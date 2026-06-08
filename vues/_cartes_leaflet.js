/* global L, MarkerCompass, wriPOILayer, wriMassifsLayer */

/*******************
 * Couches tuilées *
 *******************/
// Remplace avantageusement 663 Ko de lib IGN
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

function tileLayersCollection(keys) {
  return {
    // Pour tests, à enlever à la fin
    //'Google': L.tileLayer('https://mt0.google.com/vt/lyrs=r&x={x}&y={y}&z={z}'),

    // Cartes lbres
    OpenHikingMap: L.tileLayer(
      'https://tile.openmaps.fr/openhikingmap/{z}/{x}/{y}.png', {
        maxZoom: 18,
        edgeBufferTiles: 3,
        attribution: '<a href="https://wiki.openstreetmap.org/wiki/OpenHikingMap"> OpenHikingMap</a> | ' +
          '<a href="https://openmaps.fr/map-legend/openhikingmap-legend.html">Légende</a>',
      }),
    OpenStreetMap: L.tileLayer(
      'https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | ' +
          '<a href="https://www.openstreetmap.org/panes/legend">Légende</a>'
      }),
    OpenTopoMap: L.tileLayer(
      'https://tile.openmaps.fr/opentopomap/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '<a href="https://github.com/sletuffe/OpenTopoMap">OTM-R</a> | ' +
          '<a href="https://openmaps.fr/map-legend/opentopomap-legend.html">Légende</a>',
      }),
    "ISO-maps": L.tileLayer(
      'https://api.iso-maps.com/v1/tiles/{z}/{x}/{y}.webp?api_key=' + keys.isomaps, {
        maxZoom: 16,
        attribution: '<a href="https://www.iso-maps.com/">Isomaps</a>',
      }),

    // Thunderforest
    Outdoors: L.tileLayer(
      'https://api.thunderforest.com/outdoors/{z}/{x}/{y}{r}.png?apikey=' + keys.thunderforest, {
        attribution: ' <a href="https://www.thunderforest.com/">Thunderforest</a> |' +
          ' <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 22,
      }),

    TOP25: tileLayerIGN(
      'https://data.geopf.fr/private/wmts?', {
        layer: 'GEOGRAPHICALGRIDSYSTEMS.MAPS',
        apikey: 'ign_scan_ws',
      }),
    'IGN plan': tileLayerIGN(
      'https://data.geopf.fr/wmts?', {
        layer: 'GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2',
        format: 'image/png',
      }),

    SwissTopo: L.tileLayer.wms(
      'https://wms.geo.admin.ch/?', {
        layers: 'ch.swisstopo.pixelkarte-farbe',
        format: 'image/jpeg',
        attribution: ' <a href="https://map.geo.admin.ch/">SwissTopo</a> | ' +
          '<a href="https://prod-swishop-s3.s3.eu-central-1.amazonaws.com/2022-04/symbols_fr_0.pdf">Légende</a>',
        maxZoom: 18,
      }),
    Espagne: tileLayerIGN(
      'https://www.ign.es/wmts/mapa-raster?', {
        layer: 'MTN',
        style: 'default',
        tilematrixset: 'GoogleMapsCompatible',
      }, {
        attribution: ' <a href="https://www.ign.es/">Instituto Geográfico Nacional</a>'
      }),

    'Photo Maxar': L.tileLayer.wms(
      'https://api.mapbox.com/v4/mapbox.satellite/{z}/{x}/{y}@2x.webp?access_token=' + keys.mapbox, {
        maxZoom: 22,
        attribution: '<a href="https://www.mapbox.com/"> Mapbox</a>',
      }),
    'Photo Google': L.tileLayer(
      'https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        maxZoom: 22,
        attribution: '<a href="https://www.google.com/maps"> Google</a>',
      }),
  };
};

/***************************
 * Déclaration de la carte *
 ***************************/
