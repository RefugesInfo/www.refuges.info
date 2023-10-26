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
	$lang = [];
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

$lang = array_merge($lang, [
	'ACP_STYLES_EXPLAIN'						=> 'Qui è possibile gestire gli stili disponibili sulla tua Board.<br /> Si noti che non è possibile disinstallare lo stile “<strong>prosilver</strong>” in quanto è lo stile predefinito e principale di phpBB.',

	'CANNOT_BE_INSTALLED'						=> 'Non può essere installato',
	'CONFIRM_UNINSTALL_STYLES'					=> 'Sei sicuro di voler disinstallare gli stili selezionati?',
	'COPYRIGHT'									=> 'Copyright',

	'DEACTIVATE_DEFAULT'						=> 'Non puoi disattivare lo stile predefinito.',
	'DELETE_FROM_FS'							=> 'Cancella dal file system',
	'DELETE_STYLE_FILES_FAILED'					=> 'Errore durante l’eliminazione dei file dello stile "%s".',
	'DELETE_STYLE_FILES_SUCCESS'				=> 'I file dello stile "%s" sono stati cancellati.',
	'DETAILS'									=> 'Dettagli',

	'INHERITING_FROM'							=> 'Dipendente da',
	'INSTALL_STYLE'								=> 'Installa stile',
	'INSTALL_STYLES'							=> 'Installa stili',
	'INSTALL_STYLES_EXPLAIN'					=> 'Qui è possibile installare nuovi stili.<br />Se non riesci a trovare uno stile specifico nella lista qui sotto, verifica che lo stile sia già installato. Se non è installato, controlla se è stato caricato correttamente.',
	'INVALID_STYLE_ID'							=> 'ID stile non valido.',

	'NO_MATCHING_STYLES_FOUND'					=> 'Nessuno stile corrisponde alla tua ricerca.',
	'NO_UNINSTALLED_STYLE'						=> 'Nessuno stile disinstallato rilevato.',

	'PURGED_CACHE'								=> 'La cache è stata svuotata.',

	'REQUIRES_STYLE'							=> 'Questo stile richiede che lo stile "%s" sia installato.',

	'STYLE_ACTIVATE'							=> 'Attiva',
	'STYLE_ACTIVE'								=> 'Attivo',
	'STYLE_DEACTIVATE'							=> 'Disattiva',
	'STYLE_DEFAULT'								=> 'Rendi lo stile predefinito',
	'STYLE_DEFAULT_CHANGE_INACTIVE'				=> 'È necessario attivare lo stile prima di renderlo predefinito.',
	'STYLE_ERR_INVALID_PARENT'					=> 'Stile principale non valido.',
	'STYLE_ERR_NAME_EXIST'						=> 'Esiste già uno stile con lo stesso nome.',
	'STYLE_ERR_STYLE_NAME'						=> 'Lo stile deve essere identificato da un nome.',
	'STYLE_INSTALLED'							=> 'Stile "%s" è stato installato.',
	'STYLE_INSTALLED_RETURN_INSTALLED_STYLES'	=> 'Torna alla lista degli stili installati',
	'STYLE_INSTALLED_RETURN_UNINSTALLED_STYLES'	=> 'Installa più stili',
	'STYLE_NAME'								=> 'Nome dello stile',
	'STYLE_NAME_RESERVED'						=> 'Lo stile "%s" non può essere installato, perché il nome è riservato.',
	'STYLE_NOT_INSTALLED'						=> 'Stile "%s" non è stato installato.',
	'STYLE_PATH'								=> 'Percorso stile',
	'STYLE_UNINSTALL'							=> 'Disinstalla',
	'STYLE_UNINSTALL_DEPENDENT'					=> 'Lo stile "%s" non può essere disinstallato perché ha uno o più stili dipendenti.',
	'STYLE_UNINSTALLED'							=> 'Stile "%s" disinstallato con successo.',
	'STYLE_PHPBB_VERSION'						=> 'Versione phpBB',
	'STYLE_USED_BY'								=> 'Usato da (inclusi i bot)',
	'STYLE_VERSION'								=> 'Versione stile',

	'UNINSTALL_PROSILVER'						=> 'Non è possibile disinstallare lo stile “prosilver”.',
	'UNINSTALL_DEFAULT'							=> 'Non è possibile disinstallare lo stile predefinito.',

	'BROWSE_STYLES_DATABASE'					=> 'Scegli nel database degli stili',
]);
