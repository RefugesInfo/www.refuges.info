// Force https to allow PWA and geolocation
// Force full script name of short url to allow PWA
if (!location.href.match(/(https|localhost).*index/))
	location.replace(
		(location.hostname == 'localhost' ? 'http://' : 'https://') +
		location.hostname +
		location.pathname + (location.pathname.slice(-1) == '/' ? 'index.php' : '') +
		location.search +
		location.hash);

// Load service worker for web application, install & update
if ('serviceWorker' in navigator)
	navigator.serviceWorker.register(myolPath + 'service-worker.js.php?' + swInstance + buildDate, {
		scope: './',
	})
	.then(registration => {
		//BEST clarify this :
		if (registration.installing)
			console.log('PWA SW installing ' + registration.installing.scriptURL);
		else if (registration.waiting)
			console.log('PWA SW waiting ' + registration.waiting.scriptURL);
		else if (registration.active)
			console.log('PWA SW waiting ' + registration.active.scriptURL);
		else
			console.log('PWA SW STATUS UNKNOWN');

		registration.onupdatefound = async function() { // service-worker.js is changed
			console.log('PWA update found');

			// Completely unregister the previous SW to avoid installed SW actions ongoing
			if (registration.active) { // If it's an upgrade
				await navigator.serviceWorker.getRegistrations().then(registrations => {
					if (registrations.length) {
						for (let reg of registrations)
							//BEST need 3 reload to update
							//BEST https://bitsofco.de/what-self-skipwaiting-does-to-the-service-worker-lifecycle/ 
							//BEST https://stackoverflow.com/questions/59207110/in-a-pwa-is-there-a-way-to-check-for-a-waiting-service-worker-upgrade 
							reg.unregister()
							.then(console.log('SW ' + reg.active.scriptURL + ' deleted'));
					}
				});
			}

			// Wait for end of all actions & roboot
			const installingWorker = registration.installing;

			if (installingWorker)
				installingWorker.addEventListener('statechange', () => {
					if (installingWorker.state === 'installed') {
						console.log('PWA update installed / reload');
						location.reload();
					}
				});
		}
	})

// Manage the map
var map,
	layers = [],
	controlOptions = { // To be customized by the specific index.php
		layerSwitcher: {},
		Help: {
			submenuId: 'myol-gps-help',
		}
	};

window.addEventListener('load', function() {
	if (!controlOptions.layerSwitcher.layers)
		controlOptions.layerSwitcher.layers = layerTileCollection(controlOptions.layerSwitcher);

	// Load the map
	map = new ol.Map({
		target: 'map',
		view: new ol.View({
			constrainResolution: true, // Force zoom on the available tile's definition
		}),
		controls: controlsCollection(controlOptions)
			.concat(controlLayerSwitcher(controlOptions.layerSwitcher)),
		layers: layers,
	});
});