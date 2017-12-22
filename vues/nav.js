<?// Code Javascript de la page des cartes

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config_wri les données communes à tout WRI

include ($config_wri['racine_projet'].'vues/includes/cartes.js');
?>

var map,
	wriPoi, wriMassif, poiLayer, massifLayer,
	poiCHEM, poiOVER, poiPRC, poiC2C;

// Les massifs ou contours de massifs
massifLayer = new L.GeoJSON.Ajax(
	'<?=$config_wri['sous_dossier_installation']?>api/polygones', {
		argsGeoJSON: {
			type_polygon: 1,
<?if ($vue->mode_affichage == 'zone') {?>
	// Affiche tous les massifs d'une zone (en différentes couleurs)
			intersection: '<?=$vue->polygone->id_polygone?>',
<?}else{?>
			type_geom: 'polylines', // La surface à l'intérieur des massifs reste cliquable
<?}
if (!$vue->mode_affichage) {?>
			massif: '<?=$vue->polygone->id_polygone?>', // Affiche le contour d'un seul massif 
<?}?>
			time: <?=time()?> // Inhibe le cache
		},
		style: function(feature) {
			return {
				color: 'blue',
				weight: 2,
				fillOpacity: 0,
<?if ($vue->mode_affichage == 'zone') {?>
				popup: feature.properties.nom,
				url: feature.properties.lien,
				color: 'black',
				weight: 1,
				fillColor: feature.properties.couleur,
				fillOpacity: 0.3,
<?}?>
				opacity: 0.6
			}
		}
	}
);

// Points WRI
wriPoi = new L.GeoJSON.Ajax.wriPoi({ // Les points choisis sur toute la carte
	argsGeoJSON: {
		type_points: '<?=$_COOKIE['type_points'] ? $_COOKIE['type_points'] : ''?>'
	}
});
wriMassif = new L.GeoJSON.Ajax.wriPoi({ // Seulement les points dans un massif
	urlGeoJSON: '<?=$config_wri['sous_dossier_installation']?>api/massif',
	argsGeoJSON: {
		type_points: null,
		massif: '<?=$vue->polygone->id_polygone?>'
	},
	disabled: !wriPoi.options.argsGeoJSON
});

// Points via chemineur.fr
poiCHEM = new L.GeoJSON.Ajax.chem();
poiPRC = new L.GeoJSON.Ajax.chem({
	argsGeoJSON: {
		site: 'pyrenees-refuges',
		poi: '3,8,16,20,23,28,30,40,44,64,58,62'
	},
	idAjaxStatus: 'ajax-poiPRC-status',
	urlRootRef: 'http://www.pyrenees-refuges.com/fr/affiche.php?numenr='
});
poiC2C = new L.GeoJSON.Ajax.chem({
	argsGeoJSON: {
		site: 'camptocamp',
		poi: '3,8,16,20,23,28,30,40,44,64,58,62'
	},
	idAjaxStatus: 'ajax-poiC2C-status',
	urlRootRef: 'https://www.camptocamp.org/huts/'
});

// Points OSM
poiOVER = new L.GeoJSON.Ajax.OSM.services();
poiLayer = <?if ( $vue->polygone->id_polygone ) {?>wriMassif<?}else{?>wriPoi<?}?>; // Couche active

map = new L.Map('carte-nav', {
	layers: [
			baseLayers[
<?if ($vue->mode_affichage == 'zone') {?>
				'Outdoors'
<?}else{?>
				'<?=$config_wri["carte_base"]?>'
<?}?>
			] || // Sinon le fond de carte par défaut
			baseLayers[Object.keys(baseLayers)[0]], // Sinon la première couche définie
		massifLayer
	]
});
map.setView([45.6, 6.7], 6); // Position par défaut

// Le controle de changement de couche de carte avec la liste des cartes dispo
var controlLayers = new L.Control.Layers(baseLayers).addTo(map);
<?if ($vue->mode_affichage != 'edit') {?>
	new L.Control.Permalink.Cookies({
		position: 'bottomright',
		text:
	<?if ($vue->mode_affichage == 'zone') {?>
			'',
	<?}else{?>
			'Permalien',
	<?}?>
		layers: controlLayers
	}).addTo(map);
<?}?>

// On zomm sur la carte à l'endroit qu'on veut montrer
// A mettre après le permalink puisque c'est une priorité
<?if ( $vue->polygone->bbox ){?>
var bboxs = [<?=$vue->polygone->bbox?>]; // BBox au format Openlayers [left, bottom, right, top] = [west, south, east, north]
map.fitBounds([ // Bbox au format Leaflet
	[bboxs[1], bboxs[0]], // South West
	[bboxs[3], bboxs[2]]  // North East
]);
<?}?>

new L.Control.Scale().addTo(map);

new L.Control.Coordinates({
	position:'bottomleft'
}).addTo(map);

