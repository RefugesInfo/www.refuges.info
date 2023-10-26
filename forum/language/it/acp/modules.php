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
	'ACP_MODULE_MANAGEMENT_EXPLAIN'	=> 'Qui puoi gestire tutti i tipi di moduli. Nota che il PCA ha una struttura menù a tre livelli (Categoria -> Categoria -> Modulo) per mezzo della quale gli altri hanno una struttura menù a due livelli (Categoria -> Modulo) che deve essere mantenuta. Fai attenzione che potresti rimaner bloccato fuori se disabiliti o cancelli i moduli responsabili della gestione stessa dei moduli.',
	'ADD_MODULE'					=> 'Aggiungi modulo',
	'ADD_MODULE_CONFIRM'			=> 'Sei sicuro di voler aggiungere il modulo selezionato con la modalità selezionata?',
	'ADD_MODULE_TITLE'				=> 'Aggiungi modulo',

	'CANNOT_REMOVE_MODULE'	=> 'Impossibile rimuovere il modulo. Rimuovi tutti i contenuti collegati prima di intraprendere questa azione.',
	'CATEGORY'				=> 'Categoria',
	'CHOOSE_MODE'			=> 'Scegli modalità modulo',
	'CHOOSE_MODE_EXPLAIN'	=> 'Scegli la modalità dei moduli che viene usata.',
	'CHOOSE_MODULE'			=> 'Scegli modulo',
	'CHOOSE_MODULE_EXPLAIN'	=> 'Sceglie il file che viene chiamato da questo modulo.',
	'CREATE_MODULE'			=> 'Crea nuovo modulo',

	'DEACTIVATED_MODULE'	=> 'Modulo disattivato',
	'DELETE_MODULE'			=> 'Cancella modulo',
	'DELETE_MODULE_CONFIRM'	=> 'Sei sicuro di voler rimuovere questo modulo?',

	'EDIT_MODULE'			=> 'Modifica modulo',
	'EDIT_MODULE_EXPLAIN'	=> 'Qui puoi inserire impostazioni specifiche per il modulo.',

	'HIDDEN_MODULE'			=> 'Modulo nascosto',

	'MODULE'					=> 'Modulo',
	'MODULE_ADDED'				=> 'Modulo aggiunto.',
	'MODULE_DELETED'			=> 'Modulo rimosso.',
	'MODULE_DISPLAYED'			=> 'Modulo visualizzato',
	'MODULE_DISPLAYED_EXPLAIN'	=> 'Se desideri che questo modulo non venga visualizzato, ma vuoi usarlo, imposta su NO.',
	'MODULE_EDITED'				=> 'Modulo modificato.',
	'MODULE_ENABLED'			=> 'Modulo abilitato',
	'MODULE_LANGNAME'			=> 'Nome lingua modulo',
	'MODULE_LANGNAME_EXPLAIN'	=> 'Inserisci il nome modulo visualizzato. Utilizza la costante di lingua se il nome viene recuperato dal pacchetto lingua.',
	'MODULE_TYPE'				=> 'Tipo di modulo',

	'NO_CATEGORY_TO_MODULE'	=> 'Impossibile convertire la categoria in modulo. Rimuovere o spostare tutti i moduli figlio prima di intraprendere questa azione.',
	'NO_MODULE'				=> 'Nessun modulo trovato.',
	'NO_MODULE_ID'			=> 'Nessun id modulo specificato.',
	'NO_MODULE_LANGNAME'	=> 'Nessun nome lingua modulo specificato.',
	'NO_PARENT'				=> 'Nessun modulo padre',

	'PARENT'				=> 'Modulo padre',
	'PARENT_NO_EXIST'		=> 'Non esiste modulo padre.',

	'SELECT_MODULE'			=> 'Seleziona un modulo',
));
