<?php
/**********************************************************************************************
Fonctions de gestion des polygones de notre base.
liens vers eux, récupération, calculs de bbox, pré-calcul spatial
gestion : modification/suppression/création
06/11/10 Dominique bornes_polygone
13/03/13 jmb PDO chamboulement PDO+ pour ajout et PDO-
**********************************************************************************************/

require_once ('config.php');
require_once ("fonctions_bdd.php");
require_once ('fonctions_mise_en_forme_texte.php');

/*****************************************************************************************************
On calcul la bbox d'un polygone de notre base.
On donne à la fonction l'id_polygone et on récupère 
$bbox->latitude_maximum
$bbox->longitude_minimum
$bbox->longitude_maximum
$bbox->latitude_minimum
note: cette fonction ne sert qu'a la suivante pour mettre à jour la bbox qui se trouve maintenant conservée dans la table des polygones
l'appeler directement serait une perte d'énergie pour un résultat qui se trouve déjà dans la table.
Utilisez pluto la fonction infos_polygone() plus bas qui fourni ce résultat en même temps que les autres infos du polygone
sly 20/11/10
*****************************************************************************************************/
//GIS-
/*
function calcul_bbox_polygone($id_polygone)
{
  $query_bbox="SELECT max(latitude) as latitude_maximum, min(latitude) as latitude_minimum,
        max(longitude) as longitude_maximum,min(longitude) as longitude_minimum
	FROM polygones,lien_polygone_gps,points_gps
	WHERE
	polygones.id_polygone=lien_polygone_gps.id_polygone
	AND
	lien_polygone_gps.id_point_gps=points_gps.id_point_gps
	AND
	polygones.id_polygone=$id_polygone
	GROUP BY polygones.id_polygone";
	
$res=mysql_query($query_bbox);
if (mysql_num_rows($res)!=1)
  return -1;
$bbox_infos=mysql_fetch_object($res);
return $bbox_infos;
}
*/
/****************************************************************************************************
 Fonction de mise à jour de la BBOX d'un polygone (c'est à dire de ces bornes droite, gauche, haut et bas)
****************************************************************************************************/
//GIS-
/*
function mise_a_jour_bbox_polygone($id_polygone)
{
  $bbox_infos=calcul_bbox_polygone($id_polygone);
  $query_mise_a_jour="
  update polygones set latitude_minimum=$bbox_infos->latitude_minimum,latitude_maximum=$bbox_infos->latitude_maximum,
  longitude_minimum=$bbox_infos->longitude_minimum,longitude_maximum=$bbox_infos->longitude_maximum
  where id_polygone=$id_polygone";
  mysql_query($query_mise_a_jour);
}
*/
/*****************************************************************************************************
Fonction qui copie les polygones de la base vers un format différent plus adapté au calcul d'appartenance 
polygone la table s'appelle zzz_segments_polygones (zzz pour l'afficher à la fin et préciser que ce n'est qu'une table 
de cache)
sly 22/11/10
*****************************************************************************************************/
//GIS-
/*
function insertion_table_segments_polygones($id_polygone)
{
  $poly=tableau_polygone($id_polygone);
  $points_polygone=count($poly);
  $query_clean="delete from zzz_segments_polygones where id_polygone=$id_polygone";
  mysql_query($query_clean);
  $inserted_strings="";

  for ($i=0;$i<$points_polygone;$i++)
  {
    // si dernier point, on s'intéresse au segment [n0]
    if ($i==$points_polygone-1)
      $next=0;		
    else
      $next=$i+1;
    
    $x1=$poly[$i]->x;
    $x2=$poly[$next]->x;
    $y1=$poly[$i]->y;
    $y2=$poly[$next]->y;
    
    // On range dès le départ nos segments pour qu'ils soient tous dirigés vers la droite
    if ($x1>$x2)
    {
      $temp=$x1;$x1=$x2;$x2=$temp;
      $temp=$y1;$y1=$y2;$y2=$temp;
    }
    $inserted_strings.="($id_polygone,$y1,$x1,$y2,$x2),";
  } 
  $query_insert_segments="INSERT INTO zzz_segments_polygones (`id_polygone` ,`latitude_p1` ,`longitude_p1` ,`latitude_p2` ,`longitude_p2`) VALUES ";
  
// On enlève la , qui traine à la fin
  $query_insert_segments.=trim($inserted_strings,",");
  mysql_query($query_insert_segments);
} 
*/
/*****************************************************************************************************
Fonction qui simplifie la maintenance est qui appelle les deux autres qui concerne les pré-calculs
de polygones.
Cette fonction doit être appelée à chaque fois qu'une modification a lieu sur un polygone

*****************************************************************************************************/
//GIS-
/*
function precalculs_polygones($id_polygone)
{
  mise_a_jour_bbox_polygone($id_polygone);
  insertion_table_segments_polygones($id_polygone);
}
*/
/****************************************************************************************************
fonction de récupération des sommets ordonnés d'un polygone de la base
au format :
Array
(    [0] => Object
        (
            [x] => 4.2
            [y] => 6
        )
    [1] => Object
        (
            [x] => 7
            [y] => 8.3
        ) 
)
****************************************************************************************************/
//GIS-
/*function tableau_polygone($id_polygone)
{
$query="SELECT latitude,longitude,points_gps.id_point_gps 
		FROM points_gps,lien_polygone_gps
		where lien_polygone_gps.id_point_gps=points_gps.id_point_gps 
		and id_polygone=$id_polygone 
		order by ordre";
$re=mysql_query($query);
$i=0;
while($poly=mysql_fetch_object($re))
{
	$polygone_gps[$i]->x=$poly->longitude;
	$polygone_gps[$i]->y=$poly->latitude;
	$i++;
}
mysql_free_result($re);
return $polygone_gps;
}
*/


