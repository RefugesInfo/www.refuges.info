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
	'ACL_CAT_ACTIONS'		=> 'Acciones',
	'ACL_CAT_CONTENT'		=> 'Contenido',
	'ACL_CAT_FORUMS'		=> 'Foros',
	'ACL_CAT_MISC'			=> 'Varios',
	'ACL_CAT_PERMISSIONS'	=> 'Permisos',
	'ACL_CAT_PM'			=> 'Mensajes privados',
	'ACL_CAT_POLLS'			=> 'Encuestas',
	'ACL_CAT_POST'			=> 'Mensaje',
	'ACL_CAT_POST_ACTIONS'	=> 'Acciones en mensaje',
	'ACL_CAT_POSTING'		=> 'Envío',
	'ACL_CAT_PROFILE'		=> 'Perfil',
	'ACL_CAT_SETTINGS'		=> 'Ajustes',
	'ACL_CAT_TOPIC_ACTIONS'	=> 'Acciones en temas',
	'ACL_CAT_USER_GROUP'	=> 'Usuarios / Grupos',
));

// User Permissions
$lang = array_merge($lang, array(
	'ACL_U_VIEWPROFILE'	=> 'Puede ver perfiles, lista de usuarios y lista de conectados',
	'ACL_U_CHGNAME'		=> 'Puede cambiar de nombre de usuario',
	'ACL_U_CHGPASSWD'	=> 'Puede cambiar de contraseña',
	'ACL_U_CHGEMAIL'	=> 'Puede cambiar de dirección de correo electrónico',
	'ACL_U_CHGAVATAR'	=> 'Puede cambiar de avatar',
	'ACL_U_CHGGRP'		=> 'Puede cambiar el grupo de usuarios por defecto',
	'ACL_U_CHGPROFILEINFO'	=> 'Puede cambiar la información del campo de perfil',

	'ACL_U_ATTACH'		=> 'Puede adjuntar archivos',
	'ACL_U_DOWNLOAD'	=> 'Puede descargar archivos',
	'ACL_U_SAVEDRAFTS'	=> 'Puede guardar borradores',
	'ACL_U_CHGCENSORS'	=> 'Puede desactivar la censura de palabras',
	'ACL_U_SIG'			=> 'Puede usar firma',
	'ACL_U_EMOJI'		=> 'Puede usar emoji y caracteres de texto enriquecido en el título del tema',

	'ACL_U_SENDPM'		=> 'Puede enviar mensajes privados',
	'ACL_U_MASSPM'		=> 'Puede enviar mensaje privados a múltiples usuarios',
	'ACL_U_MASSPM_GROUP'=> 'Puede enviar mensajes privados a grupos',
	'ACL_U_READPM'		=> 'Puede leer mensajes privados',
	'ACL_U_PM_EDIT'		=> 'Puede editar sus mensajes privados',
	'ACL_U_PM_DELETE'	=> 'Puede borrar mensajes privados de su carpeta',
	'ACL_U_PM_FORWARD'	=> 'Puede reenviar mensajes privados',
	'ACL_U_PM_EMAILPM'	=> 'Puede enviar mensaje privado por email',
	'ACL_U_PM_PRINTPM'	=> 'Puede imprimir mensajes privados',
	'ACL_U_PM_ATTACH'	=> 'Puede adjuntar archivos en mensajes privados',
	'ACL_U_PM_DOWNLOAD'	=> 'Puede descargar archivos en mensajes privados',
	'ACL_U_PM_BBCODE'	=> 'Puede usar BBCode en mensajes privados',
	'ACL_U_PM_SMILIES'	=> 'Puede usar emoticonos en mensajes privados',
	'ACL_U_PM_IMG'		=> 'Puede usar la etiqueta BBCode [img] en mensajes privados',
	'ACL_U_PM_FLASH'	=> 'Puede usar etiqueta BBCode [flash] en mensajes privados',

	'ACL_U_SENDEMAIL'	=> 'Puede enviar emails',
	'ACL_U_SENDIM'		=> 'Puede enviar mensajes instantáneos',
	'ACL_U_IGNOREFLOOD'	=> 'Puede ignorar límite de saturación',
	'ACL_U_HIDEONLINE'	=> 'Puede ocultar estado de conexión',
	'ACL_U_VIEWONLINE'	=> 'Puede ver usuarios ocultos conectados',
	'ACL_U_SEARCH'		=> 'Puede hacer búsquedas',
));

