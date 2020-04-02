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
	'ACP_PERMISSIONS_EXPLAIN'	=> '
		<p>Los permisos son altamente granulares y se agrupan en cuatro grandes secciones, las cuales son:</p>

		<h2>Permisos Globales</h2>
		<p>Son usados para controlar el acceso en un nivel global y se aplican a todo el sitio. Se dividen posteriormente en Permisos de Usuario, Permisos de Grupos, Administradores y Moderadores Globales.</p>

		<h2>Permisos basados en Foros</h2>
		<p>Se usan para controlar el acceso a los foros específicamente. Se dividen posteriormente en Permisos de Foros, Moderadores de Foros, Permisos de Foro de Usuario y Permisos de Foro de grupos.</p>

		<h2>Permisos de Roles</h2>
		<p>Se usan para crear diferentes paquetes de varios tipos de permisos posteriormente asignables a los distintos Roles. Los roles por defecto deberían cubrir la Administración del sitio en sus cuatro divisiones, puede agregar/editar/borrar roles como crea conveniente.</p>

		<h2>Máscara de Permisos</h2>
		<p>Se usa para ver el efecto de los permisos asignados a Usuarios, Moderadores (Locales y Globales), Administradores o Foros.</p>

		<br />
	
	<p>Para más información sobre configuración y administración de permisos en su foro phpBB3, por favor vea la sección <a href="https://www.phpbb.com/support/docs/en/3.2/ug/quickstart/permissions/">Configuración de los permisos de nuestra Guía de Inicio Rápido</a> (web oficial en inglés).</p>
	',

	'ACL_NEVER'				=> 'Nunca',
	'ACL_SET'				=> 'Configurar permisos',
	'ACL_SET_EXPLAIN'		=> 'Los permisos están basados en un sencillo sistema <strong>SÍ</strong>/<strong>NO</strong>. Configurar una opción como <strong>NUNCA</strong> para un usuario o grupo tiene preferencia sobre cualquier otro valor asignado. Si no quiere asignar un valor, seleccione <strong>NO</strong>. Valores asignados para esta opción en cualquier lugar se usarán preferentemente, caso contrario se asume <strong>NUNCA</strong>. Todos los objetos marcados (en su respectivo checkbox) copiarán el paquete de permisos que defina.',
	'ACL_SETTING'			=> 'Configuración',

	'ACL_TYPE_A_'			=> 'Permisos Administrativos',
	'ACL_TYPE_F_'			=> 'Permisos de Foros',
	'ACL_TYPE_M_'			=> 'Permisos de Moderación',
	'ACL_TYPE_U_'			=> 'Permisos de Usuario',

	'ACL_TYPE_GLOBAL_A_'	=> 'Permisos Administrativos Globales',
	'ACL_TYPE_GLOBAL_U_'	=> 'Permisos de Usuario Globales',
	'ACL_TYPE_GLOBAL_M_'	=> 'Permisos de Moderadores Globales',
	'ACL_TYPE_LOCAL_M_'		=> 'Permisos de Moderador de Foro',
	'ACL_TYPE_LOCAL_F_'		=> 'Permisos de Foro',

	'ACL_NO'				=> 'No',
	'ACL_VIEW'				=> 'Ver permisos',
	'ACL_VIEW_EXPLAIN'		=> 'Aquí puede ver el efecto de los permisos sobre el usuario/grupo. Un cuadrado rojo indica que el usuario/grupo no tiene permisos, un cuadrado verde indica que el usuario/grupo tiene todos los permisos.',
	'ACL_YES'				=> 'Sí',

	'ACP_ADMINISTRATORS_EXPLAIN'				=> 'Aquí puede asignar derechos de administrador para usuarios o grupos. Todos los usuarios con permisos administrativos pueden ver el Panel de Control de Administración (PCA).',
	'ACP_FORUM_MODERATORS_EXPLAIN'				=> 'Aquí puede asignar usuarios y grupos como moderadores de foros. Para asignar accesos de usuario a los foros, para definir derechos de Moderador global o Administrativos por favor use la sección correspondiente.',
	'ACP_FORUM_PERMISSIONS_COPY_EXPLAIN' 		=> 'Aquí puede copiar permisos de foro de un foro a otro foro o a otros foros.',
	'ACP_FORUM_PERMISSIONS_EXPLAIN'				=> 'Aquí puede modificar cuales usuarios y grupos pueden acceder a qué foro. Para asignar Moderadores o definir Administradores por favor use la sección correspondiente.',
	'ACP_GLOBAL_MODERATORS_EXPLAIN'				=> 'Aquí puede asignar derechos de Moderador global para usuarios o grupos. Estos Moderadores son como los Moderadores corrientes excepto que tienen acceso a todos los foros del sitio.',
	'ACP_GROUPS_FORUM_PERMISSIONS_EXPLAIN' 		=> 'Aquí puede asignar permisos de foro a grupos.',
	'ACP_GROUPS_PERMISSIONS_EXPLAIN'			=> 'Aquí puede asignar permisos globales a grupos - permisos de usuario, permisos de Moderador global y permisos administrativos. Permisos de usuario incluyen capacidades como el empleo de avatares, enviar mensajes privados, etc; permisos de Moderador global tales como aprobar mensajes, administrar temas, administrar exclusiones, etc y por último permisos administrativos tales como modificar permisos, definir código BBCode personalizado, administrar foros, etc. Los permisos individuales de usuarios solamente deberían ser cambiados en raras ocaciones, el método preferido es poner a los usuarios en grupos y asignarles permisos de grupo.',
	'ACP_ADMIN_ROLES_EXPLAIN'					=> 'Aquí puede administrar los roles para permisos administrativos. Los roles actúan como permisos, si cambia un rol los elementos asignados al mismo también cambiarán sus permisos.',
	'ACP_FORUM_ROLES_EXPLAIN'					=> 'Aquí puede administrar los roles para permisos de foros. Los roles actúan como permisos, si cambia un rol los elementos asignados al mismo también cambiarán sus permisos.',
	'ACP_MOD_ROLES_EXPLAIN'						=> 'Aquí puede administrar los roles para permisos de Moderadores. Los roles actúan como permisos, si cambia un rol los elementos asignados al mismo también cambiarán sus permisos.',
	'ACP_USER_ROLES_EXPLAIN'					=> 'Aquí puede administrar los roles para permisos de usuario. Los roles actúan como permisos, si cambia un rol los elementos asignados al mismo también cambiarán sus permisos.',
	'ACP_USERS_FORUM_PERMISSIONS_EXPLAIN' 		=> 'Aquí puede asignar permisos de foro a los usuarios.',
	'ACP_USERS_PERMISSIONS_EXPLAIN'				=> 'Aquí puede asignar permisos globales a usuarios - permisos de usuario, permisos de moderador global y permisos de administrador. Permisos de usuario incluyen capacidades como el empleo de avatares, enviar mensajes privados, etc; permisos de Moderador global tales como aprobar mensajes, administrar temas, administrar exclusiones, etc y por último permisos administrativos tales como modificar permisos, definir código BBCode personalizado, administrar foros, etc. Para modificar estos parámetros en un gran número de usuarios el mejor método es el sistema de permisos de Grupo. Los permisos individuales de usuarios solamente deberían ser cambiados en raras ocaciones, el método preferido es poner a los usuarios en grupos y asignarles permisos de grupo.',
	'ACP_VIEW_ADMIN_PERMISSIONS_EXPLAIN'	  	=> 'Aquí puede ver el efecto de los permisos administrativos asignados a los usuarios/grupos seleccionados',
	'ACP_VIEW_GLOBAL_MOD_PERMISSIONS_EXPLAIN' 	=> 'Aquí puede ver el efecto de los permisos de moderación global asignados a los usuarios/grupos seleccionados',
	'ACP_VIEW_FORUM_PERMISSIONS_EXPLAIN'	  	=> 'Aquí puede ver el efecto de los permisos de foro asignados a los usuarios/grupos seleccionados',
	'ACP_VIEW_FORUM_MOD_PERMISSIONS_EXPLAIN'  	=> 'Aquí puede ver el efecto de los permisos de Moderador de foro asignados a los usuarios/grupos seleccionados y foros',
	'ACP_VIEW_USER_PERMISSIONS_EXPLAIN'	  		=> 'Aquí puede ver el efecto de los permisos de usuario asignados a los usuarios/grupos seleccionados',

	'ADD_GROUPS'				=> 'Añadir grupos',
	'ADD_PERMISSIONS'			=> 'Añadir permisos',
	'ADD_USERS'					=> 'Añadir usuarios',
	'ADVANCED_PERMISSIONS'		=> 'Permisos avanzados',
	'ALL_GROUPS'				=> 'Seleccionar todos los grupos',
	'ALL_NEVER'					=> 'Todos <strong>NUNCA</strong>',
	'ALL_NO'					=> 'Todos <strong>NO</strong>',
	'ALL_USERS'					=> 'Seleccionar todos los usuarios',
	'ALL_YES'					=> 'Todos <strong>SÍ</strong>',
	'APPLY_ALL_PERMISSIONS'		=> 'Aplicar todos los permisos',
	'APPLY_PERMISSIONS'			=> 'Aplicar permisos',
	'APPLY_PERMISSIONS_EXPLAIN'	=> 'Los permisos y roles definidos se aplicarán a éste y todos los elementos marcados.',
	'AUTH_UPDATED'				=> 'Permisos actualizados.',

	'COPY_PERMISSIONS_CONFIRM'				=> '¿Está seguro de que desea ejecutar esta acción? Por favor tenga en cuenta que esto sobreescribirá todos los permiso en los seleccionados.',
	'COPY_PERMISSIONS_FORUM_FROM_EXPLAIN'	=> 'El foro fuente del que quiere copiar los permisos.',
	'COPY_PERMISSIONS_FORUM_TO_EXPLAIN'		=> 'El foro destino al que quiere aplicar los permisos copiados.',
	'COPY_PERMISSIONS_FROM'					=> 'Copiar permisos de',
	'COPY_PERMISSIONS_TO'					=> 'Aplicar permisos a',

	'CREATE_ROLE'				=> 'Crear rol',
	'CREATE_ROLE_FROM'			=> 'Usar parámetros para…',
	'CUSTOM'					=> 'Personalizado…',

	'DEFAULT'					=> 'Por defecto',
	'DELETE_ROLE'				=> 'Borrar rol',
	'DELETE_ROLE_CONFIRM'		=> '¿Está seguro de que quiere borrar este rol? Elementos que tengan este rol asignado <strong>no</strong> perderán sus permisos.',
	'DISPLAY_ROLE_ITEMS'		=> 'Ver elementos usando este rol',

	'EDIT_PERMISSIONS'			=> 'Editar permisos',
	'EDIT_ROLE'					=> 'Editar rol',

	'GROUPS_NOT_ASSIGNED'		=> 'Ningún grupo asignado a este rol',

	'LOOK_UP_GROUP'				=> 'Buscar grupo de usuarios',
	'LOOK_UP_USER'				=> 'Buscar usuario',

	'MANAGE_GROUPS'				=> 'Administrar grupos',
	'MANAGE_USERS'				=> 'Administrar usuarios',

	'NO_AUTH_SETTING_FOUND'		=> 'Configuración de permisos no definida.',
	'NO_ROLE_ASSIGNED'			=> 'Ningún rol asignado…',
	'NO_ROLE_ASSIGNED_EXPLAIN'	=> 'Configurar este rol no cambia ningún permiso a la derecha. Si quiere limpiar/eliminar todos los permisos debería usar el enlace "Todo <strong>NO</strong>".',
	'NO_ROLE_AVAILABLE'			=> 'Ningún rol disponible',
	'NO_ROLE_NAME_SPECIFIED'	=> 'Por favor dele un nombre al rol.',
	'NO_ROLE_SELECTED'			=> 'No se puede encontrar el rol.',
	'NO_USER_GROUP_SELECTED'	=> 'No seleccionó ningún usuario o grupo.',

	'ONLY_FORUM_DEFINED'		=> 'Solo definió foros en su selección. Por favor, también seleccione al menos un usuario o un grupo.',

	'PERMISSION_APPLIED_TO_ALL'	=> 'Permisos y roles se aplicarán también a todos los objetos marcados',
	'PLUS_SUBFORUMS'			=> 'Subforos',

	'REMOVE_PERMISSIONS'		=> 'Eliminar permisos',
	'REMOVE_ROLE'				=> 'Eliminar rol',
	'RESULTING_PERMISSION'		=> 'Resultado permiso',
	'ROLE'						=> 'Rol',
	'ROLE_ADD_SUCCESS'			=> 'Rol añadido correctamente.',
	'ROLE_ASSIGNED_TO'			=> 'Usuarios/Grupos asignados a %s',
	'ROLE_DELETED'				=> 'Rol eliminado correctamente.',
	'ROLE_DESCRIPTION'			=> 'Descripción del rol',

	'ROLE_ADMIN_FORUM'			=> 'Administrador del Foro',
	'ROLE_ADMIN_FULL'			=> 'Administrador Completo',
	'ROLE_ADMIN_STANDARD'		=> 'Administrador Estándar',
	'ROLE_ADMIN_USERGROUP'		=> 'Administrador de grupos y usuarios',
	'ROLE_FORUM_BOT'			=> 'Acceso de Robots',
	'ROLE_FORUM_FULL'			=> 'Acceso completo al foro',
	'ROLE_FORUM_LIMITED'		=> 'Acceso limitado al foro',
	'ROLE_FORUM_LIMITED_POLLS'	=> 'Acceso limitado al foro + Encuestas',
	'ROLE_FORUM_NEW_MEMBER'		=> 'Acceso de Nuevos Usuarios Registrados',
	'ROLE_FORUM_NOACCESS'		=> 'Sin acceso al foro',
	'ROLE_FORUM_ONQUEUE'		=> 'En cola de moderación',
	'ROLE_FORUM_POLLS'			=> 'Acceso al foro estándar + Encuestas',
	'ROLE_FORUM_READONLY'		=> 'Acceso al foro solo para leer',
	'ROLE_FORUM_STANDARD'		=> 'Acceso al foro estándar',
	'ROLE_MOD_FULL'				=> 'Moderador Completo',
	'ROLE_MOD_QUEUE'			=> 'Moderador de Lista de Moderación',
	'ROLE_MOD_SIMPLE'			=> 'Moderador Simple',
	'ROLE_MOD_STANDARD'			=> 'Moderador Estándar',
	'ROLE_USER_FULL'			=> 'Todas las características',
	'ROLE_USER_LIMITED'			=> 'Características limitadas',	
	'ROLE_USER_NOAVATAR'		=> 'Sin Avatar',
	'ROLE_USER_NOPM'			=> 'Sin mensajes privados',
	'ROLE_USER_STANDARD'		=> 'Características estándares',
	'ROLE_USER_NEW_MEMBER'		=> 'Características de Nuevo Usuario Registrado',

	'ROLE_DESCRIPTION_ADMIN_FORUM'			=> 'Tiene acceso a la administración y configuración de permisos de foros.',
	'ROLE_DESCRIPTION_ADMIN_FULL'			=> 'Tiene acceso a todas las funciones administrativas de este Sitio.<br />No recomendado.',
	'ROLE_DESCRIPTION_ADMIN_STANDARD'		=> 'Tiene acceso a la mayoría de las funciones administrativas, pero no a herramientas relativas al servidor o al sistema.',
	'ROLE_DESCRIPTION_ADMIN_USERGROUP'		=> 'Puede administrar grupos y usuarios: Capaz de cambiar permisos, configuraciones, administrar exclusiones y rangos.',
	'ROLE_DESCRIPTION_FORUM_BOT'			=> 'Se recomienda este rol para bots y buscadores.',
	'ROLE_DESCRIPTION_FORUM_FULL'			=> 'Puede usar todas las funciones de los foros, incluyendo avisos y mensajes fijos. También puede ignorar el límite de saturación.<br />No recomendado para usuarios corrientes.',
	'ROLE_DESCRIPTION_FORUM_LIMITED'		=> 'Puede usar algunas de las funciones de los foros, pero no enviar archivos ni usar emoticonos de mensaje.',
	'ROLE_DESCRIPTION_FORUM_LIMITED_POLLS'	=> 'Igual que Acceso Limitado y además puede crear encuestas.',	
	'ROLE_DESCRIPTION_FORUM_NOACCESS'		=> 'No puede ver ni acceder a los foros.',
	'ROLE_DESCRIPTION_FORUM_ONQUEUE'		=> 'Puede usar algunas de las funciones de los foros incluyendo adjuntos, pero debe aprobar temas y mensajes por un Administrador.',
	'ROLE_DESCRIPTION_FORUM_POLLS'			=> 'Igual que Acceso Común y además puede crear encuestas.',
	'ROLE_DESCRIPTION_FORUM_READONLY'		=> 'Puede leer el foro, pero no crear temas ni enviar mensajes.',
	'ROLE_DESCRIPTION_FORUM_STANDARD'		=> 'Puede usar algunas de las funciones de los foros incluyendo adjuntos, pero no bloquear ni borrar sus propios temas, y no puede crear encuestas.',
	'ROLE_DESCRIPTION_FORUM_NEW_MEMBER'		=> 'Un rol para los miembros del grupo especial Nuevos Usuarios Registrados; contiene permisos de <strong>NUNCA</strong> para evitar ciertas opciones para nuevos usuarios.',
	'ROLE_DESCRIPTION_MOD_FULL'				=> 'Puede usar todas las funciones de moderación y también exclusiones.',
	'ROLE_DESCRIPTION_MOD_QUEUE'			=> 'Puede usar la Lista de Moderación para validar y editar mensajes, pero nada más.',
	'ROLE_DESCRIPTION_MOD_SIMPLE'			=> 'Puede ejecutar acciones básicas. No puede enviar advertencias o usar la lista de moderación.',
	'ROLE_DESCRIPTION_MOD_STANDARD'			=> 'Puede usar la mayoría de las herramientas de moderación, pero no puede excluir usuarios o cambiar el autor del mensaje.',
	'ROLE_DESCRIPTION_USER_FULL'			=> 'Puede usar todas las funciones de los foros disponibles para usuarios, incluyendo cambios en el nombre de usuario o ignorar el límite de saturación.<br />No recomendado.',
	'ROLE_DESCRIPTION_USER_LIMITED'			=> 'Tiene acceso a algunas de las funciones de usuario. Adjuntos, e-mails, o mensajes instantáneos no le están permitidos.',	
	'ROLE_DESCRIPTION_USER_NOAVATAR'		=> 'Tiene un paquete de funciones limitado y no puede usar Avatar.',
	'ROLE_DESCRIPTION_USER_NOPM'			=> 'Tiene un paquete de funciones limitado y no puede enviar Mensajes Privados.',
	'ROLE_DESCRIPTION_USER_STANDARD'		=> 'Tiene acceso a la mayoría pero no a todas las funciones. No puede cambiar nombre de usuario o ignorar el límite de saturación, por ejemplo.',
	'ROLE_DESCRIPTION_USER_NEW_MEMBER'		=> 'Un rol para los miembros del grupo especial Nuevos Usuarios Registrados; contiene permisos de <strong>NUNCA</strong> para evitar ciertas opciones para nuevos usuarios.',

	'ROLE_DESCRIPTION_EXPLAIN'		=> 'Puede insertar una explicación corta de por qué fue creado el rol o para qué sirve. Este texto también se mostrará en la sección de permisos.',
	'ROLE_DESCRIPTION_LONG'			=> 'La descripción del rol es muy larga, por favor limítela a 4000 caracteres.',
	'ROLE_DETAILS'					=> 'Detalles del rol',
	'ROLE_EDIT_SUCCESS'				=> 'Rol editado correctamente.',
	'ROLE_NAME'						=> 'Nombre del rol',
	'ROLE_NAME_ALREADY_EXIST'		=> 'Un rol llamado <strong>%s</strong> ya existe con el tipo de permisos especificados.',
	'ROLE_NOT_ASSIGNED'				=> 'El rol no ha sido asignado aún.',

	'SELECTED_FORUM_NOT_EXIST'		=> 'El foro seleccionado no existe.',
	'SELECTED_GROUP_NOT_EXIST'		=> 'El grupo seleccionado no existe.',
	'SELECTED_USER_NOT_EXIST'		=> 'El usuario seleccionado no existe.',
	'SELECT_FORUM_SUBFORUM_EXPLAIN'	=> 'El foro seleccionado incluye todos sus subforos',
	'SELECT_ROLE'					=> 'Seleccione rol…',
	'SELECT_TYPE'					=> 'Seleccione tipo',
	'SET_PERMISSIONS'				=> 'Configurar permisos',
	'SET_ROLE_PERMISSIONS'			=> 'Configurar permisos de rol',
	'SET_USERS_PERMISSIONS'			=> 'Configurar permisos de usuario',
	'SET_USERS_FORUM_PERMISSIONS'	=> 'Configurar permisos de usuario de foros',

	'TRACE_DEFAULT'							=> 'Por defecto cada permiso es <strong>NO</strong>. Aquí el permiso puede ser reemplazado por otras configuraciones.',
	'TRACE_FOR'								=> 'Seguimiento de',
	'TRACE_GLOBAL_SETTING'					=> '%s (global)',
	'TRACE_GROUP_NEVER_TOTAL_NEVER'			=> 'Los permisos de este grupo valen <strong>NUNCA</strong> como valor total así que se mantiene el valor anterior.',
	'TRACE_GROUP_NEVER_TOTAL_NEVER_LOCAL'	=> 'Los permisos de este grupo valen <strong>NUNCA</strong> como valor total así que se mantiene el valor anterior.',
	'TRACE_GROUP_NEVER_TOTAL_NO'			=> 'Los permisos de este grupo valen <strong>NUNCA</strong> que pasa a ser el nuevo valor total porque aún no se ha configurado (configurar a <strong>NO</strong>).',
	'TRACE_GROUP_NEVER_TOTAL_NO_LOCAL'		=> 'El permiso de este grupo vale <strong>NUNCA</strong> que pasa a ser el nuevo valor total porque aún no se ha configurado (configurar a <strong>NO</strong>).',
	'TRACE_GROUP_NEVER_TOTAL_YES'			=> 'Los permisos de este grupo valen <strong>NUNCA</strong> lo cual reemplaza el total <strong>SÍ</strong> por <strong>NUNCA</strong> para este usuario.',
	'TRACE_GROUP_NEVER_TOTAL_YES_LOCAL'		=> 'El permiso de este grupo vale <strong>NUNCA</strong> which overwrites the total <strong>SÍ</strong> to a <strong>NUNCA</strong> for this user.',
	'TRACE_GROUP_NO'						=> 'El permiso es <strong>NO</strong> para este grupo así que se mantiene el valor anterior.',
	'TRACE_GROUP_NO_LOCAL'					=> 'El permiso es <strong>NO</strong> para este grupo dentro de este foro así que se mantiene el valor anterior.',
	'TRACE_GROUP_YES_TOTAL_NEVER'			=> 'Los permisos de este grupo valen <strong>SÍ</strong> pero el total <strong>NUNCA</strong> no puede ser reemplazado.',
	'TRACE_GROUP_YES_TOTAL_NEVER_LOCAL'		=> 'El permiso de este grupo vale <strong>SÍ</strong> pero el total <strong>NUNCA</strong> no puede ser sobreescrito.',
	'TRACE_GROUP_YES_TOTAL_NO'				=> 'Los permisos de este grupo valen <strong>SÍ</strong> que pasa a ser el nuevo valor total porque aún no se ha configurado (configurar a  <strong>NO</strong>).',
	'TRACE_GROUP_YES_TOTAL_NO_LOCAL'		=> 'El permiso de este grupo vale <strong>SÍ</strong> que pasa a ser el nuevo valor total porque aún no se ha configurado (configurar a <strong>NO</strong>).',
	'TRACE_GROUP_YES_TOTAL_YES'				=> 'Los permisos de este grupo valen <strong>SÍ</strong> y el total de permisos ya vale <strong>SÍ</strong>, así que se mantiene el total.',
	'TRACE_GROUP_YES_TOTAL_YES_LOCAL'		=> 'El permiso de este grupo para este foro vale <strong>SÍ</strong> y el permiso total ya está definido como <strong>SÍ</strong>, así que el resultado total se mantiene.',
	'TRACE_PERMISSION'						=> 'Rastrear permisos - %s',
	'TRACE_RESULT'							=> 'Resultado rastreo',
	'TRACE_SETTING'							=> 'Rastrear configuración',

	'TRACE_USER_GLOBAL_YES_TOTAL_YES'		=> 'Los permisos de usuario para este foro en particular valen <strong>SÍ</strong> pero el permiso global ya vale <strong>SÍ</strong>, así que se mantiene el resultado total. %sRastrear permisos globales%s',
	'TRACE_USER_GLOBAL_YES_TOTAL_NEVER'		=> 'Los permisos de usuario para este foro en particular valen <strong>SÍ</strong> lo cual reemplaza el actual resultado local <strong>NUNCA</strong>. %sRastrear permisos globales%s',
	'TRACE_USER_GLOBAL_NEVER_TOTAL_KEPT'	=> 'Los permisos de usuario para este foro en particular valen <strong>NUNCA</strong> lo cual no influye en los permisos locales. %sRastrear permisos globales%s',

	'TRACE_USER_FOUNDER'					=> 'El usuario es un fundador, por lo tanto los permisos del admin pasan a ser <strong>SÍ</strong> por defecto.',
	'TRACE_USER_KEPT'						=> 'El permiso de usuario para este foro vale <strong>NO</strong> así que se mantiene el valor anterior.',
	'TRACE_USER_KEPT_LOCAL'					=> 'El permiso de usuario para este foro vale <strong>NO</strong> así que se mantiene el valor anterior.',
	'TRACE_USER_NEVER_TOTAL_NEVER'			=> 'El permiso de usuario vale <strong>NUNCA</strong> y el valor total es <strong>NUNCA</strong>, así que no cambia nada.',
	'TRACE_USER_NEVER_TOTAL_NEVER_LOCAL'	=> 'El permiso de usuario para este foro se ha establecido en <strong>NUNCA</strong> y el valor total se establece como <strong>NUNCA</strong>, por lo que nada cambia.',
	'TRACE_USER_NEVER_TOTAL_NO'				=> 'El permiso de usuario vale <strong>NUNCA</strong> que pasa a ser el valor total (que se había configurado en <strong>NUNCA</strong>).',
	'TRACE_USER_NEVER_TOTAL_NO_LOCAL'		=> 'El permiso de usuario para este foro se ha establecido en <strong>NUNCA</strong> el cual se transforma en el valor total porque se estableció como NO.',
	'TRACE_USER_NEVER_TOTAL_YES'			=> 'El permiso de usuario vale <strong>NUNCA</strong> y reemplaza al <strong>SÍ</strong> previo.',
	'TRACE_USER_NEVER_TOTAL_YES_LOCAL'		=> 'El permiso de usuario para este foro se ha establecido en <strong>NUNCA</strong> y sobreescribe el <strong>SÍ</strong> previo.',
	'TRACE_USER_NO_TOTAL_NO'				=> 'El permiso de usuario vale <strong>NO</strong> y el valor total ya era <strong>NO</strong> así que por defecto es <strong>NUNCA</strong>.',
	'TRACE_USER_NO_TOTAL_NO_LOCAL'			=> 'El permiso de usuario para este foro vale <strong>NO</strong> y el valor total ya era <strong>NO</strong> así que por defecto es <strong>NUNCA</strong>.',
	'TRACE_USER_YES_TOTAL_NEVER'			=> 'El permiso de usuario vale <strong>SÍ</strong> pero el total <strong>NUNCA</strong> no puede ser reemplazado.',
	'TRACE_USER_YES_TOTAL_NEVER_LOCAL'		=> 'El permiso de usuario para este foro se ha establecido en <strong>SÍ</strong> pero el valor total <strong>NUNCA</strong> no puede ser sobreescrito.',
	'TRACE_USER_YES_TOTAL_NO'				=> 'El permiso de usuario vale <strong>SÍ</strong> que pasa a ser el valor total (que se había configurado en <strong>NO</strong>).',
	'TRACE_USER_YES_TOTAL_NO_LOCAL'			=> 'El permiso de usuario para este foro se ha establecido en <strong>SÍ</strong> el cual se transforma en el valor total porque se estableció como <strong>NO</strong>.',
	'TRACE_USER_YES_TOTAL_YES'				=> 'El permiso de usuario vale <strong>SÍ</strong> y el valor total también es <strong>SÍ</strong>, así que no cambia nada.',
	'TRACE_USER_YES_TOTAL_YES_LOCAL'		=> 'El permiso de usuario para este foro se ha establecido en <strong>SÍ</strong> pero el valor total se establece como <strong>SÍ</strong>, por lo que nada cambia.',
	'TRACE_WHO'								=> 'Quién',
	'TRACE_TOTAL'							=> 'Total',

	'USERS_NOT_ASSIGNED'		=> 'No hay usuarios asignados a este rol',
	'USER_IS_MEMBER_OF_DEFAULT'	=> 'es miembro de los siguiente grupos por defecto',
	'USER_IS_MEMBER_OF_CUSTOM'	=> 'es miembro de los siguientes grupos personalizados',

	'VIEW_ASSIGNED_ITEMS'		=> 'Ver elementos asignados',
	'VIEW_LOCAL_PERMS'			=> 'Permisos locales',
	'VIEW_GLOBAL_PERMS'			=> 'Permisos globales',
	'VIEW_PERMISSIONS'			=> 'Ver permisos',

	'WRONG_PERMISSION_TYPE'				=> 'Tipo de permiso incorrecto.',
	'WRONG_PERMISSION_SETTING_FORMAT'	=> 'La configuración de los permisos está en un formato incorrecto, phpBB no puede procesarlos correctamente.',
));
