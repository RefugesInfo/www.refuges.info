<?php
/**
*
* @package phpBB Extension - Antispam by CleanTalk
* @author Сleantalk team (welcome@cleantalk.org) 
* @copyright (C) 2014 СleanTalk team (http://cleantalk.org)
* @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*
* Translated By : Lord Phobos
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
	'ACP_CLEANTALK_TITLE'			            => 'Antispam by CleanTalk',
	'ACP_CLEANTALK_SETTINGS'		            => 'Impostazioni di protezione dallo spam',
	'ACP_CLEANTALK_SETTINGS_SAVED'		        => 'Le impostazioni di protezione dallo spam sono state salvate con successo!',

	'ACP_CLEANTALK_REGS_LABEL'		            => 'Controlla Registrazioni',
	'ACP_CLEANTALK_REGS_DESCR'		            => 'Gli Spam-bots saranno rifiutati con una dichiarazione di ragioni.',

	'ACP_CLEANTALK_GUESTS_LABEL'		        => 'Modera Ospiti',
	'ACP_CLEANTALK_GUESTS_DESCR'		        => 'Post e topic dagli utenti verranno controllati per lo spam. Lo spam sarà rifiutato o inviato per l’approvazione.',

	'ACP_CLEANTALK_NUSERS_LABEL'		        => 'Modera i Nuovi Utenti Registrati',
	'ACP_CLEANTALK_NUSERS_DESCR'		        => 'Post e topic dei nuovi utenti registrati verranno controllati per lo spam. Lo spam sarà rifiutato o inviato per l’approvazione.',

	'ACP_CLEANTALK_CCF_LABEL'	           		=> 'Controllare i moduli di contatto',
	'ACP_CLEANTALK_CCF_DESCR'	           		=> 'Attivare l’antispam test per il modulo di contatto. Attenzione, possibili conflitti!',

	'ACP_CLEANTALK_SFW_LABEL'		       		=> 'SpamFireWall',
	'ACP_CLEANTALK_SFW_DESCR'		        	=> 'Include SpamFireWall. Questo non darà bot andare sul sito e consentirà di ridurre il carico sul server web.',	

	'ACP_CLEANTALK_APIKEY_LABEL'		        => 'Chiave d’accesso',
	'ACP_CLEANTALK_APIKEY_LABEL_PLACEHOLDER'    => 'Immettere la chiave di accesso',		
	'ACP_CLEANTALK_APIKEY_DESCR'		        => 'Per ottenere una chiave d’accesso si prega di registrarsi al sito ',
	'ACP_CLEANTALK_REG_NOTICE'                  => 'E-mail del forum',
	'ACP_CLEANTALK_REG_NOTICE2'                 => 'sarà utilizzato per la registrazione',
	'ACP_CLEANTALK_AGREEMENT'                   => 'Il contratto di licenza',
	'ACP_CLEANTALK_APIKEY_IS_OK_LABEL'			=> 'La chiave è valido.',
	'ACP_CLEANTALK_APIKEY_IS_BAD_LABEL'			=> 'La chiave non è valida!',
	'ACP_CLEANTALK_APIKEY_GET_AUTO_BUTTON_LABEL'		=> 'Ottenere la chiave automaticamente',
	'ACP_CLEANTALK_APIKEY_GET_MANUALLY_BUTTON_LABEL'	=> 'Ottenere la chiave manualmente',
	'ACP_CLEANTALK_APIKEY_CP_LINK_BUTTON'		=> 'Vai in pannello di controllo CleanTalk',
	'ACP_CLEANTALK_ACCOUNT_NAME_OB'				=> 'Account at cleantalk.org è',
	'ACP_CLEANTALK_CHECKUSERS_TITLE'		    => 'Verificare utenti spam',
	'ACP_CLEANTALK_CHECKUSERS_DESCRIPTION'		=> 'Antispam da CleanTalk controllerà tutti gli utenti in lista nera e vi mostrerà chi ha dimostrato di spam attività su altri siti.',
	'ACP_CLEANTALK_CHECKUSERS_PAGES_TITLE'      => 'Pagina:',
	'ACP_CLEANTALK_CHECKUSERS_BUTTON'			=> 'Verificare spam',
	'ACP_CHECKUSERS_DONE_2'                     => 'Fine. Tutti gli utenti testati per spam, abbiamo trovato 0 risultati',
	'ACP_CHECKUSERS_DONE_3'						=> 'Errore. Non c’è connessione con il database degli elenchi.',
	'ACP_CHECKUSERS_USERNAME'                   => 'L’utente',
	'ACP_CHECKUSERS_MESSAGES'                   => 'Messaggi',
	'ACP_CHECKUSERS_JOINED'                     => 'Aderito',
	'ACP_CHECKUSERS_EMAIL'                      => 'Email',
	'ACP_CHECKUSERS_IP'                         => 'IP',
	'ACP_CHECKUSERS_LASTVISIT'                  => 'Ultima visita',
	'ACP_CHECKUSERS_DELETEALL'                  => 'Rimuovere tutti i',
	'ACP_CHECKUSERS_DELETEALL_DESCR'            => 'Tutti i post di utenti selezionati saranno cancellati',
	'ACP_CHECKUSERS_DELETESEL'                  => 'Rimuovi selezionati',
	'ACP_CLEANTALK_MODERATE_IP'					=> 'Il servizio anti-spam è pagato dal vostro fornitore di hosting. Licenza #',	
	'SFW_DIE_NOTICE_IP'                         => 'SpamFireWall incluso per il vostro IP',
	'SFW_DIE_MAKE_SURE_JS_ENABLED'              => 'Che sarebbe continuare con il sito web, assicurarsi che avete abilitato JavaScript.',
	'SFW_DIE_CLICK_TO_PASS'                     => 'Clicca qui sotto che togliere il blocco',
	'SFW_DIE_YOU_WILL_BE_REDIRECTED'            => 'Sarete automaticamente reindirizzati su richiesta pagina 3 secondi.',
	
	'CLEANTALK_ERROR_MAIL'		                => 'L’errore di lavorare con il servizio CleanTalk',
	'CLEANTALK_ERROR_LOG'		                => '<strong>L’errore di lavorare con il servizio CleanTalk</strong><br />%s',
	'CLEANTALK_ERROR_CURL'		                => 'CURL errore: `%s`',
	'CLEANTALK_ERROR_NO_CURL'		            => 'Non c’è il supporto CURL',
	'CLEANTALK_ERROR_ADDON'		                => ' o l’impostazione allow_url_fopen in php.ini.',
	'CLEANTALK_NOTIFICATION'					=> 'Sei sicuro?',
));
