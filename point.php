<?php
/***
Point d'entrée de la page "Fiche du point" qui s'occupe de présenter le point, sommet,
village et tout autre "type" possible de la base avec photos, nom, infos, commentaires, etc...
on peut accéder au point par http://<site>/point/183/ce/quon/veut/ ( pour le n°183 ). (sly)
FIXME 16/02/2013: il faut en finir avec le Options +Multiviews merdique et peut performant, du rewrite et un vrai modèle MVC avec un seul script d'entrée à tous le site me semble la direction à prendre
***/


require_once ('modeles/config.php');
require_once ($config['chemin_modeles']."fonctions_autoconnexion.php");
require_once ($config['chemin_modeles']."fonctions_polygones.php");
require_once ($config['chemin_modeles']."fonctions_mode_emploi.php");
require_once ($config['chemin_modeles']."fonctions_points.php");
require_once ($config['chemin_modeles']."fonctions_pubs.php");
require_once ($config['chemin_modeles']."fonctions_utilisateurs.php");

// Arguments de la page
$array = explode ('/',$_SERVER['PATH_INFO']);
$id_point = $array [1]; // $array [1] contient l'id du point
$modele = new stdClass();
$modele = infos_point ($id_point); // Recupere les donnees du point concerné, centralisé dans une fonction maintenant sly 30/10/2008

// Les infos du point deviennent des membres du template ($modele->latitude ...)
// Partie spécifique de la page
if ($modele->erreur) 
  $modele->type = 'point_inexistant';
else if ($modele->nom_type == 'Censuré' && $_SESSION['niveau_moderation']<1) 
  $modele->type = 'point_censure';
