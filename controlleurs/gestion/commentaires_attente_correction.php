<?php
/***
Contrôleur qui prépare la vue pour les pages des commentaires en attente de correction
***/

// On applique la validation des commentaires cochés
$conditions = new stdclass;
if (!empty($_REQUEST["corrections_faites"]))
	foreach ($_REQUEST['commentaires_corriges'] as $id_commentaire) {
		$conditions->avec_points_caches=True; // Ici, en secteur modération, il est possible qu'un modérateur souhaite modifier le commentaire d'une fiche en attente de décision
		$conditions->ids_commentaires=$id_commentaire;
		$commentaires=infos_commentaires($conditions);
		if (!empty($commentaires->erreur))
			print($commentaires->message);
		else {
			$commentaire=$commentaires[0]; // On est censé récupérer qu'un seul commentaire vu qu'on a donner qu'une condition l'id
			$commentaire->demande_correction=0; 
			$retour=modification_ajout_commentaire($commentaire);
			if ($retour->erreur)
				print($retour->message);
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
	 1 => "d'un internaute nous signale une modification de fiche à faire",
	 2 => "n'a peut-être pas/plus d'intérêt selon un internaute",
	 3 => "apporte peut-être de l'information à la fiche selon un internaute",
	 4 => "contient un mot pouvant faire penser à une réservation",
	 5 => "concerne un %s et n'a pas été traitée par un modérateur",
];

