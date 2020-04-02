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

// Common
$lang = array_merge($lang, array(
	'ACP_ADMINISTRATORS'		=> 'Administradores',
	'ACP_ADMIN_LOGS'			=> 'Registro de administradores',
	'ACP_ADMIN_ROLES'			=> 'Roles de admins',
	'ACP_ATTACHMENTS'			=> 'Adjuntos',
	'ACP_ATTACHMENT_SETTINGS'	=> 'Configuración de adjuntos',
	'ACP_AUTH_SETTINGS'			=> 'Autenticación',
	'ACP_AUTOMATION'			=> 'Automatización',
	'ACP_AVATAR_SETTINGS'		=> 'Configuración de avatar',

	'ACP_BACKUP'				=> 'Copia de seguridad',
	'ACP_BAN'					=> 'Exclusiones',
	'ACP_BAN_EMAILS'			=> 'Excluir emails',
	'ACP_BAN_IPS'				=> 'Excluir IPs',
	'ACP_BAN_USERNAMES'			=> 'Excluir usuarios',
	'ACP_BBCODES'				=> 'BBCodes',
	'ACP_BOARD_CONFIGURATION'	=> 'Configuración del Sitio',
	'ACP_BOARD_FEATURES'		=> 'Características del Sitio',
	'ACP_BOARD_MANAGEMENT'		=> 'Administración del Sitio',
	'ACP_BOARD_SETTINGS'		=> 'Configuración del Sitio',
	'ACP_BOTS'					=> 'Spiders/Robots',

	'ACP_CAPTCHA'				=> 'CAPTCHA',

	'ACP_CAT_CUSTOMISE'			=> 'Personalizar',
	'ACP_CAT_DATABASE'			=> 'Base de datos',
	'ACP_CAT_DOT_MODS'			=> 'Extensiones',
	'ACP_CAT_FORUMS'			=> 'Foros',
	'ACP_CAT_GENERAL'			=> 'General',
	'ACP_CAT_MAINTENANCE'		=> 'Mantenimiento',
	'ACP_CAT_PERMISSIONS'		=> 'Permisos',
	'ACP_CAT_POSTING'			=> 'Mensajes',
	'ACP_CAT_STYLES'			=> 'Estilos',
	'ACP_CAT_SYSTEM'			=> 'Sistema',
	'ACP_CAT_USERGROUP'			=> 'Usuarios y grupos',
	'ACP_CAT_USERS'				=> 'Usuarios',
	'ACP_CLIENT_COMMUNICATION'	=> 'Comunicación cliente',
	'ACP_COOKIE_SETTINGS'		=> 'Configuración de cookies',
 	'ACP_CONTACT'				=> 'Página de contacto',
 	'ACP_CONTACT_SETTINGS'		=> 'Ajustes de la página de contacto',
	'ACP_CRITICAL_LOGS'			=> 'Registro de errores',
	'ACP_CUSTOM_PROFILE_FIELDS'	=> 'Campos personalizados',

	'ACP_DATABASE'				=> 'Administración de base de datos',
	'ACP_DISALLOW'				=> 'Deshabilitar',
	'ACP_DISALLOW_USERNAMES'	=> 'Deshabilitar nombres de usuario',

	'ACP_EMAIL_SETTINGS'		=> 'Configuración de email',
	'ACP_EXTENSION_GROUPS'		=> 'Grupos de extensiones',
	'ACP_EXTENSION_MANAGEMENT'	=> 'Administrar Extensión',
	'ACP_EXTENSIONS'			=> 'Administrar Extensiones',

	'ACP_FORUM_BASED_PERMISSIONS'	=> 'Permisos basados en foros',
	'ACP_FORUM_LOGS'				=> 'Registro de foros',
	'ACP_FORUM_MANAGEMENT'			=> 'Administración de foros',
	'ACP_FORUM_MODERATORS'			=> 'Moderadores de foros',
	'ACP_FORUM_PERMISSIONS'			=> 'Permisos de foros',
	'ACP_FORUM_PERMISSIONS_COPY'	=> 'Copiar los permisos de foro',
	'ACP_FORUM_ROLES'				=> 'Roles de foros',

	'ACP_GENERAL_CONFIGURATION'		=> 'Configuración general',
	'ACP_GENERAL_TASKS'				=> 'Tareas generales',
	'ACP_GLOBAL_MODERATORS'			=> 'Moderadores globales',
	'ACP_GLOBAL_PERMISSIONS'		=> 'Permisos globales',
	'ACP_GROUPS'					=> 'Grupos',
	'ACP_GROUPS_FORUM_PERMISSIONS'  => 'Permisos de los grupos en los foros',
	'ACP_GROUPS_MANAGE'				=> 'Administrar grupos',
	'ACP_GROUPS_MANAGEMENT'			=> 'Administración de grupos',
	'ACP_GROUPS_PERMISSIONS'		=> 'Permisos de grupos',
	'ACP_GROUPS_POSITION'			=> 'Administrar posición de los grupos',

	'ACP_HELP_PHPBB'			=> 'Ayuda de soporte phpBB',

	'ACP_ICONS'					=> 'Iconos del tema',
	'ACP_ICONS_SMILIES'			=> 'Iconos/Emoticonos del tema',
	'ACP_INACTIVE_USERS'		=> 'Usuarios inactivos',
	'ACP_INDEX'					=> 'Indice del PCA',

	'ACP_JABBER_SETTINGS'		=> 'Configuración de Jabber',

	'ACP_LANGUAGE'				=> 'Administración de idiomas',
	'ACP_LANGUAGE_PACKS'		=> 'Paquetes de idiomas',
	'ACP_LOAD_SETTINGS'			=> 'Configuración de carga',
	'ACP_LOGGING'				=> 'Conexión',

	'ACP_MAIN'					=> 'Panel principal de Administración',

	'ACP_MANAGE_ATTACHMENTS'			=> 'Administrar adjuntos',
	'ACP_MANAGE_ATTACHMENTS_EXPLAIN'	=> 'Aquí puede ver la lista y eliminar los ficheros adjuntos de los mensajes, y los mensajes privados.',

	'ACP_MANAGE_EXTENSIONS'		=> 'Administrar extensiones de adjuntos',
	'ACP_MANAGE_FORUMS'			=> 'Administrar foros',
	'ACP_MANAGE_RANKS'			=> 'Administrar rangos',
	'ACP_MANAGE_REASONS'		=> 'Administrar informes/razones',
	'ACP_MANAGE_USERS'			=> 'Administrar usuarios',
	'ACP_MASS_EMAIL'			=> 'Email masivo',
	'ACP_MESSAGES'				=> 'Mensajes',
	'ACP_MESSAGE_SETTINGS'		=> 'Configuración de mensajes privados',
	'ACP_MODULE_MANAGEMENT'		=> 'Administración de módulos',
	'ACP_MOD_LOGS'				=> 'Registro de moderadores',
	'ACP_MOD_ROLES'				=> 'Roles de moderador',

	'ACP_NO_ITEMS'				=> 'Aún no hay elementos.',

	'ACP_ORPHAN_ATTACHMENTS'	=> 'Adjuntos huérfanos',

	'ACP_PERMISSIONS'			=> 'Permisos',
	'ACP_PERMISSION_MASKS'		=> 'Máscaras de permisos',
	'ACP_PERMISSION_ROLES'		=> 'Permisos de roles',
	'ACP_PERMISSION_TRACE'		=> 'Rastrear permisos',
	'ACP_PHP_INFO'				=> 'Información de PHP',
	'ACP_POST_SETTINGS'			=> 'Configuración de mensaje',
	'ACP_PRUNE_FORUMS'			=> 'Purgar foros',
	'ACP_PRUNE_USERS'			=> 'Purgar usuarios',
	'ACP_PRUNING'				=> 'Purga',

	'ACP_QUICK_ACCESS'			=> 'Acceso rápido',

	'ACP_RANKS'					=> 'Rangos',
	'ACP_REASONS'				=> 'Razones',
	'ACP_REGISTER_SETTINGS'		=> 'Configuración de registro de usuarios',

	'ACP_RESTORE'				=> 'Restaurar',

	'ACP_FEED'					=> 'Gestión de Feeds',
	'ACP_FEED_SETTINGS'			=> 'Configuración de Feeds',

	'ACP_SEARCH'				=> 'Configuración del buscador',
	'ACP_SEARCH_INDEX'			=> 'Indice de búsqueda',
	'ACP_SEARCH_SETTINGS'		=> 'Configuración de búsqueda',

	'ACP_SECURITY_SETTINGS'		=> 'Configuración de seguridad',
	'ACP_SERVER_CONFIGURATION'	=> 'Configuración del servidor',
	'ACP_SERVER_SETTINGS'		=> 'Configuración del servidor',
	'ACP_SIGNATURE_SETTINGS'	=> 'Configuración de firma',
	'ACP_SMILIES'				=> 'Emoticonos',
	'ACP_STYLE_MANAGEMENT'		=> 'Administración de estilos',
	'ACP_STYLES'				=> 'Estilos',
	'ACP_STYLES_CACHE'			=> 'Limpiar Cache',
	'ACP_STYLES_INSTALL'		=> 'Instalar estilos',

	'ACP_SUBMIT_CHANGES'		=> 'Aplicar cambios',

	'ACP_TEMPLATES'				=> 'Plantillas',
	'ACP_THEMES'				=> 'Temas',

	'ACP_UPDATE'					=> 'Actualización',
	'ACP_USERS_FORUM_PERMISSIONS' 	=> 'Permisos de los usuarios en los foros',
	'ACP_USERS_LOGS'				=> 'Registro de usuarios',
	'ACP_USERS_PERMISSIONS'			=> 'Permisos de usuario',
	'ACP_USER_ATTACH'				=> 'Adjuntos',
	'ACP_USER_AVATAR'				=> 'Avatar',
	'ACP_USER_FEEDBACK'				=> 'Observaciones',
	'ACP_USER_GROUPS'				=> 'Grupos',
	'ACP_USER_MANAGEMENT'			=> 'Administración de usuarios',
	'ACP_USER_OVERVIEW'				=> 'Vista general',
	'ACP_USER_PERM'					=> 'Permisos',
	'ACP_USER_PREFS'				=> 'Preferencias',
	'ACP_USER_PROFILE'				=> 'Perfil',
	'ACP_USER_RANK'					=> 'Rango',
	'ACP_USER_ROLES'				=> 'Roles de usuario',
	'ACP_USER_SECURITY'				=> 'Seguridad de usuario',
	'ACP_USER_SIG'					=> 'Firma',
	'ACP_USER_WARNINGS'				=> 'Avisos',

	'ACP_VC_SETTINGS'					=> 'Medidas contra el Spam',
	'ACP_VC_CAPTCHA_DISPLAY'			=> 'CAPTCHA vista previa',
	'ACP_VERSION_CHECK'					=> 'Verificar actualizaciones',
	'ACP_VIEW_ADMIN_PERMISSIONS'		=> 'Ver permisos de Administradores',
	'ACP_VIEW_FORUM_MOD_PERMISSIONS' 	=> 'Ver permisos de Moderadores',
	'ACP_VIEW_FORUM_PERMISSIONS'		=> 'Ver permisos de Foros',
	'ACP_VIEW_GLOBAL_MOD_PERMISSIONS' 	=> 'Ver permisos de Moderadores globales',
	'ACP_VIEW_USER_PERMISSIONS'			=> 'Ver permisos de Usuarios',

	'ACP_WORDS'					=> 'Palabras censuradas',

	'ACTION'				=> 'Acción',
	'ACTIONS'				=> 'Acciones',
	'ACTIVATE'				=> 'Activar',
	'ADD'					=> 'Añadir',
	'ADMIN'					=> 'Administración',
	'ADMIN_INDEX'			=> 'Índice de Administración',
	'ADMIN_PANEL'	  		=> 'Panel de Control de Administración (PCA)',

	'ADM_LOGOUT'         	=> 'Desconectarse&nbsp;del&nbsp;PCA',
	'ADM_LOGGED_OUT'		=> 'Se desconectó con éxito del Panel de Control de Administración (PCA)',

	'BACK'					=> 'Volver',

	'CANNOT_CHANGE_FILE_GROUP'	=> 'Incapaz de cambiar el grupo de archivos',
	'CANNOT_CHANGE_FILE_PERMISSIONS'	=> 'Incapaz de cambiar los permisos de archivos',
	'CANNOT_COPY_FILES'		=> 'Incapaz de copiar archivos',
	'CANNOT_CREATE_SYMLINK'	=> 'Incapaz de crear un enlace simbólico',
	'CANNOT_DELETE_FILES'	=> 'Incapaz de borrar los archivos del sistema',
	'CANNOT_DUMP_FILE'		=> 'Incapaz de volvar el archivo',
	'CANNOT_MIRROR_DIRECTORY'	=> 'Incapaz de reflejar el directorio',
	'CANNOT_RENAME_FILE'	=> 'Incapaz de renombrar un archivo del sistema',
	'CANNOT_TOUCH_FILES'	=> 'Incapaz de determinar si el archivo existe',

	'CONTAINER_EXCEPTION' => 'phpBB encontró un error al construir el contenedor debido a una extensión instalada. Por esta razón, todas las extensiones se han desactivado temporalmente. Por favor, intenta purgar el caché del foro. Todas las extensiones serán automáticamente habilitadas de nuevo una vez que se resuelva el error del contenedor. Si este error continúa, por favor visita <a href="https://www.phpbb.com/support">phpBB.com</a> para soporte.',
	'EXCEPTION' => 'Excepción',

	'COLOUR_SWATCH'			=> 'Paleta de colores WWW',
	'CONFIG_UPDATED'		=> 'Configuración actualizada correctamente.',
 	'CRON_LOCK_ERROR'		=> 'No se ha podido obtener bloqueo de cron.',
 	'CRON_NO_SUCH_TASK'		=> 'No se pudo encontrar la tarea cron “%s”.',
 	'CRON_NO_TASK'			=> 'No hay tareas cron que necesiten ejecutarse en estos momentos.',
 	'CRON_NO_TASKS'			=> 'No se han podido encontrar tareas cron.',
	'CURRENT_VERSION'		=> 'Versión actual',
	
	'DEACTIVATE'				=> 'Desactivar',
	'DIRECTORY_DOES_NOT_EXIST'	=> 'La ruta introducida "%s" no existe.',
	'DIRECTORY_NOT_DIR'			=> 'La ruta introducida "%s" no es un directorio.',
	'DIRECTORY_NOT_WRITABLE'	=> 'La ruta introducida "%s" no se puede escribir.',
	'DISABLE'					=> 'Deshabilitar',
	'DOWNLOAD'					=> 'Descargar',
	'DOWNLOAD_AS'				=> 'Descargar como',
	'DOWNLOAD_STORE'			=> 'Descargar o guardar archivo',
	'DOWNLOAD_STORE_EXPLAIN'	=> 'Puede descargar el archivo directamente o guardarlo en la carpeta <samp>store/</samp>.',
	'DOWNLOADS'          		=> 'Descargas',

	'EDIT'					=> 'Editar',
	'ENABLE'				=> 'Habilitar',
	'EXPORT_DOWNLOAD'		=> 'Descargar',
	'EXPORT_STORE'			=> 'Guardar',

	'GENERAL_OPTIONS'		=> 'Opciones generales',
	'GENERAL_SETTINGS'		=> 'Configuración general',
	'GLOBAL_MASK'			=> 'Máscara de permisos global',

	'INSTALL'				=> 'Instalar',
	'IP'					=> 'IP del usuario',
	'IP_HOSTNAME'			=> 'Direcciones de IP o nombres de host',

	'LATEST_VERSION'		=> 'Última versión',
	'LOAD_NOTIFICATIONS'			=> 'Mostrar Notificaciones',
	'LOAD_NOTIFICATIONS_EXPLAIN'	=> 'Mostrar la lista de Notificaciones en todas las páginas (por lo general en la cabecera).',
	'LOGGED_IN_AS'			=> 'Se identificó como:',
	'LOGIN_ADMIN'			=> 'Para Administrar el Sitio ha de ser un usuario identificado.',
	'LOGIN_ADMIN_CONFIRM'	=> 'Para Administrar el Sitio ha de introducir su contraseña otra vez.',
	'LOGIN_ADMIN_SUCCESS'	=> 'Ha sido autentificado y será llevado al Panel de Control de Administración (PCA)',
	'LOOK_UP_FORUM'			=> 'Elija un Foro',
	'LOOK_UP_FORUMS_EXPLAIN'=> 'Puede seleccionar más de un foro.',

	'MANAGE'				=> 'Administrar',
	'MENU_TOGGLE'			=> 'Ocultar o mostrar el menú lateral',
	'MORE'					=> 'Más',			// No usado de momento
	'MORE_INFORMATION'		=> 'Más información »',
	'MOVE_DOWN'				=> 'Bajar',
	'MOVE_UP'				=> 'Subir',

	'NOTIFY'				=> 'Notificación',
	'NO_ADMIN'				=> 'No está autorizado para Administrar este Sitio.',
	'NO_EMAILS_DEFINED'		=> 'La dirección de email no es válida',
	'NO_FILES_TO_DELETE'	=> 'No existen los adjuntos que usted seleccionó para su eliminación.',
	'NO_PASSWORD_SUPPLIED'	=> 'Necesita introducir su contraseña para acceder al Panel de Control de Administración (PCA).',	

	'OFF'					=> 'Off',
	'ON'					=> 'On',

	'PARSE_BBCODE'						=> 'Reconocer BBCode',
	'PARSE_SMILIES'						=> 'Reconocer emoticonos',
	'PARSE_URLS'						=> 'Reconocer enlaces',
	'PERMISSIONS_TRANSFERRED'			=> 'Permisos transferidos',
	'PERMISSIONS_TRANSFERRED_EXPLAIN' 	=> 'Ahora tiene los permisos de %1$s. Puede navegar por el Sitio con los permisos de este usuario pero no acceder al Panel de Control de Administración ya que los permisos administrativos no han sido transferidos. Está autorizado para <a href="%2$s"><strong>revertir sus permisos</strong></a> cuando quiera.',
	'PROCEED_TO_ACP'					=> '%sIr al Panel de Control de Administración (PCA)%s',

	'RELEASE_ANNOUNCEMENT'		=> 'Anuncio',
	'REMIND'							=> 'Recordar',
	'REPARSE_LOCK_ERROR'				=> 'El re-análisis ya está en funcionando con otro proceso.',
	'RESYNC'							=> 'Resincronizar',

	'RUNNING_TASK'			=> 'Ejecutando tarea: %s.',
	'SELECT_ANONYMOUS'		=> 'Seleccionar usuario anónimo',
	'SELECT_OPTION'			=> 'Seleccionar opción',

	'SETTING_TOO_LOW'      	=> 'El valor introducido para el parámetro “%1$s” es demasiado bajo. El valor mínimo permitido es %2$d.',
	'SETTING_TOO_BIG'      	=> 'El valor introducido para el parámetro “%1$s” es demasiado alto. El valor máximo permitido es %2$d.',
	'SETTING_TOO_LONG'      => 'El valor introducido para el parámetro “%1$s” es demasiado largo. La longitud máxima permitida es %2$d.',
	'SETTING_TOO_SHORT'     => 'El valor introducido para el parámetro “%1$s” no es suficientemente largo. La longitud mínima permitida es %2$d.',

	'SHOW_ALL_OPERATIONS'	=> 'Mostrar todas las operaciones',

 	'TASKS_NOT_READY'		=> 'Tarea no preparada:',
 	'TASKS_READY'			=> 'Tarea preparada:',
	'TOTAL_SIZE'      		=> 'Tamaño total',

	'UCP'					=> 'Panel de Control del Usuario',
	'URL_INVALID'			=> 'La URL proporcionada para la configuración “%1$s” no es válida.',
	'USERNAMES_EXPLAIN'		=> 'Inserte cada nombre de usuario en una línea diferente',
	'USER_CONTROL_PANEL'	=> 'Panel de Control del Usuario',

	'UPDATE_NEEDED'			=> 'El foro no está actualizado.',
	'UPDATE_NOT_NEEDED'		=> 'El foro está actualizado.',
	'UPDATES_AVAILABLE'		=> 'Actualizaciones disponibles:',

	'WARNING'				=> 'Advertencia',
));

