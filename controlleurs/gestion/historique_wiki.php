<?php
/***
Historique du wiki : liste de toutes les pages (supprimées comprises), versions d'une page et restauration d'une version
La restauration ajoute une copie de la version choisie, voir restaurer_version_wiki()
***/

add_lib('style_formulaire.css');
require_once ('wiki.php');

$vue->page = $_GET['page'] ?? $_POST['page'] ?? '';
$vue->resultat = null;

if ($vue->page !== '' and !empty($_POST['restaurer']) and !empty($_POST['version']))
  $vue->resultat = restaurer_version_wiki($vue->page, $_POST['version']);

// Purge définitive : administrateurs seulement
if ($vue->page !== '' and !empty($_POST['purger']))
{
  if (!est_administrateur())
    $vue->resultat = erreur(_("Réservé aux administrateurs"));
  else
  {
    $vue->resultat = purger_page_wiki($vue->page);
    if (empty($vue->resultat->erreur))
      $vue->page = ''; // la page n'existe plus, retour à la liste
  }
}

if ($vue->page === '')
  $vue->pages_wiki = liste_pages_wiki_avec_supprimees();
else
  $vue->versions = versions_page_wiki($vue->page);
