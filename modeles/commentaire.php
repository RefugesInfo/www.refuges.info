<?php
/**********************************************************************************************
Fichiers regroupant les fonctions sur les commentaires des points
(suppression/modif/modération/création/déplacement/récupération/...)
sly 23/11/2012
**********************************************************************************************/

require_once ('bdd.php');
require_once ('point.php');
require_once ('mise_en_forme_texte.php');
require_once ('utilisateur.php');


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
$conditions->demande_correction=True -> pour récupérer les commentaires en attente de correction (demande_correction!=0)

$conditions->avec_commentaires_modele=True -> Très spécifique, pour avoir aussi les commentaires sur les modeles de points, le par défaut est non mais ça n'a de sens qu'avec $conditions->avec_infos_point=True
$conditions->avec_points_caches=True : Par défaut, False : les commentaires des points cachés ne sont pas retournés

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
  $conditions_sql=$condition_en_plus=$champ_en_plus=$table_en_plus="";

  // conditions de limite
  if (!empty($conditions->limite) and est_entier_positif($conditions->limite))
    $limite="LIMIT $conditions->limite";
  else
    $limite="LIMIT 200"; // limite de sécurité si on a rien spécifié comme limite

  if (!empty($conditions->ids_points))
    if (!verif_multiples_entiers($conditions->ids_points))
      return erreur("Le paramètre donné pour les ids des points dont on veut les commentaires n'est pas valide. Reçu : $conditions->ids_points");
    else
      $conditions_sql.=" AND id_point IN ($conditions->ids_points)";

  if (!empty($conditions->ids_commentaires))
    if (!verif_multiples_entiers($conditions->ids_commentaires))
      return erreur("Le paramètre donné pour les ids des commentaires n'est pas valide. Reçu : $conditions->ids_commentaires");
    else
      $conditions_sql.=" AND id_commentaire IN ($conditions->ids_commentaires)";

  if (!empty($conditions->avec_photo))
    $conditions_sql.=" AND photo_existe=1";

  if (!empty($conditions->ids_createurs_commentaires))
    if (!verif_multiples_entiers($conditions->ids_createurs_commentaires))
      return erreur("Le paramètre donné pour les ids des utilisateurs dont on veut les commentaires n'est pas valide. Reçu : $conditions->ids_createurs_commentaires");
    else
      $conditions_sql.=" AND id_createur_commentaire in ($conditions->ids_createurs_commentaires)";

  if (!empty($conditions->demande_correction))
    $conditions_sql.=" AND demande_correction!=0";

  if (!empty($conditions->date_apres))
    $conditions_sql.="\n\tAND date >= ".$pdo->quote($conditions->date_apres);

  if (!empty($conditions->texte))
    $conditions_sql.="\n\tAND texte ILIKE ".$pdo->quote("%$conditions->texte%");

  if (isset($conditions->avec_points_caches) and !$conditions->avec_points_caches ) // On ne veut pas les commentaires de points cachés, alors il nous faut impérativement les infos sur les points si on veut vérifier qu'ils sont cachés.
    $conditions->avec_infos_point=True;

  // On veut des informations supplémentaire auquel le commentaire se rapporte (nom du point, id, "massif" auquel il appartient)
  // FIXME? : usine à gaz, ça revient presque à faire la reqûete pour récupérer un point. Mais peut-être pas non plus à fusionner sinon méga usine à gaz
  // jmb ca fait un job de trop pour cette fonction. faudrait pourtant bien appeler infos_points pour etre coherent.
  // ou alors que cette fonction ET infos _points appellent une fonction d'appartenance. Le code ne serait plus en double.
  // ca rajoute une fonction, mais ca reduit ici, et ca reduit la bas.
  // Faut reduire la taille des briques. Cette fonctions donne des infos sur les commentaires, pas sur les massifs.
  // FIXME 2024 sly: Ce code est en double dans infos_points() je commence vraiment à me dire que je vais laisser tomber et boucler sur infos_points (en plus, ça ne sert que pour les news et pour la page d'accueil) qui en contiennent en nombre limité. Là ou la recherche ou l'export de point ont vraiment besoin de vitesse car on peut en sortir des tas
  // FIXME 2025 sly: Mais ouais, mais en ajoutant en 2025 aux nouvelles une conditions sur le polygone auxquel le point dont le commentaire se rapporte, avoir ici cette particularité du massif fait qu'il n'est pas possible de filtrer sur autre chose qu'un massif : exemple, un filtre sur les commentaires de points dans les Alpes (une zone) par ids_polygones=352 ou un département ou un pays ne fonctionne pas !
  // Pour avoir vu Laravel avec Eloquent, et bien en fait si, il ne faut pas avoir peur des LEFT JOIN à l'infini, SQL c'est fait pour, c'est juste que si on utilisait un moteur de génération de SQL, ça serait plus facile à coder qu'avec des ifs à n'en plus finir.
  // Bref, en attendant le grand soir, il faut faire sauter cette condition id_polygone_type=".$config_wri['id_massif']; et comme pour les points, remplir un array proprement avec un sous-ensemble des polygones auxquels le points de tel commentaire se rapporte

  if (!empty($conditions->avec_infos_point) OR !empty($conditions->avec_commentaires_modele) OR !empty(($conditions->ids_polygones)))
  {
    $table_en_plus=",point_type,points LEFT JOIN polygones on ST_Within(points.geom,polygones.geom) AND polygones.id_polygone_type=".$config_wri['id_massif'];

    $condition_en_plus.="
            AND points.id_point=commentaires.id_point
            AND point_type.id_point_type=points.id_point_type";

    $champ_en_plus.=",points.*,point_type.*,";
    // Pour éviter de mettre "*" sinon, en cas de demande sur les polygones contenant le point dont le commentaire est demandée
    // ça récupère toute la géométrie pour rien, et parfois, ça fait du grabuge
    $champ_en_plus.=$config_wri['champs_table_polygones'];

    if (!empty($conditions->avec_commentaires_modele) and $conditions->avec_commentaires_modele==True)
      $condition_en_plus.=" AND points.modele!=1 ";

    // par défaut, les points cachés ne sont pas retournés, sauf si on précise avec_points_caches=True (par exemple quand un modérateur est authentifié)
    if (empty($conditions->avec_points_caches) or $conditions->avec_points_caches==False )
      $condition_en_plus.=" AND ( points.cache= 'f' ) ";

    if (!empty($conditions->ids_polygones))
      if (!verif_multiples_entiers($conditions->ids_polygones))
        return erreur("Le paramètre donné pour les ids de polygones auxquels les points appartiennent dont on veut les commentaires n'est pas valide. Reçu : $conditions->ids_polygones");
      else
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
    if (!empty($commentaire->photo_existe))
    {
      /*
        Remplissage de l'objet avec les photos disponibles pour ce commentaire, s'il y en a et si elles existent sur le disque :
        Quand tout est "normal", on devrait avoir : la photo d'origine fournie par le contributeur, la version réduite à la taille qui nous plait, la vignette
        Le problème venant du fait que tous les commentaires n'ont pas eu leur vignette de créée, et pas tous on une photo à la taille d'origine (historique wri)
        ben, on est obligé de tout tester : ouais, c'est relou !
      */
      foreach (array("reduite", "vignette", "originale") as $taille)
        foreach($config_wri['extensions_fichier_photo'] as $extension_fichier_photo)
        {
          $nom_fichier_photo=($commentaire->id_commentaire??'')."-".$taille.".".$extension_fichier_photo;
          $chemin_photo=$config_wri['rep_photos_points'].$nom_fichier_photo;
          if (is_file($chemin_photo))
          {
            $commentaire->photo[$taille]=$chemin_photo;
            // Le filemtime a pour but, après une modification sur la photo, d'éviter que les caches navigateurs ne s'activent
            $commentaire->lien_photo[$taille]=$config_wri['rep_web_photos_points'].$nom_fichier_photo."?".filemtime($chemin_photo);
            break; // pas besoin de tester toute les extensions, on en a trouvé une
          }
        }

      // Ce cas peut exister quand on a plus/pas gardé la photo originale (historique) alors elle sera la même que la réduite
      if (!isset($commentaire->photo['originale']) and !empty($commentaire->photo['reduite']))
      {
        $commentaire->photo['originale']=$commentaire->photo['reduite'];
        $commentaire->lien_photo['originale']=$commentaire->lien_photo['reduite'];
      }
    }

    // phpBB intègre un nom d'utilisateur dans sa base après avoir passé un htmlentities, pour les users connectés
    if (!empty($commentaire->auteur_commentaire))
        $commentaire->auteur_commentaire=html_entity_decode($commentaire->auteur_commentaire);
    $commentaires [] = $commentaire;
  }
  return $commentaires ;
}


