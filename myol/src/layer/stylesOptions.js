/**
 * Some usefull style functions
 * These functions return an area of style options to be transformed into an area of Style
 * They all take 2 arguments :
 *   feature : to be displayed
 *   layer : that owns the feature
 */

import Circle from 'ol/style/Circle';
import Fill from 'ol/style/Fill';
import {
  getArea,
} from 'ol/extent';
import Icon from 'ol/style/Icon';
import Stroke from 'ol/style/Stroke';
import Text from 'ol/style/Text';

// Display a label with properties.label
export function label(feature) {
  const properties = feature.getProperties();

  if (properties.label) {
    const featureArea = getArea(feature.getGeometry().getExtent()),
      elLabel = document.createElement('span');

    elLabel.innerHTML = properties.label; //HACK to render the html entities in the canvas

    return {
      text: new Text({
        text: elLabel.innerText,
        overflow: properties.overflow, // Display label even if not contained in polygon
        textBaseline: featureArea ? 'middle' : 'bottom',
        offsetY: featureArea ? 0 : -13, // Above the icon
        padding: [1, 1, -1, 3],
        //BEST line & poly label following the cursor
        font: '12px Verdana',
        fill: new Fill({
          color: 'black',
        }),
        backgroundFill: new Fill({
          color: 'white',
        }),
        backgroundStroke: new Stroke({
          color: 'blue',
        }),
      }),
    };
  }
}

// Basic style to display a geo vector layer based on standard properties
export function basic(feature, resolution, layer) {
  const properties = feature.getProperties();

  return [{
    // Point
    image: properties.icon ?
      new Icon({
        anchor: resolution < layer.options.minResolution ? [
          feature.getId() / 5 % 1 / 2 + 0.25, // 32 px width frame
          feature.getId() / 9 % 1, // 44 px hight frame
        ] : [0.5, 0.5],
        src: properties.icon, // 24 * 24 icons
      }) : null,

    // Lines
    stroke: new Stroke({
      color: 'blue',
      width: 2,
    }),

    // Polygons
    fill: new Fill({
      color: 'rgba(0,0,256,0.3)',
    }),
    // properties.label if any
    //BEST appliquer gigue anchor au label
    ...label(...arguments),
  }];
}

// Display a circle with the number of features on the cluster
export function cluster(feature) {
  return [{
    image: new Circle({
      radius: 14,
      stroke: new Stroke({
        color: 'blue',
      }),
      fill: new Fill({
        color: 'white',
      }),
    }),
    //BEST laisser le texte sur les clusters < 3 icônes
    text: new Text({
      text: feature.getProperties().cluster.toString(),
      font: '12px Verdana',
    }),
  }];
}

// Display the detailed information of a cluster based on standard properties
// Simplify & aggregate an array of lines
export function agregateText(lines, glue) {
  return lines
    .filter(Boolean) // Avoid empty lines
    .map(l => l.toString().replace('_', ' ').trim())
    .map(l => l[0].toUpperCase() + l.substring(1))
    .join(glue || '\n');
}

export function details(feature, resolution, layer) {
  const properties = feature.getProperties();

  feature.setProperties({
    overflow: true, // Display label even if not contained in polygon
    label: agregateText([
      properties.name,
      agregateText([
        properties.ele ? parseInt(properties.ele, 10) + ' m' : null,
        properties.bed ? parseInt(properties.bed, 10) + '\u255E\u2550\u2555' : null,
      ], ', '),
      properties.type,
      properties.cluster ? null : properties.attribution || layer.options.attribution,
    ]),
  }, true);

  return label(...arguments);
}

// Display the basic hovered features
export function hover(...args) {
  return {
    ...details(...args),

    stroke: new Stroke({
      color: 'red',
      width: 2,
    }),
  };
}