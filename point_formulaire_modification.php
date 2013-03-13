<?php // Modification/création de fiche point

// Contient le code PHP de la page

// 21/03/06 rff Création : mysql_free_result et script php unique sans inclusions html (html renvoyé au client par commande echo. Anciennes balises php enlevées
// 21/03/06 rff : Insertion infos de session : utile pour gestion du cache & menu gestion
// 21/03/06 rff : la table 'massifs' devient 'polygones' dans la base 'refuges'
// 21/03/06 rff : Ajout date du jour par défaut ds 'dernière visite'
// 15/04/07 jmb : ajout de "auteur", et suppr des tables. conforme XHTML 1
// 06/10/07 sly : Formulaire dynamique selon le type de point à ajouter/modifier
// 06/03/08 jmb : new version avec déco
// 03/07/08 jmb : déplacement du include header a la fin
// 19/10/08 sly : remplacement de auteur et id_auteur par l'utilisateur a avoir fait
// 24/10/10 Dominique : Passage sur les cartes Openlayers
// 20/12/10 Dominique : Retour en GoogleMap API V2
// 15/04/11 Dominique : Passage en OL2.11
// 28/05/12 Dominique : Utilisation des modeles


require_once ("modeles/config.php");
require_once ("fonctions_bdd.php");
require_once ("fonctions_points.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_mode_emploi.php");
require_once ("fonctions_meta_donnees.php");

// Récupère les infos de type "méta informations" sur les points et les polygones
$modele = new stdClass();
$modele->infos_base = infos_base (); //utile ici pour les list checkbox du HTML
$modele->etapes = new stdClass; // les etapes, les titres complementaires affiches en haut
$modele->champs = new stdClass(); // contiendra TOUS les champs de formulaire qui seront passés au V de MVC (je yip suis converti)
$modele->champs->invisibles = new stdClass ;  // champs invisibles a passer quand meme (ancien id ...)
$modele->champs->textareas = new stdClass ;
$modele->champs->boutons = new stdClass ; // Modifier, supprimer...
$modele->champs->bools = new stdClass(); // seulement les vrais bools TRUE FALSE NULL, et seulement ceux qui ont un champs_equivalent.
$modele->champs->ferme = new stdClass(); // traite en cas particulier, trop specifique
$modele->champs->places_matelas = new stdClass(); // traite en cas particulier, trop specifique, la suppression me demange


