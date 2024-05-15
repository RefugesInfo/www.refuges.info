// Gestion des cartes
var map = mapModif({
  target: 'carte-modif',
  host: '<?=$config_wri["sous_dossier_installation"]?>',
  mapKeys: <?=json_encode($config_wri['mapKeys'])?>,
  idPoint: <?=intval($vue->point->id_point)?>,
});

// Utilitaire de saisie
function affiche_et_set(el, affiche, valeur) {
  document.getElementById(el).style.visibility = affiche;
  document.getElementById(el).value = valeur;
  return false;
}