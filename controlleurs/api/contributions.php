<?php

/********************************************
 * Ici on traite l'URL de l'api
 * exemple pour le test :
 * http://leo.refuges.info/api/bbox?bbox=world : Tout
 * http://leo.refuges.info/api/bbox?bbox=5.5,45.1,6.5,45.6 : Un bout d'alpes
********************************************/
include_once("nouvelle.php");
include_once("mise_en_forme_texte.php");

/****************************************/
// Ça permet de mettre convertir tout un objet
function updatebbcode2html(&$html, $key) {
    if (!($html === FALSE OR $html === TRUE OR $html === NULL) && $key != 'lien')
        $html=bbcode2html($html,0,1,0); 
}
function updatebbcode2markdown(&$html, $key) {
    if (!($html === FALSE OR $html === TRUE OR $html === NULL) && $key != 'lien')
        $html=bbcode2markdown($html);
}
function updatebbcode2txt(&$html, $key) {
    if (!($html === FALSE OR $html === TRUE OR $html === NULL) && $key != 'lien')
            $html=bbcode2txt($html);
}
function updatebool2char(&$html) { if($html===FALSE) { $html='0'; } elseif($html===TRUE) { $html='1'; } }
/****************************************/

// Dans un premier temps on met en place l'objet contenant la requête
$req = new stdClass();
$req->page = $cible; // Ici on récupère la page (point, bbox, massif, contribution...)
$req->type = $_REQUEST['type'];
$req->format = $_REQUEST['format'];
$req->format_texte = $_REQUEST['format_texte'];
$req->nombre = $_REQUEST['nombre'];
$req->massif = $_REQUEST['massif'];

// Ici c'est les valeurs possibles
$val = new stdClass();
$val->format = array("json", "csv", "xml", "rss");
$val->format_texte = array("bbcode", "texte", "markdown", "html");
$val->type = array("commentaires", "points", "refuges", "forums");


/****************************** VALEURS PAR DÉFAUT - PARAMS FACULTATIFS ******************************/


// On teste chaque champ pour voir si la valeur est correcte, sinon valeur par défaut
if(!in_array($req->format,$val->format))
    $req->format = "json";
if(!in_array($req->format_texte,$val->format_texte))
    $req->format_texte = "bbcode";
// On vérifie que les types sont ok
$temp = explode(",", $req->type);
foreach ($temp as $type) {
    if(!in_array($type,$val->type)) { $req->type = "points,commentaires"; break; }
}
// On vérifie que le nom est correct, ou pas trop élevé
if(!is_numeric($req->nombre))
	$req->nombre = 15;
elseif ($req->nombre > 100)
	$req->nombre = 100;
// On vérifie que la liste de massif est correcte
$temp = explode(",", $req->massif);
foreach ($temp as $massif) {
    if(!is_numeric($massif)) { $req->massif = ""; }
}

/****************************** REQUÊTE RÉCUPÉRATION NOUVELLES ******************************/

$news = nouvelles($req->nombre,$req->type,$req->massif,False);
$news = texte_nouvelles($news); // On ajoute le texte
foreach ($news as $id => $nouvelle)
{
	$news[$id]['date_formatee']=date("d/m/y", $nouvelle['date']);
}

/****************************** FORMATAGE DU TEXTE ******************************/

// On transforme le texte dans la correcte syntaxe
if($req->format_texte == "texte") {
    array_walk_recursive($news, 'updatebbcode2txt');
}
elseif($req->format_texte == "html") {
    array_walk_recursive($news, 'updatebbcode2html');
}
elseif($req->format_texte == "markdown") {
    array_walk_recursive($news, 'updatebbcode2markdown');
}
array_walk_recursive($news, 'updatebool2char'); // Remplace les False et True en 0 ou 1


/****************************** FORMAT VUE ******************************/

switch ($req->format) {
    case 'json':
        include($config_wri['chemin_vues'].'api/contributions.vue.json');
        break;
    case 'xml':
        include($config_wri['chemin_vues'].'api/contributions.vue.xml');
        break;
    case 'csv':
        include($config_wri['chemin_vues'].'api/contributions.vue.csv');
        break;
    case 'rss':
        include($config_wri['chemin_vues'].'api/contributions.vue.rss');
        break;
    default:
        include($config_wri['chemin_vues'].'api/contributions.vue.json');
        break;
}

?>
