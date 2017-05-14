<?php
// Ce fichier est appelé en requette AJAX par refuges.info pour modifier les données du forum

define('IN_PHPBB', true);
$phpbb_root_path = '../../../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
include($phpbb_root_path . 'includes/message_parser.' . $phpEx);
include($phpbb_root_path . 'includes/functions_admin.' . $phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();

// L'accés à cet API n'est autorisé que depuis le même serveur
// Aucune autre autorisation n'est vérifiée
// Les cookies n'étant pas transmis, l'utilisateur est "anonymous"
$request->enable_super_globals();
if ($_SERVER['REMOTE_ADDR'] != $_SERVER['SERVER_ADDR'])
	exit ('Forbidden access');

// Paramètres
$data = [
	'post_id' => request_var ('p', 0),
	'topic_id' => request_var ('t', 0),
	'forum_id' => request_var ('f', 0),
	'topic_title' => $_POST['s'], // Important de le prendre dans $_POST car ça préserve les caractères spéciaux
	'username' => $_POST['u'] ?: 'refuges.info',

// Données par défaut
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
	'forum_name' => '',
];

// Récupère les infos du topic
if ($data['topic_id']) {
	$sql = 'SELECT * FROM '.TOPICS_TABLE.' WHERE topic_id = '.$data['topic_id'];
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	if ($row)
		$data = array_merge ($data, $row);
}

// Traduit bbcodes
$message_parser = new parse_message();
$message_parser->message = $_POST['m'] ?: '';
$message_parser->parse(true, true, true);
$data['message'] = $message_parser->message;
$data['message_md5'] = md5($message_parser->message);

$poll = [];

// Exécute les fonctions api
// Renvoie des données JSON si la requette s'est bien passée
// Un string message d'erreur sinon
switch (request_var ('api', '')) {
	case 'creer':
		$action = 'post';
		break;

	case 'renommer':
		if (!$data['topic_first_post_id'])
			exit ('ERROR : No post in topic '.$data['topic_id']);

		// Récupère les infos du premier post
		$sql = 'SELECT * FROM '.POSTS_TABLE.' WHERE post_id = '.$data['topic_first_post_id'];
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		if ($row) {
			$data = array_merge ($data, $row);
			$data['message'] = $data['post_text'];
		}
		$action = 'edit';
		break;

	case 'transferer': // Transfert de commentaire
		$user_id = request_var ('i', 0);
		if ($user_id > ANONYMOUS) {
			// Si l'auteur du commentaire transféré était connecté, on force l'ID
			$user->data['user_id'] = $user_id;

			// Et le nom associé
			$sql = 'SELECT username FROM '.USERS_TABLE.' WHERE user_id = '.$user_id;
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
			$data['username'] = $row['username'];
		}

		$data['post_time'] = strtotime ($_POST['d']); // Recalcule suivant la timezone
		$action = 'reply';
		break;

	case 'supprimer':
		// La liste des posts
		$sql = 'SELECT post_id FROM '.POSTS_TABLE.' WHERE topic_id = '.$data['topic_id'];
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
			$pids[] = $row['post_id'];
		$db->sql_freeresult($result);

		if (!isset ($pids))
			exit ('FORUM : Erreur supression topic inconnu '.$data['topic_id']);

		delete_posts('post_id', $pids); // On ne sait pas supprimer un topic: il faut supprimer tous ses posts
		sync('forum'); // Et on nettoie un peu tout ça
		exit ('{}'); // Sortie OK (Json vide)

	default:
		exit ('Rien à exécuter');
}

submit_post (
	$action,
	$_POST['s'], // Reprend le titre modifié (qui a dû être écrasé par les infos du topic)
	$data['username'],
	0, // topic_type
	$poll, $data
);
exit (json_encode ($data));

?>
