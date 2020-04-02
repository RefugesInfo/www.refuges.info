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

// Email settings
$lang = array_merge($lang, array(
	'ACP_MASS_EMAIL_EXPLAIN'		=> 'Hier kannst du eine Nachricht per E-Mail an alle Mitglieder des Boards oder einer spezifischen Gruppe senden, <strong>sofern diese den Erhalt von Informationen per E-Mail zugelassen haben</strong>. Dazu wird eine E-Mail an die festgelegte administrative E-Mail-Adresse verschickt und alle Empfänger als Blindkopie (BCC) hinzugefügt. Standardmäßig wird pro 20 Empfänger eine solche E-Mail versandt; bei mehreren Empfängern werden mehrere E-Mails versandt. Bitte habe nach dem Absenden Geduld, wenn du eine Nachricht an eine große Gruppe schickst und breche den Vorgang nicht ab. Bei einer Massen-E-Mail ist es normal, dass ihr Versand länger dauert. Du wirst benachrichtigt, sobald der Vorgang abgeschlossen wurde.',
	'ALL_USERS'						=> 'Alle Mitglieder',

	'COMPOSE'				=> 'Entwerfen',

	'EMAIL_SEND_ERROR'		=> 'Es sind ein oder mehrere Fehler beim Versand der E-Mail aufgetreten. Bitte prüfe das %sFehler-Protokoll%s für detailliertere Fehlermeldungen.',
	'EMAIL_SENT'			=> 'Die Nachricht wurde versendet.',
	'EMAIL_SENT_QUEUE'		=> 'Die Nachricht wurde in die Warteschlange eingereiht.',

	'LOG_SESSION'			=> 'E-Mail-Sitzung im Fehler-Protokoll protokollieren',

	'SEND_IMMEDIATELY'		=> 'Sofort senden',
	'SEND_TO_GROUP'			=> 'An Gruppe senden',
	'SEND_TO_USERS'			=> 'An Benutzer senden',
	'SEND_TO_USERS_EXPLAIN'	=> 'Hier eingegebene Namen überschreiben jede oben ausgewählte Gruppe. Gib jeden Benutzer in einer neuen Zeile an.',

	'MAIL_BANNED'			=> 'Gesperrte Benutzer einschließen',
	'MAIL_BANNED_EXPLAIN'	=> 'Wenn du eine Nachricht an eine Gruppe sendest, kannst du hier auswählen, ob gesperrte Benutzer auch eine E-Mail erhalten sollen.',
	'MAIL_HIGH_PRIORITY'	=> 'Hoch',
	'MAIL_LOW_PRIORITY'		=> 'Niedrig',
	'MAIL_NORMAL_PRIORITY'	=> 'Normal',
	'MAIL_PRIORITY'			=> 'Priorität der E-Mail',
	'MASS_MESSAGE'			=> 'Deine Nachricht',
	'MASS_MESSAGE_EXPLAIN'	=> 'Bitte beachte, dass du nur reinen Text verwenden kannst. Alle Auszeichnungen werden vor dem Versand entfernt.',

	'NO_EMAIL_MESSAGE'		=> 'Du musst eine Nachricht angeben.',
	'NO_EMAIL_SUBJECT'		=> 'Du musst einen Betreff für die Nachricht angeben.',
));
