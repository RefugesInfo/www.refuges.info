<?php
/**********************************************************************************************
Fichiers regroupant les fonctions sur les commentaires des points
(suppression/modif/modération/création/déplacement/récupération/...)
sly 23/11/2012
**********************************************************************************************/

require_once ('config.php');
require_once ('fonctions_bdd.php');
require_once ('fonctions_gestion_erreurs.php');
require_once("fonctions_points.php");


/* 
Cette fonctions renvoi un objet avec les infos d'un commentaire et une liste des photos qui lui correspondent
si photo il y a + un timestampunix de sa date, format :
stdClass Object
(
    [id_commentaire] => 16357
    [date] => 2012-11-24 06:23:51
    [id_point] => 1
    [texte] => coucou
    [auteur] => moi
    [photo_existe] => 1
    [date_photo] => 2012-11-28
    [demande_correction] => 1
    [qualite_supposee] => 0
    [id_createur] => 3
    [date_unixtimestamp] => 1353734631
    [photo] => Array
        (
            [reduite] => /home/sites/www.refuges.info/photos_points/16357.jpeg
            [vignette] => /home/sites/www.refuges.info/photos_points/16357-vignette.jpeg
            [originale] => /home/sites/www.refuges.info/photos_points/16357-originale.jpeg
        )

)
*/
function infos_commentaire($id_commentaire)
{
  global $config;
  if (!is_numeric($id_commentaire))
    return erreur("Id de commentaire invalide : $id_commentaire");
  $res=mysql_query ("
  SELECT *,UNIX_TIMESTAMP(date) AS date_unixtimestamp
  FROM commentaires
  WHERE id_commentaire=$id_commentaire
  ");
  if (mysql_num_rows($res)!=1)
    return erreur("Le commentaire demandé est introuvable");

  $commentaire=mysql_fetch_object($res);
  if ($commentaire->photo_existe)
  {
	foreach (array("reduite", "vignette", "originale") as $taille)
	{
	if ($taille=="reduite")
		$file=$config['rep_photos_points'].$id_commentaire.".jpeg";
	else
		$file=$config['rep_photos_points'].$id_commentaire."-$taille.jpeg";
	if (is_file($file))
		$commentaire->photo[$taille]=$file;
	}
  }
return $commentaire;	
}
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
  global $config;  
  $photo_valide=False;
  $point=infos_point($commentaire->id_point);
  if ($point==-1)
    return erreur("Le commentaire ne correspond à aucun point du site");
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
    if (!isset($commentaire->date))
      $commentaire->date="NOW()";
    else
      $commentaire->date="'$commentaire->date'";
    if (!is_numeric($commentaire->qualite_supposee))
      $commentaire->qualite_supposee=0;
    if (!is_numeric($commentaire->id_createur))
      $commentaire->id_createur=0;
    if ($commentaire->demande_correction!=1)
      $commentaire->demande_correction=0;
    
    $query_insert_ajout ="
        SET
        id_point = $commentaire->id_point,
        date = $commentaire->date,
        texte = '" . mysql_real_escape_string($commentaire->texte) . "',
        auteur = '" . mysql_real_escape_string($commentaire->auteur) . "',
        demande_correction=$commentaire->demande_correction,
        id_createur=$commentaire->id_createur,
        qualite_supposee=$commentaire->qualite_supposee,
        photo_existe=$commentaire->photo_existe,
        date_photo='$commentaire->date_photo' ";
	
    // fait-on un updater ou un insert ?
    if ($mode=="modification")
      $query_finale="update commentaires $query_insert_ajout where id_commentaire=$commentaire->id_commentaire";
    else
      $query_finale="insert into commentaires $query_insert_ajout";
    
    //print($query_finale);
    $res=mysql_query($query_finale);
    if (!$res)
      return erreur("problème qui n'aurait pas dû arriver, le traitement du commentaire a foiré");
    if ($mode=="ajout")
    {
      $commentaire->id_commentaire=mysql_insert_id();
      $retour->message="commentaire ajouté";
    }
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
/*******************************************************/
// fonction qui loguera TOUT TYPE de moderation
// la plupart des champs sont connus lors de l'appel
// seul contenu est alors donné
// 14/09/07 désactivé car jamais eu de problème de récupération
// 03/08/2010 réactivée par endroit
// ~2010 redésactivée à nouveau, il faudrait refaire ça en mieux
/*******************************************************/
function log_moderation($contenu,
			$type_moderation,
			$idpoint,
			$moderateur)
			//$type_moderation=$_GET['type'],
			//$idpoint=$_GET['id_point_retour'],
			//$moderateur=$_SESSION['id_moderateur'])
{
	$query_sauvegarde="
		INSERT INTO logs_moderation
		SET 
			date_moderation=NOW(),
			id_moderateur=$moderateur,
			type_moderation='$type_moderation',
			id_point=$idpoint,
			contenu='".mysql_real_escape_string($contenu)."'";
	//mysql_query($query_sauvegarde) or die("erreur requete $query_sauvegarde");
	return true;
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

    imagejpeg($image2,$chemin_photo);//,$config['qualite_jpeg']);
    ImageDestroy($image2);
    ImageDestroy($image);
}

//**********************************************************************************************
// Récupère tous les commentaires d'un point
function infos_commentaires ($id) {
	return sql_infos ("
		SELECT *,UNIX_TIMESTAMP(date) AS date_affichage
		FROM commentaires
		WHERE id_point=$id ORDER
		BY date DESC
	");
}

/********** Liste des vignettes photos (clicable pour aller voir en grand)*************/
function infos_vignettes ($id) {
	return sql_infos ("
		SELECT *
		FROM commentaires
		WHERE id_point='$id' AND photo_existe=1
		ORDER BY date DESC
	");
}

/******************************************************
on lui passe un objet commentaire, il en retire les photos et 
retourne le nouvel objet commentaire
sly - 24-11-2012
FIXME il est possible que fusionner ça dans la grosse fonction ajouter_modifier_commentaire soit plus logique, mais son code là haut et déjà
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

  return ok("photo supprimée");;
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
	global $config;
	
	/****** On supprime les photo (de différentes taille) si elle existe ******/
	if ($commentaire->photo_existe)
		suppression_photos($commentaire);
	
	$query_delete="DELETE FROM commentaires WHERE id_commentaire=$commentaire->id_commentaire";
	$res=mysql_query($query_delete); 
	if (!$res)
		return erreur("Suppression d'un commentaire inexistant: $query_delete");
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
    global $config;

    $querycom="SELECT * FROM phpbb_topics WHERE topic_id_point=$commentaire->id_point";
    $res=mysql_query($querycom) or die("mauvaise requete: $querycom");
    $forum=mysql_fetch_object($res);

    // dabord declarer le post
    $query_insert_post="
    	INSERT INTO phpbb_posts
	SET
		topic_id=$forum->topic_id ,
		forum_id=$forum->forum_id ,
		poster_id='-1',
		post_time=$commentaire->date_unixtimestamp ,
		post_username='".mysql_real_escape_string($commentaire->auteur)."'";
    mysql_query($query_insert_post) or die("mauvaise requete: $query_insert_post");
    $postid=mysql_insert_id(); // recupere le post_id

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
    $query_post_text.=mysql_real_escape_string($commentaire->texte)."'";
    mysql_query($query_post_text) or die("mauvaise requete: $query_post_text");

    /*** remise à jour du topic ( alors ici c'est le bouquet, un champ qui stoque le premier et le dernier post ?? )***/
    $query_update_topic="UPDATE phpbb_topics
   			 SET
    				topic_last_post_id=$postid
    			 WHERE topic_id=$forum->topic_id
			 LIMIT 1";
    mysql_query($query_update_topic) or die("mauvaise requete: $query_update_topic");

    $retour=suppression_commentaire($commentaire);
    // Fin gros merdier forum
    //-------------------------

    log_moderation("Transfert du commentaire $commentaire->id_commentaire vers le forum",
    			"transfert_forum",
			$commentaire->id_point,
			$_SESSION["id_moderateur"]);
    if ($retour->erreur)
	return erreur($retour->message.", mais la copie à réussie");
    else
	return ok("Message transféré sur le forum");

}
?>