<?php
/**********************************************************************************************
Je sais que c'est pas terrible d'avoir, en prod, un fichier de test, mais je m'aperçois que j'en ai
très souvent besoin et que je passe mon temps à l'effacer puis le re-créer
alors voilà, on peut bidouiller tant qu'on veut, la "route" d'accès est :
http://dev.refuges.info/test
**********************************************************************************************/

require_once ("wiki.php");
require_once ("bdd.php");
require_once ("commentaire.php");
require_once ("point.php");
require_once ("utilisateur.php");

print("<pre>");
$conditions->ids_commentaires = 16758;
print_r(infos_commentaires($conditions));
print("</pre>");

exit();
?>
