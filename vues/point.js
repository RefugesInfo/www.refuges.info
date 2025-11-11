var map = mapPoint({
  target: 'carte-point',
  host: '<?=$config_wri["sous_dossier_installation"]?>',
  mapKeys: <?=json_encode($config_wri['mapKeys'])?>,
  lastChangeTime: <?=strtotime($vue->date_derniere_modification['points']??'')?>,
});

myol.trace(map);