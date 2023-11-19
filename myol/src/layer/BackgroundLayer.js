/**
 * Layer to show around partial layer
 * Outside of layer resolution or extent
 * Must be added to map before partial layers
 */

import ol from '../ol';
import * as layerTile from './TileLayerCollection';

export class BackgroundLayer extends layerTile.Positron {
  constructor(options) {
    // High resolution background layer
    super({
      minResolution: 10,
      visible: false,

      ...options,
    });

    // Low resolution background layer
    this.lowResLayer = new layerTile.NoTile({
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
        l != this && l != this.lowResLayer && // Not one of the background layers
        l.isVisible() && // Is visible
        ol.extent.containsExtent(l.getExtent() || mapExtent, mapExtent))
        needed = false;
    });

    this.setVisible(needed);
    this.lowResLayer.setVisible(needed);
  }
}

export default BackgroundLayer;