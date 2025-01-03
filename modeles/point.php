<?php
/**********************************************************************************************
On trouve les fonctions liées aux points
( affichage, création forum, modifications, etc.)

Depuis la plus grande complexistée du stockage des points
GPS (voir fichier /ressources/a_lire.txt sur la structure de la base)
il est fortement recommandé de n'utiliser plus que les fonctions
ci-après pour récupérer les infos des points, en ajouter
ou en modifier

/**********************************************************************************************/

require_once ("bdd.php");
require_once ("commentaire.php");
require_once ("polygone.php");
require_once ("historique.php");
require_once ("mise_en_forme_texte.php");
require_once ("gestion_erreur.php");


/*****************************************************
Cette fonction récupère sous la forme de plusieurs objets des points de la base qui satisfont des conditions.
En gros, c'est la fonction qui construit la requête SQL de plusieurs bras de long, va chercher, et renvoi le résultat.

retourne un tableau de points:
on accède sous la forme
foreach ($points as $point)
  print($point->nom);

c'est une fonction de centralisation est utilisée pour l'instant par
l'exportation, la recherche, les nouvelles et le flux RSS
d'autre pourrons venir ensuite.

plutôt que de lui passer 50 champs, on ne lui passe qu'un seul, un object contenant les critères
de conditions et donc plus facilement extensible
voici les paramètres attendus de recherche :
(tous facultatifs, ces conditions seront toutes vérifiées par un AND entre elles)
$conditions->nom : recherche de type ILIKE sur le champ (ILIKE est insensible à la case en postgresql)
$conditions->ids_types_point : liste d'id dans notre base des points type ex: 12 ou 12,13,14
$conditions->places_maximum
$conditions->places_minimum

$conditions->altitude_maximum
$conditions->altitude_minimum

$conditions->avec_geometrie=gml/kml/svg/text/... (ou not set si on la veut pas)
   La valeur choisie c'est le st_as$valeur de postgis voir : http://postgis.org/docs/reference.html#Geometry_Outputs
   la géométrie retournée sera sous $retour->geometrie_<paramètre en entrée> comme : $retour->geometrie_gml

$conditions->ids_polygones : points appartenant à ce ou ces polygones
$conditions->ids_points : liste restreinte à ces id_point là, attention, si d'autres condition les intérdisent, ils ne sortiront pas
$conditions->precision_gps : liste des qualités GPS souhaitées, 1 ou 2,4,5, par défaut : toutes
$conditions->pas_les_points_caches : TRUE : on ne les veut pas, FALSE on les veut quand même, par défaut : FALSE
$conditions->chauffage : soit "chauffage" pour demander poële ou cheminée ou "poele" ou "cheminee"
$conditions->places_matelas_minimum : (int) veut dire avec places_matelas >= places_matelas_minimum

$conditions->trinaire->couvertures : 1 (avec) ou 0 (sans) ou NULL (on ne sait pas)
$conditions->trinaire->eau_a_proximite : 1 (avec) ou 0 (sans) ou NULL (on ne sait pas)
$conditions->trinaire->bois_a_proximite : 1 (avec) ou 0 (sans) ou NULL (on ne sait pas)
$conditions->trinaire->latrines : 1 (avec) ou 0 (sans) ou NULL (on ne sait pas)
$conditions->trinaire->manque_un_mur : 1 (avec) ou 0 (sans) ou NULL (on ne sait pas)
$conditions->trinaire->poele : 1 (avec) ou 0 (sans) ou NULL (on ne sait pas)
$conditions->trinaire->cheminee : 1 (avec) ou 0 (sans) ou NULL (on ne sait pas)
(pour augmenter la liste, voir $config_wri['champs_trinaires_points'])

$conditions->conditions_utilisation : ouverture, fermeture, cle_a_recuperer, detruit (qui sont les valeurs possibles pour ce champs)
$conditions->ouvert : si 'oui', on ne veut que les points utilisables, si 'non' alors non utilisables (pour les points pour lesquels ça n'a pas de sens comme demander un sommet "détruit" il ne sera pas retourné)

$conditions->modele='uniquement' si on ne veut QUE les modèles (voir ce qu'est un modèle dans /ressources/a_lire.txt), 'avec' si on veut les points et les modèles, si empty() on ne les veux pas.
$conditions->avec_points_caches=True : Par défaut, False : les points cachés ne sont pas retournés
$conditions->uniquement_points_cachés=True : ne retourner que les points cachés (utiles pour les modérateurs par exemple)

$conditions->limite : nombre maximum d'enregistrement à aller chercher, par défaut sans limite
$conditions->ordre (champ sur lequel on ordonne clause SQL : ORDER BY, sans le "ORDER BY" example 'date_derniere_modification DESC')

$conditions->geometrie : Ne renvoi que les points se trouvant dans cette géométrie (qui doit être de type (MULTI-)POLY au format WKB
$conditions->avec_distance : Renvoi la distance au centroid de la géométrie, le point sont alors automatiquement triés par distance
$conditions->avec_liste_polygones=True : l'objet retourné dispose d'une propriété polygones, un array de tous les polygones auquels le point appartient.

$conditions->id_createur : Dont le modérateur actuel de fiche et l'utilisation d'id id_createur
$conditions->topic_id : Dont le topic du forum est celui-ci (permet d'avoir un lien retour du forum du point vers la fiche)

Cette fonction contrôle du mieux qu'elle peut les paramètres qu'elle reçoit, certains viennent directement d'une URL !
Elle retourne un texte d'erreur avec $objet->erreur=True et $objet->message="un texte", sinon. (Oui, je sais, les exceptions c'est fait pour ça)
*****************************************************/

