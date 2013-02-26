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
require_once ("fonctions_bdd.php");
require_once ("fonctions_gestion_erreurs.php");
require_once ("fonctions_commentaires.php");
require_once ("fonctions_gps.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_mise_en_forme_texte.php");

/**************************************************************
Lien plus simple à utiliser maintenant ! sur la base
de l'objet point "habituel" et plus rapide que celui du dessous
car requête de moins
*************************************************************/
function lien_point_fast($point,$local=false)
{
  if ($local)
    $url_complete="";
  else
    $url_complete="http://".$_SERVER["HTTP_HOST"];
  if (isset($point->nom_massif)) // Des fois, on ne l'a pas (trop d'info à aller chercher, donc il n'apparaît pas dans l'url)
    $info_massif=replace_url($point->nom_massif)."/";
  else
    $info_massif="";
  return "$url_complete/point/$point->id_point/".replace_url($point->nom_type)."/$info_massif".replace_url($point->nom)."/";
}

/****************************************
On génére une url vers le point juste à partir de son id
Attention c'est moins performant à ne pas trop utiliser
pour des longues listes ( car requete SQL oblige )
***************************************/
function lien_point_lent($id_point)
{
  $point=infos_point($id_point);
  if ($point->erreur)
    return erreur($point->message);
  return (lien_point_fast($point));
}

// fonction simple qui renvois une chaine avec liens au format :
// Pays > Massif > Département > carte topographique > (communes ?) > (parc protégé ?)
function localisation($polygones)
{
global $config;
$html="";
if(!isset($polygones))
	return "";
foreach ($polygones as $polygone)
{
	if ($polygone->id_polygone!=$config['numero_polygone_fictif']) // seulement si c'est pas le polygone fourre-tout
	{
		$lien=lien_polygone($polygone,True);
		if ($polygone->url_exterieure!="" AND $polygone->source!="")
		  $lien_externe="(<a href='$polygone->url_exterieure'>$polygone->source</a>)";
		else
		  $lien_externe="";
		$html.=" <a href=\"$lien\">".ucfirst($polygone->nom_polygone)."$lien_externe</a> >";
	}
}
return trim($html,">");
}

// Définit la carte et l'échèle suivant la présence d'une zone dans la chaine de localisation
// Dominique 28/05/2012
function param_cartes ($localisation) {
	$series = Array (
		'France'    => Array ('Maps.Refuges.info',          50000), // Inhibition temporaire, l'API ne fonctionnat plus / Dominique 30/08/2012
		'Suisse'    => Array ('Google',       50000, 'SwissTopo'), // Par défaut on affiche GG, sur demande SwT
		'Italie'    => Array ('Italie',      100000),
		'Espagne'   => Array ('Espagne',      25000),
		'Andorre'   => Array ('IGN',          25000),
		'Argentina' => Array ('OpenCycleMap', 50000),
		'Autres'    => Array ('Google',      100000),
	);

	// Il doit y avoir mieux que ce découpage :
	$chploc = explode (' ', str_replace (Array ('<', '>'), ' ', $localisation));
	foreach ($chploc AS $loc)
		if (isset ($series [$loc]))
			return $series [$loc];
			
	return $series ['Autres']; // par défaut
}
// Dominique 11/09/2012 utilisation des paramètres de /includes/config.php
function param_cartes_vignettes ($modele) {
	global $config;
	// TODO: Il doit y avoir mieux que ce charcutage :
	$chploc = explode (' ', str_replace (Array ('<', '>'), ' ', $modele->localisation));
	$carte = $config['cartes_vignettes'] ['Autres']; // par défaut
	foreach ($chploc AS $loc)
		if (isset ($config['cartes_vignettes'] [$loc]))
			$carte =  $config['cartes_vignettes'] [$loc];
	
	// Attention, MRI ne couvre pas toute la planette
	//TODO : il faudrait systématiser pour toutes les cartes
	if ($modele->longitude < -25 ||
		$modele->longitude >  45 ||
		$modele->latitude  <  33
		)
		foreach ($carte AS $k => $v)
			if ($v == 'maps.refuges.info')
				$carte [$k] = 'OpenCycleMap';

	return $carte;
}

