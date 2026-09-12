/* global L, MarkerCompass, tileLayerIGN, wriPOILayer, wriPolygonLayer */

// Couches refuges.info
const clusteredVectorlayers = {
    'Cabane non gardée': [7, 'cabane'],
    'Refuge gardé': [10, 'cabane_red'],
    'Gîte d\'étape': [9, 'cabane_green'],
    'Grotte': [29, 'grotte'],
    'Point d\'eau': [23, 'pointdeau'],
    'Passage délicat': [3, 'triangle_a33.10'],
    'Bâtiment en montagne': [28, 'cabane_white_black_a63'],
  },
  // Couches OSM overpass
  OverpassVectorlayers = {
    'hôtel': '["tourism"~"hotel|guest_house|chalet|hostel|apartment"]',
    'camping': '["tourism"="camp_site"]',
    'point d\'eau': '["natural"="spring"]({{bbox}});nwr["amenity"="drinking_water"]',
    'ravitaillement': '["shop"~"supermarket|convenience"]',
    'parking': '["amenity"="parking"]["access"!="private"]',
    'bus': '["highway"="bus_stop"]',
  };

/***************************
 * Déclaration de la carte *
 ***************************/
/* eslint-disable-next-line no-unused-vars */
function initLeafletMap(mapId, serveurAPI, versionFeatures, layerKeys) {
  console.info('MAP init');

  /*******************
   * Couches tuilées *
   *******************/
  const tileLayers = {
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
    },
    permalink = (localStorage.permalink || '').split('/'),
    baselayer = tileLayers[decodeURI(permalink[3])] || Object.values(tileLayers)[0];

  /************************
   * Couches vectorielles *
   ************************/
  // Toutes les couches vectorielles overlays
  const defaultWriLalers = ['Cabane non gardée', 'Refuge gardé', 'Gîte d\'étape'],
    overlayLayers = {},
    memCheckedLayers = typeof localStorage.checkedLayers === 'string' ?
    localStorage.checkedLayers.split(',') : defaultWriLalers,
    // Groupement des couches qui doivent être clustérisées ensembles
    vectorCluster = L.markerClusterGroup({
      spiderfyOnMaxZoom: true, // Overlapping markers will spiderfy when clicked
      showCoverageOnHover: false, // Optional: hides the cluster bounds polygon
    });

  for (const [nom, args] of Object.entries(clusteredVectorlayers)) {
    args.push(
      '<img src="/images/icones/' + args[1] + '.svg"/> ' + nom, // Libellé de la ligne sélecteur
      wriPOILayer(serveurAPI, args[0], versionFeatures), // Couche affichable
    );

    // Display as overlay
    overlayLayers[args[2]] = L.featureGroup.subGroup(vectorCluster).addLayer(args[3]);
  }

  overlayLayers['Régions'] = wriPolygonLayer(serveurAPI, 11, versionFeatures);
  overlayLayers.Massifs = wriPolygonLayer(serveurAPI, 1, versionFeatures);

  // Couche externe d'itinéraires
  overlayLayers['Itinéraires'] = L.tileLayer(
    'https://tile.waymarkedtrails.org/hiking/{z}/{x}/{y}.png', {
      maxZoom: 18,
    });

  // Couches OSM OverPass
  for (const [nom, query] of Object.entries(OverpassVectorlayers))
    overlayLayers['OSM ' + nom] = new L.OverPassLayer({
      query: '(nwr' + query + '({{bbox}}););out center;',
      markerIcon: L.icon({
        iconUrl: serveurAPI + '/images/icones/' + nom.replace('ô', 'o').replace(/[^a-z]/gu, '') + '.svg',
        iconSize: [24, 24],
        iconAnchor: [12, 12],
      }),
      minZoom: 12,
      minZoomIndicatorEnabled: false,
    });

  /******************************
   * Initialisation de la carte *
   ******************************/
  const map = L.map(mapId);

  baselayer.addTo(map); // Fond de carte par défaut
  vectorCluster.addTo(map);

  /*************
   * Permalink *
   *************/
  //TODO reprendre et en faire un module
  ['load', 'overlayadd', 'overlayremove'].forEach((type) => {
    map.on(type, (evt) => {
      const overlaySelectors = document.querySelectorAll('.leaflet-control-layers-overlays input'),
        checkedLayersnames = [],
        checkedLayersTypes = [];

      for (const lsInputEl of overlaySelectors) {
        const nom = lsInputEl.parentElement.lastChild.innerText.trim();

        // Restaure les couches overlays précédentes
        if (evt.type === 'load' && memCheckedLayers.includes(nom)) {
          if (clusteredVectorlayers[nom])
            clusteredVectorlayers[nom][3].on('adddata', () => lsInputEl.click()); // Overlays vector
          else
            lsInputEl.click(); // Overlays tiles
        }

        // Mémorise les couches actuelles
        if (lsInputEl.checked) {
          checkedLayersnames.push(nom);

          if (typeof clusteredVectorlayers[nom] === 'object')
            checkedLayersTypes.push(clusteredVectorlayers[nom][0]);
        }
      }

      // Mémorisé dans la mémoire permanente de l'explorateur localStorage
      localStorage.checkedLayers = checkedLayersnames.join(',');
      localStorage.checkedLayersTypes = checkedLayersTypes.join(',');

      // Cache les étiquettes pour les grandes échèles
      map.getContainer().classList[map.getZoom() < 8 ? 'add' : 'remove']('hide-tooltips');
    });
  });

  ['moveend', 'baselayerchange'].forEach((type) => {
    map.on(type, (evt) => {
      const baselayerSelector = document.querySelectorAll('.leaflet-control-layers-base input'),
        pos = evt.target.getCenter();
      let baseLayerName = Object.keys(tileLayers)[0];

      for (const lsInputEl of baselayerSelector)
        if (lsInputEl.checked)
          baseLayerName = lsInputEl.parentElement.lastChild.innerText.trim();

      localStorage.permalink = [evt.target.getZoom(), pos.lat, pos.lng]
        .map(f => Math.round(f * 10000) / 10000)
        .join('/') +
        '/' + encodeURI(baseLayerName);
    });
  });

  /*************
   * Contrôles *
   *************/
  // Prevent Leaflet on Chrome from focusing the map when using a Control
  map.getContainer().focus({
    preventScroll: true,
  });

  new L.Control.Fullscreen().addTo(map);

  L.control.scale({
    imperial: false,
  }).addTo(map);

  L.control.coordinates({
    position: 'bottomleft',
  }).addTo(map);

  new L.Control.Geocoder({
    position: 'topleft',
  }).addTo(map);

  new L.Control.Gps({
    marker: new MarkerCompass(),
  }).addTo(map);

  map.on('locationfound', (evt) => {
    map.setView(evt.latlng, Math.max(15, map.getZoom()));
  });

  L.control.layers(tileLayers).addTo(map);
  L.control.layers(null, overlayLayers).addTo(map);

  // Lance le chargement de la carte
  map.setView([permalink[1], permalink[2]], permalink[0]);

  return map;
}