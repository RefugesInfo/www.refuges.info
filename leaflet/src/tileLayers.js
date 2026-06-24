/* global L */

// Remplace avantageusement 663 Ko de lib IGN
/* eslint-disable-next-line no-unused-vars */
function tileLayerIGN(url, paramsIGN, paramsLayer) {
  const params = {
    request: 'GetTile',
    service: 'WMTS',
    version: '1.0.0',
    tilematrixset: 'PM',
    style: 'normal',
    format: 'image/jpeg',
    tilematrix: '{z}',
    tilerow: '{y}',
    tilecol: '{x}',
    ...paramsIGN,
  };

  return L.tileLayer(
    url + Object.entries(params).map(e => e.join('=')).join('&'), {
      bounds: [
        [-75, -180],
        [81, 180]
      ],
      attribution: '<a href="https://www.geoportail.gouv.fr/">IGN Geoportail</a>',
      ...paramsLayer,
    });
}