<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @copyright (c) 2010-2013 Moxiecode Systems AB
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
	'PLUPLOAD_ADD_FILES'			=> 'Aggiungi file',
	'PLUPLOAD_ADD_FILES_TO_QUEUE'	=> 'Aggiungi file alla coda di upload e clicca sul pulsante di avvio.',
	'PLUPLOAD_ALREADY_QUEUED'		=> '%s già presente nella coda.',
	'PLUPLOAD_CLOSE'				=> 'Chiuso',
	'PLUPLOAD_DRAG'					=> 'Trascina i file qui.',
	'PLUPLOAD_DUPLICATE_ERROR'		=> 'Errore causato da un file duplicato.',
	'PLUPLOAD_DRAG_TEXTAREA'		=> 'È inoltre possibile allegare i file trascinandoli nella finestra del messaggio.',
	'PLUPLOAD_ERR_INPUT'			=> 'L’apertura del flusso in entrata è fallita.',
	'PLUPLOAD_ERR_MOVE_UPLOADED'	=> 'Lo spostamento del file caricato, è fallito.',
	'PLUPLOAD_ERR_OUTPUT'			=> 'L’apertura del flusso in uscita è fallita.',
	'PLUPLOAD_ERR_FILE_TOO_LARGE'	=> 'File troppo grande:',
	'PLUPLOAD_ERR_FILE_COUNT'		=> 'Errore nel conteggio del file.',
	'PLUPLOAD_ERR_FILE_INVALID_EXT'	=> 'Estensione del file non valida:',
	'PLUPLOAD_ERR_RUNTIME_MEMORY'	=> 'L’esecuzione ha esaurito la memoria disponibile',
	'PLUPLOAD_ERR_UPLOAD_URL'		=> 'L’URL indicato per l’upload potrebbe essere sbagliato o non esistere.',
	'PLUPLOAD_EXTENSION_ERROR'		=> 'Errore nell’estensione del file.',
	'PLUPLOAD_FILE'					=> 'File: %s',
	'PLUPLOAD_FILE_DETAILS'			=> 'File: %s, dimensione: %d, dimensione massima del file: %d',
	'PLUPLOAD_FILENAME'				=> 'Nome del file',
	'PLUPLOAD_FILES_QUEUED'			=> '%d file in coda',
	'PLUPLOAD_GENERIC_ERROR'		=> 'Errore generico.',
	'PLUPLOAD_HTTP_ERROR'			=> 'Errore HTTP.',
	'PLUPLOAD_IMAGE_FORMAT'			=> 'Formato immagine errato o non supportato.',
	'PLUPLOAD_INIT_ERROR'			=> 'Errore di inizializzazione.',
	'PLUPLOAD_IO_ERROR'				=> 'Errore IO.',
	'PLUPLOAD_NOT_APPLICABLE'		=> 'Non disponibile',
	'PLUPLOAD_SECURITY_ERROR'		=> 'Errore di sicurezza.',
	'PLUPLOAD_SELECT_FILES'			=> 'Seleziona i file',
	'PLUPLOAD_SIZE'					=> 'Dimensione',
	'PLUPLOAD_SIZE_ERROR'			=> 'Errore sulla dimensione del file.',
	'PLUPLOAD_STATUS'				=> 'Stato',
	'PLUPLOAD_START_UPLOAD'			=> 'Avvia l’upload',
	'PLUPLOAD_START_CURRENT_UPLOAD'	=> 'Avvio upload di coda',
	'PLUPLOAD_STOP_UPLOAD'			=> 'Ferma l’upload',
	'PLUPLOAD_STOP_CURRENT_UPLOAD'	=> 'Ferma l’upload corrente',
	// Note: This string is formatted independently by plupload and so does not
	// use the same formatting rules as normal phpBB translation strings
	'PLUPLOAD_UPLOADED'				=> 'Caricati %d/%d file',
));
