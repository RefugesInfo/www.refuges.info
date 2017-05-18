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

	// Inclusion du bandeau
	function page_footer () {
		global $template, $request;
		$request->enable_super_globals();

		// Calcule la date du fichier style pour la mettre en paramètre pour pouvoir l'uploader quand il évolue
		$template->assign_var('STYLE_CSS_TIME', filemtime(__DIR__.'/../../../../../vues/style.css.php'));

		// Les fichiers template du bandeau et du pied de page étant au format "MVC+template type refuges.info",
		// on les évalue dans leur contexte PHP et on introduit le code HTML résultant dans des variables des templates de PhpBB V3.2
		$url_vue = 'http://'.$_SERVER['SERVER_NAME'].preg_replace('/forum.*/i','',$_SERVER['REQUEST_URI']).'vue/';

		$template->assign_var('BANDEAU', file_get_contents(
			$url_vue.'_bandeau',
			false,
			stream_context_create( ['http' => [
				// On envoie les mêmes cookies pour avoir le bandeau correspondant à l'utilisateur
				'header' =>'Cookie: '.http_build_query($_COOKIE, null, ';'),
			]])
		));

		$template->assign_var('PIED', file_get_contents($url_vue.'_pied'));
	}
}
