var map = mapNav({
  target: 'carte-nav',
  host: '<?=$config_wri["sous_dossier_installation"]?>',
  mapKeys: <?=json_encode($config_wri['mapKeys'])?>,
  id_polygone: <?=isset($vue->polygone)?$vue->polygone->id_polygone:0?>,
  id_polygone_type: <?=isset($vue->polygone)?$vue->polygone->id_polygone_type:0?>,
  extent: <?=json_encode($vue->polygone->extent)?>,
  initSelect: true,
});

myol.trace(map);