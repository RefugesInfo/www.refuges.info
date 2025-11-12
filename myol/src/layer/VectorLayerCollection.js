/**
 * Many simplified display of various vector layers services
 */

import {
  all,
} from 'ol/loadingstrategy';
import OSMXML from 'ol/format/OSMXML';
import {
  transformExtent,
} from 'ol/proj';

import MyVectorLayer from './MyVectorLayer';

// Get icon from chemineur.fr
function genericIconUrl(type, hostIcons) {
  if (type) {
    const icons = type.split(' ');

    return (hostIcons || 'https://chemineur.fr/ext/Dominique92/GeoBB/icones/') +
      icons[0] +
      (icons.length > 1 ? '_' + icons[1] : '') + // Limit to 2 type names & ' ' -> '_'
      '.svg';
  }
}

function addTag(doc, node, k, v) {
  const newTag = doc.createElement('tag');

  newTag.setAttribute('k', k);
  newTag.setAttribute('v', v);
  node.appendChild(newTag);
}

export class GeoBB extends MyVectorLayer {
  constructor(options) {
    super({
      serverClusterMinResolution: 100, // (meters per pixel) resolution above which we ask clusters to the server
      browserClusterMinResolution: 10, // (meters per pixel) resolution below which the browser no longer clusters but add a jitter
      nbMaxClusters: 108, // Number of clusters on the map display. Replace distance
      browserClusterFeaturelMaxPerimeter: 300, // (pixels) perimeter of a line or poly above which we do not cluster

      // Any myol.layer.MyVectorLayer, ol.source.Vector options, ol.source.layer.Vector
      ...options,
    });
  }

  query(extent, resolution) {
    return {
      _path: 'ext/Dominique92/GeoBB/gis.php',
      cat: this.options.selector.getSelection(),
      layer: resolution < this.options.serverClusterMinResolution ? null : 'cluster', // For server cluster layer
    };
  }
}

// chemineur.fr
export class Chemineur extends GeoBB {
  constructor(options) {
    super({
      host: 'https://chemineur.fr/',
      attribution: '&copy;chemineur.fr',

      // Any myol.layer.MyVectorLayer, ol.source.Vector options, ol.source.layer.Vector

      ...options,
    });
  }
}

// alpages.info
//TODO vite : Access to XMLHttpRequest at 'https://alpages.info/ext/Dominique92/GeoBB/gis.php?forums=on&bbox=5.85311%2C44.7727%2C5.91689%2C44.8093' from origin 'http://localhost:5173' has been blocked by CORS policy: No 'Access-Control-Allow-Origin' header is present on the requested resource.
export class Alpages extends MyVectorLayer {
  constructor(options) {
    super({
      host: 'https://alpages.info/',
      attribution: '&copy;alpages.info',
      browserClusterFeaturelMaxPerimeter: 300, // (pixels) perimeter of a line or poly above which we do not cluster

      // Any myol.layer.MyVectorLayer, ol.source.Vector options, ol.source.layer.Vector

      ...options,
    });
  }

  query() {
    return {
      _path: 'ext/Dominique92/GeoBB/gis.php',
      forums: this.options.selector.getSelection(),
    };
  }

  addProperties(properties) {
    return {
      icon: genericIconUrl(properties.type, this.options.hostIcons), // Replace the alpages icon
      link: this.host + 'viewtopic.php?t=' + properties.id,
    };
  }
}

// refuges.info
export class WRI extends MyVectorLayer {
  constructor(options) {
    super({
      host: 'https://www.refuges.info/',
      attribution: '&copy;refuges.info',

      serverClusterMinResolution: 100, // (meters per pixel) resolution above which we ask clusters to the server
      nbMaxClusters: 108, // Number of clusters on the map display. Replace distance
      browserClusterMinResolution: 10, // (meters per pixel) resolution below which the browser no longer clusters

      // Any myol.layer.MyVectorLayer, ol.source.Vector options, ol.source.layer.Vector

      ...options,
    });
  }

  query(extent, resolution) {
    return {
      _path: 'api/bbox',
      'nb_points': 'all',
      'type_points': this.options.selector.getSelection(),
      cluster: resolution > this.options.serverClusterMinResolution ? 0.1 : null, // For server cluster layer
    };
  }

  addProperties(properties) {
    if (!properties.cluster)
      return {
        name: properties.nom,
        icon: this.host + 'images/icones/' + properties.type.icone + '.svg',
        ele: properties.coord.alt,
        bed: properties.places.valeur,
        type: properties.type.valeur,
        link: properties.lien,
      };
  }
}

// pyrenees-refuges.com
export class PRC extends MyVectorLayer {
  constructor(options) {
    super({
      url: 'https://www.pyrenees-refuges.com/api.php?type_fichier=GEOJSON',
      strategy: all,
      attribution: '&copy;Pyrenees-Refuges',
      nbMaxClusters: 108, // Number of clusters on the map display. Replace distance

      // Any myol.layer.MyVectorLayer, ol.source.Vector options, ol.source.layer.Vector

      ...options,
    });
  }

  addProperties(properties) {
    return {
      type: properties.type_hebergement,
      icon: genericIconUrl(properties.type_hebergement, this.options.hostIcons),
      ele: properties.altitude,
      capacity: properties.cap_ete,
      link: properties.url,
    };
  }
}

// pere-lachaise.plan-interactif.com
export class PL extends MyVectorLayer {
  constructor(options) {
    super({
      url: 'https://chemineur.fr/ressources/pl.geojson.php',
      strategy: all,
      nbMaxClusters: 100,
      attribution: '&copy<a href="https://pere-lachaise.plan-interactif.com">' +
        'pere-lachaise.plan-interactif.com</a>',

      ...options,
    });
  }

