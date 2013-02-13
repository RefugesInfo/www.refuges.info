<?php
/**********************************************************************************************
23/01/08 sly création initiale d'une fonction pour supprimer un point
proprement ( commentaires, photos, forum, point lui même )
On trouve aussi les fonctions liées aux points
( affichage, création forum, modifications, etc.)

21/04/08 jmb changements dans presentation info generale point 'pour les coord en particulier)
15/10/2011 Ajout de la fonction infos_comment_point
18/10/11 / Dominique / Ajout des fonctions infos_commentaires infos_point_forum & infos_vignettes

Depuis la plus grande complexistée du stockage des points
GPS (voir fichier /ressources/a_lire.txt sur la structure de la base)
il est fortement recommandé de n'utiliser plus que les fonctions
ci-après pour récupérer les infos des points, en ajouter
ou en modifier


**********************************************************************************************/

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
function lien_point_fast($point)
{
 // jmb: j'essaie de virer les reference au nom pour que ca reste dynamique
 return "http://".$_SERVER["HTTP_HOST"]."/point/$point->id_point/".replace_url($point->nom_type)."/".replace_url($point->nom_massif)."/".replace_url($point->nom)."/";
}

/****************************************
On génére une url vers le point juste à partir de son id
Attention c'est moins performant à ne pas trop utiliser
pour des longues listes ( car requete SQL oblige )
***************************************/
function lien_point_lent($id_point)
{
  $point=infos_point($id_point);
  if ($point==-1)
    return -1;
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
		$lien=lien_polygone($polygone->nom_polygone,$polygone->id_polygone,$polygone->type_polygone);
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

//**********************************************************************************************
//* Nom de la fonction:    | presentation_infos_point_court                                    *
//* Date :                 |                                                                   *
//* Créateur :             |                                                                   *
//* Rôle de la fonction:   | Utilisée dans la recherche pour afficher une ligne par point      *
//*------------------------|-------------------------------------------------------------------*
//* Paramétres(Nom E/S)    | Rôle                                                              *
//*------------------------|-------------------------------------------------------------------*
//* $point           E     | objet contenant les informations du point                         *
//*                        | Voir la logique objet de ce type dans le fichier de documentation *
//*------------------------|-------------------------------------------------------------------*
//* Modifications(date Nom)| Elements modifiés, ajoutés ou supprimés                           *
//*------------------------|-------------------------------------------------------------------*
//**********************************************************************************************

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
function presentation_infos_point_court($point)
{
global $config;
$lien_point_debut="<a href=\"".lien_point_fast($point)."\">";$lien_point_fin="</a>";

//Si elle/il est fermé, on l'indique directement en haut en rouge
$annonce_fermeture=texte_non_ouverte($point);
if ($annonce_fermeture!="")
	$html_annonce_fermeture="<strong>($annonce_fermeture)</strong>";
else
	$html_annonce_fermeture="";
// lien de modif  uniquement si le visiteur est un modérateur 
// ou si c'est cet utilisateur du forum qui a rentré le point
$html_construct .= "
<dd class='fiche_cadre condense'>
  <em><a href=\"".
	  lien_point_fast($point).//->nom,$point->nom_polygone,$point->id_point,$point->nom_type).
	  "\">".bbcode2html($point->nom)."</a>$html_annonce_fermeture";

// Un bouton "modifier" cette fiche pour : les modérateurs, ou celui qui a rentré cette fiche si elle n'a pas été modifiée depuis
if (isset($_SESSION['id_utilisateur'])
	AND ( ($_SESSION['niveau_moderation']>=1) OR ($_SESSION['id_utilisateur']==$point->id_createur))
	)
  $lien_modifier="
  <a class='groupir' style='font-size: smaller ;' href='/point_formulaire_modification.php?id_point=".$point->id_point."'>[Modifier]</a>";
else
  $lien_modifier="";

$html_construct .="</em> $lien_modifier, ".bbcode2html($point->nom_type);
			
//afficher un lien vers le massif comprenant le point
if ($point->id_polygone!=$config['numero_massif_fictif'])
	$html_construct .= " dans le <a href=\"".lien_polygone($point->nom_massif,$point->id_polygone,"Massif")
	."\">Massif ".$point->article_partitif_massif." ".$point->nom_massif
	."</a>";
		
$html_construct .= "
</dd>
";

return $html_construct; 
}

//**********************************************************************************************
// Récupère le dernier post sur un forum d'un point
// JMB : je rajoute les first et last topic, apparement, si egaux, alors le topicest vide
// on affiche les commentaires+photos en plus
function infos_point_forum ($id) 
{
  global $config;
  $r = sql_infos ("
  SELECT *
  FROM phpbb_posts_text, phpbb_topics, phpbb_posts
  WHERE phpbb_posts_text.post_id = phpbb_topics.topic_last_post_id 
  AND phpbb_topics.topic_id_point = $id
  AND phpbb_posts.post_id = phpbb_posts_text.post_id
  ");
  $r[0]->lienforum = $config['forum_refuge'].$r[0]->topic_id;
  return $r[0];
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
  // inutile de faire tout deux fois, j'utilise la fonction liste_points() (voir plus bas)
  global $config;
  if (!is_numeric($id_point))
    return -1;
  $conditions->liste_id_point=$id_point;
  $conditions->modele=-1;
  $conditions->avec_infos_massif=1;
  
  // récupération des infos du point
  $liste_un_seul_point=liste_points($conditions);
  if ($liste_un_seul_point->nombre_points!=1)
  { 
    // zut, on a rien trouvé, soit il n'existe pas, soit il est en cours de création
    // et le calcul des polygones auquel il appartient n'a pas encore été fait
    // on le cherche donc sans
    $conditions->avec_infos_massif=0;
    $liste_un_seul_point=liste_points($conditions);
    
  }
  
  if ($liste_un_seul_point->nombre_points!=1)
    return -1; // la rien à faire, il n'existe vraiment pas
    
    $i=0;
  $point=$liste_un_seul_point->points->$i;
  
  // recherche des différents polygones auquels appartienne le point
  // FIXME Cette particularité n'existe que lorsque on demande un point en particulier
  // idéalement, la fonction ci-après de recherche devrait faire la même chose, mais c'est bien plus couteux en calcul sly 18/05/2010
  $query_polygones="SELECT polygones.*,polygone_type.* FROM polygones,appartenance_polygone,points,points_gps,polygone_type
  WHERE points.id_point=$id_point
  AND polygone_type.id_polygone_type=polygones.id_polygone_type
  AND appartenance_polygone.id_point_gps=points_gps.id_point_gps
  AND polygones.id_polygone=appartenance_polygone.id_polygone
  AND points.id_point_gps=points_gps.id_point_gps
  ORDER BY polygone_type.ordre_taille DESC";
  $res=mysql_query($query_polygones);
  if (mysql_num_rows($res)==0)
	return $point;
  
  $point->latitude=round($point->latitude,5);
  $point->longitude=round($point->longitude,5);
  while ($polygones_du_points=mysql_fetch_object($res))
  {
    $point->polygones[]=$polygones_du_points;
    
    // pour se simplifier la vie, si on tombe sur un massif, on en garde les infos
    // sly Je sens qu'il y a moyen de faire mieux avec une fonction de cet objet qui irait chercher d'elle même
    // tous ce que l'on veut sur le massif qui se situe dans $point->polygones
    if ($polygones_du_points->id_polygone_type==$config['id_massif'])
    {
      $point->nom_massif=$polygones_du_points->nom_polygone;
      $point->id_massif=$polygones_du_points->id_polygone;
      $point->article_partitif_massif=$polygones_du_points->article_partitif;
    }
  }
  return $point;
}

/*****************************************************
Cette fonction récupère sous la forme de plusieurs objets des points de la base qui satisfont des conditions.
En gros, c'est la fonction qui construit la requête SQL de plusieurs bras de long, va chercher, et renvoi le résultat.

retourne un objet:
on accède sous la forme 
$liste_points->nombre_points_sans_limite : le nombre de résultat issue de la requête s'il n'y avait pas eu le LIMIT
$liste_points->requete : la requête qui a été exécutée, (utile pour debug)
$liste_point->points : L'ensemble des points retournés (on y accède sous la forme $liste_point->points->$i->propriété du point $i
$liste_points->nombre_points : le nombre d'objets "point" renvoyés par la requête

c'est une fonction de centralisation est utilisée pour l'instant par 
l'exportation, la recherche, les nouvelles et le flux RSS
d'autre pourrons venir ensuite.

plutôt que de lui passer 50 champs, on ne lui passe qu'un seul, un object contenant les critères
de conditions et donc plus facilement extensible
voici les paramètres attendus de recherche :
(tous facultatifs, ces conditions seront toutes vérifiées par un AND entre elles)
$conditions->nom : recherche de type LIKE sur le champ
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
$conditions->liste_id_point : liste restreinte à ces id_point là, attention, si d'autres condition les intérdisent, ils ne sortiront pas
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

$conditions->distance=latitude,longitude,distance_max : Ne va chercher que les points se trouvant à une distance inférieure à distance_max en metres du point de référence
Cette option est très consommation de ressource, on choisira donc une distance moins grande que 20km sinon ça RAME ! l'attribut distance en metres sera retourné, sur lequel on peut d'ailleurs
utiliser $conditions->ordre="distance DESC"
sly : Et bé, je me demande comment j'ai pû pondre un truc pareil, cacher plusieurs champs dans un seul 
c'est relou à gérer, j'aurais mieux fais de choisir 3 champs distincts genre ->latitude_recherche
->longitude_recherche et ->distance_recherche, dur de tout changer maintenant

FIXME, cette fonction devrait contrôler avec soins les paramètres qu'elle reçoit, certains viennent directement d'une URL !
Etant donné qu'il faudrait de toute façon qu'elle alerte de paramètres anormaux autant le faire ici je pense sly 15/03/2010
Je commence, elle retourne un texte d'erreur avec $objet->erreur=True et $objet->message="un texte", sinon 
*****************************************************/
// retourne un objet indiquant l'erreur et le texte d'erreur
function liste_points($conditions) 
{
  global $config;
  // condition de limite en nombre
  if ($conditions->limite!="")
  {
    if (!is_numeric ($conditions->limite))
      return erreur("Le paramètre de limite \$conditions->limite est mal formé");
    $limite="\nLIMIT 0,$conditions->limite";
  }
  if ($conditions->ordre!="")
    $ordre="\nORDER BY $conditions->ordre";
  
  /******** Liste des conditions de type WHERE *******/
  $conditions_sql="";
  $tables_en_plus="";
  
  // conditions sur le nom du point
  if($conditions->nom!="")
    $conditions_sql .= " AND points.nom LIKE \"%".mysql_real_escape_string($conditions->nom)."%\" \n";
  
  // condition sur l'appartenance à un polygone
  if($conditions->id_polygone!="")
  {
    $tables_en_plus.=",appartenance_polygone,polygones";
    $conditions_sql .= "AND appartenance_polygone.id_point_gps=points_gps.id_point_gps 
    AND appartenance_polygone.id_polygone=polygones.id_polygone
    AND polygones.id_polygone IN ($conditions->id_polygone)";
  }
  elseif ($conditions->avec_infos_massif!="")
  {
    // FIXME !! cette partie de la requête a un gros défaut :
    // FIXME !! si le point n'appartient à aucun massif, on ne le trouve pas
    // FIXME !! un JOIN truc bidule qui autorise une liaison vide serait top sly 03/11/2008
    // Pour l'instant, comme j'ai toujours pas résolu ça, un massif fictif nommé "nul part" sert à ranger les points
    // qui n'appartienne à aucun massif, donc tout roule. Mais je ne suis pas intelectuellement satisfait. sly 14/03/2010
    $tables_en_plus.=",appartenance_polygone,polygones";
    $conditions_sql .= "AND appartenance_polygone.id_point_gps=points_gps.id_point_gps 
    AND appartenance_polygone.id_polygone=polygones.id_polygone
    AND polygones.id_polygone_type=($config[id_massif])";
  }
  
  // condition sur le type de point (on s'attend à 14 ou 14,15,16 )
    if($conditions->type_point!="")
    $conditions_sql .="\n AND points.id_point_type IN ($conditions->type_point) \n";
    
    // conditions sur le nombre de places
    if($conditions->places_minimum!="")
    $conditions_sql .= "\n AND points.places >= ".mysql_real_escape_string($conditions->places_minimum);
    if($conditions->places_maximum!="")
    $conditions_sql .= "\n AND points.places <= ".mysql_real_escape_string($conditions->places_maximum);
    
    // conditions sur l'altitude
    if($conditions->altitude_minimum!="")
    $conditions_sql .= "\n AND points_gps.altitude >= ".mysql_real_escape_string($conditions->altitude_minimum);
    if($conditions->altitude_maximum!="")
    $conditions_sql .= "\n AND points_gps.altitude <= ".mysql_real_escape_string($conditions->altitude_maximum);
    
    //veut-on les points dont les coordonnées sont cachées ?
    if($conditions->pas_les_points_caches)
    $conditions_sql .= "\n AND points_gps.id_type_precision_gps != ".$config['id_coordonees_gps_fausses'];
    
    //quelle condition sur la qualité supposée des GPS
    if($conditions->precision_gps!="")
    $conditions_sql .= "\n AND points_gps.id_type_precision_gps IN ($conditions->precision_gps)";
    
    //calcul selon la distance au point de référence
    if ($conditions->distance!="")
  {
    $donnees=explode(";",$conditions->distance);
    //petit offset ridicule de quelques centimètres histoire d'éviter d'obtenir un NULL du coté de mysql
    $latitude=$donnees[0]+0.0000001;
    $longitude=$donnees[1];
    $distance=$donnees[2];
    $formule_magique="(6366000*acos(cos(RADIANS($latitude))*cos(RADIANS(points_gps.latitude))*cos(RADIANS(points_gps.longitude)-RADIANS($longitude))+sin(RADIANS($latitude)) *sin(RADIANS(points_gps.latitude))))";
    $select_distance=",$formule_magique AS distance "; 
    $conditions_sql.="\n AND $formule_magique<$distance";
    
    //Histoire d'accélérer la chose, on ajoute des conditions d'indexes qui sont plus efficace sur les latitude/longitude min/max
    //La formule ci-après suppose que tout arc d'angle X sur terre à pour distance celui à l'équateur, c'est plus simple mais ça doit gaspiller énormément au niveau des pôles
    //et un peu quand même à nos latitude, mais bon, mysql s'en sort bien, même sans les indexes, ça reste hyper rapide
    $eloignement_maximum=360*$distance/(2*3.14159265*4004000);
    
    $conditions->latitude_minimum=$latitude-$eloignement_maximum;
    $conditions->latitude_maximum=$latitude+$eloignement_maximum;
    $conditions->longitude_minimum=$longitude-$eloignement_maximum;
    $conditions->longitude_maximum=$longitude+$eloignement_maximum;
  }
  
  // conditions géographique sur les coordonnées GPS
  if($conditions->latitude_minimum!="")
    $conditions_sql.="\n AND points_gps.latitude>" . mysql_real_escape_string($conditions->latitude_minimum);
  if($conditions->latitude_maximum!="")
    $conditions_sql.="\n AND points_gps.latitude<" . mysql_real_escape_string($conditions->latitude_maximum);
  if($conditions->longitude_minimum!="")
    $conditions_sql.="\n AND points_gps.longitude>" . mysql_real_escape_string($conditions->longitude_minimum);
  if($conditions->longitude_maximum!="")
    $conditions_sql.="\n AND points_gps.longitude<" . mysql_real_escape_string($conditions->longitude_maximum);
  
  // condition restrictive sur des id_points particuliers
  if($conditions->liste_id_point!="")
    $conditions_sql.="\n AND points.id_point IN ($conditions->liste_id_point)";
  
  //conditions sur la description (champ remark)
    if($conditions->description!="")
    $conditions_sql.="\n AND points.remark LIKE '%".mysql_real_escape_string($conditions->description)."%'";
    
    // cas spécial sur les modèle
    if ($conditions->modele==1)
    $conditions_sql.="\n AND modele=1";
    elseif($conditions->modele=="")
    $conditions_sql.="\n AND modele!=1";
    else
      $conditions_sql.="";
    
    //prise en compte des conditions binaires
    if (isset($conditions->binaire))
  {
    foreach ($conditions->binaire as $champ => $valeur)
      if ($valeur!='')
      {
	if ($valeur=='vide')
	  $valeur='';
	
	$conditions_sql.="\n AND points.$champ='".mysql_real_escape_string($valeur)."'";
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
  
  // recherche des infos "génériques" d'un point
  $query_liste_points="
  select SQL_CALC_FOUND_ROWS *,UNIX_TIMESTAMP(date_derniere_modification) as date_modif_timestamp$select_distance
  FROM points,point_type,type_precision_gps,points_gps$tables_en_plus
  WHERE 
  1=1
  AND 	points_gps.id_point_gps = points.id_point_gps
  AND	points.id_point_type=point_type.id_point_type
  AND	points_gps.id_type_precision_gps=type_precision_gps.id_type_precision_gps
  $conditions_sql $ordre $limite
  ";
  
  //print($query_liste_points);
  $res=mysql_query($query_liste_points);
  // On va chercher le nombre de ligne qu'il y aurrait eu sans la LIMIT
  $liste_points->nombre_points_sans_limite = mysql_result( mysql_query( "SELECT FOUND_ROWS();") , 0 );
  $liste_points->nombre_points=mysql_num_rows($res);
  $liste_points->requete=$query_liste_points;
  $i=0;
  
  //Constuisons maintenant la liste des points demandés avec toutes les informations sur chacun d'eux
  if ($liste_points->nombre_points!=0)
  {
    while ($point=mysql_fetch_object($res))
    {
      $liste_points->points->$i=$point;
      // on rajoute pour chacun le massif auquel il appartient, si ça a été demandé, car c'est plus rapide
      if ($conditions->avec_infos_massif!="")
      {
	$liste_points->points->$i->nom_massif=$point->nom_polygone;
	$liste_points->points->$i->id_massif=$point->id_polygone;
	$liste_points->points->$i->article_partitif_massif=$point->article_partitif;
	if ($conditions->avec_liens) // Cette option est sans effet sans la demande des massifs
	  $liste_points->points->$i->lien=lien_point_fast($point);
      }
      $i++;		
    }
  }
  $liste_points->erreur=False;
  $liste_points->message="Liste retournée";
  return $liste_points;
  
}
  
/*****************************************************
Dans le cas d'un nouveau point, creation d'un topic dans forum correspondant.
(C'est du copier coller de ce qu'il y avait dans point.php)
id et nom du point en question (nouveau point ?)
renvoie le topic_id
Non, vous ne révez pas, il y'a bien 5 requêtes là où je pense
que une devrait suffir !
phpBB serait il un brontosaure du web ? mal programmé mais finalement
très utilisé ?
********************************************/
function forum_point_ajout( $id, $nom )
{
  // Dans le forum, nom toujours commençant par une majuscule
  $nom=mysql_real_escape_string(ucfirst($nom));
  /*** mise à jour des stats du forum - un sum() vous connaissez pas chez phpBB ? ***/
  $query_update="UPDATE `phpbb_forums` SET
  `forum_topics` = forum_topics+1,
  `prune_next` = NULL
  WHERE `forum_id` = '4'";
  mysql_query($query_update);
  /*** rajout du topic spécifique au point ( Le seul qui me semble logique ! )***/
  $query_insert="INSERT INTO `phpbb_topics` (
  `topic_id` , `forum_id` , `topic_title` , `topic_poster` , `topic_time` ,
  `topic_views` , `topic_replies` , `topic_status` , `topic_vote` ,
  `topic_type` , `topic_first_post_id` , `topic_last_post_id` ,
  `topic_moved_id` , `topic_id_point` )
  VALUES (
  '', '4', '$nom', '-1', unix_timestamp() ,
  '0', '0', '0', '0',
  '0', '0', '0',
  '0', '$id' )";
  mysql_query($query_insert);
  $topic_id=mysql_insert_id();
  
  /*** rajout d'un post fictif pour débuter le truc - je vois pas en quoi c'est nécessaire, le topic devrait pouvoir être vide**/
  $query_insert_post="INSERT INTO `phpbb_posts` (
  `post_id` , `topic_id` , `forum_id` , `poster_id` , `post_time` ,
  `poster_ip` , `post_username` , `enable_bbcode` , `enable_html` ,
  `enable_smilies` , `enable_sig` , `post_edit_time` , `post_edit_count` )
  VALUES (
  '', '$topic_id', '4', '-1', UNIX_TIMESTAMP( ) ,
  '00000000', 'refuges.info' , '1', '0',
  '1', '1', NULL , '0' )";
  mysql_query($query_insert_post);
  $last=mysql_insert_id();
  
  /*** rajout d'un post avec texte pour débuter le truc ( phpBB mal codé ? non ? ) ha ça oui ! **/
  $query_texte="INSERT INTO `phpbb_posts_text` (
  `post_id` , `bbcode_uid` , `post_subject` , `post_text` )
  VALUES (
  '$last', '', '',
  '')";
  mysql_query($query_texte);
  /*** remise à jour du topic ( alors ici c'est le bouquet, un champ qui stoque le premier et le dernier post ?? )***/
  $query_update_topic="UPDATE phpbb_topics SET
  topic_first_post_id=$last,topic_last_post_id=$last
  WHERE topic_id=$topic_id";
  mysql_query($query_update_topic);
  
  return $topic_id ;
}
  
/********************************************************
Pour simplifier encore la maintenance, si on met à jour
le nom d'un point du site, on met aussi à jour le topic forum
correspondant.
Certes un joli id de liaison serait plus propre, mais il faudrait bidouiller salement
le phpBB, donc duplication
********************************************************/

function forum_mise_a_jour_nom($id_point,$nom)
{
  // Dans le forum, nom toujours commençant par une majuscule
  $nom=mysql_real_escape_string(ucfirst($nom));
  
  $query="UPDATE `phpbb_topics`
  SET `topic_title`='$nom'
  WHERE `topic_id_point`=$id_point";
  mysql_query($query);
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

Le retour de cette fonction et l'id du point (qu'il soit créé ou modifier) si une erreur grave survient, rien n'est fait et un retour de type texte est envoyé
qui ressemble à "erreur_un_truc"

********************************************************/

function modification_ajout_point($point)
{
  global $config;
  // désolé, le nom du point ne peut être vide
  if (trim($point->nom)=="")
    return "erreur_nom";
  
  // désolé, les coordonnées ne peuvent être vide ou non numérique
  if ($point->latitude=="" or $point->latitude=="")
    return "erreur_latitude_vide";
  if (!is_numeric($point->latitude) or !is_numeric($point->longitude))
    return "erreur_latitude_non_numerique";
  
  if ($point->id_point!="")
  {
    $infos_point_avant=infos_point($point->id_point);
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
  {
    if (isset($point->$champ))
      $champs_sql.="\n$champ='".mysql_real_escape_string($point->$champ)."',";
  }
  
  //cas du site un peu particuliers ou l'internaute n'aura pas forcément pensé à mettre http://
  if (isset($point->site_officiel))
  {
    $site=mysql_real_escape_string($point->site_officiel);
    if (preg_match("/http\:\/\//",$point->site_officiel))
      $champs_sql.="\nsite_officiel='$site',";
    elseif($point->site_officiel!="")
      $champs_sql.="\nsite_officiel='http://$site',";
    else
      $champs_sql.="\nsite_officiel='$site',";
  }
  
  // On met à jour la date de dernière modification
  $champs_sql.="\ndate_derniere_modification=NOW(),";
  
  // fait-on un updater ou un insert ?
  if ($point->id_point!="")
  {$insert_update="UPDATE";$condition="WHERE id_point=$point->id_point";}
  else
  {$insert_update="INSERT INTO";$champs_sql.="date_insertion=UNIX_TIMESTAMP(),";}
  
  $champs_sql=trim($champs_sql,",");
  
  $query_finale="$insert_update points set $champs_sql $condition";
  mysql_query($query_finale);
  if ($point->id_point=="")
    $point_en_cours=mysql_insert_id();
  /********* la création ou mise à jour du forum point *************/
  
  if ($point->id_point=="")
    forum_point_ajout( $point_en_cours, $point->nom);
    else
      forum_mise_a_jour_nom($point->id_point, $point->nom);
      
      /********* A quels polygones ce point appartient-t-il ? *************/
      if ($point->id_point=="")
	$point->id_point=$point_en_cours;
      mettre_a_jour_appartenance_point($point->id_point);
    
    // on retoure l'id du point (surtout utile si création)
    return $point->id_point;
}
  
/********************************************************
Toujours pour simplifier encore la maintenance, si on supprime un point, on nettoye
le topic du forum qui correspond, ça reprend casi la même chose que l'ajout 
mais en inverse ;-)
FIXME : à noter un bug dans le cas ou une photo serait présente sur ce forum (par exemple en provenance historique du site par un transfert) 
alors la photo se retrouve seule et oubliée dans /forum/photos-points/
Et je suis bien en peine pour trouver une combine pour la nettoyer
********************************************************/

function forum_supprime_topic($id_point)
{
  
  /*** on va chercher l'id du topic qu'on veut virer ***/
  $query_recherche="SELECT * FROM `phpbb_topics` where topic_id_point=$id_point";
  $res=mysql_query($query_recherche);
  
  if (mysql_num_rows($res)>0) // y'avait rien ? bizarre
  {
    $topic=mysql_fetch_object($res);
    
    /*** vu que chez phpBB un post est dans deux tables, juste avant de les virer je vais virer leurs "contenus" ***/
    $query_recherche="SELECT * FROM `phpbb_posts` WHERE topic_id=$topic->topic_id";
    $res=mysql_query($query_recherche);
    if (mysql_num_rows($res)>0)
    {
      while($posts_a_supprimer=mysql_fetch_object($res))
	mysql_query("DELETE FROM `phpbb_posts_text` where post_id=$posts_a_supprimer->post_id");
    }
    
    /*** Suppression des posts du topic**/
    $query_supprime_post="DELETE FROM `phpbb_posts` WHERE topic_id=$topic->topic_id";
    mysql_query($query_supprime_post);
    
    /*** Suppression du topic spécifique au point***/
    $query_supprime="DELETE FROM `phpbb_topics` where topic_id=$topic->topic_id";
    mysql_query($query_supprime);
    
    /*** et pour finir mise à jour des stats du forum ***/
    $query_update="UPDATE `phpbb_forums` SET
    `forum_topics` = forum_topics-1,
		    `prune_next` = NULL
		    WHERE `forum_id` = '4'";
		    mysql_query($query_update);
  }
}

/*******************************************************
* on lui passe un $id_point et ça supprime tout proprement
* commentaires, photos, forum, points, points_gps 
*******************************************************/
function suppression_point($id_point)
{
  
  // a supprimer le refuge ET ses commentaires ET photos ! bug corrigé par sly
  $query_recherche_commentaires="SELECT id_commentaire FROM commentaires WHERE id_point=$id_point";
  $commentaires_a_supprimer=mysql_query($query_recherche_commentaires) or die("$query_recherche_commentaires est mauvais");
  while ($commentaire_suppr=mysql_fetch_object($commentaires_a_supprimer))
  {
    // FIXME : y'aurais moyen de faire plus rapide en créant la fonction qui va chercher un groupe de commentaire directement -- sly 05/01/2013
    $commentaire=infos_commentaire($commentaire_suppr->id_commentaire);
    suppression_commentaire($commentaire);
  }
  // suppression dans le forum
  forum_supprime_topic($id_point);
  
  // suite à la modification dans la base sur les coordonnées GPS, on va supprimer aussi des tables :
  // appartenance_polygone & point_gps si le point_gps n'est plus utilisé du tout
  $infos_point=infos_point($id_point);
  $query_plusieurs="SELECT id_point FROM points WHERE id_point_gps=".$infos_point->id_point_gps;
  $res=mysql_query($query_plusieurs);
  if (mysql_num_rows($res)==1) // il n'y a qu'un seul point de la base donc on fait le nettoyage
  {
    mysql_query("DELETE FROM appartenance_polygone WHERE id_point_gps=".$infos_point->id_point_gps);
    mysql_query("DELETE FROM points_gps WHERE id_point_gps=".$infos_point->id_point_gps);
  }
  
  $query_delete="DELETE FROM points WHERE id_point=$id_point";
  mysql_query($query_delete);
  
  return TRUE; // pas d'échecs possibles ?
}
  ?>