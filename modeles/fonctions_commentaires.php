<?php
/**********************************************************************************************
Fichiers regroupant les fonctions sur les commentaires des points
(suppression/modif/modération/création/déplacement/récupération/...)
sly 23/11/2012
**********************************************************************************************/

require_once ('config.php');
require_once ('fonctions_bdd.php');
require_once ('fonctions_gestion_erreurs.php');
require_once ('fonctions_points.php');

/************
Cette fonction peut sembler bourrine, mais c'est assez pratique à utiliser :
On lui passe un objet "commentaire" et soit elle le créer s'il ne dispose pas d'id_commentaire
soit elle le met à jour avec les infos qu'on lui a fourni

* Lui passer un $commentaire->photo['originale']="/chemin/de/la/photo.jpeg" et elle s'occupera de créer
les versions réduite de la photo et même de remplacer la photo si celle-ci est différente d'avant
(La photo source n'est pas effacée, à vous de le faire si elle est issue d'un téléchargement)

* Si le commentaire ne dispose pas d'un $commentaire->date, il sera mis à jour avec la date/heure actuelle

Cette fonction retourne un objet contenant :
$retour->erreur=true si un problème est survenu
avec 
$retour->message un message d'erreur explicite qui peut être fourni à l'utilisateur final

si tout c'est bien passé elle retourne :
$retour->id_commentaire (l'id du commentaire créé ou modifié)
$retour->message : un message texte compréhensible indiquant une information sur ce qui s'est passé
(exemple : la photo, trop, grosse a dû être redimensionnée)

FIXME : possibilité plus facile avec cette fonction modulaire, mais à coder quand même :
Possibilité d'ajouter une photo en provenance d'un autre site (pour éviter de faire l'upload par exemple car déjà en ligne)
************/
function modification_ajout_commentaire($commentaire)
{
  global $config,$pdo;  
  $photo_valide=False;
  $point=infos_point($commentaire->id_point);
  if ($point==-1)
    return erreur("Le commentaire ne correspond à aucun point du site","Id : \"$commentaire->id_point\" donné");
  // Test de validité, un commentaire ne peut être modifié ou ajouté que si son texte existe ou a une photo
  // On dirait que le commentaire dispose bien d'une photo
  if (isset($commentaire->photo['originale']))
  {
    if (!is_file($commentaire->photo['originale']))
      return erreur("La photo proposée ne semble pas exister ou ne nous est pas parvenue");
    $taille = getimagesize($commentaire->photo['originale']);
    // Test pour voir si la photo est bien un jpeg
    if ($taille[2] != 2)
      return erreur("La photo proposée ne semble pas être au format JPEG");
    //bien, on a une image pour ce commentaire
    $photo_valide=True;
  }
  else if (isset($commentaire->photo['reduite']))
  { // On a pas (ou plus) la photo originale, mais on a quand même la réduite
    $commentaire->photo_existe=1; // normalement, vu que l'objet n'a pas de chemin pour la photo, ça devrait déjà être 0, mais si quelqu'un veut le forcer à 1 : non
  }
  else
  {
    $commentaire->photo_existe=0; // normalement, vu que l'objet n'a pas de chemin pour la photo, ça devrait déjà être 0, mais si quelqu'un veut le forcer à 1 : non
    $commentaire->date_photo="0000-00-00"; // normalement, vu que l'objet n'a pas de chemin pour la photo, ça devrait déjà être 0, mais si quelqu'un veut le forcer à 1 : non
  }
  
	if (!$photo_valide and trim($commentaire->texte)=="")
		return erreur("Le commentaire ne contient ni photo ni texte, il n'est pas traité");
  
    // On a donc soit une photo valide, soit un texte pour le commentaire, on continue
    if (isset($commentaire->id_commentaire))
    { // On souhaite ajouter le commentaire
		$old_commentaire=infos_commentaire($commentaire->id_commentaire);
		if ($old_commentaire->erreur)
			return erreur("Une modification d'un commentaire inexistant a été demandée");
		if ($commentaire->photo['originale']!=$old_commentaire->photo['originale'])
			$ajout_photo=True;
		else
			$ajout_photo=False;
		$mode="modification";
    }
    else
		$mode="ajout";

	$traitement_photo=($photo_valide and ($ajout_photo or $mode=="ajout"));
    if ($traitement_photo)
    {
		$commentaire->photo_existe=1;
		$exif_data = @exif_read_data ($commentaire->photo['originale']);
      	$date_photos = $exif_data ['DateTimeOriginal'];
	
		// Testons si on a récupéré une date dans les infos exif de la photo
		if (isset($date_photos))
			$commentaire->date_photo=date_exif_a_mysql($date_photos);
		else
			$commentaire->date_photo="";
    }
    // Quelques choix par défaut si c'est une création et que ça n'est pas précisé
    if (!is_numeric($commentaire->qualite_supposee))
		$commentaire->qualite_supposee=0;
    if (!is_numeric($commentaire->id_createur))
		$commentaire->id_createur=0;
    if ($commentaire->demande_correction!=1)
		$commentaire->demande_correction=0;
    
    $query_insert_ajout ="
        SET
        id_point = $commentaire->id_point,";
	if ($mode=='ajout')
		$query_insert_ajout .= 'date = NOW(),' ;
    $query_insert_ajout .="
        texte = " . $pdo->quote($commentaire->texte) . ",
        auteur = " . $pdo->quote($commentaire->auteur) . ",
        demande_correction=$commentaire->demande_correction,
        id_createur=$commentaire->id_createur,
        qualite_supposee=$commentaire->qualite_supposee,
        photo_existe=$commentaire->photo_existe,
        date_photo='$commentaire->date_photo' ";
	
    // fait-on un updater ou un insert ?
    if ($mode=="modification")
      $query_finale="UPDATE commentaires $query_insert_ajout WHERE id_commentaire=$commentaire->id_commentaire LIMIT 1";
    else
      $query_finale="INSERT INTO commentaires $query_insert_ajout";
    
    if ($pdo->exec($query_finale) === FALSE)
		return erreur("problème qui n'aurait pas dû arriver, le traitement du commentaire a foiré","La requête était : $query_finale");
	else
		$commentaire->id_commentaire = $pdo->lastInsertId('commentaires_id_commentaire_seq'); // FIXME POSTGRESQL normalement c la bonne syntax compatible les 2 SGBD

    if ($mode=="ajout")
		$retour->message="commentaire ajouté";
    else
		$retour->message="commentaire modifié";
    
	$retour->erreur=False;

    // On avait une photo valide sur le disque mais il est demandé qu'il n'y en ait pas, il faut donc faire le ménage
    if ($commentaire->photo_existe==0 and $photo_valide)
		suppression_photos($commentaire);
    
    // Normalement, tout est bon ici, il ne nous reste plus qu'a gérer la photo
    if ($traitement_photo)
    {
		$photo_originale=$config['rep_photos_points'] . $commentaire->id_commentaire . "-originale.jpeg";
		$vignette_photo = $config['rep_photos_points'] . $commentaire->id_commentaire . "-vignette.jpeg";
		$image_reduite=$config['rep_photos_points'] . $commentaire->id_commentaire . ".jpeg";
		if ( ($taille[0]>$config['largeur_max_photo']) OR ($taille[1]>$config['hauteur_max_photo']))
		{
			copy($commentaire->photo['originale'],$photo_originale);
			$retour->message.=", la photo est grande (plus grande que "
				.$config['largeur_max_photo'] . "x"
				.$config['hauteur_max_photo']
				."), elle est redimensionnée";
			copy($commentaire->photo['originale'],$image_reduite);
	
			redimensionnement_photo($image_reduite);
			copy($image_reduite,$vignette_photo);
		}
		else
		{
			copy($commentaire->photo['originale'],$image_reduite);
			copy($image_reduite,$vignette_photo);
			$retour->message.=", photo ajoutée";
		}
		redimensionnement_photo($vignette_photo, 'vignette');
    }
	$retour->id_commentaire=$commentaire->id_commentaire;
	return ($retour);
}

