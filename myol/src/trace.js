/**
 * Display misc values
 */

import {
  VERSION as olVersion,
} from 'ol/util';

export const VERSION = '__myolBuildVersion__ __myolBuildDate__';

export async function trace() {
  const data = [
    'Ol v' + olVersion,
    'MyOl ' + VERSION,
    'Geocoder __geocoderBuildVersion__',
    'Proj4 __proj4BuildVersion__',
    'language ' + navigator.language,
  ];

  // Storages in the subdomain
  ['localStorage', 'sessionStorage'].forEach(s => {
    if (window[s].length)
      data.push(s + ':');

    Object.keys(window[s])
      .forEach(k => data.push('  ' + k + ': ' + window[s].getItem(k)));
  });

  // Registered service workers in the scope
  if ('serviceWorker' in navigator)
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
    await caches.keys().then(names => {
      if (names.length) {
        data.push('caches:');

        for (const name of names)
          data.push('  ' + name);
      }
    });

  // Log all the traces
  console.info(data.join('\n'));
}

/* global map */
// Zoom & resolution
function traceZoom() {
  if (map.debug)
    console.info(
      'zoom ' + map.getView().getZoom().toFixed(2) + ', ' +
      'resolution ' + map.getView().getResolution().toPrecision(4) + ' m/pix'
    );
}

window.addEventListener('load', () => { // Wait for document load
  if (typeof map === 'object' && map.once)
    map.once('precompose', () => { // Wait for view load
      traceZoom();
      map.getView().on('change:resolution', traceZoom);
    });
});

export default trace;