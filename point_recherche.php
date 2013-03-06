<?php
/**********************************************************************************************
Les resultats de la recherche. Ce fichier recupere les criteres en POST de point_formulaire_recherche.php 
( une suite de fiche refuges, mais sans tous les détails )

// 15/02/13 jmb : cosmetique PHP + FIXME j'ai casse la recherche OSM !
**********************************************************************************************/

require_once("modeles/config.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_points.php");
require_once ("fonctions_polygones.php");

function cree_geometrie( $params , $type )
{
	switch ($type) {
		case 'polygone':
			//FIXME check les params: [0]->lat, [0]->lon , [1].....
			if ( sizeof($params) > 2 ) 
			$geotexte = "FIXME";
			break;
		case 'cercle':
			//FIXME check les params: lat, lon, et rayon
//			Transform(ST_Buffer(Transform(GeomFromText('LINESTRING(-76.543 42.567, -76.012 42.345, -75.890 42.445, -75.543 42.330)'), 900913), 300.0), 4326) AS buffer_shape

			$lat = $params->centre['lat'];
			$lon = $params->centre['lon'];
			$ray = $params->rayon ;
			// au depart on a du 4326 en degres. Transform vers 900913 en metres. application du Buffer en metres. Retransformation en 4326.
			$geotexte = "Transform(ST_Buffer(Transform(ST_GeomFromText('POINT($lon $lat)',4326),900913),$ray),4326)";
			break;
		default:
			$geotexte = "mauvais type de geometrie";
	}
//	var_dump($geotexte);
	return $geotexte ;
}
/************ Préparation des conditions de la recherche *******************/
// tous ceux dont le name du formulaire correspondent à la condition sur le champs en base du même nom
$conditions = new stdClass;
$conditions->binaire = new stdClass;

$conditions->avec_infos_massif=1;

foreach ($_POST as $champ => $valeur)
{
	if( ! empty($valeur) ) 
		switch ($champ) 
		{
			case ( in_array($champ, $config['champs_binaires_simples_points'] ) ) :
				$conditions->binaire->$champ = $valeur;   break;
	
			case 'limite':
				$conditions->limite=$config['points_maximum_recherche']; break ;
			
			case 'id_massif':
				$conditions->id_polygone = $valeur; break ;
			
			case 'ouvert':
				$conditions->ouvert = $valeur ; break;
			
			case ( 'lat' && !empty($_POST['lon']) && !empty($_POST['autour']) ):  // on demande un positionnement GPS. 
				// la distance n'est qu'un polygone
				$g = new stdClass();
				$g->centre = array( 'lat' => $_POST['lat'], 'lon' => $_POST['lon'] );
				$g->rayon  = $_POST['autour'] ;
				$conditions->geometrie = cree_geometrie( $g , 'cercle' );
				break;
			
			case 'id_point_type':
				$conditions->type_point = $valeur ;
				switch ( $valeur )  {
					case $config['id_cabane_gardee'] : // Condition pour ne pas retourner les abris non prévus pour dormir quand on demande une cabane non gardée sans précisé le nombre de place minimum
					case $config['tout_type_refuge'] :
						$conditions->places_minimum == '' ? $conditions->places_minimum = 1 : FALSE ;  break;
					case "tout-refuge" :
						$conditions->type_point = $config['tout_type_refuge']; break; // valeur spéciale indiquant qu'on veut les abris, refuges ou gites 
				}
		}
	
}
//	if ( !empty($valeur) )
//		$conditions->$champ=trim($valeur);

//$conditions->id_polygone=$_POST['id_massif'];
//$conditions->type_point=$_POST['id_point_type'];

// jmb tout ca dans un switch
/*switch ( $conditions->type_point ) 
{
  case $config['id_cabane_gardee'] : // Condition pour ne pas retourner les abris non prévus pour dormir quand on demande une cabane non gardée sans précisé le nombre de place minimum
  case $config['tout_type_refuge'] :
    $conditions->places_minimum == '' ? $conditions->places_minimum = 1 : FALSE ;
    break;
  case "tout-refuge" :
    $conditions->type_point=$config['tout_type_refuge']; // valeur spéciale indiquant qu'on veut les abris, refuges ou gites
    break;
}
*/
//if ($_POST['limite']==1)
//  $conditions->limite=$config['points_maximum_recherche'];

//pour tous ceux là, on attend un 'oui', donc on peut gérer en tas, la recherche faisant une boucle sur $conditions->binaire
//foreach ($config['champs_binaires_simples_points'] as $attribut_binaire )
//  if (!empty($_POST[$attribut_binaire]))
//	$conditions->binaire->$attribut_binaire=$_POST[$attribut_binaire];
  
// par défaut, on ne veut pas les éléments fermés, sauf si on les voulait spécialement
//if ($conditions->non_utilisable!='oui')
//  $conditions->ouvert='oui';	

// Recherche autour d'un couple de coordonnées gps
//if ($_POST['lat']!="" and $_POST['lon']!="" and $_POST['autour']!="")
//  $conditions->distance=$_POST['lat'].";".$_POST['lon'].";".$_POST['autour'];

$modele = new stdClass();
//======================================
// C'est LA que ca cherche
$modele->points = infos_points ($conditions);
$modele->titre = 'Dernières nouvelles du site et informations ajoutées sur les refuges';

// Mise au pluriel s'il y a plusieurs points
if ($modele->nombre_points_sans_limite>1)
	$modele->pluriel="s";
// Message indiquant qu'on a plus de point dans le résultat que la limite autorisée
// FIXME HS en pgsql
//if ($conditions->limite!="" and $modele->nombre_points_sans_limite>=$conditions->limite)
//	$modele->trop=". Votre recherche contient trop de résultats seuls $conditions->limite sont affichés.";

//-----------------------------------------------------------------------------------------------------
// Recherche de points sur nominatim.openstreetmap.org
// FIXME ca marche plus ! 
//jmb j'ai tout casse, je laisse la fct http_build_qquery au specialiste
// en attendant, desactive.
/*$urlOL =
	'http://nominatim.openstreetmap.org/search.php?'
	.http_build_query (array (
		'email' => 'sylvain@refuges.info',
		'format' => 'xml',
		'countrycodes' => 'fr,ch,it,es',
		'accept-language' => 'fr',
		'q' => $_POST['nom'],
		'limit' => 20,
	));
// Récupération du contenu à l'aide de cURL
$ch = curl_init();  // Initialiser cURL.
	curl_setopt ($ch, CURLOPT_URL, $urlOL);
	curl_setopt ($ch, CURLOPT_HEADER, 0);  // Ne pas inclure l'header dans la réponse.
	ob_start ();  // Commencer à 'cache' l'output.
		$r = curl_exec ($ch);  // Exécuter la requète.
		$cache = ob_get_contents ();  // Sauvegarder le contenu du fichier dans la variable $cache.
	ob_end_clean();  // Vider le buffer.
curl_close ($ch);  // Fermer cURL.

// Extraction de l'arbre xml
$modele->xmlOL = simplexml_load_string ($cache);

// Décompte des points // A simplifier en PHP5.3
$modele->nbPointsOL = 0;
foreach ($modele->xmlOL as $point)
	$modele->nbPointsOL++;
*/
//-----------------------------------------------------------------------------------------------------
// On affiche le tout
$modele->type = 'point_recherche';

require_once ($config['chemin_vues']."_entete.html");
require_once ($config['chemin_vues']."$modele->type.html");
require_once ($config['chemin_vues']."_pied.html");
?> 
