/**
 * Editor.js
 * geoJson lines & polygons edit
 */

import ol from '../ol';
import Button from '../control/Button';
import './editor.css';

//TODO ? ne montre pas départ / arrivée + tests sur permutation de sens

// Default french text
const helpModifFr = {
    inspect: '\
<p><b><u>EDITEUR</u>: Inspecter une ligne ou un polygone</b></p>\
<p>Cliquer sur le bouton &#x2048 (qui bleuit) puis</p>\
<p>Survoler l\'objet avec le curseur pour:</p>\
<p>Distinguer une ligne ou un polygone des autres</p>\
<p>Calculer la longueur d\'une ligne ou un polygone</p>',
    line: '\
<p><b><u>EDITEUR</u>: Modifier une ligne</b></p>\
<p>Cliquer sur le bouton &#x2725; (qui bleuit) puis</p>\
<p>Pointer le curseur sur une ligne</p>\
<p><u>Déplacer un sommet</u>: Cliquer sur le sommet et le déplacer</p>\
<p><u>Ajouter un sommet au milieu d\'un segment</u>: cliquer le long du segment puis déplacer</p>\
<p><u>Supprimer un sommet</u>: Alt+cliquer sur le sommet</p>\
<p><u>Couper une ligne en deux</u>: Alt+cliquer sur le segment à supprimer</p>\
<p><u>Inverser la direction d\'une ligne</u>: Shift+cliquer sur le segment à inverser</p>\
<p><u>Fusionner deux lignes</u>: déplacer l\'extrémité d\'une ligne pour rejoindre l\'autre</p>\
<p><u>Supprimer une ligne</u>: Ctrl+Alt+cliquer sur un segment</p>',
    poly: '\
<p><b><u>EDITEUR</u>: Modifier un polygone</b></p>\
<p>Cliquer sur le bouton &#x2725; (qui bleuit) puis </p>\
<p>Pointer le curseur sur un bord de polygone</p>\
<p><u>Déplacer un sommet</u>: Cliquer sur le sommet et le déplacer</p>\
<p><u>Ajouter un sommet au milieu d\'un segment</u>: cliquer le long du segment puis déplacer</p>\
<p><u>Supprimer un sommet</u>: Alt+cliquer sur le sommet</p>\
<p><u>Scinder un polygone</u>: joindre 2 sommets du polygone puis Alt+cliquer sur le sommet commun</p>\
<p><u>Fusionner 2 polygones</u>: superposer un côté (entre 2 sommets consécutifs)\
 de chaque polygone puis Alt+cliquer dessus</p>\
<p><u>Supprimer un polygone</u>: Ctrl+Alt+cliquer sur un segment</p>',
    both: '\
<p><b><u>EDITEUR</u>: Modifier une ligne ou un polygone</b></p>\
<p>Pointer le curseur sur une ligne ou un bord de polygone</p>\
<p>Cliquer sur le bouton &#x2725; (qui bleuit) puis</p>\
<p><u>Déplacer un sommet</u>: Cliquer sur le sommet et le déplacer</p>\
<p><u>Ajouter un sommet au milieu d\'un segment</u>: cliquer le long du segment puis déplacer</p>\
<p><u>Supprimer un sommet</u>: Alt+cliquer sur le sommet</p>\
<p><u>Couper une ligne en deux</u>: Alt+cliquer sur le segment à supprimer</p>\
<p><u>Inverser la direction d\'une ligne</u>: Shift+cliquer sur le segment à inverser</p>\
<p><u>Transformer un polygone en ligne</u>: Alt+cliquer sur un côté</p>\
<p><u>Fusionner deux lignes</u>: déplacer l\'extrémité d\'une ligne pour rejoindre l\'autre</p>\
<p><u>Transformer une ligne en polygone</u>: déplacer une extrémité pour rejoindre l\'autre</p>\
<p><u>Scinder un polygone</u>: joindre 2 sommets du polygone puis Alt+cliquer sur le sommet commun</p>\
<p><u>Fusionner 2 polygones</u>: superposer un côté (entre 2 sommets consécutifs)\
 de chaque polygone puis Alt+cliquer dessus</p>\
<p><u>Supprimer une ligne ou un polygone</u>: Ctrl+Alt+cliquer sur un segment</p>',
  },

  helpLineFr = '\
<p><b><u>EDITEUR</u>: Créer une ligne</b></p>\
<p>Cliquer sur le bouton &#x2608; (qui bleuit) puis</p>\
<p>Cliquer sur l\'emplacement du début</p>\
<p>Puis sur chaque sommet</p>\
<p>Double cliquer sur le dernier sommet pour terminer</p>\
<hr>\
<p>Cliquer sur une extrémité d\'une ligne existante pour l\'étendre</p>',

  helpPolyFr = '\
<p><b><u>EDITEUR</u>: Créer un polygone</b></p>\
<p>Cliquer sur le bouton &#x23E2; (qui bleuit) puis</p>\
<p>Cliquer sur l\'emplacement du premier sommet</p>\
<p>Puis sur chaque sommet</p>\
<p>Double cliquer sur le dernier sommet pour terminer</p>\
<hr>\
<p>Un polygone entièrement compris dans un autre crée un "trou"</p>';

