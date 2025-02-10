<?php
// Ce fichier centralise les fonctions PHP liées à tracer l'environnement des posts et enregistrements
// Attention: Le code suivant s'exécute dans un "namespace" bien défini

/* tests à faire
Création user
Création post
Création point
Création commentaire

Déconnecté refusé
Déconnecté
Connecté refusé
Connecté
*/

namespace RefugesInfo\trace\event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

if (!defined('IN_PHPBB')) exit;

use phpbb\request\request;
use phpbb\user;
use phpbb\auth\auth;
use phpbb\language\language;
use phpbb\template\template;
use phpbb\db\driver\driver_interface as db;

class listener implements EventSubscriberInterface
{
	public function __construct(
		request $request,
		user $user,
		auth $auth,
		language $language,
		template $template,
		db $db)
	{
		$this->server = $request->get_super_global(\phpbb\request\request_interface::SERVER);
		$this->get = $request->get_super_global(\phpbb\request\request_interface::GET);
		$this->post = $request->get_super_global(\phpbb\request\request_interface::POST);
		$this->request = $request;
		$this->user = $user;
		$this->auth = $auth;
		$this->language = $language;
		$this->template = $template;
		$this->db = $db;

		// Contexte refuges.info
		global $config_wri;
		$request->enable_super_globals(); // Pour avoir accés aux variables globales $_SERVER, ...
		require_once (__DIR__.'/../../../../../includes/config.php');
		$this->config_wri = $config_wri;
		// Uploader Geo*.dat de https://mailfud.org/geoip-legacy/
		geoip_setup_custom_directory ($config_wri['racine_projet'].'ressources/geoip');
	}

	static public function getSubscribedEvents () {
		return [
			'core.adm_page_header' => 'adm_page_header', // functions_acp.php 51
			'core.ucp_register_modify_template_data' => 'ucp_register_modify_template_data', // ucp_register.php 682
			'core.posting_modify_template_vars' => 'log_request_context', // posting.php 2089 (post rejeté)
			'core.ucp_register_register_after' => 'log_request_context', // ucp_register.php 562 (user acceptée)
			'core.submit_post_end' => 'submit_post_end', // functions_posting.php 2634
			'wri.point_ajout_commentaire' => 'log_request_context',
			'wri.affiche_traces' => 'affiche_traces',
			'core.mcp_post_additional_options' => 'mcp_additional_options', // mcp_post.php 125
			'core.memberlist_view_profile' => 'mcp_additional_options', // memberlist.php 757
		];
	}

	// Fait les modifiactions de structure de la table trace_requettes à chaque purge du cache
	// Provisoire pendant les tests :)
	public function adm_page_header() {
		$sqls = [
			//'ADD COLUMN IF NOT EXISTS column_name character(64) NULL',
			'ADD COLUMN IF NOT EXISTS asn character(16) NULL',
			//'ALTER column_name TYPE character(64)',
			'ALTER asn TYPE character(128)',
		];
		if ($this->get['confirm_key'])
			foreach ($sqls as $sql)
				$this->db->sql_query ('ALTER TABLE trace_requettes '.$sql);
	}

	// Log le contexte d'une création de user rejetée
	public function ucp_register_modify_template_data($event, $eventName) {
		$event['user_row'] = $this->post;

		if (isset ($this->post['new_password'])) // Except when load the registration page
			$this->log_request_context ($event, $eventName);
	}

