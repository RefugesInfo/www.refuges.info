<?// Script lié à la page point

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config les données communes à tout WRI

if ($vue->mini_carte) {
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
		map = new L.Map('vignette', {
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
				new L.GeoJSON.Ajax( // Les points d'intérêt WRI
					'<?=$config['sous_dossier_installation']?>api/bbox', {
						argsGeoJSON: {
							type_points: 'all'
						},
						bbox: true,
						degroup: 12,
						url: function(feature) {
							return '<?=$config['sous_dossier_installation']?>point/' + feature.properties.id;
						},
						icon: function(feature) {
							return {
								url: '<?=$config['sous_dossier_installation']?>images/icones/' + feature.properties.type.icone + '.png',
								size: 16
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

		// On redimensionne la carte
		var mapp = document.getElementById('vignette'),
			l1 = mapp.clientWidth,
			h1 = mapp.clientHeight;
		mapp.id = 'vignette-agrandie';
		var l2 = mapp.clientWidth,
			h2 = mapp.clientHeight;
		map.panBy(
			[(l1-l2)/2, (h1-h2)/2], // Remet le cadre au centre de la nouvelle carte plus grande
			{animate: false}
		);

		// On positionne la couche de second choix
		var oldLayerId, newLayerId;
		for (l in layerSwitcher._layers) {
			if (map.hasLayer(layerSwitcher._layers[l].layer))
				oldLayerId = l;
			if (layerSwitcher._layers[l].name == '<?=$vue->vignette[2]?>')
				newLayerId = l;
		}
		if (oldLayerId && newLayerId && oldLayerId != newLayerId) {
			map.removeLayer(layerSwitcher._layers[oldLayerId].layer);
			map.addLayer(layerSwitcher._layers[newLayerId].layer);
		}
	}
<?}?>