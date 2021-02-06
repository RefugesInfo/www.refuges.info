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
	'ACP_SEARCH_INDEX_EXPLAIN'				=> 'Vous pouvez gérer les méthodes d’indexation de la recherche. Comme le moteur de recherche n’utilise qu’une seule méthode d’indexation, vous devriez supprimer toutes les indexations inutilisées. Après la modification de certains paramètres de recherche (comme le nombre minimum/maximum de caractères), il serait préférable de recréer l’index pour qu’il prenne en compte ces modifications.',
	'ACP_SEARCH_SETTINGS_EXPLAIN'			=> 'Vous pouvez définir quelle méthode d’indexation de recherche sera utilisée pour l’indexation des messages et l’exécution des recherches. Vous pouvez définir différentes options qui peuvent influencer sur la puissance de calcul requise. Certains de ces paramètres sont les mêmes pour toutes les méthodes d’indexation du moteur de recherche.',

	'COMMON_WORD_THRESHOLD'					=> 'Seuil de mot commun',
	'COMMON_WORD_THRESHOLD_EXPLAIN'			=> 'Si un mot est contenu dans un nombre de messages supérieur au pourcentage indiqué, ce mot sera défini comme commun. Ces mots seront par la suite ignorés lors des recherches. Mettre « 0 » pour désactiver cette option. Cette option ne fonctionne que s’il y a plus de 100 messages sur votre forum. Si vous voulez que les mots actuellement considérés comme communs soient reconsidérés, vous devez recréer l’index.',
	'CONFIRM_SEARCH_BACKEND'				=> 'Voulez-vous réellement changer la méthode d’indexation ? Vous devrez recréer un index de recherche pour la nouvelle méthode. Si vous ne prévoyez pas de réutiliser l’ancienne méthode d’indexation vous pouvez la supprimer pour libérer des ressources système.',
	'CONTINUE_DELETING_INDEX'				=> 'Continuer le précédent processus de suppression de l’index',
	'CONTINUE_DELETING_INDEX_EXPLAIN'		=> 'Une suppression d’index de recherche a été commencée. Celle-ci doit être terminée ou annulée pour pouvoir accéder à la page de recherche.',
	'CONTINUE_INDEXING'						=> 'Continuer le précédent processus d’indexation',
	'CONTINUE_INDEXING_EXPLAIN'				=> 'Un processus d’indexation a été commencé. Celui-ci doit être terminé ou annulé pour pouvoir accéder à la page de recherche.',
	'CREATE_INDEX'							=> 'Créer l’index de recherche',

	'DEFAULT_SEARCH_RETURN_CHARS'			=> 'Nombre par défaut de caractères à renvoyer',
	'DEFAULT_SEARCH_RETURN_CHARS_EXPLAIN'	=> 'Correspond au nombre de caractères qui sera renvoyé lors de la recherche. Une valeur définie à 0 renverra l’intégralité du message.',
	'DELETE_INDEX'							=> 'Supprimer l’index de recherche',
	'DELETING_INDEX_IN_PROGRESS'			=> 'Suppression de l’index de recherche.',
	'DELETING_INDEX_IN_PROGRESS_EXPLAIN'	=> 'La méthode d’indexation de la recherche est en train de vider son index. Cela peut prendre quelques minutes.',

	'FULLTEXT_MYSQL_INCOMPATIBLE_DATABASE'	=> 'L’indexation FULLTEXT de MySQL ne peut être utilisée qu’avec MySQL version 4 ou supérieure.',
	'FULLTEXT_MYSQL_NOT_SUPPORTED'			=> 'Les indexations FULLTEXT de MySQL ne peuvent être utilisées qu’avec les tables MyISAM ou InnoDB. MySQL version 5.6.8 ou supérieure est requise pour les index FULLTEXT dans les tables InnoDB.',
	'FULLTEXT_MYSQL_TOTAL_POSTS'			=> 'Nombre total de messages indexés',
	'FULLTEXT_MYSQL_MIN_SEARCH_CHARS_EXPLAIN'	=> 'Les mots comportant ce nombre de caractères seront indexés pour la recherche. Il n’y a que vous ou votre hébergeur qui puissiez changer la configuration de MySQL.',
	'FULLTEXT_MYSQL_MAX_SEARCH_CHARS_EXPLAIN'	=> 'Les mots ne dépassant pas ce nombre de caractères seront indexés pour la recherche. Il n’y a que vous ou votre hébergeur qui puissiez changer la configuration de MySQL.',

	'FULLTEXT_POSTGRES_INCOMPATIBLE_DATABASE'	=> 'L’indexation FULLTEXT de PostgreSQL ne peut être utilisée qu’avec PostgreSQL.',
	'FULLTEXT_POSTGRES_TOTAL_POSTS'				=> 'Nombre total de messages indexés',
	'FULLTEXT_POSTGRES_VERSION_CHECK'			=> 'Version de PostgreSQL',
	'FULLTEXT_POSTGRES_TS_NAME'					=> 'Profil de configuration de recherche de texte :',
	'FULLTEXT_POSTGRES_MIN_WORD_LEN'			=> 'Longueur minimale des mots-clés',
	'FULLTEXT_POSTGRES_MAX_WORD_LEN'			=> 'Longueur maximale des mots-clés',
	'FULLTEXT_POSTGRES_VERSION_CHECK_EXPLAIN'	=> 'Cette indexation de la recherche nécessite PostgreSQL version 8.3 ou supérieure.',
	'FULLTEXT_POSTGRES_TS_NAME_EXPLAIN'			=> 'Le profil de configuration de recherche de texte est utilisé pour déterminer l’analyseur syntaxique et le dictionnaire.',
	'FULLTEXT_POSTGRES_MIN_WORD_LEN_EXPLAIN'	=> 'Les mots ayant un nombre de caractères supérieur à cette valeur seront inclus dans le résultat de la recherche.',
	'FULLTEXT_POSTGRES_MAX_WORD_LEN_EXPLAIN'	=> 'Les mots inférieurs à ce nombre de caractères seront inclus dans la requête à la base de données.',

	'FULLTEXT_SPHINX_CONFIGURE'				=> 'Configurez les paramètres suivants pour générer un fichier de configuration Sphinx',
	'FULLTEXT_SPHINX_DATA_PATH'				=> 'Chemin d’accès au répertoire de données',
	'FULLTEXT_SPHINX_DATA_PATH_EXPLAIN'		=> 'Il sera utilisé pour stocker les fichiers des index et des journaux. Vous devriez créer ce répertoire en dehors des répertoires Web accessibles (doit avoir une barre oblique « / »).',
	'FULLTEXT_SPHINX_DELTA_POSTS'			=> 'Nombre de messages dans l’index « delta » (fréquemment mis à jour)',
	'FULLTEXT_SPHINX_HOST'					=> 'Hôte du démon « Recherche Sphinx »',
	'FULLTEXT_SPHINX_HOST_EXPLAIN'			=> 'Hôte sur lequel le démon « searchd » (recherche sphinx) écoute. Laissez vide pour utiliser par défaut « localhost ».',
	'FULLTEXT_SPHINX_INDEXER_MEM_LIMIT'		=> 'Mémoire limite d’indexation',
	'FULLTEXT_SPHINX_INDEXER_MEM_LIMIT_EXPLAIN'	=> 'Ce nombre devrait toujours être inférieur à la mémoire vive (RAM) disponible sur votre serveur. Si vous rencontrez des problèmes de performance récurrents, cela pourrait être dû à une trop forte consommation de ressources par l’indexeur. Essayez de réduire la quantité de mémoire allouée à l’indexeur.',
	'FULLTEXT_SPHINX_MAIN_POSTS'			=> 'Nombre de messages dans l’index principal',
	'FULLTEXT_SPHINX_PORT'					=> 'Port du démon « Recherche Sphinx »',
	'FULLTEXT_SPHINX_PORT_EXPLAIN'			=> 'Port sur lequel le démon « searchd » (recherche sphinx) écoute. Laissez vide pour utiliser Sphinx API port 9312 par défaut.',
	'FULLTEXT_SPHINX_WRONG_DATABASE'		=> 'La recherche Sphinx pour phpBB supporte uniquement MySQL et PostgreSQL.',
	'FULLTEXT_SPHINX_CONFIG_FILE'			=> 'Fichier de configuration Sphinx',
	'FULLTEXT_SPHINX_CONFIG_FILE_EXPLAIN'	=> 'Contenu généré pour le fichier de configuration du moteur de recherche Sphinx. Ces informations doivent être copiées et collées dans le fichier intitulé « sphinx.conf » qui est utilisé par le démon de Sphinx. Remplacez dans le code les occurrences de « [dbuser] » et « [dbpassword] » par leur valeur, permettant de s’identifier sur votre base de données.',
	'FULLTEXT_SPHINX_NO_CONFIG_DATA'		=> 'Le chemin du répertoire de données Sphinx n’est pas défini. Merci de le définir afin de pouvoir générer le fichier de configuration.',

	'GENERAL_SEARCH_SETTINGS'				=> 'Paramètres généraux de recherche',
	'GO_TO_SEARCH_INDEX'					=> 'Aller à la page « Index de la recherche »',

	'INDEX_STATS'							=> 'Statistiques de l’index',
	'INDEXING_IN_PROGRESS'					=> 'Indexation en cours',
	'INDEXING_IN_PROGRESS_EXPLAIN'			=> 'La méthode d’indexation de la recherche est actuellement en train d’indexer tous les messages du forum. Cela peut prendre de quelques minutes à quelques heures selon la taille de votre forum.',

	'LIMIT_SEARCH_LOAD'						=> 'Limite de la charge système de la recherche',
	'LIMIT_SEARCH_LOAD_EXPLAIN'				=> 'Si la charge du système dépasse cette valeur durant une minute, la recherche sera désactivée, une valeur à 1.0 équivaut environ à 100% d’utilisation d’un processeur. Cela fonctionne uniquement sur les serveurs basés sous UNIX.',

	'MAX_SEARCH_CHARS'						=> 'Caractères maximum indexés par la recherche',
	'MAX_SEARCH_CHARS_EXPLAIN'				=> 'Seuls les mots inférieurs ou égaux à ce nombre de caractères seront indexés.',
	'MAX_NUM_SEARCH_KEYWORDS'				=> 'Nombre maximum de mots clés autorisés',
	'MAX_NUM_SEARCH_KEYWORDS_EXPLAIN'		=> 'Nombre maximum de mots que l’utilisateur est capable de rechercher. Une valeur à « 0 » autorise un nombre illimité de mots.',
	'MIN_SEARCH_CHARS'						=> 'Caractères minimum indexés par la recherche',
	'MIN_SEARCH_CHARS_EXPLAIN'				=> 'Seuls les mots supérieurs ou égaux à ce nombre de caractères seront indexés.',
	'MIN_SEARCH_AUTHOR_CHARS'				=> 'Caractères minimum du nom de l’auteur',
	'MIN_SEARCH_AUTHOR_CHARS_EXPLAIN'		=> 'Les utilisateurs doivent saisir au moins ce nombre de caractères pour effectuer une recherche par auteur avec un joker (*). Si le nom d’auteur est plus court que ce nombre vous pourrez tout de même rechercher ses messages en saisissant son nom complet.',

	'PROGRESS_BAR'							=> 'Barre de progression',

	'SEARCH_GUEST_INTERVAL'					=> 'Intervalle de flood des invités',
	'SEARCH_GUEST_INTERVAL_EXPLAIN'			=> 'Nombre de secondes que les invités doivent attendre entre chaque recherche. Si un invité lance une recherche, tous les autres doivent attendre que ce délai soit écoulé.',
	'SEARCH_INDEX_CREATE_REDIRECT'			=> array(
		2	=> 'Tous les messages jusqu’à l’ID de message %2$d ont été indexés, un lot de %1$d messages a été traité.<br>',
	),
	'SEARCH_INDEX_CREATE_REDIRECT_RATE'		=> array(
		2	=> 'Le taux actuel d’indexation est de %1$.1f messages par seconde.<br>Indexation en cours…',
	),
	'SEARCH_INDEX_DELETE_REDIRECT'			=> array(
		2	=> 'Tous les messages jusqu’à l’ID de message %2$d ont été effacés de l’index de recherche, un lot de %1$d messages a été traité.<br>',
	),
	'SEARCH_INDEX_DELETE_REDIRECT_RATE'		=> array(
		2	=> 'Le taux actuel de suppression est de %1$.1f messages par seconde.<br>Suppression en cours…',
	),
	'SEARCH_INDEX_CREATED'					=> 'Tous les messages du forum ont été indexés.',
	'SEARCH_INDEX_REMOVED'					=> 'L’index de recherche a été supprimé.',
	'SEARCH_INTERVAL'						=> 'Intervalle de flood des utilisateurs',
	'SEARCH_INTERVAL_EXPLAIN'				=> 'Nombre de secondes que les utilisateurs doivent attendre entre chaque recherche. Cet intervalle est contrôlé indépendamment pour chaque utilisateur.',
	'SEARCH_STORE_RESULTS'					=> 'Durée de la mise en cache des résultats',
	'SEARCH_STORE_RESULTS_EXPLAIN'			=> 'Les résultats de la recherche mis en cache expireront après cette durée, en secondes. Mettre « 0 » pour désactiver la mise en cache de la recherche.',
	'SEARCH_TYPE'							=> 'Méthode d’indexation de la recherche',
	'SEARCH_TYPE_EXPLAIN'					=> 'phpBB vous permet de choisir la méthode d’indexation utilisée pour la recherche de texte dans le contenu des messages. Par défaut, la recherche utilisera la recherche FULLTEXT de phpBB.',
	'SWITCHED_SEARCH_BACKEND'				=> 'Vous avez modifié la méthode d’indexation de la recherche. Afin d’utiliser la nouvelle méthode d’indexation, vous devrez vous assurer qu’il existe bien un index de recherche pour celle-ci.',

	'TOTAL_WORDS'							=> 'Nombre total de mots indexés',
	'TOTAL_MATCHES'							=> 'Nombre total de mots indexés en relation avec les messages',

	'YES_SEARCH'							=> 'Activer la fonction de recherche',
	'YES_SEARCH_EXPLAIN'					=> 'Active la fonctionnalité de recherche, ce qui inclut la recherche des membres.',
	'YES_SEARCH_UPDATE'						=> 'Activer la mise à jour de FULLTEXT',
	'YES_SEARCH_UPDATE_EXPLAIN'				=> 'Met à jour les index de FULLTEXT lors de la publication de messages, ignoré si la recherche est désactivé.',
));
