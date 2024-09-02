<?php
/**
 *
 * Prime Links. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, Ken F. Innes IV, https://www.absoluteanime.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 * @translated by Raul [TheE KuKa] https://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=94590
 *
 */

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
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
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_PRIMELINKS_TITLE'						=> 'Prime Links',
	'ACP_PRIMELINKS_SETTINGS'					=> 'Ajustes de Prime Links',
	'ACP_PRIMELINKS_BASIC_SETTINGS'				=> 'Ajustes Generales',
	'ACP_PRIMELINKS_ADV_SETTINGS'				=> 'Ajustes Avanzados',
	'ACP_PRIMELINKS_SETTINGS_SAVED'				=> '¡Los ajustes de Prime Links han sido guardados correctamente!',
	'ACP_PRIMELINKS_SETTINGS_LOG'				=> '<strong>Ajustes de Prime Links alterados</strong>',
	'ACP_PRIMELINKS_INTERNAL_LINKS'				=> 'Enlaces locales',
	'ACP_PRIMELINKS_EXTERNAL_LINKS'				=> 'Enlaces extenos',
	'ACP_PRIMELINKS_EXAMPLE'					=> 'p.ej. ',	// Examples follow directly after this, so you may want a trailing space

	'ACP_PRIMELINKS_ENABLE_GENERAL'				=> 'Habilitar procesamiento de enlaces',
	'ACP_PRIMELINKS_ENABLE_GENERAL_EXPLAIN'		=> 'Permite el procesamiento de enlaces para mensajes, mensajes privados y otros bloques de texto analizados',

	'ACP_PRIMELINKS_ENABLE_STYLE'				=> 'Habilitar estilo',
	'ACP_PRIMELINKS_ENABLE_STYLE_EXPLAIN'		=> 'Habilita el archivo CSS incluido y las imágenes para diseñar enlaces.',

	'ACP_PRIMELINKS_ENABLE_FORUMLIST'			=> 'Habilitar para la lista del foro',
	'ACP_PRIMELINKS_ENABLE_FORUMLIST_EXPLAIN'	=> 'Añade atributos de enlace externo a los enlaces de la lista del foro (tipo de foro del foro establecido en <strong>Enlace</strong>). Esto en realidad no analiza ni procesa la URL del enlace, simplemente se trata como un enlace externo.',

	'ACP_PRIMELINKS_ENABLE_MEMBERS'				=> 'Habilitar para sitios web de los miembros',
	'ACP_PRIMELINKS_ENABLE_MEMBERS_EXPLAIN'		=> 'Añade atributos de enlace externo al enlace del sitio web del miembro en las páginas de perfil y la página de la lista de miembros. Esto en realidad no analiza ni procesa la URL del enlace, simplemente se trata como un enlace externo.',

	'ACP_PRIMELINKS_LINK_GUEST_HIDE'			=> 'Eliminar enlaces para invitados',
	'ACP_PRIMELINKS_LINK_GUEST_HIDE_EXPLAIN'	=> 'Los enlaces se eliminarán para los invitados. El texto del enlace permanecerá a menos que sea reemplazado por un mensaje.',
	'ACP_PRIMELINKS_LINK_GUEST_HIDE_REPLACE'	=> 'Reemplazar con un mensaje.',

	'ACP_PRIMELINKS_LINK_PREFIX'				=> 'Prefijo de URL de enlace',
	'ACP_PRIMELINKS_LINK_PREFIX_EXPLAIN'		=> 'Esto se antepondrá a una URL de enlace.',
	'ACP_PRIMELINKS_INLINK_PREFIX_EXAMPLE'		=> '<samp>http://adf.ly/</samp>',
	'ACP_PRIMELINKS_EXLINK_PREFIX_EXAMPLE'		=> '<samp>http://anonym.to?</samp>',

	'ACP_PRIMELINKS_INLINK_DOMAINS'				=> 'Dominios locales',
	'ACP_PRIMELINKS_INLINK_DOMAINS_EXPLAIN'		=> 'Los enlaces con estos dominios se considerarán como si fueran enlaces locales. No necesita especificar el dominio del foro.',
	'ACP_PRIMELINKS_INLINK_DOMAINS_EXAMPLE'		=> '<samp>www.alt-local-domain.com</samp>',

	'ACP_PRIMELINKS_FORBIDDEN_DOMAINS'			=> 'Dominios prohibidos',
	'ACP_PRIMELINKS_FORBIDDEN_DOMAINS_EXPLAIN'	=> 'Los enlaces con estos dominios serán eliminados. El texto del enlace permanecerá a menos que también habilite el Mensaje prohibido.',
	'ACP_PRIMELINKS_FORBIDDEN_DOMAINS_EXAMPLE'	=> '<samp>www.forbidden-domain.com</samp>',

	'ACP_PRIMELINKS_FORBIDDEN_MSG'				=> 'Mensaje prohibido',
	'ACP_PRIMELINKS_FORBIDDEN_MSG_EXPLAIN'		=> 'Reemplazar el texto de los enlaces prohibidos con un mensaje.',

	'ACP_PRIMELINKS_FORBIDDEN_NEW_URL'			=> 'URL de reemplazo',
	'ACP_PRIMELINKS_FORBIDDEN_NEW_URL_EXPLAIN'	=> 'Reemplaza la URL de cualquier enlace prohibido que se haya eliminado. Puede ser una URL completa o una URL relativa.',
	'ACP_PRIMELINKS_FORBIDDEN_NEW_URL_EXAMPLE'	=> '<samp>forbidden-list.php</samp>',

	'ACP_PRIMELINKS_LINK_REL'					=> 'Relación de enlace',
	'ACP_PRIMELINKS_LINK_REL_EXPLAIN'			=> 'El atributo rel especificado se aplicará a los enlaces, especificando la relación entre el documento actual y el documento vinculado. Por ejemplo, un valor de <samp>nofollow</samp> indica que el enlace no está endosado.',
	'ACP_PRIMELINKS_INLINK_REL_EXAMPLE'			=> '<samp>follow</samp>',
	'ACP_PRIMELINKS_EXLINK_REL_EXAMPLE'			=> '<samp>nofollow</samp>',

	'ACP_PRIMELINKS_LINK_TARGET'				=> 'Objetivo del enlace',
	'ACP_PRIMELINKS_LINK_TARGET_EXPLAIN'		=> 'El atributo de destino especificado se aplicará a los enlaces, especificando dónde se abrirá el enlace. Por ejemplo, un valor de <samp>_blank</samp> abrirá el enlace en una nueva ventana.',
	'ACP_PRIMELINKS_INLINK_TARGET_EXAMPLE'		=> '<samp>_self</samp>',
	'ACP_PRIMELINKS_EXLINK_TARGET_EXAMPLE'		=> '<samp>_blank</samp>',

	'ACP_PRIMELINKS_LINK_CLASS'					=> 'Clase de enlace',
	'ACP_PRIMELINKS_LINK_CLASS_EXPLAIN'			=> 'Los nombres de clase especificados se aplicarán a los enlaces, lo que le permite diseñarlos desde dentro de los archivos CSS. Ingrese uno o más nombres de clases, separados por espacios. Déjelo en blanco para usar el predeterminado del foro.',
	'ACP_PRIMELINKS_INLINK_CLASS_EXAMPLE'		=> '<samp>postlink-local</samp>',
	'ACP_PRIMELINKS_EXLINK_CLASS_EXAMPLE'		=> '<samp>postlink</samp>',

	'ACP_PRIMELINKS_SKIP_REGEX'					=> 'Omitir enlaces RegEx',
	'ACP_PRIMELINKS_SKIP_REGEX_EXPLAIN'			=> 'Las URL que coincidan con esta expresión regular no se procesarán.',
	'ACP_PRIMELINKS_SKIP_REGEX_EXAMPLE'			=> '<samp>/\.(?:rar|zip|tar)(?:[#?]|$)/</samp>',

	'ACP_PRIMELINKS_INLINK_REGEX'				=> 'Enlaces internos RegEx',
	'ACP_PRIMELINKS_INLINK_REGEX_EXPLAIN'		=> 'Las URL que coincidan con esta expresión regular se considerarán enlaces internos.',
	'ACP_PRIMELINKS_INLINK_REGEX_EXAMPLE'		=> '<samp>/\.(?:gif|jpg|png)(?:[#?]|$)/</samp>',

	'ACP_PRIMELINKS_EXLINK_REGEX'				=> 'Enlaces externos RegEx',
	'ACP_PRIMELINKS_EXLINK_REGEX_EXPLAIN'		=> 'Las URL que coincidan con esta expresión regular se considerarán enlaces externos.',
	'ACP_PRIMELINKS_EXLINK_REGEX_EXAMPLE'		=> '<samp>/\.(?:pdf|doc|wpd)(?:[#?]|$)/</samp>',

	'ACP_PRIMELINKS_SKIP_PREFIX_REGEX'			=> 'Prefijo de omisión RegEx',
	'ACP_PRIMELINKS_SKIP_PREFIX_REGEX_EXPLAIN'	=> 'Las URL que coincidan con esta expresión regular no tendrán el prefijo de enlace aplicado.',
	'ACP_PRIMELINKS_SKIP_PREFIX_REGEX_EXAMPLE'	=> '<samp>/^www\.absoluteanime\.com)/</samp>',

	'ACP_PRIMELINKS_INLINK_USE_TITLES'			=> 'Mostrar títulos en lugar de la URL',
	'ACP_PRIMELINKS_INLINK_USE_TITLES_EXPLAIN'	=> 'Muestra el asunto del mensaje, el título del tema o el nombre del foro en lugar de la URL (por ejemplo cambia <strong>viewtopic.php?t=1</strong> a <strong>Mi tema</strong>).',
));
