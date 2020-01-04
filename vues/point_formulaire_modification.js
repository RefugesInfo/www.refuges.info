<?php
	include ($config_wri['racine_projet'].'vues/includes/cartes.js');
?>
const refugesInfo = layerRefugesInfo({
		baseUrl: '<?=$config_wri["sous_dossier_installation"]?>',
		receiveProperties: function(properties) {
			properties.icone = properties.type.icone;
			properties.link = null; // Couche non cliquable
		},
		label: function(properties) {
			return properties.nom;
		},
	}),

	marker = layerMarker({
		imageUrl: '<?=$config_wri["sous_dossier_installation"]?>images/viseur.png',
		idDisplay: 'viseur',
<?php if (!$point->id_point) { ?> // Pour une création de point
		centerOnMap: true, // On utilise la position du permalink et on centre le curseur dessus
<?php } ?>
		draggable: true,
	}),

	controls = [
		layersSwitcher,
		controlPermalink({ // Permet de garder le même réglage de carte en création
			visible: false, // Mais on ne visualise pas le lien du permalink
<?php if ($point->id_point) { ?>
			init: false, // Ici, on utilisera plutôt la position du point si on est en modification
<?php } ?>
		}),
		new ol.control.Attribution(),
		new ol.control.ScaleLine(),
		controlMousePosition(),
		new ol.control.Zoom(),
		new ol.control.FullScreen({
			label: '', //HACK Bad presentation on IE & FF
			tipLabel: 'Plein écran',
		}),
		controlGeocoder(),
		controlLoadGPX(),
		controlGPS(),
	],

	map = new ol.Map({
		target: 'carte-edit',
<?php if ($point->id_point) { ?>
		view: new ol.View({ // Position initiale forcée aux coordonnées de la cabane
			center: ol.proj.fromLonLat([<?=$vue->point->longitude?>, <?=$vue->point->latitude?>]),
			zoom: 13,
		}),
<?php } ?>
		controls: controls,
		layers: [
			refugesInfo,
			marker
		],
	});