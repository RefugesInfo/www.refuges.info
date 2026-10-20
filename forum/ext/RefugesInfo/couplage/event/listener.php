<?php
// Ce fichier centralise les "hooks" qui viennent modifier le comportement de PhpBB pour s'interfacer avec refuges.info
// Il s'exécute dans le contexte de PhpBB 3.1+ (plateforme Synphony)
// qui est incompatible avec le modèle MVC et autoload des classes PHP de refuges.info
// Attention: Le code suivant s'exécute dans un "namespace" bien défini

namespace RefugesInfo\couplage\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class listener implements EventSubscriberInterface
{
  // Code de langue du site (url, cookie) => nom du pack de langue phpBB, quand il est différent (le pack espagnol est es_x_tu).
  // Le dossier language/<pack phpBB> de l'extension porte aussi ce nom.
  const LANGUES_PHPBB = ['es' => 'es_x_tu'];

  public function __construct() {
    global $__time_start;

    $__time_start = microtime(true); // Stats du forum
  }

  static public function getSubscribedEvents() {
    return [
      'core.viewtopic_assign_template_vars_before' => 'assign_template_vars_before',
      'core.posting_modify_template_vars' => 'assign_template_vars_before',
      'core.page_footer' => 'page_footer', // includes/functions.php 4308
      'core.user_setup' => 'user_setup',
      'core.user_add_modify_data' => 'user_add_modify_data',
      'core.user_add_modify_notifications_data' => 'user_add_modify_notifications_data',
    ];
  }
  //BEST statistiques du membre : nombre & voir commentaires

  // Récupération du numéro de la fiche liée à un topic du forum refuges
  public function assign_template_vars_before($event) {
    global $db, $template, $point;

    if(isset($event['topic_id'])) {
      $sql = "SELECT id_point,id_point_type,conditions_utilisation FROM points WHERE topic_id = ".$event['topic_id'];
      $result = $db->sql_query($sql);
      $row = $db->sql_fetchrow($result);
      $db->sql_freeresult($result);
      if($row) {
        $template->assign_vars(array_change_key_case($row, CASE_UPPER));
        $point = true;
      }
    }
  }

  // Langue du forum : le choix fait dans le sélecteur du bandeau (cookie "langue" posé par vues/bandeau.js, commun au site
  // et au forum) l'emporte sur la langue du profil et sur la langue par défaut. Sans cookie, rien ne change.
  // Pas de langue dans l'url du forum : les robots (sans cookie) voient toujours la même version.
  public function user_setup($event) {
    global $request, $phpbb_root_path, $phpEx;

    // (config.php n'est chargé que dans page_footer : les langues possibles sont celles qui ont un dossier language/ dans l'extension)
    $choix = $request->variable('langue', '', false, \phpbb\request\request_interface::COOKIE);
    $pack = self::LANGUES_PHPBB[$choix] ?? $choix;
    if (preg_match('/^[a-z]{2}$/', $choix) && is_dir(__DIR__.'/../language/'.$pack) && file_exists($phpbb_root_path.'language/'.$pack."/common.$phpEx"))
      $event['user_lang_name'] = $pack;

    // Textes des templates de l'extension (language/<langue>/common.php)
    $lang_set_ext = $event['lang_set_ext'];
    $lang_set_ext[] = ['ext_name' => 'RefugesInfo/couplage', 'lang_set' => 'common'];
    $event['lang_set_ext'] = $lang_set_ext;
  }

