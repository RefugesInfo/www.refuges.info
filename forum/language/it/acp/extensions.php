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
	'EXTENSION'					=> 'Estensione',
	'EXTENSIONS'				=> 'Estensioni',
	'EXTENSIONS_ADMIN'			=> 'Gestione estensioni',
	'EXTENSIONS_EXPLAIN'		=> 'Gestione estensioni è uno strumento che consente di gestire tutte le estensioni presenti e visualizzarne le informazioni.',
	'EXTENSION_INVALID_LIST'	=> 'L’estensione “%s” non è valida.<br />%s<br /><br />',
	'EXTENSION_NOT_AVAILABLE'	=> 'L’estensione selezionata non è valida per questa Board, verifica che le tue versioni phpBB e PHP in uso siano compatibili (vedi dettagli nella pagina).',
	'EXTENSION_DIR_INVALID'		=> 'L’estensione selezionata ha una struttura di cartelle non valida e non può essere attivata.',
	'EXTENSION_NOT_ENABLEABLE'	=> 'L’estensione selezionata non può essere attivata, verificare i requisiti dell’estensione.',
	'EXTENSION_NOT_INSTALLED'	=> 'L’estensione %s non è disponibile. Controlla se è stata installata correttamente.',

	'DETAILS'				=> 'Dettagli',

	'EXTENSIONS_NOT_INSTALLED'	=> 'Estensioni non installate',
	'EXTENSIONS_DISABLED'	=> 'Estensioni disabilitate',
	'EXTENSIONS_ENABLED'	=> 'Estensioni abilitate',

	'EXTENSION_DELETE_DATA'	=> 'Cancella i dati',
	'EXTENSION_DISABLE'		=> 'Disabilita',
	'EXTENSION_ENABLE'		=> 'Abilita',

	'EXTENSION_DELETE_DATA_EXPLAIN'	=> 'Cancellando i dati di un’estensione se ne rimuovono tutti i dati e le impostazioni. I file dell’estensione vengono mantenuti per poter essere eventualmente riutilizzati.',
	'EXTENSION_DISABLE_EXPLAIN'		=> 'Disabilitando un’estensione ne sono mantenuti i file, dati e le impostazioni ma vengono rimosse le funzioni aggiuntive dell’estensione.',
	'EXTENSION_ENABLE_EXPLAIN'		=> 'Abilitando un’estensione potrai utilizzarla nella tua Board.',

	'EXTENSION_DELETE_DATA_IN_PROGRESS'	=> 'Cancellazione dati estensione in corso. Non abbandonare o aggiornare la pagina fino a quando il processo non è completato.',
	'EXTENSION_DISABLE_IN_PROGRESS'	=> 'Disabilitazione estensione in corso. Non abbandonare o aggiornare la pagina fino a quando il processo non è completato.',
	'EXTENSION_ENABLE_IN_PROGRESS'	=> 'Abilitazione estensione in corso. Non abbandonare o aggiornare la pagina fino a quando il processo non è completato.',

	'EXTENSION_DELETE_DATA_SUCCESS'	=> 'Cancellazione dati estensione avvenuta con successo',
	'EXTENSION_DISABLE_SUCCESS'		=> 'Estensione disabilitata con successo',
	'EXTENSION_ENABLE_SUCCESS'		=> 'Estensione abilitata con successo',

	'EXTENSION_NAME'			=> 'Nome estensione',
	'EXTENSION_ACTIONS'			=> 'Azioni',
	'EXTENSION_OPTIONS'			=> 'Opzioni',
	'EXTENSION_INSTALL_HEADLINE'=> 'Installazione di un’estensione',
	'EXTENSION_INSTALL_EXPLAIN'	=> '<ol>
			<li>Scarica un’estensione dal database delle estensioni di phpBB</li>
			<li>Decomprimi e carica nella cartella <samp>ext/</samp> della tua Board phpBB</li>
			<li>Abilita l’estensione, in Gestione Estensioni</li>
		</ol>',
	'EXTENSION_UPDATE_HEADLINE'	=> 'Aggiornamento estensione',
	'EXTENSION_UPDATE_EXPLAIN'	=> '<ol>
			<li>Disabilita estensione</li>
			<li>Cancella dati estensione dal filesystem</li>
			<li>Carica nuovi file</li>
			<li>Abilita estensione</li>
		</ol>',
	'EXTENSION_REMOVE_HEADLINE'	=> 'Rimozione completa di un’estensione dalla Board',
	'EXTENSION_REMOVE_EXPLAIN'	=> '<ol>
			<li>Disabilita estensione</li>
			<li>Cancella dati estensione</li>
			<li>Cancella i file dell’estensione dal filesystem</li>
		</ol>',

	'EXTENSION_DELETE_DATA_CONFIRM'	=> 'Sei sicuro di voler cancellare i dati associati a “%s”?<br /><br />Questo rimuoverà tutti i suoi dati e impostazioni, e questa operazione non potrà essere annullata!',
	'EXTENSION_DISABLE_CONFIRM'		=> 'Sei sicuro di voler disabilitare l’estensione “%s”?',
	'EXTENSION_ENABLE_CONFIRM'		=> 'Sei sicuro di voler abilitare l’estensione “%s”?',
	'EXTENSION_FORCE_UNSTABLE_CONFIRM'	=> 'Sei sicuro di voler forzare l’uso della versione instabile?',

	'RETURN_TO_EXTENSION_LIST'	=> 'Ritorna alla lista delle estensioni',

	'EXT_DETAILS'			=> 'Dettagli estensione',
	'DISPLAY_NAME'			=> 'Nome',
	'CLEAN_NAME'			=> 'Nome cartella',
	'TYPE'					=> 'Tipo',
	'DESCRIPTION'			=> 'Descrizione',
	'VERSION'				=> 'Versione',
	'HOMEPAGE'				=> 'Sito Web',
	'PATH'					=> 'Percorso file',
	'TIME'					=> 'Data rilascio',
	'LICENSE'				=> 'Licenza',

	'REQUIREMENTS'			=> 'Requisiti',
	'PHPBB_VERSION'			=> 'Versione phpBB',
	'PHP_VERSION'			=> 'Versione PHP',
	'AUTHOR_INFORMATION'	=> 'Informazioni sull’autore',
	'AUTHOR_NAME'			=> 'Nome',
	'AUTHOR_EMAIL'			=> 'Indirizzo email',
	'AUTHOR_HOMEPAGE'		=> 'Sito Web',
	'AUTHOR_ROLE'			=> 'Ruolo',

	'NOT_UP_TO_DATE'		=> '%s non è aggiornata',
	'UP_TO_DATE'			=> '%s è aggiornata',
	'ANNOUNCEMENT_TOPIC'	=> 'Annuncio di rilascio',
	'DOWNLOAD_LATEST'		=> 'Scarica la versione',
	'NO_VERSIONCHECK'		=> 'Nessuna informazione relativa al controllo di versione.',

	'VERSIONCHECK_FORCE_UPDATE_ALL'		=> 'Ri-Controlla tutte le versioni',
	'FORCE_UNSTABLE'					=> 'Controllare sempre per le versioni instabili',
	'EXTENSIONS_VERSION_CHECK_SETTINGS'	=> 'Impostazioni di controllo di versione',

	'BROWSE_EXTENSIONS_DATABASE'		=> 'Esplora il database delle estensioni',

	'META_FIELD_NOT_SET'	=> 'Il campo %s richiesto non è stato impostato.',
	'META_FIELD_INVALID'	=> 'Il campo %s non è valido.',
));
