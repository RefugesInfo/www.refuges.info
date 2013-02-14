<?php // Renvoi un fichier au format souhaité contenant les données souhaitées en provenance de notre base
// le lien d'accès à pour format : http://www.refuges.info/exportation/exportations.php?format=kmz&
// Ne pas changer l'adresse à la légère :
// ATTENTION :Openlayers est basé sur cette adresse, l'export aussi, des sites partenaires aussi peut-être !

// ??/??/?? Création
// 30/10/10 Sly: GPI
// 24/11/12 Dominique: Dédoublement des points proches
// 01/12/12 Dominique: Passage en template

require_once ("../modeles/config.php");
include ($config['chemin_vues']."fonctions_exportations.php");

// Nous allons récupérer la liste des points souhaités en fonction des paramètres demandés
// Pour des raisons de performance de la carte gmaps qui ne demande pas de limite, on ne donne 
// qu'un nombre limité de points, les exportations devront penser à passer &limite=sans pour tout avoir
// Sly 

// Pour plus de flexibilité, il me semblerait plus logique de laisser le soin aux applications de faire elles même leur choix de limite et que par défaut il n'y ait pas de limite justement
// Peut-être au passage au tout OpenLayers il serait bien d'y passer sly 28/10/2010
// Dominique 02/12/12: trop dangeureux car génère des retours volumineux: si on veut tout, il faut le demander explicitement.

//---------------------------------------------------------------------------------------
// Traitement des paramètres

// MODIF DOMINIQUE : utilisé par OpenLayers
if (!$_GET["limite"])
	$conditions->limite=120;
else if ($_GET["limite"]!="sans")
	$conditions->limite = $_GET ["limite"]; 
	
// DOMINIQUE : Ajout du paramètre bbox au format utilisé par OpenLayers
// SLY : remplacement de l'ancien format pour ne garder que celui d'openlayers : &bbox=ouest,sud,est,nord
if (isset ($_GET ['bbox']))
{
  $bbox=explode(",",$_GET ['bbox']);
  $conditions->latitude_minimum=$bbox [1];
  $conditions->latitude_maximum=$bbox [3];
  $conditions->longitude_minimum=$bbox [0];
  $conditions->longitude_maximum=$bbox [2];
}

$conditions->type_point=$_GET['liste_id_point_type'];
$conditions->pas_les_points_caches=1;
$conditions->ordre="point_type.importance DESC, points_gps.longitude DESC";
$conditions->liste_id_point=$_GET['liste_id_point'];
$conditions->id_polygone=$_GET['liste_id_massif'];
$conditions->avec_infos_massif=1;

$format_export=$_GET['format'];

//---------------------------------------------------------------------------------------
// Bidouille atroce pour les formats compressés: on réappelle l'url et on zip le résultat
if ($format_export == 'kmz') {
	header("Content-disposition: attachment; filename='refuges-info.kmz");
	header("Content-Transfer-Encoding: binary");
	header("Pragma: no-cache");
	header("Expires: 0");

	$url = str_replace ('kmz', 'kml', 'http://'.$_SERVER ['HTTP_HOST'].$_SERVER ['REQUEST_URI']);
	$zip = new zipfile () ; //on crée un fichier zip
	$zip->addfile (url_get_contents ($url), 'refuges-info.kml') ; //on ajoute le fichier
	print $zip->file ();
	
	exit();
}
//---------------------------------------------------------------------------------------
// Même bidouille pour les formats gpsbabel
if ($format_export == 'gpi') {
	header("Content-disposition: attachment; filename='refuges-info.gpi");
	header("Content-Transfer-Encoding: binary");
	header("Pragma: no-cache");
	header("Expires: 0");

	$url = str_replace ('gpi', 'gpx-garmin', 'http://'.$_SERVER ['HTTP_HOST'].$_SERVER ['REQUEST_URI']);
	$name = rand (1, 2000);
	file_put_contents ("./$name", url_get_contents ($url));
	print shell_exec ("cat ./$name | gpsbabel -w -r -t -i gpx -f - -o garmin_gpi -F -");
	unlink ($name);

	exit();
}
//---------------------------------------------------------------------------------------
function url_get_contents ($url) { // Lit le contenu d'une URL distante
	$ch = curl_init();  // Initialiser cURL.
		curl_setopt ($ch, CURLOPT_URL, $url);  // Indiquer quel URL récupérer
		curl_setopt ($ch, CURLOPT_HEADER, 0);  // Ne pas inclure l'header dans la réponse.
		ob_start ();  // Commencer à 'cache' l'output.
			curl_exec ($ch);  // Exécuter la requète.
			$cache = ob_get_contents ();  // Sauvegarder la 'cache' dans la variable $cache.
		ob_end_clean();  // Vider le buffer.
	curl_close ($ch);  // Fermer cURL.
	return $cache;
}
//---------------------------------------------------------------------------------------
// Obtenir le tableau des points, selon les conditions
$liste_points = liste_points ($conditions);

