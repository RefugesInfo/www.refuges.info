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
	'ACP_GROUPS_MANAGE_EXPLAIN'		=> 'Desde este panel puede administrar los grupos de usuarios: puede borrar, crear y editar grupos existentes. Puede designar Moderadores, abrir y/o cerrar grupos, establecer el nombre del grupo y su descripción.',
	'ADD_GROUP_CATEGORY'			=> 'Añadir categoría',
	'ADD_USERS'						=> 'Añadir usuarios',
	'ADD_USERS_EXPLAIN'				=> 'Aquí puede añadir nuevos usuarios al Grupo. Puede seleccionar también si este Grupo será el de por defecto de los usuarios seleccionados. Además puede definirlos como responsables de Grupo. Por favor introduzca cada usuario en una línea aparte.',

	'COPY_PERMISSIONS'				=> 'Copiar permisos de',
	'COPY_PERMISSIONS_EXPLAIN'		=> 'Una vez creado, el Grupo tendrá los mismos permisos que el seleccionado aquí.',
	'CREATE_GROUP'					=> 'Crear nuevo grupo',

	'GROUPS_NO_MEMBERS'				=> 'Este Grupo no tiene usuarios',
	'GROUPS_NO_MODS'				=> 'No hay moderadores de Grupo',

	'GROUP_APPROVE'					=> 'Aprobar usuario',
	'GROUP_APPROVED'				=> 'Usuarios aprobados',
	'GROUP_AVATAR'					=> 'Avatar del Grupo',
	'GROUP_AVATAR_EXPLAIN'			=> 'Esta imagen se mostrará en el Panel de Control de Grupo.',
	'GROUP_CATEGORY_NAME'			=> 'Nombre de categoría',
	'GROUP_CLOSED'					=> 'Cerrado',
	'GROUP_COLOR'					=> 'Color del Grupo',
	'GROUP_COLOR_EXPLAIN'			=> 'Determina el color con el que aparecerán los nombres de usuarios de ese grupo, déjelo en blanco si quiere que use los parámetros por defecto de los usuarios.',
	'GROUP_CONFIRM_ADD_USERS'		=> array(
		1	=> '¿Está seguro de que quiere añadir al usuario %2$s al grupo?',
		2	=> '¿Está seguro de que quiere añadir a los usuarios %2$s al grupo?',
	),
	'GROUP_CREATED'					=> 'El grupo ha sido creado correctamente.',
	'GROUP_DEFAULT'					=> 'Grupo por defecto',
	'GROUP_DEFS_UPDATED'			=> 'Grupo por defecto establecido para todos los usuarios seleccionados.',
	'GROUP_DELETE'					=> 'Eliminar miembro del Grupo',
	'GROUP_DELETED'					=> 'Grupo borrado y grupos por defecto establecidos correctamente.',
	'GROUP_DEMOTE'					=> 'Deponer responsable de grupo',
	'GROUP_DESC'					=> 'Descripción del Grupo',
	'GROUP_DETAILS'					=> 'Detalles del Grupo',
	'GROUP_EDIT_EXPLAIN'			=> 'Aquí puede editar un Grupo existente. Puede cambiar su nombre, descripción y tipo (abierto, cerrado, etc.). También establecer opciones globales como colores, rango, etc. Los cambios hechos aquí sobreescriben los parámetros actuales de los usuarios. Por favor tenga en cuenta que los usuarios del grupo no pueden cambiar su avatar a menos que defina los permisos de usuario apropiados.',
	'GROUP_ERR_USERS_EXIST'			=> 'Los usuarios especificados ya pertenecen a este Grupo',
	'GROUP_FOUNDER_MANAGE'			=> 'Fundador administra exclusivamente',
	'GROUP_FOUNDER_MANAGE_EXPLAIN'	=> 'Solo los fundadores del Grupo pueden acceder al Panel de Administración del Grupo.',
	'GROUP_HIDDEN'					=> 'Oculto',
	'GROUP_LANG'					=> 'Idioma del Grupo',
	'GROUP_LEAD'					=> 'Responsable del Grupo',
	'GROUP_LEADERS_ADDED'			=> 'Nuevos responsables agregados con éxito.',
	'GROUP_LEGEND'					=> 'Mostrar Grupo en leyenda',
	'GROUP_LIST'					=> 'Usuarios actuales',
	'GROUP_LIST_EXPLAIN'			=> 'Lista completa de todos los usuarios que actualmente pertenecen a este Grupo. Puedes borrar usuarios del grupo (excepto en ciertos grupos especiales) o agregar nuevos.',
	'GROUP_MEMBERS'					=> 'Usuarios del Grupo',
	'GROUP_MEMBERS_EXPLAIN'			=> 'Éste es el listado completo de todos los usuarios de este grupo. Incluye secciones separadas para usuarios responsables, existentes y pendientes. Desde aquí puedes administrar todos los aspectos de quienes pertenecen a este grupo y con qué roles. Para eliminar un responsable, pero manteniéndolo en el Grupo, usa Deponer en vez de Borrar. De manera similar usa Promover para hacer responsable a un usuario existente.',
	'GROUP_MESSAGE_LIMIT'			=> 'Límite de Mensajes Privados por carpeta',
	'GROUP_MESSAGE_LIMIT_EXPLAIN'	=> 'Este parámetro sobreescribe el límite por usuario. El máximo para todos los grupos de usuario se utiliza para determinar el valor real.<br />Establece este valor en 0 para sobrescribir la configuración para todos los usuarios de este grupo con la configuración del foro.',
	'GROUP_MODS_ADDED'				=> 'Usuarios añadidos correctamente.',
	'GROUP_MODS_DEMOTED'			=> 'Usuarios depuestos correctamente.',
	'GROUP_MODS_PROMOTED'			=> 'Usuarios promovidos correctamente.',
	'GROUP_NAME'					=> 'Nombre del Grupo',
	'GROUP_NAME_TAKEN'				=> 'El nombre de grupo que ha introducido ya está en uso, por favor seleccione uno distinto.',
	'GROUP_OPEN'					=> 'Abierto',
	'GROUP_PENDING'					=> 'Usuarios pendientes',
	'GROUP_MAX_RECIPIENTS'			=> 'Número máximo de destinatarios permitidos por cada mensaje privado',
	'GROUP_MAX_RECIPIENTS_EXPLAIN'	=> 'Número máximo de destinatarios permitidos en un mensaje privado. El máximo para todos los grupos de usuario se utiliza para determinar el valor real.<br />Establece este valor en 0 para sobrescribir la configuración para todos los usuarios de este grupo con la configuración del foro.',
	'GROUP_OPTIONS_SAVE'			=> 'Opciones generales de grupo',
	'GROUP_PROMOTE'					=> 'Promover a responsable de Grupo',
	'GROUP_RANK'					=> 'Rango',
	'GROUP_RECEIVE_PM'				=> 'El Grupo puede recibir Mensajes Privados',
	'GROUP_RECEIVE_PM_EXPLAIN'		=> 'Por favor tenga que en cuenta que los grupos ocultos no son capaces de recibir mensajes, a pesar de esta preferencia.',
	'GROUP_REQUEST'					=> 'Solicitud',
	'GROUP_SETTINGS_SAVE'			=> 'Configuración global del Grupo',
	'GROUP_SKIP_AUTH'				=> 'Excluir al líder de grupo de los permisos',
	'GROUP_SKIP_AUTH_EXPLAIN'		=> 'Si está activada la opción el líder de grupo no heredará más los permisos del grupo.',
	'GROUP_SPECIAL'					=> 'Pre-Definido',
	'GROUP_TEAMPAGE'				=> 'Mostrar grupo en la página del equipo',
	'GROUP_TYPE'					=> 'Tipo de Grupo',
	'GROUP_TYPE_EXPLAIN'			=> 'Esto determina qué usuarios pueden ver o identificarse al grupo.',
	'GROUP_UPDATED'					=> 'Preferencias del Grupo actualizadas correctamente.',

	'GROUP_USERS_ADDED'				=> 'Nuevos usuarios añadidos al Grupo correctamente.',
	'GROUP_USERS_EXIST'				=> 'Los usuarios seleccionados ya pertenecen al grupo.',
	'GROUP_USERS_REMOVE'			=> 'Usuarios eliminados del Grupo y nuevos parámetros por defecto ajustados correctamente.',
	'GROUP_USERS_INVALID'			=> 'No se añadieron usuarios al grupo ya que no existen los siguientes nombres de usuario: %s',

	'LEGEND_EXPLAIN'				=> 'Estos son los grupos que se muestran en la leyenda de grupos:',
	'LEGEND_SETTINGS'				=> 'Ajustes de leyenda',
	'LEGEND_SORT_GROUPNAME'			=> 'Ordenar leyenda por nombre de grupo',
	'LEGEND_SORT_GROUPNAME_EXPLAIN'	=> 'El orden de abajo se ignora cuando esta opción está activada.',

	'MANAGE_LEGEND'			=> 'Administrar leyenda de grupos',
	'MANAGE_TEAMPAGE'		=> 'Administrar página del equipo',
	'MAKE_DEFAULT_FOR_ALL'	=> 'Hacer grupo por defecto para todos los usuarios',
	'MEMBERS'				=> 'Usuarios',

	'NO_GROUP'					=> 'No se especificó Grupo.',
	'NO_GROUPS_ADDED'			=> 'No se han añadidos grupos aún.',
	'NO_GROUPS_CREATED'			=> 'No se han creado grupos aún.',
	'NO_PERMISSIONS'			=> 'No copiar permisos',
	'NO_USERS'					=> 'No introdujo ningún usuario.',
	'NO_USERS_ADDED'			=> 'No se introdujeron usuarios al grupo.',
	'NO_VALID_USERS'			=> 'No ha introducido ningún usuario eligible para esa acción.',

	'PENDING_MEMBERS'			=> 'Pendiente',

	'SELECT_GROUP'				=> 'Seleccionar un grupo',
	'SPECIAL_GROUPS'			=> 'Grupos predefinidos',
	'SPECIAL_GROUPS_EXPLAIN'	=> 'Grupos predefinidos son grupos especiales, no pueden ser borrados o modificados directamente. Sin embargo puede agregar usuarios y cambiar parámetros básicos. Haciendo clic en "Por Defecto" puede definirlo como grupo principal para todos sus usuarios.',

	'TEAMPAGE'					=> 'Página del Equipo',
	'TEAMPAGE_DISP_ALL'			=> 'Todos los usuarios',
	'TEAMPAGE_DISP_DEFAULT'		=> 'Solo el grupo predeterminado del usuario',
	'TEAMPAGE_DISP_FIRST'		=> 'Solo el primer usuario',
	'TEAMPAGE_EXPLAIN'			=> 'Estos son los grupos que se muestran en la página del Equipo:',
	'TEAMPAGE_FORUMS'			=> 'Mostrar foros moderados',
	'TEAMPAGE_FORUMS_EXPLAIN'	=> 'Si se establece en sí, los Moderadores tendrán una lista que muestra todos los foros en los que tienen permiso de Moderador. Estos datos pueden ser muy pesados para foros grandes.',
	'TEAMPAGE_MEMBERSHIPS'		=> 'Mostrar usuarios',
	'TEAMPAGE_SETTINGS'			=> 'Ajustes de página Equipo',

	'TOTAL_MEMBERS'				=> 'Usuarios',

	'USERS_APPROVED'				=> 'Usuarios aprobados correctamente.',
	'USER_DEFAULT'					=> 'Por Defecto',
	'USER_DEF_GROUPS'				=> 'Grupos definidos por el usuario',
	'USER_DEF_GROUPS_EXPLAIN'		=> 'Estos son grupos creados por usted u otro administrador de este Sitio. Puede administrar pertenencias como también editar propiedades del Grupo e inclusive borrarlo. Haciendo clic en "Por Defecto" puede definirlo como grupo principal para todos sus usuarios.',
	'USER_GROUP_DEFAULT'			=> 'Definir como grupo Por Defecto',
	'USER_GROUP_DEFAULT_EXPLAIN'	=> 'Esto lo designará como Grupo Por Defecto para todos sus usuarios',
	'USER_GROUP_LEADER'				=> 'Designar responsable de Grupo',
));
