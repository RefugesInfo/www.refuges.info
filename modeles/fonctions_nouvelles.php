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
require_once ("fonctions_bdd.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_points.php");

function stat_site () 
{
	global $config,$pdo;
	// Petits stats de début sur l'intégralité de la base
	// donc je liste bien les point_type 7,9 et 10 qui sont des hébergements
	// les autres sont des sommets, des cols, des villes où autre
        // FIXME sly : cette fonction devrait faire appels aux fonctions d'accès génériques, sinon, je suis obligé de la retoucher à chaque changement dans la base
	// PDO jmb re ecriture en une seule requete 
	$q = "SELECT 
			( SELECT count(*) FROM points WHERE id_point_type IN ( ".$config ['tout_type_refuge']." )
			AND (conditions_utilisation='ouverture' OR conditions_utilisation='cle_a_recuperer')
			AND points.modele != 1 )                                  AS nbrefuges,
	( SELECT count(*) FROM commentaires WHERE photo_existe=1 )                                AS nbphotos,
	( SELECT count(*) FROM commentaires )                                                     AS nbcomm,
	( SELECT count(*) FROM polygones WHERE id_polygone_type IN ( ".$config['id_massif'].")  ) AS nbmassifs ";
	$res = $pdo->query($q);
	return $res->fetch();
}

/****************************************
Fonction d'accès aux nouvelles
elle renvoi un tableau avec :
- les commentaires ajoutés sur les points
- les points ajoutés avec un lien
- les news d'info générale sur le site
- les derniers messages sur les forums
- un mix (new)
- le titre de la liste (new) (pas pu faire autrement pour la liste)

elle prends 2 paramêtres,$nombre news, categorie(s) de news a chercher 
les categories: séparées par "," comme "general" pour uniquement news general
    "forum,refuges" pour les nouveaux messages forum et les nouveaux refuges a la fois
A disposition : commentaires,refuges,points,general,forums

maintenir l'idée de tout regrouper dans un tableau qu'on tri ensuite
Conseils d'utilisation : cette fonction n'a de sens que lorsqu'elle mélange plusieurs sources de nature différentes
(comme message du forum et commentaire et nouveaux points, si c'est juste pour afficher certains commentaires ou certains points, les fonctions
infos_xxxx( ) sont à mon avis plus appropriées et performantes

***************************************/

