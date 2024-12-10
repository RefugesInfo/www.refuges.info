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
	'ACP_PERMISSIONS_EXPLAIN'	=> '
		<p>I permessi sono specifici e raggruppati in quattro sezioni importanti, che sono:</p>

		<h2>Permessi globali</h2>
		<p>Sono usati per controllare l’accesso a livello globale e si applicano all’intera Board. Sono suddivisi in permessi utente, permessi gruppi, amministratori e moderatori globali.</p>

		<h2>Permessi forum</h2>
		<p>Sono usati per controllare l’accesso a livello del singolo forum. Sono suddivisi in permessi forum, moderatori, permessi forum utente e permessi forum gruppi.</p>

		<h2>Ruolo permessi</h2>
		<p>Sono usati per generare diversi insiemi di permessi per i vari tipi di permesso, che successivamente possono essere assegnati su base di ruolo. I ruoli predefiniti dovrebbero permettere la gestione di Board grandi e piccole, in ogni caso all’interno di ciascuna delle quattro sezioni puoi aggiungere/modificare/eliminare ruoli a seconda delle tue necessità.</p>

		<h2>Permessi assegnati</h2>
		<p>Servono per visualizzare facilmente i permessi effettivi assegnati a utenti, moderatori (globali e di forum), amministratori o forum.</p>

		<br />

		<p>Per ulteriori informazioni su parametrizzazione e gestione dei permessi sul tuo phpBB3, leggi <a href="https://www.phpbb.com/support/docs/en/3.3/ug/quickstart/permissions/">Impostazioni permessi della Quick Start Guide</a>.</p>
	',

	'ACL_NEVER'				=> 'Mai',
	'ACL_SET'				=> 'Imposta permessi',
	'ACL_SET_EXPLAIN'		=> 'I permessi sono basati su un semplice sistema <strong>SI</strong>/<strong>NO</strong>. Impostare un’opzione su <strong>MAI</strong>, per un utente o gruppo, escluderà ogni altro valore assegnatogli. Se non vuoi assegnare un valore per l’opzione, per questo utente o gruppo, seleziona <strong>NO</strong>. Se da altre parti sono assegnati valori per queste opzioni saranno usate come preferenza, altrimenti sarà considerato <strong>MAI</strong>. Ogni oggetto selezionato (con la casella di fronte) copierà il set permessi che hai definito. Tieni presente che l’impostazione delle autorizzazioni amministrative per gli account dei fondatori non ha alcun effetto poiché le autorizzazioni amministrative sono sempre impostate su <strong>SÌ</strong> per i fondatori.',
	'ACL_SETTING'			=> 'Impostazione',

	'ACL_TYPE_A_'			=> 'Permessi amministratore',
	'ACL_TYPE_F_'			=> 'Permessi forum',
	'ACL_TYPE_M_'			=> 'Permessi moderatore',
	'ACL_TYPE_U_'			=> 'Permessi utente',

	'ACL_TYPE_GLOBAL_A_'	=> 'Permessi amministratore',
	'ACL_TYPE_GLOBAL_U_'	=> 'Permessi utente',
	'ACL_TYPE_GLOBAL_M_'	=> 'Permessi moderatore globale',
	'ACL_TYPE_LOCAL_M_'		=> 'Permessi moderatore forum',
	'ACL_TYPE_LOCAL_F_'		=> 'Permessi forum',

	'ACL_NO'				=> 'No',
	'ACL_VIEW'				=> 'Visualizza permessi',
	'ACL_VIEW_EXPLAIN'		=> 'Qui puoi vedere effettivamente quali permessi hanno utente/gruppo. Un quadrato rosso indica che utente/gruppo non ha il permesso, un quadrato verde indica che utente/gruppo ha il permesso.',
	'ACL_YES'				=> 'Sì',

	'ACP_ADMINISTRATORS_EXPLAIN'				=> 'Qui puoi assegnare i permessi amministratore ad utenti o gruppi. Tutti gli utenti con permessi da amministratore possono accedere al pannello di controllo amministratore.',
	'ACP_FORUM_MODERATORS_EXPLAIN'				=> 'Qui puoi assegnare utenti e gruppi come moderatori di forum. Per assegnare l’accesso di utenti ai forum, per definire i permessi di moderazione globale o di amministratore, usa la pagina adatta.',
	'ACP_FORUM_PERMISSIONS_EXPLAIN'				=> 'Qui puoi modificare quali utenti e gruppi possono accedere a quali forum. Per assegnare moderatori o definire amministratori, usa la pagina adatta.',
	'ACP_FORUM_PERMISSIONS_COPY_EXPLAIN'		=> 'Qui puoi copiare i permessi forum da un forum, per uno o più forum.',
	'ACP_GLOBAL_MODERATORS_EXPLAIN'				=> 'Qui puoi assegnare i permessi moderatore globale ad utenti o gruppi. Questi moderatori sono come i normali moderatori, solo che possono accedere a qualsiasi forum della Board.',
	'ACP_GROUPS_FORUM_PERMISSIONS_EXPLAIN'		=> 'Qui puoi assegnare i permessi forum ai gruppi.',
	'ACP_GROUPS_PERMISSIONS_EXPLAIN'			=> 'Qui puoi assegnare i permessi globali ai gruppi: permessi utente, permessi di moderazione globale e permessi amministratore. I permessi utente consentono l’uso di avatar, l’invio di messaggi privati, eccetera; i permessi di moderatore globale consentono di approvare messaggi, gestire argomenti, gestire i ban, eccetera; infine i permessi amministratore consentono di modificare i permessi, definire BBCodes personalizzati, gestire forum, eccetera. Per modificare le impostazioni ad un gran numero di utenti, è preferibile utilizzare i permessi gruppi. I permessi utente individuali dovrebbero essere cambiati in rare occasioni: il metodo migliore è inserire gli utenti in gruppi per poi assegnare i permessi ai gruppi.',
	'ACP_ADMIN_ROLES_EXPLAIN'					=> 'Qui hai la possibilità di gestire i ruoli per i permessi amministratori. I ruoli sono permessi veri e propri, se cambi un ruolo tutte le figure ai quali è assegnato subiranno una variazione di permessi.',
	'ACP_FORUM_ROLES_EXPLAIN'					=> 'Qui hai la possibilità di gestire i ruoli per i permessi forum. I ruoli sono permessi veri e propri, se cambi un ruolo tutte le figure ai quali è assegnato subiranno una variazione di permessi.',
	'ACP_MOD_ROLES_EXPLAIN'						=> 'Qui hai la possibilità di gestire i ruoli per i permessi moderatori. I ruoli sono permessi veri e propri, se cambi un ruolo tutte le figure ai quali è assegnato subiranno una variazione di permessi.',
	'ACP_USER_ROLES_EXPLAIN'					=> 'Qui hai la possibilità di gestire i ruoli per i permessi utente. I ruoli sono permessi veri e propri, se cambi un ruolo tutte le figure ai quali è assegnato subiranno una variazione di permessi.',
	'ACP_USERS_FORUM_PERMISSIONS_EXPLAIN'		=> 'Qui puoi assegnare i permessi forum agli utenti.',
	'ACP_USERS_PERMISSIONS_EXPLAIN'				=> 'Qui puoi assegnare i permessi globali agli utenti: permessi utente, permessi di moderazione globale e permessi amministratore. I permessi utente consentono l’uso di avatar, l’invio di messaggi privati, eccetera; i permessi di moderatore globale consentono di approvare messaggi, gestire argomenti, gestire i ban, eccetera; infine i permessi amministratore consentono di modificare i permessi, definire BBCodes personalizzati, gestire forum, eccetera. Per modificare le impostazioni ad un gran numero di utenti, è preferibile utilizzare i permessi gruppi. I permessi utente individuali dovrebbero essere cambiati in rare occasioni: il metodo migliore è inserire gli utenti in gruppi per poi assegnare i permessi ai gruppi.',
	'ACP_VIEW_ADMIN_PERMISSIONS_EXPLAIN'		=> 'Qui puoi vedere i permessi amministratore assegnati agli utenti/gruppi selezionati.',
	'ACP_VIEW_GLOBAL_MOD_PERMISSIONS_EXPLAIN'	=> 'Qui puoi vedere i permessi moderatore globale assegnati agli utenti/gruppi selezionati.',
	'ACP_VIEW_FORUM_PERMISSIONS_EXPLAIN'		=> 'Qui puoi vedere i permessi forum assegnati agli utenti/gruppi e forum selezionati.',
	'ACP_VIEW_FORUM_MOD_PERMISSIONS_EXPLAIN'	=> 'Qui puoi vedere i permessi moderatore forum assegnati agli utenti/gruppi e forum selezionati.',
	'ACP_VIEW_USER_PERMISSIONS_EXPLAIN'			=> 'Qui puoi vedere i permessi utente assegnati agli utenti/gruppi selezionati.',

	'ADD_GROUPS'				=> 'Aggiungi gruppi',
	'ADD_PERMISSIONS'			=> 'Aggiungi permessi',
	'ADD_USERS'					=> 'Aggiungi utenti',
	'ADVANCED_PERMISSIONS'		=> 'Permessi avanzati',
	'ALL_GROUPS'				=> 'Seleziona tutti i gruppi',
	'ALL_NEVER'					=> 'Tutti <strong>MAI</strong>',
	'ALL_NO'					=> 'Tutti <strong>NO</strong>',
	'ALL_USERS'					=> 'Seleziona tutti gli utenti',
	'ALL_YES'					=> 'Tutti <strong>SI</strong>',
	'APPLY_ALL_PERMISSIONS'		=> 'Applica tutti i permessi',
	'APPLY_PERMISSIONS'			=> 'Applica i permessi',
	'APPLY_PERMISSIONS_EXPLAIN'	=> 'I permessi e i ruoli definiti per questa figura saranno applicati solo ad essa e a tutte le figure selezionate.',
	'AUTH_UPDATED'				=> 'I permessi sono stati aggiornati.',

	'COPY_PERMISSIONS_CONFIRM'				=> 'Sei sicuro di voler eseguire questa operazione? <strong>ATTENZIONE: questa operazione sovrascrive tutti i permessi esistenti in relazione alle opzioni selezionate.</strong>',
	'COPY_PERMISSIONS_FORUM_FROM_EXPLAIN'	=> 'Il forum sorgente da cui si vogliono copiare i permessi.',
	'COPY_PERMISSIONS_FORUM_TO_EXPLAIN'		=> 'I forum di destinazione in cui si vogliono copiare i permessi applicati.',
	'COPY_PERMISSIONS_FROM'					=> 'Copia permessi da',
	'COPY_PERMISSIONS_TO'					=> 'Applica permessi a',

	'CREATE_ROLE'				=> 'Crea ruolo',
	'CREATE_ROLE_FROM'			=> 'Copia impostazioni da…',
	'CUSTOM'					=> 'Personalizzato…',

	'DEFAULT'					=> 'Predefinito',
	'DELETE_ROLE'				=> 'Cancella ruolo',
	'DELETE_ROLE_CONFIRM'		=> 'Sei sicuro di voler rimuovere questo ruolo? Le figure a cui è assegnato <strong>non</strong> perderanno le loro impostazioni dei permessi.',
	'DISPLAY_ROLE_ITEMS'		=> 'Visualizza figure che usano questo ruolo',

	'EDIT_PERMISSIONS'			=> 'Modifica permessi',
	'EDIT_ROLE'					=> 'Modifica ruolo',

	'GROUPS_NOT_ASSIGNED'		=> 'Nessun gruppo assegnato a questo ruolo',

	'LOOK_UP_GROUP'				=> 'Cerca gruppo',
	'LOOK_UP_USER'				=> 'Cerca utente',

	'MANAGE_GROUPS'		=> 'Gestione gruppi',
	'MANAGE_USERS'		=> 'Gestione utenti',

	'NO_AUTH_SETTING_FOUND'		=> 'Impostazioni permesso non definite.',
	'NO_ROLE_ASSIGNED'			=> 'Nessun ruolo assegnato…',
	'NO_ROLE_ASSIGNED_EXPLAIN'	=> 'Impostare questo ruolo non cambia i permessi a destra. Se vuoi cambiare/rimuovere tutti i permessi dovresti usare il collegamento “Tutti <strong>NO</strong>”.',
	'NO_ROLE_AVAILABLE'			=> 'Nessun ruolo disponibile',
	'NO_ROLE_NAME_SPECIFIED'	=> 'Devi dare un nome al ruolo.',
	'NO_ROLE_SELECTED'			=> 'Il ruolo non è stato trovato.',
	'NO_USER_GROUP_SELECTED'	=> 'Non hai selezionato alcun utente o gruppo.',

	'ONLY_FORUM_DEFINED'	=> 'Nella tua selezione hai definito solo forum. Seleziona almeno un utente o gruppo.',

	'PERMISSION_APPLIED_TO_ALL'		=> 'Permessi e ruoli saranno anche applicati a tutti gli oggetti selezionati',
	'PLUS_SUBFORUMS'				=> '+Subforum',

	'REMOVE_PERMISSIONS'			=> 'Rimuovi permessi',
	'REMOVE_ROLE'					=> 'Rimuovi ruolo',
	'RESULTING_PERMISSION'			=> 'Permesso risultante',
	'ROLE'							=> 'Ruolo',
	'ROLE_ADD_SUCCESS'				=> 'Ruolo aggiunto.',
	'ROLE_ASSIGNED_TO'				=> 'Utenti/Gruppi assegnati a %s',
	'ROLE_DELETED'					=> 'Ruolo rimosso.',
	'ROLE_DESCRIPTION'				=> 'Descrizione ruolo',

	'ROLE_ADMIN_FORUM'			=> 'Amministratore forum',
	'ROLE_ADMIN_FULL'			=> 'Amministratore globale',
	'ROLE_ADMIN_STANDARD'		=> 'Amministratore standard',
	'ROLE_ADMIN_USERGROUP'		=> 'Amministratore utenti/gruppi',
	'ROLE_FORUM_BOT'			=> 'Accesso Bot',
	'ROLE_FORUM_FULL'			=> 'Accesso totale',
	'ROLE_FORUM_LIMITED'		=> 'Accesso limitato',
	'ROLE_FORUM_LIMITED_POLLS'	=> 'Accesso limitato + sondaggi',
	'ROLE_FORUM_NOACCESS'		=> 'Accesso negato',
	'ROLE_FORUM_ONQUEUE'		=> 'In coda moderatore',
	'ROLE_FORUM_POLLS'			=> 'Accesso standard + sondaggi',
	'ROLE_FORUM_READONLY'		=> 'Accesso sola lettura',
	'ROLE_FORUM_STANDARD'		=> 'Accesso standard',
	'ROLE_FORUM_NEW_MEMBER'		=> 'Accesso Nuovo utente registrato',
	'ROLE_MOD_FULL'				=> 'Moderatore totale',
	'ROLE_MOD_QUEUE'			=> 'Coda moderatore',
	'ROLE_MOD_SIMPLE'			=> 'Moderatore semplice',
	'ROLE_MOD_STANDARD'			=> 'Moderatore standard',
	'ROLE_USER_FULL'			=> 'Tutte le caratteristiche',
	'ROLE_USER_LIMITED'			=> 'Caratteristiche limitate',
	'ROLE_USER_NOAVATAR'		=> 'Niente Avatar',
	'ROLE_USER_NOPM'			=> 'Niente MP',
	'ROLE_USER_STANDARD'		=> 'Caratteristiche standard',
	'ROLE_USER_NEW_MEMBER'		=> 'Caratteristiche Nuovo utente registrato',

	'ROLE_DESCRIPTION_ADMIN_FORUM'			=> 'Può accedere alla gestione forum e alle impostazioni di permessi forum.',
	'ROLE_DESCRIPTION_ADMIN_FULL'			=> 'Ha accesso a tutte le funzioni di amministratore della Board.<br />Non consigliato.',
	'ROLE_DESCRIPTION_ADMIN_STANDARD'		=> 'Ha accesso a molte caratteristiche amministratore ma non può usare strumenti server o di sistema.',
	'ROLE_DESCRIPTION_ADMIN_USERGROUP'		=> 'Può gestire gruppi e utenti: può cambiare permessi, impostazioni, gestire ban e gestire livelli.',
	'ROLE_DESCRIPTION_FORUM_BOT'			=> 'Questo ruolo è consigliato per bots e spiders.',
	'ROLE_DESCRIPTION_FORUM_FULL'			=> 'Può usare tutte le caratteristiche forum, compreso l’invio di annunci e importanti. Può anche ignorare il limite di flood.<br />Non consigliato per utenti normali.',
	'ROLE_DESCRIPTION_FORUM_LIMITED'		=> 'Può usare alcune caratteristiche forum, ma non può allegare file o usare icone argomenti.',
	'ROLE_DESCRIPTION_FORUM_LIMITED_POLLS'	=> 'Come l’Accesso limitato ma può anche creare sondaggi.',
	'ROLE_DESCRIPTION_FORUM_NOACCESS'		=> 'Non può vedere o accedere al forum.',
	'ROLE_DESCRIPTION_FORUM_ONQUEUE'		=> 'Può usare molte caratteristiche forum, compresi gli allegati, ma messaggi e argomenti devono essere approvati da un moderatore.',
	'ROLE_DESCRIPTION_FORUM_POLLS'			=> 'Come l’accesso standard ma può anche creare sondaggi.',
	'ROLE_DESCRIPTION_FORUM_READONLY'		=> 'Può leggere il forum ma non può creare nuovi argomenti o rispondere ai messaggi.',
	'ROLE_DESCRIPTION_FORUM_STANDARD'		=> 'Può usare molte caratteristiche forum, compresi gli allegati e la cancellazione dei propri argomenti, ma non può bloccare i propri argomenti e non può creare sondaggi.',
	'ROLE_DESCRIPTION_FORUM_NEW_MEMBER'		=> 'Un ruolo per i membri dello speciale gruppo Nuovi Utenti Registrati; contiene <strong>MAI</strong> nei permessi per bloccare le caratteristiche per i nuovi utenti.',
	'ROLE_DESCRIPTION_MOD_FULL'				=> 'Può usare tutte le caratteristiche di moderatore, compreso il ban.',
	'ROLE_DESCRIPTION_MOD_QUEUE'			=> 'Può usare la coda moderatore per validare e modificare messaggi, ma nulla di più.',
	'ROLE_DESCRIPTION_MOD_SIMPLE'			=> 'Può solo usare azioni base sugli argomenti. Non può inviare richiami o usare la coda moderatore.',
	'ROLE_DESCRIPTION_MOD_STANDARD'			=> 'Può usare molti strumenti da moderatore, ma non può bannare utenti o cambiare l’autore dei messaggi.',
	'ROLE_DESCRIPTION_USER_FULL'			=> 'Può usare tutte le caratteristiche forum disponibili per gli utenti, compreso cambiare il nome utente e ignorare il limite di flood.<br />Non consigliato.',
	'ROLE_DESCRIPTION_USER_LIMITED'			=> 'Ha accesso ad alcune delle caratteristiche utente. Allegati, email, o messaggi istantanei non sono concessi.',
	'ROLE_DESCRIPTION_USER_NOAVATAR'		=> 'Ha un set di caratteristiche limitato e non può usare l’avatar.',
	'ROLE_DESCRIPTION_USER_NOPM'			=> 'Ha un set di caratteristiche limitato e non può usare i messaggi privati.',
	'ROLE_DESCRIPTION_USER_STANDARD'		=> 'Ha accesso a molte ma non tutte le caratteristiche utente. Non può cambiare nome utente o ignorare il limite di flood.',
	'ROLE_DESCRIPTION_USER_NEW_MEMBER'		=> 'Un ruolo per i membri dello speciale gruppo Nuovi Utenti Registrati; contiene <strong>MAI</strong> nei permessi per bloccare le caratteristiche per i nuovi utenti.',

	'ROLE_DESCRIPTION_EXPLAIN'		=> 'Puoi inserire un breve spiegazione delle funzioni del ruolo o a cosa è preposto. Il testo inserito sarà visibile anche dentro le schermate permessi.',
	'ROLE_DESCRIPTION_LONG'			=> 'La descrizione del ruolo è troppo lunga, il limite è di 4000 caratteri.',
	'ROLE_DETAILS'					=> 'Dettagli ruolo',
	'ROLE_EDIT_SUCCESS'				=> 'Ruolo modificato.',
	'ROLE_NAME'						=> 'Nome ruolo',
	'ROLE_NAME_ALREADY_EXIST'		=> 'Un ruolo di nome <strong>%s</strong> esiste già per il tipo di permesso specificato.',
	'ROLE_NOT_ASSIGNED'				=> 'Il ruolo non è ancora stato assegnato.',

	'SELECTED_FORUM_NOT_EXIST'		=> 'Il forum selezionato non esiste.',
	'SELECTED_GROUP_NOT_EXIST'		=> 'Gruppo(i) selezionato(i) non esistente(i).',
	'SELECTED_USER_NOT_EXIST'		=> 'Utente(i) selezionato(i) non esistente(i).',
	'SELECT_FORUM_SUBFORUM_EXPLAIN'	=> 'Il forum che selezioni qui includerà tutti i subforum nella selezione.',
	'SELECT_ROLE'					=> 'Seleziona ruolo…',
	'SELECT_TYPE'					=> 'Seleziona tipo',
	'SET_PERMISSIONS'				=> 'Imposta permessi',
	'SET_ROLE_PERMISSIONS'			=> 'Imposta permessi ruolo',
	'SET_USERS_PERMISSIONS'			=> 'Imposta permessi utente',
	'SET_USERS_FORUM_PERMISSIONS'	=> 'Imposta permessi forum utente',

	'TRACE_DEFAULT'					=> 'Come predefinito ogni permesso è settato su <strong>NO</strong> (non impostato). Il permesso può quindi essere sovrascritto da altre impostazioni.',
	'TRACE_FOR'						=> 'Traccia per',
	'TRACE_GLOBAL_SETTING'			=> '%s (globale)',
	'TRACE_GROUP_NEVER_TOTAL_NEVER'	=> 'Il permesso di gruppo è impostato su <strong>MAI</strong> come il risultato totale, quindi il vecchio risultato è mantenuto.',
	'TRACE_GROUP_NEVER_TOTAL_NEVER_LOCAL'	=> 'Il permesso di gruppo per questo forum è impostato su <strong>MAI</strong> come il risultato totale, quindi il vecchio risultato è mantenuto.',
	'TRACE_GROUP_NEVER_TOTAL_NO'	=> 'Il permesso di gruppo è impostato su <strong>MAI</strong> che diventa il nuovo valore totale dato che non era ancora impostato (impostato su <strong>NO</strong>).',
	'TRACE_GROUP_NEVER_TOTAL_NO_LOCAL'	=> 'Il permesso di gruppo per questo forum è impostato su <strong>MAI</strong> che diventa il nuovo valore totale dato che non era ancora impostato (impostato su <strong>NO</strong>).',
	'TRACE_GROUP_NEVER_TOTAL_YES'	=> 'Il permesso di gruppo è impostato su <strong>MAI</strong> che sovrascrive il totale <strong>SI</strong> a <strong>MAI</strong> per questo utente.',
	'TRACE_GROUP_NEVER_TOTAL_YES_LOCAL'	=> 'Il permesso di gruppo per questo forum è impostato su <strong>MAI</strong> che sovrascrive il totale <strong>SI</strong> a <strong>MAI</strong> per questo utente.',
	'TRACE_GROUP_NO'				=> 'Il permesso è <strong>NO</strong> per questo gruppo, quindi il vecchio risultato è mantenuto.',
	'TRACE_GROUP_NO_LOCAL'			=> 'Il permesso è <strong>NO</strong> per questo gruppo all’interno di questo forum, quindi il vecchio risultato è mantenuto.',
	'TRACE_GROUP_YES_TOTAL_NEVER'	=> 'Il permesso di gruppo è impostato su <strong>SI</strong> ma il totale <strong>MAI</strong> non può essere sovrascritto.',
	'TRACE_GROUP_YES_TOTAL_NEVER_LOCAL'	=> 'Il permesso di gruppo per questo forum è impostato su <strong>SI</strong> ma il totale <strong>MAI</strong> non può essere sovrascritto.',
	'TRACE_GROUP_YES_TOTAL_NO'		=> 'Il permesso di gruppo è impostato su <strong>SI</strong> che diventa il nuovo valore totale dato che non era ancora impostato (impostato su <strong>NO</strong>).',
	'TRACE_GROUP_YES_TOTAL_NO_LOCAL'	=> 'Il permesso di gruppo per questo forum è impostato su <strong>SI</strong> che diventa il nuovo valore totale dato che non era ancora impostato (impostato su <strong>NO</strong>).',
	'TRACE_GROUP_YES_TOTAL_YES'		=> 'Il permesso di gruppo è impostato su <strong>SI</strong> ed il permesso totale è già impostato su <strong>SI</strong>, quindi il risultato totale è mantenuto.',
	'TRACE_GROUP_YES_TOTAL_YES_LOCAL'	=> 'Il permesso di gruppo per questo forum è impostato su <strong>SI</strong> ed il permesso totale è già impostato su <strong>SI</strong>, quindi il risultato totale è mantenuto.',
	'TRACE_PERMISSION'				=> 'Traccia permesso - %s',
	'TRACE_RESULT'					=> 'Traccia risultato',
	'TRACE_SETTING'					=> 'Impostazione tracciamento',

	'TRACE_USER_GLOBAL_YES_TOTAL_YES'		=> 'I permessi forum utente indipendenti determinano il valore <strong>SI</strong> ma il permesso totale è già impostato su <strong>SI</strong>, così il risultato totale è mantenuto. %sTraccia permesso globale%s',
	'TRACE_USER_GLOBAL_YES_TOTAL_NEVER'		=> 'I permessi forum utente indipendenti determinano il valore <strong>SI</strong> che sovrascrive l’attuale risultato locale <strong>MAI</strong>. %sTraccia permesso globale%s',
	'TRACE_USER_GLOBAL_NEVER_TOTAL_KEPT'	=> 'I permessi forum utente indipendenti determinano il valore <strong>MAI</strong> che non influenza il permesso locale. %sTraccia permesso globale%s',

	'TRACE_USER_FOUNDER'					=> 'L’utente è un fondatore, quindi i permessi amministrativi sono sempre impostati su <strong>SI</strong>.',
	'TRACE_USER_KEPT'						=> 'Il permesso utente è <strong>NO</strong> così il vecchio risultato totale è mantenuto.',
	'TRACE_USER_KEPT_LOCAL'					=> 'Il permesso utente per questo forum è <strong>NO</strong> così il vecchio risultato totale è mantenuto.',
	'TRACE_USER_NEVER_TOTAL_NEVER'			=> 'Il permesso utente è impostato su <strong>MAI</strong> e il valore totale è impostato su <strong>MAI</strong>, quindi non cambia nulla.',
	'TRACE_USER_NEVER_TOTAL_NEVER_LOCAL'	=> 'Il permesso utente per questo forum è impostato su <strong>MAI</strong> e il valore totale è impostato su <strong>MAI</strong>, quindi non cambia nulla.',
	'TRACE_USER_NEVER_TOTAL_NO'				=> 'Il permesso utente è impostato su <strong>MAI</strong> che diventa il valore totale dato che era impostato su <strong>NO</strong>.',
	'TRACE_USER_NEVER_TOTAL_NO_LOCAL'		=> 'Il permesso utente per questo forum è impostato su <strong>MAI</strong> che diventa il valore totale dato che era impostato su <strong>NO</strong>.',
	'TRACE_USER_NEVER_TOTAL_YES'			=> 'Il permesso utente è impostato su <strong>MAI</strong> e sovrascrive il precedente <strong>SI</strong>.',
	'TRACE_USER_NEVER_TOTAL_YES_LOCAL'		=> 'Il permesso utente per questo forum è impostato su <strong>MAI</strong> e sovrascrive il precedente <strong>SI</strong>.',
	'TRACE_USER_NO_TOTAL_NO'				=> 'Il permesso utente è <strong>NO</strong> e il valore totale era impostato su <strong>NO</strong> quindi va a <strong>MAI</strong> di default.',
	'TRACE_USER_NO_TOTAL_NO_LOCAL'			=> 'Il permesso utente per questo forum è <strong>NO</strong> e il valore totale era impostato su <strong>NO</strong> quindi va a <strong>MAI</strong> di default.',
	'TRACE_USER_YES_TOTAL_NEVER'			=> 'Il permesso utente è impostato su <strong>SI</strong> ma il totale <strong>MAI</strong> non può essere sovrascritto.',
	'TRACE_USER_YES_TOTAL_NEVER_LOCAL'		=> 'Il permesso utente per questo forum è impostato su <strong>SI</strong> ma il totale <strong>MAI</strong> non può essere sovrascritto.',
	'TRACE_USER_YES_TOTAL_NO'				=> 'Il permesso utente è impostato su <strong>SI</strong> che diventa il valore totale dato che era impostato su <strong>NO</strong>.',
	'TRACE_USER_YES_TOTAL_NO_LOCAL'			=> 'Il permesso utente per questo forum è impostato su <strong>SI</strong> che diventa il valore totale dato che era impostato su <strong>NO</strong>.',
	'TRACE_USER_YES_TOTAL_YES'				=> 'Il permesso utente è impostato su <strong>SI</strong> e il valore totale è impostato su <strong>SI</strong>, quindi nulla è cambiato.',
	'TRACE_USER_YES_TOTAL_YES_LOCAL'		=> 'Il permesso utente per questo forum è impostato su <strong>SI</strong> e il valore totale è impostato su <strong>SI</strong>, quindi nulla è cambiato.',
	'TRACE_WHO'								=> 'Chi',
	'TRACE_TOTAL'							=> 'Totale',

	'USERS_NOT_ASSIGNED'			=> 'Nessun utente assegnato a questo ruolo',
	'USER_IS_MEMBER_OF_DEFAULT'		=> 'è un membro dei seguenti gruppi predefiniti',
	'USER_IS_MEMBER_OF_CUSTOM'		=> 'è un membro dei seguenti gruppi personalizzati',

	'VIEW_ASSIGNED_ITEMS'	=> 'Vedi figure assegnate',
	'VIEW_LOCAL_PERMS'		=> 'Permessi locali',
	'VIEW_GLOBAL_PERMS'		=> 'Permessi globali',
	'VIEW_PERMISSIONS'		=> 'Vedi permessi',

	'WRONG_PERMISSION_TYPE'	=> 'Il tipo di permesso selezionato è errato.',
	'WRONG_PERMISSION_SETTING_FORMAT'	=> 'Le impostazioni dei permessi sono in un formato scorretto e phpBB non è in grado di processarli correttamente.',
));
