<?php
// Ce fichier centralise les fonctions PHP liées à l'enregistrement des traces des posts et enregistrements
// Attention: Le code suivant s'exécute dans un "namespace" bien défini

namespace RefugesInfo\trace\event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

if (!defined('IN_PHPBB')) exit;

class listener implements EventSubscriberInterface
{
	// List of externals
	public function __construct(
	) {
		global $request;
		$this->server = $request->get_super_global(\phpbb\request\request_interface::SERVER);
		$this->get = $request->get_super_global(\phpbb\request\request_interface::GET);
		$this->post = $request->get_super_global(\phpbb\request\request_interface::POST);
	}

	static public function getSubscribedEvents () {
		return [
			'core.posting_modify_submission_errors' => 'posting_modify_submission_errors',
			'core.submit_post_end' => 'log_request_context',
			'core.ucp_register_register_after' => 'log_request_context',
			'wri.point_ajout_commentaire' => 'log_request_context',
			'wri.list_traces' => 'list_traces',
			'core.mcp_post_additional_options' => 'mcp_additional_options',
			'core.memberlist_modify_view_profile_template_vars' => 'mcp_additional_options',
		];
	}

	// Bloque les posters qui n'ont pas javascript
	function posting_modify_submission_errors($vars) {
		global $user, $config_wri;
		$error = $vars['error'];

		if ($config_wri['blockBotPosts'] &&
			$this->post['browser_operator'] != 'human'
		) {
			$error['POST_REJECTED'] = 'Your message has been rejected for security reasons.';
			$this->log_request_context ([
				'mode' => 'Rejeté',
				'data' => $vars['post_data'],
			]);
		}

		$vars['error'] = $error;
	}

	// Log le contexte d'une soumission de post ou d'une création d'user
	function log_request_context($vars) {
		global $user, $auth, $db, $config_wri;
		date_default_timezone_set ('Europe/Paris');

		// Sauf pour les modérateurs
		if (!$config_wri['traceModoPosts'] && // Debug (ne pas utiliser ce flag en prod)
			$auth->acl_get('m_'))
			return;

		$mode = $vars['mode'] ?: 'Création compte';
		if (@$this->post['nom'])
			$mode = 'Création point';

		$user_data = $vars['user_row'] ?: $user->data;
		$log = [ // General
			'mode' => $mode,

			// Server
			'uri' => @$this->server['REQUEST_SCHEME'].'://'.
				@$this->server['HTTP_HOST'].
				@$this->server['REQUEST_URI'],
			'ip' => @$this->server['REMOTE_ADDR'],
			'host' => $this->gethost($this->server['REMOTE_ADDR']),
			'user_agent' => @$this->server['HTTP_USER_AGENT'],
			'language' => @$this->server['HTTP_ACCEPT_LANGUAGE'],

			// Navigateur
			'browser_locale' => @$this->post['browser_locale'],
			'browser_timezone' => @$this->post['browser_timeZone'],
			'browser_operator' => @$this->post['browser_operator'],
			'sid' => @$user->session_id,
			'date' => date('r'),

			// Post & point
			'topic_id' => @$vars['data']['topic_id'],
			'post_id' => @$vars['data']['post_id'],
			'point_id' => @$vars['point']->id_point,

			'commentaire_id' => @$vars['commentaire']->id_commentaire,
			'topic_title' => @$vars['data']['topic_title'],
			'title' => @$vars['subject'] ?: @$vars['point']->nom,
			'text' => @$this->post['message'] ?: @$vars['commentaire']->texte,

			// Infos enregistrées à la création du user
			'user_id' => @$user_data['user_id'] ?: $vars['user_id'],
			'user_name' => @$user_data['username'],
			'user_email' => @$user_data['user_email'],
			'user_signature' => str_replace ('<t></t>', '', @$user_data['user_sig']),
			'user_posts' => @$user_data['user_posts'],
			'user_lang' => @$user_data['user_lang'],
			'user_timezone' => @$user_data['user_timezone'],
			'ip_enregistrement' => @$user_data['user_ip'],
			'host_enregistrement' => $this->gethost (@$user_data['user_ip']),
		];

		$sql = 'INSERT INTO trace_requettes '. $db->sql_build_array ('INSERT', array_filter($log));
		$db->sql_query($sql);
	}

