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

$lang = array_merge($lang, array(
	'ABOUT_USER'			=> 'Profil',
	'ACTIVE_IN_FORUM'		=> 'Forum le plus actif',
	'ACTIVE_IN_TOPIC'		=> 'Sujet le plus actif',
	'ADD_FOE'				=> 'Ajouter à ma liste d’ignorés',
	'ADD_FRIEND'			=> 'Ajouter à ma liste d’amis',
	'AFTER'					=> 'Après',

	'ALL'					=> 'Tous',

	'BEFORE'				=> 'Avant',

	'CC_SENDER'				=> 'S’envoyer une copie de ce courriel.',
	'CONTACT_ADMIN'			=> 'Contacter un administrateur du forum',

	'DEST_LANG'				=> 'Langue',
	'DEST_LANG_EXPLAIN'		=> 'Choisissez une langue appropriée (si disponible) pour le destinataire de ce message.',

	'EDIT_PROFILE'			=> 'Modifier le profil',

	'EMAIL_BODY_EXPLAIN'	=> 'Ce message sera envoyé au format texte, ne pas inclure de code HTML ni de BBCode. L’adresse de réponse à ce message sera votre adresse courriel.',
	'EMAIL_DISABLED'		=> 'Désolé mais toutes les fonctions en rapport avec les courriels ont été désactivées.',
	'EMAIL_SENT'			=> 'Le courriel a été envoyé.',
	'EMAIL_TOPIC_EXPLAIN'	=> 'Ce message sera envoyé au format texte, ne pas inclure de code HTML ni de BBCode. Notez que les informations sur le sujet sont déjà incluses dans le message. L’adresse de réponse à ce message sera votre adresse courriel.',
	'EMPTY_ADDRESS_EMAIL'	=> 'Vous devez fournir une adresse courriel valide pour le destinataire.',
	'EMPTY_MESSAGE_EMAIL'	=> 'Vous devez écrire un message.',
	'EMPTY_MESSAGE_IM'		=> 'Vous devez écrire un message à envoyer.',
	'EMPTY_NAME_EMAIL'		=> 'Vous devez saisir le nom réel du destinataire.',
	'EMPTY_SENDER_EMAIL'	=> 'Vous devez fournir une adresse courriel valide.',
	'EMPTY_SENDER_NAME'		=> 'Vous devez indiquer un nom.',
	'EMPTY_SUBJECT_EMAIL'	=> 'Vous devez indiquer un sujet pour le courriel.',
	'EQUAL_TO'				=> 'Égal à',

	'FIND_USERNAME_EXPLAIN'	=> 'Utilisez ce formulaire pour rechercher un membre. Vous n’avez pas besoin de compléter tous les champs. Pour effectuer une recherche partielle, utilisez le caractère « * » comme joker. Utilisez le format de date <kbd>AAAA-MM-JJ</kbd>, par exemple : <samp>2004-02-29</samp>. En fonction du formulaire, vous pouvez utiliser les cases à cocher pour sélectionner un ou plusieurs noms d’utilisateurs puis cliquez sur « Valider la sélection » pour retourner au formulaire précédent.',
	'FLOOD_EMAIL_LIMIT'		=> 'Vous ne pouvez pas envoyer un autre courriel si rapidement. Veuillez réessayer ultérieurement.',

	'GROUP_LEADER'			=> 'Chef du groupe',

	'HIDE_MEMBER_SEARCH'	=> 'Cacher la recherche des membres',

	'IM_ADD_CONTACT'		=> 'Ajouter le contact',
	'IM_DOWNLOAD_APP'		=> 'Télécharger l’application',
	'IM_JABBER'				=> 'Notez que les membres ont pu choisir de ne pas recevoir de messages instantanés non sollicités.',
	'IM_JABBER_SUBJECT'		=> 'Ceci est un message automatique, merci de ne pas y répondre ! Message du membre %1$s le %2$s.',
	'IM_MESSAGE'			=> 'Votre message',
	'IM_NAME'				=> 'Votre nom',
	'IM_NO_DATA'			=> 'Aucune information de contact pour ce membre.',
	'IM_NO_JABBER'			=> 'Désolé, la transmission de messages instantanés vers des utilisateurs Jabber n’est pas supportée sur ce forum. Votre devez avoir un client Jabber installé sur votre système pour contacter le destinataire ci-dessus.',
	'IM_RECIPIENT'			=> 'Destinataire',
	'IM_SEND'				=> 'Envoyer un message',
	'IM_SEND_MESSAGE'		=> 'Envoyer un message',
	'IM_SENT_JABBER'		=> 'Votre message destiné à %1$s a été envoyé.',
	'IM_USER'				=> 'Envoyer un message instantané',

	'LAST_ACTIVE'				=> 'Dernière visite',
	'LESS_THAN'					=> 'Moins que',
	'LIST_USERS'				=> array(
		1	=> '%d membre',
		2	=> '%d membres',
	),
	'LOGIN_EXPLAIN_TEAM'		=> 'Le forum exige que vous soyez enregistré et connecté pour pouvoir consulter la liste des membres de l’équipe.',
	'LOGIN_EXPLAIN_MEMBERLIST'	=> 'Le forum exige que vous soyez enregistré et connecté pour pouvoir consulter la liste des membres.',
	'LOGIN_EXPLAIN_SEARCHUSER'	=> 'Le forum exige que vous soyez enregistré et connecté pour rechercher des membres.',
	'LOGIN_EXPLAIN_VIEWPROFILE'	=> 'Le forum exige que vous soyez enregistré et connecté pour pouvoir consulter le profil des membres.',

	'MANAGE_GROUP'			=> 'Gérer le groupe',
	'MORE_THAN'				=> 'Plus que',

	'NO_CONTACT_FORM'		=> 'Le formulaire de contact a été désactivé.',
	'NO_CONTACT_PAGE'		=> 'La page de contact a été désactivée.',
	'NO_EMAIL'				=> 'Vous ne pouvez pas envoyer de courriels à ce membre.',
	'NO_VIEW_USERS'			=> 'Vous ne pouvez pas consulter la liste des membres ou les profils.',

	'ORDER'					=> 'Ordre',
	'OTHER'					=> 'Autre',

	'POST_IP'				=> 'Posté depuis IP/domaine',

	'REAL_NAME'				=> 'Nom du destinataire',
	'RECIPIENT'				=> 'Destinataire',
	'REMOVE_FOE'			=> 'Supprimer de ma liste d’ignorés',
	'REMOVE_FRIEND'			=> 'Supprimer de ma liste d’amis',

	'SELECT_MARKED'			=> 'Valider la sélection',
	'SELECT_SORT_METHOD'	=> 'Choisir la méthode de tri',
	'SENDER_EMAIL_ADDRESS'	=> 'Votre adresse courriel',
	'SENDER_NAME'			=> 'Votre nom',
	'SEND_ICQ_MESSAGE'		=> 'Envoyer un message ICQ',
	'SEND_IM'				=> 'Messagerie instantanée',
	'SEND_JABBER_MESSAGE'	=> 'Envoyer un message Jabber',
	'SEND_MESSAGE'			=> 'Message',
	'SEND_YIM_MESSAGE'		=> 'Envoyer un message YIM',
	'SORT_EMAIL'			=> 'Adresse courriel',
	'SORT_LAST_ACTIVE'		=> 'Dernière visite',
	'SORT_POST_COUNT'		=> 'Nombre de messages',

	'USERNAME_BEGINS_WITH'	=> 'Noms commençant par',
	'USER_ADMIN'			=> 'Administrer le membre',
	'USER_BAN'				=> 'Bannissement',
	'USER_FORUM'			=> 'Statistiques du membre',
	'USER_LAST_REMINDED'	=> array(
		0		=> 'Aucun rappel envoyé actuellement',
		1		=> '%1$d rappel envoyé<br>» %2$s',
		2		=> '%1$d rappels envoyés<br>» %2$s',
	),
	'USER_ONLINE'			=> 'En ligne',
	'USER_PRESENCE'			=> 'Présence sur le forum',
	'USERS_PER_PAGE'		=> 'Membres par page',

	'VIEWING_PROFILE'			=> 'Profil de - %s',
	'VIEW_FACEBOOK_PROFILE'		=> 'Consulter le profil Facebook',
	'VIEW_SKYPE_PROFILE'		=> 'Consulter le profil Skype',
	'VIEW_TWITTER_PROFILE'		=> 'Consulter le profil Twitter',
	'VIEW_YOUTUBE_CHANNEL'		=> 'Consulter la chaîne YouTube',
));