// Forum Permissions
$lang = array_merge($lang, array(
	'ACL_F_LIST'		=> 'Puede ver foros',
	'ACL_F_LIST_TOPICS' => 'Puede ver temas',
	'ACL_F_READ'		=> 'Puede leer foros',
	'ACL_F_SEARCH'		=> 'Puede buscar en foros',
	'ACL_F_SUBSCRIBE'	=> 'Puede suscribir a foros',
	'ACL_F_PRINT'		=> 'Puede imprimir temas',
	'ACL_F_EMAIL'		=> 'Puede enviar temas por email',
	'ACL_F_BUMP'		=> 'Puede activar temas',
	'ACL_F_USER_LOCK'	=> 'Puede cerrar sus temas',
	'ACL_F_DOWNLOAD'	=> 'Puede descargar archivos',
	'ACL_F_REPORT'		=> 'Puede reportar mensajes',

	'ACL_F_POST'		=> 'Puede iniciar nuevos temas',
	'ACL_F_STICKY'		=> 'Puede publicar notas',
	'ACL_F_ANNOUNCE'	=> 'Puede publicar anuncios',
	'ACL_F_ANNOUNCE_GLOBAL'	=> 'Puede publicar anuncios globales',
	'ACL_F_REPLY'		=> 'Puede responder temas',
	'ACL_F_EDIT'		=> 'Puede editar sus mensajes',
	'ACL_F_DELETE'		=> 'Puede borrar permanentemente sus propios mensajes',
	'ACL_F_SOFTDELETE'	=> 'Puede borrar temporalmente sus mensajes<br><em>Moderadores, que tienen permiso de aprobar mensajes, pueden restaurar mensajes borrados.</em>',
	'ACL_F_IGNOREFLOOD' => 'Puede ignorar límite de saturación',
	'ACL_F_POSTCOUNT'	=> 'Incrementar cantidad de mensajes<br><em>Por favor, obsérvese que este parámetro solo afecta a mensajes nuevos.</em>',
	'ACL_F_NOAPPROVE'	=> 'Puede publicar sin aprobación',

	'ACL_F_ATTACH'		=> 'Puede adjuntar archivos',
	'ACL_F_ICONS'		=> 'Puede usar iconos de tema/mensaje',
	'ACL_F_BBCODE'		=> 'Puede usar BBCode',
	'ACL_F_FLASH'		=> 'Puede usar BBCode [flash]',
	'ACL_F_IMG'			=> 'Puede usar BBCode [img]',
	'ACL_F_SIGS'		=> 'Puede usar firmas',
	'ACL_F_SMILIES'		=> 'Puede usar emoticonos',

	'ACL_F_POLL'		=> 'Puede hacer encuestas',
	'ACL_F_VOTE'		=> 'Puede votar en encuestas',
	'ACL_F_VOTECHG'		=> 'Puede cambiar una encuesta existente',
));

// Moderator Permissions
$lang = array_merge($lang, array(
	'ACL_M_EDIT'		=> 'Puede editar mensajes',
	'ACL_M_DELETE'		=> 'Puede borrar mensajes permanentemente',
	'ACL_M_SOFTDELETE'	=> 'Puede borrar mensajes temporalmente<br><em>Moderadores, que tienen permiso de aprobar mensajes, pueden restaurar mensajes borrados.</em>',
	'ACL_M_APPROVE'		=> 'Puede aprobar y restaurar mensajes',
	'ACL_M_REPORT'		=> 'Puede cerrar y borrar informes',
	'ACL_M_CHGPOSTER'	=> 'Puede cambiar autor en mensajes',

	'ACL_M_MOVE'	=> 'Puede mover temas',
	'ACL_M_LOCK'	=> 'Puede cerrar temas',
	'ACL_M_SPLIT'	=> 'Puede dividir temas',
	'ACL_M_MERGE'	=> 'Puede unir temas',

	'ACL_M_INFO'	=> 'Puede ver detalles de mensaje',
	'ACL_M_WARN'	=> 'Puede hacer advertencia<br><em>Este ajuste sólo se asigna a nivel global. No se basa en el foro.</em>', // This moderator setting is only global (and not local)
	'ACL_M_PM_REPORT'	=> 'Puede cerrar y eliminar informes de mensajes privados<br><em>Esta configuración sólo se asigna globalmente. No está basado en un foro.</em>', // This moderator setting is only global (and not local)
	'ACL_M_BAN'		=> 'Puede administrar exclusiones<br><em>Este ajuste sólo se asigna a nivel global. No se basa en el foro.</em>', // This moderator setting is only global (and not local)
));

