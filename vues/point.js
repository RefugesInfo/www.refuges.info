<?// Script lié à la page point

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config les données communes à tout WRI
?>

var map, layerSwitcher;

window.addEventListener('load', function() {
	var baseLayers = {
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
	};
	map = new L.Map.MultiCRS('vignette', {
		fullscreenControl: true,
		center: new L.LatLng(<?=$vue->point->latitude?> , <?=$vue->point->longitude?>),
		zoom: 13,
		layers: [
			baseLayers['<?=$config["carte_base"]?>'], // Le fond de carte visible
			new L.Marker.Position(
				new L.LatLng(<?=$vue->point->latitude?>, <?=$vue->point->longitude?>), { // Un cadre
					icon: L.icon({
						iconUrl: '<?=$config['sous_dossier_installation']?>images/cadre.png',
						iconSize: [31, 43],
						iconAnchor: [15, 21]
					}),
				}
			),
			new L.GeoJSON.ajax( // Les points d'intérêt WRI
				'<?=$config['sous_dossier_installation']?>exportations/exportations.php', {
					argsGeoJson: {format: 'geojson'},
					bbox: true,
					icon: function(feature) {
						return {
							url: '<?=$config['sous_dossier_installation']?>images/icones/' + feature.properties.type + '.png',
							size: L.Browser.mobile ? 32 : 16
						}
					}
				}
			)
		]
	});

	layerSwitcher = L.control.layers(baseLayers).addTo(map); // Le controle de changement de couche de carte avec la liste des cartes dispo
	map.addControl(new L.Control.Scale());
});

// Actions de la page
function agrandir_vignette() {

	// On masque le contrôle puisqu'il a déjà été activé
	var agrandir_vignette = document.getElementById('agrandir_vignette');
	if (agrandir_vignette)
		agrandir_vignette.style.display = 'none';

	// On redimensionne ca carte
	var mapp = document.getElementById('vignette'),
		centre = map.getCenter();
	mapp.style.width = mapp.style.height = '400px';
	map.panBy([-60, -60], {
		animate: false
	});

	// On positionne la couche de second choix
	var oldLayerId, newLayerId;
	for (l in layerSwitcher._layers) {
		if (map.hasLayer(layerSwitcher._layers[l].layer))
			oldLayerId = l;
		if (layerSwitcher._layers[l].name == '<?=$vue->vignette[2]?>')
			newLayerId = l;
	}
	if (oldLayerId && newLayerId) {
		map.removeLayer(layerSwitcher._layers[oldLayerId].layer);
		map.addLayer(layerSwitcher._layers[newLayerId].layer);
	}
}