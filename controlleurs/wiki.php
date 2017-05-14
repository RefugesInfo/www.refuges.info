<?php 
/*****************************************************
Controlleur du wiki du site, c'est un moteur qui permet aux modérateurs d'intervenir sur descriptif, licence, fonctionnement et presque tout type de page du site à 
contenu non dynamiquement généré

Finalement on passe à un quasi-vrai wiki avec historique (approximatif) que pour modérateurs
*****************************************************/
require_once ("mise_en_forme_texte.php");

    $page=$controlleur->url_decoupee[1];
// On est bien avec un moderateur, on peut autoriser, si demande, modification et suppression
if (($_SESSION ['niveau_moderation'] >= 1) ) 
{
	if (isset($_POST ['modification']))
		ecrire_contenu ($page, $_POST ['texte']);
	if ($_GET ['supprimer'] == 1)
		supprimer_page($page);
}

if ($page == '')
	$page = 'index';

// Conteneur standard de l'entête et pied de page
$contenu_brut =  wiki_page_brut ($page);

$vue->titre = $page;
$vue->nom_page= $page;
// La page n'existe pas (ou pas encore !)
if ($contenu_brut->erreur and $_GET['form_modifier']!=1)
{
    $vue->http_status_code = 404;
    $vue->type = 'page_simple';
    $vue->titre=$contenu_brut->message;
    if ($_SESSION ['niveau_moderation'] >= 1)
    {
        $vue->contenu="Toutefois, vous pouvez la créér si besoin car vous êtes modérateur en : ";
        $vue->lien=lien_wiki($page)."?form_modifier=1";
        $vue->titre_lien="Cliquant ici";
    }
} // Un modérateur a demandé à la modifier
elseif($_GET['form_modifier']==1 and $_SESSION ['niveau_moderation'] >= 1)
{
    $vue->type="wiki_modification";
    $vue->contenu_a_modifier=protege($contenu_brut->contenu);
    $vue->lien_validation=lien_wiki($page);
    $vue->lien_bbcode=lien_wiki('syntaxe_bbcode');
}
else // affichage de la page
{
    if ($_SESSION ['niveau_moderation'] >= 1)
        $vue->montrer_lien_admin=True;

	$vue->date=date("d/m/Y",$contenu_brut->ts_unix_page);
    $vue->contenu_html  = wiki_page_html($page);
}
?>
