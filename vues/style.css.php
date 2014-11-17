<?php
/***********************************************************************************************
La seule est unique feuille de style CSS du site refuges.info

Pourquoi une feuille de style en .php ?
- le but c'est de faire un style dynamique selon la période de l'année pour changer les couleurs ;-) 
ouais je sais, c'est franchement de la frime -- sly

Sommaire:
    -1 Mise en page generale (types HTML, liens, infobulles)
    -2 menus du haut et du bas
    -3 classes speciales (sur-mesure, googmaps, fiche, ...)
    -4 PUB
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
 /*
  background-image:url(../images/<?=$periode?>.gif);
  background-repeat:no-repeat;
  background-position: 60% top;
 */
  }
/* zone de contenu */
.contenu {
  margin: 0.8%;
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
  background-color: #<?=$couleur_decoration_titres?>;
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
h6 { /* utilisé dans la "FAQ" comme question */
  margin-bottom: 0px;
  margin-top: 1em;
  font-size: 12px;
  font-weight: bold ;
  font-size: medium; /* sinon H6 cest tout petit ... */
  }
p {
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
  /* Utilisé pour le formulaire de création ou modification pour les 3 champs libres proprio, accès, remarques */

FORM#form_point FIELDSET {
  border: thin solid transparent;  /* pour les allergiques aux barrieres ;) */
  }
FORM#form_point.lien_syntaxe { 
  float:left;
  width:150px;
  }
FORM#form_point .booleen {
  clear: left;
  float:left;
  width: 700px; 
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
  /*width: 400px;*/
  padding-left: 10px;
  }
FORM#form_point TEXTAREA {
  clear: both;
  float: left;
  width:650px;
  height:170px;
  }
FORM#form_point LABEL.textarea  SPAN {
  clear: both;
  float:left;
  }

FORM#form_export LABEL {
  clear: none;
  float: left;
  width: 16em;
  }
#form_export FIELDSET FIELDSET:hover {  /* deco sur le fieldset actif, pour bien le differencier des autres */
  border: thin dotted black;
  }

FORM.wri SPAN , FORM.wri LABEL { /* sans la classe WRI, ca fait foirer le forum PHPBB , et oui */
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

/*==========DIVERS=======*/
IMG { /* images sans bordures */
  border: 0px;
  margin: 0px;
  padding: 0px;
  }

TEXTAREA {
  max-width: 100%;
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

A,a.mainmenu,a.nav,a.forumlink,a.cattitle,a.topictitle,a.postlink,a.gen,a.genmed,a.gensmall {
  color : #<?=$couleur_lien?>; /* en accord avec le thème du forum, et moins agressif */
  text-decoration: none;
  }
  
A:visited {
  color : #<?=$couleur_lien_visite?>;
  }

/*=========ADRESSES MAILS CODEES==========*/
.mail {
  unicode-bidi: bidi-override;
  direction: rtl;
  cursor: pointer;
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
/*  ENTETE DE PAGE : Logo, identification & recherche               */
/*==================================================================*/
#entete {
	position: relative;
	z-index: 40000;
}
#entete > DIV { /* Définit le bloc à positionner à droite */
	float: right;
	margin: 2px 5%;
}
#entete A, #entete SPAN {
	font-size: 18px;
	font-weight: bold;
	float: right;
}
#entete > A, #entete A:first-child {
    color: #<?=$couleur_lien_visite?>;
	float: none;
}
#entete FORM {
	display: block;
}
#entete INPUT:first-child {
    border: solid 1px #<?=$couleur_decoration_titres?>;
	height: 18px;
	position: relative; top: -3px;
}
#entete A:hover {
    color: white;
    background-color: #<?=$couleur_decoration_titres?>;
    text-decoration: none;
}
#entete > A:hover {
    background-color: #<?=$couleur_fond?>;
}

/*==================================================================*/
/*  MENUS                                                           */
/*==================================================================*/

/* ========== MENU DÉROULANT FIXE EN HAUT DE PAGE ========== */

/* Permet de gérer 2 menus identiques: */

/* 1/ Paramétrage du menu permanent en haut de page */
  #menu-normal  {
    z-index: 20000; /* Pour être au dessus du menu surgissant */
    position: relative; /* Pour que z-index s'applique */
    width: 100%;
  }
  #menu-normal > UL {
    border-top: solid 2px #<?=$couleur_decoration_titres?>;
  }