$modele->page_action="/point_modification.php";
// 4 cas :
// 1) On veut faire une modification, on ne s'arrêt que si le point n'est pas trouvé
// ou si les droits sont insuffisants
if ( isset($_REQUEST["id_point"]) )  
{
	if ( $_SESSION['niveau_moderation']<1 AND $_SESSION['id_utilisateur']!=$point->id_createur ) 
		erreur_on_arrete("Désolé, mais pour cette opération vous devez être modérateur du site et connecté au forum <a href=\"".$config['connexion_forum']."\">Connexion forum</a>");

	// on charge
	$point=infos_point($_REQUEST['id_point']);
	// Merde stop, le point n'existe pas
	if ($point->erreur) 
		erreur_on_arrete("<strong>problème : $point->message</strong>");

	$modele->localisation = localisation ($point->polygones); // FIXME : la fonction localisation n'est pas faite pour ça voyons !
	$modele->serie = param_cartes ($modele->localisation);

	// boutton en plus
  $modele->champs->boutons->suppr = new stdClass;
  $modele->champs->boutons->suppr->nom = "action";
  $modele->champs->boutons->suppr->type = "submit";
  $modele->champs->boutons->suppr->valeur = "supprimer";
  $modele->champs->boutons->suppr->label = "Suppression de la fiche";
  $modele->champs->boutons->suppr->js_onclick = "confirmation(this, 'SUPPRIMER')";
  
	//$boutton_supprimer="<a href=\"$modele->page_action?action=supprimer&amp;id_point=$point->id_point\"><strong>Suppression de la fiche</strong></a>";

	//cosmétique
	$icone="&amp;iconecenter=ne_sait_pas";
	$action="Modification";
	$verbe="Modifier";
	//$etape="";
}
// 2) on veut faire une création, on va rempli les champs avec ceux du modèle
elseif ( isset($_REQUEST["id_point_type"]))  
{
	$conditions = new stdClass;
	$conditions->type_point=$_REQUEST["id_point_type"];
	$conditions->modele=1;
	$points_modele=infos_points($conditions);
	if (count($points_modele)!=1)
		print("<strong>oulla big problème, le modèle du type de point ".$_REQUEST["id_point_type"]." n'est pas dans la base, on continue avec les champs vides</strong>");
	else
		$point=$points_modele[0];
  
	// on force les latitude à ce qui a été cliqué sur la carte (si existe, sinon vide)
	$point->longitude=$_REQUEST["x"].$_REQUEST["lon"]; // Dominique: on essaye de standardiser le nom des paramètres à lon / lat
	$point->latitude=$_REQUEST["y"].$_REQUEST["lat"];
	$modele->serie [1] = 20000; // Echelle de la carte
  
	// on force l'id du point à vide histoire de ne pas modifier le modèle
	unset($point->id_point);
  
	// cosmétique
	$icone="&amp;iconecenter=".$point->nom_icone;
	$action="Ajout";
	$verbe="Ajouter";
	//	$etape="<h4>Étape 3/3</h4>";
 
  
  $modele->etapes->licence = new stdClass;
  $modele->etapes->licence->titre = "Licence des contenus";
  $modele->etapes->licence->texte = $config['message_licence'];
  
  $modele->etapes->quoimettre = new stdClass;
  $modele->etapes->quoimettre->titre = "Que mettre ou ne pas mettre ?";
  $modele->etapes->quoimettre->texte = "Tout ne trouve pas sa place sur le site, merci de prendre connaissance de
                                    <a href='" .lien_mode_emploi('que_mettre') ."'>ce qui est attendu ou pas sur le site</a>";

  $modele->etapes->saisie = new stdClass;
  $modele->etapes->saisie->titre = "Saisie";
  $modele->etapes->saisie->texte = "Rien d'obligatoire mais essayez d'être précis ne laissez pas les valeurs par défaut; au pire, remplacez par un blanc.";

	if (!isset($_SESSION['id_utilisateur']))
	{
    $modele->etapes->guest = new stdClass;
    $modele->etapes->guest->titre = "Non connecté ?";
    $modele->etapes->guest->texte = "Je note que vous n'êtes pas connecté avec un compte du forum, rien de grave à ça, mais vous ne pourrez pas revenir ensuite modifier la fiche";
	}
}
// 3) on veut dupliquer l'actuel mais garder les mêmes coordonnées
elseif ( isset($_REQUEST["dupliquer"]))
{
	$point=infos_point($_REQUEST["dupliquer"]);

  $modele->etapes->unsurdeux = new stdClass;
  $modele->etapes->unsurdeux->titre = "Etape 1 / 2";
  $modele->etapes->unsurdeux->texte = "(Opération en deux étapes)";

	// on force l'id du point à vide histoire de ne pas modifier la copie
	unset($point->id_point);
	unset($point->nom);
	unset($point->proprio);
	unset($point->remark);
	unset($point->id_point_type);
	unset($point->article_partitif_point_type); 
	unset($point->nom_type);
  
  $modele->champs->invisibles->id_point_gps = new stdClass;
  $modele->champs->invisibles->id_point_gps->valeur = $point->id_point_gps;

  $modele->champs->boutons->dupliquer = new stdClass;
  $modele->champs->boutons->dupliquer->nom = "Dupliquer";
  $modele->champs->boutons->dupliquer->type = "submit";
  $modele->champs->boutons->dupliquer->valeur = "Ajouter";
  $modele->champs->boutons->dupliquer->label = "Copie avec coordonnées identiques";

	//$deja_point_gps.="<input type='hidden' name='id_point_gps' value='$point->id_point_gps' />";
  
	// cosmétique
	//$disabled_field=" style=\"background-color: #e3d4d4\" onFocus=\"javascript: this.blur()\"";
  

//	$action="Copie avec coordonnées identiques";
//	$verbe="Ajouter";
//	$icone="&amp;iconecenter=".$point->nom_icone;

}
// 4) On ne devrait pas arriver en direct sur ce formulaire
else
	erreur_on_arrete("<h3>Vous n'auriez pas dû arriver sur cette page en direct</h3>");