<?if ( $vue->mode_affichage != 'zone' ){?>
	new L.Control.Fullscreen().addTo(map);

	new L.Control.OSMGeocoder({
		position: 'topleft'
	}).addTo(map);

	new L.Control.Gps().addTo(map);

	var fl = L.Control.fileLayerLoad().addTo(map);

	// Récupérations des points sous forme de fichier GPX
	new L.Control.Click(
		function () {
			return wriPoi._getUrl() + '&format=gpx&nb_points=all';
		}, {
			title: "Obtenir les points de refuges.info visibles sur la carte\n"+
					"Pour charger le fichier sur un GARMIN, utilisez Basecamp\n"+
					"Atention: le fichier peut être gros pour une grande carte",
			label: '&#8659;'
		}
	).addTo(map);

	// Impressions
	new L.Control.EasyPrint({title: 'Imprimer la carte'}).addTo(map);
<?}?>

<?if ( !$vue->mode_affichage ){?>
	poiLayer.addTo(map);
	poiOVER.addTo(map);
<?}?>

<?if ( $vue->mode_affichage == 'edit' ){?>
	// Force la sortie sous forme de MultiPolygon (converti les PolyLine en Polygon)
	// TODO: traiter le cas où il n'y a pas de Polygon et où la base devrait être geom=null
	//    PB: remonter un champ vide donne une erreur sur geom = ST_SetSRID(ST_GeomFromGeoJSON(''), 4326) 
	map.on('draw:entry-changed', function() {
		var ele = document.getElementById('edit-json');
		var geoJson = JSON.parse(ele.value);

		// Collecte les lonlat[] des polygones & polynines présents dans l'éditeur
		var p = [];
		for (f in geoJson.features)
			if (geoJson.features[f].geometry.coordinates[0].length > 2) // Polygon
				p.push(geoJson.features[f].geometry.coordinates);
			else // Polyline
				p.push([geoJson.features[f].geometry.coordinates]);

		// Referme chaque lonlat[] avant d'en faire des polygones
		for (i in p)
			for (j in p[i]) {
				var pij0 = p[i][j][0],
					pijn = p[i][j][p[i][j].length - 1];
				if (pij0[0] != pijn[0] && pij0[1] != pijn[1])
					p[i][j].push(p[i][j][0]);
			}

		ele.value = JSON.stringify({
			type: 'MultiPolygon',
			coordinates: p
		});
	});

	// Charge les traces importées dans l'éditeur
	fl.loader.on('data:loaded', function(args) {
		this._map.fire('draw:created', { // Rend la trace éditable
			layer: args.layer
		});
	}, fl);

	// Editeur et aide de l'éditeur
	var edit = new L.Control.Draw.Plus({
		draw: {
			polygon: true,
			polyline: true
		},
		edit: {
			remove: true
		}
	}).addTo(map);

	massifLayer.addTo(edit.snapLayers); // Permet de "coller" aux tracés des autres massifs
<?}?>
maj_poi(); // Initialise la coche [de]cocher

// Pour bien gérer le retour sur la page sous chrome
var extLayersCheckbox = {poiPRC:poiPRC, poiC2C:poiC2C, poiCHEM:poiCHEM};
for (var c in extLayersCheckbox) {
	var ce = document.getElementById (c);
	if (ce)
		maj_autres_site(ce, extLayersCheckbox[c]);
}

/*************************************************************************************************************************************/
function switch_massif (combo) {
    if (combo.checked) {
        document.getElementById ('titrepage') .firstChild.nodeValue = "<?echo addslashes($vue->titre)?>"; 
		map.addLayer(massifLayer);
		map.removeLayer(poiLayer);
		map.addLayer(poiLayer = wriMassif);
    } else {
        document.getElementById ('titrepage') .firstChild.nodeValue = "Navigation sur les cartes"; 
		map.removeLayer(massifLayer);
		map.removeLayer(poiLayer);
		map.addLayer(poiLayer = wriPoi);
    }
}

/*************************************************************************************************************************************/
function maj_poi (c) {
<?php if (!$vue->mode_affichage == 'edit') {?>
    // Calcule l'argument d'extration filtre de points
    var poitypes = document.getElementsByName ('point_type[]'),
		check_types = document.getElementsByName ('check-types-input'),
		allchecked = true;

    type_points = '';
    for (var i=0; i < poitypes.length; i++) {
		if (c && check_types.length)
			poitypes[i].checked = check_types[0].checked;
        if (poitypes[i].checked)
            type_points += (type_points ? ',' : '') + poitypes[i].value;
		else
			allchecked = false;
	}
	check_types[0].checked = allchecked;
    // L'écrit dans un cookie pour se les rappeler au prochain affichage de cette page
    document.cookie = 'type_points=' + escape (type_points) + ';path=/';

	// On reparamètre les couches POI
	wriPoi.options.argsGeoJSON.type_points = 
	wriMassif.options.argsGeoJSON.type_points =
		type_points;
	poiLayer.options.disabled = !type_points;

	// Et on réaffiche la couche courante
	poiLayer.reload();
<?}?>
}

/*************************************************************************************************************************************/
function maj_autres_site(e,l) {
	if(e.checked)
		map.addLayer(l);
	else
		map.removeLayer(l);
}
