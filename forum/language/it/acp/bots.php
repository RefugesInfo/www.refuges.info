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

// Bot settings
$lang = array_merge($lang, array(
	'BOTS'				=> 'Gestione Bot',
	'BOTS_EXPLAIN'		=> '“Bot”, “spider” o “crawler” sono agenti automatizzati usati comunemente dai motori di ricerca per aggiornare i loro database. Dal momento che raramente fanno un uso corretto delle sessioni, possono distorcere il valore del contatore visite, aumentare il carico e talvolta non riescono a indicizzare i siti correttamente. Qui potete definire un tipo speciale di utente in modo tale da ovviare a questi problemi.',
	'BOT_ACTIVATE'		=> 'Attiva',
	'BOT_ACTIVE'		=> 'Attiva Bot',
	'BOT_ADD'			=> 'Aggiungi Bot',
	'BOT_ADDED'			=> 'Nuovo Bot aggiunto.',
	'BOT_AGENT'			=> 'Agent match',
	'BOT_AGENT_EXPLAIN'	=> 'Una stringa che corrisponda all’agent visualizzatore del Bot; sono permessi match parziali.',
	'BOT_DEACTIVATE'	=> 'Disattiva',
	'BOT_DELETED'		=> 'Bot cancellato.',
	'BOT_EDIT'			=> 'Modifica Bot',
	'BOT_EDIT_EXPLAIN'	=> 'Qui puoi aggiungere o modificare un Bot esistente. Devi definire una stringa agent e/o uno o più indirizzi IP (o gamma di indirizzi) corrispondenti. Fai attenzione definendo le stringhe o gli indirizzi agent corrispondenti. Puoi anche specificare uno stile e una lingua che il Bot vedrà nella Board. Questo può permetterti di ridurre l’uso di banda usando uno stile semplice per i Bot. Ricorda di mettere le autorizzazioni appropriate al gruppo speciale Bot.',
	'BOT_LANG'			=> 'Lingua del Bot',
	'BOT_LANG_EXPLAIN'	=> 'La lingua che si presenta al Bot quando fa ricerca.',
	'BOT_LAST_VISIT'	=> 'Ultima visita',
	'BOT_IP'			=> 'Indirizzo IP del Bot',
	'BOT_IP_EXPLAIN'	=> 'Confronti parziali consentiti: separa gli indirizzi con una virgola.',
	'BOT_NAME'			=> 'Nome del Bot',
	'BOT_NAME_EXPLAIN'	=> 'Utilizzato solo per tua informazione.',
	'BOT_NAME_TAKEN' 	=> 'Il nome è già in uso nella Board e non puoi assegnarlo al Bot.',
	'BOT_NEVER'			=> 'Mai',
	'BOT_STYLE'			=> 'Stile del Bot',
	'BOT_STYLE_EXPLAIN'	=> 'Lo stile utilizzato dal Bot per la Board.',
	'BOT_UPDATED'		=> 'Bot esistente aggiornato con successo.',

	'ERR_BOT_AGENT_MATCHES_UA'	=> 'L’agent del Bot che hai fornito è simile a quello che utilizzi attualmente. Per favore regola l’agent per questo Bot.',
	'ERR_BOT_NO_IP'				=> 'Gli indirizzi IP che hai fornito non sono validi o l’hostname non ha potuto essere risolto.',
	'ERR_BOT_NO_MATCHES'		=> 'Devi fornire almeno un agent o un IP per questo Bot.',

	'NO_BOT'		=> 'Nessun Bot trovato con l’ID specificato.',
	'NO_BOT_GROUP'	=> 'Impossibile trovare gruppo Bot speciale.',
));
