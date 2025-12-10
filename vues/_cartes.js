/**
 * Contient les fonctions gérant les cartes
 * Regroupées ici pour permettre des tests unitaires dans MyOl
 */
/* global ol, myol */

// Les couches de fond des cartes de refuges.info
function externTilesLayers(mapKeys, restreint) {
  return {
    /* Appel natif d'une couche d'origine OSM :
    'Une couche OSM': new ol.layer.Tile({
      source: new ol.source.OSM({
        // Des options de https://openlayers.org/en/latest/apidoc/module-ol_source_OSM-OSM.html
      }),
      // Des options de https://openlayers.org/en/latest/apidoc/module-ol_layer_Tile-TileLayer.html
    }),*/
    'OpenHikingMap': new ol.layer.Tile({
      source: new ol.source.OSM({
        url: 'https://tile.openmaps.fr/openhikingmap/{z}/{x}/{y}.png',
        maxZoom: 18,
        attributions: '©<a target="_blank" href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | ' +
          '<a target="_blank" href="https://wiki.openstreetmap.org/wiki/OpenHikingMap">OpenHikingMap</a> | ' +
          '<a target="_blank" href="https://wiki.openstreetmap.org/wiki/OpenHikingMap#Map_Legend">Légende</a>',
      }),
    }),
    'OpenStreetMap': new ol.layer.Tile({
      source: new ol.source.OSM({
        url: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        maxZoom: 19,
        attributions: '©<a target="_blank" href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | ' +
          '<a target="_blank" href="https://www.openstreetmap.org/panes/legend">Légende</a>',
      }),
    }),
    'OpenTopoMap': new ol.layer.Tile({
      source: new ol.source.OSM({
        url: 'https://tile.openmaps.fr/opentopomap/{z}/{x}/{y}.png',
        maxZoom: 17,
        attributions: '©<a target="_blank" href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | ' +
          '<a target="_blank" href="https://github.com/sletuffe/OpenTopoMap/">OpenTopoMap-R</a> | ' +
          '<a target="_blank" href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a> | ' +
          '<a target="_blank" href="https://www.geograph.org/leaflet/otm-legend.php">Légende</a>',
      }),
    }),
    'Outdoors': new ol.layer.Tile({
      source: new ol.source.OSM({
        url: 'https://{a-c}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png?apikey=' + mapKeys.thunderforest,
        maxZoom: 22,
        attributions: '©<a target="_blank" href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | ' +
          '<a target="_blank" href="https://www.thunderforest.com/">Thunderforest</a>',
      }),
    }),

    'IGN TOP25': restreint ? null : new myol.layer.tile.IGNtop25({
      key: mapKeys.ign,
    }),
    'IGN plan': new myol.layer.tile.IGNplan(),

    'SwissTopo': restreint ? null : new myol.layer.tile.SwissTopo(),
    'Autriche': new myol.layer.tile.Kompass({
      subLayer: 'osm', // No key
    }),
    'Espagne': new myol.layer.tile.IgnES(),

    'Photo IGN': new myol.layer.tile.IGN({
      layer: 'ORTHOIMAGERY.ORTHOPHOTOS',
    }),
    'Photo ArcGIS': new myol.layer.tile.ArcGIS(),
    'Photo Google': restreint ? null : new myol.layer.tile.Google({
      subLayers: 's', // Satellite
    }),
    'Photo Maxar': new myol.layer.tile.Maxbox({
      tileset: 'mapbox.satellite',
      key: mapKeys.mapbox,
    }),
  };
}

function externPointsLayers(options) {
  return [
    new myol.layer.vector.Chemineur({
      selectName: 'select-chem',
      initSelect: '', // Réinitialise le choix des points
    }),
    new myol.layer.vector.Alpages({
      selectName: 'select-alpages',
      initSelect: '',
      hostIcons: options.host + 'images/icones/',
    }),
    new myol.layer.vector.PRC({
      selectName: 'select-prc',
      initSelect: '',
      hostIcons: options.host + 'images/icones/',
    }),
    new myol.layer.vector.C2C({
      selectName: 'select-c2c',
      initSelect: '',
      hostIcons: options.host + 'images/icones/',
    }),
    new myol.layer.vector.Overpass({
      selectName: 'select-osm',
      initSelect: '',
      hostIcons: options.host + 'images/icones/',
    }),
  ];
}

