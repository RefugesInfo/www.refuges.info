<?php
// Ce fichier centralise les "hooks" qui viennent modifier le comportement de PhpBB pour s'interfacer avec refuges.info
// Il s'exécute dans le contexte de PhpBB 3.1+ (plateforme Synphony)
// qui est incompatible avec le modèle MVC et autoload des classes PHP de refuges.info
// Attention: Le code suivant s'exécute dans un "namespace" bien défini

namespace RefugesInfo\couplage\event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

if (!defined('IN_PHPBB')) exit;

class listener implements EventSubscriberInterface
{
	// List of externals
	public function __construct(
	) {
		global $request;
		$this->server = $request->get_super_global(\phpbb\request\request_interface::SERVER);
	}

	static public function getSubscribedEvents () {
		return [
			'core.viewtopic_assign_template_vars_before' => 'viewtopic_assign_template_vars_before',
			'core.posting_modify_submission_errors' => 'posting_modify_submission_errors',
			'core.page_footer' => 'page_footer',
			'core.login_box_before' => 'login_box_before',
			'core.user_add_modify_data' => 'user_add_modify_data',
			'core.user_add_modify_notifications_data' => 'user_add_modify_notifications_data',
		];
	}

	// Récupération du numéro de la fiche liée à un topic du forum refuges
	function viewtopic_assign_template_vars_before ($vars) {
		global $db, $template;

		if ($vars['topic_data']['topic_id']) {
			$sql = "SELECT id_point FROM points WHERE topic_id = ".$vars['topic_data']['topic_id'];
			$result = $db->sql_query ($sql);
			$row = $db->sql_fetchrow ($result);
			$db->sql_freeresult($result);
			if ($row)
				$template->assign_var('ID_POINT', $row['id_point']);
		}
	}

	// Permet la saisie d'un POST avec un texte vide
	function posting_modify_submission_errors($vars) {
		global $user;
		$error = $vars['error'];

		foreach ($error AS $k=>$v)
			if ($v == $user->lang['TOO_FEW_CHARS'])
				unset ($error[$k]);

		$vars['error'] = $error;
	}

	function page_footer () {
		global $template, $request, $user, $language; // Contexte PhpBB
		$request->enable_super_globals(); // Pour avoir accés aux variables globales $_SERVER, ...

		/* Includes language files of this extension */
		$ns = explode ('\\', __NAMESPACE__);
		$language->add_lang('common', $ns[0].'/'.$ns[1]);

		// On traite le logout ici car la fonction de base demande un sid (on se demande pourquoi ?)
		if ($request->variable('mode', '') == 'logout') {
			$user->session_kill();
			header('Location: https://'.$this->server['HTTP_HOST'].$request->variable('redirect', '/'));
		}

		global $config_wri, $pdo; // Contexte WRI
		require_once (__DIR__.'/../../../../../includes/config.php');

		// Calcule la date du fichier style pour la mettre en paramètre pour pouvoir l'uploader quand il évolue
		$template->assign_var('STYLE_CSS_TIME', filemtime($config_wri['chemin_vues'].'style.css.php'));

		// Les fichiers template du bandeau et du pied de page étant au format "MVC+template type refuges.info",
		// on les évalue dans leur contexte PHP et on introduit le code HTML résultant
		// dans des variables des templates de PhpBB V3.2
		require_once ('identification.php');
		require_once ('bandeau_dynamique.php');
		require_once ('gestion_erreur.php');

		$vue = new \stdClass;
		$vue->type = '';
		$vue->java_lib_foot = [];

		// Pour le bandeau
		$vue->java_lib_foot [] = $config_wri['sous_dossier_installation'].'vues/_bandeau.js?'
			.filemtime($config_wri['chemin_vues'].'_bandeau.js');
		$vue->zones_pour_bandeau=remplissage_zones_bandeau(); // Menu des zones couvertes
		$vue->lien_wiki=prepare_lien_wiki_du_bandeau(); // Menu des pages d'aide
		$vue->types_point_affichables=types_point_affichables(); // Menu des types de points
        if (est_moderateur()) {
            $vue->demande_correction=info_demande_correction ();
            $vue->email_en_erreur=info_email_bounce ();
        }

		ob_start();
		include ($config_wri['chemin_vues'].'_bandeau.html');
		$template->assign_var('BANDEAU', ob_get_clean());

		ob_start();
		include ($config_wri['chemin_vues'].'_pied.html');
		$template->assign_var('PIED', ob_get_clean());
	}

	// Forçage https du login
	function login_box_before () {
		if (!isset($this->server['HTTPS']))
			header('Location: https://'.$this->server['HTTP_HOST'].$this->server['REQUEST_URI'], true, 301);
	}

	// Pour cocher par défaut l'option "m'avertir si une réponse" dans le cas d'un nouveau sujet ou d'une réponse
	function user_add_modify_data ($vars) {
		$sql_ary = $vars['sql_ary']; // On importe le tablo
		$sql_ary['user_notify'] = 1; // On défini la valeur par défaut (peut être changée ensuite par l'utilisateur s'il le souhaite)
		$vars['sql_ary'] = $sql_ary; // On exporte le tablo
	}

	// Pour activer par défaut les notifications par email dans le cas de message privé (sans quoi plein d'utilisateur n'y prètent pas attention
	function user_add_modify_notifications_data ($vars) {
		$notifications_data = $vars['notifications_data']; 
        $notifications_data = array(
            array(
                'item_type'	=> 'notification.type.pm',
                'method'	=> 'notification.method.email',              
            ),
			array(
				'item_type'	=> 'notification.type.post',
				'method'	=> 'notification.method.email',
			),
			array(
				'item_type'	=> 'notification.type.topic',
				'method'	=> 'notification.method.email',
			),
        );
		$vars['notifications_data'] = $notifications_data; 
	}
}
