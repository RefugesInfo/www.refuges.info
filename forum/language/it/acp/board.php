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

// Board Settings
$lang = array_merge($lang, array(
	'ACP_BOARD_SETTINGS_EXPLAIN'	=> 'Qui puoi impostare le funzioni base della tua Board, darle un nome appropriato ed una descrizione adeguata. Fra le altre opzioni puoi regolare i valori predefiniti per il fuso orario e per la lingua.',
	'BOARD_INDEX_TEXT'				=> 'Testo Indice della Board',
	'BOARD_INDEX_TEXT_EXPLAIN'		=> 'Questo testo è visualizzato come Indice della Board nella barra di navigazione della Board stessa. Se non specificato, verrà visualizzato “Indice”.',
	'BOARD_STYLE'					=> 'Stile Board',
	'CUSTOM_DATEFORMAT'				=> 'Personalizzato…',
	'DEFAULT_DATE_FORMAT'			=> 'Formato della data',
	'DEFAULT_DATE_FORMAT_EXPLAIN'	=> 'La sintassi utilizza lo stesso formato della funzione data del PHP <a href="https://www.php.net/manual/datetime.format.php">date()</a>',
	'DEFAULT_LANGUAGE'				=> 'Lingua predefinita',
	'DEFAULT_STYLE'					=> 'Stile predefinito',
	'DEFAULT_STYLE_EXPLAIN'			=> 'Lo stile predefinito per i nuovi utenti.',
	'DISABLE_BOARD'					=> 'Disabilita la Board',
	'DISABLE_BOARD_EXPLAIN'			=> 'Questa opzione renderà la Board non disponibile per gli utenti che non sono amministratori o moderatori. È anche possibile inserire un breve messaggio di spiegazione (non deve superare i 255 caratteri).',
	'DISPLAY_LAST_SUBJECT'			=> 'Visualizza l’oggetto dell’ultimo messaggio aggiunto nella lista forum',
	'DISPLAY_LAST_SUBJECT_EXPLAIN'	=> 'L’oggetto dell’ultimo messaggio aggiunto sarà visualizzato nella lista dei forum con un link relativo al messaggio stesso. Gli oggetti relativi a forum protetti da password e di cui l’utente non dispone di permessi in lettura, non vengono visualizzati.',
	'DISPLAY_UNAPPROVED_POSTS'		=> 'Mostra i messaggi non approvati dall’autore',
	'DISPLAY_UNAPPROVED_POSTS_EXPLAIN'	=> 'I messaggi non approvati possono essere visualizzati dall’autore. Non si applica ai messaggi degli ospiti.',
	'GUEST_STYLE'					=> 'Stile per gli ospiti',
	'GUEST_STYLE_EXPLAIN'			=> 'Lo stile della Board per gli ospiti',
	'OVERRIDE_STYLE'				=> 'Annulla lo stile dell’utente',
	'OVERRIDE_STYLE_EXPLAIN'		=> 'Sostituisce lo stile dell’utente (e per gli ospiti) con quello predefinito.',
	'SITE_DESC'						=> 'Descrizione Board',
	'SITE_HOME_TEXT'				=> 'Testo Home Page del Sito Web',
	'SITE_HOME_TEXT_EXPLAIN'		=> 'Questo testo verrà visualizzato come un link verso l’Home Page del tuo Sito Web, sulla barra di navigazione della Board. Se non specificato, come testo predefinito, verrà utilizzata la stringa “Home”.',
	'SITE_HOME_URL'					=> 'Indirizzo URL della Home Page del Sito Web',
	'SITE_HOME_URL_EXPLAIN'			=> 'Se specificato, un link a questo URL sarà anteposto nella barra di navigazione della Board e il logo della Board punterà a questo URL invece che all’Indice del Forum. È richiesto un URL assoluto, ad esempio <samp>https://www.phpbb.com</samp>.',
	'SITE_NAME'						=> 'Nome Board',
	'SYSTEM_TIMEZONE'				=> 'Fuso orario ospite',
	'SYSTEM_TIMEZONE_EXPLAIN'		=> 'Fuso orario da utilizzare per la visualizzazione degli utenti che non sono connessi (ospiti, ma anche Bot). Gli utenti connessi possono scegliere il fuso orario in fase di registrazione e possono modificarlo nel proprio Pannello di Controllo Utente.',
	'WARNINGS_EXPIRE'				=> 'Durata del richiamo',
	'WARNINGS_EXPIRE_EXPLAIN'		=> 'Numero di giorni che devono trascorrere prima che un richiamo sia cancellato automaticamente dal profilo di un utente. Imposta questo valore su 0 per rendere permanenti i richiami.',
));

// Board Features
$lang = array_merge($lang, array(
	'ACP_BOARD_FEATURES_EXPLAIN'	=> 'Qui puoi abilitare/disabilitare diverse caratteristiche.',

	'ALLOW_ATTACHMENTS'			=> 'Abilita gli allegati',
	'ALLOW_BIRTHDAYS'			=> 'Abilita il Pannello Compleanni',
	'ALLOW_BIRTHDAYS_EXPLAIN'	=> 'Dà la possibilità di inserire la data del compleanno e di visualizzare l’età nel profilo utente. Nota Bene: questa impostazione non è quella che controlla la visualizzazione del Pannello Compleanni nell’Indice.',
	'ALLOW_BOOKMARKS'			=> 'Abilita i segnalibri per gli argomenti',
	'ALLOW_BOOKMARKS_EXPLAIN'	=> 'L’utente può memorizzare dei segnalibri per ritrovare facilmente degli argomenti di interesse',
	'ALLOW_BBCODE'				=> 'Abilita i BBCode',
	'ALLOW_FORUM_NOTIFY'		=> 'Abilita la sottoscrizione ai forum',
	'ALLOW_NAME_CHANGE'			=> 'Abilita il cambio nome utente',
	'ALLOW_NO_CENSORS'			=> 'Permetti la disabilitazione censura parole',
	'ALLOW_NO_CENSORS_EXPLAIN'	=> 'Gli utenti possono scegliere se disabilitare la funzione automatica per la censura delle parole, sia nei messaggi pubblici che nei messaggi privati.',
	'ALLOW_PM_ATTACHMENTS'		=> 'Abilita gli allegati nei messaggi privati',
	'ALLOW_PM_REPORT'			=> 'Abilita la segnalazione dei messaggi privati',
	'ALLOW_PM_REPORT_EXPLAIN'	=> 'Se questa impostazione è attivata gli utenti avranno la possibilità di segnalare allo staff un messaggio privato che abbiano ricevuto o spedito. Questi messaggi privati saranno poi visibili nel Pannello di Controllo Moderatore.',
	'ALLOW_QUICK_REPLY'			=> 'Abilita risposta rapida',
	'ALLOW_QUICK_REPLY_EXPLAIN' => 'Questa impostazione permette di disabilitare la risposta rapida su tutta la Board. Se abilitata, saranno usate le impostazioni dei singoli forum per decidere se visualizzare o meno la risposta rapida nei forum stessi',
	'ALLOW_QUICK_REPLY_BUTTON'	=> 'Abilita la risposta rapida in tutti i forum',
	'ALLOW_SIG'					=> 'Abilita le firme',
	'ALLOW_SIG_BBCODE'			=> 'Abilita i BBCode nelle firme degli utenti',
	'ALLOW_SIG_FLASH'			=> 'Abilita l’uso del BBCode <code>[FLASH]</code> nelle firme degli utenti',
	'ALLOW_SIG_IMG'				=> 'Abilita l’uso del BBCode <code>[IMG]</code> nelle firme degli utenti',
	'ALLOW_SIG_LINKS'			=> 'Abilita l’inserimento di collegamenti nelle firme degli utenti',
	'ALLOW_SIG_LINKS_EXPLAIN'	=> 'Se disabilitato, il BBCode <code>[URL]</code> e gli URL automatici non saranno attivi.',
	'ALLOW_SIG_SMILIES'			=> 'Abilita l’inserimento delle emoticon nelle firme degli utenti',
	'ALLOW_SMILIES'				=> 'Abilita le emoticon',
	'ALLOW_TOPIC_NOTIFY'		=> 'Abilita la sottoscrizione agli argomenti',
	'BOARD_PM'					=> 'Messaggi privati',
	'BOARD_PM_EXPLAIN'			=> 'Abilita l’uso dei messaggi privati per tutti gli utenti.',
	'ALLOW_BOARD_NOTIFICATIONS' => 'Abilita le notifiche nella Board',
));

