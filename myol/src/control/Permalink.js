/**
 * Permalink control
 * "map" url hash or localStorage: zoom=<ZOOM> lon=<LON> lat=<LAT>
 * Don't set view when you declare the map
 */

import ol from '../ol';

export class Permalink extends ol.control.Control {
  constructor(options) {
    options = {
      // display: false, // {false | true} Display permalink link the map.
      // init: false, // {false | true | [<zoom>, <lon>, <lat>]} use url hash or localStorage to position the map.
      default: [6, 2, 47], // France
      // setUrl: false, // {false | true} Change url hash when moving the map.
      hash: '?', // {?, #} the permalink delimiter after the url

      ...options,
    };

    super({
      element: document.createElement('div'),

      ...options,
    });

    this.options = options;

    if (options.display) {
      this.element.className = 'ol-control myol-permalink';
      this.linkEl = document.createElement('a');
      this.linkEl.innerHTML = 'Permalink';
      this.linkEl.title = 'Generate a link with map zoom & position';
      this.element.appendChild(this.linkEl);
    }
  }

  render(evt) {
    const view = evt.map.getView(),
      urlMod =
      //BEST init with res=<resolution>
      //BEST init with extent (not zoom, lon, lat)
      'zoom=' + this.options.init[0] + '&lon=' + this.options.init[1] + '&lat=' + this.options.init[2] + ',' + // init: [<zoom>, <lon>, <lat>]
      location.href.replace( // Get value from params with priority url / ? / #
        /map=([0-9.]+)\/(-?[0-9.]+)\/(-?[0-9.]+)/, // map=<zoom>/<lon>/<lat>
        'zoom=$1&lon=$2&lat=$3' // zoom=<zoom>&lon=<lon>&lat=<lat>
      ) + ',' +
      // Last values
      'zoom=' + localStorage.myol_zoom + ',' +
      'lon=' + localStorage.myol_lon + ',' +
      'lat=' + localStorage.myol_lat + ',' +
      // Default
      'zoom=' + this.options.default[0] + '&lon=' + this.options.default[1] + '&lat=' + this.options.default[2];

    // Set center & zoom at the init
    if (this.options.init) {
      this.options.init = false; // Only once

      view.setZoom(urlMod.match(/zoom=([0-9.]+)/)[1]);

      view.setCenter(ol.proj.transform([
        urlMod.match(/lon=(-?[0-9.]+)/)[1],
        urlMod.match(/lat=(-?[0-9.]+)/)[1],
      ], 'EPSG:4326', 'EPSG:3857'));
    }

    // Set the permalink with current map zoom & position
    if (view.getCenter()) {
      const ll4326 = ol.proj.transform(view.getCenter(), 'EPSG:3857', 'EPSG:4326'),
        newParams = 'map=' +
        (localStorage.myol_zoom = Math.round(view.getZoom() * 10) / 10) + '/' +
        (localStorage.myol_lon = Math.round(ll4326[0] * 10000) / 10000) + '/' +
        (localStorage.myol_lat = Math.round(ll4326[1] * 10000) / 10000);

      if (this.linkEl) {
        this.linkEl.href = this.options.hash + newParams;

        if (this.options.setUrl)
          location.href = '#' + newParams;
      }
    }

    return super.render(evt);
  }
}

export default Permalink;