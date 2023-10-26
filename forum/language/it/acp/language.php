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
	'ACP_FILES'						=> 'Amministra file di lingua',
	'ACP_LANGUAGE_PACKS_EXPLAIN'	=> 'Da qui puoi installare o rimuovere i pacchetti lingua. Il pacchetto lingua predefinito, è marcato con un asterisco (*).',

	'DELETE_LANGUAGE_CONFIRM'		=> 'Sei sicuro di voler eliminare “%s”?',

	'INSTALLED_LANGUAGE_PACKS'		=> 'Pacchetti lingua installati',

	'LANGUAGE_DETAILS_UPDATED'			=> 'Dettagli lingua caricati.',
	'LANGUAGE_PACK_ALREADY_INSTALLED'	=> 'Questo pacchetto lingua è già installato.',
	'LANGUAGE_PACK_DELETED'				=> 'Il pacchetto lingua “%s” è stato rimosso. Per tutti gli utenti che usavano questa lingua è stata ripristinata la lingua predefinita.',
	'LANGUAGE_PACK_DETAILS'				=> 'Dettagli pacchetto lingua',
	'LANGUAGE_PACK_INSTALLED'			=> 'Il pacchetto lingua “%s” è stato installato.',
	'LANGUAGE_PACK_CPF_UPDATE'			=> 'I campi profilo personalizzati, sono stati copiati dalla lingua predefinita. Se è necessario, modificali.',
	'LANGUAGE_PACK_ISO'					=> 'ISO',
	'LANGUAGE_PACK_LOCALNAME'			=> 'Nome locale',
	'LANGUAGE_PACK_NAME'				=> 'Nome',
	'LANGUAGE_PACK_NOT_EXIST'			=> 'Il pacchetto lingua selezionato non esiste.',
	'LANGUAGE_PACK_USED_BY'				=> 'Usato da (inclusi robot)',
	'LANGUAGE_VARIABLE'					=> 'Variabile di lingua',
	'LANG_AUTHOR'						=> 'Autori pacchetto lingua',
	'LANG_ENGLISH_NAME'					=> 'Nome inglese',
	'LANG_ISO_CODE'						=> 'Codice ISO',
	'LANG_LOCAL_NAME'					=> 'Nome locale',

	'MISSING_LANG_FILES'		=> 'File di lingua mancanti',
	'MISSING_LANG_VARIABLES'	=> 'Variabile di lingua mancante',

	'NO_FILE_SELECTED'				=> 'Non hai specificato un file di lingua.',
	'NO_LANG_ID'					=> 'Non hai specificato un pacchetto lingua.',
	'NO_REMOVE_DEFAULT_LANG'		=> 'Non puoi rimuovere il pacchetto lingua predefinito.<br />Se vuoi rimuovere questo pacchetto lingua, cambia prima la lingua predefinita.',
	'NO_UNINSTALLED_LANGUAGE_PACKS'	=> 'Nessun pacchetto lingua disinstallato',

	'THOSE_MISSING_LANG_FILES'			=> 'I seguenti file di lingua non sono stati trovati nella cartella di lingua “%s”',
	'THOSE_MISSING_LANG_VARIABLES'		=> 'Le seguenti variabili di lingua non sono presenti nel pacchetto lingua “%s”',

	'UNINSTALLED_LANGUAGE_PACKS'	=> 'Pacchetti lingua disinstallati',

	'BROWSE_LANGUAGE_PACKS_DATABASE'	=> 'Scegli nel database dei pacchetti lingua',

));
