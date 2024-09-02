<?php
/**
 *
 * Prime Links. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, Ken F. Innes IV, https://www.absoluteanime.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
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
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_PRIMELINKS_TITLE'						=> 'Priorité des liens',
	'ACP_PRIMELINKS_SETTINGS'					=> 'Paramètres de priorité des liens',
	'ACP_PRIMELINKS_BASIC_SETTINGS'				=> 'Configuration générale',
	'ACP_PRIMELINKS_ADV_SETTINGS'				=> 'Paramètres avancés',
	'ACP_PRIMELINKS_SETTINGS_SAVED'				=> 'Les paramètres de priorité des liens ont été enregistrés avec succès !',
	'ACP_PRIMELINKS_SETTINGS_LOG'				=> '<strong>Paramètres de priorité des liens modifiés</strong>',
	'ACP_PRIMELINKS_INTERNAL_LINKS'				=> 'Liens internes',
	'ACP_PRIMELINKS_EXTERNAL_LINKS'				=> 'Liens externes',
	'ACP_PRIMELINKS_EXAMPLE'					=> 'ex. ',	// Examples follow directly after this, so you may want a trailing space

	'ACP_PRIMELINKS_ENABLE_GENERAL'				=> 'Activer le traitement des liens',
	'ACP_PRIMELINKS_ENABLE_GENERAL_EXPLAIN'		=> 'Permet le traitement des liens pour les publications, les messages privés et d‘autres blocs de texte analysés',

	'ACP_PRIMELINKS_ENABLE_STYLE'				=> 'Activer le style',
	'ACP_PRIMELINKS_ENABLE_STYLE_EXPLAIN'		=> 'Activer le fichier CSS et les images inclus pour styliser les liens.',

	'ACP_PRIMELINKS_ENABLE_FORUMLIST'			=> 'Activer pour la liste des forums',
	'ACP_PRIMELINKS_ENABLE_FORUMLIST_EXPLAIN'	=> 'Ajoutez des attributs de lien externe aux liens de liste de forums (type de forum AKA défini sur <strong>Lien</strong>). Cela n‘analyse ni ne traite réellement l‘URL du lien, il est simplement traité comme un lien externe.',

	'ACP_PRIMELINKS_ENABLE_MEMBERS'				=> 'Activer pour le site Web des membres',
	'ACP_PRIMELINKS_ENABLE_MEMBERS_EXPLAIN'		=> 'Ajoutez des attributs de lien externe au lien du site Web des membres sur les pages de profil et la page de liste des membres. Cela n‘analyse ni ne traite réellement l‘URL du lien, il est simplement traité comme un lien externe.',

	'ACP_PRIMELINKS_LINK_GUEST_HIDE'			=> 'Supprimer les liens pour les invités',
	'ACP_PRIMELINKS_LINK_GUEST_HIDE_EXPLAIN'	=> 'Les liens seront supprimés pour les invités. Le texte du lien restera sauf s‘il est remplacé par un message.',
	'ACP_PRIMELINKS_LINK_GUEST_HIDE_REPLACE'	=> 'Remplacer par un message.',

	'ACP_PRIMELINKS_LINK_PREFIX'				=> 'Préfixe URL du lien',
	'ACP_PRIMELINKS_LINK_PREFIX_EXPLAIN'		=> 'Ce sera ajouté au début de l‘URL d‘un lien.',
	'ACP_PRIMELINKS_INLINK_PREFIX_EXAMPLE'		=> '<samp>https://adf.ly/</samp>',
	'ACP_PRIMELINKS_EXLINK_PREFIX_EXAMPLE'		=> '<samp>https://anonym.to?</samp>',

	'ACP_PRIMELINKS_INLINK_DOMAINS'				=> 'Domaines internes',
	'ACP_PRIMELINKS_INLINK_DOMAINS_EXPLAIN'		=> 'Les liens avec ces domaines seront considérés comme s‘il s‘agissait de liens internes. Vous n‘avez pas besoin de spécifier le domaine du tableau.',
	'ACP_PRIMELINKS_INLINK_DOMAINS_EXAMPLE'		=> '<samp>www.alt-local-domain.com</samp>',

	'ACP_PRIMELINKS_FORBIDDEN_DOMAINS'			=> 'Domaines interdits',
	'ACP_PRIMELINKS_FORBIDDEN_DOMAINS_EXPLAIN'	=> 'Les liens avec ces domaines seront supprimés. Le texte du lien restera sauf si vous activez également le message interdit.',
	'ACP_PRIMELINKS_FORBIDDEN_DOMAINS_EXAMPLE'	=> '<samp>www.forbidden-domain.com</samp>',

	'ACP_PRIMELINKS_FORBIDDEN_MSG'				=> 'Message interdit',
	'ACP_PRIMELINKS_FORBIDDEN_MSG_EXPLAIN'		=> 'Remplacer le texte des liens interdits par un message.',

	'ACP_PRIMELINKS_FORBIDDEN_NEW_URL'			=> 'URL de remplacement',
	'ACP_PRIMELINKS_FORBIDDEN_NEW_URL_EXPLAIN'	=> 'Remplace l‘URL de tout lien interdit qui aurait été supprimé. Il peut s‘agir d‘une URL complète ou d‘une URL relative.',
	'ACP_PRIMELINKS_FORBIDDEN_NEW_URL_EXAMPLE'	=> '<samp>forbidden-list.php</samp>',

	'ACP_PRIMELINKS_LINK_REL'					=> 'Relation de lien',
	'ACP_PRIMELINKS_LINK_REL_EXPLAIN'			=> 'L‘attribut rel spécifié sera appliqué aux liens, spécifiant la relation entre le document actuel et le document lié. Par exemple, une valeur de <samp>nofollow</samp> indique que le lien n‘est pas approuvé.',
	'ACP_PRIMELINKS_INLINK_REL_EXAMPLE'			=> '<samp>follow</samp>',
	'ACP_PRIMELINKS_EXLINK_REL_EXAMPLE'			=> '<samp>nofollow</samp>',

	'ACP_PRIMELINKS_LINK_TARGET'				=> 'Lien cible',
	'ACP_PRIMELINKS_LINK_TARGET_EXPLAIN'		=> 'L‘attribut cible spécifié sera appliqué aux liens, en spécifiant où le lien s‘ouvrira. Par exemple, une valeur de <samp>_blank</samp> ouvrira le lien dans une nouvelle fenêtre.',
	'ACP_PRIMELINKS_INLINK_TARGET_EXAMPLE'		=> '<samp>_self</samp>',
	'ACP_PRIMELINKS_EXLINK_TARGET_EXAMPLE'		=> '<samp>_blank</samp>',

	'ACP_PRIMELINKS_LINK_CLASS'					=> 'Classe de lien',
	'ACP_PRIMELINKS_LINK_CLASS_EXPLAIN'			=> 'Les noms de classe spécifiés seront appliqués aux liens, vous permettant de les styliser à partir de fichiers CSS. Entrez un ou plusieurs noms de classe, séparés par des espaces. Laisser vide pour utiliser la valeur par défaut du forum.',
	'ACP_PRIMELINKS_INLINK_CLASS_EXAMPLE'		=> '<samp>postlink-local</samp>',
	'ACP_PRIMELINKS_EXLINK_CLASS_EXAMPLE'		=> '<samp>postlink</samp>',

	'ACP_PRIMELINKS_SKIP_REGEX'					=> 'Oublier les liens RegEx',
	'ACP_PRIMELINKS_SKIP_REGEX_EXPLAIN'			=> 'Les URL correspondant à cette expression régulière ne seront pas traitées.',
	'ACP_PRIMELINKS_SKIP_REGEX_EXAMPLE'			=> '<samp>/\.(?:rar|zip|tar)(?:[#?]|$)/</samp>',

	'ACP_PRIMELINKS_INLINK_REGEX'				=> 'Liens internes RegEx',
	'ACP_PRIMELINKS_INLINK_REGEX_EXPLAIN'		=> 'Les URL correspondant à cette expression régulière seront considérées comme des liens internes.',
	'ACP_PRIMELINKS_INLINK_REGEX_EXAMPLE'		=> '<samp>/\.(?:gif|jpg|png)(?:[#?]|$)/</samp>',

	'ACP_PRIMELINKS_EXLINK_REGEX'				=> 'Liens externes RegEx',
	'ACP_PRIMELINKS_EXLINK_REGEX_EXPLAIN'		=> 'Les URL correspondant à cette expression régulière seront considérées comme des liens externes.',
	'ACP_PRIMELINKS_EXLINK_REGEX_EXAMPLE'		=> '<samp>/\.(?:pdf|doc|wpd)(?:[#?]|$)/</samp>',

	'ACP_PRIMELINKS_SKIP_PREFIX_REGEX'			=> 'Oublier les préfixes RegEx',
	'ACP_PRIMELINKS_SKIP_PREFIX_REGEX_EXPLAIN'	=> 'Le préfixe de lien ne sera pas appliqué aux URL correspondant à cette expression régulière.',
	'ACP_PRIMELINKS_SKIP_PREFIX_REGEX_EXAMPLE'	=> '<samp>/^www\.absoluteanime\.com)/</samp>',

	'ACP_PRIMELINKS_INLINK_USE_TITLES'			=> 'Afficher les titres au lieu des URL',
	'ACP_PRIMELINKS_INLINK_USE_TITLES_EXPLAIN'	=> 'Afficher le sujet du message, le titre du sujet ou le nom du forum au lieu de l‘URL (par exemple, change <strong>viewtopic.php?T=1</strong> en <strong>Mon sujet</strong>).',
));
