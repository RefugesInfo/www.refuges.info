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
	'ACP_PRIMELINKS_TITLE'						=> 'Prime Links',
	'ACP_PRIMELINKS_SETTINGS'					=> 'Prime Links Settings',
	'ACP_PRIMELINKS_BASIC_SETTINGS'				=> 'General Settings',
	'ACP_PRIMELINKS_ADV_SETTINGS'				=> 'Advanced Settings',
	'ACP_PRIMELINKS_SETTINGS_SAVED'				=> 'Prime Links settings have been saved successfully!',
	'ACP_PRIMELINKS_SETTINGS_LOG'				=> '<strong>Altered Prime Links settings</strong>',
	'ACP_PRIMELINKS_INTERNAL_LINKS'				=> 'Local Links',
	'ACP_PRIMELINKS_EXTERNAL_LINKS'				=> 'External Links',
	'ACP_PRIMELINKS_EXAMPLE'					=> 'e.g. ',	// Examples follow directly after this, so you may want a trailing space

	'ACP_PRIMELINKS_ENABLE_GENERAL'				=> 'Enable Link Processing',
	'ACP_PRIMELINKS_ENABLE_GENERAL_EXPLAIN'		=> 'Enables link processing for posts, private messages, and other parsed blocks of text',

	'ACP_PRIMELINKS_ENABLE_STYLE'				=> 'Enable Styling',
	'ACP_PRIMELINKS_ENABLE_STYLE_EXPLAIN'		=> 'Enables the included CSS file and images for styling links.',

	'ACP_PRIMELINKS_ENABLE_FORUMLIST'			=> 'Enable for Forum List',
	'ACP_PRIMELINKS_ENABLE_FORUMLIST_EXPLAIN'	=> 'Add external link attributes to forum list links (AKA forum type set to <strong>Link</strong>). This does not actually parse or process the link URL, it’s simply treated as an external link.',

	'ACP_PRIMELINKS_ENABLE_MEMBERS'				=> 'Enable for Member Website',
	'ACP_PRIMELINKS_ENABLE_MEMBERS_EXPLAIN'		=> 'Add external link attributes to the member website link on profile pages and the member list page. This does not actually parse or process the link URL, it’s simply treated as an external link.',

	'ACP_PRIMELINKS_LINK_GUEST_HIDE'			=> 'Remove links for guests',
	'ACP_PRIMELINKS_LINK_GUEST_HIDE_EXPLAIN'	=> 'Links will be removed for guests. The link text will remain unless replaced with a message.',
	'ACP_PRIMELINKS_LINK_GUEST_HIDE_REPLACE'	=> 'Replace with a message.',

	'ACP_PRIMELINKS_LINK_PREFIX'				=> 'Link URL prefix',
	'ACP_PRIMELINKS_LINK_PREFIX_EXPLAIN'		=> 'This will be prepended to a link’s URL.',
	'ACP_PRIMELINKS_INLINK_PREFIX_EXAMPLE'		=> '<samp>http://adf.ly/</samp>',
	'ACP_PRIMELINKS_EXLINK_PREFIX_EXAMPLE'		=> '<samp>http://anonym.to?</samp>',

	'ACP_PRIMELINKS_INLINK_DOMAINS'				=> 'Local Domains',
	'ACP_PRIMELINKS_INLINK_DOMAINS_EXPLAIN'		=> 'Links with these domains will be considered as if they were local links. You don’t need to specify the board’s domain.',
	'ACP_PRIMELINKS_INLINK_DOMAINS_EXAMPLE'		=> '<samp>www.alt-local-domain.com</samp>',

	'ACP_PRIMELINKS_FORBIDDEN_DOMAINS'			=> 'Forbidden Domains',
	'ACP_PRIMELINKS_FORBIDDEN_DOMAINS_EXPLAIN'	=> 'Links with these domains will be removed. The link text will remain unless you also enable the Forbidden Message.',
	'ACP_PRIMELINKS_FORBIDDEN_DOMAINS_EXAMPLE'	=> '<samp>www.forbidden-domain.com</samp>',

	'ACP_PRIMELINKS_FORBIDDEN_MSG'				=> 'Forbidden Message',
	'ACP_PRIMELINKS_FORBIDDEN_MSG_EXPLAIN'		=> 'Replace the text of forbidden links with a message.',

	'ACP_PRIMELINKS_FORBIDDEN_NEW_URL'			=> 'Replacement URL',
	'ACP_PRIMELINKS_FORBIDDEN_NEW_URL_EXPLAIN'	=> 'Replaces the URL of any forbidden link that would have been removed. It can be a full URL or a relative URL.',
	'ACP_PRIMELINKS_FORBIDDEN_NEW_URL_EXAMPLE'	=> '<samp>forbidden-list.php</samp>',

	'ACP_PRIMELINKS_LINK_REL'					=> 'Link relationship',
	'ACP_PRIMELINKS_LINK_REL_EXPLAIN'			=> 'The specified rel attribute will be applied to links, specifying the relationship between the current document and the linked document. For instance, a value of <samp>nofollow</samp> indicates that the link is not endorsed.',
	'ACP_PRIMELINKS_INLINK_REL_EXAMPLE'			=> '<samp>follow</samp>',
	'ACP_PRIMELINKS_EXLINK_REL_EXAMPLE'			=> '<samp>nofollow</samp>',

	'ACP_PRIMELINKS_LINK_TARGET'				=> 'Link target',
	'ACP_PRIMELINKS_LINK_TARGET_EXPLAIN'		=> 'The specified target attribute will be applied to links, specifying where the link will open. For instance, a value of <samp>_blank</samp> will open the link in a new window.',
	'ACP_PRIMELINKS_INLINK_TARGET_EXAMPLE'		=> '<samp>_self</samp>',
	'ACP_PRIMELINKS_EXLINK_TARGET_EXAMPLE'		=> '<samp>_blank</samp>',

	'ACP_PRIMELINKS_LINK_CLASS'					=> 'Link class',
	'ACP_PRIMELINKS_LINK_CLASS_EXPLAIN'			=> 'The specified class names will be applied to links, allowing you to style them from within CSS files. Enter one or more class names, separated by spaces. Leave blank to use the board’s default.',
	'ACP_PRIMELINKS_INLINK_CLASS_EXAMPLE'		=> '<samp>postlink-local</samp>',
	'ACP_PRIMELINKS_EXLINK_CLASS_EXAMPLE'		=> '<samp>postlink</samp>',

	'ACP_PRIMELINKS_SKIP_REGEX'					=> 'Skip Links RegEx',
	'ACP_PRIMELINKS_SKIP_REGEX_EXPLAIN'			=> 'URLs matching this regular expression won’t be processed.',
	'ACP_PRIMELINKS_SKIP_REGEX_EXAMPLE'			=> '<samp>/\.(?:rar|zip|tar)(?:[#?]|$)/</samp>',

	'ACP_PRIMELINKS_INLINK_REGEX'				=> 'Internal Links RegEx',
	'ACP_PRIMELINKS_INLINK_REGEX_EXPLAIN'		=> 'URLs matching this regular expression will be considered internal links.',
	'ACP_PRIMELINKS_INLINK_REGEX_EXAMPLE'		=> '<samp>/\.(?:gif|jpg|png)(?:[#?]|$)/</samp>',

	'ACP_PRIMELINKS_EXLINK_REGEX'				=> 'External Links RegEx',
	'ACP_PRIMELINKS_EXLINK_REGEX_EXPLAIN'		=> 'URLs matching this regular expression will be considered external links.',
	'ACP_PRIMELINKS_EXLINK_REGEX_EXAMPLE'		=> '<samp>/\.(?:pdf|doc|wpd)(?:[#?]|$)/</samp>',

	'ACP_PRIMELINKS_SKIP_PREFIX_REGEX'			=> 'Skip Prefix RegEx',
	'ACP_PRIMELINKS_SKIP_PREFIX_REGEX_EXPLAIN'	=> 'URLs matching this regular expression will not have the link prefix applied.',
	'ACP_PRIMELINKS_SKIP_PREFIX_REGEX_EXAMPLE'	=> '<samp>/^www\.absoluteanime\.com)/</samp>',

	'ACP_PRIMELINKS_INLINK_USE_TITLES'			=> 'Show titles instead of URLs',
	'ACP_PRIMELINKS_INLINK_USE_TITLES_EXPLAIN'	=> 'Display the post subject, topic title, or forum name instead of the URL (e.g. changes <strong>viewtopic.php?t=1</strong> to <strong>My Topic</strong>).',
));
