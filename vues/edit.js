const map = mapEdit({
  target: 'carte-edit',
  host: '<?=$config_wri["sous_dossier_installation"]?>',
  mapKeys: <?=json_encode($config_wri['mapKeys'])?>,
  extent: <?=json_encode($vue->polygone->extent??null)?>,
  idPolygone: <?=$vue->polygone->id_polygone??0?>,
  idPolygoneType: <?=$vue->polygone->id_polygone_type??0?>,
});