	// Log le contexte d'une soumission de post acceptée
	//TODO manque le point_id
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
		if (count ($this->post)) { // Except when load a post page
			$post_data = $event['data'] ?: $event['post_data'];

			if (strpos($eventName, 'register') !== false)
				$event['mode'] = 'création compte';

			$trace = [
				// General
				'mode' => $event['mode'] .str_replace (['core.', 'wri.'], ' ', $eventName),
				'ext_error' => $event['error'] && count ($event['error']) ?
					json_encode($event['error']) :
					null,

				// Server
				'uri' => @$this->server['REQUEST_SCHEME'].'://'.
					@$this->server['HTTP_HOST'].
					@$this->server['REQUEST_URI'],
				'ip' => @$this->server['REMOTE_ADDR'],
				'host' => @gethostbyaddr ($this->server['REMOTE_ADDR']),
				'asn' => geoip_asnum_by_name ($this->server['REMOTE_ADDR']),
				'user_agent' => @$this->server['HTTP_USER_AGENT'],
				'language' => @$this->server['HTTP_ACCEPT_LANGUAGE'],

				// Navigateur
				'browser_operator' => $this->post['browser_operator'] ?: 'serveur sans javascript',
				'sid' => @$this->user->session_id,
				'date' => date('r'),

				// Post & Point
				'topic_id' => @$event['topic_id'] ?: @$post_data['topic_id'] ?: $this->post['topic_id'],
				'post_id' => @$event['post_id'] ?: @$post_data['post_id'] ?: $this->post['post_id'],
				'point_id' => $event['point']->id_point,
				'commentaire_id' => $event['commentaire']->id_commentaire,
				'title' => $event['subject'] ?: @$post_data['topic_title'] ?: $event['point']->nom,
				'text' => $this->post['message'] ?: $event['commentaire']->texte,

				// Infos enregistrées à la création du user
				'user_id' => @$user_data['user_id'] ?: $event['user_id'],
				'user_name' => $this->post['username'] ?: $this->post['nom_createur'] ?: @$user_data['username'],
				'user_email' => @$user_data['user_email'] ?: @$user_data['email'],
				'user_signature' => str_replace ('<t></t>', '', @$user_data['user_sig']),
				'user_posts' => @$user_data['user_posts'],
				'user_lang' => @$user_data['user_lang'] ?: @$user_data['lang'],
				'user_timezone' => @$user_data['user_timezone'] ?: @$user_data['tz'],
				'ip_enregistrement' => @$user_data['user_ip'],
				'host_enregistrement' => @gethostbyaddr (@$user_data['user_ip']),
			];

			$sql = 'INSERT INTO trace_requettes'. $this->db->sql_build_array ('INSERT', array_filter($trace));
			$this->db->sql_query($sql);
		}
	}

	// Traces dans le panneau de modération d'un d'un user ou d'un post
	public function mcp_additional_options ($event, $eventName) {
		$event = [
			'where' => '',
			'ip' => $event['post_info']['poster_ip'] ?: $event['member']['user_ip'],
		];
		if (isset ($this->get['p']))
			$event['where'] = ' WHERE post_id = '. $this->get['p'];

		if (isset ($this->get['u']))
			$event['where'] =
				' WHERE uri LIKE \'%register\''.
				' AND user_id = '.$this->get['u'];

		$this->template->assign_var('TRACES', $this->affiche_traces($event, $eventName));
	}

	// Affichage des traces
	public function affiche_traces($event, $eventName) {
		if ($this->auth->acl_get('m_')) { // Uniquement pour les modérateurs
			$lignes_traces_html = [];

			$sql = 'SELECT trace_requettes.*, points.topic_id AS point_topic_id'.
				' FROM trace_requettes'.
				' LEFT JOIN points ON (trace_requettes.topic_id = points.topic_id)'.
				$event['where'].
				' ORDER BY trace_id DESC'.
				' LIMIT '.($this->get['limit'] ?: 250).
				($this->get['offset'] ? ' OFFSET '.$this->get['offset'] : '');

			$result = $this->db->sql_query ($sql);
			while ($row = $this->db->sql_fetchrow($result))
				$lignes_traces_html[] = $this->affiche_trace($row);
			$this->db->sql_freeresult($result);


			if (!count ($lignes_traces_html) && $event['ip'])
				$lignes_traces_html[] = $this->affiche_trace ([
					'ip' => $event['ip'],
				]);

			$event['traces_html'] =  implode (PHP_EOL.'<hr/>'.PHP_EOL, $lignes_traces_html);
			return $event['traces_html'];
		}
	}

	// Affichage d'une trace
	 private function affiche_trace($input_row) {
		$row = array_map('trim', array_filter ($input_row));
		preg_match ('/(.*) ([a-z_]*)/', $row['mode'], $modes);

		// Reconstruction de la base des infos issues de l'IP
		if (isset ($this->get['rebuild'])) {
			$lines = [];

			if (!$row['host'] && $row['ip'])
				$row['host'] =
				$lines['host'] = gethostbyaddr ($row['ip']);

			preg_match ('/AS[^\/]*/', $row['host'], $asns);
			if (!$row['asn'] && count ($asns))
				$row['asn'] =
				$lines['asn'] = trim ($asns[0]);

			if (!$row['asn'])
				$row['asn'] =
				$lines['asn'] = geoip_asnum_by_name ($row['ip']);

			$row = array_filter ($row);
			$lines = array_filter ($lines);
			if (count ($lines)) {
				$sql = 'UPDATE trace_requettes SET '.
					$this->db->sql_build_array ('UPDATE', $lines).
					' WHERE trace_id = '.$row['trace_id'];
				$this->db->sql_query ($sql);
			}
		}

		if (strpos ($modes[2], '_')) {
			$row['listener'] = $modes[2];

			$mode = str_replace (
				['post', 'reply', 'reply', 'quote', 'edit'],
				['création d\'un post', 'réponse à un post', 'réponse à un post', 'èdition d\'un post'],
				$modes[1]
			);
		}

		if (isset ($row['topic_title']))
			$row['titre'] = $row['topic_title'];

		// Construction de la première ligne
		$colonnes_html = [];
		$racine = $this->config_wri['sous_dossier_installation'];

		if (isset ($row['ext_error']))
			$colonnes_html[] = 'REJET '.$mode;
		else {
			if (strpos ($row['uri'], 'point_modification')) {
				if (isset ($row['point_id']))
					$colonnes_html[] = 'création d\'un <a href="'.
						$racine.'point/'.$row['point_id'].
					'">point</a>';
				elseif (isset ($row['post_id']))
					$colonnes_html[] = 'création d\'un point et de son <a href="'.
						$racine.'forum/viewtopic.php?p='.$row['post_id']
					.'">forum</a>';
				else
					$colonnes_html[] = 'erreur point_modification sans point_id';
			}
			elseif (strpos ($row['uri'], 'ajout_commentaire')) {
				if (isset ($row['point_id']))
					$colonnes_html[] = 'création d\'un <a href="'.
						$racine.'point/'.$row['point_id'].'#C'.$row['commentaire_id'].
					'">commentaire</a>';
				else
					$colonnes_html[] = 'erreur ajout_commentaire sans point_id';
			}
			elseif (strpos ($row['uri'], 'mode=register')) {
				if (isset ($row['user_id']))
					$colonnes_html[] = 'création du compte <a href="'.
						$racine.'forum/memberlist.php?mode=viewprofile&u='.$row['user_id'].
					'">'.@$row['user_name'].'</a>';
				else
					$colonnes_html[] = 'erreur register';
			}
			elseif (isset ($row['post_id']))
				$colonnes_html[] = 'création d\'un <a href="'.
					$racine.'forum/viewtopic.php?p='.$row['post_id'].
				'">post</a>';
			elseif (isset ($row['topic_id']))
				$colonnes_html[] = 'création d\'un <a href="'.
					$racine.'forum/viewtopic.php?t='.$row['topic_id'].
				'">sujet</a>';
			elseif ($row['uri'])
				$colonnes_html[] = 'contribution inconnue';
		}

		if (!strpos ($row['uri'], 'mode=register') &&
			$row['user_id'] > 1)
				$colonnes_html[] = 'par <a href="'.
					$racine.'forum/memberlist.php?mode=viewprofile&u='.$row['user_id'].
				'">'.@$row['user_name'].'</a>';

		if (count ($colonnes_html))
			$colonnes_html[count ($colonnes_html) - 1] .= '. ';

		if (!$this->get['trace_id']) {
			$colonnes_html[] =
				'<sup><a href="'.$racine.
				'gestion/historique_traces?trace_id='.$row['trace_id'].
				'">'.$row['trace_id'].'</a></sup>';
		}

		// Construction des lignes du rapport
		$lignes_html = [];
		if (count ($colonnes_html))
			$lignes_html[] = ucfirst (implode (' ', $colonnes_html)) ;

		if (isset ($row['ext_error']))
			$lignes_html[] =
				str_replace ( // Split encoded lines
					['","', '["', '"]'],
					['<br/>- ', '- ', ''],
					preg_replace ( // Décode unicode if such returned by extensions
						'/\\\\u([a-e0-9]{4})/',
						'&#x$1;',
						$row['ext_error'],
					),
				);

		if (!$row['asn'])
			$row['asn'] = geoip_asnum_by_name ($row['ip']);
		preg_match ('/(AS[0-9]+)(.*)/', $row['asn'], $asns);
		$city = geoip_record_by_name ($row['ip']);

		if (isset ($row['ip']))
			$lignes_html = array_merge ($lignes_html, [
				'Fournisseur d\'Accès: <a href="https://ipinfo.io/'.
					($asns[1] ?: $row['ip']).'">'.
					(trim ($asns[2]) ?: $row['host'] ?: $row['ip']).
					'</a>'.
					($asns[1] ? ' (voir toutes les traces: <a href="'.
					$racine.'gestion/historique_traces?asn='.$asns[1].
					'">'.$asns[1].'</a>)' : ''),
				'Localisation du point d\'entrée <a href="https://whatismyipaddress.com/ip/'.
					$row['ip'].'">'.$row['ip'].'</a> ('.$city['country_name'].
					($city['city'] ? ' - '.$city['city'] : '').
					')',
				'CleanTalk de <a href="https://cleantalk.org/blacklists/'.
					$row['ip'].'">'.$row['ip'].'</a>',
				'StopForumSpam de <a href="https://stopforumspam.com/ipcheck/'.
					$row['ip'].'">'.$row['ip'].'</a>',
				'SpamCop de <a href="https://www.spamcop.net/w3m?action=checkblock&ip='.
					$row['ip'].'">'.$row['ip'].'</a>',
				'AbuseIPdb de <a href="https://www.abuseipdb.com/check/'.
					$row['ip'].'">'.$row['ip'].'</a>',
			]);

		if (isset ($row['user_email']))
			$lignes_html[] = 'CleanTalk <a href="https://cleantalk.org/email-checker/'.
				$row['user_email'].'"></a>';

		$colonnes_traces = [
			'date' => 'date',
			'machine' => 'browser_operator',
			'url' => 'uri',
			'agent' => 'user_agent',
			'languages supportés' => 'language',
			'topic id' => 'topic_id',
			'post id' => 'post_id',
			'point_id' => 'point_id',
			'commentaire_id' => 'commentaire_id',
			'Titre' => 'title',
			'texte' => 'text',
			'id user' => 'user_id',
			'nom user' => 'user_name',
			//'IP' => 'ip',
			//'host' => 'host',
			//'asn' => 'asn',
			//'PhpBB listener' => 'listener',
			//'mode' => 'mode',
		];
		if ($row['user_email'])
			$colonnes_traces = array_merge ($colonnes_traces, [
				'email user' => 'user_email',
				'language user' => 'user_lang',
				'IP enregistrement' => 'ip_enregistrement',
			]);

		foreach ($colonnes_traces as $title => $k)
			if (isset ($row[$k])) {
				$r = str_replace (PHP_EOL, ' ', $row[$k]);
				$r = preg_replace ('/\s\s+/', ' ', $r);
				$r = trim (strip_tags ($r, '<br>'));
				if ($k == 'text')
					$r = substr ($r, 0, 80).(strlen ($r) > 80 ? '&hellip;' : '');
				$t = ucfirst ($title);
				$lignes_html[] = "$t: $r";
			}

		return '<div class="traces">'.PHP_EOL.'<p>'.
			implode ('</p>'.PHP_EOL.'<p>', $lignes_html).
			'</p>'.PHP_EOL.'</div>';
	}
}
