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

/**
*	EXTENSION-DEVELOPERS PLEASE NOTE
*
*	You are able to put your permission sets into your extension.
*	The permissions logic should be added via the 'core.permissions' event.
*	You can easily add new permission categories, types and permissions, by
*	simply merging them into the respective arrays.
*	The respective language strings should be added into a language file, that
*	start with 'permissions_', so they are automatically loaded within the ACP.
*/

$lang = array_merge($lang, array(
	'ACL_CAT_ACTIONS'		=> 'Aktivitäten',
	'ACL_CAT_CONTENT'		=> 'Inhalt',
	'ACL_CAT_FORUMS'		=> 'Foren',
	'ACL_CAT_MISC'			=> 'Diverses',
	'ACL_CAT_PERMISSIONS'	=> 'Rechte',
	'ACL_CAT_PM'			=> 'Private Nachrichten',
	'ACL_CAT_POLLS'			=> 'Umfragen',
	'ACL_CAT_POST'			=> 'Beiträge',
	'ACL_CAT_POST_ACTIONS'	=> 'Beitrags-Vorgänge',
	'ACL_CAT_POSTING'		=> 'Beiträge',
	'ACL_CAT_PROFILE'		=> 'Profil',
	'ACL_CAT_SETTINGS'		=> 'Einstellungen',
	'ACL_CAT_TOPIC_ACTIONS'	=> 'Themen-Vorgänge',
	'ACL_CAT_USER_GROUP'	=> 'Benutzer &amp; Gruppen',
));

// User Permissions
$lang = array_merge($lang, array(
	'ACL_U_VIEWPROFILE'	=> 'Kann Profile, die Mitglieder- und die Wer-ist-online-Liste ansehen',
	'ACL_U_CHGNAME'		=> 'Kann Benutzernamen ändern',
	'ACL_U_CHGPASSWD'	=> 'Kann Passwort ändern',
	'ACL_U_CHGEMAIL'	=> 'Kann E-Mail-Adresse ändern',
	'ACL_U_CHGAVATAR'	=> 'Kann Avatar ändern',
	'ACL_U_CHGGRP'		=> 'Kann Hauptgruppe ändern',
	'ACL_U_CHGPROFILEINFO'	=> 'Kann Informationen in Profilfeldern ändern',

	'ACL_U_ATTACH'		=> 'Kann Dateianhänge erstellen',
	'ACL_U_DOWNLOAD'	=> 'Kann Dateianhänge herunterladen',
	'ACL_U_SAVEDRAFTS'	=> 'Kann Entwürfe speichern',
	'ACL_U_CHGCENSORS'	=> 'Kann Wortzensur umgehen',
	'ACL_U_SIG'			=> 'Kann Signatur verwenden',
	'ACL_U_EMOJI'		=> 'Kann Emojis und Rich-Text-Zeichen in Thementiteln verwenden',

	'ACL_U_SENDPM'		=> 'Kann Private Nachrichten verschicken',
	'ACL_U_MASSPM'		=> 'Kann PNs an mehrere Benutzer verschicken',
	'ACL_U_MASSPM_GROUP'=> 'Kann PNs an Gruppen verschicken',
	'ACL_U_READPM'		=> 'Kann Private Nachrichten lesen',
	'ACL_U_PM_EDIT'		=> 'Kann eigene Private Nachrichten ändern',
	'ACL_U_PM_DELETE'	=> 'Kann Private Nachrichten aus eigenem Ordner entfernen',
	'ACL_U_PM_FORWARD'	=> 'Kann Private Nachrichten weiterleiten',
	'ACL_U_PM_EMAILPM'	=> 'Kann Private Nachrichten per E-Mail versenden',
	'ACL_U_PM_PRINTPM'	=> 'Kann Private Nachrichten drucken',
	'ACL_U_PM_ATTACH'	=> 'Kann Dateianhänge in Privaten Nachrichten versenden',
	'ACL_U_PM_DOWNLOAD'	=> 'Kann Dateianhänge in Privaten Nachrichten herunterladen',
	'ACL_U_PM_BBCODE'	=> 'Kann BBCode in Privaten Nachrichten verwenden',
	'ACL_U_PM_SMILIES'	=> 'Kann Smileys in Privaten Nachrichten verwenden',
	'ACL_U_PM_IMG'		=> 'Kann den [img]-BBCode-Tag in Privaten Nachrichten verwenden',
	'ACL_U_PM_FLASH'	=> 'Kann den [flash]-BBCode-Tag in Privaten Nachrichten verwenden',

	'ACL_U_SENDEMAIL'	=> 'Kann E-Mails versenden',
	'ACL_U_SENDIM'		=> 'Kann Instant Messages versenden',
	'ACL_U_IGNOREFLOOD'	=> 'Kann Wartezeiten übergehen',
	'ACL_U_HIDEONLINE'	=> 'Kann Online-Status ausblenden',
	'ACL_U_VIEWONLINE'	=> 'Kann auch unsichtbare Benutzer online sehen',
	'ACL_U_SEARCH'		=> 'Kann die Suchfunktion benutzen',
));

