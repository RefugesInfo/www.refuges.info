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


require_once ("fonctions_bdd.php");
require_once ("fonctions_points.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_mode_emploi.php");
require_once ("fonctions_meta_donnees.php");

// Récupère les infos de type "méta informations" sur les points et les polygones
$vue->infos_base = infos_base (); //utile ici pour les list checkbox du HTML
$vue->etapes = new stdClass; // les etapes, les titres complementaires affiches en haut
$vue->champs = new stdClass(); // contiendra TOUS les champs de formulaire qui seront passés au V de MVC (je yip suis converti)
$vue->champs->invisibles = new stdClass ;  // champs invisibles a passer quand meme (ancien id ...)
$vue->champs->textareas = new stdClass ;
$vue->champs->boutons = new stdClass ; // Modifier, supprimer...
$vue->champs->bools = new stdClass(); // seulement les vrais bools TRUE FALSE NULL, et seulement ceux qui ont un champs_equivalent.
$vue->champs->ferme = new stdClass(); // traite en cas particulier, trop specifique
$vue->champs->places_matelas = new stdClass(); // traite en cas particulier, trop specifique, la suppression me demange

// 4 cas :
// 1) On veut faire une modification, on ne s'arrêt que si le point n'est pas trouvé
// ou si les droits sont insuffisants
if ( isset($_REQUEST["id_point"]) )  
{
    // Si c'est un modérateur, il peut voir la fiche même si elle est censurée
    if ($_SESSION['niveau_moderation']>=1)
        $meme_si_censure=True;
    else
        $meme_si_censure=False;
    $point=infos_point($_REQUEST['id_point'],$meme_si_censure);
    // Stop, le point n'existe pas (ou est censuré et il ne faut pas dire que c'est le cas)
    if ($point->erreur) 
    {    
        header("HTTP/1.0 404 Not Found");
        $vue->type="page_introuvable";
        $vue->titre="Point inexistant";
        $vue->contenu=$point->message;
        return "";
    }
    // Soit on est avec un modérateur soit le créateur de la fiche
    if ( $_SESSION['niveau_moderation']>=1 or (isset($_SESSION['id_utilisateur']) and $_SESSION['id_utilisateur']==$point->id_createur ) ) 
    {
        $vue->serie = param_cartes ($point);
        
        // bug du point_gps recree a chaque fois: il faut le transmettre en invisible.
        $vue->champs->invisibles->id_point_gps = new stdClass;
        $vue->champs->invisibles->id_point_gps->valeur = $point->id_point_gps;
        
        // boutton supprimer 
        $bouton_suppr = new stdClass;
        $bouton_suppr->nom = "action";
        $bouton_suppr->type = "submit";
        $bouton_suppr->valeur = "supprimer";
        $bouton_suppr->label = "Suppression de la fiche";
        
        //cosmétique
        $icone="&amp;iconecenter=ne_sait_pas";
        $action="Modification";
        $verbe="Modifier";
    }
    else // Ni modérateur, ni créateur on l'informe que ses droits sont insuffisants
    {
          $vue->type="page_simple";
          $vue->titre="Permissions insuffisantes";
          $vue->contenu="Désolé, mais pour cette opération vous devez être modérateur ou le créateur de cette fiche et être connecté au forum :";
          $vue->titre_lien="Connexion forum";
          $vue->lien=$config['connexion_forum'];
          return "";
    }
}
// 2) on veut faire une création, on va rempli les champs avec ceux du modèle
elseif ( isset($_REQUEST["id_point_type"]))  
{
	$conditions = new stdClass;
	$conditions->ids_types_point=$_REQUEST["id_point_type"];
	$conditions->modele=1;
	$points_modele=infos_points($conditions);
	if (count($points_modele)!=1)
		print("<strong>oulla big problème, le modèle du type de point ".$_REQUEST["id_point_type"]." n'est pas dans la base, on continue avec les champs vides</strong>");
	else
		$point=$points_modele[0];
  
    // on force les latitude à ce qui a été cliqué sur la carte (si existe, sinon vide)
    $point->longitude=$_REQUEST["x"].$_REQUEST["lon"]; // Dominique: on essaye de standardiser le nom des paramètres à lon / lat
	$point->latitude=$_REQUEST["y"].$_REQUEST["lat"];
    
    // ça me semble le moins pire de proposer le fond spécial saisie "google photos" par défaut
	$vue->serie = $config['fournisseurs_fond_carte']['Saisie'];
	// on force l'id du point à vide histoire de ne pas modifier le modèle
	unset($point->id_point);
  
	// cosmétique
	$icone="&amp;iconecenter=".$point->nom_icone;
	$action="Ajout";
	$verbe="Ajouter";
	//	$etape="<h4>Étape 3/3</h4>";
 
  
  $vue->etapes->licence = new stdClass;
  $vue->etapes->licence->titre = "Licence des contenus";
  $vue->etapes->licence->texte = "<p>L'information que vous allez rentrer <a href=\"".lien_mode_emploi("restriction_licence")."\">sera soumise à la licence creative commons by-sa</a></p>";
  
  $vue->etapes->quoimettre = new stdClass;
  $vue->etapes->quoimettre->titre = "Que mettre ou ne pas mettre ?";
  $vue->etapes->quoimettre->texte = "Tout ne trouve pas sa place sur le site, merci de prendre connaissance de
                                    <a href='" .lien_mode_emploi('que_mettre') ."'>ce qui est attendu ou pas sur le site</a>";

  $vue->etapes->saisie = new stdClass;
  $vue->etapes->saisie->titre = "Saisie";
  $vue->etapes->saisie->texte = "Rien d'obligatoire mais essayez d'être précis ne laissez pas les valeurs par défaut; au pire, remplacez par un blanc.";

	if (!isset($_SESSION['id_utilisateur']))
	{
    $vue->etapes->guest = new stdClass;
    $vue->etapes->guest->titre = "Non connecté ?";
    $vue->etapes->guest->texte = "Je note que vous n'êtes pas connecté avec un compte du forum, rien de grave à ça, mais vous ne pourrez pas revenir ensuite modifier la fiche";
	}
    else
    {
        // BUG: ecrasement du createur de la fiche en cas de modif
        $vue->auteur_modification=$_SESSION['login_utilisateur']; // sert a quoi ?
        $vue->champs->invisibles->id_createur = new stdClass;
        $vue->champs->invisibles->id_createur->valeur = $_SESSION['id_utilisateur'];
    }

}
// 3) on veut dupliquer l'actuel mais garder les mêmes coordonnées
elseif ( isset($_REQUEST["dupliquer"]))
{
        $point=infos_point($_REQUEST["dupliquer"]);
        
        $vue->etapes->unsurdeux = new stdClass;
        $vue->etapes->unsurdeux->titre = "Etape 1 / 2";
        $vue->etapes->unsurdeux->texte = "(Opération en deux étapes)";
        
        // on force l'id du point à vide histoire de ne pas modifier la copie
        unset($point->id_point);
        unset($point->nom);
        unset($point->proprio);
        unset($point->remark);
        unset($point->id_point_type);
        unset($point->article_partitif_point_type); 
        unset($point->nom_type);
        
        $vue->champs->invisibles->id_point_gps = new stdClass;
        $vue->champs->invisibles->id_point_gps->valeur = $point->id_point_gps;
        
        $vue->champs->boutons->dupliquer = new stdClass;
        $vue->champs->boutons->dupliquer->nom = "Dupliquer";
        $vue->champs->boutons->dupliquer->type = "submit";
        $vue->champs->boutons->dupliquer->valeur = "Ajouter";
        $vue->champs->boutons->dupliquer->label = "Copie avec coordonnées identiques";
}
// 4) On ne devrait pas arriver en direct sur ce formulaire
else
{    
      header("HTTP/1.0 404 Not Found");
      $vue->type="page_introuvable";
      $vue->titre="Vous n'auriez pas dû arriver sur cette page en direct";
      return "";
}