// PHP info
$lang = array_merge($lang, array(
	'ACP_PHP_INFO_EXPLAIN'	=> 'Esta página muestra información de la versión de PHP instalada en el servidor. Incluye detalles de módulos cargados, variables disponibles y parámetros por defecto. Esta información puede ser útil para diagnosticar problemas. Por favor observe que algunas empresas de hosting pueden limitar la información que se muestre aquí por razones de seguridad. Le advertimos que no debería proporcionar ningún detalle de esta página excepto cuando lo requiera el <a href="https://www.phpbb.com/about/team/">usuarios del equipo oficial</a> en su Foro de Soporte.',

	'NO_PHPINFO_AVAILABLE'	=> 'La información sobre su configuración PHP no se puede determinar. Phpinfo() ha sido deshabilitado por razones de seguridad.',
));

// Logs
$lang = array_merge($lang, array(
	'ACP_ADMIN_LOGS_EXPLAIN'	=> 'Listado de las acciones realizadas por administradores. Puedes ordenarlas por nombre de usuario, fecha, IP o acción. Si tiene los permisos apropiados puede borrar acciones individuales o incluso el registro completo.',
	'ACP_CRITICAL_LOGS_EXPLAIN'	=> 'Listado de las acciones realizadas por el Sitio en sí mismo. Este registro te proporciona información que le puede ser útil para resolver problemas específicos, por ejemplo emails no enviados. Podrá ordenarlas por nombre de usuario, fecha, IP o acción. Si tiene los permisos apropiados puede borrar acciones individuales o incluso el registro completo.',
	'ACP_MOD_LOGS_EXPLAIN'		=> 'Listado de las acciones realizadas por moderadores, elige un foro del combo desplegable. Puede ordenarlas por nombre de usuario, fecha, IP o acción. Si tiene los permisos apropiados puede borrar acciones individuales o incluso el registro completo.',
	'ACP_USERS_LOGS_EXPLAIN'	=> 'Listado de las acciones realizadas por usuarios o sobre usuarios.',
	'ALL_ENTRIES'				=> 'Todas las entradas',

	'DISPLAY_LOG'	=> 'Mostrar entradas previas',

	'NO_ENTRIES'	=> 'No hay entradas en este período',

	'SORT_IP'		=> 'Dirección IP',
	'SORT_DATE'		=> 'Fecha',
	'SORT_ACTION'	=> 'Acción',
));

