var map = mapPoint({
  target: 'carte-point',
  host: '<?=$config_wri["sous_dossier_installation"]?>',
  mapKeys: <?=json_encode($config_wri['mapKeys'])?>,
  layerOptions: <?=json_encode($config_wri['layerOptions'])?>,
});

myol.trace(map);