else 
{
	$modele->nom=bbcode2html($modele->nom);
	$modele->nom_debut_majuscule=ucfirst($modele->nom);
	$modele->titre                  = "$modele->nom_debut_majuscule $modele->altitude m ($modele->nom_type)";
	$modele->description            = "fiche d'information sur : $modele->nom_debut_majuscule, $modele->nom_type, altitude $modele->altitude avec commentaires et photos";
	$modele->type                   = 'point'; // Le template
	$modele->localisation           = localisation ($modele->polygones);
	$modele->forum                  = infos_point_forum ($id_point);
	$modele->commentaires           = infos_commentaires ($id_point);
	$modele->annonce_fermeture      = texte_non_ouverte ($modele);

	/*********** Création de la liste des points à proximité si les coordonnées ne sont pas "cachée" ***/
	if ($modele->id_type_precision_gps != $config['id_coordonees_gps_fausses'])
	{
	  $conditions = new stdClass;
	  $conditions->avec_infos_massif=1;
	  $conditions->limite=10;
	  $conditions->ouvert='oui';
	  $conditions->distance="$modele->latitude;$modele->longitude;5000";
	  $conditions->ordre="distance ASC";
	  $modele->liste_proche=liste_points($conditions);
	}

	/***********  détermination si le point se situe dans un polygone pour lequel un message est à faire passer *******/
	// L'utilisation principal est le message de réglementation de la réserve naturelle
	foreach ($modele->polygones as $polygone)
	{
	  if ($polygone->message_information_polygone!="")
	  {
	    $texte_a_remplacer=array("##type_point##","##nom_polygone##","##article_partitif##");
	    $nom_type_point="$modele->article_demonstratif ".strtolower($modele->nom_type);
	    $texte_de_remplacement=array($nom_type_point,$polygone->nom_polygone,$polygone->article_partitif);
	    $modele->message_information_polygone=bbcode2html(ucfirst(str_replace($texte_a_remplacer,$texte_de_remplacement,$polygone->message_information_polygone)));
	  }
	}

	/*********** Détermination de la carte à afficher ***/
	if ($modele->id_type_precision_gps != $config['id_coordonees_gps_fausses']) { // Si les coordonnées du point sont fausse, pas besoin de carte
		$modele->mini_carte=TRUE;
		$modele->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
		$modele->java_lib [] = '/ol2.12.1.3/OpenLayers.js';
		$modele->vignette = param_cartes_vignettes ($modele);
	}

	/*********** Préparation de la présentation du point ***/
	if (isset($_SESSION['id_utilisateur']) AND (
			$_SESSION['niveau_moderation'] >= 1 OR $_SESSION['id_utilisateur'] == $modele->id_createur
		))
		$modele->lien_modification=TRUE;

	/*********** Préparation des infos complémentaires (c'est à dire les champs à cocher) ***/
	// Construction du tableau qui sera lu, ligne par ligne par le modele pour être affiché

	// Voici tous ceux qui nous intéresse (FIXME: une méthode de sioux doit exister pour se passer d'une liste en dure, comme par exemple récupérer ça directement de la base, mais bon... usine à gaz : bof)
	$champs=array_merge($config['champs_binaires_points'],array('site_officiel'));
	foreach ($champs as $champ) 
	{
	  $champ_equivalent = "equivalent_$champ";
	  // Si ce champs est vide, c'est que cet élément ne s'applique pas à ce type de point (exemple: une cheminée pour un sommet)
	  if ($modele->$champ_equivalent!="") 
	  {
	      // C'est tellement pas clair ce champs, qu'on ajoute un lien pour expliciter ou on ne dit rien si la cabane est "normale"
	      if ($champ=='sommaire')
	      {
		if ($modele->$champ=="oui")
		  $val=array('valeur'=> $modele->$champ, 'lien' => lien_mode_emploi("fiche-cabane-non-gardee"), 'texte_lien'=> "(Plus de détail sur ce que cela signifie)");
	      }
	      // Un peu spécial aussi car lien externe
	      elseif($champ=='site_officiel')
	      {
		if ($modele->$champ!="")
		  $val=array('valeur'=> '', 'lien' => $modele->$champ, 'texte_lien'=> $modele->nom_debut_majuscule);
	      }
	      else
	      {
		if ($modele->$champ=="") 
		  $modele->$champ="<strong>Inconnu</strong>";
		$val=array('valeur'=> $modele->$champ);
	      }
	
	      if (isset($val))
		$modele->infos_complementaires[$modele->$champ_equivalent]=$val;
	      
	      // Cas particulier : si matelas=yes, on indique combien de place à la ligne juste en dessous
	      if ($champ=='matelas' and $modele->$champ=='oui')
		$modele->infos_complementaires['Places sur Matelas']=array('valeur'=>$modele->places_matelas);   
	  }
	  unset($val);
	}
	/*********** Préparation des infos des commentaires ***/
	if (count ($modele->commentaires))
		foreach ($modele->commentaires AS $nc => $c){
			$commentaire = &$modele->commentaires[$nc]; // Pour faire les modifs dans le tableau et pas dans la variable de boucle
			 // Préparation des données et affichage d'un commentaire de la fiche d'un point
			// 17/10/11 / Dominique / Création
			// ici le lien pour modérer ce commentaire
			if (isset($_SESSION['id_utilisateur']) AND
				( ($_SESSION['niveau_moderation']>=1) OR ($_SESSION['id_utilisateur']==$commentaire->id_createur))
			) {
				$commentaire->lien_commentaire='/gestion/?page=moderation&amp;id_point_retour='.$commentaire->id_point.'&amp;id_commentaire='.$commentaire->id_commentaire;
				$commentaire->texte_lien_commentaire = 'Modifier';
			} else {
				// l'internaute, en cliquant ici va nous donner ce qu'il pense de ce commentaire
				$commentaire->lien_commentaire = '/gestion/avis-internaute-commentaire.php?id_commentaire='.$commentaire->id_commentaire;
				$commentaire->texte_lien_commentaire = 'Que pensez vous de ce commentaire ?';
			}

			// Si, selon la base une photo existe, on va l'afficher
			if ($commentaire->photo_existe) {
				// si la photo originale est présente ( après avril 2007 en gros ) on prépare un lien vers la photo "en grand"
				// sinon tant pis on fait un lien vers elle même 
				// ( question d'érgonomie, l'internaute ne pourrait pas comprendre que des fois ça clique des fois non )
				if (is_file($config['rep_photos_points'].$commentaire->id_commentaire.'-originale.jpeg'))
					$commentaire->fin_du_lien = '-originale';
				else
					$commentaire->fin_du_lien = '';
				
				if ($commentaire->date_photo != '0000-00-00')
					$commentaire->date_photo_format_francais=strftime('%d/%m/%Y',strtotime($commentaire->date_photo));
				else
					$commentaire->date_photo_format_francais = '';
				$commentaire->urlimg = $config ['rep_web_photos_points'] .$commentaire->id_commentaire;
			}
		}
}

/*********** On affiche le tout ***/
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?>
