<?// Code Javascript de la page des cartes

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config les données communes à tout WRI
?>

// Style de base des polylines édités
L.Polyline = L.Polyline.extend({
	options: {
		color: 'blue',
		weight: 4,
		opacity: 1,
	}
});

var map,
	arg_massifs = '<?=$vue->polygone->id_polygone?>',
	layerSwitcher,

	baseLayers = {
		'Refuges.info-OSM': new L.TileLayer.OSM.MRI(),
		'France-OSM':    new L.TileLayer.OSM.FR(),
		'Outdoors-OSM':  new L.TileLayer.OSM.Outdoors(),
		'France-IGN':    new L.TileLayer.IGN(),
		'Express-IGN':   new L.TileLayer.IGN('GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'),
		'SwissTopo':     new L.TileLayer.SwissTopo(),
		'Autriche-OB':   new L.TileLayer.OSM.OB.Touristik(),
		'Espagne-IDEE':  new L.TileLayer.WMS.IDEE(),
		'Italie-IGM':    new L.TileLayer.WMS.IGM(),
		'Angleterre-OS': new L.TileLayer.OSOpenSpace(key.os,{}),
		'Photo-Bing':    new L.BingLayer(key.bing),
		'Photos-IGN':    new L.TileLayer.IGN('ORTHOIMAGERY.ORTHOPHOTOS')
	},

	massifLayer = new L.GeoJSON.Ajax(
		'<?=$config['sous_dossier_installation']?>api/polygones', {
<?if ( $vue->mode_affichage == 'edit' ){?>
			argsGeoJSON: {
				type_polygon: 1,
				type_geom: 'polylines', // La surface à l'intérieur des massifs reste cliquable
				time: <?=time()?> // Inhibe le cache
			},
			style: function(feature) {
				return {
					color: 'blue',
					weight: 2,
					opacity: 0.6,
					fillOpacity: 0,
					editSnapable: true
				}
			}
<?}else if ( $vue->mode_affichage == 'zone' ){?>
			argsGeoJSON: {
				type_polygon: 1,
				intersection: '<?=$vue->polygone->id_polygone?>'
			},
			url: function(target) {
				return target.feature.properties.lien;
			},
			style: function(feature) {
				return {
					color: 'black',
					fillColor: feature.properties.couleur,
					weight: 1,
					opacity: 0.5,
					fillOpacity: 0.3
				}
			}
<?}else{?>
			argsGeoJSON: {
				massif: '<?=$vue->polygone->id_polygone?>'
			},
			style: function(feature) {
				return {
					color: 'blue',
					weight: 2,
					opacity: 1,
					fillOpacity: 0
				}
			}
<?}?>
		}
	),

	poiBbox = new L.GeoJSON.Ajax( // Les points d'intérêt WRI en général
		'<?=$config['sous_dossier_installation']?>api/bbox', {
			argsGeoJSON: {
				type_points: 'all'
			},
			bbox: true,
			degroup: 12,
			url: function(target) {
				return '<?=$config['sous_dossier_installation']?>point/' + target.feature.properties.id;
			},
			icon: function(feature) {
				return {
					url: '<?=$config['sous_dossier_installation']?>images/icones/' + feature.properties.type.icone + '.png'
				}
			}
		}
	),

// Serveurs externes
	poiPRC = new L.GeoJSON.Ajax(
		'http://v2.chemineur.fr/prod/chem/json.php', {
			argsGeoJSON: {
				site: 'prc',
			},
			degroup: 12,
			bbox: true,
			url: function(target) {
				return 'http://www.pyrenees-refuges.com/fr/affiche.php?numenr=' + target.feature.properties.id;
			},
			icon: function(feature) {
				return {
					url: 'http://v2.chemineur.fr/prod/chemtype/' + feature.properties.type.icone + '.png'
				}
			}
		}
	),
	poiC2C = new L.GeoJSON.Ajax(
		'http://v2.chemineur.fr/prod/chem/json.php', {
			argsGeoJSON: {
				site: 'c2c',
			},
			degroup: 12,
			bbox: true,
			url: function(target) {
				return 'http://www.camptocamp.org/huts/' + target.feature.properties.id;
			},
			icon: function(feature) {
				return {
					url: 'http://v2.chemineur.fr/prod/chemtype/' + feature.properties.type.icone + '.png'
				}
			}
		}
	),
	poiCHEM = new L.GeoJSON.Ajax(
		'http://v2.chemineur.fr/prod/chem/json.php', {
			degroup: 12,
			bbox: true,
			url: function(target) {
				return 'http://chemineur.fr/point/' + target.feature.properties.id;
			},
			icon: function(feature) {
				return {
					url: 'http://v2.chemineur.fr/prod/chemtype/' + feature.properties.type.icone + '.png'
				}
			}
		}
	),

	poiMassif = new L.GeoJSON.Ajax( // Les points d'intérêt WRI pour 1 massif
		'<?=$config['sous_dossier_installation']?>api/massif', {
			argsGeoJSON: {
				type_points: 'all',
				massif: arg_massifs
			},
			bbox: true,
			url: function(target) {
				return '<?=$config['sous_dossier_installation']?>point/' + target.feature.properties.id;
			},
			icon: function(feature) {
				return {
					url: '<?=$config['sous_dossier_installation']?>images/icones/' + feature.properties.type.icone + '.png'
				}
			}
		}
	),

	poiLayer = <?if ( $vue->polygone->id_polygone ) {?>poiMassif<?}else{?>poiBbox<?}?>;

