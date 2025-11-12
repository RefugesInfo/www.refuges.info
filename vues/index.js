var map = mapIndex({
  target: 'carte-accueil',
  host: '/',
  extent: [<?=$vue->bbox?>],
  lastChangeTime: <?=strtotime($vue->date_derniere_modification['points']??'')?>,
});
