<?// Script lié à la page point

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config_wri les données communes à tout WRI

if ($vue->mini_carte) {
	include ($config_wri['racine_projet'].'vues/includes/cartes.js');
	?>

	var map, layerSwitcher;

	map = new L.Map('carte-point', {
		layers: [
			baseLayers['<?=$vue->vignette[0]?>'] || // Le fond de carte assigné à cette région par $config_wri['fournisseurs_fond_carte']
			baseLayers['<?=$config_wri["carte_base"]?>'] || // Sinon le fond de carte par défaut
			baseLayers[Object.keys(baseLayers)[0]] // Sinon la première couche définie
		]
	});

	// Cadre fixe marquant une position;
	var cadre = new L.Marker([<?=$vue->point->latitude?>,<?=$vue->point->longitude?>], {
		icon: L.icon({
			iconUrl: '<?=$config_wri['sous_dossier_installation']?>images/cadre.png',
			className: 'leaflet-grab',
			iconAnchor: [15, 21]
		})
	})
	.coordinates('position') // Affiche les coordonnées du cadre dans les éléments HTML id=position-*
	.addTo(map);

	map.setView(cadre._latlng, 13, {reset: true});

	var wriPoi = new L.GeoJSON.Ajax.wriPoi().addTo(map);

	new L.Control.Scale().addTo(map);
	new L.Control.Coordinates().addTo(map);
	new L.Control.Fullscreen().addTo(map);
	new L.Control.Click(
		function () {
			return wriPoi._getUrl() + '&format=gpx_garmin&nb_points=all';
		}, {
			title: "Obtenir les points de refuges.info visibles sur la carte\n"+
					"Pour charger le fichier sur un GARMIN, utilisez Basecamp",
			label: '&#8659;'
		}
	).addTo(map);
	new L.Control.EasyPrint({title: 'Imprimer la carte'}).addTo(map);
	layerSwitcher = new L.Control.Layers(baseLayers).addTo(map); // Le controle de changement de couche de carte avec la liste des cartes dispo

	new L.Control.Permalink.Cookies({ // Garde la mémoire des position, zoom, carte.
		layers: layerSwitcher,
		text: null, // Le contrôle n'apparait pas sur la carte car ça n'a pas de sens pour un point qui positionne lui même la carte
		move: false // On n'initialise pas la carte avec le permalink: il est uniquement là pour enregistrer
	}).addTo(map);

	<?php include ($config_wri['racine_projet'].'vues/includes/meteo.js') ?>
<?}?>
