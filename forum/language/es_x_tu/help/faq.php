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

$lang = array_merge($lang, array(
	'HELP_FAQ_ATTACHMENTS_ALLOWED_ANSWER'	=> 'Cada foro puede permitir o no ciertos tipos de archivos adjuntos. Si no está seguro de que tipos de archivos se pueden cargar, comuníquese con La Administración para obtener más información.',
	'HELP_FAQ_ATTACHMENTS_ALLOWED_QUESTION'	=> '¿Qué archivos adjuntos son permitidos en este foro?',
	'HELP_FAQ_ATTACHMENTS_OWN_ANSWER'	=> 'Para encontrar la lista de sus archivos adjuntos, debe entrar en el Panel de Control de Usuario y hacer clic en la opción "Organizar adjuntos".',
	'HELP_FAQ_ATTACHMENTS_OWN_QUESTION'	=> '¿Cómo encuentro todos mis archivos adjuntos?',

	'HELP_FAQ_BLOCK_ATTACHMENTS'	=> 'Archivos Adjuntos',
	'HELP_FAQ_BLOCK_BOOKMARKS'	=> 'Suscripciones y Favoritos',
	'HELP_FAQ_BLOCK_FORMATTING'	=> 'Formatos y tipos de temas',
	'HELP_FAQ_BLOCK_FRIENDS'	=> 'Amigos e Ignorados',
	'HELP_FAQ_BLOCK_GROUPS'	=> 'Niveles de usuario y grupos',
	'HELP_FAQ_BLOCK_ISSUES'	=> 'Acerca de phpBB',
	'HELP_FAQ_BLOCK_LOGIN'	=> 'Problemas acerca de la identificación y el registro',
	'HELP_FAQ_BLOCK_PMS'	=> 'Mensajería privada',
	'HELP_FAQ_BLOCK_POSTING'	=> 'Publicación de mensajes',
	'HELP_FAQ_BLOCK_SEARCH'	=> 'Búsqueda en los foros',
	'HELP_FAQ_BLOCK_USERSETTINGS'	=> 'Preferencias de usuario y configuraciones',

	'HELP_FAQ_BOOKMARKS_DIFFERENCE_ANSWER'	=> 'En phpBB 3.0, los temas Favoritos trabajaron mucho como marcadores para el navegador web. Usted no era alertado cuando había una actualización. A partir de phpBB 3.1, los Favoritos son más como suscribirse a un tema. Usted puede ser notificado cuando un tema Favorito se actualiza. Al suscribirte, sin embargo, se le avisará de que hay una actualización de un tema, o foro en el propio foro. Las opciones de notificación para los Favoritos y las suscripciones se pueden configurar en el Panel de Control de Usuario, en "Preferencias de Foros".',
	'HELP_FAQ_BOOKMARKS_DIFFERENCE_QUESTION'	=> '¿Cuál es la diferencia entre añadir como Favorito y suscribirme a un tema?',
	'HELP_FAQ_BOOKMARKS_FORUM_ANSWER'	=> 'Para suscribirse a un foro en especial, debe hacer clic en el enlace "Suscribir Foro".',
	'HELP_FAQ_BOOKMARKS_FORUM_QUESTION'	=> '¿Cómo me suscribo a un foro específico?',
	'HELP_FAQ_BOOKMARKS_REMOVE_ANSWER'	=> 'Para eliminar sus suscripciones, debe entrar en el Panel de Control de Usuario y hacer clic en la opción "Organizar suscripciones".',
	'HELP_FAQ_BOOKMARKS_REMOVE_QUESTION'	=> '¿Cómo borro mis suscripciones?',
	'HELP_FAQ_BOOKMARKS_TOPIC_ANSWER'	=> 'Puede marcar o suscribirse a un tema específico haciendo clic en el enlace correspondiente en el menú "Herramientas de Tema", ubicado cerca de la parte superior e inferior de un tema de discusión.<br />Respondiendo a un tema con la opción marcada de "Notificarme cuando se publique una respuesta" también le suscribe a dicho tema.',
	'HELP_FAQ_BOOKMARKS_TOPIC_QUESTION'	=> '¿Cómo marcar Favoritos o suscribirse a temas específicos?',

	'HELP_FAQ_FORMATTING_ANNOUNCEMENT_ANSWER'	=> 'Los anuncios muchas veces contienen información importante sobre el foro que se encuentra leyendo y debería leerlos cada vez que sea posible. Los anuncios aparecen al principio de cada página en el foro donde se publicaron. Como en los anuncios globales, los permisos para anuncios son otorgados por La Administración.',
	'HELP_FAQ_FORMATTING_ANNOUNCEMENT_QUESTION'	=> '¿Qué son los anuncios?',
	'HELP_FAQ_FORMATTING_BBOCDE_ANSWER'	=> 'BBcode es una implementación especial de HTML, ofrece un gran control de formato de los objetos particulares de las publicaciones. El uso de BBCode debe ser habilitado por la administración, pero también puede ser deshabilitado del formulario de publicación de mensajes. BBCode asimismo es similar en estilo al HTML, pero las etiquetas se encuentran encerrados entre corchetes [ y ] en lugar de &lt; y &gt;. Para más información, lea el manual de BBCode. El enlace aparece cada vez que va a publicar un mensaje.',
	'HELP_FAQ_FORMATTING_BBOCDE_QUESTION'	=> '¿Qué es el código BBCode?',
	'HELP_FAQ_FORMATTING_GLOBAL_ANNOUNCE_ANSWER'	=> 'Los anuncios globales contienen información importante y debería leerlos cada vez que sea posible. Éstos aparecerán al principio de cada foro y en el Panel de Control de Usuario. Los permisos para anuncios globales son otorgados por La Administración.',
	'HELP_FAQ_FORMATTING_GLOBAL_ANNOUNCE_QUESTION'	=> '¿Qué son los anuncios globales?',
	'HELP_FAQ_FORMATTING_HTML_ANSWER'	=> 'No. No es posible publicar en HTML. Muchos de los formatos y acciones que se pueden ejecutar utilizando HTML pueden ser aplicados utilizando BBCodes.',
	'HELP_FAQ_FORMATTING_HTML_QUESTION'	=> '¿Puedo usar HTML?',
	'HELP_FAQ_FORMATTING_ICONS_ANSWER'	=> 'Son imágenes elegidas por el autor del tema para indicar el contenido del mismo. La posibilidad de usar iconos en los mensajes depende de los permisos otorgados por La Administración.',
	'HELP_FAQ_FORMATTING_ICONS_QUESTION'	=> '¿Qué son los iconos para los temas?',
	'HELP_FAQ_FORMATTING_IMAGES_ANSWER'	=> 'Sí, las imágenes se pueden mostrar en sus mensajes. Si la administración permite adjuntar archivos, puede subir la imagen directamente al foro. De otra manera, debe guardar primero su foto en un servidor de acceso público, e.j. http://www.ejemplo.com/mi-imagen.gif. No puede publicar imágenes que se encuentren en su PC (a menos que sea un servidor de acceso público) ni tampoco las que se encuentren guardadas bajo mecanismos de autenticación, e.j. hotmail o yahoo correo, sitios protegidos por contraseñas, etc. Para exhibir imágenes utilice el BBCode con la etiqueta [img].',
	'HELP_FAQ_FORMATTING_IMAGES_QUESTION'	=> '¿Puedo publicar imagenes?',
	'HELP_FAQ_FORMATTING_LOCKED_ANSWER'	=> 'Los temas cerrados son temas donde los usuarios ya no pueden responder y las encuestas allí contenidas terminaron automáticamente. Los temas pueden ser cerrados por muchas razones. Esta decisión es tomada por La Administración o un moderador. Tal vez pueda cerrar sus propios temas dependiendo de los permisos que le hayan concedido los administradores.',
	'HELP_FAQ_FORMATTING_LOCKED_QUESTION'	=> '¿Qué son los temas cerrados?',
	'HELP_FAQ_FORMATTING_SMILIES_ANSWER'	=> 'Los emoticonos son pequeñas imágenes que pueden ser utilizadas para expresar un sentimiento con un pequeño código, e.j. :) denota felicidad, mientras que :( denota tristeza. La lista completa de emoticones puede verse en el formulario de publicación. Trate de no abusar del uso de emoticonos, pues pueden hacer que un mensaje se vuelva muy difícil de leer y un moderador borre el tema o los emoticones del mensaje. La administración puede fijar un límite para el número de emoticones a utilizar en un mensaje.',
	'HELP_FAQ_FORMATTING_SMILIES_QUESTION'	=> '¿Qué son los emoticonos?',
	'HELP_FAQ_FORMATTING_STICKIES_ANSWER'	=> 'Los temas fijos aparecen en el foro por debajo de los anuncios y solo en la primer página. Muchas veces son importantes por lo que debería leerlos cada vez que sea posible. Como en los anuncios globales y anuncios, los permisos para fijar un tema son otorgados por La Administración.',
	'HELP_FAQ_FORMATTING_STICKIES_QUESTION'	=> '¿Qué son los temas fijos?',

	'HELP_FAQ_FRIENDS_BASIC_ANSWER'	=> 'Puede utilizar la lista para organizar otros usuarios del foro. Los usuarios añadidos a su lista de Amigos podrán verse en en Panel de Control de Usuario para un rápido acceso a ver si están identificados y poder así enviarles un mensaje privado. Según la plantilla que utilice el foro, los mensajes de estos usuarios pueden visualizarse resaltados. Si añade un usuario a su lista de Ignorados, todos sus mensajes quedarán ocultos.',
	'HELP_FAQ_FRIENDS_BASIC_QUESTION'	=> '¿Qué es la lista de Mis Amigos e Ignorados?',
	'HELP_FAQ_FRIENDS_MANAGE_ANSWER'	=> 'Puede añadir usuarios a su lista de dos maneras. En cada perfil de usuario hay un enlace para añadirlo a su lista de Amigos y/o Ignorados. También puede hacerlo desde el Panel de Control de Usuario directamente, introduciendo su nombre. Puede eliminar usuarios de su lista desde esta misma página.',
	'HELP_FAQ_FRIENDS_MANAGE_QUESTION'	=> '¿Cómo se puede añadir o borrar usuarios de mi lista de Amigos e Ignorados?',

	'HELP_FAQ_GROUPS_ADMINISTRATORS_ANSWER'	=> 'Los Administradores son los usuarios asignados con el mayor nivel de control sobre el foro entero. Estos usuarios pueden controlar todas las acciones y configuraciones del foro, incluyendo configuraciones de permisos, baneo de usuarios, creación de grupos usuarios y moderadores, etc. Dependen del fundador del foro y de los permisos que éste les ha dado. Ellos también tienen todas las capacidades de moderación en cada uno de los foros, dependiendo de las configuraciones realizadas por el fundador del sitio.',
	'HELP_FAQ_GROUPS_ADMINISTRATORS_QUESTION'	=> '¿Qué son los Administradores?',
	'HELP_FAQ_GROUPS_COLORS_ANSWER'	=> 'La Administración del foro tiene la posibilidad de asignar un color a los usuarios de un grupo para hacer más fácil su identificación.',
	'HELP_FAQ_GROUPS_COLORS_QUESTION'	=> '¿Por qué algunos Grupos de Usuarios aparecen en diferentes colores?',
	'HELP_FAQ_GROUPS_DEFAULT_ANSWER'	=> 'Si es miembro de más de un grupo por defecto, se usará el "predeterminado" para determinar qué color y rango se mostrará por defecto en su perfil. La Administración debe darle permisos para cambiar su grupo por defecto mediante su Panel de Control de Usuario.',
	'HELP_FAQ_GROUPS_DEFAULT_QUESTION'	=> '¿Qué es un "Grupo de Usuarios predeterminado"?',
	'HELP_FAQ_GROUPS_MODERATORS_ANSWER'	=> 'Los Moderadores son individuos (o grupos de individuos) que cuidan el foro día a día. Tienen la autoridad para editar o borrar mensajes, cerrarlos, abrirlos, moverlos, borrar y separar temas en el foro que moderan. Generalmente, los moderadores están presentes para evitar que los usuarios se salgan del tema tratado o publiquen spam y/o contenido malicioso.',
	'HELP_FAQ_GROUPS_MODERATORS_QUESTION'	=> '¿Qué son los Moderadores?',
	'HELP_FAQ_GROUPS_TEAM_ANSWER'	=> 'Esta página le provee de la lista completa de los usuarios del grupo, incluyendo los administradores, moderadores y otros detalles, como los foros que se encarga de moderar cada uno.',
	'HELP_FAQ_GROUPS_TEAM_QUESTION'	=> '¿Qué es el enlace "El equipo"?',
	'HELP_FAQ_GROUPS_USERGROUPS_ANSWER'	=> 'Los Grupos de Usuarios son conjuntos de usuarios que dividen a la comunidad en sectores manejables con los cuales puede trabajar los administradores del foro. Cada usuario puede pertenecer a varios grupos y cada grupo puede tener diferentes permisos. Esto ayuda, a los administradores, a cambiar los permisos de muchos usuarios a la vez, tales como los permisos de moderador, o garantizar el acceso a foros privados a los usuarios.',
	'HELP_FAQ_GROUPS_USERGROUPS_JOIN_ANSWER'	=> 'Puede ver todos los Grupos de usuarios a través del enlace "Grupos de Usuarios". Si desea unirse a algún grupo, puede proceder haciendo clic en el botón apropiado. No todos los grupos tienen libre acceso. Sin embargo, algunos requieren aprobación para poder unirse, otros están cerrados y algunos son ocultos. Si el grupo se encuentra abierto, puede unirse haciendo clic en el botón correspondiente. Si el grupo requiere de aprobación para unirse, puede solicitar unirse haciendo clic en el botón correspondiente. El responsable del grupo deberá aprobar su solicitud y seguramente le preguntará por qué desea hacerlo. Por favor no moleste continuamente al Responsable de Grupo si rechaza su solicitud; seguramente tenga sus razones.',
	'HELP_FAQ_GROUPS_USERGROUPS_JOIN_QUESTION'	=> '¿Donde están los Grupos de Usuarios y como me puedo unir a ellos?',
	'HELP_FAQ_GROUPS_USERGROUPS_LEAD_ANSWER'	=> 'El Responsable de un grupo es asignado por La Administración al crear el grupo. Si está interesado en crear un grupo de usuarios, contacte con La Administración.',
	'HELP_FAQ_GROUPS_USERGROUPS_LEAD_QUESTION'	=> '¿Cómo me convierto en Responsable del Grupo?',
	'HELP_FAQ_GROUPS_USERGROUPS_QUESTION'	=> '¿Qué son los Grupos de Usuarios?',

	'HELP_FAQ_ISSUES_ADMIN_ANSWER'	=> 'Todos los usuarios del foro pueden usar el formulario “Contáctenos”, si está opción ha sido habilitada por el Administrador del foro.<br />Los miembros del foro también pueden usar el enlace "El equipo".',
	'HELP_FAQ_ISSUES_ADMIN_QUESTION'	=> '¿Cómo puedo ponerme en contacto con un Administrador?',
	'HELP_FAQ_ISSUES_FEATURE_ANSWER'	=> 'Este foro fue escrito y licenciado a través de phpBB Limited. Si usted cree que se debe añadir alguna característica por favor visite <a href="https://www.phpbb.com/ideas/">Centro de phpBB Ideas</a> (en Inglés), donde se puede votar en ideas existentes o sugerir nuevas características.',
	'HELP_FAQ_ISSUES_FEATURE_QUESTION'	=> '¿Por qué este foro no tiene tal cosa?',
	'HELP_FAQ_ISSUES_LEGAL_ANSWER'	=> 'Cada uno de los administradores que figuran en la lista del grupo donde dice "El Equipo" es un contacto apropiado para enviar sus quejas. Si así no obtiene respuesta debería tratar de contactar con el dueño del dominio (efectúe una <a href="http://www.google.com/search?q=whois">búsqueda whois</a>) o, si este foro tiene correo sobre un dominio gratuito (Yahoo!, gmail.com, hotmail.com, etc.), al departamento o administración de abusos de ese servicio. Por favor, tenga en cuenta que phpBB Limited <strong>carece de cualquier tipo de control</strong> y no puede ser de ninguna manera responsable sobre cómo, dónde o por quién es usado este sistema de foros. No tiene ningún sentido contactar con phpBB Limited en relación a asuntos legales (difamación, responsabilidad, deformación de comentarios, etc.) que no sean con respecto al sitio phpbb.com o la discreción misma del software phpBB. Si envia un correo a phpBB Limited <strong>respecto del uso de terceras partes</strong> de este software esté dispuesto a recibir una respuesta cortante o directamente no recibir respuesta.',
	'HELP_FAQ_ISSUES_LEGAL_QUESTION'	=> '¿Con quién se puede contactar acerca de abusos o usos ilegales relacionados con este foro?',
	'HELP_FAQ_ISSUES_WHOIS_PHPBB_ANSWER'	=> 'Esta aplicación (en su forma original) es desarrollada, publicada y contiene derechos de autor pertenecientes a <a href="https://www.phpbb.com/">phpBB Limited</a>. Está hecho bajo la GNU (Licencia Pública General) versión 2 (GPL-2.0) y es de libre distribución. Vea <a href="https://www.phpbb.com/about/">About phpBB</a> para más detalles.',
	'HELP_FAQ_ISSUES_WHOIS_PHPBB_QUESTION'	=> '¿Quién programó este foro?',

	'HELP_FAQ_LOGIN_AUTO_LOGOUT_ANSWER'	=> 'Si no activa la casilla <em>Recordar</em> cuando ingresa al foro, sus datos se guardan en una cookie segura, que se elimina al salir de la página o al cabo de cierto tiempo. Esto previene que su cuenta pueda ser usada por otra persona. Para que el sistema le reconozca automáticamente solo marque la casilla al ingresar. No es recomendable si accede al foro desde un PC compartido, e.j. biblioteca, cyber-cafés, PCs de universidades, etc. Si no ve la casilla, significa que la administración del foro ha deshabilitado la opción.',
	'HELP_FAQ_LOGIN_AUTO_LOGOUT_QUESTION'	=> '¿Por qué mi sesión de usuario expira automáticamente?',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANSWER'	=> 'Existen varias razones por lo cuál esto puede suceder. Primero, asegúrese de que su nombre de usuario y contraseña se encuentren escritos correctamente. Si lo están, comuníquese con La Administración para asegurarse de que no ha sido excluido. También es posible que el foro esté mal configurado por su dueño y/o tenga fallos en la programación, por lo que necesitaría ser reparado.',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANYMORE_ANSWER'	=> 'Es posible que la administración haya desactivado o borrado su cuenta por alguna razón. También, algunos foros periódicamente remueven sus usuarios que no publicaron mensajes por cierto periodo de tiempo para reducir el peso de la base de datos. Si es así, registrese de nuevo y participe de las discuciones.',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANYMORE_QUESTION'	=> 'Hace un tiempo me registré, ¡pero ahora no puedo conectarme!',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_QUESTION'	=> '¿Por qué no puedo identificarme?',
	'HELP_FAQ_LOGIN_CANNOT_REGISTER_ANSWER'	=> 'Es posible que La Administración del sitio haya baneado su dirección IP o que el nombre de usuario con el que está intentando registrarse, esté deshabilitado. También puede estar deshabilitado el registro de nuevos usuarios. Póngase en contacto con La Administración del sitio.',
	'HELP_FAQ_LOGIN_CANNOT_REGISTER_QUESTION'	=> '¿Por qué no puedo registrarme?',
	'HELP_FAQ_LOGIN_COPPA_ANSWER'	=> 'COPPA, APPCO, o Acta de Privacidad y Protección de Niños menores de 13 años del año 1998, es una ley de los Estados Unidos, donde se solicita a los sitios de Internet, los cuales son potenciales recolectores de información, que el registro de niños sea escrito y ratificado con el consentimiento de los padres o con algún otro método de reconocimiento de guardia legal, que permita recolectar información personal identificable de un menor de edad.',
	'HELP_FAQ_LOGIN_COPPA_QUESTION'	=> '¿Qué es COPPA? (APPCO)',
	'HELP_FAQ_LOGIN_DELETE_COOKIES_ANSWER'	=> '"Borrar cookies" borra las cookies creadas por phpBB, las cuales le mantienen autorizado para acceder a determinados recursos del foro y estar identificado al mismo. Las cookies proveen funciones como leer el seguimiento de la navegación del foro por el usuario si la administración ha habilitado la opción. Si está teniendo problemas con el ingreso o salida del foro, borrar las cookies seguramente ayudará.',
	'HELP_FAQ_LOGIN_DELETE_COOKIES_QUESTION'	=> '¿Cuál es la función de "Borrar cookies"?',
	'HELP_FAQ_LOGIN_LOST_PASSWORD_ANSWER'	=> 'No se asuste, ¡calma! Si su contraseña no puede ser recuperada puede desactivarla o cambiarla. Visite la página de ingreso (login) y haga clic en <em>Olvidé mi contraseña</em>. Siga las instrucciones y estará identificado nuevamente en muy poco tiempo.',
	'HELP_FAQ_LOGIN_LOST_PASSWORD_QUESTION'	=> '¡Perdí mi contraseña!',
	'HELP_FAQ_LOGIN_REGISTER_ANSWER'	=> 'No está obligado a hacerlo, la decisión la toman los Administradores y Moderadores. En algunos casos necesitará registrarse para publicar temas y respuestas. Sin embargo, estar registrado le dará acceso a contenidos adicionales y/o ventajas que como usuario invitado no disfrutaría, como tener su imagen personalizada (avatar), mensajes privados, suscripción a grupos de usuarios, etc. Tan solo le tomará unos segundos. Es muy recomendable.',
	'HELP_FAQ_LOGIN_REGISTER_CONFIRM_ANSWER'	=> 'Primero, verifique su nombre de usuario y contraseña. Si todo está correcto, hay dos posibles razones. Si el Sistema de Protección Infantil (APPCO) está activado y cuando se registró eligió la opción <em>Soy menor de 13 años</em> entonces tendrá que seguir algunas instrucciones que se le darán para activar la cuenta. Algunos foros disponen que las cuentas deben ser activadas, ya sea por usted mismo o por La Administración, antes de que pueda identificarse; esta información se le brindará al finalizar el proceso de registro. Si se le envió un e-mail, siga las instrucciones. Si no recibió ningún e-mail, seguramente la dirección de correo electrónico que proporcionó no es correcta o tal vez haya sido capturada por un filtro anti-spam. Si está seguro de que la dirección de e-mail que proporcionó es correcta, envíe un mensaje a La Administración.',
	'HELP_FAQ_LOGIN_REGISTER_CONFIRM_QUESTION'	=> 'Me he registrado ¡y no me puedo identificar!',
	'HELP_FAQ_LOGIN_REGISTER_QUESTION'	=> '¿Por qué me tengo que registrar?',

	'HELP_FAQ_PMS_CANNOT_SEND_ANSWER'	=> 'Hay tres razones posibles; no está registrado y/o identificado, La Administración del foro ha deshabilitado la opción de mensajes privados para todos los usuarios, o bien La Administración ha deshabilitado para usted, o su grupo de usuarios, la opción de enviar mensajes. Comuníquese con La Administración para más información.',
	'HELP_FAQ_PMS_CANNOT_SEND_QUESTION'	=> '¡No puedo enviar un mensaje privado!',
	'HELP_FAQ_PMS_SPAM_ANSWER'	=> 'Lamentamos oír eso. El formulario de e-mail incluye identificadores para controlar quién ha enviado tales mensajes, por lo tanto, puede contactar con La Administración y hacerles llegar una copia completa del mensaje que recibió. Es muy importante que incluya la cabecera, ya que contiene los datos del usuario que envió el e-mail. La Administración tomará medidas.',
	'HELP_FAQ_PMS_SPAM_QUESTION'	=> '¡Recibí spam o correos maliciosos de alguien en este foro!',
	'HELP_FAQ_PMS_UNWANTED_ANSWER'	=> 'Si está recibiendo mensajes maliciosos u ofensivos de un usuario en particular, puede bloquearlo para que no le pueda enviar mensajes dentro de las opciones del Panel de Control de Usuario, puede usar el botón para informar o reportar dichos mensajes a los Moderadores, o comunicarlo a La Administración.',
	'HELP_FAQ_PMS_UNWANTED_QUESTION'	=> '¡Recibo mensajes privados no deseados!',

	'HELP_FAQ_POSTING_BUMP_ANSWER'	=> 'Puede hacerlo dándole clic al enlace que dice "Reactivar tema" cuando esté viendo el mismo, puede "reactivar" el tema al principio de la primera página. Sin embargo, si no lo visualiza, entonces el tema reactivado ha sido deshabilitado o el tiempo para poder reactivarlo no ha sido alcanzado aún. También es posible reactivar un tema respondiendo al mismo, sin embargo, lea las reglas del foro antes de hacerlo.',
	'HELP_FAQ_POSTING_BUMP_QUESTION'	=> '¿Cómo hago para reactivar un tema?',
	'HELP_FAQ_POSTING_CREATE_ANSWER'	=> 'Para publicar un nuevo tema, haga clic en "Nuevo tema". Para publicar una respuesta a un tema, haga clic en "Enviar respuesta". Seguramente necesite registrarse antes de poder publicar y responder. Abajo de cada foro encontrará una lista de acciones permitidas. Ejemplo: Puede publicar nuevos temas, Puede votar en las encuestas, etc.',
	'HELP_FAQ_POSTING_CREATE_QUESTION'	=> '¿Cómo puedo crear un nuevo tema o enviar una respuesta?',
	'HELP_FAQ_POSTING_DRAFT_ANSWER'	=> 'Esto le permitirá guardar borradores que serán completados y enviados más tarde. Para recargar un borrador guardado, visite el Panel de Control de Usuario.',
	'HELP_FAQ_POSTING_DRAFT_QUESTION'	=> '¿Para qué sirve el botón "Guardar" en la publicación de temas?',
	'HELP_FAQ_POSTING_EDIT_DELETE_ANSWER'	=> 'A menos que sea administrador o moderador, solo puede borrar o editar sus propios mensajes. Para editarlos debe hacer clic en en botón <em>editar</em> (a veces esta opción solo es válida durante un cierto periodo de tiempo). Si alguien editase su tema, encontrará un pequeño texto indicando que ha sido modificado y las veces que lo ha sido. No aparece si fue un moderador o la administración quién lo editó, aunque la mayoría de las veces el editor deja su nombre de usuario y la causa de la edición. Los usuarios normales no podrán borrar sus temas después de que alguien haya respondido al mismo.',
	'HELP_FAQ_POSTING_EDIT_DELETE_QUESTION'	=> '¿Cómo se puede editar o borrar un mensaje?',
	'HELP_FAQ_POSTING_FORUM_RESTRICTED_ANSWER'	=> 'Algunos foros pueden estar limitados para ciertos usuarios o grupos y para visualizar, leer, publicar o llevar a cabo otra acción allí necesita una autorización especial. Comuníquese con un moderador o administrador del foro para que se le conceda el permiso adecuado.',
	'HELP_FAQ_POSTING_FORUM_RESTRICTED_QUESTION'	=> '¿Por qué no se puede acceder a algún foro?',
	'HELP_FAQ_POSTING_NO_ATTACHMENTS_ANSWER'	=> 'Los permisos para adjuntar archivos son individuales para cada foro, grupo, usuario y son concedidos por La Administración. Tal vez La Administración no permite adjuntar archivos en el foro en que se encuentra o solo ciertos grupos pueden hacerlo. Comuníquese con La Administración si no está seguro de por qué no puede adjuntar archivos.',
	'HELP_FAQ_POSTING_NO_ATTACHMENTS_QUESTION'	=> '¿Por qué no se puede añadir archivos adjuntos?',
	'HELP_FAQ_POSTING_POLL_ADD_ANSWER'	=> 'El límite para opciones de una encuesta está fijado por la administración. Si necesita añadir más opciones a la encuesta, comuníquese con La Administración.',
	'HELP_FAQ_POSTING_POLL_ADD_QUESTION'	=> '¿Por qué no se puede añadir más opciones a la encuesta?',
	'HELP_FAQ_POSTING_POLL_CREATE_ANSWER'	=> 'Cuando inicia un nuevo tema o edita el primer mensaje del mismo, debe hacer clic en la etiqueta "Agregar Encuesta" debajo del formulario de publicación; si no la visualiza, significa que no posee los permisos apropiados para crear encuestas. Inserte un título y al menos dos opciones en el campo apropiado, asegurándose de que cada opción se encuentre en la correspondiente línea del formulario. También puede elegir el número de opciones que el usuario puede seleccionar en la etiqueta "Opciones por usuario", el tiempo límite en días para la encuesta (0 para duración infinita) y por último la opción de permitir a lo usuarios cambiar su votos.',
	'HELP_FAQ_POSTING_POLL_CREATE_QUESTION'	=> '¿Cómo creo una encuesta?',
	'HELP_FAQ_POSTING_POLL_EDIT_ANSWER'	=> 'Como en los mensajes, las encuestas solo pueden ser modificadas por su creador original, un moderador o la administración. Para editar una encuesta, hay que editar el primer mensaje del tema; este siempre esta asociado a la encuesta. Si nadie ha votado, los usuarios pueden borrar la encuesta o editar las opciones. Sin embargo, si algún miembro ha votado, solo moderadores o administradores pueden editar o borrar la encuesta. Esto evita que las encuestas sean cambiadas a mitad de la votación.',
	'HELP_FAQ_POSTING_POLL_EDIT_QUESTION'	=> '¿Cómo edito o borro una encuesta?',
	'HELP_FAQ_POSTING_QUEUE_ANSWER'	=> 'La Administración del foro tal vez ha decidido que los mensajes publicados en el foro, en el que estas intentando publicar mensajes, necesiten ser revisados antes de aprobarlos. También es posible que La Administración le haya ubicado en un grupo de usuarios cuyos mensajes necesitan ser revisados antes de aprobarlos. Por favor comuníquese con el administrador para más información al respecto.',
	'HELP_FAQ_POSTING_QUEUE_QUESTION'	=> '¿Por qué mis mensajes necesitan ser aprobados?',
	'HELP_FAQ_POSTING_REPORT_ANSWER'	=> 'Si La Administración lo permite, debería ver un botón para reportar mensajes cerca del mismo. Haciendo clic sobre el botón, el foro le llevará y guiará a través de ciertos pasos necesarios para reportar el mensaje.',
	'HELP_FAQ_POSTING_REPORT_QUESTION'	=> '¿Cómo se puede reportar un mensaje a un moderador?',
	'HELP_FAQ_POSTING_SIGNATURE_ANSWER'	=> 'Para añadir una firma a sus mensajes debe crearla en el Panel de Control de Usuario. Una vez creada, active la opción <em>Añadir firma</em> cuando publique un mensaje. Puede asignar una firma por defecto a todos sus mensajes activando la casilla correcta en su Panel de Control de Usuario. Para dejar de añadirla en los mensajes, debe desactivar la opción <em>Añadir firma</em> dentro del perfil.',
	'HELP_FAQ_POSTING_SIGNATURE_QUESTION'	=> '¿Cómo se puede añadir una firma a mi mensaje?',
	'HELP_FAQ_POSTING_WARNING_ANSWER'	=> 'Los administradores de cada foro tienen su propio conjunto de reglas para su sitio. Si ha quebrantado alguna regla puede recibir una advertencia. Por favor recuerde que esta es una decisión de La Administración del foro, y phpBB Limited no tiene nada que ver con las advertencias dadas en este sitio. Comuníquese con La Administración del foro si no está seguro de porqué fue advertido.',
	'HELP_FAQ_POSTING_WARNING_QUESTION'	=> '¿Por qué recibí una advertencia?',

	'HELP_FAQ_SEARCH_BLANK_ANSWER'	=> 'La búsqueda devolvió demasiados resultados para ser procesados por el servidor. Utilice "Búsqueda Avanzada" y sea más específico en los términos y foros de su búsqueda.',
	'HELP_FAQ_SEARCH_BLANK_QUESTION'	=> '¿Por qué mi búsqueda me devuelve una página en blanco?',
	'HELP_FAQ_SEARCH_FORUM_ANSWER'	=> 'Introduciendo un término de búsqueda en el campo correspondiente del buscador del índice, foro o en los temas. Puede acceder a búsquedas avanzadas haciendo clic en el enlace "Búsqueda Avanzada" que está disponible en todas las páginas del foro. La manera de acceder a la búsqueda depende de la plantilla utilizada.',
	'HELP_FAQ_SEARCH_FORUM_QUESTION'	=> '¿Cómo se puede buscar en uno o varios foros?',
	'HELP_FAQ_SEARCH_MEMBERS_ANSWER'	=> 'Pulse en el enlace "Usuarios" y haga clic en el enlace "Buscar un usuario".',
	'HELP_FAQ_SEARCH_MEMBERS_QUESTION'	=> '¿Cómo busco usuarios?',
	'HELP_FAQ_SEARCH_NO_RESULT_ANSWER'	=> 'Probablemente su búsqueda fue muy general e incluye muchos términos comunes que no son indexados por phpBB. Sea más específico y utilice las opciones disponibles en la búsqueda avanzada.',
	'HELP_FAQ_SEARCH_NO_RESULT_QUESTION'	=> '¿Por qué mi búsqueda me devuelve ningún resultado?',
	'HELP_FAQ_SEARCH_OWN_ANSWER'	=> 'Puede encontrar sus mensajes haciendo clic en  "Mostrar sus mensajes" en el Panel de Control de Usuario o haciendo clic en el enlace "Mostrar sus mensajes" a través de su propio página de perfil, o haciendo clic en el menú "Enlaces rápidos" en la parte superior del foro. Para buscar sus temas, utilice la página de búsqueda avanzada y complete las opciones apropiadas.',
	'HELP_FAQ_SEARCH_OWN_QUESTION'	=> '¿Como se puede encontrar mis propios mensajes y temas?',

	'HELP_FAQ_USERSETTINGS_AVATAR_ANSWER'	=> 'Hay dos imágenes que pueden aparecer debajo de su nombre de usuario cuando esté viendo los mensajes. Dependiendo de la plantilla que utilice el foro, la primera imagen está asociada a la posición (rank) del usuario, generalmente en forma de estrellas, bloques o puntos, indicando la cantidad de mensajes publicados por usted o su estatus dentro del foro. La segunda, usualmente una imagen más grande, es conocida como avatar y generalmente es única o personal para cada usuario.',
	'HELP_FAQ_USERSETTINGS_AVATAR_DISPLAY_ANSWER'	=> 'Desde su Panel de Control de Usuario, haga clic en  “Perfil” puede añadir un avatar utilizando uno de los siguientes cuatro métodos: Gravatar, Galería, Remoto o Subida. Es la administración quien decide si se pueden usar o no y en que tamaño y peso pueden ser publicadas. En caso de que no este disponible la opción de avatar, comuníquese con La Administración para que sea activada.',
	'HELP_FAQ_USERSETTINGS_AVATAR_DISPLAY_QUESTION'	=> '¿Cómo puedo mostrar un avatar?',
	'HELP_FAQ_USERSETTINGS_AVATAR_QUESTION'	=> '¿Qué es la imagen al lado de mi nombre de usuario?',
	'HELP_FAQ_USERSETTINGS_CHANGE_SETTINGS_ANSWER'	=> 'Si es un usuario registrado, todos sus datos y configuraciones están archivados en nuestra base de datos. Para modificarlos, visite el Panel de Control de Usuario; haciendo clic en su nombre de usuario que se encuentra en la parte superior de las páginas del foro. Este sistema le permitirá cambiar sus datos y preferencias.',
	'HELP_FAQ_USERSETTINGS_CHANGE_SETTINGS_QUESTION'	=> '¿Cómo se puede cambiar mi configuración?',
	'HELP_FAQ_USERSETTINGS_EMAIL_LOGIN_ANSWER'	=> 'Solo usuarios registrados pueden enviar e-mail a otros usuarios a través del foro, si la administración habilita la opción. Esto es para prevenir el uso malicioso del sistema de e-mail por usuarios anónimos.',
	'HELP_FAQ_USERSETTINGS_EMAIL_LOGIN_QUESTION'	=> 'Cuando hago clic sobre el enlace de e-mail de un usuario, ¡me pide que me registre!',
	'HELP_FAQ_USERSETTINGS_HIDE_ONLINE_ANSWER'	=> 'Desde su Panel de Control de Usuario, en "Preferencias de Foros", encontrará la opción <em>Ocultar mi estado de conexións</em>. Habilite esta opción y solamente será visto por Administradores, Moderadores y usted mismo. Se le contará como usuario oculto.',
	'HELP_FAQ_USERSETTINGS_HIDE_ONLINE_QUESTION'	=> '¿Cómo evito que mi nombre de usuario aparezca en las listas de usuarios conectados?',
	'HELP_FAQ_USERSETTINGS_LANGUAGE_ANSWER'	=> 'Esto se puede deber a que la administración no ha instalado el paquete de su idioma para el foro o nadie ha creado una traducción. Pregúntele a un Administrador si puede instalar el paquete del idioma que necesita. Si el paquete no existe, siéntase libre de hacer una traducción. Puede encontrar más información en el sitio web de <a href="https://www.phpbb.com/">phpBB</a>&reg;',
	'HELP_FAQ_USERSETTINGS_LANGUAGE_QUESTION'	=> '¡Mi idioma no está en la lista!',
	'HELP_FAQ_USERSETTINGS_RANK_ANSWER'	=> 'Los rangos aparecen debajo del nombre de usuario e indican la cantidad de publicaciones realizadas por el usuario o la posición del mismo dentro del foro, e.j. moderadores y administradores. En general, no puede cambiar su rango directamente ya que está determinado por la administración. Por favor, no abuse de sus privilegios de publicación solo para incrementar su rango. La mayoría de los foros lo consideran "spam", no lo toleran,  y moderadores o administradores reducirán el número de publicaciones realizadas, llegando incluso a tomar medidas mas drásticas, como la expulsión del foro.',
	'HELP_FAQ_USERSETTINGS_RANK_QUESTION'	=> '¿Cómo se puede cambiar mi rango?',
	'HELP_FAQ_USERSETTINGS_SERVERTIME_ANSWER'	=> 'Si está seguro de que de la zona horaria es correcta y la hora sigue siendo incorrecta, entonces la hora almacenada en el servidor es errónea. Por favor comuníquese con La Administración para corregir el problema.',
	'HELP_FAQ_USERSETTINGS_SERVERTIME_QUESTION'	=> 'Cambié la zona horaria en mi perfil, ¡pero la hora sigue siendo incorrecto!',
	'HELP_FAQ_USERSETTINGS_TIMEZONE_ANSWER'	=> 'Es posible que esté viendo la hora correspondiente a otra zona horaria. Si este es el caso, visite el Panel de Control de Usuario y defina su zona horaria de acuerdo a su ubicación, e.j. Londres, París, Nueva York, Sydney, etc. Recuerde que para cambiar la zona horaria, como las demás preferencias, debe estar registrado. Si no lo está, este es un buen momento para hacerlo.',
	'HELP_FAQ_USERSETTINGS_TIMEZONE_QUESTION'	=> '¡La hora en los foros no es correcta!',
));