// Index page
$lang = array_merge($lang, array(
	'ADMIN_INTRO'				=> 'Gracias por elegir phpBB como tu foro. Esta pantalla le proporciona una visión general de las estadísticas del Sitio. Los enlaces a la izquierda le permiten un control completo del mismo. Cada página tiene instrucciones de cómo emplear las distintas herramientas.',
	'ADMIN_LOG'					=> 'Movimientos de los Administradores',
	'ADMIN_LOG_INDEX_EXPLAIN'	=> 'Visión general de las últimas cinco acciones llevadas a cabo por los Administradores del Sitio. Puede ver el registro completo en el menú correspondiente o siguiendo el enlace de abajo.',
	'AVATAR_DIR_SIZE'			=> 'Tamaño de la carpeta de avatares',

	'BOARD_STARTED'		=> 'Sitio Inaugurado',
	'BOARD_VERSION'		=> 'Versión del Sitio',

	'DATABASE_SERVER_INFO'	=> 'Servidor de base de datos',
	'DATABASE_SIZE'			=> 'Tamaño de la base de datos',

	// Enviroment configuration checks, mbstring related
	'ERROR_MBSTRING_FUNC_OVERLOAD'					=> 'Las funciones de sobrecarga no está configurado correctamente',
	'ERROR_MBSTRING_FUNC_OVERLOAD_EXPLAIN' 			=> '<var>mbstring.func_overload</var> se debe establecer en 0 o 4. Usted puede comprobar el valor actual en la página de <samp>Información de PHP</samp>.',
	'ERROR_MBSTRING_ENCODING_TRANSLATION' 			=> 'Codificación de caracteres transparentes no está configurado correctamente',
	'ERROR_MBSTRING_ENCODING_TRANSLATION_EXPLAIN' 	=> '<var>mbstring.encoding_translation</var> se debe establecer en 0. Usted puede comprobar el valor actual en la página de <samp>Información de PHP</samp>.',
	'ERROR_MBSTRING_HTTP_INPUT'						=> 'HTTP conversión de caracteres de entrada no está configurado correctamente',
	'ERROR_MBSTRING_HTTP_INPUT_EXPLAIN' 			=> '<var>mbstring.http_input</var> se debe establecer en <samp>pass</samp>. Usted puede comprobar el valor actual en la página de <samp>Información de PHP</samp>.',
	'ERROR_MBSTRING_HTTP_OUTPUT'					=> 'HTTP conversión de caracteres de salida no está configurado correctamente',
	'ERROR_MBSTRING_HTTP_OUTPUT_EXPLAIN' 			=> '<var>mbstring.http_output</var> se debe establecer en <samp>pass</samp>. Usted puede comprobar el valor actual en la página de <samp>Información de PHP</samp>.',

	'FILES_PER_DAY'		=> 'Adjuntos por día',
	'FORUM_STATS'		=> 'Estadísticas de foros',

	'GZIP_COMPRESSION'	=> 'Compresión GZip',

	'NO_SEARCH_INDEX'	=> 'El motor de búsqueda seleccionado no tiene un índice de búsqueda.<br />Por favor, cree el índice “%1$s” en la sección %2$sÍndice de Búsqueda%3$s .',
	'NOT_AVAILABLE'		=> 'No disponible',
	'NUMBER_FILES'		=> 'Número de adjuntos',
	'NUMBER_POSTS'		=> 'Número de mensajes',
	'NUMBER_TOPICS'		=> 'Número de temas',
	'NUMBER_USERS'		=> 'Número de usuarios',
	'NUMBER_ORPHAN'		=> 'Adjuntos huérfanos',

	'PHP_VERSION'		=> 'Versión PHP',
	'PHP_VERSION_OLD'	=> 'La versión de PHP de este servidor (%1$s) no recibirá soporte en futuras versiones de phpBB. La versión mínima requerida será PHP %2$s. %3$sDetalles%4$s',

	'POSTS_PER_DAY'		=> 'Mensajes por día',

	'PURGE_CACHE'			=> 'Limpiar la caché',
	'PURGE_CACHE_CONFIRM'	=> '¿Está seguro de que quiere limpiar la caché?',
	'PURGE_CACHE_EXPLAIN'	=> 'Limpiar todos los elementos relacionados con la caché, incluyendo cualquier plantilla o consulta cacheada.',
	'PURGE_CACHE_SUCCESS'	=> 'Caché limpiado correctamente.',

	'PURGE_SESSIONS'			=> 'Purgar todas las sesiones',
	'PURGE_SESSIONS_CONFIRM'	=> '¿Está seguro de que quiere purgar todas las sesiones? Esto desconectará a todos los usuarios.',
	'PURGE_SESSIONS_EXPLAIN'	=> 'Purgar todas las sesiones. Esto desconectará a todos los usuarios al limpiar la tabla de sesiones.',
	'PURGE_SESSIONS_SUCCESS'	=> 'Sesiones limpiadas correctamente.',

	'RESET_DATE'					=> 'Reiniciar fecha comienzo Sitio',
	'RESET_DATE_CONFIRM'			=> '¿Está seguro de que quiere reiniciar la fecha de comienzo del Sitio?',
	'RESET_DATE_SUCCESS'				=> 'Fecha de inicio del Foro reiniciada',
	'RESET_ONLINE'					=> 'Reiniciar contador usuarios máximos identificados',
	'RESET_ONLINE_CONFIRM'			=> '¿Está seguro de que quiere reiniciar el contador de mayor cantidad de usuarios en línea?',
	'RESET_ONLINE_SUCCESS'				=> 'Reiniciar mayor cantidad de usuarios en línea',
	'RESYNC_POSTCOUNTS'				=> 'Sincronizar recuento de mensajes',
	'RESYNC_POSTCOUNTS_EXPLAIN'		=> 'Se tomarán en consideración mensajes existentes. No se cuentan los mensajes purgados.',
	'RESYNC_POSTCOUNTS_CONFIRM'		=> '¿Está seguro de que quiere resincronizar la cantidad de mensajes?',
	'RESYNC_POSTCOUNTS_SUCCESS'			=> 'Resincronizar la cantidad de mensajes',
	'RESYNC_POST_MARKING'			=> 'Sincronizar temas marcados',
	'RESYNC_POST_MARKING_CONFIRM'	=> '¿Está seguro de que quiere resincronizar los temas marcados?',
	'RESYNC_POST_MARKING_EXPLAIN'	=> 'Primero desmarca todos los temas y luego marca correctamente los temas que han tenido actividad en los últimos seis meses.',
	'RESYNC_POST_MARKING_SUCCESS'	=> 'Resincronizar temas marcados',
	'RESYNC_STATS'					=> 'Sincronizar estadísticas',
	'RESYNC_STATS_CONFIRM'			=> '¿Está seguro de que quiere resincronizar las estadísticas?',
	'RESYNC_STATS_EXPLAIN'			=> 'Recalcula el número total de mensajes, temas, usuarios y archivos.',
	'RESYNC_STATS_SUCCESS'			=> 'Resincronizar estadísticas',
	'RUN'							=> 'Ejecutar',

	'STATISTIC'					=> 'Estadística',
	'STATISTIC_RESYNC_OPTIONS'	=> 'Resincronizar o reiniciar las estadísticas',

	'TIMEZONE_INVALID'	=> 'La zona horaria que ha seleccionado no es válida.',
	'TIMEZONE_SELECTED'	=> '(actualmente seleccionado)',
	'TOPICS_PER_DAY'	=> 'Temas por día',

	'UPLOAD_DIR_SIZE'	=> 'Tamaño de la carpeta de adjuntos',
	'USERS_PER_DAY'		=> 'Usuarios por día',

	'VALUE'						=> 'Valor',
	'VERSIONCHECK_FAIL'		=> 'Falló el intento de obtener información sobre la última versión.',
	'VERSIONCHECK_FORCE_UPDATE'	=> 'Volver a comprobar la versión',
	'VERSION_CHECK'			=> 'Comprobar versión',
	'VERSION_CHECK_EXPLAIN'		=> 'Comprobar si tú instalación de phpBB está actualizada.',
	'VERSIONCHECK_INVALID_ENTRY'	=> 'La información de versión más reciente contiene una entrada no admitida.',
	'VERSIONCHECK_INVALID_URL'	=> 'La información de versión más reciente contiene URL no válida.',
	'VERSIONCHECK_INVALID_VERSION'	=> 'La información de versión más reciente contiene una versión no válida.',
	'VERSION_NOT_UP_TO_DATE_ACP'	=> 'Tú instalación phpBB no está actualizada.<br />A continuación se muestra un enlace al anuncio de la versión, que contiene más información, así como instrucciones sobre la actualización.',
	'VERSION_NOT_UP_TO_DATE_TITLE'	=> 'Tú instalación phpBB no está actualizada.',
	'VERSION_UP_TO_DATE_ACP'	=> 'Tú instalación de phpBB está actualizada. No hay actualizaciones disponibles en este momento.',
	'VIEW_ADMIN_LOG'		=> 'Ver registro de Administradores',
	'VIEW_INACTIVE_USERS'		=> 'Ver usuarios inactivos',

	'WELCOME_PHPBB'			=> 'Bienvenido a phpBB',
	'WRITABLE_CONFIG'		=> 'En este momento tú archivo de configuración (config.php) permite escritura a todos. Le recomendamos de forma especial que cambie los permisos a 640 ó al menos 644 (por ejemplo: <a href="http://es.wikipedia.org/wiki/Chmod" rel="external">chmod</a> 644 config.php).',
));

