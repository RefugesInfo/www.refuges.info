/**
 * MyVectorLayer class to facilitate vector layers display
 */

import ClusterSource from 'ol/source/Cluster';
import Feature from 'ol/Feature';
import GeoJSON from 'ol/format/GeoJSON';
import {
  getCenter,
} from 'ol/extent';
import Point from 'ol/geom/Point';
import Style from 'ol/style/Style';
import {
  transform,
  transformExtent,
} from 'ol/proj';
import VectorLayer from 'ol/layer/Vector';
import VectorSource from 'ol/source/Vector';

import Selector from './Selector';
import * as stylesOptions from './stylesOptions';

/**
 * Strategy for loading elements based on fixed tile grid
 * Following layer option
     tiledBBoxStrategy: {
       1000: 10, // tilesize = 1000 Mercator unit up to resolution = 10 meters per pixel
     },
 */
function tiledBboxStrategy(extent, resolution) {
  //TODO BUG obsolescence de toutes les tuiles après 1 modif: pb hors ligne
  /* eslint-disable-next-line consistent-this, no-invalid-this */
  const layer = this,
    tsur = layer.options.tiledBBoxStrategy || {},
    found = Object.keys(tsur).find(k => tsur[k] > resolution),
    tileSize = parseInt(found, 10),
    tiledExtent = [];

  if (typeof found === 'undefined')
    return [extent]; // Fall back to bbox strategy

  for (let lon = Math.floor(extent[0] / tileSize); lon < Math.ceil(extent[2] / tileSize); lon++)
    for (let lat = Math.floor(extent[1] / tileSize); lat < Math.ceil(extent[3] / tileSize); lat++)
      tiledExtent.push([
        Math.round(lon * tileSize),
        Math.round(lat * tileSize),
        Math.round(lon * tileSize + tileSize),
        Math.round(lat * tileSize + tileSize),
      ]);

  if (layer.options.debug) {
    layer.logs = {
      tileSize: Math.round(tileSize / 1414) + '*' + Math.round(tileSize / 1414) + 'km',
      isCluster: resolution > layer.options.serverClusterMinResolution,
    };
    console.info(
      'Request ' + tiledExtent.length +
      ' tile' + (tiledExtent.length > 1 ? 's ' : ' ') +
      layer.logs.tileSize + ' for ' +
      Math.round(resolution) + 'm/px resolution '
    );
  }

  return tiledExtent;
}

/**
 * GeoJSON vector display &
 * loading status display
 */
class MyVectorSource extends VectorSource {
  constructor(options) {
    // selectName: '', // Name of checkbox inputs to tune the url parameters
    // addProperties: properties => {}, // Add properties to each received feature

    super(options);

    this.options = options;
    this.statusEl = document.getElementById(options.selectName + '-status');

    // Display loading satus
    this.on(['featuresloadstart', 'featuresloadend', 'error', 'featuresloaderror'], evt => {
      if (this.statusEl)
        switch (evt.type) {
          case 'featuresloadstart':
            this.statusEl.innerHTML = '&#8987;';
            break;
          case 'featuresloadend':
            this.statusEl.innerHTML = '';
            break;
          default:
            this.statusEl.innerHTML = '&#9888;'; // Error symbol
        }
    });

    // Compute properties when the layer is loaded & before the cluster layer is computed
    this.on('change', () => {
      if (this.options.debug)
        console.info(
          'Receive 1 tile ' +
          this.logs.tileSize + ', ' + this.getFeatures().length +
          (this.logs.isCluster ? ' clusters, ' : ' points, ') +
          transform(getCenter(this.getExtent()), 'EPSG:3857', 'EPSG:4326')
          .map(x => Math.round(x * 1000) / 1000)
          .join('°E/') + '°N'
        );

      this.getFeatures().forEach(f => {
        if (!f.yetAdded) {
          f.yetAdded = true;
          f.setProperties(
            options.addProperties(f.getProperties()),
            true, // Silent : add the feature without refresh the layer
          );
        }
      });
    });
  }

  tuneDistance() {} // MyClusterSource compatibility

  // Redirection for cluster.source compatibility
  reload() {
    this.refresh();
  }
}

/**
 * Cluster source to manage clusters in the browser
 */
class MyClusterSource extends ClusterSource {
  constructor(options) {
    // options:
    // browserClusterFeaturelMaxPerimeter: 300, // (pixels) perimeter of a line or poly above which we do not cluster
    // Any MyVectorSource options

    // Source to handle the features
    const initialSource = new MyVectorSource(options);

    // Source to handle the clusters & the isolated features
    super({
      source: initialSource,
      geometryFunction: f => this.geometryFunction_(f, options),
      createCluster: (p, f) => this.createCluster_(p, f),

      ...options,
    });

    this.options = options;
  }

