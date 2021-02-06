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

// Board Settings
$lang = array_merge($lang, array(
	'ACP_BOARD_SETTINGS_EXPLAIN'	=> 'Vous pouvez modifier les paramètres de base de votre forum, depuis le nom du site jusqu’à la validation de l’enregistrement par message privé.',
	'BOARD_INDEX_TEXT'				=> 'Libellé de l’index du forum',
	'BOARD_INDEX_TEXT_EXPLAIN'		=> 'Ce texte est affiché comme index du forum dans le fil d’Ariane du forum. La valeur « Index du forum » sera utilisée si rien n’est spécifié.',
	'BOARD_STYLE'					=> 'Style du forum',
	'CUSTOM_DATEFORMAT'				=> 'Personnalisée',
	'DEFAULT_DATE_FORMAT'			=> 'Format de la date',
	'DEFAULT_DATE_FORMAT_EXPLAIN'	=> 'Le format de la date est le même que la fonction <code><a href="https://www.php.net/manual/fr/function.date.php">date()</a></code> de PHP.',
	'DEFAULT_LANGUAGE'				=> 'Langue par défaut',
	'DEFAULT_STYLE'					=> 'Style par défaut',
	'DEFAULT_STYLE_EXPLAIN'			=> 'Définit le style par défaut pour les nouveaux membres.',
	'DISABLE_BOARD'					=> 'Désactiver le forum',
	'DISABLE_BOARD_EXPLAIN'			=> 'Ceci va rendre le forum inaccessible aux utilisateurs qui ne sont ni administrateurs, ni modérateurs. Vous pouvez aussi saisir un message court (255 caractères) pour leur en expliquer la raison.',
	'DISPLAY_LAST_SUBJECT'			=> 'Afficher le titre du dernier message dans la liste des forums',
	'DISPLAY_LAST_SUBJECT_EXPLAIN'	=> 'Le titre du dernier message posté sera affiché dans la liste des forums avec un lien pointant vers ce message. Les titres de sujet ne seront pas affichés lorsque le sujet provient d’un forum protégé par mot de passe ou provient d’un forum pour lequel l’utilisateur n’a pas d’accès en lecture.',
	'DISPLAY_UNAPPROVED_POSTS'		=> 'Afficher les messages non approuvés à l’auteur',
	'DISPLAY_UNAPPROVED_POSTS_EXPLAIN'	=> 'Les messages non approuvés peuvent être consultés par l’auteur. Ne s’applique pas aux messages d’invités.',
	'GUEST_STYLE'					=> 'Styles pour les invités',
	'GUEST_STYLE_EXPLAIN'			=> 'Définit le style par défaut pour les invités.',
	'OVERRIDE_STYLE'				=> 'Annuler le style de l’utilisateur',
	'OVERRIDE_STYLE_EXPLAIN'		=> 'Remplace le style du membre (et de l’invité) par le style défini dans « Style par défaut ».',
	'SITE_DESC'						=> 'Description du site',
	'SITE_HOME_TEXT'				=> 'Libellé du site Internet',
	'SITE_HOME_TEXT_EXPLAIN'		=> 'Ce texte sera affiché en tant que lien vers la page d’accueil de votre site dans le fil d’Ariane. La valeur « Accueil » sera utilisée si rien n’est spécifié.',
	'SITE_HOME_URL'					=> 'URL du site Internet',
	'SITE_HOME_URL_EXPLAIN'			=> 'Si défini, un lien vers cette URL sera ajouté sur le fil d’Ariane et le logo. Ce lien redirigera vers cette page au lieu de renvoyer vers l’index du forum. Une URL absolue est requise, par exemple <samp>https://www.phpbb.com</samp>.',
	'SITE_NAME'						=> 'Nom du site',
	'SYSTEM_TIMEZONE'				=> 'Fuseau horaire des invités',
	'SYSTEM_TIMEZONE_EXPLAIN'		=> 'Définit le fuseau horaire à utiliser pour les utilisateurs qui ne sont pas connectés (invités, robots). Les membres définissent ce paramètre lors de leur enregistrement sur le forum et peuvent le changer depuis leur panneau de l’utilisateur.',
	'WARNINGS_EXPIRE'				=> 'Durée de l’avertissement',
	'WARNINGS_EXPIRE_EXPLAIN'		=> 'Nombre de jours qui s’écoulera avant qu’un avertissement n’expire automatiquement. Mettre « 0 » pour que l’avertissement soit permanent.',
));

// Board Features
$lang = array_merge($lang, array(
	'ACP_BOARD_FEATURES_EXPLAIN'	=> 'Vous pouvez activer/désactiver plusieurs fonctionnalités du forum.',

	'ALLOW_ATTACHMENTS'			=> 'Autoriser les fichiers joints',
	'ALLOW_BIRTHDAYS'			=> 'Autoriser les anniversaires',
	'ALLOW_BIRTHDAYS_EXPLAIN'	=> 'Autorise la saisie des dates anniversaires et l’affichage de l’âge dans les profils. Notez que l’affichage des anniversaires sur l’index du forum est contrôlé par un paramètre de charge différent.',
	'ALLOW_BOOKMARKS'			=> 'Autoriser la mise en favoris des sujets',
	'ALLOW_BOOKMARKS_EXPLAIN'	=> 'Le membre est autorisé à mettre des sujets en favoris.',
	'ALLOW_BBCODE'				=> 'Autoriser les BBCodes',
	'ALLOW_FORUM_NOTIFY'		=> 'Autoriser la surveillance des forums',
	'ALLOW_NAME_CHANGE'			=> 'Autoriser les changements de nom d’utilisateur',
	'ALLOW_NO_CENSORS'			=> 'Autoriser la désactivation de la censure',
	'ALLOW_NO_CENSORS_EXPLAIN'	=> 'Les membres peuvent choisir de désactiver la censure automatique des messages ou messages privés.',
	'ALLOW_PM_ATTACHMENTS'		=> 'Autoriser les fichiers joints dans les messages privés',
	'ALLOW_PM_REPORT'			=> 'Autoriser les membres à rapporter les messages privés',
	'ALLOW_PM_REPORT_EXPLAIN'	=> 'Si cette option est activée, les membres ont la possibilité de rapporter aux modérateurs du forum un message privé qu’ils ont reçu ou envoyé. Ces messages privés seront alors visibles dans le panneau de modération.',
	'ALLOW_QUICK_REPLY'			=> 'Autoriser la réponse rapide',
	'ALLOW_QUICK_REPLY_EXPLAIN'	=> 'Cette option vous permet de désactiver le module de réponse rapide sur l’ensemble du forum. Si activé, les paramètres spécifiques au forum seront utilisés pour déterminer si la réponse rapide est affichée pour chacun des forums.',
	'ALLOW_QUICK_REPLY_BUTTON'	=> 'Soumettre et activer la réponse rapide dans tous les forums',
	'ALLOW_SIG'					=> 'Autoriser les signatures',
	'ALLOW_SIG_BBCODE'			=> 'Autoriser les BBCodes dans la signature des membres',
	'ALLOW_SIG_FLASH'			=> 'Autoriser l’utilisation du BBCode <code>[FLASH]</code> dans la signature des membres',
	'ALLOW_SIG_IMG'				=> 'Autoriser l’utilisation du BBCode <code>[IMG]</code> dans la signature des membres',
	'ALLOW_SIG_LINKS'			=> 'Autoriser les liens dans la signature des membres',
	'ALLOW_SIG_LINKS_EXPLAIN'	=> 'Si désactivé, le BBCode <code>[URL]</code> et la transformation automatique des textes en liens seront désactivés.',
	'ALLOW_SIG_SMILIES'			=> 'Autoriser les smileys dans la signature des membres',
	'ALLOW_SMILIES'				=> 'Autoriser les smileys',
	'ALLOW_TOPIC_NOTIFY'		=> 'Autoriser la surveillance des sujets',
	'BOARD_PM'					=> 'Messagerie privée',
	'BOARD_PM_EXPLAIN'			=> 'Activer la messagerie privée pour tous les membres.',
	'ALLOW_BOARD_NOTIFICATIONS'	=> 'Autoriser les notifications du forum',
));

// Avatar Settings
$lang = array_merge($lang, array(
	'ACP_AVATAR_SETTINGS_EXPLAIN'	=> 'Les avatars sont généralement de petites images uniques qu’un membre choisit pour le représenter. Selon le style, ils sont normalement affichés sous le nom d’utilisateur lors de la visualisation de sujets. Vous pouvez choisir quelle méthode le membre peut utiliser pour choisir son avatar. Dans le cas où vous autorisez le transfert d’avatars, vous devez indiquer ci-dessous le nom du répertoire en question et vous assurer des droits en écriture de ce répertoire. Notez également que les limitations de taille ne sont imposées qu’aux avatars transférés et ne concernent pas les avatars dont on aura fourni un lien externe.',

	'ALLOW_AVATARS'					=> 'Activer les avatars',
	'ALLOW_AVATARS_EXPLAIN'			=> 'Autorise l’utilisation générale des avatars ;<br>si vous désactivez l’utilisation générale des avatars alors les avatars ne seront plus affichés sur le forum, et les membres n’auront plus accès au module de gestion des avatars présent dans leur panneau d’utilisateur.',
	'ALLOW_GRAVATAR'				=> 'Activer les Gravatars',
	'ALLOW_LOCAL'					=> 'Activer la galerie d’avatars',
	'ALLOW_REMOTE'					=> 'Autoriser les avatars distants',
	'ALLOW_REMOTE_EXPLAIN'			=> 'Avatars liés depuis un autre site.<br><em><strong class="error">Attention :</strong> l’activation de cette fonctionnalité peut permettre aux utilisateurs de vérifier l’existence de fichiers et de services qui ne sont accessibles que depuis le réseau local.</em>',
	'ALLOW_REMOTE_UPLOAD'			=> 'Autoriser le transfert distant d’avatars',
	'ALLOW_REMOTE_UPLOAD_EXPLAIN'	=> 'Autorise le transfert d’avatars depuis un autre site Internet.<br><em><strong class="error">Attention :</strong> l’activation de cette fonctionnalité peut permettre aux utilisateurs de vérifier l’existence de fichiers et de services qui ne sont accessibles que depuis le réseau local.</em>',
	'ALLOW_UPLOAD'					=> 'Autoriser le transfert d’avatar',
	'AVATAR_GALLERY_PATH'			=> 'Répertoire de la galerie d’avatars',
	'AVATAR_GALLERY_PATH_EXPLAIN'	=> 'Chemin d’accès depuis le répertoire racine de phpBB vers les images préchargées, exemple : <samp>images/avatars/gallery</samp>.<br>Les doubles points tels que <samp>../</samp> seront supprimés du chemin d’accès pour des raisons de sécurité.',
	'AVATAR_STORAGE_PATH'			=> 'Répertoire de stockage des avatars',
	'AVATAR_STORAGE_PATH_EXPLAIN'	=> 'Chemin d’accès depuis le répertoire racine de phpBB, exemple : <samp>images/avatars/upload</samp>.<br>Le transfert d’avatars <strong>ne sera pas disponible</strong> si ce chemin n’est pas accessible en écriture.<br>Les doubles points tels que <samp>../</samp> seront supprimés du chemin d’accès pour des raisons de sécurité.',
	'MAX_AVATAR_SIZE'				=> 'Dimensions maximales d’un avatar',
	'MAX_AVATAR_SIZE_EXPLAIN'		=> 'Largeur x Hauteur en pixels.',
	'MAX_FILESIZE'					=> 'Taille maximale d’un avatar',
	'MAX_FILESIZE_EXPLAIN'			=> 'Pour les avatars transférés. Si cette valeur est « 0 », la taille du fichier transféré est uniquement limitée par votre configuration PHP.',
	'MIN_AVATAR_SIZE'				=> 'Dimensions minimales d’un avatar',
	'MIN_AVATAR_SIZE_EXPLAIN'		=> 'Largeur x Hauteur en pixels.',
));