/***********************************************************************************************                                                              
Voici la fonction qui détermine si un point appartient ou non à un polygone. Pour l'utiliser, on donne
les coordonnées du point gps. L'algorithme est dit "de parité d'intersection pour un point externe". Prenez une feuille,
dessinez un polygone, prenez un point au hazard et tracez une demi droite verticale partant du point pour aller jusqu'a un bord en haut de votre 
feuille. Comptez le nombre d'intersection avec les arrêtes de votre polygone. Pair ? le point est dehors, impaire ? le point 
est dedans.

Maintenant, tout est fait dans mysql grace à la table qui représente les polygones sous forme de liste de segment.
ça va beaucoup, beaucoup plus vite.
L'étape d'après est de ne plus avoir a gérer la table appartenance_polygone, mais tout faire directement à la volée
**********************************************************************************************/
//GIS typique un boulot pour le GIS, changement des entree
function is_point_dans_polygone($id_pt_gps,$id_poly)
{
	global $pdo;
	// faudra voir si ca vaudra le coup d'en faire une PDO prepared.
	$q_in_poly=" SELECT Within( 
		(SELECT gis FROM points_gps WHERE id_point_gps=$id_pt_gps),
		(SELECT gis FROM polygones WHERE id_polygone=$id_poly) ) AS inpoly 
	";
	// On envoie la requete
	try {
		$r_in_poly = $pdo->query($q_in_poly);
	} catch( Exception $e ){
		echo 'Erreur de requete  : is_point_dans_polygone', $e->getMessage();
	}
	$result = $r_in_poly->fetch() ;
	return $result->inpoly ;
}

/* function is_point_dans_polygone($x,$y,$id_polygone)
     $query_segments_avec_intersection="select count(id_polygone) as intersections from zzz_segments_polygones where 
    id_polygone=$id_polygone and longitude_p1<$x and longitude_p2>$x
    AND $y < ($x * (latitude_p2 - latitude_p1) + longitude_p2 * latitude_p1 - latitude_p2 * longitude_p1) / (longitude_p2 - longitude_p1) ";
    $res=mysql_query($query_segments_avec_intersection);

    $nb_intersection=mysql_result($res,0);

// Bidouille trouvé sur le net; ça renvoi 1 si $nb_intersection est impaire
  if ($nb_intersection & 1)
    return TRUE;
  else
    return FALSE;
*/


