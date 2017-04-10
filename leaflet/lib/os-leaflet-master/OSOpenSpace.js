/**
 * os-leaflet ; A [Leafletjs](http://leafletjs.com/) TileLayer to display Ordnance Survey
 *       data in your Leaflet map via the OS OpenSpace web map service.
 *
 * https://github.com/rob-murray/os-leaflet
 */
(function (root, factory) {
  // UMD for  Node, AMD or browser globals
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['leaflet', 'proj4leaflet'], factory);
  } else if (typeof exports === 'object') {
    // Node & CommonJS-like environments.
    var L = require('leaflet'); // eslint-disable-line vars-on-top
    require('proj4leaflet');

    module.exports = factory(L);
  } else {
    // Browser globals
    if (typeof window.L === 'undefined') {
      throw new Error('Leaflet missing');
    }
    root.returnExports = factory(root.L);
  }
}(this, function (L) {
  /* This is our namespace for OSOpenSpace on Leaflet js */
  L.OSOpenSpace = L.OSOpenSpace || {};
  L.OSOpenSpace.VERSION = '1.0.0';
  L.OSOpenSpace.CRS = L.extend(
    new L.Proj.CRS(
      'EPSG:27700',
      '+proj=tmerc +lat_0=49 +lon_0=-2 +k=0.9996012717 +x_0=400000 +y_0=-100000 +ellps=airy +datum=OSGB36 +units=m +no_defs', {
        resolutions: [2500, 1000, 500, 200, 100, 50, 25, 10, 5, 2.5]
      }
    ), {
      distance: function (a, b) {
        return L.CRS.Earth.distance(a, b);
      }
    }
  );

  L.OSOpenSpace.LogoControl = L.Control.extend({
    options: {
      position: 'bottomleft'
    },

    onAdd: function () {
      var container = L.DomUtil.create('div', 'os-logo-control');
      var logoImage = L.DomUtil.create('img', '', container);
      logoImage.title = 'Powered by OS OpenSpace';
      logoImage.src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEIAAAA7CAMAAAD4p6zTAAAAdVBMVEUAAABDPYxDPY1AQI9EPY5EPoxEPY3///9EPY3z8/iWkr+KhrhzbqrEB1FnYaJbVZtQSZR+erGinsb00d7Fwtv78PTwwdTQz+PTRX3IF1zc2+ro5/Gtqs25ttTig6jaZJLtssn44OnLJmfpor7lk7PPNnLWVYfBOrQkAAAAB3RSTlMAUJ8Qv8+vnqzJJAAAAmNJREFUeAHl14Vi2zAUheHyuVds5nD6/o84211YcsHj/aVA85lBd0P3T/S1nu7vxh5fiIyIP58wRA+PA/FApsHXagw9DEtBhvHV2FC/LM/U4Os19Hx3RwZzMtQTAnMSAxFjTvE5QaRkg4lUARRqkgDLaC6BVHWOhBToeo9qS4adU4JIsCJrB8I5Em0EmM5HxMIJV7ORFhGlXWRaRDHVtWN2MkJNI9GwjYlrBx9RFE2sgFjZwrUy6kgpJQit6/+6DjDfFySOZStFYEFQWEbUCisb59imYKbxtVrKw1wwVFtY14QISGcN15TCSHSkXEdAZI1t+h83EtYaholwSxxqahzj4uy1gk9P2BYe4jOxFZhJ9P0vRN1K1RenjIvWu2WJbblIME1wa+mYbM6Ape7DbqP1ZjtFpJYuEoc5WVV6aLB6pcyChKDrTP0m6LcwttBVEiAk3eYGY11dEMir0k9I8uUYWOpLAknuJVLypwB9aHqjsqNAHZYfI2IKZbH+GGEpWIrXA5HkSZCoKZzE7kCUWleLzE/EFM4hPyN6ZOslJE3EOCf6tj5C0UTFNaFX84kqm03oxS0R0USM/TWx+ewWQVZeETq7IQoKF6Fvu78k8hsCjoJ1GFvnizAxvSSOceiMSD5zpMbwEbgl0JI/Ax/x6iFC29XVWCW3RO4l2JCnAiir/JoInDvBkf/sm1R6cUlUWYAAWkcXqQZD673ebLMTsUmmblGkOwMKHNpV/cwvF9lILLPpayqnQlkiFbUNzlst91onZVXu1n/mzcH8kcD88cj8UdGPGJvNHyH2PT7MHKfOHy1/Axgmj2KBwwXnAAAAAElFTkSuQmCC';

      return container;
    }
  });

  /**
   * A custom Layer for Ordnance Survey OpenSpace service.
   * Note: An API key is needed, see OS website for details
   *
   */
  L.OSOpenSpace.TileLayer = L.TileLayer.WMS.extend({
    initialize: function (apiKey, apiUrl, options) { // (String, String, Object)
      if (!apiKey) {
        throw new Error('OSOpenSpace layer requires an API Key parameter to function.');
      }
      if (!apiUrl) {
        apiUrl = 'file:///';
      }

      L.TileLayer.WMS.prototype.initialize.call(this,
        'https://openspace.ordnancesurvey.co.uk/osmapapi/ts', {
          crs: L.OSOpenSpace.CRS,
          maxZoom: 14,
          minZoom: 0,
          tileSize: 200
        },
        options
      );

      this.wmsParams = {
        KEY: apiKey,
        FORMAT: 'image/png',
        URL: apiUrl,
        REQUEST: 'GetMap',
        WIDTH: this.options.tileSize,
        HEIGHT: this.options.tileSize
      };
    },

    getAttribution: function () {
      return '&copy; Crown copyright and database rights ' +
        new Date().getFullYear() +
        ' Ordnance Survey. ' +
        '<a target="_blank" ' +
        'href="https://www.ordnancesurvey.co.uk/web-services/os-openspace/developer-agreement.html" ' +
        'title="OS OpenSpace Terms of Use">' +
        'Terms of Use</a>.';
    },

    onAdd: function (map) {
      if (map.options.attributionControl) {
        map.addControl(new L.OSOpenSpace.LogoControl());
      }
      L.TileLayer.prototype.onAdd.call(this, map);
    },

  /**
   * Return a url for this tile.
   * Calculate the bbox for the tilePoint and format the wms request
   */
    getTileUrl: function (tilePoint) { // (Point, Number) -> String
      var resolutionMpp = this.options.crs.options.resolutions[tilePoint.z],
        tileSizeMetres = this.options.tileSize * resolutionMpp,
        tileBboxX0 = tileSizeMetres * tilePoint.x,
        tileBboxY0 = tileSizeMetres * (-1 - tilePoint.y); // TODO: Is there a missing transformation ? tilePoint appears to be topLeft in this config

      // service is a tile based wms format and only requires x0, y0 - ignore other points
      this.wmsParams.BBOX = [tileBboxX0, tileBboxY0, 0, 0].join(',');
      this.wmsParams.LAYERS = resolutionMpp;

      return this._url + L.Util.getParamString(this.wmsParams); // eslint-disable-line no-underscore-dangle
    }
  });

  /*
   * Factory method to create a new OSOpenSpace tilelayer.
   *
   * @public
   * @param {string} apiKey Your API key for OSOpenSpace.
   * @param {string} apiUrl The URL of your site as provided to OSOpenSpace.
   * @param {object} options Any options to pass to the tilelayer.
   * @return {L.TileLayer} TileLayer for Ordnance Survey OpenSpace service.
   */
  L.OSOpenSpace.tilelayer = function (apiKey, apiUrl, options) {
    return new L.OSOpenSpace.TileLayer(apiKey, apiUrl, options);
  };

  return L.OSOpenSpace;
}));
