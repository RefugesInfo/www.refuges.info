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
	'APPROVE'								=> 'Aprobar',
	'ATTACHMENT'						=> 'Adjunto',
	'ATTACHMENT_FUNCTIONALITY_DISABLED'	=> 'Los adjuntos han sido deshabilitados',

	'BOOKMARK_ADDED'		=> 'Tema añadido correctamente a Favoritos.',
	'BOOKMARK_ERR'			=> 'Añadido de tema a Favoritos fallido. Por favor, inténtalo de nuevo.',
	'BOOKMARK_REMOVED'		=> 'Eliminado correctamente el tema de Favoritos.',
	'BOOKMARK_TOPIC'		=> 'Añadir tema a Favoritos',
	'BOOKMARK_TOPIC_REMOVE'	=> 'Eliminar de Favoritos',
	'BUMPED_BY'				=> 'Última reactivación por %1$s en %2$s',
	'BUMP_TOPIC'			=> 'Reactivar tema',

	'CODE'					=> 'Código',

	'DELETE_TOPIC'			=> 'Borrar tema',
	'DELETED_INFORMATION'	=> 'Borrado por %1$s el %2$s',
	'DISAPPROVE'					=> 'Desaprobar',
	'DOWNLOAD_NOTICE'		=> 'No tienes los permisos requeridos para ver los archivos adjuntos a este mensaje.',

	'EDITED_TIMES_TOTAL'	=> array(
		1	=> 'Última edición por %2$s el %3$s, editado %1$d vez en total.',
		2	=> 'Última edición por %2$s el %3$s, editado %1$d veces en total.',
	),
	'EMAIL_TOPIC'			=> 'Email sobre el tema',
	'ERROR_NO_ATTACHMENT'	=> 'El adjunto seleccionado ya no existe.',

	'FILE_NOT_FOUND_404'	=> 'El archivo <strong>%s</strong> no existe.',
	'FORK_TOPIC'			=> 'Copiar tema',
	'FULL_EDITOR'			=> 'Editor completo / Visualizar',

	'LINKAGE_FORBIDDEN'		=> 'No estás autorizado a ver, descargar o enlazar de/a este sitio.',
	'LOGIN_NOTIFY_TOPIC'	=> 'Has sido notificado sobre este tema, por favor inicia sesión para verlo.',
	'LOGIN_VIEWTOPIC'		=> 'La Administración del sitio requiere que estés registrado e identificado para ver este tema.',

	'MAKE_ANNOUNCE'				=> 'Cambiar a "Anuncio"',
	'MAKE_GLOBAL'				=> 'Cambiar a "Global"',
	'MAKE_NORMAL'				=> 'Cambiar a "Tema"',
	'MAKE_STICKY'				=> 'Cambiar a "Nota"',
	'MAX_OPTIONS_SELECT'		=> array(
		1	=> 'Puedes seleccionar <strong>%d</strong> opción',
		2	=> 'Puedes seleccionar hasta <strong>%d</strong> opciones',
	),
	'MISSING_INLINE_ATTACHMENT'	=> 'El adjunto <strong>%s</strong> ya no está disponible',
	'MOVE_TOPIC'				=> 'Mover tema',

	'NO_ATTACHMENT_SELECTED'=> 'No has seleccionado un adjunto para descargar o ver.',
	'NO_NEWER_TOPICS'		=> 'No hay temas nuevos en este foro',
	'NO_OLDER_TOPICS'		=> 'No hay temas viejos en este foro',
	'NO_UNREAD_POSTS'		=> 'No hay nuevos mensajes sin leer en este tema.',
	'NO_VOTE_OPTION'		=> 'Debes especificar una opción cuando votes.',
	'NO_VOTES'				=> 'No hay votos',
	'NO_AUTH_PRINT_TOPIC'	=> 'No estás autorizado para imprimir temas.',

	'POLL_ENDED_AT'			=> 'La encuesta terminó el %s',
	'POLL_RUN_TILL'			=> 'La encuesta continúa hasta el %s',
	'POLL_VOTED_OPTION'		=> 'Votasté por esta opción',
	'POST_DELETED_RESTORE'	=> 'Este mensaje ha sido eliminado. Puede ser restaurado.',
	'PRINT_TOPIC'			=> 'Vista para imprimir',

	'QUICK_MOD'				=> 'Herramientas de Moderación Rápida',
	'QUICKREPLY'			=> 'Respuesta Rápida',
	'QUOTE'					=> 'Citar',

	'REPLY_TO_TOPIC'		=> 'Responder al tema',
	'RESTORE'				=> 'Restaurar',
	'RESTORE_TOPIC'			=> 'Restaurar tema',
	'RETURN_POST'			=> '%sVolver al mensaje%s',

	'SUBMIT_VOTE'			=> 'Enviar voto',

	'TOPIC_TOOLS'			=> 'Herramientas de Tema',
	'TOTAL_VOTES'			=> 'Votos totales',

	'UNLOCK_TOPIC'			=> 'Desbloquear tema',

	'VIEW_INFO'				=> 'Detalles',
	'VIEW_NEXT_TOPIC'		=> 'Tema siguiente',
	'VIEW_PREVIOUS_TOPIC'	=> 'Tema anterior',
	'VIEW_RESULTS'			=> 'Ver resultados',
	'VIEW_TOPIC_POSTS'		=> array(
		1	=> '%d mensaje',
		2	=> '%d mensajes',
	),
	'VIEW_UNREAD_POST'		=> 'Primer mensaje sin leer',
	'VOTE_SUBMITTED'		=> 'Tu voto ha sido enviado',
	'VOTE_CONVERTED'		=> 'El cambio de voto no está soportado en encuestas convertidas.',

));
