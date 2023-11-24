var host = '<?=$config_wri["sous_dossier_installation"]?>', // Appeler la couche de CE serveur
  mapKeys = <?=json_encode($config_wri['mapKeys'])?>,
  layerOptions = <?=json_encode($config_wri['layerOptions'])?>,
  initPermalink = <?=$vue->polygone->id_polygone?'false':'true'?>;

// Forçage de l'init des coches
  // Supprime toutes les sélections commençant par myol_selecteur
  Object.keys(localStorage)
    .filter(k => k.substring(0, 14) == 'myol_selecteur')
    .forEach(k => localStorage.removeItem(k));

  // Force tous les points et le contour
<?php if ( $vue->polygone->id_polygone ) { ?>
  localStorage.myol_selectmassif = <?=$vue->polygone->id_polygone?>;
<?php } ?>
  localStorage.myol_selectwri = 'all';
  localStorage.myol_selectmassifs =
  localStorage.myol_selectosm =
  localStorage.myol_selectprc =
  localStorage.myol_selectcc =
  localStorage.myol_selectchem =
  localStorage.myol_selectalpages = '';

var contourMassif = coucheContourMassif({
    host: host,
    selectName: 'select-massif',
  }),

  map = new ol.Map({
    target: 'carte-nav',
    view: new ol.View({
      enableRotation: false,
      constrainResolution: true, // Force le zoom sur la définition des dalles disponibles
    }),
    controls: [
      // Haut gauche
      new ol.control.Zoom(),
      new ol.control.FullScreen(),
      new myol.control.MyGeocoder(),
      new myol.control.MyGeolocation(),
      new myol.control.Load(),
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
        display: true, // Affiche le lien
        init: initPermalink, // On cadre le massif, s'il y a massif
      }),

      // Haut droit
      new myol.control.LayerSwitcher({
        layers: fondsCarte('nav', mapKeys),
      }),
    ],
    layers: [
      coucheMassifsColores({
        host: host,
<?php if ( !$vue->contenu ) { ?>
        selectName: 'select-massifs',
<?php } ?>
      }),
      new myol.layer.vector.Chemineur({
        selectName: 'select-chem',
      }),
      new myol.layer.vector.Alpages({
        selectName: 'select-alpages',
      }),
      new myol.layer.vector.PRC({
        selectName: 'select-prc',
      }),
      /*new myol.layer.vector.C2C({
        selectName: 'select-c2c',
      }),*/
      new myol.layer.vector.Overpass({
        selectName: 'select-osm',
      }),

      contourMassif,

      couchePointsWRI({
        host: host, // Appeler la couche de CE serveur
        selectName: 'select-wri',
        selectMassif: contourMassif.options.selector,
      }, 'nav'),
      new myol.layer.Hover(), // Gère le survol du curseur
    ],
  });

myol.trace(map);

// Centrer sur la zone du polygone
<?if ($vue->polygone->id_polygone) { ?>
  map.getView().fit(ol.proj.transformExtent([
    <?=$vue->polygone->ouest?>,
    <?=$vue->polygone->sud?>,
    <?=$vue->polygone->est?>,
    <?=$vue->polygone->nord?>,
  ], 'EPSG:4326', 'EPSG:3857'));
<? } ?>
