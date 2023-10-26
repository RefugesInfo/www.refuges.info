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

// Common
$lang = array_merge($lang, array(
	'ACP_ADMINISTRATORS'		=> 'Amministratori',
	'ACP_ADMIN_LOGS'			=> 'Log amministratori',
	'ACP_ADMIN_ROLES'			=> 'Ruoli amministratore',
	'ACP_ATTACHMENTS'			=> 'Allegati',
	'ACP_ATTACHMENT_SETTINGS'	=> 'Allegati',
	'ACP_AUTH_SETTINGS'			=> 'Autenticazione',
	'ACP_AUTOMATION'			=> 'Aggiornamenti',
	'ACP_AVATAR_SETTINGS'		=> 'Avatar',

	'ACP_BACKUP'				=> 'Backup',
	'ACP_BAN'					=> 'Azioni di ban',
	'ACP_BAN_EMAILS'			=> 'Ban email',
	'ACP_BAN_IPS'				=> 'Ban IP',
	'ACP_BAN_USERNAMES'			=> 'Ban utenti',
	'ACP_BBCODES'				=> 'BBCode',
	'ACP_BOARD_CONFIGURATION'	=> 'Configurazione',
	'ACP_BOARD_FEATURES'		=> 'Caratteristiche',
	'ACP_BOARD_MANAGEMENT'		=> 'Gestione Board',
	'ACP_BOARD_SETTINGS'		=> 'Impostazioni',
	'ACP_BOTS'					=> 'Spider/Robot',

	'ACP_CAPTCHA'				=> 'CAPTCHA',

	'ACP_CAT_CUSTOMISE'			=> 'Personalizzazioni',
	'ACP_CAT_DATABASE'			=> 'Database',
	'ACP_CAT_DOT_MODS'			=> 'Estensioni',
	'ACP_CAT_FORUMS'			=> 'Gestione Forum',
	'ACP_CAT_GENERAL'			=> 'Generale',
	'ACP_CAT_MAINTENANCE'		=> 'Manutenzione',
	'ACP_CAT_PERMISSIONS'		=> 'Permessi',
	'ACP_CAT_POSTING'			=> 'Contenuti',
	'ACP_CAT_STYLES'			=> 'Stili',
	'ACP_CAT_SYSTEM'			=> 'Sistema',
	'ACP_CAT_USERGROUP'			=> 'Utenti e Gruppi',
	'ACP_CAT_USERS'				=> 'Utenti',
	'ACP_CLIENT_COMMUNICATION'	=> 'Gestione comunicazioni',
	'ACP_COOKIE_SETTINGS'		=> 'Cookie',
	'ACP_CONTACT'				=> 'Pagina Contatti',
	'ACP_CONTACT_SETTINGS'		=> 'Impostazioni pagina Contatti',
	'ACP_CRITICAL_LOGS'			=> 'Log errori',
	'ACP_CUSTOM_PROFILE_FIELDS'	=> 'Campi personalizzati profilo',

	'ACP_DATABASE'				=> 'Gestione database',
	'ACP_DISALLOW'				=> 'Disabilita',
	'ACP_DISALLOW_USERNAMES'	=> 'Disabilita nomi utente',

	'ACP_EMAIL_SETTINGS'		=> 'Impostazioni email',
	'ACP_EXTENSION_GROUPS'		=> 'Gestione gruppi di estensioni',
	'ACP_EXTENSION_MANAGEMENT'	=> 'Gestione estensione',
	'ACP_EXTENSIONS'			=> 'Gestione estensioni',

	'ACP_FORUM_BASED_PERMISSIONS'	=> 'Permessi forum',
	'ACP_FORUM_LOGS'				=> 'Storico log',
	'ACP_FORUM_MANAGEMENT'			=> 'Gestione forum',
	'ACP_FORUM_MODERATORS'			=> 'Permessi moderatori',
	'ACP_FORUM_PERMISSIONS'			=> 'Permessi forum',
	'ACP_FORUM_PERMISSIONS_COPY'	 => 'Copia permessi forum',
	'ACP_FORUM_ROLES'				=> 'Ruoli forum',

	'ACP_GENERAL_CONFIGURATION'		=> 'Configurazione generale',
	'ACP_GENERAL_TASKS'				=> 'Funzioni generali',
	'ACP_GLOBAL_MODERATORS'			=> 'Moderatori globali',
	'ACP_GLOBAL_PERMISSIONS'		=> 'Permessi globali',
	'ACP_GROUPS'					=> 'Gruppi',
	'ACP_GROUPS_FORUM_PERMISSIONS'	=> 'Permessi forum gruppi',
	'ACP_GROUPS_MANAGE'				=> 'Gestisci gruppi',
	'ACP_GROUPS_MANAGEMENT'			=> 'Gestione gruppi',
	'ACP_GROUPS_PERMISSIONS'		=> 'Permessi gruppi',
	'ACP_GROUPS_POSITION'			=> 'Gestione posizioni gruppo',

	'ACP_HELP_PHPBB'			=> 'Aiuta supportando phpBB',

	'ACP_ICONS'					=> 'Icone argomento',
	'ACP_ICONS_SMILIES'			=> 'Icone argomento/emoticon',
	'ACP_INACTIVE_USERS'		=> 'Utenti non attivi',
	'ACP_INDEX'					=> 'Indice PCA',

	'ACP_JABBER_SETTINGS'		=> 'Jabber',

	'ACP_LANGUAGE'				=> 'Gestione lingua',
	'ACP_LANGUAGE_PACKS'		=> 'Pacchetti lingua',
	'ACP_LOAD_SETTINGS'			=> 'Processi',
	'ACP_LOGGING'				=> 'Log PCA',

	'ACP_MAIN'					=> 'Indice PCA',

	'ACP_MANAGE_ATTACHMENTS'			=> 'Gestione allegati',
	'ACP_MANAGE_ATTACHMENTS_EXPLAIN'	=> 'Qui si possono elencare ed eliminare file allegati ai messaggi pubblici e privati​​.',

	'ACP_MANAGE_EXTENSIONS'		=> 'Gestione estensioni allegati',
	'ACP_MANAGE_FORUMS'			=> 'Gestione forum',
	'ACP_MANAGE_RANKS'			=> 'Gestione livelli',
	'ACP_MANAGE_REASONS'		=> 'Motivi rifiuto messaggi',
	'ACP_MANAGE_USERS'			=> 'Gestione utenti',
	'ACP_MASS_EMAIL'			=> 'Email di massa',
	'ACP_MESSAGES'				=> 'Messaggi',
	'ACP_MESSAGE_SETTINGS'		=> 'Messaggi privati',
	'ACP_MODULE_MANAGEMENT'		=> 'Gestione moduli',
	'ACP_MOD_LOGS'				=> 'Log moderatori',
	'ACP_MOD_ROLES'				=> 'Ruoli moderatore',

	'ACP_NO_ITEMS'				=> 'Non sono ancora stati generati elementi.',

	'ACP_ORPHAN_ATTACHMENTS'	=> 'Allegati orfani',

	'ACP_PERMISSIONS'			=> 'Permessi',
	'ACP_PERMISSION_MASKS'		=> 'Permessi assegnati',
	'ACP_PERMISSION_ROLES'		=> 'Ruolo permessi',
	'ACP_PERMISSION_TRACE'		=> 'Traccia permessi',
	'ACP_PHP_INFO'				=> 'Informazioni *php',
	'ACP_POST_SETTINGS'			=> 'Messaggi pubblici',
	'ACP_PRUNE_FORUMS'			=> 'Cancella argomenti',
	'ACP_PRUNE_USERS'			=> 'Cancella utenti',
	'ACP_PRUNING'				=> 'Azioni di cancellazione',

	'ACP_QUICK_ACCESS'			=> 'Accesso rapido',

	'ACP_RANKS'					=> 'Livelli',
	'ACP_REASONS'				=> 'Motivi di segnalazione/rifiuto',
	'ACP_REGISTER_SETTINGS'		=> 'Iscrizione utente',

	'ACP_RESTORE'				=> 'Ripristino',

	'ACP_FEED'					=> 'Gestione Feed',
	'ACP_FEED_SETTINGS'			=> 'Impostazioni Feed',

	'ACP_SEARCH'				=> 'Configurazione motore di ricerca',
	'ACP_SEARCH_INDEX'			=> 'Indice di ricerca',
	'ACP_SEARCH_SETTINGS'		=> 'Motore di ricerca',

	'ACP_SECURITY_SETTINGS'		=> 'Sicurezza',
	'ACP_SERVER_CONFIGURATION'	=> 'Configurazione server',
	'ACP_SERVER_SETTINGS'		=> 'Server',
	'ACP_SIGNATURE_SETTINGS'	=> 'Firma messaggi',
	'ACP_SMILIES'				=> 'Emoticon',
	'ACP_STYLE_MANAGEMENT'		=> 'Gestione stile',
	'ACP_STYLES'				=> 'Stili',
	'ACP_STYLES_CACHE'			=> 'Svuota la cache',
	'ACP_STYLES_INSTALL'		=> 'Installa gli stili',

	'ACP_SUBMIT_CHANGES'		=> 'Invia modifiche',

	'ACP_TEMPLATES'				=> 'Template',
	'ACP_THEMES'				=> 'Temi',

	'ACP_UPDATE'					=> 'Aggiornamento',
	'ACP_USERS_FORUM_PERMISSIONS'	=> 'Permessi forum utente',
	'ACP_USERS_LOGS'				=> 'Log utenti',
	'ACP_USERS_PERMISSIONS'			=> 'Permessi utente',
	'ACP_USER_ATTACH'				=> 'Allegati',
	'ACP_USER_AVATAR'				=> 'Avatar',
	'ACP_USER_FEEDBACK'				=> 'Feedback',
	'ACP_USER_GROUPS'				=> 'Gruppi',
	'ACP_USER_MANAGEMENT'			=> 'Gestione utente',
	'ACP_USER_OVERVIEW'				=> 'Panoramica',
	'ACP_USER_PERM'					=> 'Permessi',
	'ACP_USER_PREFS'				=> 'Preferenze',
	'ACP_USER_PROFILE'				=> 'Profilo',
	'ACP_USER_RANK'					=> 'Livello',
	'ACP_USER_ROLES'				=> 'Ruoli utente',
	'ACP_USER_SECURITY'				=> 'Sicurezza utente',
	'ACP_USER_SIG'					=> 'Firma',
	'ACP_USER_WARNINGS'				=> 'Richiami',

	'ACP_VC_SETTINGS'					=> 'Contromisure spambot',
	'ACP_VC_CAPTCHA_DISPLAY'			=> 'Anteprima immagine CAPTCHA',
	'ACP_VERSION_CHECK'					=> 'Controllo aggiornamenti',
	'ACP_VIEW_ADMIN_PERMISSIONS'		=> 'Permessi amministrativi',
	'ACP_VIEW_FORUM_MOD_PERMISSIONS'	=> 'Permessi moderazione',
	'ACP_VIEW_FORUM_PERMISSIONS'		=> 'Permessi forum',
	'ACP_VIEW_GLOBAL_MOD_PERMISSIONS'	=> 'Permessi moderatore globale',
	'ACP_VIEW_USER_PERMISSIONS'			=> 'Permessi utente',

	'ACP_WORDS'				=> 'Censura parole',

	'ACTION'				=> 'Azione',
	'ACTIONS'				=> 'Azioni',
	'ACTIVATE'				=> 'Attiva',
	'ADD'					=> 'Aggiungi',
	'ADMIN'					=> 'Amministrazione',
	'ADMIN_INDEX'			=> 'Indice amministrazione',
	'ADMIN_PANEL'			=> 'Pannello di Controllo Amministrazione',

	'ADM_LOGOUT'			=> 'Logout&nbsp;PCA',
	'ADM_LOGGED_OUT'		=> 'Scollegato correttamente dal Pannello di Controllo Amministrazione.',

	'BACK'					=> 'Indietro',

	'CONTAINER_EXCEPTION'	=> 'phpBB ha rilevato un errore di costruzione del contenitore a causa di un’estensione installata. Per questo motivo, tutte le estensioni sono state temporaneamente disattivate. Svuota la cache del Forum. Tutte le estensioni verranno automaticamente riattivate una volta risolto l’errore del contenitore. Se questo errore persiste, vai su <a href="https://www.phpbb.com/support">phpBB.com</a> per avere supporto.',
	'EXCEPTION'				=> 'Eccezione',

	'COLOUR_SWATCH'			=> 'Campioni colori web-safe',
	'CONFIG_UPDATED'		=> 'Configurazione aggiornata.',
	'CRON_LOCK_ERROR'		=> 'Impossibile ottenere il blocco del cron.',
	'CRON_NO_SUCH_TASK'		=> 'Impossibile trovare il processo pianificato “%s”.',
	'CRON_NO_TASK'			=> 'Nessuna operazione pianificata deve essere eseguita ora.',
	'CRON_NO_TASKS'			=> 'Nessuna operazione pianificata è stata trovata.',
	'CSV_INVALID'			=> 'L’impostazione delimitata da virgole “%1$s” fornita non è valida. I valori devono essere delimitati solo da virgole, non devono contenere delimitatori iniziali o finali.',
	'CURRENT_VERSION'		=> 'Versione corrente',

	'DEACTIVATE'				=> 'Disattiva',
	'DIRECTORY_DOES_NOT_EXIST'	=> 'Il percorso specificato “%s” non esiste.',
	'DIRECTORY_NOT_DIR'			=> 'Il percorso specificato “%s” non è una cartella.',
	'DIRECTORY_NOT_WRITABLE'	=> 'Il percorso specificato “%s” non è scrivibile.',
	'DISABLE'					=> 'Disabilita',
	'DOWNLOAD'					=> 'Scarica',
	'DOWNLOAD_AS'				=> 'Scarica come',
	'DOWNLOAD_STORE'			=> 'Scarica o salva file',
	'DOWNLOAD_STORE_EXPLAIN'	=> 'Puoi scaricare direttamente il file o salvarlo nella cartella <samp>store/</samp>.',
	'DOWNLOADS'					=> 'Download',

	'EDIT'					=> 'Modifica',
	'ENABLE'				=> 'Abilita',
	'EXPORT_DOWNLOAD'		=> 'Scarica',
	'EXPORT_STORE'			=> 'Salva',

	'GENERAL_OPTIONS'		=> 'Opzioni generali',
	'GENERAL_SETTINGS'		=> 'Impostazioni generali',
	'GLOBAL_MASK'			=> 'Schermata permessi globali',

	'INSTALL'				=> 'Installa',
	'IP'					=> 'IP utente',
	'IP_HOSTNAME'			=> 'Indirizzi IP o hostname',

	'LATEST_VERSION'				=> 'Ultima versione',
	'LOAD_NOTIFICATIONS'			=> 'Visualizza notifiche',
	'LOAD_NOTIFICATIONS_EXPLAIN'	=> 'Visualizza l’elenco delle notifiche su ogni pagina (in genere nell’header).',
	'LOGGED_IN_AS'					=> 'Sei connesso come:',
	'LOGIN_ADMIN'					=> 'Per amministrare la Board devi essere collegato come utente.',
	'LOGIN_ADMIN_CONFIRM'			=> 'Per amministrare la Board ti devi autenticare nuovamente.',
	'LOGIN_ADMIN_SUCCESS'			=> 'Ti sei autenticato correttamente verrai reindirizzato al Pannello di Controllo Amministrazione.',
	'LOOK_UP_FORUM'					=> 'Seleziona forum',
	'LOOK_UP_FORUMS_EXPLAIN'		=> 'Puoi selezionare più di un forum.',

	'MANAGE'				=> 'Gestisci',
	'MENU_TOGGLE'			=> 'Nascondi o visualizza il menu laterale',
	'MORE'					=> 'Altro',	// Not used at the moment
	'MORE_INFORMATION'		=> 'Altre informazioni »',
	'MOVE_DOWN'				=> 'Sposta giù',
	'MOVE_UP'				=> 'Sposta su',

	'NOTIFY'				=> 'Notifica',
	'NO_ADMIN'				=> 'Non sei autorizzato ad amministrare questa Board.',
	'NO_EMAILS_DEFINED'		=> 'Nessun indirizzo email valido trovato.',
	'NO_FILES_TO_DELETE'	=> 'Gli allegati selezionati per la cancellazione, non esistono.',
	'NO_PASSWORD_SUPPLIED'	=> 'Devi scrivere la tua password per accedere al Pannello di Controllo Amministrazione.',

	'OFF'					=> 'non attivo',
	'ON'					=> 'attivo',

	'PARSE_BBCODE'						=> 'Analizza BBCode',
	'PARSE_SMILIES'						=> 'Analizza emoticon',
	'PARSE_URLS'						=> 'Analizza collegamenti',
	'PERMISSIONS_TRANSFERRED'			=> 'Permessi trasferiti',
	'PERMISSIONS_TRANSFERRED_EXPLAIN'	=> 'Hai ricevuto i permessi di %1$s. Puoi navigare con i permessi utente, ma senza avere accesso al pannello di controllo fin quando i permessi di amministrazione non sono stati nuovamente trasferiti. Puoi <a href="%2$s"><strong>tornare alle tue impostazioni permessi</strong></a> in qualsiasi momento.',
	'PROCEED_TO_ACP'					=> '%sVai al PCA%s',

	'RELEASE_ANNOUNCEMENT'				=> 'Annuncio',
	'REMIND'							=> 'Ricorda',
	'REPARSE_LOCK_ERROR'				=> 'Nuova analisi in corso eseguita da un altro processo.',
	'RESYNC'							=> 'Risincronizza',

	'RUNNING_TASK'			=> 'Operazione in esecuzione: %s.',
	'SELECT_ANONYMOUS'		=> 'Seleziona utente anonimo',
	'SELECT_OPTION'			=> 'Seleziona opzione',

	'SETTING_TOO_LOW'		=> 'Il valore inserito per l’impostazione “%1$s” è troppo basso. Il valore minimo consentito è %2$d.',
	'SETTING_TOO_BIG'		=> 'Il valore inserito per l’impostazione “%1$s” è troppo grande. Il valore massimo consentito è %2$d.',
	'SETTING_TOO_LONG'		=> 'Il valore inserito per l’impostazione “%1$s” è troppo lungo. La lunghezza massima consentita è %2$d.',
	'SETTING_TOO_SHORT'		=> 'Il valore inserito per l’impostazione “%1$s” non è abbastanza lungo. La lunghezza minima consentita è %2$d.',

	'SHOW_ALL_OPERATIONS'	=> 'Mostra tutte le operazioni',

	'TASKS_NOT_READY'		=> 'Operazioni non pronte:',
	'TASKS_READY'			=> 'Operazioni pronte:',
	'TOTAL_SIZE'			=> 'Dimensione totale',

	'UCP'					=> 'Pannello di Controllo Utente',
	'URL_INVALID'			=> 'L’URL fornito per l’impostazione “%1$s” non è valido.',
	'URL_SCHEME_INVALID'	=> 'Lo schema fornito “%2$s” nell’impostazione separata da virgole “%1$s” non è valido. Lo schema dovrebbe iniziare con un carattere latino seguito da caratteri alfanumerici, trattini o punti.',
	'USERNAMES_EXPLAIN'		=> 'Metti ogni nome utente su una linea separata.',
	'USER_CONTROL_PANEL'	=> 'Pannello di Controllo Utente',

	'UPDATE_NEEDED'			=> 'La Board non è aggiornata.',
	'UPDATE_NOT_NEEDED'		=> 'La Board è aggiornata.',
	'UPDATES_AVAILABLE'		=> 'Aggiornamenti disponibili:',

	'WARNING'				=> 'Richiamo',
));

