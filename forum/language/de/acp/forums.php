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

// Forum Admin
$lang = array_merge($lang, array(
	'AUTO_PRUNE_DAYS'			=> 'Seit dem letzten Beitrag vergangene Tage',
	'AUTO_PRUNE_DAYS_EXPLAIN'	=> 'Die Anzahl der Tage seit dem letzten Beitrag, nach denen das Thema gelöscht wird.',
	'AUTO_PRUNE_FREQ'			=> 'Prüfungsintervall für automatisches Löschen',
	'AUTO_PRUNE_FREQ_EXPLAIN'	=> 'Das Intervall, in dem nach automatisch zu löschenden Themen gesucht wird.',
	'AUTO_PRUNE_VIEWED'			=> 'Seit dem letzten Zugriff vergangene Tage',
	'AUTO_PRUNE_VIEWED_EXPLAIN'	=> 'Die Anzahl der Tage seit dem letzten Zugriff auf das Thema, nach denen es entfernt wird.',
	'AUTO_PRUNE_SHADOW_FREQ'	=> 'Prüfungsintervall für automatisches Löschen von Links zu verschobenen Themen',
	'AUTO_PRUNE_SHADOW_DAYS'	=> 'Seit dem Verschieben des Themas vergangene Tage',
	'AUTO_PRUNE_SHADOW_DAYS_EXPLAIN'	=> 'Die Anzahl der Tage seit dem Verschieben eines Themas, nach denen der Link auf das verschobene Thema im alten Forum gelöscht wird.',
	'AUTO_PRUNE_SHADOW_FREQ_EXPLAIN'	=> 'Das Intervall, in dem nach automatisch zu löschenden Links zu verschobenen Themen gesucht wird.',

	'CONTINUE'						=> 'Fortsetzen',
	'COPY_PERMISSIONS'				=> 'Kopiere Berechtigungen von',
	'COPY_PERMISSIONS_EXPLAIN'		=> 'Um die Konfiguration deines neuen Forums zu erleichtern, kannst du die Berechtigungen eines bestehenden Forums kopieren.',
	'COPY_PERMISSIONS_ADD_EXPLAIN'	=> 'Sobald das Forum erstellt ist, wird es dieselben Berechtigungen haben wie das hier ausgewählte Forum. Wenn hier kein Forum gewählt wird, wird das neue Forum unsichtbar bleiben, bis entsprechende Berechtigungen gesetzt wurden.',
	'COPY_PERMISSIONS_EDIT_EXPLAIN'	=> 'Wenn du dich entscheidest, Berechtigungen zu kopieren, wird das Forum dieselben Berechtigungen haben wie das von dir hier ausgewählte. Dadurch werden alle Berechtigungen, die du vorher für dieses Forum gesetzt hast, durch die des ausgewählten Forums ersetzt. Wenn kein Forum gewählt wird, werden die derzeitigen Berechtigungen beibehalten.',
	'COPY_TO_ACL'					=> 'Alternativ kannst du auch %sneue Berechtigungen%s für dieses Forum einrichten.',
	'CREATE_FORUM'					=> 'Neues Forum erstellen',

	'DECIDE_MOVE_DELETE_CONTENT'		=> 'Lösche die Inhalte oder verschieb sie in ein anderes Forum',
	'DECIDE_MOVE_DELETE_SUBFORUMS'		=> 'Lösche die Unterforen oder verschiebe sie in ein anderes Forum',
	'DEFAULT_STYLE'						=> 'Standard-Style',
	'DELETE_ALL_POSTS'					=> 'Lösche Beiträge',
	'DELETE_SUBFORUMS'					=> 'Lösche Unterforen und Beiträge',
	'DISPLAY_ACTIVE_TOPICS'				=> 'Aktive Themen aktivieren',
	'DISPLAY_ACTIVE_TOPICS_EXPLAIN'		=> 'Wenn diese Einstellung auf „Ja“ gesetzt wird, werden aktive Themen der gewählten Unterforen unter dieser Kategorie angezeigt.',

	'EDIT_FORUM'					=> 'Forum bearbeiten',
	'ENABLE_INDEXING'				=> 'Such-Indizierung aktivieren',
	'ENABLE_INDEXING_EXPLAIN'		=> 'Wenn diese Einstellung auf „Ja“ gesetzt wird, werden Beiträge in diesem Forum für die Suche indiziert.',
	'ENABLE_POST_REVIEW'			=> 'Prüfung auf neue Beiträge aktivieren',
	'ENABLE_POST_REVIEW_EXPLAIN'	=> 'Wenn diese Einstellung auf „Ja“ gesetzt wird, können die Benutzer ihren Beitrag überprüfen und ggf. anpassen, falls während des Schreibens ein neuer Beitrag zum Thema erstellt wurde. Dies sollte für Chat-Foren deaktiviert sein.',
	'ENABLE_QUICK_REPLY'			=> 'Schnellantwort aktivieren',
	'ENABLE_QUICK_REPLY_EXPLAIN'	=> 'Aktiviert die Schnellantwort in diesem Forum. Diese Einstellung wird nicht berücksichtigt, wenn die Schnellantwort im gesamten Board deaktiviert wurde. Die Schnellantwort wird nur Benutzern angezeigt, die in dem Forum Antworten erstellen dürfen.',
	'ENABLE_RECENT'					=> 'In aktiven Themen anzeigen',
	'ENABLE_RECENT_EXPLAIN'			=> 'Wenn diese Einstellung auf „Ja“ gesetzt wird, werden Themen aus diesem Forum in der Liste der aktiven Themen angezeigt.',
	'ENABLE_TOPIC_ICONS'			=> 'Themen-Symbole aktivieren',

	'FORUM_ADMIN'						=> 'Foren-Administration',
	'FORUM_ADMIN_EXPLAIN'				=> 'In phpBB3 ist alles forenbasiert. Eine Kategorie ist hier nur eine spezielle Art von Forum. Jedes Forum kann eine unbegrenzte Anzahl von Unterforen haben und du kannst festlegen, ob in ihnen Beiträge geschrieben werden dürfen oder nicht (dann verhält es sich wie eine Kategorie). Hier kannst du Foren hinzufügen, bearbeiten, löschen, schließen und wieder öffnen wie auch zusätzliche Kontrollfunktionen einstellen. Wenn deine Beitrags- und Themeninformationen nicht mehr synchron sind, kannst du das Forum auch resynchronisieren. <strong>Du musst passende Berechtigungen erstellen oder kopieren, damit ein neu erstelltes Forum auch angezeigt wird.</strong>',
	'FORUM_AUTO_PRUNE'					=> 'Automatisches Löschen inaktiver Themen aktivieren',
	'FORUM_AUTO_PRUNE_EXPLAIN'			=> 'Löscht inaktive Themen des Forums automatisch, wenn sie den folgenden Kriterien entsprechen.',
	'FORUM_CREATED'						=> 'Forum wurde erfolgreich erstellt.',
	'FORUM_DATA_NEGATIVE'				=> 'Die Parameter zum automatischen Löschen dürfen nicht negativ sein.',
	'FORUM_DESC_TOO_LONG'				=> 'Die Beschreibung des Forums ist zu lang. Sie muss weniger als 4000 Zeichen umfassen.',
	'FORUM_DELETE'						=> 'Forum löschen',
	'FORUM_DELETE_EXPLAIN'				=> 'Das folgende Formular erlaubt dir, ein Forum zu löschen. Wenn in dem Forum Beiträge erstellt werden können, kannst du entscheiden, was mit den darin enthaltenen Themen (oder Foren) geschehen soll.',
	'FORUM_DELETED'						=> 'Forum wurde erfolgreich gelöscht.',
	'FORUM_DESC'						=> 'Beschreibung',
	'FORUM_DESC_EXPLAIN'				=> 'Eine Verwendung von HTML-Auszeichnungen ist nicht möglich. Wenn als Forum-Typ „Kategorie“ ausgewählt ist, wird die Beschreibung nicht verwendet.',
	'FORUM_EDIT_EXPLAIN'				=> 'Das unten stehende Formular erlaubt dir, dieses Forum individuell anzupassen. Beachte bitte, dass Moderations- und Beitragszähler-Einstellungen über die Foren-Berechtigungen für jeden Benutzer oder jede Benutzergruppe gesetzt werden.',
	'FORUM_IMAGE'						=> 'Forum-Bild',
	'FORUM_IMAGE_EXPLAIN'				=> 'Der Ort eines Bildes, relativ zum phpBB-Hauptverzeichnis, das diesem Forum zusätzlich zugeordnet werden soll.',
	'FORUM_IMAGE_NO_EXIST'				=> 'Das angegebene Forum-Bild existiert nicht',
	'FORUM_LINK_EXPLAIN'				=> 'Die vollständige URL (einschließlich des Protokolls, bspw. <samp>http://</samp>) der Seite, zu der die Benutzer gelangen sollen, wenn sie auf dieses Forum klicken. Beispielsweise: <samp>http://www.phpbb.com/</samp>',
	'FORUM_LINK_TRACK'					=> 'Verfolge Link-Weiterleitungen',
	'FORUM_LINK_TRACK_EXPLAIN'			=> 'Hält die Anzahl fest, wie oft ein Forum-Link aufgerufen wurde.',
	'FORUM_NAME'						=> 'Name des Forums',
	'FORUM_NAME_EMPTY'					=> 'Du musst einen Namen für dieses Forum angeben.',
	'FORUM_NAME_EMOJI'					=> 'Der Name des Forums, den du eingegeben hast, ist ungültig.<br>Er enthält die folgenden nicht unterstützten Zeichen:<br>%s',
	'FORUM_PARENT'						=> 'Übergeordnetes Forum',
	'FORUM_PASSWORD'					=> 'Forum-Passwort',
	'FORUM_PASSWORD_CONFIRM'			=> 'Forum-Passwort bestätigen',
	'FORUM_PASSWORD_CONFIRM_EXPLAIN'	=> 'Muss nur ausgefüllt werden, wenn ein Forum-Passwort vergeben wird.',
	'FORUM_PASSWORD_EXPLAIN'			=> 'Definiert ein Passwort für dieses Forum. Es wird empfohlen, vorzugsweise das Berechtigungs-System zu nutzen.',
	'FORUM_PASSWORD_UNSET'				=> 'Forum-Passwort entfernen',
	'FORUM_PASSWORD_UNSET_EXPLAIN'		=> 'Aktiviere diese Option, wenn du das Forum-Passwort entfernen möchtest.',
	'FORUM_PASSWORD_OLD'				=> 'Das Forum-Passwort nutzt eine veraltete Hash-Methode und sollte geändert werden.',
	'FORUM_PASSWORD_MISMATCH'			=> 'Die angegebenen Passwörter stimmten nicht überein.',
	'FORUM_PRUNE_SETTINGS'				=> 'Einstellungen zum automatischen Löschen',
	'FORUM_PRUNE_SHADOW'				=> 'Automatisches Löschen von Links zu verschobenen Themen',
	'FORUM_PRUNE_SHADOW_EXPLAIN'			=> 'Löscht Links zu verschobenen Themen aus dem Forum. Die Einstellungen für Häufigkeit und Alter legst du unten fest.',
	'FORUM_RESYNCED'					=> 'Forum „%s“ wurde erfolgreich resynchronisiert',
	'FORUM_RULES_EXPLAIN'				=> 'Die Forumsregeln werden auf allen Seiten innerhalb des jeweiligen Forums angezeigt.',
	'FORUM_RULES_LINK'					=> 'Link zu den Forumsregeln',
	'FORUM_RULES_LINK_EXPLAIN'			=> 'Du kannst hier die URL einer Seite oder eines Beitrags angeben, die/der deine Forumsregeln enthält. Diese Einstellung wird den eingegebenen Text der Forumsregeln überschreiben.',
	'FORUM_RULES_PREVIEW'				=> 'Vorschau der Forumsregeln',
	'FORUM_RULES_TOO_LONG'				=> 'Die Forumsregeln sind zu lang. Sie müssen weniger als 4000 Zeichen umfassen.',
	'FORUM_SETTINGS'					=> 'Forumseinstellungen',
	'FORUM_STATUS'						=> 'Forum-Status',
	'FORUM_STYLE'						=> 'Forum-Style',
	'FORUM_TOPICS_PAGE'					=> 'Themen pro Seite',
	'FORUM_TOPICS_PAGE_EXPLAIN'			=> 'Wenn dieser Wert nicht 0 ist, wird er die Standard-Einstellung für die Themen pro Seite überschreiben.',
	'FORUM_TYPE'						=> 'Forum-Typ',
	'FORUM_UPDATED'						=> 'Forumseinstellungen erfolgreich aktualisiert.',

	'FORUM_WITH_SUBFORUMS_NOT_TO_LINK'		=> 'Du möchtest ein Forum mit Unterforen in einen Link umwandeln. Bitte verschiebe alle Unterforen aus diesem Forum, bevor du fortfährst, da du nach der Umwandlung in einen Link die Unterforen dieses Forums nicht länger sehen kannst.',

	'GENERAL_FORUM_SETTINGS'	=> 'Allgemeine Forumseinstellungen',

	'LINK'						=> 'Link',
	'LIMIT_SUBFORUMS'			=> 'Beschränke die Legende auf die direkten Unterforen',
	'LIMIT_SUBFORUMS_EXPLAIN'	=> 'Beschränkt die angezeigten Unterforen auf die direkten Kinder des jeweiligen Forums. Kindeskinder werden nicht angezeigt. Ist diese Einstellung deaktiviert, so werden alle Unterforen unabhängig von deren Verschachtelungstiefe angezeigt, bei denen die Option „Unterforen in Legende aufführen“ aktiviert ist.',
	'LIST_INDEX'				=> 'Führe Unterforum in der Legende des übergeordneten Forums auf',
	'LIST_INDEX_EXPLAIN'		=> 'Zeigt einen Link zu diesem Forum in der Legende des übergeordneten Forums an, wenn dort die Option „Unterforen in Legende aufführen“ aktiviert ist.',
	'LIST_SUBFORUMS'			=> 'Unterforen in Legende aufführen',
	'LIST_SUBFORUMS_EXPLAIN'	=> 'Führt die Unterforen, bei denen die Option „Führe Unterforum in der Legende des übergeordneten Forums auf“ aktiviert ist, in der Legende dieses Forums in der Foren-Übersicht und anderswo auf.',
	'LOCKED'					=> 'Gesperrt',

	'MOVE_POSTS_NO_POSTABLE_FORUM'	=> 'Das ausgewählte Forum kann keine Beiträge aufnehmen. Bitte wähle ein Forum aus, das Beiträge aufnehmen kann.',
	'MOVE_POSTS_TO'					=> 'Beiträge verschieben nach',
	'MOVE_SUBFORUMS_TO'				=> 'Unterforen verschieben nach',

	'NO_DESTINATION_FORUM'			=> 'Du hast kein Forum angegeben, zu dem der Inhalt verschoben werden soll.',
	'NO_FORUM_ACTION'				=> 'Keine Aktion für den Inhalt des Forums festgelegt.',
	'NO_PARENT'						=> 'Kein übergeordnetes',
	'NO_PERMISSIONS'				=> 'Berechtigungen nicht kopieren',
	'NO_PERMISSION_FORUM_ADD'		=> 'Du hast nicht die erforderlichen Berechtigungen, um Foren hinzuzufügen.',
	'NO_PERMISSION_FORUM_DELETE'	=> 'Du hast nicht die erforderlichen Berechtigungen, um Foren zu löschen.',

	'PARENT_IS_LINK_FORUM'		=> 'Das übergeordnete Forum, das du ausgewählt hast, ist ein Forums-Link. Ein Forums-Link kann keine Unterforen enthalten. Bitte wähle ein Forum oder eine Kategorie als übergeordnetes Forum aus.',
	'PARENT_NOT_EXIST'			=> 'Übergeordnetes Forum existiert nicht.',
	'PRUNE_ANNOUNCEMENTS'		=> 'Bekanntmachungen automatisch löschen',
	'PRUNE_STICKY'				=> 'Wichtige Themen automatisch löschen',
	'PRUNE_OLD_POLLS'			=> 'Abgeschlossene Umfragen automatisch löschen',
	'PRUNE_OLD_POLLS_EXPLAIN'	=> 'Löscht Themen mit Umfragen, in denen im angegebenen Zeitraum keine Abstimmung erfolgte.',

	'REDIRECT_ACL'	=> 'Nun kannst du für dieses Forum %sBerechtigungen vergeben%s.',

	'SYNC_IN_PROGRESS'			=> 'Synchronisiere Foren',
	'SYNC_IN_PROGRESS_EXPLAIN'	=> 'Es wird Thema %1$d von %2$d synchronisiert.',

	'TYPE_CAT'			=> 'Kategorie',
	'TYPE_FORUM'		=> 'Forum',
	'TYPE_LINK'			=> 'Link',

	'UNLOCKED'			=> 'Entsperrt',
));
