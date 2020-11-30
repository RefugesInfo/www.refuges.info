// The first time a user hits the page an install event is triggered.
// The other times an update is provided if the remote service-worker source md5 is different
self.addEventListener('install', function(evt) {
	caches.delete('myGpsCache');
	evt.waitUntil(
		caches.open('myGpsCache').then(function(cache) {
			return cache.addAll([
				'index.html',
				'index.css',
				'index.js',
				'manifest.json',
				'favicon.png',
				'../ol/ol.css',
				'../ol/ol.js',
				'../geocoder/ol-geocoder.min.css',
				'../geocoder/ol-geocoder.js',
				'../myol.css',
				'../myol.js',
			]);
		})
	);
});

// Performed each time an URL is required before access to the internet
// Provides cached app file if any available
self.addEventListener('fetch', function(evt) {
	evt.respondWith(
		caches.match(evt.request).then(function(response) {
			return response || fetch(evt.request);
		})
	);
});