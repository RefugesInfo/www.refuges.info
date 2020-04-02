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

// User pruning
$lang = array_merge($lang, array(
	'ACP_PRUNE_USERS_EXPLAIN'	=> 'Esta opción te permite borrar o desactivar usuarios del sitio. Esto se puede hacer de varias formas: por cantidad de mensajes, última actividad, etc. Los criterios pueden combinarse para ajustar qué cuentas serán afectadas, por ejemplo: puedes purgar usuarios con menos de 10 mensajes e inactivos desde 2002-01-01.Use * como un comodín para los campos de texto. Como alternativa puedes crear una lista de usuarios directamente en la caja de texto (cada uno en una línea distinta), y se ignorará cualquier criterio. ¡Ten cuidado! Una vez que el usuario es borrado no hay forma de deshacer la acción.',

	'CRITERIA'				=> 'Criterio',

	'DEACTIVATE_DELETE'		=> 'Desactivar o borrar',
	'DEACTIVATE_DELETE_EXPLAIN'	=> 'Determina si desactivar o borrar completamente al usuario, ¡ten en cuenta que los usuarios borrados no pueden ser recuperados!',
	'DELETE_USERS'			=> 'Borrar',
	'DELETE_USER_POSTS'		=> 'Borrar mensajes de usuarios purgados',
	'DELETE_USER_POSTS_EXPLAIN'	=> 'Elimina mensajes hechos por usuarios borrados, no tiene efecto sobre usuarios desactivados.',

	'JOINED_EXPLAIN'			=> 'Introduce una fecha en el formato <kbd>AAAA-MM-DD</kbd>. Puedes utilizar los dos campos para especificar un intervalo, o deja un espacio en blanco para un rango de fechas abiertas.',

	'LAST_ACTIVE_EXPLAIN'		=> 'Introduce una fecha con el formato <kbd>AAAA-MM-DD</kbd>. Introduce <kbd>0000-00-00</kbd> para eliminar usuarios que nunca se hayan identificado, las condiciones <em>Antes de</em> y <em>Después de</em> serán ignoradas.',

	'POSTS_ON_QUEUE'			=> 'Mensajes Esperando aprobación',
	'PRUNE_USERS_GROUP_EXPLAIN'	=> 'Limitar a los usuarios dentro del grupo seleccionado.',
	'PRUNE_USERS_GROUP_NONE'	=> 'Todos los grupos',
	'PRUNE_USERS_LIST'				=> 'Usuarios para purgar',
	'PRUNE_USERS_LIST_DELETE'		=> 'Con el criterio seleccionado, las siguientes cuentas serán eliminadas. Puedes eliminar usuarios individuales de la lista de desactivación desmarcando la casilla que aparece junto a su nombre de usuario.',
	'PRUNE_USERS_LIST_DEACTIVATE'	=> 'Con el criterio seleccionado, las siguientes cuentas serán desactivadas. Puedes eliminar usuarios individuales de la lista de desactivación desmarcando la casilla que aparece junto a su nombre de usuario.',

	'SELECT_USERS_EXPLAIN'		=> 'Introduce aquí solo usuarios específicos; serán usados con preferencia sobre los criterios anteriores. Los Fundadores no pueden ser borrados.',

	'USER_DEACTIVATE_SUCCESS'	=> 'Los usuarios seleccionados han sido desactivados correctamente.',
	'USER_DELETE_SUCCESS'		=> 'Los usuarios seleccionados han sido borrados correctamente.',
	'USER_PRUNE_FAILURE'		=> 'Ningún usuario se ajusta al criterio seleccionado.',

	'WRONG_ACTIVE_JOINED_DATE'	=> 'La fecha ingresada es incorrecta, esperaba el formato <kbd>YYYY-MM-DD</kbd>.',
));

// Forum Pruning
$lang = array_merge($lang, array(
	'ACP_PRUNE_FORUMS_EXPLAIN'	=> 'Esto borrará cualquier tema que no tenga mensajes o visitas en la cantidad de días seleccionada. Si no introduces un número, se borrarán todos los temas. Por defecto, no se eliminarán temas que tengan encuestas vigentes ni se eliminarán anuncios.',

	'FORUM_PRUNE'			=> 'Purgar foro',

	'NO_PRUNE'			=> 'No se purgaron foros',

	'SELECTED_FORUM'		=> 'Foro seleccionado',
	'SELECTED_FORUMS'		=> 'Foros seleccionados',

	'POSTS_PRUNED'			=> 'Mensajes purgados',
	'PRUNE_ANNOUNCEMENTS'		=> 'Purgar anuncios',
	'PRUNE_FINISHED_POLLS'		=> 'Purgar encuestas cerradas',
	'PRUNE_FINISHED_POLLS_EXPLAIN'	=> 'Elimina temas con encuestas que han concluído.',
	'PRUNE_FORUM_CONFIRM'		=> '¿Estás seguro de querer purgar el foro seleccionado con los parámetros seleccionados? Una vez eliminado, no hay manera de recuperarlo.',
	'PRUNE_NOT_POSTED'		=> 'Días desde el último mensaje',
	'PRUNE_NOT_VIEWED'		=> 'Días desde la última visita',
	'PRUNE_OLD_POLLS'		=> 'Purgar encuestas antiguas',
	'PRUNE_OLD_POLLS_EXPLAIN'	=> 'Elimina temas con encuestas no votadas hace mucho.',
	'PRUNE_STICKY'			=> 'Purgar notas',
	'PRUNE_SUCCESS'			=> 'Foros purgados correctamente.',

	'TOPICS_PRUNED'			=> 'Temas purgados',
));
