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

// Forum Admin
$lang = array_merge($lang, array(
	'AUTO_PRUNE_DAYS'			=> 'Ancienneté des messages délestés automatiquement',
	'AUTO_PRUNE_DAYS_EXPLAIN'	=> 'Nombre de jours depuis le dernier message avant suppression du sujet.',
	'AUTO_PRUNE_FREQ'			=> 'Fréquence du délestage automatique',
	'AUTO_PRUNE_FREQ_EXPLAIN'	=> 'Durée en jours entre les événements de délestage.',
	'AUTO_PRUNE_VIEWED'			=> 'Ancienneté des messages vus délestés automatiquement',
	'AUTO_PRUNE_VIEWED_EXPLAIN'	=> 'Nombre de jours entre la dernière consultation et la suppression du sujet.',
	'AUTO_PRUNE_SHADOW_FREQ'	=> 'Fréquence de délestage automatique des sujets-traceurs',
	'AUTO_PRUNE_SHADOW_DAYS'	=> 'Ancienneté des sujets-traceurs délestés automatiquement',
	'AUTO_PRUNE_SHADOW_DAYS_EXPLAIN'	=> 'Nombre de jours depuis le dernier message du sujet avant suppression du sujet-traceur.',
	'AUTO_PRUNE_SHADOW_FREQ_EXPLAIN'	=> 'Intervalle, en jours, entre chaque délestage.',

	'CONTINUE'						=> 'Continuer',
	'COPY_PERMISSIONS'				=> 'Copier les permissions depuis',
	'COPY_PERMISSIONS_EXPLAIN'		=> 'Pour faciliter la mise en place des permissions pour votre nouveau forum, vous pouvez copier les permissions d’un forum existant.',
	'COPY_PERMISSIONS_ADD_EXPLAIN'	=> 'Une fois créé, le forum aura les mêmes permissions que celles sélectionnées ici. Si aucun forum n’est choisi, le nouveau forum ne sera pas visible tant que ses permissions n’auront pas été définies.',
	'COPY_PERMISSIONS_EDIT_EXPLAIN'	=> 'Si vous choisissez de copier les permissions, le forum aura les mêmes permissions que celles sélectionnées ici. Elles remplaceront toutes les permissions précédemment définies pour ce forum, par les permissions du forum sélectionné. Si aucun forum n’est choisi les permissions actuelles seront conservées.',
	'COPY_TO_ACL'					=> 'Autrement, vous êtes aussi capable de %srégler de nouvelles permissions%s pour ce forum.',
	'CREATE_FORUM'					=> 'Créer un nouveau forum',

	'DECIDE_MOVE_DELETE_CONTENT'		=> 'Supprimer le contenu ou le déplacer vers un forum',
	'DECIDE_MOVE_DELETE_SUBFORUMS'		=> 'Supprimer ou déplacer les sous-forums vers un forum',
	'DEFAULT_STYLE'						=> 'Style par défaut',
	'DELETE_ALL_POSTS'					=> 'Supprimer les messages',
	'DELETE_SUBFORUMS'					=> 'Supprimer les sous-forums et les messages',
	'DISPLAY_ACTIVE_TOPICS'				=> 'Activer les sujets actifs',
	'DISPLAY_ACTIVE_TOPICS_EXPLAIN'		=> 'Si activé, les sujets actifs des sous-forums choisis seront affichés dans cette catégorie.',

	'EDIT_FORUM'					=> 'Modifier un forum',
	'ENABLE_INDEXING'				=> 'Activer l’indexation de recherche',
	'ENABLE_INDEXING_EXPLAIN'		=> 'Si activé, les messages du forum seront indexés pour la recherche.',
	'ENABLE_POST_REVIEW'			=> 'Activer la révision des messages',
	'ENABLE_POST_REVIEW_EXPLAIN'	=> 'Si activé, les membres seront avertis si de nouveaux messages ont été postés dans le sujet pendant qu’ils rédigeaient le leur. Ceci devrait être désactivé sur les forums de chat.',
	'ENABLE_QUICK_REPLY'			=> 'Activer la réponse rapide',
	'ENABLE_QUICK_REPLY_EXPLAIN'	=> 'Active la réponse rapide dans ce forum. Ce paramètre est ignoré si la réponse rapide est désactivée sur l’ensemble du forum. La réponse rapide sera uniquement affichée aux utilisateurs ayant la permission de poster dans ce forum.',
	'ENABLE_RECENT'					=> 'Afficher les sujets actifs',
	'ENABLE_RECENT_EXPLAIN'			=> 'Si activé, les sujets de ce forum seront affichés dans la liste des sujets actifs.',
	'ENABLE_TOPIC_ICONS'			=> 'Activer les icônes des sujets',

	'FORUM_ADMIN'						=> 'Administration des forums',
	'FORUM_ADMIN_EXPLAIN'				=> 'Dans phpBB3 tout est basé sur la notion de forum. Une catégorie est juste un type spécial de forum. Chaque forum peut contenir un nombre illimité de sous-forums et vous pouvez déterminer s’ils peuvent contenir ou non des messages (c’est-à-dire se comporter ou non comme une ancienne catégorie). Vous pouvez individuellement ajouter, modifier, supprimer, verrouiller, déverrouiller des forums et régler certains paramètres. Si des sujets et des messages se désynchronisent vous pouvez également re-synchroniser un forum. <strong>Vous devez copier ou régler les permissions appropriées pour les nouveaux forums créés, afin qu’ils soient visibles.</strong>',
	'FORUM_AUTO_PRUNE'					=> 'Activer l’auto-délestage',
	'FORUM_AUTO_PRUNE_EXPLAIN'			=> 'Déleste le forum des sujets, réglez les paramètres de fréquence/ancienneté ci-dessous.',
	'FORUM_CREATED'						=> 'Le forum a été créé.',
	'FORUM_DATA_NEGATIVE'				=> 'Les paramètres de délestage ne peuvent pas être négatifs.',
	'FORUM_DELETE'						=> 'Supprimer le forum',
	'FORUM_DELETE_EXPLAIN'				=> 'Le formulaire suivant vous permet de supprimer un forum et de décider où vous désirez déplacer tous les sujets (ou forums) qu’il contient.',
	'FORUM_DELETED'						=> 'Le forum a été supprimé.',
	'FORUM_DESC'						=> 'Description',
	'FORUM_DESC_EXPLAIN'				=> 'Toute balise HTML saisie sera affichée telle quelle. Si le type de forum sélectionné est une catégorie alors la description ne sera pas affichée.',
	'FORUM_DESC_TOO_LONG'				=> 'La description du forum est trop longue. Elle ne peut contenir plus de 4000 caractères.',
	'FORUM_EDIT_EXPLAIN'				=> 'Le formulaire suivant vous permet de personnaliser ce forum. Notez que la modération et les paramètres de contrôle des messages sont définis via les permissions pour chaque utilisateur ou groupe.',
	'FORUM_IMAGE'						=> 'Image du forum',
	'FORUM_IMAGE_EXPLAIN'				=> 'Emplacement, relatif au répertoire racine de phpBB, d’une image supplémentaire à associer à ce forum.',
	'FORUM_IMAGE_NO_EXIST'				=> 'L’image spécifiée pour ce forum n’existe pas.',
	'FORUM_LINK_EXPLAIN'				=> 'URL complète (incluant le protocole, exemple <samp>http://</samp> ) vers laquelle l’utilisateur sera redirigé en cliquant sur ce forum. Par exemple : <samp>http://www.phpbb-fr.com/</samp>.',
	'FORUM_LINK_TRACK'					=> 'Compter les redirections',
	'FORUM_LINK_TRACK_EXPLAIN'			=> 'Enregistre le nombre de fois que le lien a été cliqué.',
	'FORUM_NAME'						=> 'Nom du forum',
	'FORUM_NAME_EMPTY'					=> 'Vous devez indiquer un nom pour le forum.',
	'FORUM_NAME_EMOJI'					=> 'Le nom du forum que vous avez saisi n’est pas valide.<br>Les caractères suivants ne sont pas pris en charge :<br>%s',
	'FORUM_PARENT'						=> 'Forum parent',
	'FORUM_PASSWORD'					=> 'Mot de passe',
	'FORUM_PASSWORD_CONFIRM'			=> 'Confirmation du mot de passe',
	'FORUM_PASSWORD_CONFIRM_EXPLAIN'	=> 'Uniquement si un mot de passe a été saisi.',
	'FORUM_PASSWORD_EXPLAIN'			=> 'Définissez un mot de passe pour ce forum, utilisez de préférence le système de permissions.',
	'FORUM_PASSWORD_UNSET'				=> 'Supprimer le mot de passe du forum',
	'FORUM_PASSWORD_UNSET_EXPLAIN'		=> 'Cochez cette case si vous souhaitez supprimer le mot de passe du forum.',
	'FORUM_PASSWORD_OLD'				=> 'Le mot de passe du forum doit être modifié car il utilise une ancienne méthode de hachage.',
	'FORUM_PASSWORD_MISMATCH'			=> 'Les mots de passe saisis ne concordent pas.',
	'FORUM_PRUNE_SETTINGS'				=> 'Paramètres de délestage des forums',
	'FORUM_PRUNE_SHADOW'				=> 'Activer l’auto-délestage des sujets-traceurs',
	'FORUM_PRUNE_SHADOW_EXPLAIN'		=> 'Déleste le forum des sujets-traceurs selon la fréquence et l’ancienneté des messages définies ci-dessous.',
	'FORUM_RESYNCED'					=> 'Le forum « %s » a été resynchronisé',
	'FORUM_RULES_EXPLAIN'				=> 'Les règles du forum sont affichées sur chaque page du forum.',
	'FORUM_RULES_LINK'					=> 'Lien vers les règles',
	'FORUM_RULES_LINK_EXPLAIN'			=> 'Vous pouvez indiquer l’URL de la page ou du message contenant vos règles. Ce paramètre annulera tout texte de règles de forum que vous avez renseigné.',
	'FORUM_RULES_PREVIEW'				=> 'Aperçu des règles',
	'FORUM_RULES_TOO_LONG'				=> 'Les règles du forum sont trop longues. Elles ne peuvent contenir plus de 4000 caractères.',
	'FORUM_SETTINGS'					=> 'Paramètres du forum',
	'FORUM_STATUS'						=> 'Statut du forum',
	'FORUM_STYLE'						=> 'Style du forum',
	'FORUM_TOPICS_PAGE'					=> 'Sujets par page',
	'FORUM_TOPICS_PAGE_EXPLAIN'			=> 'Cette valeur (autre que « 0 ») annulera le paramètre par défaut des sujets par page.',
	'FORUM_TYPE'						=> 'Type du forum',
	'FORUM_UPDATED'						=> 'Les informations du forum ont été mises à jour.',

	'FORUM_WITH_SUBFORUMS_NOT_TO_LINK'		=> 'Vous souhaitez modifier un forum contenant des sous-forums en un forum-lien. Avant de procéder, déplacez tous les sous-forums hors de ce forum, car une fois le forum modifié en un forum-lien, vous ne pourrez plus consulter les sous-forums.',

	'GENERAL_FORUM_SETTINGS'	=> 'Paramètres généraux du forum',

	'LINK'						=> 'Lien',
	'LIMIT_SUBFORUMS'			=> 'Limiter l’affichage dans la légende uniquement aux sous-forums directs',
	'LIMIT_SUBFORUMS_EXPLAIN'	=> 'Limite l’affichage des sous-forums aux sous-forums qui sont des descendants directs (enfants) du forum actuel. En désactivant cette option cela affichera tous les sous-forums ayant l’option « Lister les sous-forums dans la légende » activée, peu importe la profondeur.',
	'LIST_INDEX'				=> 'Lister le sous-forum dans la légende du forum parent',
	'LIST_INDEX_EXPLAIN'		=> 'Si cette option est activée, ce forum sera listé sous la forme d’un lien dans la légende de tous ses forums parents ayant l’option « Lister les sous-forums dans la légende » activée.',
	'LIST_SUBFORUMS'			=> 'Lister les sous-forums dans la légende',
	'LIST_SUBFORUMS_EXPLAIN'	=> 'Si cette option est activée, tous ses sous-forums, ayant l’option « Lister le sous-forum dans la légende du forum parent » activée, apparaîtront sous la forme d’un lien dans la légende de ce forum.',
	'LOCKED'					=> 'Verrouillé',

	'MOVE_POSTS_NO_POSTABLE_FORUM'	=> 'Le forum que vous avez sélectionné pour y déplacer les messages n’est pas approprié. Sélectionnez un forum destiné à recevoir des messages.',
	'MOVE_POSTS_TO'					=> 'Déplacer les messages',
	'MOVE_SUBFORUMS_TO'				=> 'Déplacer les sous-forums',

	'NO_DESTINATION_FORUM'			=> 'Vous n’avez pas indiqué de forum pour déplacer le contenu.',
	'NO_FORUM_ACTION'				=> 'Aucune action définie pour ce qui se produit avec le contenu du forum',
	'NO_PARENT'						=> 'Aucun parent',
	'NO_PERMISSIONS'				=> 'Ne pas copier les permissions',
	'NO_PERMISSION_FORUM_ADD'		=> 'Vous n’avez pas les permissions requises pour ajouter des forums.',
	'NO_PERMISSION_FORUM_DELETE'	=> 'Vous n’avez pas les permissions requises pour supprimer des forums.',

	'PARENT_IS_LINK_FORUM'		=> 'Le forum-parent que vous avez indiqué est un forum-lien. Les forums-lien ne peuvent pas avoir de sous-forums, indiquez une autre catégorie ou un autre forum en tant que forum-parent.',
	'PARENT_NOT_EXIST'			=> 'Le parent n’existe pas.',
	'PRUNE_ANNOUNCEMENTS'		=> 'Délester les annonces',
	'PRUNE_STICKY'				=> 'Délester les sujets épinglés',
	'PRUNE_OLD_POLLS'			=> 'Délester les anciens sondages',
	'PRUNE_OLD_POLLS_EXPLAIN'	=> 'Supprime les sujets avec des sondages sans vote suivant l’ancienneté des messages délestés automatiquement.',

	'REDIRECT_ACL'	=> 'Vous pouvez désormais %sdéfinir les permissions%s de ce forum.',

	'SYNC_IN_PROGRESS'			=> 'Synchronisation du forum',
	'SYNC_IN_PROGRESS_EXPLAIN'	=> 'Resynchronisation des sujets %1$d/%2$d en cours.',

	'TYPE_CAT'			=> 'Catégorie',
	'TYPE_FORUM'		=> 'Forum',
	'TYPE_LINK'			=> 'Lien',

	'UNLOCKED'			=> 'Déverrouillé',
));
