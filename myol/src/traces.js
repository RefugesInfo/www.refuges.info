/* global map */

/**
 * Display misc values
 */

import {
  VERSION as olVersion,
} from 'ol/util';

export const VERSION = '__myolBuildVersion__ __myolBuildDate__';

export async function traces(options) {
  const debug = {
      versions: true,
      storages: true,
      serviceWorkers: true,
      caches: true,
      files: false,
      ...options
    },
    data = [];

  if (debug.versions)
    data.push(...[
      'Ol v' + olVersion,
      'MyOl ' + VERSION,
      'Geocoder __geocoderBuildVersion__',
      'Proj4 __proj4BuildVersion__',
      'language ' + navigator.language,
    ]);

  // Storages in the subdomain
  if (debug.storages)
    ['localStorage', 'sessionStorage'].forEach(s => {
      if (window[s].length)
        data.push(s + ':');

      Object.keys(window[s])
        .forEach(k => data.push('  ' + k + ': ' + window[s].getItem(k)));
    });

  // Registered service workers in the scope
  if (debug.serviceWorkers && 'serviceWorker' in navigator)
    await navigator.serviceWorker.getRegistrations().then(registrations => {
      if (registrations.length) {
        data.push('service-workers:');

        for (const registration of registrations)
          if (registration.active)
            data.push('  ' + registration.active.scriptURL);
      }
    });

  // Registered caches in the scope
  if (typeof caches === 'object')
    await caches.keys().then(async keys => {
      if (keys.length) {
        data.push('caches:');

        for (const key of keys) {
          // Cache name
          data.push('  ' + key);

          // File names
          await caches
            .open(key)
            .then(cache => cache.keys())
            .then(requests =>
              requests.forEach(request =>
                data.push('  ' + request.url)
              )
            );
        }
      }
    });

  // Display all the traces
  console.info(data.join('\n'));
}

// Zoom & resolution
function traceZoom() {
  console.info(
    'zoom ' + map.getView().getZoom().toFixed(2) + ', ' +
    'resolution ' + map.getView().getResolution().toPrecision(4) + ' m/pix'
  );
}

window.addEventListener('load', () => { // Wait for document load
  if (typeof map === 'object' && map.once && map.debug)
    map.once('precompose', () => { // Wait for view load
      traceZoom();
      map.getView().on('change:resolution', traceZoom);
    });
});

export default traces;