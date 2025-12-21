/**
 * Layer to show around partial layer
 * Outside of layer resolution or extent
 * Must be added to map before partial layers
 */

import {
  containsExtent,
} from 'ol/extent';
import * as layerTile from './TileLayerCollection';

class BackgroundLayer extends layerTile.CartoDB {
  constructor(options) {
    // High resolution background layer
    super({
      minResolution: 20,
      visible: false,
      warning: '<span class="warning">CARTE HORS ZONE</span>',

      ...options,
    });

    // Low resolution background layer
    //TODO BUG apply to hors zone
    //TODO BUG no apply under zoom limit
    this.lowResLayer = new layerTile.CartoDB({
      maxResolution: this.getMinResolution(),
      visible: false,
    });
  }

  setMapInternal(map) {
    map.addLayer(this.lowResLayer); // Substitution for low resoltions
    map.on('precompose', () => this.tuneDisplay(map));

    return super.setMapInternal(map);
  }

  tuneDisplay(map) {
    const mapExtent = map.getView().calculateExtent(map.getSize());

    let needed = true;

    map.getLayers().forEach(l => {
      if (l.getUseInterimTilesOnError && // Is a tile layer
        l !== this && l !== this.lowResLayer && // Not one of the background layers
        l.isVisible() && // Is visible
        containsExtent(l.getExtent() || mapExtent, mapExtent))
        needed = false;
    });

    this.setVisible(needed);
    this.lowResLayer.setVisible(needed);
  }
}

export default BackgroundLayer;