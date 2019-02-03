<?php
/**********************************************************************************************
Fichiers regroupant les fonctions sur les commentaires des points
(suppression/modif/modération/création/déplacement/récupération/...)
sly 23/11/2012
**********************************************************************************************/

require_once ('config.php');
require_once ('bdd.php');
require_once ('gestion_erreur.php');
require_once ('point.php');
require_once ('mise_en_forme_texte.php');


/**********************************************************************************************
Récupère un ensemble de commentaires en fonction des paramètres passer comme conditions
$conditions->ids_points -> pour récupérer tous les commentaires d'un ou plusieurs point(s) particulier(s) du site format 45 ou 78,412,4
$conditions->ids_commentaires -> pour récupérer les commentaires dont les ids sont au format 45 ou 78,412,4
$conditions->avec_photo -> pour ne prendre que ceux avec photo : True ou False (par défaut c'est tous)
$conditions->limite -> pour imposer une limite au cas où

$conditions->avec_modele=False -> pour ne pas avoir les commentaires sur les modèles (si si, les modèles ont aussi leurs commentaires) par défaut : True
$conditions->ids_createurs_commentaires -> pour récupérer les commentaires de(s) l'auteur(s) d'id donnés au format 4 ou 7,8,14
$conditions->auteur_commentaire -> condition sur le champ "auteur_commentaire" pour les utilisateurs non authentifiés FIXME: un peu ridicule, ça devrait marcher dans tous les cas, anonyme ou authentifié
$conditions->texte -> condition sur le contenu du commentaire
$conditions->avec_infos_point=True -> renvoi des informations simples du point auquel ce commentaire se rapporte
$conditions->demande_correction=True -> pour récupérer les commentaires en attente de correction (demande_correction=1 ou -1)

$conditions->avec_commentaires_modele=True -> Très spécifique, pour avoir aussi les commentaires sur les modeles de points, le par défaut est non mais ça n'a de sens qu'avec $conditions->avec_infos_point=True
$conditions->avec_points_en_attente=True : Par défaut, False : les commentaires des points en attente ne sont pas retournés

$conditions->ids_polygones -> commentaires ayant eu lieu sur un point appartenant aux polygones d'id fournis


Renvoi un tableau contenant des objets commentaires sous cette forme :
stdClass Object
(
    [id_commentaire] => 16693
    [date] => 2013-02-11 17:19:50
    [id_point] => 3445
    [texte] => Une autre vue de la cabane.
blabla
    [auteur_commentaire] => cassandre
    [photo_existe] => 1
    [date_photo] => 2011-11-12
    [demande_correction] => 0
    [id_createur_commentaire] => 496 --> 0 si non authentifié
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
  global $config_wri,$pdo;
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

  if ($conditions->ids_createurs_commentaires!="")
    $conditions_sql.=" AND id_createur_commentaire in ($conditions->ids_createurs_commentaires)";

  if ($conditions->demande_correction)
    $conditions_sql.=" AND demande_correction!=0";

  // On veut des informations supplémentaire auquel le commentaire se rapporte (nom du point, id, "massif" auquel il appartient)
  // FIXME? : usine à gaz, ça revient presque à faire la reqûete pour récupérer un point. Mais peut-être pas non plus à fusionner sinon méga usine à gaz
  // jmb ca fait un job de trop pour cette fonction. faudrait pourtant bien appeler infos_points pour etre coherent.
  // ou alors que cette fonction ET infos _points appellent une fonction d'appartenance. Le code ne serait plus en double.
  // ca rajoute une fonction, mais ca reduit ici, et ca reduit la bas.
  // Faut reduire la taille des briques. Cette fonctions donne des infos sur les commentaires, pas sur les massifs.
  if ($conditions->avec_infos_point OR $conditions->avec_commentaires_modele OR isset($conditions->ids_polygones))
  {
            $table_en_plus=",points,point_type,points_gps LEFT JOIN polygones ON (ST_Within(points_gps.geom,polygones.geom) AND polygones.id_polygone_type=".$config_wri['id_massif'].")";

            $condition_en_plus.=" AND points.id_point=commentaires.id_point
                     AND points_gps.id_point_gps=points.id_point_gps
                     AND point_type.id_point_type=points.id_point_type";

            $champ_en_plus.=",points.*,point_type.*,";
            // Pour éviter de mettre "*" sinon, en cas de demande sur les polygones contenant le point dont le commentaire est demandée
            // ça récupère toute la géométrie pour rien, et parfois, ça fait du grabuge
            $champ_en_plus.=colonnes_table('polygones',False);

            if (!$conditions->avec_commentaires_modele)
                    $condition_en_plus.=" AND modele!=1 ";
            if (!$conditions->avec_points_en_attente)
                 $condition_en_plus.=" AND (en_attente=False) ";
            if (isset($conditions->ids_polygones))
                 $condition_en_plus.=" AND polygones.id_polygone IN ($conditions->ids_polygones) ";
  }

  $query="SELECT
             extract('epoch' from commentaires.date) as ts_unix_commentaire,
             extract('epoch' from commentaires.date_photo) as ts_unix_photo,
             commentaires.*,COALESCE(phpbb3_users.username,auteur_commentaire) as auteur_commentaire
             $champ_en_plus
             FROM commentaires LEFT join phpbb3_users on commentaires.id_createur_commentaire = phpbb3_users.user_id$table_en_plus
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
        if (is_file($config_wri['rep_photos_points'].$nom_fichier))
        {
          $commentaire->photo[$taille]=$config_wri['rep_photos_points'].$nom_fichier;
          $commentaire->lien_photo[$taille]=$config_wri['rep_web_photos_points'].$nom_fichier
            .'?'.filemtime($commentaire->photo[$taille]); // Permet de recharger si on bascule laphoto par exemple
        }
      }
      // Ce cas peut exister quand la photo originale est la même que la réduite (déjà suffisament petite, ou raisons historiques)
      if (!isset($commentaire->photo['originale']) and isset($commentaire->photo['reduite']))
      {
        $commentaire->photo['originale']=$commentaire->photo['reduite'];
        $commentaire->lien_photo['originale']=$commentaire->lien_photo['reduite'];
      }
    }
    //FIXME sly 12/2016: question rangement propre, il ne devrait pas appartenir au modèle de faire de la mise en forme
    $commentaire->date_formatee=date("d/m/y", $commentaire->ts_unix_commentaire);
    
    // phpBB intègre un nom d'utilisateur dans sa base après avoir passé un htmlentities, pour les users connectés
    if (isset($commentaire->id_createur_commentaire))
        $commentaire->auteur_commentaire=html_entity_decode($commentaire->auteur_commentaire);
    $commentaires [] = $commentaire;
  }

  return $commentaires ;
}


// Un appel plus simple qui utilise le précédent
// jmb , comme infos_point, je vois pas l'interet, les fonctions pointS et sommentaireS savent gerer les cas unique
// sly : totalement d'accord sur le principe, j'ai juste voulu reproduire l'appel historique qui récupére un commentaire à partir de son id
function infos_commentaire($id_commentaire,$meme_si_en_attente=False)
{
  $conditions = new stdClass;
  $conditions->ids_commentaires=$id_commentaire;
  $conditions->avec_infos_point=True;
  $conditions->avec_points_en_attente=$meme_si_en_attente;
  $c=infos_commentaires ($conditions);
  if ($c->erreur)
    return erreur($c->texte);
  if (count($c)!=1)
      return erreur("un commentaire demandé mais ".count($c)." trouvés");
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
    global $config_wri,$pdo;
    $retour = new stdClass;
    $photo_valide=False;

    $point=infos_point($commentaire->id_point,True);
    if ($point->erreur)
            return erreur("Le commentaire ne peut être ajouté car : $point->message","Id du point: \"$commentaire->id_point\"");
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
            $ajout_photo=!$commentaire->photo['originale'];
            $mode="modification";
    }
    else
            $mode="ajout";

    $traitement_photo=($photo_valide and ($ajout_photo or $mode=="ajout"));
    if ($traitement_photo)
    {
            $commentaire->photo_existe=1;
            $exif_data = @exif_read_data ($commentaire->photo['originale']);
            $date_photo = $exif_data ['DateTimeOriginal'];

            // Testons si on a récupéré une date dans les infos exif de la photo
            // jmb tant que les photos ne sont QUE dans les commentaires
            // certains appareils photo pas à l'heure enregistrent quand même une date parfois au format "0000:00:00 00:00:00" qui est manifestement invalide, j'ajoute un test plus poussé (mais un peu compliqué) pour éviter aussi les 32 Mars
            // tout autant que les 00000000000 ou n'importe quoi qui ne ressemble pas à "2014:04:14 12:45:78" -- sly
            if (preg_match('/^([0-9]{4}):([0-9]{2}):([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})$/', $date_photo, $m) == 1 && checkdate($m[2], $m[3], $m[1]))
                    $commentaire->date_photo = "$m[1]-$m[2]-$m[3] $m[4]:$m[5]:$m[6]";
    }

    // Rotation manuelle des photos
    if ($_REQUEST['rotation']) {
        $nom_fichier = $config_wri['rep_photos_points'].$_REQUEST['id_commentaire'].".jpeg";
        $image=imagecreatefromjpeg($nom_fichier);//on chope le jpeg
        $image = imagerotate ($image, $_REQUEST['rotation'], 0); // On le fait tourner
        imagejpeg($image,$nom_fichier);// On l'écrit sur le disque
    }

    // reparation crado:
    // FIXME, tout correspond, y'a pas moyen de faire un foreach sur $commentaire et remplir les champs SQL ?
    isset($commentaire->id_point) ? $champs_sql['id_point']=$commentaire->id_point: false ;
    isset($commentaire->texte) ? $champs_sql['texte']=$pdo->quote($commentaire->texte):false;
    isset($commentaire->auteur_commentaire) ? $champs_sql['auteur_commentaire']=$pdo->quote($commentaire->auteur_commentaire):false;
    isset($commentaire->id_createur_commentaire) ? $champs_sql['id_createur_commentaire']=$commentaire->id_createur_commentaire:false;
    isset($commentaire->photo_existe) ? $champs_sql['photo_existe']=$commentaire->photo_existe:false;

    if (is_numeric($commentaire->demande_correction))
        $champs_sql['demande_correction']=$commentaire->demande_correction;

    if (isset($commentaire->date_photo))
            $champs_sql['date_photo']=$pdo->quote($commentaire->date_photo);

    // fait-on un update ou un insert ?
    // FIXME  faire un upsert. voir "requete_modification_ou_ajout_generique"
    if ($mode=="modification")
            $query_finale=requete_modification_ou_ajout_generique('commentaires',$champs_sql,'update',"id_commentaire=$commentaire->id_commentaire");
    else
            $query_finale=requete_modification_ou_ajout_generique('commentaires',$champs_sql,'insert');

    if (!$pdo->exec($query_finale))
            return erreur("Problème qui n'aurait pas dû arriver, le traitement du commentaire a foiré","La requête était : $query_finale");
    elseif ($mode!="modification")
            $commentaire->id_commentaire = $pdo->lastInsertId();

    if ($mode=="ajout")
            $retour->message="Commentaire ajouté";
    else
            $retour->message="Commentaire modifié";

    $retour->erreur=False;

    // On avait une photo valide sur le disque mais il est demandé qu'il n'y en ait pas, il faut donc faire le ménage
    if ($commentaire->photo_existe==0 and $photo_valide)
            suppression_photos($commentaire);

    // Normalement, tout est bon ici, il ne nous reste plus qu'a gérer la photo
    if ($traitement_photo)
    {
            $photo_originale=$config_wri['rep_photos_points'] . $commentaire->id_commentaire . "-originale.jpeg";
            $vignette_photo = $config_wri['rep_photos_points'] . $commentaire->id_commentaire . "-vignette.jpeg";
            $image_reduite=$config_wri['rep_photos_points'] . $commentaire->id_commentaire . ".jpeg";
            if ( ($taille[0]>$config_wri['largeur_max_photo']) OR ($taille[1]>$config_wri['hauteur_max_photo']))
            {
                    copy($commentaire->photo['originale'],$photo_originale);
                    $retour->message.=", la photo est grande (plus grande que "
                    .$config_wri['largeur_max_photo'] . "x"
                    .$config_wri['hauteur_max_photo']
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
  global $config_wri;
    $image=imagecreatefromjpeg($chemin_photo);//on chope le jpeg

    // Detect orientation
    $codes_angles = [
        3 => 180,
        6 => -90,
        8 =>  90,
    ];
    $exif_data = @exif_read_data ($chemin_photo);
    $angle = @$codes_angles [$exif_data ['Orientation']];
    if ($angle)
        $image = imagerotate ($image, $angle, 0);

    $x_image= ImageSX($image); // coord en X
    $y_image= ImageSY($image); //coord en Y

    if (($x_image/$y_image)>=($config_wri['largeur_max_'.$type]/$config_wri['hauteur_max_'.$type]))
    $zoom1=$config_wri['largeur_max_'.$type]/$x_image;
    else
    $zoom1=$config_wri['hauteur_max_'.$type]/$y_image;

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
  global $config_wri;
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
  global $config_wri,$pdo;

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
// la photo dans le repertoire $config_wri['rep_forum_photos']
/*******************************************************/
function transfert_forum($commentaire)
{
  global $config_wri;
  
  if ($commentaire->photo_existe)
  {
    // insere la balise bbcode pour la photo
    $commentaire->texte.="\n[img]".$config_wri['rep_web_forum_photos'].$commentaire->id_commentaire.".jpeg[/img]";
    // et deplace la photo, question historique, on peut avoir la réduite et/ou l'originale
    if (isset($commentaire->photo['reduite']))
      $photo_a_conserver=$commentaire->photo['reduite'];
    elseif (isset($commentaire->photo['originale']))
      $photo_a_conserver=$commentaire->photo['originale'];

    // On pourrait se dire que déplacer c'est plus simple. Oui, en effet, mais je préfère profiter de la fonction "suppression_commentaire" toute faite. Et donc faire une copie à cet endroit.
    copy($photo_a_conserver,$config_wri['rep_forum_photos'].$commentaire->id_commentaire.".jpeg");
  }

// note sly 17/08/2013 : j'ajoute un "_" à la suite du nom de l'auteur, c'est un peu curieux,
// mais ça permet de réduire les chances qu'on le confonde avec un utilisateur du forum portant le même nom exactement
// de plus, toute action de modération sort un message d'erreur indiquant "utilisateur existe déjà, merci d'en choisir un autre"
  $auteur = 'Anonyme';
  if ($commentaire->auteur_commentaire)
    $auteur = substr($commentaire->auteur_commentaire,0,22).'_';
  while (strlen($auteur) < 3)  // La longueur minimum requise par PhpBB est de 3
    $auteur .= '_';

  // On appelle la fonction du forum qui cree un post
  forum_submit_post ([
    'action' => 'reply',
    'topic_id' => $commentaire->topic_id,
    'topic_title' => 'Transféré de la fiche',
    'message' => $commentaire->texte,
    'topic_poster' => $commentaire->id_createur_commentaire, // Si l'auteur était connecté, on garde l'ID
    'username' => $auteur,
    'post_time' => strtotime ($commentaire->date), // Recalcule suivant la timezone
  ]);

  // On s'occupe du commentaire
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
    $quels_ids.="AND phpbb3_topics.forum_id in ($conditions->ids_forum)";
  if (isset($conditions->sauf_ids_forum))
    $quels_ids.="AND phpbb3_topics.forum_id not in ($conditions->sauf_ids_forum)";
  if ( !isset($conditions->ordre))
    $conditions->ordre="ORDER BY date DESC";

    // Il y avait aussi ça mais je ne sais pas pourquoi ? sly 02-11-2008
    //AND phpbb_topics.topic_first_post_id < phpbb_topics.topic_last_post_id
    // réponse :  pour qu'il y ait > 1 post. cad forum non vide. sinon last=first.
    $query_messages_du_forum=
    "SELECT
      max(phpbb3_posts.post_time) AS date,
      phpbb3_posts.topic_id,
      phpbb3_topics.topic_title,
      max(phpbb3_posts.post_id) AS post_id
    FROM phpbb3_topics, phpbb3_posts
        WHERE
        phpbb3_posts.post_text!=''
    AND phpbb3_topics.topic_id = phpbb3_posts.topic_id
    $quels_ids
    GROUP BY phpbb3_posts.topic_id,phpbb3_topics.topic_title
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
