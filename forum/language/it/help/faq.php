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

$lang = array_merge($lang, array(
	'HELP_FAQ_ATTACHMENTS_ALLOWED_ANSWER'	=> 'Ogni amministratore può abilitare o meno certi tipi di allegati. Se non sei sicuro di ciò che è permesso caricare, contatta l’amministratore per avere assistenza.',
	'HELP_FAQ_ATTACHMENTS_ALLOWED_QUESTION'	=> 'Quali allegati sono ammessi in questa Board?',
	'HELP_FAQ_ATTACHMENTS_OWN_ANSWER'	=> 'Per trovare la lista degli allegati da te caricati, vai nel tuo Pannello di Controllo Utente e segui i collegamenti nella sezione degli allegati.',
	'HELP_FAQ_ATTACHMENTS_OWN_QUESTION'	=> 'Come posso trovare i miei allegati?',

	'HELP_FAQ_BLOCK_ATTACHMENTS'	=> 'Allegati',
	'HELP_FAQ_BLOCK_BOOKMARKS'	=> 'Sottoscrizioni e segnalibri',
	'HELP_FAQ_BLOCK_FORMATTING'	=> 'Formattazione e tipi di argomenti',
	'HELP_FAQ_BLOCK_FRIENDS'	=> 'Amici e ignorati',
	'HELP_FAQ_BLOCK_GROUPS'	=> 'Livelli e gruppi di utenti',
	'HELP_FAQ_BLOCK_ISSUES'	=> 'Informazioni su phpBB',
	'HELP_FAQ_BLOCK_LOGIN'	=> 'Connessione e registrazione',
	'HELP_FAQ_BLOCK_PMS'	=> 'Messaggi privati',
	'HELP_FAQ_BLOCK_POSTING'	=> 'Invio Messaggi',
	'HELP_FAQ_BLOCK_SEARCH'	=> 'Ricerche nella Board',
	'HELP_FAQ_BLOCK_USERSETTINGS'	=> 'Impostazioni e preferenze utente',

	'HELP_FAQ_BOOKMARKS_DIFFERENCE_ANSWER'	=> 'Nel phpBB 3.0 (Olympus), i segnalibri lavorano in modo molto simile ai segnalibri di un browser web. Non si viene avvisati in caso di aggiornamento. Nel phpBB 3.1 (Ascraeus), 3.2 (Rhea) e 3.3 (Proteus), i segnalibri sono simili alla sottoscrizione di un argomento. È possibile ricevere una notifica quando un segnalibro di un argomento viene aggiornato. La sottoscrizione, tuttavia, ti comunicherà quando c’è un aggiornamento relativo a un argomento o in un forum della Board. Opzioni di notifica per segnalibri e sottoscrizioni possono essere configurate nel Pannello di Controllo Utente, alla voce “Preferenze”.',
	'HELP_FAQ_BOOKMARKS_DIFFERENCE_QUESTION'	=> 'Qual è la differenza fra segnalibri e sottoscrizioni?',
	'HELP_FAQ_BOOKMARKS_FORUM_ANSWER'	=> 'Per sottoscrivere un forum specifico, fare click sul collegamento “Sottoscrivi forum”, in fondo alla pagina, entrando nel forum.',
	'HELP_FAQ_BOOKMARKS_FORUM_QUESTION'	=> 'Come posso sottoscrivere un forum specifico?',
	'HELP_FAQ_BOOKMARKS_REMOVE_ANSWER'	=> 'Per cancellare le tue sottoscrizioni, basta andare nel tuo Pannello di Controllo Utente e seguire i collegamenti alle tue sottoscrizioni.',
	'HELP_FAQ_BOOKMARKS_REMOVE_QUESTION'	=> 'Come cancello le mie sottoscrizioni?',
	'HELP_FAQ_BOOKMARKS_TOPIC_ANSWER'	=> 'Puoi aggiungere ai segnalibri o sottoscrivere un argomento specifico cliccando sul collegamento appropriato nel menu a tendina “Strumenti argomento”, situato vicino alla parte superiore e inferiore di un argomento.<br />Rispondendo a un argomento con la voce “Avvisami via email quando si risponde in questo argomento” selezionata, sarà anche sottoscritto l’argomento.',
	'HELP_FAQ_BOOKMARKS_TOPIC_QUESTION'	=> 'Come posso sottoscrivere un segnalibro o un argomento specifico?',

	'HELP_FAQ_FORMATTING_ANNOUNCEMENT_ANSWER'	=> 'Gli annunci contengono spesso informazioni importanti e dovrebbero essere letti prima possibile. Gli annunci appaiono in cima a ogni pagina del forum in cui sono stati scritti. L’amministratore può decidere se un utente può scrivere negli annunci o meno.',
	'HELP_FAQ_FORMATTING_ANNOUNCEMENT_QUESTION'	=> 'Cosa sono gli annunci?',
	'HELP_FAQ_FORMATTING_BBOCDE_ANSWER'	=> 'Il BBCode è una speciale implementazione dell’HTML; l’utilizzo è soggetto alla scelta dell’amministratore (puoi anche disabilitarlo di messaggio in messaggio tramite l’opzione nel modulo di invio messaggi). Il BBCode è simile all’HTML, i comandi sono racchiusi tra parentesi quadre [ e ] anziché tra parentesi angolari &lt; e &gt; e offre un controllo maggiore su cosa e come viene mostrato nei messaggi. Per maggiori informazioni sul BBCode leggi la guida presente nella pagina per l’invio dei messaggi.',
	'HELP_FAQ_FORMATTING_BBOCDE_QUESTION'	=> 'Cos’è il BBCode?',
	'HELP_FAQ_FORMATTING_GLOBAL_ANNOUNCE_ANSWER'	=> 'Gli annunci globali sono annunci che contengono informazioni molto importanti e tu dovresti leggerli quanto prima. Gli annunci globali appaiono in cima a tutti i forum ed anche nel Pannello di Controllo Utente. La possibilità di scrivere su un annuncio globale dipende dai permessi concessi dall’amministratore.',
	'HELP_FAQ_FORMATTING_GLOBAL_ANNOUNCE_QUESTION'	=> 'Che cosa sono gli annunci globali?',
	'HELP_FAQ_FORMATTING_HTML_ANSWER'	=> 'No. Non è possibile inserire del codice HTML e ottenere che sia interpretato come tale in questo Forum. La maggior parte delle funzioni dell’HTML può essere sostituita dal BBCode.',
	'HELP_FAQ_FORMATTING_HTML_QUESTION'	=> 'Posso usare l’HTML?',
	'HELP_FAQ_FORMATTING_ICONS_ANSWER'	=> 'Le icone argomento sono immagini che possono essere associate agli argomenti per indicare il loro contenuto. La possibilità di usarle dipende dai permessi concessi dall’amministratore.',
	'HELP_FAQ_FORMATTING_ICONS_QUESTION'	=> 'Che cosa sono le icone argomento?',
	'HELP_FAQ_FORMATTING_IMAGES_ANSWER'	=> 'Sì, puoi inserire delle immagini nei tuoi messaggi. Se l’amministratore permette gli allegati è possibile caricare delle immagini direttamente sulla Board; in alternativa devi creare un collegamento a un’immagine ospitata su un server di pubblico accesso, ad es. http://www.indirizzo-del-sito.com/immagine.gif. Non puoi inserire immagini che hai sul tuo PC (a meno che non abbia un server!) o immagini che si trovano dietro sistemi di autenticazione, come caselle di posta tipo yahoo o hotmail, siti protetti da codici di accesso, ecc. Per inserire l’immagine, puoi usare il comando BBCode [img].',
	'HELP_FAQ_FORMATTING_IMAGES_QUESTION'	=> 'Posso inserire delle immagini?',
	'HELP_FAQ_FORMATTING_LOCKED_ANSWER'	=> 'Gli argomenti possono essere bloccati dai moderatori o dall’amministratore. Non è possibile rispondere ad un argomento bloccato così come i sondaggi chiusi terminano automaticamente. Un argomento può venire bloccato per varie ragioni, ad es. se contravviene ai Termini di Utilizzo.',
	'HELP_FAQ_FORMATTING_LOCKED_QUESTION'	=> 'Cosa sono gli argomenti bloccati?',
	'HELP_FAQ_FORMATTING_SMILIES_ANSWER'	=> 'Le «emoticon» o «faccine» (in inglese, <em>emoticons</em> o <em>smileys</em>) sono piccole immagini che possono essere usate per esprimere una sensazione o un’emozione con pochi caratteri; ad es. :) significa felice, :( significa triste. Questo Forum trasforma automaticamente queste serie di caratteri in immagini. La lista completa delle emoticon è visibile nella pagina di invio messaggi. Cerca di non esagerare nell’uso delle emoticon, possono facilmente rendere un messaggio illeggibile, e un moderatore potrebbe decidere di modificarlo o addirittura rimuoverlo.',
	'HELP_FAQ_FORMATTING_SMILIES_QUESTION'	=> 'Cosa sono le emoticon?',
	'HELP_FAQ_FORMATTING_STICKIES_ANSWER'	=> 'Gli argomenti importanti (in inglese, Sticky Topics) appaiono in cima alla prima pagina del forum in cui sono stati scritti (dopo eventuali annunci). Come si intuisce dal nome stesso, contengono informazioni importanti e dovrebbero essere lette sempre. Come per gli annunci, l’amministratore può decidere se un utente vi può scrivere o meno.',
	'HELP_FAQ_FORMATTING_STICKIES_QUESTION'	=> 'Cosa sono gli argomenti importanti?',

	'HELP_FAQ_FRIENDS_BASIC_ANSWER'	=> 'Puoi usare queste liste per gestire gli iscritti al Forum. Gli utenti aggiunti alla tua lista amici saranno elencati nel Pannello di Controllo Utente per poter più rapidamente controllare se sono connessi e inviare loro messaggi privati. A seconda delle possibilità dello stile, i messaggi di questi utenti possono anche essere evidenziati. Se aggiungi un utente alla tua lista ignorati, ogni suo messaggio sarà nascosto automaticamente.',
	'HELP_FAQ_FRIENDS_BASIC_QUESTION'	=> 'Che cos’è la mia lista amici e ignorati?',
	'HELP_FAQ_FRIENDS_MANAGE_ANSWER'	=> 'Puoi aggiungere un utente alla tua lista in due modi. All’interno del profilo di ciascun utente, c’è un collegamento per aggiungerlo alla tua lista amici o ignorati. Altrimenti, dal tuo Pannello di Controllo Utente puoi aggiungere direttamente un utente inserendo il suo nome utente. Puoi anche rimuovere un utente dalla lista dalla stessa pagina.',
	'HELP_FAQ_FRIENDS_MANAGE_QUESTION'	=> 'Come posso aggiungere o rimuovere un utente dalla mia lista amici o ignorati?',

	'HELP_FAQ_GROUPS_ADMINISTRATORS_ANSWER'	=> 'Gli amministratori sono gli utenti che hanno il più alto grado di controllo sull’intera Board; possono controllare qualsiasi elemento, inclusi i permessi, la disabilitazione (o «ban») degli utenti, la creazione di moderatori e gruppi di utenti, ecc. Inoltre, possono moderare tutti i forum, a seconda delle autorizzazioni concesse dal Fondatore della Board (Amministratore Fondatore).',
	'HELP_FAQ_GROUPS_ADMINISTRATORS_QUESTION'	=> 'Cosa sono gli amministratori?',
	'HELP_FAQ_GROUPS_COLORS_ANSWER'	=> 'È possibile per l’amministratore della Board assegnare un colore ai membri di un gruppo per rendere più semplice identificarli.',
	'HELP_FAQ_GROUPS_COLORS_QUESTION'	=> 'Perché alcuni gruppi di utenti appaiono in colori differenti?',
	'HELP_FAQ_GROUPS_DEFAULT_ANSWER'	=> 'Se sei membro di più di un gruppo di utenti, quello impostato come predefinito determina il colore e quali permessi di gruppo sono attivi (in condizioni normali; l’amministratore, potrebbe attribuire al singolo utente, permessi diversi dal gruppo predefinito). L’amministratore può permetterti di modificare il tuo gruppo di utenti predefinito dal Pannello di Controllo Utente.',
	'HELP_FAQ_GROUPS_DEFAULT_QUESTION'	=> 'Che cos’è un gruppo di utenti predefinito?',
	'HELP_FAQ_GROUPS_MODERATORS_ANSWER'	=> 'I moderatori sono utenti (o gruppi di utenti) il cui compito è quello di tenere sotto controllo i forum giorno per giorno. Hanno il potere di modificare o cancellare qualsiasi messaggio e di chiudere, riaprire, spostare o rimuovere qualsiasi argomento del forum da loro moderato. Generalmente il compito dei moderatori è quello di evitare che gli utenti vadano «fuori tema» (in inglese, <em>off-topic</em>) o che scrivano messaggi oltraggiosi ed offensivi.',
	'HELP_FAQ_GROUPS_MODERATORS_QUESTION'	=> 'Cosa sono i moderatori?',
	'HELP_FAQ_GROUPS_TEAM_ANSWER'	=> 'Questa pagina fornisce una lista degli amministratori e dei moderatori, dando dettagli sui forum da loro moderati.',
	'HELP_FAQ_GROUPS_TEAM_QUESTION'	=> 'Che cos’è il collegamento “Staff”?',
	'HELP_FAQ_GROUPS_USERGROUPS_ANSWER'	=> 'I gruppi permettono agli amministratori di riunire gli utenti. Ogni utente può appartenere a più gruppi e a ogni gruppo possono venire assegnati diversi permessi. Questo facilita l’amministratore nelle operazioni di creazione di moderatori per un forum, o di concessione di permessi per un forum privato, ecc.',
	'HELP_FAQ_GROUPS_USERGROUPS_JOIN_ANSWER'	=> 'Trovi i gruppi nella sezione <em>Gruppi</em> nel Pannello di Controllo Utente. Se vuoi far parte di uno di questi procedi cliccando sul pulsante appropriato. Non sempre però i gruppi sono ad <em>accesso aperto</em>. Alcuni sono chiusi e altri hanno l’elenco dei membri nascosto. Se il gruppo è aperto, puoi chiedere l’ammissione cliccando sul pulsante apposito. Dovrai ottenere l’approvazione del moderatore del gruppo, che potrebbe chiederti perché vuoi unirti al gruppo. Se il leader di un gruppo non accetta la tua richiesta, sei pregato di non assillarlo: probabilmente ha le sue buone ragioni.',
	'HELP_FAQ_GROUPS_USERGROUPS_JOIN_QUESTION'	=> 'Dove trovo i gruppi e come posso far parte di uno di essi?',
	'HELP_FAQ_GROUPS_USERGROUPS_LEAD_ANSWER'	=> 'I gruppi vengono creati dall’amministratore, che ne stabilisce anche il leader. Se desideri creare un nuovo gruppo, contatta l’amministratore via posta elettronica o con un messaggio privato.',
	'HELP_FAQ_GROUPS_USERGROUPS_LEAD_QUESTION'	=> 'Come divento leader di un gruppo?',
	'HELP_FAQ_GROUPS_USERGROUPS_QUESTION'	=> 'Cosa sono i gruppi di utenti?',

	'HELP_FAQ_ISSUES_ADMIN_ANSWER'	=> 'Tutti gli utenti della Board possono utilizzare il modulo "Contattaci", se l’opzione è stata abilitata dall’amministratore.<br />I membri della Board possono anche usare il collegamento "Staff".',
	'HELP_FAQ_ISSUES_ADMIN_QUESTION'	=> 'Come posso contattare un amministratore del Forum?',
	'HELP_FAQ_ISSUES_FEATURE_ANSWER'	=> 'Questo programma è stato scritto da phpBB Limited. Se credi che ci sia bisogno di aggiungere una nuova funzionalità, visita il <a href="https://www.phpbb.com/ideas/">Centro Idee phpBB</a>, dove potrai supportare idee esistenti o suggerire nuove funzionalità.',
	'HELP_FAQ_ISSUES_FEATURE_QUESTION'	=> 'Perché la caratteristica X non è disponibile?',
	'HELP_FAQ_ISSUES_LEGAL_ANSWER'	=> 'Devi contattare l’amministratore di questa Board. Se non riesci a trovarlo, prova a contattare uno dei moderatori e chiedi a chi puoi rivolgerti. Se ancora non ottieni risposta, puoi contattare il proprietario del dominio (fai una ricerca con <em>whois</em>) oppure, se la Board è ospitata da un servizio gratuito (ad es. yahoo, free.fr, f2s.com, ecc.), l’amministratore di tale servizio. Nota che phpBB Limited e phpBB Store non hanno <strong>assolutamente alcun controllo</strong> e non possono essere ritenuti responsabili di come, dove e da chi viene utilizzata questa Board. È assolutamente inutile contattare phpBB Limited o phpBB Store in relazione a qualsiasi questione legale <strong>non direttamente collegata</strong> al sito phpBB.com, phpBB-Italia.it o al software phpBB stesso. I messaggi di posta elettronica inviati a phpBB Limited o a phpBB Store riguardanti l’uso da parte di terzi di questo programma non riceveranno risposta.',
	'HELP_FAQ_ISSUES_LEGAL_QUESTION'	=> 'Chi devo contattare per segnalare abusi e/o per questioni d’ordine legale concernenti questa Board?',
	'HELP_FAQ_ISSUES_WHOIS_PHPBB_ANSWER'	=> 'Questo programma (nella sua forma originale) è prodotto e rilasciato da <a href="https://www.phpbb.com/">phpBB Limited</a>. È reso disponibile sotto la GNU General Public Licence versione 2 (GPL-2.0) e può essere liberamente distribuito; clicca sul collegamento per maggiori informazioni.',
	'HELP_FAQ_ISSUES_WHOIS_PHPBB_QUESTION'	=> 'Chi ha scritto questo programma?',

	'HELP_FAQ_LOGIN_AUTO_LOGOUT_ANSWER'	=> 'Se non selezioni <em>Ricordami</em> quando effettui il login, il sistema ti terrà connesso per un periodo prestabilito. Questo serve a evitare che qualcuno possa usare il tuo nome utente. Per rimanere connesso, seleziona l’opzione quando entri, ma ricorda che questo non è consigliato se ti colleghi da un PC usato anche da altri, ad es. in biblioteca, Internet point, università, ecc. Se non vedi il checkbox, significa che un amministratore ha disabilitato questa caratteristica.',
	'HELP_FAQ_LOGIN_AUTO_LOGOUT_QUESTION'	=> 'Perché vengo disconnesso automaticamente?',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANSWER'	=> 'Ci sono svariati motivi per cui questo succede. Per prima cosa controlla che nome utente e password siano corretti. Di solito il problema è questo, altrimenti contatta un amministratore: potresti essere stato bannato o potrebbe esserci un errore di configurazione.',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANYMORE_ANSWER'	=> 'È possibile che un amministratore abbia cancellato o disattivato il tuo account per qualche ragione. Molti siti rimuovono periodicamente gli account degli utenti che non hanno mai inviato messaggi, per ridurre la grandezza del database. Se il motivo è quest’ultimo registrati nuovamente e cerca di farti coinvolgere maggiormente nelle discussioni.',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANYMORE_QUESTION'	=> 'Mi sono registrato tempo fa, ma non riesco più a connettermi?!',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_QUESTION'	=> 'Perché non riesco a connettermi?',
	'HELP_FAQ_LOGIN_CANNOT_REGISTER_ANSWER'	=> 'È possibile che l’amministratore della Board abbia bannato il tuo indirizzo IP oppure vietato il nome utente che stai tentando di registrare. Può anche aver disabilitato le registrazioni per impedire ai nuovi visitatori di registrarsi. Contatta un amministratore per avere assistenza.',
	'HELP_FAQ_LOGIN_CANNOT_REGISTER_QUESTION'	=> 'Perché non riesco a registrarmi?',
	'HELP_FAQ_LOGIN_COPPA_ANSWER'	=> 'COPPA, o Legge sulla Privacy per la protezione dei minori del 1998, è una legge statunitense che autorizza i siti web a raccogliere informazioni da i minori di età inferiore a 13 anni. Per avere tale consenso serve una richiesta scritta da parte del genitore o tutore legale, permettendo la registrazione delle informazioni scritte dal minore. Se hai dubbi o incertezze, mettiti in contatto con un consulente legale per assistenza. Nota bene che phpBB Limited e il proprietario di questa Board non possono fornire consigli legali e non sono un punto di contatto per questioni legali di qualsiasi tipo, ad eccezione di quanto indicato nella domanda “Chi devo contattare per segnalare abusi e/o per questioni d’ordine legale concernenti questa Board?”.',
	'HELP_FAQ_LOGIN_COPPA_QUESTION'	=> 'Che cosa è COPPA?',
	'HELP_FAQ_LOGIN_DELETE_COOKIES_ANSWER'	=> 'La funzione “Cancella cookie” eliminerà tutti i cookie generati da phpBB che ti mantengono autenticato e connesso, oltre a permetterti ad esempio di tenere traccia di quello che hai letto, se l’amministrazione ha attivato la funzione. Se hai avuto problemi di accesso o di uscita dal sistema, la cancellazione dei cookie potrebbe risolvere tali disguidi.',
	'HELP_FAQ_LOGIN_DELETE_COOKIES_QUESTION'	=> 'Che cosa provoca il comando “Cancella cookie”?',
	'HELP_FAQ_LOGIN_LOST_PASSWORD_ANSWER'	=> 'Niente panico! La tua password non può essere recuperata, ma può essere rigenerata. Per far questo vai nella pagina di ingresso e clicca su <em>Ho dimenticato la password</em>, segui le istruzioni e tornerai in linea in poco tempo. Se riscontri difficoltà, contatta l’amministratore.',
	'HELP_FAQ_LOGIN_LOST_PASSWORD_QUESTION'	=> 'Ho perso la mia password!',
	'HELP_FAQ_LOGIN_REGISTER_ANSWER'	=> 'Potresti non averne bisogno: dipende dagli amministratori se è necessario registrarsi per inviare messaggi. Comunque, la registrazione ti darà accesso ad altre funzioni che non sono disponibili per gli utenti ospiti come l’uso di un’immagine personale definibile, messaggistica privata, la possibilità di inviare messaggi di posta direttamente dal forum, l’iscrizione a gruppi utenti, ecc. Ti bastano pochi secondi per registrarti e quindi ti raccomandiamo di farlo.',
	'HELP_FAQ_LOGIN_REGISTER_CONFIRM_ANSWER'	=> 'Innanzitutto controlla di aver inserito nome utente e password esattamente. Se sono corretti, allora possono esser successe un paio di cose: se il supporto «registrazione minore» è abilitato e hai cliccato su <em>Ho meno di 13 anni</em> mentre ti stavi registrando, allora devi seguire le istruzioni che hai ricevuto. Se questo non è il tuo caso, forse devi attivare il tuo account. Alcune Board richiedono che tutte le nuove registrazioni vengano attivate dall’utente stesso o dagli amministratori, prima di poter accedere. Quando ti registri ti verrà indicato che tipo di attivazione è richiesta. Se ti è stato inviato un messaggio di posta, allora segui le istruzioni; se non hai ricevuto nessun messaggio... sei sicuro che il tuo indirizzo di posta sia valido? (L’attivazione via posta serve a ridurre la possibilità di avere utenti anonimi che abusano della Board.) Se sei sicuro che l’indirizzo di posta che hai usato sia corretto, allora prova a contattare un amministratore.',
	'HELP_FAQ_LOGIN_REGISTER_CONFIRM_QUESTION'	=> 'Mi sono registrato ma non riesco a connettermi!',
	'HELP_FAQ_LOGIN_REGISTER_QUESTION'	=> 'Perché devo registrarmi?',

	'HELP_FAQ_PMS_CANNOT_SEND_ANSWER'	=> 'Ci sono tre ragioni per cui questo può accadere: non sei registrato o non hai effettuato l’accesso, l’amministratore ha disabilitato i messaggi privati per tutto il Forum, oppure li ha disabilitati solo a te. Se il tuo caso è l’ultimo, prova a chiederne il motivo all’amministratore.',
	'HELP_FAQ_PMS_CANNOT_SEND_QUESTION'	=> 'Non riesco ad inviare messaggi privati!',
	'HELP_FAQ_PMS_SPAM_ANSWER'	=> 'Ci dispiace. Il sistema di invio di posta elettronica di questa Board include un sistema di protezione per risalire a chi manda questi messaggi. Dovresti mandare una copia del messaggio in questione all’amministratore, includendo anche l’intestazione, in modo che possa intervenire.',
	'HELP_FAQ_PMS_SPAM_QUESTION'	=> 'Ho ricevuto un messaggio di posta indesiderata o spam da qualcuno in questa Board!',
	'HELP_FAQ_PMS_UNWANTED_ANSWER'	=> 'È possibile eliminare automaticamente i messaggi privati ​​di un utente utilizzando le regole dei messaggi all’interno del tuo Pannello di Controllo Utente. Se si ricevono messaggi privati ​​abusivi da un particolare utente, segnala i messaggi ai moderatori; essi hanno il potere di impedire a un utente di inviare messaggi privati​​.',
	'HELP_FAQ_PMS_UNWANTED_QUESTION'	=> 'Continuano ad arrivarmi messaggi privati indesiderati!',

	'HELP_FAQ_POSTING_BUMP_ANSWER'	=> 'Cliccando sul collegamento “Argomento in cima” mentre lo stai leggendo, puoi spostarlo in cima alla lista, nella prima pagina. Se non lo vedi, significa che questa opzione è disabilitata. È anche possibile spostare in cima gli argomenti semplicemente inserendovi un messaggio. Tuttavia, sii sicuro di rispettare le regole del forum in cui ti trovi.',
	'HELP_FAQ_POSTING_BUMP_QUESTION'	=> 'Come posso spostare in cima un mio argomento?',
	'HELP_FAQ_POSTING_CREATE_ANSWER'	=> 'Per pubblicare un nuovo argomento in un forum, clicca su “Nuovo argomento”. Per pubblicare una risposta ad un argomento, clicca su “Rispondi”. Potresti avere bisogno di registrarti prima di poter inviare un messaggio: le tue funzioni disponibili sono elencate in fondo alla pagina del forum o dell’argomento (la lista <em>Puoi aprire nuovi argomenti</em>, <em>Puoi votare nei sondaggi</em>, ecc.).',
	'HELP_FAQ_POSTING_CREATE_QUESTION'	=> 'Come apro un argomento o invio un messaggio in un forum?',
	'HELP_FAQ_POSTING_DRAFT_ANSWER'	=> 'La funzione ti permette di salvare bozze di messaggi da completare e inviare in seguito. Per utilizzarle vai nell’apposita sezione del Pannello di Controllo Utente.',
	'HELP_FAQ_POSTING_DRAFT_QUESTION'	=> 'Che cos’è il pulsante “Salva” nella finestra di invio dei messaggi?',
	'HELP_FAQ_POSTING_EDIT_DELETE_ANSWER'	=> 'Puoi modificare o cancellare solo i tuoi messaggi, a meno che tu non sia un amministratore o un moderatore. Puoi cancellare un messaggio premendo il pulsante con la «X» nel messaggio che vuoi eliminare. Puoi modificare un messaggio (a volte solo per un limitato periodo di tempo dopo il suo inserimento) premendo il pulsante <em>modifica</em> nel messaggio in questione. Se qualcuno ha già risposto al tuo messaggio, quando effettui una modifica, potresti trovare del testo aggiunto dove viene indicato quante volte l’hai modificato. Un utente normale, generalmente, non può cancellare un messaggio dopo che qualcuno ha risposto.',
	'HELP_FAQ_POSTING_EDIT_DELETE_QUESTION'	=> 'Come modifico o cancello un messaggio?',
	'HELP_FAQ_POSTING_FORUM_RESTRICTED_ANSWER'	=> 'Alcuni forum potrebbero essere riservati a determinati utenti o gruppi. Per leggere, scrivere, rispondere, ecc., potresti aver bisogno di autorizzazioni speciali, che solo i moderatori e l’amministratore possono concedere.',
	'HELP_FAQ_POSTING_FORUM_RESTRICTED_QUESTION'	=> 'Perché non riesco ad accedere a un forum?',
	'HELP_FAQ_POSTING_NO_ATTACHMENTS_ANSWER'	=> 'La possibilità di aggiungere allegati può essere concessa per forum, per gruppi o per utenti specifici. L’amministratore potrebbe non aver permesso allegati per il forum in cui stai scrivendo, oppure solo il gruppo degli amministratori può aggiungere allegati. Chiedi all’amministratore se non sei sicuro del motivo per cui non riesci ad aggiungere allegati.',
	'HELP_FAQ_POSTING_NO_ATTACHMENTS_QUESTION'	=> 'Perché non riesco ad aggiungere allegati?',
	'HELP_FAQ_POSTING_POLL_ADD_ANSWER'	=> 'Il limite per le opzioni del sondaggio è impostato dall’amministratore. Se senti il bisogno di aggiungere ulteriori opzioni di risposta a quelle consentite, contatta l’amministratore del Forum.',
	'HELP_FAQ_POSTING_POLL_ADD_QUESTION'	=> 'Perché non è possibile aggiungere ulteriori opzioni del sondaggio?',
	'HELP_FAQ_POSTING_POLL_CREATE_ANSWER'	=> 'Creare un sondaggio è facile: quando inizi un nuovo argomento (o quando modifichi il primo messaggio di un argomento, se ti è permesso) dovresti vedere, sotto lo spazio per l’inserimento del messaggio, un riquadro dal titolo <em>Aggiungi sondaggio</em> (se non lo vedi, probabilmente non hai il diritto di creare sondaggi). Basta inserire un titolo per il sondaggio e almeno due opzioni di risposta (per inserire un’opzione di risposta, scrivila nell’apposito spazio e clicca su <em>Aggiungi un’opzione</em>). Puoi anche stabilire i giorni di durata del sondaggio (0 per non porre limiti). C’è un limite al numero di opzioni di risposta che puoi aggiungere, stabilito dall’amministratore.',
	'HELP_FAQ_POSTING_POLL_CREATE_QUESTION'	=> 'Come creo un sondaggio?',
	'HELP_FAQ_POSTING_POLL_EDIT_ANSWER'	=> 'Come per i messaggi, i sondaggi possono essere modificati e cancellati solo dai rispettivi autori, dai moderatori e dall’amministratore. Per modificare un sondaggio, clicca sul pulsante <em>Modifica</em> del primo messaggio (a cui è sempre associato il sondaggio). Se nessuno ha ancora votato, il sondaggio può essere modificato o cancellato, altrimenti solo i moderatori e l’amministratore possono farlo. Il limite per le opzioni del sondaggio è impostato dall’amministratore. Se vuoi aggiungere ulteriori opzioni, contatta l’amministratore.',
	'HELP_FAQ_POSTING_POLL_EDIT_QUESTION'	=> 'Come modifico o cancello un sondaggio?',
	'HELP_FAQ_POSTING_QUEUE_ANSWER'	=> 'L’amministratore può decidere che in un forum i messaggi inseriti devono prima essere controllati. È inoltre possibile che l’amministratore ti abbia inserito in un gruppo di utenti i cui messaggi ritiene che vadano controllati prima di essere resi visibili. Contatta l’amministratore per maggiori informazioni.',
	'HELP_FAQ_POSTING_QUEUE_QUESTION'	=> 'Perché il mio messaggio deve essere approvato?',
	'HELP_FAQ_POSTING_REPORT_ANSWER'	=> 'Se l’amministratore l’ha permesso, vai al messaggio che vuoi segnalare: dovresti vedere un pulsante che serve per fare la segnalazione dei messaggi. Cliccandolo sarai introdotto alla procedura necessaria per la segnalazione dei messaggi.',
	'HELP_FAQ_POSTING_REPORT_QUESTION'	=> 'Come posso segnalare messaggi ai moderatori?',
	'HELP_FAQ_POSTING_SIGNATURE_ANSWER'	=> 'Per aggiungere una firma ad un messaggio devi prima crearne una tramite il Pannello di Controllo Utente. Una volta creata, è possibile selezionare l’opzione <em>Aggiungi la firma</em> nel modulo di invio. È inoltre possibile aggiungere una firma a tutti i tuoi messaggi selezionando l’apposita voce nel Pannello di Controllo Utente. Se lo si fa, è possibile evitare che una firma venga aggiunta ai singoli messaggi deselezionando la casella per aggiungere la firma all’interno del modulo di invio.',
	'HELP_FAQ_POSTING_SIGNATURE_QUESTION'	=> 'Come aggiungo una firma ai miei messaggi?',
	'HELP_FAQ_POSTING_WARNING_ANSWER'	=> 'Ciascun amministratore ha una propria serie di regole per la propria Board. Se pensa che tu ne abbia infranta una, può mandarti un richiamo. Ti preghiamo di notare che questa è una decisione dell’amministratore, e phpBB Limited non ha niente a che fare con questi richiami.',
	'HELP_FAQ_POSTING_WARNING_QUESTION'	=> 'Perché ho ricevuto un richiamo?',

	'HELP_FAQ_SEARCH_BLANK_ANSWER'	=> 'La tua ricerca ha dato troppi risultati per le capacità di calcolo del server. Usa la ricerca avanzata e sii più specifico nella tua scelta dei termini da ricercare e dei forum in cui cercare.',
	'HELP_FAQ_SEARCH_BLANK_QUESTION'	=> 'Perché la mia ricerca dà come risultato una pagina vuota?',
	'HELP_FAQ_SEARCH_FORUM_ANSWER'	=> 'Scrivendo una parola chiave nel riquadro di ricerca visibile nell’Indice, nei forum e negli argomenti. Alla ricerca avanzata si può accedere premendo il collegamento “Cerca” visibile in tutte le pagine. Ci  possono essere differenze in base allo stile utilizzato.',
	'HELP_FAQ_SEARCH_FORUM_QUESTION'	=> 'Come si fanno le ricerche nella Board?',
	'HELP_FAQ_SEARCH_MEMBERS_ANSWER'	=> 'Vai nella pagina “Utenti” e clicca sul collegamento “trova utente”.',
	'HELP_FAQ_SEARCH_MEMBERS_QUESTION'	=> 'Come posso cercare un utente?',
	'HELP_FAQ_SEARCH_NO_RESULT_ANSWER'	=> 'Probabilmente la tua ricerca è troppo vaga e include dei termini troppo comuni che non sono indicizzati da phpBB3. Sii più specifico e usa le opzioni disponibili nella ricerca avanzata.',
	'HELP_FAQ_SEARCH_NO_RESULT_QUESTION'	=> 'Perché la mia ricerca non dà risultati?',
	'HELP_FAQ_SEARCH_OWN_ANSWER'	=> 'Puoi trovare i messaggi da te inseriti cliccando su “Mostra i tuoi messaggi” presente nel tuo Pannello di Controllo Utente, e su “Cerca i messaggi dell’utente” presente nella pagina del tuo profilo. Puoi cercare i tuoi argomenti, usando la pagina di ricerca avanzata, compilando i vari campi opportunamente. Puoi comunque trovare rapidamente i tuoi messaggi, cliccando sull’omonima funzione “I tuoi messaggi”, generalmente disponibile in ogni pagina della Board.',
	'HELP_FAQ_SEARCH_OWN_QUESTION'	=> 'Come posso trovare i miei messaggi e i miei argomenti?',

	'HELP_FAQ_USERSETTINGS_AVATAR_ANSWER'	=> 'Ci possono essere due immagini sotto un nome utente quando si leggono i messaggi. La prima è l’immagine associata al tuo grado, generalmente ha la forma di stelle, blocchi o punti che indicano quanti interventi hai scritto o il tuo livello. Sotto può esserci un’immagine più grande nota come avatar, che in genere è unica e specifica per ogni utente.',
	'HELP_FAQ_USERSETTINGS_AVATAR_DISPLAY_ANSWER'	=> 'All’interno del tuo Pannello di Controllo Utente, sotto “Profilo” è possibile aggiungere un avatar utilizzando uno dei seguenti quattro metodi: Gravatar, Galleria, Remoto oppure Carica. L’amministratore decide se abilitare o meno gli avatar e decide anche il modo in cui gli avatar sono messi a disposizione. Se non ti è concesso l’uso degli avatar, allora è una decisione dell’amministrazione, e devi chiedere a questa le ragioni.',
	'HELP_FAQ_USERSETTINGS_AVATAR_DISPLAY_QUESTION'	=> 'Come posso inserire un avatar?',
	'HELP_FAQ_USERSETTINGS_AVATAR_QUESTION'	=> 'Come posso mostrare un’immagine sotto il mio nome utente?',
	'HELP_FAQ_USERSETTINGS_CHANGE_SETTINGS_ANSWER'	=> 'Se sei un utente registrato, tutte le tue impostazioni sono conservate nel database del sistema. Per modificarle vai sul tuo Pannello di Controllo Utente; generalmente sta in cima ad ogni pagina, ma questo potrebbe non essere sempre vero. Questo ti permetterà di cambiare tutte le tue impostazioni e le preferenze.',
	'HELP_FAQ_USERSETTINGS_CHANGE_SETTINGS_QUESTION'	=> 'Come cambio le mie impostazioni?',
	'HELP_FAQ_USERSETTINGS_EMAIL_LOGIN_ANSWER'	=> 'Solo gli utenti registrati possono inviare messaggi di posta ad altri utenti usando il modulo di invio posta interno (ammesso, ovviamente, che gli amministratori abbiano abilitato questa funzione). Questo serve a prevenire un uso scorretto o malevolo del sistema di posta da parte di utenti anonimi.',
	'HELP_FAQ_USERSETTINGS_EMAIL_LOGIN_QUESTION'	=> 'Perché quando clicco sul collegamento all’indirizzo di posta di un utente mi chiede di accedere come utente registrato?',
	'HELP_FAQ_USERSETTINGS_HIDE_ONLINE_ANSWER'	=> 'Nel Pannello di Controllo Utente, sotto “Preferenze”, trovi l’opzione <em>Nascondi il tuo stato in linea</em>. Attivando questa opzione, apparirai solo agli amministratori e a te stesso. Verrai identificato come utente nascosto.',
	'HELP_FAQ_USERSETTINGS_HIDE_ONLINE_QUESTION'	=> 'Come posso evitare di apparire nella lista degli utenti in linea?',
	'HELP_FAQ_USERSETTINGS_LANGUAGE_ANSWER'	=> 'L’amministratore potrebbe non aver installato il pacchetto lingua oppure nessuno lo ha tradotto nella tua lingua. Prova a chiedere agli amministratori se è possibile installare la tua lingua. Se non esiste puoi fare tu una nuova traduzione. Puoi trovare altre informazioni sul sito di phpBB Limited (trovi il collegamento in fondo ad ogni pagina).',
	'HELP_FAQ_USERSETTINGS_LANGUAGE_QUESTION'	=> 'La mia lingua non è nella lista!',
	'HELP_FAQ_USERSETTINGS_RANK_ANSWER'	=> 'I livelli, compaiono sotto al tuo nome utente, e indicano il numero di messaggi che hai inviato oppure identificano alcuni utenti, ad esempio, moderatori e amministratori. In genere, non puoi cambiare direttamente il tuo livello. Non abusare del Forum inviando messaggi non necessari solo per aumentare il tuo livello. La maggior parte dei Forum non tollera questo comportamento e l’amministratore probabilmente abbasserà il numero dei tuoi messaggi.',
	'HELP_FAQ_USERSETTINGS_RANK_QUESTION'	=> 'Qual è il mio livello e come faccio a cambiarlo?',
	'HELP_FAQ_USERSETTINGS_SERVERTIME_ANSWER'	=> 'Se sei sicuro di aver impostato il fuso orario corretto e l’ora è ancora scorretta, allora l’orario memorizzato sull’orologio del server non è corretto. Avvisa un amministratore per correggere il problema.',
	'HELP_FAQ_USERSETTINGS_SERVERTIME_QUESTION'	=> 'Ho cambiato il fuso orario ma l’ora è ancora sbagliata',
	'HELP_FAQ_USERSETTINGS_TIMEZONE_ANSWER'	=> 'L’ora è quasi sicuramente corretta, comunque l’ora che stai vedendo potrebbe essere quella di un fuso orario differente dal tuo. Se così fosse, devi cambiare le impostazioni del tuo profilo per il fuso orario e farlo coincidere con la tua area, es. London, Paris, New York, Sydney, ecc. Nota che solo gli utenti registrati possono cambiare il fuso orario e molte impostazioni.',
	'HELP_FAQ_USERSETTINGS_TIMEZONE_QUESTION'	=> 'L’ora non è corretta!',
));
