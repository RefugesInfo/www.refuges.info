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

require_once ("config.php");
require_once ("bdd.php");
require_once ("gestion_erreur.php");
require_once ("commentaire.php");
require_once ("polygone.php");
require_once ("mise_en_forme_texte.php");
require_once ("forum.php");

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

$conditions->trinaire->couvertures : "oui" ou "vide"
$conditions->trinaire->eau_a_proximite : "oui" ou "vide"
$conditions->trinaire->bois_a_proximite : "oui" ou "vide"
$conditions->trinaire->latrines : "oui" ou "vide"
$conditions->trinaire->manque_un_mur : "oui" ou "vide"
$conditions->trinaire->site_officiel : "oui" ou "vide"
$conditions->trinaire->xxxxx : (Le champ de la table point et vérifier à oui dans la base quand se champ est à oui)

FIXME : 2 conditions pour faire presque la même chose, je me demande s'il n'y a pas matière à simplifier :
$conditions->conditions_utilisation : ouverture, fermeture, cle_a_recuperer, detruit (qui sont les valeurs possibles pour ce champs)
$conditions->ouvert : si 'oui', on ne veut que les points utilisables, si 'non' alors non utilisables (pour les points pour lesquels ça n'a pas de sens comme demander un sommet "détruit" il ne sera pas retourné)

$conditions->modele=True si on ne veut QUE les modèles (voir ce qu'est un modèle dans /ressources/a_lire.txt), -1 si on veut tout, par défaut on ne les veux pas.
$conditions->avec_points_en_attente=True : Par défaut, False : les points en attente ne sont pas retournés
$conditions->uniquement_points_en_attente=True : ne retourner que les points en attente (utiles uniquement pour les modérateurs)

$conditions->avec_infos_massif=True si on veut les infos du massif auquel le point appartient, par défaut : sans
$conditions->limite : nombre maximum d'enregistrement à aller chercher, par défaut sans limite
$conditions->ordre (champ sur lequel on ordonne clause SQL : ORDER BY, sans le "ORDER BY" example 'date_derniere_modification DESC')

$conditions->geometrie : Ne renvoir que les points se trouvant dans cette géométrie (qui doit être de type (MULTI-)POLY au format WKB
$conditions->avec_distance : Renvoi la distance au centroid de la géométrie, le point sont alors automatiquement triés par distance

$conditions->id_createur : Dont le modérateur actuel de fiche et l'utilisation d'id id_createur

FIXME, cette fonction devrait contrôler avec soins les paramètres qu'elle reçoit, certains viennent directement d'une URL !
Etant donné qu'il faudrait de toute façon qu'elle alerte de paramètres anormaux autant le faire ici je pense sly 15/03/2010
Je commence, elle retourne un texte d'erreur avec $objet->erreur=True et $objet->message="un texte", sinon
*****************************************************/

function infos_points($conditions)
{
    global $config_wri,$pdo;
    $champs_en_plus="";
    $conditions_sql="";
    $tables_en_plus="";
    $points = [];

    // condition de limite en nombre
    if (!empty($conditions->limite))
        if (!is_numeric ($conditions->limite))
            return erreur("Le paramètre de limite \$conditions->limite est mal formé, reçu : $conditions->limite");
        else
            $limite="\nLIMIT $conditions->limite";

    /******** Liste des conditions de type WHERE *******/
    if (!empty($conditions->ids_points))
        if (!verif_multiples_entiers($conditions->ids_points))
            return erreur("Le paramètre donnée pour les ids des points n'est pas valide, reçu : $conditions->ids_points");
        else
            $conditions_sql.="\n AND points.id_point IN ($conditions->ids_points)";

    // conditions sur le nom du point, on tente d'être tolérant en supportant les caractères non accentués, et les - , ou espaces de la même façon
    if( !empty($conditions->nom) )
        $conditions_sql .= " AND unaccent(points.nom) ILIKE unaccent(".$pdo->quote('%'.str_replace(array('-',' '),'%',$conditions->nom).'%').")";

    // condition sur l'appartenance à un polygone
    if( !empty($conditions->ids_polygones) )
    {
        if (!verif_multiples_entiers($conditions->ids_polygones))
            return erreur("Le paramètre donné pour les ids des polygones n'est pas valide, reçu : $conditions->ids_polygones");
        else
        {
            $tables_en_plus.=" INNER JOIN polygones ON ( ST_Within(points.geom,polygones.geom) AND polygones.id_polygone IN ($conditions->ids_polygones)   ) ";
            $champs_polygones=",".colonnes_table('polygones',False);
        }
    }
    elseif ($conditions->avec_infos_massif)
    {
        // Jointure en LEFT JOIN car certains de nos points sont dans aucun massifs mais on les veut pourtant
        // Il s'agit donc d'un "avec infos massif si existe, sinon sans"
        $tables_en_plus.=" LEFT JOIN polygones ON (ST_Within(points.geom, polygones.geom ) AND id_polygone_type=".$config_wri['id_massif'].")";
        $champs_polygones=",".colonnes_table('polygones',False);
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
         $conditions_sql .= "\n AND liste_polys.id_point=points.id_point";
    }

    // on restreint a cette geometrie (un texte "ST machin en fait")
    // cette fonction remplace la distance, qui n'est rien d'autre qu'un cercle geometrique
    if( !empty($conditions->geometrie) )
    {
        $conditions_sql .= "\n AND ST_Within(points.geom,".$conditions->geometrie .") ";
        if ($conditions->avec_distance)
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
            $conditions_sql .="\n AND points.id_point_type IN ($conditions->ids_types_point) \n";

    if( !empty($conditions->places_minimum) )
        if( is_numeric($conditions->places_minimum) )
            $conditions_sql .= "\n AND points.places >= ". $pdo->quote($conditions->places_minimum, PDO::PARAM_INT);
        else
            return erreur("Le nombre de place minimum doit être un nombre entier, reçu : $conditions->places_minimum");
    if( !empty($conditions->places_maximum) )
        if( is_numeric($conditions->places_maximum) )
            $conditions_sql .= "\n AND points.places <= ".$pdo->quote($conditions->places_maximum, PDO::PARAM_INT);
        else
            return erreur("Le nombre de place maximum doit être un nombre entier, reçu : $conditions->places_maximum");
    // le -1 est lié au fait que nous avons choisi (très curieusement !) que 0 veut dire "il y a des places sur matelas, mais en nombre inconnu", soit une ou plus)
    if( !empty($conditions->places_matelas_minimum) )
        if( is_numeric($conditions->places_matelas_minimum) and ($conditions->places_matelas_minimum>0) )
            $conditions_sql .= "\n AND points.places_matelas >= ". $pdo->quote($conditions->places_matelas_minimum, PDO::PARAM_INT);
        else
            return erreur("Le nombre de place minimum sur matelas doit être un nombre entier supérieur à 0, reçu : '$conditions->places_matelas_minimum'");

    // conditions sur l'altitude
    if( !empty($conditions->altitude_minimum) )
        if( is_numeric($conditions->altitude_minimum) )
            $conditions_sql .= "\n AND points.altitude >= ".$pdo->quote($conditions->altitude_minimum, PDO::PARAM_INT);
        else
            return erreur("L'altitude minimum doit être un nombre entier, reçu : $conditions->altitude_minimum");
    if( !empty($conditions->altitude_maximum) )
        if( is_numeric($conditions->altitude_maximum) )
            $conditions_sql .= "\n AND points.altitude <= ".$pdo->quote($conditions->altitude_maximum, PDO::PARAM_INT);
        else
            return erreur("L'altitude maximum doit être un nombre entier, reçu : $conditions->altitude_maximum");


    //veut-on les points dont les coordonnées sont cachées ?
    if($conditions->pas_les_points_caches)
        $conditions_sql .= "\n AND points.id_type_precision_gps != ".$config_wri['id_coordonees_gps_fausses'];

    //quelle condition sur la qualité supposée des GPS
    if( !empty($conditions->precision_gps) )
        $conditions_sql .= "\n AND points.id_type_precision_gps IN ($conditions->precision_gps)";

    //quel modérateur(s) de fiche ?
    if( !empty($conditions->id_createur) )
        if (!verif_multiples_entiers($conditions->id_createur))
            return erreur("Le paramètre donné pour les ids de modérateurs de fiche n'est pas valide, reçu : $conditions->id_createur");
        else
            $conditions_sql .= "\n AND points.id_createur IN ($conditions->id_createur)";

    //conditions sur la description (champ remark)
    if( !empty($conditions->description) )
        $conditions_sql.="\n AND points.remark ILIKE ".$pdo->quote('%'.$conditions->description.'%');

    if ($conditions->uniquement_points_en_attente)
    {
        $conditions_sql.="\n AND en_attente=True";
        $conditions->avec_points_en_attente=True;
    }

    // cas spécial sur les modèle
    if ($conditions->modele==1)
        $conditions_sql.="
         AND modele=1";
    elseif($conditions->modele=="")
        $conditions_sql.="
         AND modele!=1";
    else
        $conditions_sql.="";

  //prise en compte des conditions trinaires (oui, non ou NULL = ne sait pas)
  if (isset($conditions->trinaire))      // trinaire est construit a part, pas de SQL injection possible normalement
    foreach ($conditions->trinaire as $champ => $valeur)
      $conditions_sql.="\n AND points.$champ IS ".var_export($valeur,true) ; // var_export renvoie la valeur d'un bool et null aussi

    if ($conditions->avec_geometrie)
        $champs_en_plus.=",st_as$conditions->avec_geometrie(geom) AS geometrie_$conditions->avec_geometrie";

  //prise en compte de la recherche sur le chauffage
  if (isset($conditions->chauffage))
  {
    switch ($conditions->chauffage)
    {
      case 'chauffage':$conditions_sql.="\n AND (points.cheminee OR points.poele)";break;
      case 'cheminee':$conditions_sql.="\n AND points.cheminee IS TRUE";break;
      case 'poele':$conditions_sql.="\n AND points.poele IS TRUE ";break;
    }
  }
    
  // Je pige pas, en pg on ne peut pas faire not in (Null,...) !
  if ($conditions->ouvert=='non')
    $conditions_sql.="\n AND points.conditions_utilisation in ('fermeture','detruit') ";
  if ($conditions->ouvert=='oui')
    $conditions_sql.="\n AND (points.conditions_utilisation is null or points.conditions_utilisation in ( 'ouverture','cle_a_recuperer') )  ";
  if ($conditions->ordre!="")
      $ordre="\nORDER BY $conditions->ordre";

  if ( !empty($conditions->conditions_utilisation) )
    $conditions_sql.="\n AND points.conditions_utilisation = ". $pdo->quote($conditions->conditions_utilisation);
      
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
  //d($query_points);
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
      if ($conditions->avec_infos_massif)
      {
          $point->nom_massif = $point->nom_polygone;
          $point->id_massif  = $point->id_polygone;
          $point->article_partitif_massif = $point->article_partitif;
      }
      $point->date_formatee=date("d/m/y", $point->date_creation_timestamp);
      // phpBB intègre un nom d'utilisateur dans sa base après avoir passé un htmlentities, pour les users connectés
      if (isset($point->id_createur))
          $point->nom_createur=html_entity_decode($point->nom_createur);
      
      // Ici, petite particularité sur les points en attente, par défaut, on ne veut pas les renvoyer, mais on veut quand
      // même, si un seul a été demandé, pouvoir dire qu'il est en attente, donc on va le chercher en base mais on renvoi une erreur
      // s'il est en attente
      // FIXME : cela créer un bug sur l'utilisation des limites, car lorsque l'on en demande x on en obtient en fait x-le nombre de points en attente
      if (!$point->en_attente or $conditions->avec_points_en_attente) // On renvoi ce point, soit il n'est pas en attente, soit on a demandé aussi les points en attente
          $points[]=$point;
      elseif (is_numeric($conditions->ids_points)) // on avait spécifiquement demandé un point mais il est en attente on retourne un message d'erreur
          return erreur("Ce point est en attente de décision, seul un modérateur peut agir sur lui","1");
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
function infos_point($id_point,$meme_si_en_attente=False,$avec_polygones=True)
{
  // inutile de faire tout deux fois, j'utilise la fonction plus bas pour n'en récupérer qu'un
  global $config_wri,$pdo;
  $conditions = new stdClass();
  $conditions->ids_points=$id_point;
  if (empty($id_point))
      return erreur("Il semblerait que vous n'avez pas renseigné le n°du point");
  $conditions->modele=-1;
  $conditions->avec_infos_massif=True;
  if ($meme_si_en_attente)
     $conditions->avec_points_en_attente=True;

  // récupération des infos du point
  $points=infos_points($conditions);
  // Requête impossible à executer
  if ($points->erreur)
    return erreur($points->message);
  if (count($points)==0)
    return erreur("Le numéro de point demandé \"$conditions->ids_points\" est introuvable dans notre base");
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

  if (isset($point->nom_massif)) // Des fois, on ne l'a pas (trop d'info à aller chercher, donc il n'apparaît pas dans l'url)
    $info_massif=replace_url($point->nom_massif)."/";
  elseif (isset($point->nom_polygone)) // FIXME : des fois c'est dans nom_massif, des fois nom_polygone, il faudrait uniformiser
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

  $q="SELECT *
      FROM phpbb3_posts
      WHERE topic_id = {$point->topic_id}
      ORDER BY post_time DESC";
  $r = $pdo->query($q);
  if (!$r) return erreur("Erreur sur la requête SQL","$q en erreur");

  while ( $res = $r->fetch() )
  {
    $res->post_text = preg_replace ('/\[url=([^\]]*)\]/i', ' $1 ', $res->post_text); // Conserve l'url de [url=...]
    $res->post_text = preg_replace ('/\[[^\]]*\]/i', '', $res->post_text); // Enlève les balises []
    $res->post_text = preg_replace ('/\<[^\>]*\>/i', ' ', $res->post_text); // Enlève les balises <>
    $res->post_text = preg_replace ('/&nbsp;/i', ' ', $res->post_text); // Purge les espaces multiples
    $res->post_text = preg_replace ('/\s+/i', ' ', $res->post_text); // Purge les espaces multiples
    $res->post_text = preg_replace ('/^\s*$/i', '', $res->post_text); // Purge les posts sans texte

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

function modification_ajout_point($point)
{
  global $config_wri,$pdo;
  // désolé, le nom du point ne peut être vide
  if ( trim($point->nom) =="" )
    return erreur("Le nom ne peut être vide");
  if ( preg_match("/[\<\>\]\[\;]/",$point->nom) )
    return erreur("Le nom contient un des caractères non autorisé suivant : [ ] < > ;");

    if( isset($point->site_officiel) )
    {
        // Pensez bien qu'un modérateur puisse vouloir remettre à "" le site n'existant plus
        if ($point->site_officiel=="")
            $champs_sql['site_officiel'] = $pdo->quote("");
        //cas du site un peu particulier ou l'internaute n'aura pas forcément pensé à mettre http://
        elseif ( !preg_match("/https?:\/\//",$point->site_officiel))
            $champs_sql['site_officiel'] = $pdo->quote('http://'.$point->site_officiel);
        else
            $champs_sql['site_officiel'] = $pdo->quote($point->site_officiel);
    }

    // On met à jour la date de dernière modification. PGSQL peut le faire, avec un trigger..
    $champs_sql['date_derniere_modification'] = 'NOW()';

    /********* les coordonnées du point *************/
    if (!$point->geojson) { // Plus besoin de faire ces vérifs avec le nouveau format geojson
    // désolé, les coordonnées ne peuvent être vide ou non numérique
    $erreur_coordonnee="du point doit être au format degré décimaux, par exemple : 45.789, la valeur reçue est :";
    if (!is_numeric($point->latitude))
      return erreur("La latitude $erreur_coordonnee $point->latitude");
    if (!is_numeric($point->longitude))
      return erreur("La longitude $erreur_coordonnee $point->longitude");

    if ($point->latitude>90 or $point->latitude<-90)
      return erreur("La latitude du point doit être comprise entre -90 et 90 (degrés)");
    if ($point->longitude>180 or $point->longitude<-180)
      return erreur("La longitude du point doit être comprise entre -180 et 180 (degrés)");
    }
  // si aucune précision gps, on les suppose approximatives
  if ($point->id_type_precision_gps=="")
    $point->id_type_precision_gps=$config_wri['id_coordonees_gps_approximative'];

    // si aucune altitude, on la suppose à 0
    if (!isset($point->altitude))
        $point->altitude="0";
    //On a bien reçu une altitude, mais ça n'est pas une valeur numérique
    if (!is_numeric($point->altitude))
        return erreur("L'altitude du point doit être un nombre, reçu : $point->altitude");

    //On a bien reçu une altitude, mais c'est une valeur vraiment improbable
    if ($point->altitude>8848 or $point->altitude<-50)
        return erreur("$point->altitude"."m comme altitude du point, vraiment ?");

    if (($point->geojson!=""))
      $champs_sql['geom']="ST_SetSRID(ST_GeomFromGeoJSON('$point->geojson'), 4326)";

    foreach ($config_wri['champs_entier_ou_sait_pas_points'] as $a_tester)
      if (isset($point->$a_tester))
        if ( !((ctype_digit($point->$a_tester) and $point->$a_tester>=0) or $point->$a_tester=="ne_sait_pas") )
          return erreur("Le nombre de $a_tester doit être un entier supérieur ou égal à 0 ou le code spécial ne_sait_pas, reçu : '".$point->$a_tester."'");
    
    if ($point->places_matelas=="")
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
            
        // 2019-09-09 Historisation du pauvre, on log dans une table un dump de l'objet point avant et après modification
        if ( isset($_SESSION['id_utilisateur']))
            $id_utilisateur=$_SESSION['id_utilisateur'];
        
        // L'objet $point par défaut dispose de trop de propriété, ne gardons que celles qui peuvent être modifiées
        $point_avant_simple = new stdClass;
        foreach ($point as $propriete => $valeur)
            $point_avant_simple->$propriete=$point_avant->$propriete;
            
        $query_log_modification="insert into historique_modifications_points 
        (id_point,id_user,date_modification,avant,apres,type_modification) 
        values 
        ($point->id_point,$id_utilisateur,NOW(),".$pdo->quote(serialize($point_avant_simple)).",".$pdo->quote(serialize($point)).",'modification')";
        if (!$pdo->exec($query_log_modification))
            return erreur("Requête en erreur, impossible d'historiser la modification",$query_log_modification);
        
        
        /********* Renommage du topic point dans le forum refuges *************/
        forum_submit_post ([
            'action' => 'edit',
            'topic_id' => $point->topic_id,
            'topic_title' => mb_ucfirst($point->nom),
        ]);
   }
   else  // INSERT
   {
    // On appelle la fonction du forum qui crée un topic dans le forum refuges
    $r = forum_submit_post ([
        'action' => 'post',
		'forum_id' => $config_wri['forum_refuges'],
        'topic_title' => $point->nom,
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
* commentaires, photos, forum, points, points_gps
*******************************************************/
function suppression_point($point)
{
  global $config_wri,$pdo;
  $conditions = new stdClass;
  // On vérifie que le $point passé existe bien dans notre base, qu'il a donc un id et que cela correspond bien à un seul point
  // toujours présent, sinon, on ne tente rien
  $point_test=infos_point($point->id_point,True);
  if ($point_test->erreur)
      return erreur($point_test->message);

  $conditions->ids_points=$point->id_point;
  $commentaires_a_supprimer=infos_commentaires($conditions);
  if (isset($commentaires_a_supprimer))
    foreach ($commentaires_a_supprimer as  $commentaire_a_supprimer)
      suppression_commentaire($commentaire_a_supprimer);

  // On appelle la fonction du forum qui supprime un topic
  forum_delete_topic ($point->topic_id);

  $pdo->exec("DELETE FROM points WHERE id_point=$point->id_point"); // supp le point de tt facon

  return ok("La fiche du point, les commentaires, les photos et la zone forum ont bien été supprimés");
}

/*******************************************************
Cette fonction retourne le nom de l'icone (sans le chemin ni l'extention)
de l'icone à utiliser sur une carte de refuges.info
Elle n'est qu'une solution intermédiaire avant un éventuel système plus flexible
de style permettant de choisir l'icone selon les critères d'un point

*******************************************************/
function choix_icone($point)
{
    global $config_wri;
    // par défaut, et sauf modification ultérieure, le nom de l'icone à choisir porte, par défaut, le nom du type de point (dans une version convertie sans accents,guillemet ou espace)
    $nom_icone=replace_url($point->nom_type);

    // Pour les cabane dans lesquelles on ne peut dormir (ou à qui il manque un mur)
    if ( ($point->manque_un_mur OR $point->places==0) AND $point->id_point_type==$config_wri['id_cabane_non_gardee'] )
        $nom_icone="abri";

    // les bâtiments en montagne sont des bâtiments situé en montgne dont on ne sait rien et qu'il faudrait explorer ou, si fermé dont on sait qu'ils ne peuvent servir
    if ( ($point->conditions_utilisation=='fermeture' or $point->conditions_utilisation=="detruit") AND $point->id_point_type==$config_wri['id_batiment_en_montagne'] )
        $nom_icone="batiment-inutilisable";
        
    // Pour les cabane dans lesquelles on ne peut dormir (ou à qui il manque un mur)
    if ( $point->conditions_utilisation=='cle_a_recuperer' AND $point->id_point_type==$config_wri['id_cabane_non_gardee'] )
        $nom_icone="cabane_cle";
        
    // Pour les cabane/refuges/gites dans lesquelles on ne peut dormir (car fermées ou détruites)
    if ( ($point->conditions_utilisation=="fermeture" or $point->conditions_utilisation=="detruit")
          AND
          ($point->id_point_type==$config_wri['id_cabane_non_gardee'] or $point->id_point_type==$config_wri['id_gite_etape'] or $point->id_point_type==$config_wri['id_refuge_garde'])
       )
        $nom_icone="inutilisable";
    if ( ($point->conditions_utilisation=="fermeture" or $point->conditions_utilisation=="detruit")
        AND
        ($point->id_point_type==$config_wri['point_d_eau'])
       )
        $nom_icone="ancien-point-d-eau";
    return $nom_icone;
}
function chemin_icone($nom_icone,$absolu=true)
{
    global $config_wri;
    if (isset($_SERVER['HTTPS']))
        $schema="https";
    else
        $schema="http";
    if ($absolu)
        $url_et_host="$schema://".$config_wri['nom_hote'];
    else
        $url_et_host='';
    return $url_et_host.$config_wri['url_chemin_icones'].$nom_icone.'.png';
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

