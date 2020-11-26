<?php
/**
*
* @package phpBB Extension - Antispam by CleanTalk
* @author Сleantalk team (welcome@cleantalk.org)
* @copyright (C) 2014 СleanTalk team (http://cleantalk.org)
* @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*
* Translated By : Papy [admin d'Instinct-Photo.fr] 
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_CLEANTALK_TITLE'			            => 'Antispam par CleanTalk',
	
	'ACP_CLEANTALK_SETTINGS'		            => 'Paramètres de protection anti-spam',
	'ACP_CLEANTALK_SETTINGS_SAVED'		        => 'Les paramètres de protection anti-spam ont été sauvegardés avec succès !',

	'ACP_CLEANTALK_REGS_LABEL'		            => 'Vérifier les enregistrements',
	'ACP_CLEANTALK_REGS_DESCR'		            => 'Les robots Spam seront rejetés avec un exposé des motifs.',

	'ACP_CLEANTALK_GUESTS_LABEL'		        => 'Modérer les invités',
	'ACP_CLEANTALK_GUESTS_DESCR'		        => 'Les messages et les sujets des invités seront testés pour le spam. Les spams seront rejetés ou envoyés à l\'approbation.',

	'ACP_CLEANTALK_NUSERS_LABEL'		        => 'Modérer les utilisateurs nouvellement enregistrés',
	'ACP_CLEANTALK_NUSERS_DESCR'		        => 'Les messages et les sujets des nouveaux utilisateurs seront testés pour le spam. Les spams seront rejetés ou envoyés à l\'approbation.',

	'ACP_CLEANTALK_CCF_LABEL'	           		=> 'Vérifier les formulaires de contact',
	'ACP_CLEANTALK_CCF_DESCR'	           		=> 'Activer le test anti-spam pour les formulaires de contact. Peut générer des conflits !',

	'ACP_CLEANTALK_SFW_LABEL'		       		=> 'SpamFireWall',
	'ACP_CLEANTALK_SFW_DESCR'		        	=> 'Activer SpamFireWall. Réduit la charge du serveur Web et empêche les robots d\'accéder au site Web.',

	'ACP_CLEANTALK_APIKEY_LABEL'		        => 'Clé d\'activation',
	'ACP_CLEANTALK_APIKEY_LABEL_PLACEHOLDER'    => 'Entrer la clé d\'activation',		
	'ACP_CLEANTALK_APIKEY_DESCR'		        => 'Pour obtenir une clé d\'activation, veuillez vous enregistrer sur le site ',
	'ACP_CLEANTALK_REG_NOTICE'                  => 'E-mail du forum',
	'ACP_CLEANTALK_REG_NOTICE2'                 => 'sera utilisé pour l\'enregistrement',
	'ACP_CLEANTALK_AGREEMENT'                   => 'Accord de licence',
	'ACP_CLEANTALK_APIKEY_IS_OK_LABEL'			=> 'La clé est valide',
	'ACP_CLEANTALK_APIKEY_IS_BAD_LABEL'			=> 'La clé n\'est pas valide',
	'ACP_CLEANTALK_APIKEY_GET_AUTO_BUTTON_LABEL'		=> 'Obtenir la clé d\'activation automatiquement',
	'ACP_CLEANTALK_APIKEY_GET_MANUALLY_BUTTON_LABEL'	=> 'Obtenir la clé d\'activation manuellement',
	'ACP_CLEANTALK_APIKEY_CP_LINK_BUTTON'		=> 'Cliquez ici pour obtenir des statistiques anti-spam',
	'ACP_CLEANTALK_ACCOUNT_NAME_OB'				=> 'Le compte sur cleantalk.org est',
	'ACP_CLEANTALK_CHECKUSERS_TITLE'			=> 'Vérifier si les utilisateurs reçoivent des spams',
	'ACP_CLEANTALK_CHECKUSERS_DESCRIPTION'		=> 'Anti-spam par CleanTalk vérifiera tous les utilisateurs dans la base de données des listes noires et vous montrera les expéditeurs qui ont une activité de spam sur d\'autres sites Web. Cliquez simplement sur `Vérifier les utilisateurs pour le spam` pour commencer.',
	'ACP_CLEANTALK_CHECKUSERS_PAGES_TITLE'      => 'Pages:',	
	'ACP_CLEANTALK_CHECKUSERS_BUTTON'			=> 'Vérifier les utilisateurs pour le spam',
	'ACP_CLEANTALK_CHECKUSERS_NUMBER_DESCRIPTION'=> 'Nombre d\'utilisateurs non contrôlés à vérifier. Laissez le champ vide pour réinitialiser les indicateurs et lancer un balayage complet.',
	'ACP_CHECKUSERS_DONE_2'                     => 'C\'est fait. Tous les utilisateurs ont été testés via la base de données des listes noires, 0 utilisateur de spam trouvé.',
	'ACP_CHECKUSERS_DONE_3'						=> 'Erreur. Pas de connexion avec la base de données de la liste noire.',
	'ACP_CHECKUSERS_USERNAME'                   => 'Nom d\'utilisateur',
	'ACP_CHECKUSERS_MESSAGES'                   => 'Messages',
	'ACP_CHECKUSERS_JOINED'                     => 'Ajoutés',
	'ACP_CHECKUSERS_EMAIL'                      => 'Email',
	'ACP_CHECKUSERS_IP'                         => 'IP',
	'ACP_CHECKUSERS_LASTVISIT'                  => 'Dernière visite',
	'ACP_CHECKUSERS_DELETEALL'                  => 'Supprimer tout',
	'ACP_CHECKUSERS_DELETEALL_DESCR'            => 'Tous les messages des utilisateurs supprimés seront également supprimés.',
	'ACP_CHECKUSERS_DELETESEL'                  => 'Supprimer la sélection',
	'ACP_CLEANTALK_MODERATE_IP'					=> 'Le service anti-spam est payé par votre hébergeur. Licence N°',
	'SFW_DIE_NOTICE_IP'                         => 'SpamFireWall est activé pour votre IP ',
	'SFW_DIE_MAKE_SURE_JS_ENABLED'              => 'Pour continuer à travailler avec le site Web, veuillez vous assurer que vous avez activé JavaScript.',
	'SFW_DIE_CLICK_TO_PASS'                     => 'Veuillez cliquer ci-dessous pour passer la protection,',
	'SFW_DIE_YOU_WILL_BE_REDIRECTED'            => 'Ou vous serez automatiquement redirigé vers la page demandée après 3 secondes.',
	
	'CLEANTALK_ERROR_MAIL'		                => 'Erreur lors de la connexion au service CleanTalk',
	'CLEANTALK_ERROR_LOG'		                => '<strong>Erreur lors de la connexion au service CleanTalk</strong><br />%s',
	'CLEANTALK_ERROR_CURL'		                => 'Erreur CURL : `%s`',
	'CLEANTALK_ERROR_NO_CURL'		            => 'Aucun support CURL compilé dans',
	'CLEANTALK_ERROR_ADDON'		                => ' ou désactivé allow_url_fopen dans php.ini.',
	'CLEANTALK_NOTIFICATION'					=> 'Etes vous sûr ?',
));
