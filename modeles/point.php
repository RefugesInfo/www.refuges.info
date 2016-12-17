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
require_once ("point_gps.php");
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

$conditions->binaire->couvertures : "oui" ou "vide"
$conditions->binaire->eau_a_proximite : "oui" ou "vide"
$conditions->binaire->bois_a_proximite : "oui" ou "vide"
$conditions->binaire->latrines : "oui" ou "vide"
$conditions->binaire->manque_un_mur : "oui" ou "vide"
$conditions->binaire->site_officiel : "oui" ou "vide"
$conditions->binaire->xxxxx : (Le champ de la table point et vérifier à oui dans la base quand se champ est à oui)

FIXME : 2 conditions pour faire presque la même chose, je me demande s'il n'y a pas matière à simplifier :
$conditions->conditions_utilisation : ouverture, fermeture, cle_a_recuperer, detruit (qui sont les valeurs possibles pour ce champs)
$conditions->ouvert : si 'oui', on ne veut que les points utilisables, si 'non' alors non utilisables (pour les points pour lesquels ça n'a pas de sens comme demander un sommet "détruit" il ne sera pas retourné)

$conditions->modele=True si on ne veut QUE les modèles (voir ce qu'est un modèle dans /ressources/a_lire.txt), -1 si on veut tout, par défaut on ne les veux pas.
$conditions->avec_points_censure=True : Par défaut, False : les points censurés ne sont pas retournés
$conditions->uniquement_points_censure=True : ne retourner que les points censurés (utiles uniquement pour les modérateurs)

$conditions->avec_infos_massif=True si on veut les infos du massif auquel le point appartient, par défaut : sans
$conditions->limite : nombre maximum d'enregistrement à aller chercher, par défaut sans limite
$conditions->ordre (champ sur lequel on ordonne clause SQL : ORDER BY, sans le "ORDER BY" example 'date_derniere_modification DESC')

$conditions->geometrie : Ne renvoir que les points se trouvant dans cette géométrie (qui doit être de type (MULTI-)POLY au format WKB
$conditions->avec_distance : Renvoi la distance au centroid de la géométrie, le point sont alors automatiquement triés par distance

FIXME, cette fonction devrait contrôler avec soins les paramètres qu'elle reçoit, certains viennent directement d'une URL !
Etant donné qu'il faudrait de toute façon qu'elle alerte de paramètres anormaux autant le faire ici je pense sly 15/03/2010
Je commence, elle retourne un texte d'erreur avec $objet->erreur=True et $objet->message="un texte", sinon
*****************************************************/
// FIXME elle est executee 2 fois pour chaque points, 1 pour la fiche, 1 pour les points a proxi. trop de CPU
// Certes, mais faire la méga maxi requête qui va chercher le point et les points à proximité pourrait finir par être
// encore plus lourde que 2 et au final ingérable
// FIXME conditions binaires en bool ? pour + de rapidité
// Actuellement, ça peut être "oui" "non" ou Null (ou "") Y'aurais peut-être moyen en effet d'être plus économe -- sly


function infos_points($conditions)
{
    global $config,$pdo;
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
            $tables_en_plus.=" INNER JOIN polygones ON ( ST_Within(points_gps.geom,polygones.geom) AND polygones.id_polygone IN ($conditions->ids_polygones)   ) ";
            $champs_polygones=",".colonnes_table('polygones',False);
        }
    }
    elseif ($conditions->avec_infos_massif)
    {
        // Jointure en LEFT JOIN car certains de nos points sont dans aucun massifs mais on les veut pourtant
        // Il s'agit donc d'un "avec infos massif si existe, sinon sans"
        $tables_en_plus.=" LEFT JOIN polygones ON (ST_Within(points_gps.geom, polygones.geom ) AND id_polygone_type=".$config['id_massif'].")";
        $champs_polygones=",".colonnes_table('polygones',False);
    }

    if (!empty($conditions->avec_liste_polygones) )
    {
        // Jointure pour la liste des polygones auquels appartient le point
        // sly : FIXME : Cette sous requête est particulièrement couteuse en ressources, il faudrait trouver une technique pour faire ça en JOIN
        $tables_en_plus.=",(
                            SELECT
                              pgps.id_point_gps,
                              STRING_AGG(pg.id_polygone::text,',' ORDER BY pty.ordre_taille DESC) AS liste_polygones
                            FROM
                              polygones pg NATURAL JOIN polygone_type pty,
                              points_gps pgps
                            WHERE
                              ST_Within(pgps.geom, pg.geom)
                              AND
                              pty.categorie_polygone_type='".$conditions->avec_liste_polygones."'
                            GROUP BY pgps.id_point_gps
                           ) As liste_polys";
                          //  ca aurait pu aussi: AND pg.id_polygone_type IN (".$conditions->avec_liste_polygones.")

         $champs_polygones.=",liste_polys.liste_polygones";
         $conditions_sql .= "\n AND liste_polys.id_point_gps=points_gps.id_point_gps";
    }

    // on restreint a cette geometrie (un texte "ST machin en fait")
    // cette fonction remplace la distance, qui n'est rien d'autre qu'un cercle geometrique
    if( !empty($conditions->geometrie) )
    {
        $conditions_sql .= "\n AND ST_Within(points_gps.geom,".$conditions->geometrie .") ";
        if ($conditions->avec_distance)
        {
            $select_distance = ",ST_Transform(points_gps.geom,900913) <-> ST_Transform(ST_Centroid( ".$conditions->geometrie." ),900913) AS distance" ;
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

    // conditions sur l'altitude
    if( !empty($conditions->altitude_minimum) )
        if( is_numeric($conditions->altitude_minimum) )
            $conditions_sql .= "\n AND points_gps.altitude >= ".$pdo->quote($conditions->altitude_minimum, PDO::PARAM_INT);
        else
            return erreur("L'altitude minimum doit être un nombre entier, reçu : $conditions->altitude_minimum");
    if( !empty($conditions->altitude_maximum) )
        if( is_numeric($conditions->altitude_maximum) )
            $conditions_sql .= "\n AND points_gps.altitude <= ".$pdo->quote($conditions->altitude_maximum, PDO::PARAM_INT);
        else
            return erreur("L'altitude maximum doit être un nombre entier, reçu : $conditions->altitude_maximum");


    //veut-on les points dont les coordonnées sont cachées ?
    if($conditions->pas_les_points_caches)
        $conditions_sql .= "\n AND points_gps.id_type_precision_gps != ".$config['id_coordonees_gps_fausses'];

    //quelle condition sur la qualité supposée des GPS
    if( !empty($conditions->precision_gps) )
        $conditions_sql .= "\n AND points_gps.id_type_precision_gps IN ($conditions->precision_gps)";

    //conditions sur la description (champ remark)
    if( !empty($conditions->description) )
        $conditions_sql.="\n AND points.remark ILIKE ".$pdo->quote('%'.$conditions->description.'%');

    if ($conditions->uniquement_points_censure)
    {
        $conditions_sql.="\n AND censure=True";
        $conditions->avec_points_censure=True;
    }

    // cas spécial sur les modèle
    if ($conditions->modele==1)
        $conditions_sql.="\n AND modele=1";
    elseif($conditions->modele=="")
        $conditions_sql.="\n AND modele!=1";
    else
        $conditions_sql.="";

  //prise en compte des conditions binaires
  //jmb si isset a oui, faut vraiment "oui" pas '' (avant il faisait les 2)
  //TODO, transformer les champs binaires en ... binaires
  if (isset($conditions->binaire))      // binaire est construit a part, pas de SQL injection possible normalement
  foreach ($conditions->binaire as $champ => $valeur)
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

  $query_points="
  SELECT points.*,
         points_gps.*,
         ST_AsGeoJSON(points_gps.geom) AS geojson,
         type_precision_gps.*,
         point_type.*,COALESCE(phpbb_users.username,nom_createur) as nom_createur,
         ST_X(points_gps.geom) as longitude,ST_Y(points_gps.geom) as latitude,
         extract('epoch' from date_derniere_modification) as date_modif_timestamp,
     extract('epoch' from date_creation) as date_creation_timestamp
         $select_distance
         $champs_polygones
         $champs_en_plus
         FROM points NATURAL JOIN points_gps NATURAL JOIN type_precision_gps NATURAL JOIN point_type LEFT join phpbb_users on points.id_createur = phpbb_users.user_id$tables_en_plus
  WHERE
     1=1
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
      
      // Ici, petite particularité sur les points censurés, par défaut, on ne veut pas les renvoyer, mais on veut quand
      // même, si un seul a été demandé, pouvoir dire qu'il est censuré, donc on va le chercher en base mais on renvoi une erreur
      // s'il est censuré
      // FIXME : cela créer un bug sur l'utilisation des limites, car lorsque l'on en demande x on en obtient en fait x-le nombre de censurés
      if (!$point->censure or $conditions->avec_points_censure) // On renvoi ce point, soit il n'est pas censuré, soit on a demandé aussi les points censurés
          $points[]=$point;
      elseif (is_numeric($conditions->ids_points)) // on avait spécifiquement demandé un point mais il est censuré on retourne un message d'erreur
          return erreur("Ce point est censuré, seul un modérateur peut agir sur lui","1");
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
function infos_point($id_point,$meme_si_censure=False)
{
  // inutile de faire tout deux fois, j'utilise la fonction plus bas pour n'en récupérer qu'un
  global $config,$pdo;
  $conditions = new stdClass();
  $conditions->ids_points=$id_point;
  if (empty($id_point))
      return erreur("Il semblerait que vous n'avez pas renseigné le n°du point");
  $conditions->modele=-1;
  $conditions->avec_infos_massif=True;
  if ($meme_si_censure)
     $conditions->avec_points_censure=True;

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
  $query_polygones="SELECT site_web,nom_polygone,id_polygone,article_partitif,source,message_information_polygone,url_exterieure,polygone_type.*
    FROM polygones,polygone_type,points_gps
    WHERE
      polygones.id_polygone_type=polygone_type.id_polygone_type
    AND ST_Within(points_gps.geom, polygones.geom)
    AND points_gps.id_point_gps=$point->id_point_gps
    ORDER BY polygone_type.ordre_taille DESC";

  $res = $pdo->query($query_polygones);
  if ( $polygones_du_point = $res->fetch() )
    do
    {
        $polygones_du_point->lien_polygone=lien_polygone($polygones_du_point,True);
        $point->polygones[]=$polygones_du_point;
    } while ( $polygones_du_point = $res->fetch() ) ;
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
  global $config;
  if (isset($_SERVER['HTTPS']))
      $schema="https";
  else
      $schema="http";
  
  if ($lien_local)
      $url_complete=$config['sous_dossier_installation'];
  else
      $url_complete="$schema://".$config['nom_hote'].$config['sous_dossier_installation'];

  if (isset($point->nom_massif)) // Des fois, on ne l'a pas (trop d'info à aller chercher, donc il n'apparaît pas dans l'url)
    $info_massif=replace_url($point->nom_massif)."/";
  elseif (isset($point->nom_polygone)) // FIXME : des fois c'est dans nom_massif, des fois nom_polygone, il faudrait uniformiser
    $info_massif=replace_url($point->nom_polygone)."/";
  else
    $info_massif="";
  return $url_complete."point/$point->id_point/".replace_url($point->nom_type)."/$info_massif".replace_url($point->nom)."/";
}

/******************************************************************************************************************************
On génére une url vers le point juste à partir de son id Attention c'est moins performant à ne pas trop utiliser
pour des longues listes ( car requete SQL oblige )
******************************************************************************************************************************/
function lien_point_lent($id_point)
{
  $point=infos_point($id_point,True);
  if ($point->erreur)
    return erreur($point->message);
  return (lien_point($point));
}

// Définit la carte et l'échelle suivant la présence du point dans un des polygones connus pour avoir un fond de carte
// adapté
function param_cartes ($point)
{
    global $config;
    // Pour chaque polygones auquel appartient le point, on cherche voir s'il existe un fournisseur de fond de carte "recommandé"
    // Si plusieurs sont possible, le premier trouvé est renvoyé
    if ($point->polygones)
        foreach ($point->polygones as $polygone)
            foreach ($config['fournisseurs_fond_carte'] as $nom_pays => $choix_carte)
                if ($polygone->nom_polygone==$nom_pays)
                    return $choix_carte;
    // aucun n'a été trouvé
    return $config['fournisseurs_fond_carte']['Autres'];
}


// Par choix, la notion d'utilisabilité dans la base est enregistrée en un seul champ pour tous les cas
// (détruite, fermée, ouverte, besoin de récupérer la clé) car ces états sont exclusifs. Moralité, je ne peux utilise le système qui détermine tout seul
// le texte en utilisant la table point_type, donc en dur dans le code
function texte_non_ouverte($point)
{
    global $config;
  //Si elle/il est fermé, on l'indique directement en haut en rouge
  switch ($point->conditions_utilisation)
  {
    case 'cle_a_recuperer':
      return "Clé à récupérer avant";
    case 'detruit':
            if ($point->id_point_type==$config['id_cabane_non_gardee'])
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
  global $pdo,$config;
  $q=" SELECT *
       FROM phpbb_posts_text, phpbb_topics, phpbb_posts
       WHERE
         phpbb_posts_text.post_id = phpbb_topics.topic_last_post_id
       AND
         phpbb_topics.topic_id_point = $point->id_point
       AND
         phpbb_posts.post_id = phpbb_posts_text.post_id
       LIMIT 1";
  // On envoie la requete
  $r = $pdo->query($q);
  if (!$r) return erreur("Erreur sur la requête SQL","$q en erreur");

  $result = $r->fetch();
  if (isset($result->topic_id))
    $result->lienforum=$config['forum_refuge'].$result->topic_id;
  else
    if ($point->modele!=1) // Si c'est un modèle de point, il n'a pas de forum
      return erreur("Le forum du point \"$point->nom\" (id=$point->id_point) ne semble pas exister","$q n'a retourné aucun enregistrement");

    // sly : C'est un peu relou de faire ça, mais phpbb ne stoque pas les messages tels qu'ils ont été saisie puis après les travaille à l'affichage, non !
    // il stoque ça avec des entités html ! Alors comme je préfère faire les traitements de mon choix, je décode pour créer mon objet
    $result->post_text=htmlspecialchars_decode($result->post_text,ENT_QUOTES);
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
  global $config,$pdo;
  // désolé, le nom du point ne peut être vide
  if ( trim($point->nom) =="" )
    return erreur("Le nom ne peut être vide");

    if( isset($point->site_officiel) )
    {
        // Pensez bien qu'un modérateur puisse vouloir remettre à "" le site n'existant plus
        if ($point->site_officiel=="")
            $champs_sql['site_officiel'] = $pdo->quote("");
        //cas du site un peu particuliers ou l'internaute n'aura pas forcément pensé à mettre http://
        elseif ( !preg_match("/https?:\/\//",$point->site_officiel))
            $champs_sql['site_officiel'] = $pdo->quote('http://'.$point->site_officiel);
        else
            $champs_sql['site_officiel'] = $pdo->quote($point->site_officiel);
    }

    if (isset($point->places) and (!is_numeric($point->places) or ($point->places<0)))
        return erreur("Le nombre de place doit être un entier positif ou nul, reçu : $point->places");

  // On met à jour la date de dernière modification. PGSQL peut le faire, avec un trigger..
  $champs_sql['date_derniere_modification'] = 'NOW()';

    /********* les coordonnées du point dans la table points_gps *************/
    // dans $point tout ne lui sert pas mais ça m'évite de créer un nouvel objet
    $point->id_point_gps=modification_ajout_point_gps($point);
    if ($point->id_point_gps->erreur) // si on a la moindre erreur sur la gestion des coordonnées de notre point, on abandonne
        return erreur($point->id_point_gps->message);

  /********* Préparation des champs à mettre à jour, tous ceuex qui sont dans $point->xx ET dans $config['champs_simples_points'] *************/
  // champ ou il faut juste un set=nouvelle_valeur
    foreach ($config['champs_simples_points'] as $champ)
    if (isset($point->$champ))
            if($point->$champ  == "NULL")
                $champs_sql[$champ]= "NULL";
            else
                $champs_sql[$champ]=$pdo->quote($point->$champ);

    if ( !empty($point->id_point) )  // update
    {
        $infos_point_avant = infos_point($point->id_point,true);
        if ($infos_point_avant->erreur) // oulla on nous demande une modif mais il n'existe pas ?
            return erreur("Erreur de modification du point : $infos_point_avant->message");

        $query_finale=requete_modification_ou_ajout_generique('points',$champs_sql,'update',"id_point=$point->id_point");
  }
  else  // INSERT
    $query_finale=requete_modification_ou_ajout_generique('points',$champs_sql,'insert');

    if (!$pdo->exec($query_finale))
    return erreur("Requête en erreur, impossible à executer",$query_finale);

    if ($point->id_point=="")  // donc c etait un ajout
    {
    $point->id_point = $pdo->lastInsertId();

    /********* la création du forum point *************/
    forum_point_ajout($point);
    }
    else
    forum_mise_a_jour_nom($point); // La mise à jour du nom du forum

  // on retoure l'id du point (surtout utile si création)
  return $point->id_point;
}
/*****************************************************
Dans le cas d'un nouveau point, creation d'un topic dans forum correspondant.
(C'est du copier coller de ce qu'il y avait dans point.php)
id et nom du point en question (nouveau point ?)
renvoie le topic_id
Non, vous ne rêvez pas, il y'a bien 5 requêtes au total
********************************************/
function forum_point_ajout( $point )
{
  global $pdo;

  /*** mise à jour des stats du forum - un sum() vous connaissez pas chez phpBB ? ***/
  $query_update="UPDATE phpbb_forums SET
  forum_topics = forum_topics+1,
  prune_next = NULL
  WHERE forum_id = '4'";
  $pdo->exec($query_update);

  /*** rajout du topic spécifique au point ( Le seul qui me semble logique ! )***/
  // tention a PGsql, ca peut merder
  // Dans le forum, nom toujours commençant par une majuscule et on vérifie à bien convertir ça en entité html (phpbb ne pourrait il pas le faire à la volée ?) et enfin, la taille du champs est de 90 caractères max
  $nom=$pdo->quote(substr(protege(mb_ucfirst($point->nom)),0,89));
  $query_insert="INSERT INTO phpbb_topics (
  forum_id , topic_title , topic_poster , topic_time ,
  topic_views , topic_replies , topic_status , topic_vote ,
  topic_type , topic_first_post_id , topic_last_post_id ,
  topic_moved_id , topic_id_point )
  VALUES (
  4, $nom, -1, ". time()." ,
  0, 0, 0, 0,
  0, 0, 0,
  0, $point->id_point )";

  $res = $pdo->query($query_insert);
  $topic_id = $pdo->lastInsertId();


  /*** rajout d'un post fictif pour débuter le truc - je vois pas en quoi c'est nécessaire, le topic devrait pouvoir être vide**/
  $query_insert_post="INSERT INTO phpbb_posts (
  topic_id , forum_id , poster_id , post_time ,
  poster_ip , post_username , enable_bbcode , enable_html ,
  enable_smilies , enable_sig , post_edit_time , post_edit_count )
  VALUES (
  $topic_id, 4, -1, ".time()." ,
  '00000000', 'refuges.info' , 1, 0,
  1, 1, NULL , 0 )";

  $res = $pdo->query($query_insert_post);
  $last = $pdo->lastInsertId();


  /*** rajout d'un post avec texte pour débuter le truc ( phpBB mal codé ? non ? ) ha ça oui ! **/
  $query_texte="INSERT INTO phpbb_posts_text (
  post_id , bbcode_uid , post_subject , post_text )
  VALUES (
  $last, '', '',
  '')";
  $pdo->exec($query_texte);

  /*** remise à jour du topic ( alors ici c'est le bouquet, un champ qui stoque le premier et le dernier post ?? )***/
  $query_update_topic="UPDATE phpbb_topics SET
  topic_first_post_id=$last,topic_last_post_id=$last
  WHERE topic_id=$topic_id";
  $pdo->exec($query_update_topic);

  return $topic_id ;
}

/********************************************************
Pour simplifier encore la maintenance, si on met à jour
le nom d'un point du site, on met aussi à jour le topic forum
correspondant.
Certes un joli id de liaison serait plus propre, mais il faudrait bidouiller salement
le phpBB, donc duplication
********************************************************/

function forum_mise_a_jour_nom($point)
{
  global $pdo;

  // Dans le forum, nom toujours commençant par une majuscule
  $nom=$pdo->quote(mb_ucfirst($point->nom));

  $query="UPDATE phpbb_topics
  SET topic_title=".$pdo->quote(mb_ucfirst($point->nom))."
  WHERE topic_id_point=$point->id_point";
  $pdo->exec($query);
}

/********************************************************
Toujours pour simplifier encore la maintenance, si on supprime un point, on nettoye
le topic du forum qui correspond, ça reprend casi la même chose que l'ajout
mais en inverse ;-)
FIXME : à noter un bug dans le cas ou une photo serait présente sur ce forum (par exemple en provenance historique du site par un transfert)
alors la photo se retrouve seule et oubliée dans /forum/photos-points/
Et je suis bien en peine pour trouver une combine pour la nettoyer
********************************************************/

function forum_supprime_topic($point)
{
  global $pdo;
  /*** on va chercher l'id du topic qu'on veut virer ***/
  $query_recherche="SELECT * FROM phpbb_topics where topic_id_point=$point->id_point";
  $res = $pdo->query($query_recherche);
  $topic=$res->fetch();
  if ($topic)
  {
    /*** vu que chez phpBB un post est dans deux tables, juste avant de les virer je vais virer leurs "contenus" ***/
    $query_recherche="SELECT * FROM phpbb_posts WHERE topic_id=$topic->topic_id";
    $res = $pdo->query($query_recherche);

    while ( $posts_a_supprimer = $res->fetch() )
      $pdo->exec("DELETE FROM phpbb_posts_text where post_id=$posts_a_supprimer->post_id");

    /*** Suppression des posts du topic**/
    $pdo->exec("DELETE FROM phpbb_posts WHERE topic_id=$topic->topic_id");

    /*** Suppression du topic spécifique au point***/
    $pdo->exec("DELETE FROM phpbb_topics where topic_id=$topic->topic_id");


    /*** et pour finir mise à jour des stats du forum ***/
    $query_update="UPDATE phpbb_forums SET
    forum_topics = forum_topics-1,
    prune_next = NULL
    WHERE forum_id = '4'";
    $pdo->exec($query_update);
  }
  else
    return erreur("Le point ne dispose pas de forum !",$query_recherche." n'a rien retourné");
}

/*******************************************************
* on lui passe un objet $point et ça supprime tout proprement
* commentaires, photos, forum, points, points_gps
*******************************************************/
function suppression_point($point)
{
  global $pdo;
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

  // suppression dans le forum
  forum_supprime_topic($point);

  // suite à la modification dans la base sur les coordonnées GPS, on va supprimer aussi de la table :
  // point_gps si le point_gps n'est plus utilisé du tout

  $del_si_uniq="
  DELETE FROM points_gps
  WHERE
    ( SELECT COUNT(*) FROM points WHERE id_point_gps=$point->id_point_gps) = 1
  AND
   id_point_gps=$point->id_point_gps
  LIMIT 1 ";
  $pdo->exec($del_si_uniq);  // supp de la table point_gps si un seul point est dessus
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
    global $config;
    // par défaut, et sauf modification ultérieure, le nom de l'icone à choisir porte, par défaut, le nom du type de point (dans une version convertie sans accents,guillemet ou espace)
    $nom_icone=replace_url($point->nom_type);

    // Pour les cabane dans lesquelles on ne peut dormir (ou à qui il manque un mur)
    if ( ($point->manque_un_mur OR $point->places==0) AND $point->id_point_type==$config['id_cabane_non_gardee'] )
        $nom_icone="abri";

    // les bâtiments en montagne sont des bâtiments situé en montgne dont on ne sait rien et qu'il faudrait explorer ou, si fermé dont on sait qu'ils ne peuvent servir
    if ( ($point->conditions_utilisation=='fermeture' or $point->conditions_utilisation=="detruit") AND $point->id_point_type==$config['id_batiment_en_montagne'] )
        $nom_icone="batiment-inutilisable";
        
    // Pour les cabane dans lesquelles on ne peut dormir (ou à qui il manque un mur)
    if ( $point->conditions_utilisation=='cle_a_recuperer' AND $point->id_point_type==$config['id_cabane_non_gardee'] )
        $nom_icone="cabane_cle";
        
    // Pour les cabane/refuges/gites dans lesquelles on ne peut dormir (car fermées ou détruites)
    if ( ($point->conditions_utilisation=="fermeture" or $point->conditions_utilisation=="detruit")
          AND
          ($point->id_point_type==$config['id_cabane_non_gardee'] or $point->id_point_type==$config['id_gite_etape'] or $point->id_point_type==$config['id_refuge_garde'])
       )
        $nom_icone="inutilisable";
    if ( ($point->conditions_utilisation=="fermeture" or $point->conditions_utilisation=="detruit")
        AND
        ($point->id_point_type==$config['point_d_eau'])
       )
        $nom_icone="ancien-point-d-eau";
    return $nom_icone;
}
function chemin_icone($nom_icone,$absolu=true)
{
    global $config;
    if (isset($_SERVER['HTTPS']))
        $schema="https";
    else
        $schema="http";
    if ($absolu)
        $url_et_host="$schema://".$config['nom_hote'];
    else
        $url_et_host='';
    return $url_et_host.$config['url_chemin_icones'].$nom_icone.'.png';
}
?>
