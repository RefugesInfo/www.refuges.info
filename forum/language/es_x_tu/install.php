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

// Common installer pages
$lang = array_merge($lang, array(
	'INSTALL_PANEL'	=> 'Panel de Instalación',
	'SELECT_LANG'	=> 'Seleccionar idioma',

	'STAGE_INSTALL'	=> 'Instalación de phpBB',

	// Introduction page
	'INTRODUCTION_TITLE'	=> 'Introducción',
	'INTRODUCTION_BODY'		=> '¡Bienvenido a phpBB3!<br /><br />phpBB® es la solución de foros de código abierto más utilizado en el mundo. phpBB3 es la última entrega de una línea de paquetes que comenzó en el año 2000. Al igual que sus predecesores, phpBB3 tiene varias características, fácil de usar y totalmente apoyado por el Equipo de phpBB. phpBB3 mejora en gran medida de lo que hizo phpBB2 popular, y añade las funciones más solicitadas que no estaban presentes en versiones anteriores. Esperamos que supere sus expectativas.<br /><br />Este sistema de instalación le guiará a instalar phpBB3, actualizar a la última versión de phpBB3 de pasados lanzamientos, así como la conversión a phpBB3 desde un sistema de foros diferentes (incluyendo phpBB2). Para obtener más información, te invitamos a leer <a href="../docs/INSTALL.html">la guía de instalación</a>.<br /><br />Para leer la licencia de phpBB3 o aprender acerca de cómo obtener soporte y nuestra postura sobre ello, por favor, selecciona una de las opciones correspondientes en el menú lateral. Para continuar, selecciona la pestaña correspondiente.',

	// Support page
	'SUPPORT_TITLE'		=> 'Soporte',
	'SUPPORT_BODY'		=> 'Se proporcionará soporte completo para la versión estable actual de phpBB3, de forma gratuita. Esto incluye:</p><ul><li>instalación</li><li>configuración</li><li>cuestiones técnicas</li><li>problemas relacionados con errores potenciales en el software</li><li>actualizaciones de las versiones Release Candidate (RC) a la última versión estable</li><li>conversiones desde phpBB 2.0.x a phpBB3</li><li>conversiones desde otros software de foros a phpBB3 (por favor, consulte el <a href="https://www.phpbb.com/community/viewforum.php?f=486">Foro de Conversiones</a>)</li></ul><p>Animamos a los usuarios que todavía trabajan con versiones Beta de phpBB3, el reemplazar su instalación con una nueva copia de la última versión.</p><h2>Extensiones / Estilos</h2><p>Para cuestiones relacionadas con extensiones, por favor, escriba en el <a href="https://www.phpbb.com/community/viewforum.php?f=451">Foro de Extensiones</a>.<br />Para cuestiones relacionadas con estilos, plantillas y temas, por favor, escriba en el <a href="https://www.phpbb.com/community/viewforum.php?f=471">Foro de Estilos</a>.<br /><br />Si su pregunta se refiere a un paquete específico, por favor, escriba directamente en el tema dedicado al paquete.</p><h2>Obtención de Soporte</h2><p><a href="https://www.phpbb.com/support/">Sección de Soporte</a><br /><a href="https://www.phpbb.com/support/docs/en/3.2/ug/quickstart/">Guía de Inicio Rápido</a> (en inglés).<br /><br />Para asegurarse de estar al día con las últimas noticias y lanzamientos, síganos en <a href="https://www.twitter.com/phpbb/">Twitter</a> y <a href="https://www.facebook.com/phpbb/">Facebook</a><br /><br />',

	// License
	'LICENSE_TITLE'		=> 'Licencia Pública General',

	// Install page
	'INSTALL_INTRO'	=> 'Bienvenido a la Instalación',
	'INSTALL_INTRO_BODY'		=> 'Con esta opción, es posible instalar phpBB en tú servidor.</p><p>Para proceder, necesitas los datos de configuración de su base de datos. Si no conoces los datos de configuración de su base de datos, por favor, contacta con tu proveedor de hosting y pregúntale. No podrás continuar sin ellos. Necesitas:</p>
	<ul>
		<li>El tipo de base de datos - la base de datos que vas a usar.</li>
		<li>El nombre de servidor o DSN - la dirección del servidor.</li>
		<li>El puerto del servidor - (la mayoría de las veces no se necesita).</li>
		<li>El nombre - El nombre de la base de datos en el servidor.</li>
		<li>Usuario y clave - los datos para identificarse en la base de datos.</li>
	</ul>

	<p><strong>Nota:</strong> Si instalas usando SQLite, deberías ingresar la ruta completa al archivo de tú base de datos en el campo DSN y dejar los campos usuario y clave en blanco. Por razones de seguridad, debería asegurarse de que el archivo de la base de datos no está alojado en una carpeta accesible desde la web.</p>

	<p>phpBB3 soporta las siguientes bases de datos:</p>
	<ul>
		<li>MySQL 3.23 ó superior (MySQLi también)</li>
		<li>PostgreSQL 8.3+</li>
        	<li>SQLite 3.6.15+</li>
		<li>MS SQL Server 2000 ó superior (directamente o vía ODBC)</li>
		<li>MS SQL Server 2005 ó superior (nativo)</li>
		<li>Oracle</li>
	</ul>

	<p>Se mostrarán solamente las bases de datos soportadas por su servidor.',
	'ACP_LINK'	=> 'Lléveme al <a href="%1$s">PCA</a>',

	'INSTALL_PHPBB_INSTALLED'		=> 'phpBB ya está instalado.',
	'INSTALL_PHPBB_NOT_INSTALLED'	=> 'phpBB aún no está instalado.',
));

