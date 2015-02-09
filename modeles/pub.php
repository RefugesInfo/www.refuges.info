<?php
/**********************************************************************************************
Fonctions pour gérer les publicités du site.
Une seule fonction pour l'instant, qui renvoi le code javascript a insérer dans les pages
Un paramètre pourrait être développer pour choisir le model d'encart pub (large, haut, court, etc.)
sly 07/08/2012

mode par défaut "normal" = large 4 pubs
**********************************************************************************************/

function bandeau_publicitaire($taille = "normal")
{
  // pub google
  // 13/06/07 sly, ayant été banni de google il y a au moins un an,
  // je laisse une trace ici des fois que, mais ça risque bien de sauter un jour

  // 13/06/07 sly, les pubs oxado ne rapportant que peanuts ( 2-3 euros /mois ) je tente de changer encore un fois
  // sérieux ça me saoul, c'est mon dernier essais avant le "no pub" et se sera mieux comme ça

  // 13/06/07 bon et ben voilà, c'est fini ! nadinoumouk, click4france c'est de la pire daube en flash, manquait plus que ça
  // je vire tout, et fini les pubs jusqu'a ce qu'une solution sorte du lot

  // bon, on y retourne, il faudra bien un jour que nous nous remboursions une certaine somme importante perdue.

  // pour yip  si tu me lis: si je trouve un truc qui rapporte (enfin!) un peu on fera moitier/moitier comme convenu
  // sly 31/10/2007

  // retour donc chez oxado

  // 02/2008 jmb: re essai chez google
  // 03/2008 jmb : re banni juste avant qu'ils paient...

  //====================================================================//
  //======================= GOOGLE ADSENSE enculés ====================//

  // pub google
  // nouvelle tentative GOOGLE, apparement, j'ai pu recreer un compte que voici:
  // jm.bourdaret@laposte.net   mdp de la BDD

  // 07/08/2012 tentative de retour de pub de chez google, en attendant de se re-re-re faire bannir ?
  // sly

  // 24/11/2012 ça tient toujours ! On a fini par être oublié par leurs fichiers blacklistes ;-), ça tourne et ça rapporte (un peu)
  // ça tourne autour de ~40 euros/mois (avec fortes dispartité été/hiver) soit largement de quoi payer l'hébergement
  // mais environ 40 ans pour rembourser la prune IGN
  $pub_google="<script type=\"text/javascript\"><!--
  google_ad_client = \"ca-pub-3240407130303272\";
    google_ad_slot = \"2316397000\";
    google_ad_width = 970;
    google_ad_height = 90;
  //-->
  </script>
  <script type=\"text/javascript\"
  src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">
  </script>";
  return $pub_google;
}

