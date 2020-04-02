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
	'ACP_SEARCH_INDEX_EXPLAIN'				=> 'Hier kannst du die Indizes der Such-Backends verwalten. Da normalerweise nur ein Backend genutzt wird, solltest du alle Indizes löschen, die du nicht verwendest. Nach der Änderung bestimmter Such-Einstellungen (z.&nbsp;B. die minimal/maximal indizierten Zeichen) kann es sinnvoll sein, den Suchindex neu aufzubauen, damit er die Änderungen berücksichtigt.',
	'ACP_SEARCH_SETTINGS_EXPLAIN'			=> 'Hier kannst du festlegen, welches Backend zur Indizierung von und zur Suche nach Beiträgen verwendet wird. Du kannst verschiedene Optionen festlegen, die die Verarbeitungszeit dieser Vorgänge beeinflussen können. Manche Einstellungen sind für alle Backends identisch.',

	'COMMON_WORD_THRESHOLD'					=> 'Schwelle für häufig vorkommende Wörter',
	'COMMON_WORD_THRESHOLD_EXPLAIN'			=> 'Wörter, die in einem größeren als dem angegebenen Anteil von Beiträgen enthalten sind, werden als häufig vorkommende Wörter angesehen und in Suchanfragen ignoriert. Keine häufig vorkommenden Wörter werden ermittelt, wenn 0 als Wert eingestellt wird. Die Funktion greift nur, wenn mehr als 100 Beiträge existieren. Wenn Wörter, die momentan als häufig gekennzeichnet sind, wieder in den Suchindex aufgenommen werden sollen, muss der Index neu aufgebaut werden.',
	'CONFIRM_SEARCH_BACKEND'				=> 'Bist du dir sicher, dass du das Backend für die Suchen ändern möchtest? Nach dem Wechsel des Backends musst du einen neuen Index für das neue Backend aufbauen. Wenn du nicht planst, zum alten Backend zurückzukehren, kannst du auch den Index des alten Backends löschen, um Systemressourcen zu sparen.',
	'CONTINUE_DELETING_INDEX'				=> 'Letzte Index-Löschung fortsetzen',
	'CONTINUE_DELETING_INDEX_EXPLAIN'		=> 'Die Löschung eines Indexes wurde gestartet. Um auf die Such-Indizes-Seite zugreifen zu können, muss dieser Vorgang erst abgeschlossen oder abgebrochen werden.',
	'CONTINUE_INDEXING'						=> 'Letzte Indizierung fortsetzen',
	'CONTINUE_INDEXING_EXPLAIN'				=> 'Eine Indizierung wurde gestartet. Um auf die Such-Indizes-Seite zugreifen zu können, muss dieser Vorgang erst abgeschlossen oder abgebrochen werden.',
	'CREATE_INDEX'							=> 'Index erstellen',

	'DELETE_INDEX'							=> 'Index löschen',
	'DELETING_INDEX_IN_PROGRESS'			=> 'Index wird gelöscht',
	'DELETING_INDEX_IN_PROGRESS_EXPLAIN'	=> 'Das Backend löscht seinen Index. Dieser Vorgang kann einige Minuten beanspruchen.',

	'FULLTEXT_MYSQL_INCOMPATIBLE_DATABASE'	=> 'Die MySQL-Volltextsuche kann nur mit MySQL 4 oder höher verwendet werden.',
	'FULLTEXT_MYSQL_NOT_SUPPORTED'			=> 'Die MySQL-Volltextsuche kann nur mit MyISAM- oder InnoDB-Tabellen genutzt werden. Für eine Volltextsuche mit InnoDB-Tabellen ist MySQL 5.6.8 oder höher erforderlich.',
	'FULLTEXT_MYSQL_TOTAL_POSTS'			=> 'Insgesamt indizierte Beiträge',
	'FULLTEXT_MYSQL_MIN_SEARCH_CHARS_EXPLAIN'	=> 'Nur Wörter mit mindestens dieser Anzahl von Zeichen werden indiziert. Dieser Wert kann nur durch den Server-Betreiber in der MySQL-Konfiguration geändert werden.',
	'FULLTEXT_MYSQL_MAX_SEARCH_CHARS_EXPLAIN'	=> 'Nur Wörter mit maximal dieser Anzahl von Zeichen werden indiziert. Dieser Wert kann nur durch den Server-Betreiber in der MySQL-Konfiguration geändert werden.',

	'FULLTEXT_POSTGRES_INCOMPATIBLE_DATABASE'	=> 'Die PostgreSQL-Volltextsuche kann nur mit PostgreSQL genutzt werden.',
	'FULLTEXT_POSTGRES_TOTAL_POSTS'			=> 'Gesamtzahl indizierter Beiträge',
	'FULLTEXT_POSTGRES_VERSION_CHECK'		=> 'PostgreSQL-Version',
	'FULLTEXT_POSTGRES_TS_NAME'				=> 'Konfigurationsprofil für die Textsuche:',
	'FULLTEXT_POSTGRES_MIN_WORD_LEN'			=> 'Minimale Wort-Länge für Schlüsselwörter',
	'FULLTEXT_POSTGRES_MAX_WORD_LEN'			=> 'Maximale Wort-Länge für Schlüsselwörter',
	'FULLTEXT_POSTGRES_VERSION_CHECK_EXPLAIN'	=> 'Dieses Such-Backend kann nur mit PostgreSQL 8.3 oder höher genutzt werden.',
	'FULLTEXT_POSTGRES_TS_NAME_EXPLAIN'			=> 'Das Konfigurationsprofil für die Textsuche, das den Parser und das Wörterbuch festlegt.',
	'FULLTEXT_POSTGRES_MIN_WORD_LEN_EXPLAIN'	=> 'Wörter, die aus mindestens dieser Anzahl von Zeichen bestehen, werden in der Datenbankabfrage berücksichtigt.',
	'FULLTEXT_POSTGRES_MAX_WORD_LEN_EXPLAIN'	=> 'Wörter, die aus nicht mehr als dieser Anzahl von Zeichen bestehen, werden in der Datenbankabfrage berücksichtigt.',

	'FULLTEXT_SPHINX_CONFIGURE'				=> 'Passe die folgenden Einstellungen an, um eine Sphinx-Konfigurationsdatei zu erstellen',
	'FULLTEXT_SPHINX_DATA_PATH'				=> 'Pfad zum Daten-Verzeichnis',
	'FULLTEXT_SPHINX_DATA_PATH_EXPLAIN'		=> 'Wird genutzt, um die Indizes und Protokolldateien zu speichern. Das Verzeichnis sollte außerhalb der aus dem Web zugänglichen Verzeichnisse angelegt werden. (Angabe mit abschließenden Slash (Schrägstrich))',
	'FULLTEXT_SPHINX_DELTA_POSTS'			=> 'Anzahl von Beiträgen im Delta-Index für häufig aktualisierte Daten',
	'FULLTEXT_SPHINX_HOST'					=> 'Server des Sphinx-Suchdienstes',
	'FULLTEXT_SPHINX_HOST_EXPLAIN'			=> 'Server, auf dem der Dienst/Daemon (searchd) läuft. Lass den Eintrag leer, um den Standard <samp>localhost</samp> zu nutzen.',
	'FULLTEXT_SPHINX_INDEXER_MEM_LIMIT'			=> 'Speicherlimit für Indizierer',
	'FULLTEXT_SPHINX_INDEXER_MEM_LIMIT_EXPLAIN'	=> 'Dieser Wert sollte immer geringer als der maximal für dein System verfügbare Arbeitsspeicher sein. Wenn regelmäßig Performance-Probleme auftreten, könnte es sein, dass der Indizierer zu viele Ressourcen in Anspruch nimmt. In diesem Fall kann es hilfreich sein, den für den Indizierer verfügbaren Arbeitsspeicher zu reduzieren.',
	'FULLTEXT_SPHINX_MAIN_POSTS'			=> 'Anzahl von Beiträgen im Hauptindex',
	'FULLTEXT_SPHINX_PORT'					=> 'Port des Sphinx-Suchdienstes',
	'FULLTEXT_SPHINX_PORT_EXPLAIN'			=> 'Port, auf dem der Dienst/Daemon (searchd) lauscht. Lass den Eintrag leer, um den Standard-API-Port 9312 von Sphinx zu benutzen',
	'FULLTEXT_SPHINX_WRONG_DATABASE'		=> 'Die Sphinx-Suche für phpBB unterstützt lediglich MySQL und PostgreSQL.',
	'FULLTEXT_SPHINX_CONFIG_FILE'			=> 'Sphinx-Konfigurationsdatei',
	'FULLTEXT_SPHINX_CONFIG_FILE_EXPLAIN'	=> 'Dies ist der generierte Inhalt für die Konfigurationsdatei von Sphinx. Dieser muss in die sphinx.conf eingefügt werden, die vom Sphinx-Suchdienst verwendet wird. Ersetze die Platzhalter <samp>[dbuser]</samp> und <samp>[dbpassword]</samp> mit den Zugangsdaten deiner Datenbank.',
	'FULLTEXT_SPHINX_NO_CONFIG_DATA'		=> 'Das Datenverzeichnis von Sphinx wurde nicht festgelegt. Bitte lege es fest und sende dieses Formular ab, damit die Konfigurationsdatei erstellt werden kann.',

	'GENERAL_SEARCH_SETTINGS'				=> 'Allgemeine Such-Einstellungen',
	'GO_TO_SEARCH_INDEX'					=> 'Zur Übersicht der Such-Indizes gehen',

	'INDEX_STATS'							=> 'Index-Statistik',
	'INDEXING_IN_PROGRESS'					=> 'Indizierung erfolgt',
	'INDEXING_IN_PROGRESS_EXPLAIN'			=> 'Das Backend indiziert alle Beiträge des Boards. Dies kann abhängig von der Größe deines Boards zwischen wenigen Minuten und einigen Stunden dauern.',

	'LIMIT_SEARCH_LOAD'						=> 'Systemauslastungs-Limit für Suche',
	'LIMIT_SEARCH_LOAD_EXPLAIN'				=> 'Wenn die Systemauslastung der letzten Minute (load average) diesen Wert überschreitet, wird die Suchfunktion deaktiviert. 1.0 steht für eine ca. 100-prozentige Auslastung eines Prozessors. Diese Einstellung steht nur auf Systemen zur Verfügung, die auf UNIX basieren und bei denen dieser Wert zugänglich ist.',

	'MAX_SEARCH_CHARS'						=> 'Maximal indizierte Zeichen',
	'MAX_SEARCH_CHARS_EXPLAIN'				=> 'Wörter mit nicht mehr als so vielen Zeichen werden für die Suche indiziert.',
	'MAX_NUM_SEARCH_KEYWORDS'				=> 'Maximal zulässige Wörter',
	'MAX_NUM_SEARCH_KEYWORDS_EXPLAIN'		=> 'Maximale Anzahl von Wörtern, nach denen ein Benutzer suchen kann. Nach einer unbegrenzten Anzahl von Wörtern kann gesucht werden, wenn 0 als Wert eingestellt wird.',
	'MIN_SEARCH_CHARS'						=> 'Minimal indizierte Zeichen',
	'MIN_SEARCH_CHARS_EXPLAIN'				=> 'Wörter mit mindestens so vielen Zeichen werden für die Suche indiziert.',
	'MIN_SEARCH_AUTHOR_CHARS'				=> 'Mindestlänge für Suche nach Benutzernamen',
	'MIN_SEARCH_AUTHOR_CHARS_EXPLAIN'		=> 'Benutzer müssen mindestens diese Anzahl von Zeichen eingeben, wenn sie eine Mitgliedersuche mit Platzhaltern durchführen. Wenn der Benutzername des Autors kürzer als diese Zahl ist, kannst du immer noch nach den Beiträgen des Benutzers suchen, indem du nach dem vollständigen Namen suchst.',

	'PROGRESS_BAR'							=> 'Fortschritt',

	'SEARCH_GUEST_INTERVAL'					=> 'Wartezeit zwischen zwei Suchvorgängen von Gästen',
	'SEARCH_GUEST_INTERVAL_EXPLAIN'			=> 'Zeit in Sekunden, die Gäste zwischen Suchvorgängen warten müssen. Wenn ein Gast eine Suche durchgeführt hat, müssen alle Gäste so lange warten, bis sie die Suchfunktion wieder nutzen können.',
	'SEARCH_INDEX_CREATE_REDIRECT'			=> array(
		2	=> 'Die Beiträge bis zur Beitrag-ID #%2$d wurden bereits indiziert, davon %1$d Beiträge in diesem Durchgang.<br />',
	),
	'SEARCH_INDEX_CREATE_REDIRECT_RATE'		=> array(
		2	=> 'Die Indizierungs-Rate beträgt ungefähr %1$.1f Beiträge pro Sekunde.<br />Indizierung erfolgt…',
	),
	'SEARCH_INDEX_DELETE_REDIRECT'			=> array(
		2	=> 'Die Beiträge bis zur Beitrags-ID #%2$d wurden bereits vom Suchindex entfernt, davon %1$d Beiträge in diesem Durchlauf.<br />',
	),
	'SEARCH_INDEX_DELETE_REDIRECT_RATE'		=> array(
		2	=> 'Die aktuelle Löschrate beträgt ungefähr %1$.1f Beiträge pro Sekunde.<br />Index wird gelöscht…',
	),
	'SEARCH_INDEX_CREATED'					=> 'Alle Beiträge in der Datenbank wurden erfolgreich indiziert.',
	'SEARCH_INDEX_REMOVED'					=> 'Der Suchindex für das Backend wurde erfolgreich gelöscht.',
	'SEARCH_INTERVAL'						=> 'Wartezeit zwischen zwei Suchvorgängen von Benutzern',
	'SEARCH_INTERVAL_EXPLAIN'				=> 'Zeit in Sekunden, die ein Benutzer zwischen Suchvorgängen warten muss. Dieser Zeitabstand wird für jeden Benutzer individuell gemessen.',
	'SEARCH_STORE_RESULTS'					=> 'Cache-Zeit von Suchergebnissen',
	'SEARCH_STORE_RESULTS_EXPLAIN'			=> 'Zwischengespeicherte Suchergebnisse verfallen nach dieser Zeit (in Sekunden). Die Zwischenspeicherung wird deaktiviert, wenn 0 als Wert eingestellt wird.',
	'SEARCH_TYPE'							=> 'Verwendetes Backend',
	'SEARCH_TYPE_EXPLAIN'					=> 'phpBB erlaubt dir, das für die Beitragssuche zu verwendende Backend zu wählen. Standardmäßig wird die phpBB-eigene Volltextsuche verwendet.',
	'SWITCHED_SEARCH_BACKEND'				=> 'Du hast das Such-Backend gewechselt. Um das neue Backend zu benutzen, solltest du sicherstellen, dass für das neue Backend ein Index angelegt wurde.',

	'TOTAL_WORDS'							=> 'Insgesamt indizierte Wörter',
	'TOTAL_MATCHES'							=> 'Insgesamt indizierte Wort-Beitrags-Beziehungen',

	'YES_SEARCH'							=> 'Suchfunktion aktivieren',
	'YES_SEARCH_EXPLAIN'					=> 'Aktiviert die Suchfunktionen inklusive der Mitgliedersuche für die Benutzer.',
	'YES_SEARCH_UPDATE'						=> 'Aktualisierung des Suchindexes erlauben',
	'YES_SEARCH_UPDATE_EXPLAIN'				=> 'Erlaubt eine Aktualisierung des Indexes beim Erstellen/Ändern von Beiträgen. Wird überschrieben, wenn die Suchfunktion deaktiviert ist.',
));
