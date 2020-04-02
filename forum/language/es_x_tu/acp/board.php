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

// Board Settings
$lang = array_merge($lang, array(
	'ACP_BOARD_SETTINGS_EXPLAIN'	=> 'Aquí puedes determinar las operaciones básicas de tu sitio, desde el nombre pasando por el registro de usuarios hasta los mensajes privados.',
	'BOARD_INDEX_TEXT'				=> 'Texto del índice del foro',
	'BOARD_INDEX_TEXT_EXPLAIN'		=> 'Este texto será mostrado en el índice general del foro. Si no se especifica, se usará por defecto “Índice general”.',
	'BOARD_STYLE'					=> 'Estilo del foro',
	'CUSTOM_DATEFORMAT'				=> 'Personalizar…',
	'DEFAULT_DATE_FORMAT'			=> 'Formato de fecha',
	'DEFAULT_DATE_FORMAT_EXPLAIN'	=> 'El formato de fecha es el mismo que en la función <code><a href="https://secure.php.net/manual/function.date.php">date()</a></code> de PHP.',
	'DEFAULT_LANGUAGE'				=> 'Idioma por defecto',
	'DEFAULT_STYLE'					=> 'Estilo por defecto',
	'DEFAULT_STYLE_EXPLAIN'			=> 'El estilo por defecto para nuevos usuarios.',
	'DISABLE_BOARD'					=> 'Deshabilitar sitio',
	'DISABLE_BOARD_EXPLAIN'			=> 'Esto hará al sitio inaccesible a los usuarios que no sean ni Administradores ni Moderadores. Si quieres, también puedes introducir un breve mensaje (255 caracteres) para mostrar.',
	'DISPLAY_LAST_SUBJECT'			=> 'Mostrar asunto del último mensaje añadido en la lista del foros',
	'DISPLAY_LAST_SUBJECT_EXPLAIN'	=> 'El asunto del último mensaje añadido será mostrado en la lista de foros con un enlace al mensaje. No se muestran los temas de los foros con contraseña y foros en los que el usuario no tiene permisos de lectura.',
	'GUEST_STYLE'					=> 'Estilo de invitado',
	'GUEST_STYLE_EXPLAIN'			=> 'El estilo del foro para invitados.',
	'OVERRIDE_STYLE'				=> 'Sustituir estilo del usuario',
	'OVERRIDE_STYLE_EXPLAIN'		=> 'Reemplaza el estilo del usuario (e invitados) con el estilo definido en "Estilo por defecto".',
	'SITE_DESC'						=> 'Descripción del sitio',
	'SITE_HOME_TEXT'				=> 'Texto del sitio web principal',
	'SITE_HOME_TEXT_EXPLAIN'		=> 'Este texto se mostrará como un enlace a su página web en el foro. Si no se especifica, se usará por defecto “Inicio”.',
	'SITE_HOME_URL'					=> 'URL del sitio web principal',
	'SITE_HOME_URL_EXPLAIN'			=> 'Si se especifica, un enlace a esta URL se antepondrá a la navegación de su foro y el logo del foro accederá a está URL en lugar del índice del foro. Se requiere una dirección URL absoluta, por ejemplo, <samp>http://www.phpbb.com</samp>.',
	'SITE_NAME'						=> 'Nombre del sitio',
	'SYSTEM_TIMEZONE'				=> 'Zona horaria para invitados',
	'SYSTEM_TIMEZONE_EXPLAIN'   	=> 'Zona horaria a usar para mostrar horarios a usuarios no identificados (invitados, bots). Los usuarios identificados eligen su zona horaria durante el proceso de registro y pueden cambiarla en su Panel de Usuario.',
	'WARNINGS_EXPIRE'				=> 'Duración de la advertencia',
	'WARNINGS_EXPIRE_EXPLAIN'		=> 'Número de días a transcurrir antes de que una advertencia expire automáticamente. Establezca este valor como 0 para crear advertencias permanentes.',
));

// Board Features
$lang = array_merge($lang, array(
	'ACP_BOARD_FEATURES_EXPLAIN'	=> 'Aquí puede habilitar/deshabilitar varias características del sitio',

	'ALLOW_ATTACHMENTS'		=> 'Permitir adjuntos',
	'ALLOW_BIRTHDAYS'		=> 'Permitir cumpleaños',
	'ALLOW_BIRTHDAYS_EXPLAIN'	=> 'Permitir la introducción de cumpleaños y que la edad sea visualizada en los perfiles. Por favor, ten en cuenta que la lista de cumpleaños en el Índice del Foro está controlada por otro parámetro.',
	'ALLOW_BOOKMARKS'		=> 'Permitir añadir temas como Favoritos',
	'ALLOW_BOOKMARKS_EXPLAIN'	=> 'El usuario será capaz de guardar Favoritos personales',
	'ALLOW_BBCODE'			=> 'Permitir BBCode',
	'ALLOW_FORUM_NOTIFY'		=> 'Permitir la suscripción/seguimiento de Foros',
	'ALLOW_NAME_CHANGE'		=> 'Permitir cambios de nombre de usuario',
	'ALLOW_NO_CENSORS'		=> 'Permitir deshabilitar lista de palabras censuradas',
	'ALLOW_NO_CENSORS_EXPLAIN'	=> 'Los usuarios pueden elegir deshabilitar la lista de palabras censuradas de mensajes y mensajes privados.',
	'ALLOW_PM_ATTACHMENTS'		=> 'Permitir adjuntos en mensajes privados',
	'ALLOW_PM_REPORT'		=> 'Permitir a los usuarios informar de mensajes privados',
	'ALLOW_PM_REPORT_EXPLAIN'	=> 'Si esta configuración está habilitada, los usuarios tienen la opción de informar de un mensaje privado que hayan recibido o enviado a los moderadores del foro. Estos mensajes privados serán visibles entonces en el Panel de Control de Moderador.',
	'ALLOW_QUICK_REPLY'		=> 'Permitir respuesta rápida',
	'ALLOW_QUICK_REPLY_EXPLAIN'	=> 'Este interruptor permite deshabilitar la respuesta rápida en todo el Sitio. Si la opción está habilitada la configuración específica de cada foro será usada para determinar si la respuesta rápida será mostrada en los foros individuales.',
	'ALLOW_QUICK_REPLY_BUTTON'	=> 'Enviar y habilitar la respuesta rápida en todos los foros',
	'ALLOW_SIG'			=> 'Permitir firmas',
	'ALLOW_SIG_BBCODE'		=> 'Permitir etiquetas BBCode en la firma del usuario',
	'ALLOW_SIG_FLASH'		=> 'Permitir uso de etiquetas BBCode <code>[FLASH]</code> en la firma del usuario',
	'ALLOW_SIG_IMG'			=> 'Permitir uso de etiquetas BBCode <code>[IMG]</code> en la firma del usuario',
	'ALLOW_SIG_LINKS'		=> 'Permitir uso de enlaces en la firma del usuario',
	'ALLOW_SIG_LINKS_EXPLAIN'	=> 'Si está deshabilitado, las etiquetas BBCode <code>[URL]</code> y las URL\'s automáticas estarán deshabilitadas.',
	'ALLOW_SIG_SMILIES'		=> 'Permitir uso de emoticonos en la firma del usuario',
	'ALLOW_SMILIES'			=> 'Permitir emoticonos',
	'ALLOW_TOPIC_NOTIFY'		=> 'Permitir la suscripción a temas',
	'BOARD_PM'			=> 'Mensajes privados',
	'BOARD_PM_EXPLAIN'		=> 'Habilite o deshabilite mensajes privados para todos los usuarios.',
	'ALLOW_BOARD_NOTIFICATIONS' => 'Permitir notificaciones del foro',
));

// Avatar Settings
$lang = array_merge($lang, array(
	'ACP_AVATAR_SETTINGS_EXPLAIN'	=> 'Los avatares son, por lo general, pequeñas imágenes distintivas que un usuario puede asociar a sí mismo. Dependiendo del estilo suelen ser mostrados debajo del nombre de usuario cuando se lea un tema. Aquí puede establecer cómo podrán determinar los usuarios sus propios avatares. Por favor tenga en cuenta que para subir avatares necesita haber creado el directorio que se configura abajo y asegurarse de que pueda ser escrito por el servidor Web. Por favor tenga también en cuenta que los límites en el tamaño del archivo solo tienen efecto sobre los avatares subidos, no se aplican a las imágenes enlazadas fuera del Sitio.',

	'ALLOW_AVATARS'					=> 'Habilitar avatares',
	'ALLOW_AVATARS_EXPLAIN'			=> 'Permitir el uso general de avatares;<br>Si deshabilita los avatares en general o los avatares en algún modo, los avatares deshabilitados no serán mostrados más en el foro, pero los usuarios aún podrán descargar sus propios avatares a través del Panel de Control de Usuario.',
	'ALLOW_GRAVATAR'				=> 'Habilitar avatares de gravatar',	
	'ALLOW_LOCAL'					=> 'Habilitar galería de avatares',
	'ALLOW_REMOTE'					=> 'Habilitar avatares remotos',
	'ALLOW_REMOTE_EXPLAIN'			=> 'Avatares enlazados de otro sitio web.<br><em><strong class="error">Advertencia:</strong> Habilitar esta función podría permitir a los usuarios verificar la existencia de archivos y servicios a los que solo se puede acceder en red local.</em>',
	'ALLOW_REMOTE_UPLOAD'			=> 'Permitir subida remota de avatares',
	'ALLOW_REMOTE_UPLOAD_EXPLAIN'	=> 'Permitir subida de avatares desde otra web.<br><em><strong class="error">Advertencia:</strong> Habilitar esta función podría permitir a los usuarios verificar la existencia de archivos y servicios a los que solo se puede acceder en red local.</em>',
	'ALLOW_UPLOAD'					=> 'Habilitar la subida de avatares',
	'AVATAR_GALLERY_PATH'			=> 'Ruta de galería de avatares',
	'AVATAR_GALLERY_PATH_EXPLAIN'	=> 'Ruta en su directorio raíz para imagenes precargadas, ej. <samp>images/avatars/gallery</samp>.<br>Puntos dobles como <samp>../</samp> se eliminarán de la ruta por razones de seguridad.',
	'AVATAR_STORAGE_PATH'			=> 'Ruta en la que se guardarán los avatares',
	'AVATAR_STORAGE_PATH_EXPLAIN'	=> 'Ruta en su directorio raíz, ej. <samp>images/avatars/upload</samp><br>Subida de avatar <strong>no estará disponible</strong> si no se puede escribir en esa ruta.<br>Puntos dobles como <samp>../</samp> se eliminarán de la ruta por razones de seguridad.',
	'MAX_AVATAR_SIZE'				=> 'Dimensiones máximas del avatar',
	'MAX_AVATAR_SIZE_EXPLAIN'		=> '(Ancho x Alto en pixels)',
	'MAX_FILESIZE'					=> 'Tamaño máximo del avatar',
	'MAX_FILESIZE_EXPLAIN'			=> 'Para archivos subidos. Si este valor es 0, el tamaño del archivo para subir sólo estará limitado por la configuración de PHP.',
	'MIN_AVATAR_SIZE'				=> 'Dimensiones mínimas del avatar',
	'MIN_AVATAR_SIZE_EXPLAIN'		=> '(Ancho x Alto en pixels)',
));

