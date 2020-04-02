<?php
/**
*
* This file is part of the french language pack for the phpBB Forum Software package.
* This file is translated by phpBB-fr.com <http://www.phpbb-fr.com>
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

/**
*	EXTENSION-DEVELOPERS PLEASE NOTE
*
*	You are able to put your permission sets into your extension.
*	The permissions logic should be added via the 'core.permissions' event.
*	You can easily add new permission categories, types and permissions, by
*	simply merging them into the respective arrays.
*	The respective language strings should be added into a language file, that
*	start with 'permissions_', so they are automatically loaded within the ACP.
*/

$lang = array_merge($lang, array(
	'ACL_CAT_ACTIONS'		=> 'Actions',
	'ACL_CAT_CONTENT'		=> 'Contenu',
	'ACL_CAT_FORUMS'		=> 'Forums',
	'ACL_CAT_MISC'			=> 'Divers',
	'ACL_CAT_PERMISSIONS'	=> 'Permissions',
	'ACL_CAT_PM'			=> 'Messages privés',
	'ACL_CAT_POLLS'			=> 'Sondages',
	'ACL_CAT_POST'			=> 'Message',
	'ACL_CAT_POST_ACTIONS'	=> 'Actions sur les messages',
	'ACL_CAT_POSTING'		=> 'Rédaction de message',
	'ACL_CAT_PROFILE'		=> 'Panneau de l’utilisateur',
	'ACL_CAT_SETTINGS'		=> 'Configuration',
	'ACL_CAT_TOPIC_ACTIONS'	=> 'Actions sur les sujets',
	'ACL_CAT_USER_GROUP'	=> 'Utilisateurs &amp; Groupes'
));

// User Permissions
$lang = array_merge($lang, array(
	'ACL_U_VIEWPROFILE'	=> 'Peut voir les profils, la liste des membres et la liste des utilisateurs connectés.',
	'ACL_U_CHGNAME'		=> 'Peut modifier son nom d’utilisateur.',
	'ACL_U_CHGPASSWD'	=> 'Peut modifier son mot de passe.',
	'ACL_U_CHGEMAIL'	=> 'Peut modifier son adresse courriel.',
	'ACL_U_CHGAVATAR'	=> 'Peut modifier son avatar.',
	'ACL_U_CHGGRP'		=> 'Peut modifier son groupe par défaut.',
	'ACL_U_CHGPROFILEINFO'	=> 'Peut modifier ses informations de profil.',

	'ACL_U_ATTACH'		=> 'Peut joindre des fichiers.',
	'ACL_U_DOWNLOAD'	=> 'Peut télécharger des fichiers.',
	'ACL_U_SAVEDRAFTS'	=> 'Peut enregistrer des brouillons.',
	'ACL_U_CHGCENSORS'	=> 'Peut désactiver la censure.',
	'ACL_U_SIG'			=> 'Peut utiliser une signature.',
	'ACL_U_EMOJI'		=> 'Peut utiliser des émojis et des caractères de texte enrichi dans le titre d’un sujet.',

	'ACL_U_SENDPM'		=> 'Peut envoyer des messages privés.',
	'ACL_U_MASSPM'		=> 'Peut envoyer des messages privés à plusieurs membres.',
	'ACL_U_MASSPM_GROUP'=> 'Peut envoyer des messages privés à des groupes.',
	'ACL_U_READPM'		=> 'Peut lire ses messages privés.',
	'ACL_U_PM_EDIT'		=> 'Peut modifier ses messages privés.',
	'ACL_U_PM_DELETE'	=> 'Peut supprimer des messages privés de son dossier.',
	'ACL_U_PM_FORWARD'	=> 'Peut transférer des messages privés.',
	'ACL_U_PM_EMAILPM'	=> 'Peut envoyer des messages privés par courriel.',
	'ACL_U_PM_PRINTPM'	=> 'Peut imprimer des messages privés.',
	'ACL_U_PM_ATTACH'	=> 'Peut joindre des fichiers.',
	'ACL_U_PM_DOWNLOAD'	=> 'Peut télécharger des fichiers.',
	'ACL_U_PM_BBCODE'	=> 'Peut utiliser des BBCodes.',
	'ACL_U_PM_SMILIES'	=> 'Peut utiliser des smileys.',
	'ACL_U_PM_IMG'		=> 'Peut utiliser le BBCode [img].',
	'ACL_U_PM_FLASH'	=> 'Peut utiliser le BBCode [flash].',

	'ACL_U_SENDEMAIL'	=> 'Peut envoyer des courriels.',
	'ACL_U_SENDIM'		=> 'Peut envoyer des messages instantanés.',
	'ACL_U_IGNOREFLOOD'	=> 'Peut ignorer la limite de flood.',
	'ACL_U_HIDEONLINE'	=> 'Peut cacher son statut en ligne.',
	'ACL_U_VIEWONLINE'	=> 'Peut voir les membres invisibles connectés.',
	'ACL_U_SEARCH'		=> 'Peut rechercher.',
));

