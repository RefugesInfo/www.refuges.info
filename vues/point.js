var map = mapPoint({
  target: 'carte-point',
  host: '/',
  mapKeys: <?=json_encode($config_wri['mapKeys'])?>,
});

myol.trace(map);