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

// Bot settings
$lang = array_merge($lang, array(
	'BOTS'				=> 'Gestion des robots',
	'BOTS_EXPLAIN'		=> 'Les « robots » ou « aspirateurs » sont des agents automatisés le plus souvent utilisés par les moteurs de recherches pour mettre à jour leurs bases de données. Étant donné que ceux-ci font rarement une utilisation appropriée des sessions, ils peuvent fausser le compteur de visiteurs, augmenter la charge du serveur et parfois ne pas indexer correctement les sites. Depuis cette page, vous pouvez définir un type spécial d’utilisateurs afin de pallier ces problèmes.',
	'BOT_ACTIVATE'		=> 'Activer',
	'BOT_ACTIVE'		=> 'Robot actif',
	'BOT_ADD'			=> 'Ajouter un robot',
	'BOT_ADDED'			=> 'Nouveau robot ajouté.',
	'BOT_AGENT'			=> 'Agent correspondant',
	'BOT_AGENT_EXPLAIN'	=> 'Une chaîne de caractères correspondant à l’agent du robot, les correspondances partielles sont autorisées.',
	'BOT_DEACTIVATE'	=> 'Désactiver',
	'BOT_DELETED'		=> 'Robot supprimé.',
	'BOT_EDIT'			=> 'Modifier le robot',
	'BOT_EDIT_EXPLAIN'	=> 'Cette page vous permet d’ajouter ou de modifier un robot. Vous pouvez définir une chaîne de caractères pour l’agent et/ou une ou plusieurs adresses IP (ou une plage d’adresses) correspondantes. Faites attention en définissant la chaîne de caractères correspondant à l’agent ou aux adresses. Vous pouvez également indiquer le style et la langue que le robot utilisera pour consulter le forum. Cela peut vous permettre de réduire la bande passante utilisée en configurant un style simple pour les robots. N’oubliez pas de mettre les permissions appropriées au groupe prédéfini « Robots ».',
	'BOT_LANG'			=> 'Langue du robot',
	'BOT_LANG_EXPLAIN'	=> 'Langue présentée au robot lors de son passage.',
	'BOT_LAST_VISIT'	=> 'Dernière visite',
	'BOT_IP'			=> 'Adresse IP du robot',
	'BOT_IP_EXPLAIN'	=> 'Les correspondances partielles sont autorisées, séparez les adresses par une virgule.',
	'BOT_NAME'			=> 'Nom du robot',
	'BOT_NAME_EXPLAIN'	=> 'Ce nom sera le nom utilisé par le robot lorsqu’il parcourra votre forum. Ce nom n’est là qu’à titre d’information.',
	'BOT_NAME_TAKEN'	=> 'Ce nom est déjà utilisé sur votre forum et ne peut être utilisé pour le robot.',
	'BOT_NEVER'			=> 'Jamais',
	'BOT_STYLE'			=> 'Style du robot',
	'BOT_STYLE_EXPLAIN'	=> 'Style utilisé par le robot sur le forum.',
	'BOT_UPDATED'		=> 'Robot mis à jour.',

	'ERR_BOT_AGENT_MATCHES_UA'	=> 'L’agent du robot que vous avez fourni correspond à un que vous utilisez actuellement. Veuillez fournir un autre agent pour ce robot.',
	'ERR_BOT_NO_IP'				=> 'Les adresses IP que vous avez fournies ne sont pas valides ou le nom de domaine n’a pas pu être résolu.',
	'ERR_BOT_NO_MATCHES'		=> 'Vous devez fournir au moins un agent ou une IP pour correspondre à ce robot.',

	'NO_BOT'		=> 'Il n’y a pas de robot avec cet ID.',
	'NO_BOT_GROUP'	=> 'Le groupe prédéfini « Robots » n’a pas été trouvé.',
));
