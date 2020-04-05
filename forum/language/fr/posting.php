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
	'ADD_ATTACHMENT'			=> 'Ajouter des fichiers joints',
	'ADD_ATTACHMENT_EXPLAIN'	=> 'Si vous souhaitez joindre un ou plusieurs fichiers, complétez les indications suivantes.',
	'ADD_FILE'					=> 'Ajouter le fichier',
	'ADD_POLL'					=> 'Ajouter un sondage',
	'ADD_POLL_EXPLAIN'			=> 'Si vous ne souhaitez pas ajouter de sondage à votre sujet, laissez ces champs vides.',
	'ALREADY_DELETED'			=> 'Désolé, ce message a déjà été supprimé.',
	'ATTACH_COMMENT_NO_EMOJIS'	=> 'Le commentaire du fichier joint contient des caractères interdits (émojis).',
	'ATTACH_DISK_FULL'			=> 'L’espace disque n’est pas suffisant pour joindre ce fichier.',
	'ATTACH_QUOTA_REACHED'		=> 'Désolé, le quota de fichiers joints a été atteint.',
	'ATTACH_SIG'				=> 'Attacher ma signature (les signatures peuvent être modifiées dans le panneau de l’utilisateur)',

	'BBCODE_A_HELP'				=> 'Insérer un fichier joint dans ce message : [attachment=]nom_du_fichier.ext[/attachment]',
	'BBCODE_B_HELP'				=> 'Texte gras : [b]texte[/b]',
	'BBCODE_C_HELP'				=> 'Code : [code]code[/code]',
	'BBCODE_D_HELP'				=> 'Flash : [flash=largeur,hauteur]http://url[/flash]',
	'BBCODE_F_HELP'				=> 'Taille de la police : [size=85]petit texte[/size]',
	'BBCODE_IS_OFF'				=> 'Les %sBBCodes%s sont <em>désactivés</em>',
	'BBCODE_IS_ON'				=> 'Les %sBBCodes%s sont <em>activés</em>',
	'BBCODE_I_HELP'				=> 'Texte italique : [i]texte[/i]',
	'BBCODE_L_HELP'				=> 'Liste : [list][*]texte[/list]',
	'BBCODE_LISTITEM_HELP'		=> 'Élément de liste : [*]texte',
	'BBCODE_O_HELP'				=> 'Liste numérotée : par exemple [list=1][*]Point 1[/list] ou [list=a][*]Point a[/list]',
	'BBCODE_P_HELP'				=> 'Insérer une image : [img]http://image_url[/img]',
	'BBCODE_Q_HELP'				=> 'Citation : [quote]texte[/quote]',
	'BBCODE_S_HELP'				=> 'Couleur de la police : [color=red]texte[/color] ou [color=#FF0000]texte[/color]',
	'BBCODE_U_HELP'				=> 'Texte souligné : [u]texte[/u]',
	'BBCODE_W_HELP'				=> 'Insérer un lien : [url]http://url[/url] ou [url=http://url]texte descriptif[/url]',
	'BBCODE_Y_HELP'				=> 'Liste : Ajouter une liste d’éléments',
	'BUMP_ERROR'				=> 'Vous ne pouvez pas faire remonter ce sujet aussitôt après l’ajout du dernier message.',

	'CANNOT_DELETE_REPLIED'		=> 'Désolé, vous ne pouvez supprimer que les messages n’ayant reçu aucune réponse.',
	'CANNOT_EDIT_POST_LOCKED'	=> 'Ce message a été verrouillé. Vous ne pouvez plus le modifier.',
	'CANNOT_EDIT_TIME'			=> 'Vous ne pouvez plus modifier ou supprimer ce message.',
	'CANNOT_POST_ANNOUNCE'		=> 'Désolé, vous ne pouvez pas créer d’annonces.',
	'CANNOT_POST_STICKY'		=> 'Désolé, vous ne pouvez pas créer de sujets épinglés.',
	'CHANGE_TOPIC_TO'			=> 'Changer le statut du sujet en',
	'CHARS_POST_CONTAINS'		=> array(
		1	=> 'Votre message contient %1$d caractère.',
		2	=> 'Votre message contient %1$d caractères.',
	),
	'CHARS_SIG_CONTAINS'		=> array(
		1	=> 'Votre signature contient %1$d caractère.',
		2	=> 'Votre signature contient %1$d caractères.',
	),
	'CLOSE_TAGS'				=> 'Fermer les balises',
	'CURRENT_TOPIC'				=> 'Sujet actuel',

	'DELETE_FILE'				=> 'Supprimer le fichier',
	'DELETE_MESSAGE'			=> 'Supprimer le message',
	'DELETE_MESSAGE_CONFIRM'	=> 'Êtes-vous sûr de vouloir supprimer ce message ?',
	'DELETE_OWN_POSTS'			=> 'Désolé, vous ne pouvez supprimer que vos propres messages.',
	'DELETE_PERMANENTLY'		=> 'Supprimer définitivement',
	'DELETE_POST_CONFIRM'		=> 'Êtes-vous sûr de vouloir supprimer ce message ?',
	'DELETE_POST_PERMANENTLY_CONFIRM'	=> 'Êtes-vous sûr de vouloir supprimer <strong>définitivement</strong> ce message ?',
	'DELETE_POST_PERMANENTLY'	=> array(
		1	=> 'Supprimer définitivement ce message, il ne pourra pas être restauré',
		2	=> 'Supprimer définitivement %1$d messages, ils ne pourront pas être restaurés',
	),
	'DELETE_POSTS_CONFIRM'		=> 'Êtes-vous sûr de vouloir supprimer ces messages ?',
	'DELETE_POSTS_PERMANENTLY_CONFIRM'	=> 'Êtes-vous sûr de vouloir supprimer <strong>définitivement</strong> ces messages ?',
	'DELETE_REASON'				=> 'Raison de la suppression',
	'DELETE_REASON_EXPLAIN'		=> 'La raison de la suppression sera visible par les modérateurs.',
	'DELETE_POST_WARN'			=> 'Supprimer ce message',
	'DELETE_TOPIC_CONFIRM'		=> 'Êtes-vous sûr de vouloir supprimer ce sujet ?',
	'DELETE_TOPIC_PERMANENTLY'	=> array(
		1	=> 'Supprimer définitivement ce sujet, il ne pourra pas être restauré',
		2	=> 'Supprimer définitivement %1$d sujets, ils ne pourront pas être restaurés',
	),
	'DELETE_TOPIC_PERMANENTLY_CONFIRM'	=> 'Êtes-vous sûr de vouloir supprimer <strong>définitivement</strong> ce sujet ?',
	'DELETE_TOPICS_CONFIRM'		=> 'Êtes-vous sûr de vouloir supprimer ces sujets ?',
	'DELETE_TOPICS_PERMANENTLY_CONFIRM'	=> 'Êtes-vous sûr de vouloir supprimer <strong>définitivement</strong> ces sujets ?',
	'DISABLE_BBCODE'			=> 'Désactiver les BBCodes',
	'DISABLE_MAGIC_URL'			=> 'Désactiver les liens',
	'DISABLE_SMILIES'			=> 'Désactiver les smileys',
	'DISALLOWED_CONTENT'		=> 'Le chargement a été rejeté car le fichier envoyé a été identifié comme un éventuel vecteur d’attaque.',
	'DISALLOWED_EXTENSION'		=> 'L’extension %s n’est pas autorisée.',
	'DRAFT_LOADED'				=> 'Brouillon chargé dans la zone de rédaction de message, vous pouvez finir votre message maintenant.<br>Le brouillon sera supprimé dès que vous aurez posté votre message.',
	'DRAFT_LOADED_PM'			=> 'Brouillon chargé dans la zone de rédaction de message privé, vous pouvez finir votre message maintenant.<br>Le brouillon sera supprimé dès que vous aurez envoyé votre message privé.',
	'DRAFT_SAVED'				=> 'Le brouillon a été sauvegardé.',
	'DRAFT_TITLE'				=> 'Titre du brouillon',

	'EDIT_REASON'				=> 'Raison de la modification du message',
	'EMPTY_FILEUPLOAD'			=> 'Le fichier transféré est vide ou n’existe pas.',
	'EMPTY_MESSAGE'				=> 'Votre message est vide !',
	'EMPTY_REMOTE_DATA'			=> 'Le fichier n’a pas pu être transféré, essayez de le transférer manuellement.',

	'FLASH_IS_OFF'				=> '[flash] est <em>désactivé</em>',
	'FLASH_IS_ON'				=> '[flash] est <em>activé</em>',
	'FLOOD_ERROR'				=> 'Vous ne pouvez pas poster un nouveau message, si tôt après le dernier.',
	'FONT_COLOR'				=> 'Couleur de la police',
	'FONT_COLOR_HIDE'			=> 'Masquer les couleurs de la police',
	'FONT_HUGE'					=> 'Très grande',
	'FONT_LARGE'				=> 'Grande',
	'FONT_NORMAL'				=> 'Normale',
	'FONT_SIZE'					=> 'Taille de la police',
	'FONT_SMALL'				=> 'Petite',
	'FONT_TINY'					=> 'Très petite',

	'GENERAL_UPLOAD_ERROR'		=> 'Impossible de transférer le fichier joint de %s.',

	'IMAGES_ARE_OFF'			=> '[img] est <em>désactivé</em>',
	'IMAGES_ARE_ON'				=> '[img] est <em>activé</em>',
	'INVALID_FILENAME'			=> '%s est un nom de fichier invalide.',

	'LOAD'						=> 'Charger',
	'LOAD_DRAFT'				=> 'Charger un brouillon',
	'LOAD_DRAFT_EXPLAIN'		=> 'Vous pouvez charger le brouillon que vous souhaitez finir. La publication de votre message actuel sera annulée et l’intégralité de son contenu sera supprimée. Vous pouvez consulter, modifier et supprimer vos brouillons depuis le panneau de l’utilisateur.',
	'LOGIN_EXPLAIN_BUMP'		=> 'Vous devez être connecté pour remonter un sujet de ce forum.',
	'LOGIN_EXPLAIN_DELETE'		=> 'Vous devez être connecté pour supprimer définitivement des messages dans ce forum.',
	'LOGIN_EXPLAIN_SOFT_DELETE'	=> 'Vous devez être connecté pour supprimer des messages dans ce forum.',
	'LOGIN_EXPLAIN_POST'		=> 'Vous devez être connecté pour poster dans ce forum.',
	'LOGIN_EXPLAIN_QUOTE'		=> 'Vous devez être connecté pour citer des messages dans ce forum.',
	'LOGIN_EXPLAIN_REPLY'		=> 'Vous devez être connecté pour répondre aux sujets de ce forum.',

	'MAX_FONT_SIZE_EXCEEDED'	=> 'Vous pouvez seulement employer des polices dont la taille maximum est de %d.',
	'MAX_FLASH_HEIGHT_EXCEEDED'	=> array(
		1	=> 'Vos animations flash ne doivent pas dépasser %d pixel de haut.',
		2	=> 'Vos animations flash ne doivent pas dépasser %d pixels de haut.',
	),
	'MAX_FLASH_WIDTH_EXCEEDED'	=> array(
		1	=> 'Vos animations flash ne doivent pas dépasser %d pixel de large.',
		2	=> 'Vos animations flash ne doivent pas dépasser %d pixels de large.',
	),
	'MAX_IMG_HEIGHT_EXCEEDED'	=> array(
		1	=> 'Vos images ne doivent pas dépasser %1$d pixel de haut.',
		2	=> 'Vos images ne doivent pas dépasser %1$d pixels de haut.',
	),
	'MAX_IMG_WIDTH_EXCEEDED'	=> array(
		1	=> 'Vos images ne doivent pas dépasser %d pixel de large.',
		2	=> 'Vos images ne doivent pas dépasser %d pixels de large.',
	),

	'MESSAGE_BODY_EXPLAIN'		=> array(
		0	=> '', // zero means no limit, so we don't view a message here.
		1	=> 'Votre saisie ne doit pas contenir plus de <strong>%d</strong> caractère.',
		2	=> 'Votre saisie ne doit pas contenir plus de <strong>%d</strong> caractères.',
	),
	'MESSAGE_DELETED'			=> 'Votre message a été supprimé.',
	'MORE_SMILIES'				=> 'Voir plus de smileys',

	'NOTIFY_REPLY'				=> 'M’avertir lorsqu’une réponse est postée.',
	'NOT_UPLOADED'				=> 'Le fichier ne peut pas être transféré.',
	'NO_DELETE_POLL_OPTIONS'	=> 'Vous ne pouvez pas supprimer les options du sondage existantes.',
	'NO_PM_ICON'				=> 'Aucune',
	'NO_POLL_TITLE'				=> 'Vous devez saisir un titre de sondage.',
	'NO_POST'					=> 'Le message demandé n’existe pas.',
	'NO_POST_MODE'				=> 'Aucun type de message n’est indiqué.',
	'NO_TEMP_DIR'				=> 'Le répertoire temporaire n’existe pas ou n’est pas accessible en écriture.',

	'PARTIAL_UPLOAD'			=> 'Le fichier n’a été que partiellement transféré.',
	'PHP_UPLOAD_STOPPED'		=> 'Une extension de PHP a interrompu le transfert du fichier.',
	'PHP_SIZE_NA'				=> 'La taille du fichier joint est trop grande.<br>Impossible de déterminer la taille maximale définie par PHP dans php.ini.',
	'PHP_SIZE_OVERRUN'			=> 'La taille du fichier joint est trop grande, la taille maximale de chargement est de %1$d %2$s.<br>Notez que ce paramètre se trouve dans php.ini et ne peut pas être outrepassé.',
	'PLACE_INLINE'				=> 'Insérer dans le message',
	'POLL_DELETE'				=> 'Supprimer le sondage',
	'POLL_FOR'					=> 'Durée du sondage',
	'POLL_FOR_EXPLAIN'			=> 'Mettre « 0 » pour une durée de sondage illimitée.',
	'POLL_MAX_OPTIONS'			=> 'Option(s) par utilisateur',
	'POLL_MAX_OPTIONS_EXPLAIN'	=> 'Ceci est le nombre d’options que chaque utilisateur peut choisir quand il vote.',
	'POLL_OPTIONS'				=> 'Options du sondage',
	'POLL_OPTIONS_EXPLAIN'		=> array(
		1	=> 'Placez chaque option sur une ligne différente. Vous ne pouvez saisir que <strong>%d</strong> option.',
		2	=> 'Placez chaque option sur une ligne différente. Vous pouvez saisir jusqu’à <strong>%d</strong> options.',
	),
	'POLL_OPTIONS_EDIT_EXPLAIN'		=> array(
		1	=> 'Placez chaque option sur une ligne différente. Vous ne pouvez saisir que <strong>%d</strong> option. Si vous supprimez ou ajoutez des options, tous les votes précédents seront remis à zéro.',
		2	=> 'Placez chaque option sur une ligne différente. Vous pouvez saisir jusqu’à <strong>%d</strong> options. Si vous supprimez ou ajoutez des options, tous les votes précédents seront remis à zéro.',
	),
	'POLL_QUESTION'				=> 'Question du sondage',
	'POLL_TITLE_TOO_LONG'		=> 'Le titre du sondage doit contenir moins de 100 caractères.',
	'POLL_TITLE_COMP_TOO_LONG'	=> 'La taille du titre du sondage est trop importante, essayez de retirer les BBCodes et/ou les smileys.',
	'POLL_VOTE_CHANGE'			=> 'Permettre de voter à nouveau',
	'POLL_VOTE_CHANGE_EXPLAIN'	=> 'Si activé, les utilisateurs peuvent changer leur vote.',
	'POSTED_ATTACHMENTS'		=> 'Fichiers joints postés',
	'POST_APPROVAL_NOTIFY'		=> 'Vous serez averti lorsque votre message sera approuvé.',
	'POST_CONFIRMATION'			=> 'Confirmation du message',
	'POST_CONFIRM_EXPLAIN'		=> 'Afin de lutter contre le spam de messages instantanés, l’administrateur souhaite que vous entriez un code de confirmation. Le code apparaît dans l’image que vous devriez voir ci-dessous. Si vous êtes déficient visuel ou si vous ne pouvez pas lire ce code, contactez %sl’administrateur du forum%s.',
	'POST_DELETED'				=> 'Le message a été supprimé.',
	'POST_EDITED'				=> 'Votre message a été modifié.',
	'POST_EDITED_MOD'			=> 'Votre message a été modifié, mais requiert l’approbation d’un modérateur avant d’être rendu visible publiquement.',
	'POST_GLOBAL'				=> 'Annonce globale',
	'POST_ICON'					=> 'Icône de message',
	'POST_NORMAL'				=> 'Normal',
	'POST_REVIEW'				=> 'Revue du sujet',
	'POST_REVIEW_EDIT'			=> 'Revue du sujet',
	'POST_REVIEW_EDIT_EXPLAIN'	=> 'Ce message a été modifié par un autre utilisateur pendant que vous étiez entrain de le modifier. Vous pouvez revoir la version actuelle de ce message et ajuster vos modifications.',
	'POST_REVIEW_EXPLAIN'		=> 'Au moins un nouveau message a été ajouté à ce sujet entre-temps. Vous pouvez revoir votre message en conséquence.',
	'POST_STORED'				=> 'Votre message a été posté.',
	'POST_STORED_MOD'			=> 'Votre message a été posté, mais requiert l’approbation d’un modérateur avant d’être rendu visible publiquement.',
	'POST_TOPIC_AS'				=> 'Poster le sujet en tant que',
	'PROGRESS_BAR'				=> 'Barre de progression',

	'QUOTE_DEPTH_EXCEEDED'		=> array(
		1	=> 'Le nombre d’imbrication de citations est limité à %d niveau.',
		2	=> 'Le nombre d’imbrication de citations est limité à %d niveaux.',
	),
	'QUOTE_NO_NESTING'			=> 'Vous ne pouvez pas imbriquer des citations dans une autre.',

	'REMOTE_UPLOAD_TIMEOUT'		=> 'Le fichier spécifié n’a pas pu être transféré parce que le délai d’attente de la demande a expiré.',
	'SAVE'						=> 'Sauvegarder',
	'SAVE_DATE'					=> 'Sauvegardé le',
	'SAVE_DRAFT'				=> 'Sauvegarder le brouillon',
	'SAVE_DRAFT_CONFIRM'		=> 'Notez que les brouillons sauvegardés ne conservent que le titre et le texte du message, tout autre élément sera ignoré. Souhaitez-vous sauvegarder votre brouillon maintenant ?',
	'SMILIES'					=> 'Smileys',
	'SMILIES_ARE_OFF'			=> 'Les smileys sont <em>désactivés</em>',
	'SMILIES_ARE_ON'			=> 'Les smileys sont <em>activés</em>',
	'STICKY_ANNOUNCE_TIME_LIMIT'=> 'Durée du sujet épinglé, de l’annonce ou de l’annonce globale',
	'STICK_TOPIC_FOR'			=> 'Épingler pendant',
	'STICK_TOPIC_FOR_EXPLAIN'	=> 'Mettre « 0 » pour placer un sujet en « Épinglé » , « Annonce » ou « Annonce globale » pour une durée illimitée. Notez que le nombre saisi part de la date de création du sujet.',
	'STYLES_TIP'				=> 'Astuce : les mises en forme peuvent être appliquées rapidement en sélectionnant le texte.',

	'TOO_FEW_CHARS'				=> 'Votre message ne contient aucun caractère.',
	'TOO_FEW_CHARS_LIMIT'		=> array(
		1	=> 'Vous devez saisir au moins %1$d caractère.',
		2	=> 'Vous devez saisir au moins %1$d caractères.',
	),
	'TOO_FEW_POLL_OPTIONS'		=> 'Vous devez saisir au moins deux options possibles au sondage.',
	'TOO_MANY_ATTACHMENTS'		=> 'Impossible d’ajouter un nouveau fichier joint, %d est le maximum autorisé.',
	'TOO_MANY_CHARS'			=> 'Votre message contient trop de caractères.',
	'TOO_MANY_CHARS_LIMIT'		=> array(
		2	=> 'Le nombre maximum de caractères autorisés est de %1$d.',
	),
	'TOO_MANY_POLL_OPTIONS'		=> 'Vous avez dépassé le nombre d’options de sondage possible.',
	'TOO_MANY_SMILIES'			=> 'Votre message contient trop de smileys. Un maximum de %d smiley(s) est autorisé.',
	'TOO_MANY_URLS'				=> 'Votre message contient trop de liens. Un maximum de %d lien(s) est autorisé.',
	'TOO_MANY_USER_OPTIONS'		=> 'Vous ne pouvez pas indiquer un nombre d’options par utilisateur supérieur au nombre d’options du sondage.',
	'TOPIC_BUMPED'				=> 'Le sujet a été remonté.',

	'UNAUTHORISED_BBCODE'		=> 'Vous ne pouvez pas utiliser certains BBCodes : %s.',
	'UNSUPPORTED_CHARACTERS_MESSAGE'	=> 'Votre message contient les caractères non supportés suivants :<br>%s',
	'UNSUPPORTED_CHARACTERS_SUBJECT'	=> 'Votre objet contient les caractères non supportés suivants :<br>%s',
	'UPDATE_COMMENT'			=> 'Mettre à jour le commentaire',
	'URL_INVALID'				=> 'Le lien indiqué est invalide.',
	'URL_NOT_FOUND'				=> 'Le fichier indiqué n’a pas été trouvé.',
	'URL_IS_OFF'				=> '[url] est <em>désactivé</em>',
	'URL_IS_ON'					=> '[url] est <em>activé</em>',
	'USER_CANNOT_BUMP'			=> 'Vous ne pouvez pas remonter de sujets dans ce forum.',
	'USER_CANNOT_DELETE'		=> 'Vous ne pouvez pas supprimer de messages dans ce forum.',
	'USER_CANNOT_EDIT'			=> 'Vous ne pouvez pas modifier de messages dans ce forum.',
	'USER_CANNOT_REPLY'			=> 'Vous ne pouvez pas répondre à un sujet dans ce forum.',
	'USER_CANNOT_FORUM_POST'	=> 'Vous ne pouvez pas effectuer d’opérations sur ce forum car ce type de forum ne le permet pas.',

	'VIEW_MESSAGE'				=> '%sVoir le message envoyé%s',
	'VIEW_PRIVATE_MESSAGE'		=> '%sVoir le message privé envoyé%s',

	'WRONG_FILESIZE'			=> 'Le fichier est trop volumineux, la taille maximum autorisée est de %1$d %2$s.',
	'WRONG_SIZE'				=> 'L’image doit faire au moins %1$s de large, %2$s de haut et au plus %3$s de large et %4$s de haut. L’image actuelle fait %5$s pixels de large et %6$s pixels de haut.',
));
