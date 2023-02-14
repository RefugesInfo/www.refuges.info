const mapId = 'carte-point',
	mapEl = document.getElementById(mapId),
	mapSize = mapEl ? Math.max(mapEl.clientWidth, mapEl.clientHeight) : window.innerWidth;

new ol.Map({
	target: mapId,
	view: new ol.View({
		center: ol.proj.fromLonLat([<?=$vue->point->longitude?>,<?=$vue->point->latitude?>]),
		zoom: 13,
		enableRotation: false,
		constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
	}),
	controls: wriMapControls({
		page: 'point',
		Permalink: { // Permet de garder le même réglage de carte d'une page à l'autre
			visible: false, // Mais on ne visualise pas le lien du permalink
			init: false, // Ici, on utilisera plutôt la position du point
		},
	}),
	layers: [
		layerClusterWri({
			host: '<?=$config_wri["sous_dossier_installation"]?>',
			// Display a single label above each icon
			styleOptionsDisplay: function(feature, properties, layer, resolution) {
				if (!properties.cluster || resolution < layer.options.maxResolutionDegroup)
					return styleOptionsLabel(feature, properties.nom || properties.name); // Points || clusters
			},
			// Don't display attribution on labels
			convertProperties: {
				attribution: null,
			},
		}),
		// Le cadre
		layerMarker({
			prefix: 'cadre', // S'interface avec les <TAG id="cadre-xxx"...
			src: '<?=$config_wri["sous_dossier_installation"]?>images/cadre.svg',
			focus: 15, // Centrer 
		}),
	],
});