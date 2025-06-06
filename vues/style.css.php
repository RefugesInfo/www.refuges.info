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
Notes de sly sur l'année 2024: j'ai fais mal de ménage, ré-indenté tout ça, bref, ça va mieux, mais c'est pas fini !
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

#phpbb .headerbar,
.forumbg,
#phpbb .headerbar,
.forabg,
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
#phpbb .forumbg .topics>li {
  background-color: #<?=$couleur_fond?>;
  background-image: none;
}

#phpbb dl a.row-item-link:hover {
  background-color: transparent !important;
}

/* Masquage lien vers la page contact qui fait doublon avec le bandeau WRI du bas */
#nav-footer li:last-child,
/* Masquage login rapide en bas de page */
#page-body>form>h3,
.quick-login {
  display: none;
}
/* Masquage du lien "Nous Contacter" qui fait croire à un contact avec les refuges */
ul#nav-main > li > a[href*="contactadmin"] {
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
/* Mise en page générales des types                                 */
/*==================================================================*/
/*===== Général =======*/

html {
  width: 100%;
  height: 100%;
}

body {
  margin: 0px;
  width: 100%;
  height: 100%;
  background-color: #<?=$couleur_fond?>;
}

/* zone de contenu */
.contenu {
  margin: 0.5%;
  margin-top: 3px;
}

.couleur_fond_amplifiee {
  background-color: #cef99c;
}

/*=====TEXTE=======*/
strong {
  /* Strong Emphasis: gras+rouge */
  font-weight: bold;
  color: #FF0000;
}

cite {
  /* Citation: gras+droit */
  font-weight: bold;
  font-style: normal;
}

blockquote>div {
  /* en particulier les citations forum */
  border-left: 2px;
}

blockquote {
  /* message forum et commentaires */
  margin: 1em;
  font-size: normal;
}

blockquote p:before {
  /* message forum et commentaires */
  content: open-quote;
  font-size: xx-large;
}

blockquote p:after {
  /* message forum et commentaires */
  content: close-quote;
  font-size: xx-large;
  vertical-align: text-top;
  /* pour pas que cette derniere quote decale la derniere ligne */
}

/*====== Titres =======*/

/* Au 15/10/2024 le titre h1 n'est utilisé qu'une seule et unique fois dans tous le site, c'est sur les fiches, pour le nom du point */
h1 {
  /* Ce titre principal n'est pas plus gros ou gras que les autres, mais significativement, c'est le titre le plus important de la page */
  font-weight: bold;
  font-style: normal;
  font-size: large;
  margin-bottom: 3px;
}

/* h2 ? faut pas chercher à comprendre, on n'utilise le h2 à aucun endroit ! Si je n'avais que ça à faire, il faudrait tout décaller h5->h4->h3->h2 dans toutes les vues, et le wiki ! */

/* à noter que h3 h4 et h5 sont également très utilisés dans le wiki, dont le contenu est dans la base */
h3 {
  /* titres de pages */
  font-weight: bold;
  font-style: normal;
  font-size: large;
  padding: 0em 2em;
  margin: 0em;
  text-align: center;
  margin-bottom: 3px;
  color: white;
  background-color: #<?=$couleur_lien?>;
}

h4 {
  /* sous titres */
  padding-top: 4px;
  /* sous FF, la padding par defo est immense */
  padding-bottom: 2px;
  padding-left: 10px;
  font-size: large;
  margin: 0px;
  /* sous FF, la padding par defo est immense */
  border-bottom: 2px solid #<?=$couleur_decoration_titres?>;
  border-left: 2px solid #<?=$couleur_decoration_titres?>;
}

h5 {
  /* sou-sou titre, pour l'instant que dans les fiches de refuges */
  border-bottom: thin solid #<?=$couleur_decoration_titres?> ;
  font-size: medium;
  /* sinon H5 cest tout petit ... */
  margin-top: 15px;
  margin-bottom: 3px;
  padding-left: 10px;
}

p {
  margin-bottom: 1em;
}

/*===== Listes =====*/
ul {
  /* les listes , y compris news en page de garde */
  list-style-type: none;
  margin: 0px;
  padding: 0px 0px 0px 0px;
}

dt {
  /* listes, de definitions */
  font-weight: bold;
  margin-top: 4px;
}

.liste-wri>dd {
  /* listes, de definitions */
  margin-left: 1em;
}

dt>button {
  font-size: 60%;
  padding: 0px;
}

li {
  margin-bottom: 3px;
}

