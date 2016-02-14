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
	type_points = '<?=$_COOKIE['type_points'] ? $_COOKIE['type_points'] : ''?>',
	arg_massifs = '<?=$vue->polygone->id_polygone?>',
	layerSwitcher,
	baseLayers = {
		'Refuges.info':new L.TileLayer.OSM.MRI(),
		'OSM fr':      new L.TileLayer.OSM.FR(),
		'Outdoors':    new L.TileLayer.OSM.Outdoors(),
		'IGN':         new L.TileLayer.IGN({k: '<?=$config['ign_key']?>', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS'}),
		'IGN Express': new L.TileLayer.IGN({k: '<?=$config['ign_key']?>', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'}),
		'SwissTopo':   new L.TileLayer.SwissTopo({l:'ch.swisstopo.pixelkarte-farbe'}),
		'Autriche':    new L.TileLayer.Kompass({l:'Touristik'}),
		'Espagne':     new L.TileLayer.WMS.IDEE(),
		'Italie':      new L.TileLayer.WMS.IGM(),
		'Angleterre':  new L.TileLayer.OSOpenSpace('<?=$config['os_key']?>', {}),
		'Photo Bing':  new L.BingLayer('<?=$config['bing_key']?>', {type:'Aerial'}),
		'Photo IGN':   new L.TileLayer.IGN({k: '<?=$config['ign_key']?>', l:'ORTHOIMAGERY.ORTHOPHOTOS'})
	},

<?if ( $vue->mode_affichage == 'edit' ){?>
	// Dessine tous les massifs pour servir de gabari au nouveau
	massifLayer = new L.GeoJSON.Ajax(
		'<?=$config['sous_dossier_installation']?>api/polygones', {
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
					fillOpacity: 0
				}
			}
		}
	),
<?}else if ( $vue->mode_affichage == 'zone' ){?>
	// Affiche tous les massifs d'une zone (en différentes couleurs)
	massifLayer = new L.GeoJSON.Ajax(
		'<?=$config['sous_dossier_installation']?>api/polygones', {
			argsGeoJSON: {
				type_polygon: 1,
				intersection: '<?=$vue->polygone->id_polygone?>'
			},
			style: function(feature) {
				return {
					title: feature.properties.nom,
					popupAnchor: [-1, -4],
					url: feature.properties.lien,
					color: 'black',
					fillColor: feature.properties.couleur,
					weight: 1,
					fillOpacity: 0.3
				}
			}
		}
	),
<?}else{?>
	// Affiche le contour d'un seul massif 
	massifLayer = new L.GeoJSON.Ajax(
		'<?=$config['sous_dossier_installation']?>api/polygones', {
			argsGeoJSON: {
				massif: '<?=$vue->polygone->id_polygone?>',
				type_geom: 'polylines', // La surface à l'intérieur des massifs reste cliquable
			},
			style: function(feature) {
				return {
					color: 'blue',
					weight: 2,
					opacity: 1,
					fillOpacity: 0
				}
			}
		}
	),
<?}?>

	poiWRI = new L.GeoJSON.Ajax( // Les points d'intérêt WRI
		'<?=$config['sous_dossier_installation']?>api/bbox',
		{
			argsGeoJSON: {
				type_points: type_points
			},
			bbox: true,
			style: function(feature) {
				var prop = [];
				if (feature.properties.coord.alt)
					prop.push (feature.properties.coord.alt+'m');
				if (feature.properties.places.valeur)
					prop.push (feature.properties.places.valeur+'<img src="<?=$config['sous_dossier_installation']?>images/lit.png"/>');
				return {
					url: feature.properties.lien,
					iconUrl: '<?=$config['sous_dossier_installation']?>images/icones/' + feature.properties.type.icone + '.png',
					iconAnchor: [8, 8],
					title: feature.properties.nom +
						(prop.length
							? '<div style=text-align:center>'+prop.join(' ')+'</div>'
							: ''
						),
					popupAnchor: [-1, -9],
					degroup: 12 // Spread the icons when the cursor hover on a busy area.
				};
			}
		}
	),

	// Points de http://www.pyrenees-refuges.com dédoublés par chemineur.fr
	poiPRC = new L.GeoJSON.Ajax(
		'http://v2.chemineur.fr/prod/chem/json.php', {
			argsGeoJSON: {
				site: 'prc',
			},
			degroup: 12,
			bbox: true,
			style: function(feature) {
				return {
					title: feature.properties.nom,
					popupAnchor: [-1, -9],
					url: 'http://www.pyrenees-refuges.com/fr/affiche.php?numenr=' + feature.properties.id,
					iconUrl: 'http://v2.chemineur.fr/prod/chemtype/' + feature.properties.type.icone + '.png',
					iconAnchor: [8, 8]
				}
			}
		}
	),
	// Points de http://www.camptocamp.org dédoublés par chemineur.fr
	poiC2C = new L.GeoJSON.Ajax(
		'http://v2.chemineur.fr/prod/chem/json.php', {
			argsGeoJSON: {
				site: 'c2c',
			},
			degroup: 12,
			bbox: true,
			style: function(feature) {
				return {
					title: feature.properties.nom,
					popupAnchor: [-1, -9],
					url: 'http://www.camptocamp.org/huts/' + feature.properties.id,
					iconUrl: 'http://v2.chemineur.fr/prod/chemtype/' + feature.properties.type.icone + '.png',
					iconAnchor: [8, 8]
				}
			}
		}
	),
	// Autres points de http://chemineur.fr
	poiCHEM = new L.GeoJSON.Ajax(
		'http://v2.chemineur.fr/prod/chem/json.php', {
			degroup: 12,
			bbox: true,
			style: function(feature) {
				return {
					title: feature.properties.nom,
					popupAnchor: [-1, -9],
					url: 'http://chemineur.fr/point/' + feature.properties.id,
					iconUrl: 'http://v2.chemineur.fr/prod/chemtype/' + feature.properties.type.icone + '.png',
					iconAnchor: [8, 8]
				}
			}
		}
	),

	// Les points d'intérêt WRI pour 1 massif
	poiMassif = new L.GeoJSON.Ajax(
		'<?=$config['sous_dossier_installation']?>api/massif', {
			argsGeoJSON: {
				type_points: type_points,
				massif: arg_massifs
			},
			bbox: true,
			style: function(feature) {
				var prop = [];
				if (feature.properties.coord.alt)
					prop.push (feature.properties.coord.alt+'m');
				if (feature.properties.places.valeur)
					prop.push (feature.properties.places.valeur+'<img src="<?=$config['sous_dossier_installation']?>images/lit.png"/>');
				return {
					url: feature.properties.lien,
					iconUrl: '<?=$config['sous_dossier_installation']?>images/icones/' + feature.properties.type.icone + '.png',
					iconAnchor: [8, 8],
					title: feature.properties.nom +
						(prop.length
							? '<div style=text-align:center>'+prop.join(' ')+'</div>'
							: ''
						),
					popupAnchor: [-1, -9],
					degroup: 12 // Spread the icons when the cursor hover on a busy area.
				};
			}
		}
	),

	poiLayer = <?if ( $vue->polygone->id_polygone ) {?>poiMassif<?}else{?>poiWRI<?}?>;

window.addEventListener('load', function() {
	map = new L.Map('nav_bloc_carte', {
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

	map.setView([45.6, 6.7], 6);
	new L.Control.Permalink.Cookies({
		text: 'Permalien',
		layers: new L.Control.Layers(baseLayers).addTo(map) // Le controle de changement de couche de carte avec la liste des cartes dispo
	}).addTo(map);

<?if ( $vue->polygone->bbox ){?>
	var bboxs = [<?=$vue->polygone->bbox?>]; // BBox au format Openlayers [left, bottom, right, top] = [west, south, east, north]
	map.fitBounds([ // Bbox au format Leaflet
		[bboxs[1], bboxs[0]], // South West
		[bboxs[3], bboxs[2]]  // North East
	]);
<?}?>

	new L.Control.Scale().addTo(map);
	new L.Control.Coordinates().addTo(map);

	<?if ( $vue->mode_affichage != 'zone' ){?>
		new L.Control.Fullscreen().addTo(map);
		new L.Control.OSMGeocoder({
			position: 'topleft'
		}).addTo(map);
		new L.Control.Gps().addTo(map);
		var fl = L.Control.fileLayerLoad().addTo(map);
	<?}
	if ( $vue->mode_affichage == 'edit' ){?>
		// Editeur et aide de l'éditeur
		var edit = new L.Control.Draw.Plus({
			draw: {
				polygon: true
			},
			edit: {
				remove: true
			},
			editType: 'MultiPolygon', // Force le format de sortie geoGson
		}).addTo(map);
		fl.loader.on ('data:loaded', function (args){
			this._map.fire('draw:created', { // Rend la trace éditable
				layer: args.layer
			});
		}, fl);
		
		massifLayer.addTo(edit.snapLayers); // Permet de "coller" aux tracés des autres massifs
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
		map.addLayer(poiLayer = poiWRI);
    }
}
/*************************************************************************************************************************************/
function maj_carte () {
    // Calcule l'argument d'extration filtre de points
    var poitypes = document.getElementsByName ('id_point_type[]');
    type_points = '';
    for (var i=0; i < poitypes.length; i++)
        if (poitypes[i].checked)
            type_points += (type_points ? ',' : '') + poitypes[i].value;

    // L'écrit dans un cookie pour se les rappeler au prochain affichage de cette page
    document.cookie = 'type_points=' + escape (type_points) + ';path=/';

	// On reparamètre les couches POI
	poiWRI.options.argsGeoJSON.type_points = 
	poiMassif.options.argsGeoJSON.type_points =
		type_points;

	// Et on réaffiche la couche courante
	poiLayer.reload();
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
