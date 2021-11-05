const baseLayers = {
		'Refuges.info': layerMRI(),
		'OpenTopo': layerOpenTopo(),
		'Outdoors': layerThunderforest('outdoors'),
		'OSM fr': layerOSM('//{a-c}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png'),
		//TODO+ voir licences IGN V2 / Photos / SwissTopo
		'IGN TOP25': layerIGN('GEOGRAPHICALGRIDSYSTEMS.MAPS'), // Need an IGN key
		'IGN V2': layerIGN('GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2', 'png', 'pratique'), // 'pratique' is the key for the free layers
		'SwissTopo': layerSwissTopo('ch.swisstopo.pixelkarte-farbe'),
		'Autriche': layerKompass('KOMPASS Touristik'),
		'Espagne': layerSpain('mapa-raster', 'MTN'),
		'Photo IGN': layerIGN('ORTHOIMAGERY.ORTHOPHOTOS', 'jpeg', 'pratique'),
		'Photo Bing': layerBing('Aerial'),
	},

  controls = [
		controlLayerSwitcher(baseLayers),
		controlPermalink({ // Permet de garder le même réglage de carte
			display: true,
<?php if ($vue->polygone->id_polygone) { ?>
			init: false, // Ici, on cadrera plutôt sur le massif
<?php } ?>
		}),
		new ol.control.Attribution(),
		new ol.control.ScaleLine(),
		controlMousePosition(),
		new ol.control.Zoom(),
		controlFullScreen(),
		controlGeocoder(),
		controlGPS(),
		controlLoadGPX(),
<?if (!$vue->polygone->nom_polygone ) { ?>
		controlDownload(),
<?php } ?>
	],

	points = layerWri({
		host: '<?=$config_wri["sous_dossier_installation"]?>',
		urlFunction: function(options, bbox, selection) {
			const el = document.getElementById('selecteur-massif');

			if (el && el.checked)
				return options.host + 'api/massif' +
					'?massif=<?=$vue->polygone->id_polygone?>&'+
					'type_points=' + selection.join(',');
			else
				return options.host + 'api/bbox' +
					'?type_points=' + selection.join(',') +
					'&bbox=' + bbox.join(',');
		},
		selectorName: 'couche-wri',
		maxResolution: 500, // La couche est affichée pour les résolutions < 500 Mercator map unit / pixel
		distance: 30, // Clusterisation
	}),

	// Affiche les massifs si résolution > 500
	massifs = layerWriAreas({
		host: '<?=$config_wri["sous_dossier_installation"]?>',
		minResolution: 500,
		selectorName: 'couche-wri',
	}),

	// La couche "contour" (du massif, de la zone)
	contour = layerVector({
		url: '<?=$config_wri["sous_dossier_installation"]?>api/polygones' +
			'?massif=<?=$vue->polygone->id_polygone?>',
		selectorName: 'couche-massif',
		style: new ol.style.Style({
			stroke: new ol.style.Stroke({
				color: 'blue',
				width: 2,
			}),
		}),
	}),

	layers = [
		// Refuges.info
<?php if ($vue->polygone->id_polygone) { ?>
		contour,
<?php } ?>
		points,
		massifs,

		// Overpass
		layerOverpass({
			selectorName: 'couche-osm',
			distance: 30,
			maxResolution: 100,
		}),

		// Pyrenees-refuges.com
		layerPyreneesRefuges({
			selectorName: 'couche-prc',
			distance: 30,
		}),

		// CampToCamp
		layerC2C({
			selectorName: 'couche-c2c',
			distance: 30,
		}),

		// Chemineur
		layerGeoBB({
			selectorName: 'couche-chemineur',
			maxResolution: 100,
			distance: 30,
			attribution: 'Chemineur',
		}),
		layerGeoBB({
			selectorName: 'couche-chemineur',
			subLayer: 'cluster',
			minResolution: 100,
			distance: 30,
			attribution: 'Chemineur',
		}),

		// Alpages.info
		layerGeoBB({
			host: '//alpages.info/',
			selectorName: 'couche-alpages',
			argSelName: 'forums',
			distance: 30,
			attribution: 'Alpages',
		}),
	],

	map = new ol.Map({
		target: 'carte-nav',
		controls: controls,
		layers: layers,
	});

	// Centrer sur la zone du polygone
	<?if ($vue->polygone->id_polygone){?>
		map.getView().fit(ol.proj.transformExtent([
			<?=$vue->polygone->ouest?>,
			<?=$vue->polygone->sud?>,
			<?=$vue->polygone->est?>,
			<?=$vue->polygone->nord?>,
		], 'EPSG:4326', 'EPSG:3857'));
	<?}?>
