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

// Forum Admin
$lang = array_merge($lang, array(
	'AUTO_PRUNE_DAYS'			=> 'Cancellazione automatica di argomenti fermi da più di',
	'AUTO_PRUNE_DAYS_EXPLAIN'	=> 'Numero di giorni che devono trascorrere dall’ultimo messaggio perché l’argomento venga rimosso automaticamente.',
	'AUTO_PRUNE_FREQ'			=> 'Frequenza cancellazione automatica',
	'AUTO_PRUNE_FREQ_EXPLAIN'	=> 'Tempo fra i vari processi di cancellazione espresso in giorni.',
	'AUTO_PRUNE_VIEWED'			=> 'Cancellazione automatica di argomenti non letti da più di',
	'AUTO_PRUNE_VIEWED_EXPLAIN'	=> 'Numero di giorni trascorsi dall’ultima lettura dell’argomento dopo il quale l’argomento viene rimosso automaticamente.',
	'AUTO_PRUNE_SHADOW_FREQ'	=> 'Frequenza cancellazione automatica per argomenti ombra',
	'AUTO_PRUNE_SHADOW_DAYS'	=> 'Giorni per la cancellazione automatica di argomenti ombra',
	'AUTO_PRUNE_SHADOW_DAYS_EXPLAIN'	=> 'Numero di giorni che devono trascorrere perché l’argomento ombra venga rimosso automaticamente.',
	'AUTO_PRUNE_SHADOW_FREQ_EXPLAIN'	=> 'Tempo fra i vari processi di cancellazione espresso in giorni.',

	'CONTINUE'						=> 'Continua',
	'COPY_PERMISSIONS'				=> 'Copia permessi da',
	'COPY_PERMISSIONS_EXPLAIN'		=> 'Per facilitare la configurazione dei permessi del tuo nuovo forum, è possibile copiare i permessi da un forum esistente.',
	'COPY_PERMISSIONS_ADD_EXPLAIN'	=> 'Una volta creato, il forum avrà gli stessi permessi qui selezionati. Se non è stato selezionato nessun forum, quello appena creato non sarà visibile fin quando i permessi non saranno impostati.',
	'COPY_PERMISSIONS_EDIT_EXPLAIN'	=> 'Se si sceglie di copiare i permessi il forum avrà gli stessi permessi qui selezionati. Questo sovrascriverà qualsiasi permesso precedentemente impostato con i permessi del forum scelto. Se non è stato selezionato alcun forum i permessi correnti saranno mantenuti.',
	'COPY_TO_ACL'					=> 'In alternativa, puoi anche %simpostare nuovi permessi%s per questo forum.',
	'CREATE_FORUM'					=> 'Crea nuovo forum',

	'DECIDE_MOVE_DELETE_CONTENT'		=> 'Cancella contenuti o spostali nel forum',
	'DECIDE_MOVE_DELETE_SUBFORUMS'		=> 'Cancella subforum o spostale nel forum',
	'DEFAULT_STYLE'						=> 'Stile predefinito',
	'DELETE_ALL_POSTS'					=> 'Cancella messaggi',
	'DELETE_SUBFORUMS'					=> 'Cancella subforum e messaggi',
	'DISPLAY_ACTIVE_TOPICS'				=> 'Abilita argomenti attivi',
	'DISPLAY_ACTIVE_TOPICS_EXPLAIN'		=> 'Se impostato su Sì gli argomenti attivi nei subforum selezionati saranno mostrati come dipendenti da questa categoria.',

	'EDIT_FORUM'					=> 'Modifica forum',
	'ENABLE_INDEXING'				=> 'Abilita ricerca indicizzata',
	'ENABLE_INDEXING_EXPLAIN'		=> 'Se impostato su Sì i messaggi scritti in questo forum saranno indicizzati per la ricerca.',
	'ENABLE_POST_REVIEW'			=> 'Abilita revisione messaggi',
	'ENABLE_POST_REVIEW_EXPLAIN'	=> 'Se impostato su Sì gli utenti possono revisionare i propri messaggi se nuovi messaggi vengono inseriti nell’argomento mentre stanno scrivendo. Questa funzione dovrebbe essere disabilitata per la chat forum.',
	'ENABLE_QUICK_REPLY'			=> 'Abilita Risposta Rapida',
	'ENABLE_QUICK_REPLY_EXPLAIN'	=> 'Abilita la risposta rapida in questo forum. Questa impostazione non viene considerata se l’opzione globale per la risposta rapida è disattivata. La risposta rapida sarà accessibile solo agli utenti abilitati a scrivere in questo forum.',
	'ENABLE_RECENT'					=> 'Mostra argomenti attivi',
	'ENABLE_RECENT_EXPLAIN'			=> 'Se impostato su Sì gli argomenti inseriti in questo forum verranno mostrati nella lista degli argomenti attivi.',
	'ENABLE_TOPIC_ICONS'			=> 'Abilita icone argomenti',

	'FORUM_ADMIN'						=> 'Amministrazione forum',
	'FORUM_ADMIN_EXPLAIN'				=> 'Nel phpBB3, tutto è basato sui forum. Ogni forum può avere un numero illimitato di subforum e si può decidere se inviarvi messaggi o meno. Qui puoi aggiungere, modificare, cancellare, bloccare, sbloccare forum specifici così come altri controlli addizionali. Se i tuoi messaggi o argomenti sono andati fuori sincrono puoi anche risincronizzare un forum. <strong>Perché i nuovi forum creati siano visibili, devi copiare o impostare dei permessi appropriati.</strong>',
	'FORUM_AUTO_PRUNE'					=> 'Abilita cancellazione automatica',
	'FORUM_AUTO_PRUNE_EXPLAIN'			=> 'Cancellazione forum e argomenti, imposta i parametri sottostanti per la frequenza/periodo.',
	'FORUM_CREATED'						=> 'Forum creato.',
	'FORUM_DATA_NEGATIVE'				=> 'I parametri per la cancellazione automatica non possono essere negativi.',
	'FORUM_DESC_TOO_LONG'				=> 'La descrizione del forum è troppo lunga, deve avere meno di 4000 caratteri.',
	'FORUM_DELETE'						=> 'Cancella forum',
	'FORUM_DELETE_EXPLAIN'				=> 'Questa funzione ti permette di cancellare un forum. Se nel forum si può postare puoi decidere dove spostare tutti gli argomenti (o subforum) che contiene.',
	'FORUM_DELETED'						=> 'Forum cancellato.',
	'FORUM_DESC'						=> 'Descrizione',
	'FORUM_DESC_EXPLAIN'				=> 'Qualsiasi codice HTML introdotto qui verrà mostrato così come introdotto. Se il forum selezionato è una categoria la descrizione non è usata.',
	'FORUM_EDIT_EXPLAIN'				=> 'Il modulo sottostante ti permette di personalizzare questo forum. Nota che questo tipo di moderazione e il controllo del conteggio messaggi sono impostate tramite i permessi di forum per ogni utente o gruppo utenti.',
	'FORUM_IMAGE'						=> 'Immagine forum',
	'FORUM_IMAGE_EXPLAIN'				=> 'Posizione, relativa alla cartella di phpBB, di un’immagine supplementare associata a questo forum.',
	'FORUM_IMAGE_NO_EXIST'				=> 'L’immagine forum indicata non esiste',
	'FORUM_LINK_EXPLAIN'				=> 'URL completo (incluso il protocollo, per esempio <samp>http://</samp>) alla posizione di questo forum. Cliccando su tale URL gli utenti verranno indirizzati al forum stesso.',
	'FORUM_LINK_TRACK'					=> 'Traccia collegamenti dei reindirizzamenti',
	'FORUM_LINK_TRACK_EXPLAIN'			=> 'Registra il numero di volte che il collegamento ad un forum è stato cliccato.',
	'FORUM_NAME'						=> 'Nome forum',
	'FORUM_NAME_EMPTY'					=> 'Devi inserire un nome per questo forum.',
	'FORUM_NAME_EMOJI'					=> 'Il nome del forum inserito non è valido.<br />Contiene i seguenti caratteri non supportati:<br />%s',
	'FORUM_PARENT'						=> 'Forum principale',
	'FORUM_PASSWORD'					=> 'Password del forum',
	'FORUM_PASSWORD_CONFIRM'			=> 'Conferma password',
	'FORUM_PASSWORD_CONFIRM_EXPLAIN'	=> 'Necessita di essere impostata solo se è stata inserita una password per il forum.',
	'FORUM_PASSWORD_EXPLAIN'			=> 'Definisci una password per questo forum, usa preferibilmente il sistema dei permessi.',
	'FORUM_PASSWORD_UNSET'				=> 'Elimina la password del forum',
	'FORUM_PASSWORD_UNSET_EXPLAIN'		=> 'Seleziona qui se vuoi eliminare la password del forum.',
	'FORUM_PASSWORD_OLD'				=> 'La password del forum utilizza un vecchio sistema di indirizzamento e deve essere modificata.',
	'FORUM_PASSWORD_MISMATCH'			=> 'La password inserita non coincide.',
	'FORUM_PRUNE_SETTINGS'				=> 'Impostazioni cancellazione del forum',
	'FORUM_PRUNE_SHADOW'				=> 'Abilita cancellazione automatica degli argomenti ombra',
	'FORUM_PRUNE_SHADOW_EXPLAIN'		=> 'Cancellazione forum degli argomenti ombra; imposta i parametri di frequenza/tempo.',
	'FORUM_RESYNCED'					=> 'Forum "%s" risincronizzato',
	'FORUM_RULES_EXPLAIN'				=> 'Le regole del forum vengono visualizzate in ogni pagina del forum stesso.',
	'FORUM_RULES_LINK'					=> 'Collegamento alle regole del forum',
	'FORUM_RULES_LINK_EXPLAIN'			=> 'Qui puoi inserire l’URL della pagina o messaggio contenente le tue regole del forum. Questa impostazione sovrascriverà le regole del forum in formato testo specificate.',
	'FORUM_RULES_PREVIEW'				=> 'Anteprima regole forum',
	'FORUM_RULES_TOO_LONG'				=> 'Le regole del forum devono contenere meno di 4000 caratteri.',
	'FORUM_SETTINGS'					=> 'Impostazioni forum',
	'FORUM_STATUS'						=> 'Stato del forum',
	'FORUM_STYLE'						=> 'Stile forum',
	'FORUM_TOPICS_PAGE'					=> 'Argomenti per pagina',
	'FORUM_TOPICS_PAGE_EXPLAIN'			=> 'Se non impostato su zero questo valore sovrascriverà le impostazioni predefinite per gli argomenti per pagina.',
	'FORUM_TYPE'						=> 'Tipo di forum',
	'FORUM_UPDATED'						=> 'Informazione forum aggiornata.',

	'FORUM_WITH_SUBFORUMS_NOT_TO_LINK'	=> 'Cambiare un forum con argomenti e subforum in un link. Per prima cosa sposta tutti i subforum da un’altra parte, perché dal momento che modificherai in un collegamento non ti sarà più possibile visualizzare i subforum attualmente collegati a questo forum.',

	'GENERAL_FORUM_SETTINGS'	=> 'Impostazioni generali forum',

	'LINK'						=> 'Link',
	'LIMIT_SUBFORUMS'			=> 'Limita la legenda direttamente ai sub-forum figli',
	'LIMIT_SUBFORUMS_EXPLAIN'	=> 'Limita i subforum da visualizzare ai subforum che sono discendenti diretti (figli) del forum corrente. Disabilitando questo verranno visualizzati tutti i subforum con l’opzione “Elenca subforum nella legenda” abilitata, indipendentemente dalla profondità.',
	'LIST_INDEX'				=> 'Elenca i subforum nella legenda dei forum madre',
	'LIST_INDEX_EXPLAIN'		=> 'Se il forum madre ha abilitata l’opzione “Elenca i subforum nella legenda” questo forum verrà visualizzato come un collegamento all’interno della legenda del suo forum madre, sia nell’Indice che altrove.',
	'LIST_SUBFORUMS'			=> 'Elenca i subforum nella legenda',
	'LIST_SUBFORUMS_EXPLAIN'	=> 'I subforum di questo forum verranno visualizzati come collegamenti all’interno della legenda se la loro opzione “Elenca i subforum nella legenda dei forum madre” è abilitata.',
	'LOCKED'					=> 'Bloccato',

	'MOVE_POSTS_NO_POSTABLE_FORUM'	=> 'Il forum selezionato per lo spostamento dei messaggi non è valido. Selezionare un forum pubblico.',
	'MOVE_POSTS_TO'					=> 'Sposta i messaggi in',
	'MOVE_SUBFORUMS_TO'				=> 'Sposta il subforum in',

	'NO_DESTINATION_FORUM'			=> 'Non hai specificato alcun forum dove spostare i contenuti.',
	'NO_FORUM_ACTION'				=> 'Nessuna azione definita per ciò che succede con i contenuti del forum.',
	'NO_PARENT'						=> 'Nessun forum madre',
	'NO_PERMISSIONS'				=> 'Non copiare permessi',
	'NO_PERMISSION_FORUM_ADD'		=> 'Non hai i permessi necessari per aggiungere forum.',
	'NO_PERMISSION_FORUM_DELETE'	=> 'Non hai i permessi necessari per cancellare forum.',

	'PARENT_IS_LINK_FORUM'		=> 'Il forum madre specificato è un forum link. I forum link non possono contenere altri forum. Per favore specifica una categoria o un forum come forum madre.',
	'PARENT_NOT_EXIST'			=> 'Il forum madre non esiste.',
	'PRUNE_ANNOUNCEMENTS'		=> 'Cancellazione annunci',
	'PRUNE_STICKY'				=> 'Cancellazione argomenti importanti',
	'PRUNE_OLD_POLLS'			=> 'Cancellazione vecchi sondaggi',
	'PRUNE_OLD_POLLS_EXPLAIN'	=> 'Rimuove argomenti con sondaggi non più votati da un certo periodo di giorni.',

	'REDIRECT_ACL'	=> 'Adesso puoi %simpostare i permessi%s per questo forum.',

	'SYNC_IN_PROGRESS'			=> 'Sincronizzazione forum',
	'SYNC_IN_PROGRESS_EXPLAIN'	=> 'Risincronizzazione degli argomenti %1$d/%2$d.',

	'TYPE_CAT'			=> 'Categoria',
	'TYPE_FORUM'		=> 'Forum',
	'TYPE_LINK'			=> 'Link',

	'UNLOCKED'			=> 'Sbloccato',
));
