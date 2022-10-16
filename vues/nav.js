// Forçage de l'init des coches
<?php if ( $vue->polygone->id_polygone ) { ?>
	// Supprime toutes les sélections commençant par myol_selecteur
	Object.keys(localStorage)
		.filter(k => k.substring(0, 14) == 'myol_selecteur')
		.forEach(k => localStorage.removeItem(k));

	// Force tous les points et le contour
	localStorage.myol_selecteurwri = 'all';
	localStorage.myol_selecteurmassif = <?=$vue->polygone->id_polygone?>;
<?php } ?>

const mapId = 'carte-nav',
	mapEl = document.getElementById(mapId),
	mapSize = mapEl ? Math.max(mapEl.clientWidth, mapEl.clientHeight) : window.innerWidth,
	layers = [
		// Refuges.info (2 couches dependant de la resolution)
		layerClusterWri({
			host: '<?=$config_wri["sous_dossier_installation"]?>',
			selectName: 'selecteur-wri,selecteur-massif', // 2 selecteurs pour une même couche
			styleOptFnc: function (feature, properties) {
				return {
					...styleOptLabel(properties.name, feature, properties, true),
					...styleOptIcon(properties.icon),
				};
			},
			attribution: '',
		}),

		// Contour d'un massif ou d'une zone
		layerVector({
			url: '<?=$config_wri["sous_dossier_installation"]?>' +
				'api/polygones?massif=<?=$vue->polygone->id_polygone?>',
			zIndex: 3, // Au dessus des massifs mais en dessous de son hover
			<?php if ( !$vue->contenu ) { ?>
				selectName: 'selecteur-massif',
			<?php } ?>
			style: new ol.style.Style({
				stroke: new ol.style.Stroke({
					color: 'blue',
					width: 2,
				}),
			}),
		}),

		// Les massifs
		layerWriAreas({
			host: '<?=$config_wri["sous_dossier_installation"]?>',
			selectName: '<?=$vue->contenu?"":"selecteur-massifs"?>',
		}),

		// Overpass
		layerOverpass({
			selectName: 'selecteur-osm',
			maxResolution: 100,
		}),

		// Pyrenees-refuges.com
		layerPrc({
			selectName: 'selecteur-prc',
		}),

		// CampToCamp
		layerC2C({
			selectName: 'selecteur-c2c',
		}),

		// Chemineur
		layerClusterGeoBB({
			host: '//chemineur.fr/',
			selectName: 'selecteur-chemineur',
			attribution: 'Chemineur',
		}),

		// Alpages.info
		layerGeoBB({
			strategy: ol.loadingstrategy.all,
			host: '//alpages.info/',
			selectName: 'selecteur-alpages',
			extraParams: function() {
				return {
					forums: '4,5',
				}
			},
			attribution: 'Alpages',
		}),
	],

	map = new ol.Map({
		target: mapId,
		view: new ol.View({
			enableRotation: false,
			constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
		}),
		controls: wriMapControls({
			page: 'nav',
			Permalink: { // Permet de garder le même réglage de carte
				display: true,
				init: <?=$vue->polygone->id_polygone?'false':'true'?>, // On cadre le massif
			},
		}),
		layers: layers,
	});

// Centrer sur la zone du polygone
<?if ($vue->polygone->id_polygone) { ?>
	map.getView().fit(ol.proj.transformExtent([
		<?=$vue->polygone->ouest?>,
		<?=$vue->polygone->sud?>,
		<?=$vue->polygone->est?>,
		<?=$vue->polygone->nord?>,
	], 'EPSG:4326', 'EPSG:3857'));
<? } ?>
