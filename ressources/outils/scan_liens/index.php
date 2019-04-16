<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

define('IN_PHPBB', true);
$phpbb_root_path =  '../../../forum/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('viewforum');

// Vérification autorisation niveau modérateur
if (!$auth->acl_get('f_read', 7)) { // Le forum des modérateurs
	echo 'Vous n\'ètes pas autorisé à accéder à ce lien';
	exit;
}

echo "Cet utilitaire permet de visualiser tous les liens compris dans certains champs de la base<br/>
Les actions possibles sont :<br/>
- Valider le domaine du lien : tous les liens de même domaine ne seront plus listés<br/>
- Accésder aux pages de modération de refuges.info<br/>
Cet utilitaire en lui même n'apporte pas de modifications à refuges.info<hr/>";

// Liste des recherches
$types = [
	'phpbb_posts' => "
		SELECT post_id,topic_id,forum_id,poster_ip AS ip,
		poster_id AS user_id,
		post_text AS texte
		FROM phpbb3_posts
		WHERE post_text LIKE '%http://%'
		OR post_text LIKE '%https://%'",
	'commentaires' => "
		SELECT id_commentaire,id_point,auteur_commentaire,id_createur_commentaire,
		id_createur_commentaire AS user_id,
		texte
		FROM commentaires
		WHERE texte LIKE '%http://%'
		OR texte LIKE '%https://%'
		ORDER BY id_createur_commentaire DESC",
	'users_signatures' => "
		SELECT user_id,username,user_email,user_sig,phpbb3_users.user_sig AS texte
		FROM phpbb3_users
		WHERE user_sig LIKE '%http://%'
		OR user_sig LIKE '%https://%'",
];


// Récupération des paramètres _GET de l'url
$data_file = 'nosqldata.txt';
$script_name = str_replace ('/', '', $request->server ('SCRIPT_NAME', ''));
$type = request_var ('type', array_keys($types)[0]);
$nb = request_var ('nb', '5');
$script_url = "$script_name?type=$type&nb=$nb";

// Ajout d'une ligne à la fin de ce fichier
$list = request_var ('list', '');
if ($list) {
	file_put_contents ($data_file, PHP_EOL.$list, FILE_APPEND);
	echo "<meta http-equiv='refresh' content='0;url=$script_url'>";
	exit;
}

// Lecture des domaines autorisés (en fin de ce fichier)
$gfc = explode (PHP_EOL, file_get_contents ($data_file));
$urlok = [];
$urlmort = [];
foreach ($gfc AS $v)
	switch ($v[0]) {
		case 'A':
			$urlok [substr ($v, 1)] = substr ($v, 1);
			unset ($urlmort [substr ($v, 1)]);
			break;
		case 'M':
			$urlmort [substr ($v, 1)] = substr ($v, 1);
			unset ($urlok [substr ($v, 1)]);
			break;
		case 'D':
			unset ($urlok [substr ($v, 1)]);
			unset ($urlmort [substr ($v, 1)]);
			break;
	}

echo '<table><tr><td valign="top" style="white-space:nowrap">';
echo '<b>Liste des sites reconnus sûrs :</b><br/>';
foreach ($urlok AS $v)
	echo "<a target='_BLANK' title='Voir ce site' href='http://$v'>$v</a> =>
		<a title='Retirer ce site de la liste autorisée' href='$script_url&list=D$v'>oublier</a><br/>";

echo '<hr/><b>Liste des sites reconnus morts :</b><br/>';
foreach ($urlmort AS $v)
	echo "<a target='_BLANK' title='Voir ce site' href='http://$v'>$v</a> =>
		<a title='Retirer ce site de la liste des liens morts' href='$script_url&list=D$v'>oublier</a><br/>";
echo '</td><td>';

// Choix de la recherche à faire
echo "Type d'infos à scanner :
<form action='$script_name' style='display:inline'>
<select onchange='this.form.submit()' name='type'>";
	foreach ($types AS $k=>$v)
		echo "<option ".($type==$k?'selected="selected"':'').">$k</option>";
echo "</select>,
nombre présenté :
<input type='number'value='$nb' name='nb' min='5' max='100' />
<input type='submit'/>
</form>";

$result = $db->sql_query($types[$type]);
while ($nb > 0 && $row = $db->sql_fetchrow($result)) {
	$row['texte'] = preg_replace  ('/[[:cntrl:]]/', '', $row['texte']);
	preg_match ('/h[tps]+\:\/\/([^\/^\[^\]^\"]+)[^\<^\[^\]^\"^\s^[:cntrl:]]*/', $row['texte'], $match);
	if (count ($match) && !in_array ($match[1], $urlok) && !in_array ($match[1], $urlmort)) {
		echo "<hr/>";

		echo "Lien suspect : <a target='_BLANK' href='{$match[0]}'>{$match[0]}</a><br/>";

		if ($row['user_sig'])
			echo "Signature à examiner : {$row['user_sig']}<br/>";

		echo "Site : <a target='_BLANK' title='Voir ce site' href='http://{$match[1]}'>{$match[1]}</a>
		=> <a title='Ajouter {$match[1]} à la liste autorisée' href='$script_url&list=A{$match[1]}'>autoriser</a> ou
		<a title='Ajouter {$match[1]} à la liste des liens morts' href='$script_url&list=M{$match[1]}'>déclarer ce site inexistant</a><br/>";

		if ($row['post_id'])
			echo "Commentaire à examiner (et modérer si besoin) =>
		<a target='_BLANK' href='forum/posting.php?mode=edit&f={$row['forum_id']}&p={$row['post_id']}'>Modérer le message</a><br/>";

		if ($row['id_commentaire'])
			echo "Commentaire à examiner : {$row['user_sig']} =>
			<a target='_BLANK' href='gestion/moderation?id_point_retour={$row['id_point']}&id_commentaire={$row['id_commentaire']}'>Modérer le commentaire</a><br/>";

		// Analyse de l'auteur
		if ($row['user_id'] > 1 ) {
			$result_user = $db->sql_query("
				SELECT user_id,username,user_email
				FROM phpbb3_users
				WHERE user_id = ".$row['user_id']);
			$row_user = $db->sql_fetchrow($result_user);
			$result_ip = $db->sql_query("
				SELECT poster_ip
				FROM phpbb3_posts
				WHERE poster_ip IS NOT NULL AND
					poster_id = ".$row['user_id']."
				ORDER BY post_time DESC
				LIMIT 1");
			$row_ip = $db->sql_fetchrow($result_ip);
		}
		echo "Auteur : ".($row_user['user_id'] > 1 ?
			"{$row_user['username']} ({$row_user['user_email']}) =>
			<a target='_BLANK' title='Voir et modérer l auteur' href='forum/memberlist.php?mode=viewprofile&u={$row_user['user_id']}'>voir le profil et modérer</a>" :
			"{$row_user['username']}"
		);
		echo"<pre style='background-color:white;color:black;font-size:14px;'>USER = ".var_export($row_user,true).'</pre>';

		if ($row_ip['poster_ip'])
			echo "<pre style='background-color:white;color:black;font-size:14px;'>IP = ".var_export(json_decode(file_get_contents("https://www.iplocate.io/api/lookup/{$row_ip['poster_ip']}")),true)."</pre>";

		// Dump de l'enregistrement
		echo "<pre style='background-color:white;color:black;font-size:14px;'>DATA = ".var_export($row,true).'</pre>';
		$nb--;
	}
}

echo '</td></tr></table>';
