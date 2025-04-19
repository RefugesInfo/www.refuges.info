// This file defines the contents of the dist/myol.css & dist/myol libraries
// It contains all what is necessary for refuges.info & chemineur.fr websites

import '../build/banner.css';

import ol from '../src/ol'; // Imports only necessary modules
window.ol ||= ol; // Makes a global ol

import myol from '../src';

export default myol;