/******** Formulaire de modification/création/suppression *****************/

/******** Boutons répétés en haut et en bas *****************/
if (isset($point->id_point))
{
  $modele->champs->invisibles->id_point = new stdClass;
  $modele->champs->invisibles->id_point->valeur = $point->id_point;
}

$modele->champs->boutons->valider = new stdClass;
$modele->champs->boutons->valider->nom = "action";
$modele->champs->boutons->valider->type = "submit";
$modele->champs->boutons->valider->valeur = $verbe;
$modele->champs->boutons->valider->label = $verbe;

$modele->champs->boutons->reset = new stdClass;
$modele->champs->boutons->reset->nom = "reset";
$modele->champs->boutons->reset->type = "reset";
$modele->champs->boutons->reset->valeur = "Recommencer";
$modele->champs->boutons->reset->label = "Recommencer";

//$boutton_actions="
//	Validation:
//		$deja_point_gps$deja_point
// 		<input type='submit' name='action' value='$verbe' />
//		<input type='reset' value='Recommencer' />
//		$boutton_supprimer
//";

//3 Champs text area similaires, on fait une boucle
// tous les points n'ont pas forcément un propriétaire ( lac, sommet, etc. )
if ( !empty($point->equivalent_proprio) )
	$textes_area[$point->equivalent_proprio]="proprio";

//ils ont en revanche tous un accès et un champ remarques
$textes_area["accès"]="acces";
$textes_area["remarques"]="remark";


/******** Les champs libres *****************/
foreach ($textes_area as $libelle => $nom_variable)
{
	$modele->champs->textareas->$nom_variable = new stdClass;
	// kesasko ?
	if ($nom_variable=="acces")
		$modele->champs->textareas->$nom_variable->disable = true; // c'est koi ?
	
	$modele->champs->textareas->$nom_variable->label=$libelle ; // faudra mettreca dans un LABEL
	$modele->champs->textareas->$nom_variable->valeur=htmlspecialchars($point->$nom_variable,0,"UTF-8");
}

// BUG: ecrasement du createur de la fiche en cas de modif
//var_dump($point);
if (isset($_SESSION['id_utilisateur']) && empty($point->nom_createur) )
{
	$modele->auteur_modification=$_SESSION['login_utilisateur']; // sert a quoi ?
    $modele->champs->invisibles->id_createur = new stdClass;
    $modele->champs->invisibles->id_createur->valeur = $_SESSION['id_utilisateur'];
}
/******** Les informations complétaires (booléens, détails) *****************/

foreach($config['champs_binaires_simples_points'] as $champ)
{
		// nouveauté, ne crée les bool QUE si il y a un champ_equivalent.
		$champ_equivalent="equivalent_$champ";
		if ( !empty($point->$champ_equivalent) )
		{
			$modele->champs->bools->$champ = new stdClass ;
			$modele->champs->bools->$champ->label = $point->$champ_equivalent ;
            $modele->champs->bools->$champ->valeur = $point->$champ; // NULL or TRUE or FALSE
            // le cas Sommaire... que je virerai bien mais qui est la juste pour la demo
            if ($champ=="sommaire")
                $modele->champs->bools->$champ->aide = "Signifie que cet un abri très 'sommaire', trop rustique pour y passer une nuit 'volontairement'...(ce qui est bien entendu subjectif, la définition elle-même va sûrement changer)";
    }
}

