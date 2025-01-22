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
			'core.ucp_register_register_after' => 'ucp_register_register_after', // ucp_register.php 562
			'core.ucp_register_modify_template_data' => 'ucp_register_modify_template_data', // ucp_register.php 682
			// Log le contexte d'une soumission de post acceptée
			'core.submit_post_end' => 'log_request_context', // functions_posting.php 2634
			'core.posting_modify_template_vars' => 'posting_modify_template_vars', // posting.php 2089
			'wri.point_ajout_commentaire' => 'log_request_context',
			'wri.list_traces' => 'list_traces',
			'core.mcp_post_additional_options' => 'mcp_additional_options', // mcp_post.php 125
			'core.memberlist_modify_view_profile_template_vars' => 'mcp_additional_options', // memberlist.php 818
		];
	}

	// Log le contexte d'une création de user acceptée
	function ucp_register_register_after($vars) {
		$vars['mode'] = 'Création compte';

		$this->log_request_context ($vars);
	}

	// Log le contexte d'une création de user rejetée
	function ucp_register_modify_template_data($vars) {
		$vars['mode'] = 'Rejeté';
		$vars['user_row'] = $this->post;

		if (isset ($this->post['new_password'])) // Except when load registration page
			$this->log_request_context ($vars);
	}

	// Log le contexte d'une soumission de post rejeté
	function posting_modify_template_vars($vars) {
		/*
		$vars['mode'] = 'Rejeté';

		if (count ($this->post) && // Except when load post page
			isset ($vars['error']['POST_REJECTED'])) // Exclude CleanTalk
			$this->log_request_context ($vars);
		*/
	}

	// Log le contexte d'une soumission de post ou d'une création d'user
	function log_request_context($vars) {
		global $user, $auth, $db, $config_wri;

		if (!$auth->acl_get('m_')) { // Sauf pour les modérateurs
			$post_data = @$vars['data'] ?: @$vars['post_data'];
			$user_data = @$vars['user_row'] ?: $user->data;

			$log = [
				// General
				'mode' => ucfirst ($vars['mode']),

				// Server
				'uri' => @$this->server['REQUEST_SCHEME'].'://'.
					@$this->server['HTTP_HOST'].
					@$this->server['REQUEST_URI'],
				'ip' => @$this->server['REMOTE_ADDR'],
				'host' => $this->gethost(@$this->server['REMOTE_ADDR']),
				'user_agent' => @$this->server['HTTP_USER_AGENT'],
				'language' => @$this->server['HTTP_ACCEPT_LANGUAGE'],

				// Navigateur
				'browser_operator' => $this->post['browser_operator'] ?: 'server bot',
				'sid' => @$user->session_id,
				'date' => date('r'),

				// Post & Point
				'topic_id' => $post_data['topic_id'] ?: $this->post['topic_id'],
				'post_id' => $post_data['post_id'] ?: $this->post['post_id'],
				'title' => @$vars['subject'] ?: @$post_data['topic_title'] ?: @$vars['point']->nom,
				'text' => $this->post['message'] ?: @$vars['commentaire']->texte,
				'point_id' => @$vars['point']->id_point,
				'commentaire_id' => @$vars['commentaire']->id_commentaire,

				// Infos enregistrées à la création du user
				'user_id' => @$user_data['user_id'] ?: @$vars['user_id'],
				'user_name' => $this->post['username'] ?: $this->post['nom_createur'] ?: @$user_data['username'],
				'user_email' => @$user_data['user_email'] ?: @$user_data['email'],
				'user_signature' => str_replace ('<t></t>', '', @$user_data['user_sig']),
				'user_posts' => @$user_data['user_posts'],
				'user_lang' => @$user_data['user_lang'] ?: @$user_data['lang'],
				'user_timezone' => @$user_data['user_timezone'] ?: @$user_data['tz'],
				'ip_enregistrement' => @$user_data['user_ip'],
				'host_enregistrement' => $this->gethost (@$user_data['user_ip']),
			];

			$sql = 'INSERT INTO trace_requettes '. $db->sql_build_array ('INSERT', array_filter($log));
			$db->sql_query($sql);
		}
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
				'type d\'operateur' => 'browser_operator',
				'date' => 'date',
				'url' => 'uri',
				'IP' => 'ip',
				'host' => 'host',
				'agent' => 'user_agent',
				'languages supportés' => 'language',
				'topic_id' => 'topic_id',
				'post_id' => 'post_id',
				'point_id' => 'point_id',
				'commentaire_id' => 'commentaire_id',
				'Titre' => 'title',
				'texte' => 'text',
				'nom user' => 'user_name',
				'id user' => 'user_id',
			];
			$colonnes_traces_user = [
				'email user' => 'user_email',
				'language user' => 'user_lang',
				'IP enregistrement' => 'ip_enregistrement',
			];
			$lignes_traces_html = [];

			$sql = 'SELECT * FROM trace_requettes'.
				$vars['where'].
				' ORDER BY trace_id DESC'.
				' LIMIT 50';
			$result = $db->sql_query ($sql);

			while ($row = $db->sql_fetchrow($result)) {
				if (isset ($row['topic_title']))
					$row['titre'] = $row['topic_title'];

				$colonnes_html = [
					'<div class="detail_traces">',
				];
				$colonnes_traces = array_merge (
					$colonnes_traces_post,
					$row['user_email'] ? $colonnes_traces_user : []
				);

				if (isset ($vars['type_trace'])) {
					if (strpos ($row['uri'], 'point_modification')) {
						if (isset ($row['point_id']))
							$colonnes_html[] = '<p>Création du '.
								'<a href="'.$config_wri['sous_dossier_installation'].
								'point/'.$row['point_id'].
								'">point</a></p>';
						elseif (isset ($row['post_id']))
							$colonnes_html[] = '<p>Création du '.
								'<a href="'.$config_wri['sous_dossier_installation'].
								'forum/viewtopic.php?p='.$row['post_id']
								.'">point</a></p>';
					}
					elseif (strpos ($row['uri'], 'ajout_commentaire')) {
						if (isset ($row['point_id']))
							$colonnes_html[] = '<p>Création du '.
								'<a href="'.$config_wri['sous_dossier_installation'].
								'point/'.$row['point_id'].'#C'.$row['commentaire_id'].
								'">commentaire</a></p>';
					}
					elseif (strpos ($row['uri'], 'mode=register')) {
						if (isset ($row['user_id']))
							$colonnes_html[] = '<p>Création du compte '.
								'<a href="'.$config_wri['sous_dossier_installation'].
								'forum/memberlist.php?mode=viewprofile&u='.$row['user_id'].
								'">'.@$row['user_name'].'</a></p>';
						else
							$colonnes_html[] = '<p>Création du compte</p>';
					}
					elseif (strpos ($row['uri'], 'reply')) {
						if (isset ($row['post_id']))
							$colonnes_html[] = '<p>Réponse au '.
								'<a href="'.$config_wri['sous_dossier_installation'].
								'forum/viewtopic.php?p='.$row['post_id'].'#p'.$row['post_id'].
								'">post</a></p>';
					}
					elseif (isset ($row['post_id']))
						$colonnes_html[] = '<p>Création du '.
							'<a href="'.$config_wri['sous_dossier_installation'].
							'forum/viewtopic.php?p='.$row['post_id'].
							'">post</a></p>';

					if (!strpos ($row['uri'], 'mode=register') &&
						@$row['user_id'] > 1)
							$colonnes_html[] = '<p>Par '.
								'<a href="'.$config_wri['sous_dossier_installation'].
								'forum/memberlist.php?mode=viewprofile&u='.$row['user_id'].
								'">'.@$row['user_name'].'</a></p>';
				}

				if (isset ($row['ip']))
					$colonnes_html[] =
						'<p><a href="https://whatismyipaddress.com/ip/'.$row['ip'].
						'">Localisation de l\'IP</a></p>'.
						'<p><a href="https://cleantalk.org/blacklists/'.$row['ip'].
						'">Vérification CleanTalk de l\'IP</a></p>'.
						'<p><a href="https://stopforumspam.com/ipcheck/'.$row['ip'].
						'">Vérification StopForumSpam de l\'IP</a></p>'.
						'<p><a href="https://www.spamcop.net/w3m?action=checkblock&ip='.$row['ip'].
						'">Vérification SpamCop de l\'IP</a></p>';
				if (isset ($row['user_email']))
					$colonnes_html[] =
						'<p><a href="https://cleantalk.org/email-checker/'.$row['user_email'].
						'">Vérification CleanTalk du mail</a></p>';

				foreach ($colonnes_traces as $title => $k)
					if (isset ($row[$k])) {
						$r = str_replace ("\n", " ", $row[$k]);
						$r = preg_replace ("/\s\s+/", " ", $r);
						$r = trim (strip_tags ($r));
						if ($k == 'text')
							$r = substr ($r, 0, 80).(strlen ($r) > 80 ? '&hellip;' : '');
						$t = ucfirst ($title);
						$colonnes_html[] = "<p>$t: $r</p>";
					}
				$colonnes_html[] = '</div>';

				$lignes_traces_html[] = implode (PHP_EOL, $colonnes_html);
			}
			$db->sql_freeresult($result);

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