function nouvelles($nombre,$type,$lien_locaux=True)
{
    global $config,$pdo;
    $conditions = new stdClass;
    // tableau de tableau contiendra toutes les news toutes catégories confondues
    $news_array = array() ;
    
    $tok = strtok($type, ",");// le séparateur des types de news. voir aussi tt en bas
    while ($tok) // vrai tant qu'il reste une categorie a rajouter
    {
        switch ($tok) 
        {
            case "commentaires":
                $type_news="nouveau_commentaire";
                $conditions_commentaires = new stdclass();
                $conditions_commentaires->limite=$nombre;
                $conditions_commentaires->avec_infos_point=True;
                $commentaires=infos_commentaires($conditions_commentaires);
                foreach ( $commentaires as $commentaire )
                {
                    $categorie="Commentaire";
                    $lien=lien_point_fast($commentaire,$lien_locaux)."#C$commentaire->id_commentaire";
                    $titre=$commentaire->nom;
                    $texte="$categorie";
                    if ($commentaire->photo_existe)
                        $texte.="+photo";
                    if ($commentaire->auteur_commentaire!="" and $commentaire->id_createur_commentaire==0)
                        $texte.=" de ".bbcode2html($commentaire->auteur_commentaire)." ";
                    else if ($commentaire->auteur_commentaire!="" and $commentaire->id_createur_commentaire!=0)
                        $texte.=" de <a href=\"".$config['fiche_utilisateur']."$commentaire->id_createur_commentaire\">".bbcode2html($commentaire->auteur_commentaire)."</a> ";
                    
                    
                    // si le commentaire ne porte pas sur un point d'un massif, pas de lien vers le massif
                    // la ya un massif
                    if (isset($commentaire->id_polygone))
                    {
                        // Cosmétique, on ne place pas d'espace après un l'
                        if ($commentaire->article_partitif=="de l'")
                            $espace="";
                        else
                            $espace=" ";
                        
                        $lien_massif="dans <a href=\"".lien_polygone($commentaire,$lien_locaux)."\">le massif
                        ".$commentaire->article_partitif.$espace.$commentaire->nom_polygone."</a>";
                    }
                    else   // la ya pas de massif
                        $lien_massif="";
                    
                    $texte.=" sur <a href=\"$lien\">$titre</a> 
                    $lien_massif";// FIXME mieux vaudrait revoir le format du tableau sans HTML
                    $news_array[] = array($commentaire->ts_unix_commentaire,"texte"=>$texte,
                                          "date"=>$commentaire->ts_unix_commentaire,"categorie"=>$categorie,
                                          "titre"=>$titre,"lien"=>$lien); 
                }	
                break;
                
            case "refuges": $conditions->ids_types_point=$config['tout_type_refuge'];
            case "points":
                $conditions->ordre="date_creation DESC";
                $conditions->limite=$nombre;
                $conditions->avec_infos_massif=True;
                $points=infos_points($conditions);
                if (count($points)!=0)
                    foreach($points as $point)
                    {
                        $categorie="Ajout $point->article_partitif_point_type $point->nom_type";
                        $lien=lien_point_fast($point,$lien_locaux);
                        $titre=$point->nom;
                        
                        // si le point n'appartient à aucun massif, pas de lien vers le massif
                        if (isset($point->id_massif))
                        {
                            // Cosmétique, on ne place pas d'espace après un l'
                            if ($point->article_partitif_massif=="de l'")
                                $espace="";
                            else
                                $espace=" ";
                            
                            $lien_massif="dans le 
                            <a href=\"".lien_polygone($point,$lien_locaux)."\">massif $point->article_partitif_massif$espace$point->nom_massif</a>";
                        }
                        else
                            $lien_massif="";
                        
                        $texte="$categorie : 
                        <a href=\"$lien\">$titre</a>
                        $lien_massif";// FIXME mieux vaudrait revoir le format du tableau sans HTML
                        $news_array[] = array($point->date_creation_timestamp,"texte"=>$texte,
                                              "date"=>$point->date_creation_timestamp,"categorie"=>$categorie,
                                              "titre"=>$titre,"lien"=>$lien); 
                    }
                    break;
                    
            case "general":
                $conditions_commentaires_generaux = new stdClass;
                $conditions_commentaires_generaux->ids_points=$config['numero_commentaires_generaux'];
                $conditions_commentaires_generaux->limite=$nombre;
                $commentaires=infos_commentaires($conditions_commentaires_generaux);
                
                foreach ( $commentaires as $news)
                {
                    $categorie="Générale";
                    $titre=$news->texte;
                    $texte=$titre;// FIXME mieux vaudrait revoir le format du tableau sans HTML
                    $lien="/news.php";
                    $news_array[] = array($news->ts_unix_commentaire,"texte"=>$texte,
                                          "date"=>$news->ts_unix_commentaire,"categorie"=>$categorie,
                                          "titre"=>$titre,"lien"=>$lien); 
                }	
                break;
                
            case "forums":
                $type_news="nouveau_message_forum";
                $conditions_messages_forum = new stdclass();
                $conditions_messages_forum->limite=$nombre;
                $conditions_messages_forum->sauf_ids_forum=$config['id_forum_moderateur'].",".$config['id_forum_developpement'];
                
                $commentaires_forum=messages_du_forum($conditions_messages_forum);
                if (count($commentaires_forum)>0)
                    foreach ( $commentaires_forum as $commentaire_forum)
                    {
                        $lien="/forum/viewtopic.php?p=$commentaire_forum->post_id#$commentaire_forum->post_id";
                        $categorie="Sur le forum";
                        $titre=$commentaire_forum->topic_title;
                        $texte="$categorie : <a href=\"$lien\">$titre</a>"; // FIXME mieux vaudrait revoir le format du tableau sans HTML
                        $news_array[] = array($commentaire_forum->date,"texte"=>$texte,
                                              "date"=>$commentaire_forum->date,"categorie"=>$categorie,
                                              "titre"=>$titre,"lien"=>$lien); 
                    }
                    break;
        }
        
        
        $tok = strtok(","); 
    }
    // ici je trie par ordre décroissant toutes les news confondues
    rsort($news_array);
    $nb=0;
    // Et je ne prends que les $nombre première ou toutes s'il y en a moins que $nombre
    foreach ($news_array as $nouvelle)
    {
        $nouvelle['date_formatee']=date("d/m/y", $nouvelle['date']);
        $nouvelles[]=$nouvelle;
        $nb++;
        if ($nb>=$nombre)
            break;
    }
    return $nouvelles;
}

?>