// Un appel plus simple qui utilise le précédent
// jmb , comme infos_point, je vois pas l'interet, les fonctions pointS et sommentaireS savent gerer les cas unique
// sly : totalement d'accord sur le principe, j'ai juste voulu reproduire l'appel historique qui récupére un commentaire à partir de son id
// sly 2025 mini avantage détecté, par rapport à infos_commentaires cette fonction ajoute un test du nombre retourné et un message d'erreur plus propre. Si un commentaire est demandé par id, mais qu'on en trouve aucun, alors une alerte est renvoyée, pas infos_commentaires
function infos_commentaire($id_commentaire,$meme_si_cache=False)
{
  $conditions = new stdClass;
  $conditions->ids_commentaires=$id_commentaire;
  $conditions->avec_infos_point=True;
  $conditions->avec_points_caches=$meme_si_cache;
  $c=infos_commentaires ($conditions);
  if (!empty($c->erreur))
    return erreur($c->message);
  if (count($c)!=1)
    return erreur("Le commentaire d'id=".$id_commentaire." a été demandé mais il n'a pas été trouvé et ce n'est pas normal, je m'arrète là");
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
$retour->message un message explicite qui peut être fourni à l'utilisateur final sur ce qui s'est passé : Commentaire modifié ou ajouté. Modification impossible car une erreur l'empêche. Photo invalide ou dans un format non accepté.

si tout c'est bien passé elle retourne :
$retour->id_commentaire (l'id du commentaire créé ou modifié)
$retour->message : un message texte compréhensible indiquant une information sur ce qui s'est passé
(exemple : la photo, trop, grosse a dû être redimensionnée)

$commentaire->rotation : demande une rotation de la photo d'un angle de $commentaire->rotation (degrés)


TODO peut-être: pouvoir passer une url http pour la photo au lieu d'un chemin local, si la photo est déjà sur un service distant, alors la télécharger, ce qui évite à l'internaute de la ré-envoyer. (Avis sly: ouais bon, c'est pas non plus la fonction de fou, et que faire si le serveur distant ne répond pas ?)
************/
function modification_ajout_commentaire($commentaire)
{
  global $config_wri,$pdo;
  $retour = new stdClass;
  $photo_valide=False;
  $ajout_photo=False;

  $point=infos_point($commentaire->id_point??0,True);
  if (!empty($point->erreur))
    return erreur("Le commentaire ne peut être ajouté car : ".$point->message ?? '',"Id du point: \"$commentaire->id_point\"");
  // Test de validité, un commentaire ne peut être modifié ou ajouté que si son texte existe ou a une photo
  // On dirait que le commentaire dispose bien d'une photo
  if (!empty($commentaire->photo['originale']))
  {
    if (!is_file($commentaire->photo['originale']??''))
      return erreur("La photo proposée ne semble pas exister ou ne nous est pas parvenue");

    $format_photo=exif_imagetype($commentaire->photo['originale']);
    // Test pour voir si le fichier envoyé est bien un format de photo dans la liste que nous acceptons
    if (!in_array($format_photo,$config_wri['format_photo_autorisees'] ))
      return erreur("Le fichier proposé ne semble pas contenir une image au format ".$config_wri['texte_des_formats_photo_autorisee'].", vous pouvez revenir en arrière et retirer la photo, la vérifier ou en fournir une autre.");

    //bien, on a une image pour ce commentaire
    $photo_valide=True;
  }
  else if (isset($commentaire->photo['reduite']))
    // On a pas (ou plus) la photo originale, mais on a quand même la réduite
    $commentaire->photo_existe=1; // normalement, vu que l'objet n'a pas de chemin pour la photo, ça devrait déjà être 0, mais si quelqu'un veut le forcer à 1 : non
  else
    $commentaire->photo_existe=0;

  if (!$photo_valide and trim($commentaire->texte??'')=="")
    return erreur("Le commentaire ne contient ni photo ni texte, il n'est pas traité");

  // On a donc soit une photo valide, soit un texte pour le commentaire, on continue
  if (!empty($commentaire->id_commentaire)) // On a un id de commentaire, on est donc en train de le modifier
  {
    $commentaire_avant_modification=infos_commentaire($commentaire->id_commentaire,True);
    if (!empty($commentaire_avant_modification->erreur))
      return erreur("Une modification d'un commentaire inexistant a été demandée : ".$commentaire_avant_modification->message);

    if (!empty($commentaire->photo['originale']))
      $ajout_photo=empty($commentaire->photo['originale']);
    else
      $ajout_photo=False;
    $mode="modification";
    $un_transfert_a_eu_lieu = ($commentaire_avant_modification->id_point??0 != $commentaire->id_point??0);
  }
  else
    $mode="ajout";

  // On ne souhaite traiter la photo (redimensionnement, vignette) que si celle-ci est valide et que l'on est bien dans le mode d'ajout d'un commentaire
  $traitement_photo=($photo_valide and $mode=="ajout");

  // Le but de ce bout est de récupérer la date (données exif) de prise de la photo que l'on doit ajouter
  if ($traitement_photo)
  {
    $commentaire->photo_existe=1;
    $exif_data = @exif_read_data ($commentaire->photo['originale']??'');
    // la date ne semble pas exister dans les données Exif de la photo, on met ''
    $date_photo = $exif_data ['DateTimeOriginal'] ?? '';

    // Testons si on a récupéré une date dans les infos exif de la photo
    // jmb tant que les photos ne sont QUE dans les commentaires
    // certains appareils photo pas à l'heure enregistrent quand même une date parfois au format "0000:00:00 00:00:00" qui est manifestement invalide, j'ajoute un test plus poussé (mais un peu compliqué) pour éviter aussi les 32 Mars
    // tout autant que les 00000000000 ou n'importe quoi qui ne ressemble pas à "2014:04:14 12:45:78" -- sly
    if (preg_match('/^([0-9]{4}):([0-9]{2}):([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})$/', $date_photo, $m) == 1 && checkdate($m[2], $m[3], $m[1]))
      $commentaire->date_photo = "$m[1]-$m[2]-$m[3] $m[4]:$m[5]:$m[6]";
  }

  // Rotation des photos réduite (la photo originale du client n'est pas touchée, ça peut être discutable, mais avec les tags exif d'orientation, j'ai eu des gags), (2023 utilisée uniquement par les modérateurs, donc a posteriori de l'ajout)
  if (!empty($commentaire->rotation) and $mode=="modification" )
  {
    $image=imagecreatefromstring(file_get_contents($commentaire_avant_modification->photo['reduite']??'')); // on récupère la réduite, peut importe son format
    $image = imagerotate ($image, $commentaire->rotation, 0); // On la fait tourner

    imagejpeg($image,$commentaire_avant_modification->photo['reduite']??''); // On l'écrit sur le disque
    redimensionnement_photo($commentaire_avant_modification->photo['reduite']??''); // on la redimensionne en mode réduite
    imagejpeg($image,$commentaire_avant_modification->photo['vignette']??'');
    redimensionnement_photo($commentaire_avant_modification->photo['vignette']??'',"vignette"); // on redimensionne celle là en mode vignette
  }

  // FIXME, tout correspond, y'a pas moyen de simplifier par un foreach sur $commentaire et remplir les champs SQL ?
  // 2023, pas tout à fait, l'object $commentaire contient des trucs comme la photo qui n'est pas en base, il faudrait ruser.
  isset($commentaire->id_point) ? $champs_sql['id_point']=$commentaire->id_point: false ;
  isset($commentaire->date) ? $champs_sql['date']=$pdo->quote($commentaire->date): false ;
  isset($commentaire->texte) ? $champs_sql['texte']=$pdo->quote($commentaire->texte):false;
  isset($commentaire->auteur_commentaire) ? $champs_sql['auteur_commentaire']=$pdo->quote($commentaire->auteur_commentaire):false;
  isset($commentaire->id_createur_commentaire) ? $champs_sql['id_createur_commentaire']=$commentaire->id_createur_commentaire:false;
  isset($commentaire->photo_existe) ? $champs_sql['photo_existe']=$commentaire->photo_existe:false;
  isset($commentaire->raison_demande_correction) ? $champs_sql['raison_demande_correction']=$pdo->quote($commentaire->raison_demande_correction):false;
  is_numeric($commentaire->demande_correction) ? $champs_sql['demande_correction']=$commentaire->demande_correction:false;
  isset($commentaire->date_photo) ? $champs_sql['date_photo']=$pdo->quote($commentaire->date_photo):false;

  // fait-on un update ou un insert ?
  if ($mode=="modification")
    $query_finale=requete_modification_ou_ajout_generique('commentaires',$champs_sql,'update',"id_commentaire=$commentaire->id_commentaire");
  else
    $query_finale=requete_modification_ou_ajout_generique('commentaires',$champs_sql,'insert');

  if (!$pdo->exec($query_finale))
    return erreur("Problème qui n'aurait pas dû arriver, le traitement du commentaire a foiré","La requête était : $query_finale");
  elseif ($mode!="modification")
    $commentaire->id_commentaire = $pdo->lastInsertId();

  if ($mode=="ajout")
    $retour->message="Le commentaire a été ajouté";
  else
    $retour->message="Le commentaire a été modifié";

  // C'est juste "cosmétique" : si on détecte que le numéro du point a changé, on signale qu'un transfert a eu lieu.
  if ($mode == "modification" and $un_transfert_a_eu_lieu)
    $retour->message.=" et a été transféré sur la fiche : <a href=\"".lien_point($point)."\">".$point->nom."</a>";

  $retour->erreur=False;

  // On avait une photo valide sur le disque mais il est demandé qu'il n'y en ait pas, il faut donc faire le ménage
  if (empty($commentaire->photo_existe) and $photo_valide)
    suppression_photos($commentaire);

  // Normalement, tout est bon ici, il ne nous reste plus qu'a gérer la photo ajoutée
  if ($traitement_photo && !empty($commentaire->id_commentaire))
  {
    //2023 : on accepte maintenant plusieurs format possible, on garde donc une trace dans l'extension du format d'origine (on pourrait faire sans extension, mais l'intuition me dit qu'il vaut p'tet mieux garder ça
    $choix_extension_fichier=str_replace("image/","",image_type_to_mime_type($format_photo));

    // On souhaite garder la photo originale telle qu'elle a été fournie, sans la retoucher, mais on ne souhaite pas garder le nom de fichier fourni par le client
    // des fois qu'il y ait des trucs malveillants dedans, ou pour la confidentialité, et pour standardiser le stockage sur disque
    $photo_originale=$config_wri['rep_photos_points'] . $commentaire->id_commentaire . "-originale.".$choix_extension_fichier;
    $vignette_photo = $config_wri['rep_photos_points'] . $commentaire->id_commentaire . "-vignette.jpeg";
    $image_reduite=$config_wri['rep_photos_points'] . $commentaire->id_commentaire . "-reduite.jpeg";
    $taille = getimagesize($commentaire->photo['originale']);

    //On garde bien la photo d'origine, sans modification (à part la renommer), comme ça, si un jour on veut changer de format, relire les exifs, etc.
    if (!empty($commentaire->photo['originale'])) {
      copy($commentaire->photo['originale'],$photo_originale);
      copy($commentaire->photo['originale'],$image_reduite);
    }

    if ( ($taille[0]>$config_wri['largeur_max_photo']) OR ($taille[1]>$config_wri['hauteur_max_photo']))
      redimensionnement_photo($image_reduite);
    else
    {
      $image=imagecreatefromstring(file_get_contents($image_reduite));
      imagejpeg($image,$image_reduite); // On l'écrit sur le disque en jpeg même si sa résolution reste inchangée, on uniformise
    }
    copy($image_reduite,$vignette_photo);
    redimensionnement_photo($vignette_photo, 'vignette');
  }
  $retour->id_commentaire=$commentaire->id_commentaire??0;
  return $retour;
}


function redimensionnement_photo($chemin_photo, $type = 'photo')
{
  global $config_wri;
  $image=imagecreatefromstring(file_get_contents($chemin_photo)); //On récupère la photo dans n'importe lequel des formats qu'on accepte

  // Detect orientation
  $codes_angles = [
      3 => 180,
      6 => -90,
      8 =>  90,
  ];
  $exif_data = @exif_read_data ($chemin_photo);
  $angle = @$codes_angles [$exif_data ['Orientation']];

  // Si des données exif sont disponible sur l'orientation (jpeg et webp uniquement) alors on tente de respecter l'orientation
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
  if (isset($commentaire->photo) or !empty($commentaire->photo_existe))
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
  if (!empty($commentaire->photo_existe))
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
  require_once ("forum.php");

  if (!empty($commentaire->photo_existe) && !empty($commentaire->id_commentaire))
  {
    // insere la balise bbcode pour la photo
    $commentaire->texte.="\n[img]".$config_wri['rep_web_forum_photos'].$commentaire->id_commentaire.".jpeg[/img]";

    // et on copie les photos, on va garder: la version original et la version en taille réduite (ça peut servir si on veut finalement refaire venir le commentaire sur le site et avoir la photo en haute résolution)
    if (isset($commentaire->photo['reduite']))
      copy($commentaire->photo['reduite'],$config_wri['rep_forum_photos'].$commentaire->id_commentaire.".jpeg");
    if (isset($commentaire->photo['originale']))
      copy($commentaire->photo['originale'],$config_wri['rep_forum_photos'].$commentaire->id_commentaire."-originale.jpeg");
  }

  if (!empty($commentaire->id_createur_commentaire)) // L'utilisateur qui a posté ce commentaire était connecté
  {
    $utilisateur=infos_utilisateur($commentaire->id_createur_commentaire);
    if (!empty($utilisateur->erreur)) //  L'utilisateur n'existe plus ?, ça voudrait dire qu'il a existé, a rentrer un commentaire, mais qu'un modérateur à supprimé son compte ? bon, tout est possible dans ce monde ! prévoyons ce cas :
      $commentaire->id_createur_commentaire=0; // on le force à Anonyme
    else // Tout s'est bien passé, l'utilisateur existe, la fonction phpBB semble quand même avoir besoin du nom d'auteur (en plus de l'id FIXME: à confirmer ? peut-être inutile)
      $auteur=$utilisateur->username??'';
  }
  else  // Par défaut on choisi ce nom si on a rien d'autre
    $auteur = 'Anonyme';

  // note sly 17/08/2013 : j'ajoute un "_".rand(1,999) à la suite du nom de l'auteur, c'est un peu curieux,
  // mais ça permet de réduire les chances qu'on le confonde avec un utilisateur du forum portant le même nom exactement
  // de plus, toute action de modération sort un message d'erreur indiquant "utilisateur existe déjà, merci d'en choisir un autre"
  // Et comme un utilisateur phpBB doit contenir au moins 1 caractère et 80 maximum (selon config), s'il s'appelait "" (vide) ça ferait "_1" au pire, soit plus que les 1 caractères mini
  // et s'il s'appellait abcdefghijklmnopqrstuvwxyz0123456789abcdefghijklmnopqrstuvwxyz0123456789abcdefghij (83 caractères) substr 0,76 + _ + rand(1,999) va donner abcdefghijklmnopqrstuvwxyz0123456789abcdefghijklmnopqrstuvwxyz0123456789abc_999 au max soit 80 charactères qui est autorisé.
  if (!empty($commentaire->auteur_commentaire))
      $auteur = substr($commentaire->auteur_commentaire,0,76).'_'.rand(1,999);

  if (!empty($commentaire->id_point))
    $point_ratache=infos_point($commentaire->id_point,True); // Uniquement dans le but que le titre du message sur le forum porte le nom du point auquel il était rataché

  // On appelle la fonction du forum qui cree un post
  forum_submit_post ([
    'action' => 'reply',
    'topic_id' => $commentaire->topic_id??0,
    'topic_title' => 'Transféré depuis &quot;'.($point_ratache->nom??'').'&quot;',
    'message' => $commentaire->texte??0,
    'topic_poster' => $commentaire->id_createur_commentaire??0, // Si l'auteur était connecté, on garde l'ID, 0 sinon
    'username' => $auteur,
    'post_time' => strtotime ($commentaire->date)??0, // Recalcule suivant la timezone
  ]);

  // On s'occupe du commentaire
  $retour=suppression_commentaire($commentaire);

  if ($retour->erreur)
    return erreur($retour->message.", mais la copie a réussie");
  else
    return ok("Message transféré sur le forum");
}

