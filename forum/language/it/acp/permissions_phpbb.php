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

/**
*	EXTENSION-DEVELOPERS PLEASE NOTE
*
*	You are able to put your permission sets into your extension.
*	The permissions logic should be added via the 'core.permissions' event.
*	You can easily add new permission categories, types and permissions, by
*	simply merging them into the respective arrays.
*	The respective language strings should be added into a language file, that
*	start with 'permissions_', so they are automatically loaded within the ACP.
*/

$lang = array_merge($lang, array(
	'ACL_CAT_ACTIONS'		=> 'Azioni',
	'ACL_CAT_CONTENT'		=> 'Contenuti',
	'ACL_CAT_FORUMS'		=> 'Forum',
	'ACL_CAT_MISC'			=> 'Misti',
	'ACL_CAT_PERMISSIONS'	=> 'Permessi',
	'ACL_CAT_PM'			=> 'Messaggi privati',
	'ACL_CAT_POLLS'			=> 'Sondaggi',
	'ACL_CAT_POST'			=> 'Messaggio',
	'ACL_CAT_POST_ACTIONS'	=> 'Azioni messaggio',
	'ACL_CAT_POSTING'		=> 'Inserire',
	'ACL_CAT_PROFILE'		=> 'Profilo',
	'ACL_CAT_SETTINGS'		=> 'Impostazioni',
	'ACL_CAT_TOPIC_ACTIONS'	=> 'Azioni argomento',
	'ACL_CAT_USER_GROUP'	=> 'Utenti &amp; Gruppi',
));

// User Permissions
$lang = array_merge($lang, array(
	'ACL_U_VIEWPROFILE'	=> 'Può vedere profili, lista utenti e utenti online',
	'ACL_U_CHGNAME'		=> 'Può cambiare il nome utente',
	'ACL_U_CHGPASSWD'	=> 'Può modificare la password',
	'ACL_U_CHGEMAIL'	=> 'Può cambiare l’indirizzo email',
	'ACL_U_CHGAVATAR'	=> 'Può cambiare l’avatar',
	'ACL_U_CHGGRP'		=> 'Può cambiare gruppo predefinito',
	'ACL_U_CHGPROFILEINFO'	=> 'Può cambiare le informazioni del campo profilo',

	'ACL_U_ATTACH'		=> 'Può inserire allegati',
	'ACL_U_DOWNLOAD'	=> 'Può scaricare file',
	'ACL_U_SAVEDRAFTS'	=> 'Può salvare bozze',
	'ACL_U_CHGCENSORS'	=> 'Può disabilitare la censura parole',
	'ACL_U_SIG'			=> 'Può utilizzare la firma',
	
	'ACL_U_EMOJI'		=> 'Può usare emoji e caratteri rich text nel titolo dell’argomento',

	'ACL_U_SENDPM'		=> 'Può inviare messaggi privati',
	'ACL_U_MASSPM'		=> 'Può inviare messaggi privati multipli',
	'ACL_U_MASSPM_GROUP'=> 'Può inviare messaggi privati ai gruppi',
	'ACL_U_READPM'		=> 'Può leggere messaggi privati',
	'ACL_U_PM_EDIT'		=> 'Può modificare i suoi messaggi privati',
	'ACL_U_PM_DELETE'	=> 'Può rimuovere i suoi messaggi privati dalla propria cartella',
	'ACL_U_PM_FORWARD'	=> 'Può inoltrare messaggi privati',
	'ACL_U_PM_EMAILPM'	=> 'Può inviare messaggi privati via email',
	'ACL_U_PM_PRINTPM'	=> 'Può stampare messaggi privati',
	'ACL_U_PM_ATTACH'	=> 'Può allegare file nei messaggi privati',
	'ACL_U_PM_DOWNLOAD'	=> 'Può scaricare file nei messaggi privati',
	'ACL_U_PM_BBCODE'	=> 'Può inserire BBCode nei messaggi privati',
	'ACL_U_PM_SMILIES'	=> 'Può inserire emoticon nei messaggi privati',
	'ACL_U_PM_IMG'		=> 'Può usare il BBCode [img] nei messaggi privati',
	'ACL_U_PM_FLASH'	=> 'Può usare il BBCode [flash] nei messaggi privati',

	'ACL_U_SENDEMAIL'	=> 'Può inviare email',
	'ACL_U_SENDIM'		=> 'Può inviare messaggi istantanei',
	'ACL_U_IGNOREFLOOD'	=> 'Può ignorare limite flood',
	'ACL_U_HIDEONLINE'	=> 'Può nascondere lo stato in linea',
	'ACL_U_VIEWONLINE'	=> 'Può visualizzare gli utenti nascosti in linea',
	'ACL_U_SEARCH'		=> 'Può cercare nel Forum',
));

