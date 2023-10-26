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

// User pruning
$lang = array_merge($lang, array(
	'ACP_PRUNE_USERS_EXPLAIN'   => 'Questa sezione ti consente di eliminare o disattivare gli utenti. I nominativi possono essere filtrati in diversi modi; per numero di messaggi, per data di ultima attività, ecc. I criteri di scelta possono essere combinati per affinare la ricerca dei nominativi interessati. Per esempio puoi cancellare gli utenti con meno di 10 messaggi, che risultano inattivi dal 2008-02-20. Usa * come jolly per i campi di testo. In alternativa puoi evitare di impostare i criteri inserendo una lista di utenti (uno per ogni riga) nel campo di inserimento testo. Fai attenzione con questo strumento!!! Una volta che hai eliminato un utente non c’è modo di tornare indietro.',

	'CRITERIA'				=> 'Criteri',

	'DEACTIVATE_DELETE'			=> 'Disattiva o cancella',
	'DEACTIVATE_DELETE_EXPLAIN'	=> 'Scegli se disattivare gli utenti o cancellarli del tutto; attenzione, non c’è modo di tornare indietro!',
	'DELETE_USERS'				=> 'Cancella',
	'DELETE_USER_POSTS'			=> 'Cancella i messaggi dell’utente',
	'DELETE_USER_POSTS_EXPLAIN' => 'Rimuovi tutti i messaggi scritti dall’utente che stai eliminando; non ha effetto se l’utente viene disattivato.',

	'JOINED_EXPLAIN'			=> 'Inserisci una data nel formato <kbd>AAAA-MM-GG</kbd>. È possibile utilizzare entrambi i campi per specificare un intervallo, o lasciare vuoto per un intervallo di date aperto.',

	'LAST_ACTIVE_EXPLAIN'		=> 'Inserisci una data nel formato <kbd>AAAA-MM-GG</kbd>. Inserisci <kbd>0000-00-00</kbd> per cancellare gli utenti che non hanno mai effettuato un accesso; <em>Prima</em> e <em>Dopo</em> non sono presi in considerazione.',

	'POSTS_ON_QUEUE'			=> 'Messaggi in attesa di approvazione',
	'PRUNE_USERS_GROUP_EXPLAIN'	=> 'Limitare gli utenti all’interno del gruppo selezionato.',
	'PRUNE_USERS_GROUP_NONE'	=> 'Tutti i gruppi',
	'PRUNE_USERS_LIST'				=> 'Lista utenti soggetti a cancellazione',
	'PRUNE_USERS_LIST_DELETE'		=> 'Con il criterio di scelta impostato, i seguenti account saranno rimossi. È possibile rimuovere singoli utenti dalla lista cancellazione deselezionando la casella accanto al loro nome utente.',
	'PRUNE_USERS_LIST_DEACTIVATE'	=> 'Con il criterio di scelta impostato, i seguenti account saranno disattivati. È possibile rimuovere singoli utenti dalla lista disattivazione deselezionando la casella accanto a loro nome utente.',

	'SELECT_USERS_EXPLAIN'		=> 'Inserisci qui i nomi utente prescelti; saranno usati in alternativa ai criteri di scelta sopra indicati. I fondatori non possono essere cancellati',

	'USER_DEACTIVATE_SUCCESS'	=> 'Gli utenti selezionati sono stati disattivati.',
	'USER_DELETE_SUCCESS'		=> 'Gli utenti selezionati sono stati cancellati.',
	'USER_PRUNE_FAILURE'		=> 'Nessun utente selezionato con questo criterio di scelta.',

	'WRONG_ACTIVE_JOINED_DATE'	=> 'La data inserita non è corretta, il formato corretto è <kbd>AAAA-MM-GG</kbd>.',
));

// Forum Pruning
$lang = array_merge($lang, array(
	'ACP_PRUNE_FORUMS_EXPLAIN'   => 'Questo cancellerà ogni argomento nel quale non vi è stato scritto alcun messaggio o che non è stato letto da un certo numero di giorni da te scelto. Se non inserisci alcun numero tutti gli argomenti verranno cancellati. Come impostazione base non vengono rimossi argomenti nei quali i sondaggi sono ancora in corso e nemmeno gli argomenti importanti.',

	'FORUM_PRUNE'		=> 'Cancellazione nei forum',

	'NO_PRUNE'			=> 'Nessun forum soggetto a cancellazione.',

	'SELECTED_FORUM'	=> 'Forum selezionato',
	'SELECTED_FORUMS'	=> 'Forum selezionati',

	'POSTS_PRUNED'					=> 'Messaggi soggetti a cancellazione',
	'PRUNE_ANNOUNCEMENTS'			=> 'Cancellazione annunci',
	'PRUNE_FINISHED_POLLS'			=> 'Cancellazione sondaggi chiusi',
	'PRUNE_FINISHED_POLLS_EXPLAIN'	=> 'Rimuove gli argomenti con sondaggi terminati.',
	'PRUNE_FORUM_CONFIRM'			=> 'Sei sicuro di voler effettuare la cancellazione nei forum selezionati con i parametri specificati? Una volta rimossi, non potrai in alcun modo recuperare i messaggi e gli argomenti.',
	'PRUNE_NOT_POSTED'				=> 'Giorni trascorsi dall’ultimo messaggio',
	'PRUNE_NOT_VIEWED'				=> 'Giorni trascorsi dall’ultima lettura',
	'PRUNE_OLD_POLLS'				=> 'Cancellazione vecchi sondaggi',
	'PRUNE_OLD_POLLS_EXPLAIN'		=> 'Rimuove gli argomenti con sondaggi non votati da un certo numero di giorni.',
	'PRUNE_STICKY'					=> 'Cancellazione argomenti importanti',
	'PRUNE_SUCCESS'					=> 'Cancellazione all’interno dei forum avvenuta.',

	'TOPICS_PRUNED'		=> 'Argomenti soggetti a cancellazione',
));
