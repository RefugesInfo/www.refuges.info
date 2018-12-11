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
require_once ("mise_en_forme_texte.php");
require_once ("gestion_erreur.php");
require_once ("meta_donnee.php");
require_once ("xml.class.php");
require_once ("api.php");
require_once ("nouvelle.php");
require_once ("point_gps.php");
session_start();
//auto_login_phpbb_users();

print("prouf");
//$_SESSION['toto']="coucou";
print_r($_SESSION);
print_r($_GET);
die();
$html=bbcode2html($texte,$autoriser_html=FALSE,$autoriser_balise_img=TRUE,$crypter_texte_sensible=TRUE);

$point = infos_point(105);

d(lien_point($point,true));
//d($config_wri['sous_dossier_installation']);

exit();
?>
