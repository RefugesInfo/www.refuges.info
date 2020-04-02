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
	'ACP_SEARCH_INDEX_EXPLAIN'				=> 'Aquí puede gestionar los índices de búsqueda. Ya que normalmente usa solo un índice debería borrar los restantes. Después de modificar alguno de los parámetros del motor de búsqueda (p.ej. el número de caracteres min/máximos) sería importante actualizar el índice para que refleje estos cambios.',
	'ACP_SEARCH_SETTINGS_EXPLAIN'			=> 'Aquí puede definir qué índice de búsqueda se usará para indexar mensajes y efectuar búsquedas. Puede ajustar varias opciones que pueden influir en cuánto procesamiento requieran dichas acciones. Algunos de estos ajustes son los mismos para todos los motores de búsqueda.',

	'COMMON_WORD_THRESHOLD'					=> 'Umbral de palabra común',
	'COMMON_WORD_THRESHOLD_EXPLAIN'			=> 'Palabras que estén contenidas en un porcentaje mayor de todos los mensajes serán referidas como comunes. Las palabras comunes serán ignoradas en las consultas de las búsquedas. Solo se efectuará si hay más de 100 mensajes. Si quiere que palabras que actualmente referidas como comunes sean tomadas en cuenta de nuevo tendrá que reformar el índice.',
	'CONFIRM_SEARCH_BACKEND'				=> '¿Está seguro de que quiere cambiar a un motor de búsqueda diferente? Después de cambiar ha de crear un nuevo índice. Si no planea volver al anterior, también puede borrar su índice para liberar recursos de sistema.',
	'CONTINUE_DELETING_INDEX'				=> 'Continuar proceso de borrado de índices previos',
	'CONTINUE_DELETING_INDEX_EXPLAIN'		=> 'Se ha iniciado el proceso de borrado de un índice. Con el fin de acceder a la página de búsqueda nuevamente necesita completar este proceso primero.',
	'CONTINUE_INDEXING'						=> 'Continuar proceso de indexación previo',
	'CONTINUE_INDEXING_EXPLAIN'				=> 'Se ha iniciado un proceso de indexación. Con el fin de acceder a la página de búsqueda nuevamente necesita completar este proceso primero.',
	'CREATE_INDEX'							=> 'Crear índice',

	'DELETE_INDEX'							=> 'Borrar índice',
	'DELETING_INDEX_IN_PROGRESS'			=> 'Borrado de índice en curso',
	'DELETING_INDEX_IN_PROGRESS_EXPLAIN'	=> 'El motor de búsqueda actualmente está limpiando su índice. Esto puede llevar algunos minutos.',

	'FULLTEXT_MYSQL_INCOMPATIBLE_DATABASE'	=> 'Texto completo solo puede usarse MySQL4 y superiores.',
	'FULLTEXT_MYSQL_NOT_SUPPORTED'			=> 'Texto completo solo puede usarse con tablas MyISAM o tablas InnoDB. Se requiere MySQL 5.6.8 o posterior para índices de texto completo en tablas InnoDB.',
	'FULLTEXT_MYSQL_TOTAL_POSTS'			=> 'Número total de mensajes indexados',
	'FULLTEXT_MYSQL_MIN_SEARCH_CHARS_EXPLAIN'	=> 'Palabras con al menos esta cantidad de caracteres serán indexadas para futuras búsquedas. Usted o su hospedaje solo podrán cambiar esta configuración al cambiar la configuración de MySQL.',
	'FULLTEXT_MYSQL_MAX_SEARCH_CHARS_EXPLAIN'	=> 'Palabras con no más de esta cantidad de caracteres serán indexadas para futuras búsquedas. Usted o su hospedaje solo podrán cambiar esta configuración al cambiar la configuración de MySQL.',

	'FULLTEXT_POSTGRES_INCOMPATIBLE_DATABASE'	=> 'El Texto completo PostgreSQL solo puede usarse con PostgreSQL.',
	'FULLTEXT_POSTGRES_TOTAL_POSTS'				=> 'Número total de mensajes indexados',
	'FULLTEXT_POSTGRES_VERSION_CHECK'			=> 'Versión PostgreSQL',
	'FULLTEXT_POSTGRES_TS_NAME'					=> 'Perfil de configuración de texto de búsqueda:',
	'FULLTEXT_POSTGRES_MIN_WORD_LEN'			=> 'Longitud mínima de la palabra para palabras clave',
	'FULLTEXT_POSTGRES_MAX_WORD_LEN'			=> 'Longitud máxima de la palabra para palabras clave',
	'FULLTEXT_POSTGRES_VERSION_CHECK_EXPLAIN'	=> 'Está búsqueda requiere PostgreSQL versión 8.3 y superiores.',
	'FULLTEXT_POSTGRES_TS_NAME_EXPLAIN'			=> 'El perfil de configuración de búsqueda de texto es para determinar el analizador y el diccionario.',
	'FULLTEXT_POSTGRES_MIN_WORD_LEN_EXPLAIN'	=> 'Palabras con al menos esta cantidad de caracteres se incluirán en la consulta a la base de datos.',
	'FULLTEXT_POSTGRES_MAX_WORD_LEN_EXPLAIN'	=> 'Palabras con no más de esta cantidad de caracteres se incluirán en la consulta a la base de datos.',

	'FULLTEXT_SPHINX_CONFIGURE'				=> 'Configure los siguientes ajustes para generar el archivo de configuración de Sphinx',
	'FULLTEXT_SPHINX_DATA_PATH'				=> 'Ruta al directorio de datos',
	'FULLTEXT_SPHINX_DATA_PATH_EXPLAIN'		=> 'Se puede utilizar para almacenar los índices y archivos de registro. Debe crear este directorio fuera de los directorios web accesibles. (debe tener una barra final)',
	'FULLTEXT_SPHINX_DELTA_POSTS'			=> 'Número de mensajes en la actualización frecuente del índice delta',
	'FULLTEXT_SPHINX_HOST'					=> 'Host de la búsqueda Sphinx',
	'FULLTEXT_SPHINX_HOST_EXPLAIN'			=> 'Host en el que la búsqueda Sphinx (searchd) atiende. Dejar en blanco para usar el localhost por defecto',
	'FULLTEXT_SPHINX_INDEXER_MEM_LIMIT'		=> 'Límite de memoria del indexador',
	'FULLTEXT_SPHINX_INDEXER_MEM_LIMIT_EXPLAIN'	=> 'Este número debe ser siempre menor que la RAM disponible en su máquina o servidor. Si experimenta problemas de rendimiento periódicos, podría ser debido a que el indexador consume demasiados recursos. Puede ayudar el reducir la cantidad de memoria disponible para el indexador.',
	'FULLTEXT_SPHINX_MAIN_POSTS'			=> 'Número de mensajes en el índice principal',
	'FULLTEXT_SPHINX_PORT'					=> 'Puerto de la búsqueda Sphinx',
	'FULLTEXT_SPHINX_PORT_EXPLAIN'			=> 'Puerto en el que la búsqueda Sphinx (searchd) atiende. Dejar en blanco para usar el puerto por defecto 9312 de Sphinx API',
	'FULLTEXT_SPHINX_WRONG_DATABASE'		=> 'La búsqueda Sphinx para phpBB Soporta solamente MySQL y PostgreSQL.',
	'FULLTEXT_SPHINX_CONFIG_FILE'			=> 'Archivo de configuración de Sphinx',
	'FULLTEXT_SPHINX_CONFIG_FILE_EXPLAIN'	=> 'El contenido generado en el archivo de configuración de Sphinx. Estos datos necesitan ser copiados en el sphinx.conf para ser usado por la búsqueda de Sphinx. Reemplaza el [dbuser] y [dbpassword] con tus credenciales de base de datos.',
	'FULLTEXT_SPHINX_NO_CONFIG_DATA'		=> 'La ruta del directorio config no ha sido definido. Por favor, debe definir esto para generar el archivo de configuración.',

	'GENERAL_SEARCH_SETTINGS'				=> 'Configuración general de búsqueda',
	'GO_TO_SEARCH_INDEX'					=> 'Ir a índice de búsqueda',

	'INDEX_STATS'							=> 'Estadísticas de índice',
	'INDEXING_IN_PROGRESS'					=> 'Indexación en curso',
	'INDEXING_IN_PROGRESS_EXPLAIN'			=> 'El motor de búsqueda actualmente está indexando todos los mensajes del Sitio. Esto puede llevar desde un minuto a algunas horas dependiendo del tamaño del Sitio.',

	'LIMIT_SEARCH_LOAD'						=> 'Límite de carga de sistema de la página de búsqueda',
	'LIMIT_SEARCH_LOAD_EXPLAIN'				=> 'Si la carga de sistema por minuto excede este valor la página de búsqueda se pondrá offline, 1.0 equivale aprox. ~100% de utilización de un procesador. Solo funciona en servidores UNIX.',

	'MAX_SEARCH_CHARS'						=> 'Máximo de caracteres indexados para búsqueda',
	'MAX_SEARCH_CHARS_EXPLAIN'				=> 'Palabras con no más que esta cantidad de caracteres serán indexadas para búsqueda.',
	'MAX_NUM_SEARCH_KEYWORDS'            	=> 'Número máximo de palabras clave permitidas',
	'MAX_NUM_SEARCH_KEYWORDS_EXPLAIN'      	=> 'Número máximo de palabras que el usuario puede buscar. Un valor de 0 permite un número ilimitado de palabras.',
	'MIN_SEARCH_CHARS'						=> 'Mínimo de caracteres indexados para búsqueda',
	'MIN_SEARCH_CHARS_EXPLAIN'				=> 'Palabras con no menos que esta cantidad de caracteres serán indexadas para búsqueda.',
	'MIN_SEARCH_AUTHOR_CHARS'				=> 'Mínimo de caracteres de nombre de autor',
	'MIN_SEARCH_AUTHOR_CHARS_EXPLAIN'		=> 'Los usuarios tienen que identificarse al menos esta cantidad de caracteres del nombre cuando efectúan una búsqueda de autor con comodines. Si el nombre del autor es más corto que este número, aún se podrá hacer la búsqueda ingresando el nombre completo.',

	'PROGRESS_BAR'							=> 'Barra de progreso',

	'SEARCH_GUEST_INTERVAL'					=> 'Intervalo entre búsquedas para invitados',
	'SEARCH_GUEST_INTERVAL_EXPLAIN'			=> 'Número de segundos que los invitados deberán esperar entre búsquedas. Si un invitado busca, todos los demás deberán esperar que transcurra el intervalo.',
	'SEARCH_INDEX_CREATE_REDIRECT'			=> array(
		2	=> 'Todos los mensajes hasta el ID %2$d han sido indexados, de los cuales %1$d mensajes se hicieron en este paso.<br />',
	),
	'SEARCH_INDEX_CREATE_REDIRECT_RATE'		=> array(
		2	=> 'El promedio actual de indexación es aproximadamente %1$.1f mensajes por segundo.<br />Indexación en curso…',
	),
	'SEARCH_INDEX_DELETE_REDIRECT'			=> array(
		2	=> 'Todos los mensajes hasta el ID %2$d han sido borrados del índice de búsqueda, de los cuales %1$d mensajes estaban dentro de este paso..<br />',
	),
	'SEARCH_INDEX_DELETE_REDIRECT_RATE'		=> array(
		2	=> 'La tasa actual de borrado es de aproximadamente %1$.1f mensajes por segundo.<br />Borrado en progreso…',
	),
	'SEARCH_INDEX_CREATED'					=> 'Indexados todos los mensajes en la base de datos del sitio correctamente.',
	'SEARCH_INDEX_REMOVED'					=> 'Indices de búsquedas para este motor borrados correctamente.',
	'SEARCH_INTERVAL'						=> 'Intervalo entre búsquedas para usuarios',
	'SEARCH_INTERVAL_EXPLAIN'				=> 'Número de segundos que los usuarios deberán esperar entre búsquedas. Este intervalo es independiente para cada usuario.',
	'SEARCH_STORE_RESULTS'					=> 'Duración del caché de resultados de búsquedas',
	'SEARCH_STORE_RESULTS_EXPLAIN'			=> 'Resultados de búsquedas cacheados expiran transcurrido este intervalo, en segundos. 0 significa deshabilitar caché de búsquedas.',
	'SEARCH_TYPE'							=> 'Buscar motor',
	'SEARCH_TYPE_EXPLAIN'					=> 'phpBB3 le permite elegir el motor que se usa para buscar texto en el contenido de los mensajes. Por defecto la búsqueda emplea el motor propio de phpBB.',
	'SWITCHED_SEARCH_BACKEND'				=> 'Cambió de motor de búsqueda. Para emplear el nuevo motor asegúrese de que haya un índice para el motor que eligió.',

	'TOTAL_WORDS'							=> 'Número total de palabras indexadas',
	'TOTAL_MATCHES'							=> 'Número total de palabras para relacionar mensajes indexado',

	'YES_SEARCH'							=> 'Habilitar facilidades de búsqueda',
	'YES_SEARCH_EXPLAIN'					=> 'Habilite al usuario facilidades de búsqueda, incluyendo búsqueda de usuarios.',
	'YES_SEARCH_UPDATE'						=> 'Habilitar actualización de texto completo',
	'YES_SEARCH_UPDATE_EXPLAIN'				=> 'Actualización de índices de texto completo, desestimado si la búsqueda está deshabilitada.',
));
