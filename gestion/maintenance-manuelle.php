<?php
require("../modeles/config.php");
require_once ($config['chemin_modeles']."fonctions_commentaires.php");

print("<pre>");
$c->texte="pof";
$c->id_point=1;
$id=modification_ajout_commentaire($c);
print_r($id);
if ($id->erreur)
  print_r($id);
else
  print_r(infos_commentaire($id->id_commentaire));
print("</pre>");
?>