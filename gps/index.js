// Force https to allow web apps and geolocation
if (window.location.protocol == 'http:')
	window.location.href = window.location.href.replace('http:', 'https:');

// Force the script name of short url
if (!window.location.pathname.split('/').pop())
	window.location.href = window.location.href + 'index.php';

// Load service worker for web application install & updates
if ('serviceWorker' in navigator)
	navigator.serviceWorker.register('service-worker.php')
	// Reload if any app file has been updated
	.then(function(reg) {
		reg.addEventListener('updatefound', function() {
			location.reload();
		});
	});

// Extract the generation ID from the first comment of the registered service-worker
var genId;
if (typeof fetch == 'function') // Exclude IE
	fetch('service-worker.php')
	.then(function(response) {
		return response.text();
	})
	.then(function(data) {
		genId = data.match(/[0-9]+/)[0];
	});

// Openlayers part
const help =
	'« Carré » : Passer en mode plein écran\n' +
	'« Loupe » : Recherche de lieux par nom\n' +
	'« Cible » : Aller et rester à la position et orientation du GPS\n' +
	'« Cible » (2em appui) : Voir le GPS mais ne plus le suivre\n' +
	'« Cible » (3em appui) : Affacer le réticule GPS et remettre la carte nord en haut\n' +
	'« ▲ » : Afficher un fichier GPX (une trace)\n' +
	'« ... » : Choisir un autre fond de carte\n' +
	'Avant de partir en randonnée :\n' +
	'- Paramètres de l‘explorateur (3 points verticaux) -> ajouter à l‘écran d‘accueil\n' +
	'- Déplacez-vous suivant le trajet de votre randonnée suffisamment lentement au zoom maximum pour charger les images des cartes qui seront conservées dans le cache de l‘explorateur\n' +
	'Hors réseau :\n' +
	'- Cliquez sur l‘icône "GPS"\n' +
	'- Les icônes de refuges.info ne sont disponibles que quand vous avez du réseau\n' +
	'* Cette application ne permet pas d‘enregistrer le parcours\n' +
	'* Aucune donnée ni géolocalisation n‘est remontée ni mémorisée\n' +
	'* Fonctionne bien sur Android avec Chrome, Edge & Samsung Internet, un peu moins bien avec Firefox & Safari\n',

	controls = [
		layersSwitcher,
		controlTilesBuffer(4),
		new ol.control.ScaleLine(),
		new ol.control.Attribution({
			collapseLabel: '>',
		}),
		controlMousePosition(),
		new ol.control.Zoom(),
		new ol.control.FullScreen({
			label: '', //HACK Bad presentation on IE & FF
			tipLabel: 'Plein écran',
		}),
		controlGeocoder(),
		controlGPS(),
		controlLoadGPX(),
		controlButton({
			label: '?',
			title: help,
			activate: function() {
				alert(this.title + window.location + registrationDate + genId);
			},
		}),
	],

	map = new ol.Map({
		target: 'map',
		view: new ol.View({
			center: ol.proj.fromLonLat([2, 47]),
			zoom: 6,
		}),
		layers: [layerRefugesInfo({
			baseUrl: sous_dossier_installation, // Use this server as root
		})],
		controls: controls,
	});