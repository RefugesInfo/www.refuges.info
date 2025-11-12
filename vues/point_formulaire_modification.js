// Gestion des cartes
var map = mapModif({
  target: 'carte-modif',
  host: '/',
  mapKeys: <?=json_encode($config_wri['mapKeys'])?>,
  idPoint: <?=$vue->point->id_point ?? 0?>,
});

// Utilitaire de saisie
function affiche_et_set(el, affiche, valeur) {
  document.getElementById(el).style.visibility = affiche;
  document.getElementById(el).value = valeur;
  return false;
}
