console.log('MyGPS version ' + jsVars.lastChangeDate);

// Force https & script name to be compliant with PWA
if (!location.href.match(/(https|localhost).*\/index.php/)) {
  console.log('index.php reload');
  location.replace(
    (location.hostname == 'localhost' ? 'http://' : 'https://') +
    location.hostname +
    location.pathname + (location.pathname.slice(-1) == '/' ? 'index.php' : '') +
    location.search +
    location.hash);
}

if ("serviceWorker" in navigator) {
  navigator.serviceWorker.register("service-worker.php")
    .catch(err => console.log(err));
}

// Display the map
var loadControl = new myol.control.Load(),
  map = new ol.Map({
    target: 'map',
    view: new ol.View({
      constrainResolution: true, // Force zoom on the available tile's definition
    }),
    controls: [
      // Top left
      new ol.control.Zoom(),
      new myol.control.MyGeocoder(),
      new myol.control.MyGeolocation(),
      loadControl,
      new myol.control.Download(),
      new myol.control.Button({ // Help
        label: '?',
        subMenuId: 'myol-gps-help',
      }),

      // Top right
      new myol.control.LayerSwitcher({
        layers: myol.layer.tile.collection(jsVars.mapKeys),
      }),

      // Bottom left
      new myol.control.LengthLine(),
      new myol.control.MyMousePosition(),
      new ol.control.ScaleLine(),

      // Bottom right
      new myol.control.Permalink({
        init: true, // Permet de garder le même réglage de carte
      }),
      new ol.control.Attribution(),
    ],
  });

// Preload 2 more layers zoom
map.on('precompose', () => {
  map.getLayers().forEach(layer => {
    if (typeof layer.setPreload == 'function')
      layer.setPreload(2);
  });
});

// Add a menu to load .gpx files included in the gps/... directories
if (jsVars.gpxFiles.length) {
  const tracesEl = document.getElementById('myol-gps-traces');

  jsVars.gpxFiles.forEach(f => {
    const name = f.match(/([^/]*)\./);

    if (name)
      tracesEl.insertAdjacentHTML(
        'beforeend',
        '<p><a onclick="loadControl.loadUrl(\'' + f + '\')">' + name[1] + '</a></p>'
      );
  });

  map.addControl(
    new myol.control.Button({
      label: '&#128694;',
      subMenuId: 'myol-gps-traces',
    })
  );
}

// Ask user to reload the PWA when a new version is loaded
navigator.serviceWorker.addEventListener('controllerchange', () => {
  console.log('PWA controllerchange');
  map.addControl(
    new myol.control.Button({
      className: 'myol-button-upgrade',
      subMenuId: 'myol-button-upgrade',
    })
  );
}, {
  once: true,
});

// Load server .gpx file from url #name (part of filename, case insensitive
if (location.hash) {
  const initFileName = jsVars.gpxFiles.find(fileName =>
    fileName.toLowerCase()
    .includes(
      location.hash.replace('#', '')
      .toLowerCase()
    )
  );

  if (initFileName)
    loadControl.loadUrl(initFileName);
}