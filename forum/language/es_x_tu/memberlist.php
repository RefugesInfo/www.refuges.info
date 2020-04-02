<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
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
	'ABOUT_USER'			=> 'Perfil',
	'ACTIVE_IN_FORUM'		=> 'Foro más activo',
	'ACTIVE_IN_TOPIC'		=> 'Tema más activo',
	'ADD_FOE'				=> 'Añadir como ignorado',
	'ADD_FRIEND'			=> 'Añadir como amigo',
	'AFTER'					=> 'Después',

	'ALL'					=> 'Todos',

	'BEFORE'				=> 'Antes',

	'CC_SENDER'				=> 'Enviar copia de este email a si mismo.',
 	'CONTACT_ADMIN'			=> 'Contactar con un Administrador del Foro',

	'DEST_LANG'				=> 'Idioma',
	'DEST_LANG_EXPLAIN'		=> 'Selecciona un idioma apropiado (si está disponible) para el destinatario de este mensaje.',

	'EDIT_PROFILE'			=> 'Editar perfil',

	'EMAIL_BODY_EXPLAIN'	=> 'Este mensaje será enviado como texto plano, no incluyas HTML o BBCode. La dirección del remitente será tu dirección de email.',
	'EMAIL_DISABLED'		=> 'Disculpa, todas las funciones de email han sido deshabilitadas.',
	'EMAIL_SENT'			=> 'El email ha sido enviado.',
	'EMAIL_TOPIC_EXPLAIN'	=> 'Este mensaje será enviado como texto plano, no incluyas HTML o BBCode. Por favor, ten en cuenta que el tema ya ha sido incluido en el cuerpo del mensaje. La dirección del remitente será tu dirección de email.',
	'EMPTY_ADDRESS_EMAIL'	=> 'Debes proporcionar una dirección de email válida para el destinatario.',
	'EMPTY_MESSAGE_EMAIL'	=> 'Debes introducir un mensaje para ser enviado por correo electrónico.',
	'EMPTY_MESSAGE_IM'		=> 'Debes introducir un mensaje para enviar.',
	'EMPTY_NAME_EMAIL'		=> 'Debes ingresar el nombre real del destinatario.',
 	'EMPTY_SENDER_EMAIL'	=> 'Debes ingresar una dirección de correo electrónico válida.',
 	'EMPTY_SENDER_NAME'		=> 'Debes ingresar un nombre.',
	'EMPTY_SUBJECT_EMAIL'	=> 'Debes especificar un tema para el email.',
	'EQUAL_TO'				=> 'Igual a',

	'FIND_USERNAME_EXPLAIN'	=> 'Usa este formulario para buscar usuarios específicos. No necesitas rellenar todos los campos. Para indicar datos parciales usa * como comodín. Cuando introduzcas fechas, usa el formato <kbd>YYYY-MM-DD</kbd>, por ejemplo; <samp>2004-02-29</samp>. Usa los checkboxes para seleccionar uno o más usuarios (Se aceptan varios usuarios dependiendo del formulario en sí mismo) y clic en el botón Seleccionar Marcados para volver al formulario previo.',
	'FLOOD_EMAIL_LIMIT'		=> 'No puedes enviar otro email tan pronto. Por favor, inténtalo más tarde.',

	'GROUP_LEADER'			=> 'Líder del grupo',

	'HIDE_MEMBER_SEARCH'    => 'Ocultar búsqueda de usuarios',

	'IM_ADD_CONTACT'		=> 'Añadir contacto',
	'IM_DOWNLOAD_APP'		=> 'Descargar programa',
	'IM_JABBER'				=> 'Por favor, observa que los usuarios pueden haber elegido no recibir mensajes instantáneos no solicitados.',
	'IM_JABBER_SUBJECT'		=> 'Este es un mensaje automático, ¡por favor no respondas! Mensaje del usuario %1$s en %2$s',
	'IM_MESSAGE'			=> 'Tu mensaje',
	'IM_NAME'				=> 'Tu nombre',
	'IM_NO_DATA'			=> 'No hay información de contacto adecuada para este usuario.',
	'IM_NO_JABBER'			=> 'Disculpa, los mensajes directos de usuarios de Jabber no están soportados por este foro. Necesitas un cliente Jabber instalado en tu sistema para contactar con el destinatario.',
	'IM_RECIPIENT'			=> 'Destinatario',
	'IM_SEND'				=> 'Enviar',
	'IM_SEND_MESSAGE'		=> 'Enviar mensaje',
	'IM_SENT_JABBER'		=> 'Tu mensaje a %1$s ha sido enviado correctamente.',
	'IM_USER'				=> 'Enviar un mensaje instantáneo',

	'LAST_ACTIVE'				=> 'Última vez activo',
	'LESS_THAN'					=> 'Menos que',
	'LIST_USERS'				=> array(
		1	=> '%d usuario',
		2	=> '%d usuarios',
	),
	'LOGIN_EXPLAIN_TEAM'		=> 'El administrador del sitio requiere que estés registrado y te hayas identificado para ver la lista del equipo.',
	'LOGIN_EXPLAIN_MEMBERLIST'	=> 'El administrador del sitio requiere que estés registrado y te hayas identificado para acceder a la lista de usuarios.',
	'LOGIN_EXPLAIN_SEARCHUSER'	=> 'El administrador del sitio requiere que estés registrado y te hayas identificado para buscar usuarios.',
	'LOGIN_EXPLAIN_VIEWPROFILE'	=> 'El administrador del sitio requiere que estés registrado y te hayas identificado para ver perfiles.',

	'MANAGE_GROUP'			=> 'Gestionar grupo',
	'MORE_THAN'				=> 'Más que',

	'NO_CONTACT_FORM'		=> 'El formulario de contacto con la Administración del Foro ha sido deshabilitado.',
 	'NO_CONTACT_PAGE'		=> 'La página de contacto de la Administración del Foro ha sido deshabilitada.',
	'NO_EMAIL'				=> 'No tienes permitido enviar email a este usuario.',
	'NO_VIEW_USERS'			=> 'No estás autorizado para ver la lista de usuarios o perfiles.',

	'ORDER'					=> 'Orden',
	'OTHER'					=> 'Otro',

	'POST_IP'				=> 'Enviado desde IP/dominio',

	'REAL_NAME'				=> 'Nombre del destinatario',
	'RECIPIENT'				=> 'Destinatario',
	'REMOVE_FOE'			=> 'Eliminar ignorado',
	'REMOVE_FRIEND'			=> 'Eliminar amigo',

	'SELECT_MARKED'			=> 'Seleccionar marcados',
	'SELECT_SORT_METHOD'	=> 'Seleccione método de orden',
	'SENDER_EMAIL_ADDRESS'	=> 'Tu dirección de correo electrónico',
	'SENDER_NAME'			=> 'Tu nombre',
	'SEND_ICQ_MESSAGE'		=> 'Enviar mensaje ICQ',
	'SEND_IM'				=> 'Mensaje instantáneo',
	'SEND_JABBER_MESSAGE'	=> 'Enviar mensaje Jabber',
	'SEND_MESSAGE'			=> 'Enviar mensaje',
	'SEND_YIM_MESSAGE'		=> 'Enviar mensaje YIM',
	'SORT_EMAIL'			=> 'Email',
	'SORT_LAST_ACTIVE'		=> 'Última actividad',
	'SORT_POST_COUNT'		=> 'Cantidad de mensajes',

	'USERNAME_BEGINS_WITH'	=> 'Usuarios que comienzan con',
	'USER_ADMIN'			=> 'Modificar Usuario',
	'USER_BAN'				=> 'Banear',
	'USER_FORUM'			=> 'Estadísticas de usuario',
	'USER_LAST_REMINDED'	=> array(
		0		=> 'Ningún recordatorio enviado hasta este momento',
		1		=> '%1$d recordatorio enviado<br />» %2$s',
		2		=> '%1$d recordatorios enviados<br />» %2$s',
	),
	'USER_ONLINE'			=> 'Conectado',
	'USER_PRESENCE'			=> 'Presente en el foro',
	'USERS_PER_PAGE'		=> 'Usuarios por páginas',

	'VIEWING_PROFILE'	=> 'Viendo perfil - %s',
 	'VIEW_FACEBOOK_PROFILE'	=> 'Ver perfil de Facebook',
 	'VIEW_SKYPE_PROFILE'	=> 'Ver perfil de Skype',
 	'VIEW_TWITTER_PROFILE'	=> 'Ver perfil de Twitter',
 	'VIEW_YOUTUBE_CHANNEL'  => 'Ver canal de YouTube',
 	'VIEW_GOOGLEPLUS_PROFILE' => 'Ver perfil de Google+',

));