  // Generate a center point where to display the cluster
  geometryFunction_(feature, options) {
    const geometry = feature.getGeometry();

    if (geometry) {
      const ex = feature.getGeometry().getExtent(),
        featurePixelPerimeter = (ex[2] - ex[0] + ex[3] - ex[1]) * 2 / this.resolution;

      // Don't cluster lines or polygons whose the extent perimeter is more than x pixels
      if (featurePixelPerimeter > options.browserClusterFeaturelMaxPerimeter)
        this.addFeature(feature); // And return null to not cluster this feature
      else
        return new Point(getCenter(feature.getGeometry().getExtent()));
    }
  }

  // Generate the features to render the cluster
  createCluster_(point, features) {
    let nbMaxClusters = 0,
      includeCluster = false,
      lines = [];

    features.forEach(f => {
      const properties = f.getProperties();

      lines.push(properties.name);
      nbMaxClusters += parseInt(properties.cluster, 10) || 1;
      if (properties.cluster)
        includeCluster = true;
    });

    // Single feature : display it
    if (nbMaxClusters === 1)
      return features[0];

    if (includeCluster || lines.length > 5)
      lines = ['Cliquer pour zoomer'];

    // Display a cluster point
    return new Feature({
      id: features[0].getId(), // Pseudo id = the id of the first feature in the cluster
      name: stylesOptions.agregateText(lines),
      geometry: point, // The gravity center of all the features in the cluster
      features: features,
      cluster: nbMaxClusters, //BEST voir pourquoi on ne met pas ça dans properties
    });
  }

  tuneDistance(map) {
    const s = map.getSize(),
      n = this.options.nbMaxClusters,
      f = (s[0] + s[1] + 5000) / 5000; // More clusters on big maps

    if (n)
      this.setDistance(Math.sqrt(s[0] * s[1] / n / f));
  }

  reload() {
    // Reload the wrapped source
    this.getSource().reload();
  }
}

/**
 * Browser & server clustered layer
 */
class MyBrowserClusterVectorLayer extends VectorLayer {
  constructor(options) {
    // browserClusterMinResolution: 10, // (meters per pixel) resolution below which the browser no longer clusters but add a jitter

    // Any ol.source.layer.Vector options

    // High resolutions layer, can call for server clustering
    const hiResOptions = {
      source: options.nbMaxClusters ?
        new MyClusterSource(options) : // Use a cluster source and a vector source to manages clusters
        new MyVectorSource(options), // or a vector source to get the data

      ...options,

      minResolution: Math.max(
        options.minResolution || 0,
        options.browserClusterMinResolution || 0,
      ),
    };

    super(hiResOptions);
    this.options = hiResOptions; // Mem for further use

    // Low resolutions layer without clustering
    if (options.browserClusterMinResolution &&
      options.browserClusterMinResolution < options.maxResolution) {
      const lowResOptions = {
        source: new MyVectorSource(options),

        ...options,

        maxResolution: options.browserClusterMinResolution,
        type: 'lowResolution',
      };

      this.lowResolutionLayer = new VectorLayer(lowResOptions);
      this.lowResolutionLayer.options = lowResOptions;
    }
  }

  setMapInternal(map) {
    if (this.lowResolutionLayer)
      map.addLayer(this.lowResolutionLayer);

    return super.setMapInternal(map);
  }

  // Propagate reload
  reload(visible) {
    this.setVisible(visible);

    if (visible && this.state_) //BEST find better than this.state_
      this.getSource().reload();

    if (this.lowResolutionLayer) {
      this.lowResolutionLayer.setVisible(visible);

      if (visible && this.lowResolutionLayer.state_)
        this.lowResolutionLayer.getSource().reload();
    }
  }
}

/**
 * Activate a vector & a cluster layer depending on the zoom level
 */
class MyServerClusterVectorLayer extends MyBrowserClusterVectorLayer {
  constructor(options) {
    // serverClusterMinResolution: 100, // (meters per pixel) resolution above which we ask clusters to the server

    // Low resolutions layer to display the normal data
    super({
      ...options,

      maxResolution: options.serverClusterMinResolution,
      type: 'browserCluster',
    });

    // High resolutions layer to get and display the clusters delivered by the server at hight resolutions
    if (options.serverClusterMinResolution)
      this.serverClusterLayer = new MyBrowserClusterVectorLayer({
        ...options,

        minResolution: options.serverClusterMinResolution,
        type: 'serverCluster',
      });
  }

