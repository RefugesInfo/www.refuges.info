/********************
 * PWA service worker
 * S'installe avant tout autre chargement à partir des fichiers de son cache
 * Permet de consulter hors réseau les pages consultées récemment
 *
 * https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps/Guides/Caching
 */

const nomCachePWA = 'myWRICache';

// En tâche de fond, le service worker raffraichi son cache si son source est modifié
// (marqueur de version par exemple)
// il exécute l'évènement 'install' qui permet à l'utilisateur de mettre à jour d'autres fichiers
// Cette nouvelle version sera mise en service lors du prochain redémarrage du PWA
self.addEventListener('install', (event) => {
  console.info('PWA install');

  event.waitUntil(
    caches.open(nomCachePWA)
    .catch((erreur) => console.error('PWA open cache ' + nomCachePWA + ' ' + erreur))
    .then((cache) => {
      console.info('PWA open cache ' + nomCachePWA);

      // Ces fichiers sont mis en cache PWA car ils ne sont pas appelés par le navigateur, donc pas mis en cache navigateur
      cache.addAll([
          './', // Le point d'entrée
          'manifest.json',
          'service-worker.js',
          'images/icones/favicon.png',
        ])
        .catch((erreur) => console.error('Add PWA files to cache ' + erreur))
        .then(console.info('PWA files added to cache'));
    })
  );
});

// Cache type network then cache, intercepte les chargements
// En tâche de fond, rafraichit le cache qui sera utilisé en cas de hors réseau
async function networkFirst(request) {
  try {
    const networkResponse = await fetch(request);

    if (networkResponse.ok) {
      const cache = await caches.open(nomCachePWA);
      cache.put(request, networkResponse.clone());
    }
    return networkResponse;
  }
  /* eslint-disable-next-line no-unused-vars */
  catch (error) {
    const cachedResponse = await caches.match(request);
    return cachedResponse;
  }
}

// Seuls sont mis en cache les url du domaine (fichier .html constituant une page affichable)
// Les fichiers éléments des pages (css, js, images, XMLHttpRequest, ...) sont mis en cache par l'explorateur
self.addEventListener('fetch', (event) => {
  if (event.request.redirect === 'manual' && // url appelé par une page (clic)
    event.request.url.includes(location.host)) // url appartenant au site
    event.respondWith(networkFirst(event.request));
});