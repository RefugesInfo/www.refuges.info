/**
 * This file defines the myol.layer exports
 */

import BackgroundLayer from './BackgroundLayer';
import Hover from './Hover';
import Marker from './Marker';
import MyVectorLayer from './MyVectorLayer';
import Selector from './Selector';
import * as tileLayercollection from './TileLayerCollection';
import VectorEditor from './VectorEditor';
import * as vectorLayerCollection from './VectorLayerCollection';

export default {
  BackgroundLayer: BackgroundLayer,
  Hover: Hover,
  Marker: Marker,
  MyVectorLayer: MyVectorLayer,
  Selector: Selector,
  tile: tileLayercollection,
  VectorEditor: VectorEditor,
  vector: vectorLayerCollection,
};