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
	'ALL_AVAILABLE'			=> 'Alle verfügbaren',
	'ALL_RESULTS'			=> 'Alle Ergebnisse',

	'DISPLAY_RESULTS'		=> 'Ergebnisse anzeigen als',

	'FOUND_SEARCH_MATCHES'		=> array(
		1	=> 'Die Suche ergab %d Treffer',
		2	=> 'Die Suche ergab %d Treffer',
	),
	'FOUND_MORE_SEARCH_MATCHES'		=> array(
		1	=> 'Die Suche ergab mehr als %d Treffer',
		2	=> 'Die Suche ergab mehr als %d Treffer',
	),

	'GLOBAL'				=> 'Globale Bekanntmachung',

	'IGNORED_TERMS'			=> 'ignoriert',
	'IGNORED_TERMS_EXPLAIN'	=> 'Die folgenden Wörter deiner Suchanfrage wurden ignoriert, da sie zu häufig vorkommen: <strong>%s</strong>.',

	'JUMP_TO_POST'			=> 'Rufe den Beitrag auf',

	'LOGIN_EXPLAIN_EGOSEARCH'	=> 'Um deine eigenen Beiträge anzusehen, musst du auf diesem Board registriert und angemeldet sein.',
	'LOGIN_EXPLAIN_UNREADSEARCH'=> 'Um deine ungelesenen Beiträge anzusehen, musst du auf diesem Board registriert und angemeldet sein.',
	'LOGIN_EXPLAIN_NEWPOSTS'	=> 'Um die Beiträge seit deinem letzten Besuch anzusehen, musst du auf diesem Board registriert und angemeldet sein.',

	'MAX_NUM_SEARCH_KEYWORDS_REFINE'	=> array(
		1	=> 'Deine Suchanfrage enthält zu viele Wörter. Bitte gib nicht mehr als %1$d Wort an.',
		2	=> 'Deine Suchanfrage enthält zu viele Wörter. Bitte gib nicht mehr als %1$d Wörter an.',
	),

	'NO_KEYWORDS'			=> 'Du musst mindestens ein Wort angeben, nach dem gesucht werden soll. Jedes Wort muss aus mindestens %s bestehen und darf ohne Platzhalter nicht mehr als %s haben.',
	'NO_RECENT_SEARCHES'	=> 'In der letzten Zeit wurden keine Suchanfragen durchgeführt.',
	'NO_SEARCH'				=> 'Du bist leider nicht berechtigt, die Suche zu verwenden.',
	'NO_SEARCH_RESULTS'		=> 'Es wurden keine passenden Ergebnisse gefunden.',
	'NO_SEARCH_LOAD'		=> 'Leider kann die Suche derzeit nicht genutzt werden, da der Server stark ausgelastet ist. Bitte versuche es später noch einmal.',
	'NO_SEARCH_TIME'		=> array(
		1	=> 'Die Suche steht dir momentan leider nicht zur Verfügung. Bitte versuche es in %d Sekunde erneut.',
		2	=> 'Die Suche steht dir momentan leider nicht zur Verfügung. Bitte versuche es in %d Sekunden erneut.',
	),
	'NO_SEARCH_UNREADS'		=> 'Die Suche nach ungelesenen Beiträgen wurde auf diesem Board deaktiviert.',
	'WORD_IN_NO_POST'		=> 'Es wurden keine Beiträge gefunden, weil das Wort <strong>%s</strong> in keinem Beitrag enthalten ist.',
	'WORDS_IN_NO_POST'		=> 'Es wurden keine Beiträge gefunden, weil die Wörter <strong>%s</strong> in keinem Beitrag enthalten sind.',

	'POST_CHARACTERS'		=> 'Zeichen der Beiträge anzeigen',
	'PHRASE_SEARCH_DISABLED'	=> 'Die Suche nach einem exakten Ausdruck wird auf diesem Board nicht unterstützt.',

	'RECENT_SEARCHES'		=> 'Die letzten Suchanfragen',
	'RESULT_DAYS'			=> 'Suchzeitraum begrenzen',
	'RESULT_SORT'			=> 'Ergebnisse sortieren nach',
	'RETURN_FIRST'			=> 'Die ersten',
	'GO_TO_SEARCH_ADV'	=> 'Zur erweiterten Suche',

	'SEARCHED_FOR'				=> 'Benutzte Suchanfrage',
	'SEARCHED_TOPIC'			=> 'Durchsuchtes Thema',
	'SEARCHED_QUERY'			=> 'Suchanfrage',
	'SEARCH_ALL_TERMS'			=> 'Nach allen Begriffen suchen oder Suche wie angegeben verwenden',
	'SEARCH_ANY_TERMS'			=> 'Nach einem Begriff suchen',
	'SEARCH_AUTHOR'				=> 'Zu suchender Autor',
	'SEARCH_AUTHOR_EXPLAIN'		=> 'Benutze ein * als Platzhalter für teilweise Übereinstimmungen.',
	'SEARCH_FIRST_POST'			=> 'Nur im ersten Beitrag der Themen',
	'SEARCH_FORUMS'				=> 'Zu durchsuchende Foren',
	'SEARCH_FORUMS_EXPLAIN'		=> 'Wähle das Forum oder die Foren aus, in denen gesucht werden soll. Unterforen werden automatisch mit durchsucht, sofern du die Option „Unterforen durchsuchen“ unten nicht deaktivierst.',
	'SEARCH_IN_RESULTS'			=> 'Diese Ergebnisse durchsuchen',
	'SEARCH_KEYWORDS_EXPLAIN'	=> 'Setze ein <strong>+</strong> vor ein Wort, das gefunden werden muss und ein <strong>-</strong> vor ein Wort, das nicht gefunden werden darf. Verwende mehrere Wörter getrennt durch <strong>|</strong> innerhalb einer Klammer, wenn nur eines der Wörter gefunden werden muss. Benutze ein * als Platzhalter für teilweise Übereinstimmungen.',
	'SEARCH_MSG_ONLY'			=> 'Nur im Text der Beiträge',
	'SEARCH_OPTIONS'			=> 'Suchoptionen',
	'SEARCH_QUERY'				=> 'Suchanfrage',
	'SEARCH_SUBFORUMS'			=> 'Unterforen durchsuchen',
	'SEARCH_TITLE_MSG'			=> 'Betreff und Text der Beiträge',
	'SEARCH_TITLE_ONLY'			=> 'Nur im Betreff der Themen',
	'SEARCH_WITHIN'				=> 'Innerhalb suchen',
	'SORT_ASCENDING'			=> 'Aufsteigend',
	'SORT_AUTHOR'				=> 'Autor',
	'SORT_DESCENDING'			=> 'Absteigend',
	'SORT_FORUM'				=> 'Forum',
	'SORT_POST_SUBJECT'			=> 'Betreff des Beitrags',
	'SORT_TIME'					=> 'Erstellungsdatum des Beitrags',
	'SPHINX_SEARCH_FAILED'		=> 'Suche gescheitert: %s',
	'SPHINX_SEARCH_FAILED_LOG'	=> 'Die Suche konnte leider nicht ausgeführt werden. Mehr Informationen zu diesem Fehler können im erstellten Fehler-Protokoll gefunden werden.',

	'TOO_FEW_AUTHOR_CHARS'	=> array(
		1	=> 'Du musst mindestens %d Zeichen des Benutzernamens angeben.',
		2	=> 'Du musst mindestens %d Zeichen des Benutzernamens angeben.',
	),
));
