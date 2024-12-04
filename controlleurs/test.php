<?php
/**********************************************************************************************
Je sais que c'est pas terrible d'avoir, en prod, un fichier de test, mais je m'aperçois que j'en ai
très souvent besoin et que je passe mon temps à l'effacer puis le re-créer
alors voilà, on peut bidouiller tant qu'on veut, la "route" d'accès est :
http://dev.refuges.info/test


**********************************************************************************************/
// On est pas là pour les perfs, alors on inclus tout pour être tranquille !
require_once ("bdd.php");
require_once ("commentaire.php");
require_once ("point.php");
require_once ("utilisateur.php");
require_once ("polygone.php");
require_once ("meta_donnee.php");
require_once ("xml.class.php");
require_once ("nouvelle.php");
require_once ("mise_en_forme_texte.php");
require_once ("upload_max_filesize.php");
 

//print("prouf");
//print_r($_GET);
//die();
//$html=bbcode2html($texte,$autoriser_html=FALSE,$autoriser_balise_img=TRUE);
  $conditions = new stdClass;
  $conditions->ids_points=105;
  
$point = infos_points($conditions);
d($point);
// d ( ) et la fonction de debug qui print les variables passée et une trace des appels
//d(lien_point($point,true));
//d($config_wri['sous_dossier_installation']);



t("fin");
//On quitte ici notre test parce que sinon la route va tenter d'ouvrir une vue test.html que je n'ai pas faite
die();
