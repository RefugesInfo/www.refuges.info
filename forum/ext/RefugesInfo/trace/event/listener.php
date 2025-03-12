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
	public function __construct() {
		global $request, $phpbb_root_path;

		$this->server = $request->get_super_global(\phpbb\request\request_interface::SERVER);
		$this->post = $request->get_super_global(\phpbb\request\request_interface::POST);
		$this->get = $request->get_super_global(\phpbb\request\request_interface::GET) +
			[ // Default url args
				'limit' => 250,
			];
		unset ($this->get['mode']); // N epas utiliser comme sélection

		// Calcul de la racine du forum
		preg_match ('/(.*\/)([a-z]+\/)[a-z]+\./', $this->server['REQUEST_URI'], $uris);
		$ns = explode ('\\', __NAMESPACE__);
		$this->dir_wri = $uris[1];
		$this->dir_forum = $uris[1].$uris[2];
		$this->u_action = $uris[1].$uris[2].'mcp.php?i=-'.$ns[0].'-'.$ns[1].'-mcp-main_module';

		// Data directory for geoip
		$this->geoip_tmp = $phpbb_root_path.'cache/geoip';
		if (!is_dir ($this->geoip_tmp))
			mkdir ($this->geoip_tmp);
		geoip_setup_custom_directory ($this->geoip_tmp);
	}

	static public function getSubscribedEvents () {
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

			// Changements table SQL
			'core.adm_page_header' => 'adm_page_header', // functions_acp.php 51
		];
	}

	// Log le contexte d'une création 'user rejetée
	public function ucp_register_modify_template_data($event, $eventName) {
		if ($this->post['new_password']) { // Except when load the registration page
			if (!$event['error'])
				$event['error'] = ['création d\'un compte rejetée sans erreur documentée'];

			$this->log_request_context ($event, $eventName);
		}
	}

	// Log le contexte d'une soumission de post acceptée
	public function submit_post_end($event, $eventName) {
		if (!$event['error'] && $event['data']['post_visibility'] === 0)
			$event['error'] = array_merge (
				$event['error'] ?: [],
				['Post mis en approbation par CleanTalk']
			);
		$this->log_request_context ($event, $eventName);
	}

	// Log le contexte d'une soumission
	public function log_request_context($event, $eventName) {
		global $db, $user;

		if (count ($this->post) && // Except when load a post page
			!strpos ($this->server['REQUEST_URI'], 'mode=edit') &&
			!$this->post['preview'])
		{
			$post_data = $event['data'] ?: $event['post_data'];
			$user_data = $event['user_row'] ?: $user->data ?: $this->post;

			if (strpos($eventName, 'register') !== false)
				$event['mode'] = 'création compte';

			// Données à archiver
			$trace = [
				// General
				'appel' => $event['mode'] .str_replace (['core.', 'refugesinfo.'], ' ', $eventName),
				'ext_error' => $event['error'] && count ($event['error']) ?
					json_encode($event['error']) :
					null,

				// Server
				'uri' => @$this->server['REQUEST_SCHEME'].'://'.
					@$this->server['HTTP_HOST'].
					@$this->server['REQUEST_URI'],
				'ip' => @$this->server['REMOTE_ADDR'],
				'host' => @gethostbyaddr ($this->server['REMOTE_ADDR']),
				'asn' => @geoip_asnum_by_name ($this->server['REMOTE_ADDR']),
				'user_agent' => @$this->server['HTTP_USER_AGENT'],
				'language' => @$this->server['HTTP_ACCEPT_LANGUAGE'],

				// Navigateur
				'browser_operator' => $this->post['browser_operator'] ?: 'serveur sans javascript',
				'date' => date('r'),

				// Post & Point
				'topic_id' => @$event['topic_id'] ?: @$post_data['topic_id'] ?: $this->post['topic_id'],
				'post_id' => @$event['post_id'] ?: @$post_data['post_id'] ?: $this->post['post_id'],
				'id_point' => $event['point']->id_point,
				'id_commentaire' => $event['commentaire']->id_commentaire,
				'title' => $event['subject'] ?: @$post_data['topic_title'] ?: $event['point']->nom,
				'text' => mb_substr (
					$this->post['message'] ?: $event['commentaire']->texte,
					0, 256
				),

				// Infos enregistrées à la création du user
				'user_id' => @$user_data['user_id'] ?: $event['user_id'],
				'user_name' => $this->post['username'] ?: $this->post['nom_createur'] ?: @$user_data['username'],
				'user_email' => @$user_data['user_email'] ?: @$user_data['email'],
				'user_lang' => @$user_data['user_lang'] ?: @$user_data['lang'],
				'user_timezone' => @$user_data['user_timezone'] ?: @$user_data['tz'],
				'ip_enregistrement' => @$user_data['user_ip'],
				'host_enregistrement' => @gethostbyaddr (@$user_data['user_ip']),
			];

			$sql = 'INSERT INTO trace_requettes'. $db->sql_build_array ('INSERT', array_filter($trace));
			$db->sql_query($sql);

			// Mise à jour des fichiers data geoip sur le temps des bots
			foreach (['', 'City', 'ASNum', 'ISP', 'Org'] as $dn)
				foreach (['', 'v6'] as $ipv) {
					$file_name = $this->geoip_tmp."/GeoIP$dn$ipv.dat";
					if (!is_file ($file_name) || // Si le fichier n'est pas là
						(!$this->post['browser_operator'] && // Si c'est un bot
							filemtime ($file_name) + 7*24*3600 < time () // Et si le fichier est trop vieux
						)
					) {
						file_put_contents ($file_name, gzdecode (
							file_get_contents ("https://mailfud.org/geoip-legacy/GeoIP$dn$ipv.dat.gz")
						));

						break; // On n'en fait qu'un à la fois
					}
				}
		}
	}

	// Affichage des traces
	//BEST statistique sur les posts/comptes supprimés
	public function display_traces($event, $eventName) {
		global $db, $template, $auth;

		if (!$auth->acl_get('m_')) // Uniquement pour les modérateurs
			return;

		$conditions = [];

		// Arguments pour mcp_post_additional_options & core.memberlist_view_profile
		if ($this->get['p'])
			$conditions[] = 'post_id = '. $this->get['p'];
		if ($this->get['u']) {
			$conditions[] = 'uri LIKE \'%register\'';
			$conditions[] = 'user_id = '.$this->get['u'];
		}

		// Liste les colonnes pour ne prendre que les arguments qui correspondent
		$sql = 'SELECT column_name FROM information_schema.columns WHERE table_name = \'trace_requettes\'';
		$result = $db->sql_query ($sql);
		while ($row = $db->sql_fetchrow($result)) {
			$k = $row['column_name'];
			$gets = array_reverse (explode ('!', $this->get[$k]));

			// Ne retient que les arguments correspondant à des colonnes
			if ($gets[0] == 'null')
				$conditions[] = "$k IS".(isset ($gets[1]) ? ' NOT' : '')." NULL";
			elseif (is_numeric ($gets[0]))
				$conditions[] = "$k ".(isset ($gets[1]) ? '!' : '')."= {$gets[0]}";
			elseif ($gets[0])
				$conditions[] = "$k".(isset ($gets[1]) ? ' NOT' : '')." LIKE '%{$gets[0]}%'";
		}
		$db->sql_freeresult($result);

		$lignes_traces_html = [];

		// Liste des traces affichables
		$where = $conditions ? ' WHERE '.implode(' AND ', $conditions) : '';
		$sql = 'SELECT *'.
			' FROM trace_requettes'.
			$where.
			' ORDER BY trace_id DESC'.
			' LIMIT '.($this->get['limit'] ?: 250).
			($this->get['offset'] ? ' OFFSET '.$this->get['offset'] : '');
		$result = $db->sql_query ($sql);
		while ($row = $db->sql_fetchrow($result))
			$lignes_traces_html[] = $this->display_one_trace($row);
		$db->sql_freeresult($result);

		// Nombre de traces répondant aux critères
		$sql = 'SELECT COUNT(trace_id) FROM trace_requettes'.$where;
		$result = $db->sql_query ($sql);
		$row_count = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		// S'il n'y a pas de trace dans la table, décode l'IP utilisée.
		$event_ip = $event['post_info']['poster_ip'] ?: $event['member']['user_ip'];
		if (!$lignes_traces_html && $event_ip)
			$lignes_traces_html[] = $this->display_one_trace ([
				'ip' => $event_ip,
				//'user_id' => $event['user_id'],
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
	 private function display_one_trace($input_row) {
		global $db;

		// Enlever les espaces à la fin des champs character(128)
		$row = array_map('trim', array_filter ($input_row));
		$row_updated = [];

		//TODO ENLEVER QUAND BASE MOULINEE
		if (isset ($this->get['rebuild'])) {
			$lines = [];

			if (!$row['appel'] && $row['mode'])
				$row['appel'] =
				$lines['appel'] = $row['mode'];

			$row = array_filter ($row);
			$lines = array_filter ($lines);
			if (count ($lines)) {
				$sql = 'UPDATE trace_requettes SET '.
					$db->sql_build_array ('UPDATE', $lines).
					' WHERE trace_id = '.$row['trace_id'];
				$db->sql_query ($sql);
			}
		}

		// Extraction des infos issues de l'IP quand il n'y a pas de trace
		if (!$row['host'] && $row['ip'])
			$row_updated['host'] = gethostbyaddr ($row['ip']);
		if (!$row['asn'] && $row['ip'])
			$row_updated['asn'] = @geoip_asnum_by_name ($row['ip']);

		// Récupération du n° de point qu'on n'avait pas au moment de la création du forum ascoscié
		if (strpos ($row['uri'], 'point_modification')
			&& !$row['id_point'] && $row['topic_id'])
		{
			$sql = 'SELECT *'.
				' FROM points'.
				' WHERE topic_id = '.$row['topic_id'];
			$result = $db->sql_query ($sql);
			$rowpoint = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			if ($rowpoint['id_point'])
				$row_updated['id_point'] = $rowpoint['id_point'];
		}

		// Update de la table trace_requettes
		$row_updated = array_filter ($row_updated);
		if (count ($row_updated) && $row['trace_id']) {
			$sql = 'UPDATE trace_requettes SET '.
				$db->sql_build_array ('UPDATE', $row_updated).
				' WHERE trace_id = '.$row['trace_id'];
			$db->sql_query ($sql);
		}

		// Construction de la première ligne
		$row = array_merge ($row_updated, $row);
		$colonnes_html = [];

		preg_match ('/(.*) ([a-z_]*)/', $row['appel'], $modes);
		if (strpos ($modes[2], '_')) {
			$row['listener'] = $modes[2];

			$appel = str_replace (
				['register', 'post', 'reply',
					'quote', 'edit', ],
				['création d\'un user', 'création d\'un sujet', 'réponse à un post',
					'quote d\'un post', 'èdition d\'un post'],
				$modes[1]
			);
		}

		if ($row['ext_error'])
			$colonnes_html[] = 'REJET '.$appel;
		else {
			//BEST lien vers un post mis en approbation
			if (strpos ($row['uri'], 'point_modification')) {
				if ($row['id_point'])
					$colonnes_html[] = 'création d\'un <a '.
						'href="'.$this->dir_wri.'point/'.$row['id_point'].'"'.
					'>point</a>';
				elseif ($row['post_id'])
					$colonnes_html[] = 'création d\'un point et de son <a '.
						'href="'.$this->dir_forum.'viewtopic.php?p='.$row['post_id'].'"'.
					'>forum</a>';
				else
					$colonnes_html[] = 'erreur modification point sans id_point ni post_id';
			}
			elseif (strpos ($row['uri'], 'ajout_commentaire')) {
				if ($row['id_point'])
					$colonnes_html[] = 'création d\'un <a '.
						'href="'.$this->dir_wri.'point/'.$row['id_point'].'#C'.$row['id_commentaire'].'"'.
					'>commentaire</a>';
				else
					$colonnes_html[] = 'erreur ajout commentaire sans id_point';
			}
			elseif (strpos ($row['uri'], 'mode=register')) {
				if ($row['user_id'])
					$colonnes_html[] = 'création du compte <a '.
						'href="'.$this->dir_forum.'memberlist.php?mode=viewprofile&u='.$row['user_id'].'"'.
					'>'.@$row['user_name'].'</a>';
				else
					$colonnes_html[] = 'erreur création du compte sans user_id';
			}
			elseif (strpos ($row['uri'], 'mode=post')) {
				if ($row['post_id'])
					$colonnes_html[] = 'création d\'un <a '.
						'href="'.$this->dir_forum.'viewtopic.php?p='.$row['post_id'].'"'.
					'>sujet</a>';
				elseif ($row['topic_id'])
					$colonnes_html[] = 'création d\'un <a '.
						'href="'.$this->dir_forum.'viewtopic.php?t='.$row['topic_id'].'"'.
					'>sujet</a>';
				else
					$colonnes_html[] = 'erreur création d\'un post sans topic_id ni post_id';
			}
			elseif (strpos ($row['uri'], 'posting.php')) { // reply, quote, edit
				if ($row['post_id'])
					$colonnes_html[] = str_replace (
						'post',
						'<a href="'.$this->dir_forum.'viewtopic.php?p='.$row['post_id'].'">post</a>',
						$appel
					);
				else
					$colonnes_html[] = 'erreur posting inconnu';
			}
			//else
				//$colonnes_html[] = 'erreur url inconnue';
		}

		if (!strpos ($row['uri'], 'mode=register') &&
			$row['user_id'] > 1)
				$colonnes_html[] = 'par <a '.
					'href="'.$this->dir_forum.'memberlist.php?mode=viewprofile&u='.$row['user_id'].'"'.
				'>'.@$row['user_name'].'</a>'.
				' (toutes <a '.
					'href="'.$this->u_action.'&user_id='.$row['user_id'].'"'.
				'>ses contributions</a>)';

		if (count ($colonnes_html))
			$colonnes_html[count ($colonnes_html) - 1] .= '. ';

		if (!$this->get['trace_id']) {
			$colonnes_html[] =
				'<sup><a href="'.$this->u_action.'&trace_id='.$row['trace_id'].'"'.
				'>'.$row['trace_id'].'</a></sup>';
		}

		// Construction des lignes du rapport
		$lignes_html = [];
		if (count ($colonnes_html))
			$lignes_html[] = ucfirst (implode (' ', $colonnes_html)) ;

		if ($row['ext_error'])
			$lignes_html[] =
				str_replace ( // Split encoded lines
					['","', '["', '"]', 'posting_modify_template_vars : ', 'ucp_register_modify_template_data : '],
					['<br/>- ', '- ', '', '', ''],
					preg_replace ( // Décode unicode if such returned by extensions
						'/\\\\u([a-e0-9]{4})/',
						'&#x$1;',
						$row['ext_error'],
					),
				);

		preg_match ('/(AS[0-9]+)(.*)/', $row['asn'], $asns);
		$iprecord = @geoip_record_by_name ($row['ip']);

		if ($row['ip'])
			$lignes_html = array_merge ($lignes_html, [
				'Fournisseur d\'Accès Internet: <a href="https://ipinfo.io/'.
					($asns[1] ?: $row['ip']).'">'.
					(trim ($asns[2]) ?: $row['host'] ?: $row['ip']).
					'</a> - '.
					$iprecord['country_name'].
					($iprecord['city'] ? ', '.$iprecord['city'] : '').
					($asns[1] ? ' (toutes les <a '.
					'href="'.$this->u_action.'&asn='.$asns[1].'"'.
					'>contributions passant par ce FAI</a>) ' : ''),
				'<a href="https://ipinfo.io/'.$row['ip'].'">IpInfo</a> de '.$row['ip'],
				'<a href="https://whatismyipaddress.com/ip/'.$row['ip'].'">WhatIsMyIP</a> de '.$row['ip'],
				'<a href="https://cleantalk.org/blacklists/'.$row['ip'].'">CleanTalk</a> de '.$row['ip'],
				'<a href="https://stopforumspam.com/ipcheck/'.$row['ip'].'">StopForumSpam</a> de '.$row['ip'],
				'<a href="https://www.spamcop.net/w3m?action=checkblock&ip='.
					$row['ip'].'">SpamCop</a> de '.$row['ip'],
				'<a href="https://www.abuseipdb.com/check/'.$row['ip'].'">AbuseIPdb</a> de '.$row['ip'],
			]);

		if ($row['user_email'])
			$lignes_html[] = 'CleanTalk <a href="https://cleantalk.org/email-checker/'.
				$row['user_email'].'"></a>';

		$colonnes_traces = [
			'date' => 'date',
			'machine' => 'browser_operator',
			'url' => 'uri',
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
			//'host' => 'host',
			//'asn' => 'asn',
			//'PhpBB listener' => 'listener',
			//'appel' => 'appel',
		];
		if ($row['user_email'])
			$colonnes_traces = array_merge ($colonnes_traces, [
				'email user' => 'user_email',
				'language user' => 'user_lang',
				'IP enregistrement' => 'ip_enregistrement',
			]);

		foreach ($colonnes_traces as $title => $k)
			if ($row[$k]) {
				$r = str_replace (PHP_EOL, ' ', $row[$k]);
				$r = preg_replace ('/\s\s+/', ' ', $r);
				$r = trim (strip_tags ($r, '<br>'));
				$t = ucfirst ($title);
				$lignes_html[] = "$t: $r";
			}

		return '<div class="traces">'.PHP_EOL.'<p>'.
			implode ('</p>'.PHP_EOL.'<p>', $lignes_html).
			'</p>'.PHP_EOL.'</div>';
	}

	// Fait les modifications de structure de la table trace_requettes à chaque purge du cache
	// Fait ici car difficile à controler dans migrations
	public function adm_page_header() {
		global $db, $phpbb_container;

		$db_tools = $phpbb_container->get('dbal.tools');
		$table_name = 'trace_requettes';
		$colums = [
			'appel' => ['CHAR:128', NULL],
			'ext_error' => ['TEXT', NULL],
			'uri' => ['TEXT', NULL],
			'ip' => ['CHAR:64', NULL],
			'host' => ['CHAR:255', NULL],
			'asn' => ['CHAR:128', NULL],
			'user_agent' => ['CHAR:255', NULL],
			'language' => ['CHAR:128', NULL],
			'browser_operator' => ['CHAR:128', NULL],
			'date' => ['CHAR:64', NULL],
			'topic_id' => ['UINT', NULL],
			'post_id' => ['UINT', NULL],
			'id_point' => ['UINT', NULL],
			'id_commentaire' => ['UINT', NULL],
			'title' => ['CHAR:255', NULL],
			'text' => ['TEXT', NULL],
			'user_id' => ['UINT', NULL],
			'user_name' => ['CHAR:128', NULL],
			'user_email' => ['CHAR:128', NULL],
			'user_lang' => ['CHAR:128', NULL],
			'user_timezone' => ['CHAR:64', NULL],
			'ip_enregistrement' => ['CHAR:64', NULL],
			'host_enregistrement' => ['CHAR:128', NULL],
		];

		if ($this->get['confirm_key'] &&
			$db_tools->sql_table_exists($table_name)
		)
			foreach ($colums as $column_name => $column_data)
				if ($db_tools->sql_column_exists ($table_name, $column_name))
					$db_tools->sql_column_change ($table_name, $column_name, $column_data);
				else
					$db_tools->sql_column_add ($table_name, $column_name, $column_data);
	}
}
