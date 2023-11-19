/**
 * Hover & click management
 * Display the hovered feature with the hover style
 * Go to the link property when click a feature
 */

import ol from '../ol';

export class Hover extends ol.layer.Vector {
  constructor(options) {
    super({
      source: new ol.source.Vector(),
      zIndex: 500, // Above all layers
      wrapX: false,

      ...options,
    });
  }

  // Attach an hover & click listener to the map
  setMapInternal(map) {
    const mapEl = map.getTargetElement();

    // Basic listeners
    map.on(['pointermove', 'click'], evt => this.mouseListener(evt));

    // Leaving the map reset hovering
    window.addEventListener('mousemove', evt => {
      if (mapEl) {
        const divRect = mapEl.getBoundingClientRect();

        // The mouse is outside of the map
        if (evt.clientX < divRect.left || divRect.right < evt.clientX ||
          evt.clientY < divRect.top || divRect.bottom < evt.clientY)
          this.getSource().clear()
      }
    });

    return super.setMapInternal(map);
  }

  mouseListener(evt) {
    const map = evt.map,
      resolution = map.getView().getResolution(),
      source = this.getSource();

    // Find the first hovered feature & layer
    let hoveredLayer = null,
      hoveredFeature = map.forEachFeatureAtPixel(
        map.getEventPixel(evt.originalEvent),
        (f, l) => {
          if ((l && l.options && l.options.hoverStylesOptions) ||
            l == this) {
            hoveredLayer = l;
            return f; // Return feature & stop the search
          }
        }, {
          hitTolerance: 6, // For lines / Default 0
        }
      ),
      hoveredSubFeature = hoveredFeature;

    if (hoveredFeature) {
      const hoveredProperties = hoveredFeature.getProperties(),
        hoveredSubProperties = hoveredSubFeature.getProperties();

      // Click
      if (evt.type == 'click' &&
        !(hoveredLayer.options && hoveredLayer.options.noClick)) {
        // Click cluster
        if (hoveredSubProperties.cluster) {
          map.getView().animate({
            zoom: map.getView().getZoom() + 2,
            center: hoveredSubProperties.geometry.getCoordinates(),
          });
          source.clear();
        }
        // Click link
        else if (hoveredSubProperties.link) {
          // Open a new tag
          if (evt.originalEvent.ctrlKey)
            window.open(hoveredSubProperties.link, '_blank').focus();
          else
            // Open a new window
            if (evt.originalEvent.shiftKey)
              window.open(hoveredSubProperties.link, '_blank', 'resizable=yes').focus();
            // Go on the same window
            else
              window.location.href = hoveredSubProperties.link;
        }
      }
      // Hover
      else if (hoveredSubFeature != map.lastHoveredSubFeature &&
        !(hoveredLayer.options && hoveredLayer.options.noHover)) {
        const f = hoveredSubFeature.clone();

        if (hoveredLayer.options && hoveredLayer.options.hoverStylesOptions)
          f.setStyle(
            new ol.style.Style(hoveredLayer.options.hoverStylesOptions(f, resolution, hoveredLayer))
          );

        source.clear();
        source.addFeature(f);

        map.getViewport().style.cursor =
          (hoveredProperties.link || hoveredProperties.cluster) &&
          !(hoveredLayer.options && hoveredLayer.options.noClick) ?
          'pointer' :
          '';
      }
    }
    // Reset hoverLayer, style & cursor
    else {
      source.clear();
      map.getViewport().style.cursor = '';
    }

    // Mem hovered feature for next change
    map.lastHoveredSubFeature = hoveredSubFeature;
  }
}

export default Hover;