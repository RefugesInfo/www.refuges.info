/* global myol, jsVars, couchePointsWRI */

const refugeslayer = couchePointsWRI({
    host: 'https://www.refuges.info/',
    selectName: 'select-wri',
  },
  'gps');

refugeslayer.setVisible(false);

jsVars.vectorLayers = [
  refugeslayer,
  new myol.layer.Hover(),
];