<?php
/**
 *
 * This file is part of the phpBB Forum Software package.
 *
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 * @copyright (c) 2018 phpBB-Store.it <https://www.phpbb-store.it>
 * @copyright (c) 2021 phpBB-Italia.it <https://www.phpbb-italia.it>
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

// Common installer pages
$lang = array_merge($lang, array(
	'INSTALL_PANEL'	=> 'Pannello d’installazione',
	'SELECT_LANG'	=> 'Seleziona lingua',

	'STAGE_INSTALL'	=> 'Installazione di phpBB',

	// Introduction page
	'INTRODUCTION_TITLE'	=> 'Introduzione',
	'INTRODUCTION_BODY'		=> 'Benvenuto su phpBB3!<br /><br />phpBB® è la soluzione open source per Forum più utilizzata al mondo. phpBB3 è la più recente edizione di una storia iniziata nel 2000. Come i suoi predecessori il software phpBB3 è ricco di nuove caratteristiche, di facile utilizzo e completamente supportato dal Team di phpBB. Sono molti i miglioramenti apportati dalla versione phpBB2, che vanno ad integrare caratteristiche molto richieste e non presenti nella precedente versione. Speriamo che sia anche più di quello che ti aspettavi.<br /><br />Questa procedura guidata è stata studiata per aiutarti durante l’installazione di phpBB3, l’aggiornamento all’ultima versione da precedenti release di phpBB3, ed anche convertire a phpBB3 altri sistemi di Forum di discussione (incluso phpBB2). Per altre informazioni ti suggeriamo di leggere <a href="%1$s">la guida all’installazione</a>.<br /><br />Per leggere la licenza d’uso di phpBB3 o scoprire come ottenere aiuto e supporto, seleziona l’opzione corretta dal menu a lato. Per continuare seleziona in alto la sezione appropriata.',

	// Support page
	'SUPPORT_TITLE'		=> 'Supporto',
	'SUPPORT_BODY'		=> 'Supporto completo viene fornito per la versione più recente di phpBB3 su phpBB.com (in Inglese) e su phpBB-Italia.it (in Italiano). Questo include problemi relativi a:</p><ul><li>installazione</li><li>configurazione</li><li>questioni tecniche</li><li>possibili bug nel software</li><li>aggiornamento da Release Candidate (RC) all’ultima versione stabile</li><li>conversione da phpBB 2.0.x a phpBB3</li><li>conversione da altri software per forum a phpBB3 (vedere in particolare i <a href="https://www.phpbb.com/community/viewforum.php?f=486">Convertitori per Forum</a>, in inglese)</li></ul><p>Invitiamo gli utenti che utilizzano ancora versioni beta di phpBB3 a sostituire la loro installazione con una nuova copia della versione più recente.</p><h2>Estensioni / Stili</h2><p>Per questioni relative alle Estensioni, consultate gli appropriati forum su <a href="https://www.phpbb-italia.it">phpBB-Italia.it</a> o <a href="https://www.phpbb.com/community/viewforum.php?f=451">phpBB.com</a>.<br />Analogamente per gli stili, template e temi, consultate i relativi forum su <a href="https://www.phpbb-italia.it">phpBB-Italia.it</a> o <a href="https://www.phpbb.com/community/viewforum.php?f=471">phpBB.com</a>.<br /><br />Se le domande riguardano una specifica estensione o uno specifico stile, scrivi direttamente nell’argomento dedicato a quella estensione o a quello stile su phpBB.com o phpBB-Italia.it.</p><h2>Come ottenere supporto su phpBB-Italia.it</h2><p><a href="https://www.phpbb-italia.it/guide2/">Guide e FAQ su phpBB3</a><br /><a href="https://www.phpbb-italia.it/supporto-phpbb-3-2-x/">Forum con informazioni e supporto</a>.</p><h2>Come ottenere supporto su phpBB.com (in Inglese)</h2><p><a href="https://www.phpbb.com/community/viewtopic.php?f=14&amp;t=571070">Risorse e riferimenti</a><br /><a href="https://www.phpbb.com/support/">Sezione di supporto</a><br /><a href="https://www.phpbb.com/support/docs/en/3.3/ug/quickstart/">Quick Start Guide</a><br /><br />Per essere sempre aggiornato sulle ultime novità, seguici su <a href="https://www.twitter.com/phpbb/">Twitter</a> o su <a href="https://www.facebook.com/phpbb/">Facebook</a><br /><br />',

	// License
	'LICENSE_TITLE'		=> 'General Public License',

	// Install page
	'INSTALL_INTRO'			=> 'Benvenuti nell’Installazione',
	'INSTALL_INTRO_BODY'	=> 'Con questa opzione è possibile installare phpBB3 sul vostro server.</p><p>Per poter installare phpBB avrai bisogno dei dati di accesso al tuo database, che ti sono stati forniti dal gestore del servizio di hosting. Se non sei in possesso di questi dati NON procedere con l’installazione; scrivi al servizio di posta elettronica del tuo fornitore di hosting chiedendo le chiavi di accesso al database. È necessario conoscere:</p>
	
	<ul>
		<li>Il tipo di database in uso.</li>
		<li>Il database del server hostname o DSN - l’indirizzo del server su cui risiede il database.</li>
		<li>La porta del server - del database server (nella maggior parte dei casi non è richiesta).</li>
		<li>Il nome del database - il nome del database sul server</li>
		<li>l nome utente e la password - i dati di accesso al tuo database</li>
	</ul>

	<p><strong>N.B.:</strong> se stai installando con SQLite, devi inserire il percorso completo al file del tuo database nel campo DSN e lasciare i campi nome utente e password vuoti. Per motivi di sicurezza assicurati che il file del database non sia memorizzato in una posizione accessibile da web.</p>

	<p>phpBB3 supporta i seguenti database:</p>
	<ul>
		<li>MySQL 4.1.3 o successivo (MySQLi richiesto)</li>
		<li>PostgreSQL 8.3+</li>
		<li>SQLite 3.6.15+</li>
		<li>MS SQL Server 2000 o successivo (direttamente o via ODBC)</li>
		<li>MS SQL Server 2005 o successivo (nativo)</li>
		<li>Oracle</li>
	</ul>

	<p>Saranno visualizzati solo i tipi di database supportati sul tuo server.',

	'ACP_LINK'	=> 'Vai al <a href="%1$s">PCA</a>',

	'INSTALL_PHPBB_INSTALLED'		=> 'phpBB è già stato installato.',
	'INSTALL_PHPBB_NOT_INSTALLED'	=> 'phpBB non è ancora stato installato.'
));

// Requirements translation
$lang = array_merge($lang, array(
	// Filesystem requirements
	'FILE_NOT_EXISTS'						=> 'Il file non esiste',
	'FILE_NOT_EXISTS_EXPLAIN'				=> 'Per poter installare phpBB, il file %1$s deve esistere.',
	'FILE_NOT_EXISTS_EXPLAIN_OPTIONAL'		=> 'Il file %1$s, deve esistere, per una corretta funzionalità del Forum.',
	'FILE_NOT_WRITABLE'						=> 'Il file non è scrivibile',
	'FILE_NOT_WRITABLE_EXPLAIN'				=> 'Per poter installare phpBB, il file %1$s deve essere scrivibile.',
	'FILE_NOT_WRITABLE_EXPLAIN_OPTIONAL'	=> 'Il file %1$s, deve essere scrivibile, per una corretta funzionalità del Forum.',

	'DIRECTORY_NOT_EXISTS'						=> 'La cartella non esiste',
	'DIRECTORY_NOT_EXISTS_EXPLAIN'				=> 'Per poter installare phpBB, la cartella %1$s deve esistere..',
	'DIRECTORY_NOT_EXISTS_EXPLAIN_OPTIONAL'		=> 'La cartella %1$s, deve esistere, per una corretta funzionalità del Forum.',
	'DIRECTORY_NOT_WRITABLE'					=> 'La cartella non è scrivibile',
	'DIRECTORY_NOT_WRITABLE_EXPLAIN'			=> 'Per poter installare phpBB, la cartella %1$s deve essere scrivibile.',
	'DIRECTORY_NOT_WRITABLE_EXPLAIN_OPTIONAL'	=> 'La cartella %1$s, deve essere scrivibile, per una corretta funzionalità del Forum.',

	// Server requirements
	'PHP_VERSION_REQD'					=> 'Versione PHP',
	'PHP_VERSION_REQD_EXPLAIN'			=> 'phpBB richiede PHP versione 7.2.0 o successiva.',
	'PHP_GETIMAGESIZE_SUPPORT'			=> 'La funzione PHP getimagesize() è disponibile',
	'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'	=> 'Perché phpBB funzioni correttamente, la funzione getimagesize deve essere abilitata',
	'PCRE_UTF_SUPPORT'					=> 'Supporto PCRE UTF-8',
	'PCRE_UTF_SUPPORT_EXPLAIN'			=> 'phpBB non funzionerà se il tuo PHP non è compilato con supporto UTF-8 nell’estensione PCRE.',
	'PHP_JSON_SUPPORT'					=> 'Supporto PHP JSON',
	'PHP_JSON_SUPPORT_EXPLAIN'			=> 'Per un corretto funzionamento del phpBB, l’estensione PHP JSON deve essere abilitata.',
	'PHP_MBSTRING_SUPPORT'				=> 'Supporto per mbstring PHP',
	'PHP_MBSTRING_SUPPORT_EXPLAIN'		=> 'Affinché phpBB funzioni correttamente, deve essere disponibile l’estensione PHP mbstring.',
	'PHP_XML_SUPPORT'					=> 'Supporto PHP XML/DOM',
	'PHP_XML_SUPPORT_EXPLAIN'			=> 'Affinché phpBB sia eseguito correttamente, l’estensione PHP XML/DOM deve essere disponibile.',
	'PHP_SUPPORTED_DB'					=> 'Database supportati',
	'PHP_SUPPORTED_DB_EXPLAIN'			=> 'Devi supportare almeno un database compatibile all’interno di PHP. Se nessun modulo database viene visualizzato come disponibile dovresti contattare il tuo fornitore o esaminare la documentazione di installazione PHP relativa per avere dei suggerimenti.',

	'RETEST_REQUIREMENTS'	=> 'Ripeti la verifica requisiti',

	'STAGE_REQUIREMENTS'	=> 'Verifica i requisiti'
));

// General error messages
$lang = array_merge($lang, array(
	'INST_ERR_MISSING_DATA'		=> 'Devi completare tutti i campi di questo blocco.',

	'TIMEOUT_DETECTED_TITLE'	=> 'Il programma di installazione ha rilevato un timeout',
	'TIMEOUT_DETECTED_MESSAGE'	=> 'Il programma di installazione ha rilevato un timeout; si può tentare di aggiornare la pagina che può portare alla corruzione dei dati. Ti suggeriamo di aumentare le impostazioni di timeout oppure prova ad utilizzare il CLI (Command Line Interface), [Interfaccia Linea di Comando].',
));

// Data obtaining translations
$lang = array_merge($lang, array(
	'STAGE_OBTAIN_DATA'	=> 'Impostazione dati installazione',

	//
	// Admin data
	//
	'STAGE_ADMINISTRATOR'	=> 'Dettagli Amministratore',

	// Form labels
	'ADMIN_CONFIG'				=> 'Configurazione amministratore',
	'ADMIN_PASSWORD'			=> 'Password amministratore',
	'ADMIN_PASSWORD_CONFIRM'	=> 'Conferma password amministratore',
	'ADMIN_PASSWORD_EXPLAIN'	=> 'La password deve contenere un minimo di 6 ed un massimo di 30 caratteri.',
	'ADMIN_USERNAME'			=> 'Nome utente amministratore',
	'ADMIN_USERNAME_EXPLAIN'	=> 'Il nome utente deve contenere un minimo di 3 ed un massimo di 20 caratteri.',

	// Errors
	'INST_ERR_EMAIL_INVALID'		=> 'L’indirizzo email che hai inserito non è valido.',
	'INST_ERR_PASSWORD_MISMATCH'	=> 'Le password che hai inserito non coincidono.',
	'INST_ERR_PASSWORD_TOO_LONG'	=> 'La password che hai inserito è troppo lunga. La lunghezza massima è di 30 caratteri.',
	'INST_ERR_PASSWORD_TOO_SHORT'	=> 'La password che hai inserito è troppo corta. La lunghezza minima è di 6 caratteri.',
	'INST_ERR_USER_TOO_LONG'		=> 'l nome utente che hai inserito è troppo lungo. La lunghezza massima è di 20 caratteri.',
	'INST_ERR_USER_TOO_SHORT'		=> 'Il nome utente che hai inserito è troppo corto. La lunghezza minima è di 3 caratteri.',

	//
	// Board data
	//
	// Form labels
	'BOARD_CONFIG'		=> 'Configurazione Board',
	'DEFAULT_LANGUAGE'	=> 'Lingua predefinita',
	'BOARD_NAME'		=> 'Nome Board',
	'BOARD_DESCRIPTION'	=> 'Breve descrizione della Board',

	//
	// Database data
	//
	'STAGE_DATABASE'	=> 'Impostazioni Database',

	// Form labels
	'DB_CONFIG'				=> 'Configurazione database',
	'DBMS'					=> 'Tipo database',
	'DB_HOST'				=> 'Hostname server del database o DSN',
	'DB_HOST_EXPLAIN'		=> 'DSN è l’acronimo di <em>Data Source Name</em> (Dati Nome Sorgente) ed è rilevante solo per l’installazione ODBC. Sul PostgreSQL, utilizzare localhost per connettersi al server locale attraverso il socket del dominio UNIX e 127.0.0.1 per connettersi tramite TCP. Per SQLite, inserire il percorso completo del database.',
	'DB_PORT'				=> 'Porta server del database',
	'DB_PORT_EXPLAIN'		=> 'Lascia questo spazio vuoto a meno che tu non sappia che il server opera su una porta non-standard.',
	'DB_PASSWORD'			=> 'Password database',
	'DB_NAME'				=> 'Nome database',
	'DB_USERNAME'			=> 'Nome utente database',
	'DATABASE_VERSION'		=> 'Versione del database',
	'TABLE_PREFIX'			=> 'Prefisso delle tabelle nel database',
	'TABLE_PREFIX_EXPLAIN'	=> 'Il prefisso deve iniziare con una lettera e deve contenere solo lettere, numeri e underscore (trattini bassi).',

	// Database options
	'DB_OPTION_MSSQL_ODBC'	=> 'MSSQL Server 2000+ via ODBC',
	'DB_OPTION_MSSQLNATIVE'	=> 'MSSQL Server 2005+ [ Nativo ]',
	'DB_OPTION_MYSQLI'		=> 'MySQL con estensione MySQLi',
	'DB_OPTION_ORACLE'		=> 'Oracle',
	'DB_OPTION_POSTGRES'	=> 'PostgreSQL',
	'DB_OPTION_SQLITE3'		=> 'SQLite 3',

	// Errors
	'INST_ERR_DB'					=> 'Errore installazione database',
	'INST_ERR_NO_DB'				=> 'Impossibile caricare il modulo PHP per il tipo di database selezionato.',
	'INST_ERR_DB_INVALID_PREFIX'	=> 'Il prefisso inserito non è valido. Si deve iniziare con una lettera e deve contenere solo lettere, numeri e underscore (trattini bassi).',
	'INST_ERR_PREFIX_TOO_LONG'		=> 'Il prefisso tabella specificato è troppo lungo. La lunghezza massima è di %d caratteri.',
	'INST_ERR_DB_NO_NAME'			=> 'Nessun nome database specificato.',
	'INST_ERR_DB_FORUM_PATH'		=> 'Il file del database che hai specificato si trova nella cartella della tua Board. Devi mettere questo file in una zona non accessibile da web.',
	'INST_ERR_DB_CONNECT'			=> 'Impossibile collegarsi al database, controlla il messaggio d’errore qui sotto.',
	'INST_ERR_DB_NO_WRITABLE'		=> 'Sia il database che la cartella che lo contengono devono essere scrivibili.',
	'INST_ERR_DB_NO_ERROR'			=> 'Nessun messaggio d’errore restituito.',
	'INST_ERR_PREFIX'				=> 'Esistono già tabelle con il prefisso specificato, scegli un’alternativa.',
	'INST_ERR_DB_NO_MYSQLI'			=> 'La versione di MySQL installata su questa macchina è incompatibile con l’opzione “MySQL con estensione MySQLi” selezionata. In alternativa prova l’opzione “MySQL”.',
	'INST_ERR_DB_NO_SQLITE3'		=> 'La versione dell’estensione SQLite che hai installato è troppo vecchia e deve essere aggiornata almeno alla 3.6.15.',
	'INST_ERR_DB_NO_ORACLE'			=> 'La versione di Oracle installata su questa macchina necessita che si imposti il parametro <var>NLS_CHARACTERSET</var> su <var>UTF8</var>. Modifica il parametro oppure aggiorna la tua installazione alla 9.2+.',
	'INST_ERR_DB_NO_POSTGRES'		=> 'Il database che hai selezionato non è stato creato con codifica <var>UNICODE</var> o <var>UTF8</var>. Prova ad installare un database con codifica <var>UNICODE</var> o <var>UTF8</var>.',
	'INST_SCHEMA_FILE_NOT_WRITABLE'	=> 'Il file dello schema non è scrivibile',

	//
	// Email data
	//
	'EMAIL_CONFIG'	=> 'Configurazione email',

	// Package info
	'PACKAGE_VERSION'					=> 'Versione del pacchetto installata',
	'UPDATE_INCOMPLETE'				=> 'L’installazione di phpBB non è stata correttamente aggiornata.',
	'UPDATE_INCOMPLETE_MORE'		=> 'Leggi le informazioni qui di seguito, al fine di correggere questo errore.',
	'UPDATE_INCOMPLETE_EXPLAIN'		=> '<h1>Aggiornamento incompleto</h1>

		<p>Abbiamo notato che l’ultimo aggiornamento dell’installazione di phpBB non è stato completato. Clicca su <a href="%1$s" title="%1$s">aggiornamento del database</a>, assicurandoti che <em>solo aggiornamento del database</em> sia selezionato e clicca su <strong>Invia</strong>. Non dimenticare di cancellare la cartella "install" dopo aver aggiornato con successo il database.</p>',

	//
	// Server data
	//
	// Form labels
	'UPGRADE_INSTRUCTIONS'			=> 'È disponibile la nuova versione <strong>%1$s</strong>. Leggi <a href="%2$s" title="%2$s"><strong>l’annuncio di rilascio</strong></a> per conoscere ciò che ha da offrire e come aggiornare.',
	'SERVER_CONFIG'				=> 'Configurazione del server',
	'SCRIPT_PATH'				=> 'Percorso script',
	'SCRIPT_PATH_EXPLAIN'		=> 'Il percorso dove è situato phpbb relativo al nome di dominio, es. <samp>/phpBB3</samp>',
));

// Default database schema entries...
$lang = array_merge($lang, array(
	'CONFIG_BOARD_EMAIL_SIG'		=> 'Grazie, l’amministrazione',
	'CONFIG_SITE_DESC'				=> 'Un breve testo per descrivere il tuo forum',
	'CONFIG_SITENAME'				=> 'tuodominio.it',

	'DEFAULT_INSTALL_POST'			=> '<t>Questo è un messaggio di esempio nella tua installazione di phpBB3. Ogni cosa sembra funzionare. Se vuoi, puoi cancellare questo messaggio e continuare a configurare il tuo forum. Durante il processo di installazione, alla tua prima categoria e al tuo primo forum è stato assegnato un opportuno set di permessi per i gruppi predefiniti (amministratori, bot, moderatori globali, ospiti, utenti registrati, utenti COPPA). Se decidi di cancellare il primo forum e la prima categoria, ricordati di assegnare i permessi a tutti questi gruppi per ogni categoria e ogni forum che viene creato. Raccomandiamo di rinominare la tua prima categoria e il tuo primo forum e di copiare i permessi da questi quando si creano nuove categorie e nuovi forum. Buon divertimento!</t>',

	'FORUMS_FIRST_CATEGORY'			=> 'La tua prima categoria',
	'FORUMS_TEST_FORUM_DESC'		=> 'Descrizione del tuo primo forum.',
	'FORUMS_TEST_FORUM_TITLE'		=> 'Il tuo primo forum',

	'RANKS_SITE_ADMIN_TITLE'		=> 'Amministratore',
	'REPORT_WAREZ'					=> 'Il messaggio contiene collegamenti a software illegali o pirata.',
	'REPORT_SPAM'					=> 'Il messaggio segnalato ha l’unico scopo di fare pubblicità ad un sito web o un altro prodotto.',
	'REPORT_OFF_TOPIC'				=> 'Il messaggio segnalato è Off topic.',
	'REPORT_OTHER'					=> 'Il messaggio segnalato non si adatta in altre categorie, usa il campo descrizione.',

	'SMILIES_ARROW'					=> 'Arrow',
	'SMILIES_CONFUSED'				=> 'Confused',
	'SMILIES_COOL'					=> 'Cool',
	'SMILIES_CRYING'				=> 'Crying or Very Sad',
	'SMILIES_EMARRASSED'			=> 'Embarrassed',
	'SMILIES_EVIL'					=> 'Evil or Very Mad',
	'SMILIES_EXCLAMATION'			=> 'Exclamation',
	'SMILIES_GEEK'					=> 'Geek',
	'SMILIES_IDEA'					=> 'Idea',
	'SMILIES_LAUGHING'				=> 'Laughing',
	'SMILIES_MAD'					=> 'Mad',
	'SMILIES_MR_GREEN'				=> 'Mr. Green',
	'SMILIES_NEUTRAL'				=> 'Neutral',
	'SMILIES_QUESTION'				=> 'Question',
	'SMILIES_RAZZ'					=> 'Razz',
	'SMILIES_ROLLING_EYES'			=> 'Rolling Eyes',
	'SMILIES_SAD'					=> 'Sad',
	'SMILIES_SHOCKED'				=> 'Shocked',
	'SMILIES_SMILE'					=> 'Smile',
	'SMILIES_SURPRISED'				=> 'Surprised',
	'SMILIES_TWISTED_EVIL'			=> 'Twisted Evil',
	'SMILIES_UBER_GEEK'				=> 'Uber Geek',
	'SMILIES_VERY_HAPPY'			=> 'Very Happy',
	'SMILIES_WINK'					=> 'Wink',

	'TOPICS_TOPIC_TITLE'			=> 'Benvenuto su phpBB3',
));

// Common navigation items' translation
$lang = array_merge($lang, array(
	'MENU_OVERVIEW'		=> 'Panoramica',
	'MENU_INTRO'		=> 'Introduzione',
	'MENU_LICENSE'		=> 'Licenza',
	'MENU_SUPPORT'		=> 'Supporto',
));

// Task names
$lang = array_merge($lang, array(
	// Install filesystem
	'TASK_CREATE_CONFIG_FILE'	=> 'Creazione del file di configurazione',

	// Install database
	'TASK_ADD_CONFIG_SETTINGS'			=> 'Aggiunta delle impostazioni di configurazione',
	'TASK_ADD_DEFAULT_DATA'				=> 'Aggiunta delle impostazioni predefinite per il database',
	'TASK_ADD_CONFIG_SETTINGS'			=> 'Aggiunta delle impostazioni di configurazione',
	'TASK_ADD_DEFAULT_DATA'				=> 'Aggiunta delle impostazioni predefinite per il database',
	'TASK_CREATE_DATABASE_SCHEMA_FILE'	=> 'Creazione del file dello schema del database',
	'TASK_SETUP_DATABASE'				=> 'Impostazione del database',
	'TASK_CREATE_TABLES'				=> 'Creazione delle tabelle',

	// Install data
	'TASK_ADD_BOTS'			=> 'Registrazione motori di ricerca',
	'TASK_ADD_LANGUAGES'	=> 'Installazione lingue disponibili',
	'TASK_ADD_MODULES'		=> 'Installazione moduli',
	'TASK_CREATE_SEARCH_INDEX'	=> 'Creazione dell’Indice di ricerca',

	// Install finish tasks
	'TASK_INSTALL_EXTENSIONS'	=> 'Installazione delle estensioni disponibili',
	'TASK_NOTIFY_USER'			=> 'Invio email di notifica',
	'TASK_POPULATE_MIGRATIONS'	=> 'Compilazione migrazioni',

	// Installer general progress messages
	'INSTALLER_FINISHED'	=> 'Il programma di installazione è stato completato con successo',
));

// Installer's general messages
$lang = array_merge($lang, array(
	'MODULE_NOT_FOUND'				=> 'Modulo non trovato',
	'MODULE_NOT_FOUND_DESCRIPTION'	=> 'Un modulo non è stato trovato perché il servizio, %s, non è stato definito.',

	'TASK_NOT_FOUND'				=> 'Operazione non trovata',
	'TASK_NOT_FOUND_DESCRIPTION'	=> 'Non è stata trovata un’operazione perché il servizio, %s, non è stato definito.',

	'SKIP_MODULE'	=> 'Salta “%s” modulo',
	'SKIP_TASK'		=> 'Salta “%s” operazione',

	'TASK_SERVICE_INSTALLER_MISSING'	=> 'Tutti i servizi di attività del programma di installazione dovrebbero iniziare con “Installa”',
	'TASK_CLASS_NOT_FOUND'				=> 'La definizione del servizio attività del programma di installazione non è valida. Nome del servizio “%1$s” data, lo spazio dei nomi di classe previsto è “%2$s” per questo. Per ulteriori informazioni si prega di consultare la documentazione dell’operazione dell’interfaccia.',

	'INSTALLER_CONFIG_NOT_WRITABLE'	=> 'Il file di configurazione del programma di installazione non è scrivibile.',
));

// CLI messages
$lang = array_merge($lang, array(
	'CLI_INSTALL_BOARD'				=> 'Installa phpBB',
	'CLI_UPDATE_BOARD'				=> 'Aggiorna phpBB',
	'CLI_INSTALL_SHOW_CONFIG'		=> 'Mostra la configurazione che verrà utilizzata',
	'CLI_INSTALL_VALIDATE_CONFIG'	=> 'Convalida un file di configurazione',
	'CLI_CONFIG_FILE'				=> 'File di configurazione da utilizzare',
	'MISSING_FILE'					=> 'Impossibile accedere al file %1$s',
	'MISSING_DATA'					=> 'File di configurazione mancante di dati o contenente impostazioni non valide.',
	'INVALID_YAML_FILE'				=> 'Impossibile analizzare il file YAML %1$s',
	'CONFIGURATION_VALID'			=> 'Il file di configurazione è valido',
));

// Common updater messages
$lang = array_merge($lang, array(
	'UPDATE_INSTALLATION'			=> 'Aggiornamento installazione phpBB',
	'UPDATE_INSTALLATION_EXPLAIN'	=> 'Con questa opzione è possibile aggiornare all’ultima versione l’installazione del tuo phpBB.<br />Durante il processo saranno controllati tutti i tuoi file per la loro integrità. Potrai esaminare tutte le differenze e i file prima dell’aggiornamento.<br /><br />L’aggiornamento dei file può essere fatto in due modi diversi.</p><h2>Aggiornamento Manuale</h2><p> Con questo aggiornamento scarichi solo i tuoi file modificati, per assicurarti di non perdere le modifiche che potresti avere apportato ai file. Dopo aver scaricato questo pacchetto devi caricare manualmente i file nella loro posizione corretta nella cartella "principale" del tuo phpBB. Una volta fatto questo, potrai eseguire nuovamente un controllo sui file per vedere se sono stati spostati nella cartella corretta.</p><h2>Aggiornamento avanzato con FTP</h2><p>Questo metodo è simile al primo ma senza la necessità di scaricare i file modificati e di caricarli da soli. Verrà fatto in automatico. Per utilizzare questo metodo devi conoscere i tuoi dati di accesso FTP poiché ti verranno richiesti. Appena terminato, sarai reindirizzato nuovamente al controllo dei file per assicurarti che tutto sia stato aggiornato correttamente.<br /><br />',
	'UPDATE_INSTRUCTIONS'			=> '

		<h1>Annuncio di rilascio</h1>

		<p>Ti si invita a leggere l’annuncio di rilascio per la versione più recente prima di continuare il processo di aggiornamento; può contenere informazioni utili. Esso contiene inoltre tutti i link per il download e lo storico delle modifiche.</p>

		<br />
		
		<h1>Come aggiornare la tua installazione con il pacchetto di Aggiornamento completo</h1>

		<p>Il metodo consigliato di aggiornare la tua installazione è quello tramite l’utilizzo del pacchetto completo. Se i file core phpBB sono stati modificati nell’installazione, allora potresti utilizzare il pacchetto di aggiornamento avanzato per non perdere queste modifiche. È inoltre possibile aggiornare l’installazione utilizzando gli altri metodi elencati nel documento INSTALL.html. I passaggi per l’aggiornamento di phpBB3 usando il pacchetto completo sono:</p>

		<ol style="margin-left: 20px; font-size: 1.1em;">
			<li><strong class="error">Esegui il backup di tutti i file e del database.</strong></li>
			<li>Vai a <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">pagina di download su phpBB.com</a> e scarica l’ultimo "Pacchetto completo" di installazione.</li>
			<li>Decomprimi l’archivio.</li>
			<li>Rimuovi il file <code class="inline">config.php</code> , e le cartelle <code class="inline">/images</code>, <code class="inline">/store</code> e <code class="inline">/files</code> <em>dal pacchetto di installazione</em> (non dal tuo sito).</li>
			<li>Vai su PCA, Personalizzazioni, Stili e assicurati che il prosilver sia impostato come stile predefinito. In caso contrario, impostalo su prosilver.</li>
			<li>Elimina le cartelle <code class="inline">/vendor</code> e <code class="inline">/cache</code> dalla radice sul tuo spazio host.</li>
			<li>Tramite FTP o SSH, caricare i file e le cartelle rimanenti (ovvero il CONTENUTO rimanente della cartella phpBB3) nella cartella principale dell’installazione del forum sul server, sovrascrivendo i file esistenti. (Nota: Fai attenzione a non eliminare alcuna estensione nella tua cartella <code class="inline">/ext</code> durante il caricamento dei nuovi file di phpBB3.)</li>
			<li><strong><a href="%1$s" title="%1$s">Adesso avvia il processo di aggiornamento puntando il browser nella cartella di installazione</a>.</strong></li>
			<li>Seguire i passaggi per aggiornare il database ed attendere fino al completamento.</li>
			<li>Tramite FTP o SSH elimina la cartella <code class="inline">/install</code> dalla radice dove è installato il forum.<br><br></li>
		</ol>
		
		<p>Adesso hai un nuovo Forum aggiornato e contenente tutti i tuoi utenti e messaggi. Attività successive:</p>
		<ul style="margin-left: 20px; font-size: 1.1em;">
			<li>Aggiorna il tuo language pack</li>
			<li>Aggiorna il tuo style<br><br></li>
		</ul>

		<h1>Come aggiornare la tua installazione con il Pacchetto di Aggiornamento Avanzato</h1>

		<p>Il pacchetto di aggiornamento avanzato è consigliato solo per utenti esperti nel caso in cui i file phpBB di base siano stati modificati durante l’installazione. Puoi aggiornare la tua installazione anche con altri metodi e li trovi elencati nel file INSTALL.html. La procedura per aggiornare tramite il pacchetto di aggiornamento avanzato è:</p>

		<ol style="margin-left: 20px; font-size: 1.1em;">
			<li>Vai alla <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">pagina di download di phpBB.com</a> e scarica il Pacchetto di Aggiornamento Avanzato (Advanced Update Package).<br /><br /></li>
			<li>Decomprimi l’archivio.<br /><br /></li>
			<li>Invia le parti decompresse complete delle cartelle install e vendor, alla radice del tuo phpBB (ovvero dove si trova il file config.php).<br /><br /></li>
		</ol>

		<p>Una volta inviati i file, la tua Board risulterà Off-Line per gli utenti normali a causa della cartella di installazione che hai appena caricato.<br /><br />
		<strong><a href="%1$s" title="%1$s">Avvia il processo di aggiornamento indirizzando il tuo browser verso la cartella di installazione</a>.</strong><br />
		<br />
		Verrai guidato attraverso il processo di aggiornamento. Sarai informato quando l’aggiornamento sarà completato.
		</p>
	',
));

// Updater forms
$lang = array_merge($lang, array(
	// Updater types
	'UPDATE_TYPE'			=> 'Tipo di aggiornamento per l’esecuzione',

	'UPDATE_TYPE_ALL'		=> 'Aggiornamento file System e database',
	'UPDATE_TYPE_DB_ONLY'	=> 'Aggiorna solo il database',

	// File updater methods
	'UPDATE_FILE_METHOD_TITLE'		=> 'Metodi di aggiornamento del file',

	'UPDATE_FILE_METHOD'			=> 'Metodo di aggiornamento di file',
	'UPDATE_FILE_METHOD_DOWNLOAD'	=> 'Scarica i file modificati in un archivio',
	'UPDATE_FILE_METHOD_FTP'		=> 'File di aggiornamento tramite FTP (automatico)',
	'UPDATE_FILE_METHOD_FILESYSTEM'	=> 'File di aggiornamento tramite accesso diretto ai file (automatico)',

	// File updater archives
	'SELECT_DOWNLOAD_FORMAT'	=> 'Seleziona il formato dell’archivio per il download',

	// FTP settings
	'FTP_SETTINGS'			=> 'Impostazioni FTP',
));

// Requirements messages
$lang = array_merge($lang, array(
	'UPDATE_FILES_NOT_FOUND'	=> 'Nessuna cartella di aggiornamento valida è stata trovata; assicurati di aver caricato i file in questione.',

	'NO_UPDATE_FILES_UP_TO_DATE'	=> 'La versione è aggiornata. Non vi è alcuna necessità di eseguire lo strumento di aggiornamento. Se si vuole fare un controllo di integrità sui file, assicurati di aver caricato i file di aggiornamento corretti.',
	'OLD_UPDATE_FILES'				=> 'I file di aggiornamento sono obsoleti. I file di aggiornamento trovati sono per l’aggiornamento da phpBB %1$s al phpBB %2$s, ma l’ultima versione di phpBB è %3$s.',
	'INCOMPATIBLE_UPDATE_FILES'		=> 'I file di aggiornamento rilevati sono incompatibili con la versione attualmente installata. La versione installata è %1$s mentre i file di aggiornamento sono per phpBB %2$s a %3$s.',
));

// Update files
$lang = array_merge($lang, array(
	'STAGE_UPDATE_FILES'		=> 'Aggiornamento file',

	// Check files
	'UPDATE_CHECK_FILES'	=> 'Controllare i file per l’aggiornamento',

	// Update file differ
	'FILE_DIFFER_ERROR_FILE_CANNOT_BE_READ'	=> 'Il file di differenziazione non riuscito ad aprire %s.',

	'UPDATE_FILE_DIFF'		=> 'File di differenziazione modificato',
	'ALL_FILES_DIFFED'		=> 'Tutti i file differenziati sono stati modificati.',

	// File status
	'UPDATE_CONTINUE_FILE_UPDATE'	=> 'File di aggiornamento',

	'DOWNLOAD'							=> 'Download',
	'DOWNLOAD_CONFLICTS'				=> 'Download unione conflitti archivio',
	'DOWNLOAD_CONFLICTS_EXPLAIN'		=> 'Cerca &lt;&lt;&lt; per individuare i conflitti',
	'DOWNLOAD_UPDATE_METHOD'			=> 'Download archivio file modificati',
	'DOWNLOAD_UPDATE_METHOD_EXPLAIN'	=> 'Una volta scaricato devi decomprimere l’archivio. All’interno troverai i file modificati che devi caricare nella tua cartella di phpBB. Dopo che hai caricato tutti i file controllali di nuovo con l’altro bottone qui sotto.',

	'FILE_ALREADY_UP_TO_DATE'		=> 'Il file è già aggiornato.',
	'FILE_DIFF_NOT_ALLOWED'			=> 'File non abilitato per il diff mode.',
	'FILE_USED'						=> 'Informazioni usate da',			// Single file
	'FILES_CONFLICT'				=> 'Conflitto file',
	'FILES_CONFLICT_EXPLAIN'		=> 'I seguenti file sono quelli modificati e non rappresentano i file originali della vecchia versione. PhpBB ha determinato che questi file creano conflitti se si tenta di unirli. Indaga i motivi dei conflitti e prova a risolverli manualmente oppure continua l’aggiornamento scegliendo il metodo di unione preferito. Se risolvi i conflitti manualmente controlla nuovamente il file dopo la modifica. Puoi anche scegliere il metodo preferito di unione per ogni file. Il primo porterà a un file dove le righe di conflitto del vostro vecchio file saranno perse, l’altro porterà alla perdita delle modifiche del nuovo file.',
	'FILES_DELETED'					=> 'File eliminati',
	'FILES_DELETED_EXPLAIN'			=> 'I seguenti file non esistono nella nuova versione. Questi file saranno eliminati dalla tua installazione.',
	'FILES_MODIFIED'				=> 'File modificati',
	'FILES_MODIFIED_EXPLAIN'		=> 'I seguenti file sono quelli modificati e non rappresentano i file originali della vecchia versione. Il file aggiornato sarà un’unione delle tue modifiche e del nuovo file.',
	'FILES_NEW'						=> 'Nuovi file',
	'FILES_NEW_EXPLAIN'				=> 'I seguenti file attualmente non esistono all’interno della tua installazione. Questi file saranno aggiunti alla tua installazione.',
	'FILES_NEW_CONFLICT'			=> 'Nuovi file in conflitto',
	'FILES_NEW_CONFLICT_EXPLAIN'	=> 'I seguenti file fanno parte dell’ultima versione ma è stato rilevato che esiste già un file con lo stesso nome all’interno della stessa posizione. Questo file sarà sovrascritto dal nuovo file.',
	'FILES_NOT_MODIFIED'			=> 'File non modificati',
	'FILES_NOT_MODIFIED_EXPLAIN'	=> 'I seguenti file non sono modificati e rappresentano i file originali della versione di phpBB da cui vuoi aggiornare.',
	'FILES_UP_TO_DATE'				=> 'File già aggiornati',
	'FILES_UP_TO_DATE_EXPLAIN'		=> 'I seguenti file sono già aggiornati, non richiedono aggiornamento.',
	'FILES_VERSION'					=> 'Versione dei file',
	'TOGGLE_DISPLAY'				=> 'Mostra/nascondi elenco file',

	// File updater
	'UPDATE_UPDATING_FILES'	=> 'Aggiornamento dei file',

	'UPDATE_FILE_UPDATER_HAS_FAILED'	=> 'L’aggiornamento dei file “%1$s“ non è riuscito. Il programma di installazione cercherà un fallback per “%2$s“.',
	'UPDATE_FILE_UPDATERS_HAVE_FAILED'	=> 'L’aggiornamento dei file non è riuscito. Non ci sono ulteriori metodi fallback disponibili.',

	'UPDATE_CONTINUE_UPDATE_PROCESS'	=> 'Continua il processo di aggiornamento',
	'UPDATE_RECHECK_UPDATE_FILES'		=> 'Controlla nuovamente i file',
));

// Update database
$lang = array_merge($lang, array(
	'STAGE_UPDATE_DATABASE'		=> 'Aggiornamento del database',

	'INLINE_UPDATE_SUCCESSFUL'	=> 'L’aggiornamento del database è avvenuto correttamente. Adesso devi continuare il processo di aggiornamento.',

	'TASK_UPDATE_EXTENSIONS'	=> 'Aggiornamento estensioni',
));

// Converter
$lang = array_merge($lang, array(
	// Common converter messages
	'CONVERT_NOT_EXIST'			=> 'Il convertitore selezionato non esiste.',
	'DEV_NO_TEST_FILE'			=> 'Nessun valore è stato specificato per la variabile test_file nel convertitore. Se sei un utente di questo convertitore non dovresti vedere questo errore. Sei pregato quindi di segnalarlo all’autore del convertitore. Se sei l’autore del convertitore devi specificare il nome di un file esistente nella Board sorgente per permettere la verifica del percorso ad essa.',
	'COULD_NOT_FIND_PATH'		=> 'Non trovo il percorso precedente della tua Board. Controlla le tue impostazioni e prova di nuovo.<br />» %s era il percorso sorgente specificato.',
	'CONFIG_PHPBB_EMPTY'		=> 'La variabile di configurazione phpBB3 per “%s” è vuota.',

	'MAKE_FOLDER_WRITABLE'		=> 'Assicurati che la cartella esista e sia scrivibile dal webserver e poi riprova:<br />»<strong>%s</strong>.',
	'MAKE_FOLDERS_WRITABLE'		=> 'Assicurati che le cartelle esistano e siano scrivibili dal webserver e poi riprova:<br />»<strong>%s</strong>.',

	'INSTALL_TEST'				=> 'Esegui nuovamente il test',

	'NO_TABLES_FOUND'			=> 'Nessuna tabella individuata.',
	'TABLES_MISSING'			=> 'Impossibile trovare queste tabelle<br />» <strong>%s</strong>.',
	'CHECK_TABLE_PREFIX'		=> 'Controlla il prefisso delle tabelle e riprova.',

	// Conversion in progress
	'CATEGORY'					=> 'Categoria',
	'CONTINUE_CONVERT'			=> 'Continua la conversione',
	'CONTINUE_CONVERT_BODY'		=> 'È stato individuato un precedente tentativo di conversione. Puoi scegliere se iniziare una nuova conversione o continuare con quella vecchia.',
	'CONVERT_NEW_CONVERSION'	=> 'Nuova conversione',
	'CONTINUE_OLD_CONVERSION'	=> 'Continua la conversione precedentemente iniziata',
	'POST_ID'					=> 'ID messaggio',

	// Start conversion
	'SUB_INTRO'					=> 'Introduzione',
	'CONVERT_INTRO'				=> 'Benvenuto su phpBB Unified Convertor Framework',
	'CONVERT_INTRO_BODY'		=> 'Da qui hai la possibilità di importare dati da altri forum (installati). La lista sottostante mostra tutti i moduli di conversione attualmente disponibili. Se la lista non contiene un convertitore per il software dal quale vuoi prelevare i dati, controlla sul nostro sito dove ulteriori moduli di conversione potrebbero essere disponibili.',
	'AVAILABLE_CONVERTORS'		=> 'Convertitori disponibili',
	'NO_CONVERTORS'				=> 'Nessun convertitore disponibile.',
	'CONVERT_OPTIONS'			=> 'Opzioni',
	'SOFTWARE'					=> 'Board software',
	'VERSION'					=> 'Versione',
	'CONVERT'					=> 'Converti',

	// Settings
	'STAGE_SETTINGS'			=> 'Impostazioni',
	'TABLE_PREFIX_SAME'			=> 'Il prefisso della tabella deve essere quello utilizzato dal software da cui state facendo la conversione.<br />» Il prefisso specificato per la tabella era %s.',
	'DEFAULT_PREFIX_IS'			=> 'Il convertitore non è riuscito a trovare le tabelle con il prefisso specificato. Assicurati di aver inserito i dettagli corretti per la Board da cui stai effettuando la conversione. Il prefisso predefinito per la tabella %1$s è <strong>%2$s</strong>.',
	'SPECIFY_OPTIONS'			=> 'Specifica opzioni di conversione',
	'FORUM_PATH'				=> 'Percorso della Board',
	'FORUM_PATH_EXPLAIN'		=> 'Questo è il percorso <strong>relativo</strong> su disco della tua precedente Board dalla <strong>root di installazione del tuo phpBB3</strong>.',
	'REFRESH_PAGE'				=> 'Aggiorna la pagina per continuare la conversione',
	'REFRESH_PAGE_EXPLAIN'		=> 'Se impostato su Sì, il convertitore aggiornerà la pagina per continuare la conversione dopo aver terminato un passaggio. Se questa è la tua prima conversione per scopi di verifica e per determinare qualsiasi errore in anticipo, ti suggeriamo di impostare No.',

	// Conversion
	'STAGE_IN_PROGRESS'			=> 'Conversione in corso',

	'AUTHOR_NOTES'				=> 'Note autore<br />» %s',
	'STARTING_CONVERT'			=> 'Inizio processo di conversione',
	'CONFIG_CONVERT'			=> 'Il sistema sta convertendo la configurazione',
	'DONE'						=> 'Eseguito',
	'PREPROCESS_STEP'			=> 'Esecuzione delle funzioni di pre-elaborazione/query',
	'FILLING_TABLE'				=> 'La tabella <strong>%s</strong> è in fase di riempimento',
	'FILLING_TABLES'			=> 'Tabelle riempite',
	'DB_ERR_INSERT'				=> 'Errore durante il processo della query <code>INSERT</code>.',
	'DB_ERR_LAST'				=> 'Errore durante il processo <var>query_last</var>.',
	'DB_ERR_QUERY_FIRST'		=> 'Errore durante l’esecuzione <var>query_first</var>.',
	'DB_ERR_QUERY_FIRST_TABLE'	=> 'Errore durante l’esecuzione <var>query_first</var>, %s (“%s”).',
	'DB_ERR_SELECT'				=> 'Errore durante l’esecuzione della query <code>SELECT</code>.',
	'STEP_PERCENT_COMPLETED'	=> 'Passaggio <strong>%d</strong> di <strong>%d</strong>',
	'FINAL_STEP'				=> 'Esegui il passaggio finale',
	'SYNC_FORUMS'				=> 'Inizio sincronizzazione forum',
	'SYNC_POST_COUNT'			=> 'Sincronizzazione totale messaggi',
	'SYNC_POST_COUNT_ID'		=> 'Sincronizzazione totale messaggi dalla <var>voce</var> %1$s alla voce %2$s.',
	'SYNC_TOPICS'				=> 'Inizio sincronizzazione degli argomenti',
	'SYNC_TOPIC_ID'				=> 'Sincronizzazione argomenti da <var>id argomento</var> %1$s a %2$s.',
	'PROCESS_LAST'					=> 'Elaborazione delle ultime istruzioni',
	'UPDATE_TOPICS_POSTED'		=> 'Sto elaborando informazioni sugli argomenti inviati',
	'UPDATE_TOPICS_POSTED_ERR'	=> 'Si è verificato un errore durante l’elaborazione delle informazioni sugli argomenti inviati. Puoi ritentare questo passaggio nel PCA dopo che il processo di conversione sarà completato.',
	'CONTINUE_LAST'				=> 'Continua con le ultime impostazioni',
	'CLEAN_VERIFY'				=> 'Pulizia e verifica della struttura finale',
	'NOT_UNDERSTAND'			=> 'Non è possibile interpretare %s #%d, tabella %s (“%s”)',
	'NAMING_CONFLICT'			=> 'Conflitto di nomi: %s e %s sono entrambi degli alias<br /><br />%s',

	// Finish conversion
	'CONVERT_COMPLETE'			=> 'Conversione completata',
	'CONVERT_COMPLETE_EXPLAIN'	=> 'Hai convertito correttamente la tua Board a phpBB 3.3. Puoi effettuare il login e <a href="../">accedere alla tua Board</a>. Assicurati che le impostazioni siano state trasferite correttamente prima di cancellare la cartella d’installazione. Ricorda che l’aiuto sull’uso di phpBB è disponibile online con la <a href="https://www.phpbb.com/support/docs/en/3.3/ug/">Documentazione</a> ed i <a href="https://www.phpbb.com/community/viewforum.php?f=661">forum di supporto</a>.',
	'COLLIDING_CLEAN_USERNAME'			=> '<strong>%s</strong> è il nome utente pulito, per:',
	'COLLIDING_USER'					=> '» id utente: <strong>%d</strong> username: <strong>%s</strong> (%d posts)',
	'COLLIDING_USERNAMES_FOUND'			=> 'Sono stati trovati nomi utente in conflitto sul tuo vecchio Forum. Per completare la conversione, elimina o rinomina questi utenti in modo che ci sia un solo utente sul tuo vecchio Forum per ogni username pulito.',
	'CONV_ERR_FATAL'					=> 'Errore fatale nella conversione',
	
	'CONV_ERROR_ATTACH_FTP_DIR'			=> 'L’invio FTP degli allegati sulla vecchia Board è abilitato. Disabilita l’opzione ed assicurati di specificare una cartella upload valida, infine copia tutti i file allegati a questa cartella (che deve essere accessibile da web). Fatto questo fai ripartire il convertitore..',
	'CONV_ERROR_CONFIG_EMPTY'			=> 'Non ci sono informazioni di configurazione disponibili per la conversione.',
	'CONV_ERROR_FORUM_ACCESS'			=> 'Impossibile ottenere le informazioni d’accesso al Forum.',
	'CONV_ERROR_GET_CATEGORIES'			=> 'Impossibile ottenere le categorie.',
	'CONV_ERROR_GET_CONFIG'				=> 'Impossibile recuperare la configurazione della Board.',
	'CONV_ERROR_COULD_NOT_READ'			=> 'Impossibile accedere/leggere “%s”.',
	'CONV_ERROR_GROUP_ACCESS'			=> 'Impossibile ottenere informazioni di autenticazione di gruppo.',
	'CONV_ERROR_INCONSISTENT_GROUPS'	=> 'Rilevata inconsistenza della tabella gruppi in add_bots() - devi aggiungere tutti i gruppi speciali se lo fai manualmente.',
	'CONV_ERROR_INSERT_BOT'				=> 'Impossibile inserire Bot nella tabella utenti.',
	'CONV_ERROR_INSERT_BOTGROUP'		=> 'Impossibile inserire Bot nella tabella Bot.',
	'CONV_ERROR_INSERT_USER_GROUP'		=> 'Impossibile inserire utenti nella tabellauser_group.',
	'CONV_ERROR_MESSAGE_PARSER'			=> 'Analizzatore del messaggio d’errore',
	'CONV_ERROR_NO_AVATAR_PATH'			=> 'Nota per lo sviluppatore: devi specificare il $convertor[\'avatar_path\'] da utilizzare %s.',
	'CONV_ERROR_NO_FORUM_PATH'			=> 'Il percorso relativo alla Board non è stato specificato.',
	'CONV_ERROR_NO_GALLERY_PATH'		=> 'Nota per lo sviluppatore: devi specificare il $convertor[\'avatar_gallery_path\'] da utilizzare %s.',
	'CONV_ERROR_NO_GROUP'				=> 'Impossibile trovare il gruppo “%1$s” in %2$s.',
	'CONV_ERROR_NO_RANKS_PATH'			=> 'Nota per lo sviluppatore: devi specificare il $convertor[\'ranks_path\'] da utilizzare %s.',
	'CONV_ERROR_NO_SMILIES_PATH'		=> 'Nota per lo sviluppatore: devi specificare il $convertor[\'smilies_path\'] da utilizzare %s.',
	'CONV_ERROR_NO_UPLOAD_DIR'			=> 'Nota per lo sviluppatore: devi specificare il $convertor[\'upload_path\'] da utilizzare %s.',
	'CONV_ERROR_PERM_SETTING'			=> 'Impossibile inserire/aggiornare le impostazioni dei permessi.',
	'CONV_ERROR_PM_COUNT'				=> 'Impossibile selezionare la cartella relativa al conteggio dei pm.',
	'CONV_ERROR_REPLACE_CATEGORY'		=> 'Impossibile inserire una nuova sezione in sostituzione della vecchia categoria.',
	'CONV_ERROR_REPLACE_FORUM'			=> 'Impossibile inserire un nuovo forum in sostituzione del vecchio.',
	'CONV_ERROR_USER_ACCESS'			=> 'Impossibile ottenere informazioni relative all’autenticazione dell’utente.',
	'CONV_ERROR_WRONG_GROUP'			=> 'Gruppo errato “%1$s” definito in %2$s.',
	'CONV_OPTIONS_BODY'					=> 'Questa pagina raccoglie i dati necessari per accedere alla Board di origine. Inserisci i dettagli del database della tua ex Board; il convertitore non cambierà nulla nel database indicato di seguito. La Board di origine dovrebbe essere disattivata per consentire una conversione corretta.',
	'CONV_SAVED_MESSAGES'				=> 'Messaggi salvati',

	'PRE_CONVERT_COMPLETE'			=> 'Tutti i passaggi di pre-conversione sono stati completati correttamente. Ora puoi iniziare il processo di conversione effettivo. È possibile che tu debba adattare manualmente numerosi elementi. Dopo la conversione controlla soprattutto i permessi assegnati, ricostruisci se necessario l’Indice di ricerca e assicurati che i file siano stati copiati correttamente, ad esempio gli avatar e le emoticon.',
));
