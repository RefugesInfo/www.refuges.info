/**
 * Some usefull style functions
 * These functions return an area of style options to be transformed into an area of Style
 * They all take 2 arguments :
 *   feature : to be displayed
 *   layer : that owns the feature
 */

import ol from '../ol';

// Basic style to display a geo vector layer based on standard properties
export function basic(feature, resolution, layer) {
  const properties = feature.getProperties();

  return [{
    // Point
    image: properties.icon ? new ol.style.Icon({
      anchor: resolution < layer.options.minResolution ? [
        feature.getId() / 5 % 1 / 2 + 0.25, // 32 px width frame
        feature.getId() / 9 % 1, // 44 px hight frame
      ] : [0.5, 0.5],
      src: properties.icon, // 24 * 24 icons
      //BEST ??? crossOrigin: 'anonymous',
    }) : null,

    // Lines
    stroke: new ol.style.Stroke({
      color: 'blue',
      width: 2,
    }),

    // Polygons
    fill: new ol.style.Fill({
      color: 'rgba(0,0,256,0.3)',
    }),
    // properties.label if any
    //BEST appliquer gigue anchor au label
    ...label(...arguments),
  }];
}

// Display a label with properties.label
export function label(feature) {
  const properties = feature.getProperties();

  if (properties.label) {
    const featureArea = ol.extent.getArea(feature.getGeometry().getExtent()),
      elLabel = document.createElement('span');

    elLabel.innerHTML = properties.label; //HACK to render the html entities in the canvas

    return {
      text: new ol.style.Text({
        text: elLabel.innerHTML,
        overflow: properties.overflow, // Display label even if not contained in polygon
        textBaseline: featureArea ? 'middle' : 'bottom',
        offsetY: featureArea ? 0 : -13, // Above the icon
        padding: [1, 1, -1, 3],
        //BEST line & poly label following the cursor
        font: '12px Verdana',
        fill: new ol.style.Fill({
          color: 'black',
        }),
        backgroundFill: new ol.style.Fill({
          color: 'white',
        }),
        backgroundStroke: new ol.style.Stroke({
          color: 'blue',
        }),
      }),
    };
  }
}

// Display a circle with the number of features on the cluster
export function cluster(feature) {
  return [{
    image: new ol.style.Circle({
      radius: 14,
      stroke: new ol.style.Stroke({
        color: 'blue',
      }),
      fill: new ol.style.Fill({
        color: 'white',
      }),
    }),
    //TODO laisser le texte sur les clusters < 3 icônes
    text: new ol.style.Text({
      text: feature.getProperties().cluster.toString(),
      font: '12px Verdana',
    }),
  }];
}

// Display the detailed information of a cluster based on standard properties
export function details(feature, resolution, layer) {
  const properties = feature.getProperties();

  feature.setProperties({
    overflow: true, // Display label even if not contained in polygon
    label: agregateText([
      properties.name,
      agregateText([
        properties.ele ? parseInt(properties.ele) + ' m' : null,
        properties.bed ? parseInt(properties.bed) + '\u255E\u2550\u2555' : null,
      ], ', '),
      properties.type,
      properties.cluster ? null : properties.attribution || layer.options.attribution,
    ]),
  }, true);

  return label(...arguments);
}

// Display the basic hovered features
export function hover() {
  return {
    ...details(...arguments),

    stroke: new ol.style.Stroke({
      color: 'red',
      width: 2,
    }),
  };
}

// Simplify & aggregate an array of lines
export function agregateText(lines, glue) {
  return lines
    .filter(Boolean) // Avoid empty lines
    .map(l => l.toString().replace('_', ' ').trim())
    .map(l => l[0].toUpperCase() + l.substring(1))
    .join(glue || '\n');
}