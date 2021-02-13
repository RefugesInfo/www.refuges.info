<?php
/***
Indique de manière brutale (print_r) les dernières modifications ayant lieu sur les points de la base
pas super lisible, mais c'est mieux que rien en attendant un super wiki de versionning des fiches de points
si ça semble utile, je pourrais l'améliorer avec conditions sur le point et p'tet mise en rouge de ce qui a changé ;-)
2020 : Et aussi ranger proprement avec un modèle pour gérer la table historique_modifications_points.
sly : mais j'ai la flemme d'y passer du temps en sachant que ça n'est de toute façon pas la bonne solution
***/

require_once ('mise_en_forme_texte.php');
require_once ('utilisateur.php');

$condition_point="";
if (!empty($controlleur->url_decoupee[2]) and is_numeric($controlleur->url_decoupee[2]))
    $condition_point=" WHERE id_point=".$controlleur->url_decoupee[2];

$query_log_modification="select *,date_modification::timestamp(0) as date from historique_modifications_points$condition_point order by date_modification desc LIMIT 100";
if (! ($res = $pdo->query($query_log_modification)))
    return erreur("Requête en erreur, impossible d'afficher l'historique de modifications",$query_log_modification);
        
  while ($modification_point = $res->fetch())
  {
    if ($modification_point->id_user!=0)
        $utilisateur=infos_utilisateur($modification_point->id_user);
    else
        $utilisateur->username="anonyme ??";
    $point_avant=unserialize($modification_point->avant);
    $point_apres=unserialize($modification_point->apres);
    
    $modification_point->moderateur=$utilisateur->username;
    $modification_point->point_avant=$point_avant;
    $modification_point->point_apres=$point_apres;
    $vue->modifications_points[]=$modification_point;
  }