  setMapInternal(map) {
    if (this.serverClusterLayer)
      map.addLayer(this.serverClusterLayer);

    map.on('change:size', () => {
      this.getSource().tuneDistance(map);

      if (this.serverClusterLayer)
        this.serverClusterLayer.getSource().tuneDistance(map);
    });

    return super.setMapInternal(map);
  }

  // Propagate the setVisible to the serverClusterLayer
  //BEST check why reload doesn't do the job
  setVisible(visible) {
    if (this.serverClusterLayer)
      this.serverClusterLayer.setVisible(visible);

    return super.setVisible(visible);
  }

  // Propagate the reload to the serverClusterLayer
  reload(visible) {
    if (this.serverClusterLayer)
      this.serverClusterLayer.reload(visible);

    return super.reload(visible);
  }
}

/**
 * Facilities added vector layer
 * Style features
 * Layer & features selector
 */
class MyVectorLayer extends MyServerClusterVectorLayer {
  constructor(opt) {
    const options = {
      // host: '',
      strategy: tiledBboxStrategy,
      dataProjection: 'EPSG:4326',

      // Clusters:
      // serverClusterMinResolution: 100, // (meters per pixel) resolution above which we ask clusters to the server
      // browserClusterMinResolution: 10, // (meters per pixel) resolution below which the browser no longer clusters but add a jitter
      // nbMaxClusters: 108, // Number of clusters on the map display. Replace distance
      // distance: 50, // (pixels) distance above which we cluster
      minDistance: 24, // (pixels) minimum distance in pixels between clusters (can slide cluster icons)
      // browserClusterFeaturelMaxPerimeter: 300, // (pixels) perimeter of a line or poly above which we do not cluster

      // Features
      // addProperties: properties => {}, // Add properties to each received feature
      basicStylesOptions: stylesOptions.basic, // (feature, resolution, layer)
      hoverStylesOptions: stylesOptions.hover, // (feature, resolution, layer)
      // selectName: '', // Name of checkbox inputs to tune the url parameters
      // initSelect: string|true|false, // If defined, force the selector
      selector: new Selector(opt.selectName, opt.initSelect), // Tune the url parameters
      zIndex: 100, // Above tiles layers

      // Any ol.source.Vector options
      // Any ol.source.layer.Vector options

      // Methods to instantiate
      // url (extent, resolution, mapProjection) // Calculate the url
      // query (extent, resolution, mapProjection, optioons) ({_path: '...'}),
      // bboxParameter (extent, resolution, mapProjection) => {}
      // addProperties (properties) => {}, // Add properties to each received features

      ...opt,
    };
    options.format ||= new GeoJSON(options); //BEST treat & display Json errors

    super({
      url: (e, r, p) => this.url(e, r, p),
      addProperties: p => this.addProperties(p),
      style: (f, r) => this.style(f, r, this), //BEST BUG should apply on each ol.vector.layer (now only the basic layer of 3)

      ...options,
    });

    this.host = options.host;
    this.url ||= options.url;
    this.query ||= options.query;
    this.bboxParameter ||= options.bboxParameter;
    this.addProperties ||= options.addProperties;
    this.style ||= options.style;
    this.strategy = options.strategy;
    this.dataProjection = options.dataProjection;
    this.format = options.format;
    this.selector = options.selector;

    // Define the selector action
    this.selector.callbacks.push(() => this.reload());
    this.reload();
  }

  url(...args) {
    const urlArgs = this.query(...args, this.options),
      url = this.host + urlArgs._path; // Mem _path

    urlArgs.bbox = this.bboxParameter(...args);

    // Clean null & not relative parameters
    Object.keys(urlArgs).forEach(k => {
      if (k === '_path' || urlArgs[k] === 'on' || !urlArgs[k] || !urlArgs[k].toString())
        delete urlArgs[k];
    });

    // Add a pseudo parameter if any marker or edit has been done
    if (this.options.lastChangeTime)
      urlArgs.v = this.options.lastChangeTime;

    return url + '?' + new URLSearchParams(urlArgs).toString();
  }

  bboxParameter(extent, resolution, mapProjection) {
    return transformExtent(
      extent,
      mapProjection,
      this.dataProjection, // Received projection
    ).map(c => c.toPrecision(6)); // Limit the number of digits (10 m)
  }

  addProperties() {}

  // Function returning an array of styles options
  style(feature, ...args) {
    const sof = feature.getProperties().cluster ?
      stylesOptions.cluster :
      this.options.basicStylesOptions;

    return sof(feature, ...args) // Call the styleOptions function
      .map(so => new Style(so)); // Transform into an array of Style objects
  }

  // Define reload action
  reload() {
    return super.reload(this.selector.getSelection().length > 0);
  }
}

export default MyVectorLayer;