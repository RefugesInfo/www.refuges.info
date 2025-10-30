/*===================================================================*/
/* La seule et unique feuille de style CSS des pages de refuges.info */
/*===================================================================*/
<?php
/***********************************************************************************************
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

// sly 2025 : je suis un fou de l'inutile, plutôt que choisir des mois un peu au pif, désormais je colle le style aux saisons Calendaire (approximatives) https://fr.wikipedia.org/wiki/Automne
$debut_automne = new DateTime("22 September");
$debut_hiver = new DateTime("21 December");
$debut_printemps = new DateTime("21 March");
$date_maintenant = new DateTime();

if ($date_maintenant > $debut_hiver or $date_maintenant < $debut_printemps) {
  $couleur_fond="f2f2f2";
  $couleur_lien="006699";
  $couleur_lien_clair="00aaff"; /* Pour mode sombre, on reste en dominante verte */
  $couleur_decoration_titres="a6cee7";
  $couleur_legende="eef";
}
if ($date_maintenant > $debut_printemps and $date_maintenant < $debut_automne) {
  $couleur_fond="f5fde8";
  $couleur_lien="5f8c11";
  $couleur_lien_clair="9ae31c";
  $couleur_decoration_titres="77dc63";
  $couleur_legende="d1f0d0";
}
if ($date_maintenant > $debut_automne and $date_maintenant < $debut_hiver) {
  $couleur_fond="f6e8c2";
  $couleur_lien="cf5d32";
  $couleur_lien_clair="d36b45";
  $couleur_decoration_titres="bd742c";
  $couleur_legende="c1ac96";
}

?>

/* DOM 09/2025 on passe des constantes PHP aux constantes CSS */
:root {
  --couleur_texte: black;
  --couleur_titre: white;
  --couleur_lien: #<?=$couleur_lien?>;
  --couleur_fond: #<?=$couleur_fond?>;
  --couleur_fond_titre: #<?=$couleur_lien?>;
  --couleur_fond_amplifiee: #cef99c;
  --couleur_decoration_titres: #<?=$couleur_decoration_titres?>;
  --couleur_legende: #<?=$couleur_legende?>;
  --image_bandeau: url(../images/bandeau-haut/titrehorizontal_<?=date('m')?>.png);
}

/* Surcharge pour les pages du site en style sombre */
@media (prefers-color-scheme: dark) {
  body:not(.light) {
    --couleur_texte: white;
    --couleur_titre: black;
    --couleur_lien: #<?=$couleur_lien_clair?>;
    --couleur_fond: #161210;
    --couleur_fond_amplifiee: #333;
  }
}

/* Surcharge quand le commutateur dark est activé dans prosilver_fr */
body.dark {
  --couleur_texte: white;
  --couleur_titre: black;
  --couleur_lien: #<?=$couleur_lien_clair?>;
  --couleur_fond: #161210;
  --couleur_fond_amplifiee: #333;
}

/*==================================================================*/
/* Le style des pages est maintenant dans style_page.css            */
/* Il n'est chargé que pour les pages hors forum                    */
/*==================================================================*/

/*==================================================================*/
/* Le style du forum est maintenant dans                            */
/* <IDENTIFIANT_DU_STYLE>/style_forum.css                           */
/* Il n'est chargé que pour les pages du forum                      */
/* Il peut être surchargé pour des styles # de prosilver_fr         */
/*==================================================================*/

/*==================================================================*/
/* Mise en page générale                                            */
/*==================================================================*/
html {
  width: 100%;
  height: 100%;
}

body {
  margin: 0px;
  width: 100%;
  height: 100%;
  background-color: var(--couleur_fond);
  color: var(--couleur_texte);
}

/*==================================================================*/
/* Entête de page : Logo, menus, identification                     */
/*==================================================================*/
.bandeau-haut * {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  font-size: 18px;
}

.bandeau-haut a {
  color: var(--couleur_lien);
}

.menu-bouton * {
  font-family: Times New Roman;
}

.menu-haut ul {
  list-style-type: none;
}

.menu-haut form li {
  margin: 5px 2px 10px 2px;
}

/* Fenêtres larges */
@media screen and (min-width: 450px) {

  /* Le bandeau */
  .bandeau-haut {
    background-image: var(--image_bandeau);
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
  .menu-titre,
  .menu-recherche {
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

  .bandeau_info {
    border: 1px solid red;
    border-radius: 5px;
    margin: 2px;
    padding: 0 2px 2px 2px;
  }

  .bandeau_info,
  .bandeau_info a {
    font-size: 14px;
    color: green;
    cursor: pointer;
  }

  .bandeau_info span {
    color: orange;
  }

  .bandeau_info .edit-info {
    text-decoration: line-through;
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
    border-color: var(--couleur_decoration_titres) !important;
  }

  /* Blocs rétractables en dessous des boutons */
  .menu-bouton:not(.menu-liste)>p,
  .menu-bouton:not(.menu-liste)>ul {
    position: absolute;
    margin: 2px 0 0 -4px;
    border-radius: 0 10px 10px 10px;
    border: 2px solid var(--couleur_decoration_titres);
    background: var(--couleur_fond);
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
    background: var(--couleur_fond);
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
  .menu-bouton span:not(.bouton-style):first-child {
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

  .menu-bouton span:not(.bouton-style):first-child {
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
    background: var(--couleur_fond_titre);
    color: var(--couleur_texte);
  }

  /* Boutons */
  div.menu-bouton>span,
  .menu-titre {
    display: block;
    padding: 0 8px 2px 8px;
    font-size: 20px;
    font-weight: 700;
    color: var(--couleur_titre) !important;
    cursor: pointer;
  }

  .menu-titre * {
    padding-top: 4px;
    font-size: 18px;
    color: var(--couleur_titre) !important;
  }

  /* Blocs rétractables en dessous des boutons */
  .menu-liste>ul,
  .menu-recherche ul,
  .menu-connexion ul {
    position: absolute;
    border-radius: 0 0 10px 10px;
    border: 2px solid var(--couleur_decoration_titres);
    padding: 0 4px;
    background: var(--couleur_fond);
    white-space: nowrap;
    z-index: -10;
    opacity: 0;
  }

  .menu-recherche ul,
  .menu-connexion ul {
    right: 0;
  }

  .menu-liste>ul {
    padding-top: 3px;
  }

  .menu-liste.menu-touch>ul,
  .menu-liste.menu-hover>ul,
  .menu-recherche.menu-touch>ul,
  .menu-recherche.menu-hover>ul,
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

/*==================================================================*/
/* Bas de page                                                      */
/*==================================================================*/
.basdepage {
  clear: both;
  padding-top: 15px;
  text-align: center;
  font-family: Times New Roman;
  font-size: 16px;
}

.basdepage img,
form {
  /* tout le bazar de pub de bas de page, en ligne! */
  display: inline;
  vertical-align: middle;
}
