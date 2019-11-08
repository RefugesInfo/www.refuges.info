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
	'ADMIN_SIG_PREVIEW'		=> 'Aperçu de la signature',
	'AT_LEAST_ONE_FOUNDER'	=> 'Il est impossible de rétrograder ce fondateur en utilisateur normal. Sur le forum, il doit toujours y avoir au moins un fondateur. Si vous voulez changer le statut de fondateur de ce membre, vous devez au préalable promouvoir un autre utilisateur comme fondateur.',

	'BAN_ALREADY_ENTERED'	=> 'Ce bannissement a déjà été effectué. La liste des bannissements n’a pas été mise à jour.',
	'BAN_SUCCESSFUL'		=> 'Le bannissement a été ajouté.',

	'CANNOT_BAN_ANONYMOUS'			=> 'Vous n’êtes pas autorisé à bannir le compte invité. Les permissions des visiteurs peuvent être définies depuis l’onglet « Permissions ».',
	'CANNOT_BAN_FOUNDER'			=> 'Vous n’êtes pas autorisé à bannir les comptes des fondateurs.',
	'CANNOT_BAN_YOURSELF'			=> 'Vous n’êtes pas autorisé à vous bannir.',
	'CANNOT_DEACTIVATE_BOT'			=> 'Vous n’êtes pas autorisé à désactiver les comptes des robots. Désactivez plutôt le robot dans la page des robots.',
	'CANNOT_DEACTIVATE_FOUNDER'		=> 'Vous n’êtes pas autorisé à désactiver les comptes des fondateurs.',
	'CANNOT_DEACTIVATE_YOURSELF'	=> 'Vous n’êtes pas autorisé à désactiver votre propre compte.',
	'CANNOT_FORCE_REACT_BOT'		=> 'Vous n’êtes pas autorisé à forcer la réactivation sur les comptes de robots. Réactivez plutôt le robot dans la page des robots.',
	'CANNOT_FORCE_REACT_FOUNDER'	=> 'Vous n’êtes pas autorisé à forcer la réactivation sur les comptes des fondateurs.',
	'CANNOT_FORCE_REACT_YOURSELF'	=> 'Vous n’êtes pas autorisé à forcer la réactivation de votre propre compte.',
	'CANNOT_REMOVE_ANONYMOUS'		=> 'Vous n’êtes pas autorisé à supprimer le compte invité.',
	'CANNOT_REMOVE_FOUNDER'			=> 'Vous n’êtes pas autorisé à supprimer les comptes des fondateurs.',
	'CANNOT_REMOVE_YOURSELF'		=> 'Vous n’êtes pas autorisé à supprimer votre propre compte.',
	'CANNOT_SET_FOUNDER_IGNORED'	=> 'Vous ne pouvez pas promouvoir des utilisateurs ignorés en fondateurs.',
	'CANNOT_SET_FOUNDER_INACTIVE'	=> 'Vous devez activer les utilisateurs avant de les promouvoir au statut de fondateurs, seuls les utilisateurs activés peuvent être promus.',
	'CONFIRM_EMAIL_EXPLAIN'			=> 'Vous n’avez besoin de renseigner ce champ que si vous modifiez l’adresse courriel du membre.',

	'DELETE_POSTS'			=> 'Supprimer ses messages',
	'DELETE_USER'			=> 'Supprimer ce membre',
	'DELETE_USER_EXPLAIN'	=> 'Notez que la suppression d’un membre est une action irréversible. Les messages privés non lus envoyés par le membre seront supprimés et ne seront pas accessibles aux destinataires.',

	'FORCE_REACTIVATION_SUCCESS'	=> 'La réactivation a été forcée.',
	'FOUNDER'						=> 'Fondateur',
	'FOUNDER_EXPLAIN'				=> 'Les fondateurs ont toutes les permissions et ne peuvent jamais être bannis, supprimés ou modifiés par des utilisateurs non fondateurs.',

	'GROUP_APPROVE'					=> 'Accepter le membre',
	'GROUP_DEFAULT'					=> 'Groupe par défaut',
	'GROUP_DELETE'					=> 'Retirer ce membre du groupe',
	'GROUP_DEMOTE'					=> 'Rétrograder le chef de groupe',
	'GROUP_PROMOTE'					=> 'Promouvoir en chef de groupe',

	'IP_WHOIS_FOR'			=> 'IP whois pour %s',

	'LAST_ACTIVE'			=> 'Dernière visite le',

	'MOVE_POSTS_EXPLAIN'	=> 'Veuillez sélectionner le forum dans lequel seront déplacés tous les messages de ce membre.',

	'NO_SPECIAL_RANK'		=> 'Aucun rang spécial sélectionné',
	'NO_WARNINGS'			=> 'Aucun avertissement.',
	'NOT_MANAGE_FOUNDER'	=> 'Vous avez essayé de gérer un membre ayant le statut de fondateur. Seuls les fondateurs peuvent gérer d’autres fondateurs.',

	'QUICK_TOOLS'			=> 'Outils rapides',

	'REGISTERED'			=> 'Enregistré le',
	'REGISTERED_IP'			=> 'Adresse IP utilisée lors de l’enregistrement',
	'RETAIN_POSTS'			=> 'Conserver ses messages',

	'SELECT_FORM'			=> 'Sélectionner un formulaire',
	'SELECT_USER'			=> 'Sélectionner un membre',

	'USER_ADMIN'					=> 'Administration de l’utilisateur',
	'USER_ADMIN_ACTIVATE'			=> 'Activer son compte',
	'USER_ADMIN_ACTIVATED'			=> 'Le compte a été activé.',
	'USER_ADMIN_AVATAR_REMOVED'		=> 'L’avatar de cet membre a été supprimé.',
	'USER_ADMIN_BAN_EMAIL'			=> 'Bannir par son adresse courriel',
	'USER_ADMIN_BAN_EMAIL_REASON'	=> 'L’adresse courriel a été bannie via le module de gestion des membres',
	'USER_ADMIN_BAN_IP'				=> 'Bannir par son adresse IP',
	'USER_ADMIN_BAN_IP_REASON'		=> 'L’adresse IP a été bannie via le module de gestion des membres',
	'USER_ADMIN_BAN_NAME_REASON'	=> 'Le nom d’utilisateur a été banni via le module de gestion des membres',
	'USER_ADMIN_BAN_USER'			=> 'Bannir par son nom d’utilisateur',
	'USER_ADMIN_DEACTIVATE'			=> 'Désactiver son compte',
	'USER_ADMIN_DEACTIVED'			=> 'Le compte a été désactivé.',
	'USER_ADMIN_DEL_ATTACH'			=> 'Supprimer ses fichiers joints',
	'USER_ADMIN_DEL_AVATAR'			=> 'Supprimer son avatar',
	'USER_ADMIN_DEL_OUTBOX'			=> 'Vider la boîte d’envoi',
	'USER_ADMIN_DEL_POSTS'			=> 'Supprimer ses messages',
	'USER_ADMIN_DEL_SIG'			=> 'Supprimer sa signature',
	'USER_ADMIN_EXPLAIN'			=> 'Vous pouvez modifier les informations d’un membre et certaines options particulières.',
	'USER_ADMIN_FORCE'				=> 'Forcer la réactivation',
	'USER_ADMIN_LEAVE_NR'			=> 'Supprimer du groupe « Nouveaux utilisateurs enregistrés ».',
	'USER_ADMIN_MOVE_POSTS'			=> 'Déplacer ses messages',
	'USER_ADMIN_SIG_REMOVED'		=> 'La signature de ce membre a été supprimée.',
	'USER_ATTACHMENTS_REMOVED'		=> 'Les fichiers joints de ce membre ont été supprimés.',
	'USER_AVATAR_NOT_ALLOWED'		=> 'L’avatar ne peut pas être affiché car les avatars ont été désactivés.',
	'USER_AVATAR_UPDATED'			=> 'Les informations de l’avatar de ce membre ont été mises à jour.',
	'USER_AVATAR_TYPE_NOT_ALLOWED'	=> 'L’avatar actuel ne peut pas être affiché car ce type d’avatar a été désactivé.',
	'USER_CUSTOM_PROFILE_FIELDS'	=> 'Champs de profil personnalisés',
	'USER_DELETED'					=> 'Ce membre a été supprimé.',
	'USER_GROUP_ADD'				=> 'Ajouter ce membre au groupe',
	'USER_GROUP_NORMAL'				=> 'Le membre fait partie des groupes définis',
	'USER_GROUP_PENDING'			=> 'En attente d’acceptation dans les groupes',
	'USER_GROUP_SPECIAL'			=> 'Le membre fait partie des groupes prédéfinis',
	'USER_LIFTED_NR'				=> 'Le statut de nouvel utilisateur enregistré a été supprimé.',
	'USER_NO_ATTACHMENTS'			=> 'Aucun fichier joint à afficher.',
	'USER_NO_POSTS_TO_DELETE'		=> 'Le membre n’a aucun message à conserver ou à supprimer.',
	'USER_OUTBOX_EMPTIED'			=> 'La boîte d’envoi du membre a été vidée.',
	'USER_OUTBOX_EMPTY'				=> 'La boîte d’envoi du membre était déjà vide.',
	'USER_OVERVIEW_UPDATED'			=> 'Les informations de ce membre ont été mises à jour.',
	'USER_POSTS_DELETED'			=> 'Tous les messages de ce membre ont été supprimés.',
	'USER_POSTS_MOVED'				=> 'Tous les messages de ce membre ont été déplacés vers le forum cible.',
	'USER_PREFS_UPDATED'			=> 'Les préférences de ce membre ont été mises à jour.',
	'USER_PROFILE'					=> 'Profil utilisateur',
	'USER_PROFILE_UPDATED'			=> 'Le profil de ce membre a été mis à jour.',
	'USER_RANK'						=> 'Rang du membre',
	'USER_RANK_UPDATED'				=> 'Le rang de ce membre a été mis à jour.',
	'USER_SIG_UPDATED'				=> 'La signature de ce membre a été mise à jour.',
	'USER_WARNING_LOG_DELETED'		=> 'Aucune information disponible. L’enregistrement a probablement été supprimé du journal.',
	'USER_TOOLS'					=> 'Outils de base',
));
