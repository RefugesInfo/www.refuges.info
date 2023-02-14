// Utilitaire de saisie
function affiche_et_set(el, affiche, valeur) {
	document.getElementById(el).style.visibility = affiche;
	document.getElementById(el).value = valeur;
	return false;
}

// Gestion des cartes
new ol.Map({
	target: 'carte-edit',
	view: new ol.View({
		center: ol.proj.fromLonLat([<?=$vue->point->longitude?>, <?=$vue->point->latitude?>]),
		zoom: 13,
		enableRotation: false,
		constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
	}),
	controls: wriMapControls({
		page: 'modif',
	}),
	layers: [
		layerClusterWri({
			host: '<?=$config_wri["sous_dossier_installation"]?>',
			noClick: true, // Pour ne pas perturber l'édition par ces clicks intempestifs
			styleOptionsHover: function(feature, properties) {
				return styleOptionsLabel(feature, properties.nom || properties.name); // Single label
			},
		}),
		layerMarker({
			prefix: 'marker', // S'interface avec les <TAG id="marker-xxx"...
			src: '<?=$config_wri["sous_dossier_installation"]?>images/viseur.svg',
			focus: 15,
			dragable: true,
		}),
	],
});