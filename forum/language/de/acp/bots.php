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

// Bot settings
$lang = array_merge($lang, array(
	'BOTS'				=> 'Bots verwalten',
	'BOTS_EXPLAIN'		=> '„Robots“, „Spider“ oder „Crawler“ sind automatische Agenten, die meist von Suchmaschinen genutzt werden, um deren Datenbanken auf den neuesten Stand zu bringen. Weil Sitzungen von ihnen in den seltensten Fällen richtig genutzt werden, können sie das Ergebnis des Gast-Zählers verfälschen, den Datenverkehr erhöhen und manchmal Seiten nicht korrekt indizieren. Hier kannst du einen speziellen Typ von Benutzern definieren, um diese Probleme zu umgehen.',
	'BOT_ACTIVATE'		=> 'Aktivieren',
	'BOT_ACTIVE'		=> 'Bot ist aktiv',
	'BOT_ADD'			=> 'Bot hinzufügen',
	'BOT_ADDED'			=> 'Neuer Bot wurde erfolgreich hinzugefügt.',
	'BOT_AGENT'			=> 'Agenten-Übereinstimmung',
	'BOT_AGENT_EXPLAIN'	=> 'Eine Zeichenfolge, die mit der Browser-Signatur des Bots übereinstimmt. Partielle Übereinstimmungen sind erlaubt.',
	'BOT_DEACTIVATE'	=> 'Deaktivieren',
	'BOT_DELETED'		=> 'Bot wurde erfolgreich gelöscht.',
	'BOT_EDIT'			=> 'Bots bearbeiten',
	'BOT_EDIT_EXPLAIN'	=> 'Hier kannst du bestehende Bots bearbeiten oder neue hinzufügen. Du kannst eine Agenten-Zeichenfolge oder eine oder mehrere IP-Adressen (oder Bereiche von Adressen) definieren, die mit der des Bot übereinstimmen müssen. Des Weiteren kannst du einen Style oder eine Sprache angeben, der/die verwendet werden soll, wenn der Bot das Board besucht. Indem du einen einfachen Style für Bots einsetzt, kannst du die Bandbreite reduzieren, die der Bot in Anspruch nimmt. Denk daran, passende Berechtigungen für die Bots-Gruppe zu setzen.',
	'BOT_LANG'			=> 'Sprache für den Bot',
	'BOT_LANG_EXPLAIN'	=> 'Die Sprache, in der dem Bot das Board angezeigt wird, wenn er es besucht.',
	'BOT_LAST_VISIT'	=> 'Letzter Besuch',
	'BOT_IP'			=> 'IP-Adresse des Bot',
	'BOT_IP_EXPLAIN'	=> 'Partielle Übereinstimmungen sind erlaubt, trenne mehrere Adressen durch Komma.',
	'BOT_NAME'			=> 'Name des Bot',
	'BOT_NAME_EXPLAIN'	=> 'Nur zu deiner Information verwendet.',
	'BOT_NAME_TAKEN'	=> 'Der Name ist auf deinem Board bereits in Verwendung und kann nicht für den Bot verwendet werden.',
	'BOT_NEVER'			=> 'Noch nie',
	'BOT_STYLE'			=> 'Style für den Bot',
	'BOT_STYLE_EXPLAIN'	=> 'Der Style, der genutzt wird, um dem Bot das Board anzuzeigen.',
	'BOT_UPDATED'		=> 'Bestehender Bot erfolgreich aktualisiert.',

	'ERR_BOT_AGENT_MATCHES_UA'	=> 'Die angegebene Browser-Signatur ist identisch mit der, die du verwendest. Bitte ändere die angegebene Browser-Signatur des Agenten.',
	'ERR_BOT_NO_IP'				=> 'Die angegebenen IP-Adressen waren unzulässig oder der Hostname konnte nicht ermittelt werden.',
	'ERR_BOT_NO_MATCHES'		=> 'Du musst mindestens eine Agenten-Übereinstimmung oder IP für diesen Bot angeben.',

	'NO_BOT'		=> 'Konnte keinen Bot mit der angegebenen ID finden.',
	'NO_BOT_GROUP'	=> 'Die spezielle Bot-Gruppe konnte nicht gefunden werden.',
));