window.addEventListener('load', function() {
	map = new L.Map('nav_bloc_carte', {
		fullscreenControl: true,
		layers: [
			baseLayers[L.UrlUtil.queryParse(L.UrlUtil.hash()).layer] // Donné par le permalink #layer=NOM
				|| baseLayers['<?=$config["carte_base"]?>'] // Sinon le fond de carte par défaut
				|| baseLayers[Object.keys(baseLayers)[0]], // Sinon la première couche définie
			massifLayer
<?if ( !$vue->mode_affichage ){?>
			,poiLayer
<?}?>
		]
	});

<?if ( $vue->polygone->bbox ){?>
	var bboxs = [<?=$vue->polygone->bbox?>]; // BBox au format Openlayers [left, bottom, right, top] = [west, south, east, north]
	map.fitBounds([ // Bbox au format Leaflet
		[bboxs[1], bboxs[0]], // South West
		[bboxs[3], bboxs[2]]  // North East
	]);
<?}else{?>
	map.setView([45.6, 6.7], 6);
<?}?>

	var ctrlLayers = new L.Control.Layers(baseLayers).addTo(map); // Le controle de changement de couche de carte avec la liste des cartes dispo
	new L.Control.Permalink({text: 'Permalink', layers: ctrlLayers}).addTo(map);
	new L.Control.Scale().addTo(map);
	new L.Control.Coordinates().addTo(map);
	new L.Control.OSMGeocoder().addTo(map);

	<?if ( $vue->mode_affichage != 'zone' ){?>
		new L.Control.Gps().addTo(map);
		var fl = L.Control.fileLayerLoad().addTo(map);
	<?}
	if ( $vue->mode_affichage == 'edit' ){?>
		// Editeur et aide de l'éditeur
		var edit = new L.Control.PolylineEditor({
			idInput: 'contour_polygone',
			idChange: 'changed',
			submit: 'Enregistrer',
		})
		fl.loader.on ('data:loaded', function (args){
			edit.addEdit(args.layer);
			edit.elChange.style.display = '';
		}, fl);

		map.addControl(edit);
		document.getElementById('help-edit').innerHTML = '<p>'+map.editor.options.help.join('.</p><p>') + map.editor.options.submit+'.</p>';
	<?}?>
});
/*************************************************************************************************************************************/
function switch_massif (combo) {
    if (combo.checked) {
        document.getElementById ('titrepage') .firstChild.nodeValue = "<?echo addslashes($vue->titre)?>"; 
		map.addLayer(massifLayer);
		map.removeLayer(poiLayer);
		map.addLayer(poiLayer = poiMassif);
    } else {
        document.getElementById ('titrepage') .firstChild.nodeValue = "Navigation sur les cartes"; 
		map.removeLayer(massifLayer);
		map.removeLayer(poiLayer);
		map.addLayer(poiLayer = poiBbox);
    }
}
/*************************************************************************************************************************************/
function maj_carte () {
    // Calcule l'argument d'extration filtre de points
    var poitypes = document.getElementsByName ('id_point_type[]');
    var listePoints = '';
    for (var i=0; i < poitypes.length; i++)
        if (poitypes[i].checked)
            listePoints += (listePoints ? ',' : '') + poitypes[i].value;

    // L'écrit dans un cookie pour se les rappeler auprochain affichage de cette page
    document.cookie = 'liste_id_point_type=' + escape (listePoints) + ';path=/';
	poiLayer.reload({
				type_points: listePoints,
				massif: arg_massifs
	});
}
/*************************************************************************************************************************************/
function couche_externe(e,l) {
	if(e.checked)
		map.addLayer(l);
	else
		map.removeLayer(l);
}
// Pour bien gérer le retour sur la page sous chrome
window.addEventListener('load', function() {
	var extLayersCheckbox = {poiPRC:poiPRC, poiC2C:poiC2C, poiCHEM:poiCHEM};
	for (var c in extLayersCheckbox) {
		var ce = document.getElementById (c);
		if (ce && ce.checked)
			couche_externe(ce, extLayersCheckbox[c]);
	}
});
