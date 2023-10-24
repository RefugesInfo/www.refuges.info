<?php
/***********************************************************************************************
La seule et unique feuille de style CSS du site refuges.info

Pourquoi une feuille de style en .php ?
- le but c'est de faire un style dynamique selon la saison pour changer les couleurs ;-)
ouais je sais, c'est franchement de la frime et ça sert à rien, mais si on ne peut plus s'amuser sur une projet
bénévole ! -- sly

Sommaire:
    -1 Mise en page generale (types HTML, liens, infobulles)
    -2 menus du haut et du bas
    -3 classes speciales (sur-mesure, googmaps, fiche, ...)
    -4 PUB

Notes de sly en 2023: ce style a évolué au fil des années et je suis sûr qu'il y a plusieurs classes 
qui ne servent nulle part, pas mal de redondance, un manque de cohérence sur le style au niveau des formulaires.
Un support parfois médiocre des petites écrans, des adressages par id, par class. Bref, ça mériterait vraiment un coup de neuf.
Celui qui a le courage à bien sûr mon feu vert !
***********************************************************************************************/

header('content-type: text/css');
//Évitons que soit rechargée cette page à chaque coup, elle ne bouge pas beaucoup
header('Cache-Control: max-age=86000');


//Génération dynamique de certaines couleurs selon la saison
$mois=date("n");
if ($mois>9 and $mois<12)
  $periode="automne";
elseif ($mois>=4 and $mois<=6)
  $periode="printemps";
elseif ($mois>=7 and $mois<=9)
  $periode="été";
else
  $periode="hiver"; // notre thème par défaut

switch ($periode)
{
  case "hiver":
    $couleur_fond="f2f2f2";
    $couleur_lien="006699";
    $couleur_lien_visite="006699";
    $couleur_decoration_titres="A6CEE7";
    $couleur_legende="EEF";
    break;
  case "printemps":case "été":
    $couleur_fond="f5fde8";
    $couleur_lien="5f8c11";
    $couleur_lien_visite="5f8c11";
    $couleur_decoration_titres="77dc63";
    $couleur_legende="d1f0d0";
    break;
  case "automne":
    $couleur_fond="f6e8c2";
    $couleur_lien="cf5d32";
    $couleur_lien_visite=$couleur_lien;
    $couleur_decoration_titres="bd742c";
    $couleur_legende="c1ac96";
    break;
}

?>

/*==================================================================*/
/* Modification du style du nouveau forum PhpBB3-prosilver          */
/*==================================================================*/
/* Pas de ligne vide en haut */
#phpbb {
	padding: 0;
}
/* Forum de la largeur de la page */
#phpbb .wrap {
	max-width: 100%;
}

/* Titre des forums de refuges */
#phpbb .section-viewtopic .topic-title a:first-child {
	color: black !important;
}
#phpbb .wri-link {
	font-size: 70%;
}
/* Zones masquées */
#phpbb .headerbar,
#phpbb .navbar .avatar,
/* Personnalisation des couleurs */
#phpbb .navbar,
#phpbb #basdepage {
  background-color: #<?=$couleur_fond?>;
}
#phpbb .headerbar, .forumbg,
#phpbb .headerbar, .forabg,
#phpbb h3 {
	background-color: #<?=$couleur_lien?>;
	background-image: none;
}
#phpbb .panel h3,
#phpbb .alert_text h3,
#phpbb .stat-block h3,
#phpbb .stat-block h3 a,
#phpbb .headerspace h3,
#phpbb .headerspace h3 a,
#phpbb .postbody h3,
#phpbb .postbody h3 a,
#phpbb #postform .review,
#phpbb #postform .review a {
	color: white;
}
#phpbb .stat-block strong a {
	color: #a00;
}
#phpbb .bg1,
#phpbb .bg2,
#phpbb .bg3,
#phpbb .forabg .forums,
#phpbb .forumbg .topics > li {
	background-color: #<?=$couleur_fond?>;
	background-image: none;
}
#phpbb dl a.row-item-link:hover {
	background-color: transparent !important;
}
/* Masquage login rapide en bas de page */
#page-body > form > h3,
.quick-login {
	display: none;
}
.section-posting #attach-panel-multi::after {
	content: "Attendre la fin du chargement des fichiers pour enregistrer le sujet.";
	background: yellow;
}
.text-strong {
	color: initial;
}

