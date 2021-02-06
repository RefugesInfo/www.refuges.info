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
	'ALL_AVAILABLE'			=> 'Tous disponibles',
	'ALL_RESULTS'			=> 'Tous les résultats',

	'DISPLAY_RESULTS'		=> 'Afficher les résultats sous forme de',

	'FOUND_SEARCH_MATCHES'		=> array(
		1	=> '%d résultat trouvé',
		2	=> '%d résultats trouvés',
	),
	'FOUND_MORE_SEARCH_MATCHES'		=> array(
		1	=> 'Plus de %d résultat a été trouvé',
		2	=> 'Plus de %d résultats ont été trouvés',
	),

	'GLOBAL'				=> 'Annonce globale',

	'IGNORED_TERMS'			=> 'ignoré',
	'IGNORED_TERMS_EXPLAIN'	=> 'Les mots suivants de votre recherche ont été ignorés parce qu’ils sont trop communs : <strong>%s</strong>.',

	'JUMP_TO_POST'			=> 'Aller au message',

	'LOGIN_EXPLAIN_EGOSEARCH'		=> 'Vous devez être enregistré et connecté afin de voir vos propres messages.',
	'LOGIN_EXPLAIN_UNREADSEARCH'	=> 'Vous devez être enregistré et connecté afin de voir les messages non lus.',
	'LOGIN_EXPLAIN_NEWPOSTS'		=> 'Vous devez être enregistré et connecté afin de voir les nouveaux messages depuis votre dernière visite.',

	'MAX_NUM_SEARCH_KEYWORDS_REFINE'	=> array(
		1	=> 'Vous avez spécifié un nombre de mots trop important à rechercher. Ne saisissez pas plus de %1$d mot.',
		2	=> 'Vous avez spécifié un nombre de mots trop important à rechercher. Ne saisissez pas plus de %1$d mots.',
	),

	'NO_KEYWORDS'			=> 'Vous devez indiquer au moins un mot pour effectuer une recherche. Chaque mot doit être composé d’au moins %s et ne doit pas contenir plus de %s en excluant les jokers.',
	'NO_RECENT_SEARCHES'	=> 'Aucune recherche n’a été effectuée récemment.',
	'NO_SEARCH'				=> 'Désolé mais vous n’êtes pas autorisé à utiliser le système de recherche.',
	'NO_SEARCH_RESULTS'		=> 'Aucun sujet ou message ne correspond à vos critères de recherche.',
	'NO_SEARCH_LOAD'		=> 'Désolé mais la fonction de recherche ne peut pas être utilisée car le serveur est trop sollicité. Veuillez réessayer ultérieurement.',
	'NO_SEARCH_TIME'		=> array(
		1	=> 'Désolé mais vous ne pouvez pas utiliser la fonction recherche actuellement. Veuillez réessayer dans %d seconde.',
		2	=> 'Désolé mais vous ne pouvez pas utiliser la fonction recherche actuellement. Veuillez réessayer dans %d secondes.',
	),
	'NO_SEARCH_UNREADS'		=> 'Désolé mais la recherche des messages non lus a été désactivée sur ce forum.',
	'WORD_IN_NO_POST'		=> 'Aucun résultat trouvé pour le mot <strong>%s</strong>.',
	'WORDS_IN_NO_POST'		=> 'Aucun résultat trouvé pour les mots <strong>%s</strong>.',

	'POST_CHARACTERS'		=> 'premiers caractères des messages',
	'PHRASE_SEARCH_DISABLED'	=> 'La recherche par phrase exacte n’est pas prise en charge sur ce forum.',

	'RECENT_SEARCHES'		=> 'Recherches récentes',
	'RESULT_DAYS'			=> 'Rechercher depuis',
	'RESULT_SORT'			=> 'Classer les résultats par',
	'RETURN_FIRST'			=> 'Renvoyer les',
	'RETURN_FIRST_EXPLAIN'	=> 'Définir à 0 pour afficher l’intégralité du message.',
	'GO_TO_SEARCH_ADV'		=> 'Aller à la recherche avancée',

	'SEARCHED_FOR'				=> 'Rechercher les termes utilisés',
	'SEARCHED_TOPIC'			=> 'Sujet recherché',
	'SEARCHED_QUERY'			=> 'Requête recherchée',
	'SEARCH_ALL_TERMS'			=> 'Rechercher tous les termes',
	'SEARCH_ANY_TERMS'			=> 'Rechercher n’importe lequel de ces termes',
	'SEARCH_AUTHOR'				=> 'Rechercher par auteur',
	'SEARCH_AUTHOR_EXPLAIN'		=> 'Utilisez le caractère « * » comme joker pour des recherches partielles.',
	'SEARCH_FIRST_POST'			=> 'Premier message des sujets uniquement',
	'SEARCH_FORUMS'				=> 'Rechercher dans les forums',
	'SEARCH_FORUMS_EXPLAIN'		=> 'Choisissez le forum ou les forums dans le(s)quel(s) vous souhaitez effectuer une recherche. Les sous-forums sont automatiquement inclus si vous ne désactivez pas l’option ci-dessous « Rechercher dans les sous-forums ».',
	'SEARCH_IN_RESULTS'			=> 'Affiner la recherche…',
	'SEARCH_KEYWORDS_EXPLAIN'	=> 'Placez un <strong>+</strong> devant un mot qui doit être trouvé et un <strong>-</strong> devant un mot qui doit être exclu. Saisissez une suite de mots séparés par des <strong>|</strong> entre crochets si uniquement un des mots doit être trouvé. Utilisez le caractère « * » comme joker pour des recherches partielles.',
	'SEARCH_MSG_ONLY'			=> 'Messages uniquement',
	'SEARCH_OPTIONS'			=> 'Options de recherche',
	'SEARCH_QUERY'				=> 'Rechercher',
	'SEARCH_SUBFORUMS'			=> 'Rechercher dans les sous-forums',
	'SEARCH_TITLE_MSG'			=> 'Titres et messages',
	'SEARCH_TITLE_ONLY'			=> 'Titres uniquement',
	'SEARCH_WITHIN'				=> 'Rechercher dans',
	'SORT_ASCENDING'			=> 'Croissant',
	'SORT_AUTHOR'				=> 'Auteur',
	'SORT_DESCENDING'			=> 'Décroissant',
	'SORT_FORUM'				=> 'Forum',
	'SORT_POST_SUBJECT'			=> 'Sujet du message',
	'SORT_TIME'					=> 'Date',
	'SPHINX_SEARCH_FAILED'		=> 'Échec de la recherche : %s',
	'SPHINX_SEARCH_FAILED_LOG'	=> 'Désolé, la recherche n’a pu aboutir. Les informations relatives à cette erreur on été consignées dans le journal des erreurs.',

	'TOO_FEW_AUTHOR_CHARS'	=> array(
		1	=> 'Vous devez indiquer au moins %d caractère du nom de l’auteur.',
		2	=> 'Vous devez indiquer au moins %d caractères du nom de l’auteur.',
	),
));
