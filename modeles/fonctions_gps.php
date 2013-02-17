<?php
/**************************************************************************************************
Je vais tenter de regrouper les fonctions de manipulation des coordonnées GPS de la table 
points_gps et de leurs liens avec les autres tables. 
Afin de simplifier l'appel aux ajouts, modifications, suppressions
**************************************************************************************************

// 10/02/13 jmb : modif de la fonction "modification_ajout_point" pour OpenGIS

*/
require_once ('config.php');
require_once ('fonctions_bdd.php');


/********************************************************
Fonction qui permet, en fonction de l'object $point_gps passé
en paramêtre la mise à jour OU la création si :
$point->id_point_gps==""
Les champs attendus sont :
id_point_gps,longitude,latitude,altitude,access et id_type_precision_gps

Tout est facultatif, ne sera mis à jour que ce qui est présent
le reste sera présuposé si non présent
en cas d'ajout : longitude,latitude sont obligatoires
sly 02/11/2008

Ajout du 04/03/2009 sly
Nouveau paramêtre facultatif qui permet de dire si une recherche d'existence doit être faite, et si oui sur la base 
de quelles données.
Ne marche que dans le cas des polygones, ça veut dire qu'on va tenter d'utiliser le même point pour former un ou plusieurs polygones 
de même type afin d'éviter d'avoir des points superposés et double.
si -1, alors on s'en fiche on ajoute le point même s'il est déjà là.
Si on trouve un candidat, on ajoute rien, mais on renvoi son id
//10/02/13 : jmb : rajout du champs OpenGIS, prevoir suppression § polygones.
//14/02/13 : jmb : PDO
********************************************************/
function modification_ajout_point_gps($point_gps,$id_polygone_type=-1)
{
	global $config,$pdo;
	//GIS : pas de champs gis car il ne faut pas qu'il soit traité a la chaine en foreach.
	$champs = array("longitude","latitude","altitude","acces","id_type_precision_gps");

	// si on veut faire un ajout et que latitude ou longitude sont vide, on ne peut rien faire
	if ($point_gps->id_point_gps=="" AND ($point_gps->longitude=="" OR $point_gps->latitude=="") )
		return -1;
//var_dump($point_gps);
	// si aucune précision gps, on les suppose approximatives
	if ($point_gps->id_type_precision_gps=="")
		$point_gps->id_type_precision_gps=$config['id_coordonees_gps_approximative'];
	foreach ($champs as $champ)
		if (isset($point_gps->$champ))
			$champs_sql.="\n$champ=".$pdo->quote($point_gps->$champ).",";

	// GIS+ : si les latlon ne sont pas nuls, enregistrement coord OpenGIS
	if (($point_gps->longitude!="" AND $point_gps->latitude!=""))
		$champs_sql.="\ngis =GeomFromText('POINT($point_gps->longitude $point_gps->latitude),4326')";

	// fait-on un updater ou un insert ?
	if ($point_gps->id_point_gps != "")
	{
		$insert_update="UPDATE";
		$condition="WHERE id_point_gps=$point_gps->id_point_gps";
	} else
		$insert_update="INSERT INTO";

//{
//   // GIS- : pas necessaire ? uniquement pour les poly ?
//	// on va dire uniquement poly.
//	if ($id_polygone_type!=-1) // Doit on vérifier l'existence du point à ajouter ?
//	{
//		// dû au type "double" je suis obligé de faire un encadrement
//		$query_recherche_doublon="SELECT points_gps.id_point_gps
//		FROM `points_gps`,lien_polygone_gps,polygones
//		where 
//		lien_polygone_gps.id_point_gps=points_gps.id_point_gps 
//		and polygones.id_polygone=lien_polygone_gps.id_polygone 
//		and longitude<($point_gps->longitude+0.00001) and longitude>($point_gps->longitude-0.00001)
//		and latitude<($point_gps->latitude+0.00001) and latitude>($point_gps->latitude-0.00001)
//		and polygones.id_polygone_type=$id_polygone_type";
//
//		$res=mysql_query($query_recherche_doublon);
//		if (mysql_num_rows($res)>=1) // On a trouvé au moins un candidat, on le prend (la requête le sort plusieurs fois si il appartient à plus de zéro polygone, mais bon, ça nous va, c'est le même)
//		{
//			$point_gps_double=mysql_fetch_object($res);
//			return $point_gps_double->id_point_gps;
//		}
//	}
//	$insert_update="INSERT INTO";
//}

	$champs_sql = trim($champs_sql,",");

	// $condition est vide dans  le cas d'un INSERT
	$query_finale = "$insert_update points_gps SET $champs_sql $condition";

	//PDO-  mysql_query($query_finale);
	//PDO+
	$pdo->exec($query_finale);
	$lastid = $pdo->lastInsertId('points_gps_id_points_gps_seq'); // FIXME POSTRESQL non en fait. ca devrait passer comme ca
	if ($point_gps->id_point_gps!="")
		$id_point_gps = $point_gps->id_point_gps;
	else
		$id_point_gps = $lastid ;
		//	$id_point_gps=mysql_insert_id();

	return $id_point_gps;
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

/***********************************************************

***********************************************************/
?>
