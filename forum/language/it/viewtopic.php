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
	'APPROVE'							=> 'Approva',
	'ATTACHMENT'						=> 'Allegato',
	'ATTACHMENT_FUNCTIONALITY_DISABLED'	=> 'La funzione allegati è disabilitata.',

	'BOOKMARK_ADDED'		=> 'Segnalibro argomento inserito.',
	'BOOKMARK_ERR'			=> 'L’inserimento del segnalibro argomento non è riuscito. Riprova.',
	'BOOKMARK_REMOVED'		=> 'Segnalibro argomento rimosso.',
	'BOOKMARK_TOPIC'		=> 'Inserisci nei segnalibri',
	'BOOKMARK_TOPIC_REMOVE'	=> 'Rimuovi dai segnalibri',
	'BUMPED_BY'				=> 'Ultimo bump di %1$s effettuato il %2$s.',
	'BUMP_TOPIC'			=> 'Bump argomento',

	'DELETE_TOPIC'			=> 'Cancella argomento',
	'DELETED_INFORMATION'	=> 'Cancellato da %1$s il %2$s',
	'DISAPPROVE'			=> 'Disapprovare',
	'DOWNLOAD_NOTICE'		=> 'Non hai i permessi necessari per visualizzare i file allegati in questo messaggio.',

	'EDITED_TIMES_TOTAL'	=> array(
		1	=> 'Ultima modifica di %2$s il %3$s, modificato %1$d volta in totale.',
		2	=> 'Ultima modifica di %2$s il %3$s, modificato %1$d volte in totale.',
	),
	'EMAIL_TOPIC'			=> 'Argomento per Email',
	'ERROR_NO_ATTACHMENT'	=> 'L’allegato selezionato non è più presente.',

	'FILE_NOT_FOUND_404'	=> 'Il file <strong>%s</strong> non esiste.',
	'FORK_TOPIC'			=> 'Copia argomento',
	'FULL_EDITOR'			=> 'Editor completo &amp; Anteprima',

	'LINKAGE_FORBIDDEN'		=> 'Non sei autorizzato a visualizzare, scaricare o inserire collegamenti da/a questo sito.',
	'LOGIN_NOTIFY_TOPIC'	=> 'Hai una notifica per questo argomento, accedi per vederlo.',
	'LOGIN_VIEWTOPIC'		=> 'Per poter visualizzare questo argomento devi essere un utente registrato ed autenticato.',

	'MAKE_ANNOUNCE'				=> 'Modifica in “Annuncio”',
	'MAKE_GLOBAL'				=> 'Modifica in “Annuncio globale”',
	'MAKE_NORMAL'				=> 'Modifica in “Argomento semplice”',
	'MAKE_STICKY'				=> 'Modifica in “Importante”',
	'MAX_OPTIONS_SELECT'		=> array(
		1	=> 'Puoi scegliere tra <strong>%d</strong>',
		2	=> 'Puoi usare <strong>%d</strong>',
	),
	'MISSING_INLINE_ATTACHMENT'	=> 'L’allegato <strong>%s</strong> non è più disponibile',
	'MOVE_TOPIC'				=> 'Sposta argomento',

	'NO_ATTACHMENT_SELECTED'=> 'Non hai selezionato nessun allegato da visualizzare o scaricare.',
	'NO_NEWER_TOPICS'		=> 'Non ci sono nuovi argomenti in questo forum.',
	'NO_OLDER_TOPICS'		=> 'Non ci sono vecchi argomenti in questo forum.',
	'NO_UNREAD_POSTS'		=> 'Non ci sono nuovi messaggi in questo argomento.',
	'NO_VOTE_OPTION'		=> 'Devi selezionare un’opzione per votare.',
	'NO_VOTES'				=> 'Nessun voto',
	'NO_AUTH_PRINT_TOPIC'	=> 'Non sei autorizzato a stampare gli argomenti.',

	'POLL_ENDED_AT'			=> 'Sondaggio concluso il %s',
	'POLL_RUN_TILL'			=> 'Il sondaggio termina il %s',
	'POLL_VOTED_OPTION'		=> 'Hai scelto questa opzione',
	'POST_DELETED_RESTORE'	=> 'Questo messaggio è stato cancellato. Puoi ripristinarlo.',
	'PRINT_TOPIC'			=> 'Stampa pagina',

	'QUICK_MOD'				=> 'Strumenti di moderazione',
	'QUICKREPLY'			=> 'Risposta Rapida',

	'REPLY_TO_TOPIC'		=> 'Rispondi all’argomento',
	'RESTORE'				=> 'Ripristina',
	'RESTORE_TOPIC'			=> 'Ripristina argomento',
	'RETURN_POST'			=> '%sRitorna al messaggio%s',

	'SUBMIT_VOTE'			=> 'Invia voto',

	'TOPIC_TOOLS'			=> 'Strumenti argomento',
	'TOTAL_VOTES'			=> 'Voti totali',

	'UNLOCK_TOPIC'			=> 'Sblocca argomento',

	'VIEW_INFO'				=> 'Dettagli messaggio',
	'VIEW_NEXT_TOPIC'		=> 'Successivo',
	'VIEW_PREVIOUS_TOPIC'	=> 'Precedente',
	'VIEW_QUOTED_POST'		=> 'Visualizza il post citato',
	'VIEW_RESULTS'			=> 'Guarda risultati',
	'VIEW_TOPIC_POSTS'		=> array(
		1	=> '%d messaggio',
		2	=> '%d messaggi',
	),
	'VIEW_UNREAD_POST'		=> 'Primo messaggio non letto',
	'VOTE_SUBMITTED'		=> 'Il tuo voto è stato registrato.',
	'VOTE_CONVERTED'		=> 'Non è supportato il cambio voto per sondaggi convertiti.',
));