// Par choix, la notion de fermeture dans la base est enregistrée en un seul champ pour tous les cas 
// (ruines, détruite, fermée) car ces trois états sont exclusifs. Moralité, je ne peux utilise le système qui détermine tout seul
// le texte en utilisant la table point_type, donc en dur dans le code si autre que "", "non" ou "oui"
function texte_non_ouverte($point)
{
//Si elle/il est fermé, on l'indique directement en haut en rouge
if ($point->equivalent_ferme!="")
{
  if ($point->ferme=='oui')
    $annonce_fermeture="$point->equivalent_ferme";
  elseif($point->ferme=='ruine')
    $annonce_fermeture="En ruine";
  elseif($point->ferme=='detruit')
    $annonce_fermeture="Détruit(e)";
  else
    return "";
  }
else
  return "";
return $annonce_fermeture;
}

//**********************************************************************************************
// Récupère le dernier post sur un forum d'un point
// JMB : je rajoute les first et last topic, apparement, si egaux, alors le topicest vide
// on affiche les commentaires+photos en plus
function infos_point_forum ($id) 
{
  global $pdo,$config;
  // faudra voir si ca vaudra le coup d'en faire une PDO prepared.
  $q=" SELECT *
       FROM phpbb_posts_text, phpbb_topics, phpbb_posts
       WHERE 
         phpbb_posts_text.post_id = phpbb_topics.topic_last_post_id 
       AND 
         phpbb_topics.topic_id_point = $id
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
    return erreur("Le forum du point $id ne semble pas exister","$q n'a retourné aucun enregistrement");
  
  return $result;

}	

/*****************************************************
Cette fonction retourne sous la forme d'un object
toutes les caractéristiques d'un point
Voir a_lire.txt annexe 1 dans ressources pour voir un example d'élément

retourne -1 si le point n'est pas trouvé
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
*****************************************************/
function infos_point($id_point)
{
  // inutile de faire tout deux fois, j'utilise la fonction plus bas pour n'en récupérer qu'un
  global $config,$pdo;
  $conditions = new stdClass();
  if (!is_numeric($id_point))
    return erreur("id du point demandé mal formé","id du point demandé : $id_point");
  $conditions->ids_points=$id_point;
  $conditions->modele=-1;

  // récupération des infos du point
  $points=infos_points($conditions);
  // Requête impossible à executer
  if ($points->erreur)
    return erreur($points->message);
  if (count($points)==0)
    return erreur("Le point demandé est introuvable dans notre base","id du point demandé : $id_point".var_export($points,true));
  if (count($points)>1)
    return erreur("Ben ça alors ? on a récupérer plus de 1 point, pas prévu..."); 
    
    $i=0;
  $point=$points[0];
  
  // recherche des différents polygones auquels appartienne le point
  // FIXME Cette particularité n'existe que lorsque on demande un point en particulier
  // idéalement, la fonction ci-après de recherche devrait faire la même chose, mais c'est bien plus couteux en calcul sly 18/05/2010
  // J'hésite, car l'objet retourné va être hiddeusement gros et en fait, on a pas souvent besoin de sa localisation complète
  // sauf sur les pages des points... doute... incertitude -- sly
  $query_polygones="SELECT nom_polygone,id_polygone,article_partitif,source,message_information_polygone,url_exterieure,polygone_type.*
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
      $point->polygones[]=$polygones_du_point;
    } while ( $polygones_du_point = $res->fetch() ) ;
    return $point;
}

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
$conditions->altitude_maximum
$conditions->altitude_minimum
$conditions->places_maximum
$conditions->places_minimum
$conditions->type_point : liste d'id dans notre base des points type ex: 12 ou 12,13,14
$conditions->latitude_minimum
$conditions->latitude_maximum
$conditions->longitude_minimum
$conditions->longitude_maximum
$conditions->id_polygone : points appartenant à ce polygone
$conditions->ids_points : liste restreinte à ces id_point là, attention, si d'autres condition les intérdisent, ils ne sortiront pas
$conditions->precision_gps : liste des qualités GPS souhaitées, 1 ou 2,4,5, par défaut : toutes
$conditions->pas_les_points_caches : TRUE : on ne les veut pas, FALSE on les veut quand même, par défaut : FALSE
$conditions->chauffage : soit "chauffage" pour demander poële ou cheminée ou "poele" ou "cheminee"
$conditions->binaire->couvertures : "oui" ou "vide"
$conditions->binaire->eau_a_proximite : "oui" ou "vide"
$conditions->binaire->bois_a_proximite : "oui" ou "vide"
$conditions->binaire->latrines : "oui" ou "vide"
$conditions->binaire->ferme : "oui" ou "vide"
$conditions->binaire->sommaire : "oui" ou "vide"
$conditions->binaire->site_officiel : "oui" ou "vide"
$conditions->binaire->xxxxx : (Le champ de la table point et vérifier à oui dans la base quand se champ est à oui)