// Forum Permissions
$lang = array_merge($lang, array(
	'ACL_F_LIST'		=> 'Peut voir ce forum.',
	'ACL_F_LIST_TOPICS' => 'Peut voir les sujets.',
	'ACL_F_READ'		=> 'Peut consulter ce forum.',
	'ACL_F_SEARCH'		=> 'Peut rechercher dans ce forum.',
	'ACL_F_SUBSCRIBE'	=> 'Peut surveiller ce forum.',
	'ACL_F_PRINT'		=> 'Peut imprimer un sujet.',
	'ACL_F_EMAIL'		=> 'Peut envoyer des sujets par courriel.',
	'ACL_F_BUMP'		=> 'Peut remonter un sujet.',
	'ACL_F_USER_LOCK'	=> 'Peut verrouiller un de ses sujets.',
	'ACL_F_DOWNLOAD'	=> 'Peut télécharger des fichiers.',
	'ACL_F_REPORT'		=> 'Peut rapporter un message à un modérateur.',

	'ACL_F_POST'		=> 'Peut créer de nouveaux sujets.',
	'ACL_F_STICKY'		=> 'Peut poster un sujet épinglé.',
	'ACL_F_ANNOUNCE'	=> 'Peut poster une annonce.',
	'ACL_F_ANNOUNCE_GLOBAL' => 'Peut poster une annonce globale.',
	'ACL_F_REPLY'		=> 'Peut répondre à un message.',
	'ACL_F_EDIT'		=> 'Peut modifier un de ses messages.',
	'ACL_F_DELETE'		=> 'Peut supprimer définitivement un de ses messages.',
	'ACL_F_SOFTDELETE'	=> 'Peut supprimer un de ses messages.<br><em>Les modérateurs ayant la permission « Peut approuver et restaurer un message », peuvent restaurer ces messages.</em>',
	'ACL_F_IGNOREFLOOD'	=> 'Peut ignorer la limite de flood.',
	'ACL_F_POSTCOUNT'	=> 'Peut incrémenter le compteur de messages.<br><em>Notez que ce paramètre affecte uniquement les nouveaux messages.</em>',
	'ACL_F_NOAPPROVE'	=> 'Peut poster sans approbation.',

	'ACL_F_ATTACH'		=> 'Peut joindre des fichiers.',
	'ACL_F_ICONS'		=> 'Peut utiliser les icônes de sujet/message.',
	'ACL_F_BBCODE'		=> 'Peut utiliser des BBCodes.',
	'ACL_F_FLASH'		=> 'Peut poster des animations Flash.',
	'ACL_F_IMG'			=> 'Peut poster des images.',
	'ACL_F_SIGS'		=> 'Peut utiliser une signature.',
	'ACL_F_SMILIES'		=> 'Peut utiliser des smileys.',

	'ACL_F_POLL'		=> 'Peut poster un sondage.',
	'ACL_F_VOTE'		=> 'Peut voter.',
	'ACL_F_VOTECHG'		=> 'Peut modifier un vote.',
));

// Moderator Permissions
$lang = array_merge($lang, array(
	'ACL_M_EDIT'		=> 'Peut modifier un message.',
	'ACL_M_DELETE'		=> 'Peut supprimer définitivement un message.',
	'ACL_M_SOFTDELETE'	=> 'Peut supprimer un message.<br><em>Les modérateurs ayant la permission « Peut approuver et restaurer un message », peuvent restaurer ces messages.</em>',
	'ACL_M_APPROVE'		=> 'Peut approuver et restaurer un message.',
	'ACL_M_REPORT'		=> 'Peut clôturer et supprimer les rapports.',
	'ACL_M_CHGPOSTER'	=> 'Peut modifier l’auteur d’un message.',

	'ACL_M_MOVE'	=> 'Peut déplacer un sujet.',
	'ACL_M_LOCK'	=> 'Peut verrouiller un sujet.',
	'ACL_M_SPLIT'	=> 'Peut diviser un sujet.',
	'ACL_M_MERGE'	=> 'Peut fusionner des sujets.',

	'ACL_M_INFO'		=> 'Peut voir les informations du message.',
	'ACL_M_WARN'		=> 'Peut avertir un membre.<br><em>Notez que ce paramètre est assigné globalement. Il n’est pas basé sur le forum.</em>', // This moderator setting is only global (and not local)
	'ACL_M_PM_REPORT'	=> 'Peut fermer ou supprimer des rapports de messages privés.<br><em>Notez que ce paramètre est assigné globalement. Il n’est pas basé sur le forum.</em>', // This moderator setting is only global (and not local)
	'ACL_M_BAN'			=> 'Peut gérer les bannissements.<br><em>Notez que ce paramètre est assigné globalement. Il n’est pas basé sur le forum.</em>', // This moderator setting is only global (and not local)
));