// PHP info
$lang = array_merge($lang, array(
	'ACP_PHP_INFO_EXPLAIN'	=> 'Questa pagina elenca informazioni sulla versione PHP installata in questo server. Include dettagli di moduli caricati, variabili disponibili ed impostazioni predefinite. Queste informazioni possono essere utili quando si riscontrano dei problemi. Siate consapevoli che alcune società di hosting limitano le informazioni mostrate per ragioni di sicurezza. Non fornire alcun dettaglio riportato in questa pagina eccetto quando richiesto dal <a href="https://www.phpbb.com/about/team/">team di supporto ufficiale</a> o dai Forum di supporto internazionali.',

	'NO_PHPINFO_AVAILABLE'	=> 'Le informazioni sul PHP non sono disponibili. Phpinfo() è stato disabilitato per ragioni di sicurezza.',
));

// Logs
$lang = array_merge($lang, array(
	'ACP_ADMIN_LOGS_EXPLAIN'	=> 'Qui sono elencate tutte le azioni eseguite dagli amministratori. Puoi ordinarli per nome utente, data, IP o azione. Se hai le autorizzazioni appropriate puoi anche cancellare operazioni individuali o lo storico in generale.',
	'ACP_CRITICAL_LOGS_EXPLAIN'	=> 'Qui sono elencate tutte le azioni eseguite dalla Board stessa. Questi storici forniscono informazioni che puoi usare per risolvere problemi specifici, per esempio email non consegnate. Puoi ordinarli per nome utente, data, IP o azione. Se hai i permessi appropriati puoi anche cancellare operazioni individuali o lo storico in generale.',
	'ACP_MOD_LOGS_EXPLAIN'		=> 'Qui sono elencate tutte le azioni eseguite su forum, argomenti e messaggi nonché ogni altra azione eseguita sugli utenti dai moderatori, incluso il ban. Puoi ordinarli per nome utente, data, IP o azione. Se hai i permessi appropriati puoi anche cancellare operazioni individuali o lo storico in generale.',
	'ACP_USERS_LOGS_EXPLAIN'	=> 'Qui sono elencate tutte le azioni eseguite dagli utenti o sugli utenti (segnalazioni, richiami e note dell’utente).',
	'ALL_ENTRIES'				=> 'Tutti gli eventi',

	'DISPLAY_LOG'	=> 'Visualizza eventi dal precedente',

	'NO_ENTRIES'	=> 'Non ci sono eventi per questo periodo.',

	'SORT_IP'		=> 'Indirizzo IP',
	'SORT_DATE'		=> 'Data',
	'SORT_ACTION'	=> 'Storico log azioni',
));