// Requirements translation
$lang = array_merge($lang, array(
	// Filesystem requirements
	'FILE_NOT_EXISTS'			=> 'El archivo no existe',
	'FILE_NOT_EXISTS_EXPLAIN'	=> 'Para poder instalar phpBB el archivo %1$s debe existir.',
	'FILE_NOT_EXISTS_EXPLAIN_OPTIONAL'	=> 'Se recomienda que el archivo %1$s exista para una mejor experiencia del usuario del foro.',
	'FILE_NOT_WRITABLE'			=> 'No se puede escribir en el archivo',
	'FILE_NOT_WRITABLE_EXPLAIN'	=> 'Para poder instalar phpBB se debe poder escribir en el archivo %1$s.',
	'FILE_NOT_WRITABLE_EXPLAIN_OPTIONAL'	=> 'Se recomienda que el archivo %1$s se pueda escribir para una mejor experiencia del usuario del foro.',

	'DIRECTORY_NOT_EXISTS'			=> 'El directorio no existe',
	'DIRECTORY_NOT_EXISTS_EXPLAIN'		=> 'Para poder instalar phpBB el directorio %1$s debe existir.',
	'DIRECTORY_NOT_EXISTS_EXPLAIN_OPTIONAL'	=> 'Se recomienda que el directorio %1$s exista para una mejor experiencia del usuario del foro.',
	'DIRECTORY_NOT_WRITABLE'		=> 'No se puede escribir en el directorio',
	'DIRECTORY_NOT_WRITABLE_EXPLAIN'	=> 'Para poder instalar phpBB se debe poder escribir en el directorio %1$s.',
	'DIRECTORY_NOT_WRITABLE_EXPLAIN_OPTIONAL'	=> 'Se recomienda que el directorio %1$s se pueda escribir para una mejor experiencia del usuario del foro.',

	// Server requirements
	'PHP_VERSION_REQD'					=> 'Versión PHP',
	'PHP_VERSION_REQD_EXPLAIN'			=> 'phpBB requiere la versión 5.4.0 de PHP o superior.',
	'PHP_GETIMAGESIZE_SUPPORT'			=> 'La función PHP getimagesize() es requerida',
	'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'	=> 'Para que phpBB funcione correctamente, la función getimagesize debe estar disponible.',
	'PCRE_UTF_SUPPORT'					=> 'Soporte PCRE UTF-8',
	'PCRE_UTF_SUPPORT_EXPLAIN'			=> 'phpBB no se ejecutará si la instalación de PHP no está compilado con soporte UTF-8 en la extensión PCRE.',
	'PHP_JSON_SUPPORT'					=> 'Soporte PHP JSON',
	'PHP_JSON_SUPPORT_EXPLAIN'			=> 'Para que phpBB funcione correctamente, la extensión PHP JSON debe estar disponible.',
	'PHP_XML_SUPPORT'					=> 'Soporte PHP XML/DOM',
	'PHP_XML_SUPPORT_EXPLAIN'			=> 'Para que phpBB funcione correctamente, la extensión PHP XML/DOM debe estar disponible.',
	'PHP_SUPPORTED_DB'					=> 'Bases de datos soportadas',
	'PHP_SUPPORTED_DB_EXPLAIN'			=> 'Debe tener soporte de al menos una base de datos compatible con PHP. Si se muestran los módulos de base de datos como no disponibles, deberá comunicarse con su proveedor de hosting, o revise la documentación de instalación de PHP relevante.',

	'RETEST_REQUIREMENTS'	=> 'Probar de nuevo los requerimientos',

	'STAGE_REQUIREMENTS'	=> 'Comprobar requerimientos',
));

// General error messages
$lang = array_merge($lang, array(
	'INST_ERR_MISSING_DATA'		=> 'Tiene que llenar todos los campos en este bloque.',

	'TIMEOUT_DETECTED_TITLE'	=> 'El instalador detecta un tiempo de espera',
	'TIMEOUT_DETECTED_MESSAGE'	=> 'El instalador detecta un tiempo de espera, puedes tratar de actualizar la página, lo que puede conducir a la corrupción de datos. Te sugerimos que o bien aumentes la configuración de tiempo de espera, o intentes utilizar el CLI.',
));

