<?php
/**********************************************************************************************
Fichiers regroupant les fonctions sur les commentaires des points
(suppression/modif/modération/création/déplacement/récupération/...)
sly 23/11/2012
**********************************************************************************************/

require_once ("config.php");
require_once ('fonctions_bdd.php');
require_once ('fonctions_gestion_erreurs.php');
require_once ('fonctions_points.php');


/**********************************************************************************************
Récupère un ensemble de commentaires en fonction des paramètres passer comme conditions
$conditions->ids_points -> pour récupérer tous les commentaires d'un point particulier du site
$conditions->ids_commentaires -> pour récupérer les commentaires dont les ids sont au format 45 ou 78,412,4
$conditions->avec_photo -> pour ne prendre que ceux avec photo : True ou False (par défaut c'est tous)
$conditions->limite -> pour imposer une limite au cas où

$conditions->avec_modele=False -> pour ne pas avoir les commentaires sur les modèles (si si, les modèles ont aussi leurs commentaires) par défaut : True
$conditions->ids_auteurs -> pour récupérer les commentaires dont l'auteur est id_auteur au format 4 ou 7,8,14
$conditions->auteur -> condition sur le champ "auteur" pour les utilisateurs non authentifiés
$conditions->texte -> condition sur le contenu du commentaire
$conditions->avec_infos_point=True -> renvoi des informations simples du point auquel ce commentaire se rapporte
$conditions->demande_correction=True -> pour récupérer les commentaires en attente de correction (demande_correction=1 ou qualite_supposee<0)

$conditions->avec_commentaires_modele=True -> Très spécifique, pour avoir aussi les commentaires sur les modeles de points, le par défaut est non mais ça n'a de sens qu'avec $conditions->avec_infos_point=True
$conditions->avec_points_censure=True : Par défaut, False : les commentaires des points censurés ne sont pas retournés

!! A CODER ? !!
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
  
	if (isset($conditions->ids_points))
		if (!verif_multiples_entiers($conditions->ids_points))
			return erreur("Le paramètre donné pour les ids des points n'est pas valide","Reçu : $conditions->ids_points");
      
	if (isset($conditions->ids_commentaires))
		if (!verif_multiples_entiers($conditions->ids_commentaires))
			return erreur("Le paramètre donné pour les ids n'est pas valide","Reçu : $conditions->ids_commentaires");
 
	if ($conditions->ids_commentaires!="")
		$conditions_sql.=" AND id_commentaire IN ($conditions->ids_commentaires)";
  
	if ($conditions->ids_points!="")
		$conditions_sql.=" AND id_point IN ($conditions->ids_points)";

	if ($conditions->avec_photo)
		$conditions_sql.=" AND photo_existe=1";
  
	if ($conditions->ids_auteurs!="")
		$conditions_sql.=" AND id_point in ($conditions->ids_auteurs)";
  
	if ($conditions->demande_correction)
		$conditions_sql.=" AND (demande_correction!=0 OR qualite_supposee<0)";
  
	// On veut des informations supplémentaire auquel le commentaire se rapporte (nom du point, id, "massif" auquel il appartient)
	// FIXME? : usine à gaz, ça revient presque à faire la reqûete pour récupérer un point. Mais peut-être pas non plus à fusionner sinon méga usine à gaz
	// jmb ca fait un job de trop pour cette fonction. faudrait pourtant bien appeler infos_points pour etre coherent.
	// ou alors que cette fonction ET infos _points appellent une fonction d'appartenance. Le code ne serait plus en double.
	// ca rajoute une fonction, mais ca reduit ici, et ca reduit la bas.
	// Faut reduire la taille des briques. Cette fonctions donne des infos sur les commentaires, pas sur les massifs.
	if ($conditions->avec_infos_point OR $conditions->avec_commentaires_modele)
	{
            $table_en_plus=",points,point_type,points_gps LEFT JOIN polygones ON (ST_Within(points_gps.geom,polygones.geom) AND polygones.id_polygone_type=".$config['id_massif'].")";

            $condition_en_plus.=" AND points.id_point=commentaires.id_point 
                     AND points_gps.id_point_gps=points.id_point_gps
                     AND point_type.id_point_type=points.id_point_type";
            $champ_en_plus.=",points.*,point_type.*,";
            // Pour éviter de mettre "*" sinon, en cas de demande sur les polygones contenant le point dont le commentaire est demandée
            // ça récupère toute la géométrie pour rien, et parfois, ça fait du grabuge
            $champ_en_plus.=colonnes_table('polygones',False);

            if (!$conditions->avec_commentaires_modele)
                    $condition_en_plus.=" AND modele!=1 ";
            if (!$conditions->avec_points_censure)
                 $condition_en_plus.=" AND (censure=False) "; 
	}
   
	$query="SELECT 
             extract('epoch' from commentaires.date) as ts_unix_commentaire,
             extract('epoch' from commentaires.date_photo) as ts_unix_photo,
             commentaires.*
             $champ_en_plus
           FROM commentaires$table_en_plus
           WHERE 1=1
             $conditions_sql$condition_en_plus
           ORDER BY commentaires.date DESC
           $limite";

	if ( ! ($res=$pdo->query($query))) 
		return erreur("Une erreur sur la requête est survenue",$query);

	//jmb: renvoie un tablo vide, au lieu d'un NULL si pas de comment, => les appelants n'ont plus a tester.
	$commentaires = array() ;
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
			// Ce cas peut exister quand la photo originale est la même que la réduite (déjà suffisament petite, ou raisons historiques)
			if (!isset($commentaire->photo['originale']))
			{
				$commentaire->photo['originale']=$commentaire->photo['reduite'];
				$commentaire->lien_photo['originale']=$commentaire->lien_photo['reduite'];
			}
		}
		$commentaire->date_formatee=date("d/m/y", $commentaire->ts_unix_commentaire);
		$commentaires [] = $commentaire;
	}
  
	return $commentaires ;
}


// Un appel plus simple qui utilise le précédent
// jmb , comme infos_point, je vois pas l'interet, les fonctions pointS et sommentaireS savent gerer les cas unique
// sly : totalement d'accord sur le principe, j'ai juste voulu reproduire l'appel historique qui récupére un commentaire à partir de son id
function infos_commentaire($id_commentaire,$meme_si_censure=False)
{
  $conditions = new stdClass;
  $conditions->ids_commentaires=$id_commentaire;
  $conditions->avec_infos_point=True;
  $conditions->avec_points_censure=$meme_si_censure;
  $c=infos_commentaires ($conditions);
  if ($c->erreur)
    return erreur($c->texte);
  if (count($c)!=1)
      return erreur("un seul commentaire demandé mais $c trouvés");
  return $c[0];
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
    global $config,$pdo;  
    $retour = new stdClass;
    $photo_valide=False; 
    
    if ($commentaire->id_point>=0) // Si négatif, c'est une "news générale"
    {
            $point=infos_point($commentaire->id_point,True);
            if ($point->erreur)
                    return erreur("Le commentaire ne peut être ajouté car : $point->message","Id du point: \"$commentaire->id_point\"");
    }
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
            // On a pas (ou plus) la photo originale, mais on a quand même la réduite
            $commentaire->photo_existe=1; // normalement, vu que l'objet n'a pas de chemin pour la photo, ça devrait déjà être 0, mais si quelqu'un veut le forcer à 1 : non
    else
            $commentaire->photo_existe=0; 
    
    if (!$photo_valide and trim($commentaire->texte)=="")
            return erreur("Le commentaire ne contient ni photo ni texte, il n'est pas traité");
    
    // On a donc soit une photo valide, soit un texte pour le commentaire, on continue
    if (isset($commentaire->id_commentaire))
    { // On souhaite modifier le commentaire
            $old_commentaire=infos_commentaires($commentaire->id_commentaire,True);
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
            // jmb tant que les photos ne sont QUE dans les commentaires
            // jmb abandon de date_exif_a_mysql, pas utilisée ailleurs et ultra courte ?
            if (isset($date_photos))
                    $commentaire->date_photo = str_replace(':','/', strstr($date_photos,' ',true) ) ;
    }
    if ($commentaire->demande_correction!=1) // ??
            $commentaire->demande_correction=0;
  
    // reparation crado:
    isset($commentaire->id_point) ? $champs_sql['id_point']=$commentaire->id_point: false ;
    isset($commentaire->texte) ? $champs_sql['texte']=$pdo->quote($commentaire->texte):false;
    isset($commentaire->auteur) ? $champs_sql['auteur']=$pdo->quote($commentaire->auteur):false;
    isset($commentaire->demande_correction) ? $champs_sql['demande_correction']=$commentaire->demande_correction:false;
    isset($commentaire->id_createur) ? $champs_sql['id_createur']=$commentaire->id_createur:false;
    isset($commentaire->qualite_supposee) ? $champs_sql['qualite_supposee']=$commentaire->qualite_supposee:false;
    isset($commentaire->photo_existe) ? $champs_sql['photo_existe']=$commentaire->photo_existe:false;
    
    
    if (isset($date_photos))
            $champs_sql['date_photo']=$pdo->quote($commentaire->date_photo);
    
    // fait-on un update ou un insert ?
    // FIXME  faire un upsert. voir "requete_modification_ou_ajout_generique"
    if ($mode=="modification")
            $query_finale=requete_modification_ou_ajout_generique('commentaires',$champs_sql,'update',"id_commentaire=$commentaire->id_commentaire");
    else
            $query_finale=requete_modification_ou_ajout_generique('commentaires',$champs_sql,'insert');
    
    if (!$pdo->exec($query_finale))
            return erreur("problème qui n'aurait pas dû arriver, le traitement du commentaire a foiré","La requête était : $query_finale");
    elseif ($mode!="modification")
            $commentaire->id_commentaire = $pdo->lastInsertId();
    
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

/******************************************************
on lui passe un objet commentaire, il en retire les photos et 
retourne le nouvel objet commentaire
il est possible que fusionner ça dans la grosse fonction ajouter_modifier_commentaire soit plus logique, mais son code là haut et déjà
bien gros
On peut "forcer" la suppression de la photo, même si cela pourait produire un commentaire sans photos et sans texte
Ce n'est pas souhaitable lorsque un commentaire est modifié en vu d'être gardé, mais si le but c'est au final la suppression
du commentaire, ça l'est.
*******************************************************/
function suppression_photos($commentaire,$force=False)
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
    if (!$force)
    {
      $retour=modification_ajout_commentaire($commentaire);
    if ($retour->erreur)
      return erreur($retour->message); // Sans doute que supprimer sa photo en ferait un commentaire totalement vide, ce n'est pas un bug, mais on ne fait rien quand même
    }
    // On nous dit qu'il y a une photo mais en fait non ?
    if (isset($photos_a_supprimer))
      foreach ($photos_a_supprimer as $photo)
	if (is_file($photo))
	  unlink($photo);
  }
  else 
    return erreur("pas de photo dans ce commentaire");
  
  return ok("photo supprimée");
}