// Editor
export class Editor extends ol.layer.Vector {
  constructor(opt) {
    const options = {
      background: 'transparent',

      geoJsonId: 'geojson',
      format: new ol.format.GeoJSON(),
      dataProjection: 'EPSG:4326',
      featureProjection: 'EPSG:3857',

      // styleOptions: {}, // Style options to apply to the edited features
      withHoles: true, // Authorize holes in polygons
      canMerge: true, // Merge lines having a common end
      // editOnly: 'line' | 'poly',

      featuresToSave: () => this.format.writeFeatures(
        //BEST put getFeatures in main method
        this.source.getFeatures(), {
          dataProjection: this.dataProjection,
          featureProjection: this.map.getView().getProjection(),
          decimals: 5,
        }),

      ...opt,
    };

    const geoJsonEl = document.getElementById(options.geoJsonId), // Read data in an html element
      geoJson = (geoJsonEl ? geoJsonEl.value : '') || '{"type":"FeatureCollection","features":[]}';

    const source = new ol.source.Vector({
      features: options.format.readFeatures(geoJson, options),
      wrapX: false,

      ...options,
    });

    const style = new ol.style.Style({
      // Marker
      image: new ol.style.Circle({
        radius: 4,
        stroke: new ol.style.Stroke({
          color: 'red',
          width: 2,
        }),
      }),
      // Lines or polygons border
      stroke: new ol.style.Stroke({
        color: 'red',
        width: 2,
      }),
      // Polygons
      fill: new ol.style.Fill({
        color: 'rgba(0,0,255,0.2)',
      }),

      ...options.styleOptions,
    });

    super({
      source: source,
      style: style,
      zIndex: 400, // Editor & cursor : above the features

      ...options,
    });

    this.featuresToSave = options.featuresToSave;
    this.format = options.format;
    this.geoJsonEl = geoJsonEl;
    this.options = options;
    this.dataProjection = options.dataProjection;
    this.source = source;
    this.style = style;
  } // End constructor

