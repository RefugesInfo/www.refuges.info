<?php
/* Ce fichier centralise les fonctions PHP liées à tracer l'environnement des posts et enregistrements
 * Attention: Le code suivant s'exécute dans un "namespace" bien défini
 *
 * En cas de blocage, supprimer dans la base:
   phpbb3_modules WHERE module_langname = '%TRACE%'
   phpbb3_ext WHERE ext_name = '%trace%'
*/

/* Tests à faire
Création point
Création commentaire
Création topic
Création post
Réponse post
Quote post
Edit post
Création user

Déconnecté refusé
Déconnecté
Connecté refusé
Connecté

Traces avec tri
[i] post,
[i] point,
[i] commentaire,
user
*/

//BEST statistique sur les posts/comptes supprimés

namespace RefugesInfo\trace\event;

include __DIR__.'/../geoip2/geoip2.phar';
use GeoIp2\Database\Reader;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class listener implements EventSubscriberInterface
{
  protected $forum_root, $u_action, $tables, $limit, $argument_names;

  public function __construct()
  {
    global $request, $db;

    $request->enable_super_globals();

    // Calcul de la racine du forum
    preg_match('|'.$_SERVER['DOCUMENT_ROOT'].'(.*/)ext/|', __DIR__, $forum_dirs);
    $this->forum_root = $forum_dirs[1];
    $this->u_action = $this->forum_root.'mcp.php?i=-'.str_replace(['\\event','\\'], ['','-'], __NAMESPACE__).'-mcp-main_module';

    // Liste les tables et les colonnes pour ne prendre que les arguments qui correspondent
    $this->limit = $_GET['limit'] ?? 20;
    $this->argument_names = [
      'ext_error' => 'text',
      'browser_operator' => 'text',
      'trace_id' => 'number',
      'user_id' => 'number',
      'user_name' => 'text',
      'asn_id' => 'text',
      'ip' => 'text',
      'uri' => 'text', // Pour profile user
      'to_check' => 'number',
      'topic_id' => 'number',
      'post_id' => 'number',
      'id_point' => 'number',
      'id_commentaire' => 'number',
      'group_id' => 'number',
      'limit' => 'number',
      'offset' => 'number',
    ];

    // Liste les tables et les colonnes pour ne prendre que les arguments qui correspondent
    $this->tables = 'trace_requettes LEFT JOIN '.USERS_TABLE.' USING(user_id)';
  }

  static public function getSubscribedEvents()
  {
    return [
      // Log request
      'core.submit_post_end' => 'log_request_context', // functions_posting.php 2634
      'core.posting_modify_template_vars' => 'log_request_context', // posting.php 2089 (post rejeté)
      'core.ucp_register_register_after' => 'log_request_context', // ucp_register.php 562 (user acceptée)
      'core.ucp_register_modify_template_data' => 'log_request_context', // ucp_register.php 682
      'refugesinfo.ajout_point' => 'ajout_point',
      'refugesinfo.ajout_commentaire' => 'log_request_context',

      // Display traces
      'core.mcp_post_additional_options' => 'display_traces', // mcp_post.php 125
      'core.memberlist_view_profile' => 'display_traces', // memberlist.php 757
      'refugesinfo.trace_status' => 'status', // Pour les lignes du menu du bandeau bandeau
      'refugesinfo.display_traces' => 'display_traces', // Affichage du MCP traces
    ];
  }

  // Log le contexte d'une soumission
  public function log_request_context($event, $eventName)
  {
    global $db, $config_wri, $user, $auth;

    $error = $event['error'] ?? [];

    if(!count($_POST) || // Not the first page display
      isset($_POST['preview']))
      return; // Post preview is not traced

    $ip = $_SERVER['REMOTE_ADDR'];
    $reader_asn = new Reader(__DIR__.'/../geoip2/GeoLite2-ASN.mmdb');
    $geodata_asn = $reader_asn->asn($ip);
    $reader_city = new Reader(__DIR__.'/../geoip2/GeoLite2-City.mmdb');
    $geodata_city = $reader_city->city($ip);

    // Except when load the registration page
    if($eventName === 'core.ucp_register_modify_template_data' && !$_POST['new_password'])
      return;

    // Exclusion de certains ASN
    if(isset($geodata_asn->autonomousSystemNumber) &&
      in_array(
        $geodata_asn->autonomousSystemNumber,
        $config_wri['trace_block_asn'] ?? [])
      ) {
      $error[] = 'Forbiden origin';
      return;
    }

    // Cherche les infos à logguer
    $data = array_merge([
        'ip' => $ip ?? '0.0.0.0',
        'uri' => $_SERVER['REQUEST_URI'] ?? '',
      ],
      array_filter((array) $event),
      array_filter($event['point'] ?? []),
      array_filter($event['commentaire'] ?? []),
      array_filter($event['user_row'] ?? []),
      array_filter($event['data'] ?? []),
      array_filter($event['post_data'] ?? []),
      array_filter($user->data ?? []), // mode, subject, username, topic_type, url
      array_filter($_POST ?? []),
    );

    // Soumission de post mis en approbation par CleanTalk, qui l'enregistre quand même
    if(isset($data['post_visibility']) && $data['post_visibility'] === ITEM_UNAPPROVED)
      $error[] = 'Post mis en approbation par CleanTalk';

    date_default_timezone_set('UTC');
    $trace_data = [
      // 'trace_id' => autoincrement,
      'ext_error' => count($error) ? json_encode($error) : null,
      'date' => date('r'),
      'to_check' => !$auth->acl_get('m_'), // Quand le post est édité par un non modo
      'appel' => str_replace(['core.', 'refugesinfo.'], [$event['mode'].' ',''], $eventName),

      // Post & Point
      'topic_id' => intval($data['topic_id'] ?? 0),
      'post_id' => intval($data['post_id'] ?? $event['topic_cur_post_id'] ?? 0),
      'id_point' => intval($data['id_point'] ?? 0),
      'id_commentaire' => intval($data['id_commentaire'] ?? 0),
      'title' => $data['subject'] ?? $data['topic_title'] ?? $data['nom']->nom ?? '',
      'text' => mb_substr(
        $data['message'] ?? $data['texte'] ?? '',
        0,
        256
      ),

      // Serveur
      'uri' => isset($_SERVER['HTTP_HOST']) ?
        (
          ($_SERVER['REQUEST_SCHEME'] ?? '').'://'.
          ($_SERVER['HTTP_HOST'] ?? '').
          ($_SERVER['REQUEST_URI'] ?? '')
        ) : '',
      'referer' => $_SERVER['HTTP_REFERER'] ?? '',

      // Navigateur
      'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
      'language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '',
      'browser_locale' => $data['mrk_browser_locale'] ?? '',
      'browser_timezone' => $data['mrk_browser_timezone'] ?? '',
      'browser_operator' => $data['mrk_browser_operator'] ?? '',
      'browser_referer' => $data['mrk_browser_referer'] ?? '',

      // Infos enregistrées à la création du user
      // Sont gardées dans la table au cas où on supprimerait le user
      'user_id' => intval($data['user_id'] ?? 0),
      'user_name' => $data['username'] ?? $data['nom_createur'] ?? '',
      'user_email' => $data['user_email'] ?? $data['email'] ?? '',
      'user_lang' => $data['user_lang'] ?? $data['lang'] ?? '',
      'user_timezone' => $data['user_timezone'] ?? $data['tz'] ?? '',
      'ip_enregistrement' => $data['user_ip'] ?? '',
      'host_enregistrement' => gethostbyaddr($data['user_ip'] ?? $data['session_ip'] ?? $_SERVER['REMOTE_ADDR'] ?? ''),
      'creator_name' => ($data['poster_id'] ?? 0) > 1 ? $data['username'] : 'Anonymous',
      'creator_id' => intval($data['poster_id'] ?? 0),

      // ASN / FAI
      'ip' => $ip,
      'host' => gethostbyaddr($ip),
      'asn_id' => 'AS'.$geodata_asn->autonomousSystemNumber,
      'asn_name' => $geodata_asn->autonomousSystemOrganization,
      'country_name' => $geodata_city->country->name,
      'city' => $geodata_city->city->name,
    ];

    // Enregistrement de la trace
    $sql = 'INSERT INTO trace_requettes'.$db->sql_build_array('INSERT', $trace_data);
    $db->sql_query($sql);

    $event['error'] = $error;
  }

  // Mettre à jour la trace du forum avec id_point
  public function ajout_point($event)
  {
    global $db;

    $sql = 'UPDATE trace_requettes'.
      ' SET id_point = '.$event['data']['id_point'].
      ' WHERE topic_id = '.$event['data']['topic_id'];
    $db->sql_query($sql);
  }

  /*
   * Affichage des traces
   */
  // Hook pour renseigner le bandeau
  public function status($event)
  {
    global $pdo, $config_wri;

    // Nombre d'éditions de posts non vérifiées
    $sql = 'SELECT COUNT(trace_id)'.
      ' FROM '.$this->tables.
      ' WHERE uri LIKE \'%edit%\''.
        ' AND ext_error IS NULL'.
        ' AND to_check = 1';

    if(isset($config_wri['trace_no_edit_check_groups']))
      $sql .= ' AND group_id NOT IN ('.implode(',', $config_wri['trace_no_edit_check_groups']).')';

    if($res = $pdo->query($sql))
      $event['posts_edit'] = $res->fetch()->count;
  }

  public function display_traces($event)
  {
    global $db, $template, $auth;

    if(!$auth->acl_get('m_')) // Uniquement pour les modérateurs
      return;

    // Effacer la trace to_check sur demande
    if(!empty($_GET['trace_id']) && !empty($_GET['check'])) {
      $sql = 'UPDATE trace_requettes SET to_check = 0 WHERE trace_id = '.$_GET['trace_id'];
      $db->sql_query($sql);
    }

    // Champs d'édition de la requête
    foreach($this->argument_names as $name => $type)
      $template->assign_block_vars('inputs_requete', [
        'NAME' => $name,
        'VALUE' => $_GET[$name] ?? '',
      ]);

    // Affichage d'entête de la table
    $this->affiche_une_ligne(['Trace', 'Statut', 'Utilisateur', 'Machine', 'ASN (FAI)', 'IP', 'Contenu']);

    $where = $this->where($_GET);

    // Nombre de traces répondant aux critères
    $sql_count = 'SELECT COUNT(trace_id)'.
      ' FROM '.$this->tables.
      $where;
    $result = $db->sql_query($sql_count);
    $row_count = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    // Liste des traces affichables
    $sql = 'SELECT *, trace_requettes.date AS trace_date, trace_requettes.id_point AS trace_id_point'.
      ' FROM '.$this->tables.
      $where.
      ' ORDER BY trace_id DESC'.
      ' LIMIT '.$this->limit.
      (!empty($_GET['offset']) ? ' OFFSET '.$_GET['offset'] : '');
    $result = $db->sql_query($sql);

    $compteur_traces = 0;
    while($row = $db->sql_fetchrow($result))
      $compteur_traces = $this->affiche_une_trace(array_map('trim', $row), $compteur_traces);
    $db->sql_freeresult($result);

    $template->assign_vars([
      'WHERE_SQL' => $where,
      'LIMIT' => $this->limit,
      'OFFSET' => $_GET['offset'] ?? '',
      'NEXT' => http_build_query(array_filter(array_merge(
          $_GET, [
            'offset' => ($_GET['offset'] ?? 0)+$this->limit,
            'i' => null,
          ],
      ))),
      'REQUETE_SQL' => $sql,
      'NOMBRE_LIGNES' => $compteur_traces,
      'NOMBRE_TRACES' => $row_count['count'] ?? 0,
    ]);
  }

  /*
   * Affichage d'une trace
   */
  private function affiche_une_trace($row, $compteur_traces = 0)
  {
    global $db, $template;

    foreach($row as $name => $value)
      if(intval($value) > 1000000000)
        $row[$name] = date('r', intval($value));

    // Supression des infos non souhaitées dans le dump
    $row = array_filter(array_merge($row, [
      'user_permissions' => null,
      'user_password' => null,
      'user_form_salt' => null,
      'user_sig' => null,
      'user_last_confirm_key ' => null,
    ]));

    $user = $row['user_id']??1 > 1 ?
      '<a href="'.$this->forum_root.'memberlist.php?mode=viewprofile&u='.$row['user_id'].'">user</a>'
      :'user';
    $point = empty($row['trace_id_point']) ? 'point' :
      '<a href="/point/'.$row['trace_id_point'].'">point</a>';
    $commentaire = empty($row['id_commentaire']) ? 'commentaire' :
      '<a href="/point/'.($row['id_point']??0).'#C'.$row['id_commentaire'].'">commentaire</a>';
    $post = empty($row['post_id']) ? 'post' :
      '<a href="'.$this->forum_root.'viewtopic.php?p='.$row['post_id'].'#'.$row['post_id'].'">post</a>';
    if(!empty($row['trace_id_point']))
      $post = "$point et son premier $post";

    $traduction_appel = [
      // SubscribedEvents
      'post submit_post_end' => "création d'un $post",
      'reply submit_post_end' => "création d'un $post",
      'quote submit_post_end' => "quote d'un $post",
      'edit submit_post_end' => "édition d'un $post",
      'posting_modify_template_vars' => "édition d'un $post",
      'ucp_register_register_after' => "création d'un $user",
      'ucp_register_modify_template_data' => "création d'un $user",
      'ajout_point' => "création $point",
      'ajout_commentaire' => "ajout $commentaire",

      // Historique dans la base
      'ajout commentaire' => "création $commentaire",
      'ajout commentaire point_ajout_commentaire' => "création $commentaire",
      'ajout commentaire trace.log_request_context' => "création $commentaire",
      'création compte' => "création $user",
      'création compte ucp_register_modify_template_data' => "création $user",
      'création compte ucp_register_register_after' => "création $user",
      'création point' => "création $point",
      'quote' => "quote d'un $post",
      'quote posting_modify_template_vars' => "quote d'un $post",
      'reply' => "réponse à un $post",
      'reply posting_modify_template_vars' => "réponse à un $post",
      'edit' => "édition d'un $post",
      'edit posting_modify_template_vars' => "édition d'un $post",
      'post' => "création d'un $post",
      'post posting_modify_template_vars' => "édition d'un $post",
    ];

    $appel = strtolower(trim($row['appel']??''));
    if (array_key_exists($appel, $traduction_appel))
      $appel = $traduction_appel[$appel];

    // Calcul du statut
    $colonne_statut = [];

    if(empty($row['ext_error']))
      $colonne_statut[] = ucfirst($appel);
    else {
      $ext_error = str_replace('Cr\u00e9ation d\'un compte rejet\u00e9e sans erreur document\u00e9e', '', $row['ext_error']??'');
      $colonne_statut[] = ucfirst('REJET '.$appel);
      $colonne_statut = array_merge($colonne_statut, json_decode($ext_error));
    }

    if(!empty($row['to_check']) && !strncmp($row['appel'],'edit', 4))
      $colonne_statut[] = '<a class="check-trace" href="/forum/mcp.php?i=-RefugesInfo-trace-mcp-main_module&trace_id='.
        $row['trace_id'].
        '&check=1">Marquer vu</a>';

    // Affiche une ligne du tableau
    $this->affiche_une_ligne([
      isset($row['trace_id']) ? [ // Trace
        'Trace n° <a href="'.$this->u_action.'&trace_id='.$row['trace_id'].'">'.$row['trace_id'].'</a>',
        preg_replace('/\+[0-9]+/i', '', $row['trace_date']??''),
      ] : [],
      $colonne_statut,
      array_merge(
        // Auteur
        !strncmp($row['appel']??'', 'edit', 4) && !empty($row['creator_id']) ? [
          ($row['creator_id'] ?? 0) > 1 ?
          'Créé par: <a title="Voir son profil"'.
            'href="'.$this->forum_root.'memberlist.php?mode=viewprofile&u='.$row['creator_id'].'">'.
            ($row['creator_name'] ?? 'Unknown').'</a>':
            'Anonymous',
          'Modifié par:',
        ] : [],
        [ // Utilisateur
          ($row['user_id'] ?? 0) > 1 ?
          '<a title="Voir son profil"'.
            'href="'.$this->forum_root.'memberlist.php?mode=viewprofile&u='.$row['user_id'].'">'.
            ($row['user_name'] ?? 'Unknown').'</a>':
            $row['user_name']??'Anonymous',
          ($row['user_id'] ?? 0) > 1 ?
            '<a title="Voir ses traces"'.
              'href="'.$this->u_action.'&user_id='.$row['user_id'].'">Posts: '.($row['user_posts']??0).'</a>' : null,
          !empty($row['user_lang']) ? 'Langue: '.$row['user_lang'] : null,
          !empty($row['user_timezone']) ? $row['user_timezone'] : null,
          !empty($row['user_login_attempts']) ? 'Tentatives login: '.$row['user_login_attempts'] : null,
          !empty($row['user_inactive_time']) ? 'Temps inactif: '.$row['user_inactive_time'] : null,
          !empty($row['user_inactive_reason']) ? 'Raison inactif: '.$row['user_inactive_reason'] : null,
          $row['user_email'] ?? '' ?
            '<a title="Avis Cleantalk"'.
              'href="https://cleantalk.org/email-checker/'.$row['user_email'].'">'.($row['user_email'] ?? '').'</a>' : null,
        ]
      ),
      [ // Machine
        $row['browser_operator'] ?? '',
        str_replace(['<t>','</t>'], '', $row['user_sig'] ?? '') ?
          'Signature: '.$row['user_sig'] :
          null,
        !empty($row['browser_locale']) ?
          'Langue: '.$row['browser_locale'] :
          null,
        !empty($row['browser_timezone']) ?
          'Timezone: '.$row['browser_timezone'] :
          null,
      ],
      [ // FAI
        $row['host'] ?? '',
        '<a title="Fiche de l\'ASN"'.
          'href="https://ipinfo.io/'.($row['asn_id'] ?? $row['ip'] ?? '').'">'.
          ($row['asn_name'] ?? $row['host'] ?? $row['ip'] ?? '').'</a>',
        ($row['country_name'] ?? '').' / '.($row['city'] ?? ''),
        '<a title="Les contributions passant par '.($row['asn_name'] ?? '').'"'.
          'href="'.$this->u_action.'&asn_id='.($row['asn_id'] ?? '').'">Contributions</a>',
      ],
      isset($row['ip']) ? [ // IP
        $row['ip'],
        '<a href="https://ipinfo.io/'.$row['ip'].'">IpInfo</a>',
        '<a href="https://whatismyipaddress.com/ip/'.$row['ip'].'">WhatIsMyIP</a>',
        '<a href="https://www.iplocation.net/ip-lookup?query='.$row['ip'].'">IpLocation</a>',
        '<a href="https://stopforumspam.com/ipcheck/'.$row['ip'].'">StopForumSpam</a>',
        '<a href="https://www.spamcop.net/w3m?action=checkblock&ip='.
          $row['ip'].'">SpamCop</a>',
        '<a href="https://www.abuseipdb.com/check/'.$row['ip'].'">AbuseIPdb</a>',
        '<a href="https://cleantalk.org/blacklists/'.$row['ip'].'">CleanTalk</a>',
      ] : [],
      [ // Contenu
        '<b>'.($row['title'] ?? '').'</b>',
        mb_substr($row['text'] ?? '', 0, 240).(strlen($row['text'] ?? '') > 239 ? '...' : ''),
      ],
    ]);

    // Affiche le résultat complet sur la fiche d'une trace
    if(isset($_GET['trace_id']))
      foreach($row as $name => $value)
        $template->assign_block_vars('full_trace', [
          'NAME' => $name,
          'VALUE' => $value,
        ]);

    return $compteur_traces + 1;
  }

  private function affiche_une_ligne($values)
  {
    global $template;

    $template->assign_block_vars('output_requetes_raw', []);
    foreach(array_filter($values) as $v)
      $template->assign_block_vars('output_requetes_raw.output_requetes_col', [
        'VALUE' => getType($v) === 'array' ? implode('<br/>', array_filter($v)) : $v,
      ]);
  }

  private function where($args)
  {
    // Arguments pour mcp_post_additional_options & core.memberlist_view_profile
    if(!empty($args['p']))
      $args['post_id'] = $args['p'];

    if(!empty($args['u'])) {
      $args['user_id'] = $args['u'];
      $args['uri'] = 'register';
    }

    unset($args['limit']);
    unset($args['offset']);

    $conditions = [];

    foreach($this->argument_names as $name => $type)
      if(isset($args[$name]))
        foreach(explode('.', $args[$name]) as $v) {
          $conditions_ou = [];

          foreach(explode('|', $v) as $k => $vv) {
            $vs = array_reverse(explode('!', $vv ?? '')); // Separate the ! at the beginning
            $requ = isset($vs[1]) ? ' != ' : ' = ';
            $rnot = isset($vs[1]) ? ' NOT' : '';

            if($type === 'number')
              $conditions_ou[] = $name.$requ.intval($vs[0]);
            elseif($vs[0] === 'null')
              $conditions_ou[] = "$name IS$rnot NULL";
            else
              $conditions_ou[] = "$name$rnot LIKE '%{$vs[0]}%'";
          }

          if(sizeof($conditions_ou) < 2)
            $conditions[] = $conditions_ou[0];
          else
            $conditions[] = '('.implode(' OR ', $conditions_ou).')';
        }

    return $conditions ? ' WHERE '.implode(' AND ', $conditions) : '';
  }
}