/******************************************************
on lui passe un $commentaire et ça supprime le commentaire et la photo

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
		$retour=suppression_photos($commentaire,True);
	$query_delete="DELETE FROM commentaires WHERE id_commentaire=$commentaire->id_commentaire";
	$success = $pdo->exec($query_delete);
	
	if (!$success)
		return erreur("Suppression d'un commentaire inexistant",$query_delete);
	else
		return ok("Commentaire supprimé");
		
	return True; 
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
			(topic_id,forum_id,poster_id,post_time,post_username)
		VALUES
			($forum->topic_id ,$forum->forum_id ,-1,$commentaire->ts_unix_commentaire , ".$pdo->quote(substr($commentaire->auteur,0,23)).")";
  
	if (!$pdo->exec($query_insert_post))
		return erreur("Transfert vers le forum échoué",$query_insert_post);
	$postid = $pdo->lastInsertId();
  
	// ensuite entrer le texte du post
	// la folie bbcode: generer un rand sur 10 chiffres, et l'utiliser dans les balises...
	$bbcodeuid = mt_rand( 1000000000, 9999999999 );
	if ($commentaire->photo_existe) 
	{
		// insere la balise bbcode pour la photo
		$commentaire->texte.="\n[img:$bbcodeuid]http://".$config['nom_hote'].$config['rep_web_forum_photos'].$commentaire->id_commentaire.".jpeg[/img:$bbcodeuid]\n";
		// et deplace la photo, question historique, on peut avoir la réduite et/ou l'originale
		if (isset($commentaire->photo['reduite']))
			$photo_a_conserver=$commentaire->photo['reduite'];
		elseif (isset($commentaire->photo['originale']))
			$photo_a_conserver=$commentaire->photo['originale'];
     
		copy($photo_a_conserver,$config['rep_forum_photos'].$commentaire->id_commentaire.".jpeg");
	}
	$query_post_text="
		INSERT INTO phpbb_posts_text
			(post_id,bbcode_uid,post_text)
		VALUES
			($postid,$bbcodeuid,".$pdo->quote($commentaire->texte).")";
  
	$res=$pdo->exec($query_post_text);
	if (!$res)
		return erreur("Ajout du commentaire dans le forum échouée",$query_post_text);

    /*** remise à jour du topic ( alors ici c'est le bouquet, un champ qui stoque le premier et le dernier post ?? )***/
	$query_update_topic="UPDATE phpbb_topics
			SET
				topic_last_post_id=$postid
			WHERE topic_id=$forum->topic_id";
    
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
$conditions->ordre : exemple "ORDER BY date"
$conditions->ids_forum : (5 ou 4,7,8)
$conditions->sauf_ids_forum : (5 ou 4,7,8)
************************************************************************/
// jmb: return un tableau vide au lieu d'un undefined si aucun message
function messages_du_forum($conditions)
{
  global $pdo; $messages_du_forum= array();
  $quels_ids="";
  if (isset($conditions->ids_forum))
    $quels_ids.="AND phpbb_topics.forum_id in ($conditions->ids_forum)";
  if (isset($conditions->sauf_ids_forum))
    $quels_ids.="AND phpbb_topics.forum_id not in ($conditions->sauf_ids_forum)";
  if ( !isset($conditions->ordre))
    $conditions->ordre="ORDER BY date DESC";
  
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
    	return erreur("Impossible d'obtenir les derniers messages du forum",$query_messages_du_forum);
    else
    {
		while ($message_du_forum = $res->fetch())
			$messages_du_forum[]=$message_du_forum;
    }
    return $messages_du_forum;

}

?>