<?// Script lié à la page point

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config les données communes à tout WRI

if ($vue->mini_carte) { ?>
	var map, layerSwitcher;

	window.addEventListener('load', function() {
		<?php include ($config['racine_projet'].'vues/includes/cartes.js') ?>

		map = new L.Map('vignette', {
			layers: [
				baseLayers['<?=$vue->vignette[0]?>'] || // Le fond de carte assigné à cette région par $config['fournisseurs_fond_carte']
				baseLayers['<?=$config["carte_base"]?>'] || // Sinon le fond de carte par défaut
				baseLayers[Object.keys(baseLayers)[0]] // Sinon la première couche définie
			]
		});

		// Cadre fixe marquant une position;
		var cadre = new L.Marker([<?=$vue->point->latitude?>,<?=$vue->point->longitude?>], {
			clickable: false, // Evite d'activer le curseur: pointeur
			icon: L.icon({
				iconUrl: '<?=$config['sous_dossier_installation']?>images/cadre.png',
				iconAnchor: [15, 21]
			})
		})
		.coordinates('position') // Affiche les coordonnées du cadre dans les éléments HTML id=position-*
		.addTo(map);

		map.setView(cadre._latlng, 13, {reset: true});

		new L.GeoJSON.Ajax.wriPoi().addTo(map);
		new L.GeoJSON.Ajax.OSM.services({
			services: {
				tourism: 'hotel|camp_site',
				shop: 'supermarket|convenience',
				amenity: 'parking'
			},
		}).addTo(map);

		new L.Control.Scale().addTo(map);
		new L.Control.Coordinates().addTo(map);
		new L.Control.Fullscreen().addTo(map);
		layerSwitcher = new L.Control.Layers.autoHeight(baseLayers).addTo(map); // Le controle de changement de couche de carte avec la liste des cartes dispo

		new L.Control.Permalink.Cookies({ // Garde la mémoire des position, zoom, carte.
			layers: layerSwitcher,
			text: null, // Le contrôle n'apparait pas sur la carte car ça n'a pas de sens pour un point qui positionne lui même la carte
			move: false // On n'itialise pas la carte avec le permalink: il est uniquement là pour enregistrer
		}).addTo(map);
	});

	// Actions de la page
	function agrandir_vignette() {
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

	<?php include ($config['racine_projet'].'vues/includes/meteo.js') ?>
<?}?>