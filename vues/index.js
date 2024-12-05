var map = mapIndex({
  target: 'carte-accueil',
  host: '<?=$config_wri["sous_dossier_installation"]?>',
  selection: '<?=implode(',', $config_wri['tout_type_d_abri'])?>',
  extent: [<?=$vue->bbox?>],
});