// Message Settings
$lang = array_merge($lang, array(
	'ACP_MESSAGE_SETTINGS_EXPLAIN'	=> 'Aquí puede ajustar los parámetros por defecto de los mensajes privados',

	'ALLOW_BBCODE_PM'		=> 'Permitir BBCode en mensajes privados',
	'ALLOW_FLASH_PM'		=> 'Permitir uso de etiquetas BBCode <code>[FLASH]</code>',
	'ALLOW_FLASH_PM_EXPLAIN'	=> 'Observe que la capacidad de usar flash en mensajes privados, si está habilitado aquí, también depende de los permisos.',
	'ALLOW_FORWARD_PM'		=> 'Permitir reenvío de mensajes privados',
	'ALLOW_IMG_PM'			=> 'Permitir uso de etiquetas BBCode <code>[IMG]</code>',
	'ALLOW_MASS_PM'			=> 'Permitir envío de mensajes privados a múltiples usuarios y grupos',
	'ALLOW_MASS_PM_EXPLAIN'		=> 'El envío a grupos puede ser configurado por grupos en la página de configuración de grupos.',
	'ALLOW_PRINT_PM'		=> 'Permitir vista de impresión en mensajes privados',
	'ALLOW_QUOTE_PM'		=> 'Permitir citas en mensajes privados',
	'ALLOW_SIG_PM'			=> 'Permitir firmas en mensajes privados',
	'ALLOW_SMILIES_PM'		=> 'Permitir emoticonos en mensajes privados',
	'BOXES_LIMIT'			=> 'Máximo de mensajes privados por carpeta',
	'BOXES_LIMIT_EXPLAIN'		=> 'Los usuarios pueden recibir no más que esta cantidad de mensajes en cada una de sus bandejas de mensajes privados. Ajuste este valor a  0 para permitir mensajes ilimitados.',
	'BOXES_MAX'			=> 'Máximo de carpetas de mensajes',
	'BOXES_MAX_EXPLAIN'		=> 'Por defecto los usuarios pueden crear este número de carpetas personales para mensajes privados.',
	'ENABLE_PM_ICONS'		=> 'Habilitar uso de emoticonos en temas de mensajes privados',
	'FULL_FOLDER_ACTION'		=> 'Acción por defecto para carpeta llena',
	'FULL_FOLDER_ACTION_EXPLAIN'=> 'Acción a tomar si la carpeta de un usuario está llena, asumiendo que la acción elegida por el usuario, si es que ha elegido alguna, no es aplicable. La única excepción es para la carpeta "Mensajes Enviados" donde la acción por defecto es siempre borrar los mensajes antiguos.',
	'HOLD_NEW_MESSAGES'		=> 'Mantener nuevos mensajes',
	'PM_EDIT_TIME'			=> 'Tiempo límite de edición',
	'PM_EDIT_TIME_EXPLAIN'		=> 'Limita el tiempo disponible para editar un mensaje privado aún no entregado. Ponga este valor a 0 para deshabilitar esta opción.',
	'PM_MAX_RECIPIENTS'		=> 'Máximo de destinatarios permitidos',
	'PM_MAX_RECIPIENTS_EXPLAIN'	=> 'El número máximo de destinatarios permitidos en un mensaje privado. Si se inserta 0 se permitirá un número ilimitado. Esta configuración puede ser configurado para cada grupo en la página de configuración de grupos.',
));

// Post Settings
$lang = array_merge($lang, array(
	'ACP_POST_SETTINGS_EXPLAIN'	=> 'Aquí puede ajustar los parámetros por defecto de los mensajes',
	'ALLOW_POST_LINKS'		=> 'Permitir enlaces en mensajes/mensajes privados',
	'ALLOW_POST_LINKS_EXPLAIN'	=> 'Si está deshabilitado, las etiquetas BBCode <code>[URL]</code> y las URLs automáticas estarán deshabilitadas.',
	'ALLOWED_SCHEMES_LINKS'				=> 'Permitir esquemas en los enlaces',
	'ALLOWED_SCHEMES_LINKS_EXPLAIN'		=> 'Los usuarios sólo pueden publicar URL de esquema, o una de las listas separadas por comas de esquemas permitidos.',
	'ALLOW_POST_FLASH'		=> 'Permitir etiquetas BBCODE <code>[FLASH]</code> en los mensajes',
	'ALLOW_POST_FLASH_EXPLAIN'	=> 'Si está deshabilitado, las etiquetas BBCode <code>[FLASH]</code> estarán deshabilitadan en los mensajes. De lo contrario el sistema de permisos controla qué usuarios pueden utilizar etiquetas BBCODE <code>[FLASH]</code>.',

	'BUMP_INTERVAL'			=> 'Intervalo de reactivación',
	'BUMP_INTERVAL_EXPLAIN'		=> 'Número de minutos, horas o días entre el último mensaje de un tema y la capacidad de reactivar ese tema. Ajuste este valor a 0 para deshabilitar la reactivación por completo.',
	'CHAR_LIMIT'			=> 'Máximo de caracteres por mensaje',
	'CHAR_LIMIT_EXPLAIN'		=> 'El número de caracteres permitidos en un mensaje. Ajuste este valor a 0 para caracteres ilimitados.',
	'DELETE_TIME'			=> 'Límite para poder borrar',
	'DELETE_TIME_EXPLAIN'		=> 'Limita el tiempo disponible para borrar un nuevo mensaje. Inserte el valor 0 para deshabilitarlo.',
	'DISPLAY_LAST_EDITED'		=> 'Mostrar la fecha de la última edición',
	'DISPLAY_LAST_EDITED_EXPLAIN'	=> 'Decidir si la fecha de la última edición se mostrará en los mensajes',
	'EDIT_TIME'			=> 'Tiempo límite de edición',
	'EDIT_TIME_EXPLAIN'		=> 'Limita el tiempo disponible para editar un mensaje. Ajuste este valor a 0 para deshabilitar esta opción.',
	'FLOOD_INTERVAL'		=> 'Intervalo de saturación',
	'FLOOD_INTERVAL_EXPLAIN'	=> 'Número de segundos que un usuario debe esperar para enviar un nuevo mensaje. Habilitar a los usuarios para ignorar esto requiere modificar sus permisos.',
	'HOT_THRESHOLD'			=> 'Umbral para Tema Popular',
	'HOT_THRESHOLD_EXPLAIN'		=> 'Mensajes por tema requeridos para que sea considerado popular. Ajuste este valor a 0 para deshabilitar esta opción.',
	'MAX_POLL_OPTIONS'		=> 'Número máximo de opciones en encuestas',
	'MAX_POST_FONT_SIZE'		=> 'Tamaño máximo de fuente en mensajes.',
	'MAX_POST_FONT_SIZE_EXPLAIN'	=> 'Tamaño máximo de fuente permitido en un mensaje. Ajuste este valor a 0 para tamaño ilimitado.',
	'MAX_POST_IMG_HEIGHT'		=> 'Altura máxima de imagen en mensajes',
	'MAX_POST_IMG_HEIGHT_EXPLAIN'	=> 'Altura máxima de una imagen/flash en mensajes. Ajuste este valor a 0 para tamaño ilimitado.',
	'MAX_POST_IMG_WIDTH'		=> 'Ancho máximo de imagen en mensajes',
	'MAX_POST_IMG_WIDTH_EXPLAIN'	=> 'Ancho máximo de una imagen/flash en mensajes. Ajuste este valor a 0 para tamaño ilimitado.',
	'MAX_POST_URLS'			=> 'Máximo de enlaces por mensaje',
	'MAX_POST_URLS_EXPLAIN'		=> 'Número máximo de URLs en un mensaje. Ajuste este valor a 0 para enlaces ilimitados.',
	'MIN_CHAR_LIMIT'		=> 'Número mínimo de caracteres por mensaje',
	'MIN_CHAR_LIMIT_EXPLAIN'	=> 'El número mínimo de caracteres que el usuario necesita introducir en el mensaje (o mensaje privado). El mínimo para este ajuste es 1.',
	'POSTING'			=> 'Publicación',
	'POSTS_PER_PAGE'		=> 'Mensajes por página',
	'QUOTE_DEPTH_LIMIT'		=> 'Profundidad máxima de anidamiento de citas por mensaje',
	'QUOTE_DEPTH_LIMIT_EXPLAIN'	=> 'Profundidad máxima de anidamiento de citas en un mensaje. Ajuste este valor a 0 para profundidad infinita.',
	'SMILIES_LIMIT'			=> 'Máximo de emoticonos por mensaje',
	'SMILIES_LIMIT_EXPLAIN'		=> 'Número máximo de emoticonos en un mensaje. Ajuste este valor a 0 para emoticonos ilimitados.',
	'SMILIES_PER_PAGE'		=> 'Emoticonos por página',
	'TOPICS_PER_PAGE'		=> 'Temas por página',
));