// Forum Permissions
$lang = array_merge($lang, array(
	'ACL_F_LIST'		=> 'Kann Forum sehen',
	'ACL_F_LIST_TOPICS' => 'Kann Themen sehen',
	'ACL_F_READ'		=> 'Kann Forum lesen',
	'ACL_F_SEARCH'		=> 'Kann das Forum durchsuchen',
	'ACL_F_SUBSCRIBE'	=> 'Kann Forum abonnieren',
	'ACL_F_PRINT'		=> 'Kann Themen drucken',
	'ACL_F_EMAIL'		=> 'Kann Themen per E-Mail empfehlen',
	'ACL_F_BUMP'		=> 'Kann Themen als neu markieren',
	'ACL_F_USER_LOCK'	=> 'Kann eigene Themen sperren',
	'ACL_F_DOWNLOAD'	=> 'Kann Dateianhänge herunterladen',
	'ACL_F_REPORT'		=> 'Kann Beiträge melden',

	'ACL_F_POST'		=> 'Kann neue Themen im Forum starten',
	'ACL_F_STICKY'		=> 'Kann wichtige Themen erstellen',
	'ACL_F_ANNOUNCE'	=> 'Kann Bekanntmachungen erstellen',
	'ACL_F_ANNOUNCE_GLOBAL'	=> 'Kann globale Bekanntmachungen erstellen',
	'ACL_F_REPLY'		=> 'Kann auf Themen antworten',
	'ACL_F_EDIT'		=> 'Kann eigene Beiträge ändern',
	'ACL_F_DELETE'		=> 'Kann eigene Beiträge löschen',
	'ACL_F_SOFTDELETE'	=> 'Kann eigene Beiträge als gelöscht markieren<br /><em>Moderatoren, die Beiträge freigeben können, können als gelöscht markierte Beiträge wiederherstellen.</em>',
	'ACL_F_IGNOREFLOOD' => 'Kann die Wartezeit umgehen',
	'ACL_F_POSTCOUNT'	=> 'Beitrags-Zähler wird erhöht<br /><em>Bitte beachte, dass diese Einstellung nur bei neu erstellten Beiträgen wirkt.</em>',
	'ACL_F_NOAPPROVE'	=> 'Kann Beiträge ohne Freigabe erstellen',

	'ACL_F_ATTACH'		=> 'Kann Dateianhänge anfügen',
	'ACL_F_ICONS'		=> 'Kann Themen-/Beitrags-Symbole verwenden',
	'ACL_F_BBCODE'		=> 'Kann BBCode verwenden',
	'ACL_F_FLASH'		=> 'Kann den [flash]-BBCode-Tag verwenden',
	'ACL_F_IMG'			=> 'Kann den [img]-BBCode-Tag verwenden',
	'ACL_F_SIGS'		=> 'Kann Signatur verwenden',
	'ACL_F_SMILIES'		=> 'Kann Smileys verwenden',

	'ACL_F_POLL'		=> 'Kann Umfragen erstellen',
	'ACL_F_VOTE'		=> 'Kann an Umfragen teilnehmen',
	'ACL_F_VOTECHG'		=> 'Kann Abstimmung ändern',
));

// Moderator Permissions
$lang = array_merge($lang, array(
	'ACL_M_EDIT'		=> 'Kann Beiträge ändern',
	'ACL_M_DELETE'		=> 'Kann Beiträge dauerhaft löschen',
	'ACL_M_SOFTDELETE'	=> 'Kann Beiträge als gelöscht markieren<br /><em>Moderatoren, die Beiträge freigeben können, können als gelöscht markierte Beiträge wiederherstellen.</em>',
	'ACL_M_APPROVE'		=> 'Kann Beiträge freigeben und wiederherstellen',
	'ACL_M_REPORT'		=> 'Kann Meldungen schließen und löschen',
	'ACL_M_CHGPOSTER'	=> 'Kann Autor eines Beitrags ändern',

	'ACL_M_MOVE'	=> 'Kann Themen verschieben',
	'ACL_M_LOCK'	=> 'Kann Themen sperren',
	'ACL_M_SPLIT'	=> 'Kann Themen teilen',
	'ACL_M_MERGE'	=> 'Kann Themen zusammenführen',

	'ACL_M_INFO'		=> 'Kann Beitrags-Details ansehen',
	'ACL_M_WARN'		=> 'Kann Verwarnungen erteilen',
	'ACL_M_PM_REPORT'	=> 'Kann Meldungen zu Privaten Nachrichten schließen und löschen',
	'ACL_M_BAN'			=> 'Kann Sperren verwalten',
));

