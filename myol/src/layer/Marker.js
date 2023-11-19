/**
 * Marker position display & edit
 */

import ol from '../ol';
import proj4Lib from 'proj4/lib/index';

export class Marker extends ol.layer.Vector {
  constructor(options) {
    options = {
      // src: 'imageUrl', // url of marker image
      defaultPosition: [localStorage.myol_lon || 2, localStorage.myol_lat || 47], // Initial position of the marker
      // dragable: false, // Can draw the marker to edit position
      // focus: number // Center & value of zoom on the marker
      zIndex: 600, // Above points & hover

      prefix: 'marker', // Will take the values on
      // marker-json, // <input> json form
      // marker-lon, marker-lat, // <input> longitude / latitude
      // marker-x, marker-y', // <input> Swiss EPSG:21781
      // marker-select, marker-string, select // display coords format

      ...options,
    };

    const point = new ol.geom.Point(
      ol.proj.transform(options.defaultPosition, 'EPSG:4326', 'EPSG:3857') // If no json value
    );

    super({
      source: new ol.source.Vector({
        features: [new ol.Feature({
          geometry: point,
        })],
        wrapX: false,

        ...options,
      }),
      style: new ol.style.Style({
        image: new ol.style.Icon(options),
      }),
      properties: {
        marker: true, // To recognise that this is a marker
      },

      ...options
    });

    this.options = options;
    this.point = point;

    // Initialise specific projection
    if (typeof proj4Lib == 'function') {
      // Swiss
      proj4Lib.defs('EPSG:21781',
        '+proj=somerc +lat_0=46.95240555555556 +lon_0=7.439583333333333 ' +
        '+k_0=1 +x_0=600000 +y_0=200000 +ellps=bessel ' +
        '+towgs84=660.077,13.551,369.344,2.484,1.783,2.939,5.66 +units=m +no_defs'
      );
      // UTM zones
      for (let u = 1; u <= 60; u++) {
        proj4Lib.defs('EPSG:' + (32600 + u), '+proj=utm +zone=' + u + ' +ellps=WGS84 +datum=WGS84 +units=m +no_defs');
        proj4Lib.defs('EPSG:' + (32700 + u), '+proj=utm +zone=' + u + ' +ellps=WGS84 +datum=WGS84 +units=m +no_defs');
      }
      ol.proj.proj4.register(proj4Lib);
    }

    // Register the action listeners
    this.els = [];
    ['json', 'lon', 'lat', 'x', 'y', 'select', 'string'].forEach(i => {
      this.els[i] = document.getElementById(this.options.prefix + '-' + i) || document.createElement('div');
      this.els[i].addEventListener('change', evt => this.action(evt.target));
    });
  }

  setMapInternal(map) {
    map.once('postrender', () => { //HACK the only event to trigger if the map is not centered
      this.view = map.getView();

      this.action(this.els.lon); // Il value is provided in lon / lat inputs fields
      this.action(this.els.json); // Il value is provided in json inputs fields
      if (this.options.focus)
        this.view.setZoom(this.options.focus);
    });

    // Change the cursor over a dragable feature
    map.on('pointermove', evt => {
      const hoverDragable = map.getFeaturesAtPixel(evt.pixel, {
        layerFilter: l => {
          if (this.options.dragable)
            return l.ol_uid == this.ol_uid;
        }
      });

      map.getTargetElement().style.cursor = hoverDragable.length ? 'move' : 'auto';
      //BEST change cursor to grab / grabbing
    });

    // Drag the marker
    if (this.options.dragable) {
      map.addInteraction(new ol.interaction.Pointer({
        handleDownEvent: evt => {
          return map.getFeaturesAtPixel(evt.pixel, {
            layerFilter: l => {
              return l.ol_uid == this.ol_uid;
            }
          }).length;
        },
        handleDragEvent: evt => {
          this.changeLL(evt.coordinate, 'EPSG:3857');
        },
      }));

      // Get the marker at the dblclick position
      map.on('dblclick', evt => {
        this.changeLL(evt.coordinate, 'EPSG:3857');
        return false;
      });
    }

    return super.setMapInternal(map);
  } // End setMapInternal

