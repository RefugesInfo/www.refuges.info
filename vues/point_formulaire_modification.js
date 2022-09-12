// Utilitaire de saisie
function affiche_et_set(el, affiche, valeur) {
	document.getElementById(el).style.visibility = affiche;
	document.getElementById(el).value = valeur;
	return false;
}

// Gestion des cartes
const marker = layerMarker({
		prefix: 'marker', // S'interface avec les <TAG id="marker-xxx"...
		src: '<?=$config_wri["sous_dossier_installation"]?>images/viseur.svg',
		focus: 15,
		dragable: true,
		zIndex: 30, // Above points (zIndex = 10)
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
		center: ol.proj.fromLonLat([<?=$vue->point->longitude?>, <?=$vue->point->latitude?>]),
		zoom: 13,
		enableRotation: false,
		constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
	}),
	controls: [
		...mapControls('modif'),
		controlPermalink({ // Permet de garder le même réglage de carte en création
			visible: false, // Mais on ne visualise pas le lien du permalink
<?php if (!empty($point->id_point)) { ?>
			init: false, // Ici, on utilisera plutôt la position du point si on est en modification
<?php } ?>
		}),
	],
	layers: [
		layerPoints,
		marker,
	],
});