/* 2/ Paramétrage du menu surgissant et fixe en haut de fenetre */
  #menu-scroll {
    z-index: 10000; /* Au dessus du reste de la page mais en dessous du haut */
    position: fixed; top: 0;
    height: 22px; /* Réserve un espace où rien n'est affiché mais qui est sensible à la souris */
    width: 100%;
  }
  #menu-scroll:hover {
    z-index: 30000;
  }
  #menu-scroll > UL {
    display: none;
  }
  #menu-scroll:hover > UL {
    display: block;
  }

/* Paramétrage commun aux deux menus */
  .menu UL {
    clear: left;
    white-space: nowrap;
    display: block;
    font-size: 18px;
    font-weight: 700;
    text-align: left;
    margin: 0px;
    padding: 0px;
    background-color: #<?=$couleur_fond?>;
    height: 20px;
  }
  .menu UL {
    border-bottom: solid 2px #<?=$couleur_decoration_titres?>;
  }
  .menu UL LI {
    float: left; /* Distribue le premier niveau de menu de façon horizontale tout en permettant d'inclure des UL de type block */
    text-align: center;
    color: #<?=$couleur_lien?>;
    background-color: #<?=$couleur_fond?>;
    border-bottom: solid 2px #<?=$couleur_decoration_titres?>;
    height: 20px;
  }
  .menu UL LI UL {
    position: relative; top: -500px; /* On le cache loin mais on ne fait pas display:none pour avoir la largeur max une fois montré */
    left: 0;
      height: 0;
    padding: 0;
  }
  .menu UL LI:hover UL {
    top: 0; /* Montre le sous menu */
  }
  .menu UL LI UL LI {
    float: none;
    text-align: left;
    font-size: 16px;
    background-color: #<?=$couleur_fond?>;
    border-left: solid 2px #<?=$couleur_decoration_titres?>;
    border-right: solid 2px #<?=$couleur_decoration_titres?>;
    padding: 0;
    margin: 0;
  }
  .menu UL LI UL LI:first-child {
    border-top: solid 0px #<?=$couleur_decoration_titres?>;
  }
  .menu UL LI UL {
    border-bottom: solid 2px #<?=$couleur_decoration_titres?>;
  }
  .menu UL A {
    padding: 0em 0.5em;
    text-decoration: none;
  }
  .menu UL LI UL LI A {
    padding: 0;
  }
  .menu UL LI UL LI:hover,
  .menu UL A:hover {
    background-color: #<?=$couleur_decoration_titres?>;
    color: white;
    text-decoration: none;
  }
  .menu UL INPUT {
    position: relative;
    top: -3px;
    margin: 0 -18px 0 -2px;
    border-left: 1px solid #<?=$couleur_fond?>;
    border-right: 1px solid #<?=$couleur_fond?>;
    border-top: 0;
    border-bottom: 0;
    background-color: #<?=$couleur_fond?>;
    background-image: url(../images/loupe.png);
    background-position: center center;
    background-repeat: no-repeat;
  }
  .menu UL INPUT:hover {
    border: 1px solid #<?=$couleur_decoration_titres?>;
    background-color: white;
    background-image: none;
  }
  #fin-entete {
    clear: both;
  }

/* ==========MENU DU BAS ==========        */
/* en bas, il y a un gros div "basdepage" qui englobe la fin */
  #basdepage {
    clear: both;
    padding-top: 15px;
    text-align: center;
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
    margin: 20px;
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
  }
  .text_sur_image {
    position:relative;
    font-size:18px;
    color:white;
    left:-110px;
    top:2px;
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
  #carte_nav {
    height: 80%;
/*    margin-left: 210px;*/
  }
  #accueil {
    width:  300px;
    height: 320px;
  }
  #massifs {
    width:  800px;
    height: 600px;
  }
  #vignette { /* utilisé par les petites des fiches points */
    width:  280px;
    height: 280px;
  }
  #carte_edit, .carte_edit {
    width:  450px; 
    height: 500px; 
    float: right;
    max-width: 100%;
  }
  /*Externalise le sélecteur de couche de la carte nav*/
  #carte_nav .baseLbl, #carte_nav .dataLbl , #carte_nav .dataLayersDiv,
  #switch_nav .baseLbl, #switch_nav .baseLayersDiv, #switch_nav .dataLbl {
	display: none;
  }
