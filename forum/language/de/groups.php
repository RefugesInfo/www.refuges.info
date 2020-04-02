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
	'ALREADY_DEFAULT_GROUP'		=> 'Die ausgewählte Gruppe ist bereits deine Hauptgruppe.',
	'ALREADY_IN_GROUP'			=> 'Du bist bereits Mitglied der ausgewählten Gruppe.',
	'ALREADY_IN_GROUP_PENDING'	=> 'Du hast bereits eine Mitgliedschaft in der ausgewählten Gruppe beantragt.',

	'CANNOT_JOIN_GROUP'			=> 'Du kannst dieser Gruppe nicht beitreten. Du kannst nur offenen und allgemein offenen Gruppen beitreten.',
	'CANNOT_RESIGN_GROUP'		=> 'Du kannst aus dieser Gruppe nicht austreten. Du kannst nur aus offenen und allgemein offenen Gruppen austreten.',
	'CHANGED_DEFAULT_GROUP'		=> 'Du hast die Hauptgruppe erfolgreich geändert.',

	'GROUP_AVATAR'						=> 'Gruppenavatar',
	'GROUP_CHANGE_DEFAULT'				=> 'Bist du dir sicher, dass du „%s“ zu deiner Hauptgruppe machen möchtest?',
	'GROUP_CLOSED'						=> 'Geschlossen',
	'GROUP_DESC'						=> 'Gruppenbeschreibung',
	'GROUP_HIDDEN'						=> 'Versteckt',
	'GROUP_INFORMATION'					=> 'Gruppeninformationen',
	'GROUP_IS_CLOSED'					=> 'Dies ist eine geschlossene Gruppe. Ein Beitritt ist nur nach Einladung durch einen Gruppenleiter möglich.',
	'GROUP_IS_FREE'						=> 'Dies ist eine allgemein offene Gruppe, neue Mitglieder sind herzlich willkommen.',
	'GROUP_IS_HIDDEN'					=> 'Dies ist eine versteckte Gruppe. Nur Mitglieder dieser Gruppe können die Liste der Mitglieder einsehen.',
	'GROUP_IS_OPEN'						=> 'Dies ist eine offene Gruppe, für die eine Mitgliedschaft beantragt werden kann.',
	'GROUP_IS_SPECIAL'					=> 'Dies ist eine Systemgruppe. Systemgruppen werden von den Administratoren verwaltet.',
	'GROUP_JOIN'						=> 'Der Gruppe beitreten',
	'GROUP_JOIN_CONFIRM'				=> 'Möchtest du der ausgewählten Gruppe wirklich beitreten?',
	'GROUP_JOIN_PENDING'				=> 'Beitrittsanfrage stellen',
	'GROUP_JOIN_PENDING_CONFIRM'		=> 'Bist du dir sicher, dass du eine Beitrittsanfrage für diese Gruppe an den Gruppenleiter senden möchtest?',
	'GROUP_JOINED'						=> 'Du bist der Gruppe erfolgreich beigetreten.',
	'GROUP_JOINED_PENDING'				=> 'Deine Beitrittsanfrage war erfolgreich. Bitte warte, bis der Gruppenleiter dieser zugestimmt hat und dich in die Gruppe aufnimmt.',
	'GROUP_LIST'						=> 'Benutzer verwalten',
	'GROUP_MEMBERS'						=> 'Mitglieder der Gruppe',
	'GROUP_NAME'						=> 'Gruppenname',
	'GROUP_OPEN'						=> 'Offen',
	'GROUP_RANK'						=> 'Gruppenrang',
	'GROUP_RESIGN_MEMBERSHIP'			=> 'Aus der Gruppe austreten',
	'GROUP_RESIGN_MEMBERSHIP_CONFIRM'	=> 'Bist du dir sicher, dass du aus der ausgewählten Gruppe austreten möchtest?',
	'GROUP_RESIGN_PENDING'				=> 'Antrag auf Mitgliedschaft zurückziehen',
	'GROUP_RESIGN_PENDING_CONFIRM'		=> 'Bist du dir sicher, dass du deinen Antrag auf Mitgliedschaft für die ausgewählte Gruppe zurückziehen möchtest?',
	'GROUP_RESIGNED_MEMBERSHIP'			=> 'Du bist erfolgreich aus der ausgewählten Gruppe ausgetreten.',
	'GROUP_RESIGNED_PENDING'			=> 'Dein Antrag auf Mitgliedschaft für die ausgewählte Gruppe wurde erfolgreich zurückgezogen.',
	'GROUP_TYPE'						=> 'Gruppenart',
	'GROUP_UNDISCLOSED'					=> 'Versteckte Gruppe',
	'FORUM_UNDISCLOSED'					=> 'Moderiert versteckte Foren',

	'LOGIN_EXPLAIN_GROUP'	=> 'Du musst dich anmelden, um die Gruppendetails anzusehen.',

	'NO_LEADERS'					=> 'Du bist kein Leiter einer Gruppe.',
	'NOT_LEADER_OF_GROUP'			=> 'Die gewünschte Aktion kann nicht ausgeführt werden, weil du kein Leiter dieser Gruppe bist.',
	'NOT_MEMBER_OF_GROUP'			=> 'Die gewünschte Aktion kann nicht ausgeführt werden, weil du kein Mitglied dieser Gruppe bist oder dein Antrag auf Mitgliedschaft noch nicht bestätigt wurde.',
	'NOT_RESIGN_FROM_DEFAULT_GROUP'	=> 'Du kannst aus deiner Hauptgruppe nicht austreten.',

	'PRIMARY_GROUP'		=> 'Hauptgruppe',

	'REMOVE_SELECTED'		=> 'Ausgewählte entfernen',

	'USER_GROUP_CHANGE'			=> 'Von „%1$s“-Gruppe nach „%2$s“',
	'USER_GROUP_DEMOTE'			=> 'Führung niederlegen',
	'USER_GROUP_DEMOTE_CONFIRM'	=> 'Bist du dir sicher, dass du dein Amt als Gruppenleiter der ausgewählten Gruppe niederlegen möchtest?',
	'USER_GROUP_DEMOTED'		=> 'Die Führung wurde erfolgreich niedergelegt.',
));
