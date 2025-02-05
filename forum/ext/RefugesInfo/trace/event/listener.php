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

class listener implements EventSubscriberInterface
{
	public function __construct(
	) {
		global $request;

		$this->server = $request->get_super_global(\phpbb\request\request_interface::SERVER);
		$this->get = $request->get_super_global(\phpbb\request\request_interface::GET);
		$this->post = $request->get_super_global(\phpbb\request\request_interface::POST);
	}

	static public function getSubscribedEvents () {
		return [
			// Log le contexte d'une création de user rejetée
			'core.ucp_register_modify_template_data' => 'ucp_register_modify_template_data', // ucp_register.php 682
			// Log le contexte d'une soumission de post rejeté
			'core.posting_modify_template_vars' => 'log_request_context', // posting.php 2089
			// Log le contexte d'une création de user acceptée
			'core.ucp_register_register_after' => 'log_request_context', // ucp_register.php 562
			// Log le contexte d'une soumission de point ou de post acceptée //TODO manque le point_id
			'core.submit_post_end' => 'submit_post_end', // functions_posting.php 2634
			// Log le contexte d'une soumission de commentaire
			'wri.point_ajout_commentaire' => 'log_request_context',
			// Traces dans une fiche
			'wri.list_traces' => 'list_traces',
			// Traces dans le panneau de modération d'un d'un user
			'core.mcp_post_additional_options' => 'mcp_additional_options', // mcp_post.php 125
			// Traces dans le panneau de modération d'un post
			'core.memberlist_view_profile' => 'mcp_additional_options', // memberlist.php 757
		];
	}

	// Log le contexte d'une création de user rejetée
	 public function ucp_register_modify_template_data($vars, $eventName) {
		$vars['user_row'] = $this->post;

		if (isset ($this->post['new_password'])) // Except when load the registration page
			$this->log_request_context ($vars, $eventName);
	}

	// Log le contexte d'une soumission de post acceptée
	 public function submit_post_end($vars, $eventName) {
		if (!$vars['error'] && $vars['data']['post_visibility'] === 0)
			$vars['error'] = array_merge (
				$vars['error'] ?: [],
				['Post mis en approbation par CleanTalk']
			);
		$this->log_request_context ($vars, $eventName);
	}

	// Log le contexte d'une soumission
	 public function log_request_context($vars, $eventName) {
		global $user, $auth, $db;

		if (count ($this->post) && // Except when load a post page
			!$auth->acl_get('m_')) // Sauf pour les modérateurs
		{
			$post_data = $vars['data'] ?: $vars['post_data'];

			if (strpos($eventName, 'register') !== false)
				$vars['mode'] = 'création compte';

			$log = [
				// General
				'mode' => $vars['mode'] .str_replace (['core.', 'wri.'], ' ', $eventName),
				'ext_error' => $vars['error'] && count ($vars['error']) ?
					json_encode($vars['error']) :
					null,

				// Server
				'uri' => @$this->server['REQUEST_SCHEME'].'://'.
					@$this->server['HTTP_HOST'].
					@$this->server['REQUEST_URI'],
				'ip' => @$this->server['REMOTE_ADDR'],
				'host' => $this->gethost(@$this->server['REMOTE_ADDR']),
				'user_agent' => @$this->server['HTTP_USER_AGENT'],
				'language' => @$this->server['HTTP_ACCEPT_LANGUAGE'],

				// Navigateur
				'browser_operator' => $this->post['browser_operator'] ?: 'serveur sans javascript',
				'sid' => @$user->session_id,
				'date' => date('r'),

				// Post & Point
				'topic_id' => @$post_data['topic_id'] ?: $this->post['topic_id'],
				'post_id' => @$post_data['post_id'] ?: $this->post['post_id'],
				'point_id' => $vars['point']->id_point,
				'commentaire_id' => $vars['commentaire']->id_commentaire,
				'title' => $vars['subject'] ?: @$post_data['topic_title'] ?: $vars['point']->nom,
				'text' => $this->post['message'] ?: $vars['commentaire']->texte,

				// Infos enregistrées à la création du user
				'user_id' => @$user_data['user_id'] ?: $vars['user_id'],
				'user_name' => $this->post['username'] ?: $this->post['nom_createur'] ?: @$user_data['username'],
				'user_email' => @$user_data['user_email'] ?: @$user_data['email'],
				'user_signature' => str_replace ('<t></t>', '', @$user_data['user_sig']),
				'user_posts' => @$user_data['user_posts'],
				'user_lang' => @$user_data['user_lang'] ?: @$user_data['lang'],
				'user_timezone' => @$user_data['user_timezone'] ?: @$user_data['tz'],
				'ip_enregistrement' => @$user_data['user_ip'],
				'host_enregistrement' => $this->gethost (@$user_data['user_ip']),
			];

			$sql = 'INSERT INTO trace_requettes'. $db->sql_build_array ('INSERT', array_filter($log));
			$db->sql_query($sql);
		}
	}

