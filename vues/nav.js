const map = mapNav({
  target: 'carte-nav',
  host: '/',
  mapKeys: <?=json_encode($config_wri['mapKeys'])?>,
  extent: <?=json_encode($vue->polygone->extent??null)?>,
  idPolygone: <?=$vue->polygone->id_polygone??0?>,
  idPolygoneType: <?=$_REQUEST['id_polygone_type']??0?>,
});

myol.trace(map);
