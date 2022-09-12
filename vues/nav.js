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
		// Refuges.info (2 level layer depending on resolution)
		...layersWri({
			host: '<?=$config_wri["sous_dossier_installation"]?>',
			selectorName: 'selecteur-wri,selecteur-massif', // 2 selectors for one layer
			styleOptionsFunction: function (feature, properties) {
				return {
					...styleOptionsLabel(properties.name, properties, true),
					...styleOptionsIcon(properties.icon),
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
				selectorName: 'selecteur-massif',
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
			<?php if ( !$vue->contenu ) { ?>
				selectorName: 'selecteur-massifs',
			<?php } ?>
		}),

		// Overpass
		layerOverpass({
			selectorName: 'selecteur-osm',
			maxResolution: 100,
		}),

		// Pyrenees-refuges.com
		layerPyreneesRefuges({
			selectorName: 'selecteur-prc',
		}),

		// CampToCamp
		layerC2C({
			selectorName: 'selecteur-c2c',
		}),

		// Chemineur
		...layersGeoBB({
			host: '//chemineur.fr/',
			selectorName: 'selecteur-chemineur',
			attribution: 'Chemineur',
		}),

		// Alpages.info
		layerGeoBB({
			strategy: ol.loadingstrategy.all,
			host: '//alpages.info/',
			selectorName: 'selecteur-alpages',
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
		controls: [
			...mapControls('nav'),
			controlPermalink({ // Permet de garder le même réglage de carte
				display: true,
				init: <?=$vue->polygone->id_polygone?'false':'true'?>, // On cadre le massif
			}),
		],
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