// Forum Permissions
$lang = array_merge($lang, array(
	'ACL_F_LIST'		=> 'Può vedere forum',
	'ACL_F_LIST_TOPICS' => 'Può vedere gli argomenti',
	'ACL_F_READ'		=> 'Può leggere forum',
	'ACL_F_SEARCH'		=> 'Può cercare forum',
	'ACL_F_SUBSCRIBE'	=> 'Può sottoscrivere forum',
	'ACL_F_PRINT'		=> 'Può stampare argomenti',
	'ACL_F_EMAIL'		=> 'Può inviare argomenti via email',
	'ACL_F_BUMP'		=> 'Può effettuare il bump degli argomenti',
	'ACL_F_USER_LOCK'	=> 'Può bloccare i propri argomenti',
	'ACL_F_DOWNLOAD'	=> 'Può scaricare file',
	'ACL_F_REPORT'		=> 'Può segnalare messaggi',

	'ACL_F_POST'		=> 'Può pubblicare nuovi argomenti',
	'ACL_F_STICKY'		=> 'Può pubblicare nuovi argomenti importanti',
	'ACL_F_ANNOUNCE'	=> 'Può pubblicare nuovi annunci',
	'ACL_F_ANNOUNCE_GLOBAL'	=> 'Può pubblicare nuovi annunci globali',
	'ACL_F_REPLY'		=> 'Può rispondere agli argomenti',
	'ACL_F_EDIT'		=> 'Può modificare i propri messaggi',
	'ACL_F_DELETE'		=> 'Può eliminare permanentemente i propri messaggi',
	'ACL_F_SOFTDELETE'	=> 'Può eliminare in modo temporaneo i propri messaggi<br /><em>I moderatori, che hanno il permesso di approvare i messaggi, possono ripristinare messaggi cancellati in modo temporaneo.</em>',
	'ACL_F_IGNOREFLOOD' => 'Può ignorare il limite flood',
	'ACL_F_POSTCOUNT'	=> 'Incremento conteggio messaggi<br /><em>Questa impostazione influisce solo sui nuovi messaggi.</em>',
	'ACL_F_NOAPPROVE'	=> 'Può inviare messaggi senza approvazione',

	'ACL_F_ATTACH'		=> 'Può allegare file',
	'ACL_F_ICONS'		=> 'Può usare icone argomento/messaggi',
	'ACL_F_BBCODE'		=> 'Può usare BBCode',
	'ACL_F_FLASH'		=> 'Può usare il tag BBCode [flash]',
	'ACL_F_IMG'			=> 'Può usare il tag BBCode [img]',
	'ACL_F_SIGS'		=> 'Può usare le firme',
	'ACL_F_SMILIES'		=> 'Può usare le emoticon',

	'ACL_F_POLL'		=> 'Può creare sondaggi',
	'ACL_F_VOTE'		=> 'Può votare nei sondaggi',
	'ACL_F_VOTECHG'		=> 'Può cambiare il voto esistente',
));

// Moderator Permissions
$lang = array_merge($lang, array(
	'ACL_M_EDIT'		=> 'Può modificare i messaggi',
	'ACL_M_DELETE'		=> 'Può eliminare definitivamente i messaggi',
	'ACL_M_SOFTDELETE'	=> 'Può effettuare la cancellazione temporanea dei messaggi<br /><em>I moderatori, che hanno facoltà di approvare i messaggi, possono ripristinare messaggi cancellati in modo temporaneo.</em>',
	'ACL_M_APPROVE'		=> 'Può approvare e ripristinare i messaggi',
	'ACL_M_REPORT'		=> 'Può chiudere e cancellare le segnalazioni',
	'ACL_M_CHGPOSTER'	=> 'Può cambiare l’autore del messaggio',

	'ACL_M_MOVE'	=> 'Può spostare gli argomenti',
	'ACL_M_LOCK'	=> 'Può bloccare gli argomenti',
	'ACL_M_SPLIT'	=> 'Può dividere gli argomenti',
	'ACL_M_MERGE'	=> 'Può unire gli argomenti',

	'ACL_M_INFO'	=> 'Può visualizzare i dettagli nei messaggi',
	'ACL_M_WARN'	=> 'Può inviare richiami',
	'ACL_M_PM_REPORT'	=> 'Possono chiudere e cancellare le segnalazioni dei messaggi privati',
	'ACL_M_BAN'		=> 'Può gestire ban',
));

