new ol.Map({
	target: 'carte-accueil',
	view: new ol.View({
		enableRotation: false,
		constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
	}),
	layers: [
		layerMRI(), // Fond de carte WRI
		layerWriAreas({ // La couche "massifs"
			host: '<?=$config_wri["sous_dossier_installation"]?>', // Appeler la couche de ce serveur
		}),
	],
	controls: [
		new ol.control.Attribution({
			collapsed: false,
		}),
	],
})

// Centre la carte sur la zone souhaitée
.getView().fit(ol.proj.transformExtent([<?=$vue->bbox?>], 'EPSG:4326', 'EPSG:3857'));