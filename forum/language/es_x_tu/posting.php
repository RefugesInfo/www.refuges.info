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
	'ADD_ATTACHMENT'			=> 'Subir adjunto',
	'ADD_ATTACHMENT_EXPLAIN'	=> 'Si quieres adjuntar uno o más archivos introduce los detalles debajo',
	'ADD_FILE'					=> 'Agregar archivo',
	'ADD_POLL'					=> 'Agregar encuesta',
	'ADD_POLL_EXPLAIN'			=> 'Si no quieres agregar una encuesta a tu tema, deje los campos en blanco',
	'ALREADY_DELETED'			=> 'Disculpa, este mensaje ya ha sido borrado.',
	'ATTACH_COMMENT_NO_EMOJIS'	=> 'El comentario del archivo adjunto contiene caracteres prohibidos (Emoji).',
	'ATTACH_DISK_FULL'			=> 'No hay suficiente espacio libre en el disco para publicar este adjunto.',    
	'ATTACH_QUOTA_REACHED'		=> 'Disculpa, la cuota de adjuntos del sitio está a tope.',
	'ATTACH_SIG'				=> 'Adjuntar firma (las firmas se pueden modificar en el Panel de Control de Usuario)',

	'BBCODE_A_HELP'				=> 'Insertar adjunto: [attachment=]filename.ext[/attachment]',
	'BBCODE_B_HELP'				=> 'Texto en negrita: [b]texto[/b]',
	'BBCODE_C_HELP'				=> 'Mostrar código: [code]código[/code]',
	'BBCODE_D_HELP'				=> 'Flash: [flash=width,height]http://url[/flash]',
	'BBCODE_F_HELP'				=> 'Tamaño de fuente: [size=x-small]texto pequeño[/size]',
	'BBCODE_IS_OFF'				=> '%sBBCode%s está <em>deshabilitado</em>',
	'BBCODE_IS_ON'				=> '%sBBCode%s está <em>habilitado</em>',
	'BBCODE_I_HELP'				=> 'Texto Itálica: [i]texto[/i]',
    'BBCODE_L_HELP'				=> 'Lista: [list][*]texto[/list]',
	'BBCODE_LISTITEM_HELP'		=> 'Listar ítem: [*]texto',
	'BBCODE_O_HELP'				=> 'Lista ordenada: Por ejemplo, [list=1][*]Primer punto[/list] o [list=a][*]Punto a[/list]',
	'BBCODE_P_HELP'				=> 'Inserta imagen: [img]http://imagen_url[/img]',
	'BBCODE_Q_HELP'				=> 'Citar texto: [quote]texto[/quote]',
	'BBCODE_S_HELP'				=> 'Color de fuente: [color=red]texto[/color] o [color=#FF0000]text[/color]',
	'BBCODE_U_HELP'				=> 'Texto subrayado: [u]texto[/u]',
	'BBCODE_W_HELP'				=> 'Insertar URL: [url]http://url[/url] ó [url=http://url]URL texto[/url]',
 	'BBCODE_Y_HELP'				=> 'Lista: Añadir elemento a la lista',
	'BUMP_ERROR'				=> 'No puede activar este tema tan pronto.',

	'CANNOT_DELETE_REPLIED'		=> 'Disculpa, solamente puedes borrar mensajes que no hayan sido respondidos.',
	'CANNOT_EDIT_POST_LOCKED'	=> 'Este mensaje ha sido cerrado. Ya no puedes editar este mensaje.',
	'CANNOT_EDIT_TIME'			=> 'Ya no puedes editar o borrar este mensaje',
	'CANNOT_POST_ANNOUNCE'		=> 'Disculpa, no puedes publicar anuncios.',
	'CANNOT_POST_STICKY'		=> 'Disculpa, no puedes publicar notas.',
	'CHANGE_TOPIC_TO'			=> 'Cambiar tipo de tema a',
	'CHARS_POST_CONTAINS'		=> array(
		1	=> 'Tu mensaje contiene %1$d carácter.',
		2	=> 'Tu mensaje contiene %1$d caracteres.',
	),
	'CHARS_SIG_CONTAINS'		=> array(
		1	=> 'Tu firma contiene %1$d carácter.',
		2	=> 'Tu firma contiene %1$d caracteres.',
	),
	'CLOSE_TAGS'				=> 'Cerrar etiquetas',
	'CURRENT_TOPIC'				=> 'Tema actual',

	'DELETE_FILE'				=> 'Borrar archivo',
	'DELETE_MESSAGE'			=> 'Borrar mensaje',
	'DELETE_MESSAGE_CONFIRM'	=> '¿Estás seguro de querer borrar este mensaje?',
	'DELETE_OWN_POSTS'			=> 'Disculpa, solo puedes borrar tus propios mensajes.',
	'DELETE_PERMANENTLY'		=> 'Borrar permanentemente',
	'DELETE_POST_CONFIRM'		=> '¿Estás seguro de querer borrar este mensaje?',
	'DELETE_POST_PERMANENTLY_CONFIRM'	=> '¿Estás seguro de querer borrar <strong>permanentemente</strong> este mensaje?',
	'DELETE_POST_PERMANENTLY'	=> array(
		1	=> 'Borrar permanentemente este mensaje para que no pueda ser recuperado',
		2	=> 'Borrar permanentemente estos %1$d mensajes para que no puedan ser recuperados',
	),
	'DELETE_POSTS_CONFIRM'		=> '¿Estás seguro de querer borrar estos mensajes?',
	'DELETE_POSTS_PERMANENTLY_CONFIRM'	=> '¿Estás seguro de querer borrar <strong>permanentemente</strong> estos mensajes?',
	'DELETE_REASON'				=> 'Razón del borrado',
	'DELETE_REASON_EXPLAIN'		=> 'La razón especificada para su eliminación será visible para los Moderadores.',
	'DELETE_POST_WARN'			=> 'Borrar este mensaje',
	'DELETE_TOPIC_CONFIRM'		=> '¿Estás seguro de querer borrar este tema?',
	'DELETE_TOPIC_PERMANENTLY'	=> array(
		1	=> 'Borrar permanentemente este tema para que no pueda ser recuperado',
		2	=> 'Borrar permanentemente estos %1$d temas para que no puedan ser recuperados',
	),
	'DELETE_TOPIC_PERMANENTLY_CONFIRM'	=> '¿Estás seguro de querer borrar <strong>permanentemente</strong> este tema?',
	'DELETE_TOPICS_CONFIRM'		=> '¿Estás seguro de querer borrar estos temas?',
	'DELETE_TOPICS_PERMANENTLY_CONFIRM'	=> '¿Está seguro de querer borrar <strong>permanentemente</strong> estos temas?',
	'DISABLE_BBCODE'			=> 'Deshabilitar BBCode',
	'DISABLE_MAGIC_URL'			=> 'No convertir automáticamente las URLs',
	'DISABLE_SMILIES'			=> 'Deshabilitar emoticonos',
	'DISALLOWED_CONTENT'		=> 'La subida fue rechazada porque el archivo a subir fue identificado como un posible vector de ataque.',
	'DISALLOWED_EXTENSION'		=> 'La extensión %s no está permitida',
	'DRAFT_LOADED'				=> 'Borrador subido al área de envío. ¿Quieres terminar tu mensaje ahora?<br />Tu borrador será eliminado después de enviar el mensaje.',
	'DRAFT_LOADED_PM'			=> 'Borrador subido en área de mensajes, puedes terminarlo ahora.<br />Tu borrador será borrado después de enviar este mensaje privado.',
	'DRAFT_SAVED'				=> 'Borrador guardado correctamente.',
	'DRAFT_TITLE'				=> 'Título del borrador',

	'EDIT_REASON'				=> 'Razón para editar este mensaje',
	'EMPTY_FILEUPLOAD'			=> 'El archivo subido está vacío',
	'EMPTY_MESSAGE'				=> 'Tienes que enviar un mensaje cuando publiques.',
	'EMPTY_REMOTE_DATA'			=> 'Imposible subir el archivo, por favor, intentalo subirlo manualmente.',

	'FLASH_IS_OFF'				=> '[Flash] está <em>deshabilitado</em>',
	'FLASH_IS_ON'				=> '[Flash] está <em>habilitado</em>',
	'FLOOD_ERROR'				=> 'No puedes enviar otro mensaje tan pronto.',
	'FONT_COLOR'				=> 'Color de fuente',
	'FONT_COLOR_HIDE'			=> 'Ocultar color de fuente',
	'FONT_HUGE'					=> 'Enorme',
	'FONT_LARGE'				=> 'Grande',
	'FONT_NORMAL'				=> 'Normal',
	'FONT_SIZE'					=> 'Tamaño de fuente',
	'FONT_SMALL'				=> 'Pequeña',
	'FONT_TINY'					=> 'Diminuta',

	'GENERAL_UPLOAD_ERROR'		=> 'Imposible subir el adjunto a %s',

	'IMAGES_ARE_OFF'			=> '[img] está <em>deshabilitado</em>',
	'IMAGES_ARE_ON'				=> '[img] está <em>habilitado</em>',
	'INVALID_FILENAME'			=> '%s es un nombre de archivo inválido',

	'LOAD'						=> 'Cargar',
	'LOAD_DRAFT'				=> 'Cargar borrador',
	'LOAD_DRAFT_EXPLAIN'		=> 'Aquí puedes seleccionar el borrador que quieras continuar redactando. Tu mensaje actual será cancelado, el contenido será borrado. Puedes ver, borrar y editar borradores en tu Panel de Control de Usuario.',
	'LOGIN_EXPLAIN_BUMP'		=> 'Necesitas identificarte para activar temas en este foro.',
	'LOGIN_EXPLAIN_DELETE'		=> 'Necesitas identificarte para borrar mensajes en este foro.',
	'LOGIN_EXPLAIN_SOFT_DELETE'	=> 'Necesitas identificarte para el borrado temporal de mensajes en este foro.',
	'LOGIN_EXPLAIN_POST'		=> 'Necesitas identificarte para enviar mensajes en este foro.',
	'LOGIN_EXPLAIN_QUOTE'		=> 'Necesitas identificarte para citar mensajes en este foro.',
	'LOGIN_EXPLAIN_REPLY'		=> 'Necesitas identificarte para responder temas en este foro.',

	'MAX_FONT_SIZE_EXCEEDED'	=> 'Solo puedes usar fuentes de un tamaño hasta %d.',
	'MAX_FLASH_HEIGHT_EXCEEDED'	=> array(
		1	=> 'Tus archivos flash solo pueden ser hasta %d pixel de alto.',
		2	=> 'Tus archivos flash solo pueden ser hasta %d píxeles de alto.',
	),
	'MAX_FLASH_WIDTH_EXCEEDED'	=> array(
		1	=> 'Tus archivos flash solo pueden ser hasta %d pixel de ancho.',
		2	=> 'Tus archivos flash solo pueden ser hasta %d píxeles de ancho.',
	),
	'MAX_IMG_HEIGHT_EXCEEDED'	=> array(
		1	=> 'Tus imágenes solo pueden ser hasta %1$d pixel de alto.',
		2	=> 'Tus imágenes solo pueden ser hasta %1$d píxeles de alto.',
	),
	'MAX_IMG_WIDTH_EXCEEDED'	=> array(
		1	=> 'Tus imágenes solo pueden ser hasta %d pixel de ancho.',
		2	=> 'Tus imágenes solo pueden ser hasta %d píxeles de ancho.',
	),

	'MESSAGE_BODY_EXPLAIN'		=> array(
		0	=> '', // zero means no limit, so we don't view a message here.
		1	=> 'Introduce tu mensaje aquí, no puede tener más de <strong>%d</strong> carácter.',
		2	=> 'Introduce tu mensaje aquí, no puede tener más de <strong>%d</strong> caracteres.',
	),
	'MESSAGE_DELETED'			=> 'Este mensaje ha sido borrado correctamente',
	'MORE_SMILIES'				=> 'Ver más emoticonos',

	'NOTIFY_REPLY'				=> 'Enviarme un email cuando un mensaje es respondido',
	'NOT_UPLOADED'				=> 'El archivo no se pudo subir.',
	'NO_DELETE_POLL_OPTIONS'	=> 'No puedes borrar las opciones existentes de la encuesta',
	'NO_PM_ICON'				=> 'Sin icono',
	'NO_POLL_TITLE'				=> 'Tienes que poner un título a la encuesta',
	'NO_POST'					=> 'El mensaje requerido no existe.',
	'NO_POST_MODE'				=> 'No se especificó el modo de mensaje',
	'NO_TEMP_DIR'				=> 'La carpeta temporal no se ha encontrado, o no se puede escribir.',

	'PARTIAL_UPLOAD'			=> 'El archivo fue solo parcialmente subido',
	'PHP_UPLOAD_STOPPED'		=> 'Una extensión PHP ha detenido la carga de archivos.',
	'PHP_SIZE_NA'				=> 'El tamaño del archivo adjunto es muy grande.<br />No se puede determinar el tamaño máximo definido por PHP en php.ini.',
	'PHP_SIZE_OVERRUN'			=> 'El tamaño del archivo adjunto es muy grande, el tamaño máximo de subida es %1$d %2$s.<br />Por favor, ten en cuenta que está definido en php.ini y no puede ser cambiado.',
	'PLACE_INLINE'				=> 'Insertar en texto',
	'POLL_DELETE'				=> 'Borrar encuesta',
	'POLL_FOR'					=> 'Hacer encuesta para',
	'POLL_FOR_EXPLAIN'			=> 'Introduce 0 ó deja en blanco para una encuesta sin límite de tiempo.',
	'POLL_MAX_OPTIONS'			=> 'Opciones por usuario',
	'POLL_MAX_OPTIONS_EXPLAIN'	=> 'Éste es el número de opciones que cada usuario puede seleccionar cuando vota.',
	'POLL_OPTIONS'				=> 'Opciones de encuesta',
	'POLL_OPTIONS_EXPLAIN'		=> array(
		1	=> 'Coloca cada opción en una nueva línea. Puedes introducir <strong>%d</strong> opción.',
		2	=> 'Coloca cada opción en una nueva línea. Puedes introducir hasta <strong>%d</strong> opciones.',
	),
	'POLL_OPTIONS_EDIT_EXPLAIN'		=> array(
		1	=> 'Coloca cada opción en una nueva línea. Puedes introducir <strong>%d</strong> opción. Si eliminas o añades opciones todos los votos previos se resetearán.',
		2	=> 'Coloca cada opción en una nueva línea. Puedes introducir hasta <strong>%d</strong> opciones. Si eliminas o añades opciones todos los votos previos se resetearán.',
	),
	'POLL_QUESTION'				=> 'Pregunta de la encuesta',
	'POLL_TITLE_TOO_LONG'		=> 'El título de la encuesta debe tener menos de 100 caracteres.',
	'POLL_TITLE_COMP_TOO_LONG'	=> 'El título de la encuesta es demasiado largo, puedes eliminar BBcode o emoticonos.',
	'POLL_VOTE_CHANGE'			=> 'Permitir cambiar el voto',
	'POLL_VOTE_CHANGE_EXPLAIN'	=> 'Si está habilitado, los usuarios pueden cambiar su voto.',
	'POSTED_ATTACHMENTS'		=> 'Adjuntos publicados',
	'POST_APPROVAL_NOTIFY'		=> 'Se te notificará cuando su mensaje sea aprobado.',
	'POST_CONFIRMATION'			=> 'Confirmación del mensaje',
	'POST_CONFIRM_EXPLAIN'		=> 'Para prevenir posteos automáticos el administrador del sitio requiere que ingreses un código de confirmación. El código es mostrado en la imagen que deberías ver debajo. Si tienes problemas de visión, o de alguna manera no puedes leer el código, por favor contacta con la %sAdministración del Foro%s.',
	'POST_DELETED'				=> 'Este mensaje ha sido borrado correctamente',
	'POST_EDITED'				=> 'Este mensaje ha sido editado correctamente',
	'POST_EDITED_MOD'			=> 'Este mensaje ha sido editado, pero tendrá que ser aprobado por un moderador antes de que sea visible públicamente.',
	'POST_GLOBAL'				=> 'Global',
	'POST_ICON'					=> 'Icono del mensaje',
	'POST_NORMAL'				=> 'Normal',
	'POST_REVIEW'				=> 'Revisar el mensaje',
	'POST_REVIEW_EDIT'			=> 'Revisión del mensaje',
	'POST_REVIEW_EDIT_EXPLAIN'	=> 'Este mensaje ha sido modificado por otro usuario mientras tú estabas editándolo. Puedes querer revisar la versión actual de este mensaje y ajustar tus modificaciones.',
	'POST_REVIEW_EXPLAIN'		=> 'Al menos una revisión ha sido hecha a este mensaje. Tal vez quieras volver a ver tu mensaje.',
	'POST_STORED'				=> 'Este mensaje ha sido publicado correctamente.',
	'POST_STORED_MOD'			=> 'El mensaje ha sido guardado pero requiere aprobación.',
	'POST_TOPIC_AS'				=> 'Tema como',
	'PROGRESS_BAR'				=> 'Barra de progreso',

	'QUOTE_DEPTH_EXCEEDED'		=> array(
		1	=> 'Puedes incrustar solo %d cita una dentro de otra.',
		2	=> 'Puedes incrustar solo %d citas una dentro de otra.',
	),
    'QUOTE_NO_NESTING'			=> 'No puedes incrustar citas dentro de otra.',

	'REMOTE_UPLOAD_TIMEOUT'		=> 'El archivo especificado no se ha podido subir por la solicitud de tiempo de espera.',
	'SAVE'						=> 'Guardar',
	'SAVE_DATE'					=> 'Guardado como',
	'SAVE_DRAFT'				=> 'Guardar borrador',
	'SAVE_DRAFT_CONFIRM'		=> 'Por favor, ten en cuenta que los borradores guardados solo incluyen el tema y el mensaje, cualquier otro elemento será eliminado. ¿Quieres guardar tu borrador ahora?',
	'SMILIES'					=> 'Emoticonos',
	'SMILIES_ARE_OFF'			=> 'Emoticonos están <em>deshabilitados</em>',
	'SMILIES_ARE_ON'			=> 'Emoticonos están <em>habilitados</em>',
	'STICKY_ANNOUNCE_TIME_LIMIT'=> 'Fecha límite para Nota/Anuncio/Global',
	'STICK_TOPIC_FOR'			=> 'Fijar tema para',
	'STICK_TOPIC_FOR_EXPLAIN'	=> 'Introduce 0 ó deja en blanco para un Nota/Anuncio/Global sin límite de tiempo. Por favor, ten en cuenta que este número está relacionado con la fecha de publicación del mensaje.',
	'STYLES_TIP'				=> 'Consejo: Pueden aplicarse estilos rápidamente al texto seleccionado.',

	'TOO_FEW_CHARS'				=> 'Tu mensaje contiene muy pocos caracteres.',
	'TOO_FEW_CHARS_LIMIT'		=> array(
		1	=> 'Es necesario introducir al menos %1$d carácter.',
		2	=> 'Es necesario introducir al menos %1$d caracteres.',
	),
	'TOO_FEW_POLL_OPTIONS'		=> 'Tiene que introducir al menos dos opciones para la encuesta.',
	'TOO_MANY_ATTACHMENTS'		=> 'No puede añadir otro adjunto, %d es el máximo.',
	'TOO_MANY_CHARS'			=> 'Su mensaje contiene demasiados caracteres.',
	'TOO_MANY_CHARS_LIMIT'		=> array(
		2	=> 'El número máximo de caracteres permitidos es %1$d.',
	),
	'TOO_MANY_POLL_OPTIONS'		=> 'Intentas introducir demasiadas opciones para la encuesta',
	'TOO_MANY_SMILIES'			=> 'Tu mensaje contiene demasiados emoticonos. El número máximo de emoticonos permitidos es %d.',
	'TOO_MANY_URLS'				=> 'Tu mensaje contiene demasiadas URLs. El número máximo de URLs permitidas es %d.',
	'TOO_MANY_USER_OPTIONS'		=> 'No puedes especificar más opciones por usuario que la cantidad de opciones de la encuesta',
	'TOPIC_BUMPED'				=> 'El tema ha sido reactivado correctamente',

	'UNAUTHORISED_BBCODE'		=> 'No puedes usar ciertos BBCodes: %s',
	'UNGLOBALISE_EXPLAIN'		=> 'Para volver este tema de global a normal has de seleccionar el foro en el que quieres mostrarlo.',
 	'UNSUPPORTED_CHARACTERS_MESSAGE'	=> 'Tu mensaje contiene los siguientes caracteres no admitidos:<br />%s',
 	'UNSUPPORTED_CHARACTERS_SUBJECT'	=> 'Tu asunto contiene los siguientes caracteres no admitidos:<br />%s',
	'UPDATE_COMMENT'			=> 'Actualizar comentario',
	'URL_INVALID'				=> 'La URL que has especificado es inválida.',
	'URL_NOT_FOUND'				=> 'No se puede encontrar el archivo especificado.',
	'URL_IS_OFF'				=> '[url] está <em>deshabilitado</em>',
	'URL_IS_ON'					=> '[url] está <em>habilitado</em>',
	'USER_CANNOT_BUMP'			=> 'No puedes activar temas en este Foro',
	'USER_CANNOT_DELETE'		=> 'No puedes borrar temas en este Foro',
	'USER_CANNOT_EDIT'			=> 'No puedes editar mensajes en este Foro',
	'USER_CANNOT_REPLY'			=> 'No puedes responder en este Foro',
	'USER_CANNOT_FORUM_POST'	=> 'No puedes realizar esa operación en este Foro debido a que el tipo de Foro no lo soporta.',

	'VIEW_MESSAGE'				=> '%1$sVer el mensaje enviado%2$s',
	'VIEW_PRIVATE_MESSAGE'		=> '%sVer tu mensaje privado enviado%s',

	'WRONG_FILESIZE'			=> 'El archivo es muy grande, el tamaño máximo permitido es %1$d %2$s.',
	'WRONG_SIZE'				=> 'La imagen debe tener al menos %1$s de ancho, %2$s de alto, y a lo sumo %3$s de ancho y %4$s de alto. La imagen enviada tiene %5$s de ancho y %6$s de alto.',
));
