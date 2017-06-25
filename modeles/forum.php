<?php
/**********************************************************************************************
On trouve les fonctions permettant de faire des modifications dans le forum
( création & suppresion de topic, modification du titre, création de post pour transfert depuis la fiche )

/**********************************************************************************************/
// Récupère l'environnement du forum
// Cette séquence ne peut pas être dans une function
if (!defined('IN_PHPBB')) {
	define('IN_PHPBB', true);
	$phpbb_root_path = $config_wri['rep_forum'];
	$phpEx = substr(strrchr(__FILE__, '.'), 1);
	include($phpbb_root_path . 'common.' . $phpEx);
	include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
	include($phpbb_root_path . 'includes/message_parser.' . $phpEx);
	include($phpbb_root_path . 'includes/functions_admin.' . $phpEx);

	$request->enable_super_globals(); // Pour avoir accés aux variables globales $_SERVER, ...
	$user->session_begin();
	$auth->acl($user->data);

	// On restitue le contexte WRI qui a été écrasé
	include ("config.php");
}

// Fonction générique qui permet - entre autre - de créer un topic, modifier le titre et ajouter un post
function forum_submit_post ($args) {
	global $config_wri, $db, $user;

	// On se fait passer pour l'auteur du commentaire
	$mem_user = $user->data['user_id'];
	$user->data['user_id'] = $args['topic_poster'] = max (ANONYMOUS, $args['topic_poster']);
	$user->data['is_registered'] = false;

	$data = [ // Données par défaut
		'forum_name' => '',
		'message' => '',
		'username' => 'refuges.info',
		'enable_sig' => true,
		'enable_bbcode' => true,
		'enable_smilies' => true,
		'enable_urls' => true,
		'enable_indexing' => true,
		'notify' => false,
		'notify_set' => 0,
		'post_edit_locked' => 0,
		'icon_id' => 0,
		'bbcode_bitfield' => '',
		'bbcode_uid' => '',
	]
	+ $args; // Ecrase les valeurs par défaut par celles fournies à la fonction

	// Récupère les infos du topic
	if ($data['topic_id']) {
		$sql = 'SELECT * FROM '.TOPICS_TABLE.' WHERE topic_id = '.$data['topic_id'];
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		if ($row)
			$data = $data + $row + $args;
	}

	// Récupère les infos du premier post
	if ($data['topic_first_post_id']) {
		$sql = 'SELECT * FROM '.POSTS_TABLE.' WHERE post_id = '.$data['topic_first_post_id'];
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		if ($row)
			$data = array_merge ($data, $row, $args);
	}

	// Traduit bbcodes & md5
	$message_parser = new parse_message();
	$message_parser->message = $data['message'];
	$message_parser->parse(true, true, true);
	$data['message'] = $message_parser->message;
	$data['message_md5'] = md5($message_parser->message);

	$poll = []; // Il n'y a pas de sondage ici mais il faut quand même définir cette variable en statique

	submit_post ( // Appel de la fonction PhpBB
		$data['action'],
		$data['topic_title'], // Reprend le titre modifié (qui a dû être écrasé par les infos du topic)
		$data['username'],
		0, // topic_type
		$poll,
		$data
	);

	// On redevient nous même
	$user->data['user_id'] = $mem_user;
	$user->data['is_registered'] = true;

	return $data;
}

function forum_delete_topic ($topic_id) {
	global $db;

	// La liste des posts
	$sql = 'SELECT post_id FROM '.POSTS_TABLE.' WHERE topic_id = '.$topic_id;
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result))
		$pids[] = $row['post_id'];
	$db->sql_freeresult($result);

	if (!isset ($pids))
		exit ('FORUM : Erreur supression topic inconnu '.$topic_id);

	delete_posts('post_id', $pids); // On ne sait pas supprimer un topic: il faut supprimer tous ses posts
	sync('forum'); // Et on nettoie un peu tout ça
}

?>