// Message Settings
$lang = array_merge($lang, array(
	'ACP_MESSAGE_SETTINGS_EXPLAIN'		=> 'Vous pouvez modifier tous les paramètres de la messagerie privée.',

	'ALLOW_BBCODE_PM'			=> 'Autoriser les BBCodes dans les messages privés',
	'ALLOW_FLASH_PM'			=> 'Autoriser l’utilisation du BBCode <code>[FLASH]</code>',
	'ALLOW_FLASH_PM_EXPLAIN'	=> 'Notez que l’utilisation du Flash dans les messages privés, si activé ici, dépend également des permissions.',
	'ALLOW_FORWARD_PM'			=> 'Autoriser le transfert des messages privés',
	'ALLOW_IMG_PM'				=> 'Autoriser l’utilisation du BBCode <code>[IMG]</code>',
	'ALLOW_MASS_PM'				=> 'Autoriser l’envoi de messages privés à plusieurs membres et groupes',
	'ALLOW_MASS_PM_EXPLAIN'		=> 'L’envoi aux groupes peut être ajusté par groupe dans l’écran de réglage du groupe.',
	'ALLOW_PRINT_PM'			=> 'Autoriser la visualisation de l’impression dans la messagerie privée',
	'ALLOW_QUOTE_PM'			=> 'Autoriser les citations dans les messages privés',
	'ALLOW_SIG_PM'				=> 'Autoriser les signatures dans les messages privés',
	'ALLOW_SMILIES_PM'			=> 'Autoriser les smileys dans les messages privés',
	'BOXES_LIMIT'				=> 'Nombre de messages privés maximum par dossier',
	'BOXES_LIMIT_EXPLAIN'		=> 'Les membres ne peuvent pas recevoir plus que ce nombre de messages dans chacun de leurs dossiers de message privé. Mettre « 0 » pour permettre un nombre de message illimité.',
	'BOXES_MAX'					=> 'Nombre maximum de dossiers',
	'BOXES_MAX_EXPLAIN'			=> 'Les membres peuvent créer ce nombre de dossiers pour leurs messages privés.',
	'ENABLE_PM_ICONS'			=> 'Autoriser les icônes de sujet dans les messages privés',
	'FULL_FOLDER_ACTION'		=> 'Action par défaut lorsqu’un dossier est plein',
	'FULL_FOLDER_ACTION_EXPLAIN'=> 'Action par défaut à effectuer lorsque le dossier d’un membre est plein, dans le cas où l’action indiquée par le membre n’est pas applicable. La seule exception s’applique au dossier des « Messages envoyés » où l’action par défaut est de supprimer les anciens messages.',
	'HOLD_NEW_MESSAGES'			=> 'Rejeter les nouveaux messages',
	'PM_EDIT_TIME'				=> 'Limiter le temps de modification',
	'PM_EDIT_TIME_EXPLAIN'		=> 'Définit la limite de temps autorisée pour modifier un message privé qui n’a pas encore été délivré. Mettre « 0 » pour illimité.',
	'PM_MAX_RECIPIENTS'			=> 'Nombre maximum autorisé de destinataires',
	'PM_MAX_RECIPIENTS_EXPLAIN'	=> 'Le nombre maximum autorisé de destinataires d’un message privé. Une valeur à « 0 » indique un nombre illimité de destinataires. Ce paramètre peut être ajusté pour chaque groupe dans l’écran de réglage du groupe.',
));

// Post Settings
$lang = array_merge($lang, array(
	'ACP_POST_SETTINGS_EXPLAIN'			=> 'Vous pouvez définir tous les paramètres par défaut pour les messages.',
	'ALLOW_POST_LINKS'					=> 'Autoriser les liens dans les messages et messages privés',
	'ALLOW_POST_LINKS_EXPLAIN'			=> 'Si désactivé, le BBCode <code>[URL]</code> et la transformation automatique des textes en liens seront désactivés.',
	'ALLOWED_SCHEMES_LINKS'				=> 'Schémas autorisés dans les liens',
	'ALLOWED_SCHEMES_LINKS_EXPLAIN'		=> 'Les membres peuvent poster des URL sans spécifier le schéma du lien ou en utilisant un de ceux définis dans la liste suivante, séparés par une virgule.',
	'ALLOW_POST_FLASH'					=> 'Autoriser l’utilisation du BBCode <code>[FLASH]</code> dans les messages',
	'ALLOW_POST_FLASH_EXPLAIN'			=> 'Si désactivé, le BBCode <code>[FLASH]</code> sera désactivé. Autrement, le système de permission déterminera les membres pouvant utiliser le BBCode <code>[FLASH]</code>.',

	'BUMP_INTERVAL'					=> 'Intervalle de remontée des sujets',
	'BUMP_INTERVAL_EXPLAIN'			=> 'Nombre de minutes, d’heures, ou de jours entre la date du dernier message et la possibilité de remonter le sujet. Mettre « 0 » pour désactiver complètement la remontée des sujets.',
	'CHAR_LIMIT'					=> 'Nombre maximum de caractères par message',
	'CHAR_LIMIT_EXPLAIN'			=> 'Le nombre de caractères autorisés dans un message. Mettre « 0 » pour illimité.',
	'DELETE_TIME'					=> 'Limiter le temps de suppression',
	'DELETE_TIME_EXPLAIN'			=> 'Limite le temps disponible pour effacer un nouveau message. Mettre « 0 » pour désactiver cette fonctionnalité.',
	'DISPLAY_LAST_EDITED'			=> 'Afficher les informations de la dernière modification',
	'DISPLAY_LAST_EDITED_EXPLAIN'	=> 'Choisissez si les informations de la dernière modification doivent être affichées ou non dans les messages.',
	'EDIT_TIME'						=> 'Limiter le temps de modification',
	'EDIT_TIME_EXPLAIN'				=> 'Définit la limite de temps autorisée pour modifier un message après l’avoir posté. Mettre « 0 » pour illimité.',
	'FLOOD_INTERVAL'				=> 'Intervalle de flood',
	'FLOOD_INTERVAL_EXPLAIN'		=> 'Nombre de secondes à patienter avant qu’un utilisateur puisse publier de nouveaux messages. Pour autoriser les membres à passer outre, modifiez leurs permissions.',
	'HOT_THRESHOLD'					=> 'Seuil de popularité des sujets',
	'HOT_THRESHOLD_EXPLAIN'			=> 'Nombre de messages requis afin qu’un sujet soit affiché comme étant populaire. Mettre « 0 » pour désactiver les sujets populaires.',
	'MAX_POLL_OPTIONS'				=> 'Nombre maximum d’options de vote',
	'MAX_POST_FONT_SIZE'			=> 'Taille maximale de la police',
	'MAX_POST_FONT_SIZE_EXPLAIN'	=> 'Taille maximale de la police dans un message. Mettre « 0 » pour illimité.',
	'MAX_POST_IMG_HEIGHT'			=> 'Hauteur maximale d’un fichier flash',
	'MAX_POST_IMG_HEIGHT_EXPLAIN'	=> 'Hauteur maximale d’un fichier flash dans un message. Mettre « 0 » pour illimité.',
	'MAX_POST_IMG_WIDTH'			=> 'Largeur maximale d’un fichier flash',
	'MAX_POST_IMG_WIDTH_EXPLAIN'	=> 'Largeur maximale d’un fichier flash dans un message. Mettre « 0 » pour illimité.',
	'MAX_POST_URLS'					=> 'Nombre maximum de liens',
	'MAX_POST_URLS_EXPLAIN'			=> 'Nombre maximum de liens dans un message. Mettre « 0 » pour illimité.',
	'MIN_CHAR_LIMIT'				=> 'Nombre minimum de caractères par message',
	'MIN_CHAR_LIMIT_EXPLAIN'		=> 'Nombre minimum de caractères que l’utilisateur doit saisir dans un message/message privé. Le minimum pour ce paramètre est « 1 ».',
	'POSTING'						=> 'Publication',
	'POSTS_PER_PAGE'				=> 'Messages par page',
	'QUOTE_DEPTH_LIMIT'				=> 'Nombre maximum de citations imbriquées',
	'QUOTE_DEPTH_LIMIT_EXPLAIN'		=> 'Nombre maximum de citations imbriquées dans un message. Mettre « 0 » pour illimité.',
	'SMILIES_LIMIT'					=> 'Nombre maximum de smileys par message',
	'SMILIES_LIMIT_EXPLAIN'			=> 'Nombre maximum de smileys dans un message. Mettre « 0 » pour illimité.',
	'SMILIES_PER_PAGE'				=> 'Smileys par page',
	'TOPICS_PER_PAGE'				=> 'Sujets par page',
));

