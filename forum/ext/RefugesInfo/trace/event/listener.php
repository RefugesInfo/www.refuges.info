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

Traces avec tri
[i] sur le post,
point,
commentaire,
user
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
		geoip_setup_custom_directory ($config_wri['racine_projet'].'ressources/geoip');
		// Uploader Geo*.dat de https://mailfud.org/geoip-legacy/
		//TODO cron pour uploader les tables
		//TODO statistique sur les posts/comptes supprimés
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

	// Fait les modifications de structure de la table trace_requettes à chaque purge du cache
	//TODO Provisoire pendant les tests
	public function adm_page_header() {
		$sqls = [
			// 25 02 09
			'ADD COLUMN IF NOT EXISTS asn character(128) NULL',
			'ALTER asn TYPE character(128)',
			// 25 02 12
			'ADD COLUMN IF NOT EXISTS id_point integer NULL',
			'ADD COLUMN IF NOT EXISTS id_commentaire integer NULL',
		];
		if ($this->get['confirm_key'])
			foreach ($sqls as $sql)
				$this->db->sql_query ('ALTER TABLE trace_requettes '.$sql);
	}

	// Log le contexte d'une création de user rejetée
	public function ucp_register_modify_template_data($event, $eventName) {
		$event['user_row'] = $this->post;

		if (!$event['error'])
			$event['error'] = ['création d\'un compte rejetée sans erreur documentée'];

		if (isset ($this->post['new_password'])) // Except when load the registration page
			$this->log_request_context ($event, $eventName);
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
		if (count ($this->post)) { // Except when load a post page
			$post_data = $event['data'] ?: $event['post_data'];
			$user_data = $event['user_row'] ?: $this->user->data;

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

	// Traces dans le panneau de modération d'un user ou d'un post
	public function mcp_additional_options ($event, $eventName) {
		$where = [];
		if (isset ($this->get['p']))
			$where[] = 'post_id = '. $this->get['p'];
		if (isset ($this->get['u'])) {
			$where[] = 'uri LIKE \'%register\'';
			$where[] = 'user_id = '.$this->get['u'];
		}

		$event['where'] = $where;
		$event['ip'] = $event['post_info']['poster_ip'] ?: $event['member']['user_ip'];

		$this->template->assign_var('TRACES', $this->affiche_traces($event, $eventName));
	}

	// Affichage des traces
	public function affiche_traces($event, $eventName) {
		global $vue;

		if ($this->auth->acl_get('m_')) { // Uniquement pour les modérateurs
			$lignes_traces_html = [];
			$where = $event['where'] ?
				' WHERE '.implode(' AND ', $event['where']) :
				'';

			$sql = 'SELECT *'.
				' FROM trace_requettes'.
				$where.
				' ORDER BY trace_id DESC'.
				' LIMIT '.($this->get['limit'] ?: 250).
				($this->get['offset'] ? ' OFFSET '.$this->get['offset'] : '');

			$result = $this->db->sql_query ($sql);
			while ($row = $this->db->sql_fetchrow($result))
				$lignes_traces_html[] = $this->affiche_trace($row);

			$this->db->sql_freeresult($result);
			$vue->nombre_traces = count ($lignes_traces_html);

			$sql = 'SELECT COUNT (trace_id) FROM trace_requettes'.$where;
			$result = $this->db->sql_query ($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);
			$vue->nombre_total_traces = $row['count'];

			// S'il n'y a pas de trace, décode l'IP utilisée.
			if (!count ($lignes_traces_html) && $event['ip'])
				$lignes_traces_html[] = $this->affiche_trace ([
					'ip' => $event['ip'],
				]);

			$event['traces_html'] =  implode ('<hr/>'.PHP_EOL, $lignes_traces_html);
			return $event['traces_html'];
		}
	}

	// Affichage d'une trace
	 private function affiche_trace($input_row) {
		// Enlever les espaces à la fin des champs character(128)
		$row = array_map('trim', array_filter ($input_row));
		$row_from_history = [];

		// Régénération des traces les plus anciennes
		//TODO supprimer <input type="checkbox" name="rebuild"> dans \vues\gestion\historique_traces.html
		if ($this->get['rebuild']) {
			/*//TODO supprimer quand récupéré sur www
			SANS INTERET
			country_code	character(16) NULL
			browser_locale	character(128) NULL
			browser_timezone	character(128) NULL
			real_ip	character(64) NULL
			user_signature	text NULL
			user_posts	integer NULL

			FAIT
			topic_title	character(256) NULL
			point_id	integer NULL
			commentaire_id	integer NULL
			*/

			if ($row['user_id'] > 1 && !$row['user_email']) {
				$sql = 'SELECT *'.
					' FROM phpbb3_users'.
					' WHERE user_id = '.$row['user_id'];
				$result = $this->db->sql_query ($sql);
				$rowuser = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				$row_from_history['user_email'] = $rowuser['user_email'];
				$row_from_history['user_lang'] = $rowuser['user_lang'];
				$row_from_history['user_timezone'] = $rowuser['user_timezone'];
			}

			if (!$row['ext_error'] && $row['mode'] == 'Rejeté')
				$row['ext_error'] =
				$row_from_history['ext_error'] = $row['browser_operator'] == 'server bot' ?
					'["serveur sans javascript"]' :
					'["Rejeté"]';
			if (!$row['ext_error'] && strpos ($row['mode'], 'ucp_register_modify_template_data'))
				$row_from_history['ext_error'] = '["création d\'un compte rejetée sans erreur documentée"]';

			if (!$row['id_point'] && $row['point_id'])
				$row_from_history['id_point'] = $row['point_id'];
			if (!$row['id_commentaire'] && $row['commentaire_id'])
				$row_from_history['id_commentaire'] = $row['commentaire_id'];
			if (!$row['title'] && $row['topic_title'])
				$row_from_history['title'] = $row['topic_title'];

			if ($row['browser_operator'] == 'human')
				$row_from_history['browser_operator'] = 'humain avec mouvement de souris ou tactile';
			if ($row['browser_operator'] == 'server bot')
				$row_from_history['browser_operator'] = 'serveur sans javascript';

			// On limite le stockage des textes
			if (strlen ($row['text']) > 256)
				$row_from_history['text'] = mb_substr ($row['text'], 0, 256);

			// Récupération de l'ASN jusqu'au / dans le host (historique)
			preg_match ('/AS[^\/]*/', $row['host'], $asns_histo);
			if (!$row['asn'] && count ($asns_histo))
				$row['asn'] =
				$row_from_history['asn'] = trim ($asns_histo[0]);
		}
		//TODO fin récup historique

		// Extraction des infos issues de l'IP quand il n'y a pas de trace
		if (!$row['host'] && $row['ip'])
			$row_from_history['host'] = gethostbyaddr ($row['ip']);
		if (!$row['asn'] && $row['ip'])
			$row_from_history['asn'] = geoip_asnum_by_name ($row['ip']);

		// Récupération du n° de point qu'on n'avait pas au moment de la création du forum ascoscié
		if (strpos ($row['uri'], 'point_modification')
			&& !$row['id_point'] && $row['topic_id'])
		{
			$sql = 'SELECT *'.
				' FROM points'.
				' WHERE topic_id = '.$row['topic_id'];
			$result = $this->db->sql_query ($sql);
			$rowpoint = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			if ($rowpoint['id_point'])
				$row_from_history['id_point'] = $rowpoint['id_point'];
		}

		// Update de la table trace_requettes
		$row_from_history = array_filter ($row_from_history);
		if (count ($row_from_history) && $row['trace_id']) {
			$sql = 'UPDATE trace_requettes SET '.
				$this->db->sql_build_array ('UPDATE', $row_from_history).
				' WHERE trace_id = '.$row['trace_id'];
			$this->db->sql_query ($sql);

			//TODO enlever aprés récupération historique
			if (is_dir ($this->config_wri['racine_projet'].'../TEST-DOM'))
				file_put_contents (
					$this->config_wri['racine_projet'].'../TEST-DOM/trace.log',
					$sql.PHP_EOL, FILE_APPEND
				);
		}
		$row = array_filter (array_merge ($row_from_history, $row));

		// Construction de la première ligne
		$colonnes_html = [];

		preg_match ('/(.*) ([a-z_]*)/', $row['mode'], $modes);
		if (strpos ($modes[2], '_')) {
			$row['listener'] = $modes[2];

			$mode = str_replace (
				['post', 'reply', 'quote', 'edit'],
				['création d\'un post', 'réponse à un post', 'quote d\'un post', 'èdition d\'un post'],
				$modes[1]
			);
		}

		$racine = $this->config_wri['sous_dossier_installation'];
		if (isset ($row['ext_error']))
			$colonnes_html[] = 'REJET '.$mode;
			//TODO lien vers un post mis en approbation
		else {
			if (strpos ($row['uri'], 'point_modification')) {
				if (isset ($row['id_point']))
					$colonnes_html[] = 'création d\'un <a href="'.
						$racine.'point/'.$row['id_point'].
					'">point</a>';
				elseif (isset ($row['post_id']))
					$colonnes_html[] = 'création d\'un point et de son <a href="'.
						$racine.'forum/viewtopic.php?p='.$row['post_id']
					.'">forum</a>';
				else
					$colonnes_html[] = 'erreur point_modification sans id_point ni post_id';
			}
			elseif (strpos ($row['uri'], 'ajout_commentaire')) {
				if (isset ($row['id_point']))
					$colonnes_html[] = 'création d\'un <a href="'.
						$racine.'point/'.$row['id_point'].'#C'.$row['id_commentaire'].
					'">commentaire</a>';
				else
					$colonnes_html[] = 'erreur ajout_commentaire sans id_point';
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
				'">'.@$row['user_name'].'</a>'.
				' (toutes <a href="'.
					$racine.'gestion/historique_traces?user_id='.$row['user_id'].
				'">ses contributions</a>)';

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
					['","', '["', '"]', 'posting_modify_template_vars : ', 'ucp_register_modify_template_data : '],
					['<br/>- ', '- ', '', '', ''],
					preg_replace ( // Décode unicode if such returned by extensions
						'/\\\\u([a-e0-9]{4})/',
						'&#x$1;',
						$row['ext_error'],
					),
				);

		preg_match ('/(AS[0-9]+)(.*)/', $row['asn'], $asns);
		$iprecord = geoip_record_by_name ($row['ip']);
		if (isset ($row['ip']))
			$lignes_html = array_merge ($lignes_html, [
				'Fournisseur d\'Accès: <a href="https://ipinfo.io/'.
					($asns[1] ?: $row['ip']).'">'.
					(trim ($asns[2]) ?: $row['host'] ?: $row['ip']).
					'</a> - '.
					$iprecord['country_name'].
					($iprecord['city'] ? ', '.$iprecord['city'] : '').
					($asns[1] ? ' (toutes <a href="'.
					$racine.'gestion/historique_traces?asn='.$asns[1].
					'">ses contributions</a>) ' : ''),
				'WhatIsMyIP de <a href="https://whatismyipaddress.com/ip/'.
					$row['ip'].'">'.$row['ip'].'</a>',
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
					$r = mb_substr ($r, 0, 80).(strlen ($r) > 80 ? '&hellip;' : '');
				$t = ucfirst ($title);
				$lignes_html[] = "$t: $r";
			}

		return '<div class="traces">'.PHP_EOL.'<p>'.
			implode ('</p>'.PHP_EOL.'<p>', $lignes_html).
			'</p>'.PHP_EOL.'</div>';
	}
}