// Signature Settings
$lang = array_merge($lang, array(
	'ACP_SIGNATURE_SETTINGS_EXPLAIN'	=> 'Aquí puede ajustar los parámetros por defecto de las firmas',

	'MAX_SIG_FONT_SIZE'				=> 'Tamaño máximo de fuente en firmas',
	'MAX_SIG_FONT_SIZE_EXPLAIN'		=> 'Tamaño máximo de fuente permitido en firmas. Ajuste este valor a 0 para tamaño ilimitado.',
	'MAX_SIG_IMG_HEIGHT'			=> 'Altura máxima de imagen en firmas',
	'MAX_SIG_IMG_HEIGHT_EXPLAIN'	=> 'Altura máxima de una imagen/flash en firmas. Ajuste este valor a 0 para tamaño ilimitado.',
	'MAX_SIG_IMG_WIDTH'				=> 'Ancho máximo de imagen en firmas',
	'MAX_SIG_IMG_WIDTH_EXPLAIN'		=> 'Ancho máximo de una imagen/flash en firmas. Ajuste este valor a 0 para tamaño ilimitado.',
	'MAX_SIG_LENGTH'				=> 'Longitud máxima de las firmas',
	'MAX_SIG_LENGTH_EXPLAIN'		=> 'Máximo número de caracteres en las firmas de los usuarios.',
	'MAX_SIG_SMILIES'				=> 'Máximo de emoticonos por firma',
	'MAX_SIG_SMILIES_EXPLAIN'		=> 'Número máximo de emoticonos en las firmas. Ajuste este valor a 0 para emoticonos ilimitados.',
	'MAX_SIG_URLS'					=> 'Máximo de enlaces por firma',
	'MAX_SIG_URLS_EXPLAIN'			=> 'Número máximo de URLs en una firma. Ajuste este valor a 0 para enlaces ilimitados.',
));

// Registration Settings
$lang = array_merge($lang, array(
	'ACP_REGISTER_SETTINGS_EXPLAIN'	=> 'Aquí puede definir parámetros relativos al formulario de registro y el perfil',

	'ACC_ACTIVATION'				=> 'Activación de cuenta',
	'ACC_ACTIVATION_EXPLAIN'		=> 'Esto determina si los usuarios tienen acceso inmediato al Sitio o bien si se requiere confirmación. También puede deshabilitar por completo nuevos registros. <em>“Email del Foro” debe estar habilitado para poder utilizar la activación de usuario o Administrador.</em>',
	'ACC_ACTIVATION_WARNING'		=> 'Tenga en cuenta que el método de activación seleccionado actualmente requiere correos electrónicos para ser habilitados, se desactivará el registro de otra manera. Se recomienda seleccionar un método de activación diferente, o volver a activar los mensajes de correo electrónico.',
	'NEW_MEMBER_POST_LIMIT'			=> 'Límite de mensajes para nuevos usuarios',
	'NEW_MEMBER_POST_LIMIT_EXPLAIN'	=> 'Los nuevos miembros se encuentran dentro del grupo <em>Nuevos Usuarios Registrados</em> hasta que alcancen este número de mensajes. Puede usar este grupo para evitar el sistema de mensaje privados (MP) o revisar sus mensajes. <strong>Un valor de 0 deshabilita esta opción.</strong>',
	'NEW_MEMBER_GROUP_DEFAULT'		=> 'Asignar el grupo Nuevos Usuarios Registrados como grupo por defecto',
	'NEW_MEMBER_GROUP_DEFAULT_EXPLAIN'	=> 'Si está definido como SÍ, y se especifica un límite de mensajes para nuevos miembros, entonces los nuevos usuarios registrados no solo serán integrados en el grupo de <em>Nuevos Usuarios Registrados</em>, sino que ese será su grupo por defecto. Esto puede ser de utilidad si quiere asignar un rango/avatar de grupo por defecto que el usuario heredará.',

	'ACC_ADMIN'					=> 'Por el Administrador',
	'ACC_DISABLE'				=> 'Deshabilitar registro',
	'ACC_NONE'					=> 'Sin activación (acceso inmediato)',
	'ACC_USER'					=> 'Por el usuario (verificación por e-mail)',
//	'ACC_USER_ADMIN'			=> 'Usuario + Admin',
	'ALLOW_EMAIL_REUSE'			=> 'Permitir reutilización de email',
	'ALLOW_EMAIL_REUSE_EXPLAIN'	=> 'Diferentes usuarios pueden registrarse con la misma dirección de email.',
	'COPPA'						=> 'APPCO Acta de Protección y Privacidad de Menores Online',
	'COPPA_FAX'					=> 'Fax de APPCO',
	'COPPA_MAIL'				=> 'Email de APPCO',
	'COPPA_MAIL_EXPLAIN'		=> 'Esta es la dirección de email donde los padres deben enviar formularios de registro APPCO',
	'ENABLE_COPPA'				=> 'Habilitar APPCO',
	'ENABLE_COPPA_EXPLAIN'		=> 'Esto requiere que los usuarios declaren ser mayores de 13 años para aceptar las disposiciones APPCO. Si la deshabilita, los grupos específicos de APPCO no se mostrarán.',
	'MAX_CHARS'					=> 'Máx.',
	'MIN_CHARS'					=> 'Min.',
	'NO_AUTH_PLUGIN'			=> 'No se encontró una autentificación satisfactoria del plugin.',
	'PASSWORD_LENGTH'			=> 'Longitud de la contraseña',
	'PASSWORD_LENGTH_EXPLAIN'	=> 'Número de caracteres mínimo y máximo en las contraseñas.',
	'REG_LIMIT'			=> 'Intentos de registro',
	'REG_LIMIT_EXPLAIN'		=> 'Número de intentos que los usuarios pueden hacer para resolver el código de confirmación anti-bot antes de que se les bloquee la sesión.',
	'USERNAME_ALPHA_ONLY'		=> 'Solo alfanúmerico',
	'USERNAME_ALPHA_SPACERS'	=> 'Alfanumérico y espaciadores',
	'USERNAME_ASCII'		=> 'ASCII (sin unicode internacional)',
	'USERNAME_LETTER_NUM'		=> 'Cualquier letra y número',
	'USERNAME_LETTER_NUM_SPACERS'	=> 'Cualquier letra, número y espaciadores',
	'USERNAME_CHARS'		=> 'Caracteres en nombre de usuario',
	'USERNAME_CHARS_ANY'		=> 'Cualquier caracter',
	'USERNAME_CHARS_EXPLAIN'	=> 'Restringe el tipo de caracteres que pueden ser usados en nombres de usuario, espaciadores son; espacio, -, +, _, [ y ]',
	'USERNAME_LENGTH'		=> 'Longitud de nombre de usuario',
	'USERNAME_LENGTH_EXPLAIN'	=> 'Número de caracteres mínimo y máximo en nombres de usuario.',
));

