/**
 * Control to display the mouse position
 */

import ol from '../ol';

export class MyMousePosition extends ol.control.MousePosition {
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
    map.on('myol:gpspositionchanged', evt => this.position = evt.position);

    return super.setMap(map);
  }

  display(coordinates) {
    if (this.position) {
      const ll4326 = ol.proj.transform(this.position, 'EPSG:3857', 'EPSG:4326'),
        distance = ol.sphere.getDistance(coordinates, ll4326);

      return distance < 1000 ?
        (Math.round(distance)) + ' m' :
        (Math.round(distance / 10) / 100) + ' km';
    } else
      return ol.coordinate.createStringXY(4)(coordinates);
  }
}

export default MyMousePosition;