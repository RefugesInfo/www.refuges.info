/**
 * Download control to download vectors features
 * Supports GPX, KML, GeoJSON formats
 */
import Feature from 'ol/Feature';
import * as format from 'ol/format';
import LineString from 'ol/geom/LineString';

import Button from './Button';

const subMenuHTML = '\
  <p><a mime="application/gpx+xml">GPX</a></p>\
  <p><a mime="vnd.google-earth.kml+xml">KML</a></p>\
  <p><a mime="application/json">GeoJSON</a></p>',

  subMenuHTMLfr = '\
  <p>Cliquer sur un format ci-dessous pour obtenir\
  un fichier contenant les éléments visibles dans la fenêtre:</p>' +
  subMenuHTML;

//BEST BUG incompatible with clusters
class Download extends Button {
  constructor(opt) {
    const options = {
      // Button options
      className: 'myol-button-download',
      subMenuId: 'myol-button-download',
      subMenuHTML: subMenuHTML,
      subMenuHTMLfr: subMenuHTMLfr,

      // savedLayer: layer, // Layer to download
      fileName: document.title || 'openlayers', // Name of the file to be downloaded 
      //BEST name from feature

      ...opt,
    };

    super(options);

    // Add a hidden element to handle the download
    this.hiddenEl = document.createElement('a');
    this.hiddenEl.target = '_self';
    this.hiddenEl.style = 'display:none';
    this.element.appendChild(this.hiddenEl);
  }

  subMenuAction(evt) {
    const map = this.getMap(),
      formatName = evt.target.innerText,
      downloadFormat = new format[formatName](),
      mime = evt.target.getAttribute('mime'),
      mapExtent = map.getView().calculateExtent();

    let featuresToSave = [];

    if (this.options.savedLayer)
      featuresToSave = this.options.savedLayer.getSource().getFeatures();
    else
      // Get all visible features
      map.getLayers().forEach(l => {
        if (!l.getProperties().marker &&
          l.getSource() && l.getSource().forEachFeatureInExtent) // For vector layers only
          l.getSource().forEachFeatureInExtent(mapExtent, feature =>
            featuresToSave.push(feature)
          );
      });

    if (formatName === 'GPX')
      // Transform *Polygons in linestrings
      for (const f in featuresToSave) {
        const geometry = featuresToSave[f].getGeometry();

        if (geometry.getType().includes('Polygon')) {
          geometry.getCoordinates().forEach(coords => {
            if (typeof coords[0][0] === 'number')
              // Polygon
              featuresToSave.push(new Feature(new LineString(coords)));
            else
              // MultiPolygon
              coords.forEach(subCoords =>
                featuresToSave.push(new Feature(new LineString(subCoords)))
              );
          });
        }
      }

    const data = downloadFormat.writeFeatures(featuresToSave, {
        dataProjection: 'EPSG:4326',
        featureProjection: map.getView().getProjection(), // Map projection
        decimals: 5,
      })
      // Beautify the output
      .replace(/<[a-z]*>(0|null|[[object Object]|[NTZa:-]*)<\/[a-z]*>/gu, '')
      .replace(/<Data name="[a-z_]*"\/>|<Data name="[a-z_]*"><\/Data>|,"[a-z_]*":""/gu, '')
      .replace(/<Data name="copy"><value>[a-z_.]*<\/value><\/Data>|,"copy":"[a-z_.]*"/gu, '')
      .replace(/(<\/gpx|<\/?wpt|<\/?trk>|<\/?rte>|<\/kml|<\/?Document)/gu, '\n$1')
      .replace(/(<\/?Placemark|POINT|LINESTRING|POLYGON|<Point|"[a-z_]*":|\})/gu, '\n$1')
      .replace(/(<name|<ele|<sym|<link|<type|<rtept|<\/?trkseg|<\/?ExtendedData)/gu, '\n\t$1')
      .replace(/(<trkpt|<Data|<LineString|<\/?Polygon|<Style)/gu, '\n\t\t$1')
      .replace(/(<[a-z]+BoundaryIs)/gu, '\n\t\t\t$1')
      .replace(/ ([cvx])/gu, '\n\t$1');

    const file = new Blob([data], {
      type: mime,
    });

    this.hiddenEl.download = this.options.fileName + '.' + formatName.toLowerCase();
    this.hiddenEl.href = URL.createObjectURL(file);
    this.hiddenEl.click();

    // Close the submenu
    this.element.classList.remove('myol-display-submenu');
  }
}

export default Download;