  setMapInternal(map) {
    this.map = map;

    // Fit to the source at the init
    map.once('postrender', () => { //HACK the only event to trigger if the map is not centered
      const extent = this.source.getExtent(),
        defaultPosition = [localStorage.myolLon || 2, localStorage.myolLat || 47], // Initial position of the marker
        view = map.getView();

      if (ol.extent.isEmpty(extent)) {
        view.setCenter(
          ol.proj.transform(defaultPosition, 'EPSG:4326', 'EPSG:3857') // If no json value
        );
        view.setZoom(localStorage.myolZoom || 6);
      } else
        view.fit(
          extent, {
            minResolution: 10,
            padding: [5, 5, 5, 5],
          });
    });

    this.optimiseEdited(); // Optimise at init

    this.buttons = [
      new Button({ // 0
        className: 'myol-button-inspect myol-button-nokeepselect', //TODO refund button hover & touch
        subMenuId: 'myol-edit-help-inspect',
        subMenuHTML: '<p>Inspect</p>',
        subMenuHTMLfr: helpModifFr.inspect,
        buttonAction: (evt, active) => this.changeInteraction(0, evt, active),
      }),
      new Button({ // 1
        className: 'myol-button-modify myol-button-nokeepselect',
        subMenuId: 'myol-edit-help-modify',
        subMenuHTML: '<p>Modification</p>',
        subMenuHTMLfr: helpModifFr[this.options.editOnly || 'both'],
        buttonAction: (evt, active) => this.changeInteraction(1, evt, active),
      }),
      new Button({ // 2
        className: 'myol-button-draw-line myol-button-nokeepselect',
        subMenuId: 'myol-edit-help-line',
        subMenuHTML: '<p>New line</p>',
        subMenuHTMLfr: helpLineFr,
        buttonAction: (evt, active) => this.changeInteraction(2, evt, active),
      }),
      new Button({ // 3
        className: 'myol-button-draw-poly myol-button-nokeepselect',
        subMenuId: 'myol-edit-help-poly',
        subMenuHTML: '<p>New polygon</p>',
        subMenuHTMLfr: helpPolyFr,
        buttonAction: (evt, active) => this.changeInteraction(3, evt, active),
      }),
    ];

    this.interactions = [
      new ol.interaction.Select({ // 0 Inspect
        condition: ol.events.condition.pointerMove,
        style: () => new ol.style.Style({
          // Lines or polygons border
          stroke: new ol.style.Stroke({
            color: 'red',
            width: 3,
          }),
          // Polygons
          fill: new ol.style.Fill({
            color: 'rgba(0,0,255,0.5)',
          }),
        }),
      }),
      new ol.interaction.Modify({ // 1 Modify
        source: this.source,
        pixelTolerance: 16, // Default is 10
        style: this.style,
      }),
      new ol.interaction.Draw({ // 2 Draw line
        source: this.source,
        type: 'LineString',
        style: this.style,
        stopClick: true, // Avoid zoom when you finish drawing by doubleclick
      }),
      new ol.interaction.Draw({ // 3 Draw poly
        source: this.source,
        type: 'Polygon',
        style: this.style,
        stopClick: true, // Avoid zoom when you finish drawing by doubleclick
      }),
      new ol.interaction.Snap({ // 4 snap
        source: this.source,
        pixelTolerance: 7.5, // 6 + line width / 2 : default is 10
      }),
    ];

    // End of one modify interaction
    this.interactions[1].on('modifyend', evt => {
      //BEST move only one summit when dragging
      //BEST Ctrl+Alt+click on summit : delete the line or poly

      // Ctrl+Alt+click on segment : delete the line or poly
      if (evt.mapBrowserEvent.originalEvent.ctrlKey &&
        evt.mapBrowserEvent.originalEvent.altKey) {
        const selectedFeatures = map.getFeaturesAtPixel(
          evt.mapBrowserEvent.pixel, {
            hitTolerance: 6, // Default is 0
            layerFilter: l => l.ol_uid === this.ol_uid
          });

        for (const f in selectedFeatures) // We delete the selected feature
          this.source.removeFeature(selectedFeatures[f]);
      }

      // Alt+click on segment : delete the segment & split the line
      const tmpFeature = this.interactions[4].snapTo(
        evt.mapBrowserEvent.pixel,
        evt.mapBrowserEvent.coordinate,
        map
      );

      if (tmpFeature && evt.mapBrowserEvent.originalEvent.altKey)
        this.optimiseEdited(tmpFeature.vertex);

      else if (tmpFeature && evt.mapBrowserEvent.originalEvent.shiftKey)
        this.optimiseEdited(tmpFeature.vertex, true);
      else
        this.optimiseEdited();

      this.hoveredFeature = null;
    });

    // End of line & poly drawing
    [2, 3].forEach(i => this.interactions[i].on('drawend', () => {
      // Warn source 'on change' to save the feature
      // Don't do it now as it's not yet added to the source
      this.source.modified = true;

      // Reset interaction & button to modify
      this.buttons[1].buttonListener({
        type: 'click',
      });
    }));

    // End of feature creation
    this.source.on('change', () => { // Call all sliding long
      sessionStorage.myolLastchange = Date.now(); // Mem the last change date

      if (this.source.modified) { // Awaiting adding complete to save it
        this.source.modified = false; // To avoid loops

        // Finish
        this.optimiseEdited();
        this.hoveredFeature = null; // Recover hovering
      }
    });

    if (this.options.editOnly !== 'poly')
      this.map.addControl(this.buttons[0]); // 0 Inspect
    this.map.addControl(this.buttons[1]); // 1 Modify
    if (this.options.editOnly !== 'poly')
      this.map.addControl(this.buttons[2]); // 2 Draw line
    if (this.options.editOnly !== 'line')
      this.map.addControl(this.buttons[3]); // 3 Draw poly

    super.setMapInternal(map);

    // Set modify after map init
    this.buttons[1].buttonListener({
      type: 'click',
    });
  } // End setMapInternal

