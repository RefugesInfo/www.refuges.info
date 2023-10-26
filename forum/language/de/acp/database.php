<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
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

// Database Backup/Restore
$lang = array_merge($lang, array(
	'ACP_BACKUP_EXPLAIN'	=> 'Hier kannst du all deine phpBB-Daten sichern. Das Archiv wird in deinem <samp>store/</samp>-Ordner gespeichert. Abhängig von der Konfiguration deines Servers kannst du die Datei auf verschiedene Arten komprimieren.',
	'ACP_RESTORE_EXPLAIN'	=> 'Hiermit wird eine vollständige Wiederherstellung aller phpBB-Tabellen aus einer gespeicherten Datei durchgeführt. Sofern von deinem Server unterstützt, kann auch eine komprimierte gzip- oder bzip2-Datei verwendet werden, die dann automatisch dekomprimiert wird. <strong>ACHTUNG:</strong> Dieser Vorgang überschreibt alle vorhandenen Daten. Die Wiederherstellung kann einige Zeit in Anspruch nehmen, bitte wechsle nicht auf eine andere Seite, bis der Vorgang abgeschlossen ist. Backups werden im <samp>store/</samp>-Ordner gespeichert. phpBB geht davon aus, dass die Backups in diesem Ordner mit der phpBB-eigenen Backup-Funktion erstellt wurden. Die Wiederherstellung anders erstellter Backups kann, muss aber nicht funktionieren.',

	'BACKUP_DELETE'			=> 'Die Backup-Datei wurde erfolgreich gelöscht.',
	'BACKUP_INVALID'		=> 'Die ausgewählte Backup-Datei ist ungültig.',
	'BACKUP_NOT_SUPPORTED'	=> 'Die ausgewählte Backup-Option wird nicht unterstützt',
	'BACKUP_OPTIONS'		=> 'Backup-Optionen',
	'BACKUP_SUCCESS'		=> 'Die Backup-Datei wurde erfolgreich erstellt.',
	'BACKUP_TYPE'			=> 'Backup-Art',

	'DATABASE'			=> 'Datenbank-Tools',
	'DATA_ONLY'			=> 'Nur Daten',
	'DELETE_BACKUP'		=> 'Backup löschen',
	'DELETE_SELECTED_BACKUP'	=> 'Bist du dir sicher, dass du das ausgewählte Backup löschen möchtest?',
	'DESELECT_ALL'		=> 'Alle Markierungen aufheben',
	'DOWNLOAD_BACKUP'	=> 'Backup herunterladen',

	'FILE_TYPE'			=> 'Dateityp',
	'FILE_WRITE_FAIL'	=> 'Der Speicherordner konnte nicht beschrieben werden.',
	'FULL_BACKUP'		=> 'Komplett',

	'RESTORE_FAILURE'		=> 'Die Backup-Datei könnte beschädigt sein.',
	'RESTORE_OPTIONS'		=> 'Wiederherstellungs-Optionen',
	'RESTORE_SELECTED_BACKUP'	=> 'Bist du dir sicher, dass du das ausgewählte Backup wiederherstellen möchtest?',
	'RESTORE_SUCCESS'		=> 'Die Datenbank wurde erfolgreich wiederhergestellt.<br /><br />Dein Board sollte nun den Stand haben, den es zur Zeit des Backups hatte.',

	'SELECT_ALL'			=> 'Alle markieren',
	'SELECT_FILE'			=> 'Wähle eine Sicherung aus',
	'START_BACKUP'			=> 'Backup starten',
	'START_RESTORE'			=> 'Wiederherstellung starten',
	'STORE_AND_DOWNLOAD'	=> 'Speichern und herunterladen',
	'STORE_LOCAL'			=> 'Auf Server speichern',

	'TABLE_SELECT'		=> 'Tabellen-Auswahl',
	'TABLE_SELECT_ERROR'=> 'Du musst mindestens eine Tabelle auswählen.',
));
