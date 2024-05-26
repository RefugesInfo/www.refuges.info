// This file defines the contents of the dist/myol.css & dist/myol libraries
// It contains all what is necessary for refuges.info & chemineur.fr websites

import '../build/banner.css';
import ol from '../src/ol'; // Part of Openlayers functions used in myol
import myol from '../src'; // Map management pecific functions

// Add ol as member of myol
myol.ol = ol;

// Export ol & myol as globals if not already defined
window.ol ||= ol;
window.myol ||= myol;

export default myol;