// Feeds
$lang = array_merge($lang, array(
	'ACP_FEED_MANAGEMENT'		=> 'Configuración de General Syndication Feeds',
	'ACP_FEED_MANAGEMENT_EXPLAIN'	=> 'Este Módulo hace que varios ATOM Feeds estén disponibles, parsing cualquier BBCode en mensajes para que sean legibles en cualquier Feed externo.',

	'ACP_FEED_GENERAL'		=> 'Configuración General de Feeds',
	'ACP_FEED_POST_BASED'		=> 'Configuración de feed basados en mensajes',
	'ACP_FEED_TOPIC_BASED'		=> 'Configuración de feed basados en temas',
	'ACP_FEED_SETTINGS_OTHER'	=> 'Otros feeds y configuraciones',

	'ACP_FEED_ENABLE'		=> 'Habilitar los Feeds',
	'ACP_FEED_ENABLE_EXPLAIN'	=> 'Activa o desactiva los ATOM Feeds para todo el foro.<br />Deshabilitar esto desactiva todos los Feeds, sin importar cómo están configuradas las opciones de abajo.',
	'ACP_FEED_LIMIT'		=> 'Número de ítems',
	'ACP_FEED_LIMIT_EXPLAIN'	=> 'El número máximo de ítems de Feeds a mostrar.',

	'ACP_FEED_OVERALL'		=> 'Habilitar feed para todo el Sitio',
	'ACP_FEED_OVERALL_EXPLAIN'	=> 'Nuevos mensajes en todo el Sitio.',
	'ACP_FEED_FORUM'		=> 'Habilitar Feeds Por-Foro',
	'ACP_FEED_FORUM_EXPLAIN'	=> 'Nuevos mensajes en un único foro y sus subforos.',
	'ACP_FEED_TOPIC'		=> 'Habilitar Feeds Por-Tema',
	'ACP_FEED_TOPIC_EXPLAIN'	=> 'Nuevos mensajes en un único tema.',

	'ACP_FEED_TOPICS_NEW'		=> 'Habilitar feed de Nuevos Temas',
	'ACP_FEED_TOPICS_NEW_EXPLAIN'	=> 'Habilita feed de “Nuevos Temas”, el cual muestra los últimos temas creados, incluyendo el primer mensaje.',
	'ACP_FEED_TOPICS_ACTIVE'	=> 'Habilitar feed de Temas Activos',
	'ACP_FEED_TOPICS_ACTIVE_EXPLAIN' => 'Habilita feed de “Temas Activos”, el cual muestra los últimos temas activos, incluyendo el último mensaje.',
	'ACP_FEED_NEWS'						=> 'Feeds de noticias',
	'ACP_FEED_NEWS_EXPLAIN'		=> 'Publica el primer mensaje de estos foros. No seleccione foros para deshabilitar los Feeds de Noticias.<br />Seleccione multiples foros manteniendo pulsada la tecla <samp>CTRL</samp> y haciendo clic en los foros deseados.',

	'ACP_FEED_OVERALL_FORUMS'	=> 'Habilitar feed de foros',
	'ACP_FEED_OVERALL_FORUMS_EXPLAIN' => 'Habilita feed de “Todos los Foros”, el cual muestra una lista de foros.',

	'ACP_FEED_HTTP_AUTH'		=> 'Permitir Autenticación HTTP',
	'ACP_FEED_HTTP_AUTH_EXPLAIN'	=> 'Habilita Autenticación HTTP, la cual permite a los usuarios recibir contenido que esté oculto a usuarios invitados, al añadir el parámetro <samp>auth=http</samp> a la URL del feed. Por favor tenga en cuenta que algunas configuraciones de PHP requieren cambios adicionales en el archivo .htaccess . En ese archivo se pueden encontrar instrucciones para saber cómo hacerlo.',
	'ACP_FEED_ITEM_STATISTICS'	=> 'Estadísticas de ítem',
	'ACP_FEED_ITEM_STATISTICS_EXPLAIN' => 'Muestra estadísticas individuales debajo de los ítems de Feed<br />(Por ejemplo: Enviado por, fecha y hora, Respuestas, Vistas)',
	'ACP_FEED_EXCLUDE_ID'		=> 'Excluir estos foros',
	'ACP_FEED_EXCLUDE_ID_EXPLAIN'	=> 'El contenido de estos <strong>no serán incluidos en los Feeds</strong>. No seleccione ningún foro para publicar datos de todos los foros.<br />Seleccione/Deseleccione multiples foros manteniendo pulsada la tecla <samp>CTRL</samp> y haciendo clic en los foros deseados.',
));

// Visual Confirmation Settings
$lang = array_merge($lang, array(
	'ACP_VC_SETTINGS_EXPLAIN'	=> 'Aquí puede seleccionar y configurar los plugins designados para bloquear envíos de formulario por parte de robots de spam. Estos plugins suelen funcionar desafiando al usuario con un <em>CAPTCHA</em>, una prueba diseñada para que sea difícil de resolver por computadoras.',
	'ACP_VC_EXT_GET_MORE'		=> 'Para plugins adicionales (y puede que mejores), visite la <a href="https://www.phpbb.com/go/anti-spam-ext"><strong>base de datos de Extensiones de phpBB</strong></a>. Para más información sobre prevención de Spam en su foro, visite la <a href="https://www.phpbb.com/go/anti-spam"><strong>Knowledge Base de phpBB</strong></a>.',
	'AVAILABLE_CAPTCHAS'		=> 'Plugins disponibles',
	'CAPTCHA_UNAVAILABLE'		=> 'El plugin no puede ser seleccionado ya que no se han encontrado sus requisitos básicos.',
	'CAPTCHA_GD'			=> 'Imagen GD',
	'CAPTCHA_GD_3D'			=> 'Imagen GD 3D',
	'CAPTCHA_GD_FOREGROUND_NOISE'	=> 'Ruido de fondo',
	'CAPTCHA_GD_EXPLAIN'		=> 'Emplea la librería visual GD para hacer una imagen anti-spambot más avanzada',
	'CAPTCHA_GD_FOREGROUND_NOISE_EXPLAIN'	=> 'Usar ruido de fondo para hacer la imagen más difícil de leer.',
	'CAPTCHA_GD_X_GRID'		=> 'Ruido de fondo eje-x',
	'CAPTCHA_GD_X_GRID_EXPLAIN'	=> 'Usa valores bajos para aumentar la dificultad. 0 deshabilita ruido de fondo eje-x.',
	'CAPTCHA_GD_Y_GRID'		=> 'Ruido de fondo eje-y',
	'CAPTCHA_GD_Y_GRID_EXPLAIN'	=> 'Usa valores bajos para aumentar la dificultad. 0 deshabilita ruido de fondo eje-y.',
	'CAPTCHA_GD_WAVE'              	=> 'Distorsión de onda',
	'CAPTCHA_GD_WAVE_EXPLAIN'        	=> 'Esto aplica una distorsión de onda a la imagen.',
	'CAPTCHA_GD_3D_NOISE'            	=> 'Añade objetos de ruido-3D',
	'CAPTCHA_GD_3D_NOISE_EXPLAIN'    	=> 'Esto añade objetos adicionales a la imagen, por encima de las letras.',
	'CAPTCHA_GD_FONTS'                  => 'Usar fuentes diferentes',
	'CAPTCHA_GD_FONTS_EXPLAIN'          => 'Esta opción controla cuántas formas diferentes de letra se usarán. Puede simplemente usar las formas por defecto o introducir letras modificadas. Añadir letras minúsculas también es posible.',
	'CAPTCHA_FONT_DEFAULT'              => 'Por defecto',
	'CAPTCHA_FONT_NEW'                  => 'Nuevas Formas',
	'CAPTCHA_FONT_LOWER'               	=> 'Usar también minúsculas',
	'CAPTCHA_NO_GD'			=> 'Imagen simple',
	'CAPTCHA_PREVIEW_MSG'		=> 'Los cambios no fueron guardados. Esto es solo una vista previa.',
	'CAPTCHA_PREVIEW_EXPLAIN'	=> 'El plugin se verá así usando los parámetros actuales. Use el botón de vista previa para actualizar. Observe que los plugins son aleatorios y difieren de una vista a otra.',

	'CAPTCHA_SELECT'		=> 'Plugins instalados',
	'CAPTCHA_SELECT_EXPLAIN'	=> 'El desplegable contiene los plugins reconocidos por este foro. Las entradas grises no están disponibles ahora mismo y pueden necesitar una configuración previa a su uso.',
	'CAPTCHA_CONFIGURE'		=> 'Configurar plugins',
	'CAPTCHA_CONFIGURE_EXPLAIN'	=> 'Cambiar los parámetros para el plugin seleccionado.',
	'CONFIGURE'			=> 'Configurar',
	'CAPTCHA_NO_OPTIONS'		=> 'Este plugin no tiene parámetros de configuración.',

	'VISUAL_CONFIRM_POST'		=> 'Habilitar medidas contra spambots para mensajes de invitados',
	'VISUAL_CONFIRM_POST_EXPLAIN'	=> 'Requiere que los usuarios anónimos pasen una prueba anti-spambot para evitar publicaciones automáticas (spam).',
	'VISUAL_CONFIRM_REG'		=> 'Habilitar medidas contra spambots para registros',
	'VISUAL_CONFIRM_REG_EXPLAIN'	=> 'Requiere que los nuevos usuarios pasen una prueba anti-spambot para evitar registros automatizados.',
	'VISUAL_CONFIRM_REFRESH'          	=> 'Permitir a los usuarios refrescar la prueba anti-spambot',
	'VISUAL_CONFIRM_REFRESH_EXPLAIN'    => 'Permitir a los usuarios pedir nueva prueba anti-spambot, si no pueden resolver la prueba actual durante el registro.',
));