// Data obtaining translations
$lang = array_merge($lang, array(
	'STAGE_OBTAIN_DATA'	=> 'Establecer datos de instalación',

	//
	// Admin data
	//
	'STAGE_ADMINISTRATOR'	=> 'Detalles del administrador',

	// Form labels
	'ADMIN_CONFIG'				=> 'Configuración del administrador',
	'ADMIN_PASSWORD'			=> 'Contraseña del administrador',
	'ADMIN_PASSWORD_CONFIRM'	=> 'Confirme contraseña del administrador',
	'ADMIN_PASSWORD_EXPLAIN'	=> 'Por favor, introduzca una contraseña de entre 6 y 30 caracteres de longitud.',
	'ADMIN_USERNAME'			=> 'Nombre del administrador',
	'ADMIN_USERNAME_EXPLAIN'	=> 'Por favor, introduzca un nombre de entre 3 y 20 caracteres de longitud.',

	// Errors
	'INST_ERR_EMAIL_INVALID'		=> 'El email que ingresó no es válido.',
	'INST_ERR_PASSWORD_MISMATCH'	=> 'Las claves que ingresó no concuerdan.',
	'INST_ERR_PASSWORD_TOO_LONG'	=> 'La contraseña que ingresó es muy larga. La longitud máxima es de 30 caracteres.',
	'INST_ERR_PASSWORD_TOO_SHORT'	=> 'La ccontraseña que ingresó es muy corta. La longitud mímima es de 6 caracteres.',
	'INST_ERR_USER_TOO_LONG'	=> 'El usuario que ingresó es muy largo. La longitud máxima es de 20 caracteres.',
	'INST_ERR_USER_TOO_SHORT'	=> 'El usuario que ingresó es muy corto. La longitud mínima es de 3 caracteres.',

	//
	// Board data
	//
	// Form labels
	'BOARD_CONFIG'		=> 'Configuración del foro',
	'DEFAULT_LANGUAGE'	=> 'Idioma por defecto',
	'BOARD_NAME'		=> 'Título del foro',
	'BOARD_DESCRIPTION'	=> 'Breve descripción del foro',

	//
	// Database data
	//
	'STAGE_DATABASE'	=> 'Ajustes de la base de datos',

	// Form labels
	'DB_CONFIG'				=> 'Configuración de base de datos',
	'DBMS'					=> 'Tipo de base de datos',
	'DB_HOST'				=> 'Nombre del servidor de la base de datos o DSN',
	'DB_HOST_EXPLAIN'		=> 'DSN significa Data Source Name y es relevante solo para instalaciones ODBC. En PostgreSQL, use localhost para conectar con el servidor local a través del dominio del socket UNIX y 127.0.0.1 para conectar via TCP. En SQLite, introduzca la ruta completa a su base de datos.',
	'DB_PORT'				=> 'Puerto en el servidor de la base de datos',
	'DB_PORT_EXPLAIN'		=> 'Déjelo en blanco a menos que quiera que el servidor opere en un puerto distinto al estándar.',
	'DB_PASSWORD'			=> 'Contraseña de la base de datos',
	'DB_NAME'				=> 'Nombre de la base de datos',
	'DB_USERNAME'			=> 'Usuario de la base de datos',
	'DATABASE_VERSION'		=> 'Versión de la base de datos',
	'TABLE_PREFIX'			=> 'Prefijo para tablas en la base de datos',
	'TABLE_PREFIX_EXPLAIN'	=> 'El prefijo debe comenzar con una letra y sólo debe contener letras, números y subrayados.',

	// Database options
	'DB_OPTION_MSSQL_ODBC'	=> 'MSSQL Server 2000+ vía ODBC',
	'DB_OPTION_MSSQLNATIVE'	=> 'MSSQL Server 2005+ [ Nativo ]',
	'DB_OPTION_MYSQL'		=> 'MySQL',
	'DB_OPTION_MYSQLI'		=> 'MySQL con Extensiones MySQLi',
	'DB_OPTION_ORACLE'		=> 'Oracle',
	'DB_OPTION_POSTGRES'	=> 'PostgreSQL',
	'DB_OPTION_SQLITE3'		=> 'SQLite 3',

	// Errors
	'INST_ERR_DB'					=> 'Error en la instalación de la base de datos',
	'INST_ERR_NO_DB'				=> 'No se puede cargar el módulo PHP para la base de datos seleccionada.',
	'INST_ERR_DB_INVALID_PREFIX'	=> 'El prefijo introducido no es válido. Se debe comenzar con una letra y sólo debe contener letras, números y subrayados.',
	'INST_ERR_PREFIX_TOO_LONG'		=> 'El prefijo de tabla que especificó es muy largo. La longitud máxima es de %d caracteres.',
	'INST_ERR_DB_NO_NAME'			=> 'No se especificó nombre de base de datos.',
	'INST_ERR_DB_FORUM_PATH'		=> 'La base de datos especificada está dentro del árbol de carpetas de su sitio. Debería poner este archivo en un lugar no accessible desde la web.',
	'INST_ERR_DB_CONNECT'			=> 'No se puede conectar a la base de datos, mire el mensaje de error de abajo.',
	'INST_ERR_DB_NO_WRITABLE'		=> 'Tanto la base de datos como el directorio que la contiene debe ser posible escribir en ellos.',
	'INST_ERR_DB_NO_ERROR'			=> 'No se proporcionó mensaje de error.',
	'INST_ERR_PREFIX'				=> 'Ya existen tablas con el prefijo especificado, por favor elija uno diferente.',
	'INST_ERR_DB_NO_MYSQLI'			=> 'La versión de MySQL instalada en esta máquina es incompatible con la opción “MySQL con extensiones MySQLi” que seleccionó. Por favor pruebe la opción “MySQL” en su lugar.',
	'INST_ERR_DB_NO_SQLITE3'		=> 'La versión de la extensión SQLite que tiene instalada es muy antigua, hay que actualizarla al menos a la 3.6.15.',
	'INST_ERR_DB_NO_ORACLE'			=> 'La versión de Oracle instalada en esta máquina requiere que configure el parámetro <var>NLS_CHARACTERSET</var> a <var>UTF8</var>. O bien actualice su instalación a 9.2+ o cambie el parámetro.',
	'INST_ERR_DB_NO_POSTGRES'		=> 'La base de datos que seleccionó no fue creada en <var>UNICODE</var> o <var>UTF8</var>. Pruebe a reinstalar con una base de datos <var>UNICODE</var> o <var>UTF8</var>.',
	'INST_SCHEMA_FILE_NOT_WRITABLE'	=> 'No se puede escribir en el archivo de esquema',

	//
	// Email data
	//
	'EMAIL_CONFIG'	=> 'Configuración de correo electrónico',

	// Package info
	'PACKAGE_VERSION'					=> 'Versión del paquete instalada',
	'UPDATE_INCOMPLETE'				=> 'Tu instalación de phpBB no ha sido actualizada correctamente.',
	'UPDATE_INCOMPLETE_MORE'		=> 'Por favor, a continuación lee la información para solucionar este error.',
	'UPDATE_INCOMPLETE_EXPLAIN'		=> '<h1>Actualización incompleta</h1>

		<p>Nos dimos cuenta de que la última actualización de tu instalación de phpBB no se ha completado. Visita el <a href="%1$s" title="%1$s">actualizador de base de datos</a>, asegurate de que <em>actualizar sólo la base de datos</em> está seleccionado y haz clic en <strong>Enviar</strong>. No olvides eliminar el directorio "install" después de haber actualizado la base de datos correctamente.</p>',

	//
	// Server data
	//
	// Form labels
	'UPGRADE_INSTRUCTIONS'			=> 'Una nueva actualización <strong>%1$s</strong> está disponible. Por favor, lea <a href="%2$s" title="%2$s"><strong>el anuncio de la actualización</strong></a> para saber que tiene, y que ofrece, y cómo actualizar.',
	'SERVER_CONFIG'				=> 'Configuración del servidor',
	'SCRIPT_PATH'				=> 'Ruta del script',
	'SCRIPT_PATH_EXPLAIN'		=> 'La ruta dónde está ubicado phpBB3 relativa al nombre de dominio, ej. <samp>/phpBB3</samp>.',
));