// Avatar Settings
$lang = array_merge($lang, array(
	'ACP_AVATAR_SETTINGS_EXPLAIN'	=> 'Gli avatar sono immagini generalmente piccole che un utente può associare a sé stesso. A seconda dello stile in uso vengono visualizzati solitamente sotto il nome utente, di fianco ai messaggi. Da qui regoli le impostazioni e le modalità di utilizzo avatar degli utenti. Per permettere il caricamento degli avatar devi aver creato sul server un’apposita cartella che abbia adeguati permessi di scrittura. I limiti per le dimensioni dei file sono impostabili solo per gli avatar caricati sulla Board e non per le immagini caricate da remoto.',

	'ALLOW_AVATARS'					=> 'Abilita gli avatar',
	'ALLOW_AVATARS_EXPLAIN'			=> 'Abilita l’uso degli avatar;<br />Se disabiliti gli avatar in generale oppure gli avatar di un certo tipo, gli avatar disabilitati non saranno più visibili nei vari argomenti, ma gli utenti potranno comunque scaricare i propri avatar dal Pannello di Controllo Utente.',
	'ALLOW_GRAVATAR'				=> 'Abilita gli avatar gravatar',
	'ALLOW_LOCAL'					=> 'Abilita la galleria avatar',
	'ALLOW_REMOTE'					=> 'Abilita gli avatar remoti',
	'ALLOW_REMOTE_EXPLAIN'			=> 'Avatar memorizzati su un altro sito web.<br /><em><strong class="error">Attenzione:</strong> l’abilitazione di questa funzione potrebbe consentire agli utenti di verificare l’esistenza di file e servizi accessibili solo sulla rete locale.</em>',
	'ALLOW_REMOTE_UPLOAD'			=> 'Abilita il caricamento degli avatar da un altro sito web',
	'ALLOW_REMOTE_UPLOAD_EXPLAIN'	=> 'Abilita la possibilità di caricare gli avatar memorizzati su un altro sito web.<br /><em><strong class="error">Attenzione:</strong> l’abilitazione di questa funzione potrebbe consentire agli utenti di verificare l’esistenza di file e servizi accessibili solo sulla rete locale.</em>',
	'ALLOW_UPLOAD'					=> 'Abilita il caricamento degli avatar',
	'AVATAR_GALLERY_PATH'			=> 'Percorso della galleria avatar',
	'AVATAR_GALLERY_PATH_EXPLAIN'	=> 'Il percorso dalla radice del phpbb alla cartella contenente le immagini precaricate, es. <samp>images/avatars/gallery</samp>.<br />Punti doppi come <samp>../</samp> verranno rimossi dal percorso per motivi di sicurezza.',
	'AVATAR_STORAGE_PATH'			=> 'Percorso di salvataggio avatar',
	'AVATAR_STORAGE_PATH_EXPLAIN'	=> 'Il percorso della radice del phpbb relativo alla cartella in cui verranno memorizzati gli avatar, es. <samp>images/avatars/upload</samp>.<br />L’avatar caricato <strong>non sarà disponibile</strong> se la cartella non è scrivibile.<br />Punti doppi come <samp>../</samp> verranno rimossi dal percorso per motivi di sicurezza.',
	'MAX_AVATAR_SIZE'				=> 'Dimensioni massime avatar',
	'MAX_AVATAR_SIZE_EXPLAIN'		=> 'Larghezza per altezza in pixel',
	'MAX_FILESIZE'					=> 'Dimensione massima file avatar',
	'MAX_FILESIZE_EXPLAIN'			=> 'Per i file avatar caricati. Se questo valore è uguale a 0, la dimensione del file caricato sarà limitata solo dalla configurazione PHP.',
	'MIN_AVATAR_SIZE'				=> 'Dimensioni minime avatar',
	'MIN_AVATAR_SIZE_EXPLAIN'		=> 'Larghezza per altezza in pixel',
));

// Message Settings
$lang = array_merge($lang, array(
	'ACP_MESSAGE_SETTINGS_EXPLAIN'		=> 'Da qui puoi impostare tutte le funzioni predefinite per i messaggi privati.',

	'ALLOW_BBCODE_PM'			=> 'Abilita BBCode nei messaggi privati',
	'ALLOW_FLASH_PM'			=> 'Abilita l’uso del tag BBCode <code>[FLASH]</code> nei messaggi privati',
	'ALLOW_FLASH_PM_EXPLAIN'	=> 'La possibilità di utilizzare il tag flash nei messaggi privati, anche se qui abilitata, dipende dalla gestione permessi.',
	'ALLOW_FORWARD_PM'			=> 'Abilita messaggi privati',
	'ALLOW_IMG_PM'				=> 'Abilita l’uso del tag BBCode <code>[IMG]</code>',
	'ALLOW_MASS_PM'				=> 'Abilita invio di messaggi privati a utenti multipli ed a gruppi',
	'ALLOW_MASS_PM_EXPLAIN'		=> 'L’opzione di invio ai gruppi può essere modificata per singolo gruppo nella pagina di impostazioni del gruppo stesso.',
	'ALLOW_PRINT_PM'			=> 'Abilita la versione stampabile dei messaggi privati',
	'ALLOW_QUOTE_PM'			=> 'Abilita le citazioni nei messaggi privati',
	'ALLOW_SIG_PM'				=> 'Abilita la firma nei messaggi privati',
	'ALLOW_SMILIES_PM'			=> 'Abilita le emoticon nei messaggi privati',
	'BOXES_LIMIT'				=> 'Limite massimo di messaggi privati per casella',
	'BOXES_LIMIT_EXPLAIN'		=> 'Gli utenti non potranno ricevere più di questo numero di messaggi privati. 0 = illimitato.',
	'BOXES_MAX'					=> 'Limite massimo di cartelle per i messaggi privati',
	'BOXES_MAX_EXPLAIN'			=> 'Per impostazione predefinita gli utenti possono creare più cartelle personali per i propri messaggi privati.',
	'ENABLE_PM_ICONS'			=> 'Abilita l’uso delle icone argomenti per i messaggi privati',
	'FULL_FOLDER_ACTION'		=> 'Azione predefinita in caso di casella piena',
	'FULL_FOLDER_ACTION_EXPLAIN'=> 'Qualunque sia l’azione prescelta (o meno) dall’utente, in caso di casella dei messaggi privati piena, questa è l’azione che viene svolta. L’unica eccezione è per la casella dei messaggi inviati, dove l’azione predefinita è sempre quella di eliminare i vecchi messaggi.',
	'HOLD_NEW_MESSAGES'			=> 'Trattieni i nuovi messaggi',
	'PM_EDIT_TIME'				=> 'Limite di tempo per modifica',
	'PM_EDIT_TIME_EXPLAIN'		=> 'Limite di tempo disponibile per modificare un messaggio privato non ancora consegnato. 0 = illimitato.',
	'PM_MAX_RECIPIENTS'			=> 'Numero massimo di destinatari consentiti',
	'PM_MAX_RECIPIENTS_EXPLAIN'	=> 'Il numero massimo di destinatari consentiti in un messaggio privato. 0 = illimitato. Questa opzione può essere modificata per singolo gruppo nella pagina di impostazioni del gruppo stesso.',
));

// Post Settings
$lang = array_merge($lang, array(
	'ACP_POST_SETTINGS_EXPLAIN'			=> 'Qui puoi regolare tutte le impostazioni predefinite per i messaggi.',
	'ALLOW_POST_LINKS'					=> 'Abilita i collegamenti nei messaggi pubblici e nei messaggi privati',
	'ALLOW_POST_LINKS_EXPLAIN'			=> 'Se disabilitato, il BBCode <code>[URL]</code> e gli URL automatici sono disabilitati.',
	'ALLOWED_SCHEMES_LINKS'				=> 'Abilita gli schemi dei link',
	'ALLOWED_SCHEMES_LINKS_EXPLAIN'		=> 'Gli utenti possono inviare solo URL schemati o uno degli elenchi autorizzati separati da virgole.',
	'ALLOW_POST_FLASH'					=> 'Abilita l’uso del BBCode <code>[FLASH]</code> nei messaggi',
	'ALLOW_POST_FLASH_EXPLAIN'			=> 'Se disabilitato, il BBCode <code>[FLASH]</code> non sarà abilitato nei messaggi. In alternativa il sistema dei permessi controlla quali utenti possono usare il tag BBCode <code>[FLASH]</code>.',

	'BUMP_INTERVAL'					=> 'Intervallo del bump',
	'BUMP_INTERVAL_EXPLAIN'			=> 'Numero di minuti, ore o giorni trascorsi fra l’ultimo messaggio di un argomento e la possibilità di spostarlo in cima. Impostando su 0 si disabilita questa funzione.',
	'CHAR_LIMIT'					=> 'Numero massimo di caratteri per messaggio',
	'CHAR_LIMIT_EXPLAIN'			=> 'Numero massimo di caratteri permessi in un messaggio. 0 = illimitato.',
	'DELETE_TIME'					=> 'Limite tempo cancellazione',
	'DELETE_TIME_EXPLAIN'			=> 'Limite di tempo disponibile per cancellare un nuovo messaggio. Impostando su 0 si disabilita questa azione.',
	'DISPLAY_LAST_EDITED'			=> 'Visualizza informazioni sull’ultima modifica',
	'DISPLAY_LAST_EDITED_EXPLAIN'	=> 'Scegli se visualizzare informazioni sull’ultima modifica di un messaggio',
	'EDIT_TIME'						=> 'Limite tempo modifica',
	'EDIT_TIME_EXPLAIN'				=> 'Limite di tempo disponibile per modificare un nuovo messaggio. Impostando su 0 si disabilita questa azione.',
	'FLOOD_INTERVAL'				=> 'Intervallo del flood',
	'FLOOD_INTERVAL_EXPLAIN'		=> 'Numero di secondi di attesa tra un messaggio e l’altro. Per permettere agli utenti di ignorare questa funzione devi modificarne i permessi.',
	'HOT_THRESHOLD'					=> 'Limite messaggi popolari',
	'HOT_THRESHOLD_EXPLAIN'			=> 'Numero di messaggi richiesto per rendere un messaggio popolare. 0 = disabilita i messaggi popolari.',
	'MAX_POLL_OPTIONS'				=> 'Numero massimo di opzioni per sondaggio',
	'MAX_POST_FONT_SIZE'			=> 'Grandezza massima del carattere per messaggio',
	'MAX_POST_FONT_SIZE_EXPLAIN'	=> 'Grandezza massima consentita per i caratteri dei messaggi. 0 = illimitata.',
	'MAX_POST_IMG_HEIGHT'			=> 'Altezza massima file flash per messaggio',
	'MAX_POST_IMG_HEIGHT_EXPLAIN'	=> 'Altezza massima del file flash nei messaggi. 0 = illimitata.',
	'MAX_POST_IMG_WIDTH'			=> 'Larghezza massima file flash per messaggio',
	'MAX_POST_IMG_WIDTH_EXPLAIN'	=> 'Larghezza massima del file flash nei messaggi. 0 = illimitata.',
	'MAX_POST_URLS'					=> 'Link massimi per messaggio',
	'MAX_POST_URLS_EXPLAIN'			=> 'Numero massimo di URL in un argomento. 0 = illimitato.',
	'MIN_CHAR_LIMIT'				=> 'Numero minimo di caratteri per messaggio',
	'MIN_CHAR_LIMIT_EXPLAIN'		=> 'Il numero minimo di caratteri che un utente deve inserire in un messaggio o in un messaggio privato. Il minimo per questa voce è 1.',
	'POSTING'						=> 'Invio messaggi',
	'POSTS_PER_PAGE'				=> 'Messaggi per pagina',
	'QUOTE_DEPTH_LIMIT'				=> 'Limite massimo di citazioni annidate per messaggio',
	'QUOTE_DEPTH_LIMIT_EXPLAIN'		=> 'Numero massimo di citazioni concatenate per messaggio. 0 = illimitata.',
	'SMILIES_LIMIT'					=> 'Limite massimo di emoticon per messaggio',
	'SMILIES_LIMIT_EXPLAIN'			=> 'Numero limite di emoticon per messaggio.  0 = illimitato.',
	'SMILIES_PER_PAGE'				=> 'Emoticon per pagina',
	'TOPICS_PER_PAGE'				=> 'Argomenti per pagina',
));