/**
 * Contient les fonctions gérant les cartes
 */
// Fabrique le texte de l'étiquette à partir des propriétés reçues du serveur
function etiquetteComplette(properties) {
  const caracteristiques = [],
    lignes = [];

  // On calcule d'abord la deuxième ligne
  if (properties.coord && properties.coord.alt)
    caracteristiques.push(parseInt(properties.coord.alt, 10) + ' m');
  if (properties.places && properties.places.valeur)
    caracteristiques.push(parseInt(properties.places.valeur, 10) + '\u255E\u2550\u2555');

  // Calcul des lignes de l'étiquette
  lignes.push(properties.name);
  if (caracteristiques.length)
    lignes.push(caracteristiques.join(','));
  lignes.push(properties.type);

  return lignes.join('\n');
}

/**
 * La couche des points avec icones
 */
function couchePointsWRI(options) {
  const layer = new myol.layer.MyVectorLayer({
    // Default options
    selectContour: new myol.Selector('no-selector'), // Defaut = pas de sélecteur de massif

    // Default clusters options:
    serverClusterMinResolution: 100, // (mètres par pixel) Résolution au dessus de laquelle on demande des clusters au serveur
    nbMaxClusters: 108, // Nombre de clusters sur la carte (12 rangées de 9). Remplace la distance
    browserClusterMinResolution: 10, // (mètres par pixel) Résolution en-dessous de laquelle le navigateur ne clusterise plus et ajoute une gigue

    ...options,

    // Calcul de l'url de l'API refuges.info
    query: (extent, resolution, p, opt) => {
      const selectionPolygone = layer.options.selectContour.getSelection();

      return {
        _path: selectionPolygone.length ? 'api/massif' : 'api/bbox',
        massif: selectionPolygone,
        // eslint-disable-next-line camelcase 
        type_points: opt.selection || opt.selector.getSelection(),
        // eslint-disable-next-line camelcase 
        nb_points: 'all',
        cluster: resolution > opt.serverClusterMinResolution ? 0.1 : null, // For server cluster layer
      };
    },

    // Traduction des propriétés reçues de WRI pour interprétation par MyVectorLayer
    addProperties: properties => ({
      label: options.displayLabel ? properties.nom : null, // Etiquette hors survol
      name: properties.nom, // Nom utilisé dans les listes affichées au survol des ronds des clusters
      icon: options.host + 'images/icones/' + properties.type.icone + '.svg',
      type: properties.type.valeur, // Pour export
      link: properties.lien, // Lien sur lequel cliquer
    }),

    hoverStylesOptions: (f, l) => {
      // Construction de l'étiquette détaillée
      const properties = f.getProperties();

      // Si c'est un cluster, on affiche comme d'habitude
      if (properties.cluster)
        return myol.stylesOptions.hover(f, l);

      f.setProperties({
        label: etiquetteComplette(properties),
      }, true);

      return myol.stylesOptions.label(f, l);
    },
  });

  // Recharger la couche de points quand le sélecteur de massif change
  layer.options.selectContour.callbacks.push(() => layer.reload());

  return layer;
}

/**
 * La couche des massifs colorés
 */