// Default database schema entries...
$lang = array_merge($lang, array(
	'CONFIG_BOARD_EMAIL_SIG'		=> 'Gracias, La Administración del Foro',
	'CONFIG_SITE_DESC'				=> 'Un breve texto para describir su Foro',
	'CONFIG_SITENAME'				=> 'sudominio.com',

	'DEFAULT_INSTALL_POST'			=> 'Este es un mensaje de ejemplo en su instalación phpBB3. Puede borrar este mensaje, este tema e incluso este foro si quiere, ¡ya que todo parece estar funcionando! Pero es buena idea usar la categoría y el foro creados por defecto para copiar los permisos en los futuros foros a crear. Le simplificará la tarea. ¡Gracias!',

	'FORUMS_FIRST_CATEGORY'			=> 'Mi primera categoría',
	'FORUMS_TEST_FORUM_DESC'		=> 'Es solo para probar el foro.',
	'FORUMS_TEST_FORUM_TITLE'		=> 'Foro de Prueba 1',

	'RANKS_SITE_ADMIN_TITLE'		=> 'Administrador del Sitio',
	'REPORT_WAREZ'					=> 'El mensaje contiene enlaces a software ilegal o pirateado (warez).',
	'REPORT_SPAM'					=> 'El mensaje reportado solo tiene la intención de informar de un sitio web u otro producto.',
	'REPORT_OFF_TOPIC'				=> 'El mensaje reportado es Off-Topic.',
	'REPORT_OTHER'					=> 'El mensaje reportado no se ajusta a ninguna categoría, por favor use el campo de descripción.',

	'SMILIES_ARROW'					=> 'Flecha',
	'SMILIES_CONFUSED'				=> 'Confundido',
	'SMILIES_COOL'					=> 'Tranquilo',
	'SMILIES_CRYING'				=> 'Llorando o muy triste',
	'SMILIES_EMARRASSED'			=> 'Ofuscado',
	'SMILIES_EVIL'					=> 'Malo o muy loco',
	'SMILIES_EXCLAMATION'			=> 'Exclamación',
	'SMILIES_GEEK'					=> 'Friki',
	'SMILIES_IDEA'					=> 'Idea',
	'SMILIES_LAUGHING'				=> 'Riendo',
	'SMILIES_MAD'					=> 'Loco',
	'SMILIES_MR_GREEN'				=> 'Sr. Verde',
	'SMILIES_NEUTRAL'				=> 'Neutral',
	'SMILIES_QUESTION'				=> 'Pregunta',
	'SMILIES_RAZZ'					=> 'Vacilar',
	'SMILIES_ROLLING_EYES'			=> 'Harto',
	'SMILIES_SAD'					=> 'Triste',
	'SMILIES_SHOCKED'				=> 'Sacudido',
	'SMILIES_SMILE'					=> 'Sonrisa',
	'SMILIES_SURPRISED'				=> 'Sorprendido',
	'SMILIES_TWISTED_EVIL'			=> 'Diablo',
	'SMILIES_UBER_GEEK'				=> 'Microsiervo',
	'SMILIES_VERY_HAPPY'			=> 'Muy Feliz',
	'SMILIES_WINK'					=> 'Guiño',

	'TOPICS_TOPIC_TITLE'			=> 'Bienvenido a phpBB3',
));

// Common navigation items' translation
$lang = array_merge($lang, array(
	'MENU_OVERVIEW'		=> 'Vista Global',
	'MENU_INTRO'		=> 'Introducción',
	'MENU_LICENSE'		=> 'Licencia',
	'MENU_SUPPORT'		=> 'Soporte',
));

// Task names
$lang = array_merge($lang, array(
	// Install filesystem
	'TASK_CREATE_CONFIG_FILE'	=> 'Creando archivo de configuración',

	// Install database
	'TASK_ADD_CONFIG_SETTINGS'			=> 'Añadiendo ajustes de configuración',
	'TASK_ADD_DEFAULT_DATA'				=> 'Añadiendo ajustes por defecto a la base de datos',
	'TASK_CREATE_DATABASE_SCHEMA_FILE'	=> 'Creando archivo esquema de la base de datos',
	'TASK_SETUP_DATABASE'				=> 'Creando la base de datos',
	'TASK_CREATE_TABLES'				=> 'Creando tablas',

	// Install data
	'TASK_ADD_BOTS'			=> 'Registrando robots',
	'TASK_ADD_LANGUAGES'	=> 'Instalando idiomas disponibles',
	'TASK_ADD_MODULES'		=> 'Instalando módulos',
	'TASK_CREATE_SEARCH_INDEX'	=> 'Creando índice de búsqueda',

	// Install finish tasks
	'TASK_INSTALL_EXTENSIONS'	=> 'Instalación de extensiones empaquetadas',
	'TASK_NOTIFY_USER'			=> 'Enviando notificación al correo electrónico',
	'TASK_POPULATE_MIGRATIONS'	=> 'Rellenando migraciones',

	// Installer general progress messages
	'INSTALLER_FINISHED'	=> 'El instalador ha finalizado correctamente',
));

// Installer's general messages
$lang = array_merge($lang, array(
	'MODULE_NOT_FOUND'				=> 'Módulo no encontrado',
	'MODULE_NOT_FOUND_DESCRIPTION'	=> 'Un módulo no se pudo encontrar porque el servicio, %s, no está definido.',

	'TASK_NOT_FOUND'				=> 'Tarea no encontrada',
	'TASK_NOT_FOUND_DESCRIPTION'	=> 'Una tarea no se pudo encontrar porque el servicio, %s, no está definido.',

	'SKIP_MODULE'	=> 'Omitir el módulo “%s”',
	'SKIP_TASK'		=> 'Omitir la tarea “%s”',

	'TASK_SERVICE_INSTALLER_MISSING'	=> 'Todas las tareas de servicios de instalación deben comenzar con “installer”',
	'TASK_CLASS_NOT_FOUND'				=> 'La definición de la tarea de servicio de instalación no es válido. El nombre del servicio dado “%1$s”, el espacio de nombres de clase esperado para eso es “%2$s”. Para obtener más información, consulte la documentación de task_interface.',

	'INSTALLER_CONFIG_NOT_WRITABLE'	=> 'The installer config file is not writable.',
));

