<?php
/*****************************************************
Controlleur du wiki du site, c'est un moteur qui permet aux modérateurs d'intervenir sur descriptif, licence, fonctionnement
et presque tout type de page du site à contenu non dynamiquement généré

Finalement on passe à un quasi-vrai wiki avec historique (approximatif) que pour modérateurs
*****************************************************/
require_once ("mise_en_forme_texte.php");
require_once ("wiki.php");


// Si aucune page n'est précisée dans l'url on suppose que l'on souhaite la page par défaut stockée '' dans la base
$page = $controlleur->url_decoupee[1] ?? '';
$page=urldecode($page);
// On est bien avec un moderateur, on peut autoriser, si demande, modification et suppression
if (est_moderateur())
{
  if (!empty($_REQUEST ['modification']))
    ecrire_contenu ($page, $_REQUEST ['texte']);
  if (!empty($_REQUEST ['supprimer']))
    supprimer_page($page);
}

// Conteneur standard de l'entête et pied de page
$contenu_brut =  wiki_page_brut ($page);

$vue->titre = $page;
$vue->nom_page= $page;
// La page n'existe pas (ou pas encore !)
if (!empty ($contenu_brut->erreur) and $contenu_brut->erreur and empty($_REQUEST['form_modifier']))
{
  $vue->http_status_code = 404;
  $vue->type = 'page_simple';
  $vue->titre=$contenu_brut->message;
  if (est_moderateur())
  {
    $vue->contenu="Toutefois, vous pouvez la créér si besoin car vous êtes modérateur en : ";
    $vue->lien=lien_wiki($page)."?form_modifier=1";
    $vue->titre_lien="Cliquant ici";
  }
}
// Un modérateur a demandé à la modifier
elseif(!empty($_REQUEST['form_modifier']) and est_moderateur())
{
  $vue->type="wiki_modification";
  $vue->contenu_a_modifier=protege($contenu_brut->contenu??'');
  $vue->lien_validation=lien_wiki($page);
  $vue->lien_bbcode=lien_wiki('syntaxe_bbcode');
}
else // affichage de la page
{
  if (est_moderateur())
    $vue->montrer_lien_admin=True;

  $vue->date=date("d/m/Y",$contenu_brut->ts_unix_page);
    $vue->contenu_html  = wiki_page_html($page);
}
