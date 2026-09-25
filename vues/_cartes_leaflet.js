/* global L, MarkerCompass, tileLayerIGN, wriPOILayer, wriPolygonLayer */

/*********************************************************************************
 * Ce fichier contient les paramètrages spécifiques et visibles sur refuges.info *
 *********************************************************************************/

// Position et couches par défaut
sessionStorage.permalink ||= '5/46.5/5';
if (typeof sessionStorage.checkedLayers !== 'string')
  sessionStorage.checkedLayers = 'Cabane non gardée,Refuge gardé,Gîte d\'étape';

/*****************************************
 * Contrôles communs à toutes les cartes *
 *****************************************/
/* eslint-disable-next-line no-unused-vars */
function controlesComuns(map) {
  // Prevent Leaflet on Chrome from focusing the map when using a Control
  map.getContainer().focus({
    preventScroll: true,
  });

  // Réponse au contrôle GPS
  map.on('locationfound', (evt) => map.setView(evt.latlng, Math.max(15, map.getZoom()))); // Listener for GPS

  return [
    new L.Control.Fullscreen(),

    L.control.scale({
      imperial: false,
    }),

    L.control.coordinates({
      position: 'bottomleft',
    }),

    new L.Control.Geocoder({
      position: 'topleft',
    }),

    new L.Control.Gps({
      marker: new MarkerCompass(),
    }),
  ];
}

/**************************
 * Définition des couches *
 **************************/
/* eslint-disable-next-line no-unused-vars */
function couchesDeFond(layerKeys) {
  return {
    // Cartes libres
    OpenHikingMap: L.tileLayer(
      'https://tile.openmaps.fr/openhikingmap/{z}/{x}/{y}.png', {
        maxZoom: 18,
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
    'ISO-maps': L.tileLayer(
      'https://api.iso-maps.com/v1/tiles/{z}/{x}/{y}.webp?api_key=' + layerKeys.isomaps, {
        maxZoom: 16,
        attribution: '<a href="https://www.iso-maps.com/">Isomaps</a>',
      }),

    // Thunderforest
    Outdoors: L.tileLayer(
      'https://api.thunderforest.com/outdoors/{z}/{x}/{y}{r}.png?apikey=' + layerKeys.thunderforest, {
        maxZoom: 22,
        attribution: '<a href="https://www.thunderforest.com/">Thunderforest</a> | ' +
          '<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
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
        attribution: '<a href="https://map.geo.admin.ch/">SwissTopo</a> | ' +
          '<a href="https://prod-swishop-s3.s3.eu-central-1.amazonaws.com/2022-04/symbols_fr_0.pdf">Légende</a>',
        maxZoom: 18,
      }),
    Espagne: tileLayerIGN(
      'https://www.ign.es/wmts/mapa-raster?', {
        layer: 'MTN',
        style: 'default',
        tilematrixset: 'GoogleMapsCompatible',
      }, {
        attribution: '<a href="https://www.ign.es/">Instituto Geográfico Nacional</a>'
      }),

    'Photo Maxar': L.tileLayer.wms(
      'https://api.mapbox.com/v4/mapbox.satellite/{z}/{x}/{y}@2x.webp?access_token=' + layerKeys.mapbox, {
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
}

const couchesIconesWRI = {
    'Cabane non gardée': [7, 'cabane'],
    'Refuge gardé': [10, 'cabane_red'],
    'Gîte d\'étape': [9, 'cabane_green'],
    'Grotte': [29, 'grotte'],
    'Point d\'eau': [23, 'pointdeau'],
    'Passage délicat': [3, 'triangle_a33.10'],
    'Bâtiment à investiguer': [28, 'cabane_white_black_a63'],
  },

  couchesOverpass = {
    'hôtel': '["tourism"~"hotel|guest_house|chalet|hostel|apartment"]',
    'camping': '["tourism"="camp_site"]',
    'point d\'eau': '["natural"="spring"]({{bbox}});nwr["amenity"="drinking_water"]',
    'ravitaillement': '["shop"~"supermarket|convenience"]',
    'parking': '["amenity"="parking"]["access"!="private"]',
    'bus': '["highway"="bus_stop"]',
  },

  coucheItineraires = L.tileLayer(
    'https://tile.waymarkedtrails.org/hiking/{z}/{x}/{y}.png', {
      maxZoom: 18,
      //TODO BUG ne s'affiche pas sur Espagne, photo maxar & photo Google
    });

// Cluster contenant tous les types de points
/* eslint-disable-next-line no-unused-vars */
function clusterPOI(serveurAPI, versionFeatures) {
  const cluster = L.markerClusterGroup({
    spiderfyOnMaxZoom: true, // Overlapping markers will spiderfy when clicked
    maxClusterRadius: 30, // Less clusters
  });

  for (const entry of Object.entries(couchesIconesWRI))
    // On crée les couches pour chaque type de point
    wriPOILayer(serveurAPI, entry[1][0], versionFeatures)
    // Attente de la fin de réception pour l'intégrer au cluster
    .on('load', (evt) => cluster.addLayer(evt.target));

  return cluster;
}