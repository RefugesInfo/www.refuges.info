<?php
/**********************************************************************************************
Fonctions pour gérer les points supplémentaires en provenance d'openstreetmap (osm)
- accès
- import
- insertion
sly 29/11/2012
NOTE: Il y a 50% de chance que je ne récupère que 50% du code et 50% de chance que je ne récupère que 10% du code
avant de trop retoucher tout ça, on va peut-être attendre que je me décide ;-) -- sly
Une des options envisagées serait :
- comme pour les polygones en provenance d'osm, utiliser un outil tout fait : osm2pgsql (il nous construirait du GIS directement)
Au prix de quelques bidouilles à prévoir pour soit le convertir dans un format plus simple d'utilisation, soit faire des requêtes qui tapent directement
dans les tables produites par osm2pgsql

FIXME sly : je me suis décidé je laisse tomber 90% de ce code, et j'importerais avec osm2pgsql, seul la fonction de recuperation_poi_osm va rester et encore
elle est à refaire en fonction d'un nouveau schéma plus simple de base de donnée

**********************************************************************************************/
require_once ("config.php");
require_once ("fonctions_bdd.php");
require_once ('fonctions_mise_en_forme_texte.php');
require_once ("fonctions_gestion_erreurs.php");
require_once ("fonctions_exportations.php");

$tags_cache=array();

/*
Fonction de récupération génériques des poi dans la base osm 
On lui passe l'objet $conditions_recherche contenant :
->k le nom de la clé attendu au format openstreetmap (amenity, tourism, ...)
->v la valeur de la clé (hotel, drinking_water)
Une connaissance des tags osm est nécessaire, Utilisez préférablement la fonction appelant celle-ci qui est 
"simplifiée"
->nord
->ouest
->sud
->est, pour ne chercher les points osm que dans ce rectangle
Le nombre d'objet à récupérer au maximum (optionnel)
->limite
*/
function recuperation_poi_osm($conditions_recherche)
{
	global $pdo;
  // FIXME BIDOUILLE sly : La multiplication par 5 est commlètement arbitraire, c'est juste que la requête
  // ne retourne pas un nombre de point, mais un nombre de clés (point/tag) et comme la moyenne est à
  // ~4 tag par point, on prend un poil au dessus, et on limite en php ensuite
  //jmb: la x5  plus necessaire avec la nouvelle requete. le php non plus.
	if (isset($conditions_recherche->limite))
		$limite_sql="LIMIT $conditions_recherche->limite";
    //$limite=5*$conditions_recherche->limite;
    //$limite_sql="LIMIT 0,$limite";


  if (isset($conditions_recherche->tag_condition))
  {
  // jmb vire le nom des tables "osm_tags"
  $tag_condition="(";
  foreach ($conditions_recherche->tag_condition as $couple)
    foreach ($couple as $cle => $valeur)
      $tag_condition.="(k='$cle' AND v='$valeur') OR ";
  $tag_condition.=" 1=0)";
  }
  else
    $tag_condition="1=1";

	//PDO+
	// reecriture de la requete avec des JOIN
	//Note : a calculer, mais avec un select * imbriqué sans conditions, je pense que tu récupères les 14000 tags
	//de la base ! On gagne en effet en taille de requête, mais pas sûr du tout qu'on y gagne en vitesse
	// la fonction "explain" de postresql (explain select * blabla) donne un aperçu des indexes utilisés et 
	// des opérations de parcours systèmatique
    // FIXME Quand on passera au schéma créé ou copié ce sera grandement simplifié
    // FIXME 2 : En fait, cette requête ne marche pas car elle ne renvoi pas toutes les propriétées
	$query_recherche="SELECT *
	                         ,st_asgml(ST_GeomFromText(concat('POINT(',longitude,' ',latitude,')'),4326)) as geometrie_gml
						FROM
								osm_pois AS poi
								NATURAL JOIN 
								(SELECT * FROM osm_tags NATURAL JOIN osm_pois_tags) AS tag
						WHERE 
							$tag_condition
							AND longitude<$conditions_recherche->est
							AND longitude>$conditions_recherche->ouest
							AND latitude<$conditions_recherche->nord
							AND latitude>$conditions_recherche->sud
							$limite_sql";						

	$res = $pdo->query($query_recherche);
        if (!$res)
          return erreur("Execution requête impossible",$query_recherche);

	while ( $point = $res->fetch() )
	{
		$id=$point->id_osm_poi;
    
		$point_osm = new stdClass;
		$point_osm->geometrie_gml=$point->geometrie_gml;

		//jmb: dans un switch case pour + de lisibilite, le "k" n'est pas important
		switch( $point->v ) {
			case "hotel":       $point_osm->nom_icone="hotel";   break;
			case "camp_site":   $point_osm->nom_icone="camping"; break;
			case "supermarket":
			case "convenience": $point_osm->nom_icone="superette"; break;
			case "guest_house": $point_osm->nom_icone="chambre-hotes"; break;
		}
		switch( $point->k ) {
			case "name":           $point_osm->nom=$point->v;         break;
			case "phone":          $point_osm->telephone=$point->v;   break;
			case "website":        $point_osm->site_web=$point->v;    break;
			case "description":    $point_osm->description=$point->v; break;
			case "opening_hours":  $point_osm->horaires_ouvertures=$point->v; break;  //FIXME en anglais
		}
	$points[$id]=$point_osm;
	} 
  
  return $points;
}
/*
Cette fonction insère un tag osm (clé+valeur) dans notre base et renvoi son id.
S'il y est déjà, on ne l'insère pas, mais on renvoi l'id quand même.
(Cette fonction utilise un cache externe $tags_cache)
On lui passe $tag->k (clé du tag) et $tag->v (valeur du tag)
*/
function insert_ou_recupere_tag($tag)
{
    // J'ai pas réussi à le passer par référence lui, je pige pas
    global $tags_cache,$pdo;
    // déjà dans le cache ?
    if (isset($tags_cache[$tag->k][$tag->v]))
        return $tags_cache[$tag->k][$tag->v];
    // test s'il n'y est pas déjà
    $tagk = $pdo->quote($tag->k);
    $tagv = $pdo->quote($tag->v);
    
    $query_is_tag="SELECT id_osm_tag FROM osm_tags WHERE k=".$tagk." AND v=".$tagv;
    $res = $pdo->query($query_is_tag);
    $row = $res->fetch() ;
    if ( $row )   // ya bien 1 resultat
        $idrow = $row->id_osm_tag ;
    else
    {
        $query_insert_tag="INSERT INTO osm_tags
        SET k=".$tagk.", v=".$tagv."
        LIMIT 1 ";
        // RETURNING id // FIXME POSTGRESQL  lastinsertid
        $res = $pdo->query($query_insert_tag);
        $res->fetch();
        $idrow = $res->lastInsertId();  // MySQL ONLY
        //$idrow=$res->fetch()->id POSTGRESQL
    }
    //Mise en cache
    $tags_cache[$tag->k][$tag->v]=$idrow;
    return $idrow ;
}

