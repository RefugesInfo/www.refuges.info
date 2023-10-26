<?php
/**
*
* This file is part of the french language pack for the phpBB Forum Software package.
* This file is translated by phpBB-fr.com <https://www.phpbb-fr.com>
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

$lang = array_merge($lang, array(
	'CONFIG_NOT_EXIST'					=> 'Le paramètre de configuration « %s » n’existe pas.',

	'GROUP_NOT_EXIST'					=> 'Le groupe « %s » n’existe pas.',

	'MIGRATION_APPLY_DEPENDENCIES'		=> 'Appliquer les dépendances de %s.',
	'MIGRATION_DATA_DONE'				=> 'Données installées : %1$s ; Durée : %2$.2f secondes',
	'MIGRATION_DATA_IN_PROGRESS'		=> 'Installation des données en cours : %1$s ; Durée : %2$.2f secondes',
	'MIGRATION_DATA_RUNNING'			=> 'Installation des données : %s.',
	'MIGRATION_EFFECTIVELY_INSTALLED'	=> '[Étape ignorée] Cette opération de mise à jour a déjà été appliquée : %s',
	'MIGRATION_EXCEPTION_ERROR'			=> 'Un problème a été rencontré durant l’opération de mise à jour de la base de données. Les modifications déjà appliquées ont été annulées du mieux possible, veuillez vérifier que votre forum ne comporte pas d’erreur.',
	'MIGRATION_NOT_FULFILLABLE'			=> 'L’opération de mise à jour « %1$s » n’est pas complète, il manque la mise à jour « %2$s ».',
	'MIGRATION_NOT_INSTALLED'			=> 'La migration « %s » n’est pas installée.',
	'MIGRATION_NOT_VALID'				=> '%s n’est pas une migration valide.',
	'MIGRATION_SCHEMA_DONE'				=> 'Schéma installé : %1$s ; Durée : %2$.2f secondes',
	'MIGRATION_SCHEMA_IN_PROGRESS'		=> 'Installation du schéma : %1$s; Durée : %2$.2f secondes',
	'MIGRATION_SCHEMA_RUNNING'			=> 'Installation du schéma : %s.',

	'MIGRATION_REVERT_DATA_DONE'		=> 'Modifications liées aux données annulées : %1$s ; Durée : %2$.2f secondes',
	'MIGRATION_REVERT_DATA_IN_PROGRESS'	=> 'Annulation des modifications liées aux données : %1$s ; Durée : %2$.2f secondes',
	'MIGRATION_REVERT_DATA_RUNNING'		=> 'Annulation des modifications liées aux données : %s.',
	'MIGRATION_REVERT_SCHEMA_DONE'		=> 'Modifications liées au schéma annulées : %1$s ; Durée : %2$.2f secondes',
	'MIGRATION_REVERT_SCHEMA_IN_PROGRESS'	=> 'Annulation des modifications liées au schéma : %1$s; Durée : %2$.2f secondes',
	'MIGRATION_REVERT_SCHEMA_RUNNING'	=> 'Annulation des modifications liées au schéma : %s.',

	'MIGRATION_INVALID_DATA_MISSING_CONDITION'		=> 'Le fichier de mise à jour contient une erreur. Une condition est manquante dans l’instruction « IF ».',
	'MIGRATION_INVALID_DATA_MISSING_STEP'			=> 'Le fichier de mise à jour contient une erreur. La commande appelée dans l’instruction « IF » est erronée.',
	'MIGRATION_INVALID_DATA_CUSTOM_NOT_CALLABLE'	=> 'Le fichier de mise à jour contient une erreur. Une fonction de rappel personnalisée n’a pas pu être appelée.',
	'MIGRATION_INVALID_DATA_UNKNOWN_TYPE'			=> 'Le fichier de mise à jour contient une erreur. Un type de données inconnu est utilisé dans l’outil de migration.',
	'MIGRATION_INVALID_DATA_UNDEFINED_TOOL'			=> 'Le fichier de mise à jour contient une erreur. L’outil de migration utilise une commande non définie.',
	'MIGRATION_INVALID_DATA_UNDEFINED_METHOD'		=> 'Le fichier de mise à jour contient une erreur. L’outil de migration utilise une méthode non définie.',

	'MODULE_ERROR'						=> 'Une erreur est survenue pendant la création du module : %s',
	'MODULE_EXISTS'						=> 'Un module porte déjà ce nom : %s',
	'MODULE_EXIST_MULTIPLE'				=> 'Plusieurs modules utilisent déjà le module parent ayant l’ID suivant : %s. Essayez d’utiliser les paramètres « before » ou « after » afin de préciser l’emplacement du module.',
	'MODULE_INFO_FILE_NOT_EXIST'		=> 'Un fichier d’information de module requis est manquant : %2$s',
	'MODULE_NOT_EXIST'					=> 'Un module requis est manquant : %s',

	'PARENT_MODULE_FIND_ERROR'			=> 'Impossible de déterminer l’ID du module parent : %s',
	'PERMISSION_NOT_EXIST'				=> 'La permission « %s » n’existe pas.',

	'ROLE_ASSIGNED_NOT_EXIST'			=> 'Le modèle de permissions assigné au groupe "%1$s" n’existe pas. ID de rôle : "%2$s"',
	'ROLE_NOT_EXIST'					=> 'Le modèle de permissions pour le rôle « %s » n’existe pas.',
));