// Admin Permissions
$lang = array_merge($lang, array(
	'ACL_A_BOARD'		=> 'Kann Board-Einstellungen ändern/auf Updates prüfen',
	'ACL_A_SERVER'		=> 'Kann Server-/Kommunikations-Einstellungen ändern',
	'ACL_A_JABBER'		=> 'Kann Jabber-Einstellungen ändern',
	'ACL_A_PHPINFO'		=> 'Kann PHP-Einstellungen anzeigen',

	'ACL_A_FORUM'		=> 'Kann Foren verwalten',
	'ACL_A_FORUMADD'	=> 'Kann neue Foren erstellen',
	'ACL_A_FORUMDEL'	=> 'Kann Foren löschen',
	'ACL_A_PRUNE'		=> 'Kann inaktive Themen löschen',

	'ACL_A_ICONS'		=> 'Kann Themen-/Beitrags-Symbole und Smileys ändern',
	'ACL_A_WORDS'		=> 'Kann Wortzensur einstellen',
	'ACL_A_BBCODE'		=> 'Kann BBCode-Tags festlegen',
	'ACL_A_ATTACH'		=> 'Kann Einstellungen zu Dateianhängen ändern',

	'ACL_A_USER'		=> 'Kann Benutzer verwalten<br /><em>Dies beinhaltet das Recht, den verwendeten Browser in der Wer-ist-online-Liste einzusehen.</em>',
	'ACL_A_USERDEL'		=> 'Kann Benutzer löschen',
	'ACL_A_GROUP'		=> 'Kann Gruppen verwalten',
	'ACL_A_GROUPADD'	=> 'Kann neue Gruppen erstellen',
	'ACL_A_GROUPDEL'	=> 'Kann Gruppen löschen',
	'ACL_A_RANKS'		=> 'Kann Ränge verwalten',
	'ACL_A_PROFILE'		=> 'Kann benutzerdefinierte Profilfelder verwalten',
	'ACL_A_NAMES'		=> 'Kann verbotene Benutzernamen verwalten',
	'ACL_A_BAN'			=> 'Kann Sperrungen verwalten',

	'ACL_A_VIEWAUTH'	=> 'Kann effektive Berechtigungen anzeigen',
	'ACL_A_AUTHGROUPS'	=> 'Kann Berechtigungen für einzelne Gruppen ändern',
	'ACL_A_AUTHUSERS'	=> 'Kann Berechtigungen für einzelne Benutzer ändern',
	'ACL_A_FAUTH'		=> 'Kann allgemeine Foren-Berechtigungen ändern',
	'ACL_A_MAUTH'		=> 'Kann allgemeine Moderatoren-Berechtigungen ändern',
	'ACL_A_AAUTH'		=> 'Kann allgemeine Administrator-Berechtigungen ändern',
	'ACL_A_UAUTH'		=> 'Kann allgemeine Benutzer-Berechtigungen ändern',
	'ACL_A_ROLES'		=> 'Kann Rollen verwalten',
	'ACL_A_SWITCHPERM'	=> 'Kann andere Berechtigungen testen',

	'ACL_A_STYLES'		=> 'Kann Styles verwalten',
	'ACL_A_EXTENSIONS'	=> 'Kann Erweiterungen verwalten',
	'ACL_A_VIEWLOGS'	=> 'Kann Protokolle anzeigen',
	'ACL_A_CLEARLOGS'	=> 'Kann Protokolle löschen',
	'ACL_A_MODULES'		=> 'Kann Module verwalten',
	'ACL_A_LANGUAGE'	=> 'Kann Sprachpakete verwalten',
	'ACL_A_EMAIL'		=> 'Kann Massen-E-Mails versenden',
	'ACL_A_BOTS'		=> 'Kann Bots verwalten',
	'ACL_A_REASONS'		=> 'Kann Meldungs-/Ablehnungs-Gründe verwalten',
	'ACL_A_BACKUP'		=> 'Kann ein Backup der Datenbank vornehmen und sie wiederherstellen',
	'ACL_A_SEARCH'		=> 'Kann Such-Backends verwalten und einstellen',
));