// Signature Settings
$lang = array_merge($lang, array(
	'ACP_SIGNATURE_SETTINGS_EXPLAIN'	=> 'Qui puoi impostare tutti i parametri per le firme.',

	'MAX_SIG_FONT_SIZE'				=> 'Dimensione massima del carattere in firma',
	'MAX_SIG_FONT_SIZE_EXPLAIN'		=> 'Dimensione massima consentita per lo spazio firme utenti. 0 = illimitata.',
	'MAX_SIG_IMG_HEIGHT'			=> 'Altezza massima immagini in firma',
	'MAX_SIG_IMG_HEIGHT_EXPLAIN'	=> 'Altezza massima consentita per un’immagine o file flash nello spazio firma utente. 0 = illimitata.',
	'MAX_SIG_IMG_WIDTH'				=> 'Larghezza massima immagini in firma',
	'MAX_SIG_IMG_WIDTH_EXPLAIN'		=> 'Larghezza massima consentita per un’immagine o file flash nello spazio firma utente. 0 = illimitata.',
	'MAX_SIG_LENGTH'				=> 'Lunghezza massima firma',
	'MAX_SIG_LENGTH_EXPLAIN'		=> 'Numero massimo di caratteri per la firma degli utenti.',
	'MAX_SIG_SMILIES'				=> 'Numero massimo di emoticon per firma',
	'MAX_SIG_SMILIES_EXPLAIN'		=> 'Numero massimo di emoticon consentiti per la firma degli utenti. 0 = illimitato.',
	'MAX_SIG_URLS'					=> 'Numero massimo di link per firma',
	'MAX_SIG_URLS_EXPLAIN'			=> 'Numero massimo di link consentiti per la firma degli utenti. 0 = illimitato.',
));

// Registration Settings
$lang = array_merge($lang, array(
	'ACP_REGISTER_SETTINGS_EXPLAIN'		=> 'Qui puoi definire le impostazioni relative alla registrazione e al profilo',

	'ACC_ACTIVATION'					=> 'Attivazione account',
	'ACC_ACTIVATION_EXPLAIN'			=> 'Stabilisce se gli utenti hanno accesso immediato alla Board oppure se è richiesta una conferma. Puoi anche disabilitare completamente le nuove registrazioni. <em>“L’invio email dalla Board” deve essere abilitato per utilizzare l’attivazione utente o amministratore.</em>',
	'ACC_ACTIVATION_WARNING'		=> 'Nota che il metodo di attivazione selezionato, richiede l’email per essere utilizzato, altrimenti la registrazione verrà disattivata. Si consiglia di selezionare un metodo di attivazione diverso o di riattivare le email.',
	'NEW_MEMBER_POST_LIMIT'				=> 'Minimo messaggi per i Nuovi Utenti Registrati',
	'NEW_MEMBER_POST_LIMIT_EXPLAIN'		=> 'I nuovi utenti, rimangono nel gruppo <em>Nuovi Utenti Registrati</em> fino a quando non raggiungono questo numero di messaggi. Puoi usare questo gruppo per impedire che possano usare i messaggi privati o possano modificare i loro messaggi pubblici. <strong>Mettendo 0 disabiliti questa funzione.</strong>',
	'NEW_MEMBER_GROUP_DEFAULT'			=> 'Imposta il gruppo Nuovi Utenti Registrati come predefinito',
	'NEW_MEMBER_GROUP_DEFAULT_EXPLAIN'	=> 'Se impostato su Sì ed è impostato il numero minimo di messaggi, i nuovi utenti registrati saranno non solo assegnati automaticamente al gruppo <em>Nuovi Utenti Registrati</em>, ma questo diventerà il loro gruppo predefinito. Questo risulta comodo se si vuole assegnare un livello di gruppo o avatar predefinito, che il nuovo utente quindi si vedrà assegnato.',

	'ACC_ADMIN'					=> 'Amministratore',
	'ACC_DISABLE'				=> 'Disabilita la registrazione',
	'ACC_NONE'					=> 'Nessuna attivazione (accesso immediato)',
	'ACC_USER'					=> 'Utente (email di verifica)',
//	'ACC_USER_ADMIN'			=> 'Utente + Amministratore',
	'ALLOW_EMAIL_REUSE'			=> 'Consenti riutilizzo indirizzo email',
	'ALLOW_EMAIL_REUSE_EXPLAIN'	=> 'Abilitando questa funzione si consente a utenti diversi di registrarsi con lo stesso indirizzo email.',
	'COPPA'						=> 'Impostazioni reg. Minore (COPPA)',
	'COPPA_FAX'					=> 'Numero di fax per reg. Minore',
	'COPPA_MAIL'				=> 'Indirizzo postale per reg. Minore',
	'COPPA_MAIL_EXPLAIN'		=> 'Questo è l’indirizzo al quale i genitori devono spedire il modulo di registrazione per gli utenti COPPA.',
	'ENABLE_COPPA'				=> 'Abilita reg. Minore',
	'ENABLE_COPPA_EXPLAIN'		=> 'Richiede agli utenti di dichiarare se hanno più o meno di 13 anni. Se questa funzione è disabilitata il gruppo reg. Minore non verrà più visualizzato.',
	'MAX_CHARS'					=> 'Massimo',
	'MIN_CHARS'					=> 'Minimo',
	'NO_AUTH_PLUGIN'			=> 'Nessun plugin di autorizzazione idoneo trovato.',
	'PASSWORD_LENGTH'			=> 'Lunghezza password',
	'PASSWORD_LENGTH_EXPLAIN'	=> 'Numero minimo di caratteri per la password. Nota: il numero massimo non è limitato.',
	'REG_LIMIT'					=> 'Tentativi di registrazione',
	'REG_LIMIT_EXPLAIN'			=> 'Numero di tentativi che un utente può fare, al momento del Codice di conferma di registrazione, prima che la sessione venga bloccata.',
	'USERNAME_ALPHA_ONLY'		=> 'Solo alfanumerico',
	'USERNAME_ALPHA_SPACERS'	=> 'Alfanumerico e spaziature',
	'USERNAME_ASCII'			=> 'ASCII (non international unicode)',
	'USERNAME_LETTER_NUM'		=> 'Qualsiasi lettera e numero',
	'USERNAME_LETTER_NUM_SPACERS'	=> 'Qualsiasi lettera, numero e spaziatura',
	'USERNAME_CHARS'			=> 'Limite caratteri nome utente',
	'USERNAME_CHARS_ANY'		=> 'Qualsiasi carattere',
	'USERNAME_CHARS_EXPLAIN'	=> 'Restringe il tipo di caratteri che possono essere usati per i nomi utente; le spaziature sono: spazio, -, +, _, [ e ].',
	'USERNAME_LENGTH'			=> 'Lunghezza nome utente',
	'USERNAME_LENGTH_EXPLAIN'	=> 'Numero minimo e massimo di caratteri consentiti per i nomi utente.',
));