// Signature Settings
$lang = array_merge($lang, array(
	'ACP_SIGNATURE_SETTINGS_EXPLAIN'	=> 'Vous pouvez modifier les paramètres pour les signatures.',

	'MAX_SIG_FONT_SIZE'				=> 'Taille maximale de la police dans les signatures',
	'MAX_SIG_FONT_SIZE_EXPLAIN'		=> 'Définit la taille de police maximale autorisée dans la signature d’un membre. Mettre « 0 » pour illimité.',
	'MAX_SIG_IMG_HEIGHT'			=> 'Hauteur maximale d’une image dans les signatures',
	'MAX_SIG_IMG_HEIGHT_EXPLAIN'	=> 'Définit la hauteur maximale d’un fichier image/flash autorisée dans la signature d’un membre. Mettre « 0 » pour illimité.',
	'MAX_SIG_IMG_WIDTH'				=> 'Largeur maximale d’une image dans les signatures',
	'MAX_SIG_IMG_WIDTH_EXPLAIN'		=> 'Définit la largeur maximale d’un fichier image/flash autorisée dans la signature d’un membre. Mettre « 0 » pour illimité.',
	'MAX_SIG_LENGTH'				=> 'Longueur maximale des signatures',
	'MAX_SIG_LENGTH_EXPLAIN'		=> 'Définit le nombre de caractères maximum autorisés dans la signature d’un membre.',
	'MAX_SIG_SMILIES'				=> 'Nombre maximum de smileys par signature',
	'MAX_SIG_SMILIES_EXPLAIN'		=> 'Définit le nombre maximum de smileys autorisés dans la signature d’un membre. Mettre « 0 » pour illimité.',
	'MAX_SIG_URLS'					=> 'Nombre maximum de liens dans les signatures',
	'MAX_SIG_URLS_EXPLAIN'			=> 'Définit le nombre maximum de liens autorisés dans la signature d’un membre. Mettre « 0 » pour illimité.',
));

// Registration Settings
$lang = array_merge($lang, array(
	'ACP_REGISTER_SETTINGS_EXPLAIN'		=> 'Vous pouvez modifier les paramètres relatifs à l’enregistrement et au profil d’un membre.',

	'ACC_ACTIVATION'				=> 'Activation de compte',
	'ACC_ACTIVATION_EXPLAIN'		=> 'Cela détermine si les membres ont accès au forum immédiatement ou si une confirmation est requise. Vous pouvez également désactiver complètement les créations de compte. <em>« L’envoi de courriel via le forum » doit être autorisé afin de pouvoir choisir entre l’activation par le membre ou par l’administrateur.</em>',
	'ACC_ACTIVATION_WARNING'		=> 'Veuillez noter que la méthode d’activation actuellement sélectionnée nécessite que la prise en charge des courriels soit activée, sinon les créations de compte seront désactivées. Nous vous recommandons de sélectionner une autre méthode d’activation ou de réactiver les courriels.',
	'NEW_MEMBER_POST_LIMIT'			=> 'Limite de messages d’un nouveau membre',
	'NEW_MEMBER_POST_LIMIT_EXPLAIN'	=> 'Les nouveaux membres resteront dans le groupe <em>Nouveaux utilisateurs enregistrés</em> jusqu’à ce qu’ils atteignent ce nombre de messages. Vous pouvez utiliser ce groupe pour éviter qu’ils utilisent le système de messagerie privée ou la révision de leurs messages. <strong>Mettre « 0 » pour désactiver cette fonctionnalité.</strong>',
	'NEW_MEMBER_GROUP_DEFAULT'		=> 'Définir par défaut le groupe « Nouveaux utilisateurs enregistrés »',
	'NEW_MEMBER_GROUP_DEFAULT_EXPLAIN'	=> 'Si ce paramètre est activé et si une limite de messages pour les nouveaux membres est indiquée, ces derniers ne seront pas simplement placés dans le groupe <em>Nouveaux utilisateurs enregistrés</em>, mais ce groupe deviendra également leur groupe par défaut. Cela peut s’avérer pratique si vous voulez assigner un rang et/ou un avatar de groupe par défaut afin que les membres en héritent.',

	'ACC_ADMIN'					=> 'Par l’administrateur',
	'ACC_DISABLE'				=> 'Désactiver l’enregistrement',
	'ACC_NONE'					=> 'Pas de vérification (accès immédiat)',
	'ACC_USER'					=> 'Par le membre (vérification de l’adresse courriel)',
//	'ACC_USER_ADMIN'			=> 'User + Admin',
	'ALLOW_EMAIL_REUSE'			=> 'Autoriser les adresses courriel à être réutilisées',
	'ALLOW_EMAIL_REUSE_EXPLAIN'	=> 'Plusieurs utilisateurs peuvent s’enregistrer avec la même adresse courriel.',
	'COPPA'						=> 'COPPA',
	'COPPA_FAX'					=> 'Numéro de fax COPPA',
	'COPPA_MAIL'				=> 'Adresse courriel COPPA',
	'COPPA_MAIL_EXPLAIN'		=> 'Ceci est l’adresse courriel où les parents enverront les formulaires d’enregistrement COPPA.',
	'ENABLE_COPPA'				=> 'Activer la COPPA',
	'ENABLE_COPPA_EXPLAIN'		=> 'Cela oblige les utilisateurs à déclarer qu’ils ont 13 ans ou plus afin d’être en conformité avec la COPPA. Si cela est désactivé, le groupe spécial COPPA ne sera plus affiché.',
	'MAX_CHARS'					=> 'Max',
	'MIN_CHARS'					=> 'Min',
	'NO_AUTH_PLUGIN'			=> 'Aucun module d’authentification trouvé.',
	'PASSWORD_LENGTH'			=> 'Longueur du mot de passe',
	'PASSWORD_LENGTH_EXPLAIN'	=> 'Nombre de caractères minimum dans les mots de passe. Veuillez noter qu’il n’y a pas de limite maximum.',
	'REG_LIMIT'					=> 'Tentatives d’enregistrement',
	'REG_LIMIT_EXPLAIN'			=> 'Nombre de tentatives que les utilisateurs pourront effectuer pour résoudre le code de confirmation visuelle avant que leur session ne soit verrouillée.',
	'USERNAME_ALPHA_ONLY'		=> 'Alphanumériques seulement',
	'USERNAME_ALPHA_SPACERS'	=> 'Alphanumériques et séparateurs',
	'USERNAME_ASCII'			=> 'ASCII (aucun caractère unicode international)',
	'USERNAME_LETTER_NUM'		=> 'Tous chiffres et lettres',
	'USERNAME_LETTER_NUM_SPACERS'	=> 'Tous chiffres, lettres et séparateurs',
	'USERNAME_CHARS'			=> 'Limiter les caractères du nom d’utilisateur',
	'USERNAME_CHARS_ANY'		=> 'N’importe quels caractères',
	'USERNAME_CHARS_EXPLAIN'	=> 'Restreindre le type de caractères autorisé dans le nom d’utilisateur. Les séparateurs comprennent : espace, -, +, _, [ et ].',
	'USERNAME_LENGTH'			=> 'Longueur du nom d’utilisateur',
	'USERNAME_LENGTH_EXPLAIN'	=> 'Définit le nombre de caractères minimum et maximum dans les noms d’utilisateurs.',
));

// Feeds
$lang = array_merge($lang, array(
	'ACP_FEED_MANAGEMENT'				=> 'Paramètres généraux de publication des flux',
	'ACP_FEED_MANAGEMENT_EXPLAIN'		=> 'Ce module ouvre la possibilité d’utiliser des flux ATOM, avec un traitement des BBCodes présents dans les messages pour permettre aux lecteurs de flux de les visualiser',

	'ACP_FEED_GENERAL'					=> 'Paramètres de flux général',
	'ACP_FEED_POST_BASED'				=> 'Paramètres de flux des messages',
	'ACP_FEED_TOPIC_BASED'				=> 'Paramètres de flux des sujets',
	'ACP_FEED_SETTINGS_OTHER'			=> 'Autres flux et paramétrages',

	'ACP_FEED_ENABLE'					=> 'Activer les flux',
	'ACP_FEED_ENABLE_EXPLAIN'			=> 'Active ou non, les flux ATOM pour le forum entier.<br>En désactivant les flux, peu importe la manière dont sont réglées les options ci-dessous.',
	'ACP_FEED_LIMIT'					=> 'Nombre d’articles',
	'ACP_FEED_LIMIT_EXPLAIN'			=> 'Le nombre maximum d’articles de flux à afficher.',

	'ACP_FEED_OVERALL'					=> 'Activer les flux sur l’ensemble du forum',
	'ACP_FEED_OVERALL_EXPLAIN'			=> 'Permet de suivre les nouveaux messages sur l’ensemble du forum.',
	'ACP_FEED_FORUM'					=> 'Activer les flux par forum',
	'ACP_FEED_FORUM_EXPLAIN'			=> 'Permet de suivre les nouveaux messages d’un forum et ses sous-forums.',
	'ACP_FEED_TOPIC'					=> 'Activer les flux par sujet',
	'ACP_FEED_TOPIC_EXPLAIN'			=> 'Permet de suivre les nouveaux messages d’un sujet en particulier.',

	'ACP_FEED_TOPICS_NEW'				=> 'Activer le flux des nouveaux sujets',
	'ACP_FEED_TOPICS_NEW_EXPLAIN'		=> 'Active le flux des « nouveaux sujets », qui affiche les derniers sujets créés, y compris le premier message.',
	'ACP_FEED_TOPICS_ACTIVE'			=> 'Activer le flux des sujets actifs',
	'ACP_FEED_TOPICS_ACTIVE_EXPLAIN'	=> 'Active le flux des « sujet actifs », qui affiche les derniers sujets actifs, y compris le dernier message.',
	'ACP_FEED_NEWS'						=> 'Flux des nouvelles',
	'ACP_FEED_NEWS_EXPLAIN'				=> 'Affiche le premier message des forums sélectionnés. Ne sélectionnez aucun forum pour désactiver le flux des nouvelles.<br>Sélectionnez plusieurs forums en utilisant la bonne combinaison du clavier et de la souris en fonction de votre ordinateur ou navigateur.',

	'ACP_FEED_OVERALL_FORUMS'			=> 'Activer le flux des forums',
	'ACP_FEED_OVERALL_FORUMS_EXPLAIN'	=> 'Active le flux de « tous les forums », ce qui affiche une liste des forums.',

	'ACP_FEED_HTTP_AUTH'				=> 'Autoriser l’authentification HTTP',
	'ACP_FEED_HTTP_AUTH_EXPLAIN'		=> 'Active l’authentification HTTP, ce qui autorise les membres à recevoir le contenu qui est masqué aux invités en ajoutant le paramètre <samp>auth=http</samp> à l’URL du flux. Notez que certaines installations de PHP nécessitent d’effectuer des modifications additionnelles dans le fichier .htaccess. Toutes les instructions sont contenues dans ce fichier.',
	'ACP_FEED_ITEM_STATISTICS'			=> 'Statistiques de l’article',
	'ACP_FEED_ITEM_STATISTICS_EXPLAIN'	=> 'Affiche les statistiques individuelles sous les articles de flux.<br>Exemple : posté par, date et heure, réponses, vues.',
	'ACP_FEED_EXCLUDE_ID'				=> 'Exclure ces forums',
	'ACP_FEED_EXCLUDE_ID_EXPLAIN'		=> 'Sélectionnez les forums à exclure des flux, en utilisant la bonne combinaison du clavier et de la souris en fonction de votre ordinateur ou navigateur.<br>Ne sélectionnez aucun forum pour lire les données de tous les forums dans les flux.',
));

