<?php
// Script lié à la page point

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config_wri les données communes à tout WRI

include ($config_wri['racine_projet'].'vues/_carte.js');
?>
const controls = [
		layersSwitcher,
		controlPermalink({ // Permet de garder le même réglage de carte d'une page à l'autre
			visible: false, // Mais on ne visualise pas le lien du permalink
			init: false, // Ici, on utilisera plutôt la position du point
		}),
		new ol.control.ScaleLine(),
		controlMousePosition(),
		new ol.control.Zoom(),
		controlFullScreen(),
		new ol.control.Attribution({
			collapsible: false, // Attribution always open
		}),
	],

	vectorLayers = [
		layerRefugesInfo({
			baseUrl: '<?=$config_wri["sous_dossier_installation"]?>',
		}),
		layerGeoJson({
			displayPointId: 'marqueur',
			geoJson: {
				type: 'Point',
				coordinates: [
					<?=$vue->point->longitude?>,
					<?=$vue->point->latitude?>,
				],
			},
			styleOptions: {
				image: new ol.style.Icon({
					src: '<?=$config_wri["sous_dossier_installation"]?>images/cadre.png',
				}),
			},
		}),
	],

	map = new ol.Map({
		target: 'carte-point',
		view: new ol.View({
			center: ol.proj.fromLonLat([
				<?=$vue->point->longitude?>,
				<?=$vue->point->latitude?>,
			]),
			zoom: 13,
		}),
		controls: controls,
		layers: vectorLayers,
	});