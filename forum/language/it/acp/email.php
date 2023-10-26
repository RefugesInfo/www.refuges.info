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

// Email settings
$lang = array_merge($lang, array(
	'ACP_MASS_EMAIL_EXPLAIN'		=> 'Da qui puoi inviare messaggi email a tutti gli utenti o a quelli di un gruppo specifico, <strong>purché abbiano l’opzione di ricevere email di massa dall’amministratore abilitata</strong>. L’email verrà inviata all’indirizzo amministrativo del Forum, e i destinatari la riceveranno come copia di conoscenza nascosta (CCN). Le impostazioni predefinite prevedono un massimo di 20 destinatari per ciascuna email, quindi se il numero è maggiore, verranno spedite diverse email; pertanto abbi pazienza dopo l’invio e non bloccare il procedimento in corso, in quanto potrebbe durare anche diversi minuti se il numero di destinatari è molto elevato. Al termine dell’operazione verrai informato dell’avvenuto invio.',
	'ALL_USERS'						=> 'Tutti gli utenti',

	'COMPOSE'				=> 'Scrivi messaggio',

	'EMAIL_SEND_ERROR'		=> 'Si sono verificati degli errori durante l’invio email. Controlla il %sLog Errori%s per maggiori dettagli sul tipo di errore.',
	'EMAIL_SENT'			=> 'Il messaggio è stato inviato.',
	'EMAIL_SENT_QUEUE'		=> 'Il messaggio è in attesa di essere trasmesso.',

	'LOG_SESSION'			=> 'Inserisci la sessione email nel log critico',

	'SEND_IMMEDIATELY'		=> 'Invia adesso',
	'SEND_TO_GROUP'			=> 'Invia a gruppo',
	'SEND_TO_USERS'			=> 'Invia a utenti',
	'SEND_TO_USERS_EXPLAIN'	=> 'Inserire nomi qui annullerà qualsiasi gruppo selezionato sopra. Scrivi un nome utente per riga.',

	'MAIL_BANNED'			=> 'Mail agli utenti bannati',
	'MAIL_BANNED_EXPLAIN'	=> 'Quando si invia un’email di massa a un gruppo, è possibile scegliere se anche gli utenti bannati riceveranno l’email.',

	'MAIL_HIGH_PRIORITY'	=> 'Alta',
	'MAIL_LOW_PRIORITY'		=> 'Bassa',
	'MAIL_NORMAL_PRIORITY'	=> 'Normale',
	'MAIL_PRIORITY'			=> 'Priorità',
	'MASS_MESSAGE'			=> 'Il tuo messaggio',
	'MASS_MESSAGE_EXPLAIN'	=> 'Puoi scrivere soltanto testo normale. Tutto il resto sarà rimosso prima della trasmissione.',

	'NO_EMAIL_MESSAGE'		=> 'Devi scrivere il messaggio.',
	'NO_EMAIL_SUBJECT'		=> 'Devi specificare un titolo per il tuo messaggio.',
));