function infos_points($conditions)
{
  global $config_wri,$pdo;
  $champs_en_plus=$select_distance=$conditions_sql=$tables_en_plus=$ordre=$limite=$champs_polygones="";
  $points = array ();
  // On aurait pu prendre tout, mais la geom des polygones est énorme, et tout ne sert pas.
  $proprietes_interessantes_polygones = array ( 
        'id_polygone',
        'id_polygone_type',
        'article_partitif',
        'nom_polygone',
        'message_information_polygone',
        'url_exterieure',
        'site_web'
        );
  $proprietes_interessantes_type_polygones = array ( 
        'type_polygone',
        'categorie_polygone_type'
  );
   
  // condition de limite en nombre
  if (!empty($conditions->limite))
    if (!est_entier_positif ($conditions->limite))
      return erreur("Le paramètre de limite \$conditions->limite est mal formé, reçu : $conditions->limite");
    else
      $limite="\n\tLIMIT $conditions->limite";

  /******** Liste des conditions de type WHERE *******/
  if (!empty($conditions->ids_points))
    if (!verif_multiples_entiers($conditions->ids_points))
      return erreur("Le paramètre donnée pour les ids des points n'est pas valide, reçu : $conditions->ids_points");
    else
      $conditions_sql.="\n\tAND points.id_point IN ($conditions->ids_points)";

  // conditions sur le nom du point, on tente d'être tolérant en supportant les caractères non accentués, et les - , ou espaces de la même façon
  if( !empty($conditions->nom) )
    $conditions_sql .= "\n\tAND unaccent(points.nom) ILIKE unaccent(".$pdo->quote('%'.str_replace(array('-',' '),'%',$conditions->nom).'%').")";

  // condition sur l'appartenance à un polygone
  if( !empty($conditions->ids_polygones) )
  {
    if (!verif_multiples_entiers($conditions->ids_polygones))
      return erreur("Le paramètre donné pour les ids des polygones n'est pas valide, reçu : $conditions->ids_polygones");
    else
    {
      $tables_en_plus.=" INNER JOIN polygones ON ( ST_Within(points.geom,polygones.geom) AND polygones.id_polygone IN ($conditions->ids_polygones)   ) ";
      $champs_polygones=",".$config_wri['champs_table_polygones'];
    }
  }

    // On souhaite sortir tous les polygones de la base auquel chaque point appartient
  if (!empty($conditions->avec_liste_polygones) )
  {
    $tables_en_plus.=", points points2 left join polygones polygones2 on ST_Within(points2.geom, polygones2.geom) left join polygone_type on polygones2.id_polygone_type=polygone_type.id_polygone_type";
    
    foreach ($proprietes_interessantes_polygones as $propriete)
      $champs_polygones.=",polygones2.$propriete";
    foreach ($proprietes_interessantes_type_polygones as $propriete)
      $champs_polygones.=",polygone_type.$propriete";
    
    //Condition de jointure implicite pour que la 2ème référence à la table point joigne bien avec le même point dans la table points
    $conditions_sql .= "\n\tAND points.id_point=points2.id_point";
    if (empty($conditions->ordre))
      $ordre="ORDER BY points.nom,polygone_type.ordre_taille DESC";
    /* Là, c'est méga sioux et empirique comme bidouille, la limite s'appliqe au nombre de records retournés, mais avec la jointure, chaque point donne lieu à 4, 5 voir 8 lignes pour chaque polygones dont le point est membre. Alors si on voulait une limite je multiplie arbitrairement par 6 la limite demandée. (le tableau final sera tronqué pour tomber pile sur la limite demandée de nombre de points retournés) 
    Pourquoi alors mettre une limite me diriez vous ? pour économiser des ressources et du temps à attendre cette énorme requête */
    if (!empty($conditions->limite))
      $limite="\n\tLIMIT ".(7*$conditions->limite);
  }

  // on restreint les points qui appartiennent à cette geometrie (utile pour les points dans une bbox donnée ou à une distance d'un autre point, dans un cercle quoi)
  if( !empty($conditions->geometrie) )
  {
    $conditions_sql .= "\n\tAND ST_Within(points.geom,".$conditions->geometrie .") ";
    if (!empty($conditions->avec_distance))
    {
      $select_distance = ",ST_Transform(points.geom,900913) <-> ST_Transform(ST_Centroid( ".$conditions->geometrie." ),900913) AS distance" ;
      $ordre = "ORDER BY distance";
    }
  }

  // condition sur le type de point (on s'attend à 14 ou 14,15,16 )
  if( !empty($conditions->ids_types_point) )
    if (!verif_multiples_entiers($conditions->ids_types_point))
      return erreur("Le paramètre donné pour les ids des types de points n'est pas valide, reçu : $conditions->ids_types_point");
    else
      $conditions_sql .="\n\tAND points.id_point_type IN ($conditions->ids_types_point) \n";

  if( !empty($conditions->places_minimum) )
    if( est_entier_positif($conditions->places_minimum) )
        $conditions_sql .= "\n\tAND points.places >= $conditions->places_minimum";
    else
        return erreur("Le nombre de place minimum doit être un nombre entier, reçu : $conditions->places_minimum");
  if( !empty($conditions->places_maximum) )
    if( est_entier_positif($conditions->places_maximum) )
        $conditions_sql .= "\n\tAND points.places <= $conditions->places_maximum";
    else
        return erreur("Le nombre de place maximum doit être un nombre entier, reçu : $conditions->places_maximum");
  // le -1 est lié au fait que nous avons choisi (très curieusement !) que 0 veut dire "il y a des places sur matelas, mais en nombre inconnu", soit une ou plus)
  if( !empty($conditions->places_matelas_minimum) )
    if ( est_entier_positif($conditions->places_matelas_minimum ))
      $conditions_sql .= "\n\tAND points.places_matelas >= $conditions->places_matelas_minimum";
    else
      return erreur("Le nombre de place minimum sur matelas doit être un nombre entier supérieur à 0, reçu : '$conditions->places_matelas_minimum'");

  // conditions sur l'altitude
  if( !empty($conditions->altitude_minimum) )
    if( est_entier_positif($conditions->altitude_minimum) )
      $conditions_sql .= "\n\tAND points.altitude >= $conditions->altitude_minimum";
    else
      return erreur("L'altitude minimum doit être un nombre entier positif, reçu : $conditions->altitude_minimum");
  if( !empty($conditions->altitude_maximum) )
    if( est_entier_positif($conditions->altitude_maximum) )
      $conditions_sql .= "\n\tAND points.altitude <= $conditions->altitude_maximum";
    else
      return erreur("L'altitude maximum doit être un nombre entier positif, reçu : $conditions->altitude_maximum");


  //veut-on les points dont les coordonnées sont cachées ?
  if(!empty($conditions->pas_les_points_caches))
    $conditions_sql .= "\n\tAND points.id_type_precision_gps != ".$config_wri['id_coordonees_gps_fausses'];

  //quelle condition sur la qualité supposée des GPS
  if( !empty($conditions->precision_gps) )
    if (est_entier_positif($conditions->precision_gps))
      $conditions_sql .= "\n\tAND points.id_type_precision_gps IN ($conditions->precision_gps)";
    else
      return erreur("Vous avez demandé une précision pour les coordonnées gps, qui est invalide :".$conditions->precision_gps);

  //quel(s) modérateur(s) de fiche ?
  if( !empty($conditions->id_createur) )
    if (!verif_multiples_entiers($conditions->id_createur))
      return erreur("Le paramètre donné pour les ids de modérateurs de fiche n'est pas valide, reçu : $conditions->id_createur");
    else
      $conditions_sql .= "\n\tAND points.id_createur IN ($conditions->id_createur)";

  //conditions sur la description (champ remark)
  if( !empty($conditions->description) )
    $conditions_sql.="\n\tAND points.remark ILIKE ".$pdo->quote('%'.$conditions->description.'%');

  if (!empty($conditions->uniquement_points_caches))
  {
    $conditions_sql.="\n\tAND points.cache=True";
    $conditions->avec_points_caches=True;
  }

  // cas spécial sur les modèles (ils sont dans la table point, ont modele=1 et servent à pré-remplir les champs d'une saisie d'un type particulier)
  // par défaut on ne les veut pas
  if (!empty($conditions->modele))
  {
    if ($conditions->modele=='uniquement')
      $conditions_sql.="\n\tAND points.modele=1";
  }
    else
      $conditions_sql.="\n\tAND points.modele!=1";

  //prise en compte des conditions trinaires couverture, eau à proximité, etc. (1, 0 ou NULL = ne sait pas)
  if (!empty($conditions->trinaire))
    foreach ($conditions->trinaire as $champ => $valeur)
      if (in_array($champ,$config_wri['champs_trinaires_points']) and in_array($valeur,array(1,0,Null)) ) // A priori, rien ne vient d'un formulaire (mais soyons safe), et on peut nous même nous tromper en passant cette condition
        $conditions_sql.="\n\tAND points.$champ IS ".var_export($valeur,true) ; // var_export renvoie la valeur d'un bool et null aussi
      else
        return erreur("La demande ne peut aboutir car la condition de $champ=$valeur est incorrecte");

  if (!empty($conditions->avec_geometrie))
    $champs_en_plus.=",st_as$conditions->avec_geometrie(geom) AS geometrie_$conditions->avec_geometrie";

  //prise en compte de la recherche sur le chauffage
  if (!empty($conditions->chauffage))
  {
    switch ($conditions->chauffage)
    {
      case 'chauffage':$conditions_sql.="\n\tAND (points.cheminee OR points.poele)";break;
      case 'cheminee':$conditions_sql.="\n\tAND points.cheminee IS TRUE";break;
      case 'poele':$conditions_sql.="\n\tAND points.poele IS TRUE ";break;
    }
  }

  // Je pige pas, en pg on ne peut pas faire not in (Null,...) !
  if (!empty($conditions->ouvert))
  {
    if ($conditions->ouvert=='non')
      $conditions_sql.="\n\tAND points.conditions_utilisation in ('fermeture','detruit') ";
    if ($conditions->ouvert=='oui')
      $conditions_sql.="\n\tAND (points.conditions_utilisation is null or points.conditions_utilisation in ( 'ouverture','cle_a_recuperer') )  ";
  }
  if (!empty($conditions->topic_id))
    $conditions_sql.="\n\tAND points.topic_id =".$conditions->topic_id;
    
  if (!empty($conditions->ordre))
      $ordre="\nORDER BY $conditions->ordre";

  if ( !empty($conditions->conditions_utilisation) )
    if (in_array($conditions->conditions_utilisation, array('ouverture', 'fermeture', 'cle_a_recuperer', 'detruit')))
      $conditions_sql.="\n\tAND points.conditions_utilisation = '$conditions->conditions_utilisation'";
    else
      return erreur("On nous a demandé les points avec '$conditions->conditions_utilisation' ce qui est inexistant ou signe d'un bug");

  // CLUSTERISATION AU NIVEAU DU SERVEUR
  if (!empty($conditions->cluster))
    if ( $conditions->cluster &&
      !$tables_en_plus ) // Si on croise avec un polygone ou autre, on ne clusterise pas car il y aura moins de points et ça évite une requette compliquée :)
    {
    // Groupage des points dans des carrés de <cluster> degrés de latitude et longitude
    $query_clusters="
SELECT count(*) AS nb_points, min(id_point) AS id_point, min(ST_AsGeoJSON(geom)) AS geojson,
       round(ST_X(geom)/{$conditions->cluster}) AS cluster_lon, round(ST_Y(geom)/{$conditions->cluster}) AS cluster_lat
  FROM points
  WHERE true $conditions_sql
  GROUP BY cluster_lon, cluster_lat
  $limite
  ";
    if ( ! ($res_clusters = $pdo->query($query_clusters)) )
      return erreur("Une erreur sur la requête est survenue",$query_clusters);

    $points_isoles = [];

    while ( $raw = $res_clusters->fetch() )
      if ( $raw->nb_points > 1 ) // S'il y a plusieurs points dans le carré
      {
        // On fabrique un "point" de type "cluster" (cercle bleu avec un nombre dedans)
        $raw->nom = $raw->nb_points.' points';

        // Comme openlayers réclame un id pour gérer son affichage,
        // on calcule un id virtuel à partir des limites du cluster
        $raw->id_point = intval($raw->cluster_lon + ($raw->cluster_lat + 1000) * 2000);

        // Et on l'enregistre dans la liste des points
        $points[] = $raw;
      }
      elseif ( $raw->nb_points == 1 ) // S'il n'y a qu'un point dans le carré
      {
        // On n'en fait pas un cluster et on le traitera plus tard comme un point normal
        $points_isoles[] = $raw->id_point;
      }

    if ( !count($points_isoles) ) // S'il n'y a pas de points isolés, c'est tout !
      return $points;

    // Sinon, on change le scope des points qu'il reste à traiter
    $conditions_sql.="\n\tAND id_point IN (".implode(',',$points_isoles).")";
  }

  $query_points="
  SELECT points.*,
         ST_AsGeoJSON(points.geom) AS geojson,
         type_precision_gps.*,
         point_type.*,COALESCE(phpbb3_users.username,points.nom_createur) as nom_createur,
         ST_X(points.geom) as longitude,ST_Y(points.geom) as latitude,
         extract('epoch' from points.date_derniere_modification) as date_modif_timestamp,
         extract('epoch' from points.date_creation) as date_creation_timestamp
         $select_distance
         $champs_polygones
         $champs_en_plus
  FROM
         type_precision_gps,point_type, points LEFT join phpbb3_users on points.id_createur = phpbb3_users.user_id $tables_en_plus
  WHERE
         points.id_type_precision_gps=type_precision_gps.id_type_precision_gps
         AND points.id_point_type=point_type.id_point_type
         $conditions_sql
  $ordre
  $limite
  ";
  
  if ( ! ($res = $pdo->query($query_points)))
    return erreur("Une erreur sur la requête est survenue",$query_points);

  // Constuisons maintenant la liste des points demandés avec toutes les informations sur chacun d'eux
  // Depuis 12/2024 On sort maintenant tous les polygones auxquels les points appartiennent chaque point peut sortir plusieurs fois, il faut en tenir compte.
  $id_point_deja_fait=0;
  $nouveau_point=true;
  $nombre_point_deja_recuperes=0;
  while ($point = $res->fetch())
  {
    // on attaque un nouveau point
    if ($id_point_deja_fait != $point->id_point)
    {
      $point_final=$point;
      $nombre_point_deja_recuperes++;
      if (!empty($conditions->limite))
        if ($nombre_point_deja_recuperes > $conditions->limite) // On dépasse le nombre de point qu'on avait demandé, on s'arrête là
          break;
      
      $polygone = new stdClass;
      // On enlève les propriétés du polygone (si elle existe), car on les veut dans un sous array
      if (!empty($conditions->avec_liste_polygones))
      {
        foreach (array_merge($proprietes_interessantes_polygones,$proprietes_interessantes_type_polygones) as $propriete)
        {
          $polygone->$propriete = $point->$propriete;
          unset($point_final->$propriete);
        }
        $point_final->polygones[]=$polygone;
      }
      
        
      //  phpBB intègre un nom d'utilisateur dans sa base après avoir passé un htmlentities pour les users connectés, je réalise l'opération inverse
      if (!empty($point->id_createur))
        $point->nom_createur=html_entity_decode($point->nom_createur);
    }
    elseif (est_entier_positif($point->id_polygone))
    {
      // si c'est toujours le même id_point, alors c'est toujours le même point, on ne fait qu'ajouter le polygone à l'array
      $polygone = new stdClass;
      foreach (array_merge($proprietes_interessantes_polygones,$proprietes_interessantes_type_polygones) as $propriete)
        $polygone->$propriete = $point->$propriete;
      $point_final->polygones[]=$polygone;
    }

    // Ici, petite particularité sur les points cachés, par défaut, on ne veut pas les renvoyer, mais on veut quand
    // même, si un seul a été demandé, pouvoir dire qu'il est caché (du public) ce qui est différent d'inexistant dans la base. On va donc le chercher en base mais on renvoi un message erreur s'il est en caché
    // FIXME : cela créer un bug sur l'utilisation des limites, car lorsque l'on en demande x on en obtient en fait x-le nombre de points cachés
    if (!$point->cache or !empty($conditions->avec_points_caches)) // On renvoi ce point, soit il n'est pas caché, soit on a demandé aussi les points cachés
    {
      $points[$point->id_point]=$point_final;
      $id_point_deja_fait=$point->id_point;
    }
    elseif ( !empty($conditions->ids_points) and is_numeric($conditions->ids_points)) // on avait spécifiquement demandé un point mais il est caché on retourne un message d'erreur
      return erreur("Ce point d'id $conditions->ids_points a existé par le passé sur ce site, mais seul un modérateur peut retrouver son historique");
  }
  return $points;
}

