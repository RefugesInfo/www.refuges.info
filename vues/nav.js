<?php
// Code Javascript de la page des cartes

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config_wri les données communes à tout WRI

include ($config_wri['racine_projet'].'vues/_carte.js');
?>
const controls = [
		layersSwitcher,
		controlPermalink({ // Permet de garder le même réglage de carte
<?php if ($vue->polygone->id_polygone) { ?>
			init: false, // Ici, on cadrera plutôt sur le massif
<?php } ?>
		}),
		new ol.control.Attribution({
			collapsible: false,
		}),
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
		controlPrint(),
	],
	
	points = layerRefugesInfo({
		baseUrl: '<?=$config_wri["sous_dossier_installation"]?>',
		selectorName: 'couche-wri',
		noMemSelection: true,
		baseUrlFunction: function(bbox, list) {
			const el = document.getElementById('selecteur-massif');
			return '<?=$config_wri["sous_dossier_installation"]?>api/'+
				(el && el.checked ? 'massif?massif=<?=$vue->polygone->id_polygone?>&' : 'bbox?')+
				'type_points=' + list.join(',') + '&bbox=' + bbox.join(','); // Default most common url format
		},
	}),

	// La couche "contour" (du massif, de la zone)
	contour = layerVectorURL({
		baseUrl: '<?=$config_wri["sous_dossier_installation"]?>api/polygones?massif=<?=$vue->polygone->id_polygone?>',
		selectorName: 'couche-massif',
		noMemSelection: true,
		receiveProperties: function(properties, feature) {
			// Convertit les polygones en lignes pour ne pas activer le curseur en passant à l'intérieur du massif
			let multi = [];
			for(c in feature.geometry.coordinates)
				multi = multi.concat(feature.geometry.coordinates[c]);
			feature.geometry = {
				type: 'MultiLineString',
				coordinates: multi,
			};
			// Pas d'étiquette sur le bord du massif
			properties.type = null;
		},
	}),

	// La couche "polygones" (du massif, de la zone, plein et coloré)
	polygones = layerVectorURL({
		baseUrl: '<?=$config_wri["sous_dossier_installation"]?>api/polygones?type_polygon=<?=$vue->contenu->id_polygone_type?>&intersection=<?=$vue->polygone->id_polygone?>',
		noMemSelection: true,
		receiveProperties: function(properties, feature, layer) {
			properties.name = properties.nom;
			properties.type = null;
			properties.link = properties.lien;
			properties.copy = '';
		},
		styleOptions: function(properties) {
			// Translates the color in RGBA to be transparent
			var cs = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(properties.couleur);
			return {
				fill: new ol.style.Fill({
					color: 'rgba(' +
						parseInt(cs[1], 16) + ',' +
						parseInt(cs[2], 16) + ',' +
						parseInt(cs[3], 16) + ',0.5)',
				}),
				stroke: new ol.style.Stroke({
					color: 'black',
				}),
			};
		},
		hoverStyleOptions: function(properties) {
			return {
				fill: new ol.style.Fill({
					color: properties.couleur,
				}),
			};
		},
	}),

	overlays = [
<?php if ($vue->contenu) { ?>
			polygones,
<?php } else if ($vue->polygone->id_polygone) { ?>
			contour,
<?php } ?>
<?php if (!$vue->contenu) { ?>
			points,
<?php } ?>
			layerOverpass({
				selectorName: 'couche-osm',
				styleOptions: function(properties) {
					return {
						image: new ol.style.Icon({
							src: '<?=$config_wri["url_chemin_icones"]?>' + properties.sym + '.svg',
							imgSize: [24, 24], // I.E. compatibility
						}),
					};
				},
			}),
			layerPyreneesRefuges({
				selectorName: 'couche-prc',
				styleOptions: function(properties) {
					return {
						image: new ol.style.Icon({
							src: '<?=$config_wri["url_chemin_icones"]?>' + properties.sym + '.svg',
							imgSize: [24, 24], // I.E. compatibility
						}),
					};
				},
			}),
			layerC2C({
				selectorName: 'couche-c2c',
				styleOptions: function(properties) {
					return {
						image: new ol.style.Icon({
							src: '<?=$config_wri["url_chemin_icones"]?>' + properties.sym + '.svg',
							imgSize: [24, 24], // I.E. compatibility
						}),
					};
				},
			}),
			layerChemineur({
				selectorName: 'couche-chemineur',
				urlSuffix: '3,8,16,20,23', // Refuges, abris, inutilisables, points d'eau, sommets, cols, lacs, ...
			}),
			layerAlpages({
				selectorName: 'couche-alpages',
			}),
		];

	map = new ol.Map({
		target: 'carte-nav',
		controls: controls,
		layers: overlays,
	});

	<?if ($vue->polygone->id_polygone){?>
		map.getView().fit(ol.proj.transformExtent([
			<?=$vue->polygone->ouest?>,
			<?=$vue->polygone->sud?>,
			<?=$vue->polygone->est?>,
			<?=$vue->polygone->nord?>,
		], 'EPSG:4326', 'EPSG:3857'));
	<?}?>
