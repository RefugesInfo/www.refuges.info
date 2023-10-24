// Openlayers imports used in this package
// Will be used both in the sources & the build

import 'ol/ol.css';

import Feature from 'ol/Feature';
import Geolocation from 'ol/Geolocation';
import Map from 'ol/Map';
import OSMXML from 'ol/format/OSMXML';
import View from 'ol/View';
import WMTSTileGrid from 'ol/tilegrid/WMTS';
import * as control from 'ol/control';
import * as coordinate from 'ol/coordinate';
import * as extent from 'ol/extent';
import * as format from 'ol/format';
import * as geom from 'ol/geom';
import * as interaction from 'ol/interaction';
import * as layer from 'ol/layer';
import * as loadingstrategy from 'ol/loadingstrategy';
import * as proj from 'ol/proj';
import * as projProj4 from 'ol/proj/proj4';
import * as source from 'ol/source';
import * as sphere from 'ol/sphere';
import * as style from 'ol/style';
import * as util from 'ol/util';

export default {
  control: control,
  coordinate: coordinate,
  extent: extent,
  Feature: Feature,
  format: { // Not all formats are used & the total file is big
    GeoJSON: format.GeoJSON,
    GPX: format.GPX,
    KML: format.KML,
    OSMXML: OSMXML,
  },
  Geolocation: Geolocation,
  geom: geom,
  interaction: {
    Draw: interaction.Draw,
    Modify: interaction.Modify,
    MouseWheelZoom: interaction.MouseWheelZoom,
    Pointer: interaction.Pointer,
    Select: interaction.Select,
    Snap: interaction.Snap,
  },
  layer: {
    Tile: layer.Tile,
    Vector: layer.Vector,
  },
  Map: Map,
  loadingstrategy: loadingstrategy,
  proj: {
    ...proj,
    proj4: projProj4,
  },
  source: {
    BingMaps: source.BingMaps,
    Cluster: source.Cluster,
    OSM: source.OSM,
    TileWMS: source.TileWMS,
    Vector: source.Vector,
    WMTS: source.WMTS,
    XYZ: source.XYZ,
  },
  sphere: sphere,
  style: style,
  tilegrid: {
    WMTS: WMTSTileGrid,
  },
  util: {
    VERSION: util.VERSION,
  },
  View: View,
};