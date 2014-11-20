<?// Script lié à la page de modification de fiche

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config les données communes à tout WRI
?>

var map, curseur;

window.addEventListener('load', function() {
	var baseLayers = {
		'Bing photo': new L.BingLayer(key.bing), // Idem type:'Aerial'
		'maps.refuges.info': L.tileLayer('http://maps.refuges.info/hiking/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a> & <a href="http://wiki.openstreetmap.org/wiki/Hiking/mri">MRI</a>'
                }),
                'Outdoors': L.tileLayer('http://{s}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a> & <a href="http://www.thunderforest.com">Thunderforest</a>'
                }),
                'OpenStreetMap': L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a>'
                }),
	};

	map = new L.Map('carte-edit', {
		fullscreenControl: true,
		center: new L.LatLng( <?=$vue->point->latitude?> , <?=$vue->point->longitude?>),
		zoom: 13,
		layers: [
			baseLayers['Bing photo'], // Le fond de carte visible

			new L.GeoJSON.ajax( // Les points d'intérêt WRI
				'<?=$config['sous_dossier_installation']?>exportations/exportations.php?format=geojson', {
					bbox: true,
					icon: function(feature) {
						return {
							url: '/images/icones/' + feature.properties.type + '.png',
							size: L.Browser.mobile ? 32 : 16
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
	map.addControl(new L.Control.Gps());
	map.addControl(new L.Control.Scale());
});