// Visual Confirmation Settings
$lang = array_merge($lang, array(
	'ACP_VC_SETTINGS_EXPLAIN'				=> 'Vous pouvez sélectionner et configurer les plugins, qui sont conçus pour bloquer les soumissions automatisées de formulaires par des robots. Ces plugins fonctionnent généralement en défiant l’utilisateur via un <em>CAPTCHA</em>, un test conçu pour être complexe à résoudre par les ordinateurs.',
	'ACP_VC_EXT_GET_MORE'					=> 'Pour consulter la liste des plugins anti-spam disponibles pour phpBB, visitez la <a href="https://www.phpbb.com/go/anti-spam-ext"><strong>base de données des extensions de phpBB.com</strong></a> (en anglais). Pour obtenir plus de détails sur comment se prémunir du spam, visitez la <a href="https://www.phpbb.com/go/anti-spam"><strong>base de connaissances de phpBB.com</strong></a> (en anglais).',
	'AVAILABLE_CAPTCHAS'					=> 'Plugins disponibles',
	'CAPTCHA_UNAVAILABLE'					=> 'Le plugin ne peut pas être sélectionné car les prérequis ne sont pas remplis.',
	'CAPTCHA_GD'							=> 'Image GD',
	'CAPTCHA_GD_3D'							=> 'Image 3D GD',
	'CAPTCHA_GD_FOREGROUND_NOISE'			=> 'Bruit de fond',
	'CAPTCHA_GD_EXPLAIN'					=> 'Utilise GD pour faire une image plus difficile à déchiffrer par les robots.',
	'CAPTCHA_GD_FOREGROUND_NOISE_EXPLAIN'	=> 'Utiliser un bruit de fond pour faire une image plus difficile à déchiffrer par les robots.',
	'CAPTCHA_GD_X_GRID'						=> 'Bruit de fond x-axis',
	'CAPTCHA_GD_X_GRID_EXPLAIN'				=> 'Utiliser le paramètre ci-dessous pour rendre la confirmation visuelle plus difficile à déchiffrer. Mettre « 0 » pour désactiver le bruit de fond x-axis.',
	'CAPTCHA_GD_Y_GRID'						=> 'Bruit de fond y-axis',
	'CAPTCHA_GD_Y_GRID_EXPLAIN'				=> 'Utiliser le paramètre ci-dessous pour rendre la confirmation visuelle plus difficile à déchiffrer. Mettre « 0 » pour désactiver le bruit de fond y-axis.',
	'CAPTCHA_GD_WAVE'						=> 'Distorsion ondulatoire',
	'CAPTCHA_GD_WAVE_EXPLAIN'				=> 'Cela appliquera une distorsion ondulatoire à l’image.',
	'CAPTCHA_GD_3D_NOISE'					=> 'Ajouter des objets de bruit en 3D',
	'CAPTCHA_GD_3D_NOISE_EXPLAIN'			=> 'Cela ajoutera des objets supplémentaires à l’image, par-dessus les lettres.',
	'CAPTCHA_GD_FONTS'						=> 'Utiliser différentes polices',
	'CAPTCHA_GD_FONTS_EXPLAIN'				=> 'Ce paramètre contrôle le nombre de formes différentes de lettres qui sont utilisées. Vous pouvez seulement utiliser les formes par défaut ou introduire des lettres modifiées. L’ajout de lettres en minuscule est également possible.',
	'CAPTCHA_FONT_DEFAULT'					=> 'Défaut',
	'CAPTCHA_FONT_NEW'						=> 'Nouvelles formes',
	'CAPTCHA_FONT_LOWER'					=> 'Utiliser également des minuscules',
	'CAPTCHA_NO_GD'							=> 'Image simple',
	'CAPTCHA_PREVIEW_MSG'					=> 'Vos modifications n’ont pas été sauvegardées, ceci est juste un aperçu.',
	'CAPTCHA_PREVIEW_EXPLAIN'				=> 'Voici le plugin tel qu’il apparaîtrait avec vos paramètres actuels.',

	'CAPTCHA_SELECT'						=> 'Plugins installés',
	'CAPTCHA_SELECT_EXPLAIN'				=> 'La liste déroulante affiche les plugins reconnus par le forum. Les plugins grisés ne sont pas disponibles immédiatement et peuvent nécessiter au préalable une configuration pour être utilisés.',
	'CAPTCHA_CONFIGURE'						=> 'Configurer les plugins',
	'CAPTCHA_CONFIGURE_EXPLAIN'				=> 'Change les paramètres pour le plugin sélectionné.',
	'CONFIGURE'								=> 'Configurer',
	'CAPTCHA_NO_OPTIONS'					=> 'Ce plugin n’a pas d’options de configuration.',

	'VISUAL_CONFIRM_POST'					=> 'Activer la confirmation visuelle pour les visiteurs',
	'VISUAL_CONFIRM_POST_EXPLAIN'			=> 'Oblige les invités à passer le test de vérification humaine afin d’empêcher la publication automatisée de messages.',
	'VISUAL_CONFIRM_REG'					=> 'Activer la confirmation visuelle pour les enregistrements',
	'VISUAL_CONFIRM_REG_EXPLAIN'			=> 'Oblige les nouveaux utilisateurs à saisir un code aléatoire correspondant à une image afin d’empêcher les enregistrements en masse.',
	'VISUAL_CONFIRM_REFRESH'				=> 'Autoriser les utilisateurs à rafraîchir l’image de confirmation',
	'VISUAL_CONFIRM_REFRESH_EXPLAIN'		=> 'Autorise les utilisateurs à demander de nouveaux codes de confirmation s’ils sont incapables de déchiffrer la confirmation visuelle durant l’enregistrement. Certains plugins peuvent ne pas supporter cette option.',
));

// Cookie Settings
$lang = array_merge($lang, array(
	'ACP_COOKIE_SETTINGS_EXPLAIN'		=> 'Ces informations définissent les données utilisées pour envoyer les cookies aux navigateurs de vos utilisateurs. Dans la majorité des cas, les valeurs par défaut pour les paramètres de cookie suffisent. Si vous avez besoin de les modifier, faites-le avec soin car des paramètres incorrects peuvent empêcher les membres de se connecter. Si vos membres rencontrent des problèmes pour rester connectés sur votre forum, consultez l’article <strong><a href="https://www.phpbb.com/support/go/cookie-settings">phpBB.com Knowledge Base - Fixing incorrect cookie settings</a></strong> (en anglais).',

	'COOKIE_DOMAIN'				=> 'Domaine du cookie',
	'COOKIE_DOMAIN_EXPLAIN'		=> 'Dans la plupart des cas, le domaine du cookie est facultatif. En cas de doute, laissez ce champ vide.<br><br>Dans le cas où vous auriez un forum intégré avec un autre logiciel ou de multiples domaines, alors pour déterminer le domaine du cookie procédez comme suit. Si vous avez quelque chose comme <i>exemple.com</i> et <i>forums.exemple.com</i>, ou <i>forums.exemple.com</i> et <i>blog.exemple.com</i>. Retirez les sous-domaines jusqu’à obtenir le nom de domaine commun, <i>exemple.com</i>. Puis, faites précéder le nom de domaine obtenu avec un point, ce qui donnerait « .exemple.com » (veuillez observer qu’un point se trouve devant le nom de domaine).',
	'COOKIE_NAME'				=> 'Nom du cookie',
	'COOKIE_NAME_EXPLAIN'		=> 'Saisissez ce que vous souhaitez, faites original. À chaque modification des paramètres de cookie, le nom du cookie doit être changé.',
	'COOKIE_NOTICE'				=> 'Notice d’utilisation des cookies',
	'COOKIE_NOTICE_EXPLAIN'		=> 'Si activé, une information relative aux cookies sera affichée aux utilisateurs qui visitent votre forum. Cela peut être une obligation légale en fonction du contenu de votre forum ou des extensions activées.',
	'COOKIE_PATH'				=> 'Chemin du cookie',
	'COOKIE_PATH_EXPLAIN'		=> 'Il s’agira généralement de la même valeur que le chemin du script ou saisissez simplement une barre oblique « / » pour rendre le cookie accessible via n’importe quelle URL de votre forum.',
	'COOKIE_SECURE'				=> 'Cookie sécurisé',
	'COOKIE_SECURE_EXPLAIN'		=> 'Si votre site Internet est accessible par l’intermédiaire du protocole SSL (https://), activez cette option sinon laissez sur « Désactivé ». Si vous activez cette option alors que votre site Internet n’est pas accessible par le protocole SSL, des erreurs se produiront lors des redirections.',
	'ONLINE_LENGTH'				=> 'Durée d’apparition dans la liste des utilisateurs en ligne',
	'ONLINE_LENGTH_EXPLAIN'		=> 'Nombre de minutes après lequel les utilisateurs inactifs n’apparaîtront plus dans la liste des utilisateurs en ligne. Plus cette valeur est élevée, plus le traitement requis pour générer la liste sera long.',
	'SESSION_LENGTH'			=> 'Durée de la session',
	'SESSION_LENGTH_EXPLAIN'	=> 'Les sessions expireront après cette durée, en secondes.',
));

