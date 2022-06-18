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
	static public function getSubscribedEvents () {
		return [
			'core.viewtopic_assign_template_vars_before' => 'viewtopic_assign_template_vars_before',
			'core.posting_modify_submission_errors' => 'posting_modify_submission_errors',
			'core.page_footer' => 'page_footer',
			'core.login_box_before' => 'login_box_before',
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
		if ($request->variable('mode', '') == 'logout')
			$user->session_kill();

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
		$infos_identification=infos_identification();
		$vue = new \stdClass;
		$vue->type = '';
		$vue->java_lib_foot = [];
		$vue->zones_pour_bandeau=remplissage_zones_bandeau();
		$vue->lien_wiki=prepare_lien_wiki_du_bandeau();
        if (est_moderateur())
            $vue->demande_correction=info_demande_correction ();
		ob_start();
		include ($config_wri['chemin_vues'].'_bandeau.html');
		$template->assign_var('BANDEAU', ob_get_clean());

		ob_start();
		include ($config_wri['chemin_vues'].'_pied.html');
		$template->assign_var('PIED', ob_get_clean());
	}

	// Forçage https du login
	function login_box_before () {
		global $request;
		$server = $request->get_super_global(\phpbb\request\request_interface::SERVER);

		if (!isset($server['HTTPS']))
			header('Location: https://'.$server['HTTP_HOST'].$server['REQUEST_URI'], true, 301);
	}
}