/*****************************************************
Cette fonction retourne sous la forme d'un object
toutes les caractéristiques d'un point
Voir a_lire.txt annexe 1 dans ressources pour voir un example d'élément

on accède sous la forme :
$infos_point->champ
un array est disponible sous la forme
$infos_point->polygones[$i]->champ
( polygones triés par importance pays>département>massif>carte>parc
pour obtenir la liste des polygones auquels ce point appartient

FIXME: je pense que presque rien ne justifie l'existence de cette fonction qui fait la même chose que celle avant. C'est juste pour l'historique.

FIXME: 2022 Et en plus, j'arrête pas d'ajouter des paramètres, on va finir par passer un tableau d'options ! ce que je voulais éviter en faisant la fonction précédente

*****************************************************/
function infos_point($id_point,$meme_si_cache=False,$avec_polygones=True, $meme_si_modele=False)
{
  // inutile de faire tout deux fois, j'utilise la fonction plus haut pour n'en récupérer qu'un
  global $config_wri,$pdo;

  $conditions = new stdClass;
  $conditions->ids_points=$id_point;
  
  if ($avec_polygones)
    $conditions->avec_liste_polygones=True;

  if ($meme_si_modele)
    $conditions->modele='avec';

  if ($meme_si_cache)
    $conditions->avec_points_caches=True;

  // récupération des infos du point
  $points=infos_points($conditions);
  
  // Requête impossible à executer
  if (!empty($points->erreur))
    return erreur($points->message);

  if (count($points)==0)
    return erreur("Le numéro de point demandé $id_point est introuvable dans notre base");

  if (count($points)>1)
    return erreur("Ben ça alors ? on a récupéré plus que 1 point, pas prévu...");

  // Comme il n'y a qu'un élément, on le prend
  $point=reset($points);

  return $point;
}
/******************************************************************************************************************************
Lien plus simple à utiliser maintenant ! sur la base de l'objet point "habituel" et plus rapide que celui du dessous
car requête de moins
*******************************************************************************************************************************/
function lien_point($point,$lien_local=false)
{
  global $config_wri;
  if (isset($_SERVER['HTTPS']))
      $schema="https";
  else
      $schema="http";

  if ($lien_local)
      $url_complete=$config_wri['sous_dossier_installation'];
  else
      $url_complete="$schema://".$config_wri['nom_hote'].$config_wri['sous_dossier_installation'];

   return $url_complete."point/$point->id_point/".replace_url($point->nom_type)."/".replace_url($point->nom)."/";
}