//combine fermé
if ( !empty($point->equivalent_ferme) )
{
  $modele->champs->ferme->label = $point->equivalent_ferme ;
  $modele->champs->ferme->options = array('NULL' => 'ne sait pas','' => 'non','oui' => 'oui', 'detruit' => 'Détruit(e)','ruine' => 'En ruine');
  $modele->champs->ferme->valeur = is_null($point->ferme)? "NULL":$point->ferme ; // retourne "NULL" si ca vaut NULL (au lieu de"")
}
//combine matelas
if ( !empty($point->equivalent_places_matelas) )
{
  $modele->champs->places_matelas->label = $point->equivalent_places_matelas ;
  $modele->champs->places_matelas->aide = "Laisser vide si il n'y a pas de matelas disponible";
  $modele->champs->places_matelas->valeur = (string) $point->places_matelas ; // retourne "" si existe pas
}
/*if ($champ=="ferme")
			{
				$option['ruine']='En ruine';
				$option['detruit']='Détruit(e)';
			}

*/
			//if(!is_null($point->$champ))
			//	$modele->champs->bools->$champ->valeur = $point->$champ; // a venir TRUE or FALSE
			//else
			//	$modele->champs->bools->$champ->valeur = NULL;

			//unset($checked_html);
			//$checked_html[$point->$champ]=$checked;

			//$modele->champs->bools->$champ->checked = $point->$champ // true false ou null
			//$option=array('' => 'ne sait pas','oui' => 'oui', 'non' => 'non');
			
			//foreach ($option as $nom_variable => $texte)
			//	$html_info_complementaires.="&nbsp; &nbsp; $texte:<input ".$checked_html[$nom_variable]." name='$champ' type='radio' value='$nom_variable'/>";

			// "Abri sommaire" n'étant pas clair, et l'expliquer prenant de la place
			// je fais une exception que je ne peux afficher comme les autres
			//if ($champ=='sommaire')
			//     $html_info_complementaires.="<a href=\"/statique/mode_emploi.php?page=fiche-cabane-non-gardee\">(Plus de détail sur ce que cela signifie)</a>";

			// cas particuliers des matelas, si on dispose de l'info on peut indique le nombre de place sur matelas
			// FIXME matelas redonde avec nbplaces matelas.
			//if ($champ=='matelas')
			//	$html_info_complementaires.=" Nombre de places sur matelas: <input name='places_matelas' type='text' value='$point->places_matelas'/>";
		
	//$html_info_complementaires .="</dd>\n";
	
	//if ($point->equivalent_site_officiel!="")
	//  $html_info_complementaires .="\t\t<dd style='clear: both;' class=\"big_one\"> <div class=\"libelle\">$point->equivalent_site_officiel:</div> <input name='site_officiel' size='70' type='text' value='".htmlspecialchars($point->site_officiel,0,"UTF-8")."'/></dd>";

	//$htmlconstruct.=$html_info_complementaires;
/******** Détail de gestion, code anti-robot, auteur *****************/

// si la personne n'est pas modérateur, on demande un code visuel anti-robot. sly
/*if (!isset($_SESSION['id_utilisateur']))
{
	// Si pas connecté, on demande un nom d'auteur
	$htmlconstruct .="
	<dt style='clear: both;'>Gestion:</dt>
		<dd>Mettez votre nom ou pseudo (facultatif) :<input type=\"text\" name=\"nom_createur\" maxlength=\"40\" size=\"41\" value=\"".htmlspecialchars($nom_createur,ENT_QUOTES,"UTF-8")."\" /></dd>
	";
	// ansi qu'un code anti-robot
	$htmlconstruct.="
	<dd>
	<fieldset><legend>Protection anti-Spam</legend>
		<label><input name=\"lettre_securite\" type=\"text\" size=\"1\" />Entrez la lettre <strong>d</strong></label>
	</fieldset>
	</dd>
	";
}
*/
// ===================================

$modele->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
$modele->java_lib [] = $config['chemin_openlayers'].'OpenLayers.js';

// On affiche le tout
$modele->type = 'point_formulaire_modification';
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");

// ===================================
// fonction pour mourrir sur un message d'erreur ;-)
// TODO: Tout ça est à reprendre...
function erreur_on_arrete($texte)
{
	global $config;
	$modele->texte = $texte;
	$modele->type = 'point_formulaire_modification_erreur';
	include ($config['chemin_vues']."_entete.html");
	include ($config['chemin_vues']."$modele->type.html");
	include ($config['chemin_vues']."_pied.html");
	die(); // peut être moyen de faire mieux mais bon, gros problème donc on se tire
}
?>