// Nombre de point récupéré(s), on va permettre de faire du comsétique avec le bon nom de fichier si un seul
$i=0;
if ($liste_points->nombre_points==1)
	$nom_fichier_export = replace_url($liste_points->points->$i->nom);
else
	$nom_fichier_export = $config['nom_fichier_export'];

//---------------------------------------------------------------------------------------
// Dédoublement des icônes qui se recouvrent
//DEBUG http://www.refuges.info/exportations/exportations.php?format=gml&debug=oui&bbox=5,45,5.5,45.6		
if ($icones = $_GET ['icones']) { // Nombres d'icones qui, mises côte à côte, remplissent la largeur de la carte
	$delta_latitude  = ($conditions->latitude_maximum  - $conditions->latitude_minimum ) / $icones;
	$delta_longitude = ($conditions->longitude_maximum - $conditions->longitude_minimum) / $icones;

	if ($delta_latitude && $delta_longitude) // S'il y a un BBOX
		foreach ($liste_points->points as $a => $p)
			for ($b=0; $b<$a; $b++) {// Pour toutes les paires de points $a, $b
				$dlat = $liste_points->points->$a->latitude  - $liste_points->points->$b->latitude;
				$dlon = $liste_points->points->$a->longitude - $liste_points->points->$b->longitude;
				if ($dlat / $delta_latitude * $dlat / $delta_latitude + $dlon / $delta_longitude * $dlon / $delta_longitude < 1) {
					if ($dlat < 0) // $b a une plus grande latitude
						$deplacement_latitude = $dlat + $delta_latitude;
					else // $a a une plus grande latitude
						$deplacement_latitude = $dlat - $delta_latitude;

					if ($dlon < 0)  // $b a une plus grande longitude
						$deplacement_longitude = $dlon + $delta_longitude;
					else // $a a une plus grande longitude
						$deplacement_longitude = $dlon - $delta_longitude;
						
					$liste_points->points->$a->latitude  -= $deplacement_latitude  / 2;
					$liste_points->points->$b->latitude  += $deplacement_latitude  / 2;
					$liste_points->points->$a->longitude -= $deplacement_longitude / 3;
					$liste_points->points->$b->longitude += $deplacement_longitude / 3;
				}
			}
}
//---------------------------------------------------------------------------------------
if ($liste_points->nombre_points>0) // si nous n'avons aucun point dans la recherche, on renvoi un fichier valide, mais sans les points dedans
	foreach ($liste_points->points as $k => $point) {
		// Petite bidouille un peu séciale, dans le mode carte, on souhaite changer les icônes de certains point dont les critères justifie une icone différente
		// sly 12/05/2010
		// FIXME : On notera un défaut lorsque l'abri est sommaire ET détruit il faudrait une 3ème combinaison d'icône
		// sly 30/10/10

		// S'il est sommaire ou qu'il n'a aucune place pour dormir et qu'il a l'icone pour ça
		if (($point->sommaire=='oui') OR
			($point->places==0) AND
			$point->nom_icone_sommaire!=''
		)
			$point->nom_icone=$point->nom_icone_sommaire;

		// Si le point est "fermé" ou "détruit" ou "ruines" et qu'il a une icone spéciale "fermée" on la choisie 
		if ($point->ferme!='non' AND 
			$point->ferme!='' AND 
			$point->nom_icone_ferme!=''
		)
		$point->nom_icone=$point->nom_icone_ferme;

		// Ajout de quelques infos
		$point->url = lien_point_fast ($point);
		
		// On mémorise dans le tableau
		// On regroupe les points par type car le format kml à besoin de cette info
		$modele->pois [$point->nom_icone] [] = $point;
	}
//---------------------------------------------------------------------------------------
// On affiche tout ça avec le template correspondant au format
$modele->nom_fichier_export="base-refuges-info";
$modele->description = "Tout ou partie de la base de donnée de point GPS de www.refuges.info, contenant des points d'intérêts du massif des alpes";
//print_r($modele->pois);
$modele->content_type=$config['encodage_exportation'];
include ($config['chemin_vues']."exportations/export_$format_export.php");

?>