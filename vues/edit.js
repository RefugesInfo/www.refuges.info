// Affiche la limite de tous les massifs
const contours = layerVector({
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
		help: [
			(document.getElementById('myol-help-edit-modify') || {}).innerHTML,
			null, // Pas d'édition de ligne
			(document.getElementById('myol-help-edit-poly') || {}).innerHTML,
		],
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
		view: new ol.View({
			enableRotation: false,
		}),
		controls: [
			...mapControls('modif'),
			controlPermalink({ // Permet de garder le même réglage de carte
				<?php if ($vue->polygone->id_polygone) { ?>
					init: false, // Ici, on cadrera plutôt sur le massif
				<?php } ?>
			}),
		],
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