// Feeds
$lang = array_merge($lang, array(
	'ACP_FEED_MANAGEMENT'				=> 'Impostazioni generali Feed',
	'ACP_FEED_MANAGEMENT_EXPLAIN'		=> 'Questo modulo rende disponibili vari ATOM Feed, analizzando ogni BBCode nei messaggi per renderli leggibili in feed esterni.',

	'ACP_FEED_GENERAL'					=> 'Impostazioni Generali Feed',
	'ACP_FEED_POST_BASED'				=> 'Messaggi basati su impostazioni Feed',
	'ACP_FEED_TOPIC_BASED'				=> 'Argomenti basati su impostazioni Feed',
	'ACP_FEED_SETTINGS_OTHER'			=> 'Altre impostazioni Feed',

	'ACP_FEED_ENABLE'					=> 'Abilita Feed',
	'ACP_FEED_ENABLE_EXPLAIN'			=> 'Abilita o disabilita i Feed ATOM su tutta la Board.<br />La disattivazione, disabilita tutti i Feed, indipendentemente dalle impostazioni successive.',
	'ACP_FEED_LIMIT'					=> 'Numero di voci',
	'ACP_FEED_LIMIT_EXPLAIN'			=> 'Numero massimo di voci da visualizzare nel Feed.',

	'ACP_FEED_OVERALL'					=> 'Consenti livello Feed nella Board',
	'ACP_FEED_OVERALL_EXPLAIN'			=> 'Ampio livello nuovi messaggi.',
	'ACP_FEED_FORUM'					=> 'Abilita Feed per forum',
	'ACP_FEED_FORUM_EXPLAIN'			=> 'Nuovi messaggi su un singolo forum.',
	'ACP_FEED_TOPIC'					=> 'Abilita Feed per argomento',
	'ACP_FEED_TOPIC_EXPLAIN'			=> 'Nuovi messaggi su singoli argomenti.',

	'ACP_FEED_TOPICS_NEW'				=> 'Abilita Feed per i nuovi argomenti',
	'ACP_FEED_TOPICS_NEW_EXPLAIN'		=> 'Abilita Feed per i nuovi argomenti, visualizzando gli ultimi argomenti creati, incluso il primo messaggio.',
	'ACP_FEED_TOPICS_ACTIVE'			=> 'Abilita Feed per gli “Argomenti attivi”',
	'ACP_FEED_TOPICS_ACTIVE_EXPLAIN'	=> 'Abilita Feed per gli “Argomenti attivi”, visualizzando gli ultimi argomenti creati, incluso il primo messaggio.',
	'ACP_FEED_NEWS'						=> 'Nuovi Feed',
	'ACP_FEED_NEWS_EXPLAIN'				=> 'Seleziona il primo messaggio da questi forum. Non selezionare nessun forum per disattivare nuovi Feed.<br />Per selezionare più forum, usa <samp>CTRL</samp> cliccando col mouse.',

	'ACP_FEED_OVERALL_FORUMS'			=> 'Abilita globalmente i Feed nei forum',
	'ACP_FEED_OVERALL_FORUMS_EXPLAIN'	=> 'Questo Feed visualizza gli ultimi messaggi degli argomenti di tutti i forum.',

	'ACP_FEED_HTTP_AUTH'				=> 'Abilita autenticazione HTTP',
	'ACP_FEED_HTTP_AUTH_EXPLAIN'		=> 'Abilita l’autenticazione HTTP, che permette agli utenti di ricevere i contenuti nascosti agli ospiti con l’aggiunta del parametro <samp>auth=http</samp> all’URL Feed. Nota che alcune impostazioni del PHP richiedono ulteriori modifiche al file .htaccess. Le istruzioni possono essere trovate in quel file.',
	'ACP_FEED_ITEM_STATISTICS'			=> 'Voci statistiche',
	'ACP_FEED_ITEM_STATISTICS_EXPLAIN'	=> 'Visualizza le statistiche individuali sotto le voci Feed<br />(Inviato da, Data e ora, Risposte, Visite).',
	'ACP_FEED_EXCLUDE_ID'				=> 'Escludi questi forum',
	'ACP_FEED_EXCLUDE_ID_EXPLAIN'		=> 'Il contenuto di questi forum <strong>non sarà incluso nei Feed</strong>. Non selezionare nessun forum per estrarre i dati da tutti i forum.<br />Per selezionare/deselezionare più forum, usa <samp>CTRL</samp> cliccando col mouse.',
));

// Visual Confirmation Settings
$lang = array_merge($lang, array(
	'ACP_VC_SETTINGS_EXPLAIN'				=> 'Qui puoi selezionare e configurare i plugin che sono progettati per bloccare gli spambot. Questi plugin impongono all’utente un <em>CAPTCHA</em>, test che è stato progettato per essere difficile da risolvere per un Computer.',
	'ACP_VC_EXT_GET_MORE'					=> 'Per ulteriori (ed eventualmente migliori) plugin anti-spam, visita il <a href="https://www.phpbb.com/go/anti-spam-ext"><strong>Il Database delle Estensioni di phpBB.com</strong></a>. Per ulteriori informazioni su come prevenire lo spam sulla tua Board, visita il <a href="https://www.phpbb.com/go/anti-spam"><strong>phpBB.com Knowledge Base</strong></a>.',
	'AVAILABLE_CAPTCHAS'					=> 'Plugin disponibili',
	'CAPTCHA_UNAVAILABLE'					=> 'Il plugin non può essere selezionato se i suoi requisiti non sono rispettati.',
	'CAPTCHA_GD'							=> 'GD immagine',
	'CAPTCHA_GD_3D'							=> 'GD 3D immagine',
	'CAPTCHA_GD_FOREGROUND_NOISE'			=> 'Disturbo in primo piano',
	'CAPTCHA_GD_EXPLAIN'					=> 'Usa GD per ottenere un Codice Conferma Visuale più avanzato.',
	'CAPTCHA_GD_FOREGROUND_NOISE_EXPLAIN'	=> 'Usa il disturbo in primo piano per rendere più difficile il Codice Conferma Visuale.',
	'CAPTCHA_GD_X_GRID'						=> 'Usa il disturbo in primo piano per l’asse-x',
	'CAPTCHA_GD_X_GRID_EXPLAIN'				=> 'Usa un’impostazione bassa per rendere più difficile il Codice Conferma Visuale. 0 disabiliterà il disturbo sull’asse-x dello sfondo.',
	'CAPTCHA_GD_Y_GRID'						=> 'Usa il disturbo in primo piano per l’asse-y',
	'CAPTCHA_GD_Y_GRID_EXPLAIN'				=> 'Usa un’impostazione bassa per rendere più difficile il Codice Conferma Visuale. 0 disabiliterà il disturbo sull’asse-y dello sfondo.',
	'CAPTCHA_GD_WAVE'						=> 'Distorsione ondulatoria',
	'CAPTCHA_GD_WAVE_EXPLAIN'				=> 'Questo applica una distorsione onda all’immagine.',
	'CAPTCHA_GD_3D_NOISE'					=> 'Aggiungi oggetti disturbo 3D',
	'CAPTCHA_GD_3D_NOISE_EXPLAIN'			=> 'Questa funzione aggiunge degli oggetti addizionali al Codice Conferma Visuale, di fronte alle lettere.',
	'CAPTCHA_GD_FONTS'						=> 'Usa caratteri diversi',
	'CAPTCHA_GD_FONTS_EXPLAIN'				=> 'Questa impostazione controlla quante forme della lettera diverse vengono utilizzate. Si possono utilizzare le forme predefinite o introdurre forme alterate. Si possono anche aggiungere delle lettere minuscole.',
	'CAPTCHA_FONT_DEFAULT'					=> 'Predefinito',
	'CAPTCHA_FONT_NEW'						=> 'Nuove forme',
	'CAPTCHA_FONT_LOWER'					=> 'Usa anche minuscole',
	'CAPTCHA_NO_GD'							=> 'Semplice immagine',
	'CAPTCHA_PREVIEW_MSG'					=> 'Le modifiche non sono state salvate, questa è solo un’anteprima.',
	'CAPTCHA_PREVIEW_EXPLAIN'				=> 'Ecco il plugin come si presenta usando le impostazioni correnti.',

	'CAPTCHA_SELECT'						=> 'Plugin installati',
	'CAPTCHA_SELECT_EXPLAIN'				=> 'L’elenco a discesa contiene i plugin riconosciuti dalla Board. I nomi in grigio non sono al momento disponibili e potrebbero richiedere una configurazione prima del loro utilizzo.',
	'CAPTCHA_CONFIGURE'						=> 'Configura plugin',
	'CAPTCHA_CONFIGURE_EXPLAIN'				=> 'Modifica le impostazioni per il plugin selezionato.',
	'CONFIGURE'								=> 'Configura',
	'CAPTCHA_NO_OPTIONS'					=> 'Questo plugin non ha opzioni di configurazione.',

	'VISUAL_CONFIRM_POST'					=> 'Abilita conferma visuale per i messaggi degli ospiti',
	'VISUAL_CONFIRM_POST_EXPLAIN'			=> 'Richiede agli ospiti di inserire un codice casuale raffigurato da un’immagine al fine di prevenire messaggi di massa.',
	'VISUAL_CONFIRM_REG'					=> 'Abilita conferma visuale per le registrazioni',
	'VISUAL_CONFIRM_REG_EXPLAIN'			=> 'Richiede ai nuovi utenti di inserire un codice casuale raffigurato da un’immagine al fine di prevenire registrazioni di massa.',
	'VISUAL_CONFIRM_REFRESH'				=> 'Permette agli utenti di ricaricare l’immagine di conferma',
	'VISUAL_CONFIRM_REFRESH_EXPLAIN'		=> 'Permette agli utenti di richiedere nuovi codici di conferma se non sono in grado di effettuare la conferma visuale durante la registrazione. Alcuni plugin potrebbero non supportare questa opzione.',
));

// Cookie Settings
$lang = array_merge($lang, array(
	'ACP_COOKIE_SETTINGS_EXPLAIN'		=> 'Questi dettagli definiscono i dati utilizzati per inviare i cookie ai browser dei tuoi utenti. In molti casi l’impostazione predefinita è sufficiente. Se devi cambiare queste impostazioni fallo con attenzione: impostazioni errate potrebbero impedire agli utenti di effettuare l’accesso. Se gli utenti hanno problemi ad accedere alla tua Board, visita la <strong><a href="https://www.phpbb.com/support/go/cookie-settings/">Knowledge Base di phpBB.com - Risoluzione Impostazioni dei cookie non corrette</a></strong>',

	'COOKIE_DOMAIN'				=> 'Dominio cookie',
	'COOKIE_DOMAIN_EXPLAIN'		=> 'Nella maggior parte dei casi il dominio dei cookie è facoltativo. Lascia il campo vuoto se non sei sicuro.<br /><br />Nel caso in cui tu abbia una Board integrata con altri software o con più domini, per determinare il dominio dei cookie, devi fare quanto segue: se hai un dominio come <i>esempio.it </i> e <i>forum.esempio.it</i>, o  <i>blog.esempio.it</i>, rimuovi i sottodomini fino a trovare il dominio comune, <i>esempio.it</i>. Ora aggiungi un punto davanti al dominio comune e entra in .esempio.it (nota il punto all’inizio).',
	'COOKIE_NAME'				=> 'Nome cookie',
	'COOKIE_NAME_EXPLAIN'		=> 'Questo può essere modificato a propria discrezione. Ogni volta che vengono modificate le impostazioni dei cookie, il nome del cookie deve essere modificato.',
	'COOKIE_NOTICE'				=> 'Avviso cookie',
	'COOKIE_NOTICE_EXPLAIN'		=> 'Se abilitato, un avviso cookie verrà mostrato agli utenti che visitano la tua Board. Questo potrebbe essere richiesto dalla legge in base al contenuto della tua Board o in base alle estensioni abilitate.',
	'COOKIE_PATH'				=> 'Percorso cookie',
	'COOKIE_PATH_EXPLAIN'		=> 'Tieni presente che questa è sempre uno slash, non importa quale sia l’URl della tua Board.',
	'COOKIE_SECURE'				=> 'Cookie sicuri',
	'COOKIE_SECURE_EXPLAIN'		=> 'Se il tuo server funziona via SSL, abilita questo modulo, altrimenti lascialo disabilitato. Se abilitato, in assenza di SSL risulterà un errore nel server durante i reindirizzamenti.',
	'ONLINE_LENGTH'				=> 'Visualizza lasso tempo online',
	'ONLINE_LENGTH_EXPLAIN'		=> 'Numero di minuti dopo i quali gli utenti inattivi non appariranno più nella lista “Chi c’è in linea”. Più alto è questo valore e più grande sarà il processo richiesto per generare la lista.',
	'SESSION_LENGTH'			=> 'Durata sessione',
	'SESSION_LENGTH_EXPLAIN'	=> 'La sessione scadrà dopo questo lasso di tempo, in secondi.',
));

