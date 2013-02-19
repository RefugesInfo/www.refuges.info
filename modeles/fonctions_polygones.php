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
//GIS-    // FIXME  A SUPPRIMER/Convertir
function tableau_polygone($id_polygone)
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
  
  $pdo->requetes->infos_poly->bindValue('idpoly', $id_polygone, PDO::PARAM_INT );
  $a=$pdo->requetes->infos_poly->execute() or die ('infos_poly erreur sur le poly '.$id_polygone);
  // detype object comme l'ancienne
  return $pdo->requetes->infos_poly->fetch();
}

/*
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
	$r_select_mass = $pdo->query($q_select_mass);
	// Traitement
	// Ajoute les liens vers les massifs qui ne sont pas dans une zone
	// bug en cours mais la resolution passe par des polygones, pas par du PHP.
	while ($polygone = $r_select_mass->fetch()) 
		$r[$polygone->nom_polygone] = lien_polygone ($polygone->nom_polygone, $polygone->id_polygone, 'Massif');
	
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
	$q_select_zone=" SELECT * FROM polygones WHERE id_polygone_type=".$config['id_zone']." AND nom_polygone !=  '$zone_demandee'" ;
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
	global $pdo;
	if (!is_numeric($id_polygone))
		return -1;
	$query="DELETE FROM polygones WHERE id_polygone=$id_polygone";
	$pdo->exec($query) or die('pb lors suppr polygone '.$id_polygone) ;
	//suppression_points_polygone($id_polygone);
	return 0;
}

/*****************************************************
// LISTE POLYGONES DANS POLYGONE
// INPUT id_polygone du parent
// INPUT type_polygone de(s) fils recherchés ( ou tous )
// OUTPUT tableau de pointeurs de id_polygones, avec WKT
***  jmb    **********************************************/
//utile pour les zones qui contiennent des massifs
function liste_polys_dans_poly( $idpere, $typefils = NULL )
{
	global $pdo;
	$q = " SELECT id_polygone, id_polygone_type, article_partitif, nom_polygone, source, message_information_polygone, url_exterieure, AsWKT(gis) AS gis_wkt
			FROM polygones AS fils
			WHERE Intersects(
								(SELECT gis FROM polygones WHERE id_polygone=$idpere),
								fils.gis
							)
			";
	if (is_numeric( $typefils ) )
		$q .= "AND fils.id_polygone_type = $typefils";

	$res = $pdo->query($q) ;
	while( $fils[] = $res->fetch() ) ;

	return $fils ;
}

?>
