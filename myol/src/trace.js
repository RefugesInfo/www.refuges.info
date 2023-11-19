/**
 * Display misc values
 */

import ol from './ol';

export async function trace(map) {
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

  console.info(data.join('\n'));

  // Zoom & resolution
  if (map)
    map.getView().on('change:resolution', () =>
      console.log('zoom ' + map.getView().getZoom().toFixed(2) +
        ', res ' + map.getView().getResolution().toPrecision(4) + ' m/pix'
      )
    );
}

export default trace;