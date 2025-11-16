var map = mapIndex({
  target: 'carte-accueil',
  host: '/',
  mapKeys: <?=json_encode($config_wri['mapKeys'])?>,
  extent: [<?=$vue->bbox?>],
});
