<?php
// Code Javascript de la page d'édition des pointss

$edition = true; // N'affiche pas les couches dont la licence ne permet pas la recopie
include ($config_wri['racine_projet'].'vues/_carte.js');
?>

// Utilitaire de saisie
function affiche_et_set( el , affiche, valeur ) {
    document.getElementById(el).style.visibility = affiche ;
    document.getElementById(el).value = valeur ;
    return false;
}

// Gestion des cartes
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

	marker = layerEditGeoJson({
		displayPointId: 'viseur',
		geoJsonId: 'geojson',
		dragPoint: true,
		singlePoint: true,
		styleOptions: {
			image: new ol.style.Icon({
				src: '<?=$config_wri["sous_dossier_installation"]?>images/viseur.png',
			}),
		},
		// Remove FeatureCollection packing of the point
		saveFeatures: function(coordinates, format) {
			return format.writeGeometry(
				new ol.geom.Point(coordinates.points[0]), {
					featureProjection: 'EPSG:3857',
					decimals: 5,
				}
			);
		},
	}),

	controls = [
		layersSwitcher,
		controlPermalink({ // Permet de garder le même réglage de carte en création
			visible: false, // Mais on ne visualise pas le lien du permalink
<?php if (!empty($point->id_point)) { ?>
			init: false, // Ici, on utilisera plutôt la position du point si on est en modification
<?php } ?>
		}),
		new ol.control.Attribution(),
		new ol.control.ScaleLine(),
		controlMousePosition(),
		new ol.control.Zoom(),
		controlFullScreen(),
		controlGeocoder(),
		controlLoadGPX(),
		controlGPS(),
	],

	map = new ol.Map({
		target: 'carte-edit',
<?php if (!empty($point->id_point)) { ?>
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
