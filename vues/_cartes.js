// Contient les fonctions communes à plusieurs cartes

function couchePointsWRI(options, page, layerOptions) {
  const layer = new myol.layer.MyVectorLayer({
    selectMassif: new myol.Selector('no-selector'), // Defaut = pas de sélecteur de massif

    // Clusters:
    serverClusterMinResolution: 100, // (mètres par pixel) résolution au dessus de laquelle on demande des clusters au serveur
    nbMaxClusters: 108, // Nombre de clusters sur la carte (12 rangées de 9). Remplace la distance
    browserClusterMinResolution: 10, // (mètres par pixel) résolution en-dessous de laquelle le navigateur ne clusterise plus et ajoute une gigue

    ...layerOptions, // Config_privee
    ...options,

    // Calcul de l'url de l'API refuges?.info
    query: (extent, resolution, projection, opt) => {
      const selectionMassif = layer.options.selectMassif.getSelection();

      return {
        _path: selectionMassif.length ? 'api/massif' : 'api/bbox',
        massif: selectionMassif,
        type_points: opt.selector.getSelection(),
        nb_points: 'all',
        cluster: resolution > opt.serverClusterMinResolution ? 0.1 : null, // For server cluster layer
      };
    },

    // Traduction des propriétés reçues de WRI pour interprétation par MyVectorLayer
    addProperties: properties => ({
      label: 'nav,point'.includes(page) ? properties.nom : null, // Permanence de l'étiquette dès l'affichage de la carte
      name: properties.nom, // Nom utilisé dans les listes affichées au survol des ronds des clusters
      icon: options.host + 'images/icones/' + properties.type.icone + '.svg',
      type: properties.type.valeur, // Pour export
      link: properties.lien, // Lien sur lequel cliquer
    }),

    hoverStylesOptions: (feature, layer) => {
      // Construction de l'étiquette détaillée
      const properties = feature.getProperties();

      // Si c'est un cluster, on affiche comme d'habitude
      if (properties.cluster)
        return myol.stylesOptions.hover(feature, layer);

      feature.setProperties({
        label: etiquetteComplette(properties),
      }, true);

      return myol.stylesOptions.label(feature, layer);
    },
  });

  // Recharger la couche de points quand le sélecteur de massif change
  layer.options.selectMassif.callbacks.push(() => layer.reload());

  return layer;
}

// Fabrique le texte de l'étiquette à partir des propriétés reçues du serveur
function etiquetteComplette(properties) {
  const caracteristiques = [],
    lignes = [];

  // On calcule d'abord la deuxième ligne
  if (properties.coord && properties.coord.alt)
    caracteristiques.push(parseInt(properties.coord.alt) + ' m');
  if (properties.places && properties.places.valeur)
    caracteristiques.push(parseInt(properties.places.valeur) + '\u255E\u2550\u2555');

  // Calcul des lignes de l'étiquette
  lignes.push(properties.name);
  if (caracteristiques.length)
    lignes.push(caracteristiques.join(','));
  lignes.push(properties.type);

  return lignes.join('\n');
}

