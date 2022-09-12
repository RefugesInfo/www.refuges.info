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
require_once ("mise_en_forme_texte.php");


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

FIXME : 2 conditions pour faire presque la même chose, je me demande s'il n'y a pas matière à simplifier :
$conditions->conditions_utilisation : ouverture, fermeture, cle_a_recuperer, detruit (qui sont les valeurs possibles pour ce champs)
$conditions->ouvert : si 'oui', on ne veut que les points utilisables, si 'non' alors non utilisables (pour les points pour lesquels ça n'a pas de sens comme demander un sommet "détruit" il ne sera pas retourné)

$conditions->modele='uniquement' si on ne veut QUE les modèles (voir ce qu'est un modèle dans /ressources/a_lire.txt), 'avec' si on veut les points et les modèles, si empty() on ne les veux pas.
$conditions->avec_points_caches=True : Par défaut, False : les points cachés ne sont pas retournés
$conditions->uniquement_points_cachés=True : ne retourner que les points cachés (utiles uniquement pour les modérateurs)

$conditions->avec_infos_massif=True si on veut les infos du massif auquel le point appartient, par défaut : sans
$conditions->limite : nombre maximum d'enregistrement à aller chercher, par défaut sans limite
$conditions->ordre (champ sur lequel on ordonne clause SQL : ORDER BY, sans le "ORDER BY" example 'date_derniere_modification DESC')

$conditions->geometrie : Ne renvoir que les points se trouvant dans cette géométrie (qui doit être de type (MULTI-)POLY au format WKB
$conditions->avec_distance : Renvoi la distance au centroid de la géométrie, le point sont alors automatiquement triés par distance

$conditions->date_creation_apres : La date de création du point est >= à celle demandée (on peut utiliser une date '2020-02-01' ou toute syntaxe postgres du genre "NOW() -  INTERVAL '1 week'"

$conditions->id_createur : Dont le modérateur actuel de fiche et l'utilisation d'id id_createur

FIXME, cette fonction devrait contrôler avec soins les paramètres qu'elle reçoit, certains viennent directement d'une URL !
Etant donné qu'il faudrait de toute façon qu'elle alerte de paramètres anormaux autant le faire ici je pense sly 15/03/2010
Je commence, elle retourne un texte d'erreur avec $objet->erreur=True et $objet->message="un texte", sinon
*****************************************************/

function infos_points($conditions)
{
  global $config_wri,$pdo;
  $champs_en_plus=$select_distance=$conditions_sql=$tables_en_plus=$ordre=$limite=$champs_polygones="";
  $points = array ();

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
  elseif (!empty($conditions->avec_infos_massif))
  {
    // Jointure en LEFT JOIN car certains de nos points sont dans aucun massifs mais on les veut pourtant
    // Il s'agit donc d'un "avec infos massif si existe, sinon sans"
    $tables_en_plus.=" LEFT JOIN polygones ON (ST_Within(points.geom, polygones.geom ) AND id_polygone_type=".$config_wri['id_massif'].")";
    $champs_polygones=",".$config_wri['champs_table_polygones'];
  }

  if (!empty($conditions->avec_liste_polygones) )
  {
    // Jointure pour la liste des polygones auquels appartient le point
    // sly : FIXME : Cette sous requête est particulièrement couteuse en ressources, il faudrait trouver une technique pour faire ça en JOIN
    $tables_en_plus.=",(
                          SELECT
                            p.id_point,
                            STRING_AGG(pg.id_polygone::text,',' ORDER BY pty.ordre_taille DESC) AS liste_polygones
                          FROM
                            polygones pg NATURAL JOIN polygone_type pty,
                            points p
                          WHERE
                            ST_Within(p.geom, pg.geom)
                            AND
                            pty.categorie_polygone_type='".$conditions->avec_liste_polygones."'
                          GROUP BY p.id_point
                          ) As liste_polys";
                        //  ca aurait pu aussi: AND pg.id_polygone_type IN (".$conditions->avec_liste_polygones.")

    $champs_polygones.=",liste_polys.liste_polygones";         
    $conditions_sql .= "\n\tAND liste_polys.id_point=points.id_point";
  }

  // on restreint a cette geometrie (un texte "ST machin en fait")
  // cette fonction remplace la distance, qui n'est rien d'autre qu'un cercle geometrique
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

  if ( !empty($conditions->date_creation_apres) )
    $conditions_sql.="\n\tAND points.date_creation >= $conditions->date_creation_apres"; // j'ai essayé $pdo->quote mais ça m'ajoute un ' d'escape en trop quand je met NOW() INTERVAL '3 days'


  if (!empty($conditions->uniquement_points_caches))
  {
    $conditions_sql.="\n\tAND cache=True";
    $conditions->avec_points_caches=True;
  }

  // cas spécial sur les modèles (ils sont dans la table point, ont modele=1 et servent à pré-remplir les champs d'une saisie d'un type particulier)
  // par défaut on ne les veut pas
  if (!empty($conditions->modele))
  {
    if ($conditions->modele=='uniquement')
      $conditions_sql.="\n\tAND modele=1";
  }
    else 
      $conditions_sql.="\n\tAND modele!=1";

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
    
  if (!empty($conditions->ordre))
      $ordre="\nORDER BY $conditions->ordre";

  if ( !empty($conditions->conditions_utilisation) )
    if (in_array($conditions->conditions_utilisation, array('ouverture', 'fermeture', 'cle_a_recuperer', 'detruit')))
      $conditions_sql.="\n\tAND points.conditions_utilisation = '$conditions->conditions_utilisation'";
    else
      return erreur("On nous a demandé les points avec '$conditions->conditions_utilisation' ce qui est inexistant ou signe d'un bug");
      
  // CLUSTERISATION AU NIVEAU DU SERVEUR
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
         point_type.*,COALESCE(phpbb3_users.username,nom_createur) as nom_createur,
         ST_X(points.geom) as longitude,ST_Y(points.geom) as latitude,
         extract('epoch' from date_derniere_modification) as date_modif_timestamp,
         extract('epoch' from date_creation) as date_creation_timestamp
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

  //Constuisons maintenant la liste des points demandés avec toutes les informations sur chacun d'eux
  $point = new stdClass();
  while ($point = $res->fetch())
  {
    // on rajoute pour chacun le massif auquel il appartient, si ça a été demandé, car c'est plus rapide
    // FIXME sly : Encore cette spécificité liée au massif qu'il faudrait généraliser
    // jmb: ce n'est pas le boulot de infos_points de donner les noms et adjectifs des massifs.
    // l'appelant devrait appeler infos_polygone avec l'ID plus tard.
    // Note sly : Le problème est que ça peut obliger à des centaines de requêtes ! (cf la recherche, les nouvelles,etc.),
    // l'avantage d'un join ici, c'est qu'on récupère tout ça en une seule requête !
    // définitivement non, le SQL n'est pas orienté objet !
    // pas le boulot non plus de infos_points de donner les liens
    // sly : d'accord avec ça, charge à l'appelant de faire l'appel à lien_point($point);
    if (!empty($conditions->avec_infos_massif))
    {
      $point->nom_massif = $point->nom_polygone;
      $point->id_massif  = $point->id_polygone;
      $point->article_partitif_massif = $point->article_partitif;
    }
    $point->date_formatee=date("d/m/y", $point->date_creation_timestamp);
    // phpBB intègre un nom d'utilisateur dans sa base après avoir passé un htmlentities, pour les users connectés
    if (!empty($point->id_createur))
      $point->nom_createur=html_entity_decode($point->nom_createur);
    
    // Ici, petite particularité sur les points cachés, par défaut, on ne veut pas les renvoyer, mais on veut quand
    // même, si un seul a été demandé, pouvoir dire qu'il est caché (du public), donc on va le chercher en base mais on renvoi une erreur s'il est en caché
    // FIXME : cela créer un bug sur l'utilisation des limites, car lorsque l'on en demande x on en obtient en fait x-le nombre de points cachés
    if (!$point->cache or !empty($conditions->avec_points_caches)) // On renvoi ce point, soit il n'est pas caché, soit on a demandé aussi les points cachés
      $points[]=$point;
    elseif ( !empty($conditions->ids_points) and is_numeric($conditions->ids_points)) // on avait spécifiquement demandé un point mais il est en attente on retourne un message d'erreur
      return erreur("Ce point a existé par le passé sur ce site, mais seul un modérateur peut retrouver son historique (et vous n'êtes pas modérateur, ou pas connecté)");
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
Pour simplifier $infos_point->massif contient les infos du polygone massif auquel le
point appartient )
FIXME: cette histoire de $infos_point->massif est qu'historiquement on s'intéresse plus aux massifs
que aux pays/départements/autres/ une version plus logique devrait laisser tomber ça et indiquer lequel des $infos_point->polygones[$i] est le massif
auquel le point appartient sly 14/03/2010

FIXME: je pense que presque rien ne justifie l'existence de cette fonction qui fait la même chose que celle avant, à part cette histoire de polygones.
Mais postgis étant super rapide, je pense que l'on peut peut fusioner

*****************************************************/
function infos_point($id_point,$meme_si_cache=False,$avec_polygones=True)
{
  // inutile de faire tout deux fois, j'utilise la fonction plus bas pour n'en récupérer qu'un
  global $config_wri,$pdo;
  if (!est_entier_positif($id_point))
    return erreur("Le n°du point demandé est invalide, reçu : $id_point");

  $conditions = new stdClass();
  $conditions->ids_points=$id_point;
  $conditions->modele='avec';
  $conditions->avec_infos_massif=True;
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

    $i=0;
  $point=$points[0];

  // recherche des différents polygones auquels appartienne le point
  // FIXME Cette particularité n'existe que lorsque on demande un point en particulier
  // idéalement, la fonction ci-après de recherche devrait faire la même chose, mais c'est bien plus couteux en calcul sly 18/05/2010
  // J'hésite, car l'objet retourné va être hiddeusement gros et en fait, on a pas souvent besoin de sa localisation complète
  // sauf sur les pages des points... doute... incertitude -- sly
  if ($avec_polygones)
  {
    $query_polygones="SELECT site_web,nom_polygone,id_polygone,article_partitif,source,message_information_polygone,url_exterieure,polygone_type.*
        FROM polygones,polygone_type,points
        WHERE
        polygones.id_polygone_type=polygone_type.id_polygone_type
        AND ST_Within(points.geom, polygones.geom)    
        AND points.id_point=$point->id_point
        ORDER BY polygone_type.ordre_taille DESC";

    $res = $pdo->query($query_polygones);
    $point->polygones = array ();
    if ( $polygones_du_point = $res->fetch() )
        do
        {
            $polygones_du_point->lien_polygone=lien_polygone($polygones_du_point,True);
            $point->polygones[]=$polygones_du_point;
        } while ( $polygones_du_point = $res->fetch() ) ;
    }
    return $point;
}
/******************************************************************************************************************************
Lien plus simple à utiliser maintenant ! sur la base de l'objet point "habituel" et plus rapide que celui du dessous
car requête de moins
FIXME uniformiser l'appel au $point->nom_massif qui devrait être atteignable dans un truc de ce style :
$point->polygones[$x]->nom_polygone
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

  if (!empty($point->nom_massif)) // Des fois, on ne l'a pas (trop d'info à aller chercher, donc il n'apparaît pas dans l'url)
    $info_massif=replace_url($point->nom_massif)."/";
  elseif (!empty($point->nom_polygone)) // FIXME : des fois c'est dans nom_massif, des fois nom_polygone, il faudrait uniformiser
    $info_massif=replace_url($point->nom_polygone)."/";
  else
    $info_massif="";
   return $url_complete."point/$point->id_point/".replace_url($point->nom_type)."/$info_massif".replace_url($point->nom)."/";
}


// Par choix, la notion d'utilisabilité dans la base est enregistrée en un seul champ pour tous les cas
// (détruite, fermée, ouverte, besoin de récupérer la clé) car ces états sont exclusifs. Moralité, je ne peux utilise le système qui détermine tout seul
// le texte en utilisant la table point_type, donc en dur dans le code
function texte_non_ouverte($point)
{
    global $config_wri;
  //Si elle/il est fermé, on l'indique directement en haut en rouge
  switch ($point->conditions_utilisation)
  {
    case 'cle_a_recuperer':
      return "Clé à récupérer avant";
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
      ORDER BY post_time DESC";
  $r = $pdo->query($q);
  if (!$r) return erreur("Erreur sur la requête SQL","$q en erreur");

  while ( $res = $r->fetch() )
  {
    $res->post_text = purge_phpbb_post_text($res->post_text);

    // Limite la longueur du texte
    if (strlen ($res->post_text) > $config_wri['point_posts_lon_max_text'])
        $res->post_text = substr ($res->post_text,0,$config_wri['point_posts_lon_max_text']).'&nbsp;<b> . . .</b>';

    //FIXME : Bon, C pa BO mais ça marche pour l'instant ! On passe temporairement en timezone Paris pour décoder l'heure du forum
    // Pas sûr que ça marche encore en heure d'hiver !
    date_default_timezone_set('Europe/Paris');
    $res->date_humaine=strftime ('%A %e %B %Y à %H:%M',$res->post_time).':';
    date_default_timezone_set('UTC');

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
/**********************************************************************************************************************
sly : 2019-09-09 Historisation du pauvre, on log dans une table un dump de l'objet point avant et après modification
L'objet $point par défaut dispose de trop de propriété, ne gardons que celles qui peuvent être modifiées par le formulaire, 
c'est à dire celle de $point_apres qui est issue du formulaire (donc comparaison sioux entre les propriété de $point_apres et $point_avant)

**********************************************************************************************************************/
function point_historisation_modification($point_avant,$point_apres,$id_utilisateur_qui_modifie=0,$type_operation="modification")
{
  global $pdo;
  
  $point_avant_simple = new stdClass;
    if (!empty($point_apres)) // la point après modification existe, on stockera d'utile que les propriétés qui ont été passé par le formulaire (moins lourd)
     foreach ($point_apres as $propriete => $valeur)
       $point_avant_simple->$propriete=$point_avant->$propriete;
    else
      foreach ($point_avant as $propriete => $valeur)
        if ($propriete!='polygones') // en cas de suppression, la liste des polygones auquel appartenait le point ne nous intéresse pas tant que ça, lourd à l'écran !
          $point_avant_simple->$propriete=$point_avant->$propriete;
       
  $query_log_modification="insert into historique_modifications_points 
  (id_point,id_user,date_modification,avant,apres,type_modification) 
  values 
  ($point_avant->id_point,
  $id_utilisateur_qui_modifie,
  NOW(),
  ".$pdo->quote(serialize($point_avant_simple)).",
  ".$pdo->quote(serialize($point_apres)).",
  '$type_operation')";
  
  if (!$pdo->exec($query_log_modification))
      return erreur("Requête en erreur, impossible d'historiser la modification",$query_log_modification);
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
  if ( empty($point->nom) or empty(trim($point->nom)) )
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

  /********* On ne peut plus créer de cabane autour d'une cabane caché *************/
  if ($point->id_point_type == 7)
  {
    $distance = 1500; // ~500m
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
    $point->altitude="0";
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
        return erreur("Le nombre de $a_tester doit être un entier supérieur ou égal à 0 ou le code spécial ne_sait_pas, reçu : '".$point->$a_tester."'");
  
  if (isset($point->places_matelas) and $point->places_matelas=="") // La valeur a été mise à vide, ça veut dire qu'on veut l'annuler, pas l'ignorer, bon, il pourrait pas mettre 0 dans la case non ?
    $point->places_matelas="0";
/********* Préparation des champs à mettre à jour, tous ceux qui sont dans $point->xx ET dans $config_wri['champs_simples_points'] *************/
// champ ou il faut juste un set=nouvelle_valeur
  foreach ($config_wri['champs_simples_points'] as $champ)
    if (isset($point->$champ))
      if($point->$champ  == "ne_sait_pas")
        $champs_sql[$champ]= "NULL";
      else
        $champs_sql[$champ]=$pdo->quote($point->$champ);
    
  if ( !empty($point->id_point) )  // update
  {
    $point_avant = infos_point($point->id_point,true,false);
    if ($point_avant->erreur) // oulla on nous demande une modif mais il n'existe pas ?
        return erreur("Erreur de modification du point : $point_avant->message");

    $query_finale=requete_modification_ou_ajout_generique('points',$champs_sql,'update',"id_point=$point->id_point");
    if (!$pdo->exec($query_finale))
        return erreur("Requête en erreur, impossible à executer",$query_finale);
    
    /********* Renommage du topic point dans le forum refuges, sauf s'il s'agit d'un modèle, qui n'a pas (ou pas besoin) de sujet dans le forum *************/
    if (!$point_avant->modele)
      forum_submit_post ([
          'action' => 'edit',
          'topic_id' => $point->topic_id,
          'topic_title' => mb_ucfirst($point->nom),
      ]);
    point_historisation_modification($point_avant,$point,$id_utilisateur_qui_modifie,'modification');
   }
   else  // INSERT
   {
    // On appelle la fonction du forum qui crée un topic dans le forum refuges
    $r = forum_submit_post ([
        'action' => 'post',
		'forum_id' => $config_wri['forum_refuges'],
        'topic_title' => mb_ucfirst($point->nom),
    ]);
    if (!$r['topic_id'])
        return erreur( "Erreur création forum point<br/>".var_export($r,true) );

    $champs_sql['topic_id'] = $r['topic_id']; // On note le topic_id dans la table point pour faire le lien
    $query_finale=requete_modification_ou_ajout_generique('points',$champs_sql,'insert');
    if (!$pdo->exec($query_finale))
        return erreur("Requête en erreur (développeurs: activer le mode debug pour comprendre pourquoi)",$query_finale);

    $point->id_point = $pdo->lastInsertId();
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

  $pdo->exec("DELETE FROM points WHERE id_point=$point->id_point"); // supp le point de toute façon, même si le forum n'avait pas de topic par exemple
  
  point_historisation_modification($point_test,Null,$id_utilisateur_qui_supprime,'suppression');

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
  $fermee_detuite=($point->conditions_utilisation=="fermeture" or $point->conditions_utilisation=="detruit" or $point->conditions_utilisation=="tari");
  
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

  if ( $point->eau_a_proximite and in_array($point->id_point_type,explode(',',$config_wri['tout_type_refuge'])) )
    $nom_icone.="_eau";

  // il faut une clé pour rentrer dans cette cabane
  if ( $point->conditions_utilisation=='cle_a_recuperer' and $point->id_point_type==$config_wri['id_cabane_non_gardee'] )
    $nom_icone.="_cle";

  // N'importe quoi d'inutilisable, on ajoute la croix noire
  if ( $fermee_detuite )
    $nom_icone.="_x";

      
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
