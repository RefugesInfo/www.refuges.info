/**
 * Print control
 */

import ol from '../ol';
import Button from './Button.js';

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
      poElcs = this.element.querySelectorAll('input:checked'), // Selected orientation inputs
      orientation = poElcs.length ? parseInt(poElcs[0].value) : 0; // Selected orientation or portrait

    // Change map size & style
    mapEl.style.maxHeight = mapEl.style.maxWidth = mapEl.style.float = 'none';
    mapEl.style.width = orientation == 0 ? '208mm' : '295mm';
    mapEl.style.height = orientation == 0 ? '295mm' : '208mm';
    map.setSize([mapEl.clientWidth, mapEl.clientHeight]);

    // Parent the map to the top of the page
    document.body.appendChild(mapEl);

    // Set style
    const styleSheet = document.createElement('style');
    styleSheet.type = 'text/css';
    styleSheet.innerText = '\
@page {\
  size: ' + (orientation == 0 ? 'portrait' : 'landscape') + ';\
}\
body>*:not(#' + mapEl.id + '),\
.ol-control:not(.ol-zoom):not(.ol-attribution):not(.myol-button-print) {\
  display: none;\
}\
.myol-button-switcher {\
  display: block !important;\
  float: left !important;\
}\
.myol-button-switcher>div {\
  left: 65px;\
  right: initial;\
}';
    document.head.appendChild(styleSheet);

    // Finer zoom not dependent on the baselayer's levels
    map.getView().setConstrainResolution(false);
    map.addInteraction(new ol.interaction.MouseWheelZoom({
      maxDelta: 0.1,
    }));

    // Finally print if required
    if (evt.target.id == 'print')
      map.once('rendercomplete', () => {
        window.print();
        location.reload();
      });
  }
}

var subMenuHTML = '\
  <label><input type="radio" value="0">Portrait</label>\
  <label><input type="radio" value="1">Landscape</label>\
  <label><a id="print">Print</a></label>\
  <label><a onclick="location.reload()">Cancel</a></label>';

var subMenuHTML_fr = '\
  <p>Pour imprimer la carte:</p>\
  <p>-Choisir portrait ou paysage,</p>\
  <p>-zoomer et déplacer la carte dans le format,</p>\
  <p>-imprimer.</p>' +
  subMenuHTML
  .replace('Landscape', 'Paysage')
  .replace('Print', 'Imprimer')
  .replace('Cancel', 'Annuler');

export default Print;