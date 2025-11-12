var map = mapPoint({
  target: 'carte-point',
  host: '<?=$config_wri["sous_dossier_installation"]?>',
  mapKeys: <?=json_encode($config_wri['mapKeys'])?>,
});

myol.trace(map);