/*==================================================================*/
/* MISE EN PAGE GENERALE DES TYPES                                  */
/*==================================================================*/
/*=====GENERAL=======*/

HTML {
  width: 100%; /* jmb 01/2008 , pour gmaps */
  height: 100%;
}
BODY {
  margin: 0px; /* il le faut pour FF */
  width: 100%; /* jmb 01/2008 , pour gmaps */
  height: 100%;
  background-color: #<?=$couleur_fond?>;
}
/* zone de contenu */
.contenu {
  margin: 0.5%;
  margin-top:3px;
}
.couleur_fond_amplifiee {
    background-color: #cef99c;
}

/*=====TEXTE=======*/
EM { /* Emphasis: gras+italic */
  font-weight: bold ;
  font-style: italic ;
}
STRONG { /* Strong Emphasis: gras+italic+rouge */
  font-weight: bold;
  font-style: italic;
  color: #FF0000 ;
}
CITE { /* Citation: gras+droit */
  font-weight: bold ;
  font-style: normal ;
}
DFN { /*Definitions */
  border-bottom: thin dotted blue;
  font-style: normal;
}
DFN:after { /*Definition, ajoute un ? a la fin pour inciter a passer la souris dessus*/
  content: "?";
  font-size: smaller;
  vertical-align: text-top;
}
BLOCKQUOTE { /* citations: utilisé sur les fiches pour les commentaires ET la citation forum */
  font-style: italic;
}
BLOCKQUOTE > DIV { /* en particulier les ciations forum */
  border-left: double blue;
}
BLOCKQUOTE P:before  { /* message forum et commentaires *//* HS sous IE */
  content: open-quote;
  font-size: xx-large;
}
BLOCKQUOTE P:after  { /* message forum et commentaires */
  content: close-quote;
  font-size: xx-large;
  vertical-align: text-top; /* pour pas que cette derniere quote decale la derniere ligne */
}

/*======TITRES=======*/
/* on commence au H3 car 1,2 sont vraiment trop gros. je sais ... CSS .... mais maintenant c'est fait.*/
H3 { /* titres de pages */
  font-weight: bold ;
  font-style: normal ;
  font-size: large;
  padding: 0em 2em ;
  margin: 0em;
  text-align: center;
  margin-bottom:3px;
  color: white;
  background-color: #<?=$couleur_lien?>;
}
H4 { /* sous titres */
  padding-top: 4px; /* sous FF, la padding par defo est immense */
  padding-bottom: 2px;
  padding-left: 10px;
  font-size: large;
  margin: 0px; /* sous FF, la padding par defo est immense */
  border-bottom: 2px solid #<?=$couleur_decoration_titres?>;
  border-left: 2px solid #<?=$couleur_decoration_titres?>;
}
H5 { /* sou-sou titre, pour l'instant que dans les fiches de refuges */
  border-bottom: thin solid #<?=$couleur_decoration_titres?> ;
  font-size: medium; /* sinon H5 cest tout petit ... */
  margin-top:15px;
  margin-bottom:3px;
  padding-left: 10px;
}
H6 { /* utilisé dans la "FAQ" comme question */
  margin-bottom: 0px;
  margin-top: 1em;
  font-size: 12px;
  font-weight: bold ;
  font-size: medium; /* sinon H6, c'est tout petit ... */
}
P {
  margin-bottom: 1em;
}
/*===== LISTES=====*/
UL { /* les listes , y compris news en page de garde */
  list-style-type: none;
  margin: 0px;
  padding: 0px 0px 0px 5px;
}
DT { /* listes, de definitions */
  font-weight: bold;
  margin-top:4px;
}
DL > DL { /* decale les elements imbriques de 1em */
  padding-left: 1em;
}
DT > BUTTON {
  font-size: 60%;
  padding: 0px ;
}
LI {
  margin-bottom:3px;
}

/*====== FORMULAIRES======*/
/* 
  Utilisé pour le formulaire de création ou modification ainsi que l'ajout de commentaires. 
  J'aimerais pouvoir rendre un peu plus cohérent (factoriser) les style de la plupart des formulaires du site (zone modérateur, modif fiche, ajout commentaires) 
  mais ça demande un peu de tests.
*/

