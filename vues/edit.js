const controls = [
		controlLayerSwitcher(layersCollection()),
		new ol.control.Attribution(),
		new ol.control.ScaleLine(),
		controlMousePosition(),
		new ol.control.Zoom(),
		controlFullScreen(),
		controlGeocoder(),
		controlLoadGPX(),
		controlPermalink({ // Permet de garder le même réglage de carte
			display: true,
<?php if ($vue->polygone->id_polygone) { ?>
			init: false, // Ici, on cadrera plutôt sur le massif
<?php } ?>
		}),
	],

	// Affiche en noir la limite de tous les massifs
	contours = layerVector({
		url: '<?=$config_wri["sous_dossier_installation"]?>api/polygones?type_polygon=1',
		style: new ol.style.Style({
			stroke: new ol.style.Stroke({
				color: 'blue',
			}),
		}),
	}),

	editeur = layerEditGeoJson({
		geoJsonId: 'edit-json',
		snapLayers: [contours],
		titleModify: 'Modification d‘un polygone:\n' +
			'Activer ce bouton (couleur jaune) puis:\n' +
			'Déplacer un sommet: Cliquer dessus puis le déplacer.\n' +
			'Ajouter un sommet: Cliquer au milieu d\'un côté puis le déplacer.\n' +
			'Supprimer un sommet: Alt + cliquer sur le côté commun.\n' +
			'Scinder un polygone: Joindre 2 sommets du polygone,\n' +
			'Fusionner 2 polygones: Coller un côté identique\n' +
			'(entre 2 sommets consécutifs) de chaque polygone\n' +
			'puis alt+cliquer dessus.\n' +
			'Supprimer un polygone: Ctrl + Alt + cliquer dessus.',
		titlePolygon: 'Création d‘un polygone:\n' +
			'Activer ce bouton (couleur jaune) puis:\n' +
			'Cliquer sur la carte et sur chaque point désiré pour dessiner un polygone,\n' +
			'double cliquer pour terminer.\n' +
			'Un polygone entièrement compris dans un autre crée un "trou".',
		saveFeatures: function(coordinates, format) {
			return format.writeGeometry(
				new ol.geom.MultiPolygon(coordinates.polys),
				{
					featureProjection: 'EPSG:3857',
					decimals: 5,
				});
		},
	}),

	map = new ol.Map({
		target: 'carte-nav',
		controls: controls,
		layers: [
			contours,
			editeur,
		],
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
