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
	'ADD_ATTACHMENT'			=> 'Invia allegato',
	'ADD_ATTACHMENT_EXPLAIN'	=> 'Se desideri allegare uno o più file inserisci i seguenti dettagli.',
	'ADD_FILE'					=> 'Aggiungi file',
	'ADD_POLL'					=> 'Crea sondaggio',
	'ADD_POLL_EXPLAIN'			=> 'Se non vuoi aggiungere un sondaggio al tuo argomento lascia vuoti i campi che seguono.',
	'ALREADY_DELETED'			=> 'Questo messaggio è già stato cancellato.',
	'ATTACH_COMMENT_NO_EMOJIS'	=> 'Il commento dell’allegato contiene caratteri proibiti (Emoji).',
	'ATTACH_DISK_FULL'			=> 'Non c’è abbastanza spazio libero su disco per pubblicare quest’allegato.',
	'ATTACH_QUOTA_REACHED'		=> 'Il limite massimo di allegati impostato è stato raggiunto.',
	'ATTACH_SIG'				=> 'Aggiungi firma (la firma può essere modificata attraverso il PCU)',

	'BBCODE_A_HELP'				=> 'Collegamento allegato: [attachment=]nomefile.est[/attachment]',
	'BBCODE_B_HELP'				=> 'Grassetto: [b]testo[/b]',
	'BBCODE_C_HELP'				=> 'Codice: [code]codice[/code]',
	'BBCODE_D_HELP'				=> 'Flash: [flash=width,height]http://url[/flash]',
	'BBCODE_F_HELP'				=> 'Dimensione testo: [size=85]testo piccolo[/size]',
	'BBCODE_IS_OFF'				=> '%sBBCode%s <em>non attivo</em>',
	'BBCODE_IS_ON'				=> '%sBBCode%s <em>attivo</em>',
	'BBCODE_I_HELP'				=> 'Corsivo: [i]testo[/i]',
	'BBCODE_L_HELP'				=> 'Lista: [list][*]testo[/list]',
	'BBCODE_LISTITEM_HELP'		=> 'Elemento lista: [*]testo',
	'BBCODE_O_HELP'				=> 'Lista ordinata: esempio [list=1][*]Punto primo[/list] o [list=a][*]Punto a[/list]',
	'BBCODE_P_HELP'				=> 'Immagine: [img]http://immagine_url[/img]',
	'BBCODE_Q_HELP'				=> 'Cita: [quote]testo[/quote]',
	'BBCODE_S_HELP'				=> 'Colore: [color=red]testo[/color] o [color=#FF0000]testo[/color]',
	'BBCODE_U_HELP'				=> 'Sottolineato: [u]testo[/u]',
	'BBCODE_W_HELP'				=> 'Collegamento: [url]http://url[/url] o [url=http://url]testo aggiuntivo[/url]',
	'BBCODE_Y_HELP'				=> 'Lista: Aggiungi elementi alla lista',
	'BUMP_ERROR'				=> 'Non puoi effettuare il bump di questo argomento così presto dopo l’ultimo messaggio.',

	'CANNOT_DELETE_REPLIED'		=> 'Puoi cancellare solo i messaggi che non hanno avuto risposte.',
	'CANNOT_EDIT_POST_LOCKED'	=> 'Questo messaggio è stato bloccato. Non puoi modificarlo.',
	'CANNOT_EDIT_TIME'			=> 'Non puoi più modificare o cancellare questo messaggio.',
	'CANNOT_POST_ANNOUNCE'		=> 'Non puoi inserire annunci.',
	'CANNOT_POST_STICKY'		=> 'Non puoi inserire argomenti importanti.',
	'CHANGE_TOPIC_TO'			=> 'Cambia tipo di argomento in',
	'CHARS_POST_CONTAINS'		=> array(
		1	=> 'Il tuo messaggio contiene %1$d carattere.',
		2	=> 'Il tuo messaggio contiene %1$d caratteri.',
	),
	'CHARS_SIG_CONTAINS'		=> array(
		1	=> 'La tua firma contiene %1$d carattere.',
		2	=> 'La tua firma contiene %1$d caratteri.',
	),
	'CLOSE_TAGS'				=> 'Chiudi i tag',
	'CURRENT_TOPIC'				=> 'Argomento corrente',

	'DELETE_FILE'						=> 'Cancella file',
	'DELETE_MESSAGE'					=> 'Cancella messaggio',
	'DELETE_MESSAGE_CONFIRM'			=> 'Sei sicuro di voler cancellare questo messaggio?',
	'DELETE_OWN_POSTS'					=> 'Puoi cancellare solamente i tuoi messaggi.',
	'DELETE_PERMANENTLY'				=> 'Cancella in modo permanente',
	'DELETE_POST_CONFIRM'				=> 'Sei sicuro di voler cancellare questo messaggio?',
	'DELETE_POST_PERMANENTLY_CONFIRM'	=> 'Sei sicuro di voler cancellare <strong>in modo permanente</strong> questo messaggio?',
	'DELETE_POST_PERMANENTLY'			=> array(
		1	=> 'Una volta cancellato il messaggio sarà irrecuperabile',
		2	=> 'Una volta cancellati i %1$d messaggi saranno irrecuperabili',
	),
	'DELETE_POSTS_CONFIRM'				=> 'Sei sicuro di voler cancellare questi messaggi?',
	'DELETE_POSTS_PERMANENTLY_CONFIRM'	=> 'Sei sicuro di voler cancellare <strong>in modo permanente</strong> questi messaggi?',
	'DELETE_REASON'						=> 'Motivo della cancellazione',
	'DELETE_REASON_EXPLAIN'				=> 'Il motivo specificato per la cancellazione sarà visibile ai moderatori.',
	'DELETE_POST_WARN'					=> 'Cancella questo messaggio',
	'DELETE_TOPIC_CONFIRM'				=> 'Sei sicuro di voler cancellare questo argomento?',
	'DELETE_TOPIC_PERMANENTLY'			=> array(
		1	=> 'Una volta cancellato l’argomento sarà irrecuperabile',
		2	=> 'Una volta cancellati i %1$d argomenti saranno irrecuperabili',
	),
	'DELETE_TOPIC_PERMANENTLY_CONFIRM'	=> 'Sei sicuro di voler cancellare <strong>in modo permanente</strong> questo argomento?',
	'DELETE_TOPICS_CONFIRM'				=> 'Sei sicuro di voler cancellare questi argomenti?',
	'DELETE_TOPICS_PERMANENTLY_CONFIRM'	=> 'Sei sicuro di voler cancellare <strong>in modo permanente</strong> questi argomenti?',
	'DISABLE_BBCODE'					=> 'Disabilita BBCode',
	'DISABLE_MAGIC_URL'					=> 'Non rendere automaticamente cliccabili i collegamenti',
	'DISABLE_SMILIES'					=> 'Disabilita le emoticon',
	'DISALLOWED_CONTENT'				=> 'Il contenuto è stato respinto in quanto il file caricato è stato identificato come un possibile vettore di attacco.',
	'DISALLOWED_EXTENSION'				=> 'L’estensione %s non è permessa.',
	'DRAFT_LOADED'						=> 'La bozza è stata salvata; se lo desideri puoi concludere ora il messaggio.<br />La bozza sarà eliminata una volta inserito il messaggio.',
	'DRAFT_LOADED_PM'					=> 'La bozza è stata salvata; se lo desideri puoi concludere ora il messaggio privato.<br />La bozza sarà eliminata una volta inserito il messaggio privato.',
	'DRAFT_SAVED'						=> 'Bozza salvata correttamente.',
	'DRAFT_TITLE'						=> 'Titolo bozza',

	'EDIT_REASON'				=> 'Motivo della modifica del messaggio',
	'EMPTY_FILEUPLOAD'			=> 'Il file allegato è vuoto.',
	'EMPTY_MESSAGE'				=> 'Non puoi inserire un messaggio vuoto.',
	'EMPTY_REMOTE_DATA'			=> 'Il file non è stato ricevuto correttamente, prova ad inviarlo manualmente.',

	'FLASH_IS_OFF'				=> '[flash] <em>non attivo</em>',
	'FLASH_IS_ON'				=> '[flash] <em>attivo</em>',
	'FLOOD_ERROR'				=> 'Non puoi inserire un altro messaggio dopo così poco tempo.',
	'FONT_COLOR'				=> 'Colore del testo',
	'FONT_COLOR_HIDE'			=> 'Nascondi colori',
	'FONT_HUGE'					=> 'Enorme',
	'FONT_LARGE'				=> 'Grande',
	'FONT_NORMAL'				=> 'Normale',
	'FONT_SIZE'					=> 'Dimensione carattere',
	'FONT_SMALL'				=> 'Piccolo',
	'FONT_TINY'					=> 'Piccolissimo',

	'GENERAL_UPLOAD_ERROR'		=> 'L’invio dell’allegato a %s è fallito.',

	'IMAGES_ARE_OFF'			=> '[img] <em>non attivo</em>',
	'IMAGES_ARE_ON'				=> '[img] <em>attivo</em>',
	'INVALID_FILENAME'			=> '%s è un nome file non valido.',

	'LOAD'						=> 'Carica',
	'LOAD_DRAFT'				=> 'Carica bozza',
	'LOAD_DRAFT_EXPLAIN'		=> 'Qui puoi scegliere quale bozza continuare a scrivere. Il messaggio che stai scrivendo sarà cancellato con tutti i suoi contenuti. Visualizza, modifica ed elimina le bozze dal tuo Pannello di Controllo Utente.',
	'LOGIN_EXPLAIN_BUMP'		=> 'Devi essere iscritto e connesso per effettuare il bump degli argomenti di questo forum.',
	'LOGIN_EXPLAIN_DELETE'		=> 'Devi essere iscritto e connesso per cancellare messaggi di questo forum.',
	'LOGIN_EXPLAIN_SOFT_DELETE'	=> 'Devi essere iscritto e connesso per eliminare i messaggi in questo forum.',
	'LOGIN_EXPLAIN_POST'		=> 'Devi essere iscritto e connesso per inserire messaggi in questo forum.',
	'LOGIN_EXPLAIN_QUOTE'		=> 'Devi essere iscritto e connesso per citare i messaggi di questo forum.',
	'LOGIN_EXPLAIN_REPLY'		=> 'Devi essere iscritto e connesso per rispondere agli argomenti di questo forum.',

	'MAX_ATTACHMENT_FILESIZE'	=> 'Dimensione massima del file per allegato: %s.',

	'MAX_FONT_SIZE_EXCEEDED'	=> 'Puoi utilizzare caratteri di dimensione massima pari a %d.',
	'MAX_FLASH_HEIGHT_EXCEEDED'	=> array(
		1	=> 'I file flash possono avere altezza massima di %d pixel.',
		2	=> 'I file flash possono avere altezza massima %d pixel.',
	),
	'MAX_FLASH_WIDTH_EXCEEDED'	=> array(
		1	=> 'I file flash possono avere larghezza massima di %d pixel.',
		2	=> 'I file flash possono avere larghezza massima di %d pixel.',
	),
	'MAX_IMG_HEIGHT_EXCEEDED'	=> array(
		1	=> 'Le immagini possono avere altezza massima di %1$d pixel.',
		2	=> 'Le immagini possono avere altezza massima d %1$d pixel.',
	),
	'MAX_IMG_WIDTH_EXCEEDED'	=> array(
		1	=> 'Le immagini possono avere larghezza massima di %d pixel.',
		2	=> 'Le immagini possono avere larghezza massima di %d pixel.',
	),

	'MESSAGE_BODY_EXPLAIN'		=> array(
		0	=> '', // zero means no limit, so we don't view a message here.
		1	=> 'Inserisci qui il tuo messaggio, che può contenere al massimo <strong>%d</strong> caratteri.',
		2	=> 'Inserisci qui il tuo messaggio, che può contenere al massimo <strong>%d</strong> caratteri.',
	),
	'MESSAGE_DELETED'			=> 'Il messaggio è stato cancellato.',
	'MORE_SMILIES'				=> 'Visualizza tutte le emoticon',

	'NOTIFY_REPLY'				=> 'Avvisami via email quando si risponde in questo argomento',
	'NOT_UPLOADED'				=> 'Invio del file fallito.',
	'NO_DELETE_POLL_OPTIONS'	=> 'Non puoi eliminare le voci del sondaggio.',
	'NO_PM_ICON'				=> 'Nessuna',
	'NO_POLL_TITLE'				=> 'Devi dare un titolo al sondaggio.',
	'NO_POST'					=> 'Il messaggio richiesto non esiste.',
	'NO_POST_MODE'				=> 'Non è stata specificata la modalità di inserimento.',
	'NO_TEMP_DIR'				=> 'La cartella temporanea non è stato trovata o non è scrivibile.',

	'PARTIAL_UPLOAD'			=> 'Il file inviato è stato ricevuto solo in parte',
	'PHP_UPLOAD_STOPPED'		=> 'Un’estensione PHP ha bloccato il caricamento del file.',
	'PHP_SIZE_NA'				=> 'La dimensione del file allegato è eccessiva.<br />Impossibile determinare la dimensione massima definita da PHP nel php.ini.',
	'PHP_SIZE_OVERRUN'			=> 'La dimensione del file allegato è eccessiva, il limite massimo è %1$d %2$s.<br />Il limite è definito nel php.ini e non può essere ignorato da phpBB.',
	'PLACE_INLINE'				=> 'Inserisci in linea con il testo',
	'POLL_DELETE'				=> 'Elimina sondaggio',
	'POLL_FOR'					=> 'Mantieni sondaggio per',
	'POLL_FOR_EXPLAIN'			=> 'Scrivi 0 o lascia il campo vuoto per un sondaggio infinito.',
	'POLL_MAX_OPTIONS'			=> 'Opzioni per utente',
	'POLL_MAX_OPTIONS_EXPLAIN'	=> 'Numero di voci che ciascun utente può selezionare nel votare.',
	'POLL_OPTIONS'				=> 'Opzioni',
	'POLL_OPTIONS_EXPLAIN'		=> array(
		1	=> 'Inserisci una voce per riga. Puoi specificare fino a <strong>%d</strong> opzioni.',
		2	=> 'Inserisci una voce per riga. Puoi specificare fino a <strong>%d</strong> opzioni.',
	),
	'POLL_OPTIONS_EDIT_EXPLAIN'		=> array(
		1	=> 'Inserisci una voce per riga. Puoi specificare fino a <strong>%d</strong> opzione. Se modificando il messaggio rimuovi o aggiungi opzioni, tutti i voti precedenti saranno annullati.',
		2	=> 'Inserisci una voce per riga. Puoi specificare fino a <strong>%d</strong> opzioni. Se modificando il messaggio rimuovi o aggiungi opzioni, tutti i voti precedenti saranno annullati.',
	),
	'POLL_QUESTION'				=> 'Domanda del sondaggio',
	'POLL_TITLE_TOO_LONG'		=> 'Il titolo del sondaggio deve contenere meno di 100 caratteri.',
	'POLL_TITLE_COMP_TOO_LONG'	=> 'Il titolo del sondaggio è troppo grande, valuta di rimuovere BBCode o emoticon.',
	'POLL_VOTE_CHANGE'			=> 'Permetti cambio voto',
	'POLL_VOTE_CHANGE_EXPLAIN'	=> 'Se abilitato, gli utenti potranno modificare il proprio voto in un secondo momento.',
	'POSTED_ATTACHMENTS'		=> 'Allegati inseriti',
	'POST_APPROVAL_NOTIFY'		=> 'Sarai avvisato quando il tuo messaggio sarà approvato o disapprovato.',
	'POST_CONFIRMATION'			=> 'Conferma inserimento',
	'POST_CONFIRM_EXPLAIN'		=> 'Per prevenire inserimenti automatizzati, l’amministratore richiede l’inserimento di un codice di conferma. Il codice è mostrato nell’immagine sottostante. Se hai problemi a visualizzare il codice o l’immagine, contatta l’%sAmministratore%s.',
	'POST_DELETED'				=> 'Il messaggio è stato cancellato.',
	'POST_EDITED'				=> 'Il messaggio è stato modificato.',
	'POST_EDITED_MOD'			=> 'Il messaggio è stato modificato, ma dovrà essere approvato da un moderatore prima che sia pubblicamente attivo.',
	'POST_GLOBAL'				=> 'Globale',
	'POST_ICON'					=> 'Icona messaggio',
	'POST_NORMAL'				=> 'Normale',
	'POST_REVIEW'				=> 'Rivedi messaggio',
	'POST_REVIEW_EDIT'			=> 'Rivedi messaggio',
	'POST_REVIEW_EDIT_EXPLAIN'	=> 'Nel frattempo sono stati inseriti uno o più messaggi in questo argomento. Alla luce di questo, puoi rivedere il tuo messaggio.',
	'POST_REVIEW_EXPLAIN'		=> 'Nel frattempo sono stati inseriti uno o più messaggi in questo argomento. Alla luce di questo, puoi rivedere il tuo messaggio.',
	'POST_STORED'				=> 'Messaggio inserito correttamente.',
	'POST_STORED_MOD'			=> 'Il messaggio è stato inviato correttamente, ma dovrà essere approvato da un moderatore prima che sia pubblicamente attivo.',
	'POST_TOPIC_AS'				=> 'Inserisci argomento come',
	'PROGRESS_BAR'				=> 'Barra di avanzamento',

	'QUOTE_DEPTH_EXCEEDED'		=> array(
		1	=> 'Puoi inserire al massimo %d citazione una nell’altra.',
		2	=> 'Puoi inserire al massimo %d citazioni una nell’altra.',
	),
	'QUOTE_NO_NESTING'			=> 'Non è possibile inserire citazioni all’interno di altre.',

	'REMOTE_UPLOAD_TIMEOUT'		=> 'Il file specificato non può essere caricato a causa del time out della richiesta.',
	'SAVE'						=> 'Salva',
	'SAVE_DATE'					=> 'Salvato in',
	'SAVE_DRAFT'				=> 'Salva bozza',
	'SAVE_DRAFT_CONFIRM'		=> 'Le bozze salvate includono solamente titolo e corpo del messaggio, altri elementi vengono esclusi. Vuoi salvare la bozza ora?',
	'SMILIES'					=> 'Emoticon',
	'SMILIES_ARE_OFF'			=> 'Emoticon <em>non attive</em>',
	'SMILIES_ARE_ON'			=> 'Emoticon <em>attive</em>',
	'STICKY_ANNOUNCE_TIME_LIMIT'=> 'Durata Importante/Annuncio/Annuncio Globale',
	'STICK_TOPIC_FOR'			=> 'Mantieni come Importante/Annuncio per',
	'STICK_TOPIC_FOR_EXPLAIN'	=> '<br />Scrivi 0 o lascia il campo vuoto per una durata infinita dell’Argomento Importante o dell’Annuncio. Ricorda che il numero di giorni è relativo alla data del messaggio. Perché l’argomento Importante o l’Annuncio, diventi un argomento normale, è necessario che sia visualizzato dopo la scadenza del termine impostato.',
	'STYLES_TIP'				=> 'N.B.: si possono applicare rapidamente gli stili al testo selezionato.',

	'TOO_FEW_CHARS'				=> 'Il messaggio è troppo corto.',
	'TOO_FEW_CHARS_LIMIT'		=> array(
		1	=> 'È necessario inserire almeno %1$d carattere.',
		2	=> 'È necessario inserire almeno %1$d caratteri.',
	),
	'TOO_FEW_POLL_OPTIONS'		=> 'Devi inserire almeno due voci nel sondaggio.',
	'TOO_MANY_ATTACHMENTS'		=> 'Non puoi inserire un altro allegato, %d è il limite massimo.',
	'TOO_MANY_CHARS'			=> 'Il messaggio è troppo lungo.',
	'TOO_MANY_CHARS_LIMIT'		=> array(
		2	=> 'Il numero massimo di caratteri permessi è %1$d.',
	),
	'TOO_MANY_POLL_OPTIONS'		=> 'Hai cercato di inserire troppe voci nel sondaggio',
	'TOO_MANY_SMILIES'			=> 'Il messaggio contiene troppe emoticon. Il limite massimo è %d.',
	'TOO_MANY_URLS'				=> 'Il messaggio contiene troppi collegamenti. Il limite massimo è %d.',
	'TOO_MANY_USER_OPTIONS'		=> 'Non puoi specificare più voci per utente di quante ne contenga il sondaggio.',
	'TOPIC_BUMPED'				=> 'Bump argomento eseguito correttamente.',

	'UNAUTHORISED_BBCODE'		=> 'Non puoi usare questo BBCode: %s.',
	'UNSUPPORTED_CHARACTERS_MESSAGE'	=> 'Il tuo messaggio contiene i seguenti caratteri non supportati:<br />%s',
	'UNSUPPORTED_CHARACTERS_SUBJECT'	=> 'Il tuo oggetto contiene i seguenti caratteri non supportati:<br />%s',
	'UPDATE_COMMENT'			=> 'Aggiorna commento',
	'URL_INVALID'				=> 'Hai specificato un URL non valido.',
	'URL_NOT_FOUND'				=> 'Il file specificato non è stato trovato.',
	'URL_IS_OFF'				=> '[url] <em>non attivo</em>',
	'URL_IS_ON'					=> '[url] <em>attivo</em>',
	'USER_CANNOT_BUMP'			=> 'Non puoi eseguire il bump argomento in questo forum.',
	'USER_CANNOT_DELETE'		=> 'Non puoi cancellare messaggi in questo forum.',
	'USER_CANNOT_EDIT'			=> 'Non puoi modificare messaggi in questo forum.',
	'USER_CANNOT_REPLY'			=> 'Non puoi rispondere agli argomenti in questo forum.',
	'USER_CANNOT_FORUM_POST'	=> 'Non puoi inserire messaggi in questo forum in quanto il tipo di forum non lo consente.',

	'VIEW_MESSAGE'				=> '%sVisualizza il messaggio%s',
	'VIEW_PRIVATE_MESSAGE'		=> '%sVisualizza il tuo messaggio inviato%s',

	'WRONG_FILESIZE'			=> 'La dimensione del file è eccessiva; il limite massimo è %1$d %2$s.',
	'WRONG_SIZE'				=> 'L’immagine deve essere larga almeno %1$s pixel, alta almeno %2$s pixel, al massimo larga %3$s pixel e alta %4$s pixel. L’immagine proposta è larga %5$s pixel ed alta %6$s pixel.',
));
