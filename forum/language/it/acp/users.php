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
	'ADMIN_SIG_PREVIEW'		=> 'Anteprima firma',
	'AT_LEAST_ONE_FOUNDER'	=> 'Questo utente è l’unico fondatore, non puoi farlo diventare un utente normale. Nel forum deve esserci per lo meno un socio fondatore. Se devi cambiare lo stato di questo utente fondatore, è prima obbligatorio promuovere un altro utente a fondatore.',

	'BAN_ALREADY_ENTERED'	=> 'È già stato accettato un ban. La lista ban non è aggiornata.',
	'BAN_SUCCESSFUL'		=> 'Ban utente eseguito.',

	'CANNOT_BAN_ANONYMOUS'			=> 'Non puoi bannare l’account <strong>anonymous</strong>. I permessi per <strong>anonymous</strong> possono essere configurati nella scheda dei Permessi.',
	'CANNOT_BAN_FOUNDER'			=> 'Non puoi bannare l’account di un utente fondatore.',
	'CANNOT_BAN_YOURSELF'			=> 'Non puoi bannare te stesso.',
	'CANNOT_DEACTIVATE_BOT'			=> 'Non puoi disattivare l’account di un Bot. In alternativa disattiva il Bot dalla pagina dedicata ai Bot.',
	'CANNOT_DEACTIVATE_FOUNDER'		=> 'Non puoi disattivare l’account di un utente fondatore.',
	'CANNOT_DEACTIVATE_YOURSELF'	=> 'Non puoi disattivare il tuo account.',
	'CANNOT_FORCE_REACT_BOT'		=> 'Non puoi forzare la riattivazione di un Bot. In alternativa riattiva il Bot dalla pagina dedicata ai Bot.',
	'CANNOT_FORCE_REACT_FOUNDER'	=> 'Non puoi forzare la riattivazione dell’account di un utente fondatore.',
	'CANNOT_FORCE_REACT_YOURSELF'	=> 'Non puoi forzare la riattivazione del tuo account.',
	'CANNOT_REMOVE_ANONYMOUS'		=> 'Non puoi eliminare l’account Ospite.',
	'CANNOT_REMOVE_FOUNDER'			=> 'Non sei autorizzato a rimuovere gli account fondatori.',
	'CANNOT_REMOVE_YOURSELF'		=> 'Non è possibile rimuovere il proprio account utente.',
	'CANNOT_SET_FOUNDER_IGNORED'	=> 'Non puoi promuovere utenti ignorati al grado di fondatori.',
	'CANNOT_SET_FOUNDER_INACTIVE'	=> 'È necessario attivare gli utenti prima di promuoverli a fondatori; solo gli utenti attivi possono essere promossi.',
	'CONFIRM_EMAIL_EXPLAIN'			=> 'Questo va specificato solamente se stai cambiando l’indirizzo email dell’utente.',

	'DELETE_POSTS'			=> 'Cancella messaggi',
	'DELETE_USER'			=> 'Cancella utente',
	'DELETE_USER_EXPLAIN'	=> 'Attenzione: l’account dell’utente eliminato, non potrà essere recuperato. I messaggi privati non letti inviati da questo utente, saranno cancellati e non saranno quindi a disposizione dei rispettivi destinatari.',

	'FORCE_REACTIVATION_SUCCESS'	=> 'Riabilitazione forzata effettuata correttamente.',
	'FOUNDER'						=> 'Fondatore',
	'FOUNDER_EXPLAIN'				=> 'I fondatori hanno tutti i privilegi di amministrazione e non possono essere bannati, cancellati o modificati dagli utenti non fondatori.',

	'GROUP_APPROVE'					=> 'Approva membro',
	'GROUP_DEFAULT'					=> 'Crea gruppo predefinito per l’utente',
	'GROUP_DELETE'					=> 'Elimina membro dal gruppo',
	'GROUP_DEMOTE'					=> 'Retrocedi leader del gruppo',
	'GROUP_PROMOTE'					=> 'Promuovi a leader del gruppo',

	'IP_WHOIS_FOR'			=> 'IP whois per %s',

	'LAST_ACTIVE'			=> 'Ultimo accesso',

	'MOVE_POSTS_EXPLAIN'	=> 'Seleziona il forum al quale vuoi trasportare tutti i messaggi che questo utente ha fatto.',

	'NO_SPECIAL_RANK'		=> 'Nessun livello speciale assegnato',
	'NO_WARNINGS'           => 'Nessun richiamo.',
	'NOT_MANAGE_FOUNDER'	=> 'Stai amministrando un fondatore. Solo un fondatore può amministrare altri fondatori.',

	'QUICK_TOOLS'			=> 'Strumenti veloci',

	'REGISTERED'			=> 'Registrato',
	'REGISTERED_IP'			=> 'Registrato da IP',
	'RETAIN_POSTS'			=> 'Trattieni messaggi',

	'SELECT_FORM'			=> 'Seleziona campo',
	'SELECT_USER'			=> 'Seleziona utente',

	'USER_ADMIN'					=> 'Gestione utenti',
	'USER_ADMIN_ACTIVATE'			=> 'Attiva account',
	'USER_ADMIN_ACTIVATED'			=> 'Utente attivato.',
	'USER_ADMIN_AVATAR_REMOVED'		=> 'Avatar rimosso.',
	'USER_ADMIN_BAN_EMAIL'			=> 'Ban per email',
	'USER_ADMIN_BAN_EMAIL_REASON'	=> 'L’indirizzo email è stato bannato',
	'USER_ADMIN_BAN_IP'				=> 'Ban per IP',
	'USER_ADMIN_BAN_IP_REASON'		=> 'L’IP utente è stato bannato',
	'USER_ADMIN_BAN_NAME_REASON'	=> 'Nome utente bannato',
	'USER_ADMIN_BAN_USER'			=> 'Ban per nome utente',
	'USER_ADMIN_DEACTIVATE'			=> 'Disattiva account',
	'USER_ADMIN_DEACTIVED'			=> 'Utente disattivato.',
	'USER_ADMIN_DEL_ATTACH'			=> 'Cancella tutti gli allegati',
	'USER_ADMIN_DEL_AVATAR'			=> 'Cancella avatar',
	'USER_ADMIN_DEL_OUTBOX'         => 'Vuota casella Messaggi in uscita',
	'USER_ADMIN_DEL_POSTS'			=> 'Cancella tutti i messaggi',
	'USER_ADMIN_DEL_SIG'			=> 'Cancella firma',
	'USER_ADMIN_EXPLAIN'			=> 'Qui puoi cambiare le informazioni degli utenti ed alcune opzioni specifiche.',
	'USER_ADMIN_FORCE'				=> 'Forza riabilitazione',
	'USER_ADMIN_LEAVE_NR'           => 'Rimuovi da Nuovi Utenti Registrati',
	'USER_ADMIN_MOVE_POSTS'			=> 'Sposta tutti i messaggi',
	'USER_ADMIN_SIG_REMOVED'		=> 'Firma rimossa.',
	'USER_ATTACHMENTS_REMOVED'		=> 'Allegati inseriti dall’utente eliminati.',
	'USER_AVATAR_NOT_ALLOWED'       => 'L’avatar non può essere visualizzato perché gli avatar non sono stati disabilitati.',
	'USER_AVATAR_UPDATED'			=> 'Avatar aggiornato.',
	'USER_AVATAR_TYPE_NOT_ALLOWED'  => 'L’attuale avatar non può essere visualizzato perché quel particolare tipo è stato disabilitato.',
	'USER_CUSTOM_PROFILE_FIELDS'	=> 'Campi del profilo',
	'USER_DELETED'					=> 'Utente eliminato.',
	'USER_GROUP_ADD'				=> 'Aggiungi utente al gruppo',
	'USER_GROUP_NORMAL'				=> 'L’utente fa già parte del gruppo',
	'USER_GROUP_PENDING'			=> 'L’utente del gruppo è impostato in modalità "pendente"',
	'USER_GROUP_SPECIAL'			=> 'L’utente è membro del gruppo speciale',
	'USER_LIFTED_NR'                => 'Lo stato di nuovo utente registrato è stato rimosso.',
	'USER_NO_ATTACHMENTS'			=> 'Non ci sono file allegati da visualizzare.',
	'USER_NO_POSTS_TO_DELETE'		=> 'L’utente non ha messaggi da conservare o cancellare.',
	'USER_OUTBOX_EMPTIED'           => 'La casella Messaggi in uscita dell’utente è stata vuotata con successo.',
	'USER_OUTBOX_EMPTY'             => 'La casella Messaggi in uscita dell’utente era già vuota.',
	'USER_OVERVIEW_UPDATED'			=> 'Dettagli utente aggiornati.',
	'USER_POSTS_DELETED'			=> 'Tutti i messaggi dell’utente sono stati cancellati.',
	'USER_POSTS_MOVED'				=> 'Messaggi spostati al forum selezionato.',
	'USER_PREFS_UPDATED'			=> 'Opzioni utente aggiornate.',
	'USER_PROFILE'					=> 'Profilo utente',
	'USER_PROFILE_UPDATED'			=> 'Profilo utente aggiornato.',
	'USER_RANK'						=> 'Livello utente',
	'USER_RANK_UPDATED'				=> 'Livello utente aggiornato.',
	'USER_SIG_UPDATED'				=> 'Firma aggiornata.',
	'USER_WARNING_LOG_DELETED'      => 'Nessuna informazione disponibile; è possibile che la registrazione del log sia stata cancellata.',
	'USER_TOOLS'					=> 'Strumenti di base',
));