/*====== Formulaires======*/
/* 
  Utilisé pour le formulaire de création ou modification ainsi que l'ajout de commentaires. 
  J'aimerais pouvoir rendre un peu plus cohérent (factoriser) les style de la plupart des formulaires du site (zone modérateur, modif fiche, ajout commentaires) 
  mais ça demande un peu de tests, je (sly 2024) le fais au fûr et à mesure.
*/

/* Pour faire disparaitre un élément au bout de 5 secondes*/
.fade-out { 
  opacity: 0; // l'état par défaut est d'être invisible
  animation-iteration-count: 1;
  animation: fade;
  animation-duration: 8s;
}
@keyframes fade {
  0% { opacity: 1; filter:alpha(opacity=100); } // première frame, 100% visible
  100% { opacity: 0; filter:alpha(opacity=0); } // dernière, 100% invisible
}

form#form_point fieldset {
  border: thin solid transparent;
  /* pour les allergiques aux barrieres ;) */
  padding: 0.75em 0;
}

form#form_point .textarea {
  width: 100%;
  min-width: 150px;
  max-width: 1000px;
  min-height: 10em;
}

form#form_point .textarea label,
form#form_point .textarea textarea {
  width: calc(100% - 7px);
}

form#form_point .booleen {
  clear: left;
  float: left;
  width: calc(100% - 7px);
  min-width: 450px;
  max-width: calc(100% - 4px);
  text-align: right;
  padding: 1px;
}

form#form_point .booleen legend {
  clear: left;
  float: left;
}

form#form_point .booleen label {
  clear: none;
  float: none;
  padding-left: 5px;
}

form#form_export label {
  clear: none;
  float: left;
  width: 16em;
}

#form_export fieldset fieldset:hover {
  /* deco sur le fieldset actif, pour bien le differencier des autres */
  border: thin dotted black;
}

form.wri label {
  /* sans la classe WRI, ca fait foirer le forum PHPBB , et oui */
  clear: left;
  float: left;
}

form label[title]:after,
form legend[title]:after {
  /* combine pour exclure OL , leurs label ne sont pas dans des form */
  content: url(../images/tooltip.png);
}

fieldset fieldset {
  /* moins de déco pour les fieldset imbriques */
  float: left;
  border: thin solid transparent;
}

form .champs_null_masque>input {
  /* couleur de la case "champ null" et masquee par defo */
  outline: red solid 2px;
  float: left;
  display: none;
}

form .champs_null_masque>input:checked+* input {
  /* desactive les input qui suivent */
  visibility: hidden;
}

form .champs_null_masque>label {
  /* permet a la case de s'intercaler au bon endroit */
  clear: none;
}

.input_en_ligne {
  width: 26em;
}

.input_captcha_court {
  width: 3em;
}

.textarea_large {
  width: 99%;
  min-width: 150px;
  max-width: 1000px;
  min-height: 10em;
}

/* Cas particulier pour OL qui a des labels non standards */
div#switch_nav label {
  float: none;
  clear: none;
}

input[type=checkbox]:hover,
input[type=radio]:hover {
  box-shadow: 0px 0px 10px #1300ff;
}

/*==========divers=======*/
img {
  /* images sans bordures */
  border: 0px;
  margin: 0px;
  padding: 0px;
}

/*=========liens==========*/
a:hover {
  /*met en valeur les liens qd on est dessus */
  background-color: #<?=$couleur_legende?>;
  text-decoration: none;
}

/*
J'intègre également les class des liens du forum
en gros je veux tout de la même couleur
*/

