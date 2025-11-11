var map = mapIndex({
  target: 'carte-accueil',
  host: '<?=$config_wri["sous_dossier_installation"]?>',
  extent: [<?=$vue->bbox?>],
  lastChangeTime: <?=strtotime($vue->date_derniere_modification['points']??'')?>,
});