// Contact Settings
$lang = array_merge($lang, array(
	'ACP_CONTACT_SETTINGS_EXPLAIN'	=> 'Ici vous pouvez activer et désactiver la page de contact, ainsi que définir un texte qui sera affiché sur cette même page.',

	'CONTACT_US_ENABLE'				=> 'Activer la page de contact',
	'CONTACT_US_ENABLE_EXPLAIN'		=> 'Cette page permet aux utilisateurs de contacter les administrateurs du forum par courriel. Veuillez noter que l’option « Autoriser l’envoi de courriel via le forum » doit être activée. Vous trouverez cette option dans « Général &gt; Communication &gt; Paramètres des courriels »',

	'CONTACT_US_INFO'				=> 'Message de la page de contact',
	'CONTACT_US_INFO_EXPLAIN'		=> 'Ce message est affiché sur la page de contact.',
	'CONTACT_US_INFO_PREVIEW'		=> 'Message de la page de contact - Aperçu',
	'CONTACT_US_INFO_UPDATED'		=> 'Le message de la page de contact a été mis à jour.',
));

// Load Settings
$lang = array_merge($lang, array(
	'ACP_LOAD_SETTINGS_EXPLAIN'	=> 'Vous pouvez activer et désactiver certaines fonctions du forum pour réduire la quantité de traitement requise. Sur la plupart des serveurs, il n’est pas nécessaire de désactiver ces fonctionnalités. Cependant, sur certains systèmes ou hébergements mutualisés, il peut être préférable de désactiver certaines possibilités dont vous n’avez pas réellement besoin. Vous pouvez également indiquer des limites pour la charge du système et les sessions actives au-delà desquelles le forum sera hors-ligne.',

	'ALLOW_CDN'						=> 'Autoriser l’utilisation des CDN tiers',
	'ALLOW_CDN_EXPLAIN'				=> 'Un CDN (Content Delivery Network) est un réseau de distribution de contenus. Si l’option est activée, certains fichiers seront distribués par des serveurs tiers au lieu du vôtre. Ceci permet de réduire la bande passante utilisée par votre serveur, mais pour certains administrateurs de forums, cette option pourraient poser des problèmes de confidentialité.',
	'ALLOW_LIVE_SEARCHES'			=> 'Autoriser la recherche dynamique',
	'ALLOW_LIVE_SEARCHES_EXPLAIN'	=> 'Si activé, au fur et à mesure qu’un membre saisira du texte dans certains champs de recherche des mots-clés seront suggérés.',
	'CUSTOM_PROFILE_FIELDS'			=> 'Champs de profil personnalisés',
	'LIMIT_LOAD'					=> 'Limiter la charge système',
	'LIMIT_LOAD_EXPLAIN'			=> 'Si la charge du système dépasse cette valeur durant une minute, le forum sera automatiquement indisponible. Une valeur à 1.0 équivaut à environ 100% d’utilisation d’un processeur. Cela ne fonctionne que sur les serveurs basés sous UNIX et où cette information est accessible. Cette valeur se réinitialise à 0 si phpBB n’arrive pas à obtenir la valeur de la charge du système.',
	'LIMIT_SESSIONS'				=> 'Nombre de sessions',
	'LIMIT_SESSIONS_EXPLAIN'		=> 'Si le nombre de sessions dépasse cette valeur durant une minute, le forum sera indisponible. Mettre « 0 » pour illimité.',
	'LOAD_CPF_MEMBERLIST'			=> 'Autoriser les styles à afficher les champs personnalisés dans la liste des membres',
	'LOAD_CPF_PM'					=> 'Afficher les champs personnalisés dans les messages privés',
	'LOAD_CPF_VIEWPROFILE'			=> 'Afficher les champs personnalisés dans le profil des membres',
	'LOAD_CPF_VIEWTOPIC'			=> 'Afficher les champs personnalisés dans les pages de sujet',
	'LOAD_USER_ACTIVITY'			=> 'Afficher l’activité des membres',
	'LOAD_USER_ACTIVITY_EXPLAIN'	=> 'Affiche les sujets/forums actifs dans le profil des membres. Il est recommandé de désactiver cette option pour les forums de plus d’un million de messages.',
	'LOAD_USER_ACTIVITY_LIMIT'		=> 'Limiter l’affichage de l’activité des membres',
	'LOAD_USER_ACTIVITY_LIMIT_EXPLAIN'	=> 'Masque l’affichage des sujets/forums actifs dans le profil des membres ayant atteints ce nombre de messages. Définir cette valeur à « 0 » pour désactiver cette limitation.',
	'READ_NOTIFICATION_EXPIRE_DAYS'	=> 'Expiration des notifications lues',
	'READ_NOTIFICATION_EXPIRE_DAYS_EXPLAIN'	=> 'Nombre de jours avant qu’une notification lue soit automatiquement supprimée. Définir cette valeur à « 0 » pour des notifications permanentes.',
	'RECOMPILE_STYLES'				=> 'Recompiler les différents éléments du style',
	'RECOMPILE_STYLES_EXPLAIN'		=> 'Cherche les nouvelles mises à jour du style dans le système de fichiers et les recompile.',
	'YES_ACCURATE_PM_BUTTON'			=> 'Activer l’indicateur de message privé dans le mini-profil des sujets',
	'YES_ACCURATE_PM_BUTTON_EXPLAIN'	=> 'Si activé, seuls les membres autorisés à lire des messages privés auront dans leur mini-profil le bouton de message privé.',
	'YES_ANON_READ_MARKING'			=> 'Activer l’indicateur de lecture pour les visiteurs',
	'YES_ANON_READ_MARKING_EXPLAIN'	=> 'Enregistre l’état lu/non lu pour les visiteurs. Si désactivé, les messages sont toujours considérés comme lus pour les visiteurs.',
	'YES_BIRTHDAYS'					=> 'Activer l’affichage de la liste des anniversaires',
	'YES_BIRTHDAYS_EXPLAIN'			=> 'Si désactivé, la liste des anniversaires ne sera plus affichée. Ce paramètre n’est pris en compte que si la fonctionnalité des anniversaires est également activée.',
	'YES_JUMPBOX'					=> 'Activer l’affichage de l’accès rapide aux forums',
	'YES_MODERATORS'				=> 'Activer l’affichage des modérateurs',
	'YES_ONLINE'					=> 'Activer l’affichage de la liste des utilisateurs en ligne',
	'YES_ONLINE_EXPLAIN'			=> 'Affiche ces informations sur l’accueil, dans les forums et sujets.',
	'YES_ONLINE_GUESTS'				=> 'Activer l’affichage des visiteurs dans « Qui est en ligne ? »',
	'YES_ONLINE_GUESTS_EXPLAIN'		=> 'Affiche les informations concernant les visiteurs dans « Qui est en ligne ? ».',
	'YES_ONLINE_TRACK'				=> 'Activer l’affichage de l’état de connexion',
	'YES_ONLINE_TRACK_EXPLAIN'		=> 'Affiche dans le profil public et les sujets le statut du membre.',
	'YES_POST_MARKING'				=> 'Activer les sujets pointés',
	'YES_POST_MARKING_EXPLAIN'		=> 'Indique si le membre a participé au sujet.',
	'YES_READ_MARKING'				=> 'Activer l’indicateur de lecture par le serveur',
	'YES_READ_MARKING_EXPLAIN'		=> 'Enregistre l’état lu/non lu dans la base plutôt que dans un cookie.',
	'YES_UNREAD_SEARCH'				=> 'Activer la recherche des messages non lus',
));