$condition->non_utilisable : on chercher ferme!='non' et !=''
$condition->ouvert : si 'oui', on ne veut que les points ayant ferme='non' ou ferme=''

$conditions->modele : 1 si on ne veut QUE les modèles (voir ce qu'est un modèle dans /ressources/a_lire.txt), -1 si on veut tout, par défaut on ne les veux pas.
$condition->avec_infos_massif : 1 si on veut les infos du massif auquel le point appartient, par défaut : sans
$condition->limite : nombre maximum d'enregistrement à aller chercher, par défaut sans limite
$conditions->ordre (champ sur lequel on ordonne clause SQL : ORDER BY, sans le "ORDER BY" example 'date_derniere_modification DESC')
$conditions->avec_liens : True si on veut avior en retour un lien vers la fiche du point renvoyé dans ->lien

$conditions->distance=latitude;longitude;distance_max : Ne va chercher que les points se trouvant à une distance inférieure à distance_max en metres du point de référence
Cette option est très consommation de ressource, on choisira donc une distance moins grande que 20km sinon ça RAME ! l'attribut distance en metres sera retourné, sur lequel on peut d'ailleurs
utiliser $conditions->ordre="distance DESC"
sly : Et bé, je me demande comment j'ai pû pondre un truc pareil, cacher plusieurs champs dans un seul 
c'est relou à gérer, j'aurais mieux fais de choisir 3 champs distincts genre ->latitude_recherche
->longitude_recherche et ->distance_recherche, dur de tout changer maintenant

FIXME, cette fonction devrait contrôler avec soins les paramètres qu'elle reçoit, certains viennent directement d'une URL !
Etant donné qu'il faudrait de toute façon qu'elle alerte de paramètres anormaux autant le faire ici je pense sly 15/03/2010
Je commence, elle retourne un texte d'erreur avec $objet->erreur=True et $objet->message="un texte", sinon 
*****************************************************/
//FIXME elle est executee 2 fois pour chaque points, 1 pour la fiche, 1 pour les points a proxi. trop de CPU
// Certes, mais faire la méga maxi requête qui va chercher le point et les points à proximité pourrait finir par être
// encore plus lourde que 2 et au final ingérable
//FIXME conditions binaires en bool ? pour + de rapidité
//A mon avis ce serait se prendre la tête et risquer d'avoir un jour besoin de 2. ce sont des ints, donc traiter par le processeur
//d'un seul coup -- sly
function infos_points($conditions) 
{
  global $config,$pdo;
  // condition de limite en nombre
  if ($conditions->limite!="")
    if (!is_numeric ($conditions->limite))
      return erreur("Le paramètre de limite \$conditions->limite est mal formé");
    else
      $limite="\nLIMIT $conditions->limite";
    
    if ($conditions->ordre!="")
      $ordre="\nORDER BY $conditions->ordre";
    
    /******** Liste des conditions de type WHERE *******/
    $conditions_sql="";
  $tables_en_plus="";
  
  // conditions sur le nom du point
  if($conditions->nom!="")
    $conditions_sql .= " AND points.nom ILIKE ".$pdo->quote('%'.$conditions->nom.'%') ;
  
  // condition sur l'appartenance à un polygone
  if($conditions->id_polygone!="")
  {
    $tables_en_plus.=",points_gps,polygones";
    $conditions_sql .= "AND ST_Within(points_gps.geom,polygones.geom) 
      AND polygones.id_polygone IN ($conditions->id_polygone)";
  }
  elseif ($conditions->avec_infos_massif!="")
    // Jointure en LEFT JOIN car certains de nos points sont dans aucun massifs mais on les veut pourtant
    // Il s'agit donc d'un "avec infos massif si existe, sinon sans"
    $tables_en_plus.=",points_gps LEFT JOIN polygones ON (ST_Within(points_gps.geom, polygones.geom ) and id_polygone_type=1)"; 
  else
    //On ne veut aucune conditions ni info sur les polygones, on place cette table quand même pour récupérer 
    //les coordonnées même si on se fiche de savoir dans quels polygones ils sont
    $tables_en_plus.=",points_gps";
  
  // condition sur le type de point (on s'attend à 14 ou 14,15,16 )
  if($conditions->type_point!="")
    $conditions_sql .="\n AND points.id_point_type IN ($conditions->type_point) \n";
  
  // condition pour n'avoir que les points avec au moins un commentaire avec photo
  if($conditions->photo != "")
  {
    $tables_en_plus .= ",commentaires ";
    $conditions_sql .= "\n AND commentaires.photo_existe = 1 
    AND points.id_point=commentaires.id_point";
  }	
  
  // conditions sur le nombre de places
  if($conditions->places_minimum!="")
    $conditions_sql .= "\n AND points.places >= ". $pdo->quote($conditions->places_minimum, PDO::PARAM_INT);
  if($conditions->places_maximum!="")
    $conditions_sql .= "\n AND points.places <= ".$pdo->quote($conditions->places_maximum, PDO::PARAM_INT);
  
  // conditions sur l'altitude
  if($conditions->altitude_minimum!="")
    $conditions_sql .= "\n AND points_gps.altitude >= ".$pdo->quote($conditions->altitude_minimum, PDO::PARAM_INT);
  if($conditions->altitude_maximum!="")
    $conditions_sql .= "\n AND points_gps.altitude <= ".$pdo->quote($conditions->altitude_maximum, PDO::PARAM_INT);
  
  //veut-on les points dont les coordonnées sont cachées ?
  if($conditions->pas_les_points_caches)
    $conditions_sql .= "\n AND points_gps.id_type_precision_gps != ".$config['id_coordonees_gps_fausses'];
  
  //quelle condition sur la qualité supposée des GPS
  if($conditions->precision_gps!="")
    $conditions_sql .= "\n AND points_gps.id_type_precision_gps IN ($conditions->precision_gps)";
  
  //calcul selon la distance au point de référence
  // fourni sous la forme lat;lon;metres (45;5;5000) pour 5km
  if ($conditions->distance!="")
  {
    $donnees=explode(";",$conditions->distance);
    $latitude=$donnees[0];
    $longitude=$donnees[1];
    $distance=$donnees[2];
    // Notre base étant en lat/lon, quand on veut calculer une distance, c'est avec des coordonnées projectées
    // Je choisi la projection sphérical mercator de google qui ne règle in fine pas le problème qu'aucune projection (?)
    // ne peut conserver les distances à travers la terre, il faudrait utiliser le type "geography" de postgis qui choisi
    // dynamiquement la meilleure projection selon l'endroit du globe. Mais je ne sais pas m'en servir, donc cette solution
    // marche a peu prêt bien sous les latitudes françaises et du quartier proche
    $geom_point="ST_GeomFromText('POINT($longitude $latitude)',4326)";
    $geom_point_mercator="st_transform($geom_point,900913)";
    $calcul_distance="st_distance(st_transform(points_gps.geom,900913),$geom_point_mercator)";
    $select_distance=",$calcul_distance AS distance "; 
    // Changement de projection à s'arracher les cheveux : on souhaite les autres points de notre base à une distance en metres
    // d'un point de référence en lat/lon je projete donc ce point pour créer un buffer d'un rayon (en metres) autour de notre choix
    // que je reprojette en lat/lon pour que postgis puisse faire usage de son indexe qui est sur des géométries lat/lon
    // et je met comme conditions que les autres points soient dans ce buffer. Ouf.
    $conditions_sql.="\n AND ST_within(points_gps.geom,st_transform(st_buffer($geom_point_mercator,$distance),4326))";
    $ordre="ORDER BY $calcul_distance";
  }
  // conditions géographique sur les coordonnées GPS
  // FIXME... ou pas : on considère qu'une requête : tous les points dont la latitude est >50° n'est pas possible/souhaitable
  // Ces conditions sur les fonctions sont pour demander une bbox, pas "toute la terre", c'est donc tout, ou rien
  if($conditions->latitude_minimum!="" and $conditions->latitude_maximum!="" and $conditions->longitude_minimum!="" and $conditions->longitude_maximum!="")
  {
    $conditions_sql.="\n AND points_gps.geom && 
    ST_GeomFromText(('LINESTRING($conditions->longitude_minimum $conditions->latitude_minimum,$conditions->longitude_maximum $conditions->latitude_maximum)'),4326)";
  }
  
  // condition restrictive sur des id_points particuliers
  if($conditions->ids_points!="")
    $conditions_sql.="\n AND points.id_point IN ($conditions->ids_points)";
  
  //conditions sur la description (champ remark)
  if($conditions->description!="")
    $conditions_sql.="\n AND points.remark ILIKE ".$pdo->quote('%'.$conditions->description.'%');
  
  // cas spécial sur les modèle
  if ($conditions->modele==1)
    $conditions_sql.="\n AND modele=1";
  elseif($conditions->modele=="")
    $conditions_sql.="\n AND modele!=1";
  else
    $conditions_sql.="";
  
  //prise en compte des conditions binaires
  //jmb si isset a oui, faut vraiment "oui" pas '' (avant il faisait les 2)
  if (isset($conditions->binaire))
  {
    foreach ($conditions->binaire as $champ => $valeur)
      if ($valeur!='')
      {
	if ($valeur=='vide')
	  $valeur='';
	$conditions_sql.="\n AND points.$champ=".$pdo->quote($valeur, PDO::PARAM_INT)."";
      }
  }
  //prise en compte de la recherche sur le chauffage
  if (isset($conditions->chauffage))
  {
    switch ($conditions->chauffage)
    {
      case 'chauffage':$conditions_sql.="\n AND (points.cheminee='oui' OR points.poele='oui')";break;
      case 'cheminee':$conditions_sql.="\n AND points.cheminee='oui'";break;
      case 'poele':$conditions_sql.="\n AND points.poele='oui'";break;
    }
  }
  if ($conditions->non_utilisable=='oui')
    $conditions_sql.="\n AND points.ferme!='non' AND points.ferme!=''";
  if ($conditions->ouvert=='oui')
    $conditions_sql.="\n AND (points.ferme='non' OR points.ferme='')";
  
  // Censure
  if ($_SESSION['niveau_moderation']<1)
    $conditions_sql.="\n AND (points.id_point_type!=26)";
  
  $query_points="
  SELECT *,ST_X(points_gps.geom) as longitude,ST_Y(points_gps.geom) as latitude,
    extract('epoch' from date_derniere_modification) as date_modif_timestamp
    $select_distance
  FROM points,point_type,type_precision_gps$tables_en_plus
  WHERE 
    points.id_point_type=point_type.id_point_type
    AND points_gps.id_point_gps=points.id_point_gps
    AND points_gps.id_type_precision_gps=type_precision_gps.id_type_precision_gps
    $conditions_sql 
  $ordre
  $limite
  ";
  
  if ( ! ($res = $pdo->query($query_points))) 
    return erreur("Une erreur sur la requête est survenue",$query_points);
  
  $point = new stdClass();
  
  $i=0;
  //Constuisons maintenant la liste des points demandés avec toutes les informations sur chacun d'eux
  while ($point = $res->fetch())
  {
    $points[$i]=$point;
    // on rajoute pour chacun le massif auquel il appartient, si ça a été demandé, car c'est plus rapide
    // FIXME : Encore cette spécificité liée au massif qu'il faudrait généraliser
    if ($conditions->avec_infos_massif!="")
    {
      $points[$i]->nom_massif = $point->nom_polygone;
      $points[$i]->id_massif  = $point->id_polygone;
      $points[$i]->article_partitif_massif = $point->article_partitif;
      if ($conditions->avec_liens) // Cette option est sans effet sans la demande des massifs
	$points[$i]->lien=lien_point_fast($point);
    }
    $i++;		
  }
  return $points;
}
/********************************************************
Fonction qui permet, en fonction de l'object $point passé en paramêtre la mise à jour OU la création si :
$point->id_point==""
Les autres champ, classiques, comme la sortie de la fonction infos_point($id_point) servirons pour la création ou la mise à jour.
Le minimum vital est que $point->nom ne soit pas vide et que les coordonées latitude et longitude soient données
tout est facultatif (ou presque) mais si :
$point->champ est vide ("") il sera remis à zéro
si
$point->champ n'existe pas (isset()=FALSE on y touche pas)
sly 02/11/2008
jmb 17/02/13 PDO + ca deconne
Le retour de cette fonction et l'id du point (qu'il soit créé ou modifier) si une erreur grave survient, rien n'est fait et un retour de type texte est envoyé
qui ressemble à "erreur_un_truc"

********************************************************/

function modification_ajout_point($point)
{
  global $config,$pdo;
  // désolé, le nom du point ne peut être vide
  if (trim($point->nom)=="")
    return "erreur_nom";
  
  // désolé, les coordonnées ne peuvent être vide ou non numérique
  if ($point->latitude=="" or $point->latitude=="")
    return "erreur_latitude_vide";
  if (!is_numeric($point->latitude) or !is_numeric($point->longitude))
    return "erreur_latitude_non_numerique";
  if ($point->id_point!="")  // update
  {
    $infos_point_avant = infos_point($point->id_point);
    if ($infos_point_avant==-1) // oulla on nous demande une modif mais il n'existe pas
      return "erreur_point_inexistant";
    
    if ($point->id_point_gps=="")
      $point->id_point_gps=$infos_point_avant->id_point_gps;
  }
  
  /********* les coordonnées du point dans la table points_gps *************/
  // dans $point tout ne lui sert pas mais ça m'évite de créer un nouvel objet uniquement
  $point->id_point_gps=modification_ajout_point_gps($point);
  
  /********* Les caractéristiques propres du point *************/
  // champ ou il faut juste un set=nouvelle_valeur
  foreach ($config['champs_simples_points'] as $champ)
    if (isset($point->$champ))
      $champs_sql[$champ]=$pdo->quote($point->$champ);
    
    
    //cas du site un peu particuliers ou l'internaute n'aura pas forcément pensé à mettre http://
    if (isset($point->site_officiel))
      if (preg_match("/http\:\/\//",$point->site_officiel))
      $champs_sql['site_officiel'] = $pdo->quote($point->site_officiel);
    elseif($point->site_officiel!="")
      $champs_sql['site_officiel'] = $pdo->quote('http://'.$point->site_officiel);
    else
      $champs_sql['site_officiel'] = $pdo->quote($point->site_officiel);
    
    // On met à jour la date de dernière modification
    $champs_sql['date_derniere_modification'] = 'NOW()';
    
    // fait-on un updater ou un insert ?
    if ($point->id_point=="")
    {
      $champs_sql['date_insertion']=time(); //FIXME : horreur, la date_insertion est un unix timestamp stocké dans un bigint ;-(
      $query_finale=requete_modification_ou_ajout_generique('points',$champs_sql,'insert');
    }
    else
      $query_finale=requete_modification_ou_ajout_generique('points',$champs_sql,'update',"id_point=$point->id_point");
    
    if (!$pdo->exec($query_finale))
      return erreur("Requête en erreur, impossible à executer : $query_finale");
    
    if ($point->id_point=="") 
    {	// donc c etait un ajout
    $point->id_point = $pdo->lastInsertId('points_id_point_seq'); //FIXME c'est un peu relou de devoir spécifier la séquence : ni portable ni fiable si on la change
    
    /********* la création ou mise à jour du forum point *************/
    forum_point_ajout($point);
}
else
  forum_mise_a_jour_nom($point);
  
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
  
  // Dans le forum, nom toujours commençant par une majuscule
  $nom=$pdo->quote(ucfirst($point->nom));
  /*** mise à jour des stats du forum - un sum() vous connaissez pas chez phpBB ? ***/
  $query_update="UPDATE phpbb_forums SET
  forum_topics = forum_topics+1,
  prune_next = NULL
  WHERE forum_id = '4'";
  $pdo->exec($query_update);
	
  /*** rajout du topic spécifique au point ( Le seul qui me semble logique ! )***/
  // tention a PGsql, ca peut merder
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
  $topic_id = $pdo->lastInsertId('phpbb_topics_topic_id_seq'); //FIXME POSTGRESQL : ca devrait etre bon necessite un sequence_name, voir doc PHP
	
  
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
  $last = $pdo->lastInsertId('phpbb_posts_post_id_seq'); //FIXME POSTGRESQL : ca devrait passer necessite un sequence_name, voir doc PHP

  
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
  $nom=$pdo->quote(ucfirst($point->nom));
  
  $query="UPDATE phpbb_topics
  SET topic_title=$point->nom
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
  // a supprimer le refuge ET ses commentaires ET photos ! bug corrigé par sly
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

  return TRUE; // pas d'échecs possibles ?
}
  ?>