/**
 * MyVectorLayer.js
 * Facilities to vector layers
 */

import ol from '../ol';

import Selector from './Selector';
import * as stylesOptions from './stylesOptions';

/**
 * GeoJSON vector display
 * display the loading status
 */
class MyVectorSource extends ol.source.Vector {
  constructor(options) {
    super(options);

    this.statusEl = document.getElementById(options.selectName + '-status');

    // Display loading satus
    this.on(['featuresloadstart', 'featuresloadend', 'error', 'featuresloaderror'], evt => {
      if (this.statusEl) this.statusEl.innerHTML =
        evt.type == 'featuresloadstart' ? '&#8987;' :
        evt.type == 'featuresloadend' ? '' :
        '&#9888;'; // Error symbol
    });

    // Compute properties when the layer is loaded & before the cluster layer is computed
    this.on('change', () =>
      this.getFeatures()
      .forEach(f => {
        if (!f._yetAdded) {
          f._yetAdded = true;
          f.setProperties(
            options.addProperties(f.getProperties()),
            true // Silent : add the feature without refresh the layer
          );
        }
      })
    );
  }

  // Redirection for cluster.source compatibility
  reload() {
    this.refresh();
  }
}

/**
 * Cluster source to manage clusters in the browser
 */
class MyClusterSource extends ol.source.Cluster {
  constructor(options) {
    // browserClusterMinDistance:50, // (pixels) distance above which the browser clusterises
    // browserClusterFeaturelMaxPerimeter: 300, // (pixels) perimeter of a line or poly above which we do not cluster

    // Any MyVectorSource options

    // Source to handle the features
    const initialSource = new MyVectorSource(options);

    // Source to handle the clusters & the isolated features
    super({
      distance: options.browserClusterMinDistance,
      source: initialSource,
      geometryFunction: geometryFunction_,
      createCluster: createCluster_,
    });

    // Generate a center point where to display the cluster
    function geometryFunction_(feature) {
      const geometry = feature.getGeometry();

      if (geometry) {
        const ex = feature.getGeometry().getExtent(),
          featurePixelPerimeter = (ex[2] - ex[0] + ex[3] - ex[1]) *
          2 / this.resolution;

        // Don't cluster lines or polygons whose the extent perimeter is more than x pixels
        if (featurePixelPerimeter > options.browserClusterFeaturelMaxPerimeter)
          this.addFeature(feature);
        else
          return new ol.geom.Point(ol.extent.getCenter(feature.getGeometry().getExtent()));
      }
    }

    // Generate the features to render the cluster
    function createCluster_(point, features) {
      let nbClusters = 0,
        includeCluster = false,
        lines = [];

      features.forEach(f => {
        const properties = f.getProperties();

        lines.push(properties.name);
        nbClusters += parseInt(properties.cluster) || 1;
        if (properties.cluster)
          includeCluster = true;
      });

      // Single feature : display it
      if (nbClusters == 1)
        return features[0];

      if (includeCluster || lines.length > 5)
        lines = ['Cliquer pour zoomer'];

      // Display a cluster point
      return new ol.Feature({
        id: features[0].getId(), // Pseudo id = the id of the first feature in the cluster
        name: stylesOptions.agregateText(lines),
        geometry: point, // The gravity center of all the features in the cluster
        features: features,
        cluster: nbClusters, //BEST voir pourquoi on ne met pas ça dans properties
      });
    }
  }

  reload() {
    // Reload the wrapped source
    this.getSource().reload();
  }
}

/**
 * Browser & server clustered layer
 */
class MyBrowserClusterVectorLayer extends ol.layer.Vector {
  constructor(options) {
    // browserClusterMinDistance: 50, // (pixels) distance above which the browser clusterises
    // Any ol.source.layer.Vector

    super({
      source: options.browserClusterMinDistance ?
        new MyClusterSource(options) : // Use a cluster source and a vector source to manages clusters
        new MyVectorSource(options), // or a vector source to get the data

      ...options,
    });

    this.options = options; // Mem for further use
  }

  // Propagate reload
  reload(visible) {
    this.setVisible(visible);
    if (visible && this.state_) //BEST find better than this.state_
      this.getSource().reload();
  }
}