// Index page
$lang = array_merge($lang, array(
	'ADMIN_INTRO'				=> 'Grazie per aver scelto phpBB3. In questa pagina hai il riassunto delle varie statistiche della tua Board. Tramite i collegamenti a sinistra puoi accedere alle pagine delle varie funzioni, dove troverai istruzioni dettagliate per utilizzarle al meglio.',
	'ADMIN_LOG'					=> 'Azioni compiute dall’amministratore',
	'ADMIN_LOG_INDEX_EXPLAIN'	=> 'Descrizione delle ultime cinque azioni effettuate dagli amministratori. Una copia completa dei log può essere vista nella sezione manutenzione o dal collegamento qui sotto.',
	'AVATAR_DIR_SIZE'			=> 'Dimensione cartella avatar',

	'BOARD_STARTED'			=> 'Sistema avviato il',
	'BOARD_VERSION'			=> 'Versione in uso',

	'DATABASE_SERVER_INFO'	=> 'Database server',
	'DATABASE_SIZE'			=> 'Dimensione database',

	// Environment configuration checks, mbstring related
	'ERROR_MBSTRING_FUNC_OVERLOAD'					=> 'La funzione di sovraccarico non è correttamente configurata.',
	'ERROR_MBSTRING_FUNC_OVERLOAD_EXPLAIN'			=> '<var>mbstring.func_overload</var> deve essere impostata su 0 o su 4. Puoi controllare il valore corrente nella pagina <samp>Informazioni *php</samp>.',
	'ERROR_MBSTRING_ENCODING_TRANSLATION'			=> 'La codifica trasparente dei caratteri non è correttamente configurata',
	'ERROR_MBSTRING_ENCODING_TRANSLATION_EXPLAIN'	=> '<var>mbstring.encoding_translation</var> deve essere impostata su 0. Puoi controllare il valore corrente nella pagina <samp>Informazioni *php</samp>.',
	'ERROR_MBSTRING_HTTP_INPUT'						=> 'La codifica HTTP dei caratteri in ingresso non è correttamente configurata',
	'ERROR_MBSTRING_HTTP_INPUT_EXPLAIN'				=> '<var>mbstring.http_input</var> deve essere lasciato vuoto. Puoi controllare il valore corrente nella pagina <samp>Informazioni *php</samp>.',
	'ERROR_MBSTRING_HTTP_OUTPUT'					=> 'La codifica HTTP dei caratteri in uscita non è correttamente configurata',
	'ERROR_MBSTRING_HTTP_OUTPUT_EXPLAIN'			=> '<var>mbstring.http_output</var> deve essere lasciato vuoto. Puoi controllare il valore corrente nella pagina <samp>Informazioni *php</samp>.',
    'ERROR_DEFAULT_CHARSET'							=> 'Il set di caratteri predefinito non è configurato correttamente',
	'ERROR_DEFAULT_CHARSET_EXPLAIN'					=> '<var>set di caratteri predefinito</var> deve essere impostato su <samp>UTF-8</samp>. Puoi controllare il valore corrente nella pagina <samp>Informazioni *php</samp>.',
	
	'FILES_PER_DAY'		=> 'Allegati al giorno',
	'FORUM_STATS'		=> 'Statistiche',

	'GZIP_COMPRESSION'	=> 'Compressione GZip',

	'NO_SEARCH_INDEX'	=> 'Il tipo di ricerca selezionato non dispone di un Indice di ricerca.<br />Crea l’Indice per “%1$s” nella sezione relativa all’%2$sIndice di Ricerca%3$s.',
	'NOT_AVAILABLE'		=> 'Non disponibile',
	'NUMBER_FILES'		=> 'Numero di allegati',
	'NUMBER_POSTS'		=> 'Numero di messaggi',
	'NUMBER_TOPICS'		=> 'Numero di argomenti',
	'NUMBER_USERS'		=> 'Numero di utenti',
	'NUMBER_ORPHAN'		=> 'Allegati orfani',

	'PHP_VERSION'		=> 'Versione PHP',
	'PHP_VERSION_OLD'	=> 'La versione di PHP in uso su questo server (%1$s) non sarà più supportata nelle versioni future di phpBB. La versione minima richiesta sarà PHP %2$s. %3$sDettagli%4$s',

	'POSTS_PER_DAY'		=> 'Messaggi al giorno',

	'PURGE_CACHE'			=> 'Vuota la cache',
	'PURGE_CACHE_CONFIRM'	=> 'Sei sicuro di voler vuotare la cache?',
	'PURGE_CACHE_EXPLAIN'	=> 'Vuota tutta la cache, compresi i file del template e le ricerche.',
	'PURGE_CACHE_SUCCESS'	=> 'La cache è stata svuotata con successo.',

	'PURGE_SESSIONS'			=> 'Elimina tutte le sessioni',
	'PURGE_SESSIONS_CONFIRM'	=> 'Sei sicuro di voler eliminare tutte le sessioni? Questa operazione effettua un logout di tutti gli utenti.',
	'PURGE_SESSIONS_EXPLAIN'	=> 'Elimina tutte le sessioni. Questa operazione effettuerà un logout di tutti gli utenti, troncando la tabella delle sessioni.',
	'PURGE_SESSIONS_SUCCESS'	=> 'Sessioni eliminate con successo.',

	'RESET_DATE'					=> 'Ripristina la data di avvio del sistema',
	'RESET_DATE_CONFIRM'			=> 'Sei sicuro di voler ripristinare la data di avvio del sistema?',
	'RESET_DATE_SUCCESS'			=> 'La data di avvio del sistema è stata ripristinata',
	'RESET_ONLINE'					=> 'Ripristina il massimo numero di utenti connessi',
	'RESET_ONLINE_CONFIRM'			=> 'Sei sicuro di voler ripristinare il massimo numero di utenti connessi?',
	'RESET_ONLINE_SUCCESS'			=> 'Massimo numero di utenti OnLine ripristinato',
	'RESYNC_POSTCOUNTS'				=> 'Sincronizza conteggio messaggi',
	'RESYNC_POSTCOUNTS_EXPLAIN'		=> 'Saranno presi in considerazione solamente i messaggi attuali.',
	'RESYNC_POSTCOUNTS_CONFIRM'		=> 'Sei sicuro di voler sincronizzare il conteggio dei messaggi?',
	'RESYNC_POSTCOUNTS_SUCCESS'		=> 'Conteggio dei messaggi risincronizzato',
	'RESYNC_POST_MARKING'			=> 'Sincronizza argomenti marcati',
	'RESYNC_POST_MARKING_CONFIRM'	=> 'Sei sicuro di voler sincronizzare gli argomenti marcati?',
	'RESYNC_POST_MARKING_EXPLAIN'	=> 'Prima deseleziona tutti gli argomenti e poi seleziona correttamente gli argomenti che sono stati attivi negli ultimi sei mesi.',
	'RESYNC_POST_MARKING_SUCCESS'	=> 'Argomenti marcati risincronizzati',
	'RESYNC_STATS'					=> 'Sincronizza statistiche',
	'RESYNC_STATS_CONFIRM'			=> 'Sei sicuro di voler sincronizzare le statistiche?',
	'RESYNC_STATS_EXPLAIN'			=> 'Ricalcola il numero totale di messaggi, argomenti, utenti e file.',
	'RESYNC_STATS_SUCCESS'			=> 'Statistiche risincronizzate',
	'RUN'							=> 'Avvia',

	'STATISTIC'					=> 'Statistiche',
	'STATISTIC_RESYNC_OPTIONS'	=> 'Sincronizza o azzera statistiche',

	'TIMEZONE_INVALID'	=> 'Il fuso orario selezionato non è valido.',
	'TIMEZONE_SELECTED'	=> '(attualmente selezionato)',
	'TOPICS_PER_DAY'	=> 'Argomenti al giorno',

	'UPLOAD_DIR_SIZE'	=> 'Dimensione degli allegati inviati',
	'USERS_PER_DAY'		=> 'Utenti al giorno',

	'VALUE'						=> 'Valore',
	'VERSIONCHECK_FAIL'			=> 'Non è stato possibile ottenere informazioni sulla versione più recente.',
	'VERSIONCHECK_FORCE_UPDATE'	=> 'Ricontrolla versione',
	'VERSION_CHECK'				=> 'Controllo versione',
	'VERSION_CHECK_EXPLAIN'		=> 'Controlla se la tua installazione di phpBB è aggiornata.',
	'VERSIONCHECK_INVALID_ENTRY'	=> 'Le informazioni sulla versione più recente contengono una voce non supportata.',
	'VERSIONCHECK_INVALID_URL'		=> 'Le informazioni sulla versione più recente contengono URL non validi.',
	'VERSIONCHECK_INVALID_VERSION'	=> 'Le informazioni sulla versione più recente contengono una versione non valida.',
	'VERSION_NOT_UP_TO_DATE_ACP'	=> 'La tua installazione di phpBB non è aggiornata.<br />Di seguito è riportato un link per l’annuncio di rilascio, che contiene ulteriori informazioni e le istruzioni sull’aggiornamento.',
	'VERSION_NOT_UP_TO_DATE_TITLE'	=> 'La tua installazione di phpBB non è aggiornata.',
	'VERSION_UP_TO_DATE_ACP'	=> 'La tua installazione di phpBB è aggiornata. Non ci sono aggiornamenti disponibili in questo momento.',
	'VIEW_ADMIN_LOG'			=> 'Vedi log amministratore',
	'VIEW_INACTIVE_USERS'		=> 'Vedi utenti non attivi',

	'WELCOME_PHPBB'			=> 'Benvenuto in phpBB3',
	'WRITABLE_CONFIG'		=> 'Il tuo file di configurazione (config.php) è attualmente scrivibile. Ti consigliamo vivamente di cambiare i permessi a 640 o almeno a 644 (per info: <a href="http://it.wikipedia.org/wiki/Chmod" rel="external">chmod</a> 640 config.php).',
));