/****************************************
Fonction qui écrit en TIMESTAMP une
date venant JJ/MM/AAAA hh:mm
qui est le format plus "humain" demandé au modérateurs lorsqu'ils 
veulent modifier la date d'un commentaire
 ***************************************/
function date_jjmmaaaa2TS($date_fr)
{
	//-----------------------
	// remplace la fonction strtotime, qui reconnait MM/JJ/AAAA
	list($jour, $mois, $annee, $heure, $minute) = split('[/ :-]', $date_fr) ;
	$ts = mktime($heure, $minute, 59, $mois, $jour, $annee);
	return ( $ts );
}

// Fonction, pour l'instant désactivée, mais qui permet, en urgence d'empêcher un internaute indélicat
// de nous remplir de commentaires
function bloquage_internaute($code="")
{
	// n'ayant pour l'instant plus de problème, je ne bloque plus personne sly 23/03/08
	return 0;
	// sinon, on refuse tout les gaoland
	$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	if (ereg("^(.*)\.rev\.gaoland\.net$",$hostname))
		return -1;
	else
		return 0;
}

function redimensionnement_photo($chemin_photo, $type = 'photo')
{
	global $config;
    $image=imagecreatefromjpeg($chemin_photo);//on chope le jpeg
    $x_image= ImageSX($image); // coord en X
    $y_image= ImageSY($image); //coord en Y

    if (($x_image/$y_image)>=($config['largeur_max_'.$type]/$config['hauteur_max_'.$type]))
		$zoom1=$config['largeur_max_'.$type]/$x_image;
    else
		$zoom1=$config['hauteur_max_'.$type]/$y_image;

    $image2=imagecreatetruecolor($x_image*$zoom1,$y_image*$zoom1);
    imagecopyresampled ($image2, $image, 0,0, 0, 0,$x_image*$zoom1 ,$y_image*$zoom1,$x_image,$y_image);

    imagejpeg($image2,$chemin_photo);
    ImageDestroy($image2);
    ImageDestroy($image);
}

