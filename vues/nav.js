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
			'maps.refuges.info': L.tileLayer('http://maps.refuges.info/hiking/{z}/{x}/{y}.png', {
				attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a> & <a href="http://wiki.openstreetmap.org/wiki/Hiking/mri">MRI</a>'
			}),
			'Outdoors': L.tileLayer('http://{s}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png', {
				attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a> & <a href="http://www.thunderforest.com">Thunderforest</a>'
			}),
			'OpenStreetMap': L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
				attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a>'
			}),
			'IGN': new L.TileLayer.IGN(),
			'IGN Topo': new L.TileLayer.IGN('GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.STANDARD'),
			'IGN Classique': new L.TileLayer.IGN('GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'),
			'SwissTopo': new L.TileLayer.SwissTopo(),
			'Espagne': new L.TileLayer.WMS.IDEE(),
			'Italie': new L.TileLayer.WMS.IGM(),
			'Photo': new L.BingLayer(key.bing), // Idem type:'Aerial'
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
			url: function(feature) {
				return feature.properties.lien;
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
			url: function(feature) {
				return '<?=$config['sous_dossier_installation']?>point/' + feature.properties.id;
			},
			icon: function(feature) {
				return {
					url: '<?=$config['sous_dossier_installation']?>images/icones/' + feature.properties.type.icone + '.png'
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
			url: function(feature) {
				return '<?=$config['sous_dossier_installation']?>point/' + feature.properties.id;
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
		center: new L.LatLng(45.6, 6.7),
		zoom: 6,
		layers: [
			baseLayers[L.UrlUtil.queryParse(L.UrlUtil.hash()).layer] // Donné par le permalink #layer=NOM
			|| baseLayers['<?=$config["carte_base"]?>'], // Sinon le fond de carte par défaut
			massifLayer,
<?if ( !$vue->mode_affichage ){?>
			poiLayer
<?}?>
		]
	});
	new L.Control.OSMGeocoder().addTo(map);
<?if ( $vue->polygone->bbox ){?>
	var bboxs = [<?=$vue->polygone->bbox?>]; // BBox au format Openlayers
	map.fitBounds([
		[bboxs[3], bboxs[0]], // Bbox au format Leaflet
		[bboxs[1], bboxs[2]]
	]);
<?}?>

	var ctrlLayers = new L.Control.Layers(baseLayers).addTo(map); // Le controle de changement de couche de carte avec la liste des cartes dispo
	new L.Control.Permalink({text: 'Permalink', layers: ctrlLayers}).addTo(map);
	new L.Control.Scale().addTo(map);
	new L.Control.Coordinates().addTo(map);

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
