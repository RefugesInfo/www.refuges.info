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
/* Bas de page                                                      */
/*==================================================================*/
.basdepage {
  clear: both;
  padding-top: 15px;
  text-align: center;
  font-family: Times New Roman;
  font-size: 16px;
}

.basdepage img {
  display: inline;
  vertical-align: middle;
}
