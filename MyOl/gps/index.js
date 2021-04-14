/** PWA area */
// Force https to allow web apps and geolocation
if (window.location.protocol == 'http:' && window.location.host != 'localhost')
	window.location.href = window.location.href.replace('http:', 'https:');

// Force the script name of short url
if (!window.location.pathname.split('/').pop())
	window.location.href = window.location.href + 'index.php';

// Load service worker for web application install & updates
if ('serviceWorker' in navigator)
	navigator.serviceWorker.register(
		typeof service_worker === 'undefined' ? 'service-worker.js' : service_worker,
		typeof scope === 'undefined' ? {} : {
			scope: scope, // Max scope. Allow service worker to be in a different directory
		}
	)
	// Reload if the service worker md5 (including the total files key) has changed
	.then(function(reg) {
		reg.addEventListener('updatefound', function() {
			location.reload();
		});
	});

/** Openlayers map area */
const nbli = document.getElementsByTagName('li').length,
	elListe = document.getElementById('liste'),

	help = 'Pour utiliser les cartes et le GPS hors réseau :\n' +
	'Avant le départ :\n' +
	'- Enregistrez un marque-page ou installez l‘application web (explorateur -> options -> ajouter à l‘écran d‘accueil)\n' +
	'- Choisissez une couche de carte\n' +
	'- Placez-vous au point de départ de votre randonnée\n' +
	'- Zoomez au niveau le plus détaillé que vous voulez mémoriser\n' +
	'- Déplacez-vous suivant le trajet de votre randonnée suffisamment lentement pour charger toutes les dalles\n' +
	'- Recommencez avec les couches de cartes que vous voulez mémoriser\n' +
	'* Toutes les dalles visualisées une fois seront conservées dans le cache de l‘explorateur quelques jours\n' +
	'Hors réseau :\n' +
	'- Ouvrez votre marque-page ou votre application\n' +
	'- Si vous avez un fichier .gpx dans votre mobile, visualisez-le en cliquant sur ▲\n' +
	'* Fonctionne bien sur Android avec Chrome, Edge, Samsung Internet, fonctions réduites avec Firefox & Safari\n' +
	'* Cette application ne permet pas d‘enregistrer le parcours\n' +
	'* Aucune donnée ni géolocalisation n‘est remontée ni mémorisée',

	controls = [
		controlTilesBuffer(4),
		controlLayersSwitcher({
			baseLayers: layersCollection(),
		}),
		controlPermalink(),

		new ol.control.Attribution({
			collapseLabel: '>',
		}),
		new ol.control.ScaleLine(),
		controlMousePosition(),
		controlLengthLine(),

		new ol.control.Zoom(),
		new ol.control.FullScreen({
			label: '', //HACK Bad presentation on IE & FF
			tipLabel: 'Plein écran',
		}),
		controlGeocoder(),
		controlGPS(),

		!nbli ? noControl() :
		controlButton({
			label: '\u25B3',
			title: 'Choisir une trace dans la liste / fermer',
			activate: function() {
				if (elListe)
					elListe.style.display = elListe.style.display == 'none' ? 'block' : 'none';
				window.scrollTo(0, 0);
				if (document.fullscreenElement)
					document.exitFullscreen();
			},
		}),
		controlLoadGPX(),
		controlDownload(),
		controlButton({
			label: '?',
			title: help,
			activate: function() {
				alert(this.title);
			},
		}),
	],

	map = new ol.Map({
		target: 'map',
		controls: controls,
	});

function addLayer(url) {
	const layer = layerVectorURL({
		url: url,
		format: new ol.format.GPX(),
		receiveFeatures: function(features) {
			map.getView().setZoom(1); //HACK enable gpx rendering anywhere we are
			return features;
		},
	});

	// Zoom the map on the added features
	layer.once('prerender', function() {
		const features = layer.getSource().getFeatures(),
			extent = ol.extent.createEmpty();
		for (let f in features)
			ol.extent.extend(extent, features[f].getGeometry().getExtent());
		map.getView().fit(extent, {
			maxZoom: 17,
			size: map.getSize(),
			padding: [5, 5, 5, 5],
		});
	});

	map.addLayer(layer);

	if (elListe)
		elListe.style.display = 'none';
}