// Admin Permissions
$lang = array_merge($lang, array(
	'ACL_A_BOARD'		=> 'Puede modificar configuración de sitio/verificar actualizaciones',
	'ACL_A_SERVER'		=> 'Puede modificar configuración de servidor/comunicación',
	'ACL_A_JABBER'		=> 'Puede modificar parámetros Jabber',
	'ACL_A_PHPINFO'		=> 'Puede ver configuración de PHP',

	'ACL_A_FORUM'		=> 'Puede administrar foros',
	'ACL_A_FORUMADD'	=> 'Puede agregar nuevos foros',
	'ACL_A_FORUMDEL'	=> 'Puede borrar foros',
	'ACL_A_PRUNE'		=> 'Puede purgar foros',

	'ACL_A_ICONS'		=> 'Puede modificar iconos de tema y emoticonos',
	'ACL_A_WORDS'		=> 'Puede modificar palabras censuradas',
	'ACL_A_BBCODE'		=> 'Puede definir código BBCode',
	'ACL_A_ATTACH'		=> 'Puede modificar parámetros relativos a adjuntos',

	'ACL_A_USER'		=> 'Puede administrar usuarios<br><em>Esto también incluye ver el agente navegador del usuario dentro de la lista de usuarios conectados.</em>',
	'ACL_A_USERDEL'		=> 'Puede borrar/purgar usuarios',
	'ACL_A_GROUP'		=> 'Puede administrar grupos',
	'ACL_A_GROUPADD'	=> 'Puede agregar nuevos grupos',
	'ACL_A_GROUPDEL'	=> 'Puede borrar grupos',
	'ACL_A_RANKS'		=> 'Puede administrar rangos',
	'ACL_A_PROFILE'		=> 'Puede administrar campos de perfil personalizados',
	'ACL_A_NAMES'		=> 'Puede administrar nombres deshabilitados',
	'ACL_A_BAN'			=> 'Puede administrar exclusiones',

	'ACL_A_VIEWAUTH'	=> 'Puede ver máscaras de permisos',
	'ACL_A_AUTHGROUPS'	=> 'Puede modificar permisos para grupos individuales',
	'ACL_A_AUTHUSERS'	=> 'Puede modificar permisos para usuarios individuales',
	'ACL_A_FAUTH'		=> 'Puede modificar tipos de permisos de foros',
	'ACL_A_MAUTH'		=> 'Puede modificar tipos de permisos de Moderadores',
	'ACL_A_AAUTH'		=> 'Puede modificar tipos de permisos de Administradores',
	'ACL_A_UAUTH'		=> 'Puede modificar tipos de permisos de usuario',
	'ACL_A_ROLES'		=> 'Puede administrar roles',
	'ACL_A_SWITCHPERM'	=> 'Puede usar otros permisos',

	'ACL_A_STYLES'		=> 'Puede administrar estilos',
	'ACL_A_EXTENSIONS'	=> 'Puede administrar extensiones',
	'ACL_A_VIEWLOGS'	=> 'Puede ver registros',
	'ACL_A_CLEARLOGS'	=> 'Puede limpiar registros',
	'ACL_A_MODULES'		=> 'Puede administrar módulos',
	'ACL_A_LANGUAGE'	=> 'Puede administrar paquetes de idioma',
	'ACL_A_EMAIL'		=> 'Puede enviar emails masivos',
	'ACL_A_BOTS'		=> 'Puede administrar bots',
	'ACL_A_REASONS'		=> 'Puede administrar motivos de reporte/negación',
	'ACL_A_BACKUP'		=> 'Puede resguardar/restaurar base de datos',
	'ACL_A_SEARCH'		=> 'Puede administrar motores de búsqueda y parámetros',
));
