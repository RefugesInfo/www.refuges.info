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
	'CLI_CONFIG_CANNOT_CACHED'			=> 'Verwende diese Option, wenn sich die Konfigurations-Einstellung zu oft ändert, um effizient gecached zu werden.',
	'CLI_CONFIG_CURRENT'				=> 'Aktuell eingestellter Wert. Nutze 0 und 1, um einen boolschen Wert festzulegen',
	'CLI_CONFIG_DELETE_SUCCESS'			=> 'Konfigurations-Einstellung %s erfolgreich gelöscht.',
	'CLI_CONFIG_NEW'					=> 'Neuer Konfigurations-Wert. Nutze 0 und 1, um einen boolschen Wert festzulegen',
	'CLI_CONFIG_NOT_EXISTS'				=> 'Konfigurations-Einstellung %s existiert nicht',
	'CLI_CONFIG_OPTION_NAME'			=> 'Der Name der Konfigurations-Einstellung',
	'CLI_CONFIG_PRINT_WITHOUT_NEWLINE'	=> 'Verwende diese Option, wenn der Wert ohne Zeilenwechsel am Ende ausgegeben werden soll.',
	'CLI_CONFIG_INCREMENT_BY'			=> 'Wert, um den erhöht werden soll',
	'CLI_CONFIG_INCREMENT_SUCCESS'		=> 'Konfigurations-Einstellung %s erfolgreich erhöht',
	'CLI_CONFIG_SET_FAILURE'			=> 'Konnte Konfiguration %s nicht einstellen',
	'CLI_CONFIG_SET_SUCCESS'			=> 'Konfiguration %s erfolgreich eingestellt',

	'CLI_DESCRIPTION_CRON_LIST'					=> 'Gibt eine Liste aller bereiten und aller nicht bereiten Cron-Jobs aus.',
	'CLI_DESCRIPTION_CRON_RUN'					=> 'Führt alle bereiten Cron-Jobs aus.',
	'CLI_DESCRIPTION_CRON_RUN_ARGUMENT_1'		=> 'Name des Jobs, der ausgeführt werden soll',
	'CLI_DESCRIPTION_DB_LIST'					=> 'Zeigt alle installierten und verfügbaren Migrationen an.',
	'CLI_DESCRIPTION_DB_MIGRATE'				=> 'Aktualisiert die Datenbank über eine Migration.',
	'CLI_DESCRIPTION_DB_REVERT'					=> 'Macht eine Migration rückgängig.',
	'CLI_DESCRIPTION_DELETE_CONFIG'				=> 'Löscht eine Konfigurations-Einstellung',
	'CLI_DESCRIPTION_DISABLE_EXTENSION'			=> 'Deaktiviert die angegebene Erweiterung.',
	'CLI_DESCRIPTION_ENABLE_EXTENSION'			=> 'Aktiviert die angegebene Erweiterung.',
	'CLI_DESCRIPTION_FIND_MIGRATIONS'			=> 'Findet Migrationen, die von keinen anderen Migrationen vorausgesetzt werden.',
	'CLI_DESCRIPTION_FIX_LEFT_RIGHT_IDS'		=> 'Repariert die Baumstruktur der Foren und Module.',
	'CLI_DESCRIPTION_GET_CONFIG'				=> 'Gibt den Wert einer Konfigurations-Einstellung aus',
	'CLI_DESCRIPTION_INCREMENT_CONFIG'			=> 'Erhöht den ganzzahligen Wert einer Konfigurations-Einstellung',
	'CLI_DESCRIPTION_LIST_EXTENSIONS'			=> 'Gibt alle in der Datenbank und im Dateisystem vorhandenen Erweiterungen aus.',

	'CLI_DESCRIPTION_OPTION_ENV'				=> 'Name der Umgebung.',
	'CLI_DESCRIPTION_OPTION_SAFE_MODE'			=> 'Im abgesicherten Modus ausführen (ohne Erweiterungen).',
	'CLI_DESCRIPTION_OPTION_SHELL'				=> 'Komandozeile starten.',

	'CLI_DESCRIPTION_PURGE_EXTENSION'			=> 'Löscht die angegebene Erweiterung.',

	'CLI_DESCRIPTION_REPARSER_LIST'						=> 'Listet die Arten von Texten auf, die neu verarbeitet werden können.',
	'CLI_DESCRIPTION_REPARSER_AVAILABLE'				=> 'Verfügbare Verarbeitungs-Routinen:',
	'CLI_DESCRIPTION_REPARSER_REPARSE'					=> 'Verarbeitet gespeicherte Texte mit dem aktuellen text_formatter-Dienst neu.',
	'CLI_DESCRIPTION_REPARSER_REPARSE_ARG_1'			=> 'Text-Art die neu verarbeitet werden soll. Leer lassen, um alles neu zu verarbeiten.',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_DRY_RUN'		=> 'Keine Änderungen speichern; nur ausgeben, was passieren würde',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_MIN'	=> 'Niedrigste Eintrags-ID, die verarbeitet wird',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_MAX'	=> 'Höchste Eintrags-ID, die verarbeitet wird',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_SIZE'	=> 'Geschätzte Zahl von Einträgen, die in einem Durchgang verarbeitet werden',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RESUME'		=> 'Startet die Verarbeitung dort, wo die letzte Ausführung endete',

	'CLI_DESCRIPTION_RECALCULATE_EMAIL_HASH'			=> 'Berechnet die Einträge im Feld user_email_hash der Benutzer-Tabelle neu.',

	'CLI_DESCRIPTION_SET_ATOMIC_CONFIG'					=> 'Legt den Wert für eine Konfigurations-Einstellung fest, wenn die derzeitige Einstellung dem angegebenen Vergleichswert entspricht',
	'CLI_DESCRIPTION_SET_CONFIG'						=> 'Legt den Wert für eine Konfigurations-Einstellung fest',

	'CLI_DESCRIPTION_THUMBNAIL_DELETE'					=> 'Löscht alle existierenden Vorschaubilder.',
	'CLI_DESCRIPTION_THUMBNAIL_GENERATE'				=> 'Erstellt alle fehlenden Vorschaubilder.',
	'CLI_DESCRIPTION_THUMBNAIL_RECREATE'				=> 'Erstellt alle Vorschaubilder neu.',

	'CLI_DESCRIPTION_UPDATE_CHECK'					=> 'Prüft, ob das Board auf dem neuesten Stand ist.',
	'CLI_DESCRIPTION_UPDATE_CHECK_ARGUMENT_1'		=> 'Name der zu überprüfenden Erweiterung (bei „all“ werden alle Erweiterungen überprüft)',
	'CLI_DESCRIPTION_UPDATE_CHECK_OPTION_CACHE'		=> 'Führt den Befehl („check“) auf Basis der im Cache gespeicherten Informationen aus.',
	'CLI_DESCRIPTION_UPDATE_CHECK_OPTION_STABILITY'	=> 'Nur auf produktive ("stable") oder vorläufige Versionen ("unstable") prüfen.',

	'CLI_DESCRIPTION_UPDATE_HASH_BCRYPT'		=> 'Hasht veraltete Passwort-Hashes mit bcrypt.',

	'CLI_ERROR_INVALID_STABILITY' => 'Für „%s“ muss „stable“ oder „unstable“ eingetragen werden.',

	'CLI_DESCRIPTION_USER_ACTIVATE'				=> 'Aktiviert (oder deaktiviert) ein Benutzerkonto.',
	'CLI_DESCRIPTION_USER_ACTIVATE_USERNAME'	=> 'Benutzername des Kontos, das aktiviert werden soll.',
	'CLI_DESCRIPTION_USER_ACTIVATE_DEACTIVATE'	=> 'Deaktiviert das Benutzerkonto',
	'CLI_DESCRIPTION_USER_ACTIVATE_ACTIVE'		=> 'Das Benutzerkonto ist bereits aktiviert.',
	'CLI_DESCRIPTION_USER_ACTIVATE_INACTIVE'	=> 'Das Benutzerkonto ist bereits deaktiviert.',
	'CLI_DESCRIPTION_USER_ADD'					=> 'Erstellt ein neues Benutzerkonto.',
	'CLI_DESCRIPTION_USER_ADD_OPTION_USERNAME'	=> 'Benutzername des neuen Kontos',
	'CLI_DESCRIPTION_USER_ADD_OPTION_PASSWORD'	=> 'Passwort des neuen Benutzers',
	'CLI_DESCRIPTION_USER_ADD_OPTION_EMAIL'		=> 'E-Mail-Adresse des neuen Benutzers',
	'CLI_DESCRIPTION_USER_ADD_OPTION_NOTIFY'	=> 'Aktivierungs-E-Mail an neuen Benutzer senden (wird standardmäßig nicht gesendet)',
	'CLI_DESCRIPTION_USER_DELETE'				=> 'Löscht ein Benutzerkonto.',
	'CLI_DESCRIPTION_USER_DELETE_USERNAME'		=> 'Benutzername des Kontos, das gelöscht werden soll.',
	'CLI_DESCRIPTION_USER_DELETE_OPTION_POSTS'	=> 'Löscht alle Beiträge des Benutzers. Wenn diese Option nicht gesetzt ist, bleiben die Beiträge des Benutzers erhalten.',
	'CLI_DESCRIPTION_USER_RECLEAN'				=> 'Benutzernamen erneut bereinigen.',

	'CLI_EXTENSION_DISABLE_FAILURE'		=> 'Konnte Erweiterung %s nicht deaktivieren',
	'CLI_EXTENSION_DISABLE_SUCCESS'		=> 'Erweiterung %s erfolgreich deaktiviert',
	'CLI_EXTENSION_DISABLED'			=> 'Erweiterung %s ist nicht aktiviert',
	'CLI_EXTENSION_ENABLE_FAILURE'		=> 'Konnte Erweiterung %s nicht aktivieren',
	'CLI_EXTENSION_ENABLE_SUCCESS'		=> 'Erweiterung %s erfolgreich aktiviert',
	'CLI_EXTENSION_ENABLED'				=> 'Erweiterung %s ist bereits aktiviert',
	'CLI_EXTENSION_NOT_EXIST'			=> 'Erweiterung %s existiert nicht',
	'CLI_EXTENSION_NAME'				=> 'Name der Erweiterung',
	'CLI_EXTENSION_PURGE_FAILURE'		=> 'Konnte Arbeitsdaten der Erweiterung %s nicht löschen',
	'CLI_EXTENSION_PURGE_SUCCESS'		=> 'Arbeitsdaten der Erweiterung %s erfolgreich gelöscht',
	'CLI_EXTENSION_UPDATE_FAILURE'		=> 'Erweiterung %s konnte nicht aktualisiert werden',
	'CLI_EXTENSION_UPDATE_SUCCESS'		=> 'Erweiterung %s wurde erfolgreich aktualisiert',
	'CLI_EXTENSION_NOT_FOUND'			=> 'Es wurden keine Erweiterungen gefunden.',
	'CLI_EXTENSION_NOT_ENABLEABLE'		=> 'Erweiterung %s ist nicht aktivierbar.',
	'CLI_EXTENSIONS_AVAILABLE'			=> 'Verfügbar',
	'CLI_EXTENSIONS_DISABLED'			=> 'Deaktiviert',
	'CLI_EXTENSIONS_ENABLED'			=> 'Aktiviert',

	'CLI_FIXUP_FIX_LEFT_RIGHT_IDS_SUCCESS'		=> 'Die Baumstruktur der Foren und Module wurde erfolgreich repariert.',
	'CLI_FIXUP_RECALCULATE_EMAIL_HASH_SUCCESS'	=> 'Alle E-Mail-Hashes wurden erfolgreich neu ermittelt.',
	'CLI_FIXUP_UPDATE_HASH_BCRYPT_SUCCESS'		=> 'Die veralteten Passwort-Hashes wurden erfolgreich auf bcrypt aktualisiert.',

	'CLI_MIGRATION_NAME'					=> 'Name der Migration inkl. Namesraum (Schrägstriche statt Backslashes verwenden, um Probleme zu vermeiden).',
	'CLI_MIGRATIONS_AVAILABLE'				=> 'Verfügbare Migrationen',
	'CLI_MIGRATIONS_INSTALLED'				=> 'Installierte Migrationen',
	'CLI_MIGRATIONS_ONLY_AVAILABLE'		    => 'Nur installierte Migrationen anzeigen',
	'CLI_MIGRATIONS_EMPTY'                  => 'Keine Migrationen.',

	'CLI_REPARSER_REPARSE_REPARSING'		=> 'Verarbeite %1$s (Bereich %2$d..%3$d)',
	'CLI_REPARSER_REPARSE_REPARSING_START'	=> 'Verarbeite %s...',
	'CLI_REPARSER_REPARSE_SUCCESS'			=> 'Verarbeitung erfolgreich abgeschlossen',

	// In all the case %1$s is the logical name of the file and %2$s the real name on the filesystem
	// eg: big_image.png (2_a51529ae7932008cf8454a95af84cacd) generated.
	'CLI_THUMBNAIL_DELETED'		=> '%1$s (%2$s) gelöscht.',
	'CLI_THUMBNAIL_DELETING'	=> 'Lösche Vorschaubilder',
	'CLI_THUMBNAIL_SKIPPED'		=> '%1$s (%2$s) übersprungen.',
	'CLI_THUMBNAIL_GENERATED'	=> '%1$s (%2$s) erstellt.',
	'CLI_THUMBNAIL_GENERATING'	=> 'Erstelle Vorschaubilder',
	'CLI_THUMBNAIL_GENERATING_DONE'	=> 'Alle Vorschaubilder wurden neu erstellt.',
	'CLI_THUMBNAIL_DELETING_DONE'	=> 'Alle Vorschaubilder wurden gelöscht.',

	'CLI_THUMBNAIL_NOTHING_TO_GENERATE'	=> 'Keine Vorschaubilder zu erstellen.',
	'CLI_THUMBNAIL_NOTHING_TO_DELETE'	=> 'Keine Vorschaubilder zu löschen.',

	'CLI_USER_ADD_SUCCESS'		=> 'Benutzer %s erfolgreich angelegt.',
	'CLI_USER_DELETE_CONFIRM'	=> 'Soll „%s“ wirklich gelöscht werden? [y/N]',
	'CLI_USER_RECLEAN_START'	=> 'Benutzernamen werden erneut bereinigt',
	'CLI_USER_RECLEAN_DONE'		=> [
		0	=> 'Bereinigung abgeschlossen. Es musste kein Benutzername bereinigt werden.',
		1	=> 'Bereinigung abgeschlossen. %d Benutzername wurde bereinigt.',
		2	=> 'Bereinigung abgeschlossen. %d Benutzernamen wurden bereinigt.',
	],
));