// Auth settings
$lang = array_merge($lang, array(
	'ACP_AUTH_SETTINGS_EXPLAIN'	=> 'phpBB supporte les plugins d’authentification ou modules. Ceux-ci vous permettent de déterminer de quelle manière les membres sont authentifiés lorsqu’ils se connectent au forum. Par défaut, quatre plugins sont fournis : DB, LDAP, Apache et OAuth. Toutes les méthodes ne nécessitent pas d’informations complémentaires, remplissez uniquement les champs s’ils sont appropriés à la méthode sélectionnée.',

	'AUTH_METHOD'				=> 'Sélectionnez une méthode d’authentification',

	'AUTH_PROVIDER_OAUTH_ERROR_ELEMENT_MISSING'	=> 'Vous devez fournir la clé et le secret pour chaque fournisseur de service OAuth activé. Une seule de ces informations a été fournie pour l’un d’entre eux',
	'AUTH_PROVIDER_OAUTH_EXPLAIN'				=> 'Chaque « fournisseur OAuth » nécessite une clé et un secret unique afin de pouvoir s’authentifier auprès du serveur externe.<br>Ceux-ci devraient être fournis par le service OAuth lorsque vous enregistrez votre site chez eux. Ces informations doivent impérativement être saisies comme elles vous ont été transmises.<br>Tout service qui n’a pas à la fois une clé et un secret valides, ne pourra pas être accessible par les utilisateurs du forum. Notez également que les utilisateurs peuvent toujours s’enregistrer et se connecter en utilisant la méthode d’authentification « DB ».',
	'AUTH_PROVIDER_OAUTH_KEY'					=> 'Clé',
	'AUTH_PROVIDER_OAUTH_TITLE'					=> 'OAuth',
	'AUTH_PROVIDER_OAUTH_SECRET'				=> 'Secret',

	'APACHE_SETUP_BEFORE_USE'	=> 'Vous devez configurer l’authentification Apache avant de passer phpBB sur cette méthode d’authentification. Gardez en tête que le nom d’utilisateur utilisé pour l’authentification Apache doit être identique à votre nom d’utilisateur phpBB. L’authentification Apache peut seulement être utilisée avec mod_php (pas avec une version CGI).',

	'LDAP'							=> 'LDAP',
	'LDAP_DN'						=> 'Base LDAP vers <var>DN</var>',
	'LDAP_DN_EXPLAIN'				=> 'Ceci est le « Distinguished Name » permettant de localiser les informations de l’utilisateur LDAP, exemple : <samp>o=Mon entreprise, c=FR</samp>.',
	'LDAP_EMAIL'					=> 'Attribut LDAP des adresses courriel',
	'LDAP_EMAIL_EXPLAIN'			=> 'Ceci est le nom de l’attribut (s’il existe) contenant l’adresse courriel de vos utilisateurs LDAP, afin de régler automatiquement l’adresse courriel des nouveaux membres. Si ce paramètre n’est pas défini, l’adresse courriel ne sera pas automatiquement renseignée lorsque le membre se connectera pour la première fois.',
	'LDAP_INCORRECT_USER_PASSWORD'	=> 'La connexion au serveur LDAP a échoué avec les nom d’utilisateur et mot de passe indiqués.',
	'LDAP_NO_EMAIL'					=> 'Cet attribut d’adresse courriel n’existe pas.',
	'LDAP_NO_IDENTITY'				=> 'Impossible de trouver un identifiant de connexion pour %s',
	'LDAP_PASSWORD'					=> 'Mot de passe LDAP',
	'LDAP_PASSWORD_EXPLAIN'			=> 'Laissez cette case vide pour utiliser une connexion anonyme, sinon, indiquez le mot de passe pour l’utilisateur indiqué ci-dessus. Ceci est obligatoire pour les serveurs possédant un « Active Directory ».<br><em><strong>Attention :</strong> ce mot de passe sera stocké en clair dans votre de base de données et sera visible par n’importe qui ayant accès à votre base de données ou à cette page de configuration.</em>',
	'LDAP_PORT'						=> 'Port du serveur LDAP',
	'LDAP_PORT_EXPLAIN'				=> 'Si vous le souhaitez, vous pouvez indiquer un port qui devra être employé pour se connecter au serveur LDAP au lieu du port par défaut 389.',
	'LDAP_SERVER'					=> 'Nom du serveur LDAP',
	'LDAP_SERVER_EXPLAIN'			=> 'Si vous utilisez LDAP, ceci est le nom d’hôte ou l’adresse IP du serveur LDAP. Sinon, vous pouvez préciser une URL comme ldap://hostname:port/',
	'LDAP_UID'						=> 'Clé <var>uid</var> LDAP',
	'LDAP_UID_EXPLAIN'				=> 'Ceci est la clé utilisée pour la recherche d’un identifiant de connexion, exemple : <var>uid</var>, <var>sn</var>, etc.',
	'LDAP_USER'						=> 'Utilisateur <var>dn</var> LDAP',
	'LDAP_USER_EXPLAIN'				=> 'Laissez cette case vide pour utiliser une connexion anonyme. Si cela est renseigné, phpBB utilise, lors de la connexion d’un membre, le nom unique (Distinguished Name) indiqué et tente de trouver le bon nom d’utilisateur. Exemple de « dn » : <samp>uid=Nom,ou=MonUnité,o=MaCompagnie,c=FR</samp>. Requis pour les serveurs Active Directory.',
	'LDAP_USER_FILTER'				=> 'Filtre de l’utilisateur LDAP',
	'LDAP_USER_FILTER_EXPLAIN'		=> 'Si vous le souhaitez, vous pouvez en plus limiter les objets recherchés avec des filtres additionnels. Par exemple : <samp>objectClass=posixGroup</samp> deviendrait lors de l’utilisation <samp>(&amp;(uid=$username)(objectClass=posixGroup))</samp>',
));

// Server Settings
$lang = array_merge($lang, array(
	'ACP_SERVER_SETTINGS_EXPLAIN'	=> 'Vous pouvez définir les paramètres du serveur et du domaine. Vérifiez que les données saisies soient précises, afin d’éviter que vos courriels ne contiennent des données erronées. Lorsque vous saisissez le nom de domaine, n’oubliez pas qu’il doit contenir http:// ou un autre protocole. Ne modifiez le numéro de port que si vous savez que votre serveur utilise une valeur différente, le port 80 est correct dans la majorité des cas.',

	'ENABLE_GZIP'				=> 'Activer la compression GZip',
	'ENABLE_GZIP_EXPLAIN'		=> 'Le contenu généré sera compressé avant d’être envoyé à l’utilisateur. Cela peut réduire le trafic mais également augmenter l’utilisation du CPU à la fois du côté serveur et client. Cela nécessite que l’extension PHP zlib soit chargée.',
	'FORCE_SERVER_VARS'			=> 'Forcer les paramètres URL du serveur',
	'FORCE_SERVER_VARS_EXPLAIN'	=> 'Si « Oui », les paramètres définis ici seront utilisés à la place des valeurs déterminées automatiquement.',
	'ICONS_PATH'				=> 'Emplacement des icônes de message',
	'ICONS_PATH_EXPLAIN'		=> 'Chemin depuis le répertoire racine de phpBB, exemple : <samp>images/icons</samp>',
	'MOD_REWRITE_ENABLE'			=> 'Activer la réécriture d’URL',
	'MOD_REWRITE_ENABLE_EXPLAIN'	=> 'Si activé, les URL contenant « app.php » seront réécrites afin d’en retirer le nom du fichier (ex : app.php/foo deviendra /foo). <strong>Le module « mod_rewrite » du serveur Apache est requis pour rendre cette fonctionnalité opérationnelle ; si cette option est activée sans que le « mod_rewrite » soit disponible, les adresses URL de votre forum seront erronées.</strong>',
	'MOD_REWRITE_DISABLED'			=> 'L’extension <strong>mod_rewrite</strong> du serveur Apache est désactivée. Activez cette extension ou contactez votre hébergeur Web si vous souhaitez activer cette fonctionnalité.',
	'MOD_REWRITE_INFORMATION_UNAVAILABLE'	=> 'Il est impossible de déterminer si ce serveur permet la réécriture d’URL. Cette option peut être activée, mais si la réécriture d’URL n’est pas disponible, les chemins générés pour ce forum (dans les adresses de lien) peuvent être erronés. Contactez votre hébergeur Web si vous n’êtes pas sûr de pouvoir activer en toute sécurité cette fonctionnalité.',
	'PATH_SETTINGS'				=> 'Chemins d’accès',
	'RANKS_PATH'				=> 'Emplacement des images de rang',
	'RANKS_PATH_EXPLAIN'		=> 'Chemin depuis le répertoire racine de phpBB, exemple : <samp>images/ranks</samp>',
	'SCRIPT_PATH'				=> 'Chemin du script',
	'SCRIPT_PATH_EXPLAIN'		=> 'Chemin d’accès où sont situés les fichiers phpBB depuis le nom de domaine, exemple : <samp>/phpBB3</samp>',
	'SERVER_NAME'				=> 'Nom de domaine',
	'SERVER_NAME_EXPLAIN'		=> 'Nom de domaine du serveur exécutant phpBB, exemple : <samp>www.exemple.com</samp>',
	'SERVER_PORT'				=> 'Port du serveur',
	'SERVER_PORT_EXPLAIN'		=> 'Port utilisé par le serveur, normalement 80, changez seulement si différent.',
	'SERVER_PROTOCOL'			=> 'Protocole du serveur',
	'SERVER_PROTOCOL_EXPLAIN'	=> 'Utilisé comme protocole du serveur si ces paramètres sont forcés. Si vide ou non forcé, le protocole est déterminé par les paramètres de cookie sécurisé. (<samp>http://</samp> ou <samp>https://</samp>)',
	'SERVER_URL_SETTINGS'		=> 'Paramètres des URLs du serveur',
	'SMILIES_PATH'				=> 'Emplacement des smileys',
	'SMILIES_PATH_EXPLAIN'		=> 'Chemin depuis le répertoire racine de phpBB, exemple : <samp>images/smilies</samp>',
	'UPLOAD_ICONS_PATH'			=> 'Emplacement des icônes de groupes d’extensions',
	'UPLOAD_ICONS_PATH_EXPLAIN'	=> 'Chemin depuis le répertoire racine de phpBB, exemple : <samp>images/upload_icons</samp>',
	'USE_SYSTEM_CRON'			=> 'Exécuter les tâches récurrentes en utilisant le « cron » système.',
	'USE_SYSTEM_CRON_EXPLAIN'	=> 'Si définie à « Non », phpBB fera le nécessaire pour exécuter automatiquement les tâches récurrentes. Si définie à « Oui », phpBB ne planifiera aucune tâche récurrente par lui-même ; un administrateur système devra faire le nécessaire pour que le fichier <code>bin/phpbbcli.php cron:run</code> puisse être exécuté par le « cron » système à intervalle régulier (par exemple toutes les 5 minutes).',
));