// Contact Settings
$lang = array_merge($lang, array(
	'ACP_CONTACT_SETTINGS_EXPLAIN'		=> 'Qui è possibile abilitare e disabilitare la pagina dei contatti e anche aggiungere un testo che viene visualizzato nella pagina.',

	'CONTACT_US_ENABLE'				=> 'Abilita pagina dei contatti',
	'CONTACT_US_ENABLE_EXPLAIN'		=> 'Questa pagina consente agli utenti di inviare email all’Amministratore della Board. Si noti che deve essere abilitata anche l’opzione email a livello di Board. Puoi trovare questa opzione in Generale &gt; Gestione Comunicazioni &gt; Impostazioni email.',

	'CONTACT_US_INFO'				=> 'Informazioni sui contatti',
	'CONTACT_US_INFO_EXPLAIN'		=> 'Il messaggio viene visualizzato sulla pagina dei contatti',
	'CONTACT_US_INFO_PREVIEW'		=> 'Informazioni pagina dei contatti - Anteprima',
	'CONTACT_US_INFO_UPDATED'		=> 'Informazioni pagina dei contatti aggiornate.',
));

// Load Settings
$lang = array_merge($lang, array(
	'ACP_LOAD_SETTINGS_EXPLAIN'	=> 'Qui puoi abilitare o disabilitare alcune funzioni della Board per ridurre l’ammontare dei processi richiesti. Sulla maggior parte dei server non c’è bisogno di disabilitare alcuna funzione. Tuttavia in alcuni sistemi o ambienti condivisi può essere consigliato disabilitare ciò di cui non hai bisogno. Puoi anche stabilire dei limiti al caricamento del sistema ed alle sessioni attive oltre i quali la Board andrà OffLine.',

	'ALLOW_CDN'						=> 'Consenti l’utilizzo delle reti di distribuzione per contenuti di terze parti',
	'ALLOW_CDN_EXPLAIN'				=> 'Se questa impostazione è attivata, alcuni file saranno forniti da server di terze parti esterni anziché dal tuo server. Questo riduce la larghezza di banda utilizzata dal tuo server, ma potrebbe creare un problema di privacy in alcuni paesi. In un’installazione phpBB predefinita, questo include caricamenti “jQuery” e il font “Open Sans” per i contenuti della rete distribuzione di Google.',
	'ALLOW_LIVE_SEARCHES'			=> 'Consenti ricerche in tempo reale',
	'ALLOW_LIVE_SEARCHES_EXPLAIN'	=> 'Se questa impostazione è attivata, gli utenti usufruiranno di suggerimenti di parole chiave, digitando nei campi relativi in tutta la Board.',
	'CUSTOM_PROFILE_FIELDS'			=> 'Campi profilo personalizzati',
	'LIMIT_LOAD'					=> 'Limita caricamento del sistema',
	'LIMIT_LOAD_EXPLAIN'			=> 'Se il limite per caricamento del sistema eccede il valore impostato, entro un minuto la Board andrà automaticamente OffLine. Il valore di 1.0 equivale al 100% di utilizzo di un processore. Questo funziona solo sui server che si basano su UNIX e dove questa informazione è accessibile. Il valore si reimposta sullo 0 se phpBB non è in grado di raggiungere il limite di caricamento. Questo vale anche per il font "Font Awesome", che phpBB e alcune estensioni usano per le icone',
	'LIMIT_SESSIONS'				=> 'Limita sessioni',
	'LIMIT_SESSIONS_EXPLAIN'		=> 'Se il numero delle sessioni eccede questo valore, entro un minuto la Board andrà OffLine. 0 = illimitate.',
	'LOAD_CPF_MEMBERLIST'			=> 'Permetti ai temi di visualizzare i campi personalizzati nel profilo nella lista utenti',
	'LOAD_CPF_PM'					=> 'Visualizza i campi profilo personalizzati nei messaggi privati',
	'LOAD_CPF_VIEWPROFILE'			=> 'Visualizza i campi personalizzati nel profilo degli utenti',
	'LOAD_CPF_VIEWTOPIC'			=> 'Visualizza i campi personalizzati nelle pagine degli argomenti',
	'LOAD_USER_ACTIVITY'			=> 'Visualizza attività degli utenti',
	'LOAD_USER_ACTIVITY_EXPLAIN'	=> 'Visualizza argomenti o forum attivi nel pannello di controllo del profilo utenti. Si raccomanda di disabilitare questa funzione su forum con più di un milione di messaggi.',
	'LOAD_USER_ACTIVITY_LIMIT'		=> 'Limite messaggi attivi dell’utente',
	'LOAD_USER_ACTIVITY_LIMIT_EXPLAIN'	=> 'L’argomento/forum attivo non verrà mostrato per gli utenti che hanno un numero superiore a questo numero di messaggi. Imposta questo valore su 0 (zero) per disabilitare il limite.',
	'READ_NOTIFICATION_EXPIRE_DAYS'	=> 'Scadenza notifica di lettura',
	'READ_NOTIFICATION_EXPIRE_DAYS_EXPLAIN' => 'Numero di giorni che decorreranno prima che una notifica venga cancellata automaticamente. Imposta questo valore su 0 (zero) per avere le notifiche permanentemente.',
	'RECOMPILE_STYLES'				=> 'Ricompila i componenti obsoleti degli stili',
	'RECOMPILE_STYLES_EXPLAIN'		=> 'Verifica la presenza di componenti di stile aggiornati sul filesystem e ricompilali.',
	'YES_ACCURATE_PM_BUTTON'			=> 'Abilita il permesso specifico del pulsante MP nelle pagine degli argomenti',
	'YES_ACCURATE_PM_BUTTON_EXPLAIN'	=> 'Se questa impostazione è abilitata, solo gli utenti a cui è consentito leggere i messaggi privati avranno un pulsante MP.',
	'YES_ANON_READ_MARKING'			=> 'Abilita marcatura argomenti per gli ospiti',
	'YES_ANON_READ_MARKING_EXPLAIN'	=> 'Conserva le informazioni riguardanti i messaggi letti e da leggere per gli ospiti. Se disabilitata, i messaggi risulteranno sempre come letti per gli ospiti.',
	'YES_BIRTHDAYS'					=> 'Abilita il Pannello Compleanni',
	'YES_BIRTHDAYS_EXPLAIN'			=> 'Se disabilitato, il Pannello Compleanni non sarà più visualizzato. Perché questa impostazione abbia effetto anche l’altra opzione compleanni deve essere attivata.',
	'YES_JUMPBOX'					=> 'Abilita visualizzazione jumpbox',
	'YES_MODERATORS'				=> 'Abilita visualizzazione dei moderatori',
	'YES_ONLINE'					=> 'Abilita lista utenti online',
	'YES_ONLINE_EXPLAIN'			=> 'Visualizza informazioni sugli utenti online nell’Indice, nei forum e nelle pagine degli argomenti.',
	'YES_ONLINE_GUESTS'				=> 'Abilita lista ospiti online in “Chi c’è in linea”',
	'YES_ONLINE_GUESTS_EXPLAIN'		=> 'Permette di visualizzare informazioni riguardanti gli ospiti online in “Chi c’è in linea”.',
	'YES_ONLINE_TRACK'				=> 'Abilita visualizzazione degli utenti online/offline',
	'YES_ONLINE_TRACK_EXPLAIN'		=> 'Visualizza informazioni online per gli utenti, nei profili e nelle pagine degli argomenti.',
	'YES_POST_MARKING'				=> 'Abilita argomenti contrassegnati',
	'YES_POST_MARKING_EXPLAIN'		=> 'Indica se un utente ha scritto un messaggio in un argomento.',
	'YES_READ_MARKING'				=> 'Abilita segnalazione argomenti lato server',
	'YES_READ_MARKING_EXPLAIN'		=> 'Conserva le informazioni sullo stato dei messaggi letti e da leggere nel database anziché nei cookie.',
	'YES_UNREAD_SEARCH'				=> 'Abilita la ricerca dei messaggi non letti',
));

