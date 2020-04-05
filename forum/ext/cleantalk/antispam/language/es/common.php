<?php
/**
*
* @package phpBB Extension - Antispam by CleanTalk
* @author Сleantalk team (welcome@cleantalk.org)
* @copyright (C) 2014 СleanTalk team (http://cleantalk.org)
* @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*
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
	'ACP_CLEANTALK_TITLE'						=> 'Antispam por CleanTalk',
	
	
	'ACP_CLEANTALK_SETTINGS'					=> 'Ajustes de protección Spam',
	'ACP_CLEANTALK_SETTINGS_SAVED'				=> '¡Los ajustes de protección Spam se han guardado correctamente!',
	
	'ACP_CLEANTALK_REGS_LABEL'					=> 'Comprobar registros',
	'ACP_CLEANTALK_REGS_DESCR'					=> 'Los robots Spam serán rechazadas con una exposición de motivos.',
	
	'ACP_CLEANTALK_GUESTS_LABEL'				=> 'Moderar invitados',
	'ACP_CLEANTALK_GUESTS_DESCR'				=> 'Mensajes y temas de los invitados estarán a prueba en busca de Spam. Los correos no deseados serán rechazados, o enviados para ser aprobados.',
	
	'ACP_CLEANTALK_NUSERS_LABEL'				=> 'Moderar nuevos usuarios registrados',
	'ACP_CLEANTALK_NUSERS_DESCR'				=> 'Mensajes y temas de los nuevos usuarios estarán a prueba en busca de Spam. Los correos no deseados serán rechazados, o enviados para ser aprobados.',

	'ACP_CLEANTALK_CCF_LABEL'	           		=> 'Comprobar que formularios de contacto',
	'ACP_CLEANTALK_CCF_DESCR'	           		=> 'Activar el filtro antispam de prueba para el formulario de contacto. Atención, puede haber conflictos!',
		
	'ACP_CLEANTALK_SFW_LABEL'					=> 'SpamFireWall',
	'ACP_CLEANTALK_SFW_DESCR'					=> 'Enables SpamFireWall. Reduces webserver load and prevents bots to access the website.',
	
	'ACP_CLEANTALK_APIKEY_LABEL'				=> 'Llave de acceso',
	'ACP_CLEANTALK_APIKEY_LABEL_PLACEHOLDER'    => 'Escriba la clave de acceso',		
	'ACP_CLEANTALK_APIKEY_DESCR'				=> 'Para obtener una clave de acceso, por favor registrese en el sitio ',
	'ACP_CLEANTALK_REG_NOTICE'                  => 'Board e-mail',
	'ACP_CLEANTALK_REG_NOTICE2'                 => 'will be used for registration',
	'ACP_CLEANTALK_AGREEMENT'                   => 'License agreement',
	'ACP_CLEANTALK_APIKEY_IS_OK_LABEL'			=> 'Key is ok!',
	'ACP_CLEANTALK_APIKEY_IS_BAD_LABEL'			=> 'Key is not valid!',
	'ACP_CLEANTALK_APIKEY_GET_AUTO_BUTTON_LABEL'		=> 'Get Access key automatically',
	'ACP_CLEANTALK_APIKEY_GET_MANUALLY_BUTTON_LABEL'	=> 'Get Access manually',
	'ACP_CLEANTALK_APIKEY_CP_LINK_BUTTON'		=> 'Click here to get anti-spam statistics',
	'ACP_CLEANTALK_ACCOUNT_NAME_OB'				=> 'Cuenta en cleantalk.org es',
	'ACP_CLEANTALK_CHECKUSERS_TITLE'			=> 'Comprobar usuarios de Spam',
	'ACP_CLEANTALK_CHECKUSERS_DESCRIPTION'		=> 'Anti-Spam por CleanTalk comprobará todos los usuarios de la base de datos contra las listas negras y le mostrará los remitentes de correo no deseado que tienen actividad en otros sitios web. Simplemente haga clic `Comprobar usuarios de Spam` para comenzar.',
	'ACP_CLEANTALK_CHECKUSERS_PAGES_TITLE'      => 'Página:',	
	'ACP_CLEANTALK_CHECKUSERS_BUTTON'			=> 'Comprobar usuarios de Spam',
	'ACP_CHECKUSERS_DONE_2' 					=> 'Hecho. Todos los usuarios de la base de datos han sido probados a través de listas negras, se encontraron 0 usuarios de Spam.',
	'ACP_CHECKUSERS_DONE_3'						=> 'Error. No hay conexión con la base de datos de lista negra.',
	'ACP_CHECKUSERS_USERNAME'					=> 'Nombre de usuario',
	'ACP_CHECKUSERS_MESSAGES'					=> 'Mensajes',
	'ACP_CHECKUSERS_JOINED' 					=> 'Ingreso',
	'ACP_CHECKUSERS_EMAIL' 						=> 'Email',
	'ACP_CHECKUSERS_IP' 						=> 'IP',
	'ACP_CHECKUSERS_LASTVISIT' 					=> 'Última visita',
	'ACP_CHECKUSERS_DELETEALL' 					=> 'Borrar todo',
	'ACP_CHECKUSERS_DELETEALL_DESCR' 			=> 'También se borrarán todos los mensajes de los usuarios borrados.',
	'ACP_CHECKUSERS_DELETESEL' 					=> 'Borrar lo seleccionado',
	'ACP_CLEANTALK_MODERATE_IP'					=> 'El Servicio anti-spam es pagado por su proveedor de alojamiento. Licencia #',	
	'SFW_DIE_NOTICE_IP'                         => 'SpamFireWall is activated for your IP ',
	'SFW_DIE_MAKE_SURE_JS_ENABLED'              => 'To continue working with web site, please make sure that you have enabled JavaScript.',
	'SFW_DIE_CLICK_TO_PASS'                     => 'Please click bellow to pass protection,',
	'SFW_DIE_YOU_WILL_BE_REDIRECTED'            => 'Or you will be automatically redirected to the requested page after 3 seconds.',
	
	'CLEANTALK_ERROR_MAIL'		                => 'Error al conectar con el servicio CleanTalk',
	'CLEANTALK_ERROR_LOG'		                => '<strong>Error al conectar con el servicio CleanTalk</strong><br />%s',
	'CLEANTALK_ERROR_CURL'		                => 'CURL error: `%s`',
	'CLEANTALK_ERROR_NO_CURL'		            => 'No CURL support compiled in',
	'CLEANTALK_ERROR_ADDON'		                => ' or disabled allow_url_fopen in php.ini.',
	'CLEANTALK_NOTIFICATION'					=> '¿Está usted seguro?',
));
