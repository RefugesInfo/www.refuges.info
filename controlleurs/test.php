<?php
/**********************************************************************************************
Je sais que c'est pas terrible d'avoir, en prod, et qu'il faudrait mieux l'avoir dans le .gitignore
ce fichier de test et la route qui va avec, mais je m'aperçois que j'en ai très souvent besoin
et que quitte à avoir une route pour accéder au controlleur test,
alors voilà, par défaut dans le git c'est une version qui ne fait rien de risqué
on peut bidouiller tant qu'on veut, la "route" d'accès est :
https://xxxx.refuges.info/test xxxx étant l'instance du développeur

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
//t("debut");
//d($_GET);


// exemples pour tester le modèle point
$conditions = new stdClass;
$conditions->ids_points=105;
$point = infos_points($conditions);
// d ( ) et la fonction de debug qui print les variables passée et une trace des appels
print(json_encode($point));



//d(lien_point($point,true));
//d("/");

/*
// exemples pour tester le modèle commentaire
$conditions = new stdClass;
$conditions->ids_points=105;
$commentaires = infos_commentaires($conditions);
d($point);
*/



//t("fin");
//On quitte ici notre test parce que sinon la route va tenter d'ouvrir une vue test.html que je n'ai pas faite
die();
