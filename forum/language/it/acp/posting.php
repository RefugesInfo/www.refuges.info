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

// BBCodes
// Note to translators: you can translate everything but what's between { and }
$lang = array_merge($lang, array(
	'ACP_BBCODES_EXPLAIN'		=> 'Il BBCode è una speciale implementazione dell’HTML e offre un controllo maggiore su cosa e come viene mostrato nei messaggi. Da qui puoi aggiungere, rimuovere e modificare BBCode.',
	'ADD_BBCODE'				=> 'Aggiungi nuovo BBCode',

	'BBCODE_DANGER'				=> 'Il BBCode che stai cercando di aggiungere sembra non sicuro. Se il BBCode utilizza un segnaposto {TEXT} in un contesto sensibile, prova invece a utilizzare un tipo più restrittivo. Procedere solo se si comprendono i rischi.',
	'BBCODE_DANGER_PROCEED'		=> 'Vai avanti', //'Accetto il rischio',

	'BBCODE_ADDED'				=> 'BBCode aggiunto.',
	'BBCODE_EDITED'				=> 'BBCode modificato.',
	'BBCODE_DELETED'			=> 'Il BBCode è stato rimosso con successo.',
	'BBCODE_NOT_EXIST'			=> 'Il BBCode selezionato non esiste.',
	'BBCODE_HELPLINE'			=> 'Aiuto in linea',
	'BBCODE_HELPLINE_EXPLAIN'	=> 'Questo campo contiene il testo visibile al passaggio del mouse sopra il BBCode.',
	'BBCODE_HELPLINE_TEXT'		=> 'Testo di aiuto',
	'BBCODE_HELPLINE_TOO_LONG'  => 'Il testo di aiuto inserito è troppo lungo.',

	'BBCODE_INVALID_TAG_NAME'	=> 'Il nome tag del BBCode selezionato è già esistente.',
	'BBCODE_INVALID'            => 'Il tuo BBCode è costruito in una forma non valida.',
	'BBCODE_INVALID_TEMPLATE'	=> 'Il modello del tuo BBCode non è valido.',
	'BBCODE_TAG'				=> 'Tag',
	'BBCODE_TAG_TOO_LONG'		=> 'Il nome tag inserito è troppo lungo.',
	'BBCODE_TAG_DEF_TOO_LONG'	=> 'La definizione del tag inserita è troppo lunga, riduci tale definizione.',
	'BBCODE_USAGE'				=> 'Uso del BBCode',
	'BBCODE_USAGE_EXAMPLE'		=> '[highlight={COLOR}]{TEXT}[/highlight]<br /><br />[font={SIMPLETEXT1}]{SIMPLETEXT2}[/font]',
	'BBCODE_USAGE_EXPLAIN'		=> 'Qui definisci come usare il BBCode. Ogni variabile di input deve essere sostituita dal simbolo corrispondente (%svedi sotto%s).',

	'EXAMPLE'						=> 'Esempio:',
	'EXAMPLES'						=> 'Esempi:',

	'HTML_REPLACEMENT'				=> 'Trasforma in HTML',
	'HTML_REPLACEMENT_EXAMPLE'		=> '&lt;span style="background-color: {COLOR};"&gt;{TEXT}&lt;/span&gt;<br /><br />&lt;span style="font-family: {SIMPLETEXT1};"&gt;{SIMPLETEXT2}&lt;/span&gt;',
	'HTML_REPLACEMENT_EXPLAIN'		=> 'Qui definisci la trasformazione in HTML. Ricordati che devi usare i simboli che hai definito sopra!',

	'TOKEN'					=> 'Segnaposto',
	'TOKENS'				=> 'Segnaposto',
	'TOKENS_EXPLAIN'		=> 'I segnaposto indicano l’input utente. L’input verrà validato solo se corrisponde alla definizione. È possibile numerarli, cioè aggiungere un numero come ultimo carattere tra parentesi graffe, es. {USERNAME1}, {USERNAME2}.<br /><br />Oltre a questi simboli puoi utilizzare le stringhe di lingua presenti nella tua cartella language/ tipo questa: {L_<em>&lt;STRINGNAME&gt;</em>} dove <em>&lt;STRINGNAME&gt;</em> è il nome della stringa tradotta che vuoi aggiungere. Per esempio, {L_WROTE} apparirà come &quot;scritto&quot; o quella che è la traduzione nella lingua locale di riferimento.<br /><br /><strong>Tieni presente che solo i segnaposto indicati sotto sono abilitati all’interno di BBCodes personalizzati.</strong>',
	'TOKEN_DEFINITION'		=> 'Che cosa sono?',
	'TOO_MANY_BBCODES'		=> 'Non puoi creare altri BBCode. Devi cancellarne almeno uno e riprovare.',

	'tokens'	=>	array(
		'TEXT'			=> 'Qualsiasi testo, inclusi con caratteri stranieri, numeri, ecc...',
		'SIMPLETEXT'	=> 'Caratteri dall’alfabeto latino (A-Z), numeri, spazi, virgole, punti, segno meno, segno più, trattino e underscore',
		'INTTEXT'		=> 'Caratteri Unicode, numeri, spazi, virgole, punti, segno meno, segno più, trattino, underscore e spazi bianchi.',
		'IDENTIFIER'	=> 'Caratteri dall’alfabeto latino (A-Z), numeri, trattino e underscore',
		'NUMBER'		=> 'Una serie di cifre',
		'EMAIL'			=> 'Indirizzo email valido',
		'URL'			=> 'Un URL valido che utilizzi qualsiasi protocollo consentito (http, ftp, ecc... non possono essere usati per exploit javascript). Se non ne viene fornito nessuno, il protocollo &quot;http://&quot; verrà aggiunto davanti alla stringa.',
		'LOCAL_URL'		=> 'Un URL locale. L’URL deve essere relativo alla pagina in cui si trova l’argomento e non può contenere il nome del server, né un protocollo; i link relativi vengono preceduti da “%s”',
		'RELATIVE_URL'	=> 'Un URL relativo. È possibile utilizzarlo per abbinare le parti di un URL, ma attenzione: un URL completo, è un URL relativo valido. Quando vuoi utilizzare un URL relativo nella tua Board, utilizza il segnaposto LOCAL_URL.',
		'COLOR'			=> 'Un colore definito per HTML, sia in forma numerica <samp>#FF1234</samp> o un <a href="http://www.w3.org/TR/CSS21/syndata.html#value-def-color">colore con chiave CSS</a> tipo <samp>fuchsia</samp> o <samp>InactiveBorder</samp>',
		'ALNUM'			=> 'Caratteri dell’alfabeto latino (A-Z) e numeri.',
		'CHOICE'		=> 'Una scelta di valori specificati, ad esempio <samp>{CHOICE=cuori,quadri,fiori,picche}</samp>. I valori sono trattati come non sensibili alle maiuscole/minuscole per impostazione predefinita e possono essere trattati come sensibili alle maiuscole/minuscole specificando l’opzione <samp>caseSensitive</samp>: <samp>{CHOICE=cuori,quadri,fiori,picche;caseSensitive}</samp>',
		'FLOAT'			=> 'Un valore decimale, ad esempio <samp>0.5</samp>.',
		'HASHMAP'		=> 'Esegue il mapping delle stringhe alla loro sostituzione nel formato <samp>{HASHMAP=string1:sostituzione1,string2:sostituzione2}</samp>. Rileva le maiuscole e le minuscole. Per impostazione predefinita, conserva i valori sconosciuti.',
		'INT'			=> 'Un valore intero, ad esempio <samp>2</samp>.',
		'IP'			=> 'Un indirizzo IPv4 o IPv6 valido.',
		'IPPORT'		=> 'Un indirizzo IPv4 o IPv6 valido con numero di porta.',
		'IPV4'			=> 'Un indirizzo IPv4 valido.',
		'IPV6'			=> 'Un indirizzo IPv6 valido.',
		'MAP'			=> 'Esegue il mapping delle stringhe alla loro sostituzione nel formato <samp>{MAP=string1:sostituzione1,string2:sostituzione2}</samp>. Non distingue tra maiuscole e minuscole. Per impostazione predefinita, conserva i valori sconosciuti.',
		'RANGE'			=> 'Accetta un numero intero nell’intervallo specificato, ad esempio <samp>{RANGE=-10,42}</samp>.',
		'REGEXP'		=> 'Convalida il suo valore rispetto a una data espressione regolare, ad esempio <samp>{REGEXP=/^foo\w+bar$/}</samp>.',
		'TIMESTAMP'		=> 'Un timestamp come <samp>1h30m10s</samp> che verrà convertito in un numero di secondi. Accetta anche un numero.',
		'UINT'			=> 'Un valore intero senza segno. Uguale a <samp>{INT}</samp>, ma rifiuta valori inferiori a 0.',
	),
));