// CLI messages
$lang = array_merge($lang, array(
	'CLI_INSTALL_BOARD'				=> 'Instalar phpBB',
	'CLI_UPDATE_BOARD'				=> 'Actualizar phpBB',
	'CLI_INSTALL_SHOW_CONFIG'		=> 'Mostrar la configuración que se utilizará',
	'CLI_INSTALL_VALIDATE_CONFIG'	=> 'Validar un archivo de configuración',
	'CLI_CONFIG_FILE'				=> 'Archivo de configuración a usar',
	'MISSING_FILE'					=> 'No se ha podido acceder al archivo %1$s',
	'MISSING_DATA'					=> 'En el archivo de configuración faltan datos o pueden contener ajustes no válidos.',
	'INVALID_YAML_FILE'				=> 'No se pudo analizar el archivo YAML %1$s',
	'CONFIGURATION_VALID'			=> 'El archivo de configuración es válido',
));

// Common updater messages
$lang = array_merge($lang, array(
	'UPDATE_INSTALLATION'			=> 'Actualizar la instalación de phpBB',
	'UPDATE_INSTALLATION_EXPLAIN'	=> 'Con esta opción, es posible actualizar su instalacion de phpBB a la última versión.<br />Durante el proceso se verificará la integridad de todos los archivos. Podrá también revisar las diferencias y archivos antes de actualizar.<br /><br /> La actualización de archivos en si misma se puede hacer de dos formas distintas.</p><h2>Actualización Manual</h2> <p>Con esta actualización solamente descarga su paquete de archivos cambiados personalizado para asegurarse de no perder sus cambios de archivos. Una vez terminado se le redirige a la comprobación de archivo de nuevo para asegurarse de que todo se actualizó correctamente.<br /><br />',
	'UPDATE_INSTRUCTIONS'			=> '

		<h1>Anuncio de la publicación</h1>

		<p>Por favor, lea el anuncio de la publicación para la última versión antes de continuar el proceso de actualización, puede tener información útil. También tiene enlaces a la descarga completa y al registro de cambios.</p>

		<br />

		<h1>Cómo actualizar su instalación con el paquete completo</h1>

		<p>La forma recomendada de actualizar su instalación es utilizando el paquete completo. Si los archivos core phpBB se han modificado en su instalación, es posible que desee utilizar el paquete de actualización automática para no perder estos cambios. También puede actualizar su instalación utilizando los otros métodos enumerados en el documento INSTALL.html. Los pasos para actualizar phpBB3 usando el paquete completo son los siguientes:</p>

		<ol style="margin-left: 20px; font-size: 1.1em;">
			<li><strong class="error">Copia de seguridad de todos los archivos y base de datos.</strong></li>
			<li>Ir a la <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">Página de descargas de phpBB.com</a> y descargue el último archivo del "Full Package" (paquete completo).</li>
			<li>Descomprima el archivo.</li>
			<li>Quitar (eliminar) el archivo <code class="inline">config.php</code>, y las carpetas <code class="inline">/images</code>, <code class="inline">/store</code> y <code class="inline">/files</code> <em>del paquete</em> (NO de su servidor).</li>
			<li>Ir al PCA > GENERAL > Configuración del Sitio > Estilo del foro y asegurese de que prosilver es el estilo por defecto. Si no es así, ponga por defecto prosilver.</li>
			<li>Borre las carpetas <code class="inline">/vendor</code> y <code class="inline">/cache</code> de la carpeta raíz del foro, en su servidor.</li>
			<li>Usando FTP o SSH suba los archivos y carpetas restantes (es decir, el CONTENIDO restante de la carpeta phpBB3) en la carpeta raíz de la instalación del foro en el servidor, sobrescribiendo los archivos existentes. (Nota: tenga cuidado de no borrar ninguna extensión en su carpeta <code class="inline">/ext</code> al subir el nuevo contenido de phpBB3)</li>
			<li><strong><a href="%1$s" title="%1$s">Ahora inicie el proceso de actualización, apuntando su navegador a la carpeta de instalación</a>.</strong></li>
			<li>Siga los pasos para actualizar la base de datos y deje que se ejecute hasta su finalización.</li>
			<li>Usando FTP o SSH borre la carpeta <code class="inline">/install</code> de la raíz de su foro instalado.<br><br></li>
		</ol>
		
		<p>Ahora tiene un nuevo foro actualizado que contiene todos sus usuarios y mensajes. Tareas de seguimiento:</p>
		<ul style="margin-left: 20px; font-size: 1.1em;">
			<li>Actualiza tu paquete de lenguaje</li>
			<li>Actualiza tu estilo<br><br></li>
		</ul>

		<h1>Cómo actualizar su instalación con el paquete de actualización automática</h1>

		<p>El paquete de actualización automática solo se recomienda en caso de que se hayan modificado los archivos core phpBB en su instalación. También puede actualizar su instalación utilizando los métodos enumerados en el documento INSTALL.html. Los pasos para actualizar phpBB3 usando el paquete de actualización automática son:</p>

		<ul style="margin-left: 20px; font-size: 1.1em;">
			<li>Visite la <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">página de descargas de phpBB.com</a> y descargue el archivo “Paquete de Actualización automática de phpBB”.</li>
			<li>Desempaquete el archivo.<br /><br /></li>
			<li>Suba las carpetas de instalación descomprimida “install” y “vendor” completa a la carpeta raiz de phpBB (donde está el archivo config.php).<br><br></li>
		</ul>

		<p>Una vez subido su sitio estará fuera de línea para los usuarios normales debido a que la carpeta de instalación se halla presente.<br><br>
		<strong><a href="%1$s" title="%1$s">Ahora comenzará el proceso de actualización yendo con su navegador a la carpeta install</a>.</strong><br />
		<br />
		Posteriormente será guiado a través del proceso de actualización. Será notificado después de que la actualización se complete.
		</p>
	',
));

// Updater forms
$lang = array_merge($lang, array(
	// Updater types
	'UPDATE_TYPE'			=> 'Type of update to run',

	'UPDATE_TYPE_ALL'		=> 'Update filesystem and database',
	'UPDATE_TYPE_DB_ONLY'	=> 'Update database only',

	// File updater methods
	'UPDATE_FILE_METHOD_TITLE'		=> 'Métodos de actualización de los archivos',

	'UPDATE_FILE_METHOD'			=> 'Método de actualización del archivo',
	'UPDATE_FILE_METHOD_DOWNLOAD'	=> 'Descargar archivos modificados en un archivo',
	'UPDATE_FILE_METHOD_FTP'		=> 'Archivos de actualización a través de FTP (Automático)',
	'UPDATE_FILE_METHOD_FILESYSTEM'	=> 'Archivos de actualización a través de acceso directo a archivos (Automático)',

	// File updater archives
	'SELECT_DOWNLOAD_FORMAT'	=> 'Seleccione el formato del archivo de descarga',

	// FTP settings
	'FTP_SETTINGS'			=> 'Ajustes FTP',
));

