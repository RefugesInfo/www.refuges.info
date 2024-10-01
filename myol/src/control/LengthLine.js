/**
 * LengthLine control to display the length of an hovered line
 */

import Control from 'ol/control/Control';
import {
  getLength as sphereGetLength,
} from 'ol/sphere';

import './lengthLine.css';

class LengthLine extends Control {
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
      const geometry = feature.getGeometry(),
        length = sphereGetLength(geometry),
        fcs = this.getFlatCoordinates(geometry);
      let denivPos = 0,
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

    if (geometry.stride === 3)
      fcs = geometry.flatCoordinates;

    if (geometry.getType() === 'GeometryCollection')
      for (const g of geometry.getGeometries())
        fcs.push(...this.getFlatCoordinates(g));

    return fcs;
  }
}

export default LengthLine;