// Smilies and topic icons
$lang = array_merge($lang, array(
	'ACP_ICONS_EXPLAIN'		=> 'Da qui è possibile aggiungere, cancellare e modificare le icone che gli utenti possono aggiungere nei loro argomenti o messaggi. Solitamente queste icone vengono visualizzate accanto ai titoli degli argomenti all’interno del forum, o nei titoli dei messaggi nella lista argomenti. È anche possibile installare e creare dei pacchetti di icone.',
	'ACP_SMILIES_EXPLAIN'	=> 'Le emoticon (o smilies) sono in genere piccole immagini, a volte anche animate, usate per esprimere un’emozione o una sensazione. Da qui è possibile aggiungere, cancellare e modificare le emoticon che l’utente potrà usare nei suoi messaggi pubblici e privati. È anche possibile installare e creare dei pacchetti di emoticon.',
	'ADD_SMILIES'			=> 'Aggiungi emoticon',
	'ADD_SMILEY_CODE'		=> 'Aggiungi codici emoticon',
	'ADD_ICONS'				=> 'Aggiungi icone',
	'AFTER_ICONS'			=> 'Dopo %s',
	'AFTER_SMILIES'			=> 'Dopo %s',

	'CODE'						=> 'Codice',
	'CURRENT_ICONS'				=> 'Icone correnti',
	'CURRENT_ICONS_EXPLAIN'		=> 'Decidi cosa fare delle icone attualmente installate.',
	'CURRENT_SMILIES'			=> 'Emoticon correnti',
	'CURRENT_SMILIES_EXPLAIN'	=> 'Decidi cosa fare delle emoticon attualmente installate.',

	'DISPLAY_ON_POSTING'		=> 'Mostra nella pagina di scrittura',
	'DISPLAY_POSTING'			=> 'Nella pagina di scrittura',
	'DISPLAY_POSTING_NO'		=> 'Non nella pagina di scrittura',

	'EDIT_ICONS'				=> 'Modifica icone',
	'EDIT_SMILIES'				=> 'Modifica emoticon',
	'EMOTION'					=> 'Emozione',
	'EXPORT_ICONS'				=> 'Esporta e scarica icons.pak',
	'EXPORT_ICONS_EXPLAIN'		=> '%sCliccando questo link, le icone attualmente installate verranno raccolte in <samp>icons.pak</samp> che una volta scaricato potrà essere usato per creare un file <samp>.zip</samp> o <samp>.tgz</samp> con tutte le tue icone più questo file <samp>icons.pak</samp> di configurazione%s.',
	'EXPORT_SMILIES'			=> 'Esporta e scarica smilies.pak',
	'EXPORT_SMILIES_EXPLAIN'	=> '%sCliccando questo link, le emoticon attualmente installate verranno raccolte in <samp>smilies.pak</samp> che una volta scaricato potrà essere usato per creare un file <samp>.zip</samp> o <samp>.tgz</samp> con tutte le tue emoticon più questo file <samp>smilies.pak</samp> di configurazione%s.',

	'FIRST'			=> 'Primo',

	'ICONS_ADD'				=> 'Aggiungi nuova icona',
	'ICONS_ADDED'			=> array(
		0	=> 'Nessuna icona aggiunta.',
		1	=> 'L’icona è stata aggiunta con successo.',
		2	=> 'Le icone sono state aggiunte con successo.',
	),
	'ICONS_CONFIG'			=> 'Configura icona',
	'ICONS_DELETED'			=> 'L’icona è stato rimosso con successo.',
	'ICONS_EDIT'			=> 'Modifica icona',
	'ICONS_EDITED'			=> array(
		0	=> 'Nessuna icona è stata modificata.',
		1	=> 'L’icona è stata modificata con successo.',
		2	=> 'Le icone sono state modificate con successo..',
	),
	'ICONS_HEIGHT'			=> 'Altezza icona',
	'ICONS_IMAGE'			=> 'Immagine icona',
	'ICONS_IMPORTED'		=> 'Il pacchetto icone è stato installato.',
	'ICONS_IMPORT_SUCCESS'	=> 'Il pacchetto icone è stato importato.',
	'ICONS_LOCATION'		=> 'Collocazione icona',
	'ICONS_NOT_DISPLAYED'	=> 'Le seguenti icone non appaiono nella pagina di inserimento messaggi',
	'ICONS_ORDER'			=> 'Ordine icone',
	'ICONS_URL'				=> 'File immagine icona',
	'ICONS_WIDTH'			=> 'Larghezza Icona',
	'IMPORT_ICONS'			=> 'Installa pacchetto icone',
	'IMPORT_SMILIES'		=> 'Installa pacchetto emoticon',

	'KEEP_ALL'			=> 'Tieni tutto',

	'MASS_ADD_SMILIES'	=> 'Aggiungi più emoticon',

	'NO_ICONS_ADD'		=> 'Non ci sono icone disponibili da aggiungere.',
	'NO_ICONS_EDIT'		=> 'Non ci sono icone disponibili da modificare.',
	'NO_ICONS_EXPORT'	=> 'Non hai icone con cui generare un pacchetto.',
	'NO_ICONS_PAK'		=> 'Non ci sono pacchetti icone.',
	'NO_SMILIES_ADD'	=> 'Non ci sono emoticon disponibili da aggiungere.',
	'NO_SMILIES_EDIT'	=> 'Non ci sono emoticon disponibili da modificare.',
	'NO_SMILIES_EXPORT'	=> 'Non hai emoticon con cui generare un pacchetto.',
	'NO_SMILIES_PAK'	=> 'Non ci sono pacchetti di emoticon.',

	'PAK_FILE_NOT_READABLE'		=> 'File <samp>.pak</samp> illeggibile.',

	'REPLACE_MATCHES'	=> 'Rimpiazza simili',

	'SELECT_PACKAGE'			=> 'Seleziona un file pacchetto',
	'SMILIES_ADD'				=> 'Aggiungi nuova emoticon',
	'SMILIES_ADDED'				=> array(
		0	=> 'Nessuna emoticon aggiunta.',
		1	=> 'L’emoticon è stata aggiunta con successo.',
		2	=> 'Le emoticon sono state aggiunte	con successo.',
	),
	'SMILIES_CODE'				=> 'Codice emoticon',
	'SMILIES_CONFIG'			=> 'Configurazione emoticon',
	'SMILIES_DELETED'			=> 'Emoticon cancellata.',
	'SMILIES_EDIT'				=> 'Modifica emoticon',
	'SMILIE_NO_CODE'			=> 'Emoticon “%s” ignorata perché non è stato inserito il codice.',
	'SMILIE_NO_EMOTION'			=> 'Emoticon “%s” ignorata perché non è stata inserita l’emozione.',
	'SMILIE_NO_FILE'			=> 'Emoticon “%s” ignorata perché il file è mancante.',
	'SMILIES_EDITED'			=> array(
		0	=> 'Nessuna emoticon modificata.',
		1	=> 'L’emoticon è stata modificata con successo.',
		2	=> 'Le emoticon sono state modificate con successo.',
	),
	'SMILIES_EMOTION'			=> 'Emozione',
	'SMILIES_HEIGHT'			=> 'Altezza emoticon',
	'SMILIES_IMAGE'				=> 'Immagine emoticon',
	'SMILIES_IMPORTED'			=> 'Pacchetto di emoticon installato.',
	'SMILIES_IMPORT_SUCCESS'	=> 'Pacchetto di emoticon importato.',
	'SMILIES_LOCATION'			=> 'Localizzazione emoticon',
	'SMILIES_NOT_DISPLAYED'		=> 'Le seguenti emoticon non appaiono nella pagina di inserimento messaggi',
	'SMILIES_ORDER'				=> 'Ordine emoticon',
	'SMILIES_URL'				=> 'File immagine emoticon',
	'SMILIES_WIDTH'				=> 'Larghezza emoticon',

	'TOO_MANY_SMILIES'			=> array(
		1	=> 'Il limite di %d emoticon è stato raggiunto.',
		2	=> 'Il limite di %d emoticon è stato raggiunto.',
	),

	'WRONG_PAK_TYPE'	=> 'Il pacchetto specificato non contiene i dati appropriati.',
));