// Auth settings
$lang = array_merge($lang, array(
	'ACP_AUTH_SETTINGS_EXPLAIN'	=> 'phpBB supporta plugin di autenticazione o moduli. Questo ti permette di stabilire come gli utenti vengono autenticati quando accedono alla Board. Ci sono tre plugin predefiniti: DB, LDAP e Apache. Non tutti i metodi richiedono informazioni addizionali per cui basta riempire i campi, se sono rilevanti per il metodo selezionato.',

	'AUTH_METHOD'				=> 'Seleziona un metodo di autenticazione',

	'AUTH_PROVIDER_OAUTH_ERROR_ELEMENT_MISSING'	=> 'Deve essere fornita la chiave segreta di ogni servizio OAuth abilitato. Ne è stata disposta solo una dal provider di servizi OAuth.',
	'AUTH_PROVIDER_OAUTH_EXPLAIN'				=> 'Ogni provider OAuth richiede una chiave segreta univoca allo scopo di autenticarsi con il server esterno. Questa deve essere fornita dal servizio OAuth quando registri il tuo sito web e ti deve essere fornita esattamente dal provider.<br />Qualsiasi servizio che non abbia la chiave segreta immessa qui non sarà fruibile dagli utenti del Forum. L’utente può comunque registrarsi ed effettuare il login utilizzando il plugin di autenticazione DB.',

	'AUTH_PROVIDER_OAUTH_KEY'					=> 'Chiave',
	'AUTH_PROVIDER_OAUTH_TITLE'					=> 'OAuth',
	'AUTH_PROVIDER_OAUTH_SECRET'				=> 'Segreta',

	'APACHE_SETUP_BEFORE_USE'	=> 'Devi impostare l’autenticazione Apache prima di configurare su phpBB questo metodo di autenticazione. Ricorda che il nome utente che usi per l’autenticazione Apache deve essere uguale al tuo nome utente per phpBB. L’autenticazione Apache può essere usata solo con mod_php (non con una versione CGI).',

	'LDAP'							=> 'LDAP',
	'LDAP_DN'						=> 'LDAP base <var>dn</var>',
	'LDAP_DN_EXPLAIN'				=> 'Questo è il Nome distinto che localizza le informazioni utente, es. <samp>o=My Company,c=US</samp>.',
	'LDAP_EMAIL'					=> 'Attributo email LDAP',
	'LDAP_EMAIL_EXPLAIN'			=> 'Imposta con il nome del tuo accesso email (se ne esiste uno) in modo da configurare automaticamente gli indirizzi email dei nuovi utenti. Lasciando vuoto, risulterà un campo indirizzo email vuoto per gli utenti che effettuano il log-in per la prima volta.',
	'LDAP_INCORRECT_USER_PASSWORD'	=> 'Connessione al server LDAP fallita con nome utente/password specificati.',
	'LDAP_NO_EMAIL'					=> 'L’attributo email specificato non esiste.',
	'LDAP_NO_IDENTITY'				=> 'Impossibile trovare identità di connessione per %s.',
	'LDAP_PASSWORD'					=> 'Password LDAP',
	'LDAP_PASSWORD_EXPLAIN'			=> 'Lascia il campo vuoto per usare un accesso anonimo. Oppure inserisci la password per l’utente sopra specificato. Obbligatorio per server Active Directory. <br /><em><strong>Attenzione:</strong> questa password verrà memorizzata come testo in chiaro nel database e sarà visibile a chi può accedere al tuo database o a questa pagina di configurazione.</em>',
	'LDAP_PORT'						=> 'Porta del server LDAP',
	'LDAP_PORT_EXPLAIN'				=> 'Qui puoi inserire il numero di una porta da usare per la connessione al server LDAP in alternativa alla porta predefinita (389).',
	'LDAP_SERVER'					=> 'Nome del server LDAP',
	'LDAP_SERVER_EXPLAIN'			=> 'Se si usa LDAP questo è il nome o indirizzo IP del server. Puoi anche specificare un URL tipo ldap://hostname:port/',
	'LDAP_UID'						=> '<var>uid</var> LDAP',
	'LDAP_UID_EXPLAIN'				=> 'Questa è la chiave sotto cui cercare una certa identità per la connessione, es. <var>uid</var>, <var>sn</var>, ecc.',
	'LDAP_USER'						=> 'Utente LDAP <var>dn</var>',
	'LDAP_USER_EXPLAIN'				=> 'Lascia vuoto per usare un accesso anonimo. Se invece viene inserito un dato, phpBB cercherà di connettersi al server LDAP con i dati dell’utente specificato o i tentativi di login effettuati, ad esempio <samp>uid=Username,ou=MyUnit,o=MyCompany,c=US</samp>. Obbligatorio per server Active Directory.',
	'LDAP_USER_FILTER'				=> 'Filtro utente LDAP',
	'LDAP_USER_FILTER_EXPLAIN'		=> 'Hai l’opzione di limitare ulteriormente gli oggetti ricercati con filtri addizionali. Ad esempio <samp>objectClass=posixGroup</samp> porterà all’utilizzo di <samp>(&amp;(uid=$username)(objectClass=posixGroup))</samp>',
));

// Server Settings
$lang = array_merge($lang, array(
	'ACP_SERVER_SETTINGS_EXPLAIN'	=> 'Qui definisci le impostazioni dipendenti dal server e dal dominio. Assicurati che i dati inseriti siano esatti; eventuali errori risulteranno nelle email che conterranno informazioni inesatte. Quando inserisci il nome del dominio, ricorda di includere http:// o altro protocollo. Cambia il numero della porta solo se sei sicuro che il server usa un valore differente; la porta 80 è corretta nella maggioranza dei casi.',

	'ENABLE_GZIP'				=> 'Abilita compressione GZip',
	'ENABLE_GZIP_EXPLAIN'		=> 'Il contenuto generato sarà compresso prima di essere inviato all’utente. Questo può ridurre il traffico di rete ma aumenterà anche l’utilizzo di CPU, sia sul server che lato client. Richiede che sia caricata l’estensione PHP gzip.',
	'FORCE_SERVER_VARS'			=> 'Forza impostazioni URL del server',
	'FORCE_SERVER_VARS_EXPLAIN'	=> 'Se impostato su SI le impostazioni del server qui definite saranno usate per i valori automaticamente determinati.',
	'ICONS_PATH'				=> 'Percorso salvataggio icone dei messaggi',
	'ICONS_PATH_EXPLAIN'		=> 'Il percorso dalla radice del phpBB, es. <samp>images/icons</samp>.',
	'MOD_REWRITE_ENABLE'		=> 'Abilita la riscrittura URL',
	'MOD_REWRITE_ENABLE_EXPLAIN'=> 'Quando abilitato, gli URL contenenti ’app.php’ saranno riscritti per rimuovere il nome file (ad esempio app.php/foo diventerà /foo). <strong>È richiesta la mod_rewrite dei server Apache per rendere operativa questa funzione; se questa opzione viene abilitata senza la presenza della mod_rewrite, gli URL della tua Board possono essere compromessi.</strong>',
	'MOD_REWRITE_DISABLED'		=> 'Il modulo <strong>mod_rewrite</strong> sul tuo web server Apache è disabilitato. Abilita il modulo o contatta il tuo Host se desideri usare questa funzione.',
	'MOD_REWRITE_INFORMATION_UNAVAILABLE' => 'Non è possibile determinare se il tuo server supporta la riscrittura degli URL. Questa impostazione può essere abilitata, ma se la riscrittura URL non è disponibile, i percorsi generati da questa Board (come per l’uso dei link) possono essere corrotti. Contatta il tuo Host se non sei sicuro di poter abilitare questa opzione.',
	'PATH_SETTINGS'				=> 'Impostazioni percorso',
	'RANKS_PATH'				=> 'Percorso salvataggio livelli',
	'RANKS_PATH_EXPLAIN'		=> 'Il percorso dalla radice del phpBB, es. <samp>images/ranks</samp>',
	'SCRIPT_PATH'				=> 'Percorso script',
	'SCRIPT_PATH_EXPLAIN'		=> 'Percorso in cui è situato phpBB, relativo al nome del dominio, es. <samp>/phpBB3</samp>.',
	'SERVER_NAME'				=> 'Nome del dominio',
	'SERVER_NAME_EXPLAIN'		=> 'Nome del dominio relativo alla Board (per esempio: <samp>esempio.com</samp>).',
	'SERVER_PORT'				=> 'Porta del server',
	'SERVER_PORT_EXPLAIN'		=> 'La porta del tuo server, di solito 80. Cambiala solo se è diversa.',
	'SERVER_PROTOCOL'			=> 'Protocollo del server',
	'SERVER_PROTOCOL_EXPLAIN'	=> 'Questo verrà usato come protocollo del server se queste impostazioni saranno forzate. Se vuoto o non forzato il protocollo sarà determinato dalle impostazioni cookie sicuri (<samp>http://</samp> o <samp>https://</samp>)',
	'SERVER_URL_SETTINGS'		=> 'Impostazioni server URL',
	'SMILIES_PATH'				=> 'Percorso salvataggio emoticon',
	'SMILIES_PATH_EXPLAIN'		=> 'Il percorso dalla radice del phpBB, es. <samp>images/smilies</samp>',
	'UPLOAD_ICONS_PATH'			=> 'Percorso salvataggio icone gruppo',
	'UPLOAD_ICONS_PATH_EXPLAIN'	=> 'Il percorso dalla radice del phpBB, es. <samp>images/upload_icons</samp>',
	'USE_SYSTEM_CRON'			=> 'Esegui attività periodiche dal cron del sistema operativo',
	'USE_SYSTEM_CRON_EXPLAIN'   => 'Se disabilitato, phpBB organizzerà l’esecuzione automatica di task periodici. Quando attivato, phpBB non attuerà nessuna esecuzione periodica; un amministratore di sistema dovrà eseguire <code>bin/phpbbcli.php cron:run</code> dal cron del sistema operativo ad intervalli regolari (ad esempio ogni 5 minuti).',
));