// Requirements messages
$lang = array_merge($lang, array(
	'UPDATE_FILES_NOT_FOUND'	=> 'No se encontró directorio de actualización válido. Por favor, asegúrese de que ha cargado los archivos correspondientes.',

	'NO_UPDATE_FILES_UP_TO_DATE'	=> 'Su versión está actualizada. No hay necesidad de ejecutar la herramienta de actualización. Si quiere verificar la integridad de sus archivos asegúrese de haber subido los archivos actualizados correctos.',
	'OLD_UPDATE_FILES'				=> 'Los archivos actualizados no tienen la fecha correcta. Los archivos actualizados que se encontraron son para actualizar de phpBB %1$s a phpBB %2$s pero la última versión de phpBB es %3$s.',
	'INCOMPATIBLE_UPDATE_FILES'		=> 'Los archivos actualizados encontrados son incompatibles con la versión instalada. La versión instalada es %1$s y el archivo actualizado es para phpBB %2$s a %3$s.',
));

// Update files
$lang = array_merge($lang, array(
	'STAGE_UPDATE_FILES'		=> 'Actualizar archivos',

	// Check files
	'UPDATE_CHECK_FILES'	=> 'Comprobar archivos a actualizar',

	// Update file differ
	'FILE_DIFFER_ERROR_FILE_CANNOT_BE_READ'	=> 'El archivo de diferencias (differ) %s no se puede abrir.',

	'UPDATE_FILE_DIFF'		=> 'Archivos diferenciados modificados',
	'ALL_FILES_DIFFED'		=> 'Todos los archivos modificados han sido diferenciados.',

	// File status
	'UPDATE_CONTINUE_FILE_UPDATE'	=> 'Archivos de actualización',

	'DOWNLOAD'							=> 'Descargar',
	'DOWNLOAD_CONFLICTS'				=> 'Conflictos en la descarga de este archivo',
	'DOWNLOAD_CONFLICTS_EXPLAIN'		=> 'Buscar &lt;&lt;&lt; para descubrir los conflictos',
	'DOWNLOAD_UPDATE_METHOD'			=> 'Descargar archivos modificados',
	'DOWNLOAD_UPDATE_METHOD_EXPLAIN'	=> 'Una vez descargado, debería desempaquetar el archivo. Encontrará dentro los archivos modificados que necesita subir al directorio raíz de su foro phpBB. Por favor, súbalos a sus respectivas ubicaciones. Después de que los haya subido todos, por favor verifique los archivos de nuevo con el otro botón de abajo.',

	'FILE_ALREADY_UP_TO_DATE'		=> 'El archivo ya está actualizado.',
	'FILE_DIFF_NOT_ALLOWED'			=> 'El archivo no permite que se le aplique diff.',
	'FILE_USED'						=> 'Información empleada',			// Single file
	'FILES_CONFLICT'				=> 'Archivos en conflicto',
	'FILES_CONFLICT_EXPLAIN'		=> 'Los siguientes archivos han sido modificados y no coinciden con los archivos originales de la antigua versión. phpBB ha determinado que esos archivos creará conflitos si se intenta insertarlos. Por favor, investigue los conflictos y trate de resolverlos manualmente o continúe la instalación decidiendo el método de integración preferido. Si resuelve los conflictos manualmente verifique los archivos nuevamente despues de modificarlos. También puede decidir un método de integración para cada archivo. El primero dará como resultado un archivo donde las líneas conflictivas de su viejo archivo se perderán, el otro dará como resultado perder los cambios en el nuevo archivo.',
	'FILES_DELETED'					=> 'Archivos borrados',
	'FILES_DELETED_EXPLAIN'			=> 'Los siguientes archivos no existen en la nueva versión. Estos archivos tienen que ser eliminados de su actual instalación.',
	'FILES_MODIFIED'				=> 'Archivos modificados',
	'FILES_MODIFIED_EXPLAIN'		=> 'Los siguientes archivos fueron modificados y no coinciden con los archivos originales de la antigua versión. Las modificaciones se insertarán a los archivos actualizados.',
	'FILES_NEW'						=> 'Archivos nuevos',
	'FILES_NEW_EXPLAIN'				=> 'Los siguientes archivos actualmente no existen en su instalación.',
	'FILES_NEW_CONFLICT'			=> 'Archivos nuevos en conflicto',
	'FILES_NEW_CONFLICT_EXPLAIN'	=> 'Los siguientes archivos son nuevos de la última versión pero se ha determinado que ya hay un archivo con el mismo nombre en la misma ubicación. Este archivo será sobreescrito por el nuevo.',
	'FILES_NOT_MODIFIED'			=> 'Archivos sin modificación',
	'FILES_NOT_MODIFIED_EXPLAIN'	=> 'Los siguientes archivos no han sido modificados y coinciden con los archivos originales de phpBB para la versión a la cual quiere actualizar.',
	'FILES_UP_TO_DATE'				=> 'Archivos actualizados',
	'FILES_UP_TO_DATE_EXPLAIN'		=> 'Los siguientes archivos ya han sido actualizados.',
	'FILES_VERSION'					=> 'Versión de los archivos',
	'TOGGLE_DISPLAY'				=> 'Ver/Ocultar lista de archivos',

	// File updater
	'UPDATE_UPDATING_FILES'	=> 'Actualizando archivos',

	'UPDATE_FILE_UPDATER_HAS_FAILED'	=> 'La actualización del archivo “%1$s“ falló. El instalador intentará vuelve a “%2$s“.',
	'UPDATE_FILE_UPDATERS_HAVE_FAILED'	=> 'La actualización del archivo falló. No hay métodos de retorno adicionales disponibles.',

	'UPDATE_CONTINUE_UPDATE_PROCESS'	=> 'Continuar el proceso de actualización',
	'UPDATE_RECHECK_UPDATE_FILES'		=> 'Comprobar archivos de nuevo',
));

