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

// Custom profile fields
$lang = array_merge($lang, array(
	'ADDED_PROFILE_FIELD'	=> 'Campo de perfil personalizado añadido correctamente.',
	'ALPHA_DOTS'			=> 'Alfanumérico y puntos (períodos)',
	'ALPHA_ONLY'			=> 'Alfanumérico solamente',
	'ALPHA_SPACERS'			=> 'Alfanumérico y espacios',
	'ALPHA_UNDERSCORE'		=> 'Alfanumérico y guiones',
	'ALPHA_PUNCTUATION'		=> 'Alfanumérico con comas, puntos, guiones y guiones que comienza con una letra',
	'ALWAYS_TODAY'			=> 'Siempre la fecha actual',

	'BOOL_ENTRIES_EXPLAIN'	=> 'Introduzca sus opciones ahora',
	'BOOL_TYPE_EXPLAIN'		=> 'Definir el tipo, un checkbox o botón radio',

	'CHANGED_PROFILE_FIELD'		=> 'Campo personalizado cambiado correctamente.',
	'CHARS_ANY'					=> 'Cualquier caracter',
	'CHECKBOX'					=> 'Checkbox',
	'COLUMNS'					=> 'Columnas',
	'CP_LANG_DEFAULT_VALUE'		=> 'Valor por defecto',
	'CP_LANG_EXPLAIN'			=> 'Descripción del campo',
	'CP_LANG_EXPLAIN_EXPLAIN'	=> 'Explicación para este campo presentada al usuario',
	'CP_LANG_NAME'				=> 'Nombre/título para este campo presentado al usuario',
	'CP_LANG_OPTIONS'			=> 'Opciones',
	'CREATE_NEW_FIELD'			=> 'Crear nuevo campo',
	'CUSTOM_FIELDS_NOT_TRANSLATED'	=> 'Al menos un campo de perfil personalizado no ha sido traducido aún. Por favor, inserte la información requerida haciendo clic en &quot;Traducir&quot;.',

	'DEFAULT_ISO_LANGUAGE'			=> 'Idioma por defecto [%1$s]',
	'DEFAULT_LANGUAGE_NOT_FILLED'	=> 'Las definiciones para el idioma por defecto no están completas para este campo de perfil.',
	'DEFAULT_VALUE'					=> 'Valor por defecto',
	'DELETE_PROFILE_FIELD'			=> 'Eliminar campo de perfil',
	'DELETE_PROFILE_FIELD_CONFIRM'	=> '¿Seguro que quiere borrar este campo de perfil?',
	'DISPLAY_AT_PROFILE'			=> 'Mostrar en Panel de Control del Usuario',
	'DISPLAY_AT_PROFILE_EXPLAIN'	=> 'El usuario es capaz de cambiar este campo de perfil desde el Panel de Control del Usuario.',
	'DISPLAY_AT_REGISTER'			=> 'Mostrar en la pantalla de registro',
	'DISPLAY_AT_REGISTER_EXPLAIN'	=> 'Si esta opción está habilitada el campo se mostrará en el formulario de registro.',
	'DISPLAY_ON_MEMBERLIST'			=> 'Mostrar en lista de usuarios',
	'DISPLAY_ON_MEMBERLIST_EXPLAIN'	=> 'Si se activa esta opción, el campo se mostrará en pantalla en la lista de usuarios.',	
	'DISPLAY_ON_PM'					=> 'Mostrar en la vista de pantalla de mensajes privados',
	'DISPLAY_ON_PM_EXPLAIN'			=> 'Si habilita está opción, el campo será mostrado en el mini-perfil de la pantalla de mensajes privados.',
	'DISPLAY_ON_VT'					=> 'Mostrar en la pantalla del tema',
	'DISPLAY_ON_VT_EXPLAIN'			=> 'Si esta opción está habilitada el campo será mostrado en el mini-perfil en la pantalla del tema.',
	'DISPLAY_PROFILE_FIELD'			=> 'Mostrar campo de perfil públicamente',
	'DISPLAY_PROFILE_FIELD_EXPLAIN'	=> 'El campo de perfil se mostrará en todos los lugares disponibles dentro la configuración/parámetros de carga. Configurar esto como “no” ocultará el campo de las páginas de los temas, perfiles y lista de miembros.',
	'DROPDOWN_ENTRIES_EXPLAIN'		=> 'Introduzca sus opciones ahora, cada opción en una línea aparte',

	'EDIT_DROPDOWN_LANG_EXPLAIN'	=> 'Por favor fíjese en que puede cambiar sus opciones y también añadir nuevas opciones al final. No es recomendable agregar nuevas opciones _entre_ las existentes - esto podria causar una asignación incorrecta de las opciones a los usuarios. También podría ocurrir si borra opciones intermedias. Borrar las opciones desde la última significa que usuarios asignados a este ítem volverán a sus opciones por defecto.',
	'EMPTY_FIELD_IDENT'				=> 'Notificación de campo vacío',
	'EMPTY_USER_FIELD_NAME'			=> 'Por favor introduzca un nombre/título para el campo',
	'ENTRIES'						=> 'Entradas',
	'EVERYTHING_OK'					=> 'Todo OK',

	'FIELD_BOOL'				=> 'Lógico (Sí/No)',
	'FIELD_CONTACT_DESC'		=> 'Descripción de contacto',
	'FIELD_CONTACT_URL'			=> 'Enlace de contacto',
	'FIELD_DATE'				=> 'Fecha',
	'FIELD_DESCRIPTION'			=> 'Descripción del campo',
	'FIELD_DESCRIPTION_EXPLAIN'	=> 'La explicación para el campo presentada al usuario',
	'FIELD_DROPDOWN'			=> 'Selección desplegable',
	'FIELD_GOOGLEPLUS'			=> 'Google+',
	'FIELD_IDENT'				=> 'Identificación del campo',
	'FIELD_IDENT_ALREADY_EXIST'	=> 'La identificación elegida para el campo ya existe. Por favor, elija otro nombre.',
	'FIELD_IDENT_EXPLAIN'		=> 'La identificación del campo es un nombre para identificar el campo de perfil en la base de datos y plantillas.',
	'FIELD_INT'					=> 'Números',
	'FIELD_IS_CONTACT'			=> 'Campo a Mostrar como un campo de contacto',
	'FIELD_IS_CONTACT_EXPLAIN'	=> 'Campos de contacto son mostrados  en la sección de contactos del perfil de usuario y se muestran de manera diferente en el mini perfil junto a respuestas y mensajes privados. Puede usar <samp>%s</samp> como una variable de marcador de posición que será sustituida por un valor proporcionado por el usuario.',
	'FIELD_LENGTH'				=> 'Longitud del campo',
	'FIELD_NOT_FOUND'			=> 'Campo de perfil no encontrado.',
	'FIELD_STRING'				=> 'Campo de texto simple',
	'FIELD_TEXT'				=> 'Área de texto',
	'FIELD_TYPE'				=> 'Tipo de campo',
	'FIELD_TYPE_EXPLAIN'		=> 'No podrá cambiar este tipo de campo más adelante.',
	'FIELD_URL'					=> 'URL (Enlace)',
	'FIELD_VALIDATION'			=> 'Validación de campo',
	'FIRST_OPTION'				=> 'Primera opción',

	'HIDE_PROFILE_FIELD'			=> 'Ocultar campo de perfil',
	'HIDE_PROFILE_FIELD_EXPLAIN'	=> 'Oculta el campo de perfil de todos los usuarios, excepto los Administradores y Moderadores, que aún podrán ver este campo. Si la opción Mostrar en el panel de control del usuario está deshabilitada, el usuario no podrá ver ni cambiar este campo y solo los Administradores podrán cambiar el campo.',

	'INVALID_CHARS_FIELD_IDENT'	=> 'El campo de identificación solamente puede contener minúsculas a-z y guión bajo _',
	'INVALID_FIELD_IDENT_LEN'	=> 'El campo de identificación solamente puede tener 17 caracteres de longitud',
	'ISO_LANGUAGE'				=> 'Idioma [%s]',

	'LANG_SPECIFIC_OPTIONS'		=> 'Opciones específicas de idioma [<strong>%1$s</strong>]',

	'LETTER_NUM_DOTS'			=> 'Cualquier letra, números y puntos (períodos)',
	'LETTER_NUM_ONLY'			=> 'Cualquier letra y números',
	'LETTER_NUM_PUNCTUATION'	=> 'Cualquier letra, números, coma, puntos, guión bajo y guiones que comiencen con cualquier letra',
	'LETTER_NUM_SPACERS'		=> 'Cualquier letra, números y espacios',
	'LETTER_NUM_UNDERSCORE'		=> 'Cualquier letra, números y guión bajo',

	'MAX_FIELD_CHARS'			=> 'Número máximo de caracteres',
	'MAX_FIELD_NUMBER'			=> 'Número más alto permitido',
	'MIN_FIELD_CHARS'			=> 'Número mínimo de caracteres',
	'MIN_FIELD_NUMBER'			=> 'Número más bajo permitido',

	'NO_FIELD_ENTRIES'			=> 'No se definieron entradas',
	'NO_FIELD_ID'				=> 'No se especificó ID del campo.',
	'NO_FIELD_TYPE'				=> 'No se especificó tipo de campo.',
	'NO_VALUE_OPTION'			=> 'Opción "campo vacío"',
	'NO_VALUE_OPTION_EXPLAIN'	=> 'Valor para una no-entrada. Si el campo es obligatorio, el usuario recibe un error si elige la opción seleccionada aquí',
	'NUMBERS_ONLY'				=> 'Solo números (0-9)',

	'PROFILE_BASIC_OPTIONS'		=> 'Opciones básicas',
	'PROFILE_FIELD_ACTIVATED'	=> 'Campo de perfil activado con éxito.',
	'PROFILE_FIELD_DEACTIVATED'	=> 'Campo de perfil desactivado con éxito.',
	'PROFILE_LANG_OPTIONS'		=> 'Opciones específicas de idioma',
	'PROFILE_TYPE_OPTIONS'		=> 'Opciones específicas de tipo de perfil',

	'RADIO_BUTTONS'				=> 'Botones radio',
	'REMOVED_PROFILE_FIELD'		=> 'Campo de perfil eliminado con éxito.',
	'REQUIRED_FIELD'			=> 'Campo obligatorio',
	'REQUIRED_FIELD_EXPLAIN'	=> 'Fuerza que el campo del perfil sea rellenado o especificado por el usuario o La Administración. Si la opción de Mostrar en la pantalla de registro está habilitada el campo solo será requerido cuando el usuario edite su perfil.',
	'ROWS'						=> 'Filas',

	'SAVE'							=> 'Guardar',
	'SECOND_OPTION'					=> 'Segunda opción',
	'SHOW_NOVALUE_FIELD'			=> 'Mostrar el campo si no fue seleccionado un valor',
	'SHOW_NOVALUE_FIELD_EXPLAIN'	=> 'Determina si el campo de perfil que se debe mostrar si no fue seleccionado un valor para los campos opcionales, o si no ha seleccionado un valor aún para los campos obligatorios.',
	'STEP_1_EXPLAIN_CREATE'			=> 'Aquí puede insertar los primeros parámetros básicos de su nuevo campo de perfil. Esta información es necesaria para el segundo paso donde puede identificarse las opciones restantes y hacer una vista previa o más ajustes.',
	'STEP_1_EXPLAIN_EDIT'			=> 'Aquí puede cambiar los parámetros básicos del campo de perfil. Las opciones relevantes son recalculadas en el segundo paso, donde puede hacer una vista previa y probar los parámetros cambiados.',
	'STEP_1_TITLE_CREATE'			=> 'Crear campo de perfil',
	'STEP_1_TITLE_EDIT'				=> 'Editar título del campo',
	'STEP_2_EXPLAIN_CREATE'			=> 'Aquí puede definir algunas opciones comunes. Más adelante puede hacer una vista previa del campo, tal como lo vería el usuario. Vaya probando hasta que quede como desee.',
	'STEP_2_EXPLAIN_EDIT'			=> 'Aquí puede cambiar algunas opciones comunes. Más adelante puede hacer una vista previa de los cambios, tal como lo vería el usuario. Pruebe hasta que quede como usted desee.<br /><strong>Por favor, obsérvese que estos cambios no afectarán a los perfiles existentes de los usuarios.</strong>',
	'STEP_2_TITLE_CREATE'			=> 'Opciones específicas del tipo de perfil',
	'STEP_2_TITLE_EDIT'				=> 'Opciones específicas del tipo de perfil',
	'STEP_3_EXPLAIN_CREATE'			=> 'Ya que tienes más de un idioma instalado para el sitio, has de completar los elementos en los idiomas restantes. Si no lo haces, entonces se usará la configuración de idioma predeterminada para este campo de perfil personalizado, puedes completar los elementos de idioma restantes más tarde.',
	'STEP_3_EXPLAIN_EDIT'			=> 'Ya que tienes más de un idioma instalado para el sitio, has de cambiar los elementos en los idiomas restantes. Si no lo haces, se utilizará la configuración de idioma predeterminada para este campo de perfil personalizado.',
	'STEP_3_TITLE_CREATE'			=> 'Definiciones de idioma restantes',
	'STEP_3_TITLE_EDIT'				=> 'Definiciones de idioma',
	'STRING_DEFAULT_VALUE_EXPLAIN'	=> 'Introduzca una palabra por defecto para mostrar, un valor por defecto. Déjelo vacío si quiere que se muestre vacío en primer término.',

	'TEXT_DEFAULT_VALUE_EXPLAIN'	=> 'Introduzca un texto por defecto para mostrar, un valor por defecto. Déjelo vacío si quiere que se muestre vacío en primer término.',
	'TRANSLATE'						=> 'Traducir',

	'USER_FIELD_NAME'	=> 'Campo nombre/título mostrado al usuario',

	'VISIBILITY_OPTION'				=> 'Opciones de visibilidad',
));