FORM#form_point FIELDSET {
  border: thin solid transparent;  /* pour les allergiques aux barrieres ;) */
  padding: 0.75em 0;
}
FORM#form_point .textarea {
  width: 100%;
  min-width: 150px;
  max-width: 1000px;
  min-height: 10em;
}
FORM#form_point .textarea LABEL,
FORM#form_point .textarea TEXTAREA {
  width: 100%;
}
FORM#form_point .booleen {
  clear: left;
  float:left;
  width: 700px;
  min-width: 450px;
  max-width: calc(100% - 4px);
  text-align: right;
  padding: 1px;
}
FORM#form_point .booleen LEGEND {
  clear: left;
  float:left;
}
FORM#form_point .booleen LABEL {
  clear: none;
  float: none;
  padding-left: 5px;
}
FORM#form_export LABEL {
  clear: none;
  float: left;
  width: 16em;
}
#form_export FIELDSET FIELDSET:hover {  /* deco sur le fieldset actif, pour bien le differencier des autres */
  border: thin dotted black;
}
FORM.wri LABEL { /* sans la classe WRI, ca fait foirer le forum PHPBB , et oui */
  clear: left;
  float: left;
}
FORM LABEL[title]:after, FORM LEGEND[title]:after {  /* combine pour exclure OL , leurs LABEL ne sont pas dans des FORM */
  content: url(../images/tooltip.png);
}
FIELDSET FIELDSET {  /* moins de déco pour les fieldset imbriques */
  float: left;
  border: thin solid transparent;
}
FORM .champs_null_masque>INPUT { /* couleur de la case "champ null" et masquee par defo */
  outline : red solid 2px ;
  float: left;
  display: none;
}
FORM .champs_null_masque > INPUT:checked  + *  INPUT { /* desactive les INPUT qui suivent */
  visibility: hidden;
}
FORM .champs_null_masque > LABEL { /* permet a la case de s'intercaler au bon endroit */
  clear: none;
}
.input_en_ligne {
  width:18em;
}
.input_captcha_court {
  width:3em;
}
.textarea_large {
  width: 99%;
  min-width: 150px;
  max-width: 1000px;
  min-height: 10em;
}

.fauxfieldset-legend {
  background-color: #<?=$couleur_legende?> ;
  border: thin solid black ;
  font-weight: bold;
}
/* Cas particulier pour OL qui a des labels non standards */
DIV#switch_nav LABEL {
  float: none;
  clear: none;
}
input[type=checkbox]:hover, input[type=radio]:hover{
    box-shadow: 0px 0px 10px #1300ff;
}

/*==========DIVERS=======*/
IMG { /* images sans bordures */
  border: 0px;
  margin: 0px;
  padding: 0px;
}

/*=========LIENS==========*/
A:hover { /*met en valeur les liens qd on est dessus */
  background-color: #<?=$couleur_legende?>;
  text-decoration: none;
}
/*
J'intègre également les class des liens du forum
en gros je veux tout de la même couleur
*/

A,A.mainmenu,A.nav,A.forumlink,A.cattitle,A.topictitle,A.postlink,A.gen,A.genmed,A.gensmall {
  color : #<?=$couleur_lien?>; /* en accord avec le thème du forum, et moins agressif */
  text-decoration: none;
}

A:visited {
  color : #<?=$couleur_lien_visite?>;
}

/*=========ERREUR==========*/
.erreur_saisie {
	border: 2px double red;
	background-color: yellow;
	padding: 10px;
}

/*=========INFOBULLES===========*/
A.infobulle {
  position:relative;
  text-decoration: none;
  color: black;
}
A.infobulle SPAN { /* au repos, on efface */
  display: none;
}
A.infobulle:hover SPAN { /* qd on passe dessus, ca affiche */
  display: block;
  position: absolute; /* relativement au relatif du A */
  top: 18px;
  left: -10px;
  padding: 5px;
  color: #000;
  border: 1px solid #bbb;
  background: #ffc;
  white-space: nowrap;
  z-index: 100; /* ?? */
}

/*=========LIENS==========*/
.don {
  text-decoration: underline;
  margin-left: 450px;
  position: relative; top: 15px;
}

