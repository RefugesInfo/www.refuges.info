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
	'CAPTCHA_QA'				=> 'Q&amp;A',
	'CONFIRM_QUESTION_EXPLAIN'	=> 'Questa domanda serve a prevenire iscrizioni automatiche.',
	'CONFIRM_QUESTION_WRONG'	=> 'La risposta alla domanda di conferma di registrazione, non è corretta.',
	'CONFIRM_QUESTION_MISSING'	=> 'Le domande relative al captcha non potevano essere recuperate. Contatta l’amministratore.',
	'QUESTION_ANSWERS'			=> 'Risposte',
	'ANSWERS_EXPLAIN'			=> 'Inserisci risposte valide alla domanda, una per riga.',
	'CONFIRM_QUESTION'			=> 'Domanda',

	'ANSWER'					=> 'Risposta',
	'EDIT_QUESTION'				=> 'Modifica Domanda',
	'QUESTIONS'					=> 'Domande',
	'QUESTIONS_EXPLAIN'			=> 'Per ogni invio di moduli in cui è stato abilitato il plugin Q&amp;A, gli utenti saranno invitati a rispondere a una delle domande qui specificate. Per usare questo plugin, almeno una domanda deve essere impostata nella lingua predefinita. Queste domande dovrebbero essere facili per il vostro target di riferimento, al di là della capacità di un Bot in grado di eseguire una ricerca su Google™. Utilizzando una grande e regolarmente modificata serie di domande, si avranno i risultati migliori. Abilita il controllo rigoroso, se la tua domanda tiene conto della punteggiatura o dell’uso di iniziali maiuscole.',
	'QUESTION_DELETED'			=> 'Domanda cancellata',
	'QUESTION_LANG'				=> 'Lingua',
	'QUESTION_LANG_EXPLAIN'		=> 'La lingua della domanda e delle sue risposte.',
	'QUESTION_STRICT'			=> 'Controllo rigoroso',
	'QUESTION_STRICT_EXPLAIN'	=> 'Se abilitato, si terrà conto delle iniziali maiuscole e degli spazi.',

	'QUESTION_TEXT'				=> 'Domanda',
	'QUESTION_TEXT_EXPLAIN'		=> 'La domanda che sarà richiesta al momento della registrazione.',

	'QA_ERROR_MSG'				=> 'Si prega di compilare tutti i campi e inserire almeno una risposta.',
	'QA_LAST_QUESTION'			=> 'Non puoi cancellare tutte le domande prima che il plugin sia attivo.',
));
