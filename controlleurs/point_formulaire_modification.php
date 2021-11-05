<?php // Modification/création de fiche point

require_once ("bdd.php");
require_once ("point.php");
require_once ("polygone.php");
require_once ("meta_donnee.php");
require_once ("mise_en_forme_texte.php");
require_once ("utilisateur.php");

// Récupère les infos de type "méta informations" sur les points et les polygones
$vue->infos_base = infos_base (); //utile ici pour les list checkbox du HTML
$vue->champs = new stdClass; // contiendra TOUS les champs de formulaire qui seront passés au V de MVC (je yip suis converti)
$vue->champs->invisibles = new stdClass;  // champs invisibles a passer quand meme (ancien id ...)
$vue->champs->textareas = new stdClass;
$vue->champs->boutons = new stdClass; // Modifier, supprimer...
$vue->champs->trinaires = new stdClass; // seulement les trinaires TRUE FALSE NULL, et seulement ceux qui ont un champs_equivalent.
$vue->champs->entier_ou_sait_pas = new stdClass; // seulement les trinaires TRUE FALSE NULL, et seulement ceux qui ont un champs_equivalent.

// 4 cas :
// 1) On veut faire une modification, on ne s'arrêt que si le point n'est pas trouvé
// ou si les droits sont insuffisants
if ( !empty($_REQUEST["id_point"]) )  
{
    // Si c'est un modérateur, il peut voir la fiche même si elle est en attente de décision
    if (est_moderateur())
        $meme_si_en_attente=True;
    else
        $meme_si_en_attente=False;

    $point=infos_point($_REQUEST['id_point'],$meme_si_en_attente);

    // Stop, le point n'existe pas (ou est en attente et il ne faut pas dire que c'est le cas)
    if (!empty($point->erreur)) 
    {
        $vue->http_status_code = 404;
        $vue->type = "page_simple";
        $vue->titre="Point inexistant";
        $vue->contenu=$point->message;
        return "";
    }
    // Soit on est avec un modérateur global ou de cette fiche
    if ( est_autorise($point->id_createur) )
    {
        // boutton supprimer uniquement pour les modérateurs globaux
        if ( est_moderateur() )
        {
            $bouton_suppr = new stdClass;
            $bouton_suppr->nom = "action";
            $bouton_suppr->type = "submit";
            $bouton_suppr->valeur = "supprimer";
            $bouton_suppr->label = "Suppression de la fiche";
        }
        
        //cosmétique
        $icone="&amp;iconecenter=ne_sait_pas";
        $action="Modification";
        $verbe="Modifier";
    }
    else // Ni modérateur global, ni modérateur de fiche on l'informe que ses droits sont insuffisants
    {
          $vue->type="page_simple";
          $vue->titre="Permissions insuffisantes";
          $vue->contenu="Désolé, mais pour cette opération vous devez être modérateur et être connecté au forum :";
          $vue->titre_lien="Connexion forum";
          $vue->lien=$config_wri['connexion_forum'];
          return "";
    }
}
// 2) on veut faire une création, on va rempli les champs avec ceux du modèle
elseif ( !empty($_REQUEST["id_point_type"]))  
{
    $conditions = new stdClass;
    $conditions->ids_types_point=$_REQUEST["id_point_type"];
    $conditions->modele='uniquement';
    $points_modele=infos_points($conditions);
    if (count($points_modele)!=1)
    {
        print("<strong>oulla big problème, le modèle du type de point ".$_REQUEST["id_point_type"]." n'est pas dans la base, on continue avec les champs vides</strong>");
        $point = new stdClass;
    }
    else
        $point=$points_modele[0];
    
    // on force les latitude à ce qui a été cliqué sur la carte (si existe, sinon vide)
    $point->longitude=6;
    $point->latitude=47;
    
    // on force l'id du point à vide histoire de ne pas modifier le modèle
    unset($point->id_point);
    // et pareil pour le modérateur actuel du point qui sera alors choisi directement car l'utilisateur est authentifié (ou pas, mais alors ça sera 0)
    unset($point->id_createur);
    
    // cosmétique
    $icone="&amp;iconecenter=".choix_icone($point);
    $action="Ajout";
    $verbe="Ajouter";
}
// 3) On ne devrait pas arriver en direct sur ce formulaire ou il nous manque une information
else
{    
    $vue->type="page_simple";
    $vue->titre="Vous n'auriez pas dû arriver sur cette page de cette façon (formulaire précédent incomplet ?)";
    return "";
}

/******** Formulaire de modification/création/suppression *****************/
if (!empty($point->id_point))
{
    $vue->champs->invisibles->id_point = new stdClass;
    $vue->champs->invisibles->id_point->valeur = $point->id_point;
}

/******** Boutons répétés en haut et en bas FIXME devrait être dans $vue-> *****************/
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
$vue->champs->boutons->valider=$bouton_valider;
$vue->champs->boutons->reset=$bouton_reset;

if (!empty($bouton_suppr))
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
    $vue->champs->textareas->$nom_variable->label=$libelle;
    $vue->champs->textareas->$nom_variable->valeur=protege($point->$nom_variable);
}

