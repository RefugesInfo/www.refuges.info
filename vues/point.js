<?// Script lié à la page point

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config les données communes à tout WRI

if ($vue->mini_carte) {
	include ($config['racine_projet'].'vues/includes/cartes.js');
	?>

	var map, layerSwitcher;

	map = new L.Map('carte-point', {
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

	var wriPoi = new L.GeoJSON.Ajax.wriPoi().addTo(map);
	new L.GeoJSON.Ajax.OSM.services({
		maxPoints: 30,
		services: {
			// <NOM ICONE> = '<REQUETTE OVERPASS>'
			hotel: '["tourism"~"hotel|camp_site|hostel|chalet"]',
			camping: '["tourism"~"camp_site"]',
			ravitaillement: '["shop"~"supermarket|convenience"]',
			parking: '["amenity"="parking"]["access"!="private"]',
			bus: '["highway"="bus_stop"]'
		},
	}).addTo(map);

	new L.Control.Scale().addTo(map);
	new L.Control.Coordinates().addTo(map);
	new L.Control.Fullscreen().addTo(map);
	new L.Control.Click(
		function () {
			return wriPoi._getUrl() + '&format=gpx&nb_points=all';
		}, {
			title: "Obtenir les points de refuges.info visibles sur la carte\n"+
					"Pour charger le fichier sur un GARMIN, utlisez Basecamp",
			label: '&#8659;'
		}
	).addTo(map);
	new L.Control.EasyPrint({title: 'Imprimer la carte'}).addTo(map);
	layerSwitcher = new L.Control.Layers.overflow(baseLayers).addTo(map); // Le controle de changement de couche de carte avec la liste des cartes dispo

	new L.Control.Permalink.Cookies({ // Garde la mémoire des position, zoom, carte.
		layers: layerSwitcher,
		text: null, // Le contrôle n'apparait pas sur la carte car ça n'a pas de sens pour un point qui positionne lui même la carte
		move: false // On n'initialise pas la carte avec le permalink: il est uniquement là pour enregistrer
	}).addTo(map);

	// Actions de la page
	function agrandir_carte_point() {
		// On masque le contrôle puisqu'il a déjà été activé
		var agrandir_vignette = document.getElementById('agrandir-carte-point');
		if (agrandir_vignette)
			agrandir_vignette.style.display = 'none';

		// On redimensionne la carte
		var mapp = document.getElementById('carte-point');
		var l1 = mapp.clientWidth,
			h1 = mapp.clientHeight;
		mapp.style.width = '40vw';
		mapp.style.height = '40vw';
		mapp.style.minWidth = l1+'px';
		mapp.style.minHeight = h1+'px';
		mapp.style.maxHeight = 2*h1+'px';
		var l2 = mapp.clientWidth,
			h2 = mapp.clientHeight;
		map.panBy(
			[(h1-h2)/2, (h1-h2)/2], // Remet le cadre au centre de la nouvelle carte plus grande
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

	<?php include ($config['racine_projet'].'vues/includes/meteo.js') ?>
<?}?>