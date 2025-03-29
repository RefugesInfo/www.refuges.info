var map = mapNav({
  target: 'carte-nav',
  host: '<?=$config_wri["sous_dossier_installation"]?>',
  mapKeys: <?=json_encode($config_wri['mapKeys'])?>,
  <?php if (isset($vue->polygone)) { // si on a un polygone on zoom sur lui ?>
  id_polygone: <?=$vue->polygone->id_polygone?>,
  id_polygone_type: <?=$vue->polygone->id_polygone_type?>,
  extent: <?=json_encode($vue->polygone->extent)?>,
  <?php } ?>
  initSelect: true,
});

myol.trace(map);