  // Read new values
  action(el) {
    // Find changed input type from tne input id
    const idMatch = el.id.match(/-([a-z]+)/);

    if (idMatch)
      switch (idMatch[1]) {
        case 'json': // Init the field
          this.changeLL([...this.els.json.value.matchAll(/-?[0-9.]+/g)], 'EPSG:4326', true);
          break;
        case 'lon': // Change lon / lat
        case 'lat':
          this.changeLL([this.els.lon.value, this.els.lat.value], 'EPSG:4326', true);
          break;
        case 'x': // Change X / Y
        case 'y':
          this.changeLL([this.els.x.value, this.els.y.value], 'EPSG:21781', true);
          break;
        case 'select': // Change the display format
          this.changeLL();
      }
  }

  // Display values
  changeLL(pos, projection, focus) {
    sessionStorage.myol_lastchange = Date.now(); // Mem the last change date

    // If no position is given, use the marker's (dragged)
    if (!pos || pos.length < 2) {
      pos = this.point.getCoordinates();
      projection = 'EPSG:3857';
    }

    // Don't change if none entry
    if (!pos[0] && !pos[1])
      return;

    const ll4326 = ol.proj.transform([
      // Protection against non-digital entries / transform , into .
      parseFloat(pos[0].toString().replace(/[^-0-9]+/, '.')),
      parseFloat(pos[1].toString().replace(/[^-0-9]+/, '.'))
    ], projection, 'EPSG:4326');

    ll4326[0] -= Math.round(ll4326[0] / 360) * 360; // Wrap +-180°

    const ll3857 = ol.proj.transform(ll4326, 'EPSG:4326', 'EPSG:3857'),
      inEPSG21781 = typeof proj4Lib == 'function' &&
      ol.extent.containsCoordinate([664577, 5753148, 1167741, 6075303], ll3857);

    // Move the marker
    this.point.setCoordinates(ll3857);

    // Move the map
    if (focus && this.view)
      this.view.setCenter(ll3857);

    // Populate inputs
    this.els.lon.value = Math.round(ll4326[0] * 100000) / 100000;
    this.els.lat.value = Math.round(ll4326[1] * 100000) / 100000;
    this.els.json.value = '{"type":"Point","coordinates":[' + this.els.lon.value + ',' + this.els.lat.value + ']}';

    // Display
    const strings = {
      dec: 'Lon: ' + this.els.lon.value + ', Lat: ' + this.els.lat.value,
      dms: ol.coordinate.toStringHDMS(ll4326),
    };

    if (inEPSG21781) {
      const ll21781 = ol.proj.transform(ll4326, 'EPSG:4326', 'EPSG:21781'),
        z = Math.floor(ll4326[0] / 6 + 90) % 60 + 1,
        u = 32600 + z + (ll4326[1] < 0 ? 100 : 0),
        llutm = ol.proj.transform(ll3857, 'EPSG:4326', 'EPSG:' + u);

      // UTM zones
      strings.utm = ' UTM ' + z +
        ' E:' + Math.round(llutm[0]) + ' ' +
        (llutm[1] > 0 ? 'N:' : 'S:') + Math.round(llutm[1] + (llutm[1] > 0 ? 0 : 10000000));

      // Swiss
      this.els.x.value = Math.round(ll21781[0]);
      this.els.y.value = Math.round(ll21781[1]);
      strings.swiss = 'X=' + this.els.x.value + ', Y=' + this.els.y.value + ' (CH1903)';
    }
    // When not on the CH1903 extend, hide the choice
    else if (this.els.select.value == 'swiss')
      this.els.select.value = 'dec';

    // Hide Swiss coordinates when out of extent
    document.querySelectorAll('.xy').forEach(el =>
      el.style.display = inEPSG21781 ? '' : 'none'
    );

    // Display selected format
    this.els.string.textContent = strings[this.els.select.value || 'dec'];
  }
}

export default Marker;