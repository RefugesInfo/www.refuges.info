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
	'APPROVE'								=> 'Approuver',
	'ATTACHMENT'						=> 'Fichier(s) joint(s)',
	'ATTACHMENT_FUNCTIONALITY_DISABLED'	=> 'Les fichiers joints ont été désactivés.',

	'BOOKMARK_ADDED'		=> 'Le sujet a été ajouté aux favoris.',
	'BOOKMARK_ERR'			=> 'Le sujet n’a pas pu être ajouté aux favoris. Essayez à nouveau.',
	'BOOKMARK_REMOVED'		=> 'Le sujet a été supprimé des favoris.',
	'BOOKMARK_TOPIC'		=> 'Ajouter ce sujet aux favoris',
	'BOOKMARK_TOPIC_REMOVE'	=> 'Supprimer ce sujet des favoris',
	'BUMPED_BY'				=> 'Sujet remonté par %1$s le %2$s.',
	'BUMP_TOPIC'			=> 'Remonter le sujet',

	'DELETE_TOPIC'			=> 'Supprimer le sujet',
	'DELETED_INFORMATION'	=> 'Supprimé par %1$s le %2$s',
	'DISAPPROVE'			=> 'Désapprouver',
	'DOWNLOAD_NOTICE'		=> 'Vous n’avez pas les permissions nécessaires pour voir les fichiers joints à ce message.',

	'EDITED_TIMES_TOTAL'	=> array(
		1	=> 'Modifié en dernier par %2$s le %3$s, modifié %1$d fois.',
		2	=> 'Modifié en dernier par %2$s le %3$s, modifié %1$d fois.',
	),
	'EMAIL_TOPIC'			=> 'Envoyer le sujet par courriel',
	'ERROR_NO_ATTACHMENT'	=> 'Le fichier joint sélectionné n’est plus disponible.',

	'FILE_NOT_FOUND_404'	=> 'Le fichier <strong>%s</strong> n’existe pas.',
	'FORK_TOPIC'			=> 'Copier le sujet',
	'FULL_EDITOR'			=> 'Éditeur complet &amp; Aperçu',

	'LINKAGE_FORBIDDEN'		=> 'Vous n’avez pas l’autorisation de consulter, télécharger ou de mettre en lien un fichier joint vers ou depuis de ce site.',
	'LOGIN_NOTIFY_TOPIC'	=> 'Vous avez demandé à surveiller ce sujet. Connectez-vous pour le voir.',
	'LOGIN_VIEWTOPIC'		=> 'Vous devez être enregistré et connecté pour voir ce sujet.',

	'MAKE_ANNOUNCE'				=> 'Changer en « Annonce »',
	'MAKE_GLOBAL'				=> 'Changer en « Annonce globale »',
	'MAKE_NORMAL'				=> 'Changer en « Sujet normal »',
	'MAKE_STICKY'				=> 'Changer en « Sujet épinglé »',
	'MAX_OPTIONS_SELECT'		=> array(
		1	=> 'Vous pouvez sélectionner <strong>%d</strong> option',
		2	=> 'Vous pouvez sélectionner <strong>%d</strong> options',
	),
	'MISSING_INLINE_ATTACHMENT'	=> 'Le fichier joint <strong>%s</strong> n’est plus disponible.',
	'MOVE_TOPIC'				=> 'Déplacer le sujet',

	'NO_ATTACHMENT_SELECTED'=> 'Vous n’avez pas sélectionné de fichier joint à voir ou à télécharger.',
	'NO_NEWER_TOPICS'		=> 'Aucun sujet plus récent dans ce forum.',
	'NO_OLDER_TOPICS'		=> 'Aucun sujet plus ancien dans ce forum.',
	'NO_UNREAD_POSTS'		=> 'Aucun nouveau message non-lu dans ce sujet.',
	'NO_VOTE_OPTION'		=> 'Vous devez choisir une option lorsque vous votez.',
	'NO_VOTES'				=> 'Aucun vote',
	'NO_AUTH_PRINT_TOPIC'	=> 'Vous n’êtes pas autorisé à imprimer des sujets.',

	'POLL_ENDED_AT'			=> 'Le sondage s’est terminé le %s',
	'POLL_RUN_TILL'			=> 'Le sondage est actif jusqu’au %s',
	'POLL_VOTED_OPTION'		=> 'Vous avez voté pour cette option',
	'POST_DELETED_RESTORE'	=> 'Ce sujet a été supprimé. Il peut être restauré.',
	'PRINT_TOPIC'			=> 'Imprimer le sujet',

	'QUICK_MOD'				=> 'Actions rapides de modération',
	'QUICKREPLY'			=> 'Réponse rapide',

	'REPLY_TO_TOPIC'		=> 'Répondre au sujet',
	'RESTORE'				=> 'Restaurer',
	'RESTORE_TOPIC'			=> 'Restaurer le sujet',
	'RETURN_POST'			=> '%sRevenir au message%s',

	'SUBMIT_VOTE'			=> 'Voter',

	'TOPIC_TOOLS'			=> 'Outils de sujet',
	'TOTAL_VOTES'			=> 'Nombre total de votes',

	'UNLOCK_TOPIC'			=> 'Déverrouiller le sujet',

	'VIEW_INFO'				=> 'Informations du message',
	'VIEW_NEXT_TOPIC'		=> 'Sujet suivant',
	'VIEW_PREVIOUS_TOPIC'	=> 'Sujet précédent',
	'VIEW_RESULTS'			=> 'Voir les résultats',
	'VIEW_TOPIC_POSTS'		=> array(
		1	=> '%d message',
		2	=> '%d messages',
	),
	'VIEW_UNREAD_POST'		=> 'Voir le premier message non lu',
	'VOTE_SUBMITTED'		=> 'Votre vote a été pris en compte.',
	'VOTE_CONVERTED'		=> 'La modification d’un vote n’est pas possible pour les sondages issus d’une conversion.',

));
