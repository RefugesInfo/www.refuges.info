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
	'CAPTCHA_QA'               => 'Q&amp;A (Preguntas y Respuestas)',
	'CONFIRM_QUESTION_EXPLAIN' => 'Esta pregunta es una forma de evitar inserciones automatizadas por Spambots.',
	'CONFIRM_QUESTION_WRONG'   => 'Has proporcionado una respuesta incorrecta a la pregunta.',
	'CONFIRM_QUESTION_MISSING'	=> 'Las preguntas para el código de imagen no pudieron ser recuperadas. Por favor, póngase en contacto con un Administrador del foro.',

	'QUESTION_ANSWERS'		   => 'Respuestas',
	'ANSWERS_EXPLAIN'		   => 'Por favor, introduce respuestas válidas para la pregunta, una por línea.',
	'CONFIRM_QUESTION'		   => 'Pregunta',

	'ANSWER'				   => 'Respuesta',
	'EDIT_QUESTION'			   => 'Editar pregunta',
	'QUESTIONS'				   => 'Preguntas',
	'QUESTIONS_EXPLAIN'        => 'Por cada formulario de envío donde hayas habilitado el plugin Q&amp;A, a los usuarios se les formulará una de las preguntas especificadas aquí. Para usar este plugin al menos una pregunta debe ser configurada en el idioma por defecto del foro. Estas preguntas deberían ser fáciles de responder para la mayoría de sus usuarios pero más allá de la habilidad de un robot capaz de realizar una búsqueda en Google™. Solo una pregunta apropiada es necesaria. Si comienzas a recibir registros de spam, la pregunta debe cambiarse. Activa la opción de Chequeo Estricto si tu pregunta depende de tildes, mayúsculas o puntuación.',
	'QUESTION_DELETED'         => 'Pregunta eliminada',
	'QUESTION_LANG'            => 'Idioma',
	'QUESTION_LANG_EXPLAIN'    => 'El idioma en el que esta pregunta y sus respuestas están escritas.',
	'QUESTION_STRICT'          => 'Chequeo Estricto',
	'QUESTION_STRICT_EXPLAIN'  => 'Activar si quieres forzar la mezcla de mayúsculas y minúsculas, caracteres especiales de puntuación y el espacio en blanco.',

	'QUESTION_TEXT'            => 'Pregunta',
	'QUESTION_TEXT_EXPLAIN'    => 'La pregunta a presentar al usuario.',

	'QA_ERROR_MSG'			   => 'Por favor, rellena todos los campos e introduce al menos una respuesta.',
	'QA_LAST_QUESTION'		   => 'No puedes eliminar todas las preguntas mientras el plugin esté activo.',
));