function couchePolygonesColores(options) {
  return new myol.layer.MyVectorLayer({
    // Construction de l'url
    strategy: ol.loadingstrategy.all, // Pas de bbox
    query: () => ({
      _path: 'api/polygones',
      // eslint-disable-next-line camelcase 
      type_polygon: options.idPolygoneType,
      intersection: options.intersection,
    }),
    ...options,

    // Réception et traduction des données
    addProperties: properties => ({
      label: properties.nom, // Affichage du nom du massif si le polygone est assez grand
      link: properties.lien, // Lien sur lequel cliquer
    }),

    // Affichage de base
    basicStylesOptions: feature => {
      // Conversion de la couleur en rgb pour pouvoir y ajouter la transparence
      const rgb = feature.getProperties().couleur
        .match(/([0-9a-f]{2})/igu)
        .map(c => parseInt(c, 16));

      return [{
        // Etiquette
        ...myol.stylesOptions.label(feature),

        // Affichage de la couleur du massif
        fill: new ol.style.Fill({
          // Transparence 0.3
          color: 'rgba(' + rgb.join(',') + ',0.3)',
        }),
      }];
    },

    // Affichage au survol des massifs
    hoverStylesOptions: feature => {
      feature.setProperties({
        overflow: true, // Affiche l'étiquette même si elle n'est pas contenue dans le polygone
      }, true);

      return {
        // Etiquette (pour les cas où elle n'est pas déja affichée)
        ...myol.stylesOptions.label(feature),

        // On renforce le contour du massif survolé
        stroke: new ol.style.Stroke({
          color: feature.getProperties().couleur,
          width: 2,
        }),
      };
    },
  });
}

/**
 * La couche des contours de massifs en noir
 */
function coucheContoursPolygones(options) {
  return new myol.layer.MyVectorLayer({
    // Construction de l'url
    query: (extent, r, p, opt) => ({
      _path: 'api/polygones',
      // eslint-disable-next-line camelcase 
      type_polygon: options.idPolygoneType,
      massif: opt.selector.getSelection(),
    }),
    strategy: ol.loadingstrategy.all, // Pas de bbox

    ...options,

    // Affichage de base
    basicStylesOptions: () => [{
      stroke: new ol.style.Stroke({
        color: 'black',
      }),
    }],

    // Pas d'action au survol
    hoverStylesOptions: () => {},
  });
}

/**
 * Carte d'accueil
 */
// eslint-disable-next-line no-unused-vars
function mapIndex(options) {
  const pointsLayer = couchePointsWRI({ // Les points
      host: options.host,
      selection: options.selection,
    }),
    polygonesLayer = couchePolygonesColores({ // Les massifs
      host: options.host,
      idPolygoneType: 1,
    });

  const boutonSelectPoints = new myol.control.Button({
      className: 'accueil-switcher',
      label: '&#127968;',
      title: 'Afficher les points',
    }),
    boutonSelectContour = new myol.control.Button({
      className: 'accueil-switcher',
      label: '&#127760;',
      title: 'Afficher les massifs',
    });

  // Initialiser au chargement de la page
  if (localStorage.wriaccueilmassifs === 'true')
    boutonSelectContour.element.classList.add('myol-button-selected');
  else
    boutonSelectPoints.element.classList.add('myol-button-selected');

  function selectIndexLayer(evt) {
    if (evt && evt.type === 'click') {
      if (evt.target === boutonSelectPoints.buttonEl) {
        boutonSelectPoints.element.classList.add('myol-button-selected');
        boutonSelectContour.element.classList.remove('myol-button-selected');
      } else {
        boutonSelectPoints.element.classList.remove('myol-button-selected');
        boutonSelectContour.element.classList.add('myol-button-selected');
      }
    }

    const pointsSelected = boutonSelectPoints.element.classList.contains('myol-button-selected');

    pointsLayer.setVisible(pointsSelected);
    polygonesLayer.setVisible(!pointsSelected);
    localStorage.wriaccueilmassifs = !pointsSelected;
  }
  boutonSelectPoints.buttonAction = selectIndexLayer;
  boutonSelectContour.buttonAction = selectIndexLayer;
  selectIndexLayer(); // On appelle une fois au chargement de la page

  const map = new ol.Map({
    target: options.target,

    view: new ol.View({
      enableRotation: false,
      constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
    }),

    controls: [
      new ol.control.Zoom(),
      new ol.control.FullScreen(),
      boutonSelectContour,
      boutonSelectPoints,
      new ol.control.Attribution({ // Du fond de carte
        collapsed: false,
      }),
    ],

    layers: [
      externTilesLayers(options.mapKeys).OpenHikingMap, // Fond de carte
      polygonesLayer,
      pointsLayer,
      new myol.layer.Hover(), // Gère le survol du curseur
    ],
  });

  map.getView().fit(ol.proj.transformExtent(options.extent, 'EPSG:4326', 'EPSG:3857'));

  return map;
}

