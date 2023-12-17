/**
 * VectorLayerCollection.js
 * Various acces to geoJson services
 */

import ol from '../ol';
import MyVectorLayer from './MyVectorLayer';

// Get icon from chemineur.fr
function chemIconUrl(type, host) {
  if (type) {
    const icons = type.split(' ');

    return (host || 'https://chemineur.fr/') +
      'ext/Dominique92/GeoBB/icones/' +
      icons[0] +
      (icons.length > 1 ? '_' + icons[1] : '') + // Limit to 2 type names & ' ' -> '_'
      '.svg';
  }
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
      icon: chemIconUrl(properties.type), // Replace the alpages icon
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
      nb_points: 'all',
      type_points: this.options.selector.getSelection(),
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
      strategy: ol.loadingstrategy.all,
      attribution: '&copy;Pyrenees-Refuges',
      nbMaxClusters: 108, // Number of clusters on the map display. Replace distance

      // Any myol.layer.MyVectorLayer, ol.source.Vector options, ol.source.layer.Vector

      ...options,
    });
  }

  addProperties(properties) {
    return {
      type: properties.type_hebergement,
      icon: chemIconUrl(properties.type_hebergement),
      ele: properties.altitude,
      capacity: properties.cap_ete,
      link: properties.url,
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

      for (let p in json.documents) {
        const properties = json.documents[p];

        features.push({
          id: properties.document_id,
          type: 'Feature',
          geometry: JSON.parse(properties.geometry.geom),
          properties: {
            name: properties.locales[0].title,
            type: properties.waypoint_type,
            icon: chemIconUrl(properties.waypoint_type),
            ele: properties.elevation,
            link: 'https://www.camptocamp.org/waypoints/' + properties.document_id,
          },
        });
      }

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
      format: new ol.format.OSMXML(),
      attribution: '&copy;OpenStreetMap',

      maxResolution: 50,
      nbMaxClusters: 108, // Number of clusters on the map display. Replace distance

      // Any myol.layer.MyVectorLayer, ol.source.Vector options, ol.source.layer.Vector
      ...options,
    });

    // List of acceptable tags in the request return
    let tags = '';

    for (let e in selectEls)
      if (selectEls[e].value)
        tags += selectEls[e].value.replace('private', '');

    // Extract features from data when received
    this.format.readFeatures = function(doc, options) {
      // Transform an area to a node (picto) at the center of this area

      for (let node = doc.documentElement.firstElementChild; node; node = node.nextSibling) {
        // Translate attributes to standard myol
        for (let tag = node.firstElementChild; tag; tag = tag.nextSibling)
          if (tag.attributes) {
            if (tags.indexOf(tag.getAttribute('k')) !== -1 &&
              tags.indexOf(tag.getAttribute('v')) !== -1 &&
              tag.getAttribute('k') != 'type') {
              addTag(node, 'type', tag.getAttribute('v'));
              addTag(node, 'icon', chemIconUrl(tag.getAttribute('v')));
              // Only once for a node
              addTag(node, 'link', 'https://www.openstreetmap.org/node/' + node.id);
            }

            if (tag.getAttribute('k') && tag.getAttribute('k').includes('capacity:'))
              addTag(node, 'capacity', tag.getAttribute('v'));
          }

        // Create a new 'node' element centered on the surface
        if (node.nodeName == 'way') {
          const newNode = doc.createElement('node');
          newNode.id = node.id;
          doc.documentElement.appendChild(newNode);

          // Browse <way> attributes to build a new node
          for (let subTagNode = node.firstElementChild; subTagNode; subTagNode = subTagNode.nextSibling)
            switch (subTagNode.nodeName) {
              case 'center':
                // Set node attributes
                newNode.setAttribute('lon', subTagNode.getAttribute('lon'));
                newNode.setAttribute('lat', subTagNode.getAttribute('lat'));
                newNode.setAttribute('nodeName', subTagNode.nodeName);
                break;

              case 'tag': {
                // Get existing properties
                newNode.appendChild(subTagNode.cloneNode());

                // Add a tag to mem what node type it was (for link build)
                addTag(newNode, 'nodetype', node.nodeName);
              }
            }
        }

        // Status 200 / error message
        if (node.nodeName == 'remark' && statusEl)
          statusEl.textContent = node.textContent;
      }

      function addTag(node, k, v) {
        const newTag = doc.createElement('tag');
        newTag.setAttribute('k', k);
        newTag.setAttribute('v', v);
        node.appendChild(newTag);
      }

      return ol.format.OSMXML.prototype.readFeatures.call(this, doc, options);
    };
  }

  query(extent, resolution, mapProjection) {
    const selections = this.selector.getSelection(),
      items = selections[0].split(','), // The 1st (and only) selector
      ex4326 = ol.proj.transformExtent(extent, mapProjection, 'EPSG:4326').map(c => c.toPrecision(6)),
      bbox = '(' + ex4326[1] + ',' + ex4326[0] + ',' + ex4326[3] + ',' + ex4326[2] + ');',
      args = [];

    // Convert selected items on overpass_api language
    for (let l = 0; l < items.length; l++) {
      const champs = items[l].split('+');

      for (let ls = 0; ls < champs.length; ls++)
        args.push(
          'node' + champs[ls] + bbox + // Ask for nodes in the bbox
          'way' + champs[ls] + bbox // Also ask for areas
        );
    }

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