/**********************************************************************************************
Récupère un ensemble de commentaires en fonction des paramètres passer comme conditions
$conditions->ids_point -> pour récupérer tous les commentaires d'un point particulier du site
$conditions->ids_commentaires -> pour récupérer les commentaires dont les ids sont au format 45 ou 78,412,4
$conditions->avec_photo -> pour ne prendre que ceux avec photo : True ou False (par défaut c'est tous)
$conditions->limite -> pour imposer une limite au cas où
A venir :
$conditions->avec_modele=False -> pour ne pas avoir les commentaires sur les modèles (si si, les modèles ont aussi leurs commentaires) par défaut : True
$conditions->ids_auteurs -> pour récupérer les commentaires dont l'auteur est id_auteur au format 4 ou 7,8,14
$conditions->auteur -> condition sur le champ "auteur" pour les utilisateurs non authentifiés
$conditions->texte -> condition sur le contenu du commentaire
$conditions->ids_polygones -> commentaires ayant eu lieu sur un point appartenant aux polygones d'id fournis

Renvoi un tableau contenant des objets commentaires sous cette forme :
stdClass Object
(
    [id_commentaire] => 16693
    [date] => 2013-02-11 17:19:50
    [id_point] => 3445
    [texte] => Une autre vue de la cabane.
blabla
    [auteur] => cassandre
    [photo_existe] => 1
    [date_photo] => 2011-11-12
    [demande_correction] => 0
    [qualite_supposee] => 0
    [id_createur] => 496
    [ts_unix_commentaire] => 1360599590
    [ts_unix_photo] => 1321052400
    [photo] => Array
        (
            [reduite] => /home/users/sly/www.refuges.info//photos_points/16693.jpeg
            [vignette] => /home/users/sly/www.refuges.info//photos_points/16693-vignette.jpeg
            [originale] => /home/users/sly/www.refuges.info//photos_points/16693-originale.jpeg
        )

    [lien_photo] => Array
        (
            [reduite] => /photos_points/16693.jpeg
            [vignette] => /photos_points/16693-vignette.jpeg
            [originale] => /photos_points/16693-originale.jpeg
        )

)
**********************************************************************************************/

