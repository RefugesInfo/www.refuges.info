/**
 * Geolocation control
 * Display status, altitude & speed
 */

import ol from '../ol';
import Button from './Button';

export class MyGeolocation extends Button {
  constructor(options) {
    super(
      location.href.match(/(https|localhost)/) ? {
        // Button options
        className: 'myol-button-geolocation',
        subMenuId: 'myol-button-geolocation',
        subMenuHTML: subMenuHTML,
        subMenuHTML_fr: subMenuHTML_fr,

        // ol.Geolocation options
        // https://www.w3.org/TR/geolocation/#position_options_interface
        enableHighAccuracy: true,
        maximumAge: 1000,
        timeout: 1000,

        ...options,
      } :
      // Hide if http
      {
        className: 'myol-button-hide',
      });

    // Add status display element
    this.statusEl = document.createElement('p');
    this.element.appendChild(this.statusEl);

    this.addGraticule();

    // Browser heading from the inertial & magnetic sensors
    window.addEventListener('deviceorientationabsolute', evt => {
      this.heading = evt.alpha || evt.webkitCompassHeading; // Android || iOS
      this.subMenuAction(evt);
    });
  } // End constructor

  addGraticule() {
    this.graticuleFeature = new ol.Feature();
    this.northGraticuleFeature = new ol.Feature();

    this.graticuleFeature.setStyle(new ol.style.Style({
      stroke: new ol.style.Stroke({
        color: '#00f',
        lineDash: [16, 14],
        width: 1,
      }),
    }));

    this.northGraticuleFeature.setStyle(new ol.style.Style({
      stroke: new ol.style.Stroke({
        color: '#c00',
        lineDash: [16, 14],
        width: 1,
      }),
    }));

    this.graticuleLayer = new ol.layer.Vector({
      source: new ol.source.Vector({
        features: [this.graticuleFeature, this.northGraticuleFeature],
      }),
      wrapX: false,
      zIndex: 300, // Above the features
    });
  }

  setMap(map) {
    map.addLayer(this.graticuleLayer);
    map.on('moveend', evt => this.subMenuAction(evt)); // Refresh graticule after map zoom

    this.geolocation = new ol.Geolocation({
      projection: map.getView().getProjection(),
      trackingOptions: this.options,

      ...this.options,
    });
    this.geolocation.on('change', evt => this.subMenuAction(evt));
    this.geolocation.on('error', error => {
      console.log('Geolocation error: ' + error.message);
    });

    return super.setMap(map);
  }

  buttonAction(evt) {
    const sourceEls = document.getElementsByName('myol-gps-source'),
      buttonSelected = document.querySelector('.myol-button-geolocation.myol-button-selected');

    if (evt.type == 'click' && !buttonSelected && sourceEls[0].checked)
      sourceEls[1].click();
  }