/*=========WIKIS SURGISSANTS==========*/
.wiki {
	border: 5px solid #<?=$couleur_decoration_titres?>;
	background-color: #f8fff4;
    z-index: 500000;
}
/*==================================================================*/
/*  ENTETE DE PAGE : Logo, menus, identification                    */
/*==================================================================*/
.bandeau-haut * {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 18px;
}
.menu-bouton * {
	font-family: Times New Roman;
}
.menu-haut FORM LI {
	margin: 5px 2px 10px 2px;
}

/* Fenêtres larges */
@media screen and (min-width: 450px) {
	/* Le bandeau */
	.bandeau-haut {
		background-image: url(../images/bandeau-haut/titrehorizontal_<?=date('m')?>.png);
		background-repeat: no-repeat;
	}
	.logo-haut {
		display: block;
		position: absolute;
		width: calc(100% - 225px);
		height: 50px;
	}
	.logo-haut:hover {
		background: transparent;
	}
	.recherche-haut {
		float: right;
		padding: 11px 0;
		font-size: 16px;
	}
	.recherche-haut INPUT {
		font-size: 16px;
	}
	.menu-haut {
		clear: both;
	}

	/* Ligne de menus */
	.menu-liste > UL {
		display: flex;
		justify-content: space-between;
		padding: 0;
	}
	.menu-liste > SPAN,
	.menu-titre {
		display: none;
	}
	.menu-connexion {
		float: right;
	}
	.menu-connexion UL {
		right: 0;
		border-radius: 10px 0 10px 10px !important;
	}
	.menu-connexion SPAN SPAN {
		vertical-align:super;
		font-size: 12px;
	}

	/* Boutons */
	.menu-bouton:not(.menu-liste) {
		border: 2px solid transparent;
		border-radius: 10px;
		padding: 2px;
	}
	.menu-bouton:not(.menu-liste):hover {
		border-radius: 10px 10px 0 0;
	}
	.menu-touch,
	.menu-hover {
		border-color: #<?=$couleur_decoration_titres?> !important;
	}

	/* Blocs rétractables en dessous des boutons */
	.menu-bouton:not(.menu-liste) > P,
	.menu-bouton:not(.menu-liste) > UL {
		position: absolute;
		margin: 2px 0 0 -4px;
		border-radius: 0 10px 10px 10px;
		border: 2px solid #<?=$couleur_decoration_titres?>;
		background: #<?=$couleur_fond?>;
		padding: 0 4px;
		opacity: 0;
		z-index: -10;
	}
	.menu-touch:not(.menu-liste) > UL,
	.menu-hover:not(.menu-liste) > UL,
	.menu-hover:not(.menu-liste) > P,
	.menu-hover:not(.menu-liste) > A {
		opacity: 1;
		z-index: 1000;
	}

	/* Lignes des blocs rétractables */
	.menu-bouton:not(.menu-liste) LI {
		max-height: 0;
		transition: max-height 0.2s ease-in;
	}
	.menu-touch:not(.menu-liste) LI,
	.menu-hover:not(.menu-liste) LI {
		max-height: 2.2em;
	}
}

/* On met tout sur une même ligne pour les très grandes fenêtres */
@media screen and (min-width:1200px) {
	.menu-haut {
		clear: none;
		padding: 7.5px;
	}
	.logo-haut {
		position: initial;
		float: left;
		width: 25vw;
	}
	.menu-bouton:not(.menu-liste) {
		background: #<?=$couleur_fond?>;
	}
	.menu-connexion UL {
		right: initial;
		border-radius: 0 10px 10px 10px !important;
	}
	.recherche-haut {
		padding-left: 20px;
	}
}

/* On enlève les icones pour les fenêtres moyenes */
@media screen and (min-width:500px) and (max-width:650px) {
	.menu-bouton SPAN:first-child {
		display: none;
	}
}

/* On enlève le bandeau pour les fenêtres de faible hauteur */
@media screen and (max-height: 600px) and (min-width:500px) {
	.bandeau-haut {
		background-image: none;
	}
	.logo-haut,
	.recherche-haut,
	.menu-titre SPAN {
		display: none;
	}
}
@media screen and (max-height: 600px) and (min-width:500px) and (max-width:700px) {
	.menu-bouton SPAN {
		line-height: 1.5em;
	}
	.menu-bouton SPAN:first-child {
		display: none;
	}
}