// Par choix, la notion d'utilisabilité dans la base est enregistrée en un seul champ pour tous les cas
// (détruite, fermée, ouverte, besoin de récupérer la clé) car ces états sont exclusifs. Moralité, je ne peux utilise le système qui détermine tout seul
// le texte en utilisant la table point_type, donc en dur dans le code
// Pour les points d'eau, on va aussi gérer le cas intermitent
function texte_non_ouverte($point)
{
    global $config_wri;
  //Si elle/il est fermé, on l'indique directement en haut en rouge
  switch ($point->conditions_utilisation)
  {
    case 'cle_a_recuperer':
      return "Clé à récupérer avant";
    case 'intermittent':
      return "Débit intermittent";
    case 'detruit':
            if ($point->id_point_type==$config_wri['id_cabane_non_gardee'])
                return "Détruite";
            else
                return "Détruit";
    case 'fermeture':
            return $point->equivalent_conditions_utilisation;

    default:
      return ""; // tous les autres cas, normalement on arrive pas la
  }
}

//**********************************************************************************************
// Récupère le dernier post sur un forum d'un point
// JMB : je rajoute les first et last topic, apparement, si egaux, alors le topicest vide
// on affiche les commentaires+photos en plus
function infos_point_forum ($point)
{
  global $config_wri,$pdo;
  $result = array();

  if (!est_entier_positif($point->topic_id))
    return erreur("Le point passé n'a pas d'id valide ou existant sur le forum reçu :".$point->topic_id ?? '');
  $q="SELECT *
      FROM phpbb3_posts
      WHERE topic_id = $point->topic_id
        AND post_visibility = 1
      ORDER BY post_time DESC";
  $r = $pdo->query($q);
  if (!$r) return erreur("Erreur sur la requête SQL","$q en erreur");

  while ( $res = $r->fetch() )
  {
    $res->post_text = purge_phpbb_post_text($res->post_text);

    // Limite la longueur du texte
    if (strlen ($res->post_text) > $config_wri['point_posts_lon_max_text'])
        $res->post_text = substr ($res->post_text,0,$config_wri['point_posts_lon_max_text']).'&nbsp;<b> . . .</b>';

    $res->date_humaine=date_format_francais($res->post_time);

    if (strlen($res->post_text)) { // Elimine le premier post généré automatiquement lors de la création du point
      if (count($result) == $config_wri['point_posts_nb_max_post']) {
        $res->date_humaine = '. . . voir les autres.';
        $res->post_text = '';
      }
      if (count($result) <= $config_wri['point_posts_nb_max_post']) // Elimine le premier post généré automatiquement lors de la création du point
        $result[] = $res;
    }
  }

  return $result;
}

