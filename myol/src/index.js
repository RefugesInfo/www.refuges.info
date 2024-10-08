/**
 * This file defines the myol exports
 */

//BEST resizable map
import control from './control';
import layer from './layer';
import * as stylesOptions from './layer/stylesOptions';
import * as trace from './trace';

export default {
  control: control,
  layer: layer,
  Selector: layer.Selector,
  stylesOptions: stylesOptions,
  trace: trace.trace,
  VERSION: trace.VERSION,
};