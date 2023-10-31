var centre = ol.proj.transform([<?=$vue->point->longitude?>, <?=$vue->point->latitude?>], 'EPSG:4326', 'EPSG:3857'),
  mapKeys = <?=json_encode($config_wri['mapKeys'])?>,
  host = '<?=$config_wri["sous_dossier_installation"]?>', // Appeler la couche de CE serveur
  cadre = '<?=$config_wri["sous_dossier_installation"]?>images/cadre.svg';

var map = new ol.Map({
  target: 'carte-point',
  view: new ol.View({
    center: ol.proj.transform(centre, 'EPSG:4326', 'EPSG:3857'),
    zoom: 13,
    enableRotation: false,
    constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
  }),
  controls: [
    // Haut gauche
    new ol.control.Zoom(),
    new ol.control.FullScreen(),
    new myol.control.MyGeocoder(),
    new myol.control.MyGeolocation(),
    new myol.control.Download(),
    new myol.control.Print(),

    // Bas gauche
    new myol.control.MyMousePosition(),
    new ol.control.ScaleLine(),

    // Bas droit
    new ol.control.Attribution({ // Attribution doit être défini avant LayerSwitcher
      collapsed: false,
    }),
    new myol.control.Permalink({ // Permet de garder le même réglage de carte
      visible: false, // Mais on ne visualise pas le lien du permalink
      init: false, // Ici, on utilisera plutôt la position du point
    }),

    // Haut droit
    new myol.control.LayerSwitcher({
      layers: fondsCarte('point', mapKeys),
    }),
  ],
  layers: [
    // Les autres points refuges.info
    couchePointsWRI({
      host: host,
    }),
    // Le cadre rouge autour du point de la fiche
    new myol.layer.Marker({
      src: cadre,
      prefix: 'cadre', // S'interface avec les <TAG id="cadre-xxx"...>
      focus: 17, // Centrer
    }),
    new myol.layer.Hover(), // Gère le survol du curseur
  ],
});

myol.trace(map);