  subMenuAction(evt) {
    const sourceLevelEl = document.querySelector('input[name="myol-gps-source"]:checked'),
      displayEls = document.getElementsByName('myol-gps-display'),
      displayLevelEl = document.querySelector('input[name="myol-gps-display"]:checked'),
      sourceLevel = sourceLevelEl ? parseInt(sourceLevelEl.value) : 0, // On/off, GPS, GPS&WiFi
      displayLevel = displayLevelEl ? parseInt(displayLevelEl.value) : 0, // Graticule & sourceLevel
      map = this.getMap(),
      view = map ? map.getView() : null;

    // Tune the tracking level
    if (evt.target.name == 'myol-gps-source') {
      this.geolocation.setTracking(sourceLevel > 0);
      this.graticuleLayer.setVisible(false);
      if (!sourceLevel)
        displayEls[0].checked = true;
      if (sourceLevel && displayLevel == 0)
        displayEls[2].checked = true;
    }

    // Get geolocation values
    ['Position', 'AccuracyGeometry', 'Speed', 'Altitude'].forEach(valueName => {
      const value = this.geolocation['get' + valueName]();
      if (value)
        this[valueName.toLowerCase()] = value;
    });

    // State 1 only takes positions from the GPS which have an altitude
    if (sourceLevel == 0 ||
      (sourceLevel == 1 && !this.altitude))
      this.position = null;

    // Aware all who needs
    map.dispatchEvent({
      type: 'myol:gpspositionchanged',
      position: this.position,
    });

    // Render position & graticule
    if (map && view && sourceLevel && this.position) {
      // Estimate the viewport size to draw a visible graticule
      const p = this.position,
        hg = map.getCoordinateFromPixel([0, 0]),
        bd = map.getCoordinateFromPixel(map.getSize()),
        far = Math.hypot(hg[0] - bd[0], hg[1] - bd[1]) * 10,
        // The graticule
        geometry = [
          new ol.geom.MultiLineString([
            [
              [p[0] - far, p[1]],
              [p[0] + far, p[1]]
            ],
            [
              [p[0], p[1]],
              [p[0], p[1] - far]
            ],
          ]),
        ],
        // Color north in red
        northGeometry = [
          new ol.geom.LineString([
            [p[0], p[1]],
            [p[0], p[1] + far]
          ]),
        ];

      // The accuracy circle
      if (this.accuracygeometry)
        geometry.push(this.accuracygeometry);

      this.graticuleFeature.setGeometry(new ol.geom.GeometryCollection(geometry));
      this.northGraticuleFeature.setGeometry(new ol.geom.GeometryCollection(northGeometry));

      // Center the map
      if (displayLevel > 0)
        view.setCenter(p);

      // Orientation
      if (!sourceLevel || displayLevel == 1)
        view.setRotation(0);
      else if (this.heading && displayLevel == 2)
        view.setRotation(
          Math.PI / 180 * (this.heading - screen.orientation.angle) // Delivered ° reverse clockwize
        );

      // Zoom on the area
      if (!this.isZoomed) { // Only the first time after activation
        this.isZoomed = true;
        view.setZoom(17);

        // Close submenu when GPS locates
        this.element.classList.remove('myol-button-hover');
        this.element.classList.remove('myol-button-selected');
      }
      this.graticuleLayer.setVisible(true);
    } else
      view.setRotation(0); // Return to inactive state

    // Display data under the button
    let status = this.position ? '' : 'Sync...';
    if (this.altitude) {
      status = Math.round(this.altitude) + ' m';
      if (this.speed)
        status += ' ' + (Math.round(this.speed * 36) / 10) + ' km/h';
    }
    if (this.statusEl)
      this.statusEl.innerHTML = sourceLevel ? status : '';

    // Close the submenu
    if (evt.target.name) // Only when an input is hit
      this.element.classList.remove('myol-display-submenu');
  } // End subMenuAction
}

var subMenuHTML = '<p>\
  <input type="radio" name="myol-gps-source" value="0" checked="checked">None &nbsp;\
  <input type="radio" name="myol-gps-source" value="1">Outdoor &nbsp;\
  <input type="radio" name="myol-gps-source" value="2">Indoor &nbsp;\
  </p><hr><p>\
  <input type="radio" name="myol-gps-display" value="0" checked="checked">Free map&nbsp;\
  <input type="radio" name="myol-gps-display" value="1">Center &nbsp;\
  <input type="radio" name="myol-gps-display" value="2">Center & orient &nbsp;\
  </p>';

var subMenuHTML_fr = '\
  <p>Localisation GPS:</p>\
  <label>\
    <input type="radio" name="myol-gps-source" value="0" checked="checked">\
    Inactif</label><label>\
    <input type="radio" name="myol-gps-source" value="1">\
    Position GPS <span>(1) extérieur</span></label><label>\
    <input type="radio" name="myol-gps-source" value="2">\
    Position GPS ou IP <span>(2) intérieur</span></label>\
  <hr><label>\
    <input type="radio" name="myol-gps-display" value="0" checked="checked">\
    Graticule, carte libre</label><label>\
    <input type="radio" name="myol-gps-display" value="1">\
    Centre la carte, nord en haut</label><label>\
    <input type="radio" name="myol-gps-display" value="2">\
    Centre et oriente la carte <span>(3)</span></label>\
  <hr>\
  <p>(1) plus précis en extérieur mais plus lent à initialiser,\
    nécessite un capteur et une réception GPS.</p>\
  <p>(2) plus précis et rapide en intérieur ou en zone urbaine\
    mais peut être très erroné en extérieur à l\'initialisation.\
    Utilise les position des points WiFi proches en plus du GPS dont il peut se passer.</p>\
  <p>(3) nécessite un capteur magnétique et un explorateur le supportant.</p>';

export default MyGeolocation;