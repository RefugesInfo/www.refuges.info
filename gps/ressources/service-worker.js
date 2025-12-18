/* global jsVars */

// Create/install cache
self.addEventListener('install', evt => {
  // Last file date will trigger the cache reload
  console.info('PWA install ' + jsVars.lastChangeDate);

  self.skipWaiting(); // Immediately activate the SW & trigger controllerchange

  const cacheName = 'myGpsCache';

  caches.delete(cacheName)
    .then(console.info('PWA ' + cacheName + ' deleted'))
    .catch(error => console.error(error));

  evt.waitUntil(
    caches.open(cacheName)
    .then(cache => {
      console.info('PWA open cache ' + cacheName);
      cache.addAll([
          'ressources/favicon.svg',
          'ressources/gps.js',
          'index.php',
          'manifest.json',
          'service-worker.php',
          ...jsVars.myolFiles,
          ...jsVars.gpxFiles,
        ])
        .then(console.info('PWA files added to cache'))
        .catch(error => console.error(error));
    })
    .catch(error => console.error(error))
  );
});

// Serves required files
// Cache first, then browser cache, then network
self.addEventListener('fetch', evt => {
  //console.info('PWA fetch ' + evt.request.url);
  evt.respondWith(
    caches.match(evt.request)
    .then(found => found || fetch(evt.request))
    .catch(error => console.error(error + ' ' + evt.request.url))
  )
});