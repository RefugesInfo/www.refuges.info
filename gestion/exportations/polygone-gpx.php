<?php // url d'extraction et d'import d'un polygone au format GPX
// A utiliser comme couche dans l'éditeur de massifs

// 18/07/12 Dominique : Création

require_once("../../modeles/config.php");
require_once ($config['chemin_modeles']."fonctions_gps.php");
require_once ($config['chemin_modeles']."fonctions_polygones.php");
require_once ($config['chemin_modeles']."fonctions_exportations.php");

$id_polygone = $_GET['id_polygone'];
if ($id_polygone > 0) {
	$infos = infos_polygone($id_polygone);
		
	// Import des données passées en argument par l'éditeur
	if ($data = file_get_contents("php://input")) { // Récupération du flux en méthode PUT
		$trace = simplexml_load_string (str_replace( 'gpx:', '', $data));
		suppression_points_polygone ($id_polygone);	
		$i=1;
		$points_precedents = Array ();
		foreach ($trace->trk->trkseg->trkpt as $point) {
			//print($point['lat']);
			$point_gps->latitude  = $point['lat'];
			$point_gps->longitude = $point['lon'];
			if (!$points_precedents ['P'.$point['lat']] ['P'.$point['lon']]) { // Elimine les doublons
				if (!$points_precedents ['P'.$point['lat']] )
					$points_precedents ['P'.$point['lat']] = Array ();
				$points_precedents ['P'.$point['lat']] ['P'.$point['lon']] = true;
				$id_point=modification_ajout_point_gps ($point_gps,$id_polygone);
				mysql_query ("INSERT INTO lien_polygone_gps set id_polygone=$id_polygone,id_point_gps=$id_point,ordre=$i");
				$i++;
			}
		}
		// On demande la mise à jour des pré-calculs dans notre base du polygone qu'on vient de modifier/ajouter
		precalculs_polygones($id_polygone);
	}

	// Export du polygone vers l'éditeur
	if (($xml_gpx=export_polygone_gpx($id_polygone))!=-1) {
		header('Content-type: application/gpx+xml');
		header('Content-Disposition: attachment; filename="'.$infos->nom_polygone.'.gpx"');
		print (str_replace (
			'<trk>', 
			// Ajout du nom du polygone pour que le feature de la couche OL porte ce nom
			'<trk><name>' .$infos->nom_polygone .'</name>', 
			$xml_gpx
		));
	}
}
?>