/******** Formulaire de modification/création/suppression *****************/

/******** Boutons répétés en haut et en bas *****************/
if (isset($point->id_point))
{
  $vue->champs->invisibles->id_point = new stdClass;
  $vue->champs->invisibles->id_point->valeur = $point->id_point;
}

$bouton_valider = new stdClass;
$bouton_valider->nom = "action";
$bouton_valider->type = "submit";
$bouton_valider->valeur = $verbe;
$bouton_valider->label = $verbe;

$bouton_reset = new stdClass;
$bouton_reset->nom = "reset";
$bouton_reset->type = "reset";
$bouton_reset->valeur = "Recommencer";
$bouton_reset->label = "Recommencer";

// Gestion de l'ordre des boutons modifier/valider/supprimer 
// FIXME : voir dupliquer ? car c'est bizarre l'ancienne méthode de modifier d'abord pour "dupliquer")
$vue->champs->boutons->valider=$bouton_valider;
$vue->champs->boutons->reset=$bouton_reset;

if (isset($bouton_suppr))
    $vue->champs->boutons->suppr=$bouton_suppr;

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
	$vue->champs->textareas->$nom_variable = new stdClass;
	// kesasko ?
	if ($nom_variable=="acces")
		$vue->champs->textareas->$nom_variable->disable = true; // c'est koi ?
	
	$vue->champs->textareas->$nom_variable->label=$libelle ; // faudra mettreca dans un LABEL
	$vue->champs->textareas->$nom_variable->valeur=htmlspecialchars($point->$nom_variable,0,"UTF-8");
}