function infos_commentaires ($conditions)
{
  global $pdo,$config;
  $conditions_sql="";
  
  // conditions de limite
  if (is_numeric($conditions->limite))
    $limite="LIMIT $conditions->limite";
  else
    $limite="LIMIT 100"; // limite de sécurité si on s'enballe
  
  if ($conditions->ids_commentaires!="")
    $conditions_sql.=" AND id_commentaire IN ($conditions->ids_commentaires)";
  
  if ($conditions->ids_points!="")
    $conditions_sql.=" AND id_point in ($conditions->ids_points)";

  if ($conditions->avec_photo)
    $conditions_sql.=" AND photo_existe=1";
  
  if ($conditions->ids_auteurs!="")
    $conditions_sql.=" AND id_point in ($conditions->ids_auteurs)";

  $query="SELECT *,extract('epoch' from commentaires.date) as ts_unix_commentaire,extract('epoch' from commentaires.date_photo) as ts_unix_photo
           FROM commentaires
           WHERE 1=1
             $conditions_sql
           ORDER BY commentaires.date DESC
           $limite";
  
  if ( ! ($res=$pdo->query($query))) 
    return erreur("Une erreur sur la requête est survenue $query");

  while ($commentaire = $res->fetch())
  {
    if ($commentaire->photo_existe)
    {
    	// Remplissage de l'objet avec les photos disponibles pour ce commentaire, s'il y en a et si elle existe sur le disque
    	// Le problème venant du fait que tous les commentaires n'ont pas eu leur vignette de créée, et pas tous on une photo à la taille d'origine (historique wri)
	foreach (array("reduite", "vignette", "originale") as $taille)
	{
	  if ($taille=="reduite")
	    $nom_fichier=$commentaire->id_commentaire.".jpeg";
	  else
	    $nom_fichier=$commentaire->id_commentaire."-$taille.jpeg";
	  if (is_file($config['rep_photos_points'].$nom_fichier))
	  {
	    $commentaire->photo[$taille]=$config['rep_photos_points'].$nom_fichier;
	    $commentaire->lien_photo[$taille]=$config['rep_web_photos_points'].$nom_fichier;
	  }
	}
    }
    $r [] = $commentaire;
  }
  
  return $r ;
}
// Un appel plus simple qui utilise le précédent
function infos_commentaire($id_commentaire)
{
  $conditions->ids_commentaires=$id_commentaire;
  $c=infos_commentaires ($conditions);
  if ($c->erreur)
    return erreur($c->texte);
  return $c[0];
}
/******************************************************
on lui passe un objet commentaire, il en retire les photos et 
retourne le nouvel objet commentaire
il est possible que fusionner ça dans la grosse fonction ajouter_modifier_commentaire soit plus logique, mais son code là haut et déjà
bien gros
*******************************************************/
function suppression_photos($commentaire)
{
  global $config;
  if (isset($commentaire->photo) or $commentaire->photo_existe)
  {
    $commentaire->photo_existe=0;
    if (isset($commentaire->photo))
    {
      $photos_a_supprimer=$commentaire->photo;
      unset($commentaire->photo);
    }
    
    $retour=modification_ajout_commentaire($commentaire);
    if ($retour->erreur)
      return erreur($retour->message);
    // On nous dit qu'il y a une photo mais en fait non ?
    if (isset($photos_a_supprimer))
    {
      foreach ($photos_a_supprimer as $photo)
	unlink($photo);
    }
  }
  else 
    return (erreur("pas de photo dans ce commentaire"));
  
  return ok("photo supprimée");
}

/******************************************************
on lui passe un $id_commentaire et ça supprime le commentaire et la photo

Comme vous pouvez le voir, il n'y a strictement aucune sauvegarde , c'est un peu dangereux en cas de vandalisme, 
mais tout copier à tout copier à coté, c'est lourd. Je pense évoluer vers un champ nommé "suppression" 
qui contiendra 1 ou 0. Et que l'ensemble du site ignorera ( sauf zones de maintenance ) 
On peut aller plus loin et imaginer un champ id_nouveau_commentaire qui contient 0 si c'est le commentaire actif, et X si c'est
une ancienne version du commentaire d'id X... disons pas une priorité ;-) sly - 27-06-2008 
*******************************************************/
function suppression_commentaire($commentaire)
{
	global $config,$pdo;
	
	/****** On supprime les photo (de différentes taille) si elle existe ******/
	if ($commentaire->photo_existe)
		suppression_photos($commentaire);
	
	$query_delete="DELETE FROM commentaires WHERE id_commentaire=$commentaire->id_commentaire LIMIT 1";
	$success = $pdo->exec($query_delete);
	
	if (!$success)
		return erreur("Suppression d'un commentaire inexistant",$query_delete);
	else
		return ok("Commentaire supprimé");
		
	return True; 
}

