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
	'ACP_MASS_EMAIL_EXPLAIN'	=> 'Desde aquí puedes enviar un email a todos los usuarios, o a los usuarios de un grupo específico. Para esto se enviará un email a la dirección administrativa proporcionada, con copia oculta a todos los receptores. Si el grupo de personas es muy grande, por favor se paciente después de pulsar en "Enviar" y no detengas el proceso por la mitad. Es normal que enviar un email masivo lleve algún tiempo, serás notificado cuando se complete el proceso',
	'ALL_USERS'					=> 'Todos los usuarios',

	'COMPOSE'				=> 'Escribir',

	'EMAIL_SEND_ERROR'		=> 'Hubo uno o más errores mientras enviaba el email. Por favor, verifica el %sLog de Errores%s para más detalles.',
	'EMAIL_SENT'			=> 'El mensaje ha sido enviado.',
	'EMAIL_SENT_QUEUE'		=> 'El mensaje ha sido aceptado para su envio.',

	'LOG_SESSION'			=> 'Registrar sesión de email en Registro de errores',

	'SEND_IMMEDIATELY'		=> 'Enviar de inmediato',
	'SEND_TO_GROUP'			=> 'Enviar a grupo',
	'SEND_TO_USERS'			=> 'Enviar a usuarios',
	'SEND_TO_USERS_EXPLAIN'	=> 'Introducir nombres aquí invalida cualquier grupo seleccionado arriba. Introduce cada nombre de usuario en una nueva línea.',
	'MAIL_BANNED'			=> 'Email a usuarios excluidos',
	'MAIL_BANNED_EXPLAIN'	=> 'Cuando se envía un correo electrónico masivo a un grupo se puede elegir si los usuarios excluidos recibirán el email.',

	'MAIL_HIGH_PRIORITY'	=> 'Alta',
	'MAIL_LOW_PRIORITY'		=> 'Baja',
	'MAIL_NORMAL_PRIORITY'	=> 'Normal',
	'MAIL_PRIORITY'			=> 'Prioridad',
	'MASS_MESSAGE'			=> 'Su mensaje',
	'MASS_MESSAGE_EXPLAIN'	=> 'Por favor, ten en cuenta que solo puede insertarse texto plano. Se eliminará cualquier código antes de enviar.',

	'NO_EMAIL_MESSAGE'		=> 'Tienes que introducir un mensaje.',
	'NO_EMAIL_SUBJECT'		=> 'Tienes que especificar un tema para su mensaje.',
));