/* eslint-disable-next-line no-unused-vars */
function initMap(mapId, serveurAPI, keys) {
  console.info('MAP init');

  /******************************
   * Initialisation de la carte *
   ******************************/
  const map = L.map(mapId),
    permalink = localStorage.permalink.split('/');

  // Prevent Leaflet on Chome from focusing the map when using a Control
  map.getContainer().focus({
    preventScroll: true,
  });

  new L.Control.Fullscreen().addTo(map);

  L.control.scale({
    imperial: false,
  }).addTo(map);

  new L.Control.Geocoder({
    position: 'topleft',
  }).addTo(map);

  new L.Control.Gps({
    marker: new MarkerCompass(),
  }).addTo(map);

  map.on('locationfound', (evt) => {
    map.setView(evt.latlng, map.getZoom());
  });

  /*******************
   * Couches tuilées *
   *******************/
  const tileLayers = tileLayersCollection(keys),
    baselayer = tileLayers[permalink[3]] || Object.values(tileLayers)[0];

  baselayer.addTo(map); // Fond de carte par défaut

  /***********************
   * Couches vectorielle *
   ***********************/
  const vectorLayers = {
      'Massifs': wriMassifsLayer(serveurAPI),
    },
    clusteredOverlays = {
      'Cabane non gardée': 7,
      'Refuge gardé': 10,
      'Gîte d\'étape': 9,
      'Grotte': 29,
      'Point d\'eau': 23,
      'Passage délicat': 3,
      'Bâtiment en montagne': 28,
    },
    memCheckedLayers = typeof localStorage.checkedLayers === 'string' ?
    localStorage.checkedLayers.split(',') : ['Cabane non gardée', 'Refuge gardé', 'Gîte d\'étape'], // Par défaut

    // Groupement des couches qui doivent être clustérisées ensembles
    vectorCluster = L.markerClusterGroup().addTo(map);

  for (const [titre, typeId] of Object.entries(clusteredOverlays))
    vectorLayers[titre] =
    L.featureGroup.subGroup(vectorCluster).addLayer(
      wriPOILayer(serveurAPI, typeId)
    );

  /******************
   * Layer switcher *
   ******************/
  L.control.layers(tileLayers, vectorLayers).addTo(map);

  /*****************************
   * Mémorisation des overlays *
   *****************************/
  ['load', 'overlayadd', 'overlayremove'].forEach((type) => {
    map.on(type, (evt) => {
      const overlaySelectors = document.querySelectorAll('.leaflet-control-layers-overlays input'),
        checkedLayers = [];

      for (const lsInputEl of overlaySelectors) {
        const titre = lsInputEl.parentElement.lastChild.innerText.substring(1);

        // Restaure les couches précédentes
        if (evt.type === 'load' && memCheckedLayers.includes(titre)) {
          if (Object.keys(clusteredOverlays).includes(titre))
            vectorLayers[titre].eachLayer((layer) => {
              layer.on('adddata', () => lsInputEl.click());
            });
          else
            lsInputEl.click();
        }

        // Mémorise les couches actuelles
        if (lsInputEl.checked)
          checkedLayers.push(titre);
      }

      // Mémorisé dans la mémoire permanente de l'explorateur localStorage
      localStorage.checkedLayers = checkedLayers.join(',');

      // Cache les étiquettes pour les grandes échèles
      map.getContainer().classList[map.getZoom() < 8 ? 'add' : 'remove']('hide-tooltips');
    });
  });

  /*************
   * Permalink *
   *************/
  ['moveend', 'baselayerchange'].forEach((type) => {
    map.on(type, (evt) => {
      const baselayerSelector = document.querySelectorAll('.leaflet-control-layers-base input'),
        pos = evt.target.getCenter();
      let baseLayerName = Object.keys(tileLayers)[0];

      for (const lsInputEl of baselayerSelector)
        if (lsInputEl.checked)
          baseLayerName = lsInputEl.parentElement.lastChild.innerText.substring(1);

      localStorage.permalink = [evt.target.getZoom(), pos.lat, pos.lng]
        .map(f => Math.round(f * 10000) / 10000)
        .join('/') +
        '/' + encodeURI(baseLayerName);
    });
  });

  // Lance le chargement de la carte
  map.setView([permalink[1], permalink[2]], permalink[0]);

  return map;
}