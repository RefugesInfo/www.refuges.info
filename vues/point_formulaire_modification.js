<?// Script lié à la page de modification de fiche

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config les données communes à tout WRI
?>

var map, viseur, gps;

window.addEventListener('load', function() {
	var baseLayers = {
		'Refuges.info':new L.TileLayer.OSM.MRI(),
		'OSM fr':      new L.TileLayer.OSM.FR(),
		'Outdoors':    new L.TileLayer.OSM.Outdoors(),
		'Photo Bing':  new L.BingLayer('<?=$config['bing_key']?>', {type:'Aerial'})
	};

	map = new L.Map('carte-edit');

	baseLayers['<?=$vue->fond_carte_par_defaut?>'].addTo(map); // Le fond de carte visible

	// Viseur déplaçable affichant sa position éditable.
	viseur = new L.Marker([46,6], {
		draggable: true,
		zIndexOffset: 1000, // Passe au dessus des autres pictos
		icon: L.icon({
			iconUrl: '<?=$config['sous_dossier_installation']?>images/viseur.png',
			iconAnchor: [15, 15]
		}),
	})
	.coordinates('viseur') // Lien avec le formulaire HTML
	.addTo(map);
	map.setView(viseur._latlng, 13, { // Recentre la carte sur ce viseur
		reset: true
	});

	new L.GeoJSON.Ajax( // Les points d'intérêt WRI
		'<?=$config['sous_dossier_installation']?>api/bbox',
		{
			argsGeoJSON: {
				type_points: 'all'
			},
			bbox: true,
			style: function(feature) {
				return {
					iconUrl: '<?=$config['sous_dossier_installation']?>images/icones/' + feature.properties.type.icone + '.png',
					iconAnchor: [8, 8],
					title: feature.properties.nom,
					popupAnchor: [-1, -9]
				};
			}
		}
	).addTo(map);

	var layerSwitcher = new L.Control.Layers(baseLayers).addTo(map); // Le controle de changement de couche de carte avec la liste des cartes dispo

	new L.Control.Permalink.Cookies({ // Garde la mémoire des position, zoom, carte
		layers: layerSwitcher,
		text: null // Mais le contrôle n'apparait pas sur la carte car ça n'a pas de sens pour un point
	}).addTo(map);

	new L.Control.Scale().addTo(map);
	new L.Control.Fullscreen().addTo(map);

	gps = new L.Control.Gps().addTo(map)
	gps.on('gpslocated', function(e) {
		viseur.setLatLng(e.latlng); // Déplacement du viseur
		e.target._map.setView(e.latlng, 16, {
			reset: true
		});
	});

	new L.Control.OSMGeocoder({
		position: 'topleft'
	}).addTo(map);
});

function affiche_et_set( el , affiche, valeur ) {
    document.getElementById(el).style.visibility = affiche ;
    document.getElementById(el).value = valeur ;
    return false;
}