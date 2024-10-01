/**
 * MyMousePosition control to display the mouse position
 * Improve style
 */

import {
  createStringXY,
} from 'ol/coordinate';
import {
  getDistance,
} from 'ol/sphere';
import MousePosition from 'ol/control/MousePosition';
import {
  transform,
} from 'ol/proj';

import './control.css';

class MyMousePosition extends MousePosition {
  constructor(options) {
    super({
      // From MousePosition options
      className: 'ol-control myol-mouse-position',
      projection: 'EPSG:4326',
      placeholder: String.fromCharCode(0), // Hide control when mouse is out of the map
      coordinateFormat: c => this.display(c),

      ...options,
    });
  }

  setMap(map) {
    map.on('myol:gpspositionchanged', evt => {
      this.position = evt.position;
    });

    return super.setMap(map);
  }

  display(coordinates) {
    if (this.position) {
      const ll4326 = transform(this.position, 'EPSG:3857', 'EPSG:4326'),
        distance = getDistance(coordinates, ll4326);

      return distance < 1000 ?
        (Math.round(distance)) + ' m' :
        (Math.round(distance / 10) / 100) + ' km';
    }
    return createStringXY(4)(coordinates);
  }
}

export default MyMousePosition;