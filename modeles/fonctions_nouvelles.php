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
require_once ("fonctions_affichage_points.php");
require_once ("fonctions_points.php");

function stat_site () {
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
			
/*	$query_nombre_refuge = "
		SELECT count(*) AS somme 
		FROM points
		WHERE id_point_type IN ({$config ['tout_type_refuge']})
			AND (ferme='' or ferme='non')
			AND points.modele != 1";

	$r ['nbrefuges'] = mysql_result ($result = mysql_query ($query_nombre_refuge), 0);
	mysql_free_result($result);

	$query_nombre_photos = "SELECT count(*) FROM commentaires WHERE photo_existe=1";
	$r ['nbphotos'] = mysql_result ($result = mysql_query($query_nombre_photos), 0);
	mysql_free_result ($result);

	$query_nombre_comm = "SELECT count(*) FROM commentaires";
	$r ['nbcomm'] = mysql_result ($result=  mysql_query( $query_nombre_comm), 0);
	mysql_free_result ($result);

	$query_nombre_massifs = "SELECT count(*) FROM polygones WHERE id_polygone_type=1";
	$r ['nbmassifs'] = mysql_result ($result=  mysql_query( $query_nombre_massifs), 0);
	mysql_free_result ($result);

	return $r;
*/
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
***************************************/

function affiche_news($nombre,$type,$rss=FALSE,$vignette=FALSE)
{
 global $config,$pdo;
 // tableau de tableau contiendra toutes les news toutes catégories confondues
 $news_array = array() ;

 $tok = strtok($type, ",");// le séparateur des types de news. voir aussi tt en bas
 while ($tok) // vrai tant qu'il reste une categorie a rajouter
 {
  switch ($tok) 
  {
    case "commentaires":
    $type_news="nouveau_commentaire";

    //FIXME ce format devrait un jour être une extension du système modulaire de recherche, mais pour l'instant il ne fait encore rien des commentaires (ou presque)
    // sly 18/05/2010
	//PDO passage de cette requete en prepared, car elle sert ailleurs aussi
	//var_dump ( array("point"   => '',			"vignette"=> $vignette ? "AND commentaires.photo_existe = 1 " : '',
	//														"limite"  => $nombre ) );
	$pdo->requetes->liste_comments->bindValue('point', -1 , PDO::PARAM_INT ); // -1 = tous
//	$pdo->requetes->liste_comments->bindValue('vignette', $vignette ? $vignette : -1 , PDO::PARAM_INT ); // 1 avec, -1 tous , 0 sans
	$pdo->requetes->liste_comments->bindValue('vignette', -1, PDO::PARAM_INT ); // 1 avec, -1 tous , 0 sans
	$pdo->requetes->liste_comments->bindValue('limite', $nombre, PDO::PARAM_INT); //ATTENTION LIMIT attent un INT, ce qui fait foirer la methode array

	$pdo->requetes->liste_comments->execute();

//    $query_news=
//		"SELECT commentaires.auteur,points.id_point,
//			points.nom,commentaires.id_commentaire,commentaires.photo_existe,
//			UNIX_TIMESTAMP(commentaires.date) as date
//       FROM commentaires, points
//        WHERE
//			".($vignette ? "commentaires.photo_existe = 1 AND" : "") ."
//		commentaires.id_point = points.id_point
//		AND
//		points.modele!=1
//		ORDER BY commentaires.date DESC
//        LIMIT 0,$nombre";
//PDO-
// 	$r_select_news = mysql_query($query_news);
//	while ($news = mysql_fetch_object($r_select_news))
	//PDO+
	while ( $news = $pdo->requetes->liste_comments->fetch() )
	{
		//résultat de mon commentaire d'avant, ici, on fait chauffer le CPU !
		$point=infos_point($news->id_point);
		$categorie="Commentaire";
//		var_dump($point); 
		$lien=lien_point_fast($point)."#C$news->id_commentaire";
		$titre=$news->nom;
		$texte="<i>$categorie </i>";
		if ($news->photo_existe)
			$texte.="+<img src=\"/images/icones/photo.png\" alt=\"commentaire avec photo\" /> ";
		if ($news->auteur!="")
			$texte.="de $news->auteur ";

		// si le commentaire ne porte pas sur un point d'un massif, pas de lien vers le massif
		// la ya un massif
		if ($point->id_massif != $config['numero_massif_fictif'])
		{
			// Cosmétique, on ne place pas d'espace après un l'
			if ($point->article_partitif_massif=="de l'")
				$espace="";
			else
				$espace=" ";
		
			$lien_massif="dans <a href=\"".lien_polygone($point->nom_massif,$point->id_massif,"massif")."\">le massif
			".$point->article_partitif_massif.$espace.$point->nom_massif."</a>";
		}
		else   // la ya pas de massif
			$lien_massif="";

		$texte.="sur <a href=\"$lien\">
			$titre</a> 
			$lien_massif";
		$news_array[] = array($news->date,"texte"=>$texte,
				"date"=>$news->date,"categorie"=>$categorie,
				"vignette"=>$config['rep_web_photos_points'].$news->id_commentaire."-vignette.jpeg",
				"titre"=>$titre,"lien"=>$lien); 
	}	
//PDO-	mysql_free_result($r_select_news);
   break;
 
	case "refuges": $conditions->type_point=$config['tout_type_refuge'];
	case "points":
	$conditions->ordre="date_insertion DESC";
	$conditions->limite=$nombre;
	$conditions->avec_infos_massif=1;
	$liste_points=liste_points($conditions);
	
	foreach($liste_points->points as $point)
	{
		$categorie="Ajout $point->article_partitif_point_type $point->nom_type";
		$lien=lien_point_fast($point);
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
			<a href=\"".lien_polygone($point->nom_massif,$point->id_massif,$point->type_polygone)."\">massif $point->article_partitif_massif$espace$point->nom_massif</a>";
		}
		else
			$lien_massif="";

		$texte="$categorie : 
			<a href=\"$lien\">$titre</a>
			$lien_massif";
		$news_array[] = array($point->date_insertion,"texte"=>$texte,
				"date"=>$point->date_insertion,"categorie"=>$categorie,
				"vignette"=>"",
				"titre"=>$titre,"lien"=>$lien); 
	}
   break;
    
    case "general":
    $query_news=
		"SELECT UNIX_TIMESTAMP(date) as date,
			id_commentaire,
			texte
		FROM commentaires
		WHERE
			commentaires.id_point = ".$config['numero_commentaires_generaux']."
		ORDER BY date DESC
		LIMIT 0,$nombre";
//PDO-
//	$r_select_news = mysql_query($query_news);
//	while ($news = mysql_fetch_object($r_select_news))
	//PDO+
	$res = $pdo->query($query_news);
	while ( $news = $res->fetch() )
	{
//var_dump($news);
		$categorie="Générale";
		$titre=$news->texte;
		$texte="<i>$titre</i>";
		$lien="/news.php";
		$news_array[] = array($news->date,"texte"=>$texte,
				"date"=>$news->date,"categorie"=>$categorie,
				"vignette"=>"",
				"titre"=>$titre,"lien"=>$lien); 
	}	
//PDO-	mysql_free_result($r_select_news);
    break;
  
    case "forums":
	$type_news="nouveau_message_forum";
// Il y avait aussi ça mais je ne sais pas pourquoi ? sly 02-11-2008
//AND phpbb_topics.topic_first_post_id < phpbb_topics.topic_last_post_id
// réponse :  pour qu'il y ait > 1 post. cad forum non vide. sinon last=first.
    $query_news=
		"SELECT
			max(phpbb_posts.post_time) AS date,
			phpbb_posts.topic_id,
			phpbb_topics.topic_title,
			phpbb_posts_text.post_text AS texte,
			max(phpbb_posts_text.post_id) AS post_id
		FROM phpbb_posts_text, phpbb_topics, phpbb_posts
    		WHERE
    		phpbb_posts_text.post_text!=''
		AND phpbb_topics.topic_id = phpbb_posts.topic_id
		AND phpbb_posts_text.post_id = phpbb_posts.post_id
		AND phpbb_topics.forum_id not in ($config[id_forum_moderateur],$config[id_forum_developpement])
		GROUP BY topic_id
		ORDER BY date DESC
		LIMIT 0,$nombre";

//PDO-
//	$r_select_news = mysql_query($query_news);
//	while ($news = mysql_fetch_object($r_select_news))
	//PDO+
	$res = $pdo->query($query_news);
	while ( $news = $res->fetch() )
	{
		$lien="/forum/viewtopic.php?p=$news->post_id#$news->post_id";
		$categorie="Sur le forum";
		$titre=$news->topic_title;
		$texte="$categorie : <a href=\"$lien\">$titre</a>";
		$news_array[] = array($news->date,"texte"=>$texte,
				"date"=>$news->date,"categorie"=>$categorie,
				"vignette"=>"",
				"titre"=>$titre,"lien"=>$lien); 
	}
//PDO-  	mysql_free_result($r_select_news);

    break;

    default:
	break;

  }


$tok = strtok(","); 
}

// ici je trie par ordre décroissant toutes les news confondues
rsort($news_array);

 // AFFICHAGE
if (!$rss)
{
	for ($i = 0; $i < $nombre; $i++)
		if ($vignette) {
			print("\n<li><a href=\"".$news_array[$i]['lien']."\" title=\"".$news_array[$i]['titre']."\"><img alt=\"photo\" src=\"".$news_array[$i]['vignette']."\" /></a></li>");
		}
		else
		{ // évidement pas de miracles, avant on préparait le format plus haut maintenant c'est ici !
			print("\n<li><em>".date("d/m/y", $news_array[$i]['date'])."</em>&nbsp;");
			print($news_array[$i]['texte']."</li>");
		
		}
// et le reste du tableau ben il sert a rien...
return 0;
}
else
	return $news_array;
}

?>
