<?php
/****************************************************************************************************
Voici les fonctions qui permettent de fournir différents moyen d'avoir les dernières infos de refuges.info
(Nouveau message sur le forum, commentaire sur un point, nouveau point, nouvelle globale)
En format exploitable pour le flux RSS, les pages nouvelles en HTML

22/04/08 jmb	: modif de affiche_news, (bug des forums)  elle sert QUE dans news.php.
04/07/08 jmb : modif de affiche news, forum, rajout de Post_id dans la requete, et chgt du lien forum
rajout du setlocale et déplacement dans un fichier config.php
24/10/11 Dominique : Ajout de stat_site() pour compatibilité MVC
****************************************************************************************************/

require_once ("config.php");
require_once ("bdd.php");
require_once ("polygone.php");
require_once ("point.php");
require_once ("utilisateur.php");

  function stat_site ()
  {
    global $config_wri,$pdo;
    // Petits stats de début sur l'intégralité de la base
    // donc je liste bien les point_type 7,9 et 10 qui sont des hébergements
    // les autres sont des sommets, des cols, des villes où autre
    // FIXME sly : cette fonction devrait faire appels aux fonctions d'accès génériques, sinon, je suis obligé de la retoucher à chaque changement dans la base
    // PDO jmb re ecriture en une seule requete
    $q = "SELECT
        ( SELECT count(*) FROM points WHERE id_point_type IN ( ".$config_wri['tout_type_refuge']." )
        AND ( conditions_utilisation in ('ouverture','cle_a_recuperer') or conditions_utilisation is NULL)
        AND points.modele <> 1
        AND points.en_attente <> TRUE
        )                                  AS nbrefuges,
    ( SELECT count(*) FROM commentaires WHERE photo_existe=1 )                                AS nbphotos,
    ( SELECT count(*) FROM commentaires )                                                     AS nbcomm,
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

elle prends 3 paramêtres,$nombre news, categorie(s) de news a chercher et $id_massif 
 * Les categories: séparées par "," comme "forum,refuges" pour les nouveaux messages forum et les nouveaux refuges a la fois
   A disposition : commentaires,refuges,points,forums
 * L'ID du massif n'est effectif que sur les commentaires et les points (pas sur le forum)
   Possibilité de mettre une liste d'ids séparés par une virgule

maintenir l'idée de tout regrouper dans un tableau qu'on tri ensuite
Conseils d'utilisation : cette fonction n'a de sens que lorsqu'elle mélange plusieurs sources de nature différentes
(comme message du forum et commentaire et nouveaux points, si c'est juste pour afficher certains commentaires ou certains points, les fonctions
infos_xxxx( ) sont plus appropriées et performantes

FIXME: il reste un peu de html en dur dans cette fonction (et de mise en forme bbcode2html), il faudrait en faire un vrai retour par
array/object et ce serait au controleur/la vue de s'occuper de la mise en forme

***************************************/

function nouvelles($nombre,$type,$id_massif="",$lien_locaux=True)
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
                $conditions_commentaires->avec_infos_point=True;
                if($id_massif!="") $conditions_commentaires->ids_polygones=$id_massif;
                $commentaires=infos_commentaires($conditions_commentaires);
                foreach ( $commentaires as $commentaire )
                {
                    $news_array[$i]['date'] = $commentaire->ts_unix_commentaire;
                    $news_array[$i]['categorie']="Commentaire";
                    $news_array[$i]['lien']=lien_point($commentaire,$lien_locaux)."#C$commentaire->id_commentaire";
                    $news_array[$i]['titre']=$commentaire->nom;
                    $news_array[$i]['commentaire']=$commentaire->texte;
                    if ($commentaire->photo_existe) {
                        $news_array[$i]['photo']="1";
                        $news_array[$i]['photo_mini']=$commentaire->lien_photo['reduite'];
                        $news_array[$i]['photo_originale']=$commentaire->lien_photo['originale'];
                    }
                    if ($commentaire->auteur_commentaire!="")
                    {
                        $news_array[$i]['auteur']=$commentaire->auteur_commentaire;
                        if ($commentaire->id_createur_commentaire!=0)
                        {
                          $utilisateur=infos_utilisateur($commentaire->id_createur_commentaire);
                          $news_array[$i]['lien_auteur'] = lien_utilisateur($utilisateur,$lien_locaux);
                        }
                    }
                    // si le commentaire ne porte pas sur un point d'un massif, pas de lien vers le massif
                    // la ya un massif
                    if (isset($commentaire->id_polygone))
                    {
                        // Cosmétique, on ne place pas d'espace après un l'
                        if ($commentaire->article_partitif=="de l'")
                            $espace="";
                        else
                            $espace=" ";
                        $news_array[$i]['lien_massif']=lien_polygone($commentaire,$lien_locaux);
                        $news_array[$i]['partitif_massif'] = $commentaire->article_partitif.$espace;
                        $news_array[$i]['massif'] = $commentaire->nom_polygone;
                    } 
                    $i++;
                }	
                break;
                
            case "refuges": $conditions->ids_types_point=$config_wri['tout_type_refuge'];
            case "points":
                $conditions->ordre="date_creation DESC";
                $conditions->limite=$nombre;
                $conditions->avec_infos_massif=True;
                if($id_massif!="") $conditions->ids_polygones=$id_massif;
                $points=infos_points($conditions);
                if (count($points)!=0)
                    foreach($points as $point)
                    {
                        $news_array[$i]['categorie']="Point";
                        if ($point->nom_createur!="")
                        {
                            $news_array[$i]['auteur']=$point->nom_createur;
                            if ($point->id_createur!=0)
                            {
                                $utilisateur=infos_utilisateur($point->id_createur);
                                $news_array[$i]['lien_auteur'] =  lien_utilisateur($utilisateur,$lien_locaux);
                            }
                        }
                        
                        $news_array[$i]['lien']=lien_point($point,$lien_locaux);
                        $news_array[$i]['titre']=$point->nom;
                        $news_array[$i]['partitif_point']=$point->article_partitif_point_type;
                        $news_array[$i]['type_point']=$point->nom_type;
                        $news_array[$i]['remarques']=$point->remark;
                        $news_array[$i]['acces']=$point->acces;
                        $news_array[$i]['date']=$point->date_creation_timestamp;

                        // si le point n'appartient à aucun massif, pas de lien vers le massif
                        if (isset($point->id_massif))
                        {
                          // Cosmétique, on ne place pas d'espace après un l'
                          if ($point->article_partitif_massif=="de l'")
                            $espace="";
                          else
                            $espace=" ";
                          $news_array[$i]['lien_massif']=lien_polygone($point,$lien_locaux);
                          $news_array[$i]['partitif_massif'] = $point->article_partitif.$espace;
                          $news_array[$i]['massif'] = $point->nom_polygone;
                        }
                        $i++;
                    }
                    break;
                
            case "forums":
                $conditions_messages_forum = new stdclass();
                $conditions_messages_forum->limite=$nombre;
                $conditions_messages_forum->sauf_ids_forum=$config_wri['id_forum_moderateur'].",".$config_wri['id_forum_developpement'];
                
                $commentaires_forum=messages_du_forum($conditions_messages_forum);
                if (count($commentaires_forum)>0)
                    foreach ( $commentaires_forum as $commentaire_forum)
                    {
                        if ($lien_locaux)
                            $url_complete="";
                        else
                            $url_complete="http://".$config_wri['nom_hote'];
                        $news_array[$i]['lien']=$url_complete.$config_wri['lien_forum']."viewtopic.php?p=$commentaire_forum->post_id#p$commentaire_forum->post_id";
                        $news_array[$i]['categorie']="Forum";
                        $news_array[$i]['titre']=html_entity_decode ($commentaire_forum->topic_title);
                        $news_array[$i]['date']=$commentaire_forum->date;
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
    // FIXME c'est à faire dans le controleur ça, pas dans le modèle
    foreach ($news_array as $nouvelle)
    {
        $nouvelles[]=$nouvelle;
        $nb++;
        if ($nb>=$nombre)
            break;
    }
    return $nouvelles;
}

// Cette fonction retourne un texte en bbcode à insérer par la suite dans les vues du site

function texte_nouvelles($nouvelles) {
    foreach($nouvelles as $key => $nouvelle) {
        switch ($nouvelle['categorie']) {
            case 'Forum':
                $texte = "Sur le forum : [url=".$nouvelle['lien']."]".$nouvelle['titre']."[/url]";
                break;
            case 'Commentaire':
                $texte = "Commentaire";
                if ($nouvelle['photo'])
                    $texte .= " et photo";
                if (isset($nouvelle['auteur'])) {
                    $texte .= " de ";
                    if (isset($nouvelle['lien_auteur']))
                        $texte .= "[url=".$nouvelle['lien_auteur']."]";
                    $texte .= $nouvelle['auteur'];
                    if (isset($nouvelle['lien_auteur']))
                        $texte .= "[/url]";
                }
                $texte .= " sur [url=".$nouvelle['lien']."]".ucfirst($nouvelle['titre'])."[/url]";
                if (isset($nouvelle['massif']))
                    $texte .= " dans [url=".$nouvelle['lien_massif']."]le massif ".$nouvelle['partitif_massif'].$nouvelle['massif']."[/url]";
                break;
            case 'Point':
                $texte = "Ajout ".$nouvelle['partitif_point']." ".$nouvelle['type_point'];
                if (isset($nouvelle['auteur'])) {
                    $texte .= " par ";
                    if (isset($nouvelle['lien_auteur']))
                        $texte .= "[url=".$nouvelle['lien_auteur']."]";
                    $texte .= $nouvelle['auteur'];
                    if (isset($nouvelle['lien_auteur']))
                        $texte .= "[/url]";
                }
                $texte .= " : ";
                $texte .= "[url=".$nouvelle['lien']."]".ucfirst($nouvelle['titre'])."[/url]";
                if (isset($nouvelle['massif']))
                    $texte .= " dans [url=".$nouvelle['lien_massif']."]le massif ".$nouvelle['partitif_massif'].$nouvelle['massif']."[/url]";
                break;
        }
        $nouvelles[$key]['texte'] = $texte;
    }
    return $nouvelles;
}
?>