// Cookie Settings
$lang = array_merge($lang, array(
	'ACP_COOKIE_SETTINGS_EXPLAIN'	=> 'Estos detalles determinan los datos usados para enviar cookies a los navegadores de los usuarios. En la mayoría de los casos los valores por defecto para los configuración de las cookies deberían ser suficiente. Si necesita cambiar algo, hágalo con cuidado, parámetros incorrectos impedirían que los usuarios puedan identificarse. Si tiene problemas para que los usuarios mantengan la sesión correctamente en su foro, visite la página (en Inglés) <strong><a href="https://www.phpbb.com/support/go/cookie-settings">phpBB.com Knowledge Base - Fixing incorrect cookie settings</a></strong>.',

	'COOKIE_DOMAIN'				=> 'Dominio de la cookie',
	'COOKIE_DOMAIN_EXPLAIN'		=> 'En la mayoría de los casos, el dominio de cookies es opcional. Puede dejarlo en blanco si no está seguro.<br><br> En el caso de tener un foro integrado con otro software, o tiene varios dominios, entonces para determinar el dominio de la cookie que necesita, debe hacer lo siguiente. Si tiene algo como <i>example.com</i> y <i>forums.example.com</i>, o quizás <i>forums.example.com</i> y <i>blog.example.com</i>. Elimine los subdominios hasta encontrar el dominio común, <i>example.com</i>. Ahora agregue un punto delante del dominio común e introduzca .example.com (note el punto al principio).',
	'COOKIE_NAME'				=> 'Nombre de la cookie',
	'COOKIE_NAME_EXPLAIN'		=> 'Esto puede ser cualquier cosa que quiera, que sea original. Siempre que se cambie la configuración de la cookie, se debe cambiar el nombre de la cookie.',
	'COOKIE_NOTICE'				=> 'Aviso de Cookie',
	'COOKIE_NOTICE_EXPLAIN'		=> 'Si está activado, se mostrará un aviso de cookie a los usuarios cuando visiten tu foro. Esto puede ser requerido por ley dependiendo del contenido de tu foro y de las extensiones habilitadas.',
	'COOKIE_PATH'				=> 'Ruta de la cookie',
	'COOKIE_PATH_EXPLAIN'		=> 'Esto generalmente será igual a la ruta de su script, o simplemente una barra para hacer que la cookie sea accesible en todo el dominio del sitio.',
	'COOKIE_SECURE'				=> 'Cookie segura',
	'COOKIE_SECURE_EXPLAIN'		=> 'Si su servidor emplea SSL, habilite esta opción, si no, déjelo deshabilitado. Habilitar esto sin usar SSL provocará errores en el servidor.',
	'ONLINE_LENGTH'				=> 'Lapso de tiempo para verse con estado identificado',
	'ONLINE_LENGTH_EXPLAIN'		=> 'Número de minutos después de los cuales los usuarios inactivos no aparecerán en la lista "Quién está conectado". Un valor mayor requiere más procesamiento para generar la lista.',
	'SESSION_LENGTH'			=> 'Duración de la sesión',
	'SESSION_LENGTH_EXPLAIN'	=> 'Las sesiones expiran transcurrido este tiempo, en segundos.',
));

// Contact Settings
$lang = array_merge($lang, array(
 	'ACP_CONTACT_SETTINGS_EXPLAIN'		=> 'Aquí puede habilitar y deshabilitar la página de contacto y también añadir un texto que será mostrado en la página.',
 
 	'CONTACT_US_ENABLE'				=> 'Habilitar página de contacto',
 	'CONTACT_US_ENABLE_EXPLAIN'		=> 'Está página permite a los usuarios enviar emails a los Administradores del foro. Ten en cuenta que la opción de correos electrónicos en todo el foro debe estar habilitada también. Puedes encontrar esta opción en General &gt; Comunicación Cliente &gt; Configuración de email.',
 
 	'CONTACT_US_INFO'				=> 'Información de contacto',
 	'CONTACT_US_INFO_EXPLAIN'		=> 'El mensaje se muestra en la página de contacto',
 	'CONTACT_US_INFO_PREVIEW'		=> 'Información de página de contacto - Vista previa',
 	'CONTACT_US_INFO_UPDATED'		=> 'La información de la página de contacto ha sido actualizada.',
));

// Load Settings
$lang = array_merge($lang, array(
	'ACP_LOAD_SETTINGS_EXPLAIN'	=> 'Aquí puede habilitar y deshabilitar ciertas funciones del Sitio para reducir la cantidad de procesamiento requerido. En la mayoría de los servidores no hay necesidad de deshabilitar ninguna función. Sin embargo en ciertos sistemas o entornos compartidos puede ser beneficioso deshabilitar capacidades que no necesite realmente. También puede especificar límites para la carga de sistema y sesiones activas, superadas las cuales el Sitio se pondrá fuera de línea.',

	'ALLOW_CDN'						=> 'Permitir el uso de las redes de distribución de contenidos de terceros',
	'ALLOW_CDN_EXPLAIN'				=> 'Si esta opción está activada, algunos archivos se sirven desde los servidores de terceros externos en lugar de su servidor. Esto reduce el ancho de banda requerido por el servidor, pero puede presentar un problema de privacidad para algunos Administradores del foro. En una instalación por defecto de phpBB, incluye la carga de “jQuery” y la fuente “Open Sans” desde la red de contenido de Google.',
	'ALLOW_LIVE_SEARCHES'			=> 'Permitir búsquedas en vivo',
	'ALLOW_LIVE_SEARCHES_EXPLAIN'	=> 'Si se habilita esta opción, los usuarios disponen de sugerencias de palabras clave del tipo en ciertos campos del foro.',
    	'CUSTOM_PROFILE_FIELDS'			=> 'Campos de perfil personalizados',
	'LIMIT_LOAD'					=> 'Límite de carga de sistema',
	'LIMIT_LOAD_EXPLAIN'			=> 'Si el promedio de carga del sistema por minuto excede este valor, el Sitio automáticamente se pondrá fuera de línea. Un valor de 1.0 equivale ~100% de utilización de un procesador. Esto solo funciona en servidores UNIX.',
	'LIMIT_SESSIONS'				=> 'Límite de sesiones',
	'LIMIT_SESSIONS_EXPLAIN'		=> 'Si el número de sesiones excede este valor en el periodo de un minuto, el Sitio automáticamente se pondrá fuera de línea. Ponga este valor en 0 para sesiones ilimitadas.',
	'LOAD_CPF_MEMBERLIST'			=> 'Permitir estilos para mostrar campos de perfil personalizados en la lista de usuarios',
	'LOAD_CPF_PM'					=> 'Mostrar campos de perfil personalizados en mensajes privados',
	'LOAD_CPF_VIEWPROFILE'			=> 'Mostrar campos de perfil personalizados en perfiles de usuario',
	'LOAD_CPF_VIEWTOPIC'			=> 'Mostrar campos de perfil personalizados al ver temas',
	'LOAD_USER_ACTIVITY'			=> 'Mostrar actividad del usuario',
	'LOAD_USER_ACTIVITY_EXPLAIN'	=> 'Mostrar actividad en temas/foros en perfil de usuario y panel de control de usuario. Se recomienda deshabilitar esto en sitios con más de un millón de mensajes.',
	'LOAD_USER_ACTIVITY_LIMIT'		=> 'Límite de mensajes de actividad del usuario',
	'LOAD_USER_ACTIVITY_LIMIT_EXPLAIN'	=> 'El tema/foro activo no se mostrará para los usuarios que tengan más de este número de mensajes. Establezca en 0 para desactivar el límite.',
	'READ_NOTIFICATION_EXPIRE_DAYS'	=> 'Expiración de notificaciones de lectura',
	'READ_NOTIFICATION_EXPIRE_DAYS_EXPLAIN' => 'Número de días que transcurrirán antes de eliminar automáticamente las notificaciones de lectura. Establezca este valor en 0 para hacer notificaciones permanentes.',
	'RECOMPILE_STYLES'				=> 'Recompilar plantillas antiguas',
	'RECOMPILE_STYLES_EXPLAIN'		=> 'Busca plantillas actualizadas y las reconstruye.',
	'YES_ACCURATE_PM_BUTTON'			=> 'Habilitar el permiso específico del botón de MP en las páginas de temas',
	'YES_ACCURATE_PM_BUTTON_EXPLAIN'	=> 'Si esta configuración está habilitada, solo los perfiles de publicación de los usuarios que tienen permiso para leer mensajes privados tendrán un botón de mensaje privado.',
	'YES_ANON_READ_MARKING'			=> 'Habilitar marcado de temas para invitados',
	'YES_ANON_READ_MARKING_EXPLAIN'	=> 'Guarda información de leído/no leído para invitados. Si se deshabilita los mensajes siempre se marcan como leídos a los invitados.',
	'YES_ACCURATE_PM_BUTTON'			=> 'Habilitar el indicador MP en las páginas de temas',
	'YES_ACCURATE_PM_BUTTON_EXPLAIN'	=> 'Si este ajuste está habilitada, solo los usuarios que tienen permiso para leer mensajes privados tendrán un botón de mensaje privado.',
	'YES_BIRTHDAYS'					=> 'Habilitar lista de cumpleaños',
	'YES_BIRTHDAYS_EXPLAIN'			=> 'Si está deshabilitada, la lista de cumpleaños no se visualizará. Para que esta preferencia tenga efecto, la preferencia de cumpleaños deber estar también habilitada.',
	'YES_JUMPBOX'					=> 'Habilite mostrar \'Saltar a\'',
	'YES_MODERATORS'				=> 'Habilite mostrar moderadores',
	'YES_ONLINE'					=> 'Habilite listado de usuarios identificados',
	'YES_ONLINE_EXPLAIN'			=> 'Muestra una lista de usuarios identificados en inicio, foros y tema.',
	'YES_ONLINE_GUESTS'				=> 'Habilite listado de invitados identificados en Ver Conectados',
	'YES_ONLINE_GUESTS_EXPLAIN'		=> 'Permite mostrar usuarios invitados en Ver Conectados.',
	'YES_ONLINE_TRACK'				=> 'Habilite mostrar información de usuarios identificados/desconectados',
	'YES_ONLINE_TRACK_EXPLAIN'		=> 'Muestra información de usuario identificado en perfiles y ver tema.',
	'YES_POST_MARKING'				=> 'Habilitar marcado de temas',
	'YES_POST_MARKING_EXPLAIN'		=> 'Indica si un usuario ha publicado en un tema.',
	'YES_READ_MARKING'				=> 'Habilitar marcado de temas en el servidor',
	'YES_READ_MARKING_EXPLAIN'		=> 'Guarda información de leído/no leído en la base de datos en vez de en una cookie.',
	'YES_UNREAD_SEARCH'            	=> 'Habilita la búsqueda de mensajes no leídos',
));