/*
On lui donne une bbox object en paramètre et elle insère dans les tables osm

bbox doit être composé de ces 4 champs là :
$bbox->sud $bbox->nord $bbox->est $bbox->est
On peut par exemple lui envoyer un object polygone qui contient tout ça
et des conditions xapi, résultat :
"*[tourism=hotel][bbox=6.5,45.5,7,46]"
Cette conction consomme beaucoup de mémoire car tout est stoquer en RAM avant d'être dumper dans la base, c'est plus efficace au niveau base
mais beaucoup moins en terme de consomation mémoire.
*/
function importation_osm_poi($bbox,$xapi_condition)
{
  global $config,$pdo;
  global $tags_cache;
  $xapi_p=fopen($config['xapi_url_poi'].$xapi_condition."[bbox=$bbox->est,$bbox->sud,$bbox->est,$bbox->nord]","r");
  if (!$xapi_p)
    die("Connexion impossible");
  $osm_xml="";
  while (($buffer = fgets($xapi_p, 4096)) !== false) 
    $osm_xml.=$buffer;
  if (!feof($xapi_p)) 
    die("Error: unexpected fgets() fail\n");
  
  $osm = simplexml_load_string($osm_xml);
  if (isset($osm->node))
  {
    foreach ( $osm->node as $node )
    {
      if (isset($node->tag))
        {
	$pois_osm[(string)$node["id"]]=array("latitude" => (string)$node["lat"], (string)"longitude" => (string) $node["lon"]);
	foreach ( $node->tag as $tag )
	{
	  //Obligé de transtyper car la fonction simplexml_load_string gère les attributs de manière curieuse https://bugs.php.net/bug.php?id=29500
	  $tag_a_ajouter->k=(string) $tag['k'];
	  $tag_a_ajouter->v=(string) $tag['v'];
          $id_tag=insert_ou_recupere_tag($tag_a_ajouter); // Cette fonction s'occupe de remplir $tags_cache qui dispose d'un cache des tags (elle retourne l'id)
          $pois_osm[(string)$node["id"]]["tags"][]=$id_tag;
	}
      }
    }
  }
  else
    return erreur("Aucun POI récupéré depuis OSM");
  foreach ($pois_osm as $id_poi => $poi)
  {
    foreach ($poi['tags'] as $tag)
      $sql_values_tags_poi.="($id_poi,$tag),";
    $sql_values_poi.="($id_poi,$poi[latitude],$poi[longitude]),";
  }
  $insert_poi="INSERT IGNORE INTO osm_pois (id_osm_poi,latitude,longitude) VALUES ".trim($sql_values_poi,",");
	$pdo->exec($insert_poi);
  print($insert_poi."\n");
  $insert_poi_tags="INSERT IGNORE INTO osm_pois_tags (id_osm_poi,id_osm_tag) VALUES ".trim($sql_values_tags_poi,",");
	$pdo->exec($insert_poi_tags);
  return ok("Poi OSM importés avec succès (on espère)");
}

?>
