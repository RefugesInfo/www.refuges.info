// Utilitaire de saisie
function affiche_et_set( el , affiche, valeur ) {
    document.getElementById(el).style.visibility = affiche ;
    document.getElementById(el).value = valeur ;
    return false;
}

// Gestion des cartes
const baseLayers = {
		'Refuges.info': layerMRI(),
		'OpenTopo': layerOpenTopo(),
		'Outdoors': layerThunderforest('outdoors'),
		'OSM fr': layerOSM('//{a-c}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png'),
		'SwissTopo': layerSwissTopo('ch.swisstopo.pixelkarte-farbe'),
		'Autriche': layerKompass('KOMPASS Touristik'),
		'Espagne': layerSpain('mapa-raster', 'MTN'),
		'Photo IGN': layerIGN('ORTHOIMAGERY.ORTHOPHOTOS', 'jpeg', 'pratique'),
		'Photo Bing': layerBing('Aerial'),
	},

	controls = [
		controlLayerSwitcher(baseLayers),
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

	coordinates = [<?=$vue->point->longitude?>, <?=$vue->point->latitude?>],

	viseur = layerEditGeoJson({
		displayPointId: 'viseur',
		geoJsonId: 'geojson',
		dragPoint: true,
		singlePoint: true,
		styleOptions: {
			image: new ol.style.Icon({
				src: '<?=$config_wri["sous_dossier_installation"]?>images/viseur.png',
				imgSize: [30, 30], // IE compatibility
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

	layerPoints = layerWri({
		host: '<?=$config_wri["sous_dossier_installation"]?>',
		maxResolution: 100, // La couche est affichée pour les résolutions < 100 Mercator map unit / pixel
		noClick: true, // Pour ne pas perturber l'édition par ces clicks intempestifs
		styleOptionsFunction: function(feature, properties) {
			return styleOptionsIcon(properties.icon); // Display only the icon
		},
		hoverStyleOptionsFunction: null, // Pour ne pas perturber l'édition par ces étiquettes intempestives
	});

new ol.Map({
	target: 'carte-edit',
	view: new ol.View({
		center: ol.proj.fromLonLat(coordinates),
		zoom: 13,
		enableRotation: false,
	}),
	controls: controls,
	layers: [
		layerPoints,
		viseur,
	],
});