	function gethost ($ip) {
		if (substr_count($ip, '.') === 3)
			return gethostbyaddr($ip);
		return null;
	}

	// Prépare l'affichage des traces
	function list_traces($vars) {
		global $db, $auth, $config_wri;

		if ($auth->acl_get('m_')) {
			$colonnes_traces_post = [
				'date' => 'date',
				'type' => 'mode',
				'url' => 'uri',
				'IP' => 'ip',
				'host' => 'host',
				'operator' => 'browser_operator',
				'agent' => 'user_agent',
				'languages supportés' => 'language',
				'langage demandé' => 'browser_locale',
				'timezone' => 'browser_timezone',
				'topic_id' => 'topic_id',
				'post_id' => 'post_id',
				'point_id' => 'point_id',
				'commentaire_id' => 'commentaire_id',
				'nom' => 'title',
				'titre' => 'topic_title',
				'texte' => 'text',
			];
			$colonnes_traces_user = [
				'id user' => 'user_id',
				'nom user' => 'user_name',
				'email user' => 'user_email',
				'language user' => 'user_lang',
				'timezone user' => 'user_timezone',
				'IP enregistrement' => 'ip_enregistrement',
			];
			$lignes_traces_html = [];

			$sql = 'SELECT * FROM trace_requettes'.
				$vars['where'].
				' ORDER BY trace_id DESC'.
				' LIMIT 50';
			$result = $db->sql_query ($sql);
			while ($row = $db->sql_fetchrow($result)) {
				$colonnes_html = [];
				$colonnes_traces = array_merge ($colonnes_traces_post, $row['user_id'] > 1 ? $colonnes_traces_user : []);

				if ($row['point_id'])
					$colonnes_html[] = '<div><a href="'.$config_wri['sous_dossier_installation'].
						'point/'.$row['point_id'].'#C'.@$row['commentaire_id'].'">Voir le point</a></div>';
				if ($row['post_id'])
					$colonnes_html[] = '<div><a href="'.$config_wri['sous_dossier_installation'].
						'forum/viewtopic.php?p='.$row['post_id'].'">Voir le post</a></div>';

				foreach ($colonnes_traces as $title => $k)
					if ($row[$k]) {
						$r = str_replace ("\n", " ", $row[$k]);
						$r = preg_replace ("/\s\s+/", " ", $r);
						$r = trim (strip_tags ($r));
						if ($k == 'text')
							$r = ucfirst (substr ($r, 0, 80)).(strlen ($r) > 80 ? '&hellip;' : '');
						$t = ucfirst ($title);
						$colonnes_html[] = "<div>$t: $r</div>";
				}
				if ($row['user_email'])
					$colonnes_html[] =
						'<div><a href="https://cleantalk.org/email-checker/'.$row['user_email'].
						'">Vérification CleanTalk du mail</a></div>';
				if ($row['ip'])
					$colonnes_html[] =
						'<div><a href="https://cleantalk.org/blacklists/'.$row['ip'].
						'">Vérification CleanTalk de l\'IP</a></div>'.
						'<div><a href="https://stopforumspam.com/ipcheck/'.$row['ip'].
						'">Vérification StopForumSpam de l\'IP</a></div>'.
						'<div><a href="https://whatismyipaddress.com/ip/'.$row['ip'].
						'">Localisation de l\'IP</a></div>';

				$lignes_traces_html[] = implode (PHP_EOL, $colonnes_html);
			}
			$result = $db->sql_query($sql);
			$vars['traces_html'] =  implode (PHP_EOL.'<hr/>'.PHP_EOL, $lignes_traces_html);
			return $vars['traces_html'];
		}
	}

	// Traces dans le panneau de modération d'un post et d'un user
	function mcp_additional_options () {
		global $template, $phpbb_dispatcher;

		$vars = [
			'where' => '',
		];
		if (isset ($this->get['p']))
			$vars['where'] = ' WHERE post_id = '. $this->get['p'];
		if (isset ($this->get['u']))
			$vars['where'] =
				' WHERE uri LIKE \'%register\''.
				' AND user_id = '.$this->get['u'];

		$template->assign_var('TRACES', $this->list_traces($vars));
	}
}
