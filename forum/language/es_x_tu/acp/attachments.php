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
//


$lang = array_merge($lang, array(
	'ACP_ATTACHMENT_SETTINGS_EXPLAIN'	=> 'Aquí puedes configurar los principales parámetros para archivos adjuntos y las categorías especiales asociadas.',
	'ACP_EXTENSION_GROUPS_EXPLAIN'		=> 'Aquí puedes añadir, borrar, modificar o deshabilitar los grupos de extensiones. Opciones adicionales incluyen su asignación a una categoría especial, cambiar el mecanismo de descarga y definir un icono que se mostrará delante del adjunto que pertenezca al grupo.',
	'ACP_MANAGE_EXTENSIONS_EXPLAIN'		=> 'Aquí puedes editar sus extensiones permitidas. Para activar sus extensiones, por favor diríjete al Panel de Control de Administración (PCA) de extensiones de grupo. Te recomendamos encarecidamente no permitir extensiones de scripts (como <code>php</code>, <code>php3</code>, <code>php4</code>, <code>phtml</code>, <code>pl</code>, <code>cgi</code>, <code>py</code>, <code>rb</code>, <code>asp</code>, <code>aspx</code>, y similares).',
	'ACP_ORPHAN_ATTACHMENTS_EXPLAIN'	=> 'Aquí puedes ver qué archivos están en la carpeta de subidas sin ser asignados a ningún mensaje. Esto ocurre generalmente si el usuario adjunta un archivo pero no envía el mensaje. Puedes borrar estos archivos o asignarlos a un mensaje existente. Esto requiere de un ID de mensaje válido por lo que ha de determinarlo por su cuenta. Esta utilidad es principalmente para aquellas personas que quieren subir archivos (por lo general grandes) con otro programa (por ejemplo, con un cliente ftp) y asignarlos a un mensaje ya existente.',
	'ADD_EXTENSION'						=> 'Añadir extensión',
	'ADD_EXTENSION_GROUP'				=> 'Añadir grupo de extensiones',
	'ADMIN_UPLOAD_ERROR'				=> 'Se podrujo algún error mientras tratabas de adjuntar un archivo: %s',
	'ALLOWED_FORUMS'					=> 'Foros permitidos',
	'ALLOWED_FORUMS_EXPLAIN'			=> 'Habilitado enviar las extensiones asignadas al foro (o foros) seleccionado(s)',
	'ALLOWED_IN_PM_POST'				=> 'Permitido',
	'ALLOW_ATTACHMENTS'					=> 'Permitir adjuntos',
	'ALLOW_ALL_FORUMS'					=> 'Permitir todos los Foros',
	'ALLOW_IN_PM'						=> 'Permitir en Mensajes Privados',
	'ALLOW_PM_ATTACHMENTS'				=> 'Permitir adjuntos en Mensajes Privados',
	'ALLOW_SELECTED_FORUMS'				=> 'Solo los Foros seleccionados debajo',
	'ASSIGNED_EXTENSIONS'				=> 'Extensiones asignadas',
	'ASSIGNED_GROUP'					=> 'Grupo de extensiones asignado',
	'ATTACH_EXTENSIONS_URL'				=> 'Extensiones',
	'ATTACH_EXT_GROUPS_URL'				=> 'Grupos de extensiones',
	'ATTACH_ID'							=> 'ID',
	'ATTACH_MAX_FILESIZE'				=> 'Tamaño máximo',
	'ATTACH_MAX_FILESIZE_EXPLAIN'		=> 'Tamaño máximo de cada archivo. Si este valor es 0, el tamaño del archivo para subir sólo estará limitado por la configuración de PHP.',
	'ATTACH_MAX_PM_FILESIZE'			=> 'Máximo por usuario',
	'ATTACH_MAX_PM_FILESIZE_EXPLAIN'	=> 'Tamaño máximo, 0 significa ilimitado, de un archivo adjuntado a un Mensaje Privado.',
	'ATTACH_ORPHAN_URL'					=> 'Adjuntos huérfanos',
	'ATTACH_POST_ID'					=> 'Mensaje ID',
	'ATTACH_POST_TYPE'					=> 'Tipo de mensaje',
	'ATTACH_QUOTA'						=> 'Máximo total para adjuntos',
	'ATTACH_QUOTA_EXPLAIN'				=> 'Máximo en disco disponible para adjuntos en todo el sitio, 0 significa ilimitado.',
	'ATTACH_TO_POST'					=> 'Adjuntar archivo a mensaje',

	'CAT_FLASH_FILES'					=> 'Archivos Flash',
	'CAT_IMAGES'						=> 'Imágenes',
	'CHECK_CONTENT'						=> 'Comprobar archivos adjuntos',
	'CHECK_CONTENT_EXPLAIN'				=> 'Algunos navegadores pueden ser engañados para que asuman un mimetype de archivos subibles incorrecto. Esta opción previene que tales archivos que puedan causar eso sean rechazados.',
	'CREATE_GROUP'						=> 'Crear nuevo grupo',
	'CREATE_THUMBNAIL'					=> 'Crear vista en miniatura',
	'CREATE_THUMBNAIL_EXPLAIN'			=> 'Crear vista en miniatura siempre que sea posible.',

	'DEFINE_ALLOWED_IPS'				=> 'Definir IPs/hostnames permitidos',
	'DEFINE_DISALLOWED_IPS'				=> 'Definir IPs/hostnames no permitidos',
	'DOWNLOAD_ADD_IPS_EXPLAIN'			=> 'Para especificar varias IPs o hostnames diferentes, introduce cada una en una nueva línea. Para especificar un rango de direcciones IP separa el inicio y el final con un guión (-), para especificar un comodín use *',
	'DOWNLOAD_REMOVE_IPS_EXPLAIN'		=> 'Puedes eliminar (o des-excluir) múltiples direcciones IP al mismo tiempo usando la combinación apropiada de ratón y teclado para tu navegador (por ejemplo, Ctrl+Clic). Las IPs excluidas están en negrita.',
	'DISPLAY_INLINED'					=> 'Mostrar imagenes',
	'DISPLAY_INLINED_EXPLAIN'			=> 'Si eliges "Sin imagen", los adjuntos se mostrarán como un enlace.',
	'DISPLAY_ORDER'						=> 'Mostrar adjuntos ordenados',
	'DISPLAY_ORDER_EXPLAIN'				=> 'Muestra los adjuntos ordenados por fecha.',

	'EDIT_EXTENSION_GROUP'				=> 'Editar grupo de extensiones',
	'EXCLUDE_ENTERED_IP'				=> 'Habilítalo para excluir la IP/hostname ingresada.',
	'EXCLUDE_FROM_ALLOWED_IP'			=> 'Excluir IP de las IPs/hostnames permitidas',
	'EXCLUDE_FROM_DISALLOWED_IP'		=> 'Excluir IP de las IPs/hostnames no permitidas',
	'EXTENSIONS_UPDATED'				=> 'Extensiones actualizadas correctamente',
	'EXTENSION_EXIST'					=> 'La extensión %s ya existe',
	'EXTENSION_GROUP'					=> 'Grupo de extensiones',
	'EXTENSION_GROUPS'					=> 'Grupos de extensiones',
	'EXTENSION_GROUP_DELETED'			=> 'Grupo de extensiones borrado correctamente.',
	'EXTENSION_GROUP_EXIST'				=> 'El grupo de extensiones %s ya existe',
	'EXT_GROUP_ARCHIVES'  				=> 'Archivos',
	'EXT_GROUP_DOCUMENTS'  				=> 'Documentos',
	'EXT_GROUP_DOWNLOADABLE_FILES'   	=> 'Archivos descargables',
	'EXT_GROUP_FLASH_FILES'	  			=> 'Archivos flash',
	'EXT_GROUP_IMAGES'	  				=> 'Imágenes',
	'EXT_GROUP_PLAIN_TEXT'	  			=> 'Texto plano',

	'FILES_GONE'			=> 'Algunos de los archivos adjuntos que has seleccionado para su eliminación ya no existen. Pueden haber sido eliminados. Los archivos adjuntos que no existen se eliminaron.',
	'FILES_STATS_WRONG'		=> 'Las estadísticas de sus archivos son probablemente inexactos y deben ser resincronizados. Valores actuales: número de adjuntos = %1$d, tamaño total de adjuntos = %2$s.<br />Clic %3$saquí%4$s para resincronizar esto.',

	'GO_TO_EXTENSIONS'					=> 'Ir a la sección de Administración de extensiones',
	'GROUP_NAME'						=> 'Nombre del Grupo',

	'IMAGE_LINK_SIZE'					=> 'Dimensiones de la imagen enlazada',
	'IMAGE_LINK_SIZE_EXPLAIN'			=> 'Mostrar la imagen adjunta como un enlace si es más grande. 0px por 0px significa ilimitado.',

	'MAX_ATTACHMENTS'					=> 'Número de adjuntos máximos por mensaje',
	'MAX_ATTACHMENTS_PM'				=> 'Número de adjuntos máximos por Mensaje Privado',
	'MAX_EXTGROUP_FILESIZE'				=> 'Tamaño máximo',
	'MAX_IMAGE_SIZE'					=> 'Dimensiones máximas',
	'MAX_IMAGE_SIZE_EXPLAIN'			=> 'Dimensiones máximas de la imagen adjunta. 0px por 0px significa ilimitado.',
	'MAX_THUMB_WIDTH'					=> 'Anchura/Altura máxima de la vista en miniatura en píxeles',
	'MAX_THUMB_WIDTH_EXPLAIN'			=> 'La imagen en miniatura generada no excederá esta anchura/altura',
	'MIN_THUMB_FILESIZE'				=> 'Tamaño mínimo para vista en miniatura',
	'MIN_THUMB_FILESIZE_EXPLAIN'		=> 'No crear vista en miniatura para imágenes más pequeñas que esto.',
	'MODE_INLINE'						=> 'Modo Inline',
	'MODE_PHYSICAL'						=> 'Modo Físico',

	'NOT_ALLOWED_IN_PM'					=> 'Solo permitido en Mensajes',
	'NOT_ALLOWED_IN_PM_POST'			=> 'No permitido',
	'NOT_ASSIGNED'						=> 'No asignado',
	'NO_ATTACHMENTS'			=> 'No se han encontrado adjuntos en este período.',
	'NO_EXT_GROUP'						=> 'Ninguno',
	'NO_EXT_GROUP_NAME'					=> 'No introdujo el nombre del Grupo',
	'NO_EXT_GROUP_SPECIFIED'			=> 'No especificó Grupo de Extensiones.',
	'NO_FILE_CAT'						=> 'Ninguno',
	'NO_IMAGE'							=> 'Sin imagen',
	'NO_UPLOAD_DIR'						=> 'La carpeta de subidas que has especificado no existe.',
	'NO_WRITE_UPLOAD'					=> 'La carpeta de subidas que has especificado no se puede escribir. Por favor, cambia los permisos en el servidor.',

	'ONLY_ALLOWED_IN_PM'				=> 'Solo permitido en Mensajes Privados',
	'ORDER_ALLOW_DENY'					=> 'Permitir',
	'ORDER_DENY_ALLOW'					=> 'Denegar',

	'REMOVE_ALLOWED_IPS'			=> 'Eliminar o des-excluir IPs/hostnames <em>permitidas</em>',
	'REMOVE_DISALLOWED_IPS'			=> 'Eliminar o des-excluir IPs/hostnames <em>no permitidas</em>',
	'RESYNC_FILES_STATS_CONFIRM'	=> '¿Estás seguro de querer resincronizar las estadísticas de archivos?',

	'SECURE_ALLOW_DENY'					=> 'Lista de Permitidos/No permitidos',
	'SECURE_ALLOW_DENY_EXPLAIN'			=> 'Cuando está habilitada la Descarga Segura cambia el comportamiento por defecto de la Lista de Permitidos/No permitidos de <strong>lista blanca</strong> (Permitido) a <strong>lista negra</strong> (No permitido)',
	'SECURE_DOWNLOADS'					=> 'Habilitar Descarga Segura',
	'SECURE_DOWNLOADS_EXPLAIN'			=> 'Con esta opción habilitada, las descargas se limitan a las IP’s/hostnames que hayas definido.',
	'SECURE_DOWNLOAD_NOTICE'			=> 'Descarga Segura no está habilitada. Los configuración de debajo se aplicarán después de habilitarla.',
	'SECURE_DOWNLOAD_UPDATE_SUCCESS'	=> 'La lista de IP ha sido actualizada correctamente.',
	'SECURE_EMPTY_REFERRER'				=> 'Permitir referrer vacío',
	'SECURE_EMPTY_REFERRER_EXPLAIN'		=> 'Descarga Segura está basada en referrers. ¿Quieres permitir las descargas para aquellos que omitan tus referrers?',
	'SETTINGS_CAT_IMAGES'				=> 'Configuración de Categoría de Imagen',
	'SPECIAL_CATEGORY'					=> 'Categoría Especial',
	'SPECIAL_CATEGORY_EXPLAIN'			=> 'Las Categorías Especiales son diferentes formas de presentar los mensajes.',
	'SUCCESSFULLY_UPLOADED'				=> 'Subido correctamente',
	'SUCCESS_EXTENSION_GROUP_ADD'		=> 'Grupo de extensiones agregado con éxito',
	'SUCCESS_EXTENSION_GROUP_EDIT'		=> 'Grupo de extensiones actualizado con éxito',

	'UPLOADING_FILES'					=> 'Subiendo archivos',
	'UPLOADING_FILE_TO'					=> 'Subiendo archivo "%1$s" al mensaje número %2$d…',
	'UPLOAD_DENIED_FORUM'				=> 'No tienes permisos para subir archivos al foro "%s"',
	'UPLOAD_DIR'						=> 'Carpeta de subidas',
	'UPLOAD_DIR_EXPLAIN'				=> 'Ruta donde se guardan los adjuntos.',
	'UPLOAD_ICON'						=> 'Icono de subida',
	'UPLOAD_NOT_DIR'					=> 'La ubicación que has especificado no parece ser una carpeta.',
));
