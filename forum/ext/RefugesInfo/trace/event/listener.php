<?php
// Ce fichier centralise les fonctions PHP liées à tracer l'environnement des posts et enregistrements
// Attention: Le code suivant s'exécute dans un "namespace" bien défini

/* Tests à faire
Création user
Création topic
Création post
Réponse post
Quote post
Création point
Création commentaire

Déconnecté refusé
Déconnecté
Connecté refusé
Connecté

Nouveau
Ancien (avant les traces)

Traces avec tri
[i] post,
[i] point,
[i] commentaire,
user
*/

namespace RefugesInfo\trace\event;

include __DIR__.'/../geoip2/geoip2.phar';
use GeoIp2\Database\Reader;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class listener implements EventSubscriberInterface
{
  protected $server, $post, $get;
  protected $forum_root, $u_action, $columns_names;
  protected $reader_asn, $reader_city;

  public function __construct()
  {
    global $request, $db;

    $this->server = $request->get_super_global(\phpbb\request\request_interface::SERVER);
    $this->post = $request->get_super_global(\phpbb\request\request_interface::POST);
    $this->get = $request->get_super_global(\phpbb\request\request_interface::GET) +
      [ // Default url args
        'limit' => 250,
      ];

    // Calcul de la racine du forum
    preg_match('|'.$this->server['DOCUMENT_ROOT'].'(.*/)ext/|', __DIR__, $forum_dirs);
    $this->forum_root = $forum_dirs[1];
    $ns = explode('\\', __NAMESPACE__);
    $this->u_action = $this->forum_root.'mcp.php?i=-'.$ns[0].'-'.$ns[1].'-mcp-main_module';

    // Liste les colonnes pour ne prendre que les arguments qui correspondent
    include __DIR__.'/../migrations/config.php';
    $this->table_name = array_key_first($config['tables']);
    $this->columns_names = array_keys($config['tables'][$this->table_name]['COLUMNS']);
  }

  static public function getSubscribedEvents()
  {
    return [
      // Log request
      'core.ucp_register_modify_template_data' => 'ucp_register_modify_template_data', // ucp_register.php 682
      'core.submit_post_end' => 'submit_post_end', // functions_posting.php 2634
      'core.posting_modify_template_vars' => 'log_request_context', // posting.php 2089 (post rejeté)
      'core.ucp_register_register_after' => 'log_request_context', // ucp_register.php 562 (user acceptée)
      'refugesinfo.trace.log_request_context' => 'log_request_context',

      // Display traces
      'core.mcp_post_additional_options' => 'display_traces', // mcp_post.php 125
      'core.memberlist_view_profile' => 'display_traces', // memberlist.php 757
      'refugesinfo.trace.display_traces' => 'display_traces',
    ];
  }

  // Log le contexte d'une création de user rejetée
  public function ucp_register_modify_template_data($event, $eventName)
  {
    if(isset($this->post['new_password'])) { // Except when load the registration page
      $error = $event['error'];
      $error[] = 'Création d\'un compte rejetée sans erreur documentée';
      $event['error'] = $error;

      $this->log_request_context($event, $eventName);
    }
  }

  // Log le contexte d'une soumission de post acceptée
  public function submit_post_end($event, $eventName)
  {
    if(isset($event['data']['post_visibility']) &&
      $event['data']['post_visibility'] === ITEM_UNAPPROVED)
    {
      $error = $event['error'];
      $error[] = 'Post mis en approbation par CleanTalk';
      $event['error'] = $error;
    }

    $this->log_request_context($event, $eventName);
  }

  // Log le contexte d'une soumission
  public function log_request_context($event, $eventName)
  {
    global $user;

    if(count($this->post) && // Except when load a post page
      strpos($this->server['REQUEST_URI'], 'mode=edit') === false && // Edit is not traced
      !isset($this->post['preview'])) // Post preview is not traced
    {
      $post_data = array_filter(
        $event['data'] ??
        $event['post_data'] ?? []
      );
      $user_data = array_filter(
        $event['user_row'] ??
        $user->data ??
        $this->post ?? []
      );

      // Données à archiver
      $trace = $this->full_row([
        // General
        'appel' => strpos($eventName, 'register') !== false
          ? 'création compte'
          : ($event['mode'] ?? '') .str_replace(['core.', 'refugesinfo.'], ' ', $eventName),
        'ext_error' => !empty($event['error']) ? json_encode($event['error']) : null,

        // Server
        'ip' => $this->server['REMOTE_ADDR']??null,
        'uri' => isset($this->server['HTTP_HOST']) ? (
            ($this->server['REQUEST_SCHEME']??'').'://'.
            $this->server['HTTP_HOST'].
            ($this->server['REQUEST_URI']??'')
          ) : null,
        'referer' => $this->server['HTTP_REFERER']??null,
        'user_agent' => $this->server['HTTP_USER_AGENT']??null,
        'language' => $this->server['HTTP_ACCEPT_LANGUAGE']??null,
        'date' => date('r'),

        // Navigateur
        'browser_operator' => $this->post['browser_operator']??null,
        'browser_referer' => $this->post['browser_referer']??null,
        'browser_locale' => $this->post['browser_locale']??null,
        'browser_timezone' => $this->post['browser_timezone']??null,

        // Post & Point
        'topic_id' => $event['topic_id'] ??
          $post_data['topic_id'] ??
          $this->post['topic_id'] ?? null,
        'post_id' => $event['post_id'] ??
          $post_data['post_id'] ??
          $this->post['post_id'] ?? null,
        'id_point' => $event['point']->id_point ?? null,
        'id_commentaire' => $event['commentaire']->id_commentaire ?? null,
        'title' => $event['subject'] ??
          $post_data['topic_title'] ??
          $event['point']->nom ?? null,
        'text' => mb_substr(
          $this->post['message'] ??
          $event['commentaire']->texte ?? '',
          0, 256
        ),

        // Infos enregistrées à la création du user
        // Sont gardées dans la table au cas où on supprimerait le user
        'user_id' => $user_data['user_id'] ?? $event['user_id'] ?? null,
        'user_name' => $this->post['username'] ??
          $this->post['nom_createur'] ??
          $user_data['username'] ?? null,
        'user_email' => $user_data['user_email'] ??
          $user_data['email'] ?? null,
        'user_lang' => $user_data['user_lang'] ??
          $user_data['lang'] ?? null,
        'user_timezone' => $user_data['user_timezone'] ??
          $user_data['tz'] ?? null,
        'ip_enregistrement' => $user_data['user_ip'] ?? null,
        'host_enregistrement' => gethostbyaddr($user_data['user_ip'] ?? $user_data['session_ip'] ?? null),
      ]);
    }
  }

  // Affichage des traces
  //BEST statistique sur les posts/comptes supprimés
  public function display_traces($event, $eventName)
  {
    global $db, $template, $auth;

    if(!$auth->acl_get('m_')) // Uniquement pour les modérateurs
      return;

    $conditions = [];

    // Arguments pour mcp_post_additional_options & core.memberlist_view_profile
    if(!empty($this->get['p']))
      $conditions[] = 'post_id = '.$this->get['p'];

    if(!empty($this->get['u'])) {
      $conditions[] = 'uri LIKE \'%register%\'';
      $conditions[] = 'user_id = '.$this->get['u'];
    }

    // Liste les colonnes pour ne prendre que les arguments qui correspondent
    foreach($this->columns_names as $column_name)
      // Multicriteria on one column
      foreach(explode(',', $this->get[$column_name] ?? '') as $sub_colomn) {
        // Separate the ! at the beginning
        $scs = array_reverse(explode('!', $sub_colomn));

        if($scs[0] === 'null')
          $conditions[] = $column_name.(isset($scs[1])?' IS NOT NULL':' IS NULL');
        elseif(is_numeric($scs[0]))
          $conditions[] = $column_name.(isset($scs[1])?'!=':'=').$scs[0];
        elseif($scs[0])
          $conditions[] = $column_name.(isset($scs[1])?' NOT':'').' LIKE \'%'.$scs[0].'%\'';
      }
    //TODO afficher les critères sélectionnés

    $lignes_traces_html = [];

    // Liste des traces affichables
    $where = $conditions ? ' WHERE '.implode(' AND ', $conditions) : '';
    $sql = 'SELECT *'.
      ' FROM '.$this->table_name.
      $where.
      ' ORDER BY trace_id DESC'.
      ' LIMIT '.($this->get['limit'] ?? 250).
      (!empty($this->get['offset']) ? ' OFFSET '.$this->get['offset'] : '');
    $result = $db->sql_query($sql);
    while($row = $db->sql_fetchrow($result))
      $lignes_traces_html[] = $this->display_one_trace(array_map('trim', $row));
    $db->sql_freeresult($result);

    // Nombre de traces répondant aux critères
    $sql = 'SELECT COUNT(trace_id) FROM '.$this->table_name.$where;
    $result = $db->sql_query($sql);
    $row_count = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    // S'il n'y a pas de trace dans la table, décode l'IP utilisée.
    $event_ip =
      $event['post_info']['poster_ip'] ??
      $event['member']['user_ip'] ??
      null;

    if(!count($lignes_traces_html) && $event_ip)
      $lignes_traces_html[] = $this->display_one_trace([
        'ip' => $event_ip,
      ]);

    $template->assign_vars([
      'WHERE' => implode('<br/>', $conditions),
      'TRACES' => implode('<hr/>'.PHP_EOL, $lignes_traces_html),
      'NOMBRE_LIGNES' => count($lignes_traces_html),
      'NOMBRE_TRACES' => $row_count['count'] ?? 0,
    ]);
    $template->assign_vars(array_change_key_case($this->get, CASE_UPPER));
  }

  // Affichage d'une trace
  private function display_one_trace($row)
  {
    global $db;

    $row = $this->full_row($row);

    // Construction de la première ligne
    $ligne1 = [];

    if(!empty($row['appel'])) {
      preg_match('/(.*) ([a-z_]*)/', $row['appel'], $modes);
      if(isset($modes[2]) && strpos($modes[2], '_') !== false) {
        $row['listener'] = $modes[2];

        $appel = str_replace(
          ['register', 'post', 'reply',
            'quote', 'edit', ],
          ['création d\'un user', 'création d\'un sujet', 'réponse à un post',
            'quote d\'un post', 'èdition d\'un post'],
          $modes[1]
        );
      }
    }

    if(!empty($row['ext_error']))
      $ligne1[] = 'REJET '.($appel ?? '');
    else
    if(!empty($row['uri'])) {
      //BEST lien vers un post mis en approbation
      if(strpos($row['uri'], 'point_modification') !== false) {
        if(!empty($row['id_point']))
          $ligne1[] = 'création d\'un <a '.
            'href="'.$this->forum_root.'../point/'.$row['id_point'].'"'.
          '>point</a>';
        elseif(!empty($row['post_id']))
          $ligne1[] = 'création d\'un point et de son <a '.
            'href="'.$this->forum_root.'viewtopic.php?p='.$row['post_id'].'"'.
          '>forum</a>';
        else
          $ligne1[] = 'erreur modification point sans id_point ni post_id';
      }
      elseif(strpos($row['uri'], 'ajout_commentaire') !== false) {
        if(!empty($row['id_point']))
          $ligne1[] = 'création d\'un <a '.
            'href="'.$this->forum_root.'../point/'.$row['id_point'].'#C'.@$row['id_commentaire'].'"'.
          '>commentaire</a>';
        else
          $ligne1[] = 'erreur ajout commentaire sans id_point';
      }
      elseif(strpos($row['uri'], 'mode=register') !== false) {
        if(!empty($row['user_id']))
          $ligne1[] = 'création du compte <a '.
            'href="'.$this->forum_root.'memberlist.php?mode=viewprofile&u='.$row['user_id'].'"'.
          '>'.($row['user_name']??'NONAME').'</a>';
        else
          $ligne1[] = 'erreur création du compte sans user_id';
      }
      elseif(strpos($row['uri'], 'mode=post') !== false ||
        strpos($row['uri'], 'contactadmin') !== false) {
        if(!empty($row['post_id']))
          $ligne1[] = 'création d\'un <a '.
            'href="'.$this->forum_root.'viewtopic.php?p='.$row['post_id'].'"'.
          '>sujet</a>';
        elseif(!empty($row['topic_id']))
          $ligne1[] = 'création d\'un <a '.
            'href="'.$this->forum_root.'viewtopic.php?t='.$row['topic_id'].'"'.
          '>sujet</a>';
        else
          $ligne1[] = 'erreur création d\'un post sans topic_id ni post_id';
      }
      elseif(strpos($row['uri'], 'posting.php') !== false) { // reply, quote, edit
        if(!empty($row['post_id']))
          $ligne1[] = str_replace(
            'post',
            '<a href="'.$this->forum_root.'viewtopic.php?'.
              'p='.$row['post_id'].'#p'.$row['post_id'].'">post'.
            '</a>',
            ($appel ?? '')
          );
        else
          $ligne1[] = 'erreur posting sans post_id';
      }
      else
        $ligne1[] = 'erreur url inconnue';
    }

    if(strpos($row['uri'] ?? '', 'mode=register') === false &&
      !empty($row['user_id'])) {
        if($row['user_id'] > 1)
          $ligne1[] = 'par <a '.
            'href="'.$this->forum_root.'memberlist.php?mode=viewprofile&u='.$row['user_id'].'"'.
          '>'.($row['user_name']??'NONAME').'</a>'.
          ' (toutes <a '.
            'href="'.$this->u_action.'&user_id='.$row['user_id'].'"'.
          '>ses contributions</a>)';
        elseif (isset($row['user_name']))
          $ligne1[] = 'par '.$row['user_name'];
      }  

    if(count($ligne1))
      $ligne1[count($ligne1) - 1] .= '. ';

    if(!empty($row['trace_id']) && empty($this->get['trace_id']))
      $ligne1[] =
        '<sup><a href="'.$this->u_action.'&trace_id='.$row['trace_id'].'"'.
        '>'.$row['trace_id'].'</a></sup>';

    // Construction des lignes du rapport
    $lignes_html = [];
    if(count($ligne1))
      $lignes_html[] = ucfirst(implode(' ', $ligne1)) ;

    if(!empty($row['ext_error']))
      $lignes_html[] =
        str_replace( // Split encoded lines
          ['","', '["', '"]', 'posting_modify_template_vars : ', 'ucp_register_modify_template_data : '],
          ['<br/>- ', '- ', '', '', ''],
          preg_replace( // Décode unicode if such returned by extensions
            '/\\\\u([a-e0-9]{4})/',
            '&#x$1;',
            $row['ext_error'],
          ),
        );

    if(!empty($row['ip']))
      $lignes_html[] =
        'Fournisseur d\'Accès Internet: '.
        '<a href="https://ipinfo.io/'.($row['asn_id'] ?? $row['ip']).'">'.
          ($row['asn_name'] ?? $row['host'] ?? $row['ip']).
        '</a>'.
        (!empty($row['country_name']) ? ' - '.$row['country_name'] : '').
        (!empty($row['city']) ? ' / '.$row['city'] : '');

    if(!empty($row['asn_id']) && !empty($row['asn_name']))
      $lignes_html[] = 'Toutes les contributions '.
        '<a href="'.$this->u_action.'&asn_id='.$row['asn_id'].'">'.
          'passant par '.$row['asn_name'].
        '</a>';

    $lignes_traces = [
      'date' => 'date',
      'machine' => 'browser_operator',
      'url' => 'uri',
      'url-1' => 'referer',
      'url-2' => 'browser_referer',
      'host' => 'host',
      'agent' => 'user_agent',
      'langues supportés' => 'language',
      'langue' => 'browser_locale',
      'timezone' => 'browser_timezone',
      'topic' => 'topic_id',
      'post' => 'post_id',
      'point' => 'id_point',
      'commentaire' => 'id_commentaire',
      'Titre' => 'title',
      'texte' => 'text',
      'id utilisateur' => 'user_id',
      'nom utilisateur' => 'user_name',
    ];

    if(!empty($row['user_email']))
      $lignes_traces += [
        'email utilisateur' => 'user_email',
        'langue utilisateur' => 'user_lang',
        'IP enregistrement' => 'ip_enregistrement',
      ];

    foreach($lignes_traces as $title => $k)
      if(!empty($row[$k])) {
        $r = str_replace(PHP_EOL, ' ', $row[$k]);
        $r = preg_replace('/\s\s+/', ' ', $r);
        $r = trim(strip_tags($r, '<br>'));
        $t = ucfirst($title);
        $lignes_html[] = "<span title='$k'>$t</span>: $r";
      }

    if(!empty($row['ip']))
      array_push($lignes_html,
        '<a href="https://ipinfo.io/'.$row['ip'].'">IpInfo</a> de '.$row['ip'],
        '<a href="https://whatismyipaddress.com/ip/'.$row['ip'].'">WhatIsMyIP</a> de '.$row['ip'],
        '<a href="https://www.iplocation.net/ip-lookup?query='.$row['ip'].'">IpLocation</a> de '.$row['ip'],
        '<a href="https://stopforumspam.com/ipcheck/'.$row['ip'].'">StopForumSpam</a> de '.$row['ip'],
        '<a href="https://www.spamcop.net/w3m?action=checkblock&ip='.
          $row['ip'].'">SpamCop</a> de '.$row['ip'],
        '<a href="https://www.abuseipdb.com/check/'.$row['ip'].'">AbuseIPdb</a> de '.$row['ip'],
        '<a href="https://cleantalk.org/blacklists/'.$row['ip'].'">CleanTalk</a> de '.$row['ip'],
      );

    if(!empty($row['user_email']))
      $lignes_html[] = '<a href="https://cleantalk.org/email-checker/'.
        $row['user_email'].'">CleanTalk</a> de '.$row['user_email'];

    return '<p>'.implode('</p>'.PHP_EOL.'<p>', $lignes_html).'</p>';
  }

  private function full_row($row)
  {
    global $db, $config_wri;

    $row = array_filter($row);

    if(!empty($row['ip'])) {
      if(empty($row['host']))
        $row['host'] = gethostbyaddr($row['ip']);

      if(empty($row['asn_id']) || empty($row['asn_name']) &&
        is_file(__DIR__.'/../geoip2/GeoLite2-ASN.mmdb')) {
          if (!isset ($this->reader_asn))
            $this->reader_asn = new Reader(__DIR__.'/../geoip2/GeoLite2-ASN.mmdb');
          $geodata_asn = $this->reader_asn->asn($row['ip']);
          $row['asn_id'] = 'AS'.$geodata_asn->autonomousSystemNumber;
          $row['asn_name'] = $geodata_asn->autonomousSystemOrganization;
        }

      if(empty($row['country_name']) || empty($row['city']) &&
        is_file(__DIR__.'/../geoip2/GeoLite2-City.mmdb')) {
          if (!isset ($this->reader_city))
            $this->reader_city = new Reader(__DIR__.'/../geoip2/GeoLite2-City.mmdb');
          $geodata_city = $this->reader_city->city($row['ip']);
          $row['country_name'] = $geodata_city->country->name;
          $row['city'] = $geodata_city->city->name;
        }
    }

    // Force NULL if no error to enable request by "IS NULL"
    if(!isset($row['ext_error']))
      $row['ext_error'] = null;

    // Update d'une trace existante
    if(!empty($row['trace_id'])) {
      // On récupère la trace existante
      $sql_row = [];
      $sql = 'SELECT '.$this->table_name.'.*'.
        (isset($config_wri) ? ',points.id_point AS wri_id_point' : '').
        ' FROM '.$this->table_name.
        (isset($config_wri) ? ' LEFT JOIN points USING(topic_id)' : '').
        ' WHERE trace_id = '.$row['trace_id'];
      $result = $db->sql_query($sql);
      $sql_row = $db->sql_fetchrow($result);
      $db->sql_freeresult($result);

      // Récupération du n° de point qu'on n'avait pas lors de la création du forum associé
      if (!empty($sql_row['wri_id_point']))
        $row['id_point'] = $sql_row['wri_id_point'];

      // On ne garde que les valeurs qui ont changé
      $delta_row = array_filter(
        $row,
        function($v, $k) use($sql_row) {
          return
            in_array($k, $this->columns_names) &&
            isset ($v) && isset ($sql_row[$k]) &&
            !($v === null && $sql_row[$k] === null) &&
            $v !== trim ($sql_row[$k]);
        },
        ARRAY_FILTER_USE_BOTH
      );

      if(count($delta_row)) {
        $sql = 'UPDATE '.$this->table_name.' SET '.
          $db->sql_build_array('UPDATE', $delta_row).
          ' WHERE trace_id = '.$row['trace_id'];
        $db->sql_query($sql);
      }
    }
    // Nouvelle trace
    elseif(!empty($row['uri'])) { // Pas pour les vieux posts ou uisers qui n'ont pas de trace
      $sql = 'INSERT INTO '.$this->table_name.$db->sql_build_array('INSERT', $row);
      $db->sql_query($sql);
    }

    return $row;
  }
}
