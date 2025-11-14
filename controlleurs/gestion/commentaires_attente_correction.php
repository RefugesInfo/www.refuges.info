<?php
/***
Contrôleur qui prépare la vue pour les pages des commentaires en attente de correction
***/

// On applique la validation des commentaires cochés
$conditions = new stdclass;
if (!empty($_REQUEST["corrections_faites"]))
  foreach ($_REQUEST['commentaires_corriges'] as $id_commentaire) {
    $commentaire=infos_commentaire($id_commentaire,True);
    if (!empty($commentaire->erreur))
    {
      $vue->type = "page_simple";
      $vue->titre= "Erreur de modération";
      $vue->contenu=$commentaire->message."<br>peut être pouvez-vous essayer de ré-ouvrir ce formulaire : ";
      $vue->lien="./commentaires_attente_correction";
      $vue->titre_lien="Liste des commentaires en attente de correction";
    }
    else {
      $commentaire->demande_correction=0;
      $retour=modification_ajout_commentaire($commentaire);

      if (!empty($retour->erreur))
      {
        $vue->type = "page_simple";
        $vue->titre= "Erreur de modération";
        $vue->contenu=$retour->erreur;
      }
    }
  }

// On charge dans le template la liste des attentes de corrections
$conditions_attente_correction = new stdclass;
$conditions_attente_correction->demande_correction=True;
$conditions_attente_correction->avec_infos_point=True;
$conditions_attente_correction->avec_points_caches=True;
$vue->commentaires_attente_correction=infos_commentaires($conditions_attente_correction);

// Petit tableau pour afficher le message de cause
$vue->liste_causes = [
  1 => "nous signale une modification de fiche à faire",
  2 => "n'a peut-être pas/plus d'intérêt selon un internaute",
  3 => "apporte peut-être de l'information à la fiche selon un internaute",
  4 => "contient un mot pouvant faire penser à une réservation",
  5 => "concerne un %s et n'a pas été traitée par un modérateur",
];

