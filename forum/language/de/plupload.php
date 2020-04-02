<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @copyright (c) 2010-2013 Moxiecode Systems AB
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
*
* Deutsche Übersetzung durch die Übersetzer-Gruppe von phpBB.de:
* siehe language/de/AUTHORS.md und https://www.phpbb.de/go/ubersetzerteam
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
	'PLUPLOAD_ADD_FILES'		=> 'Dateien hinzufügen',
	'PLUPLOAD_ADD_FILES_TO_QUEUE'	=> 'Füge die anzuhängenden Dateien der Warteschlange hinzu und klicke auf die Schaltfläche „Warteschlange hochladen“.',
	'PLUPLOAD_ALREADY_QUEUED'	=> '%s ist bereits in der Warteschlange vorhanden.',
	'PLUPLOAD_CLOSE'			=> 'Schließen',
	'PLUPLOAD_DRAG'				=> 'Ziehe neue Dateien in diesen Bereich.',
	'PLUPLOAD_DUPLICATE_ERROR'	=> 'Doppelte-Datei-Fehler.',
	'PLUPLOAD_DRAG_TEXTAREA'	=> 'Du kannst Dateien auch anhängen, indem du sie mit der Maus in den Beitragseditor ziehst.',
	'PLUPLOAD_ERR_INPUT'		=> 'Eingabestrom konnte nicht geöffnet werden.',
	'PLUPLOAD_ERR_MOVE_UPLOADED'	=> 'Hochgeladene Datei konnte nicht verschoben werden.',
	'PLUPLOAD_ERR_OUTPUT'		=> 'Ausgabestrom konnte nicht geöffnet werden.',
	'PLUPLOAD_ERR_FILE_TOO_LARGE'	=> 'Datei zu groß:',
	'PLUPLOAD_ERR_FILE_COUNT'	=> 'Dateianzahl-Fehler.',
	'PLUPLOAD_ERR_FILE_INVALID_EXT'	=> 'Ungültige Dateierweiterung:',
	'PLUPLOAD_ERR_RUNTIME_MEMORY'	=> 'Der Laufzeitumgebung steht nicht ausreichend Arbeitsspeicher zur Verfügung.',
	'PLUPLOAD_ERR_UPLOAD_URL'	=> 'Die hochzuladende URL ist entweder fehlerhaft oder existiert nicht.',
	'PLUPLOAD_EXTENSION_ERROR'	=> 'Dateierweiterungs-Fehler.',
	'PLUPLOAD_FILE'				=> 'Datei: %s',
	'PLUPLOAD_FILE_DETAILS'		=> 'Datei: %s, Größe: %d, maximale Dateigröße: %d',
	'PLUPLOAD_FILENAME'			=> 'Dateiname',
	'PLUPLOAD_FILES_QUEUED'		=> '%d Dateien in der Warteschlange',
	'PLUPLOAD_GENERIC_ERROR'	=> 'Allgemeiner Fehler.',
	'PLUPLOAD_HTTP_ERROR'		=> 'HTTP-Fehler.',
	'PLUPLOAD_IMAGE_FORMAT'		=> 'Das Bild-Format ist entweder fehlerhaft oder wird nicht unterstützt.',
	'PLUPLOAD_INIT_ERROR'		=> 'Initialisierungs-Fehler',
	'PLUPLOAD_IO_ERROR'			=> 'Eingabe-/Ausgabe-Fehler',
	'PLUPLOAD_NOT_APPLICABLE'	=> 'n/a',
	'PLUPLOAD_SECURITY_ERROR'	=> 'Sicherheits-Fehler.',
	'PLUPLOAD_SELECT_FILES'		=> 'Dateien auswählen',
	'PLUPLOAD_SIZE'				=> 'Größe',
	'PLUPLOAD_SIZE_ERROR'		=> 'Dateigrößen-Fehler.',
	'PLUPLOAD_STATUS'			=> 'Status',
	'PLUPLOAD_START_UPLOAD'		=> 'Hochladen beginnen',
	'PLUPLOAD_START_CURRENT_UPLOAD'	=> 'Warteschlange hochladen',
	'PLUPLOAD_STOP_UPLOAD'		=> 'Hochladen stoppen',
	'PLUPLOAD_STOP_CURRENT_UPLOAD'	=> 'Aktuellen Vorgang stoppen',
	// Note: This string is formatted independently by plupload and so does not
	// use the same formatting rules as normal phpBB translation strings
	'PLUPLOAD_UPLOADED'			=> '%d/%d Dateien hochgeladen',
));