/**
 * Carte de visualisation d'un point
 */
// eslint-disable-next-line no-unused-vars
function mapPoint(options) {
  return new ol.Map({
    target: options.target,

    controls: [
      new ol.control.Zoom(),
      new ol.control.FullScreen(),
      new myol.control.MyGeolocation(),
      new myol.control.Download(),
      new myol.control.MyMousePosition(),
      new ol.control.ScaleLine(),
      new ol.control.Attribution(), // Attribution doit être défini avant LayerSwitcher
      new myol.control.LayerSwitcher({
        layers: externTilesLayers(options.mapKeys),
      }),
      new myol.control.Permalink({ // Permet de garder le même réglage de carte
        visible: false, // Mais on ne visualise pas le lien du permalink
        init: false, // Ici, on utilisera plutôt la position du point
      }),
    ],

    layers: [
      // Les autres points refuges.info
      couchePointsWRI({
        host: options.host,
        browserClusterMinResolution: 10, // (mètres par pixel) pour ne pas générer de gigue à l'affichage du point
        displayLabel: true,
      }),

      // Le cadre rouge autour du point de la fiche
      new myol.layer.Marker({
        prefix: 'cadre', // S'interface avec les <TAG id="cadre-xxx"...>
        // Prend la position qui est dans <input id="cadre-json">
        src: options.host + 'images/cadre.svg',
        focus: 15, // Centrer
        zIndex: 300, // Above the features, under the hover label
      }),

      // Gère le survol du curseur
      new myol.layer.Hover(),
    ],

    view: new ol.View({
      enableRotation: false,
      constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
    }),
  });
}

/**
 * Carte des pages de création et de modification d'un point
 */
// eslint-disable-next-line no-unused-vars
function mapModif(options) {
  return new ol.Map({
    target: options.target,

    controls: [
      new ol.control.Zoom(),
      new ol.control.FullScreen(),
      new myol.control.MyGeocoder(),
      new myol.control.MyGeolocation(),
      new myol.control.MyMousePosition(),
      new ol.control.ScaleLine(),
      new ol.control.Attribution(), // Attribution doit être défini avant LayerSwitcher
      new myol.control.LayerSwitcher({
        layers: externTilesLayers(options.mapKeys, true),
      }),
      new myol.control.Permalink({
        init: !options.idPoint, // Va à la position courante en création
      }),
    ],

    layers: [
      // Les autres points refuges.info
      couchePointsWRI({
        host: options.host,
        browserClusterMinResolution: null, // Pour ne pas générer de gigue
        noClick: true,
      }),

      // Le viseur jaune pour modifier la position du point
      new myol.layer.Marker({
        src: options.host + 'images/viseur.svg',
        prefix: 'marker', // S'interface avec les <TAG id="marker-xxx"...>
        // Prend la position qui est dans <input id="cadre-json">
        dragable: true,
        focus: 15, // Centre la carte sur le curseur
      }),

      // Gère le survol du curseur
      new myol.layer.Hover(),
    ],

    view: new ol.View({
      enableRotation: false,
      constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
    }),
  });
}

/**
 * Carte de navigation
 */
