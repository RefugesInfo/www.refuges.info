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

$lang = array_merge($lang, array(
	'CAPTCHA_QA'				=> 'Q&amp;A',
	'CONFIRM_QUESTION_EXPLAIN'	=> 'Cette question est un moyen d’empêcher des soumissions automatisées de formulaires par des robots.',
	'CONFIRM_QUESTION_WRONG'	=> 'Vous avez fourni une réponse invalide à la question.',
	'CONFIRM_QUESTION_MISSING'	=> 'Les questions n’ont pas pu être récupérées. Veuillez contacter l’administrateur du forum.',

	'QUESTION_ANSWERS'			=> 'Réponses',
	'ANSWERS_EXPLAIN'			=> 'Saisissez des réponses valides à la question, une par ligne.',
	'CONFIRM_QUESTION'			=> 'Question',

	'ANSWER'					=> 'Réponse',
	'EDIT_QUESTION'				=> 'Modifier la question',
	'QUESTIONS'					=> 'Questions',
	'QUESTIONS_EXPLAIN'			=> 'Pour chaque soumission d’un formulaire où vous avez activé le plugin Q&amp;A, les utilisateurs seront invités à répondre à une des questions indiquées ici. Pour utiliser ce plugin, au moins une question doit être définie dans la langue par défaut. Il devrait être simple pour votre public cible de répondre à ces questions, mais au-delà de la capacité d’un robot à lancer une recherche Google™. Une seule bonne question est nécessaire. Si vous commencez à constater du SPAM lors des enregistrements, modifiez la question. Activez le contrôle strict si votre question doit prendre en compte la casse des caractères, la ponctuation ou les espaces.',
	'QUESTION_DELETED'			=> 'Question supprimée',
	'QUESTION_LANG'				=> 'Langue',
	'QUESTION_LANG_EXPLAIN'		=> 'La langue dans laquelle la question et sa réponse ont été écrites.',
	'QUESTION_STRICT'			=> 'Contrôle strict',
	'QUESTION_STRICT_EXPLAIN'	=> 'Si activé, la casse des caractères, la ponctuation et les espaces seront pris en compte.',

	'QUESTION_TEXT'				=> 'Question',
	'QUESTION_TEXT_EXPLAIN'		=> 'La question présentée à l’utilisateur.',

	'QA_ERROR_MSG'				=> 'Complétez tous les champs et écrivez au moins une réponse.',
	'QA_LAST_QUESTION'			=> 'Vous ne pouvez pas supprimer toutes les questions tant que le plugin est actif.',
));
