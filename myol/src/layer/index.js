/**
 * This file defines the myol.layer exports
 */

import BackgroundLayer from './BackgroundLayer';
import VectorEditor from './VectorEditor';
import Hover from './Hover';
import Marker from './Marker';
import MyVectorLayer from './MyVectorLayer';
import Selector from './Selector';
import * as loadingstrategy from './MyLoadingStrategy';
import * as tileLayercollection from './TileLayerCollection';
import * as vectorLayerCollection from './VectorLayerCollection';

export default {
  BackgroundLayer: BackgroundLayer,
  VectorEditor: VectorEditor,
  Hover: Hover,
  Marker: Marker,
  MyVectorLayer: MyVectorLayer,
  Selector: Selector,
  loadingstrategy: loadingstrategy,
  tile: tileLayercollection,
  vector: vectorLayerCollection,
};