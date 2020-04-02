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

// Banning
$lang = array_merge($lang, array(
	'1_HOUR'		=> '1 Stunde',
	'30_MINS'		=> '30 Minuten',
	'6_HOURS'		=> '6 Stunden',

	'ACP_BAN_EXPLAIN'	=> 'Hier kannst du die Sperrung von Benutzern nach Benutzername, IP-Adresse oder E-Mail-Adresse steuern. Wenn du möchtest, kannst du eine kurze Begründung (bis zu 3000 Zeichen) für die Sperre angeben, die im Administrations-Protokoll angezeigt wird. Die Dauer der Sperre kann ebenfalls festgelegt werden. Wenn du möchtest, dass die Sperre statt nach einer festgelegten Zeit an einem bestimmten Tag endet, wähle <span style="text-decoration: underline;">Bis zum -&gt;</span> für die Dauer aus und gib das Enddatum im Format <kbd>JJJJ-MM-TT</kbd> an.',

	'BAN_EXCLUDE'			=> 'Von Sperre ausnehmen',
	'BAN_LENGTH'			=> 'Dauer der Sperre',
	'BAN_REASON'			=> 'Grund für die Sperre',
	'BAN_GIVE_REASON'		=> 'Dem Gesperrten angezeigter Grund',
	'BAN_UPDATE_SUCCESSFUL'	=> 'Die Sperrliste wurde erfolgreich aktualisiert.',
	'BANNED_UNTIL_DATE'		=> 'bis zum %s', // Example: "until Mon 13.Jul.2009, 14:44"
	'BANNED_UNTIL_DURATION'	=> '%1$s (bis zum %2$s)', // Example: "7 days (until Tue 14.Jul.2009, 14:44)"

	'EMAIL_BAN'					=> 'Eine oder mehrere E-Mail-Adressen sperren',
	'EMAIL_BAN_EXCLUDE_EXPLAIN'	=> 'Aktiviere diese Option, um die Adresse von allen aktiven Sperren auszunehmen.',
	'EMAIL_BAN_EXPLAIN'			=> 'Um mehr als eine E-Mail-Adresse anzugeben, gib jede Adresse in einer neuen Zeile ein. Um Übereinstimmungen von Teilen einer Adresse anzugeben, verwende „*“ als Platzhalter; z.&nbsp;B. <samp>*@phpbb.com</samp>, <samp>*@*.example.org</samp> usw.',
	'EMAIL_NO_BANNED'			=> 'Keine gesperrten E-Mail-Adressen.',
	'EMAIL_UNBAN'				=> 'E-Mail-Adressen entsperren oder Ausnahmen entfernen',
	'EMAIL_UNBAN_EXPLAIN'		=> 'Du kannst mehrere E-Mail-Adressen gleichzeitig entsperren (oder aus der Ausnahmeliste entfernen), indem du mit der entsprechenden Tasten- und Mauskombination mehrere Einträge markierst. E-Mail-Adressen auf der Ausnahmeliste sind hervorgehoben.',

	'IP_BAN'					=> 'Eine oder mehrere IP-Adressen sperren',
	'IP_BAN_EXCLUDE_EXPLAIN'	=> 'Aktiviere diese Option, um die Adresse von allen aktiven Sperren auszunehmen.',
	'IP_BAN_EXPLAIN'			=> 'Um mehrere IP-Adressen oder Host-Namen zu sperren, gib jede(n) in einer neuen Zeile ein. Um einen ganzen IP-Bereich zu sperren, trenne die Anfangs- und die Endadresse mit einem Bindestrich (-), verwende „*“ als Platzhalter.',
	'IP_HOSTNAME'				=> 'IP-Adressen oder Hostnamen',
	'IP_NO_BANNED'				=> 'Keine gesperrten IP-Adressen.',
	'IP_UNBAN'					=> 'IP-Adressen entsperren oder Ausnahmen entfernen',
	'IP_UNBAN_EXPLAIN'			=> 'Du kannst mehrere IP-Adressen gleichzeitig entsperren (oder aus der Ausnahmeliste entfernen), indem du mit der entsprechenden Tasten- und Mauskombination mehrere Einträge markierst. IP-Adressen auf der Ausnahmeliste sind hervorgehoben.',

	'LENGTH_BAN_INVALID'		=> 'Das Datum muss im Format <kbd>JJJJ-MM-TT</kbd> angegeben werden.',

	'OPTIONS_BANNED'			=> 'Gesperrt',
	'OPTIONS_EXCLUDED'			=> 'Ausgenommen',

	'PERMANENT'		=> 'Dauerhaft',

	'UNTIL'						=> 'Bis zum',
	'USER_BAN'					=> 'Einen oder mehrere Benutzer anhand des Benutzernamens sperren',
	'USER_BAN_EXCLUDE_EXPLAIN'	=> 'Aktiviere diese Option, um den Namen von allen aktiven Sperren auszunehmen.',
	'USER_BAN_EXPLAIN'			=> 'Um mehrere Benutzer auf einmal zu sperren, gib jeden Namen in einer neuen Zeile ein. Benutze <span style="text-decoration: underline;">Nach einem Mitglied suchen</span>, um nach einem oder mehreren Benutzer(n) zu suchen und diese(n) der Liste hinzuzufügen.',
	'USER_NO_BANNED'			=> 'Keine gesperrten Benutzernamen.',
	'USER_UNBAN'				=> 'Sperrungen von Benutzern anhand des Benutzernamens aufheben oder Ausnahmen entfernen',
	'USER_UNBAN_EXPLAIN'		=> 'Du kannst mehrere Benutzer gleichzeitig entsperren (oder aus der Ausnahmeliste entfernen), indem du mit der entsprechenden Tasten- und Mauskombination mehrere Einträge markierst. Benutzernamen auf der Ausnahmeliste sind hervorgehoben.',
));
