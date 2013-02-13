<?php // Fonctions liées au mode d'emploi du site
// Accés aux données : entrées / sorties / modifications des textes
// fonction qui va chercher le texte du fichier correspondant à la page 

require_once ('config.php');
require_once ("fonctions_mise_en_forme_texte.php");

// Fonction pour réaliser un lien vers une page du mode d'emploi 
function lien_mode_emploi($page="index")
{
	return "/statique/mode_emploi.php?page=".strtolower($page);
}


function recupere_contenu($page)
{
	global $config;
	// lieu du fichier texte correspondant à la page souhaitée
	$fichier=$config['textes_mode_emploi'].$page.".txt";
	if (!is_file($fichier))
		return FALSE;
	$pointeur=fopen($fichier,"r");
	if (filesize($fichier))
		$contenu=fread($pointeur,filesize($fichier));
	return $contenu;
}

// fonction qui va ré-écrire le contenu de la page
function ecrire_contenu($page,$contenu)
{
	global $config;
	// lieu du fichier texte correspondant à la page souhaitée
	$fichier=$config['textes_mode_emploi'].$page.".txt";
	$pointeur=fopen($fichier,"w");
	fwrite($pointeur,$contenu);
}

function supprimer_page($page)
{
        global $config;
        // lieu du fichier texte correspondant ` la page souhaitie
        $fichier=$config['textes_mode_emploi'].$page.".txt";                           
        @unlink($fichier);
}

// recréer les liens internes au mode d'emploi au format [url=##page][/url] (page étant la page texte à afficher)
// traite le phpBB code mais en autorisant le HTML (paramètre TRUE)
function genere_contenu($page)
{
	if( ($contenu=recupere_contenu($page))==FALSE)
		return FALSE;
	// gestion des liens internes au format [url=##page]c'est là que ça se passe[/url]
	$contenu=str_replace("##","./mode_emploi.php?page=",$contenu);
	// conversion bbcode
	$html=bbcode2html($contenu,TRUE);
	return trim($html);
}
function date_modif_contenu($page)
{
	global $config;
	return filemtime($config['textes_mode_emploi'].$page.".txt");
}
?>
