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

require_once ('config.php');
require_once ("fonctions_polygones.php");
require_once ("fonctions_points.php");

function stat_site () 
{
  global $config,$pdo;
  // Petits stats de début sur l'intégralité de la base
  // donc je liste bien les point_type 7,9 et 10 qui sont des hébergements
  // les autres sont des sommets, des cols, des villes où autre
  
  // PDO jmb re ecriture en une seule requete
  // a passer en prepared ??
  $q = "SELECT 
  ( SELECT count(*) FROM points WHERE id_point_type IN ( ".$config ['tout_type_refuge']." )
  AND (ferme='' or ferme='non')
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
FIXME: la prochaine étape est de ne générer aucun HTML ici, mais transmettre au nouveau modèle mvc 
un tableau contenant les informations sly 20/12/2011
Conseils d'utilisation : cette fonction n'a de sens que lorsqu'elle mélange plusieurs sources de nature différentes
(comme message du forum et commentaire et nouveaux points, si c'est juste pour afficher certains commentaires, la fonctions
infos_commentaires( ) est à mon avis plus appropriée

***************************************/

function affiche_news($nombre,$type,$rss=FALSE)
{
 global $config,$pdo;
 // tableau de tableau contiendra toutes les news toutes catégories confondues
 $news_array = array() ;
 if ($rss)
   $lien_absolu=True;
 else
   $lien_absolu=False;

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
      $lien=lien_point_fast($commentaire,$lien_absolu)."#C$commentaire->id_commentaire";
      $titre=$commentaire->nom;
      $texte="<i>$categorie </i>";
      if ($commentaire->photo_existe)
	$texte.="+<img src=\"/images/icones/photo.png\" alt=\"commentaire avec photo\" /> ";
      if ($commentaire->auteur!="")
	$texte.="de $commentaire->auteur ";
      
      // si le commentaire ne porte pas sur un point d'un massif, pas de lien vers le massif
      // la ya un massif
      if (isset($commentaire->id_polygone))
      {
	// Cosmétique, on ne place pas d'espace après un l'
	if ($commentaire->article_partitif=="de l'")
	  $espace="";
	else
	  $espace=" ";
	
	$lien_massif="dans <a href=\"".lien_polygone($commentaire,$lien_absolu)."\">le massif
	".$commentaire->article_partitif.$espace.$commentaire->nom_massif."</a>";
      }
      else   // la ya pas de massif
	$lien_massif="";
      
      $texte.="sur <a href=\"$lien\">$titre</a> 
      $lien_massif";
      $news_array[] = array($commentaire->ts_unix_commentaire,"texte"=>$texte,
			    "date"=>$commentaire->ts_unix_commentaire,"categorie"=>$categorie,
			    "titre"=>$titre,"lien"=>$lien); 
    }	
    break;
    
    case "refuges": $conditions->type_point=$config['tout_type_refuge'];
    case "points":
      $conditions = new stdClass;
      $conditions->ordre="date_insertion DESC";
      $conditions->limite=$nombre;
      $conditions->avec_infos_massif=1;
      $liste_points=liste_points($conditions);
      if (isset($liste_points))
	foreach($liste_points->points as $point)
	{
	  $categorie="Ajout $point->article_partitif_point_type $point->nom_type";
	  $lien=lien_point_fast($point,$lien_absolu);
	  $titre=$point->nom;
	  
	  // si le point n'appartient à aucun massif, pas de lien vers le massif
	  if ($point->id_massif!=$config['numero_massif_fictif'])
	  {
	    // Cosmétique, on ne place pas d'espace après un l'
	    if ($point->article_partitif_massif=="de l'")
	      $espace="";
	    else
	      $espace=" ";
	    
	    $lien_massif="dans le 
	    <a href=\"".lien_polygone($point,$lien_absolu)."\">massif $point->article_partitif_massif$espace$point->nom_massif</a>";
	  }
	  else
	    $lien_massif="";
	  
	  $texte="$categorie : 
	  <a href=\"$lien\">$titre</a>
	  $lien_massif";
	  $news_array[] = array($point->date_insertion,"texte"=>$texte,
				"date"=>$point->date_insertion,"categorie"=>$categorie,
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
	$texte="<i>$titre</i>";
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
        $conditions_messages_forum->ordre="ORDER BY date DESC";

        $commentaires_forum=messages_du_forum($conditions_messages_forum);
        foreach ( $commentaires_forum as $commentaire_forum)
        {
          $lien="/forum/viewtopic.php?p=$commentaire_forum->post_id#$commentaire_forum->post_id";
          $categorie="Sur le forum";
          $titre=$commentaire_forum->topic_title;
          $texte="$categorie : <a href=\"$lien\">$titre</a>";
          $news_array[] = array($commentaire_forum->date,"texte"=>$texte,
            "date"=>$commentaire_forum->date,"categorie"=>$categorie,
            "titre"=>$titre,"lien"=>$lien); 
        }
    break;

    default:
	break;

  }


$tok = strtok(","); 
}
// ici je trie par ordre décroissant toutes les news confondues
rsort($news_array);

// AFFICHAGE
// FIXME : a convertir au modèle MVC
if (!$rss)
{
  for ($i = 0; $i < $nombre; $i++)
    print("\n<li><em>".date("d/m/y", $news_array[$i]['date'])."</em>&nbsp;".$news_array[$i]['texte']."</li>");
  
// et le reste du tableau ben il sert a rien...
return 0;
}
else
	return $news_array;
}

?>