// Security Settings
$lang = array_merge($lang, array(
	'ACP_SECURITY_SETTINGS_EXPLAIN'		=> 'Qui puoi definire le impostazioni della sessione e della connessione.',

	'ALL'							=> 'Tutto',
	'ALLOW_AUTOLOGIN'				=> 'Abilita il login “Ricordami”',
	'ALLOW_AUTOLOGIN_EXPLAIN'		=> 'Determina se gli utenti usano l’opzione “Ricordami” quando visitano la Board.',
	'ALLOW_PASSWORD_RESET'			=> 'Permetti il ripristino della password (“Ho dimenticato la password”)',
	'ALLOW_PASSWORD_RESET_EXPLAIN'	=> 'Determina se gli utenti sono abilitati ad usare la funzione “Ho dimenticato la mia password” linkata sulla pagina del login per ripristinare il proprio account. Se usi un sistema di autenticazione esterno, puoi disattivare questa funzione.',
	'AUTOLOGIN_LENGTH'				=> '“Ricordami”: durata scadenza della chiave del login (in giorni)',
	'AUTOLOGIN_LENGTH_EXPLAIN'		=> 'Numero di giorni dopo cui la funzione “Ricordami” viene rimossa. Zero per disabilitare.',
	'BROWSER_VALID'					=> 'Convalida browser',
	'BROWSER_VALID_EXPLAIN'			=> 'Permette la convalida del browser per ogni sessione aumentandone la sicurezza.',
	'CHECK_DNSBL'					=> 'Controllo IP tramite DNS Blackhole List',
	'CHECK_DNSBL_EXPLAIN'			=> 'Se abilitato l’indirizzo IP di un utente viene controllato tramite il seguente servizio DNSBL nelle registrazioni e nei messaggi: <a href="http://spamcop.net">spamcop.net</a> e <a href="http://www.spamhaus.org">www.spamhaus.org</a>. Questo controllo impiega tempo, a seconda della configurazione del server. Se vengono rilevati rallentamenti o falsi positivi si raccomanda di disabilitare questo controllo.',
	'CLASS_B'						=> 'A.B',
	'CLASS_C'						=> 'A.B.C',
	'EMAIL_CHECK_MX'				=> 'Controlla dominio email per convalida MX record',
	'EMAIL_CHECK_MX_EXPLAIN'		=> 'Se abilitato, il dominio email fornito al momento della registrazione o al cambio profilo verrà controllato per la convalida MX record.',
	'FORCE_PASS_CHANGE'				=> 'Forza cambio password',
	'FORCE_PASS_CHANGE_EXPLAIN'		=> 'Richiede all’utente di cambiare la propria password dopo un determinato numero di giorni. Impostando 0 si disabilita l’opzione.',
	'FORM_TIME_MAX'					=> 'Tempo massimo per inviare il form',
	'FORM_TIME_MAX_EXPLAIN'			=> 'Tempo massimo per inviare il form. Usa -1 per disattivare. NB: il form potrebbe diventare nullo se la sessione scade, indipendentemente da questa impostazione.',
	'FORM_SID_GUESTS'				=> 'Associa i moduli alle sessioni degli ospiti',
	'FORM_SID_GUESTS_EXPLAIN'		=> 'Se abilitato, il token del modulo emesso per gli ospiti avrà valore sulla singola sessione (session-exclusive). Questo potrebbe causare alcuni problemi con alcuni ISP.',
	'FORWARDED_FOR_VALID'			=> 'Convalida l’intestazione <var>X_FORWARDED_FOR</var>',
	'FORWARDED_FOR_VALID_EXPLAIN'	=> 'Le sessioni continueranno soltanto se l’intestazione trasmessa <var>X_FORWARDED_FOR</var> sarà uguale a quella inviata con la precedente richiesta. Anche i ban saranno controllati tramite IP su <var>X_FORWARDED_FOR</var>.',
	'IP_VALID'						=> 'Convalida sessione IP',
	'IP_VALID_EXPLAIN'				=> 'Determina quanto dell’IP utente viene usato per convalidare una sessione; <samp>Tutto</samp>: confronta l’indirizzo completo; <samp>A.B.C</samp> il primo x.x.x; <samp>A.B</samp> il primo x.x, <samp>Nessuno</samp>: disabilita controllo. Sugli indirizzi IPv6 <samp>A.B.C</samp> confronta i primi 4 blocchi e <samp>A.B</samp> i primi 3 blocchi.',
	'IP_LOGIN_LIMIT_MAX'			=> 'Numero massimo di tentativi di login consentiti per indirizzo IP',
	'IP_LOGIN_LIMIT_MAX_EXPLAIN'	=> 'Dopo questo numero di tentativi di connessione falliti l’utente dovrà ulteriormente confermare il proprio accesso con l’aggiunta di una contromisura spambot. Inserendo 0, si disabilita questa funzione.',
	'IP_LOGIN_LIMIT_TIME'			=> 'Limite di tempo per i tentativi di login per indirizzo IP',
	'IP_LOGIN_LIMIT_TIME_EXPLAIN'	=> 'Limite di tempo per i tentativi di login che scadono dopo questo periodo.',
	'IP_LOGIN_LIMIT_USE_FORWARDED'	=> 'Limite di tentativi di login tramite l’intestazione <var>X_FORWARDED_FOR</var>',
	'IP_LOGIN_LIMIT_USE_FORWARDED_EXPLAIN'	=> 'Invece di limitare i tentativi di login tramite indirizzo IP, questi possono essere limitati dai valori di <var>X_FORWARDED_FOR</var>.<br /><em><strong>Attenzione:</strong> abilita questa funzione solo se utilizzi un server proxy che imposta <var>X_FORWARDED_FOR</var> su valori affidabili.</em>',
	'MAX_LOGIN_ATTEMPTS'			=> 'Numero massimo di tentativi di login',
	'MAX_LOGIN_ATTEMPTS_EXPLAIN'	=> 'Il numero di tentativi di login consentiti per un singolo account prima che le contromisure spambot siano attivate. Inserisci 0 per evitare che le contromisure spambot siano attivate per gli account utente.',
	'NO_IP_VALIDATION'				=> 'Nessuno',
	'NO_REF_VALIDATION'				=> 'Nessuno',
	'PASSWORD_TYPE'					=> 'Complessità password',
	'PASSWORD_TYPE_EXPLAIN'			=> 'Determina quanto complessa deve essere una password quando la si imposta o la si modifica. Le opzioni successive includono quelle precedenti.',
	'PASS_TYPE_ALPHA'				=> 'Deve contenere lettere e numeri',
	'PASS_TYPE_ANY'					=> 'Nessun requisito',
	'PASS_TYPE_CASE'				=> 'Deve essere mista',
	'PASS_TYPE_SYMBOL'				=> 'Deve contenere simboli',
	'REF_HOST'						=> 'Valida solo host',
	'REF_PATH'						=> 'Valida anche percorso',
	'REFERRER_VALID'				=> 'Valida referrer',
	'REFERRER_VALID_EXPLAIN'		=> 'Se abilitato, il referrer delle richieste POST sarà controllato sui parametri di host e percorso script. Questo potrebbe causare problemi con Board che usano più domini o login esterni.',
	'TPL_ALLOW_PHP'					=> 'Permetti php negli stili',
	'TPL_ALLOW_PHP_EXPLAIN'			=> 'Se impostato su Sì, le dichiarazioni <code>PHP</code> e <code>INCLUDEPHP</code>, saranno riconosciute ed analizzate negli stili.',
	'UPLOAD_CERT_VALID'				=> 'Convalida certificato di upload',
	'UPLOAD_CERT_VALID_EXPLAIN'		=> 'Se abilitato, i certificati di upload remoti verranno convalidati. Questo richiede che il CA bundle sia definito tramite l’impostazione <samp>openssl.cafile</samp> o <samp>curl.cainfo</samp> del tuo php.ini.',
));

