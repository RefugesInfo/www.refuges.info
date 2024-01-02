/**
 * Print control
 */

import Button from './Button.js';
import './print.css';

export class Print extends Button {
  constructor(options) {
    super({
      // Button options
      className: 'myol-button-print',
      subMenuId: 'myol-button-print',
      subMenuHTML: subMenuHTML,
      subMenuHTML_fr: subMenuHTML_fr,

      ...options,
    });

    // To return without print
    document.addEventListener('keydown', evt => {
      if (evt.key == 'Escape')
        setTimeout(() => { // Delay reload for FF & Opera
          location.reload();
        });
    });
  }

  subMenuAction(evt) {
    const map = this.getMap(),
      mapEl = map.getTargetElement(),
      poEl = this.element.querySelector('input:checked'), // Selected orientation inputs
      orientation = poEl && poEl.value == '1' ? 'landscape' : 'portrait';

    // Fix resolution to an available tiles resolution
    map.getView().setConstrainResolution(true);

    // Set or replace the page style
    if (document.head.lastChild.textContent.match(/^@page{size:/))
      document.head.lastChild.remove();
    document.head.insertAdjacentHTML('beforeend', '<style>@page{size: A4 ' + orientation + '}</style>');

    // Parent the map to the top of the page
    document.body.appendChild(mapEl);
    mapEl.className = 'myol-print-' + orientation;

    // Finally print if required
    if (evt.target.id == 'myol-print') {
      if (poEl) { // If a format is set, the full page is already loaded
        window.print();
        location.reload();
      } else // Direct print : wait for full format rendering
        map.once('rendercomplete', () => {
          window.print();
          location.reload();
        });
    }
  }
}

var subMenuHTML = '\
  <label><input type="radio" name="myol-print-orientation" value="0">Portrait</label>\
  <label><input type="radio" name="myol-print-orientation" value="1">Landscape</label>\
  <p><a id="myol-print">Print</a></p>',

  subMenuHTML_fr = '\
  <p style="float:right" title="Cancel"><a onclick="location.reload()">&#10006;</a></p>\
  <p style="width:175px">Choisir le format et recadrer</p>' +
  subMenuHTML
  .replace('Landscape', 'Paysage')
  .replace('Print', 'Imprimer');

export default Print;