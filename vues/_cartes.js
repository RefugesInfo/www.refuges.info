/**
 * Contient les fonctions gérant les cartes
 */
/* global ol, myol */

/**
 * Contient les fonctions gérant les cartes
 */
// Les couches de fond des cartes de refuges.info
function fondsCarte(mapKeys, restreint) {
  return {
    'Refuges.info': new myol.layer.tile.MRI(),
    'OSM': new myol.layer.tile.OpenStreetMap(),
    'OpenTopo': new myol.layer.tile.OpenTopo(),
    'Outdoors': new myol.layer.tile.Thunderforest({
      subLayer: 'outdoors',
      key: mapKeys.thunderforest,
    }),
    'IGN TOP25': restreint ? null : new myol.layer.tile.IGN({
      layer: 'GEOGRAPHICALGRIDSYSTEMS.MAPS',
      key: mapKeys.ign,
    }),
    'IGN V2': new myol.layer.tile.IGN({
      layer: 'GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2',
      format: 'image/png',
    }),
    'SwissTopo': restreint ? null : new myol.layer.tile.SwissTopo({
      subLayer: 'ch.swisstopo.pixelkarte-farbe',
    }),
    'Autriche': new myol.layer.tile.Kompass({
      subLayer: 'osm', // No key
    }),
    'Espagne': new myol.layer.tile.IgnES(),
    'Photo IGN': new myol.layer.tile.IGN({
      layer: 'ORTHOIMAGERY.ORTHOPHOTOS',
    }),
    'Photo ArcGIS': new myol.layer.tile.ArcGIS(),
    'Photo Google': restreint ? null : new myol.layer.tile.Google({
      subLayers: 's',
    }),
    'Photo Maxar': new myol.layer.tile.Maxbox({
      tileset: 'mapbox.satellite',
      key: mapKeys.mapbox,
    }),
  };
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
    selectMassif: new myol.Selector('no-selector'), // Defaut = pas de sélecteur de massif

    // Clusters:
    serverClusterMinResolution: 100, // (mètres par pixel) Résolution au dessus de laquelle on demande des clusters au serveur
    nbMaxClusters: 108, // Nombre de clusters sur la carte (12 rangées de 9). Remplace la distance
    browserClusterMinResolution: 10, // (mètres par pixel) Résolution en-dessous de laquelle le navigateur ne clusterise plus et ajoute une gigue

    ...options,

    // Calcul de l'url de l'API refuges?.info
    query: (extent, resolution, projection, opt) => {
      const selectionMassif = layer.options.selectMassif.getSelection();

      return {
        _path: selectionMassif.length ? 'api/massif' : 'api/bbox',
        massif: selectionMassif,
        'type_points': opt.selection || opt.selector.getSelection(),
        'nb_points': 'all',
        cluster: resolution > opt.serverClusterMinResolution ? 0.1 : null, // For server cluster layer
      };
    },

    // Traduction des propriétés reçues de WRI pour interprétation par MyVectorLayer
    addProperties: properties => ({
      label: 'nav,point'.includes(options.page) ? properties.nom : null, // Permanence de l'étiquette dès l'affichage de la carte
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
  layer.options.selectMassif.callbacks.push(() => layer.reload());

  return layer;
}

/**
 * La couche des massifs colorés (accueil et couche carte nav)
 */
function coucheMassifsColores(options) {
  return new myol.layer.MyVectorLayer({
    // Construction de l'url
    strategy: ol.loadingstrategy.all, // Pas de bbox
    query: () => ({
      _path: 'api/polygones',
      'type_polygon': 1, // Massifs
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
 * La couche des contours massifs colorés (page nav)
 */
function coucheContourMassif(options) {
  return new myol.layer.MyVectorLayer({
    // Construction de l'url
    query: (extent, resolution, projection, opt) => ({
      _path: 'api/polygones',
      'type_polygon': 1, // Massifs
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
/* eslint-disable-next-line no-unused-vars */
function mapIndex(options) {
  const pointsLayer = couchePointsWRI({ // Les points
      host: options.host,
      selection: '7,9,10',
    }),
    massifsLayer = coucheMassifsColores({ // Les massifs
      host: options.host,
    });

  const boutonSelectPoints = new myol.control.Button({
      className: 'accueil-switcher',
      label: '&#127968;',
      title: 'Afficher les points',
    }),
    boutonSelectMassifs = new myol.control.Button({
      className: 'accueil-switcher',
      label: '&#127760;',
      title: 'Afficher les massifs',
    });

  // Initialiser au chargement de la page
  if (localStorage.wriaccueilmassifs === 'true')
    boutonSelectMassifs.element.classList.add('myol-button-selected');
  else
    boutonSelectPoints.element.classList.add('myol-button-selected');

  function selectIndexLayer(evt) {
    if (evt && evt.type === 'click') {
      if (evt.target === boutonSelectPoints.buttonEl) {
        boutonSelectPoints.element.classList.add('myol-button-selected');
        boutonSelectMassifs.element.classList.remove('myol-button-selected');
      } else {
        boutonSelectPoints.element.classList.remove('myol-button-selected');
        boutonSelectMassifs.element.classList.add('myol-button-selected');
      }
    }

    const pointsSelected = boutonSelectPoints.element.classList.contains('myol-button-selected');

    pointsLayer.setVisible(pointsSelected);
    massifsLayer.setVisible(!pointsSelected);
    localStorage.wriaccueilmassifs = !pointsSelected;
  }
  boutonSelectPoints.buttonAction = selectIndexLayer;
  boutonSelectMassifs.buttonAction = selectIndexLayer;
  selectIndexLayer(); // On appelle une fois au chargement de la page

  const map = new ol.Map({
    target: options.target,

    view: new ol.View({
      enableRotation: false,
    }),

    controls: [
      new ol.control.Zoom(),
      new ol.control.FullScreen(),
      boutonSelectMassifs,
      boutonSelectPoints,
      new ol.control.Attribution({ // Du fond de carte
        collapsed: false,
      }),
    ],

    layers: [
      new myol.layer.tile.MRI(), // Fond de carte
      massifsLayer,
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
/* eslint-disable-next-line no-unused-vars */
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
        layers: fondsCarte(options.mapKeys),
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
        browserClusterMinResolution: 4, // (mètres par pixel) pour ne pas générer de gigue à l'affichage du point
        page: 'point',
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
/* eslint-disable-next-line no-unused-vars */
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
        layers: fondsCarte(options.mapKeys, true),
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
        page: 'modif',
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
/* eslint-disable-next-line no-unused-vars */
function mapNav(options) {
  const contourMassif = coucheContourMassif({
    host: options.host,
    selectName: 'select-massif',
    initSelect: options.id_polygone,
  });

  const pointsWRI = couchePointsWRI({
    host: options.host,
    selectName: 'select-wri',
    initSelect: 'all',
    selectMassif: contourMassif.options.selector,
    page: 'nav',
  });

  const externLayers = [
    new myol.layer.vector.Chemineur({
      selectName: 'select-chem',
      initSelect: '',
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
        layers: fondsCarte(options.mapKeys),
      }),
      new myol.control.Permalink({ // Permet de garder le même réglage de carte
        display: true, // Affiche le lien
        init: !options.extent, // On reprend la même position s'il n'y a pas de massif
      }),
    ],

    layers: [
      coucheMassifsColores({
        host: options.host,
        initSelect: '',
        intersection: options.id_polygone_type === 11 ? options.id_polygone : -1,
      }),
      ...externLayers,
      contourMassif,
      pointsWRI,
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
/* eslint-disable-next-line no-unused-vars */
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
    }),

    map = new ol.Map({
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
          layers: fondsCarte(options.mapKeys, true),
        }),
        new myol.control.Permalink({
          init: !options.extent,
        }),
      ],

      layers: [
        coucheContourMassif({
          host: options.host,
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