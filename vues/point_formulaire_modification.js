<?// Script lié à la page de modification de fiche

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config_wri les données communes à tout WRI

include ($config_wri['racine_projet'].'vues/includes/cartes.js');
?>

var map = new L.Map('carte-edit'),
	viseur,
	gps,
	baseLayers = {
		'Refuges.info':new L.TileLayer.OSM.MRI(),
		'OSM fr':      new L.TileLayer.OSM.FR(),
		'Outdoors':    new L.TileLayer.OSM.Outdoors(),
		'Photo Bing':  new L.BingLayer('<?=$config_wri['bing_key']?>', {type:'Aerial'})
	};
baseLayers['<?=$vue->fond_carte_par_defaut?>'].addTo(map); // Le fond de carte visible

// Viseur déplaçable affichant sa position éditable.
viseur = new L.Marker([], {
	draggable: true,
	zIndexOffset: 1000, // Passe au dessus des autres pictos
	icon: L.icon({
		iconUrl: '<?=$config_wri['sous_dossier_installation']?>images/viseur.png',
		className: 'leaflet-move',
		iconAnchor: [15, 15]
	}),
})
	.coordinates('viseur') // Lien avec le formulaire HTML
	.addTo(map);

map.setView(viseur._latlng, 13, { // Recentre la carte sur ce viseur
	reset: true
});

new L.GeoJSON.Ajax.wriPoi ({ // Les points d'intérêt WRI, style simplifié
	style: function(feature) {
		return {
			iconUrl: '<?=$config_wri['sous_dossier_installation']?>images/icones/' + feature.properties.type.icone + '.png',
			className: 'leaflet-grab',
			iconAnchor: [8, 8],
			popup: feature.properties.nom
		};
	}
}).addTo(map);

var layerSwitcher = new L.Control.Layers(baseLayers).addTo(map); // Le controle de changement de couche de carte avec la liste des cartes dispo

new L.Control.Scale().addTo(map);
new L.Control.Fullscreen().addTo(map);

gps = new L.Control.Gps().addTo(map)
gps.on('gps:located', function(e) {
	viseur.setLatLng(e.latlng); // Déplacement du viseur
	e.target._map.setView(e.latlng, 16, {
		reset: true
	});
});

new L.Control.OSMGeocoder({
	position: 'topleft'
}).addTo(map);

function affiche_et_set( el , affiche, valeur ) {
    document.getElementById(el).style.visibility = affiche ;
    document.getElementById(el).value = valeur ;
    return false;
}