// Auth settings
$lang = array_merge($lang, array(
	'ACP_AUTH_SETTINGS_EXPLAIN'	=> 'phpBB soporta plugins de autentificación o módulos. Esto le permite determinar cómo se identifica a los usuarios cuando se conectan al Sitio. Por defecto se proveen tres plugins; DB, LDAP, Apache y OAuth. No todos los métodos requieren información adicional, así que rellene solo los campos que sean relevantes para el método elegido.',

	'AUTH_METHOD'				=> 'Seleccione un método de autentificación',

	'AUTH_PROVIDER_OAUTH_ERROR_ELEMENT_MISSING'	=> 'Debe proporcionar la clave y secreto de cada proveedor de servicios habilitado OAuth. Sólo uno fue proporcionado por un proveedor de servicios de OAuth.',
	'AUTH_PROVIDER_OAUTH_EXPLAIN'				=> 'Cada proveedor OAuth requiere un secreto y la clave única para identificarse con el servidor externo. Estos deben ser suministrados por el servicio OAuth al registrar tu sitio web, y deben introducirse exactamente como te lo proporcionarón.<br>Cualquier servicio que no tu clave y tu secreto introducido aquí, no estará disponible para los usuarios del foro. También ten en cuenta, que el usuario aún puede registrarse e identificarse utilizando la autenticación del plug-in de base de datos.',
	'AUTH_PROVIDER_OAUTH_KEY'					=> 'Clave',
	'AUTH_PROVIDER_OAUTH_TITLE'					=> 'OAuth',
	'AUTH_PROVIDER_OAUTH_SECRET'				=> 'Secreto',

	'APACHE_SETUP_BEFORE_USE'	=> 'Tiene que configurar la autentificación de Apache antes de cambiar a este método. Tenga en cuenta que el nombre de usuario que emplea para autentificación de Apache tiene que ser el mismo que usa en phpBB.',

    	'LDAP'							=> 'LDAP',
	'LDAP_DN'						=> 'LDAP base <var>dn</var>',
	'LDAP_DN_EXPLAIN'				=> 'Éste es el Distinguished Name, que se usa para la localización de usuario, ej. <samp>o=My Company,c=US</samp>',
	'LDAP_EMAIL'					=> 'LDAP atributo email',
	'LDAP_EMAIL_EXPLAIN'			=> 'Configure esto con el nombre del atributo de usuario de email entrante (si existe) para configurar automáticamente la dirección de email para nuevos usuarios. Dejar esto vacío provoca una dirección de email vacía para usuarios que ingresan por primera vez.',
	'LDAP_INCORRECT_USER_PASSWORD'	=> 'La conexión con el servidor LDAP ha fallado con el usuario/contraseña especificado(s).',
	'LDAP_NO_EMAIL'					=> 'El atributo de email especificado no existe.',
	'LDAP_NO_IDENTITY'				=> 'No se puede encontrar una identidad para %s',
	'LDAP_PASSWORD'					=> 'Contraseña LDAP',
	'LDAP_PASSWORD_EXPLAIN'			=> 'Deje en blanco para acceso anónimo. De lo contrario, complételo con la contraseña de usuario. Obligatorio para servidores de Directorio Activo.<br><em><strong>ADVERTENCIA:</strong> Esta contraseña será guardada como texto plano en la base de datos y será visible para cualquiera que tenga acceso a la misma o que pueda ver esta página de configuración.</em>',
	'LDAP_PORT'						=> 'Puerto de servidor LDAP',
	'LDAP_PORT_EXPLAIN'				=> 'Opcionalmente puede especificar un puerto que se usaría para conectar al servidor LDAP en vez del puerto por defecto 389.',
	'LDAP_SERVER'					=> 'Nombre de servidor LDAP',
	'LDAP_SERVER_EXPLAIN'			=> 'Si usa LDAP, éste es el nombre o dirección IP del servidor.',
	'LDAP_UID'						=> '<var>uid</var> LDAP ',
	'LDAP_UID_EXPLAIN'				=> 'Esta es la contraseña bajo la cual se busca una identidad, ej. <var>uid</var>, <var>sn</var>, etc.',
	'LDAP_USER'						=> 'Usuario LDAP',
	'LDAP_USER_EXPLAIN'				=> 'Deje en blanco para acceso anónimo. Si lo completa, phpBB conectará con el servidor LDAP como el usuario especificado.',
	'LDAP_USER_FILTER'				=> 'Filtro de usuario LDAP',
	'LDAP_USER_FILTER_EXPLAIN'		=> 'Opcionalmente puede limitar más los objetos buscados con filtros adicionales. Por ejemplo <samp>objectClass=posixGroup</samp> resultaría en el uso de <samp>(&amp;(uid=$username)(objectClass=posixGroup))</samp>',
));

// Server Settings
$lang = array_merge($lang, array(
	'ACP_SERVER_SETTINGS_EXPLAIN'	=> 'Aquí puede definir parámetros relativos a dominio y servidor. Por favor verifique que los datos que introduzca sean exactos, los errores provocarían emails con información incorrecta. Cuando configure el dominio, recuerde poner http:// u otro protocolo. Solo cambie el número de puerto si sabe que su servidor emplea uno diferente, el puerto 80 está bien para la mayoría de los casos.',

	'ENABLE_GZIP'			=> 'Habilitar compresión Gzip',
	'ENABLE_GZIP_EXPLAIN'		=> 'El contenido generado será comprimido antes de enviarse al usuario. Esto puede reducir el tráfico de red, pero incrementa el uso de CPU tanto en el servidor como del lado del usuario. Requiere la extensión zlib de PHP para ser cargado.',
	'FORCE_SERVER_VARS'		=> 'Forzar parámetro URL',
	'FORCE_SERVER_VARS_EXPLAIN'	=> 'Si configura SÍ el parámetro definido aquí, será empleado en lugar del valor predeterminado automáticamente',
	'ICONS_PATH'			=> 'Ruta de guardado de iconos de mensaje',
	'ICONS_PATH_EXPLAIN'		=> 'Ruta en su directorio raíz, ej. <samp>images/icons</samp>',
	'MOD_REWRITE_ENABLE'		=> 'Habilitar reescritura de URL',
	'MOD_REWRITE_ENABLE_EXPLAIN' => 'Si está activado, las URLs que contienen ’app.php’ serán reescritas para quitar el nombre de archivo (ej. app.php/foo se convertirá en /foo). <strong>Se requiere el módulo mod_rewrite en su servidor Apache para que esta funcionalidad pueda trabajar, si esta opción está activada sin el módulo mod_rewrite, las URLs de su foro se podrían romper.</strong>',
	'MOD_REWRITE_DISABLED'		=> 'El módulo <strong>mod_rewrite</strong> en su servidor Apache está desactivado. Active el módulo o contacte con su proveedor de hosting si desea activar esta función.',
	'MOD_REWRITE_INFORMATION_UNAVAILABLE' => 'No podemos determinar si el servidor soporta la reescritura de URL. Este ajuste se puede activar, pero si la reescritura de URL no está disponible, las rutas generadas para este foro (como para su uso en los enlaces) se podrían romper. Póngase en contacto con su proveedor de alojamiento web, si usted no está seguro de si se puede o no habilitar de forma segura esta característica.',
	'PATH_SETTINGS'			=> 'Configuración de ruta',
	'RANKS_PATH'			=> 'Ruta de guardado de imágenes de rango',
	'RANKS_PATH_EXPLAIN'		=> 'Ruta en su directorio raíz, ej. <samp>images/ranks</samp>',
	'SCRIPT_PATH'			=> 'Ruta de phpBB',
	'SCRIPT_PATH_EXPLAIN'		=> 'Ruta donde está ubicado phpBB relativa al nombre de dominio, ej. <samp>/phpBB3</samp>',
	'SERVER_NAME'			=> 'Nombre de dominio',
	'SERVER_NAME_EXPLAIN'		=> 'El nombre del dominio de este Sitio (por ejemplo: <samp>www.foo.bar</samp>)',
	'SERVER_PORT'			=> 'Puerto del servidor',
	'SERVER_PORT_EXPLAIN'		=> 'El puerto que utiliza su servidor, normalmente 80, cámbielo solo si es diferente',
	'SERVER_PROTOCOL'		=> 'Protocolo del servidor',
	'SERVER_PROTOCOL_EXPLAIN'	=> 'Se usa como protocolo del servidor si se fuerzan los parámetros. Caso contrario el protocolo es determinado por los configuración de cookie (<samp>http://</samp> o <samp>https://</samp>)',
	'SERVER_URL_SETTINGS'		=> 'Configuración de URL',
	'SMILIES_PATH'			=> 'Ruta de guardado de emoticonos',
	'SMILIES_PATH_EXPLAIN'		=> 'Ruta en su directorio raíz, ej. <samp>images/smilies</samp>',
	'UPLOAD_ICONS_PATH'		=> 'Ruta de guardado de iconos de extensiones',
	'UPLOAD_ICONS_PATH_EXPLAIN'	=> 'Ruta en su directorio raíz, ej. <samp>images/upload_icons</samp>',
	'USE_SYSTEM_CRON'		=> 'Ejecutar tareas periódicas del sistema cron',
	'USE_SYSTEM_CRON_EXPLAIN'		=> 'Si está apagado, phpBB se encargará de las tareas periódicas para que se ejecuten automáticamente. Si está activado, phpBB no se encargará de las tareas periódicas de por sí, un Administrador del sistema debe disponer de <code>bin/phpbbcli.php cron:run</code> para ejecutar el cron del sistema a intervalos regulares (ej. cada 5 minutos).',
));