// Word censors
$lang = array_merge($lang, array(
	'ACP_WORDS_EXPLAIN'		=> 'Da qui è possibile aggiungere, modificare o cancellare le parole che saranno automaticamente censurate nel sistema. Tieni presente che è possibile utilizzare la parola censurata per effettuare la registrazione. Nel campo parola, sono accettate le abbreviazioni (*), Es. *test* vale anche per detestabile, test* va bene per testaccio, *test va bene per contest.',
	'ADD_WORD'				=> 'Aggiungi nuova parola',

	'EDIT_WORD'		=> 'Modifica parola censurata',
	'ENTER_WORD'	=> 'Devi scrivere la parola e quella che la deve sostituire.',

	'NO_WORD'	=> 'Non è stata selezionata alcuna parola.',

	'REPLACEMENT'	=> 'Sostituzione',

	'UPDATE_WORD'	=> 'Aggiorna censura parole',

	'WORD'				=> 'Parola',
	'WORD_ADDED'		=> 'Parola da censurare aggiunta.',
	'WORD_REMOVED'		=> 'Parola rimossa dalla censura.',
	'WORD_UPDATED'		=> 'Parola nella censura aggiornata.',
));

// Ranks
$lang = array_merge($lang, array(
	'ACP_RANKS_EXPLAIN'		=> 'Con questo modulo si possono aggiungere, modificare, guardare e cancellare i livelli. È possibile creare livelli personalizzati applicabili agli utenti attraverso il sistema di gestione utente.',
	'ADD_RANK'				=> 'Aggiungi nuovo livello',

	'MUST_SELECT_RANK'		=> 'Selezionare un livello.',

	'NO_ASSIGNED_RANK'		=> 'Nessun livello assegnato.',
	'NO_RANK_TITLE'			=> 'Non è stato specificato un titolo per il livello.',
	'NO_UPDATE_RANKS'		=> 'Livello cancellato. Gli utenti iscritti ed assegnati a questo livello, non sono stati aggiornati. È necessario reimpostare il livello per ogni iscritto.',

	'RANK_ADDED'			=> 'Livello aggiunto.',
	'RANK_IMAGE'			=> 'Immagine livello',
	'RANK_IMAGE_EXPLAIN'	=> 'Qui è possibile assegnare una piccola immagine che sarà associata al livello. Il percorso della cartella è relativo alla radice del forum phpBB.',
	'RANK_IMAGE_IN_USE'     => '(In uso)',
	'RANK_MINIMUM'			=> 'Minimo messaggi',
	'RANK_REMOVED'			=> 'Livello cancellato.',
	'RANK_SPECIAL'			=> 'Stabilisci livello speciale',
	'RANK_TITLE'			=> 'Titolo livello',
	'RANK_UPDATED'			=> 'Livello aggiornato.',
));