// Security Settings
$lang = array_merge($lang, array(
	'ACP_SECURITY_SETTINGS_EXPLAIN'		=> 'Vous pouvez définir les paramètres relatifs à l’identification et à la session.',

	'ALL'							=> 'Tous',
	'ALLOW_AUTOLOGIN'				=> 'Autoriser « Se souvenir de moi »',
	'ALLOW_AUTOLOGIN_EXPLAIN'		=> 'Détermine si les membres peuvent être reconnectés automatiquement quand ils reviennent visiter le forum.',
	'ALLOW_PASSWORD_RESET'			=> 'Autoriser la réinitialisation du mot de passe (« Mot de passe oublié »)',
	'ALLOW_PASSWORD_RESET_EXPLAIN'	=> 'Détermine si les membres sont en mesure d’utiliser le lien « J’ai oublié mon mot de passe » sur la page de connexion afin de récupérer un accès à leur compte. Si vous utilisez un mécanisme de connexion externe vous pouvez désactiver cette fonctionnalité.',
	'AUTOLOGIN_LENGTH'				=> 'Expiration des clés de connexion « Se souvenir de moi » (en jours)',
	'AUTOLOGIN_LENGTH_EXPLAIN'		=> 'Nombre de jours après lequel les clés de connexion « Se souvenir de moi » sont supprimées. Mettre « 0 » pour désactiver.',
	'BROWSER_VALID'					=> 'Valider le navigateur',
	'BROWSER_VALID_EXPLAIN'			=> 'Active la validation du navigateur pour chaque session, ce qui améliore la sécurité.',
	'CHECK_DNSBL'					=> 'Comparer l’IP avec la liste noire DNS',
	'CHECK_DNSBL_EXPLAIN'			=> 'Si activé, l’adresse IP de l’utilisateur est vérifiée par les services DNSBL lors de la création de compte et la publication de messages : <a href="http://spamcop.net">spamcop.net</a> et <a href="http://www.spamhaus.org">www.spamhaus.org</a>. Cette vérification peut prendre un moment, selon la configuration du serveur. Si vous remarquez des ralentissements ou de mauvaises appréciations, il est recommandé de désactiver cette vérification.',
	'CLASS_B'						=> 'A.B',
	'CLASS_C'						=> 'A.B.C',
	'EMAIL_CHECK_MX'				=> 'Vérifier l’enregistrement MX du domaine de l’adresse courriel',
	'EMAIL_CHECK_MX_EXPLAIN'		=> 'Si activé, le domaine de l’adresse courriel fournie est contrôlé lors de la création d’un compte et des modifications de profil, pour s’assurer qu’il possède un enregistrement MX valide.',
	'FORCE_PASS_CHANGE'				=> 'Forcer la modification du mot de passe',
	'FORCE_PASS_CHANGE_EXPLAIN'		=> 'Oblige le membre à modifier son mot de passe après un certain nombre de jours. Mettre « 0 » pour désactiver cette fonctionnalité.',
	'FORM_TIME_MAX'					=> 'Temps maximum lors de l’envoi des formulaires',
	'FORM_TIME_MAX_EXPLAIN'			=> 'Détermine le temps dont un utilisateur dispose pour envoyer un formulaire. Mettre « -1 » pour désactiver. Notez qu’un formulaire peut devenir invalide si la session expire, et cela indépendamment de ce paramètre.',
	'FORM_SID_GUESTS'				=> 'Lier les formulaires aux sessions des invités',
	'FORM_SID_GUESTS_EXPLAIN'		=> 'Si activé, les formulaires émis aux invités seront exclusifs à leur session. Cela peut entraîner quelques problèmes avec certains fournisseurs d’accès.',
	'FORWARDED_FOR_VALID'			=> 'En-tête <var>X_FORWARDED_FOR</var> valide',
	'FORWARDED_FOR_VALID_EXPLAIN'	=> 'Les sessions seront continuées seulement si l’en-tête <var> X_FORWARDED_FOR </var> envoyée est égale à celle envoyée avec la requête précédente. L’en-tête <var>X_FORWARDED_FOR</var> vérifiera également si les adresses IP n’ont pas été bannies.',
	'IP_VALID'						=> 'Validation de session IP',
	'IP_VALID_EXPLAIN'				=> 'Détermine quelle partie de l’adresse IP des utilisateurs sera utilisée pour valider une session : <samp>Tous</samp> compare l’adresse complète, <samp>A.B.C</samp> les premiers x.x.x, <samp>A.B</samp> les premiers x.x, <samp>Aucune</samp> désactive la vérification. Pour les adresses IPv6, <samp>A.B.C</samp> compare les 4 premiers blocs et <samp>A.B</samp> les 3 premiers blocs.',
	'IP_LOGIN_LIMIT_MAX'			=> 'Nombre maximal de tentatives de connexion par adresse IP',
	'IP_LOGIN_LIMIT_MAX_EXPLAIN'	=> 'Seuil du nombre de tentatives de connexion autorisé pour une adresse IP avant d’activer la confirmation visuelle. Mettre « 0 » pour désactiver la confirmation visuelle par adresse IP.',
	'IP_LOGIN_LIMIT_TIME'			=> 'Expiration des tentatives de connexion par adresse IP',
	'IP_LOGIN_LIMIT_TIME_EXPLAIN'	=> 'Temps d’expiration des tentatives de connexion par adresse IP.',
	'IP_LOGIN_LIMIT_USE_FORWARDED'	=> 'Limite des tentatives de connexions par en-tête <var>X_FORWARDED_FOR</var>',
	'IP_LOGIN_LIMIT_USE_FORWARDED_EXPLAIN'	=> 'Au lieu de limiter les tentatives de connexions par adresse IP, elles seront limitées par la valeur <var>X_FORWARDED_FOR</var>.<br><em><strong>Attention :</strong> à activer seulement si le serveur proxy a des valeurs <var>X_FORWARDED_FOR</var> dignes de confiance.</em>',
	'MAX_LOGIN_ATTEMPTS'			=> 'Nombre maximal de tentatives de connexion par nom d’utilisateur',
	'MAX_LOGIN_ATTEMPTS_EXPLAIN'	=> 'Nombre maximal de tentatives de connexion autorisé par nom d’utilisateur avant d’activer la confirmation visuelle. Mettre « 0 » pour désactiver la confirmation visuelle par nom d’utilisateur.',
	'NO_IP_VALIDATION'				=> 'Aucune',
	'NO_REF_VALIDATION'				=> 'Aucune',
	'PASSWORD_TYPE'					=> 'Complexité du mot de passe',
	'PASSWORD_TYPE_EXPLAIN'			=> 'Détermine la complexité requise pour définir ou modifier un mot de passe, les options suivantes incluent les précédentes.',
	'PASS_TYPE_ALPHA'				=> 'Doit contenir des lettres et des chiffres',
	'PASS_TYPE_ANY'					=> 'Aucune condition',
	'PASS_TYPE_CASE'				=> 'Doit contenir des majuscules et minuscules',
	'PASS_TYPE_SYMBOL'				=> 'Doit contenir des symboles',
	'REF_HOST'						=> 'Valider uniquement l’hôte',
	'REF_PATH'						=> 'Valider également le chemin',
	'REFERRER_VALID'				=> 'Valider le référent',
	'REFERRER_VALID_EXPLAIN'		=> 'Si activé, le référent des requêtes POST sera comparé au paramétrage du chemin de l’hôte ou du script. Ceci peut entraîner certains problèmes avec les forums utilisant plusieurs domaines ou des méthodes d’authentification externes.',
	'TPL_ALLOW_PHP'					=> 'Autoriser le PHP dans les templates',
	'TPL_ALLOW_PHP_EXPLAIN'			=> 'Si cette option est activée, les instructions <code>PHP</code> et <code>INCLUDEPHP</code> seront reconnues et analysées dans les templates.',
	'UPLOAD_CERT_VALID'				=> 'Valider les certificats nécessaires au transfert de fichiers distants',
	'UPLOAD_CERT_VALID_EXPLAIN'		=> 'Si activé, les certificats nécessaires au transfert de fichiers distants seront validés. Dans ce cas, les certificats faisant autorités (CA bundle) doivent être définis par l’option <samp>openssl.cafile</samp> ou <samp>curl.cainfo</samp> dans votre fichier php.ini.',
));

