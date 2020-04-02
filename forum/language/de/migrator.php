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

$lang = array_merge($lang, array(
	'CONFIG_NOT_EXIST'					=> 'Die Konfigurationseinstellung „%s“ existiert unerwarteterweise nicht.',

	'GROUP_NOT_EXIST'					=> 'Die Gruppe „%s“ existiert unerwarteterweise nicht.',

	'MIGRATION_APPLY_DEPENDENCIES'		=> 'Wende Abhängigkeiten von %s an.',
	'MIGRATION_DATA_DONE'				=> 'Daten eingerichtet: %1$s; Dauer: %2$.2f Sekunden',
	'MIGRATION_DATA_IN_PROGRESS'		=> 'Richte Daten ein: %1$s; Dauer: %2$.2f Sekunden',
	'MIGRATION_DATA_RUNNING'			=> 'Richte Daten ein: %s.',
	'MIGRATION_EFFECTIVELY_INSTALLED'	=> 'Die Migration wurde bereits erfolgreich durchgeführt (übersprungen): %s',
	'MIGRATION_EXCEPTION_ERROR'			=> 'Während der Anpassung der Datenbank ist etwas falsch gelaufen und ein Fehler aufgetreten. Die Änderungen, die vor dem Fehler durchgeführt wurden, wurden so weit wie möglich rückgängig gemacht. Du solltest jedoch prüfen, ob dein Board fehlerfrei funktioniert.',
	'MIGRATION_NOT_FULFILLABLE'			=> 'Die Migration „%1$s“ kann nicht durchgeführt werden. Fehlender Migrations-Schritt: „%2$s“.',
	'MIGRATION_NOT_INSTALLED'			=> 'Die Migration „%s“ ist nicht installiert.',
	'MIGRATION_NOT_VALID'				=> '%s ist keine gültige Migration.',
	'MIGRATION_SCHEMA_DONE'				=> 'Installiertes Schema: %1$s; Dauer: %2$.2f Sekunden',
	'MIGRATION_SCHEMA_IN_PROGRESS'		=> 'Installiere Schema: %1$s; Dauer: %2$.2f Sekunden',
	'MIGRATION_SCHEMA_RUNNING'			=> 'Installiere Schema: %s.',

	'MIGRATION_REVERT_DATA_DONE'		=> 'Rückgängig gemachte Daten-Änderungen: %1$s; Dauer: %2$.2f Sekunden',
	'MIGRATION_REVERT_DATA_IN_PROGRESS'	=> 'Mache Daten-Änderungen rückgängig: %1$s; Dauer: %2$.2f Sekunden',
	'MIGRATION_REVERT_DATA_RUNNING'		=> 'Mache Daten-Änderungen rückgängig: %s.',
	'MIGRATION_REVERT_SCHEMA_DONE'		=> 'Rückgängig gemachte Schema-Änderungen: %1$s; Dauer: %2$.2f Sekunden',
	'MIGRATION_REVERT_SCHEMA_IN_PROGRESS'	=> 'Mache Schema-Änderungen rückgängig: %1$s; Dauer: %2$.2f Sekunden',
	'MIGRATION_REVERT_SCHEMA_RUNNING'	=> 'Mache Schema-Änderungen rückgängig: %s.',

	'MIGRATION_INVALID_DATA_MISSING_CONDITION'		=> 'Eine Migration ist ungültig. Einer Hilfsfunktion für bedingte Anweisungen fehlt eine Bedingung. („An if statement helper is missing a condition.“)',
	'MIGRATION_INVALID_DATA_MISSING_STEP'			=> 'Eine Migration ist ungültig. Einer Hilfsfunktion für bedingte Anweisungen fehlt ein gültiger Aufruf eines Migrationsschritts. („An if statement helper is missing a valid call to a migration step.“)',
	'MIGRATION_INVALID_DATA_CUSTOM_NOT_CALLABLE'	=> 'Eine Migration ist ungültig. Der Aufruf einer benutzerdefinierten Rückruffunktion ist gescheitert. („A custom callable function could not be called.“)',
	'MIGRATION_INVALID_DATA_UNKNOWN_TYPE'			=> 'Eine Migration ist ungültig. Ein unbekannter Migrationstool-Typ wurde gefunden. („An unknown migration tool type was encountered.“)',
	'MIGRATION_INVALID_DATA_UNDEFINED_TOOL'			=> 'Eine Migration ist ungültig. Ein undefiniertes Migrationstool wurde gefunden. („An undefined migration tool was encountered.“)',
	'MIGRATION_INVALID_DATA_UNDEFINED_METHOD'		=> 'Eine Migration ist ungültig. Eine undefinierte Migrationstool-Methode wurde gefunden. („An undefined migration tool method was encountered.“)',


	'MODULE_ERROR'						=> 'Bei der Erstellung eines Moduls ist ein Fehler aufgetreten: %s',
	'MODULE_EXISTS'						=> 'Ein Modul existiert bereits: %s',
	'MODULE_EXIST_MULTIPLE'				=> 'Es existieren mehrere Module mit dem angegebenen übergeordneten Namen: %s. Verwende die Nach-Oben-/Nach-Unten-Schaltflächen, um die Position des Moduls festzulegen.',
	'MODULE_INFO_FILE_NOT_EXIST'		=> 'Eine erforderliche Informationsdatei für ein Modul existiert nicht: %2$s',
	'MODULE_NOT_EXIST'					=> 'Ein erforderliches Modul existiert nicht: %s',

	'PARENT_MODULE_FIND_ERROR'			=> 'Es wurde kein übergeordnetes Modul mit diesem Namen gefunden: %s',
	'PERMISSION_NOT_EXIST'				=> 'Die Berechtigungs-Einstellung „%s“ existiert unerwarteterweise nicht.',

	'ROLE_NOT_EXIST'					=> 'Die Berechtigungs-Rolle „%s“ existiert unerwarteterweise nicht.',
));
