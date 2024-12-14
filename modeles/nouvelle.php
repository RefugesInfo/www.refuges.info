<?php
/****************************************************************************************************
Voici les fonctions qui permettent de fournir différents moyen d'avoir les dernières infos de refuges.info
(Nouveau message sur le forum, commentaire sur un point, nouveau point, nouvelle globale)
En format exploitable pour le flux RSS et les pages nouvelles en HTML

22/04/08 jmb	: modif de affiche_news, (bug des forums)  elle sert QUE dans news.php.
04/07/08 jmb : modif de affiche news, forum, rajout de Post_id dans la requete, et chgt du lien forum
rajout du setlocale et déplacement dans un fichier config.php
24/10/11 Dominique : Ajout de stat_site() pour compatibilité MVC

2021-02-13 sly : C'est un sacré morceau de code tout ça, pas très rapide, un peu redondant avec l'accueil qui n'utilise même pas ce code ! et s'en sort très bien. Et pénible à maintenir.
Sa seule force, c'est de pouvoir fournir, ordonné par date un ensemble fusionné provenant de plusieurs sources : surtout forum puis commentaires et fiches.
Mais bon, franchement, tout ça pour ça, j'ai envie de tout jeter et me simplifier la vie...
****************************************************************************************************/

require_once ("bdd.php");
require_once ("polygone.php");
require_once ("point.php");
require_once ("utilisateur.php");
require_once ("commentaire.php");
require_once ("forum.php");

function stat_site ()
{
  global $config_wri,$pdo;
  // Petits stats de début sur l'intégralité de la base
  // donc je liste bien les "refuges"
  // les autres sont des sommets, des cols, des villes où autre
  // FIXME sly : cette fonction devrait faire appels aux fonctions d'accès génériques, sinon, je suis obligé de la retoucher à chaque changement dans la base
  // PDO jmb re ecriture en une seule requete
  $q = "SELECT
      ( SELECT count(*) FROM points WHERE id_point_type IN ( ".implode(',',$config_wri['tout_type_refuge'])." )
      AND ( conditions_utilisation in ('ouverture','cle_a_recuperer') or conditions_utilisation is NULL)
      AND points.modele <> 1
      AND points.cache <> TRUE
      )                                                                                         AS nbrefuges,
  ( SELECT count(*) FROM points WHERE points.modele <> 1 AND points.cache <> TRUE )         AS nbpoints,
  ( SELECT count(*) FROM commentaires WHERE photo_existe=1 )                                    AS nbphotos,
  ( SELECT count(*) FROM commentaires )                                                         AS nbcomm,
  ( SELECT count(*) FROM polygones WHERE id_polygone_type IN ( ".$config_wri['id_massif'].")  ) AS nbmassifs ";
  $res = $pdo->query($q);
  return $res->fetch();
}

/****************************************
Fonction d'accès aux nouvelles
elle peut renvoyer selon le $type un tableau avec :
- les commentaires ajoutés sur tous points
et/ou
- Tout type de points ajoutés
et/ou 
- Tout type de refuge (cabane, gite, refuges) ajoutés
et/ou
- les derniers messages sur les forums des points

elle prends minimum 2 paramêtres : $nombre nouvelles à sortir au total, la ou les categorie(s) de nouvelles a chercher 

 * Les categories: séparées par "," comme "forum,refuges" pour les nouveaux messages forum et les nouveaux refuges a la fois
   A disposition : commentaires,refuges,points,forums
 * option : L'ID du massif n'est effectif que sur les commentaires et les points (pas sur le forum)
   Possibilité de mettre une liste d'ids séparés par une virgule

Une 3ème option permet de restreindre les nouvelles ne concernant que les points contenus dans un ou plusieurs polygones, utilisée uniquement par le flux RSS mais en 2025 j'ai bon espoir d'en faire un critère de filtre pour les nouvelles   
   
NOTE sly : Conseils d'utilisation : Utiliser cette fonction n'a de sens que lorsqu'on veut mélanger plusieurs sources de natures différentes
(comme message du forum et commentaire et nouveaux points, si c'est juste pour afficher des commentaires ou des points, les fonctions
infos_xxxx( ) sont plus appropriées et performantes.)
Car lorsque l'on demande 100 nouvelles on ne peut pas utiliser efficacement le LIMIT en SQL, en effet, comme c'est fait en plusieurs requêtes, on ne sait pas à l'avance comment on atteindra la limite, on est donc obligé de demander 100 de chaque catégories pour finalement ne prendre que les 100 plus récentes.
***************************************/