// Inactive Users
$lang = array_merge($lang, array(
	'INACTIVE_DATE'					=> 'Data inattività',
	'INACTIVE_REASON'				=> 'Motivo',
	'INACTIVE_REASON_MANUAL'		=> 'Account disattivato da amministratore',
	'INACTIVE_REASON_PROFILE'		=> 'Dettagli profilo modificati',
	'INACTIVE_REASON_REGISTER'		=> 'Utente appena registrato',
	'INACTIVE_REASON_REMIND'		=> 'Riattivazione utente forzata',
	'INACTIVE_REASON_UNKNOWN'		=> 'Sconosciuto',
	'INACTIVE_USERS'				=> 'Utenti non attivi',
	'INACTIVE_USERS_EXPLAIN'		=> 'Elenco di utenti registrati ma non attivi. Puoi attivarli, cancellarli o mandare loro un avviso (via email) se lo desideri.',
	'INACTIVE_USERS_EXPLAIN_INDEX'	=> 'Elenco degli ultimi 10 utenti registrati non attivi. Gli account sono inattivi o perché è abilitata l’attivazione degli utenti nelle impostazioni di registrazione utente, o perché questi account sono stati disattivati. Una lista completa può essere vista dal collegamento qui sotto da dove puoi attivare, cancellare o inviare un avviso (via email) se lo desideri.',

	'NO_INACTIVE_USERS'	=> 'Non sono presenti utenti non attivi',

	'SORT_INACTIVE'			=> 'Data inattività',
	'SORT_LAST_VISIT'		=> 'Ultimo accesso',
	'SORT_REASON'			=> 'Motivo',
	'SORT_REG_DATE'			=> 'Data di iscrizione',
	'SORT_LAST_REMINDER'	=> 'Ultimo sollecito',
	'SORT_REMINDER'			=> 'Sollecito inviato',

	'USER_IS_INACTIVE'		=> 'L’utente non è attivo',
));

// Help support phpBB page
$lang = array_merge($lang, array(
	'EXPLAIN_SEND_STATISTICS'	=> 'Il team di sviluppo di phpBB ti chiede, gentilmente, di inviare alcuni dati tecnici sul tuo server e sulle tue configurazioni, per futuri sviluppi del software. Tutte le informazioni che possono identificare te o il tuo sito sono state rimosse. I dati sono completamente <strong>anonimi</strong>, come puoi vedere dai dettagli. Questi dati anonimi, ci serviranno per future versioni dello script e saranno poi resi pubblici. Inoltre, condividiamo questi dati statistici con il PHP project, il linguaggio di programmazione con cui è fatto phpBB.',
	'EXPLAIN_SHOW_STATISTICS'	=> 'Tramite il pulsante qui sotto puoi vedere in anteprima i dati che verranno inviati.',
	'DONT_SEND_STATISTICS'		=> 'Ritorna al PCA se non desideri inviare informazioni statistiche a phpBB.',
	'GO_ACP_MAIN'				=> 'Vai alla pagina principale del PCA',
	'HIDE_STATISTICS'			=> 'Nascondi i dettagli',
	'SEND_STATISTICS'			=> 'Invia statistiche',
	'SEND_STATISTICS_LONG'		=> 'Invia informazioni statistiche',
	'SHOW_STATISTICS'			=> 'Mostra i dettagli',
	'THANKS_SEND_STATISTICS'	=> 'Ti ringraziamo per aver inviato le tue informazioni.',
	'FAIL_SEND_STATISTICS'		=> 'phpBB non è riuscito ad inviare le statistiche',
));

