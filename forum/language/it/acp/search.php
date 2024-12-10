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
	'ACP_SEARCH_INDEX_EXPLAIN'				=> 'Qui puoi gestire gli Indici del motore di ricerca. Poiché normalmente si utilizza solo un motore di ricerca dovresti cancellare tutti gli Indici di cui non fai uso. Dopo aver modificato alcune delle impostazioni di ricerca (es. il numero minimo o massimo dei caratteri) potrebbe essere utile ricreare l’Indice in modo che rifletta quelle modifiche.',
	'ACP_SEARCH_SETTINGS_EXPLAIN'			=> 'Qui puoi definire quale motore di ricerca sarà utilizzato per l’indicizzazione dei messaggi e per le ricerche. Puoi impostare diverse opzioni che possono influire sull’elaborazione richiesta. Alcune di queste impostazioni sono le stesse per tutti i motori di ricerca.',

	'COMMON_WORD_THRESHOLD'					=> 'Soglia parola comune',
	'COMMON_WORD_THRESHOLD_EXPLAIN'			=> 'Le parole contenute nella maggior parte dei messaggi saranno considerate come parole comuni. Le parole comuni vengono ignorate nelle ricerche. Imposta zero per disabilitare. Questo ha effetto solo se ci sono più di 100 messaggi.',
	'CONFIRM_SEARCH_BACKEND'				=> 'Sei sicuro di voler passare ad un motore di ricerca diverso? Dopo avere modificato il motore di ricerca dovrai creare un Indice per il nuovo motore di ricerca. Se non vuoi tornare al vecchio motore di ricerca puoi anche cancellare l’Indice del vecchio motore di ricerca per liberare risorse di sistema.',
	'CONTINUE_DELETING_INDEX'				=> 'Continua il precedente processo di cancellazione dell’Indice',
	'CONTINUE_DELETING_INDEX_EXPLAIN'		=> 'Avviato processo di cancellazione dell’Indice. Per poter accedere nuovamente alla pagina dell’Indice di ricerca devi prima completarlo.',
	'CONTINUE_INDEXING'						=> 'Continua il precedente processo di indicizzazione',
	'CONTINUE_INDEXING_EXPLAIN'				=> 'Avviato processo di indicizzazione. Per poter accedere nuovamente alla pagina dell’Indice di ricerca devi prima completarlo.',
	'CREATE_INDEX'							=> 'Crea Indice',

	'DEFAULT_SEARCH_RETURN_CHARS'			=> 'Numero predefinito di caratteri restituiti',
	'DEFAULT_SEARCH_RETURN_CHARS_EXPLAIN'	=> 'Il numero predefinito di caratteri che verrà restituito durante la ricerca. Un valore pari a 0 restituirà l’intero messaggio.',
	
	'DELETE_INDEX'							=> 'Cancella Indice',
	'DELETING_INDEX_IN_PROGRESS'			=> 'Eliminazione dell’indice in corso...',
	'DELETING_INDEX_IN_PROGRESS_EXPLAIN'	=> 'Il motore di ricerca sta pulendo il suo Indice. Questo può impiegare alcuni minuti.',

	'FULLTEXT_MYSQL_INCOMPATIBLE_DATABASE'		=> 'Il motore MySQL fulltext può essere utilizzato solo con MySQL4 o superiore.',
	'FULLTEXT_MYSQL_NOT_SUPPORTED'				=> 'Gli Indici MySQL fulltext possono essere utilizzati solo con tabelle MyISAM o InnoDB. MySQL 5.6.8 o successivo è necessario per Indici fulltext su tabelle InnoDB.',
	'FULLTEXT_MYSQL_TOTAL_POSTS'				=> 'Numero totale di messaggi indicizzati',
	'FULLTEXT_MYSQL_MIN_SEARCH_CHARS_EXPLAIN'	=> 'Le parole aventi questo numero minimo di caratteri saranno indicizzate per la ricerca. Tu o il tuo Host potete modificare questa impostazione attraverso la configurazione MySQL.',
	'FULLTEXT_MYSQL_MAX_SEARCH_CHARS_EXPLAIN'	=> 'Le parole aventi questo numero massimo di caratteri saranno indicizzate per la ricerca. Tu o il tuo Host potete modificare questa impostazione attraverso la configurazione MySQL.',

	'FULLTEXT_POSTGRES_INCOMPATIBLE_DATABASE'	=> 'Il motore PostgreSQL fulltext può essere utilizzato solo con PostgreSQL.',
	'FULLTEXT_POSTGRES_TOTAL_POSTS'				=> 'Numero totale di messaggi indicizzati',
	'FULLTEXT_POSTGRES_VERSION_CHECK'			=> 'Versione di PostgreSQL',
	'FULLTEXT_POSTGRES_TS_NAME'					=> 'Profilo di configurazione per la ricerca del testo:',
	'FULLTEXT_POSTGRES_MIN_WORD_LEN'			=> 'Lunghezza minima parola per parole chiave',
	'FULLTEXT_POSTGRES_MAX_WORD_LEN'			=> 'Lunghezza massima parola per parole chiave',
	'FULLTEXT_POSTGRES_VERSION_CHECK_EXPLAIN'	=> 'Questo motore di ricerca richiede PostgreSQL 8.3 o superiore.',
	'FULLTEXT_POSTGRES_TS_NAME_EXPLAIN'			=> 'Il profilo di configurazione per la ricerca del testo usato per determinare il parser e il dizionario.',
	'FULLTEXT_POSTGRES_MIN_WORD_LEN_EXPLAIN'	=> 'Le parole aventi questo numero minimo di caratteri saranno incluse nella query al database.',
	'FULLTEXT_POSTGRES_MAX_WORD_LEN_EXPLAIN'	=> 'La parole aventi questo numero massimo di caratteri saranno include nella query al database.',

	'FULLTEXT_SPHINX_CONFIGURE'					=> 'Configura le seguenti impostazioni per generare il file di configurazione Sphinx',
	'FULLTEXT_SPHINX_DATA_PATH'					=> 'Percorso relativo alla cartella dei dati',
	'FULLTEXT_SPHINX_DATA_PATH_EXPLAIN'			=> 'Sarà utilizzato per memorizzare gli Indici dei file di log. È necessario creare questa cartella al di fuori delle cartelle accessibili via web (dovrebbe esserci uno slash finale).',
	'FULLTEXT_SPHINX_DELTA_POSTS'				=> 'Numero di messaggi nell’Indice delta frequentemente aggiornato',
	'FULLTEXT_SPHINX_HOST'						=> 'Host del demone di ricerca Sphinx',
	'FULLTEXT_SPHINX_HOST_EXPLAIN'				=> 'Host su cui il demone di ricerca Sphinx (searchd) è in ascolto. Lascia vuoto per usare localhost.',
	'FULLTEXT_SPHINX_INDEXER_MEM_LIMIT'			=> 'Limite di memoria indicizzatore',
	'FULLTEXT_SPHINX_INDEXER_MEM_LIMIT_EXPLAIN'	=> 'Questo numero deve essere sempre inferiore alla quantità di RAM disponibile sul server. Se si verificano problemi di prestazioni periodiche, questo potrebbe essere dovuto all’indicizzatore che consuma troppe risorse. Potrebbe aiutare, il ridurre la quantità di memoria disponibile per l’indicizzatore.',
	'FULLTEXT_SPHINX_MAIN_POSTS'				=> 'Numero di messaggi nell’Indice principale',
	'FULLTEXT_SPHINX_PORT'						=> 'Porta del demone di ricerca Sphinx',
	'FULLTEXT_SPHINX_PORT_EXPLAIN'				=> 'Porta sul quale il demone di ricerca Sphinx (searchd) è in ascolto. Lascia vuoto per usare la porta Sphinx API di default 9312.',
	'FULLTEXT_SPHINX_WRONG_DATABASE'			=> 'La ricerca Sphinx per phpBB supporta solo MySQL e PostgreSQL.',
	'FULLTEXT_SPHINX_CONFIG_FILE'				=> 'File di configurazione Sphinx',
	'FULLTEXT_SPHINX_CONFIG_FILE_EXPLAIN'		=> 'Il contenuto generato del file di configurazione di Sphinx. Queste informazioni devono essere inserite nel file sphinx.conf, che viene utilizzato dal demone di ricerca Sphinx. Sostituisci il segnaposto [dbuser] e [dbpassword] con le credenziali del tuo database.',
	'FULLTEXT_SPHINX_NO_CONFIG_DATA'			=> 'Il percorso della cartella dei dati di configurazione Sphinx non è definito. Definite il percorso e inviate per generare il file di configurazione.',

	'GENERAL_SEARCH_SETTINGS'				=> 'Impostazioni generali di ricerca',
	'GO_TO_SEARCH_INDEX'					=> 'Vai alla pagina Indice di ricerca',

	'INDEX_STATS'							=> 'Statistiche dell’Indice',
	'INDEXING_IN_PROGRESS'					=> 'Indicizzazione in corso...',
	'INDEXING_IN_PROGRESS_EXPLAIN'			=> 'Il motore di ricerca sta indicizzando tutti i messaggi della Board. Questo può impiegare da alcuni minuti ad alcune ore; attendi.',

	'LIMIT_SEARCH_LOAD'						=> 'Limite di caricamento del sistema per la pagina di ricerca',
	'LIMIT_SEARCH_LOAD_EXPLAIN'				=> 'Se il limite di caricamento del sistema eccede di un minuto questo valore, la pagina andrà OffLine. 1.0 uguaglia l’utilizzo del ~100% di un processore. Questo funziona solo su server basati su UNIX.',

	'MAX_SEARCH_CHARS'						=> 'Valore massimo caratteri indicizzati dalla ricerca',
	'MAX_SEARCH_CHARS_EXPLAIN'				=> 'Le parole con non più di questo numero di caratteri saranno indicizzate per la ricerca.',
	'MAX_NUM_SEARCH_KEYWORDS'				=> 'Numero massimo di chiavi di ricerca consentite',
	'MAX_NUM_SEARCH_KEYWORDS_EXPLAIN'		=> 'Il numero massimo di parole che è possibile inserire per la ricerca. 0 = illimitato.',
	'MIN_SEARCH_CHARS'						=> 'Valore minimo caratteri indicizzati dalla ricerca',
	'MIN_SEARCH_CHARS_EXPLAIN'				=> 'Le parole con almeno questo numero minimo di caratteri saranno indicizzate per la ricerca.',
	'MIN_SEARCH_AUTHOR_CHARS'				=> 'Numero minimo di caratteri per il nome autore',
	'MIN_SEARCH_AUTHOR_CHARS_EXPLAIN'		=> 'Gli utenti devono immettere almeno questo numero minimo di caratteri quando eseguono una ricerca del nome con carattere jolly (es. di solito l’asterisco (*) si sostituisce come un carattere jolly). Se il nome utente è più breve di questo numero puoi ancora cercare i suoi messaggi inserendo il nome utente completo.',

	'PROGRESS_BAR'							=> 'Barra di progresso',

	'SEARCH_GUEST_INTERVAL'					=> 'Intervallo del flood di ricerca per gli ospiti',
	'SEARCH_GUEST_INTERVAL_EXPLAIN'			=> 'Numero di secondi che gli ospiti devono aspettare tra una ricerca e l’altra. Se un ospite fa una ricerca tutti gli altri devono aspettare fino a quando l’intervallo di tempo non è passato.',
	'SEARCH_INDEX_CREATE_REDIRECT'			=> array(
		2	=> 'Tutti i messaggi fino al numero ID %2$d vengono ora indicizzati, di cui %1$d messaggi erano all’interno di questa fase.',
	),
	'SEARCH_INDEX_CREATE_REDIRECT_RATE'		=> array(
		2	=> 'La velocità di indicizzazione corrente è approssimativamente di %1$.1f messaggi al secondo.',
	),
	'SEARCH_INDEX_DELETE_REDIRECT'			=> array(
		2	=> 'Tutti i messaggi fino al numero ID %2$d sono stati rimossi dall’Indice di ricerca, di cui %1$d messaggi erano in questa fase.',
	),
	'SEARCH_INDEX_DELETE_REDIRECT_RATE'		=> array(
		2	=> 'Approssimativamente vengono eliminati %1$.1f messaggi al secondo.',
	),	
	'SEARCH_INDEX_CREATED'					=> 'Tutti i messaggi sono stati indicizzati correttamente nel database.',
	'SEARCH_INDEX_PROGRESS'					=> 'Fatto: %1$d | In attesa: %2$d | Totale: %3$d',
	'SEARCH_INDEX_REMOVED'					=> 'L’Indice di ricerca per questo motore è stato cancellato.',
	'SEARCH_INTERVAL'						=> 'Intervallo del flood di ricerca per gli utenti',
	'SEARCH_INTERVAL_EXPLAIN'				=> 'Numero di secondi che gli utenti devono aspettare tra una ricerca e l’altra. Questo intervallo è controllato indipendentemente per ogni utente.',
	'SEARCH_STORE_RESULTS'					=> 'Durata cache per i risultati della ricerca',
	'SEARCH_STORE_RESULTS_EXPLAIN'			=> 'I risultati della ricerca memorizzati nella cache scadranno dopo questo tempo, in secondi. Imposta 0 se vuoi disabilitare la cache per la ricerca.',
	'SEARCH_TYPE'							=> 'Cerca motore di ricerca',
	'SEARCH_TYPE_EXPLAIN'					=> 'phpBB ti permette di scegliere il motore utilizzato per la ricerca del testo nei contenuti dei messaggi. Di default, la ricerca avverrà tramite il sistema di ricerca fulltext di phpBB.',
	'SWITCHED_SEARCH_BACKEND'				=> 'Hai commutato il motore di ricerca. Per utilizzare il nuovo motore di ricerca dovresti assicurarti che ci sia un Indice per il motore che hai scelto.',

	'TOTAL_WORDS'							=> 'Numero totale di parole indicizzate',
	'TOTAL_MATCHES'							=> 'Numero totale di relazioni "parola - argomento" indicizzate',

	'YES_SEARCH'							=> 'Permetti le funzioni di ricerca',
	'YES_SEARCH_EXPLAIN'					=> 'Permette tra le funzionalità anche la ricerca utenti.',
	'YES_SEARCH_UPDATE'						=> 'Permetti aggiornamento fulltext',
	'YES_SEARCH_UPDATE_EXPLAIN'				=> 'Aggiornamento degli Indici fulltext quando si scrive un messaggio, annullato se la ricerca è disabilitata.',
));