// Disallow Usernames
$lang = array_merge($lang, array(
	'ACP_DISALLOW_EXPLAIN'	=> 'Qui è possibile controllare i nomi utente che non sono ammessi all’utilizzo. I nomi utente disabilitati possono essere definiti tramite abbreviazione *. ',
	'ADD_DISALLOW_EXPLAIN'	=> 'È possibile disabilitare un nome utente utilizzando i caratteri di abbreviazione * che rappresentano qualsiasi stringa.',
	'ADD_DISALLOW_TITLE'	=> 'Aggiungi un nome da disabilitare',

	'DELETE_DISALLOW_EXPLAIN'	=> 'È possibile cancellare un nome disabilitato selezionando il nome in questione da questa lista e facendo click su Esegui.',
	'DELETE_DISALLOW_TITLE'		=> 'Rimuovi nome utente disabilitato',
	'DISALLOWED_ALREADY'		=> 'Il nome utente che hai inserito è già disabilitato.',
	'DISALLOWED_DELETED'		=> 'I nomi utente disabilitati sono stati rimossi.',
	'DISALLOW_SUCCESSFUL'		=> 'I nomi utente disabilitati sono stati aggiunti.',

	'NO_DISALLOWED'				=> 'Nessun nome utente disabilitato',
	'NO_USERNAME_SPECIFIED'		=> 'Non è stato selezionato alcun nome con cui operare.',
));

