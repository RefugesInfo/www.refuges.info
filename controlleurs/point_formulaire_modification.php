<?php // Modification/création de fiche point

require_once ("bdd.php");
require_once ("point.php");
require_once ("polygone.php");
require_once ("meta_donnee.php");
require_once ("mise_en_forme_texte.php");
require_once ("utilisateur.php");

// Récupère les infos de type "méta informations" sur les points et les polygones
$vue->infos_base = infos_base (); //utile ici pour les list checkbox du HTML
$vue->etapes = new stdClass; // les etapes, les titres complementaires affiches en haut
$vue->champs = new stdClass; // contiendra TOUS les champs de formulaire qui seront passés au V de MVC (je yip suis converti)
$vue->champs->invisibles = new stdClass;  // champs invisibles a passer quand meme (ancien id ...)
$vue->champs->textareas = new stdClass;
$vue->champs->boutons = new stdClass; // Modifier, supprimer...
$vue->champs->bools = new stdClass; // seulement les vrais bools TRUE FALSE NULL, et seulement ceux qui ont un champs_equivalent.
$vue->champs->places_matelas = new stdClass; // traite en cas particulier, trop specifique, la suppression me demange
$vue->fond_carte_par_defaut= $config_wri['carte_base'];

// 4 cas :
// 1) On veut faire une modification, on ne s'arrêt que si le point n'est pas trouvé
// ou si les droits sont insuffisants
if ( isset($_REQUEST["id_point"]) )  
{
    // Si c'est un modérateur, il peut voir la fiche même si elle est en attente de décision
    if ($_SESSION['niveau_moderation']>=1)
        $meme_si_en_attente=True;
    else
        $meme_si_en_attente=False;
    $point=infos_point($_REQUEST['id_point'],$meme_si_en_attente);
    // Stop, le point n'existe pas (ou est en attente et il ne faut pas dire que c'est le cas)
    if ($point->erreur) 
    {
        $vue->http_status_code = 404;
        $vue->type = "page_simple";
        $vue->titre="Point inexistant";
        $vue->contenu=$point->message;
        return "";
    }
    // Soit on est avec un modérateur global ou de cette fiche
    if ( isset($_SESSION['id_utilisateur']) AND ( $_SESSION['niveau_moderation'] >= 1 OR $_SESSION['id_utilisateur'] == $point->id_createur ) ) 
    {
        $vue->serie = param_cartes ($point);
        
        // bug du point_gps recree a chaque fois: il faut le transmettre en invisible.
        $vue->champs->invisibles->id_point_gps = new stdClass;
        $vue->champs->invisibles->id_point_gps->valeur = $point->id_point_gps;
        
        // boutton supprimer uniquement pour les modérateurs globaux
        if ( $_SESSION['niveau_moderation'] >= 1 )
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

        $vue->serie = $config_wri['fournisseurs_fond_carte']['Saisie-modification'];    
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
elseif ( isset($_REQUEST["id_point_type"]))  
{
    $conditions = new stdClass;
    $conditions->ids_types_point=$_REQUEST["id_point_type"];
    $conditions->modele=1;
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
    $icone="&amp;iconecenter=".$point->nom_icone;
    $action="Ajout";
    $verbe="Ajouter";
    
    $vue->etapes->saisie = new stdClass;
    $vue->etapes->saisie->titre = "Saisie";
    $vue->etapes->saisie->texte = "Rien d'obligatoire mais essayez d'être précis ne laissez pas les valeurs par défaut; au pire, remplacez par un blanc.";
    
    if (!isset($_SESSION['id_utilisateur']))
    {
        $vue->etapes->guest = new stdClass;
        $vue->etapes->guest->titre = "Non connecté ?";
        $vue->etapes->guest->texte = "Je note que vous n'êtes pas connecté avec un compte du forum, rien de grave à ça, mais vous ne pourrez pas revenir ensuite modifier la fiche";
    }
    
    $vue->serie = $config_wri['fournisseurs_fond_carte']['Saisie-création'];    

}
// 3) On ne devrait pas arriver en direct sur ce formulaire ou il nous manque une information
else
{    
    $vue->type="page_simple";
    $vue->titre="Vous n'auriez pas dû arriver sur cette page de cette façon (formulaire précédent incomplet ?)";
    return "";
}

/******** Formulaire de modification/création/suppression *****************/

if (isset($point->id_point))
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
    $vue->champs->textareas->$nom_variable->valeur=protege($point->$nom_variable);
}

/******** Les informations complémentaires (booléens, détails) *****************/

// Seuls les modérateurs peuvent passer un point en attente de décision
// ce n'est pas tout à fait un champ trinaire comme les autres (true, false, null) car on ne peut pas "pas savoir"
if ($_SESSION['niveau_moderation']>=1)
{
    $vue->champs->en_attente = new stdClass ;
    $vue->champs->en_attente->actif = True ;
    $vue->champs->en_attente->valeur = $point->en_attente;
    $vue->champs->en_attente->label="Mettre ce point en attente";
    $vue->champs->en_attente->aide = "Cette action n'est accessible qu'aux modérateurs, cela cachera la fiche de la vue de tous sauf les modérateurs le temps de prendre une décision";
}

foreach($config_wri['champs_binaires_points'] as $champ)
{
    // nouveauté, ne crée les bool QUE si il y a un champ_equivalent.
    $champ_equivalent="equivalent_$champ";
    if ( !empty($point->$champ_equivalent) )
    {
        $vue->champs->bools->$champ = new stdClass ;
        $vue->champs->bools->$champ->label = $point->$champ_equivalent ;
        $vue->champs->bools->$champ->valeur = $point->$champ; // NULL or TRUE or FALSE
    }
}

//spécificité du cas des conditions d'utilisation de la cabane (clé à récup, ouvert tout le temps, fermée tout le temps, ou détruite)
if ( !empty($point->equivalent_conditions_utilisation) )
{
    $vue->champs->conditions_utilisation = new stdClass; // traite en cas particulier, trop specifique

    if ($point->id_point_type==$config_wri['point_d_eau'])
        $vue->champs->conditions_utilisation->options = array('ouverture' => 'Coule', 'NULL' => 'Ne sait pas','detruit' => 'Détruite','fermeture' => $point->equivalent_conditions_utilisation);
    else
        $vue->champs->conditions_utilisation->options = array('ouverture' => 'Ouvert', 'detruit' => 'Détruit(e)','fermeture' => $point->equivalent_conditions_utilisation,'cle_a_recuperer' => 'Clé à récupérer');
    $vue->champs->conditions_utilisation->valeur = is_null($point->conditions_utilisation)? "NULL":$point->conditions_utilisation ; // retourne "NULL" si ca vaut NULL (au lieu de"")
}
//combine matelas
if ( !empty($point->equivalent_places_matelas) )
{
    $vue->champs->places_matelas->label = $point->equivalent_places_matelas ;
    $vue->champs->places_matelas->aide = "Laisser vide ou 0 si vous ne connaissez pas le nombre";
    $vue->champs->places_matelas->valeur = is_null($point->places_matelas)?'NULL': $point->places_matelas ; // retourne un NULL en string au besoin
}

// ===========================================
// Préparation de la $vue commune à chaque cas

$vue->css           [] = $config_wri['url_chemin_leaflet'].'leaflet.css?'.filemtime($config_wri['chemin_leaflet'].'leaflet.css');
$vue->java_lib_foot [] = $config_wri['url_chemin_leaflet'].'leaflet.js?' .filemtime($config_wri['chemin_leaflet'].'leaflet.js');
// sly : FIXME je n'ai pas sû ou le mettre dans ce fichier
$vue->lien_bbcode = lien_wiki("syntaxe_bbcode");
$vue->lien_aide_points = lien_wiki("autres_points");

// En mode modification, on peut récupéer toutes les infos du point à modifier dans $vue->point->$propriété, ça peut contenir des tas de caractères douteux
$point->nom=protege($point->nom);
$point->site_officiel=protege($point->site_officiel);
$point->nom_createur=protege($point->nom_createur);
$vue->point=$point;
$vue->utilisateurs=infos_utilisateurs();
?>
