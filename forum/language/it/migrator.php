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
	'CONFIG_NOT_EXIST'					=> 'L’impostazione di configurazione "%s" non esiste.',

	'GROUP_NOT_EXIST'					=> 'Il gruppo "%s" non esiste.',

	'MIGRATION_APPLY_DEPENDENCIES'		=> 'Applica le dipendenze di %s.',
	'MIGRATION_DATA_DONE'				=> 'Installazione dati: %1$s; tempo: %2$.2f secondi',
	'MIGRATION_DATA_IN_PROGRESS'		=> 'Installazione dati in corso: %1$s; tempo: %2$.2f secondi',
	'MIGRATION_DATA_RUNNING'			=> 'Installazione dati: %s.',
	'MIGRATION_EFFECTIVELY_INSTALLED'	=> 'Migrazione già installata (richiesta ignorata): %s',
	'MIGRATION_EXCEPTION_ERROR'			=> 'Qualcosa non ha funzionato a dovere durante la richiesta, ed è stata generata un’eccezione. Le modifiche apportate prima del verificarsi dell’errore sono state corrette nel modo migliore possibile, ma si raccomanda di controllare la Board per verificare eventuali errori.',
	'MIGRATION_NOT_FULFILLABLE'			=> 'La migrazione "%1$s" non è funzionante, migrazione mancante "%2$s".',
	'MIGRATION_NOT_INSTALLED'			=> 'La migrazione "%s" non è stata installata.',
	'MIGRATION_NOT_VALID'				=> '%s non è una migrazione valida.',
	'MIGRATION_SCHEMA_DONE'				=> 'Schema installato: %1$s; tempo: %2$.2f secondi',
	'MIGRATION_SCHEMA_IN_PROGRESS'		=> 'Installazione schema: %1$s; tempo: %2$.2f secondi',
	'MIGRATION_SCHEMA_RUNNING'			=> 'Installazione schema: %s.',
	'MIGRATION_REVERT_DATA_DONE'		=> 'Dati ripristinati: %1$s; tempo: %2$.2f secondi',
	'MIGRATION_REVERT_DATA_IN_PROGRESS'	=> 'Avanzamento ripristino dati: %1$s; tempo: %2$.2f secondi',
	'MIGRATION_REVERT_DATA_RUNNING'		=> 'Dati in ripristino: %s.',
	'MIGRATION_REVERT_SCHEMA_DONE'		=> 'Schema ripristinato: %1$s; tempo: %2$.2f secondi',
	'MIGRATION_REVERT_SCHEMA_IN_PROGRESS'	=> 'Ripristino schema: %1$s; tempo: %2$.2f secondi',
	'MIGRATION_REVERT_SCHEMA_RUNNING'	=> 'Avanzamento ripristino Schema: %s.',

	'MIGRATION_INVALID_DATA_MISSING_CONDITION'		=> 'Una migrazione è invalida. In una dichiarazione di aiuto manca una condizione.',
	'MIGRATION_INVALID_DATA_MISSING_STEP'			=> 'Una migrazione è invalida. In una dichiarazione di aiuto manca una valida chiamata ad una fase di migrazione.',
	'MIGRATION_INVALID_DATA_CUSTOM_NOT_CALLABLE'	=> 'Una migrazione è invalida. Una funzione personalizzata richiamabile non potrebbe essere chiamata.',
	'MIGRATION_INVALID_DATA_UNKNOWN_TYPE'			=> 'Una migrazione è invalida. È stato individuato un tipo di strumento di migrazione sconosciuto.',
	'MIGRATION_INVALID_DATA_UNDEFINED_TOOL'			=> 'Una migrazione è invalida. È stato rilevato uno strumento di migrazione non definito.',
	'MIGRATION_INVALID_DATA_UNDEFINED_METHOD'		=> 'Una migrazione è invalida. È stato rilevato un metodo di strumento di migrazione non definito.',

	'MODULE_ERROR'						=> 'Errore durante la creazione di un modulo: %s',
	'MODULE_EXISTS'						=> 'Esiste già un modulo: %s',
	'MODULE_EXIST_MULTIPLE'				=> 'Esistono già diversi moduli con il genitore modulo langname: %s. Prova a utilizzare prima/dopo le chiavi per chiarire la posizione del modulo.',
	'MODULE_INFO_FILE_NOT_EXIST'		=> 'Il file di informazioni modulo richiesto non esiste: %2$s',
	'MODULE_NOT_EXIST'					=> 'Il modulo richiesto non esiste: %s',

	'PARENT_MODULE_FIND_ERROR'			=> 'Impossibile determinare l’identificatore del modulo genitore: %s',
	'PERMISSION_NOT_EXIST'				=> 'L’autorizzazione permessi "%s" non esiste.',

	'ROLE_ASSIGNED_NOT_EXIST'			=> 'Il ruolo di autorizzazione assegnato al gruppo "%1$s" inaspettatamente non esiste. ID ruolo: "%2$s"',
	
	'ROLE_NOT_EXIST'					=> 'L’autorizzazione ruolo "%s" non esiste.',
));
