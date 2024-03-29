/**
 * Display misc values
 */

import ol from './ol';

export async function trace() {
  const data = [
    //BEST myol & geocoder version
    'Ol v' + ol.util.VERSION,
    'language: ' + navigator.language,
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

        for (let registration of registrations)
          if (registration.active)
            data.push('  ' + registration.active.scriptURL);
      }
    });

  // Registered caches in the scope
  if (typeof caches == 'object')
    await caches.keys().then(function(names) {
      if (names.length) {
        data.push('caches:');

        for (let name of names)
          data.push('  ' + name);
      }
    });

  // Log all the traces
  console.info(data.join('\n'));
}

// Zoom & resolution
/* global map */
window.addEventListener('load', () => { // Wait for doculment load
  if (typeof map == 'object' && map.once)
    map.once('precompose', () => { // Wait for view load
      traceZoom(); //BEST put in data.join
      map.getView().on('change:resolution', traceZoom);
    });
});

function traceZoom() {
  console.log(
    'zoom ' + map.getView().getZoom().toFixed(2) + ', ' +
    'res ' + map.getView().getResolution().toPrecision(4) + ' m/pix'
  );
}

export default trace;