  public function page_footer() {
    // Les fichiers template du bandeau et du pied de page étant au format "MVC+template type refuges.info",
    // on les évalue dans leur contexte PHP et on introduit le code HTML résultant
    // dans des variables des templates de PhpBB V3.2
    global $config_wri, $pdo, $__time_start, $request, $template, $user, $phpbb_dispatcher;

    // Pour avoir accés aux variables globales $_SERVER, ... dans config.php
    $request->enable_super_globals();

    // Pour exporter $config_wri & importer $pdo à l'intérieur d'une fonction
    require_once(__DIR__.'/../../../../../includes/config.php');
    require_once('bdd.php');
    require_once('gestion_erreur.php');

    // On traite le logout ici car la fonction de base demande un sid (on se demande pourquoi ?)
    if($request->variable('mode', '') == 'logout') {
      $user->session_kill();
      header('Location: https://'.$_SERVER['HTTP_HOST'].$request->variable('redirect', '/'));
    }

    // Les liens complets avec le jack de rechargement
    // pour qu'ils soient insérés aux bons endroits
    $template->assign_vars([
      'BANDEAU_CSS' => fichier_vue('bandeau.css', 'chemin_vues', true),
      'STYLE_CSS' => fichier_vue('style.css.php', 'chemin_vues', true),
      'STYLE_FORUM_CSS' => fichier_vue('style_forum.css', 'chemin_vues', true),
    ]);

    // Le bandeau et le pied de page sont dans la langue du forum (le routeur du site n'est pas passé par là) :
    // seules les langues de $config_wri['langues_url'] y ont un catalogue ; le sélecteur recharge la même page, le cookie "langue" (bandeau.js) fait le reste
    $code_site = array_flip(self::LANGUES_PHPBB)[$user->lang_name] ?? $user->lang_name;
    $langue = in_array($code_site, $config_wri['langues_url'], true) ? $code_site : 'fr';
    $config_wri['langue_courante'] = $langue;
    $config_wri['url_suffixe_langue'] = $langue == 'fr' ? '' : $langue.'/';
    if ($langue != 'fr')
      $config_wri['langue'] = $config_wri['locales_intl'][$langue] ?? 'en_GB'; // IntlDateFormatter
    setlocale(LC_MESSAGES, $config_wri['locales_systeme'][$langue]);
    bindtextdomain('refuges', $config_wri['chemin_locale']);
    bind_textdomain_codeset('refuges', 'UTF-8');
    textdomain('refuges');
    $config_wri['liens_langues'] = array_fill_keys(array_merge(['fr'], $config_wri['langues_url']), $_SERVER['REQUEST_URI']);

    // On recrée le contexte car on n'est pas dans le MVC de WRI
    $vue = new \stdClass;
    $vue->type = '';
    $vue->java_lib_foot = [];

    // On appelle le controleur du bandeau pour afficher le bloc
    include($config_wri['chemin_controlleurs']."bandeau.php");

    // Récupère le contenu des fichiers pour les affecter à des variables du template PhpBB
    // pour qu'ils soient insérés aux bons endroits
    ob_start();
    include(fichier_vue('bandeau.html'));
    $template->assign_var('BANDEAU', ob_get_clean());

    ob_start();
    include(fichier_vue('_pied.html'));
    $template->assign_var('PIED', ob_get_clean());
  }

  // Pour cocher par défaut l'option "m'avertir si une réponse" dans le cas d'un nouveau sujet ou d'une réponse
  public function user_add_modify_data($event) {
    $sql_ary = $event['sql_ary']; // On importe le tablo
    $sql_ary['user_notify'] = 1; // On défini la valeur par défaut (peut être changée ensuite par l'utilisateur s'il le souhaite)
    $event['sql_ary'] = $sql_ary; // On exporte le tablo
  }

  // Pour activer par défaut les notifications par email dans le cas de message privé (sans quoi plein d'utilisateur n'y prètent pas attention
  public function user_add_modify_notifications_data($event) {
    $event['notifications_data'] = [[
      'item_type'  => 'notification.type.pm',
      'method'  => 'notification.method.email',
    ],[
      'item_type'  => 'notification.type.post',
      'method'  => 'notification.method.email',
    ],[
      'item_type'  => 'notification.type.topic',
      'method'  => 'notification.method.email',
    ]];
  }
}
