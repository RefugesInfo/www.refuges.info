/**
 * This file defines the myol.layer exports
 */

import BackgroundLayer from './BackgroundLayer';
import Editor from './Editor';
import Hover from './Hover';
import Marker from './Marker';
import Selector from './Selector';
import * as myVectorLayer from './MyVectorLayer';
import * as tileLayercollection from './TileLayerCollection';
import * as vectorLayerCollection from './VectorLayerCollection';

export default {
  ...myVectorLayer,
  BackgroundLayer: BackgroundLayer,
  Editor: Editor,
  Hover: Hover,
  Marker: Marker,
  Selector: Selector,
  tile: tileLayercollection,
  vector: vectorLayerCollection,
};