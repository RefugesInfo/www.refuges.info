<?// Script lié à la page de modification de fiche

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config les données communes à tout WRI
?>

var map, curseur, gps;

window.addEventListener('load', function() {
	var baseLayers = {
			'Refuges.info':new L.TileLayer.OSM.MRI(),
			'OSM fr':      new L.TileLayer.OSM.FR(),
			'Outdoors':    new L.TileLayer.OSM.Outdoors(),
			'SwissTopo':   new L.TileLayer.SwissTopo(),
			'Autriche':    new L.TileLayer.OSM.OB.Touristik(),
			'Espagne':     new L.TileLayer.WMS.IDEE(),
			'Italie':      new L.TileLayer.WMS.IGM(),
			'Angleterre':  new L.TileLayer.OSOpenSpace(key.os,{}),
			'Photo Bing':  new L.BingLayer(key.bing)
		};

	map = new L.Map('carte-edit', {
		fullscreenControl: true,
		center: new L.LatLng( <?=$vue->point->latitude?> , <?=$vue->point->longitude?>),
		zoom: 13,
		layers: [
					baseLayers['<?=$vue->fond_carte_par_defaut?>'], // Le fond de carte visible

			new L.GeoJSON.Ajax( // Les points d'intérêt WRI
				'<?=$config['sous_dossier_installation']?>api/bbox', {
					argsGeoJSON: {
						type_points: 'all'
					},
					bbox: true,
					degroup: 12,
					icon: function(feature) {
						return {
							url: '<?=$config['sous_dossier_installation']?>images/icones/' + feature.properties.type.icone + '.png',
							size: 16
						}
					}
				}
			),

			curseur = new L.Marker.Position( // Le pointeur à déplacer
				new L.LatLng(<?=$vue->point->latitude?>, <?=$vue->point->longitude?>), {
					prefixe: 'curseur-',
					draggable: true,
					riseOnHover: true, // The marker will get on top of others when you hover the mouse over it.
					icon: L.icon({
						iconUrl: '<?=$config['sous_dossier_installation']?>images/curseur.png',
						iconSize: [30, 30],
						iconAnchor: [15, 15]
					}),
				}
			)
		],
	});

	map.addControl(new L.Control.Layers(baseLayers)); // Le controle de changement de couche de carte avec la liste des cartes dispo
	gps = new L.Control.Gps();
	map.addControl(gps);
	gps.on ('gpslocated', function (args){
		curseur.setLatLng(args.latlng);
		gps.deactivate();
	});
	map.addControl(new L.Control.Scale());
	L.Control.fileLayerLoad().addTo(map);
	new L.Control.OSMGeocoder().addTo(map);
});

function affiche_et_set( el , affiche, valeur ) {
    document.getElementById(el).style.visibility = affiche ;
    document.getElementById(el).value = valeur ;
    return false;
}