class MyServerClusterVectorLayer extends MyBrowserClusterVectorLayer {
  constructor(options) {
    // serverClusterMinResolution: 100, // (map units per pixel) resolution above which we ask clusters to the server

    // Low resolutions layer to display the normal data
    super({
      ...options,
      maxResolution: options.serverClusterMinResolution,
    });

    // High resolutions layer to get and display the clusters delivered by the server at hight resolutions
    if (options.serverClusterMinResolution)
      this.altLayer = new MyBrowserClusterVectorLayer({
        minResolution: options.serverClusterMinResolution,
        ...options,
      });
  }

  setMapInternal(map) {
    super.setMapInternal(map);

    if (this.altLayer)
      map.addLayer(this.altLayer);
  }

  // Propagate the reload to the altLayer
  reload(visible) {
    super.reload(visible);

    if (this.altLayer)
      this.altLayer.reload(visible);
  }
}

/**
 * Facilities added vector layer
 * Style features
 * Layer & features selector
 */
export class MyVectorLayer extends MyServerClusterVectorLayer {
  constructor(options) {
    options = {
      // host: '',
      strategy: ol.loadingstrategy.bbox,
      dataProjection: 'EPSG:4326',
      // browserClusterMinDistance:50, // (pixels) distance above which the browser clusterises
      // browserClusterFeaturelMaxPerimeter: 300, // (pixels) perimeter of a line or poly above which we do not cluster
      // serverClusterMinResolution: 100, // (map units per pixel) resolution above which we ask clusters to the server

      basicStylesOptions: stylesOptions.basic, // (feature, layer)
      hoverStylesOptions: stylesOptions.hover,
      selector: new Selector(options.selectName),
      zIndex: 100, // Above tiles layers

      // Any ol.source.Vector options
      // Any ol.source.layer.Vector

      // Methods to instantiate
      // url (extent, resolution, mapProjection) // Calculate the url
      // query (extent, resolution, mapProjection, optioons) ({_path: '...'}),
      // bbox (extent, resolution, mapProjection) => {}
      // addProperties (properties) => {}, // Add properties to each received features

      ...options,
    };
    options.format ||= new ol.format.GeoJSON(options); //BEST treat & display JSON errors

    super({
      url: (e, r, p) => this.url(e, r, p),
      addProperties: p => this.addProperties(p),
      style: (f, r) => this.style(f, r),
      ...options,
    });

    this.host = options.host;
    this.url ||= options.url;
    this.query ||= options.query;
    this.bbox ||= options.bbox;
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

  url() {
    const args = this.query(...arguments, this.options),
      url = this.host + args._path; // Mem _path

    if (this.strategy == ol.loadingstrategy.bbox)
      args.bbox = this.bbox(...arguments);

    // Add a pseudo parameter if any marker or edit has been done
    const version = sessionStorage.myol_lastchange ?
      '&' + Math.round(sessionStorage.myol_lastchange / 2500 % 46600).toString(36) : '';

    // Clean null & not relative parameters
    Object.keys(args).forEach(k => {
      if (k == '_path' || args[k] == 'on' || !args[k] || !args[k].toString())
        delete args[k];
    });

    return url + '?' + new URLSearchParams(args).toString() + version;
  }

  bbox(extent, resolution, mapProjection) {
    return ol.proj.transformExtent(
      extent,
      mapProjection,
      this.dataProjection, // Received projection
    ).map(c => c.toPrecision(6)); // Limit the number of digits (10 m)
  }

  addProperties() {}

  style(feature, resolution) {
    // Function returning an array of styles options
    const sof = !feature.getProperties().cluster ? this.options.basicStylesOptions :
      resolution < this.options.spreadClusterMaxResolution ? stylesOptions.spreadCluster :
      stylesOptions.cluster;

    return sof(feature, this) // Call the styleOptions function
      .map(so => new ol.style.Style(so)); // Transform into an array of Style objects
  }

  // Define reload action
  reload() {
    super.reload(this.selector.getSelection().length);
  }
}

export default MyVectorLayer;