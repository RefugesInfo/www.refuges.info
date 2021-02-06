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

// Custom profile fields
$lang = array_merge($lang, array(
	'ADDED_PROFILE_FIELD'	=> 'Le champ de profil personnalisé a été ajouté.',
	'ALPHA_DOTS'			=> 'Alphanumérique et points',
	'ALPHA_ONLY'			=> 'Alphanumérique uniquement',
	'ALPHA_SPACERS'			=> 'Alphanumérique et espaces',
	'ALPHA_UNDERSCORE'		=> 'Alphanumérique et tirets bas (underscore)',
	'ALPHA_PUNCTUATION'		=> 'Alphanumérique, virgules, points, tirets bas (underscore), tirets et commençant par une lettre',
	'ALWAYS_TODAY'			=> 'Date du jour par défaut',

	'BOOL_ENTRIES_EXPLAIN'	=> 'Saisissez vos options',
	'BOOL_TYPE_EXPLAIN'		=> 'Détermine le type, soit une case à cocher, soit un bouton radio. La case à cocher s’affichera uniquement si l’option est cochée dans le profil du membre. Dans ce cas, seulement la <strong>deuxième</strong> option de langue sera utilisée. Les boutons radios seront affichés indépendamment de leur valeur.',

	'CHANGED_PROFILE_FIELD'		=> 'Le champ de profil a été modifié.',
	'CHARS_ANY'					=> 'N’importe quel caractère',
	'CHECKBOX'					=> 'Case à cocher',
	'COLUMNS'					=> 'Colonnes',
	'CP_LANG_DEFAULT_VALUE'		=> 'Valeur par défaut',
	'CP_LANG_EXPLAIN'			=> 'Description du champ',
	'CP_LANG_EXPLAIN_EXPLAIN'	=> 'Cette description sera affichée à l’utilisateur.',
	'CP_LANG_NAME'				=> 'Nom de champ/titre affiché à l’utilisateur',
	'CP_LANG_OPTIONS'			=> 'Options',
	'CREATE_NEW_FIELD'			=> 'Créer un nouveau champ',
	'CUSTOM_FIELDS_NOT_TRANSLATED'	=> 'Au moins un champ de profil personnalisé n’a pas encore été traduit. Veuillez saisir les informations nécessaires en cliquant sur le lien « Traduire ».',

	'DEFAULT_ISO_LANGUAGE'			=> 'Langue par défaut [%s]',
	'DEFAULT_LANGUAGE_NOT_FILLED'	=> 'L’entrée de langue pour la langue par défaut n’a pas été renseignée pour ce champ de profil.',
	'DEFAULT_VALUE'					=> 'Valeur par défaut',
	'DELETE_PROFILE_FIELD'			=> 'Supprimer le champ de profil',
	'DELETE_PROFILE_FIELD_CONFIRM'	=> 'Êtes-vous sûr de voir supprimer ce champ de profil ?',
	'DISPLAY_AT_PROFILE'			=> 'Afficher dans le panneau de l’utilisateur',
	'DISPLAY_AT_PROFILE_EXPLAIN'	=> 'Le membre peut modifier ce champ de profil dans le panneau de l’utilisateur.',
	'DISPLAY_AT_REGISTER'			=> 'Afficher sur la page d’enregistrement',
	'DISPLAY_AT_REGISTER_EXPLAIN'	=> 'Si cette option est activée, le champ sera affiché dans le formulaire d’enregistrement au forum.',
	'DISPLAY_ON_MEMBERLIST'			=> 'Afficher dans la liste des membres',
	'DISPLAY_ON_MEMBERLIST_EXPLAIN'	=> 'Si cette option est activée, le champ sera affiché dans la ligne des utilisateurs de la liste des membres.',
	'DISPLAY_ON_PM'					=> 'Afficher dans les messages privés',
	'DISPLAY_ON_PM_EXPLAIN'			=> 'Si cette option est activée, le champ sera affiché dans le mini-profil des messages privés.',
	'DISPLAY_ON_VT'					=> 'Afficher dans les sujets',
	'DISPLAY_ON_VT_EXPLAIN'			=> 'Si cette option est activée, le champ sera affiché dans le mini-profil des sujets.',
	'DISPLAY_PROFILE_FIELD'			=> 'Afficher publiquement le champ de profil',
	'DISPLAY_PROFILE_FIELD_EXPLAIN'	=> 'Le champ de profil sera visible dans tous les endroits autorisés dans la page « Paramètres de charge ». Réglez cela sur « Non » masquera le champ des pages de sujets, des profils et de la liste des membres.',
	'DROPDOWN_ENTRIES_EXPLAIN'		=> 'Saisissez vos options, chaque option doit être sur une ligne différente.',

	'EDIT_DROPDOWN_LANG_EXPLAIN'	=> 'Notez que vous pouvez modifier le texte de vos options et ajouter de nouvelles options en fin de liste. Il est déconseillé d’insérer de nouvelles options entre celles existantes - cela pourrait entraîner l’attribution d’options erronées à vos utilisateurs. Ceci peut également se produire si vous supprimez des options parmi d’autres. La suppression d’options en partant de la fin va entraîner, pour les utilisateurs ayant sélectionné ces options, l’activation de l’option définie par défaut.',
	'EMPTY_FIELD_IDENT'				=> 'L’identification du champ est vide',
	'EMPTY_USER_FIELD_NAME'			=> 'Saisissez un nom/titre du champ',
	'ENTRIES'						=> 'Entrées',
	'EVERYTHING_OK'					=> 'Tout est correct',

	'FIELD_BOOL'				=> 'Booléen (oui/non)',
	'FIELD_CONTACT_DESC'		=> 'Description du contact',
	'FIELD_CONTACT_URL'			=> 'Lien du contact',
	'FIELD_DATE'				=> 'Date',
	'FIELD_DESCRIPTION'			=> 'Description du champ',
	'FIELD_DESCRIPTION_EXPLAIN'	=> 'Cette description sera affichée à l’utilisateur.',
	'FIELD_DROPDOWN'			=> 'Liste déroulante',
	'FIELD_IDENT'				=> 'Identification du champ',
	'FIELD_IDENT_ALREADY_EXIST'	=> 'L’identification du champ choisie existe déjà. Saisissez un autre nom.',
	'FIELD_IDENT_EXPLAIN'		=> 'L’identification du champ est un nom qui vous permet d’identifier le champ de profil dans la base de données et les templates.',
	'FIELD_INT'					=> 'Nombres',
	'FIELD_IS_CONTACT'			=> 'Afficher le champ comme un champ de contact',
	'FIELD_IS_CONTACT_EXPLAIN'	=> 'Les champs de contact sont affichés dans la section contact du profil du membre et sont affichés différemment dans le mini-profil des messages et messages privés. Vous pouvez utiliser <samp>%s</samp> comme texte indicatif qui sera remplacé dès que l’utilisateur saisira une valeur.',
	'FIELD_LENGTH'				=> 'Taille de la zone de saisie',
	'FIELD_NOT_FOUND'			=> 'Le champ de profil est introuvable.',
	'FIELD_STRING'				=> 'Champ de texte simple',
	'FIELD_TEXT'				=> 'Zone de texte',
	'FIELD_TYPE'				=> 'Type de champ',
	'FIELD_TYPE_EXPLAIN'		=> 'Une fois défini, le type de champ ne pourra plus être changé.',
	'FIELD_URL'					=> 'URL (Lien)',
	'FIELD_VALIDATION'			=> 'Validation du champ',
	'FIRST_OPTION'				=> 'Première option',

	'HIDE_PROFILE_FIELD'			=> 'Masquer le champ de profil',
	'HIDE_PROFILE_FIELD_EXPLAIN'	=> 'Masque le champ de profil à tous les utilisateurs sauf pour les administrateurs et les modérateurs. Si l’option « Afficher dans le panneau de l’utilisateur » est désactivée, l’utilisateur ne pourra pas voir ou modifier ce champ, seuls les administrateurs le pourront.',

	'INVALID_CHARS_FIELD_IDENT'	=> 'L’identification du champ ne peut contenir que des minuscules a-z et _',
	'INVALID_FIELD_IDENT_LEN'	=> 'La longueur de l’identification du champ ne peut dépasser 17 caractères',
	'ISO_LANGUAGE'				=> 'Langue [%s]',

	'LANG_SPECIFIC_OPTIONS'		=> 'Options particulières à la langue [<strong>%s</strong>]',

	'LETTER_NUM_DOTS'			=> 'Toutes lettres, chiffres et points',
	'LETTER_NUM_ONLY'			=> 'Toutes lettres et chiffres',
	'LETTER_NUM_PUNCTUATION'	=> 'Toutes lettres, chiffres, virgules, points, tirets bas (underscores), tirets et commençant par une lettre',
	'LETTER_NUM_SPACERS'		=> 'Toutes lettres, chiffres et espaces',
	'LETTER_NUM_UNDERSCORE'		=> 'Toutes lettres, chiffres et tirets bas (underscore)',

	'MAX_FIELD_CHARS'		=> 'Nombre maximum de caractères',
	'MAX_FIELD_NUMBER'		=> 'Nombre maximal autorisé',
	'MIN_FIELD_CHARS'		=> 'Nombre minimum de caractères',
	'MIN_FIELD_NUMBER'		=> 'Nombre minimal autorisé',

	'NO_FIELD_ENTRIES'			=> 'Aucune entrée définie',
	'NO_FIELD_ID'				=> 'Aucun ID de champ indiqué.',
	'NO_FIELD_TYPE'				=> 'Aucun type de champ indiqué.',
	'NO_VALUE_OPTION'			=> 'Option égale à la valeur de non-saisie',
	'NO_VALUE_OPTION_EXPLAIN'	=> 'Valeur de non-saisie. Si le champ est obligatoire, une erreur est affichée lorsque cette valeur est saisie par l’utilisateur.',
	'NUMBERS_ONLY'				=> 'Uniquement des chiffres (0-9)',

	'PROFILE_BASIC_OPTIONS'		=> 'Options de base',
	'PROFILE_FIELD_ACTIVATED'	=> 'Le champ de profil a été activé.',
	'PROFILE_FIELD_DEACTIVATED'	=> 'Le champ de profil a été désactivé.',
	'PROFILE_LANG_OPTIONS'		=> 'Options particulières de langue',
	'PROFILE_TYPE_OPTIONS'		=> 'Options particulières du type de champ',

	'RADIO_BUTTONS'				=> 'Boutons radio',
	'REMOVED_PROFILE_FIELD'		=> 'Le champ de profil a été supprimé.',
	'REQUIRED_FIELD'			=> 'Champ obligatoire',
	'REQUIRED_FIELD_EXPLAIN'	=> 'Oblige l’utilisateur ou les administrateurs à remplir ou à préciser le champ. Si l’option « Afficher sur la page d’enregistrement » est désactivée, le champ sera seulement requis lorsque l’utilisateur modifiera son profil.',
	'ROWS'						=> 'Lignes',

	'SAVE'							=> 'Sauvegarder',
	'SECOND_OPTION'					=> 'Deuxième option',
	'SHOW_NOVALUE_FIELD'			=> 'Afficher le champ si aucune valeur n’a été sélectionnée',
	'SHOW_NOVALUE_FIELD_EXPLAIN'	=> 'Détermine si le champ de profil doit être affiché si aucune valeur n’a été sélectionnée pour les champs optionnels ou si aucune valeur n’est déjà sélectionnée pour les champs requis.',
	'STEP_1_EXPLAIN_CREATE'			=> 'Vous pouvez saisir les premiers paramètres de base du nouveau champ de profil. Ces informations sont requises pour la seconde étape où vous pourrez régler les options restantes et améliorer davantage votre champ de profil.',
	'STEP_1_EXPLAIN_EDIT'			=> 'Vous pouvez modifier les paramètres de base de votre champ de profil. Les options appropriées sont recalculées dans la seconde étape.',
	'STEP_1_TITLE_CREATE'			=> 'Ajouter un champ de profil',
	'STEP_1_TITLE_EDIT'				=> 'Modifier le champ de profil',
	'STEP_2_EXPLAIN_CREATE'			=> 'Vous pouvez définir quelques options courantes que vous pouvez vouloir ajuster.',
	'STEP_2_EXPLAIN_EDIT'			=> 'Vous pouvez modifier quelques options courantes.<br><strong>Notez que les modifications faites aux champs de profil n’affecteront pas les valeurs déjà saisies par les utilisateurs.</strong>',
	'STEP_2_TITLE_CREATE'			=> 'Options particulières du type de champ',
	'STEP_2_TITLE_EDIT'				=> 'Options particulières du type de champ',
	'STEP_3_EXPLAIN_CREATE'			=> 'Comme vous avez plus d’une langue installée, vous devez aussi traduire chacun des éléments dans chaque langue. En l’absence de traduction, les paramètres définis pour la langue par défaut de ce champ de profil personnalisé seront utilisés. Vous pourrez traduire ces éléments de langue ultérieurement.',
	'STEP_3_EXPLAIN_EDIT'			=> 'Comme vous avez plus d’une langue installée, vous pouvez maintenant modifier ou ajouter les éléments de langue restants. En l’absence de traduction, les paramètres définis pour la langue par défaut de ce champ de profil personnalisé seront utilisés.',
	'STEP_3_TITLE_CREATE'			=> 'Traduire le champ',
	'STEP_3_TITLE_EDIT'				=> 'Modifier les traductions',
	'STRING_DEFAULT_VALUE_EXPLAIN'	=> 'Saisissez une phrase à afficher comme valeur par défaut. Laissez vide si vous préférez ne pas afficher une valeur par défaut.',

	'TEXT_DEFAULT_VALUE_EXPLAIN'	=> 'Saisissez un texte à afficher comme valeur par défaut. Laissez vide si vous préférez ne pas afficher une valeur par défaut.',
	'TRANSLATE'						=> 'Traduire',

	'USER_FIELD_NAME'	=> 'Nom/titre du champ affiché à l’utilisateur',

	'VISIBILITY_OPTION'	=> 'Options de visibilité',
));