/* Fenêtres étroites */
@media screen and (max-width: 449.9px) {
	.bandeau-haut * {
		font-size: 16px;
	}
	.logo-haut,
	.recherche-haut,
	.menu-haut .menu-large,
	.menu-bouton P,
	.headerbar,
	body:not(#phpbb) .menu-titre SPAN {
		display: none;
	}
	.menu-haut {
		display: flex;
		flex-direction: row-reverse;
		justify-content: space-between;
		margin-bottom: 5px;
		background: #<?=$couleur_lien?>;
	}

	/* Boutons */
	DIV.menu-bouton > SPAN,
	.menu-titre {
		display: block;
		padding: 0 8px 2px 8px;
		Wfont-size: 20px;
		font-weight: 700;
		color: white !important;
		cursor: pointer;
	}
	.menu-titre * {
		padding-top: 4px;
		font-size: 18px;
		color: white !important;
	}

	/* Blocs rétractables en dessous des boutons */
	.menu-liste > UL,
	.menu-connexion UL {
		position: absolute;
		border-radius: 0 0 10px 10px;
		border: 2px solid #<?=$couleur_decoration_titres?>;
		padding: 0 4px;
		background: #<?=$couleur_fond?>;
		white-space: nowrap;
		z-index: -10;
		opacity: 0;
	}
	.menu-connexion UL {
		right: 0;
	}
	.menu-liste > UL {
		padding-top: 3px;
	}
	.menu-liste.menu-touch > UL,
	.menu-liste.menu-hover > UL,
	.menu-connexion.menu-touch > UL,
	.menu-connexion.menu-hover > UL {
		opacity: 1;
		z-index: 1000;
	}

	/* Lignes des blocs rétractables */
	.menu-liste LI,
	.menu-connexion LI {
		max-height: 0;
		transition: max-height 0.2s ease-in;
	}
	.menu-liste.menu-touch LI,
	.menu-liste.menu-hover LI {
		max-height: initial;
	}
	.menu-liste.menu-touch UL UL LI,
	.menu-liste.menu-hover UL UL LI,
	.menu-connexion.menu-touch LI,
	.menu-connexion.menu-hover LI {
		padding: 1.5px 0;
		max-height: 1.2em;
	}
}
/* Fenêtres très étroites */
@media screen and (max-width: 300px) {
	.menu-titre SPAN {
		display: none;
	}
}

/* ==========MENU DU BAS ========== */

/* en bas, il y a un gros div "basdepage" qui englobe la fin */
  #basdepage {
    clear: both;
    padding-top: 15px;
    text-align: center;
    font-family: Times New Roman;
    font-size: 16px;
}
  /* c'est la liste en bas de page */
  #basdepage #racourcismenus {
    clear: both;
    border: dashed thin #096EA1;
    text-align: center;
    margin: 0px;
}
  #basdepage UL {
    clear: both;
    text-align: center;
}
  #basdepage LI {
    display: inline;
    margin-right: 2em;
}
  #basdepage IMG,IFRAME,FORM { /* tout le bazar de pub de bas de page, en ligne! */
    display: inline;
    vertical-align: middle;
}

/*==================================================================*/
  .lien_ajout_commentaire {
    text-align: center;
}
  .lien_ajout_commentaire A {
    border-style: solid;
    border-color: #<?=$couleur_decoration_titres?>;
    padding-right: 0.5em;
    padding-left: 0.5em;
}

/*==================================================================*/
/* LA PAGES DES MASSIFS (Accueil)                                   */
/*==================================================================*/

  .tablo { /* DIV imite une table */
    display:table-cell;
    min-width:400px; //En dessous de 400 pixels, c'est trop tassé/pas lisible, en mettant ça, on force un affichage en dessous de la carte de l'accueil
    vertical-align: top;
    float: left; /* pour IE7 */
}

