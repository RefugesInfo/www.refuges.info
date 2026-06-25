/* global L */

/*********************************************************
 * Rotating marker to be used in L.Control.Gps           *
 * which indicates the direction in which we are looking *
 *********************************************************/
/* eslint-disable-next-line no-unused-vars */
class MarkerCompass extends L.Marker {
  constructor() {
    // Fix icon
    const iconMarker = L.divIcon({
        iconSize: [16, 16],
        iconAnchor: [8, 8],
        className: '', // To clean default class
        html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" height="16" width="16">\
          <circle cx="8" cy="8" r="6" fill="#ff0" stroke="#f00" stroke-width="2" />\
        </svg>',
      }),

      // Direction icon
      iconCompas = L.divIcon({
        iconSize: [16, 16],
        iconAnchor: [8, 8],
        className: '',
        html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" height="16" width="16">\
          <circle cx="8" cy="8" r="6" fill="#ff0" stroke="#f00" stroke-width="2" />\
          <path d="M0,0 8,1 8,8 1,8" fill="#f00" />\
        </svg>',
      });

    super([0, 0], {
      icon: iconMarker,
    });

    // Rotate the marker following the orientation sensors
    window.addEventListener('deviceorientationabsolute', (evt) => {
      this.heading = evt.alpha || evt.webkitCompassHeading; // Android || iOS

      if (this._icon && this.heading) { // If gps enabled
        // Add the direction to the icon if it is not already done.
        this.setIcon(iconCompas);
        this._icon.style.transformOrigin = 'center';
        this.rotateIcon();
      }
    });
  }

  // Prevents zoom from affecting the marker's direction.
  _setPos(pos) {
    super._setPos(pos);

    if (this.heading)
      this.rotateIcon();
  }

  // Add or replace the icon rotation style
  rotateIcon() {
    this._icon.style.transform =
      this._icon.style.transform.replace(/rotateZ\([^)]+\)/u, '') +
      ' rotateZ(' + (45 - parseInt(this.heading, 10)) + 'deg)';
  }
};