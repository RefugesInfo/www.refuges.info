/**
 * LengthLine control
 * Control to display the length & height difference of an hovered line
 */

import ol from '../ol';

export class LengthLine extends ol.control.Control {
  constructor() {
    super({
      element: document.createElement('div'), //HACK button not visible
    });

    this.element.className = 'ol-control myol-length-line';
  }

  setMap(map) {
    map.on('pointermove', evt => {
      this.element.innerHTML = ''; // Clear the measure if hover no feature

      // Find new features to hover
      map.forEachFeatureAtPixel(
        evt.pixel,
        feature => this.calculateLength(feature), {
          hitTolerance: 6, // Default is 0
        });
    });

    return super.setMap(map);
  }

  //BEST calculate distance to the ends
  calculateLength(feature) {
    if (feature) {
      let geometry = feature.getGeometry(),
        length = ol.sphere.getLength(geometry),
        fcs = this.getFlatCoordinates(geometry),
        denivPos = 0,
        denivNeg = 0;

      // Height difference calculation
      for (let c = 5; c < fcs.length; c += 3) {
        const d = fcs[c] - fcs[c - 3];

        if (d > 0)
          denivPos += d;
        else
          denivNeg -= d;
      }

      // Display
      //BEST BUG display length of GPS colimator
      if (length) {
        this.element.innerHTML =
          // Line length
          length < 1000 ?
          (Math.round(length)) + ' m' :
          (Math.round(length / 10) / 100) + ' km' +
          // Height difference
          (denivPos ? ' +' + denivPos + ' m' : '') +
          (denivNeg ? ' -' + denivNeg + ' m' : '');

        return false; // Continue detection (for editor that has temporary layers)
      }
    }
  }

  getFlatCoordinates(geometry) {
    let fcs = [];

    if (geometry.stride == 3)
      fcs = geometry.flatCoordinates;

    if (geometry.getType() == 'GeometryCollection')
      for (let g of geometry.getGeometries())
        fcs.push(...this.getFlatCoordinates(g));

    return fcs;
  }
}

export default LengthLine;