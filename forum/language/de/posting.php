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
	'ADD_ATTACHMENT'			=> 'Dateianhang hochladen',
	'ADD_ATTACHMENT_EXPLAIN'	=> 'Wenn du eine Datei oder mehrere Dateien anhängen möchtest, gib die Details unten ein.',
	'ADD_FILE'					=> 'Datei hinzufügen',
	'ADD_POLL'					=> 'Umfrage erstellen',
	'ADD_POLL_EXPLAIN'			=> 'Wenn du zu dem Thema keine Umfrage hinzufügen möchtest, lass die Felder einfach leer.',
	'ALREADY_DELETED'			=> 'Diese Nachricht wurde bereits gelöscht.',
	'ATTACH_COMMENT_NO_EMOJIS'	=> 'Der Kommentar für den Dateianhang enthält nicht zulässige Zeichen (Emoji).',
	'ATTACH_DISK_FULL'			=> 'Es steht nicht genügend Speicherplatz zur Verfügung, um diesen Anhang zu veröffentlichen.',
	'ATTACH_QUOTA_REACHED'		=> 'Das Kontingent für Dateianhänge ist bereits vollständig ausgenutzt.',
	'ATTACH_SIG'				=> 'Signatur anhängen (die Signatur kann im persönlichen Bereich geändert werden)',

	'BBCODE_A_HELP'				=> 'Eingebetteter Dateianhang: [attachment=]dateiname.erw[/attachment]',
	'BBCODE_B_HELP'				=> 'Fett: [b]Text[/b]',
	'BBCODE_C_HELP'				=> 'Code anzeigen: [code]Code[/code]',
	'BBCODE_D_HELP'				=> 'Flash: [flash=Breite,Höhe]http://url[/flash]',
	'BBCODE_F_HELP'				=> 'Schriftgröße: [size=85]kleiner Text[/size]',
	'BBCODE_IS_OFF'				=> '%sBBCode%s ist <em>ausgeschaltet</em>',
	'BBCODE_IS_ON'				=> '%sBBCode%s ist <em>eingeschaltet</em>',
	'BBCODE_I_HELP'				=> 'Kursiv: [i]Text[/i]',
	'BBCODE_L_HELP'				=> 'Aufzählung: [list][*]Text[/list]',
	'BBCODE_LISTITEM_HELP'		=> 'Listeneintrag: [*]Text',
	'BBCODE_O_HELP'				=> 'Geordnete Aufzählung: z.&nbsp;B. [list=1][*]Erster Punkt[/list] oder [list=a][*]Punkt a[/list]',
	'BBCODE_P_HELP'				=> 'Bild einfügen: [img]http://bild_url[/img]',
	'BBCODE_Q_HELP'				=> 'Zitat: [quote]Text[/quote]',
	'BBCODE_S_HELP'				=> 'Schriftfarbe: [color=red]Text[/color] oder [color=#FF0000]Text[/color]',
	'BBCODE_U_HELP'				=> 'Unterstrichen: [u]Text[/u]',
	'BBCODE_W_HELP'				=> 'Link einfügen: [url]http://url[/url] oder [url=http://url]Linktext[/url]',
	'BBCODE_Y_HELP'				=> 'Aufzählung: Listenelement hinzufügen',
	'BUMP_ERROR'				=> 'Du kannst dieses Thema nicht so kurz nach dem letzten Beitrag als neu markieren.',

	'CANNOT_DELETE_REPLIED'		=> 'Du kannst nur Themen löschen, auf die noch nicht geantwortet wurde.',
	'CANNOT_EDIT_POST_LOCKED'	=> 'Dieser Beitrag wurde gesperrt, daher kannst du ihn nicht mehr bearbeiten.',
	'CANNOT_EDIT_TIME'			=> 'Du kannst diesen Beitrag nicht mehr ändern oder löschen.',
	'CANNOT_POST_ANNOUNCE'		=> 'Du darfst keine Bekanntmachungen erstellen.',
	'CANNOT_POST_STICKY'		=> 'Du darfst keine wichtigen Themen erstellen.',
	'CHANGE_TOPIC_TO'			=> 'Art des Themas ändern zu',
	'CHARS_POST_CONTAINS'		=> array(
		1	=> 'Dein Beitrag besteht aus %1$d Zeichen.',
		2	=> 'Dein Beitrag besteht aus %1$d Zeichen.',
	),
	'CHARS_SIG_CONTAINS'		=> array(
		1	=> 'Deine Signatur besteht aus %1$d Zeichen.',
		2	=> 'Deine Signatur besteht aus %1$d Zeichen.',
	),
	'CLOSE_TAGS'				=> 'Tags schließen',
	'CURRENT_TOPIC'				=> 'Derzeitiges Thema',

	'DELETE_FILE'				=> 'Datei löschen',
	'DELETE_MESSAGE'			=> 'Nachricht löschen',
	'DELETE_MESSAGE_CONFIRM'	=> 'Bist du dir sicher, dass du diese Nachricht löschen möchtest?',
	'DELETE_OWN_POSTS'			=> 'Du kannst nur deine eigenen Beiträge löschen.',
	'DELETE_PERMANENTLY'		=> 'Endgültig löschen',
	'DELETE_POST_CONFIRM'		=> 'Bist du dir sicher, dass du diesen Beitrag löschen möchtest?',
	'DELETE_POST_PERMANENTLY_CONFIRM'	=> 'Bist du dir sicher, dass du diesen Beitrag <strong>endgültig</strong> löschen möchtest?',
	'DELETE_POST_PERMANENTLY'	=> array(
		1	=> 'Diesen Beitrag endgültig löschen, so dass er nicht wiederhergestellt werden kann.',
		2	=> 'Diese %1$d Beiträge endgültig löschen, so dass sie nicht wiederhergestellt werden können.',
	),
	'DELETE_POSTS_CONFIRM'		=> 'Bist du dir sicher, dass du diese Beiträge löschen möchtest?',
	'DELETE_POSTS_PERMANENTLY_CONFIRM'	=> 'Bist du dir sicher, dass du diese Beiträge <strong>endgültig</strong> löschen möchtest?',
	'DELETE_REASON'				=> 'Begründung für Löschung',
	'DELETE_REASON_EXPLAIN'		=> 'Moderatoren können die für die Löschung angegebene Begründung lesen.',
	'DELETE_POST_WARN'			=> 'Diesen Beitrag löschen',
	'DELETE_TOPIC_CONFIRM'		=> 'Bist du dir sicher, dass du dieses Thema löschen möchtest?',
	'DELETE_TOPIC_PERMANENTLY'	=> array(
		1	=> 'Dieses Thema endgültig löschen, so dass es nicht wiederhergestellt werden kann.',
		2	=> 'Diese %1$d Themen endgültig löschen, so dass sie nicht wiederhergestellt werden können.',
	),
	'DELETE_TOPIC_PERMANENTLY_CONFIRM'	=> 'Bist du dir sicher, dass du dieses Theme <strong>endgültig</strong> löschen möchtest?',
	'DELETE_TOPICS_CONFIRM'		=> 'Bist du dir sicher, dass du diese Themen löschen möchtest?',
	'DELETE_TOPICS_PERMANENTLY_CONFIRM'	=> 'Bist du dir sicher, dass du diese Themen <strong>endgültig</strong> löschen möchtest?',
	'DISABLE_BBCODE'			=> 'BBCode ausschalten',
	'DISABLE_MAGIC_URL'			=> 'URLs nicht automatisch verlinken',
	'DISABLE_SMILIES'			=> 'Smileys ausschalten',
	'DISALLOWED_CONTENT'		=> 'Die hochgeladene Datei wurde abgewiesen, da sie als möglicher Angriffsversuch identifiziert wurde.',
	'DISALLOWED_EXTENSION'		=> 'Die Dateierweiterung %s ist nicht erlaubt.',
	'DRAFT_LOADED'				=> 'Der Entwurf wurde in das Formular geladen. Du kannst deinen Beitrag nun abschließen.<br />Der Entwurf wird nach dem Absenden des Beitrags gelöscht.',
	'DRAFT_LOADED_PM'			=> 'Der Entwurf wurde in das Formular geladen. Du kannst deine Private Nachricht nun abschließen.<br />Der Entwurf wird nach dem Absenden der Privaten Nachricht gelöscht.',
	'DRAFT_SAVED'				=> 'Entwurf erfolgreich gespeichert.',
	'DRAFT_TITLE'				=> 'Entwurfstitel',

	'EDIT_REASON'				=> 'Grund für die Bearbeitung dieses Beitrags',
	'EMPTY_FILEUPLOAD'			=> 'Die hochgeladene Datei ist leer.',
	'EMPTY_MESSAGE'				=> 'Du musst zu deinem Beitrag eine Nachricht eingeben.',
	'EMPTY_REMOTE_DATA'			=> 'Die Datei konnte nicht hochgeladen werden. Bitte lade sie manuell hoch.',

	'FLASH_IS_OFF'				=> '[flash] ist <em>ausgeschaltet</em>',
	'FLASH_IS_ON'				=> '[flash] ist <em>eingeschaltet</em>',
	'FLOOD_ERROR'				=> 'Du kannst einen Beitrag nicht so schnell nach deinem letzten schreiben.',
	'FONT_COLOR'				=> 'Schriftfarbe',
	'FONT_COLOR_HIDE'			=> 'Schriftfarbe ausblenden',
	'FONT_HUGE'					=> 'Riesig',
	'FONT_LARGE'				=> 'Groß',
	'FONT_NORMAL'				=> 'Normal',
	'FONT_SIZE'					=> 'Schriftgröße',
	'FONT_SMALL'				=> 'Klein',
	'FONT_TINY'					=> 'Sehr klein',

	'GENERAL_UPLOAD_ERROR'		=> 'Konnte Dateianhang nicht nach %s hochladen.',

	'IMAGES_ARE_OFF'			=> '[img] ist <em>ausgeschaltet</em>',
	'IMAGES_ARE_ON'				=> '[img] ist <em>eingeschaltet</em>',
	'INVALID_FILENAME'			=> '%s ist ein ungültiger Dateiname.',

	'LOAD'						=> 'Laden',
	'LOAD_DRAFT'				=> 'Entwurf laden',
	'LOAD_DRAFT_EXPLAIN'		=> 'Hier kannst du den Entwurf auswählen, mit dessen Erstellung du fortfahren möchtest. Dein derzeitiger Beitrag wird abgebrochen und die Inhalte der Eingabefelder gelöscht. In deinem persönlichen Bereich kannst du Entwürfe ansehen, bearbeiten oder löschen.',
	'LOGIN_EXPLAIN_BUMP'		=> 'Du musst dich anmelden, um in diesem Forum Themen als neu zu markieren.',
	'LOGIN_EXPLAIN_DELETE'		=> 'Du musst dich anmelden, um in diesem Forum Beiträge zu löschen.',
	'LOGIN_EXPLAIN_SOFT_DELETE'	=> 'Du musst dich anmelden, um in diesem Forum Beiträge als gelöscht zu markieren.',
	'LOGIN_EXPLAIN_POST'		=> 'Du musst dich anmelden, um in diesem Forum Beiträge zu schreiben.',
	'LOGIN_EXPLAIN_QUOTE'		=> 'Du musst dich anmelden, um in diesem Forum Beiträge zu zitieren.',
	'LOGIN_EXPLAIN_REPLY'		=> 'Du musst dich anmelden, um in diesem Forum auf Beiträge zu antworten.',

	'MAX_ATTACHMENT_FILESIZE'	=> 'Maximale Dateigröße pro Anhang: %s.',
	'MAX_FONT_SIZE_EXCEEDED'	=> 'Die Schriftgröße darf maximal %d betragen.',
	'MAX_FLASH_HEIGHT_EXCEEDED'	=> array(
		1	=> 'Deine Flash-Dateien dürfen maximal %1$d Pixel hoch sein.',
		2	=> 'Deine Flash-Dateien dürfen maximal %1$d Pixel hoch sein.',
	),
	'MAX_FLASH_WIDTH_EXCEEDED'	=> array(
		1	=> 'Deine Flash-Dateien dürfen maximal %1$d Pixel breit sein.',
		2	=> 'Deine Flash-Dateien dürfen maximal %1$d Pixel breit sein.',
	),
	'MAX_IMG_HEIGHT_EXCEEDED'	=> array(
		1	=> 'Deine Bilder dürfen maximal %1$d Pixel hoch sein.',
		2	=> 'Deine Bilder dürfen maximal %1$d Pixel hoch sein.',
	),
	'MAX_IMG_WIDTH_EXCEEDED'	=> array(
		1	=> 'Deine Bilder dürfen maximal %1$d Pixel breit sein.',
		2	=> 'Deine Bilder dürfen maximal %1$d Pixel breit sein.',
	),

	'MESSAGE_BODY_EXPLAIN'		=> array(
		0	=> '', // zero means no limit, so we don't view a message here.
		1	=> 'Gib deine Nachricht hier ein. Sie darf nicht mehr als <strong>%d</strong> Zeichen enthalten.',
		2	=> 'Gib deine Nachricht hier ein. Sie darf nicht mehr als <strong>%d</strong> Zeichen enthalten.',
	),
	'MESSAGE_DELETED'			=> 'Der Beitrag wurde erfolgreich gelöscht.',
	'MORE_SMILIES'				=> 'Mehr Smileys anzeigen',

	'NOTIFY_REPLY'				=> 'Mich benachrichtigen, sobald eine Antwort geschrieben wurde',
	'NOT_UPLOADED'				=> 'Datei konnte nicht hochgeladen werden.',
	'NO_DELETE_POLL_OPTIONS'	=> 'Du kannst keine bestehenden Umfrageoptionen löschen.',
	'NO_PM_ICON'				=> 'Kein PN-Symbol',
	'NO_POLL_TITLE'				=> 'Du musst einen Umfragentitel angeben.',
	'NO_POST'					=> 'Die angeforderte Nachricht existiert nicht.',
	'NO_POST_MODE'				=> 'Kein Eintragsmodus gewählt.',
	'NO_TEMP_DIR'				=> 'Der temporäre Ordner konnte nicht gefunden werden oder ist nicht beschreibbar.',

	'PARTIAL_UPLOAD'			=> 'Die Datei wurde nur teilweise hochgeladen.',
	'PHP_UPLOAD_STOPPED'		=> 'Eine PHP-Erweiterung hat den Hochlade-Vorgang unterbrochen.',
	'PHP_SIZE_NA'				=> 'Der Dateianhang ist zu groß.<br />Die durch PHP in der php.ini festgelegte maximale Größe konnte nicht ermittelt werden.',
	'PHP_SIZE_OVERRUN'			=> 'Der Dateianhang ist zu groß, er darf maximal %1$d %2$s groß sein.<br />Dieser Wert ist in der php.ini festgelegt und kann nicht überschrieben werden.',
	'PLACE_INLINE'				=> 'Im Beitrag anzeigen',
	'POLL_DELETE'				=> 'Umfrage löschen',
	'POLL_FOR'					=> 'Umfrage durchführen für',
	'POLL_FOR_EXPLAIN'			=> 'Diese Umfrage endet nie, wenn 0 als Wert eingestellt wird.',
	'POLL_MAX_OPTIONS'			=> 'Auswahlmöglichkeiten pro Benutzer',
	'POLL_MAX_OPTIONS_EXPLAIN'	=> 'Diese Anzahl von Optionen kann ein Benutzer maximal auswählen.',
	'POLL_OPTIONS'				=> 'Antworten der Umfrage',
	'POLL_OPTIONS_EXPLAIN'		=> array(
		1	=> 'Gib jede Antwort in einer separaten Zeile ein. Du kannst <strong>eine</strong> Antwortmöglichkeit angeben.',
		2	=> 'Gib jede Antwort in einer separaten Zeile ein. Du kannst bis zu <strong>%d</strong> Antwortmöglichkeiten angeben.',
	),
	'POLL_OPTIONS_EDIT_EXPLAIN'		=> array(
		1	=> 'Gib jede Antwort in einer separaten Zeile ein. Du kannst <strong>eine</strong> Antwortmöglichkeit angeben. Wenn du Optionen entfernst oder hinzufügst, werden alle vorherigen Abstimmungen zurückgesetzt.',
		2	=> 'Gib jede Antwort in einer separaten Zeile ein. Du kannst bis zu <strong>%d</strong> Antwortmöglichkeiten angeben. Wenn du Optionen entfernst oder hinzufügst, werden alle vorherigen Abstimmungen zurückgesetzt.',
	),
	'POLL_QUESTION'				=> 'Frage',
	'POLL_TITLE_TOO_LONG'		=> 'Die Frage der Umfrage muss weniger als 100 Zeichen enthalten.',
	'POLL_TITLE_COMP_TOO_LONG'	=> 'Die umgesetzte Größe deiner Frage ist zu lang. Entferne ggf. BBCode oder Smileys.',
	'POLL_VOTE_CHANGE'			=> 'Ändern der Abstimmung erlauben',
	'POLL_VOTE_CHANGE_EXPLAIN'	=> 'Wenn diese Option aktiviert ist, kann ein Benutzer seine Antwort später nochmals ändern',
	'POSTED_ATTACHMENTS'		=> 'Angehängte Dateien',
	'POST_APPROVAL_NOTIFY'		=> 'Du wirst informiert, sobald dein Beitrag freigegeben wurde.',
	'POST_CONFIRMATION'			=> 'Bestätigung des Beitrags',
	'POST_CONFIRM_EXPLAIN'		=> 'Um automatisch verfasste Beiträge zu verhindern, musst du einen Bestätigungscode eingeben. Den Code siehst du im folgenden Bild. Wenn du nur über ein eingeschränktes Sehvermögen verfügst oder aus einem anderen Grund den Code nicht lesen kannst, kontaktiere bitte die %sBoard-Administration%s.',
	'POST_DELETED'				=> 'Der Beitrag wurde erfolgreich gelöscht.',
	'POST_EDITED'				=> 'Der Beitrag wurde erfolgreich bearbeitet.',
	'POST_EDITED_MOD'			=> 'Der Beitrag wurde erfolgreich bearbeitet. Er muss jedoch erst von einem Moderator freigegeben werden, bevor er öffentlich einsehbar ist.',
	'POST_GLOBAL'				=> 'Globale Bekanntmachung',
	'POST_ICON'					=> 'Beitrags-Symbol',
	'POST_NORMAL'				=> 'Normal',
	'POST_REVIEW'				=> 'Neue Beiträge im Thema',
	'POST_REVIEW_EDIT'			=> 'Geänderter Beitrag',
	'POST_REVIEW_EDIT_EXPLAIN'	=> 'Dieser Beitrag wurde von einem anderen Benutzer geändert, während du ihn bearbeitet hast. Du kannst deine Änderungen überprüfen und sie gegebenenfalls anpassen.',
	'POST_REVIEW_EXPLAIN'		=> 'In dem Thema wurde in der Zwischenzeit mindestens ein neuer Beitrag erstellt. Du kannst deinen Beitrag überprüfen und ihn gegebenenfalls anpassen.',
	'POST_STORED'				=> 'Der Beitrag wurde erfolgreich gespeichert.',
	'POST_STORED_MOD'			=> 'Der Beitrag wurde erfolgreich gespeichert. Er muss jedoch erst von einem Moderator freigegeben werden, bevor er öffentlich einsehbar ist.',
	'POST_TOPIC_AS'				=> 'Thema schreiben als',
	'PROGRESS_BAR'				=> 'Statusanzeige',

	'QUOTE_DEPTH_EXCEEDED'		=> array(
		1	=> 'Es kann maximal %d Zitat ineinander verschachtelt werden.', // Wird nicht verwendet - stattdessen erscheint QUOTE_NO_NESTING
		2	=> 'Es können maximal %d Zitate ineinander verschachtelt werden.',
	),
	'QUOTE_NO_NESTING'			=> 'Du kannst Zitate nicht ineinander verschachteln.',

	'REMOTE_UPLOAD_TIMEOUT'		=> 'Die ausgewählte Datei konnte nicht hochgeladen werden, da bei der Anfrage eine Zeitüberschreitung aufgetreten ist.',
	'SAVE'						=> 'Entwurf speichern',
	'SAVE_DATE'					=> 'Gespeichert am',
	'SAVE_DRAFT'				=> 'Entwurf speichern',
	'SAVE_DRAFT_CONFIRM'		=> 'Bitte beachte, dass gespeicherte Entwürfe nur den Betreff und den Nachrichtentext enthalten. Alle anderen Elemente werden entfernt. Möchtest du den Entwurf jetzt speichern?',
	'SMILIES'					=> 'Smileys',
	'SMILIES_ARE_OFF'			=> 'Smileys sind <em>ausgeschaltet</em>',
	'SMILIES_ARE_ON'			=> 'Smileys sind <em>eingeschaltet</em>',
	'STICKY_ANNOUNCE_TIME_LIMIT'=> 'Zeitlimit für wichtige Themen/Bekanntmachungen/Globale Bekanntmachungen',
	'STICK_TOPIC_FOR'			=> 'Thema anpinnen für',
	'STICK_TOPIC_FOR_EXPLAIN'	=> 'Dieses Thema erscheint dauerhaft als wichtig/Bekanntmachung/Globale Bekanntmachung, wenn 0 als Wert eingestellt wird. Beachte, dass sich diese Angabe auf den Erstellungszeitpunkt des Themas bezieht.',
	'STYLES_TIP'				=> 'Tipp: Formatierungen können schnell auf den markierten Text angewandt werden.',

	'TOO_FEW_CHARS'				=> 'Die eingegebene Nachricht ist zu kurz.',
	'TOO_FEW_CHARS_LIMIT'		=> array(
		1	=> 'Es müssen mindestens %1$d Zeichen verwendet werden.',
		2	=> 'Es müssen mindestens %1$d Zeichen verwendet werden.',
	),
	'TOO_FEW_POLL_OPTIONS'		=> 'Du musst mindestens zwei Antwortmöglichkeiten für die Umfrage eingeben.',
	'TOO_MANY_ATTACHMENTS'		=> 'Du kannst keinen weiteren Dateianhang hinzufügen. Die maximale Anzahl liegt bei %d.',
	'TOO_MANY_CHARS'			=> 'Dein Beitrag enthält zu viele Zeichen.',
	'TOO_MANY_CHARS_LIMIT'		=> array(
		2	=> 'Es sind maximal %1$d Zeichen erlaubt.',
	),
	'TOO_MANY_POLL_OPTIONS'		=> 'Du hast zu viele Antwortmöglichkeiten eingegeben',
	'TOO_MANY_SMILIES'			=> 'Dein Beitrag enthält zu viele Smileys. Die maximal erlaubte Anzahl von Smileys ist %d.',
	'TOO_MANY_URLS'				=> 'Dein Beitrag enthält zu viele URLs. Die maximal erlaubte Anzahl von URLs ist %d.',
	'TOO_MANY_USER_OPTIONS'		=> 'Du kannst nicht mehr Antwortmöglichkeiten pro Benutzer erlauben als es Antwortmöglichkeiten gibt.',
	'TOPIC_BUMPED'				=> 'Das Thema wurde erfolgreich als neu markiert.',

	'UNAUTHORISED_BBCODE'		=> 'Du darfst bestimmte BBCodes nicht verwenden: %s.',
	'UNSUPPORTED_CHARACTERS_MESSAGE'	=> 'Deine Nachricht enthält folgende unzulässigen Zeichen:<br />%s',
	'UNSUPPORTED_CHARACTERS_SUBJECT'	=> 'Dein Betreff enthält folgende unzulässigen Zeichen:<br />%s',
	'UPDATE_COMMENT'			=> 'Kommentar aktualisieren',
	'URL_INVALID'				=> 'Die eingegebene URL ist ungültig.',
	'URL_NOT_FOUND'				=> 'Die angegebene Datei konnte nicht gefunden werden.',
	'URL_IS_OFF'				=> '[url] ist <em>ausgeschaltet</em>',
	'URL_IS_ON'					=> '[url] ist <em>eingeschaltet</em>',
	'USER_CANNOT_BUMP'			=> 'Du darfst in diesem Forum keine Themen als neu markieren.',
	'USER_CANNOT_DELETE'		=> 'Du darfst keine Beiträge in diesem Forum löschen.',
	'USER_CANNOT_EDIT'			=> 'Du darfst keine Beiträge in diesem Forum ändern.',
	'USER_CANNOT_REPLY'			=> 'Du darfst keine Antworten zu Themen in diesem Forum erstellen.',
	'USER_CANNOT_FORUM_POST'	=> 'Du kannst in diesem Forum keine Beiträge schreiben, weil der Forentyp dies nicht unterstützt.',

	'VIEW_MESSAGE'				=> '%sDen Beitrag anzeigen%s',
	'VIEW_PRIVATE_MESSAGE'		=> '%sDeine Private Nachricht anzeigen%s',

	'WRONG_FILESIZE'			=> 'Die Datei ist zu groß. Die maximal erlaubte Dateigröße ist %1$d %2$s.',
	'WRONG_SIZE'				=> 'Das Bild muss zwischen %1$s und %3$s breit sowie zwischen %2$s und %4$s hoch sein. Das angegebene Bild ist %5$s breit und %6$s hoch.',
));
