<?php
/***
Indique de manière brutale (print_r) les dernières modifications ayant lieu sur les points de la base
pas super lisible, mais c'est mieux que rien en attendant un super wiki de versionning des fiches de points
si ça semble utile, je pourrais l'améliorer avec conditions sur le point et p'tet mise en rouge de ce qui a changé ;-)
***/

require_once ('mise_en_forme_texte.php');
require_once ('utilisateur.php');

$query_log_modification="select avant,apres,id_user,date_modification::timestamp(0) as date_modification from historique_modifications_points order by date_modification desc LIMIT 100";
if (! ($res = $pdo->query($query_log_modification)))
    return erreur("Requête en erreur, impossible d'afficher l'historique de modifications",$query_log_modification);
        
  //Constuisons maintenant la liste des points demandés avec toutes les informations sur chacun d'eux
  while ($modification_point = $res->fetch())
  {
    if ($modification_point->id_user!=0)
        $utilisateur=infos_utilisateur($modification_point->id_user);
    else
        $utilisateur->username="anonyme ??";
    
    $modification_point->moderateur=$utilisateur->username;
    $vue->modifications_points[]=$modification_point;
  }
//d($vue);
?>