// Reasons
$lang = array_merge($lang, array(
	'ACP_REASONS_EXPLAIN'	=> 'Qui è possibile gestire le motivazioni usate per fare segnalazioni o rifiutare messaggi che non si vogliono approvare. Esiste una motivazione predefinita (segnata con *) che non si può eliminare, normalmente usata per i messaggi in cui non viene specificata una diversa motivazione.',
	'ADD_NEW_REASON'		=> 'Aggiungi motivazione',
	'AVAILABLE_TITLES'		=> 'Titoli di motivazioni disponibili',

	'IS_NOT_TRANSLATED'			=> 'Motivazione <strong>non</strong> localizzata.',
	'IS_NOT_TRANSLATED_EXPLAIN'	=> 'Motivazione <strong>non</strong> localizzata. Per fornire una descrizione nella lingua locale, specifica la forma corretta nel file di lingua, sezione ragione segnalazioni.',
	'IS_TRANSLATED'				=> 'Motivazione localizzata.',
	'IS_TRANSLATED_EXPLAIN'		=> 'Motivazione localizzata. Se il titolo usato qui è specificato nel file di lingua, sezione ragioni della segnalazione, verrà utilizzata la forma localizzata del titolo e la descrizione.',

	'NO_REASON'					=> 'Motivazione non esistente.',
	'NO_REASON_INFO'			=> 'Per questa motivazione occorre specificare un titolo e una descrizione.',
	'NO_REMOVE_DEFAULT_REASON'	=> 'Non è possibile cancellare la motivazione predefinita "Altro".',

	'REASON_ADD'				=> 'Aggiungi motivo di segnalazione/rifiuto',
	'REASON_ADDED'				=> 'Motivo di segnalazione/rifiuto aggiunto.',
	'REASON_ALREADY_EXIST'		=> 'Esiste già una motivazione con questo titolo, per cui devi cambiare titolo alla motivazione.',
	'REASON_DESCRIPTION'		=> 'Descrivi motivazione',
	'REASON_DESC_TRANSLATED'	=> 'Descrizione motivazione visibile',
	'REASON_EDIT'				=> 'Modifica motivo di segnalazione/rifiuto',
	'REASON_EDIT_EXPLAIN'		=> 'Qui è possibile aggiungere e modificare le motivazioni. Se una motivazione è tradotta nella versione localizzata sarà usata al posto di quella originale.',
	'REASON_REMOVED'			=> 'Motivo di segnalazione/rifiuto eliminato.',
	'REASON_TITLE'				=> 'Titolo motivazione',
	'REASON_TITLE_TRANSLATED'	=> 'Titolo motivazione visibile',
	'REASON_UPDATED'			=> 'Motivo di segnalazione/rifiuto aggiornato.',

	'USED_IN_REPORTS'		=> 'Usato per le segnalazioni',
));