  addProperties(properties) {
    return {
      icon: 'https://chemineur.fr/ext/Dominique92/GeoBB/icones/edifice_religieux.svg',
      link: 'https://pere-lachaise.plan-interactif.com/fr/#!/category/' + properties.parent + '/marker/' + properties.id,
    };
  }
}

// CampToCamp.org
export class C2C extends MyVectorLayer {
  constructor(options) {
    super({
      host: 'https://api.camptocamp.org/',
      dataProjection: 'EPSG:3857',
      attribution: '&copy;Camp2camp',

      // Any myol.layer.MyVectorLayer options

      ...options,
    });

    this.format.readFeatures = json => {
      const features = [];

      JSON.parse(json).documents.forEach(properties =>
        features.push({
          id: properties.document_id,
          type: 'Feature',
          geometry: JSON.parse(properties.geometry.geom),
          properties: {
            name: properties.locales[0].title,
            type: properties.waypoint_type,
            icon: genericIconUrl(properties.waypoint_type, options.hostIcons),
            ele: properties.elevation,
            link: 'https://www.camptocamp.org/waypoints/' + properties.document_id,
          },
        })
      );

      return this.format.readFeaturesFromObject({
        type: 'FeatureCollection',
        features: features,
      });
    };
  }

  query() {
    return {
      _path: 'waypoints',
      wtyp: this.selector.getSelection(),
      limit: 100, // C2C max limit
    };
  }
}

/**
 * OSM XML overpass POI layer
 * From: https://openlayers.org/en/latest/examples/vector-osm.html
 * Doc: http://wiki.openstreetmap.org/wiki/Overpass_API/Language_Guide
 */
export class Overpass extends MyVectorLayer {
  constructor(options) {
    const statusEl = document.getElementById(options.selectName),
      selectEls = document.getElementsByName(options.selectName);

    super({
      host: 'https://overpass-api.de',
      //host: 'https://lz4.overpass-api.de',
      //host: 'https://overpass.kumi.systems',
      bbox: () => null, // No bbox at the end of the url
      format: new OSMXML(),
      attribution: '&copy;OpenStreetMap',

      maxResolution: 50,
      nbMaxClusters: 108, // Number of clusters on the map display. Replace distance

      // Any myol.layer.MyVectorLayer, ol.source.Vector options, ol.source.layer.Vector
      ...options,
    });

    // List of acceptable tags in the request return
    let tags = '';

    for (const e in selectEls)
      if (selectEls[e].value)
        tags += selectEls[e].value.replace('private', '');

    // Extract features from data when received
    this.format.readFeatures = function(doc, opt) {
      const newNodes = [];

      for (let node = doc.documentElement.firstElementChild; node; node = node.nextSibling) {
        // Translate attributes to standard myol
        for (let tag = node.firstElementChild; tag; tag = tag.nextSibling)
          if (tag.attributes) {
            const tagv = tag.getAttribute('v');
            if (tags.indexOf(tag.getAttribute('k')) !== -1 &&
              tags.indexOf(tagv) !== -1 &&
              tag.getAttribute('k') !== 'type') {
              addTag(doc, node, 'type', tagv);
              addTag(doc, node, 'icon',
                genericIconUrl(tagv, options.hostIcons)
              );

              // Only once for a node
              addTag(doc, node, 'link', 'https://www.openstreetmap.org/' + node.nodeName + '/' + node.id);
            }

            if (tag.getAttribute('k') && tag.getAttribute('k').includes('capacity:'))
              addTag(doc, node, 'capacity', tagv);
          }

        // Transform an area to a node (picto) at the center of this area
        if (node.nodeName === 'way') {
          const newNode = doc.createElement('node');

          newNode.id = node.id;
          newNodes.push(newNode);

          // Browse <way> attributes to build a new node
          for (let subTagNode = node.firstElementChild; subTagNode; subTagNode = subTagNode.nextSibling)
            switch (subTagNode.nodeName) {
              case 'center':
                // Set node attributes
                newNode.setAttribute('lon', subTagNode.getAttribute('lon'));
                newNode.setAttribute('lat', subTagNode.getAttribute('lat'));
                newNode.setAttribute('nodeName', subTagNode.nodeName);
                break;

              case 'tag':
                // Get existing properties
                newNode.appendChild(subTagNode.cloneNode());

                // Add a tag to mem what node type it was (for link build)
                addTag(doc, newNode, 'nodetype', node.nodeName);
            }
        }

        // Status 200 / error message
        if (node.nodeName === 'remark' && statusEl)
          statusEl.textContent = node.textContent;
      }

      // Add new nodes to the document
      newNodes.forEach(n => doc.documentElement.appendChild(n));

      return OSMXML.prototype.readFeatures.call(this, doc, opt);
    };
  }

  query(extent, resolution, mapProjection) {
    const selections = this.selector.getSelection(),
      ex4326 = transformExtent(extent, mapProjection, 'EPSG:4326').map(c => c.toPrecision(6)),
      bbox = '(' + ex4326[1] + ',' + ex4326[0] + ',' + ex4326[3] + ',' + ex4326[2] + ');',
      args = [];

    for (let s = 0; s < selections.length; s++) // For each selected input checkbox
      selections[s].split('+') // Multiple choices separated by "+"
      .forEach(sel => args.push('nwr' + sel + bbox)); // Ask for node, way & relation in the bbox

    return {
      _path: '/api/interpreter',
      data: '[timeout:5];(' + args.join('') + ');out center;',
    };
  }

  bbox() {}
}

// Vectors layers examples
export function collection(options = {}) {
  return [
    new WRI(options.wri),
    new PRC(options.prc),
    new C2C(options.c2c),
    new Overpass(options.osm),
    new Chemineur(options.chemineur),
    new Alpages(options.alpages),
  ];
}