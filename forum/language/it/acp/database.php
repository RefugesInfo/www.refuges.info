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

// Database Backup/Restore
$lang = array_merge($lang, array(
	'ACP_BACKUP_EXPLAIN'	=> 'Qui puoi creare il backup di tutti i dati riferiti al tuo phpBB. Puoi salvare l’archivio nella cartella <samp>store/</samp>. A seconda della configurazione del tuo server potrai comprimere il file in numerosi formati.',
	'ACP_RESTORE_EXPLAIN'	=> 'Effettua un ripristino completo di tutte le tabelle del tuo phpBB da un file salvato precedentemente. Se il tuo server lo supporta puoi utilizzare la compressione gzip o bzip2; i file verranno decompressi automaticamente. <strong>ATTENZIONE:</strong> verranno sovrascritti tutti i dati attuali. Il ripristino può impiegare molto tempo; dipende dalla grandezza del database. Non uscire questa pagina fino al completamento del ripristino. I backup sono memorizzati nella cartella <samp>store/</samp> e sono generati dalla funzione backup di phpBB. Il ripristino di backup non generati dal sistema può o meno funzionare.',

	'BACKUP_DELETE'		=> 'Il file di backup è stato cancellato.',
	'BACKUP_INVALID'	=> 'Il file di backup selezionato non è valido.',
	'BACKUP_NOT_SUPPORTED'	=> 'Il backup selezionato non è supportato',
	'BACKUP_OPTIONS'	=> 'Opzioni di backup',
	'BACKUP_SUCCESS'	=> 'Il file di backup è stato creato.',
	'BACKUP_TYPE'		=> 'Tipo di backup',

	'DATABASE'					=> 'Utilità database',
	'DATA_ONLY'					=> 'Solo dati',
	'DELETE_BACKUP'				=> 'Cancella backup',
	'DELETE_SELECTED_BACKUP'	=> 'Sei sicuro di voler cancellare il backup selezionato?',
	'DESELECT_ALL'				=> 'Deseleziona tutti',
	'DOWNLOAD_BACKUP'			=> 'Scarica backup',

	'FILE_TYPE'			=> 'Tipo di file',
	'FILE_WRITE_FAIL'	=> 'Impossibile scrivere il file nella cartella di archiviazione.',
	'FULL_BACKUP'		=> 'Completo',

	'RESTORE_FAILURE'			=> 'Il file di backup sembra essere corrotto.',
	'RESTORE_OPTIONS'			=> 'Opzioni di ripristino',
	'RESTORE_SELECTED_BACKUP'	=> 'Sei sicuro di voler ripristinare il backup selezionato?',
	'RESTORE_SUCCESS'			=> 'Il database è stato ripristinato.<br /><br />La tua Board dovrebbe essere tornata allo stato in cui si trovava al momento del backup.',

	'SELECT_ALL'			=> 'Seleziona tutti',
	'SELECT_FILE'			=> 'Seleziona un file',
	'START_BACKUP'			=> 'Avvia backup',
	'START_RESTORE'			=> 'Avvia ripristino',
	'STORE_AND_DOWNLOAD'	=> 'Salva e scarica',
	'STORE_LOCAL'			=> 'Salva file in store',

	'TABLE_SELECT'		=> 'Seleziona tabelle',
	'TABLE_SELECT_ERROR'=> 'Devi selezionare almeno una tabella.',
));