function nouvelles($nombre,$type,$ids_polygones="",$lien_locaux=True,$req=null)
{
  global $config_wri,$pdo;
  $conditions = new stdClass;
  // tableau de tableau contiendra toutes les news toutes catégories confondues
  $news_array = array() ;
  
  $i = 1;    
  $tok = strtok($type, ",");// le séparateur des types de news. voir aussi tt en bas
  while ($tok) // vrai tant qu'il reste une categorie a rajouter
  {
    switch ($tok) 
    {
      case "commentaires":
        $conditions_commentaires = new stdclass();
        $conditions_commentaires->limite=$nombre; // FIXME ?: C'est toujours un peu dommage d'aller chercher le max de commentaires sachant que au total, plein ne servirons pas
        $conditions_commentaires->avec_points_caches=False; // On ne veut pas les commentaires sur des points cachés. Sauf si on est modérateur ?
        
        if ($req && $req->avec_photo)
          $conditions_commentaires->avec_photo=$req->avec_photo;
          
        if(!empty($ids_polygones)) 
          $conditions_commentaires->ids_polygones=$ids_polygones;
        
        $commentaires=infos_commentaires($conditions_commentaires);

        $conditions_point = new stdclass;
        foreach ( $commentaires as $commentaire )
        {
          $news_array[$i]['id_point'] = $commentaire->id_point;
          $news_array[$i]['date'] = $commentaire->ts_unix_commentaire;
          $news_array[$i]['categorie']="Commentaire";
          if ($req && $req->avec_texte)
            $news_array[$i]['commentaire']=$commentaire->texte;
          $news_array[$i]['id_commentaire']=$commentaire->id_commentaire;
          $news_array[$i]['photo']=0;
          if ($commentaire->photo_existe) {
            $news_array[$i]['photo']="1";
            $news_array[$i]['photo_mini']=$commentaire->lien_photo['reduite'] ?? '';
            $news_array[$i]['photo_originale']=$commentaire->lien_photo['originale'] ?? '';
          }
          if (!empty($commentaire->auteur_commentaire))
          {
            $news_array[$i]['auteur']=html_entity_decode($commentaire->auteur_commentaire);
            if ($commentaire->id_createur_commentaire!=0)
            {
              $utilisateur=infos_utilisateur($commentaire->id_createur_commentaire);
              if (!isset($utilisateur->erreur))
                $news_array[$i]['lien_auteur'] = lien_utilisateur($utilisateur,$lien_locaux);
            }
          }
          $i++;
          }
        break;
            
        case "refuges": $conditions->ids_types_point=implode(',',$config_wri['tout_type_refuge']);
        case "points":
          $conditions->ordre="points.date_creation DESC,polygone_type.ordre_taille DESC";
          $conditions->limite=$nombre; // FIXME ?: C'est toujours un peu dommage d'aller chercher le max de commentaires sachant que au total, plein ne servirons pas
          $conditions->avec_liste_polygones=True;
          if($ids_polygones!="") $conditions->ids_polygones=$ids_polygones;
          $points=infos_points($conditions);
          if (count($points)!=0)
            foreach($points as $point)
            {
                $news_array[$i]['categorie']="Point";
                if ($point->nom_createur!="")
                {
                  if (!empty($point->nom_createur))
                    $news_array[$i]['auteur']=$point->nom_createur;
                  else
                    $news_array[$i]['auteur']="Auteur supprimé";
                  if ($point->id_createur!=0)
                  {
                    $utilisateur=infos_utilisateur($point->id_createur);
                    if (!isset($utilisateur->erreur))
                      $news_array[$i]['lien_auteur'] =  lien_utilisateur($utilisateur,$lien_locaux);
                  }
                }
                
                $news_array[$i]['lien']=lien_point($point,$lien_locaux);
                $news_array[$i]['nom_point']=ucfirst($point->nom);
                $news_array[$i]['partitif_point']=$point->article_partitif_point_type;
                $news_array[$i]['type_point']=$point->nom_type;
                $news_array[$i]['remarques']=$point->remark;
                $news_array[$i]['acces']=$point->acces;
                $news_array[$i]['date']=$point->date_creation_timestamp;
                $news_array[$i]['localisation']=chaine_de_localisation($point->polygones);
                $texte = "[url=".lien_point($point,$lien_locaux)."][b]Ajout ".$news_array[$i]['partitif_point']." ".$news_array[$i]['type_point']."[/b][/url]" ;
                if (!empty($news_array[$i]['auteur'])) {
                  $texte .= " par ";
                  if (!empty($news_array[$i]['lien_auteur']))
                    $texte .= "[url=".$news_array[$i]['lien_auteur']."]";
                  $texte .= $news_array[$i]['auteur'];
                  if (!empty($news_array[$i]['lien_auteur']))
                    $texte .= "[/url]";
                }
                $news_array[$i]['texte']=$texte;
                $i++;
              }
              break;
            
        case "forums":
          $conditions_messages_forum = new stdclass();
          $conditions_messages_forum->limite=$nombre; // FIXME ?: C'est toujours un peu dommage d'aller chercher le max de commentaires sachant que au total, plein ne servirons pas
          $conditions_messages_forum->ids_forum=$config_wri['ids_forum_pour_les_nouvelles'];

          $commentaires_forum=messages_du_forum($conditions_messages_forum);
          
          if (count($commentaires_forum)>0)
            foreach ( $commentaires_forum as $commentaire_forum )
            {
              $news_array[$i]['topic_id']=$commentaire_forum->topic_id;              
              $news_array[$i]['categorie']="Forum";
              $news_array[$i]['post_id']=$commentaire_forum->post_id;
              $news_array[$i]['date']=$commentaire_forum->date;
              if ($req && $req->avec_texte)
                $news_array[$i]['commentaire']=purge_phpbb_post_text($commentaire_forum->post_text);
              $i++;
            }
          break;
    }
    
    
    $tok = strtok(","); 
  }
  // ici je trie par ordre décroissant toutes les news confondues
  function cmp($a, $b)
  {
    if ($a['date'] == $b['date']) {
      return 0;
    }
  return ($a['date'] < $b['date']) ? 1 : -1;
  }
  usort($news_array,"cmp");
  $nb=0;

  // Et je ne prends que les $nombre première ou toutes s'il y en a moins que $nombre
  $nouvelles = array ();
  foreach ($news_array as $nouvelle)
  {
    if ($nouvelle['categorie'] == "Forum") // FIXME: idée d'une magie pour s'éviter de faire x fois la requête ? where id_point in (x,y,z,t,.....) ?
    {
      $conditions_point = new stdclass;
      $conditions_point->avec_liste_polygones=True;
      $conditions_point->topic_id=$nouvelle['topic_id'];
      $conditions_point->avec_points_caches=True; // NOTE: si le point est caché, on veut quand même les messages du forum qui s'y rapporte, et donc les infos du point ?
      $point=reset(infos_points($conditions_point));
      $nouvelle['nom_point']=ucfirst($point->nom);
      $nouvelle['localisation']=chaine_de_localisation($point->polygones);
      if ($lien_locaux)
        $url_complete="";
      else
        $url_complete="https://".$config_wri['nom_hote'];
      $lien_forum=$url_complete.$config_wri['lien_forum']."viewtopic.php?p=".$nouvelle['post_id']."#".$nouvelle['post_id'];
      $nouvelle['texte']="[url=$lien_forum][b]Message sur son forum[/b][/url]";
    }
    if ($nouvelle['categorie'] == "Commentaire")
    {
      $conditions_point = new stdclass;
      $conditions_point->avec_liste_polygones=True;
      $conditions_point->ids_points=$nouvelle['id_point'];
      $point=reset(infos_points($conditions_point));
      $lien=lien_point($point,$lien_locaux)."#C".$nouvelle['id_commentaire'];
      $nouvelle['nom_point']=ucfirst($point->nom);
      $nouvelle['localisation']=chaine_de_localisation($point->polygones);
      $nouvelle['texte'] = "[url=$lien][b]Commentaire[/b][/url]";
      if (!empty($nouvelle['photo']))
        $nouvelle['texte'] .= " et photo";
      if (!empty($nouvelle['auteur'])) {
          $nouvelle['texte'] .= " de ";
        if (!empty($nouvelle['lien_auteur']))
          $nouvelle['texte'] .= "[url=".$nouvelle['lien_auteur']."]".$nouvelle['auteur']."[/url]";
        else
          $nouvelle['texte'] .= $nouvelle['auteur'];
      }
    }
    // $nouvelle['categorie'] == "Point" -> Les nouvelles sur les ajouts de points ont déjà toutes les infos nécessaires sur leurs polygones d'appartenance, on ne fait rien de spécifique pour eux
    $nouvelles[]=$nouvelle;
    $nb++;
    if ($nb>=$nombre) // On obtient le nombre de nouvelles demandées, on s'arrête là et surtout on ne va gaspille plus de temps à chercher les infos $points sur les nouvelles qu'on affichera pas
        break;
  }
  return $nouvelles;
}