/********************************************************
Fonction qui permet, en fonction de l'object $point passé en paramêtre la mise à jour OU la création si :
$point->id_point=="" ou not set
Les autres champ, classiques, comme la sortie de la fonction infos_point($id_point) servirons pour la création ou la mise à jour.
Le minimum vital est que $point->nom ne soit pas vide et que les coordonées latitude et longitude soient données
tout est facultatif (ou presque) mais si :
$point->champ est vide ("") il sera remis à zéro
si
$point->champ n'existe pas (isset()=FALSE on y touche pas)
sly 02/11/2008
jmb 17/02/13 PDO + ca deconne
Le retour de cette fonction et l'id du point (qu'il soit créé ou modifié)
Si une erreur grave survient, rien n'est fait et un retour par la fonction erreur() est fait.

********************************************************/

function modification_ajout_point($point,$id_utilisateur_qui_modifie=0)
{
  global $config_wri,$pdo;

  // désolé, le nom du point ne peut être vide, unset ou juste des espaces
  if ( empty($point->nom) or empty(trim($point->nom)))
    return erreur("Le nom ne peut être vide");
  if ( preg_match("/[\<\>\]\[\;]/",$point->nom) )
    return erreur("Le nom contient un des caractères non autorisé suivant : [ ] < > ;");

  if( isset($point->site_officiel) )
  {
    // Pensez bien qu'un modérateur puisse vouloir remettre à "" le site n'existant plus
    if ($point->site_officiel=="")
        $champs_sql['site_officiel'] = "''";
    //cas du site un peu particulier ou l'internaute n'aura pas forcément pensé à mettre http://
    elseif ( !preg_match("/https?:\/\//",$point->site_officiel))
        $champs_sql['site_officiel'] = $pdo->quote('http://'.$point->site_officiel);
    else
        $champs_sql['site_officiel'] = $pdo->quote($point->site_officiel);
  }

  // On met à jour la date de dernière modification. PGSQL peut le faire, avec un trigger..
  $champs_sql['date_derniere_modification'] = 'NOW()';

  /********* On ne peut plus créer de cabane autour d'une cabane cachée *************/
  if ($point->id_point_type == 7 )
  {
    $distance = $config_wri['defaut_max_distance_cabane_cachee'] * 3;
    $q="SELECT id_point, nom
      FROM points
      WHERE cache = true AND
          id_point <> ".($point->id_point?:0)." AND
          ST_DWithin(geom, ST_GeomFromGeoJSON('{$point->geojson}'), $distance, false)
        LIMIT 1";

    $r = $pdo->query($q);
    if (!$r)
      return erreur("Erreur sur la requête SQL","$q en erreur");

    if ( $res = $r->fetch() )
      return erreur("L'emplacement de <a href='/point/{$res->id_point}'>\"{$res->nom}\"</a> \n".
        "et ses alentours sont privés.<br/>\n".
        "On ne peut pas y référencer de cabane.<br/>\n".
        "Voir : <a href=\"/wiki/fiche-cabane-non-gardee\">Définition d'une cabane non gardée</a>.<br/>\n".
        "Laissez-nous un message sur le forum si vous souhaitez en discuter.<br/>\n");
  }

  /********* les coordonnées du point *************/
  if (empty($point->geojson)) { // Plus besoin de faire ces vérifs avec le nouveau format geojson
  // désolé, les coordonnées ne peuvent être vide ou non numérique
  $erreur_coordonnee="du point doit être au format degré décimaux, par exemple : 45.789, la valeur reçue est :";
  if (empty($point->latitude) or !is_numeric($point->latitude))
    return erreur("La latitude $erreur_coordonnee $point->latitude");
  if (empty($point->latitude) or !is_numeric($point->longitude))
    return erreur("La longitude $erreur_coordonnee $point->longitude");

  if ($point->latitude>90 or $point->latitude<-90)
    return erreur("La latitude du point doit être comprise entre -90 et 90 (degrés)");
  if ($point->longitude>180 or $point->longitude<-180)
    return erreur("La longitude du point doit être comprise entre -180 et 180 (degrés)");
  }
  // si aucune précision gps, on les suppose approximatives
  if (empty($point->id_type_precision_gps))
    $point->id_type_precision_gps=$config_wri['id_coordonees_gps_approximative'];

  // si aucune altitude, on la suppose à 0
  if (!isset($point->altitude))
    $point->altitude=0;
  //On a bien reçu une altitude, mais ça n'est pas une valeur numérique
  if (!is_numeric($point->altitude))
    return erreur("L'altitude du point doit être un nombre, reçu : $point->altitude");

  //On a bien reçu une altitude, mais c'est une valeur vraiment improbable
  if ($point->altitude>8848 or $point->altitude<0)
    return erreur("$point->altitude"."m comme altitude du point, vraiment ?");

  if (!empty($point->geojson))
    $champs_sql['geom']="ST_SetSRID(ST_GeomFromGeoJSON('$point->geojson'), 4326)";

  foreach ($config_wri['champs_entier_ou_sait_pas_points'] as $a_tester)
    if (!empty($point->$a_tester))
      if ( !(est_entier_positif($point->$a_tester) or $point->$a_tester=="ne_sait_pas") )
        return erreur("Le nombre de $a_tester doit être un entier supérieur ou égal à 0, reçu : '".$point->$a_tester."'");
  //d($point->places_matelas);
  if (isset($point->places_matelas) and empty($point->places_matelas)) // La valeur a été mise à vide, ça veut dire qu'on veut l'annuler, pas l'ignorer, bon, il pourrait pas mettre 0 dans la case non ?
    $point->places_matelas=0;
  if (isset($point->places) and empty($point->places)) // La valeur a été mise à vide, ça veut dire qu'on veut l'annuler, pas l'ignorer, bon, il pourrait pas mettre 0 dans la case non ?
    $point->places=0;
/********* Préparation des champs à mettre à jour, tous ceux qui sont dans $point->xx ET dans $config_wri['champs_simples_points'] *************/
// champ ou il faut juste un set=nouvelle_valeur

  foreach ($config_wri['champs_simples_points'] as $champ)
    if (isset($point->$champ))
      if($point->$champ  === "ne_sait_pas") // cas spécial qui vient directement du formulaire avec la coche "Ne sait pas"
        $champs_sql[$champ]= "NULL";
      elseif (is_string($point->$champ))
        $champs_sql[$champ]=$pdo->quote($point->$champ);
      elseif ($point->$champ === false)
        $champs_sql[$champ]="'f'";
      elseif ($point->$champ === true)
        $champs_sql[$champ]="'t'";
      else
        $champs_sql[$champ]=$point->$champ;

  if ( !empty($point->id_point) )  // update
  {
    $point_avant = infos_point($point->id_point,true,false,true);
    if (isset($point_avant->erreur) and $point_avant->erreur) // oulla on nous demande une modif mais il n'existe pas ?
        return erreur("Erreur de modification du point : $point_avant->message");

    $query_finale=requete_modification_ou_ajout_generique('points',$champs_sql,'update',"id_point=$point->id_point");

    if (!$pdo->exec($query_finale))
        return erreur("La requête SQL est en erreur, mais nous ne savons pas pourquoi, prévenez nous sur le forum, vous avez trouvé un bug !",$query_finale);

    /********* Renommage du titre "topic point" dans le forum refuges si le nom de la fiche change, sauf s'il s'agit d'un modèle, qui n'a pas de sujet dans le forum, en réalité, on pourrait uniformiser et leur laisser un forum, ça ne poserait aucun problème, mais des modérateurs s'en sont trouvé étonné et on voulu bien faire, et on supprimé les forum en question, créant finalement un bug, alors, en 2020 j'ai décidé de ne plus avoir de forum pour les modèles *************/
    if (!$point_avant->modele and $point_avant->nom!=$point->nom)
      forum_submit_post ([
          'action' => 'edit',

          'post_edit_reason' => 'Le nom de la fiche a été changée, le titre du forum change aussi. Il était '.mb_ucfirst($point_avant->nom),
          'post_edit_user' => $id_utilisateur_qui_modifie, // En cas de modification, cet id servira dans le log de modération pour dire qui a modifié la fiche, ça rassure Pascal 74
          'topic_id' => $point->topic_id,
          'topic_title' => mb_ucfirst($point->nom),
          'post_time' => '', // sly : ça ressemble à une magouille, mais si post_time est vide, alors lors d'une modif du post le code de phpBB va prendre la date actuelle comme date de modification. Oui, moi non plus je n'ai pas compris, mais c'est ce que fait le code de submit_post. Si on ne l'avait pas passé, alors il aurait pris la date actuelle du post comme date de modif.
      ]);
    historisation_modification($point_avant,$point,'modification point',$id_utilisateur_qui_modifie);
  }
  else  // INSERT
  {
    // On appelle la fonction du forum qui crée un topic dans le forum refuges
    $r = forum_submit_post ([
        'action' => 'post',
        'forum_id' => $config_wri['forum_refuges'],
        'topic_title' => mb_ucfirst($point->nom),
        'topic_poster' => $point->id_createur, // Vaut 0 si c'est un anonyme, sinon l'id de la personne connectée
    ]);
    if (!$r['topic_id'])
        return erreur( "Erreur création forum point<br/>".var_export($r,true) );

    $champs_sql['topic_id'] = $r['topic_id']; // On note le topic_id dans la table point pour faire le lien
    $query_finale=requete_modification_ou_ajout_generique('points',$champs_sql,'insert');
    if (!$pdo->exec($query_finale))
        return erreur("Requête en erreur (développeurs: activer le mode debug pour comprendre pourquoi)",$query_finale);

    $point->id_point = $pdo->lastInsertId();

    historisation_modification(null,$point,'création point',$id_utilisateur_qui_modifie);
  }

  // on retourne l'id du point (surtout utile si création)
  return $point->id_point;
}
/*******************************************************
* on lui passe un objet $point et ça supprime tout proprement
* commentaires, photos, forum, messages du forum?, point
*******************************************************/
function suppression_point($point,$id_utilisateur_qui_supprime=0)
{
  global $config_wri,$pdo;
  $conditions = new stdClass;
  // On vérifie que le $point passé existe bien dans notre base, qu'il a donc un id et que cela correspond bien à un seul point
  // toujours présent, sinon, on ne tente rien
  $point_test=infos_point($point->id_point,True);
  if (!empty($point_test->erreur))
    return erreur($point_test->message);

  $conditions->ids_points=$point->id_point;
  $commentaires_a_supprimer=infos_commentaires($conditions);
  if (isset($commentaires_a_supprimer))
    foreach ($commentaires_a_supprimer as  $commentaire_a_supprimer)
      suppression_commentaire($commentaire_a_supprimer);

  // On appelle la fonction du forum qui supprime un topic
  forum_delete_topic ($point->topic_id);

  // supp le point de toute façon, même si le forum n'avait pas de topic par exemple
  $pdo->exec("DELETE FROM points WHERE id_point=$point->id_point");

  historisation_modification($point_test,null,'suppression point');

  return ok("La fiche du point, les commentaires, les photos et la zone forum ont bien été supprimés");
}

