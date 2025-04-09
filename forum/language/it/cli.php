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

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'CLI_APCU_CACHE_NOTICE'				=> 'La cache deve essere svuotata tramite il Pannello di Controllo Amministratore.',
	'CLI_CONFIG_CANNOT_CACHED'			=> 'Imposta questa opzione se la configurazione cambia troppo spesso per essere memorizzata nella cache in modo efficiente.',
	'CLI_CONFIG_CURRENT'				=> 'Valore di configurazione corrente; utilizza 0 e 1 per specificare valori booleani',
	'CLI_CONFIG_DELETE_SUCCESS'			=> 'Config %s cancellato con successo.',
	'CLI_CONFIG_NEW'					=> 'Nuovo valore di configurazione; utilizza 0 e 1 per specificare valori booleani',
	'CLI_CONFIG_NOT_EXISTS'				=> 'Config %s non esiste',
	'CLI_CONFIG_OPTION_NAME'			=> 'Configurazione dell’opzione del nome',
	'CLI_CONFIG_PRINT_WITHOUT_NEWLINE'	=> 'Impostare questa opzione se il valore deve essere stampato senza una nuova riga alla fine.',
	'CLI_CONFIG_INCREMENT_BY'			=> 'Importo incrementabile da',
	'CLI_CONFIG_INCREMENT_SUCCESS'		=> 'Config %s incrementato con successo',
	'CLI_CONFIG_SET_FAILURE'			=> 'Impossibile settare il config %s',
	'CLI_CONFIG_SET_SUCCESS'			=> 'Impostato con successo il config %s',

	'CLI_DESCRIPTION_CRON_LIST'					=> 'Consenti di visualizzare un elenco di operazioni pianificate pronte o meno.',
	'CLI_DESCRIPTION_CRON_RUN'					=> 'Esegue tutte le operazioni pianificate pronte.',
	'CLI_DESCRIPTION_CRON_RUN_ARGUMENT_1'		=> 'Nome dell’operazione da eseguire',
	'CLI_DESCRIPTION_DB_LIST'					=> 'Elenca tutte le migrazioni installate e disponibili.',
	'CLI_DESCRIPTION_DB_MIGRATE'				=> 'Aggiorna il database mediante l’applicazione delle migrazioni.',
	'CLI_DESCRIPTION_DB_REVERT'					=> 'Ripristina una migrazione.',
	'CLI_DESCRIPTION_DELETE_CONFIG'				=> 'Elimina un’opzione di configurazione',
	'CLI_DESCRIPTION_DISABLE_EXTENSION'			=> 'Disabilita l’estensione specificata.',
	'CLI_DESCRIPTION_ENABLE_EXTENSION'			=> 'Abilita l’estensione specificata.',
	'CLI_DESCRIPTION_FIND_MIGRATIONS'			=> 'Trova le migrazioni non dipendenti al momento.',
	'CLI_DESCRIPTION_FIX_LEFT_RIGHT_IDS'		=> 'Ripara la struttura ad albero dei forum e dei moduli.',
	'CLI_DESCRIPTION_GET_CONFIG'				=> 'Ottieni il valore di un’opzione di configurazione',
	'CLI_DESCRIPTION_INCREMENT_CONFIG'			=> 'Incrementa di un valore intero l’opzione di configurazione',
	'CLI_DESCRIPTION_LIST_EXTENSIONS'			=> 'Elenca tutti le estensioni del database e sul filesystem.',
	'CLI_DESCRIPTION_OPTION_ENV'				=> 'Nome della condizione.',
	'CLI_DESCRIPTION_OPTION_SAFE_MODE'			=> 'Esegui in modalità provvisoria (senza estensioni).',
	'CLI_DESCRIPTION_OPTION_SHELL'				=> 'Avvia la shell.',

	'CLI_DESCRIPTION_PURGE_EXTENSION'					=> 'Elimina l’estensione specificata.',

	'CLI_DESCRIPTION_REPARSER_LIST'						=> 'Elenca i tipi di testo che possono essere rianalizzati.',
	'CLI_DESCRIPTION_REPARSER_AVAILABLE'				=> 'Rianalisi disponibili:',
	'CLI_DESCRIPTION_REPARSER_REPARSE'					=> 'Rianalizza il testo memorizzato col corrente servizio text_formatter',
	'CLI_DESCRIPTION_REPARSER_REPARSE_ARG_1'			=> 'Tipo di testo da rianalizzare. Lascia il campo vuoto per rianalizzare ogni cosa.',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_DRY_RUN'		=> 'Non salvare le modifiche; stampa solo ciò che sarebbe verificato',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_FORCE_BBCODE'	=> 'Rianalizzare tutti i BBCode senza eccezioni. Nota che tutti i BBCode precedentemente disabilitati saranno rielaborati, abilitati e renderizzati completamente.',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_MIN'	=> 'Record ID più basso del processo',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_MAX'	=> 'Record ID più alto del processo',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_SIZE'	=> 'Numero approssimativo dei record dei processi in una volta',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RESUME'		=> 'Riprendi l’analisi dal punto in cui l’ultima esecuzione si è bloccata',

	'CLI_DESCRIPTION_SET_ATOMIC_CONFIG'					=> 'Imposta il valore di un’opzione di configurazione solo se il vecchio corrisponde al valore corrente',
	'CLI_DESCRIPTION_SET_CONFIG'						=> 'Imposta il valore di un’opzione di configurazione',

	'CLI_DESCRIPTION_THUMBNAIL_DELETE'					=> 'Elimina tutte le miniature presenti.',
	'CLI_DESCRIPTION_THUMBNAIL_GENERATE'				=> 'Crea tutte le miniature mancanti.',
	'CLI_DESCRIPTION_THUMBNAIL_RECREATE'				=> 'Ricrea tutte le miniature.',

	'CLI_DESCRIPTION_UPDATE_CHECK'						=> 'Verifica che la Board sia aggiornata.',
	'CLI_DESCRIPTION_UPDATE_CHECK_ARGUMENT_1'			=> 'Nome dell’estensione da verificare (se tutte, verificherà tutte le estensioni)',
	'CLI_DESCRIPTION_UPDATE_CHECK_OPTION_CACHE'			=> 'Esegui verifica con cache.',
	'CLI_DESCRIPTION_UPDATE_CHECK_OPTION_STABILITY'		=> 'Esegui il comando scegliendo di verificare solo versioni stabili e non.',

	'CLI_DESCRIPTION_UPDATE_HASH_BCRYPT'		=> 'Aggiorna gli hash delle password obsolete da decomprimere con bcrypt.',

	'CLI_ERROR_INVALID_STABILITY'						=> '"%s" deve essere impostato su "stabile" o "instabile".',

	'CLI_DESCRIPTION_USER_ACTIVATE'				=> 'Attiva (o disattiva) un account utente.',
	'CLI_DESCRIPTION_USER_ACTIVATE_USERNAME'	=> 'Nome utente dell’account da attivare.',
	'CLI_DESCRIPTION_USER_ACTIVATE_DEACTIVATE'	=> 'Disattiva l’account dell’utente',
	'CLI_DESCRIPTION_USER_ACTIVATE_ACTIVE'		=> 'L’utente è già attivo.',
	'CLI_DESCRIPTION_USER_ACTIVATE_INACTIVE'	=> 'L’utente è già inattivo.',
	'CLI_DESCRIPTION_USER_ADD'					=> 'Aggiungi un nuovo utente.',
	'CLI_DESCRIPTION_USER_ADD_OPTION_USERNAME'	=> 'Nome utente del nuovo utente',
	'CLI_DESCRIPTION_USER_ADD_OPTION_PASSWORD'	=> 'Password del nuovo utente',
	'CLI_DESCRIPTION_USER_ADD_OPTION_EMAIL'		=> 'Indirizzo email del nuovo utente',
	'CLI_DESCRIPTION_USER_ADD_OPTION_NOTIFY'	=> 'Invia account di posta elettronica di attivazione al nuovo utente (non inviato per impostazione predefinita)',
	'CLI_DESCRIPTION_USER_DELETE'				=> 'Elimina un account utente.',
	'CLI_DESCRIPTION_USER_DELETE_USERNAME'		=> 'Nome dell’utente da eliminare',
	'CLI_DESCRIPTION_USER_DELETE_ID'			=> 'Elimina account utente tramite ID.',
	'CLI_DESCRIPTION_USER_DELETE_ID_OPTION_ID'	=> 'ID utente da eliminare',
	'CLI_DESCRIPTION_USER_DELETE_OPTION_POSTS'	=> 'Elimina tutti i messaggi dell’utente. Senza questa opzione, i messaggi dell’utente saranno conservati.',
	'CLI_DESCRIPTION_USER_RECLEAN'				=> 'Ri-pulisci i nomi utente.',

	'CLI_EXTENSION_DISABLE_FAILURE'		=> 'Impossibile disabilitare l’estensione %s',
	'CLI_EXTENSION_DISABLE_SUCCESS'		=> 'Estensione %s disabilitata con successo',
	'CLI_EXTENSION_DISABLED'			=> 'L’estensione %s non è abilitata',
	'CLI_EXTENSION_ENABLE_FAILURE'		=> 'Impossibile abilitare l’estensione %s',
	'CLI_EXTENSION_ENABLE_SUCCESS'		=> 'Estensione %s abilitata con successo',
	'CLI_EXTENSION_ENABLED'				=> 'L’estensione %s è già abilitata',
	'CLI_EXTENSION_NAME'				=> 'Nome dell’estensione',
	'CLI_EXTENSION_NOT_EXIST'                      => 'L’estensione %s non esiste',
	'CLI_EXTENSION_NOT_ENABLEABLE'            => 'Questa estensione %s non è abilitabile.',
	'CLI_EXTENSION_PURGE_FAILURE'		=> 'Impossibile eliminare l’estensione %s',
	'CLI_EXTENSION_PURGE_SUCCESS'		=> 'Estensione %s eliminata con successo',
	'CLI_EXTENSION_UPDATE_FAILURE'		=> 'Impossibile aggiornare l’estensione %s',
	'CLI_EXTENSION_UPDATE_SUCCESS'		=> 'L’estensione %s è stata aggiornata con successo',
	'CLI_EXTENSION_NOT_FOUND'			=> 'Non sono state trovate estensioni.',
	'CLI_EXTENSIONS_AVAILABLE'			=> 'Disponibile',
	'CLI_EXTENSIONS_DISABLED'			=> 'Disabilitato',
	'CLI_EXTENSIONS_ENABLED'			=> 'Abilitato',

	'CLI_FIXUP_FIX_LEFT_RIGHT_IDS_SUCCESS'		=> 'La struttura ad albero dei forum e dei moduli è stata riparata con successo.',
	'CLI_FIXUP_UPDATE_HASH_BCRYPT_SUCCESS'		=> 'Aggiorna correttamente gli hash delle password obsolete per bcrypt.',

	'CLI_MIGRATION_NAME'					=> 'Nome migrazione, incluso lo spazio dei nomi (utilizza la barra obliqua [/] in luogo della barra inversa [\] per evitare problemi).',
	'CLI_MIGRATIONS_AVAILABLE'				=> 'Migrazioni disponibili',
	'CLI_MIGRATIONS_INSTALLED'				=> 'Migrazioni installate',
	'CLI_MIGRATIONS_ONLY_AVAILABLE'		    => 'Mostra solo migrazioni disponibili',
	'CLI_MIGRATIONS_EMPTY'                  => 'Nessuna migrazione disponibile.',

	'CLI_REPARSER_REPARSE_REPARSING'		=> 'Rianalisi %1$s (distanza %2$d..%3$d)',
	'CLI_REPARSER_REPARSE_REPARSING_START'	=> 'Rianalisi %s...',
	'CLI_REPARSER_REPARSE_SUCCESS'			=> 'Rianalisi completata con successo',

	// In tutti i casi %1$s è il nome logico del file e %2$s il nome reale del filesystem
	// es: big_image.png (2_a51529ae7932008cf8454a95af84cacd) creata.
	'CLI_THUMBNAIL_DELETED'		=> '%1$s (%2$s) cancellata.',
	'CLI_THUMBNAIL_DELETING'	=> 'Cancellazione miniature',
	'CLI_THUMBNAIL_SKIPPED'		=> '%1$s (%2$s) ignorate.',
	'CLI_THUMBNAIL_GENERATED'	=> '%1$s (%2$s) create.',
	'CLI_THUMBNAIL_GENERATING'	=> 'Creazione miniature',
	'CLI_THUMBNAIL_GENERATING_DONE'	=> 'Tutte le miniature sono state ricreate.',
	'CLI_THUMBNAIL_DELETING_DONE'	=> 'Tutte le miniature sono state cancellate.',

	'CLI_THUMBNAIL_NOTHING_TO_GENERATE'	=> 'Nessuna miniatura da creare.',
	'CLI_THUMBNAIL_NOTHING_TO_DELETE'	=> 'Nessuna miniatura da cancellare.',

	'CLI_USER_ADD_SUCCESS'		=> 'Utente aggiunto con successo %s.',
	'CLI_USER_DELETE_CONFIRM'	=> 'Sei sicuro di voler eliminare ‘%s’? [y/N]',
	'CLI_USER_DELETE_ID_CONFIRM'	=> 'Sei sicuro di voler eliminare gli ID utente? ‘%s’? [y/N]',
	'CLI_USER_DELETE_ID_SUCCESS'	=> 'ID utente eliminati con successo.',
	'CLI_USER_DELETE_ID_START'		=> 'Eliminazione degli utenti tramite ID',
	'CLI_USER_DELETE_NONE'			=> 'Nessun utente con questo ID, da eliminare.',
	'CLI_USER_RECLEAN_START'	=> 'Ripulisci i nomi utente',
	'CLI_USER_RECLEAN_DONE'		=> [
		0	=> 'Pulizia completa. Nessun nome utente richiede pulizia.',
		1	=> 'Pulizia completa. %d il nome utente è stato pulito.',
		2	=> 'Pulizia completa. %d i nomi utente sono stati puliti.',
	],
));

// Additional help for commands.
$lang = array_merge($lang, array(
	'CLI_HELP_CRON_RUN'			=> $lang['CLI_DESCRIPTION_CRON_RUN'] . ' È possibile programmare un’operazione pianificata per eseguire solo l’attività specificata.',
	'CLI_HELP_USER_ACTIVATE'	=> 'Attiva un account utente, o disattiva un account utilizzando l’opzione <info>Disattiva</info>. Per inviare una email di attivazione per l’utente, utilizza l’opzione <info>Invia email</info>.',
	'CLI_HELP_USER_ADD'			=> 'Il comando <info>%command.name%</info> aggiunge un nuovo utente:
	se questo comando viene eseguito senza opzioni, sarà necessario inserirle.
	Per inviare una mail al nuovo utente, utilizza l’opzione <info>Invia email</info>.',
	'CLI_HELP_USER_RECLEAN'		=> 'Ripulisci i nomi utente controllerà tutti i nomi utente memorizzati e garantirà che siano memorizzate versioni pulite. Pulisci i nomi utente è una forma tra maiuscole e minuscole, NFC normalizzata e trasformata in ASCII.',
));
