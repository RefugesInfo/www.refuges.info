<?php
/**
*
* Contact Admin extension for the phpBB Forum Software package.
*
* @copyright 2016 Rich McGirr (RMcGirr83)
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
	$lang = [];
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
// ’ » “ ” …
//

$lang = array_merge($lang, [
	'ADMINS_NOT_EXIST_FOR_METHOD'	=> [
		0 => 'Aucun administrateur n‘autorise les e-mails. Vous devez choisir une autre méthode de contact.',
		2 => 'Aucun administrateur n‘autorise les messages privés. Vous devez choisir une autre méthode de contact.',
	],
	'CONTACT_CONFIG_SAVED'			=> 'La configuration de contact de ladministrateur a été mise à jour',
	'CONTACT_ACP_CONFIRM'				=> 'Activer la confirmation visuelle',
	'CONTACT_ACP_CONFIRM_EXPLAIN'		=> 'Si vous activez cette option, les utilisateurs devront entrer une confirmation visuelle pour envoyer le message.<br>Ceci afin d‘éviter les spams. Notez que cette option est pour la page de contact uniquement.  Cela n‘affecte pas les autres paramètres de confirmation visuelle.',
	'CONTACT_ATTACHMENTS'				=> 'Pièces jointes autorisées',
	'CONTACT_ATTACHMENTS_EXPLAIN'		=> 'Si les pièces jointes sont autorisées, les utilisateurs pourront ajouter des fichiers dans la publication sur le forum et les messages privés.<br>Les extensions autorisées sont identiques à la configuration du forum.<br><span style="color:red;">Ne s‘applique pas à la méthode de contact par “e-mail”.</span>',
	'CONTACT_CONFIRM_GUESTS'			=> 'Confirmation visuelle pour les invités uniquement',
	'CONTACT_CONFIRM_GUESTS_EXPLAIN'	=> 'Si cette option est activée, la confirmation visuelle ne s‘affiche que pour les invités (si elle est activée).',
	'CONTACT_FOUNDER'					=> 'Contacter uniquement le fondateur du forum',
	'CONTACT_FOUNDER_EXPLAIN'			=> 'Si ce paramètre est activé, seul le fondateur du forum recevra des notifications par e-mail ou en message privé.',

	'CONTACT_MAX_ATTEMPTS'				=> 'Nombre maximum de tentatives',
	'CONTACT_MAX_ATTEMPTS_EXPLAIN'		=> 'Combien de fois un utilisateur peut-il essayer de saisir correctement l‘image de confirmation ?<br>Entrer 0 pour des tentatives illimitées.',
	'CONTACT_METHOD'					=> 'Méthode de contact',
	'CONTACT_METHOD_EXPLAIN'			=> 'Comment voulez-vous que les utilisateurs puissent entrer en contact.<br><span style="color:red;">Si défini sur «E-mail», les pièces jointes ne s‘appliquent pas.</span>',
	'CONTACT_REASONS'					=> 'Raisons de contact',
	'CONTACT_REASONS_EXPLAIN'			=> 'Saisissez les raisons du contact, séparées par de nouvelles lignes.<br>Si vous ne souhaitez pas utiliser cette fonctionnalité, laissez ce champ vide.',
	// Bot config options
	'CONTACT_BOT_FORUM'				=> 'Forum du robot de contact',
	'CONTACT_BOT_FORUM_EXPLAIN'		=> 'Sélectionnez le forum sur lequel le robot de contact doit publier si la méthode de contact est définie sur "Dans un forum".',
	'CONTACT_BOT_POSTER'			=> 'Utilisation du robot de contact',
	'CONTACT_BOT_POSTER_EXPLAIN'	=> 'Si les MP et les messages sont définis, ils sembleront provenir de l‘utilisateur du robot de contact choisi ci-dessus en fonction des paramètres ici. Si «Ni l‘un ni l‘autre» est sélectionné, le robot n‘est pas utilisé pour le message. Les messages et les MP seront publiés en fonction des informations saisies dans le formulaire de contact.',
	'CONTACT_BOT_USER'				=> 'Utilisateur comme robot de contact',
	'CONTACT_BOT_USER_EXPLAIN'		=> 'Sélectionnez l‘utilisateur sous lequel les messages seront publiés si la méthode de contact est définie sur "Message privé" ou "Dans un forum".',
	'CONTACT_NO_BOT_USER'			=> '<b>L‘ID utilisateur du robot de contact choisi n‘existe pas</b>',
	'CONTACT_USERNAME_CHK'			=> 'Vérifier le nom d‘utilisateur',
	'CONTACT_USERNAME_CHK_EXPLAIN'	=> 'Si la valeur est oui, le nom d’utilisateur saisi sera comparé à celui de la base de données. Si le nom est trouvé, l‘utilisateur aura un message d‘erreur et sera invité à entrer un nom d‘utilisateur différent.',
	'CONTACT_EMAIL_CHK'				=> 'Vérifier l‘adresse e-mail',
	'CONTACT_EMAIL_CHK_EXPLAIN'		=> 'Si la valeur est oui, l‘adresse e-mail de l‘utilisateur sera comparée à celles de la base de données. Si l‘adresse e-mail est trouvée, l‘utilisateur aura un message d‘erreur et sera invité à saisir une adresse e-mail différente.',

	// Contact methods
	'CONTACT_METHOD_EMAIL'			=> 'E-mail',
	'CONTACT_METHOD_PM'				=> 'Message privé',
	'CONTACT_METHOD_POST'			=> 'Dans un forum',
	'CONTACT_METHOD_BOARD_DEFAULT'	=> 'Courriel par défaut du forum',

	// Contact posters...user bot
	'CONTACT_POST_NEITHER'			=> 'Ni l‘un ni l‘autre',
	'CONTACT_POST_GUEST'			=> 'Invités seulement',
	'CONTACT_POST_ALL'				=> 'Tout le monde',

	// Overwrite the default contact page lang
	'CONTACT_EXTENSION_ACTIVE'	=> '<span style="color:red;">Les paramètres ici n‘auront pas d‘importance car vous avez actuellement activé l‘extension de contact de l‘administrateur. Vous ne pourrez pas activer cette option sans avoir préalablement désactivé l‘extension</span>',
]);
