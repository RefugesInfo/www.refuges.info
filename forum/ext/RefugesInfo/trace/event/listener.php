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
			// Log le contexte d'une création de user acceptée
			'core.ucp_register_register_after' => 'log_request_context', // ucp_register.php 562
			// Log le contexte d'une création de user rejetée
			'core.ucp_register_modify_template_data' => 'ucp_register_modify_template_data', // ucp_register.php 682
			// Log le contexte d'une soumission de post rejeté
			'core.posting_modify_template_vars' => 'log_request_context', // posting.php 2089
			// Log le contexte d'une soumission de point ou de post acceptée
			//TODO manque le point_id
			'core.submit_post_end' => 'log_request_context', // functions_posting.php 2634
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

	function ucp_register_modify_template_data($vars, $eventName) {
		$vars['user_row'] = $this->post;

		if (isset ($this->post['new_password'])) // Except when load registration page
			$this->log_request_context ($vars, $eventName);
	}

	// Log le contexte d'une soumission de post ou d'une création d'user
	function log_request_context($vars, $eventName) {
		global $user, $auth, $db, $config_wri;

		if (count ($this->post) && // Except when load a post page
			!$auth->acl_get('m_')) // Sauf pour les modérateurs
		{
			$post_data = $vars['data'] ?: $vars['post_data'];
			$user_data = $vars['user_row'] ?: $user->data;

			if (strpos($eventName, 'register') !== false)
				$vars['mode'] = 'création compte';

			$log = [
				// General
				'mode' => ucfirst ($vars['mode']),
				'ext_error' => isset ($vars['error']) ?
					str_replace ('core.', '', $eventName) .' : '.
						json_encode(array_values (array_filter ($vars['error']))) :
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

			$sql = 'INSERT INTO trace_requettes '. $db->sql_build_array ('INSERT', array_filter($log));
			$db->sql_query($sql);
		}
	}

	function gethost ($ip) {
		if (substr_count($ip, '.') === 3)
			return gethostbyaddr($ip);
		return null;
	}

	function mcp_additional_options ($vars, $eventName) {
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
	function list_traces($vars, $eventName) {
		global $db, $auth;

		if ($auth->acl_get('m_')) {
			$lignes_traces_html = [];

			$sql = 'SELECT * FROM trace_requettes'.
				$vars['where'].
				' ORDER BY trace_id DESC'.
				' LIMIT 250';
			$result = $db->sql_query ($sql);
			while ($row = $db->sql_fetchrow($result))
				$lignes_traces_html[] = $this->affiche_trace($row);
			$db->sql_freeresult($result);


			if (!count ($lignes_traces_html) && $vars['ip'])
				$lignes_traces_html[] = $this->affiche_trace (['ip' => $vars['ip']]);

			$vars['traces_html'] =  implode (PHP_EOL.'<hr/>'.PHP_EOL, $lignes_traces_html);
			return $vars['traces_html'];
		}
	}

	// Affichage des traces
	function affiche_trace($row) {
		global $config_wri, $controlleur;

		$row = array_filter($row);

		if (isset ($row['topic_title']))
			$row['titre'] = $row['topic_title'];

		if (isset ($row['ext_error']))
			$row['display_error'] =
				str_replace ( // Split encoded lines
					['","','["','"]'],
					['<br/>- ', '<br/>- ', ''],
					preg_replace ( // Décode unicode
						'/\\\\u([a-e0-9]{4})/',
						'&#x$1;',
						$row['ext_error'],
					),
				);

		$colonnes_html = [
			'<div class="detail_traces">',
		];

		if (!count ($this->get) && // Si listage historique
			!isset ($row['ext_error'])) // Uniquement si acceptée
		{
			if (strpos ($row['uri'], 'point_modification')) {
				if (isset ($row['point_id']))
					$colonnes_html[] = '<p>Création du '.
						'<a href="'.$config_wri['sous_dossier_installation'].
						'point/'.$row['point_id'].
					'">point</a></p>';
				elseif (isset ($row['post_id']))
					$colonnes_html[] = '<p>Création d\'un point et de son '.
						'<a href="'.$config_wri['sous_dossier_installation'].
						'forum/viewtopic.php?p='.$row['post_id']
					.'">forum</a></p>';
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
			elseif (strpos ($row['uri'], 'detail')) {
				if (isset ($row['post_id']))
					$colonnes_html[] = '<p>Trace '.
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
		elseif (!$controlleur->url_decoupee[3])
			$colonnes_html[] = '<p>Refusé => '.
				'<a href="'.$config_wri['sous_dossier_installation'].
				'gestion/historique_traces/detail/'.$row['trace_id'].
				'">lien vers la trace</a></p>';

		if (isset ($row['ip']))
			$colonnes_html[] =
				'<p><a href="https://whatismyipaddress.com/ip/'.$row['ip'].
					'">Localisation de l\'IP '.$row['ip'].'</a></p>'.
				'<p><a href="https://cleantalk.org/blacklists/'.$row['ip'].
					'">Vérification CleanTalk de l\'IP '.$row['ip'].'</a></p>'.
				'<p><a href="https://stopforumspam.com/ipcheck/'.$row['ip'].
					'">Vérification StopForumSpam de l\'IP '.$row['ip'].'</a></p>'.
				'<p><a href="https://www.spamcop.net/w3m?action=checkblock&ip='.$row['ip'].
					'">Vérification SpamCop de l\'IP '.$row['ip'].'</a></p>';

		if (isset ($row['user_email']))
			$colonnes_html[] =
				'<p><a href="https://cleantalk.org/email-checker/'.$row['user_email'].
					'">Vérification CleanTalk du mail</a></p>';

		$colonnes_traces = [
			'date' => 'date',
			'mode' => 'mode',
			'type d\'operateur' => 'browser_operator',
			'rejet' => 'display_error',
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
				$colonnes_html[] = "<p>$t: $r</p>";
			}
		$colonnes_html[] = '</div>';

		return implode (PHP_EOL, $colonnes_html);
	}
}
