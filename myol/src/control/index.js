/**
 * This file defines the myol.control exports
 */

import Attribution from 'ol/control/Attribution';
import FullScreen from 'ol/control/FullScreen';
import ScaleLine from 'ol/control/ScaleLine';
import Zoom from 'ol/control/Zoom';

import Button from './Button';
import Download from './Download';
import LayerSwitcher from './LayerSwitcher';
import LengthLine from './LengthLine';
import Load from './Load';
import MyGeocoder from './MyGeocoder';
import MyGeolocation from './MyGeolocation';
import MyMousePosition from './MyMousePosition';
import Permalink from './Permalink';
import Print from './Print';

/**
 * Basic list of controls
 */
export function collection(options = {}) {
  return [
    // Top left
    new Zoom(options.zoom),
    new FullScreen(options.fullScreen),
    new MyGeocoder(options.geocoder),
    new MyGeolocation(options.geolocation),
    new Load(options.load),
    new Download(options.download),
    new Print(options.print),

    // Bottom left
    new LengthLine(options.lengthLine),
    new MyMousePosition(options.myMousePosition),
    new ScaleLine(options.scaleLine),

    // Bottom right
    new Attribution(options.attribution),
  ];
}

export default {
  Button: Button,
  Download: Download,
  LengthLine: LengthLine,
  LayerSwitcher: LayerSwitcher,
  Load: Load,
  MyGeocoder: MyGeocoder,
  MyGeolocation: MyGeolocation,
  MyMousePosition: MyMousePosition,
  Permalink: Permalink,
  Print: Print,
  collection,
};