// Additional help for commands.
$lang = array_merge($lang, array(
	'CLI_HELP_CRON_RUN'			=> $lang['CLI_DESCRIPTION_CRON_RUN'] . ' Optional kannst du den Namen eines Cron-Jobs angeben, um nur diesen auszuführen.',
	'CLI_HELP_USER_ACTIVATE'	=> 'Aktiviert ein Benutzerkonto oder deaktiviert es, wenn die <info>--deactivate</info>-Option verwendet wird.
Um zusätzlich eine Aktivierungs-E-Mail an den Benutzer zu senden, verwende die <info>--send-email</info>-Option.',
	'CLI_HELP_USER_ADD'			=> 'Mit dem <info>%command.name%</info>-Befehl wird ein neues Benutzerkonto erstellt:
Wenn der Befehl ohne Optionen ausgeführt wird, werden diese von dir abgefragt.
Um zusätzlich eine Aktivierungs-E-Mail an den neuen Benutzer zu senden, verwende die <info>--send-email</info>-Option.',
	'CLI_HELP_USER_RECLEAN'		=> 'Die erneute Bereinigung der Benutzernamen prüft alle gespeicherten Benutzernamen und stellt sicher, dass die bereinigten Versionen auch vorhanden sind. Bereinigte Benutzernamen sind unabhängig von Groß- und Kleinschreibung, NFC-normalisiert und in ASCII umgewandelt.',
));