  changeInteraction(interaction, evt, active) {
    if (!active) // Click twice on the same button
      return this.buttons[1].buttonListener({
        type: 'click',
      });

    if (evt.type === 'click') {
      this.interactions.forEach(inter => this.map.removeInteraction(inter));
      this.map.addInteraction(this.interactions[interaction]);
      this.map.addInteraction(this.interactions[4]); // Snap must be added after the others

      // For snap : register again the full list of features as addFeature manages already registered
      this.map.getLayers().forEach(l => {
        if (l.getSource() && l.getSource().getFeatures) // Vector layers only
          l.getSource().getFeatures().forEach(f =>
            this.interactions[4].addFeature(f)
          );
      });
    }

    // Set the cursor dependng on the activity
    const mapEl = this.map.getTargetElement();

    if (mapEl)
      mapEl.className = 'map-edit-' + interaction;
  }

  // Processing the data
  optimiseEdited(selectedVertex, reverseLine) {
    const view = this.map.getView();

    const coordinates = this.optimiseFeatures(
      this.source.getFeatures(),
      selectedVertex,
      reverseLine
    );

    // Recreate features
    this.source.clear();

    //BEST Multilinestring / Multipolygon
    for (const l in coordinates.lines)
      this.source.addFeature(new ol.Feature({
        geometry: new ol.geom.LineString(coordinates.lines[l]),
      }));
    for (const p in coordinates.polys)
      this.source.addFeature(new ol.Feature({
        geometry: new ol.geom.Polygon(coordinates.polys[p]),
      }));

    // Save geometries in <EL> as geoJSON at every change
    if (this.geoJsonEl && view)
      this.geoJsonEl.value = this.featuresToSave(coordinates)
      .replace(/,"properties":(\{[^}]*\}|null)/u, '');
  }

  // Refurbish Lines & Polygons
  // Split lines having a summit at selectedVertex
  optimiseFeatures(features, selectedVertex, reverseLine) {
    const points = [],
      lines = [],
      polys = [];

    // Get all edited features as array of coordinates
    for (const f in features)
      this.flatFeatures(features[f].getGeometry(), points, lines, polys, selectedVertex, reverseLine);

    for (const a in lines)
      // Exclude 1 coordinate features (points)
      if (lines[a].length < 2)
        delete lines[a];

      // Merge lines having a common end
      else if (this.options.canMerge)
      for (let b = 0; b < a; b++) // Once each combination
        if (lines[b]) {
          const m = [a, b];

          for (let i = 4; i; i--) // 4 times
            if (lines[m[0]] && lines[m[1]]) { // Test if the line has been removed
              // Shake lines end to explore all possibilities
              m.reverse();
              lines[m[0]].reverse();
              if (this.compareCoords(lines[m[0]][lines[m[0]].length - 1], lines[m[1]][0])) {
                // Merge 2 lines having 2 ends in common
                lines[m[0]] = lines[m[0]].concat(lines[m[1]].slice(1));
                delete lines[m[1]]; // Remove the line but don't renumber the array keys
              }
            }
        }

    // Make polygons with looped lines
    for (const a in lines)
      if (this.options.editOnly !== 'line' && lines[a]) {
        // Close open lines
        if (this.options.editOnly === 'poly')
          if (!this.compareCoords(lines[a]))
            lines[a].push(lines[a][0]);

        if (this.compareCoords(lines[a])) { // If this line is closed
          // Split squeezed polygons
          // Explore all summits combinaison
          for (let i1 = 0; i1 < lines[a].length - 1; i1++)
            for (let i2 = 0; i2 < i1; i2++)
              if (lines[a][i1][0] === lines[a][i2][0] &&
                lines[a][i1][1] === lines[a][i2][1]) { // Find 2 identical summits
                const squized = lines[a].splice(i2, i1 - i2); // Extract the squized part
                squized.push(squized[0]); // Close the poly
                polys.push([squized]); // Add the squized poly
                i1 = lines[a].length; // End loop
                i2 = lines[a].length;
              }

          // Convert closed lines into polygons
          polys.push([lines[a]]); // Add the polygon
          delete lines[a]; // Forget the line
        }
      }

    // Makes holes if a polygon is included in a biggest one
    for (const p1 in polys) // Explore all Polygons combinaison
      if (this.options.withHoles && polys[p1]) {
        const fs = new ol.geom.Polygon(polys[p1]);

        for (const p2 in polys)
          if (polys[p2] && p1 !== p2) {
            let intersects = true;
            for (const c in polys[p2][0])
              if (!fs.intersectsCoordinate(polys[p2][0][c]))
                intersects = false;
            if (intersects) { // If one intersects a bigger
              polys[p1].push(polys[p2][0]); // Include the smaler in the bigger
              delete polys[p2]; // Forget the smaller
            }
          }
      }

    return {
      points: points,
      lines: lines.filter(Boolean), // Remove deleted array members
      polys: polys.filter(Boolean),
    };
  }

  flatFeatures(geom, points, lines, polys, selectedVertex, reverseLine) {
    // Expand geometryCollection
    if (geom.getType() === 'GeometryCollection') {
      const geometries = geom.getGeometries();

      for (const g in geometries)
        this.flatFeatures(geometries[g], points, lines, polys, selectedVertex, reverseLine);
    }
    // Point
    else if (geom.getType().match(/point$/iu))
      points.push(geom.getCoordinates());

    // line & poly
    else
      // Get lines or polyons as flat array of coordinates
      this.flatCoord(lines, geom.getCoordinates(), selectedVertex, reverseLine);
  }

  // Get all lines fragments (lines, polylines, polygons, multipolygons, hole polygons, ...)
  // at the same level & split if one point = selectedVertex
  flatCoord(lines, coords, selectedVertex, reverseLine) {
    if (coords.length && typeof coords[0][0] === 'object') {
      // Multi*
      for (const c1 in coords)
        this.flatCoord(lines, coords[c1], selectedVertex, reverseLine);
    } else {
      // LineString
      const begCoords = []; // Coords before the selectedVertex
      let selectedLine = false;

      while (coords.length) {
        const c = coords.shift();

        if (!coords.length || !this.compareCoords(c, coords[0])) { // Skip duplicated points
          if (selectedVertex && this.compareCoords(c, selectedVertex)) {
            selectedLine = true;
            break; // Ignore this point and stop selection
          }
          begCoords.push(c);
        }
      }

      if (selectedLine && reverseLine)
        lines.push(begCoords.concat(coords).reverse());
      else
        lines.push(begCoords, coords);
    }
  }

  // Are coords identials ?
  compareCoords(a, b) {
    if (!a) return false;
    if (!b) return this.compareCoords(a[0], a[a.length - 1]); // Compare start with end
    return a[0] === b[0] && a[1] === b[1]; // 2 coordinates
  }
}

export default Editor;