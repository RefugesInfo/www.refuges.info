<?php
/**********************************************************************************************
Route générique « maintenance » : https://xxxx.refuges.info/maintenance

Cette coquille est VIDE par défaut, donc la route est désactivée (404).
Pour une opération ponctuelle de maintenance, copier un outil de ressources/outils/ ici, par exemple :
  cp ressources/outils/rangement-cabanes-fermees.php controlleurs/maintenance.php
puis le désactiver avec :
  git checkout controlleurs/maintenance.php
Ne jamais commiter une copie active. Un outil doit contrôler lui-même les droits (est_moderateur()) et finir par die()
pour que le routeur ne cherche pas de vue maintenance.html.
**********************************************************************************************/
http_response_code(404);
die("Page introuvable");
