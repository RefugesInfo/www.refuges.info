/**
 * Load control to load vectors features
 * Supports any format supported by Openlayers
 */

import * as format from 'ol/format';
import Icon from 'ol/style/Icon';
import {
  isEmpty,
} from 'ol/extent';
import VectorLayer from 'ol/layer/Vector';
import VectorSource from 'ol/source/Vector';
import Stroke from 'ol/style/Stroke';
import Style from 'ol/style/Style';

import Button from './Button';

const subMenuHTML = '<input type="file" accept=".gpx,.kml,.json,.geojson">',
  subMenuHTMLfr = '<p>Importer un fichier de points ou de traces</p>' + subMenuHTML;

class Load extends Button {
  constructor(options) {
    super({
      className: 'myol-button-load', // Button options
      subMenuId: 'myol-button-load',
      subMenuHTML: subMenuHTML,
      subMenuHTMLfr: subMenuHTMLfr,
      // loadedStyleOptions: {}, // Style of the loaded features
      // receivingLayer: layer, // Layer to addFeatures when loaded

      ...options,
    });

    this.reader = new FileReader();
  }

  subMenuAction(evt) {
    const blob = evt.target.files[0];

    if (evt.type === 'change' && evt.target.files)
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

  // Method to load features from a GeoJSON text
  loadText(text, url) {
    const map = this.getMap(),
      formatName = url.split('.').pop().toUpperCase(), // Extract extension to be used as format name
      loadFormat = new format[formatName in format ? formatName : 'GeoJSON']({ // Find existing format
        extractStyles: false, // For KML
      }),
      receivedLat = text.match(/lat="-?([0-9]+)/u); // Received projection depending on the first value

    const receivedProjection =
      receivedLat &&
      receivedLat.length &&
      (parseInt(receivedLat[1], 10) > 100 ? 'EPSG:3857' : 'EPSG:4326');

    const features = loadFormat.readFeatures(text, {
      dataProjection: receivedProjection,
      featureProjection: map.getView().getProjection(), // Map projection
    });

    const gpxSource = new VectorSource({
      format: loadFormat,
      features: features,
      wrapX: false,
    });

    const fileExtent = gpxSource.getExtent();

    if (isEmpty(fileExtent))
      alert(url + ' ne comporte pas de point ni de trace.');
    else {
      // Add received features to the layer defined in potion
      if (this.options.receivingLayer)
        this.options.receivingLayer.getSource().addFeatures(features);
      // Or create a new layer
      else {
        map.addLayer(new VectorLayer({
          source: gpxSource,

          style: feature => {
            const properties = feature.getProperties();

            return new Style({
              stroke: new Stroke({
                color: 'blue',
                width: 2,
              }),
              image: properties.sym ? new Icon({
                src: 'https://chemineur.fr/ext/Dominique92/GeoBB/icones/' + properties.sym + '.svg',
              }) : null,

              ...this.options.loadedStyleOptions,
            });
          },
        }));
      }

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

export default Load;