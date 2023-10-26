<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @copyright (c) 2010 phpBB.it
* @copyright (c) 2014 phpBBItalia.net <https://www.phpbbitalia.net>
* @copyright (c) 2018 phpBB-Store.it <https://www.phpbb-store.it>
* @copyright (c) 2021 phpBB-Italia.it <https://www.phpbb-italia.it>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
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
	'ALL_AVAILABLE'			=> 'Tutto disponibile',
	'ALL_RESULTS'			=> 'Tutti i risultati',

	'DISPLAY_RESULTS'		=> 'Mostra i risultati come',

	'FOUND_SEARCH_MATCHES'			=> array(
		1	=> 'La ricerca ha trovato %d risultato',
		2	=> 'La ricerca ha trovato %d risultati',
	),
	'FOUND_MORE_SEARCH_MATCHES'		=> array(
		1	=> 'La ricerca ha trovato più di %d risultato',
		2	=> 'La ricerca ha trovato più di %d risultati',
	),

	'GLOBAL'				=> 'Annuncio globale',

	'IGNORED_TERMS'			=> 'ignora',
	'IGNORED_TERMS_EXPLAIN'	=> 'Nella tua ricerca le seguenti parole sono state ignorate perché troppo comuni: <strong>%s</strong>.',

	'JUMP_TO_POST'			=> 'Vai al messaggio',

	'LOGIN_EXPLAIN_EGOSEARCH'	=> 'Devi essere iscritto e connesso per poter leggere i tuoi messaggi.',
	'LOGIN_EXPLAIN_UNREADSEARCH'=> 'Devi essere iscritto e connesso per poter visualizzare i messaggi non letti.',
	'LOGIN_EXPLAIN_NEWPOSTS'	=> 'Devi essere iscritto e connesso per visualizzare i nuovi messaggi successivi alla tua ultima visita.',

	'MAX_NUM_SEARCH_KEYWORDS_REFINE'	=> array(
		1	=> 'Hai indicato troppe parole da ricercare. Per favore inserisci non più di %1$d parola.',
		2	=> 'Hai indicato troppe parole da ricercare. Per favore inserisci non più di %1$d parole.',
	),

	'NO_KEYWORDS'			=> 'Devi specificare almeno una parola da cercare, ciascuna parola deve essere di almeno %s caratteri e non deve contenere più di %s caratteri, escluse le abbreviazioni.',
	'NO_RECENT_SEARCHES'	=> 'Nessuna ricerca è stata effettuata recentemente.',
	'NO_SEARCH'				=> 'Non ti è permesso di utilizzare il sistema di ricerca.',
	'NO_SEARCH_RESULTS'		=> 'Nessun argomento o messaggio con questo criterio di ricerca.',
	'NO_SEARCH_LOAD'		=> 'Siamo spiacenti ma in questo momento non è possibile effettuare la ricerca. Il server è sovraccarico. Si prega di riprovare più tardi.',
	'NO_SEARCH_TIME'		=> array(
		1	=> 'Al momento non ti è permesso fare ricerche. Riprova tra %d secondo.',
		2	=> 'Al momento non ti è permesso fare ricerche. Riprova tra %d secondi.',
	),
	'NO_SEARCH_UNREADS'		=> 'Siamo spiacenti ma la ricerca dei messaggi non letti è stata disabilitata in questa Board.',
	'WORD_IN_NO_POST'		=> 'Non sono stati trovati argomenti perché la parola <strong>%s</strong> non è contenuta in nessun messaggio.',
	'WORDS_IN_NO_POST'		=> 'Non sono stati trovati argomenti perché le parole <strong>%s</strong> non sono contenute in nessun messaggio.',

	'POST_CHARACTERS'			=> 'Caratteri dei messaggi',
	'PHRASE_SEARCH_DISABLED'	=> 'La ricerca per frase esatta non è supportata in questa Board.',

	'RECENT_SEARCHES'		=> 'Ricerche recenti',
	'RESULT_DAYS'			=> 'Limita risultati a',
	'RESULT_SORT'			=> 'Ordina risultati per',
	'RETURN_FIRST'			=> 'Restituisci i primi',
	'RETURN_FIRST_EXPLAIN'	=> 'Imposta su 0 per visualizzare l’intero messaggio.',
	'GO_TO_SEARCH_ADV'		=> 'Vai alla ricerca avanzata',

	'SEARCHED_FOR'				=> 'Termine di ricerca usato',
	'SEARCHED_TOPIC'			=> 'Argomento cercato',
	'SEARCHED_QUERY'			=> 'Query cercata',
	'SEARCH_ALL_TERMS'			=> 'Cerca per parola o usa frase esatta',
	'SEARCH_ANY_TERMS'			=> 'Ricerca qualsiasi termine',
	'SEARCH_AUTHOR'				=> 'Ricerca per autore',
	'SEARCH_AUTHOR_EXPLAIN'		=> 'Usa * come abbreviazione per parole parziali.',
	'SEARCH_FIRST_POST'			=> 'Solo il primo messaggio dell’argomento',
	'SEARCH_FORUMS'				=> 'Ricerca nei forum',
	'SEARCH_FORUMS_EXPLAIN'		=> 'Seleziona il/i forum in cui vuoi cercare. Per velocizzare la ricerca nei subforum seleziona il forum principale e abilita la ricerca.',
	'SEARCH_IN_RESULTS'			=> 'Cerca tra questi risultati',
	'SEARCH_KEYWORDS_EXPLAIN'	=> 'Metti un <strong>+</strong> davanti alla parola che deve essere cercata e un <strong>-</strong> davanti a quella che deve essere ignorata. Inserisci una lista di parole separate da <strong>|</strong> tra parentesi se solo una delle parole deve essere cercata. Usa * come abbreviazione per parole parziali.',
	'SEARCH_MSG_ONLY'			=> 'Solo il testo del messaggio',
	'SEARCH_OPTIONS'			=> 'Opzioni di Ricerca',
	'SEARCH_QUERY'				=> 'Motore di ricerca',
	'SEARCH_SUBFORUMS'			=> 'Cerca nei subforum',
	'SEARCH_TITLE_MSG'			=> 'Titolo e testo del messaggio',
	'SEARCH_TITLE_ONLY'			=> 'Solo tra i titoli degli argomenti',
	'SEARCH_WITHIN'				=> 'Cerca',
	'SORT_ASCENDING'			=> 'Crescente',
	'SORT_AUTHOR'				=> 'Autore',
	'SORT_DESCENDING'			=> 'Decrescente',
	'SORT_FORUM'				=> 'Forum',
	'SORT_POST_SUBJECT'			=> 'Oggetto del messaggio',
	'SORT_TIME'					=> 'Ora del messaggio',
	'SPHINX_SEARCH_FAILED'		=> 'Ricerca fallita: %s',
	'SPHINX_SEARCH_FAILED_LOG'	=> 'La ricerca non può essere eseguita. Ulteriori informazioni su questo fallimento sono state registrate nel log degli errori.',

	'TOO_FEW_AUTHOR_CHARS'	=> array(
		1	=> 'Devi specificare almeno %d carattere del nome dell’autore.',
		2	=> 'Devi specificare almeno %d caratteri del nome dell’autore.',
	),
));
