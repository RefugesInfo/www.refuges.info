<?php
/**
*
* This file is part of the french language pack for the phpBB Forum Software package.
* This file is translated by phpBB-fr.com <http://www.phpbb-fr.com>
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
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
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

// Banning
$lang = array_merge($lang, array(
	'1_HOUR'		=> '1 heure',
	'30_MINS'		=> '30 minutes',
	'6_HOURS'		=> '6 heures',

	'ACP_BAN_EXPLAIN'	=> 'Vous pouvez contrôler le bannissement d’utilisateurs par nom, adresse IP ou adresse courriel. Ces méthodes empêchent l’utilisateur d’accéder à toutes les sections de votre forum. Vous pouvez donner si vous le souhaitez une courte raison (3000 caractères maximum) du bannissement. Celle-ci sera affichée dans le journal d’administration.<br>Une durée de bannissement peut également être indiquée. Si vous voulez que le bannissement se termine à une date particulière plutôt qu’après une période de temps définie, sélectionnez <span style="text-decoration: underline;">Jusqu’au -&gt;</span> pour la durée du bannissement et saisissez une date au format <kbd>AAAA-MM-JJ</kbd>.',

	'BAN_EXCLUDE'			=> 'Exclure du bannissement',
	'BAN_LENGTH'			=> 'Durée du bannissement',
	'BAN_REASON'			=> 'Raison du bannissement',
	'BAN_GIVE_REASON'		=> 'Raison affichée au membre banni',
	'BAN_UPDATE_SUCCESSFUL'	=> 'La liste des bannissements a été mise à jour.',
	'BANNED_UNTIL_DATE'		=> 'Jusqu’au %s', // Example: "until Mon 13.Jul.2009, 14:44"
	'BANNED_UNTIL_DURATION'	=> '%1$s (Jusqu’au %2$s)', // Example: "7 days (until Tue 14.Jul.2009, 14:44)"

	'EMAIL_BAN'					=> 'Bannir une ou plusieurs adresses courriels',
	'EMAIL_BAN_EXCLUDE_EXPLAIN'	=> 'Activez cette option pour exclure les adresses courriel listées de tous bannissements actuels.',
	'EMAIL_BAN_EXPLAIN'			=> 'Pour indiquer plus d’une adresse courriel, saisissez chacune d’elles sur une nouvelle ligne. Pour bannir sur une partie du nom, utilisez « * » comme caractère joker, par exemple : <samp>*@hotmail.com</samp>, <samp>*@*.domain.tld</samp>, etc.',
	'EMAIL_NO_BANNED'			=> 'Aucune adresse courriel bannie',
	'EMAIL_UNBAN'				=> 'Débannir ou ne plus exclure des adresses courriel',
	'EMAIL_UNBAN_EXPLAIN'		=> 'Vous pouvez débannir (ou ne plus exclure) plusieurs adresses courriel en une seule fois, en utilisant la bonne combinaison du clavier et de la souris en fonction de votre ordinateur ou navigateur.',

	'IP_BAN'					=> 'Bannir une ou plusieurs adresses IP',
	'IP_BAN_EXCLUDE_EXPLAIN'	=> 'Activez cette option pour exclure les adresses IP listées de tous bannissements actuels.',
	'IP_BAN_EXPLAIN'			=> 'Pour indiquer plusieurs adresses IP ou noms d’hôtes différents, saisissez chacun d’eux sur une nouvelle ligne. Pour indiquer une plage d’adresses IP, séparez le début et la fin par un tiret, et utilisez « * » comme caractère joker.',
	'IP_HOSTNAME'				=> 'Adresses IP ou noms d’hôtes',
	'IP_NO_BANNED'				=> 'Aucune adresse IP bannie',
	'IP_UNBAN'					=> 'Débannir ou ne plus exclure des adresses IP',
	'IP_UNBAN_EXPLAIN'			=> 'Vous pouvez débannir (ou ne plus exclure) plusieurs adresses IP en une seule fois, en utilisant la bonne combinaison du clavier et de la souris en fonction de votre ordinateur ou navigateur.',

	'LENGTH_BAN_INVALID'		=> 'La date indiquée doit être au format <kbd>AAAA-MM-JJ</kbd>.',

	'OPTIONS_BANNED'			=> 'Banni(s)',
	'OPTIONS_EXCLUDED'			=> 'Exclu(s)',

	'PERMANENT'		=> 'Permanent',

	'UNTIL'						=> 'Jusqu’à',
	'USER_BAN'					=> 'Bannir un ou plusieurs membres par le nom d’utilisateur',
	'USER_BAN_EXCLUDE_EXPLAIN'	=> 'Activez cette option pour exclure les noms d’utilisateurs listés ci-dessus de tous bannissements actuels.',
	'USER_BAN_EXPLAIN'			=> 'Vous pouvez bannir plusieurs membres en une fois, en saisissant chaque nom sur une nouvelle ligne. Utilisez la fonction <span style="text-decoration: underline;">Rechercher un membre</span> pour ajouter automatiquement un ou plusieurs membres.',
	'USER_NO_BANNED'			=> 'Aucun membre banni',
	'USER_UNBAN'				=> 'Débannir ou ne plus exclure des membres par le nom d’utilisateur',
	'USER_UNBAN_EXPLAIN'		=> 'Vous pouvez débannir (ou ne plus exclure) plusieurs membres en une seule fois, en utilisant la bonne combinaison du clavier et de la souris en fonction de votre ordinateur ou navigateur.',
));