/******** Les informations complémentaires (places, matelas, latrines, bois à proximité, etc.) *****************/

// Seuls les modérateurs peuvent passer un point en attente de décision, le test est directement dans la vue
$vue->champs->en_attente = $point->en_attente;
$vue->champs->en_attente_label = "Mettre ce point en attente";
$vue->champs->en_attente_aide = "Cette action n'est accessible qu'aux modérateurs, cela cachera la fiche de la vue de tous sauf des modérateurs le temps de prendre une décision";

// cas spécifique des champs qui peuvent être NULL=ne sait pas ou un nombre entier
foreach ($config_wri['champs_entier_ou_sait_pas_points'] as $champ)
{
  $champ_equivalent="equivalent_$champ";
  if ( !empty($point->$champ_equivalent) )
  {
    $vue->champs->entier_ou_sait_pas->$champ = new stdClass ;
    $vue->champs->entier_ou_sait_pas->$champ->label = $point->$champ_equivalent;
    $vue->champs->entier_ou_sait_pas->$champ->valeur = $point->$champ ;
  }
}
// cas des champs trinaires (oui, non, ne sait pas)
foreach($config_wri['champs_trinaires_points'] as $champ)
{
  // on ne créér QUE si il y a un equivalent_$champ existe, ce qui signifie que cela a un sens pour ce type de point.
  $champ_equivalent="equivalent_$champ";
  if ( !empty($point->$champ_equivalent) )
  {
    $vue->champs->trinaires->$champ = new stdClass ;
    $vue->champs->trinaires->$champ->label = $point->$champ_equivalent ;
    $vue->champs->trinaires->$champ->valeur = $point->$champ; // NULL or TRUE or FALSE
  }
}

//spécificité du cas des conditions d'utilisation de la cabane (clé à récup, ouvert tout le temps, fermée tout le temps, ou détruite)
if ( !empty($point->equivalent_conditions_utilisation) )
{
    $vue->champs->conditions_utilisation = new stdClass; // traite en cas particulier, trop specifique

    if ($point->id_point_type==$config_wri['point_d_eau'])
        $vue->champs->conditions_utilisation->options = array('ouverture' => 'Coule', 'NULL' => 'Ne sait pas','detruit' => 'Détruite','fermeture' => $point->equivalent_conditions_utilisation);
    else if ($point->id_point_type==$config_wri['passage_delicat'])
        $vue->champs->conditions_utilisation->options = array('ouverture' => 'Ouvert', 'NULL' => 'Ne sait pas','fermeture' => $point->equivalent_conditions_utilisation);
    else
        $vue->champs->conditions_utilisation->options = array('ouverture' => 'Ouvert', 'detruit' => 'Détruit(e)','fermeture' => $point->equivalent_conditions_utilisation,'cle_a_recuperer' => 'Clé à récupérer');
    $vue->champs->conditions_utilisation->valeur = is_null($point->conditions_utilisation)? "NULL":$point->conditions_utilisation ; // retourne "NULL" si ca vaut NULL (au lieu de"")
}
// ===========================================
// Préparation de la $vue commune à chaque cas

$vue->css          [] = $config_wri['url_chemin_ol'].'ol/ol.css?'.filemtime($config_wri['chemin_ol'].'ol/ol.css');
$vue->java_lib_foot[] = $config_wri['url_chemin_ol'].'ol/ol.js?'.filemtime($config_wri['chemin_ol'].'ol/ol.js');
if (!$config_wri['is_ie']) { // geocoder non supporté IE
  $vue->css          [] = $config_wri['url_chemin_ol'].'geocoder/ol-geocoder.min.css?'.filemtime($config_wri['chemin_ol'].'geocoder/ol-geocoder.min.css');
  $vue->java_lib_foot[] = $config_wri['url_chemin_ol'].'geocoder/ol-geocoder.js?'.filemtime($config_wri['chemin_ol'].'geocoder/ol-geocoder.js');
}
$vue->java_lib_foot[] = $config_wri['url_chemin_ol'].'proj4/proj4.js?'.filemtime($config_wri['chemin_ol'].'proj4/proj4.js');
$vue->css          [] = $config_wri['url_chemin_ol'].'myol.css?'.filemtime($config_wri['chemin_ol'].'myol.css');
$vue->java_lib_foot[] = $config_wri['url_chemin_ol'].'myol.js?'.filemtime($config_wri['chemin_ol'].'myol.js');

// sly : FIXME je n'ai pas sû ou le mettre dans ce fichier
$vue->lien_bbcode = lien_wiki("syntaxe_bbcode");
$vue->lien_aide_points = lien_wiki("autres_points");

// En mode modification, on peut récupéer toutes les infos du point à modifier dans $vue->point->$propriété, ça peut contenir des tas de caractères douteux
$point->nom=protege($point->nom);
$point->site_officiel=protege($point->site_officiel);
$point->nom_createur=protege($point->nom_createur);
$vue->point=$point;
$vue->utilisateurs=infos_utilisateurs();