// Security Settings
$lang = array_merge($lang, array(
	'ACP_SECURITY_SETTINGS_EXPLAIN'	=> 'Aquí puede definir parámetros relativos a conexión y sesiones',

	'ALL'							=> 'Todo',
	'ALLOW_AUTOLOGIN'				=> 'Permitir "Recordar" en inicios de sesión',
	'ALLOW_AUTOLOGIN_EXPLAIN'		=> 'Determina si los usuarios se les da la opción "Recordar" cuando visitan el foro.',
	'ALLOW_PASSWORD_RESET'			=> 'Permitir reinicio de contraseña ("Olvidé mi contraseña")',
	'ALLOW_PASSWORD_RESET_EXPLAIN'	=> 'Determina si el usuario puede usar el enlace "Olvidé mi contraseña" de la página de inicio de sesión`para recordar su cuenta. Si utiliza un mecanismo de autenticación externo es posible que desee desactivar esta función.',
	'AUTOLOGIN_LENGTH'				=> '"Recordar" Expiración de la clave de sesión (en días)',
	'AUTOLOGIN_LENGTH_EXPLAIN'		=> 'Número de días después de los cuales se elimina "Recordar" del inicio de sesión, o cero para deshabilitar.',
	'BROWSER_VALID'					=> 'Validar navegador',
	'BROWSER_VALID_EXPLAIN'			=> 'Habilite la validación de navegador para cada sesión mejorando la seguridad.',
	'CHECK_DNSBL'					=> 'Verificar IP en las listas negras de DNS',
	'CHECK_DNSBL_EXPLAIN'			=> 'Si está habilitado, la direccion IP de los usuarios es verificada en los siguiente servicios DNSBL (para registro y envío de mensaje): <a href="http://spamcop.net">spamcop.net</a> y <a href="http://www.spamhaus.org">www.spamhaus.org</a>. Esta búsqueda puede llevar un tiempo, dependiendo de la configuración del servidor. Si se ralentiza demasiado o se reciben muchos falsos positivos se recomienda deshabilitar esta opción.',
	'CLASS_B'						=> 'A.B',
	'CLASS_C'						=> 'A.B.C',
	'EMAIL_CHECK_MX'				=> 'Verifica que el dominio del email tenga un registro MX válido',
	'EMAIL_CHECK_MX_EXPLAIN'		=> 'Si está habilitado, se verificará que el dominio del email provisto en la registro y perfil tengan un registro MX válido.',
	'FORCE_PASS_CHANGE'				=> 'Forzar cambio de contraseña',
	'FORCE_PASS_CHANGE_EXPLAIN'		=> 'Requiere que un usuario cambie su contraseña después de un número específico de días. Ajuste este valor a 0 para deshabilitar esta opción.',
	'FORM_TIME_MAX'					=> 'Tiempo máximo para enviar formularios',
	'FORM_TIME_MAX_EXPLAIN'			=> 'El tiempo que un usuario tiene para enviar un formulario. Use -1 para desactivarlo. Note que un formulario puede volverse no válido si la sesión expira, independientemente de esta configuración.',
	'FORM_SID_GUESTS'				=> 'Relaciona formularios a sesiones de invitado',
	'FORM_SID_GUESTS_EXPLAIN'		=> 'Si está habilitado el vínculo del formulario relacionado con los invitados serán exclusivos de su sesión. Esto puede causar problemas con algunos ISPs.',
	'FORWARDED_FOR_VALID'			=> 'Validar encabezado <var>X_FORWARDED_FOR</var>',
	'FORWARDED_FOR_VALID_EXPLAIN'	=> 'Las sesiones continuarán si el encabezado <var>X_FORWARDED_FOR</var> enviado coincide con el previo. También se verificarán las exclusiones con la IP enviada en <var>X_FORWARDED_FOR</var>.',
	'IP_VALID'						=> 'Validación de sesión por IP',
	'IP_VALID_EXPLAIN'				=> 'Determina qué porción de la IP del usuario se emplea para validar la sesión; <samp>Todo</samp> Compara la dirección completa, <samp>A.B.C</samp> los primeros x.x.x, <samp>A.B</samp> los primeros x.x, <samp>Ninguna</samp> deshabilita la verificación.',
	'IP_LOGIN_LIMIT_MAX'			=> 'Número máximo de intentos de conexión por dirección IP',
	'IP_LOGIN_LIMIT_MAX_EXPLAIN'    => 'El umbral de intentos de conexión permitidos a partir de una dirección IP antes de que la tarea anti-spambot se active. Introduzca 0 para evitar la tarea anti-spambot, en caso de que surjan las direcciones IP.',
	'IP_LOGIN_LIMIT_TIME'			=> 'Tiempo de expiración de intentos de conexión para dirección IP',
	'IP_LOGIN_LIMIT_TIME_EXPLAIN'   => 'Los intentos de conexión finalizan tras este periodo.',
	'IP_LOGIN_LIMIT_USE_FORWARDED'  => 'Límite de intentos de conexión por encabezado <var>X_FORWARDED_FOR</var>',
	'IP_LOGIN_LIMIT_USE_FORWARDED_EXPLAIN'	=> 'En lugar de limitar los intentos de conexión por dirección IP que están limitados por los valores <var>X_FORWARDED_FOR</var>. <br><em><strong>Aviso:</strong> Sólo activar esta opción si está funcionando en un servidor proxy que establece valores de confianza <var> X_FORWARDED_FOR </var>.</em>',
	'MAX_LOGIN_ATTEMPTS'			=> 'Máximo de intentos de conexión',
	'MAX_LOGIN_ATTEMPTS_EXPLAIN'	=> 'Después de este número de intentos fallidos el usuario tiene que resolver además la prueba anti-spambot',
	'NO_IP_VALIDATION'				=> 'Ninguna',
	'NO_REF_VALIDATION'				=> 'Ninguna',
	'PASSWORD_TYPE'					=> 'Complejidad de la contraseña',
	'PASSWORD_TYPE_EXPLAIN'			=> 'Determina la complejidad necesaria para una contraseña, las opciones siguientes incluyen las precedentes.',
	'PASS_TYPE_ALPHA'				=> 'Debe contener alfanuméricos',
	'PASS_TYPE_ANY'					=> 'Ningún requerimiento',
	'PASS_TYPE_CASE'				=> 'Debe contener mayúsculas y minúsculas',
	'PASS_TYPE_SYMBOL'				=> 'Debe contener símbolos',
	'REF_HOST'						=> 'Solo validar host',
	'REF_PATH'						=> 'También validar ruta (path)',
	'REFERRER_VALID'				=> 'Validar Referido',
	'REFERRER_VALID_EXPLAIN'		=> 'Si está habilitado, el referido de peticiones de POST será comparado con la configuración existente de la ruta del host/script. Esto puede causar contingencias en foros que usen varios dominios y/o identificaciones externas.',
	'TPL_ALLOW_PHP'					=> 'Permitir PHP en plantillas',
	'TPL_ALLOW_PHP_EXPLAIN'			=> 'Si se habilita esta opción, <code>PHP</code> e <code>INCLUDEPHP</code> serán convertidos en las plantillas.',
	'UPLOAD_CERT_VALID'				=> 'Validar el certificado de subida',
	'UPLOAD_CERT_VALID_EXPLAIN'		=> 'Si está habilitado, se validarán los certificados de archivos remotos. Esto requiere que el haz de CA a ser definida en los ajustes de <samp>openssl.cafile</samp> o <samp>curl.cainfo</samp> en tú php.ini.',
));