/************************************************************
Cette fonction, profitant de toute les autres, mets à jour
pour un point la table d'appartenance polygone pour lui

************************************************************/
// GIS- jmb ca part a l'eau avec GIS, du moins tant que ca rame pas trop
/*
function mettre_a_jour_appartenance_point($id_point,$dry_run=false)
{
	global $config;
	global $cache_polygones;

	//$infos_point=infos_point($id_point); // Bizarrement cette fonction top moumoute top objet prend 30% du temps !
	$qs="select points.id_point_gps,latitude,longitude from points_gps,points 
	where points.id_point_gps=points_gps.id_point_gps and $id_point=id_point"; // ce truc basic 7%
	$res=mysql_query($qs) or die ($qs);
	$infos_point=mysql_fetch_object($res);
	
	$query_polygones_potentiels="
	SELECT id_polygone,id_polygone_type
	FROM polygones
	WHERE
	$infos_point->latitude < latitude_maximum and
	$infos_point->latitude > latitude_minimum and
	$infos_point->longitude < longitude_maximum and
	$infos_point->longitude > longitude_minimum and
	id_polygone!=0";
	
	$res_poly_pot=mysql_query($query_polygones_potentiels) or die($query_polygones_potentiels);
	// on enlève les anciens
	if (!$dry_run)
		mysql_query("DELETE FROM appartenance_polygone WHERE id_point_gps=$infos_point->id_point_gps");

	// balayage de la liste des polygones candidats pour ce point
	$aucun_massif=true;
	$polygone_auquels_il_appartient=array();
	while($poly_possible=mysql_fetch_object($res_poly_pot))
	{
		$t=is_point_dans_polygone($infos_point->longitude,$infos_point->latitude,$poly_possible->id_polygone);
		if ($t)
		{
			$polygone_auquels_il_appartient[]=$poly_possible->id_polygone;
		
			// Est-il au moins dans un massif répértorié du site ?
			if ($poly_possible->id_polygone_type==1)
				$aucun_massif=false;

		}
	}

	// FIXME alors on lui attribue au moins le faux massif "nul-part" histoire de savoir où il est
	// peut mieux faire comme technique mais plus simple dans plusieurs requêtes déjà existante sly  23-08-2009
	if ($aucun_massif) 
		$polygone_auquels_il_appartient[]=$config['numero_polygone_fictif'];
		
	foreach ($polygone_auquels_il_appartient as $id_polygone)
	{
		$query_insert="INSERT INTO appartenance_polygone 
			set id_point_gps=$infos_point->id_point_gps,
			id_polygone=$id_polygone";
		if (!$dry_run)
			mysql_query($query_insert);	
  
	}
return TRUE;
}
*/

/***********************************************************************************
Cette fonction permet d'aller chercher toutes les infos d'un polygone
- Elle prend en paramêtre l'id du polygone
- Elle renvoi un objet contenant :
*nom_polygone
*l'article partitif du polygone ( "de la" chartreuse ou "des" bauges...) pour un polygone 'massif'
*etc...
// PDO : jmb ca devient une requete pré-préparée
******************************************************************/
function infos_polygone($id_polygone)
{
	global $pdo;
	//PDO+ requete pre-preparee dans la bibliotheque du constructeur PDO (fct BDD)
	$pdo->requetes->infos_poly->execute(array('idpoly'=>"$id_polygone"));

	// detype object comme l'ancienne
	return $pdo->requetes->infos_poly->fetch();
}

//PDO- ancienne fct
/*if (!is_numeric( $id_polygone))
  return -1;
 $sql_query_polygone="SELECT *
     FROM polygone_type LEFT JOIN polygones
     ON polygone_type.id_polygone_type = polygones.id_polygone_type WHERE id_polygone=$id_polygone";

 $rq_polygone=mysql_query($sql_query_polygone);
 if (!$rq_polygone)
   return -1;
 if (mysql_num_rows($rq_polygone)==0)
	return -1;
 $polygone=mysql_fetch_object($rq_polygone);

 mysql_free_result($rq_polygone);

 return $polygone;*/


/********************************************
On génére une url vers la carte d'un polygone
*********************************************/
function lien_polygone($nom_polygone,$id_polygone,$type="")
{
// sly 27/04/06 afin de préparer une url encore mieux au niveau référencement j'ajoute le type de polygone sur lequel on va centrer dans l'url
// option facultative, sinon ce sera "massif" simplement
if ($type=="")
	$type="massif";
	return "/nav/".replace_url($type)."/$id_polygone/".replace_url($nom_polygone)."/";
}