// eslint-disable-next-line no-unused-vars
function mapNav(options) {
  const intersectionLayer = coucheContoursPolygones({
    host: options.host,
    selectName: 'select-massif',
    initSelect: 'all', // Réinitialise le choix du selecteur
  });

  const pointsLayer = couchePointsWRI({
    host: options.host,
    selectName: 'select-wri',
    initSelect: 'all', // Réinitialise les choix du selecteur
    selectContour: intersectionLayer.options.selector, // Recharger quand la sélection change
    displayLabel: true,
  });

  const polygonesLayer = couchePolygonesColores({ // Les massifs
    host: options.host,
    intersection: options.idPolygone,
    idPolygoneType: options.idPolygoneType,
  });

  const map = new ol.Map({
    target: options.target,

    controls: [
      new ol.control.Zoom(),
      new ol.control.FullScreen(),
      new myol.control.MyGeocoder(),
      new myol.control.MyGeolocation(),
      new myol.control.Load(),
      new myol.control.Download(),
      new myol.control.Print(),
      new myol.control.MyMousePosition(),
      new ol.control.ScaleLine(),
      new ol.control.Attribution(), // Attribution doit être défini avant LayerSwitcher
      new myol.control.LayerSwitcher({
        layers: externTilesLayers(options.mapKeys),
      }),
      new myol.control.Permalink({ // Permet de garder le même réglage de carte
        display: true, // Affiche le lien
        init: !options.extent, // On reprend la même position s'il n'y a pas de massif
      }),
    ],

    layers: [
      ...externPointsLayers(options),
      intersectionLayer,
      options.idPolygoneType ? polygonesLayer : pointsLayer,
      new myol.layer.Hover(), // Gère le survol du curseur
    ],

    view: new ol.View({
      enableRotation: false,
      constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
    }),
  });

  // Centrer sur la zone du polygone
  if (options.extent) {
    const extent4326 = options.extent.map(c => parseFloat(c)), // Parse string
      extent3857 = ol.proj.transformExtent(extent4326, 'EPSG:4326', 'EPSG:3857');

    map.getView().fit(extent3857);
  }

  return map;
}

/**
 * Carte de création ou d'édition de massif ou de zone
 */
// eslint-disable-next-line no-unused-vars
function mapEdit(options) {
  const editorLayer = new myol.layer.VectorEditor({
    geoJsonId: 'edit-json',
    canMerge: true,
    withPolys: true,
    withHoles: true,

    writeGeoJson: (features, lines, polys, opt) => {
      // Controle du statut d'enregistrement par le CSS
      const editStatus = document.getElementById('selecteur-carte-edit');

      if (editStatus)
        editStatus.className = 'noprint ' +
        'edit-lines-' + lines.length +
        ' edit-polys-' + polys.length;

      // Enregistrement au format MultiPolygon
      return opt.format.writeGeometry(
        new ol.geom.MultiPolygon(polys),
        opt,
      );
    },
  });

  const map = new ol.Map({
    target: options.target,

    controls: [
      new ol.control.Zoom(),
      new ol.control.FullScreen(),
      new myol.control.MyGeocoder(),
      new myol.control.MyGeolocation(),
      new myol.control.Load({
        loadedStyleOptions: {
          stroke: new ol.style.Stroke({
            color: 'black',
            width: 2,
          }),
        }
      }),
      new myol.control.Download({
        savedLayer: editorLayer,
      }),
      new myol.control.MyMousePosition(),
      new ol.control.ScaleLine(),
      new ol.control.Attribution(), // Attribution doit être défini avant LayerSwitcher
      new myol.control.LayerSwitcher({
        layers: externTilesLayers(options.mapKeys, true),
      }),
      new myol.control.Permalink({
        init: !options.extent,
      }),
    ],

    layers: [
      // Massifs en couleur
      couchePolygonesColores({
        host: options.host,
        idPolygoneType: 1,
      }),
      // Zones en contour noir
      coucheContoursPolygones({
        host: options.host,
        idPolygoneType: 11,
      }),
      editorLayer,
    ],

    view: new ol.View({
      enableRotation: false,
      constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
    }),
  });

  // Centrer sur la zone du polygone
  if (options.extent) {
    const extent4326 = options.extent.map(c => parseFloat(c)),
      extent3857 = ol.proj.transformExtent(extent4326, 'EPSG:4326', 'EPSG:3857');

    map.getView().fit(extent3857);
  }

  return map;
}