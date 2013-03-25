<?php
/**************************************************************************************************
Je vais tenter de regrouper les fonctions de manipulation des coordonnées GPS de la table 
points_gps et de leurs liens avec les autres tables. 
Afin de simplifier l'appel aux ajouts, modifications, suppressions
**************************************************************************************************

// 10/02/13 jmb : modif de la fonction "modification_ajout_point" pour OpenGIS

*/
require_once ("config.php");
require_once ('fonctions_bdd.php');
require_once ("fonctions_gestion_erreurs.php");


/********************************************************
Fonction qui permet, en fonction de l'object $point_gps passé
en paramêtre la mise à jour OU la création si :
$point->id_point_gps==""
Les champs attendus sont :
id_point_gps,longitude,latitude,altitude,access et id_type_precision_gps

Tout est facultatif, ne sera mis à jour que ce qui est présent
le reste sera présuposé si non présent
en cas d'ajout : longitude,latitude sont obligatoires
********************************************************/
function modification_ajout_point_gps($point_gps)
{
	global $config,$pdo;

	// si on veut faire un ajout et que latitude ou longitude sont vide, on ne peut rien faire
	if ($point_gps->id_point_gps=="" AND ($point_gps->longitude=="" OR $point_gps->latitude=="") )
		return erreur("Impossible d'ajouter le point, longitude ou/et latitude n'ont pas été donné");
	// si aucune précision gps, on les suppose approximatives
	if ($point_gps->id_type_precision_gps=="")
		$point_gps->id_type_precision_gps=$config['id_coordonees_gps_approximative'];
	// si aucune altitude, on la suppose à -1
	if ($point_gps->altitude=="")
		$point_gps->altitude=-1;
	
	// On prépare notre tableau contenant tous les champs à mettre à jour
	//GIS : pas de champs gis car il ne faut pas qu'il soit traité a la chaine en foreach.
	$champs = array("altitude","acces","id_type_precision_gps");
	foreach ($champs as $champ)
		if (isset($point_gps->$champ))
			$champs_sql[$champ]=$pdo->quote($point_gps->$champ);
	// GIS+ : si les latlon ne sont pas nuls, enregistrement coord OpenGIS
	if (($point_gps->longitude!="" AND $point_gps->latitude!=""))
		$champs_sql['geom']="ST_GeomFromText('POINT($point_gps->longitude $point_gps->latitude)',4326)";

	// fait-on un updater ou un insert ? -> avec posgresql et être compatible, impossible de reprendre la même forme pour la requête
	if ($point_gps->id_point_gps != "") // Un UPDATE
        {
            $query_finale=requete_modification_ou_ajout_generique('points_gps',$champs_sql,'update',"id_point_gps=$point_gps->id_point_gps");
            $id_point_gps = $point_gps->id_point_gps;
        }
	else // un INSERT
            $query_finale=requete_modification_ou_ajout_generique('points_gps',$champs_sql,'insert');
	
	if (!$pdo->exec($query_finale))
		return erreur("Impossible d'executer la requête car mal formée : $query_finale");
        
        if ($point_gps->id_point_gps == "") // On avait donc demander un INSERT, on récupère l'id inséré
            $id_point_gps = $pdo->lastInsertId();
	
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
