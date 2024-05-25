var map = mapIndex({
  target: 'carte-accueil',
  host: '<?=$config_wri["sous_dossier_installation"]?>',
  extent: [<?=$vue->bbox?>],
});