/**
 * LayerSwitcher.js
 */

import Button from './Button';
import BackgroundLayer from '../layer/BackgroundLayer';
import './layerSwitcher.css';

//BEST how do we do on touch terminal ? alt key to switch layers / transparency
//BEST slider transparency doesn't work out of range (no BackgroundLayer)
//BEST BUG Attribution must be set before LayerSwitcher
export class LayerSwitcher extends Button {
  constructor(options) {
    super({
      // Button options
      className: 'myol-button-switcher',
      subMenuHTML: '<div>',

      ...options,
    });

    this.selectExtId = options.selectExtId;

    // Filter null or hidden layers
    this.layers = {};
    for (let name in options.layers)
      if (options.layers[name] && !options.layers[name].getProperties().hidden)
        this.layers[name] = options.layers[name];

    // Get baselayer from url hash (#baselayer=...) if any
    const bl = location.href.match(/baselayer=([^&]+)/);
    if (bl)
      localStorage.myol_baselayer = decodeURI(bl[1]);

    this.sliderEl = document.createElement('input');
    this.sliderEl.type = 'range';
    this.sliderEl.title = 'Glisser pour faire varier la tranparence';
    this.sliderEl.oninput = () => this.displayTransparencyRange();
  }

  setMap(map) {
    map.addLayer(new BackgroundLayer());

    for (let name in this.layers) {
      // Build html layers selectors
      this.subMenuEl.insertAdjacentHTML('beforeend', '<label><input type="checkbox" name="baselayer" value="' + name + '">' + name + '</label>');

      // Make layers available for display
      this.layers[name].setVisible(false); // Don't begin to get the tiles yet (Necessary for Bing)
      map.addLayer(this.layers[name]);
    }
    this.selectorEls = this.element.querySelectorAll('input[name="baselayer"]');
    this.action(); // Display active layer
    this.subMenuEl.insertAdjacentHTML('beforeend', '<p>Ctrl+click: multicouches</p>');

    // Attach html additional selector (must be there to be after base layers)
    const selectExtEl = document.getElementById(this.selectExtId);
    if (selectExtEl) {
      selectExtEl.classList.add('select-ext');
      this.subMenuEl.appendChild(selectExtEl);
      selectExtEl.style.display = ''; // Unmask the selector if it has been at the declaration
    }

    // Register action listeners
    this.element.querySelectorAll('input[name=baselayer]')
      .forEach(el =>
        el.addEventListener('click', evt =>
          this.action(evt)
        )
      );

    // Hide the selector when the cursor is out of the selector
    map.on('pointermove', evt => {
      const max_x = map.getTargetElement().offsetWidth - this.element.offsetWidth - 20,
        max_y = this.element.offsetHeight + 20;

      if (evt.pixel[0] < max_x || evt.pixel[1] > max_y)
        this.element.classList.remove('myol-button-switcher-open');
    });

    return super.setMap(map);
  }

  action(evt) {
    // Clean checks
    if (evt && !evt.ctrlKey) {
      this.selectorEls.forEach(el => el.checked = false);
      evt.target.checked = true;
    }
    if (!this.element.querySelector('input[name="baselayer"]:checked'))
      (this.element.querySelector('input[value="' + localStorage.myol_baselayer + '"]') ||
        this.selectorEls[0]
      ).checked = true;

    const selectedEls = this.element.querySelectorAll('input[name="baselayer"]:checked');

    localStorage.myol_baselayer = selectedEls[0].value;
    this.sliderEl.value = 50;
    this.sliderEl.remove();
    this.transparentlayer = null;

    // Display the layers & slider
    this.selectorEls.forEach(el => {
      this.layers[el.value].setVisible(el.checked);
      this.layers[el.value].setOpacity(1);

      if (el.checked && selectedEls.length > 1) {
        el.parentElement.after(this.sliderEl);
        this.transparentlayer = this.layers[el.value];
      }
    });

    this.displayTransparencyRange();
  }

  displayTransparencyRange() {
    if (this.transparentlayer)
      this.transparentlayer.setOpacity(this.sliderEl.value / 100);
  }
}

export default LayerSwitcher;