/**************************************************
Donne un tableau de massifs non compris dans la zone
//PDO+GIS jmb cette fonction est fait pour le GIS
// TODO: que les zones soient des polygones ...
// fonction a virer vu que c'est des ZONES qu'on veut et pas des MASSIFS (voir en dessous)
*************************************************/
function liste_autres_massifs ($zone_demandee) {
	global $config, $zones, $zone, $pdo;

	
	// Lecture de tous les massifs
	// dont les polygones n'intersectent PAS celui de la zone
	$q_select_mass= "
		SELECT *
		FROM polygones
		WHERE id_polygone_type=".$config['id_massif']."
			AND id_polygone != ".$config['numero_polygone_fictif']."
			AND Disjoint(
				gis,
				(SELECT gis FROM polygones WHERE nom_polygone =  \"" .$zone_demandee."\"  )
				)
	";

	// On envoie la requete
	try {
		$r_select_mass = $pdo->query($q_select_mass);
		// Traitement
		// Ajoute les liens vers les massifs qui ne sont pas dans une zone
		// bug en cours mais la resolution passe par des polygones, pas par du PHP.
		while ($polygone = $r_select_mass->fetch()) 
			$r[$polygone->nom_polygone] = lien_polygone ($polygone->nom_polygone, $polygone->id_polygone, 'Massif');
		} catch( Exception $e ){
		echo 'Erreur de requete liste_autre_massifs : ', $e->getMessage();
	}

	//tableau de tous les massif n'etant pas dans la zone (polygones normalement...)
	return $r;
}
/**************************************************
Donne un tableau de ZONES hormis celle donnée en param
// TODO: que les zones soient des polygones ...
*************************************************/
function liste_autres_zones ($zone_demandee) {
	global $config, $zones, $zone, $pdo;

	//si pas de param, c'est qu'on veut les alpes de chez nous
	if ( !$zone_demandee)
		$zone_demandee = $config['zone_defaut'];
	// faut arreter, ... , les zones c'est un ID eet c'est tout
	$q_select_zone=" SELECT * FROM polygones WHERE id_polygone_type=".$config['id_zone']." AND nom_polygone !=  \"$zone_demandee\"" ;
	// On envoie la requete
	try {
		$r_select_zone = $pdo->query($q_select_zone);
	} catch( Exception $e ){
		echo 'Erreur de requete liste_autres_zones : ', $e->getMessage();
	}

	// Traitement
	// Ajoute les liens vers les massifs qui ne sont pas dans une zone
	// bug en cours mais la resolution passe par des polygones, pas par du PHP.
	while ($polygone = $r_select_zone->fetch()) 
		$z[$polygone->nom_polygone] = lien_polygone ($polygone->nom_polygone, $polygone->id_polygone, 'Zone');

	//tableau de tous les ZONES autre que la notre
	return $z;
}


/**************************************************
On génére une url vers la carte d'un polygone à partir de son id
Attention c'est moins performant à ne pas trop utiliser
pour des longues listes ( car requete SQL oblige )
*************************************************/
function lien_polygone_lent($id_polygone)
{
  $rq_polygone=mysql_query("SELECT * FROM polygones,polygone_type
                					WHERE polygones.id_polygone_type=polygone_type.id_polygone_type 
							AND id_polygone=$id_polygone");
  if (mysql_num_rows($rq_polygone)!=1)
    return -1;
  // Recupere les donnees du massif concerné
  $polygone = mysql_fetch_object($rq_polygone);

  mysql_free_result($rq_polygone);

  return lien_polygone($polygone->nom_polygone,$id_polygone,$polygone->type_polygone);
}

/*************************************************
Ces fonctions s'occupent de supprimer un polygone de la base
C'est à utiliser avec forte méfiance car des id de liaison
entre les points de la base et ce polygone peuvent exister, un recalcul 
des points qui appartiennent à un polygone devra être refait

FIXME : Il faudrait aussi nettoyer la table point_gps des points rendu non 
utilisés 19/04/2010 sly
*************************************************/
//GIS- jmb ca part a la trappe avec GIS
//suppression des liaisons point du polygone
//function suppression_points_polygone($id_polygone)
//{
//if (!is_numeric($id_polygone))
//	return -1;
//$query="delete from lien_polygone_gps where id_polygone=$id_polygone";
//mysql_query($query);
//return 0;
//}

//suppression juste du polygone
function suppression_polygone($id_polygone)
{
if (!is_numeric($id_polygone))
	return -1;
$query="delete from polygones where id_polygone=$id_polygone";
mysql_query($query);
suppression_points_polygone($id_polygone);
return 0;
}


?>
