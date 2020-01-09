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
	'ACP_CLEANTALK_TITLE'			=> 'Antispam por CleanTalk',

	'ACP_CLEANTALK_SETTINGS'		=> 'Ajustes de protección Spam',
	'ACP_CLEANTALK_SETTINGS_SAVED'	=> '¡Los ajustes de protección Spam se han guardado correctamente!',

	'ACP_CLEANTALK_REGS_LABEL'		=> 'Comprobar registros',
	'ACP_CLEANTALK_REGS_DESCR'		=> 'Los robots Spam serán rechazadas con una exposición de motivos.',

	'ACP_CLEANTALK_GUESTS_LABEL'	=> 'Moderar invitados',
	'ACP_CLEANTALK_GUESTS_DESCR'	=> 'Mensajes y temas de los invitados estarán a prueba en busca de Spam. Los correos no deseados serán rechazados, o enviados para ser aprobados.',

	'ACP_CLEANTALK_NUSERS_LABEL'	=> 'Moderar nuevos usuarios registrados',
	'ACP_CLEANTALK_NUSERS_DESCR'	=> 'Mensajes y temas de los nuevos usuarios estarán a prueba en busca de Spam. Los correos no deseados serán rechazados, o enviados para ser aprobados.',

	'ACP_CLEANTALK_APIKEY_LABEL'	=> 'Llave de acceso',
	'ACP_CLEANTALK_APIKEY_DESCR'	=> 'Para obtener una clave de acceso, por favor registrese en el sitio ',

	'MAIL_CLEANTALK_ERROR'			=> 'Error al conectar con el servicio CleanTalk',
	'LOG_CLEANTALK_ERROR'			=> '<strong>Error al conectar con el servicio CleanTalk</strong><br />%s',
	'ACP_CLEANTALK_CHECKUSERS_TITLE'		=> 'Comprobar usuarios de Spam',
	'ACP_CLEANTALK_CHECKUSERS_DESCRIPTION'	=> "Anti-Spam por CleanTalk comprobará todos los usuarios de la base de datos contra las listas negras y le mostrará los remitentes de correo no deseado que tienen actividad en otros sitios web. Simplemente haga clic 'Comprobar usuarios de Spam' para comenzar.",
	'ACP_CLEANTALK_CHECKUSERS_BUTTON'		=> 'Comprobar usuarios de Spam',
	'ACP_CHECKUSERS_DONE_1' => 'Hecho. Todos los usuarios de la base de datos han sido probados a través de listas negras, por favor vea el resultado a continuación.',
	'ACP_CHECKUSERS_DONE_2' => 'Hecho. Todos los usuarios de la base de datos han sido probados a través de listas negras, se encontraron 0 usuarios de Spam.',
	'ACP_CHECKUSERS_SELECT' => 'Seleccionar',
	'ACP_CHECKUSERS_USERNAME' => 'Nombre de usuario',
	'ACP_CHECKUSERS_JOINED' => 'Ingreso',
	'ACP_CHECKUSERS_EMAIL' => 'Email',
	'ACP_CHECKUSERS_IP' => 'IP',
	'ACP_CHECKUSERS_LASTVISIT' => 'Última visita',
	'ACP_CHECKUSERS_DELETEALL' => 'Borrar todo',
	'ACP_CHECKUSERS_DELETEALL_DESCR' => 'También se borrarán todos los mensajes de los usuarios borrados.',
	'ACP_CHECKUSERS_DELETESEL' => 'Borrar lo seleccionado',
));
