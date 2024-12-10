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
	'ACP_PERMISSIONS_EXPLAIN'	=> '
		<p>Berechtigungen können sehr detailliert festgelegt werden. Sie sind in vier zentrale Bereiche aufgeteilt:</p>

		<h2>Allgemeine Berechtigungen</h2>
		<p>Mit diesen werden Berechtigungen forenübergreifend auf das gesamte Board angewandt. Sie sind weiter unterteilt in Benutzerrechte, Gruppenrechte, Administratoren und globale Moderatoren.</p>

		<h2>Forenbasierte Berechtigungen</h2>
		<p>Diese werden verwendet, um den Zugriff Foren-bezogen zu definieren. Sie sind weiter unterteilt in Forenrechte, Foren-Moderatoren, benutzerspezifische Forenrechte und gruppenspezifische Forenrechte.</p>

		<h2>Berechtigungs-Rollen</h2>
		<p>Rollen werden verwendet, um Sammlungen verschiedener Berechtigungen für die verschiedenen Berechtigungs-Arten zu erstellen, die später rollenbasiert zugewiesen werden können. Die standardmäßigen Gruppen sollten kleine wie auch große Boards abdecken; du kannst jedoch in allen vier Bereichen Rollen nach deinen Bedürfnissen hinzufügen, ändern und entfernen.</p>

		<h2>Effektive Berechtigungen</h2>
		<p>Diese Funktion wird verwendet, um die effektiven Berechtigungen anzuzeigen, die Benutzern, Moderatoren (forenspezifisch und global), Administratoren und Foren zugewiesen sind.</p>

		<br />

		<p>Weitere Informationen über die Einrichtung und Verwaltung von Berechtigungen auf deinem phpBB3-Board findest du <a href="https://www.phpbb.com/support/docs/en/3.3/ug/quickstart/permissions/">im Kapitel „Setting permissions“ der Schnellstartanleitung (englisch)</a> (<a href="https://www.phpbb.de/go/3.3/berechtigungen">deutsche Übersetzung</a>) nach.</p>
	',

	'ACL_NEVER'				=> 'Nie',
	'ACL_SET'				=> 'Berechtigungen setzen',
	'ACL_SET_EXPLAIN'		=> 'Berechtigungen basieren auf einem einfachen <strong>JA/NEIN</strong>-System. Wird eine Einstellung für einen Benutzer oder eine Gruppe auf <strong>NIE</strong> gesetzt, so überschreibt dieser Wert alle anderen gesetzten Werte. Wenn du bei diesem Benutzer/dieser Gruppe keinen Wert für eine Einstellung vornehmen möchtest, wähle <strong>NEIN</strong> aus. Wenn an anderer Stelle eine abweichende Einstellung vorgenommen wurde, so wird diese verwendet; ansonsten wird von <strong>NIE</strong> ausgegangen. Alle (mit dem davorstehendem Kontrollkästchen) ausgewählten Objekte werden die von dir definierten Berechtigungen übernehmen. Bitte beachte, dass die Festlegung von Administrator-Berechtigungen für Gründer keine Auswirkungen haben wird, da die Administrations-Berechtigungen für Gründer-Benutzeraccounts immer auf <strong>JA</strong> eingestellt sind.',
	'ACL_SETTING'			=> 'Einstellung',

	'ACL_TYPE_A_'			=> 'Administrator-Berechtigungen',
	'ACL_TYPE_F_'			=> 'Forums-Berechtigungen',
	'ACL_TYPE_M_'			=> 'Moderator-Berechtigungen',
	'ACL_TYPE_U_'			=> 'Benutzer-Berechtigungen',

	'ACL_TYPE_GLOBAL_A_'	=> 'Administrator-Berechtigungen',
	'ACL_TYPE_GLOBAL_U_'	=> 'Benutzer-Berechtigungen',
	'ACL_TYPE_GLOBAL_M_'	=> 'Globale Moderator-Berechtigungen',
	'ACL_TYPE_LOCAL_M_'		=> 'Moderator-Berechtigungen',
	'ACL_TYPE_LOCAL_F_'		=> 'Forums-Berechtigungen',

	'ACL_NO'				=> 'Nein',
	'ACL_VIEW'				=> 'Effektive Berechtigungen',
	'ACL_VIEW_EXPLAIN'		=> 'Hier kannst du die effektiven Berechtigungen anzeigen, die für einen Benutzer/eine Gruppe greifen. Ein rotes Kästchen zeigt an, dass der Benutzer/die Gruppe keine Berechtigung hat; ein grünes Kästchen, dass der Benutzer/die Gruppe über die Berechtigung verfügt.',
	'ACL_YES'				=> 'Ja',

	'ACP_ADMINISTRATORS_EXPLAIN'				=> 'Hier kannst du Benutzern oder Gruppen Administrations-Berechtigungen zuweisen. Alle Benutzer mit Administrationsrechten können auf den Administrations-Bereich zugreifen.',
	'ACP_FORUM_MODERATORS_EXPLAIN'				=> 'Hier kannst du Benutzer und Gruppen zu Forums-Moderatoren ernennen. Um den Zugriff von Benutzern auf Foren zu regeln, Rechte für globale Moderatoren festzulegen oder um Administratoren zu ernennen, verwende bitte die entsprechenden Bereiche.',
	'ACP_FORUM_PERMISSIONS_EXPLAIN'				=> 'Hier kannst du festlegen, welche Benutzer und Gruppen Zugriff auf welches Forum haben. Um Moderatoren oder Administratoren zu ernennen, verwende bitte die entsprechenden Bereiche.',
	'ACP_FORUM_PERMISSIONS_COPY_EXPLAIN'		=> 'Hier kannst du die Berechtigungen von einem Forum zu einem oder mehreren anderen Foren kopieren.',
	'ACP_GLOBAL_MODERATORS_EXPLAIN'				=> 'Hier kannst du Benutzern oder Gruppen globale Moderator-Berechtigungen zuweisen. Diese Moderatoren haben die gleichen Rechte wie gewöhnliche Moderatoren, können jedoch auf jedes Forum des Boards zugreifen.',
	'ACP_GROUPS_FORUM_PERMISSIONS_EXPLAIN'		=> 'Hier kannst du Gruppen Forums-Berechtigungen zuweisen.',
	'ACP_GROUPS_PERMISSIONS_EXPLAIN'			=> 'Hier kannst du Gruppen globale Rechte (Benutzer-, globale Moderatoren- und Administrator-Berechtigungen) zuweisen. Benutzerrechte beinhalten Punkte wie Avatare, den Versand von Privaten Nachrichten usw.; Globale-Moderator-Berechtigungen beinhalten die Bestätigung von Beiträgen, die Verwaltung von Themen und Sperren etc. und Administrations-Berechtigungen beinhalten die Änderung von Berechtigungen, die Definition benutzerdefinierter BBCodes etc. Individuelle Benutzer-Berechtigungen sollten nur in seltenen Fällen verwendet werden; die vorzuziehende Methode ist, die Benutzer in Gruppen aufzunehmen und den Gruppen entsprechende Rechte zuzuweisen.',
	'ACP_ADMIN_ROLES_EXPLAIN'					=> 'Hier kannst du Rollen für Administrator-Berechtigungen verwalten. Rollen sind zugewiesene Berechtigungen; wenn du eine Rolle änderst, ändern sich die Rechte aller Elemente, denen diese Rolle zugewiesen wurde.',
	'ACP_FORUM_ROLES_EXPLAIN'					=> 'Hier kannst du Rollen für Forum-Berechtigungen verwalten. Rollen sind zugewiesene Berechtigungen; wenn du eine Rolle änderst, ändern sich die Rechte aller Elemente, denen diese Rolle zugewiesen wurde.',
	'ACP_MOD_ROLES_EXPLAIN'						=> 'Hier kannst du Rollen für Moderator-Berechtigungen verwalten. Rollen sind zugewiesene Berechtigungen; wenn du eine Rolle änderst, ändern sich die Rechte aller Elemente, denen diese Rolle zugewiesen wurde.',
	'ACP_USER_ROLES_EXPLAIN'					=> 'Hier kannst du Rollen für Benutzer-Berechtigungen verwalten. Rollen sind zugewiesene Berechtigungen; wenn du eine Rolle änderst, ändern sich die Rechte aller Elemente, denen diese Rolle zugewiesen wurde.',
	'ACP_USERS_FORUM_PERMISSIONS_EXPLAIN'		=> 'Hier kannst du Benutzern Foren-Berechtigungen zuweisen.',
	'ACP_USERS_PERMISSIONS_EXPLAIN'				=> 'Hier kannst du Benutzern globale Rechte (Benutzer-, globale Moderatoren- und Administrator-Berechtigungen) zuweisen. Benutzerrechte beinhalten Punkte wie Avatare, den Versand von Privaten Nachrichten usw.; Globale-Moderator-Berechtigungen beinhalten die Bestätigung von Beiträgen, die Verwaltung von Themen und Sperren etc. und Administrations-Berechtigungen beinhalten die Änderung von Berechtigungen, die Definition benutzerdefinierter BBCodes etc. Um diese Rechte für eine größere Anzahl von Benutzern zu ändern, sollte das Gruppen-Berechtigungssystem verwendet werden. Benutzer-Berechtigungen sollten nur in seltenen Fällen verwendet werden; die vorzuziehende Methode ist, die Benutzer in Gruppen aufzunehmen und den Gruppen entsprechende Rechte zuzuweisen.',
	'ACP_VIEW_ADMIN_PERMISSIONS_EXPLAIN'		=> 'Hier kannst du die effektiven Administrator-Berechtigungen anzeigen, die den ausgewählten Benutzern/Gruppen zugewiesen sind.',
	'ACP_VIEW_GLOBAL_MOD_PERMISSIONS_EXPLAIN'	=> 'Hier kannst du die globalen Moderator-Berechtigungen anzeigen, die den ausgewählten Benutzern/Gruppen zugewiesen sind.',
	'ACP_VIEW_FORUM_PERMISSIONS_EXPLAIN'		=> 'Hier kannst du die Forums-Berechtigungen anzeigen, die den ausgewählten Benutzer/Gruppen und Foren zugewiesen sind.',
	'ACP_VIEW_FORUM_MOD_PERMISSIONS_EXPLAIN'	=> 'Hier kannst du die Moderator-Berechtigungen anzeigen, die den ausgewählten Benutzer/Gruppen und Foren zugewiesen sind.',
	'ACP_VIEW_USER_PERMISSIONS_EXPLAIN'			=> 'Hier kannst du die effektiven Benutzer-Berechtigungen anzeigen, die den ausgewählten Benutzern/Gruppen zugewiesen sind.',

	'ADD_GROUPS'				=> 'Gruppen hinzufügen',
	'ADD_PERMISSIONS'			=> 'Berechtigungen hinzufügen',
	'ADD_USERS'					=> 'Benutzer hinzufügen',
	'ADVANCED_PERMISSIONS'		=> 'Erweiterte Berechtigungen',
	'ALL_GROUPS'				=> 'Alle Gruppen auswählen',
	'ALL_NEVER'					=> 'Alle <strong>Nie</strong>',
	'ALL_NO'					=> 'Alle <strong>Nein</strong>',
	'ALL_USERS'					=> 'Alle Benutzer auswählen',
	'ALL_YES'					=> 'Alle <strong>Ja</strong>',
	'APPLY_ALL_PERMISSIONS'		=> 'Alle Berechtigungen anwenden',
	'APPLY_PERMISSIONS'			=> 'Berechtigungen anwenden',
	'APPLY_PERMISSIONS_EXPLAIN'	=> 'Die definierten Berechtigungen und die definierte Rolle werden nur für dieses und alle markierten Objekte angewandt.',
	'AUTH_UPDATED'				=> 'Die Berechtigungen wurden aktualisiert.',

	'COPY_PERMISSIONS_CONFIRM'				=> 'Bist du dir sicher, dass du diesen Vorgang durchführen möchtest? Dieser Vorgang wird alle bestehenden Berechtigungen der ausgewählten Foren überschreiben.',
	'COPY_PERMISSIONS_FORUM_FROM_EXPLAIN'	=> 'Das Forum, dessen Berechtigungen du kopieren möchtest.',
	'COPY_PERMISSIONS_FORUM_TO_EXPLAIN'		=> 'Die Ziel-Foren, zu denen die Berechtigungen kopiert werden sollen.',
	'COPY_PERMISSIONS_FROM'					=> 'Berechtigungen kopieren von',
	'COPY_PERMISSIONS_TO'					=> 'Berechtigungen kopieren nach',

	'CREATE_ROLE'				=> 'Rolle erstellen',
	'CREATE_ROLE_FROM'			=> 'Verwende Einstellungen von …',
	'CUSTOM'					=> 'Benutzerdefiniert …',

	'DEFAULT'					=> 'Standard',
	'DELETE_ROLE'				=> 'Rolle löschen',
	'DELETE_ROLE_CONFIRM'		=> 'Bist du dir sicher, dass du diese Rolle löschen möchtest? Objekte, denen diese Rolle zugewiesen wurde, werden ihre Rechte <strong>nicht</strong> verlieren.',
	'DISPLAY_ROLE_ITEMS'		=> 'Zeige Objekte an, die diese Rolle verwenden',

	'EDIT_PERMISSIONS'			=> 'Berechtigungen ändern',
	'EDIT_ROLE'					=> 'Rolle ändern',

	'GROUPS_NOT_ASSIGNED'		=> 'Keiner Gruppe ist diese Rolle zugewiesen.',

	'LOOK_UP_GROUP'				=> 'Benutzergruppe anzeigen',
	'LOOK_UP_USER'				=> 'Benutzer anzeigen',

	'MANAGE_GROUPS'		=> 'Gruppen verwalten',
	'MANAGE_USERS'		=> 'Benutzer verwalten',

	'NO_AUTH_SETTING_FOUND'		=> 'Keine definierten Berechtigungen gefunden',
	'NO_ROLE_ASSIGNED'			=> 'Keine Rolle zugewiesen …',
	'NO_ROLE_ASSIGNED_EXPLAIN'	=> 'Die Auswahl dieser Rolle ändert die rechts angegebenen Rechte nicht. Wenn du alle Berechtigungen entfernen möchtest, verwende den „<strong>Alle Nie</strong>“-Link.',
	'NO_ROLE_AVAILABLE'			=> 'Keine Rolle verfügbar',
	'NO_ROLE_NAME_SPECIFIED'	=> 'Bitte gib der Rolle einen Namen.',
	'NO_ROLE_SELECTED'			=> 'Die Rolle kann nicht gefunden werden.',
	'NO_USER_GROUP_SELECTED'	=> 'Du hast keine Benutzer/Gruppen ausgewählt.',

	'ONLY_FORUM_DEFINED'	=> 'Du hast nur Foren ausgewählt. Bitte wähle zusätzlich mindestens einen Benutzer/eine Gruppe aus.',

	'PERMISSION_APPLIED_TO_ALL'		=> 'Berechtigungen und Rolle werden auch auf alle markierten Objekte angewandt.',
	'PLUS_SUBFORUMS'				=> '+Unterforen',

	'REMOVE_PERMISSIONS'			=> 'Berechtigungen entfernen',
	'REMOVE_ROLE'					=> 'Rolle entfernen',
	'RESULTING_PERMISSION'			=> 'Resultierende Berechtigung',
	'ROLE'							=> 'Rolle',
	'ROLE_ADD_SUCCESS'				=> 'Rolle erfolgreich hinzugefügt.',
	'ROLE_ASSIGNED_TO'				=> 'Benutzer/Gruppen zugeordnet zu %s',
	'ROLE_DELETED'					=> 'Rolle erfolgreich gelöscht.',
	'ROLE_DESCRIPTION'				=> 'Rollen-Beschreibung',

	'ROLE_ADMIN_FORUM'			=> 'Foren-Administrator',
	'ROLE_ADMIN_FULL'			=> 'Umfassender Administrator',
	'ROLE_ADMIN_STANDARD'		=> 'Standard-Administrator',
	'ROLE_ADMIN_USERGROUP'		=> 'Benutzer- und Gruppen-Administrator',
	'ROLE_FORUM_BOT'			=> 'Bot-/Spider-Zugang',
	'ROLE_FORUM_FULL'			=> 'Voller Zugang',
	'ROLE_FORUM_LIMITED'		=> 'Begrenzter Zugang',
	'ROLE_FORUM_LIMITED_POLLS'	=> 'Begrenzter Zugang + Umfragen',
	'ROLE_FORUM_NOACCESS'		=> 'Kein Zugang',
	'ROLE_FORUM_ONQUEUE'		=> 'Mit Warteschlange',
	'ROLE_FORUM_POLLS'			=> 'Standard-Zugang + Umfragen',
	'ROLE_FORUM_READONLY'		=> 'Nur lesender Zugriff',
	'ROLE_FORUM_STANDARD'		=> 'Standard-Zugang',
	'ROLE_FORUM_NEW_MEMBER'		=> 'Zugang für neu registrierte Benutzer',
	'ROLE_MOD_FULL'				=> 'Umfassender Moderator',
	'ROLE_MOD_QUEUE'			=> 'Warteschlangen-Moderator',
	'ROLE_MOD_SIMPLE'			=> 'Einfacher Moderator',
	'ROLE_MOD_STANDARD'			=> 'Standard-Moderator',
	'ROLE_USER_FULL'			=> 'Volle Funktionalität',
	'ROLE_USER_LIMITED'			=> 'Eingeschränkte Funktionalität',
	'ROLE_USER_NOAVATAR'		=> 'Kein Avatar',
	'ROLE_USER_NOPM'			=> 'Keine Privaten Nachrichten',
	'ROLE_USER_STANDARD'		=> 'Standard-Funktionalität',
	'ROLE_USER_NEW_MEMBER'		=> 'Funktionalitäten für neu registrierte Benutzer',

	'ROLE_DESCRIPTION_ADMIN_FORUM'			=> 'Kann auf die Foren-Verwaltung und die Foren-Berechtigungen zugreifen.',
	'ROLE_DESCRIPTION_ADMIN_FULL'			=> 'Hat Zugriff auf alle Administrator-Funktionen des Boards.<br />Verwendung wird nicht empfohlen.',
	'ROLE_DESCRIPTION_ADMIN_STANDARD'		=> 'Hat Zugriff auf die meisten Administrator-Funktionen, kann aber nicht die server- und systemnahen Funktionen nutzen.',
	'ROLE_DESCRIPTION_ADMIN_USERGROUP'		=> 'Kann Gruppen und Benutzer verwalten: kann Rechte und Einstellungen ändern sowie Sperren und Ränge verwalten.',
	'ROLE_DESCRIPTION_FORUM_BOT'			=> 'Diese Einstellung wird für Bots und Spider von Suchmaschinen empfohlen.',
	'ROLE_DESCRIPTION_FORUM_FULL'			=> 'Kann alle Funktionen des Forums benutzen inkl. der Erstellung von Bekanntmachungen und wichtigen Themen. Kann auch die Wartezeit umgehen.<br />Nicht für normale Benutzer empfohlen.',
	'ROLE_DESCRIPTION_FORUM_LIMITED'		=> 'Kann die meisten Forums-Funktionen nutzen, aber keine Dateianhänge erstellen oder Beitrags-Symbole verwenden.',
	'ROLE_DESCRIPTION_FORUM_LIMITED_POLLS'	=> 'Wie „Begrenzter Zugang“, kann aber auch Umfragen erstellen.',
	'ROLE_DESCRIPTION_FORUM_NOACCESS'		=> 'Kann das Forum weder sehen noch darauf zugreifen.',
	'ROLE_DESCRIPTION_FORUM_ONQUEUE'		=> 'Kann die meisten Foren-Funktionen inkl. Dateianhänge nutzen, aber Beiträge und Themen bedürfen der Freigabe durch einen Moderator.',
	'ROLE_DESCRIPTION_FORUM_POLLS'			=> 'Wie „Standard-Zugang“, kann aber auch Umfragen erstellen.',
	'ROLE_DESCRIPTION_FORUM_READONLY'		=> 'Kann das Forum lesen, aber keine neuen Themen oder Antworten erstellen.',
	'ROLE_DESCRIPTION_FORUM_STANDARD'		=> 'Kann die meisten Foren-Funktionen inkl. Dateianhänge nutzen und kann eigene Themen löschen, kann aber keine Umfragen erstellen.',
	'ROLE_DESCRIPTION_FORUM_NEW_MEMBER'		=> 'Eine Rolle für Mitglieder der speziellen Gruppe neu registrierter Benutzer. Enthält <strong>NIE</strong>-Berechtigungen, um Funktionen für neue Benutzer zu sperren.',
	'ROLE_DESCRIPTION_MOD_FULL'				=> 'Kann alle Moderations-Funktionen inkl. der Sperren nutzen.',
	'ROLE_DESCRIPTION_MOD_QUEUE'			=> 'Kann die Moderations-Warteschlange benutzen, um Beiträge zu bestätigen und zu ändern — aber nichts anderes.',
	'ROLE_DESCRIPTION_MOD_SIMPLE'			=> 'Kann nur die themenbezogenen Grundfunktionen nutzen. Kann keine Verwarnungen erteilen oder die Moderations-Warteschlange nutzen.',
	'ROLE_DESCRIPTION_MOD_STANDARD'			=> 'Kann die meisten Moderations-Funktionen nutzen, kann aber keine Benutzer sperren oder den Autor eines Beitrags ändern.',
	'ROLE_DESCRIPTION_USER_FULL'			=> 'Kann alle verfügbaren Benutzer-Funktionen verwenden inkl. der Änderung des Benutzernamens und des Übergehens der Wartezeit.<br />Verwendung wird nicht empfohlen.',
	'ROLE_DESCRIPTION_USER_LIMITED'			=> 'Kann bestimmte Benutzer-Funktionen verwenden. Dateianhänge, E-Mails oder Instant Messages sind nicht erlaubt.',
	'ROLE_DESCRIPTION_USER_NOAVATAR'		=> 'Hat eingeschränkte Rechte und kann keinen Avatar benutzen.',
	'ROLE_DESCRIPTION_USER_NOPM'			=> 'Hat eingeschränkte Rechte und kann keine Privaten Nachrichten benutzen.',
	'ROLE_DESCRIPTION_USER_STANDARD'		=> 'Kann fast alle Benutzer-Funktionen verwenden. Ausgenommen sind z.&nbsp;B. die Änderung des Benutzernames oder das Übergehen der Wartezeit.',
	'ROLE_DESCRIPTION_USER_NEW_MEMBER'		=> 'Eine Rolle für Mitglieder der speziellen Gruppe neu registrierter Benutzer. Enthält <strong>NIE</strong>-Berechtigungen, um Funktionen für neue Benutzer zu sperren.',

	'ROLE_DESCRIPTION_EXPLAIN'		=> 'Du kannst eine kurze Beschreibung angeben, was diese Rolle macht oder für was sie gedacht ist. Der Text, den du hier angibst, wird auch in der Berechtigungs-Verwaltung angezeigt.',
	'ROLE_DESCRIPTION_LONG'			=> 'Die Beschreibung der Rolle ist zu lang. Sie muss weniger als 4000 Zeichen umfassen.',
	'ROLE_DETAILS'					=> 'Details der Rolle',
	'ROLE_EDIT_SUCCESS'				=> 'Rolle erfolgreich geändert.',
	'ROLE_NAME'						=> 'Rollen-Name',
	'ROLE_NAME_ALREADY_EXIST'		=> 'Es existiert bereits eine Rolle mit dem Namen <strong>%s</strong> für diesen Berechtigungs-Typ.',
	'ROLE_NOT_ASSIGNED'				=> 'Rolle wurde bislang nicht zugewiesen.',

	'SELECTED_FORUM_NOT_EXIST'		=> 'Das/Die ausgewählte(n) Forum/Foren existieren nicht.',
	'SELECTED_GROUP_NOT_EXIST'		=> 'Die ausgewählte(n) Gruppe(n) existieren nicht.',
	'SELECTED_USER_NOT_EXIST'		=> 'Der/Die ausgewählte(n) Benutzer existieren nicht.',
	'SELECT_FORUM_SUBFORUM_EXPLAIN'	=> 'Das ausgewählte Forum bezieht auch alle Unterforen in die Auswahl mit ein.',
	'SELECT_ROLE'					=> 'Rolle wählen …',
	'SELECT_TYPE'					=> 'Berechtigungs-Art',
	'SET_PERMISSIONS'				=> 'Berechtigungen festlegen',
	'SET_ROLE_PERMISSIONS'			=> 'Berechtigungen der Rolle definieren',
	'SET_USERS_PERMISSIONS'			=> 'Benutzer-Berechtigungen festlegen',
	'SET_USERS_FORUM_PERMISSIONS'	=> 'Benutzerspezifische Forenrechte festlegen',

	'TRACE_DEFAULT'					=> 'Standardmäßig ist jede Berechtigung auf <strong>NEIN</strong> (nicht definiert), so dass die Berechtigung durch andere Berechtigungen überschrieben werden kann.',
	'TRACE_FOR'								=> 'Verfolgung der Einstellung von',
	'TRACE_GLOBAL_SETTING'					=> '%s (global)',
	'TRACE_GROUP_NEVER_TOTAL_NEVER'	=> 'Die Berechtigung dieser Gruppe ist <strong>NIE</strong> wie das Ergebnis, so dass das alte Ergebnis beibehalten wird.',
	'TRACE_GROUP_NEVER_TOTAL_NEVER_LOCAL'	=> 'Die Berechtigung dieser Gruppe für dieses Forum ist <strong>NIE</strong> wie das Ergebnis, so dass das alte Ergebnis beibehalten wird.',
	'TRACE_GROUP_NEVER_TOTAL_NO'	=> 'Die Berechtigung dieser Gruppe ist <strong>NIE</strong>, was zum neuen Ergebnis wird, weil es bislang nicht definiert (<strong>NEIN</strong>) war.',
	'TRACE_GROUP_NEVER_TOTAL_NO_LOCAL'	=> 'Die Berechtigung dieser Gruppe für dieses Forum ist <strong>NIE</strong>, was zum neuen Ergebnis wird, weil es bislang nicht definiert (<strong>NEIN</strong>) war.',
	'TRACE_GROUP_NEVER_TOTAL_YES'	=> 'Die Berechtigung dieser Gruppe ist <strong>NIE</strong>, was das Ergebnis <strong>JA</strong> für diesen Benutzer mit <strong>NIE</strong> überschreibt.',
	'TRACE_GROUP_NEVER_TOTAL_YES_LOCAL'	=> 'Die Berechtigung dieser Gruppe für dieses Forum ist <strong>NIE</strong>, was das Ergebnis <strong>JA</strong> für diesen Benutzer mit <strong>NIE</strong> überschreibt.',
	'TRACE_GROUP_NO'				=> 'Die Berechtigung dieser Gruppe ist <strong>NEIN</strong>, so dass die alte Berechtigung beibehalten wird.',
	'TRACE_GROUP_NO_LOCAL'			=> 'Die Berechtigung dieser Gruppe für dieses Forum ist <strong>NEIN</strong>, so dass die alte Berechtigung beibehalten wird.',
	'TRACE_GROUP_YES_TOTAL_NEVER'	=> 'Die Berechtigung dieser Gruppe ist <strong>JA</strong>, aber das Ergebnis <strong>NIE</strong> kann nicht überschritten werden.',
	'TRACE_GROUP_YES_TOTAL_NEVER_LOCAL'	=> 'Die Berechtigung dieser Gruppe für dieses Forum ist <strong>JA</strong>, aber das Ergebnis <strong>NIE</strong> kann nicht überschritten werden.',
	'TRACE_GROUP_YES_TOTAL_NO'		=> 'Die Berechtigung dieser Gruppe ist <strong>JA</strong>, was zum neuen Ergebnis wird, weil es bislang nicht definiert (<strong>NEIN</strong>) war.',
	'TRACE_GROUP_YES_TOTAL_NO_LOCAL'	=> 'Die Berechtigung dieser Gruppe für dieses Forum ist <strong>JA</strong>, was zum neuen Ergebnis wird, weil es bislang nicht definiert (<strong>NEIN</strong>) war.',
	'TRACE_GROUP_YES_TOTAL_YES'		=> 'Die Berechtigung dieser Gruppe ist <strong>JA</strong> wie das Ergebnis, so dass das alte Ergebnis beibehalten wird.',
	'TRACE_GROUP_YES_TOTAL_YES_LOCAL'	=> 'Die Berechtigung dieser Gruppe für dieses Forum ist <strong>JA</strong> wie das Ergebnis, so dass das alte Ergebnis beibehalten wird.',
	'TRACE_PERMISSION'						=> 'Einstellung verfolgen — %s',
	'TRACE_RESULT'							=> 'Ergebnis der Verfolgung',
	'TRACE_SETTING'							=> 'Einstellung verfolgen',

	'TRACE_USER_GLOBAL_YES_TOTAL_YES'		=> 'Die forenunabhängigen Benutzerrechte ergeben <strong>JA</strong>, so dass das Ergebnis beibehalten wird. %sVerfolge globale Berechtigung%s',
	'TRACE_USER_GLOBAL_YES_TOTAL_NEVER'		=> 'Die forenunabhängigen Benutzerrechte ergeben <strong>JA</strong>, was das lokale Ergebnis NIE überschreibt. %sVerfolge globale Berechtigung%s',
	'TRACE_USER_GLOBAL_NEVER_TOTAL_KEPT'	=> 'Die forenunabhängigen Benutzerrechte ergeben <strong>NIE</strong>, was das lokale Ergebnis nicht beeinflusst. %sVerfolge globale Berechtigung%s',

	'TRACE_USER_FOUNDER'					=> 'Der Benutzer ist ein Gründer, so dass Administrationsrechte immer auf <strong>JA</strong> gesetzt sind.',
	'TRACE_USER_KEPT'						=> 'Die Berechtigung dieses Benutzers ist <strong>NEIN</strong>, so dass das alte Ergebnis beibehalten wird.',
	'TRACE_USER_KEPT_LOCAL'					=> 'Die Berechtigung dieses Benutzers für dieses Forum ist <strong>NEIN</strong>, so dass das alte Ergebnis beibehalten wird.',
	'TRACE_USER_NEVER_TOTAL_NEVER'			=> 'Die Berechtigung dieses Benutzers ist <strong>NIE</strong> wie das Ergebnis, so dass das alte Ergebnis beibehalten wird.',
	'TRACE_USER_NEVER_TOTAL_NEVER_LOCAL'	=> 'Die Berechtigung dieses Benutzers für dieses Forum ist <strong>NIE</strong> wie das Ergebnis, so dass das alte Ergebnis beibehalten wird.',
	'TRACE_USER_NEVER_TOTAL_NO'				=> 'Die Berechtigung dieses Benutzers ist <strong>NIE</strong>, was zum neuen Ergebnis wird, weil es bislang nicht definiert (<strong>NEIN</strong>) war.',
	'TRACE_USER_NEVER_TOTAL_NO_LOCAL'		=> 'Die Berechtigung dieses Benutzers für dieses Forum ist <strong>NIE</strong>, was zum neuen Ergebnis wird, weil es bislang nicht definiert (<strong>NEIN</strong>) war.',
	'TRACE_USER_NEVER_TOTAL_YES'			=> 'Die Berechtigung dieses Benutzers ist <strong>NIE</strong>, was das Ergebnis <strong>JA</strong> mit <strong>NIE</strong> überschreibt.',
	'TRACE_USER_NEVER_TOTAL_YES_LOCAL'		=> 'Die Berechtigung dieses Benutzers für dieses Forum ist <strong>NIE</strong>, was das Ergebnis <strong>JA</strong> mit <strong>NIE</strong> überschreibt.',
	'TRACE_USER_NO_TOTAL_NO'				=> 'Die Berechtigung dieses Benutzers ist <strong>NEIN</strong> wie das Ergebnis, so dass es zum Standardwert <strong>NIE</strong> wird.',
	'TRACE_USER_NO_TOTAL_NO_LOCAL'			=> 'Die Berechtigung dieses Benutzers für dieses Forum ist <strong>NEIN</strong> wie das Ergebnis, so dass es zum Standardwert <strong>NIE</strong> wird.',
	'TRACE_USER_YES_TOTAL_NEVER'			=> 'Die Berechtigung dieses Benutzers ist <strong>JA</strong>, aber das Ergebnis <strong>NIE</strong> kann nicht überschrieben werden.',
	'TRACE_USER_YES_TOTAL_NEVER_LOCAL'		=> 'Die Berechtigung dieses Benutzers für dieses Forum ist <strong>JA</strong>, aber das Ergebnis <strong>NIE</strong> kann nicht überschrieben werden.',
	'TRACE_USER_YES_TOTAL_NO'				=> 'Die Berechtigung dieses Benutzers ist <strong>JA</strong>, was zum neuen Ergebnis wird, weil es bislang nicht definiert war (<strong>NEIN</strong>).',
	'TRACE_USER_YES_TOTAL_NO_LOCAL'			=> 'Die Berechtigung dieses Benutzers für dieses Forum ist <strong>JA</strong>, was zum neuen Ergebnis wird, weil es bislang nicht definiert war (<strong>NEIN</strong>).',
	'TRACE_USER_YES_TOTAL_YES'				=> 'Die Berechtigung dieses Benutzers ist <strong>JA</strong> wie das Ergebnis, so dass das alte Ergebnis beibehalten wird.',
	'TRACE_USER_YES_TOTAL_YES_LOCAL'		=> 'Die Berechtigung dieses Benutzers für dieses Forum ist <strong>JA</strong> wie das Ergebnis, so dass das alte Ergebnis beibehalten wird.',
	'TRACE_WHO'								=> 'Wer',
	'TRACE_TOTAL'							=> 'Ergebnis',

	'USERS_NOT_ASSIGNED'			=> 'Diese Rolle ist keinem Benutzer zugewiesen.',
	'USER_IS_MEMBER_OF_DEFAULT'		=> 'ist Mitglied folgender Systemgruppen',
	'USER_IS_MEMBER_OF_CUSTOM'		=> 'ist Mitglied folgender benutzerdefinierter Gruppen',

	'VIEW_ASSIGNED_ITEMS'	=> 'Zugeordnete Elemente anzeigen',
	'VIEW_LOCAL_PERMS'		=> 'Lokale Berechtigungen',
	'VIEW_GLOBAL_PERMS'		=> 'Globale Berechtigungen',
	'VIEW_PERMISSIONS'		=> 'Berechtigungen anzeigen',

	'WRONG_PERMISSION_TYPE'				=> 'Falsche Berechtigungs-Art ausgewählt.',
	'WRONG_PERMISSION_SETTING_FORMAT'	=> 'Die Berechtigungs-Einstellungen sind in einem fehlerhaften Format, phpBB kann sie nicht verarbeiten.',
));