// Update database
$lang = array_merge($lang, array(
	'STAGE_UPDATE_DATABASE'		=> 'Actualizar base de datos',

	'INLINE_UPDATE_SUCCESSFUL'		=> 'La actualización de base de datos se ha realizado correctamente.',

	'TASK_UPDATE_EXTENSIONS'	=> 'Actualización de extensiones',
));

// Converter
$lang = array_merge($lang, array(
	// Common converter messages
	'CONVERT_NOT_EXIST'			=> 'El conversor especificado no existe.',
	'DEV_NO_TEST_FILE'			=> 'No ha sido especificado un valor para la variable test_file en el conversor. Si es un usuario de ese conversor, no debería estar viendo este error, Por favor, reporte este mensaje al autor del conversor. Si es usted, tiene que especificar el nombre de un archivo que exista en el sitio original para permitir que sea verificada la ruta al mismo.',
	'COULD_NOT_FIND_PATH'		=> 'No se puede encontrar la ruta a su antiguo sitio. Por favor, verifique sus parámetros e intente de nuevo.<br />» La ruta especificada fue %s.',
	'CONFIG_PHPBB_EMPTY'		=> 'La variable de configuración para “%s” está vacía.',

	'MAKE_FOLDER_WRITABLE'		=> 'Por favor, asegúrese de que esta carpeta existe y que el servidor web puede escribirla luego pruebe otra vez:<br />»<strong>%s</strong>.',
	'MAKE_FOLDERS_WRITABLE'		=> 'Por favor, asegúrese de que estas carpetas existen y que el servidor web puede escribir en ellas; luego pruebe otra vez:<br />»<strong>%s</strong>.',

	'INSTALL_TEST'				=> 'Probar de nuevo',

	'NO_TABLES_FOUND'			=> 'No se encontraron las tablas.',
	'TABLES_MISSING'			=> 'No se puede encontrar estas tablas<br />» <strong>%s</strong>.',
	'CHECK_TABLE_PREFIX'		=> 'Por favor, verifique el prefijo y pruebe de nuevo.',

	// Conversion in progress
	'CONTINUE_CONVERT'			=> 'Continuar conversión',
	'CONTINUE_CONVERT_BODY'		=> 'Se ha determinado un intento previo de conversión. Puede elegir entre iniciar una nueva conversión, o continuar la existente.',
	'CONVERT_NEW_CONVERSION'	=> 'Nueva conversión',
	'CONTINUE_OLD_CONVERSION'	=> 'Continuar la conversión previamente iniciada',

	// Start conversion
	'SUB_INTRO'					=> 'Introducción',
	'CONVERT_INTRO'				=> 'Bienvenido al conversor unificado de phpBB',
	'CONVERT_INTRO_BODY'		=> 'Desde aquí puede importar datos de otros sitios instalados. La lista de abajo muestra todos los módulos de conversión disponibles actualmente. Si no hay ningún conversor mostrado para la versión que quiere, por favor visite nuestro sitio web dónde puede haber más módulos para descargar.',
	'AVAILABLE_CONVERTORS'		=> 'Conversores disponibles',
	'NO_CONVERTORS'				=> 'No hay disponibles conversores para usar.',
	'CONVERT_OPTIONS'			=> 'Opciones',
	'SOFTWARE'					=> 'Software del foro',
	'VERSION'					=> 'Versión',
	'CONVERT'					=> 'Convertir',

	// Settings
	'STAGE_SETTINGS'			=> 'Ajustes',
	'TABLE_PREFIX_SAME'			=> 'El prefijo para las tablas necesita ser uno usado por el software que está convirtiendo.<br />» El prefijo especificado fue %s.',
	'DEFAULT_PREFIX_IS'			=> 'El conversor no fue capaz de encontrar tablas con el prefijo especificado. Por favor, asegúrese de haber insertado los detalles correctos para el sitio que está convirtiendo. El prefijo de tabla por defecto para %1$s es <strong>%2$s</strong>.',
	'SPECIFY_OPTIONS'			=> 'Especificar opciones de conversión',
	'FORUM_PATH'				=> 'Ruta del foro',
	'FORUM_PATH_EXPLAIN'		=> 'Esta es la ruta <strong>relativa</strong> en el disco de su antiguo sitio desde el directorio <strong>raíz de su instalación phpBB</strong>.',
	'REFRESH_PAGE'				=> 'Refresque la página para continuar con la conversión',
	'REFRESH_PAGE_EXPLAIN'		=> 'Si eliges SÍ, el conversor actualizará la página para continuar la conversión después de haber finalizado un paso. Si esta es tu primera conversión con propósito de prueba y determinar errores por adelantado, le sugerimos que seleccione NO.',

	// Conversion
	'STAGE_IN_PROGRESS'			=> 'Conversión en progreso',

	'AUTHOR_NOTES'				=> 'Notas del autor<br />» %s',
	'STARTING_CONVERT'			=> 'Starting conversion process',
	'CONFIG_CONVERT'			=> 'Convirtiendo la configuración',
	'DONE'						=> 'Hecho',
	'PREPROCESS_STEP'			=> 'Ejecutando funciones/consultas previas',
	'FILLING_TABLE'				=> 'Llenando tabla <strong>%s</strong>',
	'FILLING_TABLES'			=> 'Llenando tablas',
	'DB_ERR_INSERT'				=> 'Error mientras procesaba consulta <code>INSERT</code>.',
	'DB_ERR_LAST'				=> 'Error mientras procesaba <var>query_last</var>.',
	'DB_ERR_QUERY_FIRST'		=> 'Error mientras procesaba <var>query_first</var>.',
	'DB_ERR_QUERY_FIRST_TABLE'	=> 'Error mientras procesaba <var>query_first</var>, %s (“%s”).',
	'DB_ERR_SELECT'				=> 'Error mientras ejecutaba consulta <code>SELECT</code>.',
	'STEP_PERCENT_COMPLETED'	=> 'Paso <strong>%d</strong> de <strong>%d</strong>',
	'FINAL_STEP'				=> 'Procesando el paso final',
	'SYNC_FORUMS'				=> 'Comenzando a sincronizar foros',
	'SYNC_POST_COUNT'			=> 'Sincronizando post_counts',
	'SYNC_POST_COUNT_ID'		=> 'Sincronizando post_counts desde <var>entry</var> %1$s desde %2$s.',
	'SYNC_TOPICS'				=> 'Comenzando a sincronizar temas',
	'SYNC_TOPIC_ID'				=> 'Synchronising topics from <var>topic_id</var> %1$s to %2$s.',
	'PROCESS_LAST'				=> 'Haciendo últimos ajustes',
	'UPDATE_TOPICS_POSTED'		=> 'Generando información de temas publicados',
	'UPDATE_TOPICS_POSTED_ERR'	=> 'Ha ocurrido un error mientras generaba información de topics posteados. Puedes reintentar este paso en el Panel de Control de Administración (PCA) después de completar el proceso de conversión.',
	'CONTINUE_LAST'				=> 'Continuar al último paso',
	'CLEAN_VERIFY'				=> 'Limpiando y verificando la estructura final',
	'NOT_UNDERSTAND'			=> 'No se puede entender %s #%d, tabla %s (“%s”)',
	'NAMING_CONFLICT'			=> 'Conflicto de nombres: %s y %s ambos son alias<br /><br />%s',

	// Finish conversion
	'CONVERT_COMPLETE'			=> 'Conversión completada',
	'CONVERT_COMPLETE_EXPLAIN'	=> 'Has convertido tu sitio a phpBB 3.2 correctamente. Ahora puedes identificarte y <a href="../">acceder a tu sitio</a>. Recuerda que hay ayuda disponible en línea para usar phpBB3 vía <a href="https://www.phpbb.com/support/docs/en/3.2/ug/">Documentación</a>, y los <a href="https://www.phpbb.com/community/viewforum.php?f=466">foros de soporte</a> (ambos en inglés).',

	'CONV_ERROR_ATTACH_FTP_DIR'			=> 'El FTP para subir adjuntos está habilitado en el viejo sitio. Por favor, deshabilita esta opción de FTP y asegúrate de especificar una carpeta válida para subir, luego copia todos los adjuntos a esta nueva carpeta. Una vez hecho esto, reinicia el conversor.',
	'CONV_ERROR_CONFIG_EMPTY'			=> 'No hay información de conversión disponible para la misma.',
	'CONV_ERROR_FORUM_ACCESS'			=> 'Imposible obtener información de acceso al foro.',
	'CONV_ERROR_GET_CATEGORIES'			=> 'Imposible obtener las categorías.',
	'CONV_ERROR_GET_CONFIG'				=> 'No se puede recuperar la configuración de tu foro.',
	'CONV_ERROR_COULD_NOT_READ'			=> 'Imposible acceder/leer “%s”.',
	'CONV_ERROR_GROUP_ACCESS'			=> 'Imposible obtener información de autentificación de grupo.',
	'CONV_ERROR_INCONSISTENT_GROUPS'	=> 'Inconsistencia en tabla de grupos detectada en add_bots() - es necesario agregar manualmente todos los grupos especiales.',
	'CONV_ERROR_INSERT_BOT'				=> 'Imposible insertar robot en la tabla de usuarios',
	'CONV_ERROR_INSERT_BOTGROUP'		=> 'Imposible insertar robot en la tabla de robots.',
	'CONV_ERROR_INSERT_USER_GROUP'		=> 'Imposible insertar usuario en la tabla user_group.',
	'CONV_ERROR_MESSAGE_PARSER'			=> 'Mensaje de error del analizador',
	'CONV_ERROR_NO_AVATAR_PATH'			=> 'Nota para el desarrollador: tiene que especificar $convertor[\'avatar_path\'] para usar %s.',
	'CONV_ERROR_NO_FORUM_PATH'			=> 'La ruta relativa del foro no ha sido especificada.',
	'CONV_ERROR_NO_GALLERY_PATH'		=> 'Nota para el desarrollador: ha de especificar $convertor[\'avatar_gallery_path\'] para usar %s.',
	'CONV_ERROR_NO_GROUP'				=> 'No se puede encontrar el grupo “%1$s” en %2$s.',
	'CONV_ERROR_NO_RANKS_PATH'			=> 'Nota para el desarrollador: ha de especificar $convertor[\'ranks_path\'] para usar %s.',
	'CONV_ERROR_NO_SMILIES_PATH'		=> 'Nota para el desarrollador: ha de especificar $convertor[\'smilies_path\'] para usar %s.',
	'CONV_ERROR_NO_UPLOAD_DIR'			=> 'Nota para el desarrollador: ha de especificar $convertor[\'upload_path\'] para usar %s.',
	'CONV_ERROR_PERM_SETTING'			=> 'Imposible insertar/actualizar la configuración de permisos.',
	'CONV_ERROR_PM_COUNT'				=> 'Imposible seleccionar carpeta de recuento de MP.',
	'CONV_ERROR_REPLACE_CATEGORY'		=> 'Imposible insertar nuevo foro reemplazando antigua categoría.',
	'CONV_ERROR_REPLACE_FORUM'			=> 'Imposible insertar nuevo foro reemplazando antiguo foro.',
	'CONV_ERROR_USER_ACCESS'			=> 'Imposible obtener información de autentificación de usuario.',
	'CONV_ERROR_WRONG_GROUP'			=> 'Grupo incorrecto “%1$s” definido en %2$s.',
	'CONV_OPTIONS_BODY'					=> 'Esta página recopila los datos requeridos para acceder al foro antiguo. Introduce los detalles de la base de datos de tu foro; el conversor no cambiará nada en esa base de datos. Debe deshabilitarse el foro antiguo para una conversión correcta.',
	'CONV_SAVED_MESSAGES'				=> 'Mensajes guardados',

	'PRE_CONVERT_COMPLETE'			=> 'Todos los pasos de preconversión se han completado correctamente. Ahora puedes comenzar el proceso de conversión. Por favor, ten en cuenta que podrías tener que ajustar varios detalles manualmente. Después de la conversión, verifica especialmente los permisos asignados, reconstruye tu índice de búsqueda si es necesario y también asegúrate de que los archivos se copien correctamente, por ejemplo avatares y emoticonos.',
));