body:not(#phpbb) a,
a.mainmenu,
a.nav,
a.forumlink,
a.cattitle,
a.topictitle,
a.postlink,
a.gen,
a.genmed,
a.gensmall {
  color: #<?=$couleur_lien?>;
  /* en accord avec le thème du forum, et moins agressif */
  text-decoration: none;
}

body:not(#phpbb) a:visited {
  color: #<?=$couleur_lien_visite?>;
}

/*========= Erreurs ==========*/
.erreur_saisie {
  border: 2px double red;
  background-color: yellow;
  padding: 10px;
}

/*==================================================================*/
/*  Entête de page : Logo, menus, identification                    */
/*==================================================================*/
.bandeau-haut * {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  font-size: 18px;
}

.menu-bouton * {
  font-family: Times New Roman;
}

.menu-haut form li {
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

  .recherche-haut input {
    font-size: 16px;
  }

  .recherche-haut a {
    padding-right: 10px;
    font-size: 18px;
  }

  .menu-haut {
    clear: both;
  }

  /* Ligne de menus */
  .menu-liste>ul {
    display: flex;
    justify-content: space-between;
    padding: 0;
  }

  .menu-liste>span,
  .menu-titre {
    display: none;
  }

  .menu-connexion {
    float: right;
  }

  .menu-connexion ul {
    right: 0;
    border-radius: 10px 0 10px 10px !important;
  }

  .menu-connexion span span {
    vertical-align: super;
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
    border-color: #<?=$couleur_decoration_titres?>  !important;
  }

  /* Blocs rétractables en dessous des boutons */
  .menu-bouton:not(.menu-liste)>p,
  .menu-bouton:not(.menu-liste)>ul {
    position: absolute;
    margin: 2px 0 0 -4px;
    border-radius: 0 10px 10px 10px;
    border: 2px solid #<?=$couleur_decoration_titres?>;
    background: #<?=$couleur_fond?>;
    padding: 0 4px;
    opacity: 0;
    z-index: -10;
  }

  .menu-touch:not(.menu-liste)>ul,
  .menu-hover:not(.menu-liste)>ul,
  .menu-hover:not(.menu-liste)>p,
  .menu-hover:not(.menu-liste)>a {
    opacity: 1;
    z-index: 1000;
  }

  /* Lignes des blocs rétractables */
  .menu-bouton:not(.menu-liste) li {
    max-height: 0;
    transition: max-height 0.2s ease-in;
  }

  .menu-touch:not(.menu-liste) li,
  .menu-hover:not(.menu-liste) li {
    max-height: 2.2em;
  }
}

/* On met tout sur une même ligne pour les très grandes fenêtres */
@media screen and (min-width: 1200px) {
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

  .menu-connexion ul {
    right: initial;
    border-radius: 0 10px 10px 10px !important;
  }

  .recherche-haut {
    padding-left: 20px;
  }
}

/* On enlève les icones pour les fenêtres moyenes */
@media screen and (min-width: 450px) and (max-width: 650px) {
  .menu-bouton span:first-child {
    display: none;
  }
}

/* On enlève le bandeau pour les fenêtres de faible hauteur */
@media screen and (max-height: 600px) and (min-width: 500px) {
  .bandeau-haut {
    background-image: none;
  }

  .logo-haut,
  .recherche-haut,
  .menu-titre span {
    display: none;
  }
}

@media screen and (max-height: 600px) and (min-width: 500px) and (max-width: 700px) {
  .menu-bouton span {
    line-height: 1.5em;
  }

  .menu-bouton span:first-child {
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
  body:not(#phpbb) .menu-titre span {
    display: none;
  }

  .menu-haut {
    display: flex;
    flex-direction: row-reverse;
    justify-content: space-between;
    background: #<?=$couleur_lien?>;
  }

  /* Boutons */
  div.menu-bouton>span,
  .menu-titre {
    display: block;
    padding: 0 8px 2px 8px;
    font-size: 20px;
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
  .menu-liste>ul,
  .menu-connexion ul {
    position: absolute;
    border-radius: 0 0 10px 10px;
    border: 2px solid #<?=$couleur_decoration_titres?>;
    padding: 0 4px;
    background: #<?=$couleur_fond?>;
    white-space: nowrap;
    z-index: -10;
    opacity: 0;
  }

  .menu-connexion ul {
    right: 0;
  }

  .menu-liste>ul {
    padding-top: 3px;
  }

  .menu-liste.menu-touch>ul,
  .menu-liste.menu-hover>ul,
  .menu-connexion.menu-touch>ul,
  .menu-connexion.menu-hover>ul {
    opacity: 1;
    z-index: 1000;
  }

  /* Lignes des blocs rétractables */
  .menu-liste li,
  .menu-connexion li {
    max-height: 0;
    transition: max-height 0.2s ease-in;
  }

  .menu-liste.menu-touch li,
  .menu-liste.menu-hover li {
    max-height: initial;
  }

  .menu-liste.menu-touch ul ul li,
  .menu-liste.menu-hover ul ul li,
  .menu-connexion.menu-touch li,
  .menu-connexion.menu-hover li {
    padding: 1.5px 0;
    max-height: 1.2em;
  }
}

/* Fenêtres très étroites */
@media screen and (max-width: 300px) {
  .menu-titre span {
    display: none;
  }
}

/* ========== Menu du bas ========== */

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
  border: dashed thin #096Ea1;
  text-align: center;
  margin: 0px;
}

#basdepage ul {
  clear: both;
  text-align: center;
}

#basdepage li {
  display: inline;
  margin-right: 2em;
}

#basdepage img,
form {
  /* tout le bazar de pub de bas de page, en ligne! */
  display: inline;
  vertical-align: middle;
}

/*==================================================================*/
/* La pages des massifs (accueil)                                   */
/*==================================================================*/