/************************************************************************
Converti d'une date au format exif (trouvée dans les photos jpeg)
vers un format MySQL
de YYYY:MM:JJ HH:mm:ss vers YYYY-MM-JJ
************************************************************************/
function date_exif_a_mysql($date_exif)
{
	$date_exif_sans_espace=str_replace(" ",":",$date_exif);
	$decoupe=explode(':',$date_exif_sans_espace);
	return("$decoupe[0]-$decoupe[1]-$decoupe[2]");
}
/*******************************************************/
// transfert le commentaire et la photo sur le forum
// la photo dans le repertoire $config['rep_forum_photos']
/*******************************************************/
function transfert_forum($commentaire)
{
  global $config,$pdo;
  
  $querycom="SELECT * FROM phpbb_topics WHERE topic_id_point=$commentaire->id_point";
  
  $res = $pdo->query($querycom);
  $forum = $res->fetch() ;
  
  // dabord declarer le post
  $query_insert_post="
  INSERT INTO phpbb_posts
  SET
  topic_id=$forum->topic_id ,
  forum_id=$forum->forum_id ,
    poster_id='-1',
    post_time=$commentaire->date_unixtimestamp ,
    post_username=".$pdo->quote($commentaire->auteur);
  
  if (!$pdo->exec($query_insert_post))
    return erreur("Transfert vers le forum échoué",$query_insert_post);
  $postid = $pdo->lastInsertId('phpbb_posts_post_id_seq'); //FIXME POSTGRESQL ca devrait etre bon en PG mais mefiance...
  
  // ensuite entrer le texte du post
  // la folie bbcode: generer un rand sur 10 chiffres, et l'utiliser dans les balises...
  $bbcodeuid = mt_rand( 1000000000, 9999999999 );
  $query_post_text="
  INSERT INTO phpbb_posts_text
  SET
    post_id=$postid,
    bbcode_uid=$bbcodeuid, 
    post_text='";
  if ($commentaire->photo_existe) 
  {
    // insere la balise bbcode pour la photo
    $query_post_text.="[img:$bbcodeuid]".$config['rep_web_forum_photos'].$commentaire->id_commentaire.".jpeg[/img:$bbcodeuid]\n";
    // et deplace la photo
    rename($commentaire->photo['reduite'],$config['rep_forum_photos'].$commentaire->id_commentaire.".jpeg");
  }
  // insere le texte du comment
  $query_post_text.=$pdo->quote($commentaire->texte);
  
  $pdo->exec($query_post_text);


    /*** remise à jour du topic ( alors ici c'est le bouquet, un champ qui stoque le premier et le dernier post ?? )***/
    $query_update_topic="UPDATE phpbb_topics
    SET
      topic_last_post_id=$postid
      WHERE topic_id=$forum->topic_id
    LIMIT 1";
    
    $pdo->exec($query_update_topic);

    $retour=suppression_commentaire($commentaire);
    
    if ($retour->erreur)
      return erreur($retour->message.", mais la copie à réussie");
    else
      return ok("Message transféré sur le forum");

}
/************************************************************************
Derniers messages du forum
$conditions->limite : nombre maximum de messages retournés
$conditions->ordre : exempple "ORDER BY date DESC"
$conditions->ids_forum : (5 ou 4,7,8)
$conditions->sauf_ids_forum : (5 ou 4,7,8)
************************************************************************/
function messages_du_forum($conditions)
{
  global $pdo;
  if (isset($conditions->ids_forum))
    $quels_ids="AND phpbb_topics.forum_id in ($conditions->ids_forum)";
  if (isset($conditions->sauf_ids_forum))
    $quels_ids="AND phpbb_topics.forum_id not in ($conditions->sauf_ids_forum)";
    
    // Il y avait aussi ça mais je ne sais pas pourquoi ? sly 02-11-2008
    //AND phpbb_topics.topic_first_post_id < phpbb_topics.topic_last_post_id
    // réponse :  pour qu'il y ait > 1 post. cad forum non vide. sinon last=first.
    $query_messages_du_forum=
		"SELECT
			max(phpbb_posts.post_time) AS date,
			phpbb_posts.topic_id,
			phpbb_topics.topic_title,
			max(phpbb_posts_text.post_id) AS post_id
		FROM phpbb_posts_text, phpbb_topics, phpbb_posts
    		WHERE
    		phpbb_posts_text.post_text!=''
		AND phpbb_topics.topic_id = phpbb_posts.topic_id
		AND phpbb_posts_text.post_id = phpbb_posts.post_id
		$quels_ids
		GROUP BY phpbb_posts.topic_id,phpbb_topics.topic_title
		$conditions->ordre
		LIMIT $conditions->limite";

    if (! ($res=$pdo->query($query_messages_du_forum)))
    	return erreur("Impossible d'obtenir les derniers messages du forum".$query_messages_du_forum);
    else
      return $res->fetch();
}
?>