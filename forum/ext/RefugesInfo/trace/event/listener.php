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

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
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
		preg_match ('|'.$this->server['DOCUMENT_ROOT'].'(.*/)ext/|', __DIR__, $forum_dirs);
		$this->forum_root = $forum_dirs[1];
		$ns = explode ('\\', __NAMESPACE__);
		$this->u_action = $this->forum_root.'mcp.php?i=-'.$ns[0].'-'.$ns[1].'-mcp-main_module';

		// Liste les colonnes pour ne prendre que les arguments qui correspondent
		$this->table_name = 'trace_requettes';
		$this->columns_names = [];

		$sql = 'SELECT column_name FROM information_schema.columns'.
			' WHERE table_name = \''.$this->table_name.'\'';
		$result = $db->sql_query ($sql);
		while ($row = $db->sql_fetchrow($result))
			$this->columns_names[] = @$row['column_name'];
		$db->sql_freeresult($result);
	}

	static public function getSubscribedEvents ()
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

	// Log le contexte d'une création 'user rejetée
	public function ucp_register_modify_template_data($event, $eventName)
	{
		if (isset($this->post['new_password'])) { // Except when load the registration page
			if (!isset($event['error']))
				$event['error'] = ['création d\'un compte rejetée sans erreur documentée'];

			$this->log_request_context ($event, $eventName);
		}
	}

	// Log le contexte d'une soumission de post acceptée
	public function submit_post_end($event, $eventName)
	{
		if (!isset($event['error']) && isset($event['data']['post_visibility']) === 0)
			$event['error'] = array_merge (
				$event['error'] ?? [],
				['Post mis en approbation par CleanTalk']
			);
		$this->log_request_context ($event, $eventName);
	}

	// Log le contexte d'une soumission
	public function log_request_context($event, $eventName)
	{
		global $user;

		if (count ($this->post) && // Except when load a post page
			!strpos ($this->server['REQUEST_URI'], 'mode=edit') && // Edit is not traced
			!isset($this->post['preview'])) // Post preview is not traced
		{
			$post_data = $event['data'] ??
				$event['post_data'] ??
				[];
			$user_data = $event['user_row'] ??
				$user->data ??
				$this->post ??
				[];

			// Données à archiver
			$trace = $this->full_row ([
				// General
				'appel' => strpos($eventName, 'register')
					? 'création compte'
					: @$event['mode'] .str_replace (['core.', 'refugesinfo.'], ' ', $eventName),
				'ext_error' => isset($event['error']) ? json_encode ($event['error']) : null,

				// Server
				'ip' => $this->server['REMOTE_ADDR'],
				'uri' => $this->server['REQUEST_SCHEME'].'://'.
					$this->server['HTTP_HOST'].
					$this->server['REQUEST_URI'],
				'user_agent' => $this->server['HTTP_USER_AGENT'],
				'language' => $this->server['HTTP_ACCEPT_LANGUAGE'],

				// Navigateur
				'browser_operator' =>
					$this->post['browser_operator'] ??
					'serveur sans javascript',
				'date' => date('r'),

				// Post & Point
				'topic_id' => $event['topic_id'] ??
					$post_data['topic_id'] ??
					$this->post['topic_id'] ??
					[],
				'post_id' => $event['post_id'] ??
					$post_data['post_id'] ??
					$this->post['post_id'] ??
					[],
				'id_point' => @$event['point']->id_point,
				'id_commentaire' => @$event['commentaire']->id_commentaire,
				'title' => $event['subject'] ??
					$post_data['topic_title'] ??
					@$event['point']->nom,
				'text' => mb_substr (
					$this->post['message'] ??
						@$event['commentaire']->texte,
					0, 256
				),

				// Infos enregistrées à la création du user
				// Gsont gardées dans la table au cas où on supprimerait le user
				'user_id' => $user_data['user_id'] ?? $event['user_id'] ?? [],
				'user_name' => $this->post['username'] ??
					$this->post['nom_createur'] ??
					$user_data['username'] ??
					[],
				'user_email' => $user_data['user_email'] ??
					$user_data['email'] ??
					[],
				'user_lang' => $user_data['user_lang'] ??
					$user_data['lang'] ??
					[],
				'user_timezone' => $user_data['user_timezone'] ??
					$user_data['tz'] ??
					[],
				'ip_enregistrement' => $user_data['user_ip'] ??
					[],
				'host_enregistrement' => @gethostbyaddr (@$user_data['user_ip']),
			]);
		}
	}

	// Affichage des traces
	//BEST statistique sur les posts/comptes supprimés
	public function display_traces($event, $eventName)
	{
		global $db, $template, $auth;

		if (!$auth->acl_get('m_')) // Uniquement pour les modérateurs
			return;

		$conditions = [];

		// Arguments pour mcp_post_additional_options & core.memberlist_view_profile
		if (isset($this->get['p']))
			$conditions[] = 'post_id = '.$this->get['p'];
		if (isset($this->get['u'])) {
			$conditions[] = 'uri LIKE \'%register%\'';
			$conditions[] = 'user_id = '.$this->get['u'];
		}

		// Liste les colonnes pour ne prendre que les arguments qui correspondent
		foreach ($this->columns_names as $column_name) {
			$gets = array_reverse (explode ('!', @$this->get[$column_name])); // Separate the ! at the beginning

			if (@$gets[0] == 'null')
				$conditions[] = "$column_name IS".(isset ($gets[1]) ? ' NOT' : '')." NULL";
			elseif (is_numeric (@$gets[0]))
				$conditions[] = "$column_name ".(isset ($gets[1]) ? '!' : '')."= {$gets[0]}";
			elseif ($gets[0])
				$conditions[] = "$column_name".(isset ($gets[1]) ? ' NOT' : '')." LIKE '%{$gets[0]}%'";
		}

		$lignes_traces_html = [];

		// Liste des traces affichables
		$where = $conditions ? ' WHERE '.implode(' AND ', $conditions) : '';
		$sql = 'SELECT *'.
			' FROM '.$this->table_name.
			$where.
			' ORDER BY trace_id DESC'.
			' LIMIT '.($this->get['limit'] ?? 250).
			(isset($this->get['offset']) ? ' OFFSET '.$this->get['offset'] : '');
		$result = $db->sql_query ($sql);
		while ($row = $db->sql_fetchrow($result))
			$lignes_traces_html[] = $this->display_one_trace(
				array_map ('trim', array_filter ($row))
			);
		$db->sql_freeresult($result);

		// Nombre de traces répondant aux critères
		$sql = 'SELECT COUNT(trace_id) FROM '.$this->table_name.$where;
		$result = $db->sql_query ($sql);
		$row_count = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		// S'il n'y a pas de trace dans la table, décode l'IP utilisée.
		$event_ip = $event['post_info']['poster_ip'] ??
			@$event['member']['user_ip'];
		if (!$lignes_traces_html && $event_ip)
			$lignes_traces_html[] = $this->display_one_trace ([
				'ip' => $event_ip,
				//TODO ? 'user_id' => @$event['user_id'],
			]);

		$template->assign_vars([
			'WHERE' => implode ('<br/>', $conditions),
			'TRACES' => implode ('<hr/>'.PHP_EOL, $lignes_traces_html),
			'NOMBRE_LIGNES' => count ($lignes_traces_html),
			'NOMBRE_TRACES' => $row_count['count'],
		]);
		$template->assign_vars (array_change_key_case ($this->get, CASE_UPPER));
	}

	// Affichage d'une trace
	private function display_one_trace($row)
	{
		global $db;

		$row = $this->full_row($row);

		// Construction de la première ligne
		$ligne1 = [];

		preg_match ('/(.*) ([a-z_]*)/', @$row['appel'], $modes);
		if (strpos ($modes[2], '_')) {
			$row['listener'] = @$modes[2];

			$appel = str_replace (
				['register', 'post', 'reply',
					'quote', 'edit', ],
				['création d\'un user', 'création d\'un sujet', 'réponse à un post',
					'quote d\'un post', 'èdition d\'un post'],
				$modes[1]
			);
		}

		if (isset($row['ext_error']))
			$ligne1[] = 'REJET '.$appel;
		else
		if (isset($row['uri'])) {
			//BEST lien vers un post mis en approbation
			if (strpos ($row['uri'], 'point_modification')) {
				if (isset($row['id_point']))
					$ligne1[] = 'création d\'un <a '.
						'href="'.$this->forum_root.'../point/'.@$row['id_point'].'"'.
					'>point</a>';
				elseif (isset($row['post_id']))
					$ligne1[] = 'création d\'un point et de son <a '.
						'href="'.$this->forum_root.'viewtopic.php?p='.@$row['post_id'].'"'.
					'>forum</a>';
				else
					$ligne1[] = 'erreur modification point sans id_point ni post_id';
			}
			elseif (strpos ($row['uri'], 'ajout_commentaire')) {
				if (isset($row['id_point']))
					$ligne1[] = 'création d\'un <a '.
						'href="'.$this->forum_root.'../point/'.@$row['id_point'].'#C'.@$row['id_commentaire'].'"'.
					'>commentaire</a>';
				else
					$ligne1[] = 'erreur ajout commentaire sans id_point';
			}
			elseif (strpos ($row['uri'], 'mode=register')) {
				if (isset($row['user_id']))
					$ligne1[] = 'création du compte <a '.
						'href="'.$this->forum_root.'memberlist.php?mode=viewprofile&u='.@$row['user_id'].'"'.
					'>'.@$row['user_name'].'</a>';
				else
					$ligne1[] = 'erreur création du compte sans user_id';
			}
			elseif (strpos ($row['uri'], 'mode=post')) {
				if (isset($row['post_id']))
					$ligne1[] = 'création d\'un <a '.
						'href="'.$this->forum_root.'viewtopic.php?p='.@$row['post_id'].'"'.
					'>sujet</a>';
				elseif (isset($row['topic_id']))
					$ligne1[] = 'création d\'un <a '.
						'href="'.$this->forum_root.'viewtopic.php?t='.@$row['topic_id'].'"'.
					'>sujet</a>';
				else
					$ligne1[] = 'erreur création d\'un post sans topic_id ni post_id';
			}
			elseif (strpos ($row['uri'], 'posting.php')) { // reply, quote, edit
				if (isset($row['post_id']))
					$ligne1[] = str_replace (
						'post',
						'<a href="'.$this->forum_root.'viewtopic.php?p='.@$row['post_id'].'">post</a>',
						$appel
					);
				else
					$ligne1[] = 'erreur posting sans post_id';
			}
			else
				$ligne1[] = 'erreur url inconnue';
		}

		if (!strpos (@$row['uri'], 'mode=register') &&
			@$row['user_id'] > 1)
				$ligne1[] = 'par <a '.
					'href="'.$this->forum_root.'memberlist.php?mode=viewprofile&u='.@$row['user_id'].'"'.
				'>'.@$row['user_name'].'</a>'.
				' (toutes <a '.
					'href="'.$this->u_action.'&user_id='.@$row['user_id'].'"'.
				'>ses contributions</a>)';

		if (count ($ligne1))
			$ligne1[count ($ligne1) - 1] .= '. ';

		if (isset($row['trace_id']) && !isset($this->get['trace_id']))
			$ligne1[] =
				'<sup><a href="'.$this->u_action.'&trace_id='.@$row['trace_id'].'"'.
				'>'.@$row['trace_id'].'</a></sup>';

		// Construction des lignes du rapport
		$lignes_html = [];
		if (count ($ligne1))
			$lignes_html[] = ucfirst (implode (' ', $ligne1)) ;

		if (isset($row['ext_error']))
			$lignes_html[] =
				str_replace ( // Split encoded lines
					['","', '["', '"]', 'posting_modify_template_vars : ', 'ucp_register_modify_template_data : '],
					['<br/>- ', '- ', '', '', ''],
					preg_replace ( // Décode unicode if such returned by extensions
						'/\\\\u([a-e0-9]{4})/',
						'&#x$1;',
						@$row['ext_error'],
					),
				);

		preg_match ('/(AS[0-9]+)(.*)/', @$row['asn'], $asns);
		$fai = trim(@$asns[2]) ??
			$row['host'] ??
			$row['ip'] ??
			'FAI';

		if (isset($row['ip']))
			$lignes_html[] =
				'Fournisseur d\'Accès Internet: '.
				'<a href="https://ipinfo.io/'.($asns[1] ?? @$row['ip']).'">'.
					$fai.
				'</a> - '.
				@$row['country_name'].@$row['city'];
		if (isset($row['ip']) && isset($asns[1]))
			$lignes_html[] = 'Toutes les '.
				'<a '.'href="'.$this->u_action.'&asn='.@$asns[1].'">'.
					'contributions passant par '.$fai.
				'</a>';

		$lignes_traces = [
			'date' => 'date',
			'machine' => 'browser_operator',
			'url' => 'uri',
			'serveur' => 'host',
			'agent' => 'user_agent',
			'languages supportés' => 'language',
			'topic' => 'topic_id',
			'post' => 'post_id',
			'point' => 'id_point',
			'commentaire' => 'id_commentaire',
			'Titre' => 'title',
			'texte' => 'text',
			'id user' => 'user_id',
			'nom user' => 'user_name',
			//'IP' => 'ip',
			//'asn' => 'asn',
			//'PhpBB listener' => 'listener',
			//'appel' => 'appel',
		];

		if (isset($row['user_email']))
			$lignes_traces = array_merge ($lignes_traces, [
				'email user' => 'user_email',
				'language user' => 'user_lang',
				'IP enregistrement' => 'ip_enregistrement',
			]);

		foreach ($lignes_traces as $title => $k)
			if (isset($row[$k])) {
				$r = str_replace (PHP_EOL, ' ', @$row[$k]);
				$r = preg_replace ('/\s\s+/', ' ', $r);
				$r = trim (strip_tags ($r, '<br>'));
				$t = ucfirst ($title);
				$lignes_html[] = "$t: $r";
			}

		if (isset($row['ip']))
			$lignes_html = array_merge ($lignes_html, [
				'<a href="https://ipinfo.io/'.@$row['ip'].'">IpInfo</a> de '.@$row['ip'],
				'<a href="https://whatismyipaddress.com/ip/'.@$row['ip'].'">WhatIsMyIP</a> de '.@$row['ip'],
				'<a href="https://www.iplocation.net/ip-lookup?query='.@$row['ip'].'">IpLocation</a> de '.@$row['ip'],
				'<a href="https://stopforumspam.com/ipcheck/'.@$row['ip'].'">StopForumSpam</a> de '.@$row['ip'],
				'<a href="https://www.spamcop.net/w3m?action=checkblock&ip='.
					@$row['ip'].'">SpamCop</a> de '.@$row['ip'],
				'<a href="https://www.abuseipdb.com/check/'.@$row['ip'].'">AbuseIPdb</a> de '.@$row['ip'],
				'<a href="https://cleantalk.org/blacklists/'.@$row['ip'].'">CleanTalk</a> de '.@$row['ip'],
			]);

		if (isset($row['user_email']))
			$lignes_html[] = '<a href="https://cleantalk.org/email-checker/'.
				@$row['user_email'].'">CleanTalk</a> de '.@$row['user_email'];

		return '<p>'.implode ('</p>'.PHP_EOL.'<p>', $lignes_html).'</p>';
	}

	private function full_row($row)
	{
		global $db, $config_wri;

		if (isset($row['ip']) &&
			function_exists('geoip_setup_custom_directory') &&
			is_dir (__DIR__.'/../../../../cache/geoip/') &&
			is_file (__DIR__.'/../../../../cache/geoip/GeoIP.dat')) {
			geoip_setup_custom_directory (__DIR__.'/../../../../cache/geoip/');
			$row['host'] ??= gethostbyaddr($row['ip']);
			$row['asn'] ??= geoip_asnum_by_name($row['ip']);
			$row['grbn'] ??= geoip_record_by_name($row['ip']);
		}

		preg_match ('/(AS[0-9]+)(.*)/', @$row['asn'], $asns);
		$row['asn_id'] ??= @$asns[1];
		$row['asn_name'] ??= trim (@$asns[2]);

		if (!isset($row['country_name']) && isset($row['grbn']))
			$row = array_merge (@$row['grbn'], $row);

		// Find existing values in the table
		$sql_row = [];
		if (isset($row['trace_id'])) {
			$sql = isset($config_wri) // Spécifique à refuges.info
				? 'SELECT *, points.id_point AS wri_point_id'.
					' FROM '.$this->table_name.
					' LEFT JOIN points USING(topic_id)'.
					' WHERE trace_id = '.@$row['trace_id']
				: 'SELECT *'.
					' FROM '.$this->table_name.
					' WHERE trace_id = '.@$row['trace_id'];
			$result = $db->sql_query ($sql);
			$sql_row = array_map ('trim', array_filter (
				$db->sql_fetchrow($result)
			));
			$db->sql_freeresult($result);
			$sql_row['id_point'] ??= @$sql_row['wri_point_id'];
		}

		// Récupération du n° de point qu'on n'avait pas au moment de la création du forum associé
		$row['id_point'] ??= @$sql_row['id_point'];

		// Find colums to be udated
		$delta_row = array_filter (
			$row,
			function($v, $k) use($sql_row) {
				return
					!empty($v) &&
					$v != @$sql_row[$k] &&
					in_array ($k, $this->columns_names);
			},
			ARRAY_FILTER_USE_BOTH
		);

		if($delta_row && @$row['uri']) {
			// To have the NULL value on the TEXT field
			if (!$delta_row['ext_error'])
				$delta_row['ext_error'] = null;

			if (isset($row['trace_id']))
				$sql = 'UPDATE '.$this->table_name.' SET '.
					$db->sql_build_array ('UPDATE', $delta_row).
					' WHERE trace_id = '.@$row['trace_id'];
			else
				$sql = 'INSERT INTO '.$this->table_name.
					$db->sql_build_array('INSERT', $delta_row);

			$db->sql_query($sql);
		}

		return $row;
	}
}