/*******************************************************
Cette fonction retourne le nom de l'icone (sans le chemin ni l'extention)
de l'icone à utiliser sur une carte de refuges.info

Attention !! L'ordre des if est important, une cabane non utilisable  même si elle a un moyen de chauffage ben il faut bien
indiquer d'abord qu'elle est inutilisable
La nouvelle syntaxe du nom peut être visible dans /images/icones/index.php elle permet d'être dynamique pour générer un grand nombre d'icônes semblables

*******************************************************/
function choix_icone($point)
{
  global $config_wri;

  // conversion de nos types de points vers une icône de base
  $nom_icone=$config_wri['correspondance_type_icone'][replace_url($point->nom_type)] ?? '';

  // Une icone de base spéciale pour les cabanes dont il manque un mur
  if ( $point->manque_un_mur and $point->id_point_type==$config_wri['id_cabane_non_gardee'] )
    $nom_icone="cabane_manqueunmur";

   /* options qui s'ajoutent */
  if ( $point->id_point_type==$config_wri['id_cabane_non_gardee'] and $point->places==0 )
    $nom_icone.="_a48";

  if ( ($point->cheminee or $point->poele) and $point->id_point_type==$config_wri['id_cabane_non_gardee'] )
    $nom_icone.="_feu";

  if ( $point->eau_a_proximite and in_array($point->id_point_type,$config_wri['tout_type_refuge']) )
    $nom_icone.="_eau";

  // il faut une clé pour rentrer dans cette cabane
  if ( $point->conditions_utilisation=='cle_a_recuperer' and $point->id_point_type==$config_wri['id_cabane_non_gardee'] )
    $nom_icone.="_cle";

  // N'importe quoi d'inutilisable, on ajoute la croix noire
  if ( $point->conditions_utilisation=="fermeture" or $point->conditions_utilisation=="detruit" )
    $nom_icone.="_x";

  // Pour les points d'eau intermittents
  if ( $point->conditions_utilisation=="intermittent" and $point->id_point_type==$config_wri['id_point_d_eau'] )
    $nom_icone.="_a33";


  return $nom_icone;
}
// FIXME: on devrait pouvoir s'en passer et utiliser la fonction ci-avant
function liste_icones_possibles()
{
    global $config_wri;
    return array_keys($config_wri['definition_icones']);
}

/********************************************************
Fonction qui calcul la distance entre deux points gps
Retourne la distance en metres entre deux points gps dont les coordonnées sont données
( earth's circumference is 40030 Km long, divided in 360 degrees, that's 111190 )
********************************************************/
function calcul_distance_gps($lat1,$lon1,$lat2,$lon2)
{
  if ($lat1==$lat2 && $lon1==$lon2) return 0;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lon1-$lon2));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  //debug("dist($lat1,$lon1,$lat2,$lon2)=$dist");
  if ($dist>0) return $dist * 111190;
  return 0;
}
/********************************************************
Fonction qui calcul la distance entre deux points GPS de notre base
********************************************************/
function calcul_distance_points($point1,$point2)
{
  return calcul_distance_gps($point1->latitude,$point1->longitude,$point2->latitude,$point2->longitude);
}