// Email Settings
$lang = array_merge($lang, array(
	'ACP_EMAIL_SETTINGS_EXPLAIN'	=> 'Questo modulo viene usato quando si inviano email ai propri utenti dalla Board. Assicurati che l’indirizzo email specificato sia valido; ogni messaggio respinto o non consegnato, verrà inviato a questo indirizzo. Se il tuo server non fornisce un servizio email (basato su PHP) puoi in alternativa inviare messaggi direttamente via SMTP. Questo richiede l’indirizzo di un server appropriato (chiedi al tuo provider, se necessario). Non specificare nomi vecchi qui. Se il server richiede autenticazione (e solo se lo fa) inserisci nome utente e password.',

	'ADMIN_EMAIL'					=> 'Indirizzo di ritorno email',
	'ADMIN_EMAIL_EXPLAIN'			=> 'Questo indirizzo email verrà usato come indirizzo di ritorno per tutte le email, ovvero come indirizzo di contatto tecnico. Verrà sempre usato come indirizzo email <samp>Percorso-Ritorno</samp> e <samp>Mittente</samp> nelle email.',
	'BOARD_EMAIL_FORM'				=> 'Messaggistica email attraverso Board',
	'BOARD_EMAIL_FORM_EXPLAIN'		=> 'Anziché visualizzare gli indirizzi email gli utenti possono utilizzare la Board per inviarsi email.',
	'BOARD_HIDE_EMAILS'				=> 'Nascondi indirizzi email',
	'BOARD_HIDE_EMAILS_EXPLAIN'		=> 'Questa funzione permette di mantenere privati gli indirizzi email.',
	'CONTACT_EMAIL'					=> 'Indirizzo email di contatto',
	'CONTACT_EMAIL_EXPLAIN'			=> 'Questo indirizzo verrà usato ogni volta che è richiesto un contatto specifico, es. spam, error output, ecc. Verrà sempre usato come indirizzo email <samp>Da</samp> e <samp>Rispondi-a</samp> nelle email.',
	'CONTACT_EMAIL_NAME'			=> 'Nome del contatto',
	'CONTACT_EMAIL_NAME_EXPLAIN'	=> 'Questo è il nome del contatto che i destinatari di posta elettronica vedranno. Se non si vuole avere un nome del contatto, lasciare questo campo vuoto.',
	'EMAIL_FORCE_SENDER'            => 'Forza dall’indirizzo email',
	'EMAIL_FORCE_SENDER_EXPLAIN'	=> 'Questo imposterà il ritorno all’indirizzo email invece di utilizzare l’utente locale e il nome host del server. Questa impostazione non si applica quando si utilizza SMTP.<br /><em><strong>Attenzione:</strong> richiede che l’utente venga aggiunto come utente fidato alla configurazione di sendmail nel webserver.</em>',
	'EMAIL_PACKAGE_SIZE'			=> 'Dimensione pacchetto email',
	'EMAIL_PACKAGE_SIZE_EXPLAIN'	=> 'Questo è il numero delle email spedite in un pacchetto.',
	'EMAIL_MAX_CHUNK_SIZE'			=> 'Numero massimo di destinatari email consentiti',
	'EMAIL_MAX_CHUNK_SIZE_EXPLAIN'	=> 'Se necessario, impostarlo in modo da non superare il numero massimo di destinatari consentito dal server di posta per singolo messaggio.',
	'EMAIL_SIG'						=> 'Firma nelle email',
	'EMAIL_SIG_EXPLAIN'				=> 'Questo testo verrà allegato ad ogni email spedita dalla Board.',
	'ENABLE_EMAIL'					=> 'Abilita l’invio email della Board',
	'ENABLE_EMAIL_EXPLAIN'			=> 'Se questa funzione è disabilitata nessuna email verrà spedita tramite la Board. <em>Ricorda che l’impostazione di attivazione account da utente o amministratore richiede che questa impostazione sia abilitata. Se attualmente stai usando l’opzione “Utente” o “Amministratore” per l’attivazione degli account, la disattivazione di questa impostazione consentirà di disattivare la registrazione.</em>',
	'SEND_TEST_EMAIL'				=> 'Invia email di prova',
	'SEND_TEST_EMAIL_EXPLAIN'		=> 'Questo invierà un’email di prova all’indirizzo specificato sul tuo account.',
	'SMTP_ALLOW_SELF_SIGNED'		=> 'Abilita certificati SSL auto-firmati',
	'SMTP_ALLOW_SELF_SIGNED_EXPLAIN'=> 'Abilita le connessioni al server SMTP con certificato SSL autofirmato. <em><strong>Attenzione:</strong> permettere i certificati SSL auto-firmati potrebbe causare problemi di sicurezza.</em>',
	'SMTP_AUTH_METHOD'				=> 'Metodo autenticazione per SMTP',
	'SMTP_AUTH_METHOD_EXPLAIN'		=> 'Si usa solo se un nome utente o una password sono impostati. Chiedi al tuo provider se non sei sicuro del metodo da usare.',
	'SMTP_CRAM_MD5'					=> 'CRAM-MD5',
	'SMTP_DIGEST_MD5'				=> 'DIGEST-MD5',
	'SMTP_LOGIN'					=> 'LOGIN',
	'SMTP_PASSWORD'					=> 'Password SMTP',
	'SMTP_PASSWORD_EXPLAIN'			=> 'Inserisci una password solo se il tuo server SMTP la richiede. <br /><em><strong>Attenzione:</strong> questa password è conservata come testo in chiaro nel database.</em>',
	'SMTP_PLAIN'					=> 'PLAIN',
	'SMTP_POP_BEFORE_SMTP'			=> 'POP-BEFORE-SMTP',
	'SMTP_PORT'						=> 'Porta del server SMTP',
	'SMTP_PORT_EXPLAIN'				=> 'Modifica questo parametro solo se sai che il tuo server SMTP si trova su una porta diversa.',
	'SMTP_SERVER'					=> 'Indirizzo server SMTP',
	'SMTP_SERVER_EXPLAIN'			=> 'Non fornire un protocollo (<samp>ssl://</samp> o <samp>tls://</samp>) a meno che il tuo host di posta non ti dica di farlo.',
	'SMTP_SETTINGS'					=> 'Impostazioni SMTP',
	'SMTP_USERNAME'					=> 'Nome utente SMTP',
	'SMTP_USERNAME_EXPLAIN'			=> 'Inserisci un nome utente solo se il tuo server SMTP lo richiede.',
	'SMTP_VERIFY_PEER'				=> 'Verifica il certificato SSL',
	'SMTP_VERIFY_PEER_EXPLAIN'		=> 'Richiedi la verifica del certificato SSL utilizzato dal server SMTP. <em><strong>Attenzione:</strong> il collegamento peer con certificati SSL non verificati può causare problemi di sicurezza.</em>',
	'SMTP_VERIFY_PEER_NAME'			=> 'Verifica il nome peer SMTP',
	'SMTP_VERIFY_PEER_NAME_EXPLAIN'	=> 'Richiedi la verifica del nome peer per i server SMTP utilizzando connessioni SSL / TLS. <em><strong>Attenzione:</strong> la connessione a peer non verificati può causare problemi di sicurezza.</em>',
	'TEST_EMAIL_SENT'				=> 'L’email di prova è stata inviata.<br />Se non la dovessi ricevere, controlla le tue configurazioni di posta elettronica e la cartella antispam del tuo account di posta<br /><br />Se hai bisogno di supporto, visita il <a href="https://www.phpbb-italia.it">Forum di supporto di phpBB Italia</a>.',

	'USE_SMTP'						=> 'Usa un server SMTP per le email',
	'USE_SMTP_EXPLAIN'				=> 'Scegli “Sì” se vuoi o devi inviare email attraverso un server specifico invece di usare la funzione mail locale.',
));

// Jabber settings
$lang = array_merge($lang, array(
	'ACP_JABBER_SETTINGS_EXPLAIN'	=> 'Qui puoi abilitare e controllare l’uso del Jabber per i messaggi privati e per gli avvisi. Jabber è un protocollo opensource ed è quindi disponibile per tutti. Alcuni server Jabber includono gateways o transports che permettono di mettersi in contatto con gli utenti su altre reti. Non tutti i server offrono tutti i transports ed i cambiamenti nei protocolli possono impedire ai transports di funzionare. Possono occorrere parecchi secondi per aggiornare i dettagli dell’utenza Jabber, non arrestare prima che lo script sia completato!',

	'JAB_ALLOW_SELF_SIGNED'			=> 'Abilita certificati SSL auto-firmati',
	'JAB_ALLOW_SELF_SIGNED_EXPLAIN'	=> 'Abilita le connessioni al server Jabber con il certificato SSL autofirmato. <em><strong>Attenzione:</strong> permettere certificati SSL auto-firmati potrebbe causare problemi di sicurezza.</em>',
	'JAB_ENABLE'				=> 'Abilita Jabber',
	'JAB_ENABLE_EXPLAIN'		=> 'Abilita l’uso della messaggistica e delle notifiche Jabber.',
	'JAB_GTALK_NOTE'			=> 'Fai attenzione che GTalk non funzionerà, dato che manca la funzione <samp>dns_get_record</samp>. Questa funzione non è disponibile in PHP4 e non è implementata sulle piattaforme Windows. Attualmente non funziona su sistemi basati su BSD, compreso Mac OS.',
	'JAB_PACKAGE_SIZE'			=> 'Dimensione pacchetto Jabber',
	'JAB_PACKAGE_SIZE_EXPLAIN'	=> 'Questo è il numero dei messaggi spediti in un pacchetto. Se impostato su 0 il messaggio verrà inviato immediatamente e non verrà accodato per invio posticipato.',
	'JAB_PASSWORD'				=> 'Password Jabber',
	'JAB_PASSWORD_EXPLAIN'		=> '<em><strong>Attenzione:</strong> questa password è conservata come testo in chiaro nel database; può essere vista da chi può accedere al database o da chi può vedere questa pagina di configurazione.</em>',
	'JAB_PORT'					=> 'Porta del Jabber',
	'JAB_PORT_EXPLAIN'			=> 'Lascia in bianco a meno che tu non sappia che la porta non è la 5222.',
	'JAB_SERVER'				=> 'Server Jabber',
	'JAB_SERVER_EXPLAIN'		=> 'Visita %sjabber.org%s per la lista dei server.',
	'JAB_SETTINGS_CHANGED'		=> 'Impostazioni Jabber modificate.',
	'JAB_USE_SSL'				=> 'Usa SSL per connettere',
	'JAB_USE_SSL_EXPLAIN'		=> 'Se attivato cercherà di stabilire una connessione sicura. La porta Jabber sarà modificata a 5223 se la 5222 viene specificata.',
	'JAB_USERNAME'				=> 'Nome utente Jabber o JID',
	'JAB_USERNAME_EXPLAIN'		=> 'Inserisci un nome utente registrato o un JID valido. Il nome utente non sarà controllato per vedere se è valido. Se inserisci un nome utente allora il JID sarà il nome utente e il server che hai inserito prima. In alternativa inserisci un JID valido, ad esempio user@jabber.org.',
	'JAB_VERIFY_PEER'				=> 'Verifica certificato SSL',
	'JAB_VERIFY_PEER_EXPLAIN'		=> 'Richiedi la verifica del certificato SSL utilizzato dal server Jabber. <em><strong>Attenzione:</strong> il collegamento peer con certificati SSL non verificati può causare problemi di sicurezza.</em>',
	'JAB_VERIFY_PEER_NAME'			=> 'Verifica il nome peer Jabber',
	'JAB_VERIFY_PEER_NAME_EXPLAIN'	=> 'Richiedi la verifica del nome di peer per i server Jabber, utilizzando connessioni SSL / TLS. <em><strong>Attenzione:</strong> la connessione a peer non verificati può causare problemi di sicurezza.</em>',
));