	private function gethost ($ip) {
		if (substr_count ($ip, '.') === 3) {
			$ipinfo = @json_decode( file_get_contents ("https://ipinfo.io/$ip/json"));
			if ($ipinfo)
				return $ipinfo->org.' / '.$ipinfo->hostname;

			return gethostbyaddr($ip);
		}
	}

	 public function mcp_additional_options ($vars, $eventName) {
		global $template, $user, $phpbb_dispatcher;

		$vars = [
			'where' => '',
			'ip' => $vars['post_info']['poster_ip'] ?: $vars['member']['user_ip'],
		];
		if (isset ($this->get['p']))
			$vars['where'] = ' WHERE post_id = '. $this->get['p'];

		if (isset ($this->get['u']))
			$vars['where'] =
				' WHERE uri LIKE \'%register\''.
				' AND user_id = '.$this->get['u'];

		$template->assign_var('TRACES', $this->list_traces($vars, $eventName));
	}

	// Affichage des traces
	 public function list_traces($vars, $eventName) {
		global $db, $auth;

		if ($auth->acl_get('m_')) {
			$lignes_traces_html = [];

			$sql = 'SELECT trace_requettes.*, points.topic_id AS point_topic_id'.
				' FROM trace_requettes'.
				' LEFT JOIN points ON (trace_requettes.topic_id = points.topic_id)'.
				$vars['where'].
				' ORDER BY trace_id DESC'.
				' LIMIT '.($vars['limit'] ?: 250);
			$result = $db->sql_query ($sql);
			while ($row = $db->sql_fetchrow($result))
				$lignes_traces_html[] = $this->affiche_trace($row);
			$db->sql_freeresult($result);


			if (!count ($lignes_traces_html) && $vars['ip'])
				$lignes_traces_html[] = $this->affiche_trace ([
					'ip' => $vars['ip'],
				]);

			$vars['traces_html'] =  implode (PHP_EOL.'<hr/>'.PHP_EOL, $lignes_traces_html);
			return $vars['traces_html'];
		}
	}

