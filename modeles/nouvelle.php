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
 * 3ème paramètre : Le ou les ID du/des polygones n'est effectif que sur les commentaires et les points (pas sur le forum)
   Possibilité de mettre une liste d'ids séparés par une virgule : utilisée uniquement par le flux RSS mais en 2025 j'ai bon espoir d'en faire un critère de filtre pour la page des nouvelles qui devient de plus en plus énorme les mois de rando (tant mieux pour le site, difficile à suivre pour les modérateurs)  
   
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
       
            
  // pour chaque catégorie, on va chercher autant que la limite qui nous a été demandée (si on nous demande 300 nouvelles : on va chercher 300 commentaires, 300 nouveaux points et 300 nouveau message forum. Et ouais, c'est triste, mais comme c'est en plusieurs requêtes, je ne sais pas sinon quels sont les 300 plus récents
  // Je vais au moins limiter dans cette première boucle à n'aller chercher que le minimum, la deuxième boucle, qui ne prendra que les 300 nouvelles, fera les traitements de recherche des points et polygones correspondants
  while ($tok) 
  {
    
    switch ($tok) 
    {
      case "commentaires":
        $conditions_commentaires = new stdclass();
        $conditions_commentaires->limite=$nombre;
        $conditions_commentaires->avec_points_caches=False; // On ne veut pas les commentaires sur des points cachés. Sauf si on est modérateur ?
        
        if ($req && $req->avec_photo)
          $conditions_commentaires->avec_photo=$req->avec_photo;
          
        $conditions_commentaires->ids_polygones=$ids_polygones ?? Null;
        
        $commentaires=infos_commentaires($conditions_commentaires);
        if ($commentaires->erreur??'')
          return erreur($commentaires->message);

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
          if ($commentaire->photo_existe) 
          {
            $news_array[$i]['photo']="1";
            $news_array[$i]['photo_mini']=$commentaire->lien_photo['reduite'] ?? '';
            $news_array[$i]['photo_originale']=$commentaire->lien_photo['originale'] ?? '';
          }
          $news_array[$i]['user_id']=$commentaire->id_createur_commentaire;
          $news_array[$i]['auteur']=$commentaire->auteur_commentaire;
          $i++;
          
        }
      break;
      // FIXME sly: franchement, je ne suis pas fier de cette bidouille, d'accord, ça tient en 3 lignes mais c'est pas du tout extensible, il faudrait que les nouvelles acceptent un code du genre forum,points=8-9-7-8,commentaires=7-9 histoire de vraiment sélectionner ce qu'on veut par thèmes
      case "points_d_eau": $conditions->ids_types_point=$conditions->ids_types_point ?? $config_wri['id_point_d_eau'];
      case "grottes": $conditions->ids_types_point=$conditions->ids_types_point ?? $config_wri['id_grotte'];
      case "refuges": $conditions->ids_types_point=$conditions->ids_types_point ?? implode(',',$config_wri['tout_type_refuge']);
      case "points":
          $conditions->ordre="points.date_creation DESC,polygone_type.ordre_taille DESC";
          $conditions->limite=$nombre;
          $conditions->avec_liste_polygones=True;
          $conditions->ids_polygones=$ids_polygones ?? Null;
          $points=infos_points($conditions);
          if (count($points)!=0)
            foreach($points as $point)
            {
                $news_array[$i]['categorie']="Point";                
                $news_array[$i]['lien']=lien_point($point,$lien_locaux);
                $news_array[$i]['nom_point']=ucfirst($point->nom);
                $news_array[$i]['id_point']=$point->id_point;
                $news_array[$i]['partitif_point']=$point->article_partitif_point_type;
                $news_array[$i]['type_point']=$point->nom_type;
                $news_array[$i]['remarques']=$point->remark;
                $news_array[$i]['acces']=$point->acces;
                $news_array[$i]['date']=$point->date_creation_timestamp;
                $news_array[$i]['localisation']=chaine_de_localisation($point->polygones);
                $news_array[$i]['user_id']=$point->id_createur;
                $news_array[$i]['auteur']=$point->nom_createur;
                $texte = "<b><a href=\"".lien_point($point,$lien_locaux)."\">Ajout ".$news_array[$i]['partitif_point']." ".$news_array[$i]['type_point']."</a></b>" ;
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
            foreach ( $commentaires_forum as $commentaire_forum )
            {
              $news_array[$i]['topic_id']=$commentaire_forum->topic_id;              
              $news_array[$i]['user_id']=$commentaire_forum->poster_id;              
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
    $par_ou_de="par";
    if ($nouvelle['categorie'] == "Forum") // FIXME: idée d'une magie pour s'éviter de faire x fois la requête ? where id_point in (x,y,z,t,.....) ?
    {
      $nouvelle['texte'] = "";
      $conditions_point = new stdclass;
      $conditions_point->avec_liste_polygones=True;
      $conditions_point->topic_id=$nouvelle['topic_id'];
      $conditions_point->avec_points_caches=True; // NOTE: si le point est caché, on veut quand même les messages du forum qui s'y rapporte, et donc les infos du point ?
      $points=infos_points($conditions_point);
      if (count($points)!=0) // Nous avons bien ce topic dans le forum demandé, mais il n'est rattaché à aucun point. Cela arrive quand quelqu'un ou un robot a créé manuellement un topic dans le forum des refuges. ça devrait pas, mais ça arrive, et je n'ai pas moyen de l'interdire en amont, évitons d'avoir une ligne vide
      {
        $point=reset($points);
        $nouvelle['nom_point']=ucfirst($point->nom);
        $nouvelle['localisation']=chaine_de_localisation($point->polygones);
        if ($lien_locaux)
          $url_complete="";
        else
          $url_complete="https://".$config_wri['nom_hote'];
        $lien_forum=$url_complete.$config_wri['lien_forum']."viewtopic.php?p=".$nouvelle['post_id']."#p".$nouvelle['post_id'];
        $nouvelle['texte']="<b><a href=\"$lien_forum\">Message forum</a></b>";
        $nouvelle['lien']=$lien_forum;
        $par_ou_de="de";
        }
    }
    if ($nouvelle['categorie'] == "Commentaire")
    {
      $conditions_point = new stdclass;
      $conditions_point->avec_liste_polygones=True;
      $conditions_point->ids_points=$nouvelle['id_point'];
      $points=infos_points($conditions_point);
      $point=reset($points);
      $lien=lien_point($point,$lien_locaux)."#C".$nouvelle['id_commentaire'];
      $nouvelle['nom_point']=ucfirst($point->nom);
      $nouvelle['localisation']=chaine_de_localisation($point->polygones);
      $nouvelle['texte'] = "<b><a href=\"$lien\">Commentaire</a></b>";
      $nouvelle['lien']=$lien;
      $par_ou_de="de";
    }
    
    if (!empty($nouvelle['user_id']) and $nouvelle['user_id'] > 1) // Les anonymes sont 1 sur le forum et 0 dans notre base
    {
      $utilisateur=infos_utilisateur($nouvelle['user_id']);
      $nouvelle['texte'] .= " $par_ou_de <a href=\"".lien_utilisateur($utilisateur)."\">".($utilisateur->username??'Anonymous')."</a>";
    }
    elseif  (!empty($nouvelle['auteur'])) // on est face à un anonyme, il a peut-être saisie le champ libre "auteur" ?
      $nouvelle['texte'] .= " $par_ou_de ".$nouvelle['auteur'];

    // et $nouvelle['categorie'] == "Point" alors ? => Les nouvelles sur les ajouts de points ont déjà toutes les infos nécessaires sur leurs polygones d'appartenance, on ne fait rien de spécifique pour eux
    if( !empty($nouvelle['nom_point']) )
      $nouvelles[]=$nouvelle;
    $nb++;
    if ($nb>=$nombre) // On obtient le nombre de nouvelles demandées, on s'arrête là et surtout on ne va gaspille plus de temps à chercher les infos $points sur les nouvelles qu'on affichera pas
        break;
  }
  return $nouvelles;
}
