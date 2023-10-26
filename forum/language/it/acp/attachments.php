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
	'ACP_ATTACHMENT_SETTINGS_EXPLAIN'	=> 'Da qui puoi configurare le caratteristiche principali degli allegati e delle categorie speciali collegate.',
	'ACP_EXTENSION_GROUPS_EXPLAIN'		=> 'Da qui puoi aggiungere, cancellare o modificare i gruppi di estensioni, puoi disabilitare tali gruppi, assegnare categorie speciali ad essi, cambiare il meccanismo di download e definire l’icona di upload che sarà visualizzata davanti all’allegato che appartiene a quel gruppo.',
	'ACP_MANAGE_EXTENSIONS_EXPLAIN'		=> 'Da qui puoi gestire le estensioni permesse. Per attivare le estensioni, fai riferimento al gruppo di estensione. Consigliamo di non permettere estensioni script (come <code>php</code>, <code>php3</code>, <code>php4</code>, <code>phtml</code>, <code>pl</code>, <code>cgi</code>, <code>py</code>, <code>rb</code>, <code>asp</code>, <code>aspx</code>, ecc…).',
	'ACP_ORPHAN_ATTACHMENTS_EXPLAIN'	=> 'Da qui puoi vedere gli allegati presenti nella cartella di upload che non sono stati assegnati a nessun messaggio. Questo può capitare perché alcune volte gli utenti allegano il file al messaggio senza poi inviarlo. Quindi puoi cancellare il file o allegarlo a qualche messaggio esistente. Per allegare il file ad un messaggio viene richiesto l’ID del messaggio che dovrai recuperare; questa caratteristica è utilizzata principalmente per quelle persone che vogliono caricare i file (spesso di grosse dimensioni) con un altro programma e assegnarlo a un messaggio esistente.',
	'ADD_EXTENSION'						=> 'Aggiungi estensione',
	'ADD_EXTENSION_GROUP'				=> 'Aggiungi gruppo di estensioni',
	'ADMIN_UPLOAD_ERROR'				=> 'Si è verificato un errore tentando di allegare il file: “%s”.',
	'ALLOWED_FORUMS'					=> 'Forum abilitati',
	'ALLOWED_FORUMS_EXPLAIN'			=> 'Permetti di allegare file nei messaggi dei forum selezionati (o tutti se selezionati).',
	'ALLOWED_IN_PM_POST'				=> 'Permetti',
	'ALLOW_ATTACHMENTS'					=> 'Permetti allegati',
	'ALLOW_ALL_FORUMS'					=> 'Permetti in tutti i forum',
	'ALLOW_IN_PM'						=> 'Permetti nei messaggi privati',
	'ALLOW_PM_ATTACHMENTS'				=> 'Permetti allegati nei messaggi privati',
	'ALLOW_SELECTED_FORUMS'				=> 'Solo i forum selezionati di seguito',
	'ASSIGNED_EXTENSIONS'				=> 'Estensioni assegnate',
	'ASSIGNED_GROUP'					=> 'Gruppo di estensioni assegnato',
	'ATTACH_EXTENSIONS_URL'				=> 'Estensioni',
	'ATTACH_EXT_GROUPS_URL'				=> 'Gruppi di estensioni',
	'ATTACH_ID'							=> 'ID',
	'ATTACH_MAX_FILESIZE'				=> 'Dimensione massima',
	'ATTACH_MAX_FILESIZE_EXPLAIN'		=> 'Dimensione massima di ogni file. Se questo valore è uguale a 0, la dimensione del file inviabile sarà limitata solo dalla configurazione PHP.',
	'ATTACH_MAX_PM_FILESIZE'			=> 'Dimensione massima messaggi privati',
	'ATTACH_MAX_PM_FILESIZE_EXPLAIN'	=> 'Dimensione massima di ogni file (0 = illimitata) allegato ai messaggi privati.',
	'ATTACH_ORPHAN_URL'					=> 'Allegati orfani',
	'ATTACH_POST_ID'					=> 'ID messaggio',
	'ATTACH_POST_TYPE'					=> 'Tipo di messaggio',
	'ATTACH_QUOTA'						=> 'Quota massima allegati',
	'ATTACH_QUOTA_EXPLAIN'				=> 'Dimensione massima riservata su disco per tutti gli allegati; 0 = illimitata.',
	'ATTACH_TO_POST'					=> 'Allega file al messaggio',

	'CAT_IMAGES'				=> 'Immagini',
	'CHECK_CONTENT'             => 'Controlla allegati',
	'CHECK_CONTENT_EXPLAIN'		=> 'Alcuni browser possono essere ingannati nell’accettare un mimetype incorretto per i file da caricare. Questa opzione garantisce che i file che possono causare questo problema vengano respinti.',
	'CREATE_GROUP'				=> 'Crea nuovo gruppo',
	'CREATE_THUMBNAIL'			=> 'Crea miniatura',
	'CREATE_THUMBNAIL_EXPLAIN'	=> 'Crea miniatura in tutte le situazioni possibili.',

	'DEFINE_ALLOWED_IPS'			=> 'Definisci IP/Hostname abilitati',
	'DEFINE_DISALLOWED_IPS'			=> 'Definisci IP/Hostname non abilitati',
	'DOWNLOAD_ADD_IPS_EXPLAIN'		=> 'Puoi specificare più IP o Hostname contemporaneamente inserendone uno per linea. Per specificare un intervallo di indirizzi separa l’inizio e la fine con un trattino (-), per indirizzi parziali usa il carattere “*”.',
	'DOWNLOAD_REMOVE_IPS_EXPLAIN'	=> 'Puoi eliminare (o non escludere) più indirizzi IP alla volta servendoti della combinazione di mouse e tastiera più appropriata per il tuo tipo di computer e browser. Gli IP esclusi hanno uno sfondo blu.',
	'DISPLAY_INLINED'				=> 'Visualizza le immagini in linea con il testo',
	'DISPLAY_INLINED_EXPLAIN'		=> 'Se imposti No le immagini allegate verranno visualizzate come collegamento.',
	'DISPLAY_ORDER'					=> 'Ordine visualizzazione allegati',
	'DISPLAY_ORDER_EXPLAIN'			=> 'Visualizza gli allegati in ordine di tempo.',

	'EDIT_EXTENSION_GROUP'			=> 'Modifica gruppo di estensioni',
	'EXCLUDE_ENTERED_IP'			=> 'Permetti di escludere l’IP/Hostname inserito.',
	'EXCLUDE_FROM_ALLOWED_IP'		=> 'Escludi IP dagli IP/Hostname abilitati',
	'EXCLUDE_FROM_DISALLOWED_IP'	=> 'Escludi IP dagli IP/Hostname non abilitati',
	'EXTENSIONS_UPDATED'			=> 'Estensioni aggiornate.',
	'EXTENSION_EXIST'				=> 'L’estensione %s esiste già.',
	'EXTENSION_GROUP'				=> 'Gruppo di estensioni',
	'EXTENSION_GROUPS'				=> 'Gruppi di estensioni',
	'EXTENSION_GROUP_DELETED'		=> 'Gruppo di estensioni eliminato.',
	'EXTENSION_GROUP_EXIST'			=> 'Il gruppo di estensioni %s esiste già.',

	'EXT_GROUP_ARCHIVES'			=> 'Archivi',
	'EXT_GROUP_DOCUMENTS'			=> 'Documenti',
	'EXT_GROUP_DOWNLOADABLE_FILES'	=> 'File scaricabili',
	'EXT_GROUP_IMAGES'				=> 'Immagini',
	'EXT_GROUP_PLAIN_TEXT'			=> 'Testo normale',

	'FILES_GONE'			=> 'Alcuni degli allegati che hai selezionato per la cancellazione non esistono. Potrebbero essere stati cancellati. Gli allegati esistenti sono stati cancellati.',
	'FILES_STATS_WRONG'		=> 'Le statistiche su file probabilmente sono inaccurate e necessitano di essere sincronizzate nuovamente. Valori attuali: numero di allegati = %1$d, dimensione totale degli allegati = %2$s.<br />Clicca %3$squi%4$s per sincronizzarli.',

	'GO_TO_EXTENSIONS'		=> 'Vai al pannello di amministrazione estensioni',
	'GROUP_NAME'			=> 'Nome gruppo',

	'IMAGE_LINK_SIZE'			=> 'Dimensione collegamento immagine',
	'IMAGE_LINK_SIZE_EXPLAIN'	=> 'Se l’immagine allegata supera le dimensioni impostate viene visualizzata come collegamento; imposta 0px e 0px per disabilitare questa funzione.',

	'IMAGE_QUALITY'				=> 'Qualità delle immagini allegate (solo JPEG)',
	'IMAGE_QUALITY_EXPLAIN'		=> 'Specificare un valore compreso tra 50% (dimensione minore del file) e 90% (qualità superiore). Una qualità superiore al 90% aumenta la dimensione del file ed è disabilitata. L’impostazione si applica solo se le dimensioni massime dell’immagine sono impostate su un valore diverso da 0px per 0px.',
	'IMAGE_STRIP_METADATA'		=> 'Elimina metadati dell’immagine (solo JPEG)',
	'IMAGE_STRIP_METADATA_EXPLAIN'	=> 'Elimina metadati Exif, ad es. nome dell’autore, coordinate GPS e dettagli della fotocamera. L’impostazione si applica solo se le dimensioni massime dell’immagine sono impostate su un valore diverso da 0px per 0px.',
	
	'MAX_ATTACHMENTS'				=> 'Numero massimo di allegati per messaggio',
	'MAX_ATTACHMENTS_PM'			=> 'Numero massimo di allegati per messaggio privato',
	'MAX_EXTGROUP_FILESIZE'			=> 'Dimensione massima file',
	'MAX_IMAGE_SIZE'				=> 'Dimensione massima immagine',
	'MAX_IMAGE_SIZE_EXPLAIN'		=> 'Dimensioni massime delle immagini allegate; impostando entrambi i valori a 0px per 0px si disabilita il controllo di dimensione.',
	'MAX_THUMB_WIDTH'				=> 'Larghezza/altezza massima miniatura in pixel',
	'MAX_THUMB_WIDTH_EXPLAIN'		=> 'La miniatura generata non avrà una larghezza superiore a quella impostata qui.',
	'MIN_THUMB_FILESIZE'			=> 'Dimensioni minime per miniatura',
	'MIN_THUMB_FILESIZE_EXPLAIN'	=> 'Non crea miniature per immagini con dimensioni inferiori a queste.',
	'MODE_INLINE'					=> 'In linea con il testo',
	'MODE_PHYSICAL'					=> 'Fisico',

	'NOT_ALLOWED_IN_PM'			=> 'Non permesso nei messaggi privati',
	'NOT_ALLOWED_IN_PM_POST'	=> 'Non permesso',
	'NOT_ASSIGNED'				=> 'Non assegnato',
	'NO_ATTACHMENTS'			=> 'Non sono stati trovati allegati per questo periodo.',
	'NO_EXT_GROUP'				=> 'Nessuno',
	'NO_EXT_GROUP_ALLOWED_PM'	=> 'Non sono presenti <a href="%s">gruppi di estensioni consentite</a> per i messaggi privati.',
	'NO_EXT_GROUP_ALLOWED_POST'	=> 'Non sono presenti <a href="%s">gruppi di estensioni consentite</a> per i messaggi',
	'NO_EXT_GROUP_NAME'			=> 'Nessun nome gruppo inserito',
	'NO_EXT_GROUP_SPECIFIED'	=> 'Nessun gruppo di estensioni specificato.',
	'NO_FILE_CAT'				=> 'Nessuna',
	'NO_IMAGE'					=> 'Nessuna immagine',
	'NO_UPLOAD_DIR'				=> 'La cartella upload specificata non esiste.',
	'NO_WRITE_UPLOAD'			=> 'Cartella upload priva di permessi: modifica i permessi CHMOD della cartella in 777.',

	'ONLY_ALLOWED_IN_PM'	=> 'Permesso solo nei messaggi privati',
	'ORDER_ALLOW_DENY'		=> 'Permesso',
	'ORDER_DENY_ALLOW'		=> 'Negato',

	'REMOVE_ALLOWED_IPS'			=> 'Rimuovi o non escludere IP/hostnames <em>ammessi</em>',
	'REMOVE_DISALLOWED_IPS'			=> 'Rimuovi o non escludere IP/hostnames <em>non ammessi</em>',
	'RESYNC_FILES_STATS_CONFIRM'	=> 'Sei sicuro di voler sincronizzare nuovamente le statiche dei file?',

	'SECURE_ALLOW_DENY'				=> 'Permetti/Nega lista',
	'SECURE_ALLOW_DENY_EXPLAIN'		=> 'Modifica il comportamento predefinito quando i download sicuri sono abilitati sulla lista Permesso/Negato a quella di <strong>whitelist</strong> (permesso) o di <strong>blacklist</strong> (negato).',
	'SECURE_DOWNLOADS'				=> 'Permetti download sicuri',
	'SECURE_DOWNLOADS_EXPLAIN'		=> 'Abilitando questa opzione i download sono limitati agli IP/Hostname che tu definisci.',
	'SECURE_DOWNLOAD_NOTICE'		=> 'Download sicuro non abilitato. Le impostazioni seguenti saranno applicate solo dopo aver abilitato il download sicuro.',
	'SECURE_DOWNLOAD_UPDATE_SUCCESS'=> 'La lista IP è stata aggiornata.',
	'SECURE_EMPTY_REFERRER'			=> 'Abilita i referer vuoti',
	'SECURE_EMPTY_REFERRER_EXPLAIN'	=> 'Il download sicuro è basato sui referer. Vuoi permettere i download per quelli che omettono i referer?',
	'SETTINGS_CAT_IMAGES'			=> 'Impostazioni categoria immagini',
	'SPECIAL_CATEGORY'				=> 'Categoria speciale',
	'SPECIAL_CATEGORY_EXPLAIN'		=> 'Le categorie speciali differiscono nel modo di presentazione all’interno dei messaggi.',
	'SUCCESSFULLY_UPLOADED'			=> 'Caricato.',
	'SUCCESS_EXTENSION_GROUP_ADD'	=> 'Gruppo di estensioni aggiunto.',
	'SUCCESS_EXTENSION_GROUP_EDIT'	=> 'Gruppo di estensioni aggiornato.',

	'UPLOADING_FILES'				=> 'Caricamento dei file',
	'UPLOADING_FILE_TO'				=> 'Caricamento file "%1$s" nel messaggio numero %2$d…',
	'UPLOAD_DENIED_FORUM'			=> 'Non hai i permessi per caricare file al forum “%s”.',
	'UPLOAD_DIR'					=> 'Cartella upload',
	'UPLOAD_DIR_EXPLAIN'			=> 'Percorso della cartella allegati. NOTA BENE: se cambi questo dato quando degli allegati sono già stati caricati, questi dovranno essere spostati/copiati manualmente alla nuova posizione.',
	'UPLOAD_ICON'					=> 'Icona upload',
	'UPLOAD_NOT_DIR'				=> 'L’indirizzo specificato non sembra essere una cartella.',
	
	'UPLOAD_POST_NOT_EXIST'			=> 'Impossibile caricare il file “%1$s” nel post numero %2$d poichè il post non esiste.',
	
));