/*==================================================================*/
/* LES PAGES POINTS                                                 */
/*==================================================================*/

  .fauxfieldset { /* DIV imite un fieldset */
    border: thin solid black;
    margin-top: 1em;
    /*padding: 1em;*/
}
  .fauxfieldset-legend  { /* P imite un fieldset legend */
    float: left;
    margin: -0.2em 1em 0em 1em;
    /*margin-bottom: 1em;*/
    /*vertical-align: super;*/
}
  .spacer { /* HR de spacer pour la mise en page, en particulier dans les fiches */
    clear: both;
    visibility: hidden;
    margin: 0px;
    padding: 0px;
}
  /* ENCADRE de présentation de FICHE */
  .fiche_cadre .condense, .fiche_cadre .condense DD, .fiche_cadre .condense DT {
    display: inline;
    margin: 1px 5px 1px 0px;
}
  .photos {
    float: left;
    margin: 1px;
    position: relative;
    max-width: 100%;
}
  .texte_sur_image {
    color: white;
    text-shadow: 2px 0 #555, -2px 0 #555, 0 2px #555, 0 -2px #555,
             1px 1px #555, -1px -1px #555, 1px -1px #555, -1px 1px #555;
    position: absolute		

;
    top: 10px;
    right: 10px;
}
  .point_forum blockquote {
    margin-block-start: 0;
}
  .point_forum blockquote * {
    margin-block-start: 0;
    margin-block-end: 0;
    margin-inline-start: 0;
    margin-inline-end: 0;
}
  .point_forum em {
    color: black !important;
}

/*==================================================================*/
/*                              CARTES                              */
/*==================================================================*/
.carte /* utilisé par TOUTES les images cartes */
 {
  background-image: url(../images/sablier.png);
  background-position: center center;
  background-repeat: no-repeat;
}

/* Carte de l'accueil */
#carte-accueil {
  width: 750px;
  height: 600px;
}
#carte-accueil .ol-switch-layer {
  display: none;
}
@media screen and (max-width: 750px) {
  #carte-accueil {
    width: calc(100vw - 6px);
    height: 90vw;
  }
}

/* Carte NAV présentation mobile verticale */
#carte-nav {
  width: 75%; /* Support of non CSS3 browsers (Safari on Windows)*/
  height: 75%;
  width: 100%;
  height: 96vw;
  max-height: calc(100% - 65px); /* Pour ne pas trop déborder en bas */
  margin: 0 0;
}
#selecteur-carte-edit {
  padding-left: 1px;
}
#selecteur-carte-edit P {
  margin-top: 0;
  margin-bottom: 5px;
}
#selecteur-carte-edit SPAN {
  font-size: .8em;
  font-style: oblique;
}
#selecteur-carte-edit INPUT,
#selecteur-carte-edit LABEL {
  text-align: justify;
  cursor: pointer;
}
/* Menu deplié */
@media screen and (min-width: 641px) and (min-device-height: 361px) {
  #carte-nav {
    max-height: calc(100% - 126px);
  }
}
/* Carte NAV présentation mobile horizontale */
@media screen and (min-aspect-ratio: 1/1) and (min-width: 365px) and (max-device-height: 360px) {
  #carte-nav {
    float: right;
    width: 67%;
    max-height: calc(100% - 75px);
}
  #selecteur-carte-edit {
    display: table-cell;
    width: 33%;
  }
}
/* Carte NAV présentation écrans */
@media screen and (min-width: 800px) {
  #carte-nav {
    float: right;
    width: 75vw;
    height: 75vw;
}
  #selecteur-carte-edit {
    display: table-cell;
    width: 33%;
    padding-left: 5px;
  }
}
.carte-nav-full {
  width: 98.4% !important;
  margin-right: 0.8% !important;
}

/* Carte de la page des points écrans */
#container-carte-point {
  float: right;
}
#carte-point {
  width: 50vw;
  height: 50vw;
  max-height: 75vh;
}
/* Carte de la page des points mobiles */
@media screen and (max-width: 640px) {
  #carte-point {
    width: calc(100vw - 10px);
    height: 400px;
    max-height: 100vw;
  }
}

/* Carte formulaire de modification de point */
#carte-modif {
  float: right;
  width: 99vw;
  height: 97vw;
  max-height: 450px;
}
/* Carte formulaire de modification de massif */
#carte-edit {
  float: right;
  width: 99vw;
  height: 97vw;
  max-height: 450px;
}
/* Carte formulaire de modification présentation écrans */
@media screen and (min-width: 800px) {
  #carte-modif {
    width: 450px;
    height: 450px;
  }
}
@media print {
  html {
    height: initial;
}
  .noprint {
    display:none;
  }
}
  #carte-nav {
    margin: 0;
}

#check-types {
	float: right;
	position: relative;
	right: -10px;
}
#check-types input {
	position: relative;
	top: 3px;
}

.bouton-supprimer {
	color: red;
	background-color: yellow;
	padding: 4px;
}

