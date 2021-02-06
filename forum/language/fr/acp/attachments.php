<?php
/**
*
* This file is part of the french language pack for the phpBB Forum Software package.
* This file is translated by phpBB-fr.com <http://www.phpbb-fr.com>
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_ATTACHMENT_SETTINGS_EXPLAIN'	=> 'Depuis cette page, vous pouvez configurer les paramètres principaux pour les fichiers joints et les catégories spéciales associées.',
	'ACP_EXTENSION_GROUPS_EXPLAIN'		=> 'Ajoutez, supprimez, modifiez ou désactivez vos groupes d’extensions. D’autres options incluent l’attribution d’une catégorie spéciale, la modification du mécanisme de téléchargement et la définition d’une icône de transfert qui sera affichée devant le fichier joint qui appartient au groupe.',
	'ACP_MANAGE_EXTENSIONS_EXPLAIN'		=> 'Ici, vous pouvez gérer les extensions de fichier autorisées. Pour activer vos extensions, référez-vous au panneau de gestion des groupes d’extensions. Nous recommandons vivement de ne pas autoriser les extensions de scripts tel que <code>php</code>, <code>php3</code>, <code>php4</code>, <code>phtml</code>, <code>pl</code>, <code>cgi</code>, <code>py</code>, <code>rb</code>, <code>asp</code>, <code>aspx</code>, etc.',
	'ACP_ORPHAN_ATTACHMENTS_EXPLAIN'	=> 'Depuis cette page, vous accédez à la liste les fichiers orphelins. Un fichier est orphelin lorsqu’un membre joint un fichier dans un message qu’il n’envoie pas. Vous pouvez supprimer ces fichiers orphelins, ou les attribuer à des messages existants en saisissant l’ID (valide) du message auquel le fichier orphelin sera affecté.',
	'ADD_EXTENSION'						=> 'Ajouter une extension',
	'ADD_EXTENSION_GROUP'				=> 'Ajouter un groupe d’extensions',
	'ADMIN_UPLOAD_ERROR'				=> 'Erreur lors du transfert du fichier : « %s ».',
	'ALLOWED_FORUMS'					=> 'Forums autorisés',
	'ALLOWED_FORUMS_EXPLAIN'			=> 'Autorise l’utilisation du groupe d’extensions sur les forums sélectionnés (ou tous si sélectionné).',
	'ALLOWED_IN_PM_POST'				=> 'Autorisé',
	'ALLOW_ATTACHMENTS'					=> 'Autoriser les fichiers joints',
	'ALLOW_ALL_FORUMS'					=> 'Autoriser dans tous les forums',
	'ALLOW_IN_PM'						=> 'Autoriser dans la messagerie privée',
	'ALLOW_PM_ATTACHMENTS'				=> 'Autoriser les fichiers joints dans les messages privés',
	'ALLOW_SELECTED_FORUMS'				=> 'Seulement dans les forums sélectionnés ci-dessous',
	'ASSIGNED_EXTENSIONS'				=> 'Extensions assignées',
	'ASSIGNED_GROUP'					=> 'Groupe d’extensions assigné',
	'ATTACH_EXTENSIONS_URL'				=> 'Extensions',
	'ATTACH_EXT_GROUPS_URL'				=> 'Groupes d’extensions',
	'ATTACH_ID'							=> 'ID',
	'ATTACH_MAX_FILESIZE'				=> 'Taille maximale du fichier',
	'ATTACH_MAX_FILESIZE_EXPLAIN'		=> 'Taille maximale de chaque fichier. Si cette valeur est « 0 », la taille du fichier transféré est uniquement limitée par votre configuration PHP.',
	'ATTACH_MAX_PM_FILESIZE'			=> 'Taille maximale des fichiers dans la messagerie privée',
	'ATTACH_MAX_PM_FILESIZE_EXPLAIN'	=> 'Taille maximale de chaque fichier joint à un message privé, mettre « 0 » pour illimité.',
	'ATTACH_ORPHAN_URL'					=> 'Fichiers orphelins',
	'ATTACH_POST_ID'					=> 'ID du message',
	'ATTACH_POST_TYPE'					=> 'Type du message',
	'ATTACH_QUOTA'						=> 'Quota total de fichiers joints',
	'ATTACH_QUOTA_EXPLAIN'				=> 'Espace disque maximum disponible pour les fichiers joints de tout le forum, mettre « 0 » pour illimité.',
	'ATTACH_TO_POST'					=> 'Joindre le fichier au message',

	'CAT_IMAGES'				=> 'Images',
	'CHECK_CONTENT'				=> 'Vérifier les fichiers joints',
	'CHECK_CONTENT_EXPLAIN'		=> 'Certains navigateurs peuvent se tromper en attribuant un type MIME incorrect aux fichiers transférés. Cette option permet de rejeter les fichiers qui risquent d’entraîner ce problème.',
	'CREATE_GROUP'				=> 'Créer un nouveau groupe',
	'CREATE_THUMBNAIL'			=> 'Créer une miniature',
	'CREATE_THUMBNAIL_EXPLAIN'	=> 'Créer une miniature dans tous les cas possibles.',

	'DEFINE_ALLOWED_IPS'			=> 'Définir les adresses IP/noms d’hôtes autorisés',
	'DEFINE_DISALLOWED_IPS'			=> 'Définir les adresses IP/noms d’hôtes interdits',
	'DOWNLOAD_ADD_IPS_EXPLAIN'		=> 'Pour indiquer plusieurs adresses IP ou noms d’hôtes différents, saisissez chacun d’eux sur une nouvelle ligne. Pour indiquer une plage d’adresses IP, séparez le début et la fin par un tiret (-), et utilisez « * » comme caractère joker.',
	'DOWNLOAD_REMOVE_IPS_EXPLAIN'	=> 'Vous pouvez supprimer (ou ne plus exclure) plusieurs adresses IP d’un coup en utilisant la combinaison de touches appropriée avec votre clavier et votre souris. Les adresses IP et les noms d’hôtes exclus apparaissent en gras.',
	'DISPLAY_INLINED'				=> 'Afficher les images',
	'DISPLAY_INLINED_EXPLAIN'		=> 'Si « Non », les images jointes seront affichées sous forme de lien.',
	'DISPLAY_ORDER'					=> 'Ordre d’affichage des fichiers joints',
	'DISPLAY_ORDER_EXPLAIN'			=> 'Classer les fichiers joints par date.',

	'EDIT_EXTENSION_GROUP'			=> 'Modifier le groupe d’extensions',
	'EXCLUDE_ENTERED_IP'			=> 'Activez ceci pour exclure l’IP/nom d’hôte entré.',
	'EXCLUDE_FROM_ALLOWED_IP'		=> 'Exclure une IP des IP/noms d’hôtes autorisés',
	'EXCLUDE_FROM_DISALLOWED_IP'	=> 'Exclure une IP des IP/noms d’hôtes interdits',
	'EXTENSIONS_UPDATED'			=> 'Les extensions ont été mises à jour.',
	'EXTENSION_EXIST'				=> 'L’extension %s existe déjà.',
	'EXTENSION_GROUP'				=> 'Groupe d’extensions',
	'EXTENSION_GROUPS'				=> 'Groupes d’extensions',
	'EXTENSION_GROUP_DELETED'		=> 'Le groupe d’extensions a été supprimé.',
	'EXTENSION_GROUP_EXIST'			=> 'Le groupe d’extensions %s existe déjà.',

	'EXT_GROUP_ARCHIVES'			=> 'Archives',
	'EXT_GROUP_DOCUMENTS'			=> 'Documents',
	'EXT_GROUP_DOWNLOADABLE_FILES'	=> 'Fichiers téléchargeables',
	'EXT_GROUP_IMAGES'				=> 'Images',
	'EXT_GROUP_PLAIN_TEXT'			=> 'Texte',

	'FILES_GONE'			=> 'Certains des fichiers joints sélectionnés pour suppression n’existent pas. Ils ont probablement déjà été supprimés. Les fichiers joints qui existaient ont été supprimés.',
	'FILES_STATS_WRONG'		=> 'Vos statistiques de fichiers sont probablement inexactes et doivent être actualisées. Valeurs réelles : nombre de fichiers joints = %1$d, taille totale des fichiers joints = %2$s.<br>Cliquez %3$sici%4$s pour actualiser les statistiques.',

	'GO_TO_EXTENSIONS'		=> 'Gérer les extensions des fichiers joints',
	'GROUP_NAME'			=> 'Nom du groupe',

	'IMAGE_LINK_SIZE'			=> 'Dimensions du lien de l’image',
	'IMAGE_LINK_SIZE_EXPLAIN'	=> 'Les fichiers image joints s’afficheront sous forme de lien texte, si la taille de l’image est plus grande que les dimensions saisies. Pour désactiver ce comportement, réglez les valeurs sur 0px par 0px.',
	'IMAGE_QUALITY'				=> 'Qualité des images jointes transférées (JPEG uniquement)',
	'IMAGE_QUALITY_EXPLAIN'		=> 'Spécifiez une valeur entre 50% (fichier compact) and 90% (meilleure qualité). Une qualité supérieure à 90% augmente la taille du fichier et est désactivée. Le paramètre ne s’applique que si les dimensions maximales de l’image sont définies sur une valeur autre que 0 px par 0 px.',
	'IMAGE_STRIP_METADATA'		=> 'Supprimer les métadonnées d’image (JPEG uniquement)',
	'IMAGE_STRIP_METADATA_EXPLAIN'	=> 'Supprime les métadonnées Exif, par exemple le nom de l’auteur, les coordonnées GPS les détails de l’appareil photo. Le paramètre ne s’applique que si les dimensions maximales de l’image sont définies sur une valeur autre que 0 px par 0 px.',

	'MAX_ATTACHMENTS'				=> 'Nombre maximum de fichiers joints par message',
	'MAX_ATTACHMENTS_PM'			=> 'Nombre maximum de fichiers joints par message privé',
	'MAX_EXTGROUP_FILESIZE'			=> 'Taille maximale du fichier',
	'MAX_IMAGE_SIZE'				=> 'Dimensions maximales de l’image',
	'MAX_IMAGE_SIZE_EXPLAIN'		=> 'Taille maximale des images jointes. Réglez les deux valeurs sur 0px par 0px pour désactiver le contrôle des dimensions.',
	'MAX_THUMB_WIDTH'				=> 'Largeur/hauteur maximale de la miniature générée',
	'MAX_THUMB_WIDTH_EXPLAIN'		=> 'La miniature générée n’excédera pas la largeur ou la hauteur indiquée.',
	'MIN_THUMB_FILESIZE'			=> 'Taille minimale de la miniature',
	'MIN_THUMB_FILESIZE_EXPLAIN'	=> 'Ne pas créer de miniature pour les images ayant un poids inférieur à',
	'MODE_INLINE'					=> 'Intégré',
	'MODE_PHYSICAL'					=> 'Physique',

	'NOT_ALLOWED_IN_PM'			=> 'Non autorisé dans les messages privés',
	'NOT_ALLOWED_IN_PM_POST'	=> 'Non autorisé',
	'NOT_ASSIGNED'				=> 'Non assigné',
	'NO_ATTACHMENTS'			=> 'Aucune pièce jointe pour cette période.',
	'NO_EXT_GROUP'				=> 'Aucun',
	'NO_EXT_GROUP_ALLOWED_PM'	=> 'Aucun <a href="%s">groupe d’extension n’est autorisé</a> pour les messages privés.',
	'NO_EXT_GROUP_ALLOWED_POST'	=> 'Aucun <a href="%s">groupe d’extension n’est autorisé</a> pour les messages.',
	'NO_EXT_GROUP_NAME'			=> 'Vous n’avez indiqué aucun nom de groupe',
	'NO_EXT_GROUP_SPECIFIED'	=> 'Vous n’avez indiqué aucun groupe d’extension.',
	'NO_FILE_CAT'				=> 'Aucun',
	'NO_IMAGE'					=> 'Aucune image',
	'NO_UPLOAD_DIR'				=> 'Le répertoire de transfert indiqué n’existe pas.',
	'NO_WRITE_UPLOAD'			=> 'Vous ne possédez pas les droits en écriture sur le répertoire de transfert indiqué. Modifiez les permissions du répertoire (CHMOD) afin d’autoriser le service Web à y accéder en écriture.',

	'ONLY_ALLOWED_IN_PM'	=> 'Seulement autorisé dans les messages privés',
	'ORDER_ALLOW_DENY'		=> 'Autorisé',
	'ORDER_DENY_ALLOW'		=> 'Refusé',

	'REMOVE_ALLOWED_IPS'			=> 'Supprimer ou ne plus exclure les IP/noms d’hôtes <em>autorisés</em>',
	'REMOVE_DISALLOWED_IPS'			=> 'Supprimer ou ne plus exclure les IP/noms d’hôtes <em>interdits</em>',
	'RESYNC_FILES_STATS_CONFIRM'	=> 'Êtes-vous sûr de vouloir actualiser les statistiques de fichiers ?',

	'SECURE_ALLOW_DENY'				=> 'Liste des autorisations/refus',
	'SECURE_ALLOW_DENY_EXPLAIN'		=> 'Lorsque les téléchargements sécurisés sont activés, modifiez le comportement par défaut de la liste d’autorisations/refus à celle d’une <strong>liste blanche</strong> (Autorisé) ou une <strong>liste noire</strong> (Refusé).',
	'SECURE_DOWNLOADS'				=> 'Activer les téléchargements sécurisés',
	'SECURE_DOWNLOADS_EXPLAIN'		=> 'Si cette option est activée, les téléchargements seront limités aux IP/noms d’hôtes définis.',
	'SECURE_DOWNLOAD_NOTICE'		=> 'Les téléchargements sécurisés ne sont pas activés. Les paramètres ci-dessous seront appliqués une fois les téléchargements sécurisés activés.',
	'SECURE_DOWNLOAD_UPDATE_SUCCESS'=> 'La liste des adresses IP a été mise à jour.',
	'SECURE_EMPTY_REFERRER'			=> 'Autoriser un référent vide',
	'SECURE_EMPTY_REFERRER_EXPLAIN'	=> 'Les téléchargements sécurisés sont basés sur les référents. Voulez-vous autoriser les téléchargements pour ceux qui omettent le référent ?',
	'SETTINGS_CAT_IMAGES'			=> 'Paramètres des catégories d’images',
	'SPECIAL_CATEGORY'				=> 'Catégorie spéciale',
	'SPECIAL_CATEGORY_EXPLAIN'		=> 'Les catégories spéciales proposent un affichage particulier.',
	'SUCCESSFULLY_UPLOADED'			=> 'Le transfert est terminé.',
	'SUCCESS_EXTENSION_GROUP_ADD'	=> 'Le groupe d’extension a été créé.',
	'SUCCESS_EXTENSION_GROUP_EDIT'	=> 'Le groupe d’extension a été mis à jour.',

	'UPLOADING_FILES'				=> 'Transfert de fichiers',
	'UPLOADING_FILE_TO'				=> 'Le fichier « %1$s » a été transféré au message numéro %2$d.',
	'UPLOAD_DENIED_FORUM'			=> 'Vous n’avez pas la permission de transférer des fichiers sur le forum « %s ».',
	'UPLOAD_DIR'					=> 'Répertoire de transfert',
	'UPLOAD_DIR_EXPLAIN'			=> 'Indiquez le chemin du répertoire de stockage destiné au transfert de fichiers joints. Notez que si vous modifiez ce répertoire alors que des fichiers joints s’y trouvent déjà, vous devrez les déplacer manuellement vers le nouvel emplacement.',
	'UPLOAD_ICON'					=> 'Icône de transfert',
	'UPLOAD_NOT_DIR'				=> 'L’emplacement de transfert que vous avez indiqué ne semble pas être un répertoire.',
));
