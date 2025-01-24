<?php
/***
Fonctions permettant de faire des modifications dans le forum
( création & suppresion de topic, modification du titre, création de post pour transfert depuis la fiche )
***/

// Récupère l'environnement du forum
// Cette séquence ne peut pas être dans une function
define('IN_PHPBB', true);
$phpEx="php";
$phpbb_root_path=$config_wri['rep_forum'];
include($config_wri['rep_forum'] . 'includes/functions_posting.php');
include($config_wri['rep_forum'] . 'includes/message_parser.php');
include($config_wri['rep_forum'] . 'includes/functions_admin.php');

// Fonction générique qui permet - entre autre - de créer un topic, modifier le titre et ajouter un post
function forum_submit_post ($args) {
  global $config_wri, $db, $user;

  // On garde de coté l'information d'identification de l'utilisateur connecté
  $mem_user = $user;
  
  // On se fait passer pour l'auteur du commentaire à transférer si ce n'est pas déjà le même
  if ($user->data['user_id'] != $args['topic_poster'] )
  {
    $user->data['user_id'] = $args['topic_poster'] = max (ANONYMOUS, $args['topic_poster']);
    $user->data['is_registered'] = false;
    $user->data['user_colour'] = ''; // On force la couleur de l'utilisateur dont on créer le topic à vide histoire que la couleur ne soit pas celle du modérateur connecté
  
    if ($user->data['user_id'] !== ANONYMOUS) // s'il n'est pas anonyme, on récupère son username
    {
      $utilisateur=infos_utilisateur($args['topic_poster']);
      $user->data['username']=$utilisateur->username;  
    }
  }
  
  $data = [ // Données par défaut
    'forum_name' => '',
    'message' => '',
    'username' => '', // peut-être mieux de laisser vite par défaut, ça marque "invité" si non connecté, le vrai nom de compte si connecté en le surdéfinissant plus tard et le nom rentré par l'anonyme s'il n'a pas mis "vide"
    'user_colour' => 0,
    'enable_sig' => true,
    'enable_bbcode' => true,
    'enable_smilies' => true,
    'enable_urls' => true,
    'enable_indexing' => true,
    'notify' => true,
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
  $user = $mem_user;
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

/************************************************************************
Derniers messages du forum
$conditions->limite : nombre maximum de messages retournés
$conditions->ordre : exemple "ORDER BY date"
$conditions->ids_forum : (5 ou 4,7,8) pour restreindre la provenance des messages
************************************************************************/
// jmb: return un tableau vide au lieu d'un undefined si aucun message
function messages_du_forum($conditions)
{
  global $pdo; $messages_du_forum= array();
  $quels_ids="";
  if (isset($conditions->ids_forum))
    $quels_ids.="AND phpbb3_topics.forum_id in ($conditions->ids_forum)";
  if ( !isset($conditions->ordre))
    $conditions->ordre="ORDER BY date DESC";

    // Il y avait aussi ça mais je ne sais pas pourquoi ? sly 02-11-2008
    //AND phpbb_topics.topic_first_post_id < phpbb_topics.topic_last_post_id
    // réponse :  pour qu'il y ait > 1 post. cad forum non vide. sinon last=first.
    $query_messages_du_forum=
    "SELECT
      max(phpbb3_posts.post_time) AS date,
      phpbb3_posts.topic_id,
      phpbb3_posts.poster_id,
      phpbb3_posts.post_text,
      phpbb3_topics.topic_title,
      max(phpbb3_posts.post_id) AS post_id
    FROM phpbb3_topics, phpbb3_posts
        WHERE
        phpbb3_posts.post_text!=''
    AND phpbb3_posts.post_visibility=1
    AND phpbb3_topics.topic_id = phpbb3_posts.topic_id
    $quels_ids
    GROUP BY phpbb3_posts.poster_id,phpbb3_posts.topic_id,phpbb3_topics.topic_title,phpbb3_posts.post_text
    $conditions->ordre
    LIMIT $conditions->limite";

    if (! ($res=$pdo->query($query_messages_du_forum)))
      return erreur("Impossible d'obtenir les derniers messages du forum",$query_messages_du_forum);
    else
    {
    while ($message_du_forum = $res->fetch())
      $messages_du_forum[]=$message_du_forum;
    }
    return $messages_du_forum;

}
