// This file defines the contents of the dist/myol.css & dist/myol libraries
// This contains all what is necessary for refuges.info & chemineur.fr websites

import '../build/banner.css';
import ol from '../src/ol'; // Openlayers native functions used in myol
import myol from '../src'; // Map management pecific functions

// Export ol & myol as global vars if not already defined
window.ol ||= ol;
window.myol ||= myol;

export default myol;