// Inactive Users
$lang = array_merge($lang, array(
	'INACTIVE_DATE'					=> 'Fecha inactividad',
	'INACTIVE_REASON'				=> 'Razón',
	'INACTIVE_REASON_MANUAL'		=> 'Cuenta desactivada por La Administración',
	'INACTIVE_REASON_PROFILE'		=> 'Datos del perfil cambiados',
	'INACTIVE_REASON_REGISTER'		=> 'Cuenta registrada nuevamente',
	'INACTIVE_REASON_REMIND'		=> 'Recordar activación de cuenta de usuario',
	'INACTIVE_REASON_UNKNOWN'		=> 'Desconocido',
	'INACTIVE_USERS'				=> 'Usuarios inactivos',
	'INACTIVE_USERS_EXPLAIN'		=> 'Esta es una lista de usuarios registrados, pero con cuentas inactivas. Puede activar, borrar o recordárselo (enviando un e-mail) si quiere.',
	'INACTIVE_USERS_EXPLAIN_INDEX'	=> 'Esta es una lista de los últimos 10 usuarios registrados que tienen cuentas inactivas. Las cuentas están inactivas, ya sea porque la activación de la cuenta fue activada en la configuración de registro de usuarios, y las cuentas de estos usuarios aún no han sido activadas, o debido a que estas cuentas se han desactivado. Una lista completa está disponible desde el menú o siguiendo el enlace donde puede activar, borrar o recordárselo (enviando un e-mail) si quiere.',

	'NO_INACTIVE_USERS'	=> 'No hay usuarios inactivos',

	'SORT_INACTIVE'		=> 'Inactividad',
	'SORT_LAST_VISIT'	=> 'Última visita',
	'SORT_REASON'		=> 'Razón',
	'SORT_REG_DATE'		=> 'Fecha de registro',
	'SORT_LAST_REMINDER'=> 'Último recordado',
	'SORT_REMINDER'		=> 'Recordatorio enviado',

	'USER_IS_INACTIVE'		=> 'Usuario inactivo',
));

// Help support phpBB page
$lang = array_merge($lang, array(
	'EXPLAIN_SEND_STATISTICS'	=> 'Por favor envíe información sobre su servidor y configuraciones del foro a phpBB para análisis estadísticos. Toda información que pueda identificarle o a su web ha sido eliminada - los datos son completamente <strong>anónimos</strong>. Basamos las decisiones sobre futuras versiones de phpBB en esta información. Las estadísticas se ofrecen públicamente. También compartimos estos datos con el proyecto PHP, el lenguaje de programación con el que está hecho phpBB.',
	'EXPLAIN_SHOW_STATISTICS'	=> 'Usando el botón de abajo puede tener una vista previa de todas las variables que serán transmitidas.',
	'DONT_SEND_STATISTICS'		=> 'Vuelva al PCA si no desea enviar información estadística a phpBB.',
	'GO_ACP_MAIN'				=> 'Ir a la página inicial del PCA',
	'HIDE_STATISTICS'			=> 'Ocultar detalles',
	'SEND_STATISTICS'			=> 'Enviar estadísticas',
	'SEND_STATISTICS_LONG'		=> 'Enviar información estadística',
	'SHOW_STATISTICS'			=> 'Mostrar detalles',
	'THANKS_SEND_STATISTICS'	=> 'Gracias por enviar su información.',
	'FAIL_SEND_STATISTICS'		=> 'phpBB no pudo enviar estadísticas',
));

