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

// User pruning
$lang = array_merge($lang, array(
	'ACP_PRUNE_USERS_EXPLAIN'	=> 'Cette section vous permet de supprimer ou désactiver des utilisateurs de votre forum. Les comptes peuvent être filtrés selon différents critères : par nombre de message, la plus récente activité, etc. Les critères peuvent être combinés de manière à limiter le nombre de comptes qui seront affectés. Par exemple, vous pouvez supprimer les utilisateurs ayant moins de 10 messages, et qui sont également inactifs depuis le 1er janvier 2002. Utilisez * comme joker pour les champs texte. Autrement, Vous pouvez passer complètement la sélection de critères, en entrant une liste d’utilisateurs (chaque utilisateur sur une ligne différente) dans la zone de texte. Soyez vigilant avec cette fonctionnalité ! Une fois qu’un utilisateur est supprimé il n’y a aucun moyen de revenir en arrière.',

	'CRITERIA'				=> 'Critères',

	'DEACTIVATE_DELETE'			=> 'Désactiver ou supprimer',
	'DEACTIVATE_DELETE_EXPLAIN'	=> 'Choisissez ici de désactiver des utilisateurs ou de les supprimer définitivement. Notez que la suppression d’utilisateurs est irréversible.',
	'DELETE_USERS'				=> 'Supprimer',
	'DELETE_USER_POSTS'			=> 'Supprimer les messages des utilisateurs délestés',
	'DELETE_USER_POSTS_EXPLAIN'	=> 'Supprime les messages des utilisateurs délestés, n’a aucun effet sur les utilisateurs désactivés.',

	'JOINED_EXPLAIN'			=> 'Saisissez une date au format <kbd>AAAA-MM-JJ</kbd>. Vous devez renseigner au moins un des deux champs afin de définir soit une date de début, soit une date de fin. Renseignez les deux champs pour spécifier un intervalle.',

	'LAST_ACTIVE_EXPLAIN'		=> 'Saisissez une date au format <kbd>AAAA-MM-JJ</kbd>. Indiquez <kbd>0000-00-00</kbd> pour supprimer les utilisateurs qui ne se sont jamais connectés, les conditions <em>Avant</em> et <em>Après</em> seront ignorées.',

	'POSTS_ON_QUEUE'			=> 'Messages en attente d’approbation',
	'PRUNE_USERS_GROUP_EXPLAIN'	=> 'Limiter aux utilisateurs du groupe sélectionné.',
	'PRUNE_USERS_GROUP_NONE'	=> 'Tous les groupes',
	'PRUNE_USERS_LIST'				=> 'Utilisateurs à délester',
	'PRUNE_USERS_LIST_DELETE'		=> 'Les comptes utilisateurs répondant aux critères de délestage seront supprimés. Dans la liste ci-dessous, décochez la case se trouvant à côté du nom de l’utilisateur que vous ne souhaitez pas supprimer définitivement.',
	'PRUNE_USERS_LIST_DEACTIVATE'	=> 'Les comptes utilisateurs répondant aux critères de délestage seront désactivés. Dans la liste ci-dessous, décochez la case se trouvant à côté du nom de l’utilisateur que vous ne souhaitez pas désactiver.',

	'SELECT_USERS_EXPLAIN'		=> 'Saisissez ici des noms d’utilisateurs. Ils seront utilisés sans tenir compte des critères précédents. Les fondateurs ne peuvent pas être supprimés.',

	'USER_DEACTIVATE_SUCCESS'	=> 'Les utilisateurs sélectionnés ont été désactivés.',
	'USER_DELETE_SUCCESS'		=> 'Les utilisateurs sélectionnés ont été supprimés.',
	'USER_PRUNE_FAILURE'		=> 'Aucun utilisateur ne répond aux critères.',

	'WRONG_ACTIVE_JOINED_DATE'	=> 'La date est incorrecte. Elle doit être au format <kbd>AAAA-MM-JJ</kbd>.',
));

// Forum Pruning
$lang = array_merge($lang, array(
	'ACP_PRUNE_FORUMS_EXPLAIN'	=> 'Ceci supprimera les sujets n’ayant pas reçu de réponse ou n’ayant pas été consultés depuis le nombre de jours que vous avez indiqué. Si vous n’indiquez pas un nombre de jours, tous les sujets seront supprimés. Par défaut, cette action ne supprimera pas les sujets ayant des sondages actifs, ni les annonces et les sujets épinglés.',

	'FORUM_PRUNE'		=> 'Délestage',

	'NO_PRUNE'			=> 'Pas de forums délestés.',

	'SELECTED_FORUM'	=> 'Forum sélectionné',
	'SELECTED_FORUMS'	=> 'Forums sélectionnés',

	'POSTS_PRUNED'					=> 'Messages délestés',
	'PRUNE_ANNOUNCEMENTS'			=> 'Délester les annonces',
	'PRUNE_FINISHED_POLLS'			=> 'Délester les sondages expirés',
	'PRUNE_FINISHED_POLLS_EXPLAIN'	=> 'Supprimer les sujets avec un sondage expiré.',
	'PRUNE_FORUM_CONFIRM'			=> 'Êtes-vous sûr de vouloir délester les forums sélectionnés selon les critères précédemment définis ? Une fois supprimés, il n’y a aucun moyen de récupérer les sujets et les messages.',
	'PRUNE_NOT_POSTED'				=> 'Nombre de jours depuis le dernier message posté',
	'PRUNE_NOT_VIEWED'				=> 'Nombre de jours depuis la dernière consultation du sujet',
	'PRUNE_OLD_POLLS'				=> 'Délester les anciens sondages',
	'PRUNE_OLD_POLLS_EXPLAIN'		=> 'Supprime les sujets contenant des sondages sans vote depuis le nombre de jours sélectionné.',
	'PRUNE_STICKY'					=> 'Délester les sujets épinglés',
	'PRUNE_SUCCESS'					=> 'Le délestage des forums a été effectué.',

	'TOPICS_PRUNED'		=> 'Sujets délestés',
));
