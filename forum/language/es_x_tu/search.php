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
	'ALL_AVAILABLE'			=> 'Todos los disponibles',
	'ALL_RESULTS'			=> 'Todos los resultados',

	'DISPLAY_RESULTS'		=> 'Mostrar resultados como',

	'FOUND_SEARCH_MATCHES'		=> array(
		1	=> 'Se encontró %d coincidencia',
		2	=> 'Se encontraron %d coincidencias',
	),
	'FOUND_MORE_SEARCH_MATCHES'		=> array(
		1	=> 'Se encontraron más de %d coincidencia',
		2	=> 'Se encontraron más de %d coincidencias',
	),

	'GLOBAL'				=> 'Anuncio Global',

	'IGNORED_TERMS'			=> 'Ignorado',
	'IGNORED_TERMS_EXPLAIN'	=> 'Las siguientes palabras en tu consulta fueron ignoradas porque son palabras demasiado comunes: <strong>%s</strong>',

	'JUMP_TO_POST'			=> 'Saltar al mensaje',

	'LOGIN_EXPLAIN_EGOSEARCH'	=> 'El foro requiere que estés registrado e identificado para ver tus propios mensajes.',
	'LOGIN_EXPLAIN_NEWPOSTS'	=> 'El foro requiere que estés registrado e identificado para ver nuevos mensajes desde tu última visita.',
	'LOGIN_EXPLAIN_UNREADSEARCH'=> 'El foro requiere que esté registrado e identificado para ver tus mensajes sin leer.',

	'MAX_NUM_SEARCH_KEYWORDS_REFINE'	=> array(
		1	=> 'Has especificado demasiadas palabras a buscar. Por favor, no insertes más de %1$d palabra.',
		2	=> 'Has especificado demasiadas palabras a buscar. Por favor, no insertes más de %1$d palabras.',
	),

	'NO_KEYWORDS'			=> 'Debes especificar al menos una palabra para buscar. Cada palabra debe tener al menos %s y no debe contener más de %s excluyendo los comodines.',
	'NO_RECENT_SEARCHES'	=> 'No se han realizado búsquedas recientemente',
	'NO_SEARCH'				=> 'Disculpa, no te está permitido usar el sistema de búsqueda.',
	'NO_SEARCH_RESULTS'		=> 'No se encontraron coincidencias.',
	'NO_SEARCH_LOAD'		=> 'Lo sentimos pero no se puede usar la búsqueda en este momento. El servidor tiene una alta carga. Inténtalo de nuevo más tarde.',
	'NO_SEARCH_TIME'		=> array(
		1	=> 'Disculpa, no puedes buscar en este momento. Por favor, inténtalo nuevamente en %d segundo.',
		2	=> 'Disculpa, no puedes buscar en este momento. Por favor, inténtalo nuevamente en %d segundos.',
	),
	'NO_SEARCH_UNREADS'		=> 'Disculpa, pero la búsqueda de mensajes no leídos ha sido deshabilitada en este foro.',
	'WORD_IN_NO_POST'		=> 'La palabra <strong>%s</strong> no se encuentra en ningún mensaje.',
	'WORDS_IN_NO_POST'		=> 'Las palabras <strong>%s</strong> no se encuentran en ningún mensaje.',

	'POST_CHARACTERS'		=> 'Caracteres del mensaje',
	'PHRASE_SEARCH_DISABLED'	=> 'Búsqueda por frase exacta no se admite en este foro.',

	'RECENT_SEARCHES'		=> 'Búsquedas recientes',
	'RESULT_DAYS'			=> 'Limitar resultados previos a',
	'RESULT_SORT'			=> 'Ordenar resultados por',
	'RETURN_FIRST'			=> 'Mostrar los primeros',
	'GO_TO_SEARCH_ADV'		=> 'Ir a búsqueda avanzada',

	'SEARCHED_FOR'				=> 'Término buscado',
	'SEARCHED_TOPIC'			=> 'Mensaje buscado',
	'SEARCHED_QUERY'			=> 'Consulta buscada',
	'SEARCH_ALL_TERMS'			=> 'Buscar todos los términos',
	'SEARCH_ANY_TERMS'			=> 'Buscar cualquier término',
	'SEARCH_AUTHOR'				=> 'Buscar autor',
	'SEARCH_AUTHOR_EXPLAIN'			=> 'Emplea * como comodín para coincidencias parciales.',
	'SEARCH_FIRST_POST'			=> 'Solo el primer mensaje de los temas',
	'SEARCH_FORUMS'				=> 'Buscar en Foros',
	'SEARCH_FORUMS_EXPLAIN'			=> 'Selecciona el Foro o Foros en los que deseas buscar. Para agilizar puedes buscar en los subforos seleccionando el Foro padre y habilitar la búsqueda en los subforos (en Opciones de búsqueda).',
	'SEARCH_IN_RESULTS'			=> 'Buscar en los resultados',
	'SEARCH_KEYWORDS_EXPLAIN'		=> 'Escribe <strong>+</strong> delante de una palabra a encontrar y <strong>-</strong> delante de la palabra para excluirla. Crea una lista de palabras separadas por <strong>|</strong> entre corchetes si solo una de ellas se quiere encontrar. Emplea <strong>*</strong> como comodín para coincidencias parciales.',
	'SEARCH_MSG_ONLY'			=> 'Solo el texto del mensaje',
	'SEARCH_OPTIONS'			=> 'Opciones de búsqueda',
	'SEARCH_QUERY'				=> 'Consulta',
	'SEARCH_SUBFORUMS'			=> 'Buscar en subforos',
	'SEARCH_TITLE_MSG'			=> 'Título y texto del mensaje',
	'SEARCH_TITLE_ONLY'			=> 'Solo títulos',
	'SEARCH_WITHIN'				=> 'Buscar en ',
	'SORT_ASCENDING'			=> 'Ascendente',
	'SORT_AUTHOR'				=> 'Autor',
	'SORT_DESCENDING'			=> 'Descendente',
	'SORT_FORUM'				=> 'Foro',
	'SORT_POST_SUBJECT'			=> 'Asunto del mensaje',
	'SORT_TIME'					=> 'Fecha',
	'SPHINX_SEARCH_FAILED'		=> 'Falló la búsqueda: %s',
	'SPHINX_SEARCH_FAILED_LOG'	=> 'Lo sentimos, pero no se pudo realizar la búsqueda. Más información acerca de este fallo en el registro de errores.',

	'TOO_FEW_AUTHOR_CHARS'	=> array(
		1	=> 'Debes especificar al menos %d carácter del nombre del autor.',
		2	=> 'Debes especificar al menos %d caracteres del nombre del autor.',
	),
));
