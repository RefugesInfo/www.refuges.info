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
	'ADMIN_SIG_PREVIEW'		=> 'Signatur-Vorschau',
	'AT_LEAST_ONE_FOUNDER'	=> 'Du kannst diesen Gründer nicht in einen normalen Benutzer umwandeln. Es muss mindestens ein Gründer in diesem Board vorhanden sein. Wenn du den Gründer-Status dieses Benutzers ändern möchtest, musst du zuerst einen anderen Benutzer zum Gründer ernennen.',

	'BAN_ALREADY_ENTERED'	=> 'Die Sperre wurde bereits früher erfolgreich erstellt. Die Liste der Sperren wurde nicht aktualisiert.',
	'BAN_SUCCESSFUL'		=> 'Sperre erfolgreich hinzugefügt.',

	'CANNOT_BAN_ANONYMOUS'			=> 'Du kannst das Gast-Benutzerkonto nicht sperren. Berechtigungen für Gäste können im Register „Berechtigungen“ geändert werden.',
	'CANNOT_BAN_FOUNDER'			=> 'Du kannst keine Gründer sperren.',
	'CANNOT_BAN_YOURSELF'			=> 'Du kannst dich nicht selber sperren.',
	'CANNOT_DEACTIVATE_BOT'			=> 'Du kannst keine Benutzerkonten von Bots deaktivieren. Deaktiviere stattdessen den Bot in den Einstellungen für Spiders/Robots.',
	'CANNOT_DEACTIVATE_FOUNDER'		=> 'Du kannst keine Benutzerkonten von Gründern sperren.',
	'CANNOT_DEACTIVATE_YOURSELF'	=> 'Du kannst dein eigenes Benutzerkonto nicht deaktivieren.',
	'CANNOT_FORCE_REACT_BOT'		=> 'Du kannst keine erneute Aktivierung für Bots erzwingen. Reaktiviere stattdessen den Bot in den Einstellungen für Spiders/Robots.',
	'CANNOT_FORCE_REACT_FOUNDER'	=> 'Du kannst keine erneute Aktivierung für Benutzerkonten von Gründern erzwingen.',
	'CANNOT_FORCE_REACT_YOURSELF'	=> 'Du kannst für dein eigenes Benutzerkonto keine erneute Aktivierung erzwingen.',
	'CANNOT_REMOVE_ANONYMOUS'		=> 'Du kannst das Gäste-Benutzerkonto nicht löschen.',
	'CANNOT_REMOVE_FOUNDER'			=> 'Du kannst keine Benutzerkonten von Gründern löschen.',
	'CANNOT_REMOVE_YOURSELF'		=> 'Du kannst dein eigenes Benutzerkonto nicht löschen.',
	'CANNOT_SET_FOUNDER_IGNORED'	=> 'Du kannst keine ignorierten Mitglieder zu Gründern ernennen.',
	'CANNOT_SET_FOUNDER_INACTIVE'	=> 'Du musst Benutzer erst aktivieren, bevor du sie zum Gründer ernennen kannst, da nur aktive Benutzer zum Gründer ernannt werden können.',
	'CONFIRM_EMAIL_EXPLAIN'			=> 'Muss nur angegeben werden, wenn du die E-Mail-Adresse änderst.',

	'DELETE_POSTS'			=> 'Beiträge löschen',
	'DELETE_USER'			=> 'Benutzer löschen',
	'DELETE_USER_EXPLAIN'	=> 'Bitte beachte, dass das Löschen eines Benutzers endgültig ist und nicht rückgängig gemacht werden kann. Ungelesende Private Nachrichten, die der Benutzer geschrieben hat, werden gelöscht und können nicht mehr durch die Empfänger abgerufen werden.',

	'FORCE_REACTIVATION_SUCCESS'	=> 'Erneute Aktivierung des Benutzerkontos erfolgreich erzwungen.',
	'FOUNDER'						=> 'Gründer',
	'FOUNDER_EXPLAIN'				=> 'Gründer haben alle Administrations-Rechte und können von Nicht-Gründern nicht gesperrt, gelöscht oder geändert werden.',

	'GROUP_APPROVE'					=> 'Mitglied aufnehmen',
	'GROUP_DEFAULT'					=> 'Zur Hauptgruppe des Mitglieds machen',
	'GROUP_DELETE'					=> 'Mitglied aus Gruppe entfernen',
	'GROUP_DEMOTE'					=> 'Leitung entziehen',
	'GROUP_PROMOTE'					=> 'Zum Gruppenleiter ernennen',

	'IP_WHOIS_FOR'			=> 'Whois für Adresse %s',

	'LAST_ACTIVE'			=> 'Letzte Anmeldung',

	'MOVE_POSTS_EXPLAIN'	=> 'Bitte wähle ein Forum aus, in das alle Beiträge verschoben werden sollen, die der Benutzer erstellt hat.',

	'NO_SPECIAL_RANK'		=> 'Kein spezieller Rang zugewiesen',
	'NO_WARNINGS'			=> 'Keine Verwarnungen.',
	'NOT_MANAGE_FOUNDER'	=> 'Du hast versucht, einen Benutzer mit Gründer-Status zu verwalten. Nur Benutzer mit Gründer-Status können andere Gründer verwalten.',

	'QUICK_TOOLS'			=> 'Schnellauswahl',

	'REGISTERED'			=> 'Registriert',
	'REGISTERED_IP'			=> 'Registriert von IP-Adresse',
	'RETAIN_POSTS'			=> 'Beiträge erhalten',

	'SELECT_FORM'			=> 'Auswahl',
	'SELECT_USER'			=> 'Benutzer auswählen',

	'USER_ADMIN'					=> 'Benutzer-Verwaltung',
	'USER_ADMIN_ACTIVATE'			=> 'Benutzer aktivieren',
	'USER_ADMIN_ACTIVATED'			=> 'Benutzer erfolgreich aktiviert.',
	'USER_ADMIN_AVATAR_REMOVED'		=> 'Avatar erfolgreich aus dem Benutzerkonto entfernt.',
	'USER_ADMIN_BAN_EMAIL'			=> 'Über E-Mail-Adresse sperren',
	'USER_ADMIN_BAN_EMAIL_REASON'	=> 'E-Mail-Adresse über Benutzer-Verwaltung gesperrt',
	'USER_ADMIN_BAN_IP'				=> 'Über IP-Adresse sperren',
	'USER_ADMIN_BAN_IP_REASON'		=> 'IP-Adresse über Benutzer-Verwaltung gesperrt',
	'USER_ADMIN_BAN_NAME_REASON'	=> 'Benutzername über Benutzer-Verwaltung gesperrt',
	'USER_ADMIN_BAN_USER'			=> 'Über Benutzernamen sperren',
	'USER_ADMIN_DEACTIVATE'			=> 'Benutzer deaktivieren',
	'USER_ADMIN_DEACTIVED'			=> 'Benutzer erfolgreich deaktiviert.',
	'USER_ADMIN_DEL_ATTACH'			=> 'Alle Dateianhänge löschen',
	'USER_ADMIN_DEL_AVATAR'			=> 'Avatar löschen',
	'USER_ADMIN_DEL_OUTBOX'			=> 'Postausgang Privater Nachrichten leeren',
	'USER_ADMIN_DEL_POSTS'			=> 'Alle Beiträge löschen',
	'USER_ADMIN_DEL_SIG'			=> 'Signatur löschen',
	'USER_ADMIN_EXPLAIN'			=> 'Hier kannst du die Daten deiner Benutzer einstellen und bestimmte Einstellungen ändern.',
	'USER_ADMIN_FORCE'				=> 'Erneute Aktivierung erzwingen',
	'USER_ADMIN_LEAVE_NR'			=> 'Aus neu registrierten Benutzern entfernen',
	'USER_ADMIN_MOVE_POSTS'			=> 'Alle Beiträge verschieben',
	'USER_ADMIN_SIG_REMOVED'		=> 'Signatur erfolgreich aus dem Benutzerkonto entfernt.',
	'USER_ATTACHMENTS_REMOVED'		=> 'Alle Dateianhänge des Benutzers erfolgreich gelöscht.',
	'USER_AVATAR_NOT_ALLOWED'		=> 'Der Avatar kann nicht angezeigt werden, da Avatare deaktiviert wurden.',
	'USER_AVATAR_UPDATED'			=> 'Avatar-Daten des Benutzers erfolgreich geändert.',
	'USER_AVATAR_TYPE_NOT_ALLOWED'	=> 'Der Avatar kann nicht angezeigt werden, da der verwendete Avatar-Typ deaktiviert wurde.',
	'USER_CUSTOM_PROFILE_FIELDS'	=> 'Benutzerdefinierte Profil-Felder',
	'USER_DELETED'					=> 'Benutzer erfolgreich gelöscht.',
	'USER_GROUP_ADD'				=> 'Benutzer einer Gruppe hinzufügen',
	'USER_GROUP_NORMAL'				=> 'Benutzerdefinierte Gruppen, in denen der Benutzer Mitglied ist',
	'USER_GROUP_PENDING'			=> 'Gruppen, bei denen der Benutzer auf Aufnahme wartet',
	'USER_GROUP_SPECIAL'			=> 'Systemgruppen, in denen der Benutzer Mitglied ist',
	'USER_LIFTED_NR'				=> 'Benutzer erfolgreich aus der Gruppe der kürzlich registrierten Benutzer entfernt.',
	'USER_NO_ATTACHMENTS'			=> 'Es gibt keine angehängten Dateien, die angezeigt werden könnten.',
	'USER_NO_POSTS_TO_DELETE'		=> 'Der Benutzer hat keine Beiträge, die beibehalten oder gelöscht werden könnten.',
	'USER_OUTBOX_EMPTIED'			=> 'Der Postausgang des Benutzers für Private Nachrichten wurde erfolgreich geleert.',
	'USER_OUTBOX_EMPTY'				=> 'Der Postausgang des Benutzers für Private Nachrichten war bereits leer.',
	'USER_OVERVIEW_UPDATED'			=> 'Benutzerdaten erfolgreich geändert.',
	'USER_POSTS_DELETED'			=> 'Alle Beiträge des Benutzers erfolgreich gelöscht.',
	'USER_POSTS_MOVED'				=> 'Beiträge des Benutzers erfolgreich in Zielform verschoben.',
	'USER_PREFS_UPDATED'			=> 'Einstellungen des Benutzers erfolgreich geändert.',
	'USER_PROFILE'					=> 'Benutzer-Profil',
	'USER_PROFILE_UPDATED'			=> 'Benutzer-Profil erfolgreich aktualisiert.',
	'USER_RANK'						=> 'Benutzerrang',
	'USER_RANK_UPDATED'				=> 'Benutzerrang erfolgreich aktualisiert.',
	'USER_SIG_UPDATED'				=> 'Signatur des Benutzers erfolgreich geändert.',
	'USER_WARNING_LOG_DELETED'		=> 'Es sind keine Informationen verfügbar. Vermutlich wurde der Eintrag im Log gelöscht.',
	'USER_TOOLS'					=> 'Standard-Funktionen',
));