// Admin Permissions
$lang = array_merge($lang, array(
	'ACL_A_BOARD'		=> 'Peut modifier la configuration générale/Vérifier les mises à jour.',
	'ACL_A_SERVER'		=> 'Peut modifier la configuration serveur/communication.',
	'ACL_A_JABBER'		=> 'Peut modifier la configuration Jabber.',
	'ACL_A_PHPINFO'		=> 'Peut consulter la configuration PHP.',

	'ACL_A_FORUM'		=> 'Peut gérer les forums.',
	'ACL_A_FORUMADD'	=> 'Peut ajouter un forum.',
	'ACL_A_FORUMDEL'	=> 'Peut supprimer un forum.',
	'ACL_A_PRUNE'		=> 'Peut délester un forum.',

	'ACL_A_ICONS'		=> 'Peut modifier les icônes de sujet/message et les smileys.',
	'ACL_A_WORDS'		=> 'Peut modifier les mots censurés.',
	'ACL_A_BBCODE'		=> 'Peut créer des balises BBCodes.',
	'ACL_A_ATTACH'		=> 'Peut modifier la configuration des fichiers joints.',

	'ACL_A_USER'		=> 'Peut gérer les membres.<br><em>Ceci inclut également l’affichage du navigateur des utilisateurs dans la liste des utilisateurs connectés.</em>',
	'ACL_A_USERDEL'		=> 'Peut supprimer/trier les membres.',
	'ACL_A_GROUP'		=> 'Peut gérer les groupes.',
	'ACL_A_GROUPADD'	=> 'Peut ajouter un groupe.',
	'ACL_A_GROUPDEL'	=> 'Peut supprimer un groupe.',
	'ACL_A_RANKS'		=> 'Peut gérer les rangs.',
	'ACL_A_PROFILE'		=> 'Peut gérer les champs de profil personnalisés.',
	'ACL_A_NAMES'		=> 'Peut gérer les noms interdits.',
	'ACL_A_BAN'			=> 'Peut gérer les bannissements.',

	'ACL_A_VIEWAUTH'	=> 'Peut visualiser les masques de permissions.',
	'ACL_A_AUTHGROUPS'	=> 'Peut modifier les permissions des groupes.',
	'ACL_A_AUTHUSERS'	=> 'Peut modifier les permissions des membres.',
	'ACL_A_FAUTH'		=> 'Peut modifier les permissions des forums.',
	'ACL_A_MAUTH'		=> 'Peut modifier les permissions des modérateurs.',
	'ACL_A_AAUTH'		=> 'Peut modifier les permissions des administrateurs.',
	'ACL_A_UAUTH'		=> 'Peut modifier les permissions des utilisateurs individuels.',
	'ACL_A_ROLES'		=> 'Peut gérer les modèles.',
	'ACL_A_SWITCHPERM'	=> 'Peut utiliser les permissions d’autrui.',

	'ACL_A_STYLES'		=> 'Peut gérer les styles.',
	'ACL_A_EXTENSIONS'	=> 'Peut gérer les extensions.',
	'ACL_A_VIEWLOGS'	=> 'Peut consulter les journaux.',
	'ACL_A_CLEARLOGS'	=> 'Peut effacer les journaux.',
	'ACL_A_MODULES'		=> 'Peut gérer les modules.',
	'ACL_A_LANGUAGE'	=> 'Peut gérer les packs de langue.',
	'ACL_A_EMAIL'		=> 'Peut envoyer des courriels de masse.',
	'ACL_A_BOTS'		=> 'Peut gérer les robots.',
	'ACL_A_REASONS'		=> 'Peut gérer les rapports/raisons.',
	'ACL_A_BACKUP'		=> 'Peut sauvegarder et restaurer la base de données.',
	'ACL_A_SEARCH'		=> 'Peut gérer l’indexation et les paramètres de recherche.',
));