// Admin Permissions
$lang = array_merge($lang, array(
	'ACL_A_BOARD'		=> 'Può modificare le impostazioni della Board/controllare gli aggiornamenti',
	'ACL_A_SERVER'		=> 'Può modificare il server/impostazioni di comunicazione',
	'ACL_A_JABBER'		=> 'Può modificare le impostazioni Jabber',
	'ACL_A_PHPINFO'		=> 'Può visualizzare le impostazioni php',

	'ACL_A_FORUM'		=> 'Può gestire forum',
	'ACL_A_FORUMADD'	=> 'Può aggiungere nuovi forum',
	'ACL_A_FORUMDEL'	=> 'Può cancellare forum',
	'ACL_A_PRUNE'		=> 'Può effettuare la cancellazione forum',

	'ACL_A_ICONS'		=> 'Può modificare l’argomento/pubblicare icone ed emoticon',
	'ACL_A_WORDS'		=> 'Può modificare la censura parole',
	'ACL_A_BBCODE'		=> 'Può definire tag BBCode',
	'ACL_A_ATTACH'		=> 'Può modificare le impostazioni degli allegati relativi',

	'ACL_A_USER'		=> 'Può gestire gli utenti<br /><em>Questo include anche il vedere l’user agent degli utenti del browser all’interno del modulo Chi c’è in linea.</em>',
	'ACL_A_USERDEL'		=> 'Può eliminare/cancellare utenti',
	'ACL_A_GROUP'		=> 'Può gestire gruppi',
	'ACL_A_GROUPADD'	=> 'Può aggiungere nuovi gruppi',
	'ACL_A_GROUPDEL'	=> 'Può eliminare gruppi',
	'ACL_A_RANKS'		=> 'Può gestire livelli',
	'ACL_A_PROFILE'		=> 'Può gestire i campi profilo personalizzati',
	'ACL_A_NAMES'		=> 'Può gestire i nomi non consentiti',
	'ACL_A_BAN'			=> 'Può gestire i ban',

	'ACL_A_VIEWAUTH'	=> 'Può visualizzare la maschera dei permessi',
	'ACL_A_AUTHGROUPS'	=> 'Può modificare i permessi per singoli gruppi',
	'ACL_A_AUTHUSERS'	=> 'Può modificare i permessi per singoli utenti',
	'ACL_A_FAUTH'		=> 'Può modificare la classe dei permessi forum',
	'ACL_A_MAUTH'		=> 'Può modificare la classe dei permessi moderatore',
	'ACL_A_AAUTH'		=> 'Può modificare la classe dei permessi amministratore',
	'ACL_A_UAUTH'		=> 'Può modificare la classe dei permessi utente',
	'ACL_A_ROLES'		=> 'Può gestire i ruoli',
	'ACL_A_SWITCHPERM'	=> 'Può usare altri permessi',

	'ACL_A_STYLES'		=> 'Può gestire gli stili',
	'ACL_A_EXTENSIONS'	=> 'Può gestire le estensioni',
	'ACL_A_VIEWLOGS'	=> 'Può visualizzare i log',
	'ACL_A_CLEARLOGS'	=> 'Può cancellare i log',
	'ACL_A_MODULES'		=> 'Può gestire moduli',
	'ACL_A_LANGUAGE'	=> 'Può gestire i pacchetti lingua',
	'ACL_A_EMAIL'		=> 'Può inviare email di massa',
	'ACL_A_BOTS'		=> 'Può gestire bot',
	'ACL_A_REASONS'		=> 'Può gestire segnalazioni/motivi di rifiuto',
	'ACL_A_BACKUP'		=> 'Può effettuare il backup/ripristino database',
	'ACL_A_SEARCH'		=> 'Può gestire la ricerca backend e le impostazioni',
));