// Email Settings
$lang = array_merge($lang, array(
	'ACP_EMAIL_SETTINGS_EXPLAIN'	=> 'Ces informations sont utilisées lors de l’envoi de courriels à vos membres par l’intermédiaire du forum. Assurez-vous que l’adresse courriel indiquée soit valide car les rapports de non-remise (NDR) seront probablement envoyés à cette adresse. Si votre hébergeur ne fournit pas nativement un service de courriel basé sur PHP, vous pouvez envoyer directement les messages en utilisant SMTP. Cela nécessite l’adresse d’un serveur approprié (contactez votre hébergeur si besoin). Si le serveur requiert une authentification (et seulement dans ce cas) sélectionnez la méthode d’authentification SMTP utilisée par votre hébergeur, puis saisissez le nom d’utilisateur et le mot de passe du compte SMTP.',

	'ADMIN_EMAIL'					=> 'Adresse courriel de l’expéditeur',
	'ADMIN_EMAIL_EXPLAIN'			=> 'Il s’agit de l’adresse courriel de l’expéditeur qui sera utilisée dans tous les courriels émis par le forum, l’adresse courriel de contact technique. C’est elle qui sera fournie pour le champ <samp>Sender</samp> (expéditeur) des en-têtes de courriels.',
	'BOARD_EMAIL_FORM'				=> 'Les membres envoient des courriels via le forum',
	'BOARD_EMAIL_FORM_EXPLAIN'		=> 'Au lieu de montrer publiquement les adresses courriels des membres, ces derniers peuvent envoyer des courriels via le forum.',
	'BOARD_HIDE_EMAILS'				=> 'Masquer les adresses courriels',
	'BOARD_HIDE_EMAILS_EXPLAIN'		=> 'Cette fonction préserve les adresses courriels complètement privées.',
	'CONTACT_EMAIL'					=> 'Courriel de contact',
	'CONTACT_EMAIL_EXPLAIN'			=> 'Cette adresse de messagerie sera utilisée dans les messages comme adresse de contact, tel que les messages sur le spam, les erreurs générales, etc. Elle sera ainsi utilisée dans les champs <samp>From</samp> (De) et <samp>Reply-To</samp> (Répondre à) des en-têtes courriels.',
	'CONTACT_EMAIL_NAME'			=> 'Nom du contact',
	'CONTACT_EMAIL_NAME_EXPLAIN'	=> 'Il s’agit du nom que le destinataire du courriel verra. Si vous ne souhaitez pas avoir de nom de contact, laissez ce champ vide.',
	'EMAIL_FORCE_SENDER'			=> 'Forcer l’adresse courriel de réponse',
	'EMAIL_FORCE_SENDER_EXPLAIN'	=> 'Ceci définira le champ <samp>Return-Path</samp> (adresse de réponse) au niveau de l’adresse de courriel au lieu d’utiliser l’utilisateur local et le nom d’hôte du serveur. Ce paramètre ne s’applique pas lors de l’utilisation d’un serveur SMTP.<br><em><strong>Attention :</strong> ceci requiert que cette adresse de courriel soit ajoutée en tant qu’adresse de confiance au niveau des paramètres du serveur de courriel.</em>',
	'EMAIL_PACKAGE_SIZE'			=> 'Taille des paquets de courriels',
	'EMAIL_PACKAGE_SIZE_EXPLAIN'	=> 'Ceci est le nombre de courriels envoyés dans un paquet. Cette option est appliquée à la file d’attente des messages ; réglez cette option à « 0 » si vous rencontrez des problèmes avec des notifications de messages non délivrés.',
	'EMAIL_MAX_CHUNK_SIZE'			=> 'Nombre maximum de destinataires autorisés',
	'EMAIL_MAX_CHUNK_SIZE_EXPLAIN'	=> 'Si nécessaire, définissez ce paramètre afin de ne pas dépasser le nombre maximum de destinataires que votre serveur de messagerie pourrait autorisé par courriel.',
	'EMAIL_SIG'						=> 'Signature du courriel',
	'EMAIL_SIG_EXPLAIN'				=> 'Ce texte sera inséré à la fin de tous les courriels envoyés par le forum.',
	'ENABLE_EMAIL'					=> 'Autoriser l’envoi de courriel via le forum',
	'ENABLE_EMAIL_EXPLAIN'			=> 'Si désactivé, aucun courriel ne sera envoyé par le forum. <em>Notez que les paramètres d’activation de compte « par le membre » ou « par l’administrateur » nécessitent que ce paramètre soit activé. Si l’activation de compte est définie sur « par le membre » ou « par l’administrateur », désactiver ce paramètre désactivera l’enregistrement de nouveaux membres.</em>',
	'SEND_TEST_EMAIL'				=> 'Envoyer un courriel de test',
	'SEND_TEST_EMAIL_EXPLAIN'		=> 'Ceci enverra un courriel de test à l’adresse définie dans les paramètres de votre compte.',
	'SMTP_ALLOW_SELF_SIGNED'		=> 'Autoriser les certificats SSL auto-signés',
	'SMTP_ALLOW_SELF_SIGNED_EXPLAIN'=> 'Autorise les connexions à un serveur SMTP utilisant un certificat SSL auto-signé.<br><em><strong>Attention :</strong> autoriser des certificats SSL auto-signés peut induire des problèmes de sécurité.</em>',
	'SMTP_AUTH_METHOD'				=> 'Méthode d’authentification SMTP',
	'SMTP_AUTH_METHOD_EXPLAIN'		=> 'Seulement utilisée si un nom d’utilisateur et un mot de passe ont été renseignés. Contactez votre fournisseur d’accès si vous n’êtes pas sûr de la méthode à utiliser.',
	'SMTP_CRAM_MD5'					=> 'CRAM-MD5',
	'SMTP_DIGEST_MD5'				=> 'DIGEST-MD5',
	'SMTP_LOGIN'					=> 'LOGIN',
	'SMTP_PASSWORD'					=> 'Mot de passe SMTP',
	'SMTP_PASSWORD_EXPLAIN'			=> 'Saisissez un mot de passe uniquement si votre serveur SMTP en requiert un.<br><em><strong>Attention :</strong> ce mot de passe sera stocké en clair dans la base de données, visible de toute personne ayant accès à votre base de données ou à cette page de configuration.</em>',
	'SMTP_PLAIN'					=> 'PLAIN',
	'SMTP_POP_BEFORE_SMTP'			=> 'POP-AVANT-SMTP',
	'SMTP_PORT'						=> 'Port du serveur SMTP',
	'SMTP_PORT_EXPLAIN'				=> 'Modifiez cela uniquement si vous savez que votre serveur SMTP utilise un port différent.',
	'SMTP_SERVER'					=> 'Adresse du serveur SMTP',
	'SMTP_SERVER_EXPLAIN'			=> 'N’indiquez pas le protocole (<samp>ssl://</samp> ou <samp>tls://</samp>) sauf si le serveur de messagerie le requiert.',
	'SMTP_SETTINGS'					=> 'Paramètres SMTP',
	'SMTP_USERNAME'					=> 'Nom d’utilisateur SMTP',
	'SMTP_USERNAME_EXPLAIN'			=> 'Saisissez un nom d’utilisateur uniquement si votre serveur SMTP en requiert un.',
	'SMTP_VERIFY_PEER'				=> 'Vérifier le certificat SSL',
	'SMTP_VERIFY_PEER_EXPLAIN'		=> 'Exige la vérification du certificat SSL utilisé par le server SMTP partenaire.<br><em><strong>Attention :</strong> établir une connexion avec un certificat SSL non vérifié peut induire des problèmes de sécurité.</em>',
	'SMTP_VERIFY_PEER_NAME'			=> 'Vérifier le nom du partenaire SMTP',
	'SMTP_VERIFY_PEER_NAME_EXPLAIN'	=> 'Exige la vérification du nom du partenaire pour les serveurs SMTP utilisant une connexion SSL/TLS.<br><em><strong>Attention :</strong> établir une connexion à un partenaire non vérifié peut induire des problèmes de sécurité.</em>',
	'TEST_EMAIL_SENT'				=> 'Le courriel de test a été envoyé.<br>Si vous ne le recevez pas, veuillez vérifier les paramètres courriels du forum.<br><br>Si vous avez besoin d’assistance, veuillez visiter le <a href="https://www.phpbb.com/community/">forum de support phpBB</a> (en anglais) ou le <a href="http://forums.phpbb-fr.com/">forum de support phpBB-fr.com</a> (en français).',

	'USE_SMTP'						=> 'Utiliser un serveur SMTP pour l’envoi de courriels',
	'USE_SMTP_EXPLAIN'				=> 'Sélectionnez « Oui » si vous voulez ou devez envoyer les courriels par l’intermédiaire d’un serveur au lieu d’utiliser la fonction courriel locale.',
));

// Jabber settings
$lang = array_merge($lang, array(
	'ACP_JABBER_SETTINGS_EXPLAIN'	=> 'Vous pouvez activer et contrôler l’utilisation de Jabber pour la messagerie instantanée et les notifications du forum. Jabber est un protocole open-source et donc librement utilisable. Certains serveurs Jabber contiennent des passerelles qui vous permettent de contacter des utilisateurs sur d’autres réseaux. Tous les serveurs n’offrent pas cette possibilité. Assurez-vous de renseigner les informations d’un compte déjà enregistré - phpBB utilisera les informations indiquées telles quelles.',

	'JAB_ALLOW_SELF_SIGNED'			=> 'Autoriser les certificats SSL auto-signés',
	'JAB_ALLOW_SELF_SIGNED_EXPLAIN'	=> 'Autorise les connexions à un serveur Jabber utilisant un certificat SSL auto-signé.<br><em><strong>Attention :</strong> autoriser des certificats SSL auto-signés peut induire des problèmes de sécurité.</em>',
	'JAB_ENABLE'					=> 'Activer Jabber',
	'JAB_ENABLE_EXPLAIN'			=> 'Active l’utilisation de Jabber pour l’envoi de messages et de notifications.',
	'JAB_GTALK_NOTE'				=> 'Notez que GTalk ne marchera pas car la fonction <samp>dns_get_record</samp> est introuvable. Cette fonction n’est pas disponible dans PHP4 et elle n’est pas implémentée sur les environnements Windows. Cela ne fonctionne pas non plus sur les système basés sous BSD, y compris Mac OS.',
	'JAB_PACKAGE_SIZE'				=> 'Taille des paquets Jabber',
	'JAB_PACKAGE_SIZE_EXPLAIN'		=> 'Nombre de messages envoyés dans un paquet. Si mis à « 0 », le message est envoyé immédiatement et ne sera pas placé en file d’attente.',
	'JAB_PASSWORD'					=> 'Mot de passe Jabber',
	'JAB_PASSWORD_EXPLAIN'			=> '<em><strong>Attention :</strong> ce mot de passe sera stocké en clair dans la base de données, visible de toute personne ayant accès à votre base de données ou à cette page de configuration.</em>',
	'JAB_PORT'						=> 'Port Jabber',
	'JAB_PORT_EXPLAIN'				=> 'Laissez cette case vide à moins que vous sachiez qu’il ne s’agisse pas du port 5222.',
	'JAB_SERVER'					=> 'Serveur Jabber',
	'JAB_SERVER_EXPLAIN'			=> 'Consultez %sjabber.org%s pour la liste des serveurs.',
	'JAB_SETTINGS_CHANGED'			=> 'Les paramètres Jabber ont été modifiés.',
	'JAB_USE_SSL'					=> 'Utiliser SSL pour se connecter',
	'JAB_USE_SSL_EXPLAIN'			=> 'Si activé, une connexion sécurisée tentera d’être établie. Le port de Jabber sera modifié en 5223, si le port 5222 est utilisé.',
	'JAB_USERNAME'					=> 'Nom d’utilisateur Jabber ou JID',
	'JAB_USERNAME_EXPLAIN'			=> 'Indiquez un nom d’utilisateur enregistré ou un JID valide. La validité du nom d’utilisateur ne sera pas vérifiée. Si vous ne spécifiez qu’un nom d’utilisateur, votre JID sera calculé à partir de ce nom et de celui du serveur spécifié ci-dessus. Sinon, spécifiez un JID valide, par exemple utilisateur@jabber.org.',
	'JAB_VERIFY_PEER'				=> 'Vérifier le certificat SSL',
	'JAB_VERIFY_PEER_EXPLAIN'		=> 'Exige la vérification du certificat SSL utilisé par le serveur Jabber.<br><em><strong>Attention :</strong> établir une connexion avec un certificat SSL non vérifié peut induire des problèmes de sécurité.</em>',
	'JAB_VERIFY_PEER_NAME'			=> 'Vérifier le nom du partenaire Jabber',
	'JAB_VERIFY_PEER_NAME_EXPLAIN'	=> 'Exige la vérification du nom du partenaire pour les serveurs Jabber utilisant une connexion SSL/TLS.<br><em><strong>Attention :</strong> établir une connexion à un partenaire non vérifié peut induire des problèmes de sécurité.</em>',
));
