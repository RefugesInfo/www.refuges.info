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
	'ACP_GROUPS_MANAGE_EXPLAIN'		=> 'Hier kannst du alle Benutzergruppen verwalten. Du kannst bestehende löschen oder ändern oder neue Gruppen erstellen, Gruppenleiter auswählen, den Gruppenstatus (offen, versteckt, geschlossen) ändern sowie Name und Beschreibung der Gruppe einstellen.',
	'ADD_GROUP_CATEGORY'			=> 'Kategorie hinzufügen',
	'ADD_USERS'						=> 'Benutzer hinzufügen',
	'ADD_USERS_EXPLAIN'				=> 'Hier kannst du neue Benutzer zur Gruppe hinzufügen. Du kannst einstellen, ob die Gruppe die neue Hauptgruppe für die gewählten Benutzer wird. Außerdem kannst du die Benutzer als Gruppenleiter eintragen. Bitte gib je einen Benutzernamen pro Zeile ein.',

	'COPY_PERMISSIONS'				=> 'Berechtigungen kopieren von',
	'COPY_PERMISSIONS_EXPLAIN'		=> 'Nach dem Erstellen wird die neue Gruppe die gleichen Berechtigungen haben, wie die hier ausgewählte Gruppe.',
	'CREATE_GROUP'					=> 'Neue Gruppe erstellen',

	'GROUPS_NO_MEMBERS'				=> 'Diese Gruppe hat keine Mitglieder',
	'GROUPS_NO_MODS'				=> 'Keine Gruppenleiter definiert',

	'GROUP_APPROVE'					=> 'Mitglied aufnehmen',
	'GROUP_APPROVED'				=> 'Freigegebene Mitglieder',
	'GROUP_AVATAR'					=> 'Gruppen-Avatar',
	'GROUP_AVATAR_EXPLAIN'			=> 'Dieses Bild wird in den Gruppendetails angezeigt.',
	'GROUP_CATEGORY_NAME'			=> 'Name der Kategorie',
	'GROUP_CLOSED'					=> 'Geschlossen',
	'GROUP_COLOR'					=> 'Gruppen-Farbe',
	'GROUP_COLOR_EXPLAIN'			=> 'Farbe, die für die Mitglieder der Gruppe benutzt wird. Frei lassen für Standardfarbe der Benutzer.',
	'GROUP_CONFIRM_ADD_USERS'		=> array(
		1	=> 'Bist du dir sicher, dass du den Benutzer %2$s der Gruppe hinzufügen möchtest?',
		2	=> 'Bist du dir sicher, dass du die Benutzer %2$s der Gruppe hinzufügen möchtest?',
	),
	'GROUP_CREATED'					=> 'Gruppe erfolgreich erstellt.',
	'GROUP_DEFAULT'					=> 'Zur Hauptgruppe des Mitglieds machen',
	'GROUP_DEFS_UPDATED'			=> 'Hauptgruppe für alle ausgewählten Mitglieder gesetzt.',
	'GROUP_DELETE'					=> 'Mitglied aus Gruppe entfernen',
	'GROUP_DELETED'					=> 'Gruppe gelöscht und neue Hauptgruppen für die Benutzer erfolgreich eingestellt.',
	'GROUP_DEMOTE'					=> 'Leitung entziehen',
	'GROUP_DESC'					=> 'Gruppenbeschreibung',
	'GROUP_DETAILS'					=> 'Gruppendetails',
	'GROUP_EDIT_EXPLAIN'			=> 'Hier kannst du eine bestehende Gruppe bearbeiten. Du kannst ihren Namen, die Beschreibung und den Typ (offen, geschlossen usw.) ändern. Außerdem kannst du einige gruppenweite Einstellungen vornehmen, wie z.&nbsp;B. die Gruppenfarbe, den Gruppenrang usw. Änderungen, die hier gemacht werden, überschreiben die Benutzereinstellungen. Bitte beachte, dass Gruppenmitglieder die Einstellungen des Gruppen-Avatars ändern können, es sei denn, du entziehst ihnen die entsprechende Berechtigung.',
	'GROUP_ERR_USERS_EXIST'			=> 'Die gewählten Benutzer sind bereits Mitglieder dieser Gruppe.',
	'GROUP_FOUNDER_MANAGE'			=> 'Verwaltung nur durch Gründer',
	'GROUP_FOUNDER_MANAGE_EXPLAIN'	=> 'Schränkt die Verwaltung dieser Gruppe auf Gründer ein. Benutzer mit Rechten für diese Gruppe können diese Gruppe und ihre Mitglieder weiterhin einsehen.',
	'GROUP_HIDDEN'					=> 'Versteckt',
	'GROUP_LANG'					=> 'Gruppen-Sprache',
	'GROUP_LEAD'					=> 'Gruppenleiter',
	'GROUP_LEADERS_ADDED'			=> 'Neue Gruppenleiter erfolgreich hinzugefügt.',
	'GROUP_LEGEND'					=> 'Gruppe in der Legende der Online-Liste anzeigen',
	'GROUP_LIST'					=> 'Derzeitige Mitglieder',
	'GROUP_LIST_EXPLAIN'			=> 'Dies ist eine komplette Liste der Benutzer, die Mitglied dieser Gruppe sind. Du kannst Benutzer löschen (außer in bestimmten Systemgruppen) oder neue hinzufügen.',
	'GROUP_MEMBERS'					=> 'Gruppenmitglieder',
	'GROUP_MEMBERS_EXPLAIN'			=> 'Dies ist eine Liste aller Mitglieder dieser Benutzergruppe. Sie enthält separate Bereiche für Gruppenleiter, auf Aufnahme wartende Benutzer und derzeitige Gruppenmitglieder. Von hier aus kannst du einstellen, wer Mitglied dieser Gruppe sein soll und mit welchem Status. Um einen Gruppenleiter als normales Mitglied in der Gruppe weiterzuführen, wähle „Leitung entziehen“ an Stelle von „Löschen“. Gleichfalls kannst du „Zum Gruppenleiter ernennen“ verwenden, um ein bestehendes Gruppenmitglied zum Gruppenleiter zu machen.',
	'GROUP_MESSAGE_LIMIT'			=> 'Limit an Privaten Nachrichten pro Ordner für diese Gruppe',
	'GROUP_MESSAGE_LIMIT_EXPLAIN'	=> 'Diese Option überschreibt das Limit an Privaten Nachrichten, die ein Gruppenmitglied pro Ordner speichern darf. Es greift der maximale Wert aller Gruppen, in denen ein Benutzer Mitglied ist. Das in den Board-Einstellungen festgelegte Standardlimit für Benutzer wird verwendet, wenn 0 als Wert eingestellt wird.',
	'GROUP_MODS_ADDED'				=> 'Neue Gruppenleiter erfolgreich hinzugefügt.',
	'GROUP_MODS_DEMOTED'			=> 'Gruppenleiter erfolgreich zu normalen Mitgliedern heruntergestuft.',
	'GROUP_MODS_PROMOTED'			=> 'Mitglieder erfolgreich zum Gruppenleiter heraufgestuft.',
	'GROUP_NAME'					=> 'Gruppenname',
	'GROUP_NAME_TAKEN'				=> 'Der angegebene Gruppenname wird bereits benutzt. Bitte wähle einen anderen aus.',
	'GROUP_OPEN'					=> 'Offen',
	'GROUP_PENDING'					=> 'auf Aufnahme wartende Benutzer',
	'GROUP_MAX_RECIPIENTS'			=> 'Maximale Anzahl zulässiger Empfänger pro Privater Nachricht',
	'GROUP_MAX_RECIPIENTS_EXPLAIN'	=> 'Die maximale Anzahl zulässiger Empfänger für eine Private Nachricht. Es greift der maximale Wert aller Gruppen, in denen ein Benutzer Mitglied ist. Die in den Board-Einstellungen festgelegte Standardzahl für Benutzer wird verwendet, wenn 0 als Wert eingestellt wird.',
	'GROUP_OPTIONS_SAVE'			=> 'Optionen für die Gruppe',
	'GROUP_PROMOTE'					=> 'Zum Gruppenleiter ernennen',
	'GROUP_RANK'					=> 'Gruppenrang',
	'GROUP_RECEIVE_PM'				=> 'Gruppe kann Private Nachrichten empfangen',
	'GROUP_RECEIVE_PM_EXPLAIN'		=> 'Beachte, dass versteckte Gruppen – unabhängig dieser Einstellung – nicht angeschrieben werden können.',
	'GROUP_REQUEST'					=> 'Moderiert',
	'GROUP_SETTINGS_SAVE'			=> 'Gruppenweite Einstellungen',
	'GROUP_SKIP_AUTH'				=> 'Gruppenleiter von Berechtigungen ausnehmen',
	'GROUP_SKIP_AUTH_EXPLAIN'		=> 'Wenn gesetzt, gelten die Berechtigungen der Gruppe nicht für die Gruppenleiter.',
	'GROUP_SPECIAL'					=> 'System',
	'GROUP_TEAMPAGE'				=> 'Gruppe auf Team-Seite anzeigen',
	'GROUP_TYPE'					=> 'Gruppentyp',
	'GROUP_TYPE_EXPLAIN'			=> 'Hier kannst du einstellen, wer die Gruppe sehen oder ihr beitreten darf.',
	'GROUP_UPDATED'					=> 'Gruppeneinstellungen erfolgreich aktualisiert.',

	'GROUP_USERS_ADDED'				=> 'Die neuen Benutzer wurden erfolgreich der Gruppe hinzugefügt.',
	'GROUP_USERS_EXIST'				=> 'Die gewählten Benutzer sind bereits Mitglied der Gruppen.',
	'GROUP_USERS_REMOVE'			=> 'Benutzer aus der Gruppe entfernt; neue Hauptgruppen erfolgreich eingestellt.',
	'GROUP_USERS_INVALID'			=> 'Es wurden keine Benutzer zu der Gruppe hinzugefügt, da keine Benutzer mit folgenden Benutzernamen existieren: %s',

	'LEGEND_EXPLAIN'				=> 'Diese Gruppen werden in der Gruppen-Legende angezeigt:',
	'LEGEND_SETTINGS'				=> 'Einstellungen für Legende',
	'LEGEND_SORT_GROUPNAME'			=> 'Legende nach Gruppennamen sortieren',
	'LEGEND_SORT_GROUPNAME_EXPLAIN'	=> 'Die unten stehende Sortierung wird ignoriert, wenn diese Option aktiviert ist.',

	'MANAGE_LEGEND'			=> 'Gruppen-Legende verwalten',
	'MANAGE_TEAMPAGE'		=> 'Team-Seite verwalten',
	'MAKE_DEFAULT_FOR_ALL'	=> 'Zur Hauptgruppe jedes Mitglieds machen',
	'MEMBERS'				=> 'Mitglieder',

	'NO_GROUP'					=> 'Keine Gruppe angegeben.',
	'NO_GROUPS_ADDED'			=> 'Es wurden noch keine Gruppen hinzugefügt.',
	'NO_GROUPS_CREATED'			=> 'Es wurden bislang keine Gruppen erstellt.',
	'NO_PERMISSIONS'			=> 'Berechtigungen nicht kopieren',
	'NO_USERS'					=> 'Du hast keine Benutzer angegeben.',
	'NO_USERS_ADDED'			=> 'Es wurden keine Benutzer der Gruppe hinzugefügt.',
	'NO_VALID_USERS'			=> 'Du hast keine Benutzer angegeben, für die dieser Vorgang möglich wäre.',

	'PENDING_MEMBERS'			=> 'Wartend',

	'SELECT_GROUP'				=> 'Gruppe auswählen',
	'SPECIAL_GROUPS'			=> 'Systemgruppen',
	'SPECIAL_GROUPS_EXPLAIN'	=> 'Systemgruppen sind spezielle Gruppen, die nicht gelöscht oder bearbeitet werden können. Allerdings kannst du Benutzer hinzufügen und Grundeinstellungen ändern.',

	'TEAMPAGE'					=> 'Team-Seite',
	'TEAMPAGE_DISP_ALL'			=> 'Alle Mitgliedschaften',
	'TEAMPAGE_DISP_DEFAULT'		=> 'Nur die Hauptgruppe',
	'TEAMPAGE_DISP_FIRST'		=> 'Nur die erste Gruppe',
	'TEAMPAGE_EXPLAIN'			=> 'Diese Gruppen werden auf der Team-Seite angezeigt:',
	'TEAMPAGE_FORUMS'			=> 'Moderierte Foren anzeigen',
	'TEAMPAGE_FORUMS_EXPLAIN'	=> 'Wenn aktiviert, wird bei Moderatoren eine Liste der Foren angezeigt, in denen sie Moderationsrechte haben. Dies kann bei größeren Boards zu einer erhöhten Datenbank-Last führen.',
	'TEAMPAGE_MEMBERSHIPS'		=> 'Mitgliedschaften der Benutzer anzeigen',
	'TEAMPAGE_SETTINGS'			=> 'Einstellungen für Team-Seite',
	'TOTAL_MEMBERS'				=> 'Mitglieder',

	'USERS_APPROVED'				=> 'Benutzer erfolgreich bestätigt',
	'USER_DEFAULT'					=> 'Standardrang',
	'USER_DEF_GROUPS'				=> 'Benutzerdefinierte Gruppen',
	'USER_DEF_GROUPS_EXPLAIN'		=> 'Dies sind Gruppen, die von dir oder einem anderen Administrator erstellt wurden. Du kannst Mitgliedschaften verwalten sowie Gruppeneinstellungen ändern oder Gruppen löschen.',
	'USER_GROUP_DEFAULT'			=> 'Als Hauptgruppe setzen',
	'USER_GROUP_DEFAULT_EXPLAIN'	=> 'Wenn hier ja gewählt wird, wird diese Gruppe die Hauptgruppe für die neu hinzugefügten Benutzer.',
	'USER_GROUP_LEADER'				=> 'Zum Gruppenleiter machen',
));
