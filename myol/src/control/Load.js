/**
 * GPX file loader control
 */

import ol from '../ol';
import Button from './Button.js';

export class Load extends Button {
  constructor(options) {
    super({
      // Button options
      className: 'myol-button-load',
      subMenuId: 'myol-button-load',
      subMenuHTML: subMenuHTML,
      subMenuHTML_fr: subMenuHTML_fr,

      // receivingLayer: layer, // Layer to addFeatures when loaded

      ...options,
    });

    this.reader = new FileReader();
  }

  subMenuAction(evt) {
    const blob = evt.target.files[0];

    if (evt.type == 'change' && evt.target.files)
      this.reader.readAsText(blob);

    this.reader.onload = () => this.loadText(this.reader.result, blob.name);
  }

  // Method to load a geoJson layer from an url
  loadUrl(url) {
    if (url)
      fetch(url)
      .then(response => response.text())
      .then(text => this.loadText(text, url));
  }

  // Method to load features from a geoJson text
  loadText(text, url) {
    const map = this.getMap(),
      formatName = url.split('.').pop().toUpperCase(), // Extract extension to be used as format name
      loadFormat = new ol.format[formatName in ol.format ? formatName : 'GeoJSON'](), // Find existing format
      receivedLat = text.match(/lat="-?([0-9]+)/), // Received projection depending on the first value
      receivedProjection = receivedLat && receivedLat.length && parseInt(receivedLat[1]) > 100 ? 'EPSG:3857' : 'EPSG:4326',
      features = loadFormat.readFeatures(text, {
        dataProjection: receivedProjection,
        featureProjection: map.getView().getProjection(), // Map projection
      }),
      gpxSource = new ol.source.Vector({
        format: loadFormat,
        features: features,
        wrapX: false,
      }),
      gpxLayer = new ol.layer.Vector({
        source: gpxSource,
        style: feature => {
          const properties = feature.getProperties();

          return new ol.style.Style({
            stroke: new ol.style.Stroke({
              color: 'blue',
              width: 2,
            }),
            image: properties.sym ? new ol.style.Icon({
              src: 'https://chemineur.fr/ext/Dominique92/GeoBB/icones/' + properties.sym + '.svg',
            }) : null,
          });
        },
      }),
      fileExtent = gpxSource.getExtent();

    if (ol.extent.isEmpty(fileExtent))
      alert(url + ' ne comporte pas de point ni de trace.');
    else {
      if (this.options.receivingLayer)
        this.options.receivingLayer.getSource().addFeatures(features);
      else
        map.addLayer(gpxLayer);

      // Zoom the map on the added features
      map.getView().fit(
        fileExtent, {
          minResolution: 1,
          padding: [5, 5, 5, 5],
        });
    }

    // Close the submenu
    this.element.classList.remove('myol-display-submenu');
  }
}

var subMenuHTML = '<input type="file" accept=".gpx,.kml,.json,.geojson">',
  subMenuHTML_fr = '<p>Importer un fichier de points ou de traces</p>' + subMenuHTML;

export default Load;