// Log Entries
$lang = array_merge($lang, array(
	'LOG_ACL_ADD_USER_GLOBAL_U_'		=> '<strong>Añadidos o editados: permisos de usuario</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_U_'		=> '<strong>Añadidos o editados: permisos de grupo de usuarios</strong><br />» %s',
	'LOG_ACL_ADD_USER_GLOBAL_M_'		=> '<strong>Añadidos o editados: permisos de Moderador global</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_M_'		=> '<strong>Añadidos o editados: permisos de grupos de Moderadores globales</strong><br />» %s',
	'LOG_ACL_ADD_USER_GLOBAL_A_'		=> '<strong>Añadidos o editados: permisos de Administrador</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_A_'		=> '<strong>Añadidos o editados: permisos de grupos de Administradores</strong><br />» %s',

	'LOG_ACL_ADD_ADMIN_GLOBAL_A_'		=> '<strong>Añadidos o editados: Administradores</strong><br />» %s',
	'LOG_ACL_ADD_MOD_GLOBAL_M_'			=> '<strong>Añadidos o editados: Moderadores globales</strong><br />» %s',

	'LOG_ACL_ADD_USER_LOCAL_F_'			=> '<strong>Añadidos o editados: acceso a foro de usuarios</strong> de %1$s<br />» %2$s',
	'LOG_ACL_ADD_USER_LOCAL_M_'			=> '<strong>Añadidos o editados: acceso a foro de moderadores</strong> de %1$s<br />» %2$s',
	'LOG_ACL_ADD_GROUP_LOCAL_F_'		=> '<strong>Añadidos o editados: acceso a foro de grupos de usuarios</strong> de %1$s<br />» %2$s',
	'LOG_ACL_ADD_GROUP_LOCAL_M_'		=> '<strong>Añadidos o editados: acceso a foro de grupos de moderadores</strong> de %1$s<br />» %2$s',

	'LOG_ACL_ADD_MOD_LOCAL_M_'			=> '<strong>Añadidos o editados: Moderadores</strong> de %1$s<br />» %2$s',
	'LOG_ACL_ADD_FORUM_LOCAL_F_'		=> '<strong>Añadidos o editados: permisos de foros</strong> de %1$s<br />» %2$s',

	'LOG_ACL_DEL_ADMIN_GLOBAL_A_'		=> '<strong>Borrado: Administradores</strong><br />» %s',
	'LOG_ACL_DEL_MOD_GLOBAL_M_'			=> '<strong>Borrado: Moderadores Globales</strong><br />» %s',
	'LOG_ACL_DEL_MOD_LOCAL_M_'			=> '<strong>Borrado: Moderadores</strong> de %1$s<br />» %2$s',
	'LOG_ACL_DEL_FORUM_LOCAL_F_'		=> '<strong>Borrado: Permisos de foro Usuario/Grupo </strong> de %1$s<br />» %2$s',

	'LOG_ACL_TRANSFER_PERMISSIONS'		=> '<strong>Permisos transferidos de</strong><br />» %s',
	'LOG_ACL_RESTORE_PERMISSIONS'		=> '<strong>Permisos propios restaurados después de usar permisos de</strong><br />» %s',

	'LOG_ADMIN_AUTH_FAIL'		=> '<strong>Falló autenticación de Administrador</strong>',
	'LOG_ADMIN_AUTH_SUCCESS'	=> '<strong>Autenticación de Administrador correcta</strong>',

	'LOG_ATTACHMENTS_DELETED'	=> '<strong>Adjuntos usuario eliminados</strong><br />» %s',

	'LOG_ATTACH_EXT_ADD'		=> '<strong>Agregados o editados: extensiones de adjuntos</strong><br />» %s',
	'LOG_ATTACH_EXT_DEL'		=> '<strong>Borrado: extensión de adjuntos</strong><br />» %s',
	'LOG_ATTACH_EXT_UPDATE'		=> '<strong>Actualizado: extensiones de adjuntos</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_ADD'	=> '<strong>Agregado: grupo de extensiones</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_EDIT'	=> '<strong>Editado: grupo de extensiones</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_DEL'	=> '<strong>Borrado: grupo de extensiones</strong><br />» %s',
	'LOG_ATTACH_FILEUPLOAD'		=> '<strong>Archivo huérfano subido a Mensaje</strong><br />» ID %1$d - %2$s',
	'LOG_ATTACH_ORPHAN_DEL'		=> '<strong>Archivo huérfano borrado</strong><br />» %s',

	'LOG_BAN_EXCLUDE_USER'	=> '<strong>Usuario quitado de exclusión</strong> por razón "<em>%1$s</em>"<br />» %2$s ',
	'LOG_BAN_EXCLUDE_IP'	=> '<strong>IP quitada de exclusión</strong> por razón "<em>%1$s</em>"<br />» %2$s ',
	'LOG_BAN_EXCLUDE_EMAIL'	=> '<strong>Email quitado de exclusión</strong> por razón "<em>%1$s</em>"<br />» %2$s ',
	'LOG_BAN_USER'			=> '<strong>Excluido: usuario</strong> por razón "<em>%1$s</em>"<br />» %2$s ',
	'LOG_BAN_IP'			=> '<strong>Excluida: IP</strong> por razón "<em>%1$s</em>"<br />» %2$s',
	'LOG_BAN_EMAIL'			=> '<strong>Excluido: email</strong> por razón "<em>%1$s</em>"<br />» %2$s',
	'LOG_UNBAN_USER'		=> '<strong>Quitado excluido: usuario</strong><br />» %s',
	'LOG_UNBAN_IP'			=> '<strong>Quitado excluida: IP</strong><br />» %s',
	'LOG_UNBAN_EMAIL'		=> '<strong>Quitado excluido: email</strong><br />» %s',

	'LOG_BBCODE_ADD'		=> '<strong>Añadido: nuevo BBCode</strong><br />» %s',
	'LOG_BBCODE_EDIT'		=> '<strong>Editado: BBCode</strong><br />» %s',
	'LOG_BBCODE_DELETE'		=> '<strong>Borrado: BBCode</strong><br />» %s',
	'LOG_BBCODE_CONFIGURATION_ERROR'	=> '<strong>Error al configurar el BBCode</strong>: %1$s<br />» %2$s',

	'LOG_BOT_ADDED'		=> '<strong>Añadido: robot</strong><br />» %s',
	'LOG_BOT_DELETE'	=> '<strong>Borrado: robot</strong><br />» %s',
	'LOG_BOT_UPDATED'	=> '<strong>Actualizado robot existente</strong><br />» %s',

	'LOG_CLEAR_ADMIN'		=> '<strong>Limpiado: registro admin</strong>',
	'LOG_CLEAR_CRITICAL'	=> '<strong>Limpiado: registro errores</strong>',
	'LOG_CLEAR_MOD'			=> '<strong>Limpiado: registro moderadores</strong>',
	'LOG_CLEAR_USER'		=> '<strong>Limpiado: registro usuario</strong><br />» %s',
	'LOG_CLEAR_USERS'		=> '<strong>Limpiado: registro de usuarios</strong>',

	'LOG_CONFIG_ATTACH'			=> '<strong>Modificado: configuración de adjuntos</strong>',
	'LOG_CONFIG_AUTH'			=> '<strong>Modificado: configuración de autentificación</strong>',
	'LOG_CONFIG_AVATAR'			=> '<strong>Modificado: configuración de avatar</strong>',
	'LOG_CONFIG_COOKIE'			=> '<strong>Modificado: configuración de cookie</strong>',
	'LOG_CONFIG_EMAIL'			=> '<strong>Modificado: configuración de email</strong>',
	'LOG_CONFIG_FEATURES'		=> '<strong>Modificado: propiedades del Sitio</strong>',
	'LOG_CONFIG_LOAD'			=> '<strong>Modificado: configuración de carga</strong>',
	'LOG_CONFIG_MESSAGE'		=> '<strong>Modificado: configuración de mensaje privado</strong>',
	'LOG_CONFIG_POST'			=> '<strong>Modificado: configuración de mensaje</strong>',
	'LOG_CONFIG_REGISTRATION'	=> '<strong>Modificado: configuración de registro de usuario</strong>',
	'LOG_CONFIG_FEED'			=> '<strong>Configuración de Syndication Feeds modificada</strong>',
	'LOG_CONFIG_SEARCH'			=> '<strong>Modificado: configuración de búsqueda</strong>',
	'LOG_CONFIG_SECURITY'		=> '<strong>Modificado: configuración de seguridad</strong>',
	'LOG_CONFIG_SERVER'			=> '<strong>Modificado: configuración del servidor</strong>',
	'LOG_CONFIG_SETTINGS'		=> '<strong>Modificado: configuración del Sitio</strong>',
	'LOG_CONFIG_SIGNATURE'		=> '<strong>Modificado: configuración de firma</strong>',
	'LOG_CONFIG_VISUAL'			=> '<strong>Modificado: configuración Anti-Spambot</strong>',

	'LOG_APPROVE_TOPIC'			=> '<strong>Tema aprobado</strong><br />» %s',
	'LOG_BUMP_TOPIC'			=> '<strong>Tema reactivado por usuario</strong><br />» %s',
	'LOG_DELETE_POST'			=> '<strong>Mensaje borrado “%1$s” escrito por “%2$s” por la siguiente razón</strong><br />» %3$s',
	'LOG_DELETE_SHADOW_TOPIC'	=> '<strong>Tema sombreado eliminado</strong><br />» %s',
	'LOG_DELETE_TOPIC'			=> '<strong>Tema eliminado “%1$s” escrito por “%2$s” por la siguiente razón</strong><br />» %3$s',
	'LOG_FORK'					=> '<strong>Tema copiado </strong><br />» de %s',
	'LOG_LOCK'					=> '<strong>Tema cerrado</strong><br />» %s',
	'LOG_LOCK_POST'				=> '<strong>Mensaje cerrado</strong><br />» %s',
	'LOG_MERGE'					=> '<strong>Mensajes unidos</strong> al tema<br />» %s',
	'LOG_MOVE'					=> '<strong>Tema movido</strong><br />» de %1$s a %2$s',
	'LOG_MOVED_TOPIC'			=> '<strong>Tema movido</strong><br />» %s',
	'LOG_PM_REPORT_CLOSED'		=> '<strong>Informe de MP cerrado</strong><br />» %s',
	'LOG_PM_REPORT_DELETED'		=> '<strong>Informe de MP eliminado</strong><br />» %s',
	'LOG_POST_APPROVED'			=> '<strong>Mensajes aprobados</strong><br />» %s',
	'LOG_POST_DISAPPROVED'		=> '<strong>Mensaje desaprobado “%1$s” escrito por “%3$s” por la siguiente razón</strong><br />» %2$s',
	'LOG_POST_EDITED'			=> '<strong>Mensaje editado “%1$s” escrito por “%2$s” por la siguiente razón</strong><br />» %3$s',
	'LOG_POST_RESTORED'			=> '<strong>Mensaje restaurado</strong><br />» %s',
	'LOG_REPORT_CLOSED'			=> '<strong>Informe cerrado</strong><br />» %s',
	'LOG_REPORT_DELETED'		=> '<strong>Informe borrado</strong><br />» %s',
	'LOG_RESTORE_TOPIC'			=> '<strong>Tema restaurado “%1$s” escrito por</strong><br />» %2$s',
	'LOG_SOFTDELETE_POST'		=> '<strong>Mensaje borrado temporalmente “%1$s” escrito por “%2$s” por la siguiente razón</strong><br />» %3$s',
	'LOG_SOFTDELETE_TOPIC'		=> '<strong>Tema borrado temporalmente “%1$s” escrito por “%2$s” por la siguiente razón</strong><br />» %3$s',
	'LOG_SPLIT_DESTINATION'		=> '<strong>Mensajes divididos movidos</strong><br />» a %s',
	'LOG_SPLIT_SOURCE'			=> '<strong>Mensajes divididos</strong><br />» de %s',

	'LOG_TOPIC_APPROVED'		=> '<strong>Tema aprobado</strong><br />» %s',
	'LOG_TOPIC_RESTORED'		=> '<strong>Tema restaurado</strong><br />» %s',
    	'LOG_TOPIC_DISAPPROVED'		=> '<strong>Tema desaprobado “%1$s” escrito por “%3$s” por la siguiente razón</strong><br />» %2$s',
	'LOG_TOPIC_RESYNC'			=> '<strong>Resincronizados contadores de temas</strong><br />» %s',
	'LOG_TOPIC_TYPE_CHANGED'	=> '<strong>Cambiado: tipo de tema</strong><br />» %s',
	'LOG_UNLOCK'				=> '<strong>Abierto: tema</strong><br />» %s',
	'LOG_UNLOCK_POST'			=> '<strong>Abierto: mensaje</strong><br />» %s',

	'LOG_DISALLOW_ADD'		=> '<strong>Añadido: deshabilitar nombre de usuario</strong><br />» %s',
	'LOG_DISALLOW_DELETE'	=> '<strong>Borrado: deshabilitar nombre de usuario</strong>',

	'LOG_DB_BACKUP'			=> '<strong>Base de datos: copia de seguridad</strong>',
	'LOG_DB_DELETE'			=> '<strong>Copia de Seguridad de base de datos borrada</strong>',
	'LOG_DB_RESTORE'		=> '<strong>Base de datos: restauración</strong>',

	'LOG_DOWNLOAD_EXCLUDE_IP'	=> '<strong>Excluído IP/hostname de la lista de descarga</strong><br />» %s',
	'LOG_DOWNLOAD_IP'			=> '<strong>Añadido: IP/hostname a la lista de descarga</strong><br />» %s',
	'LOG_DOWNLOAD_REMOVE_IP'	=> '<strong>Borrado: IP/hostname de la lista de descarga</strong><br />» %s',

	'LOG_ERROR_JABBER'		=> '<strong>Error Jabber</strong><br />» %s',
	'LOG_ERROR_EMAIL'		=> '<strong>Error Email</strong><br />» %s',
	'LOG_ERROR_CAPTCHA'		=> '<strong>Error CAPTCHA</strong><br />» %s',

	'LOG_FORUM_ADD'							=> '<strong>Creado: Nuevo foro</strong><br />» %s',
	'LOG_FORUM_COPIED_PERMISSIONS'			=> '<strong>Permisos de foro copiados</strong> de %1$s<br />» %2$s',
	'LOG_FORUM_DEL_FORUM'					=> '<strong>Borrado: foro</strong><br />» %s',
	'LOG_FORUM_DEL_FORUMS'					=> '<strong>Borrado: foro y subforos</strong><br />» %s',
	'LOG_FORUM_DEL_MOVE_FORUMS'				=> '<strong>Borrado: foro y movidos subforos</strong> a %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS'				=> '<strong>Borrado: foro y movidos mensajes </strong> a %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS_FORUMS' 		=> '<strong>Borrado: foro y subforos, mensajes movidos</strong> a %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS_MOVE_FORUMS'	=> '<strong>Borrado: foro, mensajes movidos</strong> a %1$s <strong>y subforos</strong> a %2$s<br />» %3$s',
	'LOG_FORUM_DEL_POSTS'					=> '<strong>Borrado: foro y sus mensajes</strong><br />» %s',
	'LOG_FORUM_DEL_POSTS_FORUMS'			=> '<strong>Borrado: foro, subforos y mensajes</strong><br />» %s',
	'LOG_FORUM_DEL_POSTS_MOVE_FORUMS' 		=> '<strong>Borrado: foro y sus mensajes, subforos movidos</strong> a %1$s<br />» %2$s',
	'LOG_FORUM_EDIT'						=> '<strong>Editado: detalles foro</strong><br />» %s',
	'LOG_FORUM_MOVE_DOWN'					=> '<strong>Movido: foro</strong> %1$s <strong>de abajo</strong> %2$s',
	'LOG_FORUM_MOVE_UP'						=> '<strong>Movido: foro</strong> %1$s <strong>encima de</strong> %2$s',
	'LOG_FORUM_SYNC'						=> '<strong>Foro resincronizado</strong><br />» %s',

	'LOG_GENERAL_ERROR'	=> '<strong>Ha ocurrido un error general</strong>: %1$s <br />» %2$s',

	'LOG_GROUP_CREATED'		=> '<strong>: nuevo grupo de usuarios</strong><br />» %s',
	'LOG_GROUP_DEFAULTS'	=> '<strong>Groupo “%1$s” por defecto para usuarios</strong><br />» %2$s',
	'LOG_GROUP_DELETE'		=> '<strong>Borrado grupo de usuarios</strong><br />» %s',
	'LOG_GROUP_DEMOTED'		=> '<strong>Responsables depuestos en grupo</strong> %1$s<br />» %2$s',
	'LOG_GROUP_PROMOTED'	=> '<strong>Usuarios promovidos a responsables en grupo</strong> %1$s<br />» %2$s',
	'LOG_GROUP_REMOVE'		=> '<strong>Usuarios eliminados de grupo</strong> %1$s<br />» %2$s',
	'LOG_GROUP_UPDATED'		=> '<strong>Actualizado: detalles de grupo de usuarios</strong><br />» %s',
	'LOG_MODS_ADDED'		=> '<strong>Agregados responsables de grupo</strong> %1$s<br />» %2$s',
	'LOG_USERS_ADDED'		=> '<strong>Agregados nuevos usuarios a grupo</strong> %1$s<br />» %2$s',
	'LOG_USERS_APPROVED'	=> '<strong>Usuarios aprobados en el grupo</strong> %1$s<br />» %2$s',
	'LOG_USERS_PENDING'		=> '<strong>Usuarios que pidieron unirse al grupo “%1$s” y necesitan ser aprobados</strong><br />» %2$s',

	'LOG_IMAGE_GENERATION_ERROR'	=> '<strong>Error al crear la imagen</strong><br />» Error en %1$s en la línea %2$s: %3$s',

	'LOG_INACTIVE_ACTIVATE'	=> '<strong>Activados: usuarios inactivos</strong><br />» %s',
	'LOG_INACTIVE_DELETE'	=> '<strong>Borrado: usuarios inactivos</strong><br />» %s',
	'LOG_INACTIVE_REMIND'	=> '<strong>Enviado email recordatorio a usuarios inactivos</strong><br />» %s',
	'LOG_INSTALL_CONVERTED'	=> '<strong>Migrado de %1$s a phpBB %2$s</strong>',
	'LOG_INSTALL_INSTALLED'	=> '<strong>Instalado phpBB %s</strong>',

	'LOG_IP_BROWSER_FORWARDED_CHECK' 	=> '<strong>Falló identificación de sesión IP/browser/X_FORWARDED_FOR </strong><br />»IP de usuario "<em>%1$s</em>" verificada contra sesión "<em>%2$s</em>", navegador de usuario "<em>%3$s</em>" verificado contra sesión "<em>%4$s</em>"  usuario X_FORWARDED_FOR "<em>%5$s</em>" verificado contra sesión X_FORWARDED_FOR  "<em>%6$s</em>".',

	'LOG_JAB_CHANGED'			=> '<strong>Jabber: cuenta cambiada</strong>',
	'LOG_JAB_PASSCHG'			=> '<strong>Jabber: contraseña cambiada</strong>',
	'LOG_JAB_REGISTER'			=> '<strong>Jabber: cuenta registrada</strong>',
	'LOG_JAB_SETTINGS_CHANGED'	=> '<strong>Jabber: parámetros cambiados</strong>',

	'LOG_LANGUAGE_PACK_DELETED'		=> '<strong>Borrado: paquete de idioma</strong><br />» %s',
	'LOG_LANGUAGE_PACK_INSTALLED'	=> '<strong>Instalado: paquete de idioma</strong><br />» %s',
	'LOG_LANGUAGE_PACK_UPDATED'		=> '<strong>Actualizado: detalles de paquete de idioma</strong><br />» %s',
	'LOG_LANGUAGE_FILE_REPLACED'	=> '<strong>Reemplazado: archivo de idioma</strong><br />» %s',
	'LOG_LANGUAGE_FILE_SUBMITTED'	=> '<strong>Archivo de idioma enviado a la carpeta store</strong><br />» %s',

	'LOG_MASS_EMAIL'		=> '<strong>Enviado: email masivo</strong><br />» %s',

	'LOG_MCP_CHANGE_POSTER'	=> '<strong>Cambiado remitente en el tema "%1$s"</strong><br />» de %2$s a %3$s',

	'LOG_MODULE_DISABLE'	=> '<strong>Módulo deshabilitado</strong><br />» %s',
	'LOG_MODULE_ENABLE'		=> '<strong>Módulo habilitado</strong><br />» %s',
	'LOG_MODULE_MOVE_DOWN'	=> '<strong>Módulo movido abajo</strong><br />» %1$s abajo %2$s',
	'LOG_MODULE_MOVE_UP'	=> '<strong>Módulo movido arriba</strong><br />» %1$s arriba %2$s',
	'LOG_MODULE_REMOVED'	=> '<strong>Módulo eliminado</strong><br />» %s',
	'LOG_MODULE_ADD'		=> '<strong>Módulo añadido</strong><br />» %s',
	'LOG_MODULE_EDIT'		=> '<strong>Módulo editado</strong><br />» %s',

	'LOG_A_ROLE_ADD'		=> '<strong>Añadido: rol de admin</strong><br />» %s',
	'LOG_A_ROLE_EDIT'		=> '<strong>Editado: rol de admin</strong><br />» %s',
	'LOG_A_ROLE_REMOVED'	=> '<strong>Eliminado: rol de admin</strong><br />» %s',
	'LOG_F_ROLE_ADD'		=> '<strong>Agredado: rol de foro</strong><br />» %s',
	'LOG_F_ROLE_EDIT'		=> '<strong>Editado: rol de foro</strong><br />» %s',
	'LOG_F_ROLE_REMOVED'	=> '<strong>Eliminado: rol de foro</strong><br />» %s',
	'LOG_M_ROLE_ADD'		=> '<strong>Agregado: rol de moderador</strong><br />» %s',
	'LOG_M_ROLE_EDIT'		=> '<strong>Editado: rol de moderador</strong><br />» %s',
	'LOG_M_ROLE_REMOVED'	=> '<strong>Eliminado: rol de moderador</strong><br />» %s',
	'LOG_U_ROLE_ADD'		=> '<strong>Agregado: rol de usuario</strong><br />» %s',
	'LOG_U_ROLE_EDIT'		=> '<strong>Editado: rol de usuario</strong><br />» %s',
	'LOG_U_ROLE_REMOVED'	=> '<strong>Eliminado: rol de usuario</strong><br />» %s',

	'LOG_PLUPLOAD_TIDY_FAILED'		=> '<strong>No se puede abrir %1$s para ordenarlo, compruebe los permisos.</strong><br />Excepción: %2$s<br />Rastro: %3$s',

	'LOG_PROFILE_FIELD_ACTIVATE'	=> '<strong>Activado: campo de perfil</strong><br />» %s',
	'LOG_PROFILE_FIELD_CREATE'		=> '<strong>Añadido: campo de perfil</strong><br />» %s',
	'LOG_PROFILE_FIELD_DEACTIVATE'	=> '<strong>Desactivado: campo de perfil</strong><br />» %s',
	'LOG_PROFILE_FIELD_EDIT'		=> '<strong>Cambiado: campo de perfil</strong><br />» %s',
	'LOG_PROFILE_FIELD_REMOVED'		=> '<strong>Eliminado: campo de perfil</strong><br />» %s',

	'LOG_PRUNE'					=> '<strong>Purgados: foros</strong><br />» %s',
	'LOG_AUTO_PRUNE'			=> '<strong>Auto-purgados: foros</strong><br />» %s',
    	'LOG_PRUNE_SHADOW'		=> '<strong>Auto-purgados: temas sombreados</strong><br />» %s',
	'LOG_PRUNE_USER_DEAC'		=> '<strong>Desactivados: usuarios</strong><br />» %s',
	'LOG_PRUNE_USER_DEL_DEL'	=> '<strong>Usuarios purgados y mensajes borrados</strong><br />» %s',
	'LOG_PRUNE_USER_DEL_ANON'	=> '<strong>Usuarios purgados y mensajes retenidos</strong><br />» %s',

	'LOG_PURGE_CACHE'			=> '<strong>Caché limpiado</strong>',
	'LOG_PURGE_SESSIONS'		=> '<strong>Sesiones limpiadas</strong>',

	'LOG_RANK_ADDED'		=> '<strong>Añadido: rango</strong><br />» %s',
	'LOG_RANK_REMOVED'		=> '<strong>Borrado: rango</strong><br />» %s',
	'LOG_RANK_UPDATED'		=> '<strong>Actualizado: rango</strong><br />» %s',

	'LOG_REASON_ADDED'		=> '<strong>Añadido: informe/razón denegado</strong><br />» %s',
	'LOG_REASON_REMOVED'	=> '<strong>Borrado: informe/razón denegado</strong><br />» %s',
	'LOG_REASON_UPDATED'	=> '<strong>Actualizado: informe/razón denegado</strong><br />» %s',

	'LOG_REFERER_INVALID'		=> '<strong>Validación del Referido fallida</strong><br />»El Referido era “<em>%1$s</em>”. La petición fue rechazada y se finalizó la sesión.',
	'LOG_RESET_DATE'			=> '<strong>Reiniciar fecha inicio Sitio</strong>',
	'LOG_RESET_ONLINE'			=> '<strong>Reiniciar número máximo de usuarios conectados</strong>',
	'LOG_RESYNC_FILES_STATS'	=> '<strong>Resincronizado: Estadísticas de archivo</strong>',
	'LOG_RESYNC_POSTCOUNTS'		=> '<strong>Resincronizado: Cantidad de mensajes</strong>',
	'LOG_RESYNC_POST_MARKING'	=> '<strong>Resincronizado: Temas marcados</strong>',
	'LOG_RESYNC_STATS'			=> '<strong>Resincronizado: Mensajes, temas y estadísticas de usuarios</strong>',

	'LOG_SEARCH_INDEX_CREATED'	=> '<strong>Índice de búsqueda creado por</strong><br />» %s',
	'LOG_SEARCH_INDEX_REMOVED'	=> '<strong>Índice de búsqueda borrado por</strong><br />» %s',
	'LOG_SPHINX_ERROR'			=> '<strong>Error en Sphinx</strong><br />» %s',
	'LOG_STYLE_ADD'				=> '<strong>Añadido: estilo</strong><br />» %s',
	'LOG_STYLE_DELETE'			=> '<strong>Borrado: estilo</strong><br />» %s',
	'LOG_STYLE_EDIT_DETAILS'	=> '<strong>Editado: estilo</strong><br />» %s',
	'LOG_STYLE_EXPORT'			=> '<strong>Exportado estilo</strong><br />» %s',

	// @deprecated 3.1
	'LOG_TEMPLATE_ADD_DB'			=> '<strong>Añadida: plantilla a base de datos</strong><br />» %s',
	// @deprecated 3.1
	'LOG_TEMPLATE_ADD_FS'			=> '<strong>Añadida: plantilla a sistema  de archivos</strong><br />» %s',
	'LOG_TEMPLATE_CACHE_CLEARED'	=> '<strong>Borrado: versiones cacheadas de archivos de conjunto de plantillas <em>%1$s</em></strong><br />» %2$s',
	'LOG_TEMPLATE_DELETE'			=> '<strong>Borrado: conjunto de plantillas</strong><br />» %s',
	'LOG_TEMPLATE_EDIT'				=> '<strong>Editado: conjunto de plantillas <em>%1$s</em></strong><br />» %2$s',
	'LOG_TEMPLATE_EDIT_DETAILS'		=> '<strong>Editado: detalle de plantillas</strong><br />» %s',
	'LOG_TEMPLATE_EXPORT'			=> '<strong>Exportado: conjunto de plantillas</strong><br />» %s',
	// @deprecated 3.1
	'LOG_TEMPLATE_REFRESHED'		=> '<strong>Actualizado: conjunto de plantillas</strong><br />» %s',

	// @deprecated 3.1
	'LOG_THEME_ADD_DB'			=> '<strong>Añadido: tema a base de datos</strong><br />» %s',
	// @deprecated 3.1
	'LOG_THEME_ADD_FS'			=> '<strong>Añadido: tema a filesystem</strong><br />» %s',
	'LOG_THEME_DELETE'			=> '<strong>Borrado: tema</strong><br />» %s',
	'LOG_THEME_EDIT_DETAILS'	=> '<strong>Editado: detalles de tema</strong><br />» %s',
	'LOG_THEME_EDIT'			=> '<strong>Editado: tema <em>%1$s</em></strong>',
	'LOG_THEME_EDIT_FILE'		=> '<strong>Editado: tema <em>%1$s</em></strong><br />» Modificado: archivo <em>%2$s</em>',
	'LOG_THEME_EXPORT'			=> '<strong>Exportado tema</strong><br />» %s',
	// @deprecated 3.1
	'LOG_THEME_REFRESHED'		=> '<strong>Actualizado: tema</strong><br />» %s',

	'LOG_UPDATE_DATABASE'	=> '<strong>Actualizado: Base de datos de versión %1$s a versión %2$s</strong>',
	'LOG_UPDATE_PHPBB'		=> '<strong>Actualizado: phpBB de versión %1$s a versión %2$s</strong>',

	'LOG_USER_ACTIVE'		=> '<strong>Activado: usuario</strong><br />» %s',
	'LOG_USER_BAN_USER'		=> '<strong>Excluido: usuario, vía administración de usuarios</strong> por razón "<em>%1$s</em>"<br />» %2$s',
	'LOG_USER_BAN_IP'		=> '<strong>Excluida: IP, vía administración de usuarios</strong> por razón "<em>%1$s</em>"<br />» %2$s',
	'LOG_USER_BAN_EMAIL'	=> '<strong>Excluido: email, vía administración de usuarios</strong> por razón "<em>%1$s</em>"<br />» %2$s',
	'LOG_USER_DELETED'		=> '<strong>Borrado: usuario</strong><br />» %s',
	'LOG_USER_DEL_ATTACH'	=> '<strong>Borrado: todos los adjuntos hechos por el usuario</strong><br />» %s',
	'LOG_USER_DEL_AVATAR'	=> '<strong>Borrado: avatar de usuario</strong><br />» %s',
	'LOG_USER_DEL_OUTBOX'	=> '<strong>Bandeja de salida del usuario vaciada</strong><br />» %s',
	'LOG_USER_DEL_POSTS'	=> '<strong>Borrado: todos los mensajes hechos por el usuario</strong><br />» %s',
	'LOG_USER_DEL_SIG'		=> '<strong>Borrado: firma de usuario</strong><br />» %s',
	'LOG_USER_INACTIVE'		=> '<strong>Desactivado: usuario</strong><br />» %s',
	'LOG_USER_MOVE_POSTS'	=> '<strong>Movido: mensajes </strong><br />» hechos por "%1$s" a foro "%2$s"',
	'LOG_USER_NEW_PASSWORD'	=> '<strong>Cambiada: clave de usuario</strong><br />» %s',
	'LOG_USER_REACTIVATE'	=> '<strong>Forzada: reactivación de cuenta de usuario</strong><br />» %s',
	'LOG_USER_REMOVED_NR'	=> '<strong>Marca de Nuevo Usuario Registrado eliminada del usuario</strong><br />» %s',

	'LOG_USER_UPDATE_EMAIL'	=> '<strong>Usuario "%1$s" cambió email</strong><br />» de "%2$s" a "%3$s"',
	'LOG_USER_UPDATE_NAME'	=> '<strong>Cambiado: nombre de usuario</strong><br />» de "%1$s" a "%2$s"',
	'LOG_USER_USER_UPDATE'	=> '<strong>Actualizado: detalles de usuario</strong><br />» %s',

	'LOG_USER_ACTIVE_USER'		=> '<strong>Cuenta de usuario activada</strong>',
	'LOG_USER_DEL_AVATAR_USER'	=> '<strong>Avatar de usuario eliminado</strong>',
	'LOG_USER_DEL_SIG_USER'		=> '<strong>Firma de usuario eliminado</strong>',
	'LOG_USER_FEEDBACK'			=> '<strong>Añadido: observaciones usuario</strong><br />» %s',
	'LOG_USER_GENERAL'			=> '<strong>Entrada añadida:</strong><br />» %s',
	'LOG_USER_INACTIVE_USER'	=> '<strong>Cuenta de usuario desactivada</strong>',
	'LOG_USER_LOCK'				=> '<strong>Usuario bloqueó su propio tema</strong><br />» %s',
	'LOG_USER_MOVE_POSTS_USER'	=> '<strong>Movido: todos los mensajes al foro</strong>» %s',
	'LOG_USER_REACTIVATE_USER'	=> '<strong>Reactivación de cuenta de usuario forzada</strong>',
	'LOG_USER_UNLOCK'			=> '<strong>Usuario desbloqueó su propio tema</strong><br />» %s',
	'LOG_USER_WARNING'			=> '<strong>Añadido: advertencia a usuario</strong><br />» %s',
	'LOG_USER_WARNING_BODY'		=> '<strong>La siguiente advertencia fue hecha al usuario</strong><br />» %s',

	'LOG_USER_GROUP_CHANGE'			=> '<strong>Usuario cambió grupo por defecto</strong><br />» %s',
	'LOG_USER_GROUP_DEMOTE'			=> '<strong>Usuario depuesto del grupo</strong><br />» %s',
	'LOG_USER_GROUP_JOIN'			=> '<strong>Usuario ingresó en el grupo</strong><br />» %s',
	'LOG_USER_GROUP_JOIN_PENDING'	=> '<strong>Usuario ingresó en el grupo y necesita aprobación</strong><br />» %s',
	'LOG_USER_GROUP_RESIGN'			=> '<strong>Usuario renunció al grupo</strong><br />» %s',

	'LOG_WARNING_DELETED'		=> '<strong>Avisos de usuario eliminados</strong><br />» %s',
	'LOG_WARNINGS_DELETED'		=> array(
		1 => '<strong>Eliminado aviso del usuario</strong><br />» %1$s',
		2 => '<strong>Eliminados %2$d avisos del usuario</strong><br />» %1$s', // Example: '<strong>Deleted 2 user warnings</strong><br />» username'
	),
	'LOG_WARNINGS_DELETED_ALL'	=> '<strong>Eliminados todos los avisos del usuario</strong><br />» %s',

	'LOG_WORD_ADD'			=> '<strong>Añadida: palabra censurada</strong><br />» %s',
	'LOG_WORD_DELETE'		=> '<strong>Borrada: palabra censurada</strong><br />» %s',
	'LOG_WORD_EDIT'			=> '<strong>Editada: palabra censurada</strong><br />» %s',

	'LOG_EXT_ENABLE'	=> '<strong>Extensión habilitada</strong><br />» %s',
	'LOG_EXT_DISABLE'	=> '<strong>Extensión deshabilitada</strong><br />» %s',
	'LOG_EXT_PURGE'		=> '<strong>Datos de Extensión borrados</strong><br />» %s',
	'LOG_EXT_UPDATE'	=> '<strong>Extensión actualizada</strong><br />» %s',
));