// Log Entries
$lang = array_merge($lang, array(
	'LOG_ACL_ADD_USER_GLOBAL_U_'		=> '<strong>Aggiunti o modificati permessi utente a utenti</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_U_'		=> '<strong>Aggiunti o modificati permessi utente a gruppi</strong><br />» %s',
	'LOG_ACL_ADD_USER_GLOBAL_M_'		=> '<strong>Aggiunti o modificati permessi moderatore globale a utenti</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_M_'		=> '<strong>Aggiunti o modificati permessi moderatore globale a gruppi</strong><br />» %s',
	'LOG_ACL_ADD_USER_GLOBAL_A_'		=> '<strong>Aggiunti o modificati permessi amministratore a utenti</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_A_'		=> '<strong>Aggiunti o modificati permessi amministratore a gruppi</strong><br />» %s',

	'LOG_ACL_ADD_ADMIN_GLOBAL_A_'		=> '<strong>Aggiunti o modificati amministratori</strong><br />» %s',
	'LOG_ACL_ADD_MOD_GLOBAL_M_'			=> '<strong>Aggiunti o modificati moderatori globali</strong><br />» %s',

	'LOG_ACL_ADD_USER_LOCAL_F_'			=> '<strong>Aggiunto o modificato accesso forum a utenti</strong> in %1$s<br />» %2$s',
	'LOG_ACL_ADD_USER_LOCAL_M_'			=> '<strong>Aggiunto o modificato accesso forum moderatore a utenti</strong> in %1$s<br />» %2$s',
	'LOG_ACL_ADD_GROUP_LOCAL_F_'		=> '<strong>Aggiunto o modificato accesso forum a gruppi</strong> in %1$s<br />» %2$s',
	'LOG_ACL_ADD_GROUP_LOCAL_M_'		=> '<strong>Aggiunto o modificato accesso forum moderatore a gruppi</strong> in %1$s<br />» %2$s',

	'LOG_ACL_ADD_MOD_LOCAL_M_'			=> '<strong>Aggiunti o modificati moderatori</strong> in %1$s<br />» %2$s',
	'LOG_ACL_ADD_FORUM_LOCAL_F_'		=> '<strong>Aggiunti o modificati permessi forum</strong> in %1$s<br />» %2$s',

	'LOG_ACL_DEL_ADMIN_GLOBAL_A_'		=> '<strong>Rimossi amministratori</strong><br />» %s',
	'LOG_ACL_DEL_MOD_GLOBAL_M_'			=> '<strong>Rimossi moderatori globali</strong><br />» %s',
	'LOG_ACL_DEL_MOD_LOCAL_M_'			=> '<strong>Rimossi moderatori</strong> da %1$s<br />» %2$s',
	'LOG_ACL_DEL_FORUM_LOCAL_F_'		=> '<strong>Rimossi permessi forum Utente/Gruppo</strong> da %1$s<br />» %2$s',

	'LOG_ACL_TRANSFER_PERMISSIONS'		=> '<strong>Permessi trasferiti da</strong><br />» %s',
	'LOG_ACL_RESTORE_PERMISSIONS'		=> '<strong>Ripristinati propri permessi dopo aver usato i permessi di</strong><br />» %s',

	'LOG_ADMIN_AUTH_FAIL'		=> '<strong>Tentativo di accesso in amministrazione fallito</strong>',
	'LOG_ADMIN_AUTH_SUCCESS'	=> '<strong>Accesso in amministrazione</strong>',

	'LOG_ATTACHMENTS_DELETED'	=> '<strong>Rimosso allegato utente</strong><br />» %s',

	'LOG_ATTACH_EXT_ADD'		=> '<strong>Aggiungi o modifica estensione allegato</strong><br />» %s',
	'LOG_ATTACH_EXT_DEL'		=> '<strong>Rimossa estensione allegato</strong><br />» %s',
	'LOG_ATTACH_EXT_UPDATE'		=> '<strong>Aggiornata estensione allegato</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_ADD'	=> '<strong>Aggiunta estensione gruppo</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_EDIT'	=> '<strong>Modificata estensione gruppo</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_DEL'	=> '<strong>Rimossa estensione gruppo</strong><br />» %s',
	'LOG_ATTACH_FILEUPLOAD'		=> '<strong>File orfano caricato su argomento</strong><br />» ID %1$d - %2$s',
	'LOG_ATTACH_ORPHAN_DEL'		=> '<strong>File orfano cancellato</strong><br />» %s',

	'LOG_BAN_EXCLUDE_USER'	=> '<strong>Escludi utente dal ban</strong> per questo motivo “<em>%1$s</em>”<br />» %2$s',
	'LOG_BAN_EXCLUDE_IP'	=> '<strong>Escludi IP dal ban</strong> per questo motivo “<em>%1$s</em>”<br />» %2$s',
	'LOG_BAN_EXCLUDE_EMAIL' => '<strong>Escludi email dal ban</strong> per questo motivo “<em>%1$s</em>”<br />» %2$s',
	'LOG_BAN_USER'			=> '<strong>Utente bannato</strong> per questo motivo “<em>%1$s</em>”<br />» %2$s',
	'LOG_BAN_IP'			=> '<strong>IP bannato</strong> per questo motivo “<em>%1$s</em>”<br />» %2$s',
	'LOG_BAN_EMAIL'			=> '<strong>Email bannata</strong> per questo motivo “<em>%1$s</em>”<br />» %2$s',
	'LOG_UNBAN_USER'		=> '<strong>Riabilita utente</strong><br />» %s',
	'LOG_UNBAN_IP'			=> '<strong>Riabilita IP</strong><br />» %s',
	'LOG_UNBAN_EMAIL'		=> '<strong>Riabilita email</strong><br />» %s',

	'LOG_BBCODE_ADD'		=> '<strong>Aggiungi nuovo BBCode</strong><br />» %s',
	'LOG_BBCODE_EDIT'		=> '<strong>Modifica BBCode</strong><br />» %s',
	'LOG_BBCODE_DELETE'		=> '<strong>Cancella BBCode</strong><br />» %s',
	'LOG_BBCODE_CONFIGURATION_ERROR'	=> '<strong>Errore durante la configurazione del BBCode</strong>: %1$s<br />» %2$s',

	'LOG_BOT_ADDED'			=> '<strong>Nuovo Bot aggiunto</strong><br />» %s',
	'LOG_BOT_DELETE'		=> '<strong>Bot cancellato</strong><br />» %s',
	'LOG_BOT_UPDATED'		=> '<strong>Bot esistenti aggiornati</strong><br />» %s',

	'LOG_CLEAR_ADMIN'		=> '<strong>Storico log amministratore eliminato</strong>',
	'LOG_CLEAR_CRITICAL'	=> '<strong>Storico log errori eliminato</strong>',
	'LOG_CLEAR_MOD'			=> '<strong>Storico log moderatore eliminato</strong>',
	'LOG_CLEAR_USER'		=> '<strong>Storico log utente eliminato</strong><br />» %s',
	'LOG_CLEAR_USERS'		=> '<strong>Storico log utenti eliminati</strong>',

	'LOG_CONFIG_ATTACH'			=> '<strong>Impostazioni allegati modificate</strong>',
	'LOG_CONFIG_AUTH'			=> '<strong>Impostazioni autenticazione modificate</strong>',
	'LOG_CONFIG_AVATAR'			=> '<strong>Impostazioni avatar modificate</strong>',
	'LOG_CONFIG_COOKIE'			=> '<strong>Impostazioni cookie modificate</strong>',
	'LOG_CONFIG_EMAIL'			=> '<strong>Impostazioni email modificate</strong>',
	'LOG_CONFIG_FEATURES'		=> '<strong>Caratteristiche Board modificate</strong>',
	'LOG_CONFIG_LOAD'			=> '<strong>Impostazioni processi modificate</strong>',
	'LOG_CONFIG_MESSAGE'		=> '<strong>Impostazioni MP modificate</strong>',
	'LOG_CONFIG_POST'			=> '<strong>Impostazioni messaggi modificate</strong>',
	'LOG_CONFIG_REGISTRATION'	=> '<strong>Impostazioni iscrizione modificate</strong>',
	'LOG_CONFIG_FEED'			=> '<strong>Impostazioni syndication feed modificate</strong>',
	'LOG_CONFIG_SEARCH'			=> '<strong>Impostazioni di ricerca modificate</strong>',
	'LOG_CONFIG_SECURITY'		=> '<strong>Impostazioni sicurezza modificate</strong>',
	'LOG_CONFIG_SERVER'			=> '<strong>Impostazioni server modificate</strong>',
	'LOG_CONFIG_SETTINGS'		=> '<strong>Impostazioni Board modificate</strong>',
	'LOG_CONFIG_SIGNATURE'		=> '<strong>Impostazioni firma modificate</strong>',
	'LOG_CONFIG_VISUAL'			=> '<strong>Impostazioni contromisure spambot modificate</strong>',

	'LOG_APPROVE_TOPIC'			=> '<strong>Argomenti approvati</strong><br />» %s',
	'LOG_BUMP_TOPIC'			=> '<strong>Bump argomento eseguito su</strong><br />» %s',
	'LOG_DELETE_POST'			=> '<strong>Cancellato messaggio “%1$s” scritto da “%2$s” per il seguente motivo</strong><br />» %3$s',
	'LOG_DELETE_SHADOW_TOPIC'	=> '<strong>Argomenti ombra cancellati</strong><br />» %s',
	'LOG_DELETE_TOPIC'			=> '<strong>Cancellato argomento “%1$s” scritto da “%2$s” per il seguente motivo</strong><br />» %3$s',
	'LOG_FORK'					=> '<strong>Argomenti copiati</strong><br />» da %s',
	'LOG_LOCK'					=> '<strong>Argomenti bloccati</strong><br />» %s',
	'LOG_LOCK_POST'				=> '<strong>Messaggi bloccati</strong><br />» %s',
	'LOG_MERGE'					=> '<strong>Messaggi uniti</strong> in un argomento<br />» %s',
	'LOG_MOVE'					=> '<strong>Argomenti spostati</strong><br />» da %1$s a %2$s',
	'LOG_MOVED_TOPIC'			=> '<strong>Argomento spostato</strong><br />Â» %s',
	'LOG_PM_REPORT_CLOSED'		=> '<strong>Segnalazione MP chiusa</strong><br />» %s',
	'LOG_PM_REPORT_DELETED'		=> '<strong>Segnalazione MP cancellata</strong><br />» %s',
	'LOG_POST_APPROVED'			=> '<strong>Messaggi approvati</strong><br />» %s',
	'LOG_POST_DISAPPROVED'		=> '<strong>Messaggio “%1$s” scritto da “%3$s” disapprovato per il seguente motivo</strong><br />» %2$s',
	'LOG_POST_EDITED'			=> '<strong>Messaggio “%1$s” scritto da “%2$s” modificato per il seguente motivo</strong><br />» %3$s',
	'LOG_POST_RESTORED'			=> '<strong>Messaggio ripristinato</strong><br />» %s',
	'LOG_REPORT_CLOSED'			=> '<strong>Segnalazione chiusa</strong><br />» %s',
	'LOG_REPORT_DELETED'		=> '<strong>Segnalazione cancellata</strong><br />» %s',
	'LOG_RESTORE_TOPIC'			=> '<strong>Argomento ripristinato “%1$s” scritto da</strong><br />» %2$s',
	'LOG_SOFTDELETE_POST'		=> '<strong>Cancellazione temporanea del messaggio “%1$s” scritto da “%2$s” per il seguente motivo</strong><br />» %3$s',
	'LOG_SOFTDELETE_TOPIC'		=> '<strong>Cancellazione temporanea dell’argomento “%1$s” scritto da “%2$s” per il seguente motivo</strong><br />» %3$s',
	'LOG_SPLIT_DESTINATION'		=> '<strong>Messaggi divisi spostati</strong><br />» a %s',
	'LOG_SPLIT_SOURCE'			=> '<strong>Messaggi divisi</strong><br />» da %s',

	'LOG_TOPIC_APPROVED'		=> '<strong>Argomenti approvati</strong><br />» %s',
	'LOG_TOPIC_RESTORED'		=> '<strong>Argomento ripristinato</strong><br />» %s',
	'LOG_TOPIC_DISAPPROVED'		=> '<strong>Argomento “%1$s” scritto da “%3$s” disapprovato per questo motivo</strong><br />%2$s',
	'LOG_TOPIC_RESYNC'			=> '<strong>Contatore argomenti sincronizzato</strong><br />» %s',
	'LOG_TOPIC_TYPE_CHANGED'	=> '<strong>Genere argomento cambiato</strong><br />» %s',
	'LOG_UNLOCK'				=> '<strong>Argomento sbloccato</strong><br />» %s',
	'LOG_UNLOCK_POST'			=> '<strong>Messaggio sbloccato</strong><br />» %s',

	'LOG_DISALLOW_ADD'		=> '<strong>Nomi utenti non permessi aggiunti</strong><br />» %s',
	'LOG_DISALLOW_DELETE'	=> '<strong>Nomi utenti non permessi cancellati</strong>',

	'LOG_DB_BACKUP'			=> '<strong>Backup database</strong>',
	'LOG_DB_DELETE'			=> '<strong>Backup database cancellato</strong>',
	'LOG_DB_RESTORE'		=> '<strong>Backup database ripristinato</strong>',

	'LOG_DOWNLOAD_EXCLUDE_IP'	=> '<strong>IP/hostname esclusi dalla lista di scaricamento</strong><br />» %s',
	'LOG_DOWNLOAD_IP'			=> '<strong>IP/hostname aggiunti alla lista di scaricamento</strong><br />» %s',
	'LOG_DOWNLOAD_REMOVE_IP'	=> '<strong>IP/hostname rimossi dalla lista di scaricamento</strong><br />» %s',

	'LOG_ERROR_JABBER'		=> '<strong>Errore Jabber</strong><br />» %s',
	'LOG_ERROR_EMAIL'		=> '<strong>Errore email</strong><br />» %s',
	'LOG_ERROR_CAPTCHA'		=> '<strong>Errore CAPTCHA</strong><br />» %s',

	'LOG_FORUM_ADD'							=> '<strong>Nuovo forum creato</strong><br />» %s',
	'LOG_FORUM_COPIED_PERMISSIONS'			=> '<strong>Permessi forum copiati</strong> da %1$s<br />» %2$s',
	'LOG_FORUM_DEL_FORUM'					=> '<strong>Forum cancellato</strong><br />» %s',
	'LOG_FORUM_DEL_FORUMS'					=> '<strong>Forum e relativi subforum cancellati</strong><br />» %s',
	'LOG_FORUM_DEL_MOVE_FORUMS'				=> '<strong>Forum cancellato e relativi subforum spostati</strong> in %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS'				=> '<strong>Forum cancellato e relativi messaggi spostati</strong> in %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS_FORUMS'		=> '<strong>Forum e relativi subforum cancellati, argomenti spostati</strong> in %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS_MOVE_FORUMS'	=> '<strong>Forum cancellato, argomenti spostati</strong> in %1$s <strong>e subforum</strong> in %2$s<br />» %3$s',
	'LOG_FORUM_DEL_POSTS'					=> '<strong>Forum e relativi argomenti cancellati</strong><br />» %s',
	'LOG_FORUM_DEL_POSTS_FORUMS'			=> '<strong>Forum, relativi subforum ed argomenti cancellati</strong><br />» %s',
	'LOG_FORUM_DEL_POSTS_MOVE_FORUMS'		=> '<strong>Forum e relativi argomenti cancellati, subforum spostati</strong> in %1$s<br />» %2$s',
	'LOG_FORUM_EDIT'						=> '<strong>Dettagli forum modificati</strong><br />» %s',
	'LOG_FORUM_MOVE_DOWN'					=> '<strong>Forum spostato</strong> %1$s <strong>sotto</strong> %2$s',
	'LOG_FORUM_MOVE_UP'						=> '<strong>Forum spostato</strong> %1$s <strong>sopra</strong> %2$s',
	'LOG_FORUM_SYNC'						=> '<strong>Forum risincronizzato</strong><br />» %s',

	'LOG_GENERAL_ERROR'		=> '<strong>Un errore generale ha avuto luogo</strong>: %1$s <br />» %2$s',

	'LOG_GROUP_CREATED'		=> '<strong>Creato nuovo gruppo</strong><br />» %s',
	'LOG_GROUP_DEFAULTS'	=> '<strong>Il gruppo “%1$s” è ora quello predefinito per i membri selezionati</strong><br />» %2$s',
	'LOG_GROUP_DELETE'		=> '<strong>Gruppo cancellato</strong><br />» %s',
	'LOG_GROUP_DEMOTED'		=> '<strong>Leader del gruppo retrocesso</strong> %1$s<br />» %2$s',
	'LOG_GROUP_PROMOTED'	=> '<strong>Utenti promossi a leader del gruppo</strong> %1$s<br />» %2$s',
	'LOG_GROUP_REMOVE'		=> '<strong>Membri rimossi dal gruppo</strong> %1$s<br />» %2$s',
	'LOG_GROUP_UPDATED'		=> '<strong>Dettagli gruppo aggiornato</strong><br />» %s',
	'LOG_MODS_ADDED'		=> '<strong>Nuovi leader aggiunti al gruppo</strong> %1$s<br />» %2$s',
	'LOG_USERS_ADDED'		=> '<strong>Utenti aggiunti nel gruppo</strong> %1$s<br />» %2$s',
	'LOG_USERS_APPROVED'	=> '<strong>Utenti approvati nel gruppo</strong> %1$s<br />» %2$s',
	'LOG_USERS_PENDING'		=> '<strong>Utenti hanno richiesto di entrare nel gruppo “%1$s” e devono essere approvati</strong><br />» %2$s',

	'LOG_IMAGE_GENERATION_ERROR'	=> '<strong>Errore durante la creazione dell’immagine</strong><br />» Errore in %1$s nella riga %2$s: %3$s',

	'LOG_INACTIVE_ACTIVATE'	=> '<strong>Attivati utenti inattivi</strong><br />» %s',
	'LOG_INACTIVE_DELETE'	=> '<strong>Cancellati utenti inattivi</strong><br />» %s',
	'LOG_INACTIVE_REMIND'	=> '<strong>Email di sollecito inviate a utenti inattivi</strong><br />» %s',
	'LOG_INSTALL_CONVERTED'	=> '<strong>Convertito da %1$s a phpBB %2$s</strong>',
	'LOG_INSTALL_INSTALLED'	=> '<strong>Installato phpBB %s</strong>',

	'LOG_IP_BROWSER_FORWARDED_CHECK'	=> '<strong>La sessione IP/controllo browser/X _ FORWARDED_FOR non è riuscita</strong><br />»IP utente “<em>%1$s</em>” controllato in confronto alla sessione IP “<em>%2$s</em>”, stringa di ricerca dell’utente “<em>%3$s</em>” controllata in confronto alla sessione di ricerca “<em>%4$s</em>” e la stringa utente X_FORWARDED_FOR “<em>%5$s</em>” controllata in confronto alla sessione X_FORWARDED_FOR “<em>%6$s</em>”.',

	'LOG_JAB_CHANGED'			=> '<strong>Utenza Jabber modificata</strong>',
	'LOG_JAB_PASSCHG'			=> '<strong>Password Jabber modificata</strong>',
	'LOG_JAB_REGISTER'			=> '<strong>Utenza Jabber registrata</strong>',
	'LOG_JAB_SETTINGS_CHANGED'	=> '<strong>Impostazioni Jabber modificate</strong>',

	'LOG_LANGUAGE_PACK_DELETED'		=> '<strong>Pacchetto lingua cancellato</strong><br />» %s',
	'LOG_LANGUAGE_PACK_INSTALLED'	=> '<strong>Pacchetto lingua installato</strong><br />» %s',
	'LOG_LANGUAGE_PACK_UPDATED'		=> '<strong>Dettagli pacchetto lingua aggiornati</strong><br />» %s',
	'LOG_LANGUAGE_FILE_REPLACED'	=> '<strong>File di lingua sostituito</strong><br />» %s',
	'LOG_LANGUAGE_FILE_SUBMITTED'	=> '<strong>File di lingua inviato nella cartella store</strong><br />» %s',

	'LOG_MASS_EMAIL'		=> '<strong>Email di massa inviate</strong><br />» %s',

	'LOG_MCP_CHANGE_POSTER'	=> '<strong>Autore dell’argomento cambiato “%1$s”</strong><br />» da %2$s a %3$s',

	'LOG_MODULE_DISABLE'	=> '<strong>Modulo disabilitato</strong><br />» %s',
	'LOG_MODULE_ENABLE'		=> '<strong>Modulo abilitato</strong><br />» %s',
	'LOG_MODULE_MOVE_DOWN'	=> '<strong>Modulo spostato in basso</strong><br />» %1$s sotto %2$s',
	'LOG_MODULE_MOVE_UP'	=> '<strong>Modulo spostato in alto</strong><br />» %1$s sopra %2$s',
	'LOG_MODULE_REMOVED'	=> '<strong>Modulo rimosso</strong><br />» %s',
	'LOG_MODULE_ADD'		=> '<strong>Modulo aggiunto</strong><br />» %s',
	'LOG_MODULE_EDIT'		=> '<strong>Modulo modificato</strong><br />» %s',

	'LOG_A_ROLE_ADD'		=> '<strong>Ruolo amministratore aggiunto</strong><br />» %s',
	'LOG_A_ROLE_EDIT'		=> '<strong>Ruolo amministratore modificato</strong><br />» %s',
	'LOG_A_ROLE_REMOVED'	=> '<strong>Ruolo amministratore rimosso</strong><br />» %s',
	'LOG_F_ROLE_ADD'		=> '<strong>Ruolo forum aggiunto</strong><br />» %s',
	'LOG_F_ROLE_EDIT'		=> '<strong>Ruolo forum modificato</strong><br />» %s',
	'LOG_F_ROLE_REMOVED'	=> '<strong>Ruolo forum rimosso</strong><br />» %s',
	'LOG_M_ROLE_ADD'		=> '<strong>Ruolo moderatore aggiunto</strong><br />» %s',
	'LOG_M_ROLE_EDIT'		=> '<strong>Ruolo moderatore modificato</strong><br />» %s',
	'LOG_M_ROLE_REMOVED'	=> '<strong>Ruolo moderatore rimosso</strong><br />» %s',
	'LOG_U_ROLE_ADD'		=> '<strong>Ruolo utente aggiunto</strong><br />» %s',
	'LOG_U_ROLE_EDIT'		=> '<strong>Ruolo utente modificato</strong><br />» %s',
	'LOG_U_ROLE_REMOVED'	=> '<strong>Ruolo utente rimosso</strong><br />» %s',

	'LOG_PLUPLOAD_TIDY_FAILED'		=> '<strong>Impossibile aprire %1$s per riassetto; controllare i permessi.</strong><br />Eccezione: %2$s<br />Traccia: %3$s',

	'LOG_PROFILE_FIELD_ACTIVATE'	=> '<strong>Campo profilo attivato</strong><br />» %s',
	'LOG_PROFILE_FIELD_CREATE'		=> '<strong>Campo profilo aggiunto</strong><br />» %s',
	'LOG_PROFILE_FIELD_DEACTIVATE'	=> '<strong>Campo profilo disattivato</strong><br />» %s',
	'LOG_PROFILE_FIELD_EDIT'		=> '<strong>Campo profilo modificato</strong><br />» %s',
	'LOG_PROFILE_FIELD_REMOVED'		=> '<strong>Campo profilo rimosso</strong><br />» %s',

	'LOG_PRUNE'					=> '<strong>Forum che hanno subito la cancellazione</strong><br />» %s',
	'LOG_AUTO_PRUNE'			=> '<strong>Forum che hanno subito la cancellazione automatica</strong><br />» %s',
	'LOG_PRUNE_SHADOW'			=> '<strong>Cancellazione automatica argomenti ombra</strong><br />» %s',
	'LOG_PRUNE_USER_DEAC'		=> '<strong>Utenti disattivati</strong><br />» %s',
	'LOG_PRUNE_USER_DEL_DEL'	=> '<strong>Utenti e messaggi cancellati</strong><br />» %s',
	'LOG_PRUNE_USER_DEL_ANON'	=> '<strong>Utenti e messaggi mantenuti</strong><br />» %s',

	'LOG_PURGE_CACHE'			=> '<strong>Cache svuotata</strong>',
	'LOG_PURGE_SESSIONS'		=> '<strong>Sessioni eliminate</strong>',

	'LOG_RANK_ADDED'		=> '<strong>Nuovo livello aggiunto</strong><br />» %s',
	'LOG_RANK_REMOVED'		=> '<strong>Livello rimosso</strong><br />» %s',
	'LOG_RANK_UPDATED'		=> '<strong>Livello aggiornato</strong><br />» %s',

	'LOG_REASON_ADDED'		=> '<strong>Aggiunta ragione di segnalazione/rifiuto</strong><br />» %s',
	'LOG_REASON_REMOVED'	=> '<strong>Rimossa ragione di segnalazione/rifiuto</strong><br />» %s',
	'LOG_REASON_UPDATED'	=> '<strong>Aggiornata ragione di segnalazione/rifiuto</strong><br />» %s',

	'LOG_REFERER_INVALID'		=> '<strong>Validazione referrer fallita</strong><br />»Il referrer era “<em>%1$s</em>”. La richiesta è stata respinta e la sessione è stata chiusa.',
	'LOG_RESET_DATE'			=> '<strong>Ripristina la data d’avvio della Board</strong>',
	'LOG_RESET_ONLINE'			=> '<strong>Ripristina la maggior parte degli utenti in linea</strong>',
	'LOG_RESYNC_FILES_STATS'	=> '<strong>Risincronizza file statistiche</strong>',
	'LOG_RESYNC_POSTCOUNTS'		=> '<strong>Contatore messaggi utenti risincronizzato</strong>',
	'LOG_RESYNC_POST_MARKING'	=> '<strong>Argomenti marcati risincronizzati</strong>',
	'LOG_RESYNC_STATS'			=> '<strong>Statistiche messaggi, argomenti e utenti risincronizzati</strong>',

	'LOG_SEARCH_INDEX_CREATED'	=> '<strong>Creato Indice ricerca per</strong><br />» %s',
	'LOG_SEARCH_INDEX_REMOVED'	=> '<strong>Rimosso Indice ricerca per</strong><br />» %s',
	'LOG_SPHINX_ERROR'			=> '<strong>Errore Sphinx</strong><br />» %s',
	'LOG_SPAMHAUS_OPEN_RESOLVER'		=> 'Spamhaus non consente query che utilizzano un risolutore aperto. Il controllo della lista nera è stato disabilitato. Per ulteriori informazioni, vedere https://www.spamhaus.com/product/help-for-spamhaus-public-mirror-users/',
	'LOG_SPAMHAUS_VOLUME_LIMIT'			=> 'Il limite del volume delle query di Spamhaus è stato superato. Il controllo della lista nera è stato disabilitato. Per ulteriori informazioni, vedere https://www.spamhaus.com/product/help-for-spamhaus-public-mirror-users/',
	'LOG_STYLE_ADD'				=> '<strong>Nuovo stile aggiunto</strong><br />» %s',
	'LOG_STYLE_DELETE'			=> '<strong>Stile cancellato</strong><br />» %s',
	'LOG_STYLE_EDIT_DETAILS'	=> '<strong>Stile modificato</strong><br />» %s',
	'LOG_STYLE_EXPORT'			=> '<strong>Stile esportato</strong><br />» %s',

	// @deprecated 3.1
	'LOG_TEMPLATE_ADD_DB'			=> '<strong>Nuovo template aggiunto al database</strong><br />» %s',
	// @deprecated 3.1
	'LOG_TEMPLATE_ADD_FS'			=> '<strong>Nuovo template aggiunto sul filesystem</strong><br />» %s',
	'LOG_TEMPLATE_CACHE_CLEARED'	=> '<strong>Versioni di template memorizzate nella cache cancellate dalla raccolta template <em>%1$s</em></strong><br />» %2$s',
	'LOG_TEMPLATE_DELETE'			=> '<strong>Raccolta template cancellata</strong><br />» %s',
	'LOG_TEMPLATE_EDIT'				=> '<strong>Raccolta template modificata <em>%1$s</em></strong><br />» %2$s',
	'LOG_TEMPLATE_EDIT_DETAILS'		=> '<strong>Dettagli template modificati</strong><br />» %s',
	'LOG_TEMPLATE_EXPORT'			=> '<strong>Raccolta template esportata</strong><br />» %s',
	// @deprecated 3.1
	'LOG_TEMPLATE_REFRESHED'		=> '<strong>Raccolta template aggiornata</strong><br />» %s',

	// @deprecated 3.1
	'LOG_THEME_ADD_DB'			=> '<strong>Nuovo tema aggiunto al database</strong><br />» %s',
	// @deprecated 3.1
	'LOG_THEME_ADD_FS'			=> '<strong>Nuovo tema aggiunto al filesystem</strong><br />» %s',
	'LOG_THEME_DELETE'			=> '<strong>Tema cancellato</strong><br />» %s',
	'LOG_THEME_EDIT_DETAILS'	=> '<strong>Dettagli tema modificati</strong><br />» %s',
	'LOG_THEME_EDIT'			=> '<strong>Tema modificato <em>%1$s</em></strong>',
	'LOG_THEME_EDIT_FILE'		=> '<strong>Tema modificato <em>%1$s</em></strong><br />» File modificato <em>%2$s</em>',
	'LOG_THEME_EXPORT'			=> '<strong>Tema esportato</strong><br />» %s',
	// @deprecated 3.1
	'LOG_THEME_REFRESHED'		=> '<strong>Tema aggiornato</strong><br />» %s',

	'LOG_UPDATE_DATABASE'	=> '<strong>Database aggiornato dalla versione %1$s alla versione %2$s</strong>',
	'LOG_UPDATE_PHPBB'		=> '<strong>phpBB aggiornato dalla versione %1$s alla versione %2$s</strong>',

	'LOG_USER_ACTIVE'		=> '<strong>Utente attivato</strong><br />» %s',
	'LOG_USER_BAN_USER'		=> '<strong>Utente bannato via gestione utenti</strong> per questo motivo “<em>%1$s</em>”<br />» %2$s',
	'LOG_USER_BAN_IP'		=> '<strong>IP bannato via gestione utenti</strong> per questo motivo “<em>%1$s</em>”<br />» %2$s',
	'LOG_USER_BAN_EMAIL'	=> '<strong>Email bannata via gestione utenti</strong> per questo motivo “<em>%1$s</em>”<br />» %2$s',
	'LOG_USER_DELETED'		=> '<strong>Utente cancellato</strong><br />» %s',
	'LOG_USER_DEL_ATTACH'	=> '<strong>Tutti gli allegati inseriti dall’utente cancellati</strong><br />» %s',
	'LOG_USER_DEL_AVATAR'	=> '<strong>Avatar utente cancellato</strong><br />» %s',
	'LOG_USER_DEL_OUTBOX'	=> '<strong>Casella messaggi in uscita dall’utente vuotata</strong><br />» %s',
	'LOG_USER_DEL_POSTS'	=> '<strong>Tutti i messaggi dell’utente rimossi</strong><br />» %s',
	'LOG_USER_DEL_SIG'		=> '<strong>Firma utente rimossa</strong><br />» %s',
	'LOG_USER_INACTIVE'		=> '<strong>Utente disattivato</strong><br />» %s',
	'LOG_USER_MOVE_POSTS'	=> '<strong>Messaggi utente spostati</strong><br />» scritti da “%1$s” nel forum “%2$s”',
	'LOG_USER_NEW_PASSWORD'	=> '<strong>Password utente modificata</strong><br />» %s',
	'LOG_USER_REACTIVATE'	=> '<strong>Riattivazione utente forzata</strong><br />» %s',
	'LOG_USER_REMOVED_NR'	=> '<strong>Rimosso flag nuovo utente registrato dall’utente</strong><br />» %s',

	'LOG_USER_UPDATE_EMAIL'	=> '<strong>L’utente “%1$s” ha cambiato email</strong><br />» da “%2$s” a “%3$s”',
	'LOG_USER_UPDATE_NAME'	=> '<strong>Nome utente cambiato</strong><br />» da “%1$s” a “%2$s”',
	'LOG_USER_USER_UPDATE'	=> '<strong>Dettagli utente aggiornati</strong><br />» %s',

	'LOG_USER_ACTIVE_USER'		=> '<strong>Utenza attivata</strong>',
	'LOG_USER_DEL_AVATAR_USER'	=> '<strong>Avatar utente rimosso</strong>',
	'LOG_USER_DEL_SIG_USER'		=> '<strong>Firma utente rimossa</strong>',
	'LOG_USER_FEEDBACK'			=> '<strong>Feedback utente aggiunto</strong><br />» %s',
	'LOG_USER_GENERAL'			=> '<strong>Inserimento aggiunto:</strong><br />» %s',
	'LOG_USER_INACTIVE_USER'	=> '<strong>Account utente disattivato</strong>',
	'LOG_USER_LOCK'				=> '<strong>L’utente ha bloccato il proprio argomento</strong><br />» %s',
	'LOG_USER_MOVE_POSTS_USER'	=> '<strong>Tutti i messaggi spostati nel forum</strong>» %s',
	'LOG_USER_REACTIVATE_USER'	=> '<strong>Riattivazione utenza forzata</strong>',
	'LOG_USER_UNLOCK'			=> '<strong>L’utente ha sbloccato il proprio argomento</strong><br />» %s',
	'LOG_USER_WARNING'			=> '<strong>Richiamo utente aggiunto</strong><br />» %s',
	'LOG_USER_WARNING_BODY'		=> '<strong>Il seguente richiamo è stato emesso per questo utente</strong><br />» %s',

	'LOG_USER_GROUP_CHANGE'			=> '<strong>L’utente ha cambiato gruppo predefinito</strong><br />» %s',
	'LOG_USER_GROUP_DEMOTE'			=> '<strong>Utente degradato da moderatore del gruppo</strong><br />» %s',
	'LOG_USER_GROUP_JOIN'			=> '<strong>L’utente si è unito al gruppo</strong><br />» %s',
	'LOG_USER_GROUP_JOIN_PENDING'	=> '<strong>L’utente si è unito al gruppo e deve essere approvato</strong><br />» %s',
	'LOG_USER_GROUP_RESIGN'			=> '<strong>L’utente rinuncia ad entrare nel gruppo</strong><br />» %s',

	'LOG_WARNING_DELETED'		=> '<strong>Richiami utente cancellati</strong><br />» %s',
	'LOG_WARNINGS_DELETED'		=> array(
		1 => '<strong>Cancellato richiamo utente</strong><br />» %1$s',
		2 => '<strong>Cancellati %2$d richiami utente</strong><br />» %1$s', // Example: '<strong>Deleted 2 user warnings</strong><br />» username'
	),
	'LOG_WARNINGS_DELETED_ALL'	=> '<strong>Cancellati tutti i richiami utente</strong><br />» %s',

	'LOG_WORD_ADD'			=> '<strong>Censura parola aggiunta</strong><br />» %s',
	'LOG_WORD_DELETE'		=> '<strong>Censura parola cancellata</strong><br />» %s',
	'LOG_WORD_EDIT'			=> '<strong>Censura parola modificata</strong><br />» %s',

	'LOG_EXT_ENABLE'	=> '<strong>Estensione abilitata</strong><br />» %s',
	'LOG_EXT_DISABLE'	=> '<strong>Estensione disabilitata</strong><br />» %s',
	'LOG_EXT_PURGE'		=> '<strong>Dati estensione eliminati</strong><br />» %s',
	'LOG_EXT_UPDATE'	=> '<strong>Estensione aggiornata</strong><br />» %s',
));