.tablo {
  /* div imite une table */
  display: table-cell;
  /* En dessous de 400 pixels, c'est trop tassé/pas lisible, en mettant ça, on force un affichage en dessous de la carte de l'accueil */
  min-width: 400px;
  vertical-align: top;
  float: left;
  /* pour IE7 */
}

/*==================================================================*/
/* Les pages points                                                 */
/*==================================================================*/

.liens_avec_decoration {
  border-style: solid;
  background-color: #<?=$couleur_fond?>;
  border-color: #<?=$couleur_decoration_titres?>;
  padding-right: 0.5em;
  padding-left: 0.5em;
}

.bloc_liens_centre {
  text-align: center;
  font-weight: bold;
}

/* concernant la disposition des commentaires */
.bloc_liens_haut_droit {
  display: block; 
  float: right;
  margin: -0.6em 1em 0em 1em;
}

.bloc_commentaire {
  border: thin solid black;
  margin-top: 1em;
}

.commentaire_metainfo {
  background-color: #<?=$couleur_legende?> ;
  border: thin solid black;
  font-weight: bold;
  float: left;
  margin: -0.6em 1em 0em 1em;
  border: thin solid black;
}

.spacer {
  /* HR de spacer pour la mise en page, en particulier dans les fiches */
  clear: both;
  visibility: hidden;
  margin: 0px;
  padding: 0px;
}

/* ENCADRE de présentation de FICHE */
.fiche_cadre .condense,
.fiche_cadre .condense dd,
.fiche_cadre .condense dt {
  display: inline;
  margin: 1px 5px 1px 0px;
}

.photos {
  float: left;
  position: relative;
  max-width: 100%;
}

.texte_sur_image {
  color: white;
  text-shadow: 2px 0 #555, -2px 0 #555, 0 2px #555, 0 -2px #555,
    1px 1px #555, -1px -1px #555, 1px -1px #555, -1px 1px #555;
  position: absolute;
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
/*                              Cartes                              */
/*==================================================================*/
.carte

/* utilisé par toutes les images cartes */
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

.accueil-switcher {
  float: right !important;
  background: white !important;
}

.accueil-switcher:not(.myol-button-selected) button {
  opacity: 0.5;
}

@media screen and (max-width: 750px) {
  #carte-accueil {
    width: calc(100vw - 22px);
    height: 90vw;
  }
}

/* Carte NAV présentation mobile verticale */
#carte-nav {
  height: 96vw;
  max-height: calc(100% - 65px);
  /* Pour ne pas trop déborder en bas */
}

#selecteur-carte-edit {
  padding-left: 1px;
}

#selecteur-carte-edit p {
  margin-top: 0;
  margin-bottom: 5px;
}

#selecteur-carte-edit span {
  font-size: .8em;
  font-style: oblique;
}

#selecteur-carte-edit input,
#selecteur-carte-edit label {
  text-align: justify;
  cursor: pointer;
}

/* Menu deplié */
@media screen and (min-width: 641px) and (min-device-height: 361px) {
  #carte-nav {
    max-height: calc(100% - 126px);
  }
}

/* Carte NaV présentation mobile horizontale */
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

/* Carte nav présentation écrans */
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

/* Cartes pour les petits écrans et mobiles */
@media screen and (max-width: 640px) {
  #carte-point {
    width: 99vw;
    height: 400px;
    max-height: 100vw;
  }
}

/* Carte formulaire de modification présentation grand écrans */
@media screen and (min-width: 1000px) {
  #carte-modif {
    width: 600px;
    height: 600px;
  }
}

/* Carte formulaire de modification de point pour moyen écran et mobiles*/
@media screen and (max-width: 1000px) {
  #container-carte-point {
    width: 100%;
  }
  #carte-modif {
    float: right;
    width: 100%;
    height: 100vw;
    max-height: 450px;
  }
}

/* Carte formulaire de modification de massif */
#carte-edit {
  width: 99%;
  height: 97vw;
  max-height: 450px;
  margin: 0 auto;
}

@media (pointer:coarse) {
  .hide-touch-screen {
    display: none;
  }
}

@media print {
  html {
    height: initial;
  }

  .noprint {
    display: none;
  }
}

#carte-nav {
  margin: 4px;
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

.texte-tout-petit {
  font-size: x-small;
}

// css pour se comporter comme une table
.table {
  display: table;
}

.tr {
  display: table-row;
}

.td {
  display: table-cell;
}

.ligne_pointillee {
  border-bottom: 1px dotted;
}


.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}

/* Debug PHP, style de var_dump() */
.xdebug-var-dump {
  background-color:black;
  color:white;
  font-size:14px
}
.xdebug-var-dump > small:first-child {
	display: block;
	border-top: solid white;
}
