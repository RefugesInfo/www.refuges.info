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

// Banning
$lang = array_merge($lang, array(
	'1_HOUR'		=> '1 ora',
	'30_MINS'		=> '30 minuti',
	'6_HOURS'		=> '6 ore',

	'ACP_BAN_EXPLAIN'	=> 'Da qui puoi effettuare il ban di utenti tramite il nome, l’IP o l’indirizzo email. Questo impedirà all’utente di raggiungere qualsiasi parte della Board. Puoi allegare una breve spiegazione del ban se lo desideri (3000 caratteri), che verrà visualizzata anche nel log amministratore. Anche la durata del ban può essere specificata. Se desideri che un ban finisca ad una data specifica piuttosto che dopo un periodo di tempo determinato, seleziona <span style="text-decoration: underline;">Fino a -&gt;</span> nella durata del ban e inserisci una data nel formato <kbd>AAAA-MM-GG</kbd>.',

	'BAN_EXCLUDE'			=> 'Escludi dal ban',
	'BAN_LENGTH'			=> 'Durata del ban',
	'BAN_REASON'			=> 'Motivo del ban',
	'BAN_GIVE_REASON'		=> 'Motivazione visualizzata dal bannato',
	'BAN_UPDATE_SUCCESSFUL'	=> 'Lista dei ban aggiornata.',
	'BANNED_UNTIL_DATE'     => 'fino a %s', // Example: "until Mon 13.Jul.2009, 14:44"
	'BANNED_UNTIL_DURATION' => '%1$s (fino a %2$s)', // Example: "7 days (until Tue 14.Jul.2009, 14:44)"

	'EMAIL_BAN'					=> 'Banna uno o più indirizzi email',
	'EMAIL_BAN_EXCLUDE_EXPLAIN'	=> 'Abilita questo per escludere l’indirizzo email inserito da tutti i ban correnti.',
	'EMAIL_BAN_EXPLAIN'			=> 'Puoi indicare più di un indirizzo email inserendone uno per linea. Per indirizzi parziali usa “*” es. <samp>*@hotmail.com</samp>, <samp>*@*.domain.tld</samp>, ecc.',
	'EMAIL_NO_BANNED'			=> 'Nessun indirizzo email bannato',
	'EMAIL_UNBAN'				=> 'Riabilita o non escludere email',
	'EMAIL_UNBAN_EXPLAIN'		=> 'Puoi riabilitare (o non escludere) dal ban più indirizzi email con un’unica azione, selezionando e cliccando su <strong>Invia</strong>. Gli indirizzi email esclusi hanno uno sfondo grigio.',

	'IP_BAN'					=> 'Banna uno o più IP',
	'IP_BAN_EXCLUDE_EXPLAIN'	=> 'Attiva questo per escludere l’indirizzo IP da tutti i ban correnti.',
	'IP_BAN_EXPLAIN'			=> 'Puoi indicare diversi IP o nome server inserendone uno per linea. Per indicare un range di indirizzi IP, separane l’inizio e la fine con un trattino (-) mentre per indicare un’abbreviazione usa “*”.',
	'IP_HOSTNAME'				=> 'Indirizzo IP o nome server',
	'IP_NO_BANNED'				=> 'Nessun indirizzo IP bannato',
	'IP_UNBAN'					=> 'Riabilita o non escludere IP',
	'IP_UNBAN_EXPLAIN'			=> 'Puoi riabilitare (o non-escludere) dal ban più indirizzi IP con un’unica azione, selezionando e cliccando su <strong>Invia</strong>. Gli IP esclusi hanno uno sfondo grigio.',

	'LENGTH_BAN_INVALID'		=> 'La data deve essere nel formato <kbd>AAAA-MM-GG</kbd>.',
	'OPTIONS_BANNED'			=> 'Bannato',
	'OPTIONS_EXCLUDED'			=> 'Escluso',
	'PERMANENT'					=> 'Permanente',

	'UNTIL'						=> 'Fino a',
	'USER_BAN'					=> 'Banna uno o più utenti in base al nome utente',
	'USER_BAN_EXCLUDE_EXPLAIN'	=> 'Abilita questo per escludere gli utenti inseriti da tutti i ban correnti.',
	'USER_BAN_EXPLAIN'			=> 'Puoi bannare più utenti inserendone uno per linea. Usa <span style="text-decoration: underline;">Trova utente</span> per trovare e aggiungere uno o più utenti automaticamente.',
	'USER_NO_BANNED'			=> 'Nessun nome utente bannato',
	'USER_UNBAN'				=> 'Riabilita o non escludere utenti in base al nome utente',
	'USER_UNBAN_EXPLAIN'		=> 'Puoi riabilitare (o non-escludere) dal ban più utenti con un’unica azione, selezionando e cliccando su <strong>Invia</strong>. Gli utenti esclusi hanno uno sfondo grigio.',
));
