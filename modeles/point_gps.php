<?php
/**************************************************************************************************
Je vais tenter de regrouper les fonctions de manipulation des coordonnées GPS de la table
points_gps et de leurs liens avec les autres tables.
Afin de simplifier l'appel aux ajouts, modifications, suppressions
***************************************************************************************************/

require_once ("config.php");
require_once ('bdd.php');
require_once ("gestion_erreur.php");


/********************************************************
Fonction qui permet, en fonction de l'object $point_gps passé
en paramêtre la mise à jour OU la création si :
$point->id_point_gps==""
Les champs attendus sont :
id_point_gps,longitude,latitude,altitude,access et id_type_precision_gps

Tout est facultatif sauf latitude et longitude, ne sera mis à jour que ce qui est présent
le reste sera présuposé si non présent

********************************************************/
function modification_ajout_point_gps($point_gps)
{
  global $config_wri,$pdo;
  if (!$point_gps->geojson) { // Plus besoin de faire ces vérifs avec le nouveau format geojson
    // désolé, les coordonnées ne peuvent être vide ou non numérique
    $erreur_coordonnee="du point doit être au format degré décimaux, par exemple : 45.789, la valeur reçue est :";
    if (!is_numeric($point_gps->latitude))
        return erreur("La latitude $erreur_coordonnee $point_gps->latitude");
    if (!is_numeric($point_gps->longitude))
        return erreur("La longitude $erreur_coordonnee $point_gps->longitude");

    if ($point_gps->latitude>90 or $point_gps->latitude<-90)
        return erreur("La latitude du point doit être comprise entre -90 et 90 (degrés)");
    if ($point_gps->longitude>180 or $point_gps->longitude<-180)
        return erreur("La longitude du point doit être comprise entre -180 et 180 (degrés)");
  }
  // si aucune précision gps, on les suppose approximatives
  if ($point_gps->id_type_precision_gps=="")
    $point_gps->id_type_precision_gps=$config_wri['id_coordonees_gps_approximative'];

    // si aucune altitude, on la suppose à 0
    if (!isset($point_gps->altitude))
        $point_gps->altitude=0;
    //On a bien reçu une altitude, mais ça n'est pas une valeur numérique
    if (!is_numeric($point_gps->altitude))
        return erreur("L'altitude du point doit être un nombre, reçu : $point_gps->altitude");

    //On a bien reçu une altitude, mais c'est une valeur vraiment improbable
    if ($point_gps->altitude>8848 or $point_gps->altitude<-50)
        return erreur("$point_gps->altitude"."m comme altitude du point, vraiment ?");


  // On prépare notre tableau contenant tous les champs à mettre à jour
  //GIS : pas de champs gis car il ne faut pas qu'il soit traité a la chaine en foreach.
  $champs = array("altitude","acces","id_type_precision_gps");
  foreach ($champs as $champ)
    if (isset($point_gps->$champ))
      $champs_sql[$champ]=$pdo->quote($point_gps->$champ);

  if (($point_gps->geojson!=""))
    $champs_sql['geom']="ST_SetSRID(ST_GeomFromGeoJSON('$point_gps->geojson'), 4326)";

  // fait-on un updater ou un insert ? -> avec posgresql et être compatible, impossible de reprendre la même forme pour la requête
  if ($point_gps->id_point_gps != "") // Un UPDATE
        {
            $query_finale=requete_modification_ou_ajout_generique('points_gps',$champs_sql,'update',"id_point_gps=$point_gps->id_point_gps");
            $id_point_gps = $point_gps->id_point_gps;
        }
  else // un INSERT
            $query_finale=requete_modification_ou_ajout_generique('points_gps',$champs_sql,'insert');

  if (!$pdo->exec($query_finale))
    return erreur("Erreur inconnue sur la requête SQL",$query_finale);

        if (empty($point_gps->id_point_gps)) // On avait donc demandé un INSERT, on récupère l'id inséré
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

?>