// La couche des massifs colorés (accueil et couche carte nav)
function coucheMassifsColores(options) {
  return new myol.layer.MyVectorLayer({
    // Construction de l'url
    strategy: ol.loadingstrategy.all, // Pas de bbox
    query: () => ({
      _path: 'api/polygones',
      type_polygon: 1, // Massifs
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
        .match(/([0-9a-f]{2})/ig)
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

// Affiche le contour d'un massif pour la page nav
function coucheContourMassif(options) {
  return new myol.layer.MyVectorLayer({
    // Construction de l'url
    query: (extent, resolution, projection, options) => ({
      _path: 'api/polygones',
      type_polygon: 1, // Massifs
      massif: options.selector.getSelection(),
    }),
    strategy: ol.loadingstrategy.all, // Pas de bbox
    ...options,

    // Affichage de base
    basicStylesOptions: () => [{
      // Simple contour bleu
      stroke: new ol.style.Stroke({
        color: 'blue',
        width: 2,
      }),
    }],

    // Pas d'action au survol
    hoverStylesOptions: () => {},
  });
}

// Les couches de fond des cartes de refuges.info
function fondsCarte(page, mapKeys) {
  return {
    'Refuges.info': new myol.layer.tile.MRI(),
    'OSM': new myol.layer.tile.OpenStreetMap(),
    'OpenTopo': new myol.layer.tile.OpenTopo(),
    'Outdoors': new myol.layer.tile.Thunderforest({
      subLayer: 'outdoors',
      key: mapKeys.thunderforest,
    }),
    'IGN TOP25': 'nav,point'.includes(page) ? // Not available on edit pages
      new myol.layer.tile.IGN({
        layer: 'GEOGRAPHICALGRIDSYSTEMS.MAPS',
        key: mapKeys.ign,
      }) : null,
    'IGN V2': new myol.layer.tile.IGN({
      layer: 'GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2',
      key: 'essentiels', // La clé pour les couches publiques
      format: 'image/png',
    }),
    'SwissTopo': 'nav,point'.includes(page) ? // Not available on edit pages
      new myol.layer.tile.SwissTopo({
        subLayer: 'ch.swisstopo.pixelkarte-farbe',
      }) : null,
    'Autriche': new myol.layer.tile.Kompass({
      subLayer: 'osm', // No key
    }),
    'Espagne': new myol.layer.tile.IgnES(),
    'Photo IGN': new myol.layer.tile.IGN({
      layer: 'ORTHOIMAGERY.ORTHOPHOTOS',
      key: 'essentiels',
    }),
    'Photo ArcGIS': new myol.layer.tile.ArcGIS(),
    'Photo Google': 'nav,point'.includes(page) ? // Not available on edit pages
      new myol.layer.tile.Google({
        subLayers: 's',
      }) : null,
    'Photo Maxar': new myol.layer.tile.Maxbox({
      tileset: 'mapbox.satellite',
      key: mapKeys.mapbox,
    }),
  };
}

// Carte de la page d'accueil
function mapIndex(options) {
  const map = new ol.Map({
    target: options.target,

    view: new ol.View({
      enableRotation: false,
      constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
    }),

    controls: [
      new ol.control.Attribution({ // Du fond de carte
        collapsed: false,
      }),
    ],

    layers: [
      new myol.layer.tile.MRI(), // Fond de carte
      coucheMassifsColores({ // Les massifs
        host: options.host,
      }),
      new myol.layer.Hover(), // Gère le survol du curseur
    ],
  });

  // Centre la carte sur la zone souhaitée
  map.getView().fit(ol.proj.transformExtent(options.extent, 'EPSG:4326', 'EPSG:3857'));

  return map;
}

// Carte de la page de visualisation d'un point
function mapPoint(options) {
  return new ol.Map({
    target: options.target,

    view: new ol.View({
      enableRotation: false,
      constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
    }),

    controls: [
      // Haut gauche
      new ol.control.Zoom(),
      new ol.control.FullScreen(),
      new myol.control.MyGeocoder(),
      new myol.control.MyGeolocation(),
      new myol.control.Download(),
      new myol.control.Print(),

      // Bas gauche
      new myol.control.MyMousePosition(),
      new ol.control.ScaleLine(),

      // Bas droit
      new ol.control.Attribution({ // Attribution doit être défini avant LayerSwitcher
        collapsed: false,
      }),
      new myol.control.Permalink({ // Permet de garder le même réglage de carte
        visible: false, // Mais on ne visualise pas le lien du permalink
        init: false, // Ici, on utilisera plutôt la position du point
      }),

      // Haut droit
      new myol.control.LayerSwitcher({
        layers: fondsCarte('point', options.mapKeys),
      }),
    ],

    layers: [
      // Les autres points refuges.info
      couchePointsWRI({
        host: options.host,
        browserClusterMinResolution: 4, // (mètres par pixel) pour ne pas générer de gigue à l'affichage du point
        ...options.layerOptions,
      }, 'point'),

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
  });
}

// Carte de la page de modification d'un point
function mapModif(options) {
  return new ol.Map({
    target: options.target,

    view: new ol.View({
      enableRotation: false,
      constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
    }),

    controls: [
      // Haut gauche
      new ol.control.Zoom(),
      new ol.control.FullScreen(),
      new myol.control.MyGeocoder(),
      new myol.control.MyGeolocation(),

      // Bas gauche
      new myol.control.MyMousePosition(),
      new ol.control.ScaleLine(),

      // Bas droit
      new ol.control.Attribution({ // Attribution doit être défini avant LayerSwitcher
        collapsed: false,
      }),
      new myol.control.Permalink({
        init: !options.idPoint, // Garde la position courante en création de point
      }),

      // Haut droit
      new myol.control.LayerSwitcher({
        layers: fondsCarte('modif', options.mapKeys),
      }),
    ],

    layers: [
      // Les autres points refuges.info
      couchePointsWRI({
          host: options.host,
          browserClusterMinResolution: null, // Pour ne pas générer de gigue
          noClick: true,
        },
        'modif',
      ),

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
  });
}

// Carte de la page des cartes
function mapNav(options) {
  // Forçage de l'init des coches
  // Supprime toutes les sélections commençant par myol_selecteur
  Object.keys(localStorage)
    .filter(k => k.substring(0, 14) == 'myol_selecteur')
    .forEach(k => localStorage.removeItem(k));

  // Force tous les points et le contour
  if (options.id_polygone)
    localStorage.myol_selectmassif = options.id_polygone;
  localStorage.myol_selectwri = 'all';
  localStorage.myol_selectmassifs =
    localStorage.myol_selectosm =
    localStorage.myol_selectprc =
    localStorage.myol_selectcc =
    localStorage.myol_selectchem =
    localStorage.myol_selectalpages = '';

  const contourMassif = coucheContourMassif({
    host: options.host,
    selectName: 'select-massif',
  });

  const map = new ol.Map({
    target: options.target,

    view: new ol.View({
      enableRotation: false,
      constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
    }),

    controls: [
      // Haut gauche
      new ol.control.Zoom(),
      new ol.control.FullScreen(),
      new myol.control.MyGeocoder(),
      new myol.control.MyGeolocation(),
      new myol.control.Load(),
      new myol.control.Download(),
      new myol.control.Print(),

      // Bas gauche
      new myol.control.MyMousePosition(),
      new ol.control.ScaleLine(),

      // Bas droit
      new ol.control.Attribution({ // Attribution doit être défini avant LayerSwitcher
        collapsed: false,
      }),
      new myol.control.Permalink({ // Permet de garder le même réglage de carte
        display: true, // Affiche le lien
        init: !options.extent, // On reprend la même position s'il n'y a pas de massif
      }),

      // Haut droit
      new myol.control.LayerSwitcher({
        layers: fondsCarte('nav', options.mapKeys),
      }),
    ],

    layers: [
      coucheMassifsColores({
        host: options.host,
        selectName: 'select-massifs',
      }),
      new myol.layer.vector.Chemineur({
        selectName: 'select-chem',
      }),
      new myol.layer.vector.Alpages({
        selectName: 'select-alpages',
      }),
      new myol.layer.vector.PRC({
        selectName: 'select-prc',
      }),
      new myol.layer.vector.C2C({
        selectName: 'select-c2c',
      }),
      new myol.layer.vector.Overpass({
        selectName: 'select-osm',
      }),

      contourMassif,

      couchePointsWRI({
          host: options.host,
          selectName: 'select-wri',
          selectMassif: contourMassif.options.selector,
        },
        'nav',
        ...options.layerOptions,
      ),
      new myol.layer.Hover(), // Gère le survol du curseur
    ],
  });

  // Centrer sur la zone du polygone
  if (options.extent) {
    const extent4326 = options.extent.map(c => parseFloat(c)),
      extent3857 = ol.proj.transformExtent(extent4326, 'EPSG:4326', 'EPSG:3857');

    map.getView().fit(extent3857);
  }

  return map;
}

// Carte de la page d'édion de massif ou de zone
function navEdit(options) {
  const editorlayer = new myol.layer.Editor({
    geoJsonId: 'edit-json',
    editOnly: 'poly',

    featuresToSave: function(coordinates) {
      return this.format.writeGeometry(
        new ol.geom.MultiPolygon(coordinates.polys), {
          featureProjection: 'EPSG:3857',
          decimals: 5,
        });
    },
  });

  return new ol.Map({
    target: options.target,

    view: new ol.View({
      enableRotation: false,
      constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
    }),

    controls: [
      // Haut gauche
      new ol.control.Zoom(),
      new ol.control.FullScreen(),
      new myol.control.MyGeocoder(),
      new myol.control.MyGeolocation,
      new myol.control.Load(),
      new myol.control.Download({
        savedLayer: editorlayer,
      }),

      // Bas gauche
      new myol.control.MyMousePosition(),
      new ol.control.ScaleLine(),

      // Bas droit
      new ol.control.Attribution({ // Attribution doit être défini avant LayerSwitcher
        collapsed: false,
      }),

      // Haut droit
      new myol.control.LayerSwitcher({
        layers: fondsCarte('edit', options.mapKeys),
      }),
    ],

    layers: [
      coucheContourMassif({
        host: options.host,
      }),
      editorlayer,
    ],
  });
}