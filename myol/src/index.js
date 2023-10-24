/**
 * This file defines the myol exports
 */

import control from './control';
import layer from './layer';
import * as stylesOptions from './layer/stylesOptions';
import trace from './trace';

export default {
  control: control,
  layer: layer,
  Selector: layer.Selector,
  stylesOptions: stylesOptions,
  trace: trace,
};