/******** Les informations complétaires (booléens, détails) *****************/

// Seuls les modérateurs peuvent passer un point en censuré
// ce n'est pas tout à fait un champ trinaire comme les autres (true, false, null) car on ne peut pas "pas savoir"
if ($_SESSION['niveau_moderation']>=1)
{
    $vue->champs->censure = new stdClass ;
    $vue->champs->censure->actif = True ;
    $vue->champs->censure->valeur = $point->censure;
    $vue->champs->censure->label="Censurer ce point";
    $vue->champs->censure->aide = "Cette action n'est accessible qu'aux modérateurs, cela cachera la fiche de la vue de tous sauf les modérateurs";
}

foreach($config['champs_binaires_simples_points'] as $champ)
{
    // nouveauté, ne crée les bool QUE si il y a un champ_equivalent.
    $champ_equivalent="equivalent_$champ";
    if ( !empty($point->$champ_equivalent) )
    {
        $vue->champs->bools->$champ = new stdClass ;
        $vue->champs->bools->$champ->label = $point->$champ_equivalent ;
        $vue->champs->bools->$champ->valeur = $point->$champ; // NULL or TRUE or FALSE
        // le cas Sommaire... que je virerai bien mais qui est la juste pour la demo
        if ($champ=="sommaire")
            $vue->champs->bools->$champ->aide = "Signifie que cet un abri très 'sommaire', trop rustique pour y passer une nuit 'volontairement'...(ce qui est bien entendu subjectif, la définition elle-même peut changer)";
    }
}


//combine fermé
if ( !empty($point->equivalent_ferme) )
{
  $vue->champs->ferme->label = $point->equivalent_ferme ;
  $vue->champs->ferme->options = array('NULL' => 'ne sait pas','' => 'non','oui' => 'oui', 'detruit' => 'Détruit(e)','ruine' => 'En ruine');
  $vue->champs->ferme->valeur = is_null($point->ferme)? "NULL":$point->ferme ; // retourne "NULL" si ca vaut NULL (au lieu de"")
}
//combine matelas
if ( !empty($point->equivalent_places_matelas) )
{
  $vue->champs->places_matelas->label = $point->equivalent_places_matelas ;
  $vue->champs->places_matelas->aide = "Laisser vide ou 0 si vous ne connaissez pas le nombre";
  $vue->champs->places_matelas->valeur = is_null($point->places_matelas)?'NULL': $point->places_matelas ; // retourne un NULL en string au besoin
}

// ===================================

$vue->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
$vue->java_lib [] = $config['chemin_openlayers'].'OpenLayers.js';
// sly : FIXME je n'ai pas sû ou le mettre dans ce fichier
$vue->lien_bbcode = lien_mode_emploi("syntaxe_bbcode");
$vue->lien_aide_points = lien_mode_emploi("autres_points");

?>
