<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @copyright (c) 2010 phpBB.it
* @copyright (c) 2014 phpBBItalia.net <https://www.phpbbitalia.net>
* @copyright (c) 2018 phpBB-Store.it <https://www.phpbb-store.it>
* @copyright (c) 2021 phpBB-Italia.it <https://www.phpbb-italia.it>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
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

$lang = array_merge($lang, array(
	'ALREADY_DEFAULT_GROUP'		=> 'Il gruppo selezionato è già il tuo gruppo predefinito.',
	'ALREADY_IN_GROUP'			=> 'Sei già iscritto al gruppo selezionato.',
	'ALREADY_IN_GROUP_PENDING'	=> 'Hai già fatto richiesta di adesione al gruppo selezionato.',

	'CANNOT_JOIN_GROUP'			=> 'Non puoi iscriverti a questo gruppo. Puoi iscriverti solo a gruppi aperti.',
	'CANNOT_RESIGN_GROUP'		=> 'Non puoi cancellarti da questo gruppo. Puoi solo cancellarti da gruppi aperti.',
	'CHANGED_DEFAULT_GROUP'		=> 'Cambio del gruppo predefinito riuscito.',

	'GROUP_AVATAR'						=> 'Avatar del gruppo',
	'GROUP_CHANGE_DEFAULT'				=> 'Sei sicuro di voler cambiare la tua iscrizione predefinita con il gruppo “%s”?',
	'GROUP_CLOSED'						=> 'Chiuso',
	'GROUP_DESC'						=> 'Descrizione gruppo',
	'GROUP_HIDDEN'						=> 'Nascosto',
	'GROUP_INFORMATION'					=> 'Informazioni gruppo',
	'GROUP_IS_CLOSED'					=> 'Questo è un gruppo chiuso, i nuovi utenti possono iscriversi solo dopo l’invito da parte del leader del gruppo stesso.',
	'GROUP_IS_FREE'						=> 'Questo è un gruppo libero, tutti gli utenti possono liberamente iscriversi.',
	'GROUP_IS_HIDDEN'					=> 'Questo è un gruppo nascosto, solo gli iscritti al gruppo stesso possono vederlo.',
	'GROUP_IS_OPEN'						=> 'Questo è un gruppo aperto, gli iscritti al forum possono richiedere l’iscrizione.',
	'GROUP_IS_SPECIAL'					=> 'Questo è un gruppo speciale ed è gestito dagli amministratori del forum.',
	'GROUP_JOIN'						=> 'Iscriviti al gruppo',
	'GROUP_JOIN_CONFIRM'				=> 'Sei sicuro di volerti iscrivere al gruppo selezionato?',
	'GROUP_JOIN_PENDING'				=> 'Richiesta d’iscrizione al gruppo',
	'GROUP_JOIN_PENDING_CONFIRM'		=> 'Sei sicuro di voler richiedere l’iscrizione al gruppo selezionato?',
	'GROUP_JOINED'						=> 'Sei stato iscritto al gruppo selezionato.',
	'GROUP_JOINED_PENDING'				=> 'Richiesta di iscrizione inviata. Attendi l’approvazione da parte del leader del gruppo.',
	'GROUP_LIST'						=> 'Gestione iscritti',
	'GROUP_MEMBERS'						=> 'Iscritti al gruppo',
	'GROUP_NAME'						=> 'Nome gruppo',
	'GROUP_OPEN'						=> 'Aperto',
	'GROUP_RANK'						=> 'Livello gruppo',
	'GROUP_RESIGN_MEMBERSHIP'			=> 'Cancellati dal gruppo',
	'GROUP_RESIGN_MEMBERSHIP_CONFIRM'	=> 'Sei sicuro di volerti cancellare dal gruppo selezionato?',
	'GROUP_RESIGN_PENDING'				=> 'Ritira iscrizione al gruppo',
	'GROUP_RESIGN_PENDING_CONFIRM'		=> 'Sei sicuro di voler ritirare la richiesta d’iscrizione al gruppo selezionato?',
	'GROUP_RESIGNED_MEMBERSHIP'			=> 'Sei stato cancellato dal gruppo selezionato.',
	'GROUP_RESIGNED_PENDING'			=> 'La tua richiesta d’iscrizione al gruppo selezionato è stata cancellata.',
	'GROUP_TYPE'						=> 'Tipo di gruppo',
	'GROUP_UNDISCLOSED'					=> 'Gruppo nascosto',
	'FORUM_UNDISCLOSED'					=> 'Sta moderando sezioni nascoste',

	'LOGIN_EXPLAIN_GROUP'	=> 'Devi essere iscritto e connesso per vedere i dettagli del gruppo.',

	'NO_LEADERS'					=> 'Non sei leader di alcun gruppo.',
	'NOT_LEADER_OF_GROUP'			=> 'L’operazione richiesta non può essere conclusa perché non sei il leader del gruppo selezionato.',
	'NOT_MEMBER_OF_GROUP'			=> 'L’operazione richiesta non può essere conclusa perché non sei iscritto al gruppo selezionato, o ancora non hai avuto approvazione di adesione.',
	'NOT_RESIGN_FROM_DEFAULT_GROUP'	=> 'Non puoi cancellarti dal gruppo predefinito.',

	'PRIMARY_GROUP'		=> 'Gruppo principale',

	'REMOVE_SELECTED'	=> 'Rimuovi selezionati',

	'USER_GROUP_CHANGE'			=> 'Dal gruppo “%1$s” al gruppo “%2$s”',
	'USER_GROUP_DEMOTE'			=> 'Dimettiti da leader',
	'USER_GROUP_DEMOTE_CONFIRM'	=> 'Sei sicuro di volerti dimettere dal ruolo di leader dal gruppo selezionato?',
	'USER_GROUP_DEMOTED'		=> 'Non sei più leader del gruppo.',
));
