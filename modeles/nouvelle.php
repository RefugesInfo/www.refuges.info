<?php
/****************************************************************************************************
Voici les fonctions qui permettent de fournir différents moyen d'avoir les dernières infos de refuges.info
(Nouveau message sur le forum, commentaire sur un point, nouveau point, nouvelle globale)
En format exploitable pour le flux RSS, les pages nouvelles en HTML

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
elle renvoi un tableau avec :
- les commentaires ajoutés sur les points
- les points ajoutés avec un lien
- les derniers messages sur les forums
- un mix (new)
- le titre de la liste (new) (pas pu faire autrement pour la liste)

elle prends 3 paramêtres,$nombre news, categorie(s) de news a chercher et $ids_polygones 
 * Les categories: séparées par "," comme "forum,refuges" pour les nouveaux messages forum et les nouveaux refuges a la fois
   A disposition : commentaires,refuges,points,forums
 * L'ID du massif n'est effectif que sur les commentaires et les points (pas sur le forum)
   Possibilité de mettre une liste d'ids séparés par une virgule

maintenir l'idée de tout regrouper dans un tableau qu'on tri ensuite
NOTE : Conseils d'utilisation : Utiliser cette fonction n'a de sens que lorsqu'elle mélange plusieurs sources de natures différentes
(comme message du forum et commentaire et nouveaux points, si c'est juste pour afficher des commentaires ou des points, les fonctions
infos_xxxx( ) sont plus appropriées et performantes.)
Par exemple car lorsque l'on demande 100 news on ne peut pas utiliser efficacement le LIMIT en SQL, en effet, comme c'est fait en plusieurs requêtes, on ne sait pas à l'avance comment on atteindra la limite, on est donc obligé de demander 100 de chaque catégories pour finalement ne prendre que les 100 plus récentes.


***************************************/

function nouvelles($nombre,$type,$ids_polygones="",$lien_locaux=True,$req=null)
{
  global $config_wri,$pdo;
  $conditions = new stdClass;
  // tableau de tableau contiendra toutes les news toutes catégories confondues
  $news_array = array() ;
  
  $i = 0;    
  $tok = strtok($type, ",");// le séparateur des types de news. voir aussi tt en bas
  while ($tok) // vrai tant qu'il reste une categorie a rajouter
  {
    switch ($tok) 
    {
      case "commentaires":
        $conditions_commentaires = new stdclass();
        $conditions_commentaires->limite=$nombre;
        
        if ($req && $req->avec_photo)
            $conditions_commentaires->avec_photo=$req->avec_photo;
        if($ids_polygones!="") $conditions_commentaires->ids_polygones=$ids_polygones;
        $commentaires=infos_commentaires($conditions_commentaires);
        $conditions_point = new stdclass;
        foreach ( $commentaires as $commentaire )
        {
          // Ici, on retrouve les informations du point auquel ce commentaire se rapporte, dans le but de le localiser
          $conditions_point->ids_points=$commentaire->id_point;
          $conditions_point->avec_liste_polygones=True;
          $points=infos_points($conditions_point);
          $point=reset($points);
          
          
          $news_array[$i]['localisation']=chaine_de_localisation($point->polygones);
          
          $news_array[$i]['date'] = $commentaire->ts_unix_commentaire;
          $news_array[$i]['categorie']="Commentaire";
          $news_array[$i]['lien']=lien_point($point,$lien_locaux)."#C$commentaire->id_commentaire";
          $news_array[$i]['titre']=ucfirst($point->nom);
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
          $texte = "Commentaire";
          if (!empty($news_array[$i]['photo']))
            $texte .= " et photo";
          if (!empty($news_array[$i]['auteur'])) {
              $texte .= " de ";
            if (!empty($news_array[$i]['lien_auteur']))
              $texte .= "[url=".$news_array[$i]['lien_auteur']."]";
              $texte .= $news_array[$i]['auteur'];
            if (!empty($news_array[$i]['lien_auteur']))
              $texte .= "[/url]";
            $news_array[$i]['texte']=$texte;        
          $i++;
          }
        }
        break;
            
        case "refuges": $conditions->ids_types_point=implode(',',$config_wri['tout_type_refuge']);
        case "points":
          $conditions->ordre="points.date_creation DESC,polygone_type.ordre_taille DESC";
          $conditions->limite=$nombre;
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
                $news_array[$i]['titre']=ucfirst($point->nom);
                $news_array[$i]['partitif_point']=$point->article_partitif_point_type;
                $news_array[$i]['type_point']=$point->nom_type;
                $news_array[$i]['remarques']=$point->remark;
                $news_array[$i]['acces']=$point->acces;
                $news_array[$i]['date']=$point->date_creation_timestamp;
                $news_array[$i]['localisation']=chaine_de_localisation($point->polygones);
                $texte = "Ajout ".$news_array[$i]['partitif_point']." ".$news_array[$i]['type_point'];
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
          $conditions_messages_forum->limite=$nombre;
          $conditions_messages_forum->ids_forum=$config_wri['ids_forum_pour_les_nouvelles'];

          $commentaires_forum=messages_du_forum($conditions_messages_forum);
          
          if (count($commentaires_forum)>0)
            foreach ( $commentaires_forum as $commentaire_forum)
            {
              if ($lien_locaux)
                $url_complete="";
              else
                $url_complete="http://".$config_wri['nom_hote'];
              // Ici, on retrouve les informations du point auquel ce Sujet de forum se rapporte
              $conditions_point = new stdclass;
              $conditions_point->topic_id=$commentaire_forum->topic_id;
              $conditions_point->avec_liste_polygones=True;
              $conditions_point->avec_points_caches=True;
              $point=reset(infos_points($conditions_point));
              
              $news_array[$i]['lien']=lien_point($point,$lien_locaux);
              $news_array[$i]['titre']=ucfirst($point->nom);
              $news_array[$i]['localisation']=chaine_de_localisation($point->polygones);
              
              $lien_forum=$url_complete.$config_wri['lien_forum']."viewtopic.php?p=$commentaire_forum->post_id#p$commentaire_forum->post_id";
              $news_array[$i]['categorie']="Forum";
              $news_array[$i]['titre']=html_entity_decode ($commentaire_forum->topic_title);
              $news_array[$i]['date']=$commentaire_forum->date;
              if ($req && $req->avec_texte)
                $news_array[$i]['commentaire']=purge_phpbb_post_text($commentaire_forum->post_text);
              $news_array[$i]['texte']="Message sur le forum : [url=".$lien_forum."]".$news_array[$i]['titre']."[/url]";
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
      $nouvelles[]=$nouvelle;
      $nb++;
      if ($nb>=$nombre)
          break;
  }
  return $nouvelles;
}