	// Affichage des traces
	 private function affiche_trace($input_row) {
		// Contexte WRI
		global $request, $config_wri; // $config_wri pour le contexte du require dans la fonction
		$request->enable_super_globals(); // Pour avoir accés aux variables globales $_SERVER, ...
		require_once (__DIR__.'/../../../../../includes/config.php');

		$row = array_map('trim', array_filter ($input_row));
		preg_match('/(.*) ([a-z_]*)/',$row['mode'],$mode);
		if (strpos ($mode[2], '_')) {
			$row['listener'] = $mode[2];
			$row['mode'] = str_replace (
				['post', 'reply', 'reply', 'quote', 'edit'],
				['création d\'un post', 'réponse à un post', 'réponse à un post', 'èdition d\'un post'],
				$mode[1]
			);
		}

		if (isset ($row['topic_title']))
			$row['titre'] = $row['topic_title'];

		if (isset ($row['ext_error']))
			$row['display_error'] =
				str_replace ( // Split encoded lines
					['","','["','"]'],
					['<br/>- ', '<br/>- ', ''],
					preg_replace ( // Décode unicode if such returned by extensions
						'/\\\\u([a-e0-9]{4})/',
						'&#x$1;',
						$row['ext_error'],
					),
				);

		// Construction de la première ligne
		$colonnes_html = [];

		if (isset ($row['ext_error']))
			$colonnes_html[] = 'REJET '.$row['mode'];
		else {
			if (strpos ($row['uri'], 'point_modification')) {
				if (isset ($row['point_id']))
					$colonnes_html[] = 'création d\'un '.
						'<a href="'.$config_wri['sous_dossier_installation'].
						'point/'.$row['point_id'].
					'">point</a>';
				elseif (isset ($row['post_id']))
					$colonnes_html[] = 'création d\'un point et de son '.
						'<a href="'.$config_wri['sous_dossier_installation'].
						'forum/viewtopic.php?p='.$row['post_id']
					.'">forum</a>';
			}
			elseif (strpos ($row['uri'], 'ajout_commentaire')) {
				if (isset ($row['point_id']))
					$colonnes_html[] = 'création d\'un '.
						'<a href="'.$config_wri['sous_dossier_installation'].
						'point/'.$row['point_id'].'#C'.$row['commentaire_id'].
					'">commentaire</a>';
			}
			elseif (strpos ($row['uri'], 'mode=register')) {
				if (isset ($row['user_id']))
					$colonnes_html[] = 'création du compte '.
						'<a href="'.$config_wri['sous_dossier_installation'].
						'forum/memberlist.php?mode=viewprofile&u='.$row['user_id'].
					'">'.@$row['user_name'].'</a>';
				else
					$colonnes_html[] = 'création d\'un compte';
			}
			elseif (strpos ($row['uri'], 'reply')) {
				if (isset ($row['post_id']))
					$colonnes_html[] = 'réponse au '.
						'<a href="'.$config_wri['sous_dossier_installation'].
						'forum/viewtopic.php?p='.$row['post_id'].'#p'.$row['post_id'].
					'">post</a>';
			}
			elseif (strpos ($row['uri'], 'trace')) {
				if (isset ($row['post_id']))
					$colonnes_html[] = 'trace '.
						'<a href="'.$config_wri['sous_dossier_installation'].
						'forum/viewtopic.php?p='.$row['post_id'].'#p'.$row['post_id'].
					'">post</a>';
			}
			elseif (isset ($row['post_id']))
				$colonnes_html[] = 'création d\'un '.
					'<a href="'.$config_wri['sous_dossier_installation'].
					'forum/viewtopic.php?p='.$row['post_id'].
				'">post</a>';
		}

		if (!strpos ($row['uri'], 'mode=register') &&
			$row['user_id'] > 1)
				$colonnes_html[] = 'par '.
					'<a href="'.$config_wri['sous_dossier_installation'].
					'forum/memberlist.php?mode=viewprofile&u='.$row['user_id'].
				'">'.@$row['user_name'].'</a>';

		$colonnes_html[count ($colonnes_html) - 1] .= '. ';

		if (!$this->get['trace_id']) {
			$colonnes_html[] =
				'<sup><a href="'.$config_wri['sous_dossier_installation'].
				'gestion/historique_traces?trace_id='.$row['trace_id'].
				'">'.$row['trace_id'].'</a></sup>';
		}

		// Construction des lignes du rapport
		$lignes_html = [
			'<div class="detail_traces">',
		];
		if (count ($colonnes_html))
			$lignes_html[] = '<p>'. ucfirst (implode (' ', $colonnes_html)) .'</p>';

		if (isset ($row['ip']))
			$lignes_html[] =
				'<p>Localisation <a href="https://whatismyipaddress.com/ip/'.
					$row['ip'].'">'.$row['ip'].'</a></p>'.
				'<p>IPinfo <a href="https://ipinfo.io/'.
					$row['ip'].'">'.$row['ip'].'</a></p>'.
				'<p>CleanTalk <a href="https://cleantalk.org/blacklists/'.
					$row['ip'].'">'.$row['ip'].'</a></p>'.
				'<p>StopForumSpam <a href="https://stopforumspam.com/ipcheck/'.
					$row['ip'].'">'.$row['ip'].'</a></p>'.
				'<p>SpamCop <a href="https://www.spamcop.net/w3m?action=checkblock&ip='.
					$row['ip'].'">'.$row['ip'].'</a></p>'.
				'<p>AbuseIPdb <a href="https://www.abuseipdb.com/check/'.
					$row['ip'].'">'.$row['ip'].'</a></p>';

		if (isset ($row['user_email']))
			$lignes_html[] =
				'<p>CleanTalk <a href="https://cleantalk.org/email-checker/'.
					$row['user_email'].'"></a></p>';

		$colonnes_traces = [
			'date' => 'date',
			//'mode' => 'mode',
			'type d\'opérateur' => 'browser_operator',
			'PhpBB listener' => 'listener',
			'cause rejet' => 'display_error',
			'url' => 'uri',
			'IP' => 'ip',
			'opérateur / host' => 'host',
			'agent' => 'user_agent',
			'languages supportés' => 'language',
			'topic_id' => 'topic_id',
			'post_id' => 'post_id',
			'point_id' => 'point_id',
			'commentaire_id' => 'commentaire_id',
			'Titre' => 'title',
			'texte' => 'text',
			'id user' => 'user_id',
			'nom user' => 'user_name',
		];
		if ($row['user_email'])
			$colonnes_traces = array_merge ($colonnes_traces, [
				'email user' => 'user_email',
				'language user' => 'user_lang',
				'IP enregistrement' => 'ip_enregistrement',
			]);

		foreach ($colonnes_traces as $title => $k)
			if (isset ($row[$k])) {
				$r = str_replace ("\n", " ", $row[$k]);
				$r = preg_replace ("/\s\s+/", " ", $r);
				$r = trim (strip_tags ($r, '<br>'));
				if ($k == 'text')
					$r = substr ($r, 0, 80).(strlen ($r) > 80 ? '&hellip;' : '');
				$t = ucfirst ($title);
				$lignes_html[] = "<p>$t: $r</p>";
			}
		$lignes_html[] = '</div>';

		return implode (PHP_EOL, $lignes_html);
	}
}