// Email Settings
$lang = array_merge($lang, array(
	'ACP_EMAIL_SETTINGS_EXPLAIN'	=> 'Esta información se usa cuando el Sitio envía emails a sus usuarios. Por favor verifique que la dirección de email ingresada sea válida, cualquier rebote se reenviará a esa dirección. Si su host no provee un servicio de email nativo (utilizable por PHP), entonces use directamente SMTP. Esto requiere la dirección de un servidor apropiado (pregúntele a su ISP de ser necesario). Si (si, y solo si) el servidor requiere autentificación complete el usuario y contraseña. Por favor observe que solo se ofrece autentificación básica, otro tipo de implementación no es posible actualmente.',

	'ADMIN_EMAIL'					=> 'Dirección de origen de emails',
	'ADMIN_EMAIL_EXPLAIN'			=> 'Se usa como dirección de origen de todos los emails, la dirección del contacto técnico. Siempre se usará como dirección <samp>Sender</samp> en los emails.',
	'BOARD_EMAIL_FORM'				=> 'Usuarios envían email mediante el Sitio',
	'BOARD_EMAIL_FORM_EXPLAIN'		=> 'En lugar de mostrar su dirección de email, los usuarios pueden enviar emails vía el Sitio.',
	'BOARD_HIDE_EMAILS'				=> 'Ocultar direcciones de email',
	'BOARD_HIDE_EMAILS_EXPLAIN'		=> 'Mantiene las direcciones de email completamente privadas.',
	'CONTACT_EMAIL'					=> 'Email de contacto',
	'CONTACT_EMAIL_EXPLAIN'			=> 'Esta dirección se usará cuando se necesite específicamente un contacto, ej. spam, errores, etc. Siempre se usará como <samp>From</samp> y <samp>Reply-To</samp> en los emails.',
	'CONTACT_EMAIL_NAME'			=> 'Nombre de contacto',
	'CONTACT_EMAIL_NAME_EXPLAIN'	=> 'Este es el nombre del contacto que los destinatarios de correo electrónico van a ver. Si no quiere tener un nombre de contacto, deje este campo vacío.',
	'EMAIL_FORCE_SENDER'			=> 'Fuerza desde dirección email',
	'EMAIL_FORCE_SENDER_EXPLAIN'	=> 'Esto establecerá el <samp>Return-Path</samp> a la dirección de correo electrónico en lugar de usar el usuario local y el nombre de host del servidor. Esta configuración no se aplica cuando se usa SMTP.<br><em><strong>Advertencia:</strong> Requiere que el usuario ejecute el servidor web para ser agregado como usuario de confianza a la configuración de sendmail.</em>',
	'EMAIL_PACKAGE_SIZE'			=> 'Tamaño del paquete de email',
	'EMAIL_PACKAGE_SIZE_EXPLAIN'	=> 'Número de emails enviados por paquete. Esta configuración se aplica a la cola interna de espera de mensajes. Establezca este valor a 0 si experimenta problemas con emails de notificación no enviados.',
	'EMAIL_MAX_CHUNK_SIZE'			=> 'Máximo permitidos de destinatarios de correo electrónico',
	'EMAIL_MAX_CHUNK_SIZE_EXPLAIN'	=> 'Si es necesario, configura esto para que no exceda el número máximo de destinatarios que tu servidor de correo electrónico permitirá en un mensaje de correo electrónico.',
	'EMAIL_SIG'						=> 'Firma de email',
	'EMAIL_SIG_EXPLAIN'				=> 'Este texto se anexará a todos los emails que envíe el Sitio.',
	'ENABLE_EMAIL'					=> 'Habilitar envío de emails',
	'ENABLE_EMAIL_EXPLAIN'			=> 'Si se deshabilita, el Sitio no enviará ningún tipo de email. <em>Note que los parámetros de activación de la cuenta del Administrador y del usuario requiren que esta opción esté habilitada. Si la configuración de activación actual es “Usuario” or “Administrador” en los parámetros de activación, la deshabilitación de esta opción deshabilitará el registro.</em>',
	'SEND_TEST_EMAIL'				=> 'Enviar un correo electrónico de prueba',
	'SEND_TEST_EMAIL_EXPLAIN'		=> 'Esto enviará un correo electrónico de prueba a la dirección definida en su cuenta.',
	'SMTP_ALLOW_SELF_SIGNED'		=> 'Permitir certificados SSL auto-firmados',
	'SMTP_ALLOW_SELF_SIGNED_EXPLAIN'=> 'Permitir conexiones al servidor SMTP con certificado SSL auto-firmado. <br><em><strong>Advertencia:</strong> Permitir los certificados SSL auto-firmados puede causar implicaciones de seguridad.</em>',
	'SMTP_AUTH_METHOD'				=> 'Método de autentificación para SMTP',
	'SMTP_AUTH_METHOD_EXPLAIN'		=> 'Solo usado si se configura usuario/contraseña, pregúntele a su ISP si no está seguro de cual método usar.',
	'SMTP_CRAM_MD5'					=> 'CRAM-MD5',
	'SMTP_DIGEST_MD5'				=> 'DIGEST-MD5',
	'SMTP_LOGIN'					=> 'LOGIN',
	'SMTP_PASSWORD'					=> 'Contraseña SMTP',
	'SMTP_PASSWORD_EXPLAIN'			=> 'Introduzca una contraseña solo si su servidor SMTP lo requiere.<br><em><strong>ADVERTENCIA:</strong> Esta contraseña será guardada como texto plano en la base de datos y será visible para cualquiera que tenga acceso a la misma o que pueda ver esta página de configuración.</em>',
	'SMTP_PLAIN'					=> 'PLAIN',
	'SMTP_POP_BEFORE_SMTP'			=> 'POP-BEFORE-SMTP',
	'SMTP_PORT'						=> 'Puerto servidor SMTP',
	'SMTP_PORT_EXPLAIN'				=> 'Cámbialo solo si sabes que tu servidor SMTP está en un puerto diferente.',
	'SMTP_SERVER'					=> 'Dirección del servidor SMTP',
	'SMTP_SERVER_EXPLAIN'			=> 'No proporciones un protocolo (<samp>ssl://</samp> o <samp>tls://</samp>) a menos que tu servidor de correo le indique que lo hagas.',
	'SMTP_SETTINGS'					=> 'Configuración SMTP',
	'SMTP_USERNAME'					=> 'Usuario SMTP',
	'SMTP_USERNAME_EXPLAIN'			=> 'Solo introduce un usuario si tu servidor SMTP lo requiere.',
	'SMTP_VERIFY_PEER'				=> 'Verificar el certificado SSL',
	'SMTP_VERIFY_PEER_EXPLAIN'		=> 'Requiere verificación del certificado SSL utilizado por el servidor SMTP. <br><em><strong>Advertencia:</strong> La conexión de pares con certificados SSL no verificados puede causar implicaciones de seguridad.</em>',
	'SMTP_VERIFY_PEER_NAME'			=> 'Verificar el nombre de usuario SMTP',
	'SMTP_VERIFY_PEER_NAME_EXPLAIN'	=> 'Requiere verificación del nombre de usuario para servidores SMTP que utilizan conexiones SSL / TLS. <br><em><strong>Advertencia:</strong> La conexión a pares no verificados puede causar implicaciones de seguridad.</em>',
	'TEST_EMAIL_SENT'				=> 'El correo electrónico de prueba ha sido enviado.<br>Si no lo recibes, por favor revisa tú configuración de mensajes de correo electrónico.<br><br>Si necesitas ayuda, por favor visita los <a href="https://www.phpbb.com/community/">foros de soporte de phpBB</a>.',
	'USE_SMTP'						=> 'Usar servidor SMTP para email',
	'USE_SMTP_EXPLAIN'				=> 'Elija "Sí" si quiere o necesita enviar emails mediante un servidor específico en lugar de la función de email local.',
));

// Jabber settings
$lang = array_merge($lang, array(
	'ACP_JABBER_SETTINGS_EXPLAIN'	=> 'Aquí puede habilitar y controlar el uso de Jabber para mensajería instantánea y avisos del Sitio. Jabber es un protocolo de código abierto y por lo tanto disponible para que lo use cualquiera. Algunos servidores Jabber le permiten contactar con usuarios en otras redes. No todos los servidores ofrecen todos los transportes, y los cambios en el protocolo pueden causar que algunos transportes dejen de funcionar. Observe que puede tomar varios segundos actualizar los datos de la cuenta Jabber, ¡no cancele el proceso hasta completarlo!',

	'JAB_ALLOW_SELF_SIGNED'			=> 'Permitir certificados SSL auto-firmados',
	'JAB_ALLOW_SELF_SIGNED_EXPLAIN'	=> 'Permitir conexiones al servidor Jabber con certificado SSL auto-firmado. <br><em><strong>Advertencia:</strong> Permitir los certificados SSL auto-firmados puede causar implicaciones de seguridad.</em>',
	'JAB_ENABLE'					=> 'Habilitar Jabber',
	'JAB_ENABLE_EXPLAIN'			=> 'Habilite el uso de mensajeria y notificaciones Jabber',
	'JAB_GTALK_NOTE'				=> 'Por favor fíjese en que GTalk no funcionará porque no se encontró la función <samp>dns_get_record</samp>. Esta función no está disponible en PHP4, y no está implementada en plataformas Windows. Actualmente no funciona en sistemas basados en BSD, incluído Mac OS.',
	'JAB_PACKAGE_SIZE'				=> 'Tamaño del paquete Jabber',
	'JAB_PACKAGE_SIZE_EXPLAIN'		=> 'Éste es el número de mensajes enviados en un paquete. Si es 0, el mensaje se envía inmediatamente y no se pone en cola para un envío posterior.',
	'JAB_PASSWORD'					=> 'Contraseña Jabber',
	'JAB_PASSWORD_EXPLAIN'			=> '<em><strong>Advertencia:</strong> Esta contraseña será guardada como texto plano en la base de datos y será visible para cualquiera que tenga acceso a la misma o que pueda ver esta página de configuración.</em>',
	'JAB_PORT'						=> 'Puerto Jabber',
	'JAB_PORT_EXPLAIN'				=> 'Deje en blanco a menos que sepa que no es el puerto 5222',
	'JAB_SERVER'					=> 'Servidor Jabber',
	'JAB_SERVER_EXPLAIN'			=> 'Vea %sjabber.org%s para obtener una lista de servidores',
	'JAB_SETTINGS_CHANGED'			=> 'Configuración Jabber cambiada con éxito.',
	'JAB_USE_SSL'					=> 'Usar SSL para conectar',
	'JAB_USE_SSL_EXPLAIN'			=> 'Si una conexión segura está habilitada, se intentará establecer la conexión. El puerto Jabber será cambiado a 5223 si está especificado el puerto 5222.',
	'JAB_USERNAME'					=> 'Usuario Jabber o JID',
	'JAB_USERNAME_EXPLAIN'			=> 'Especifique un nombre de usuario registrado o un JID válido. No se comprobará la validez del nombre de usuario. Si solo especifica un nombre de usuario entonces su JID será el nombre de usuario y el servidor que especificó arriba. Si no, especifique un JID válido, por ejemplo user@jabber.org.',
	'JAB_VERIFY_PEER'				=> 'Verificar el certificado SSL',
	'JAB_VERIFY_PEER_EXPLAIN'		=> 'Requiere verificación del certificado SSL utilizado por el servidor Jabber. <br><em><strong>Advertencia:</strong> La conexión de pares con certificados SSL no verificados puede causar implicaciones de seguridad.</em>',
	'JAB_VERIFY_PEER_NAME'			=> 'Verificar el nombre de los pares de Jabber',
	'JAB_VERIFY_PEER_NAME_EXPLAIN'	=> 'Requiere verificación del nombre de los pares para los servidores Jabber mediante conexiones SSL / TLS. <br><em><strong>Advertencia:</strong> La conexión a pares no verificados puede causar implicaciones de seguridad.</em>',
));
