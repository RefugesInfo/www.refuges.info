<?php
$numero = $controlleur->url_decoupee[3] ?: 0;
$where_list = [
	'accepte' => ' WHERE ext_error IS NULL AND mode != \'Rejeté\'',
	'rejete' => ' WHERE ext_error IS NOT NULL OR mode = \'Rejeté\'',
	'cleantalk' => ' WHERE ext_error NOT LIKE \'%security reasons%\' AND ext_error LIKE \'%CleanTalk%\'',
	'blockbotposts' => ' WHERE ext_error LIKE \'%security reasons%\' AND ext_error NOT LIKE \'%CleanTalk%\'',
	'les2' => ' WHERE ext_error LIKE \'%security reasons%\' OR ext_error LIKE \'%CleanTalk%\'',
	'nini' => ' WHERE ext_error IS NOT NULL AND ext_error NOT LIKE \'%security reasons%\' AND ext_error NOT LIKE \'%CleanTalk%\'',
	'topic' => ' WHERE topic_id = '.$numero,
	'post' => ' WHERE post_id = '.$numero,
	'point' => ' WHERE point_id = '.$numero,
	'commentaire' => ' WHERE commentaire_id = '.$numero,
];

// Hook ext/RefugesInfo/trace/listener.php liste des colonnes à afficher
$where = $where_list[$controlleur->url_decoupee[2]];
$traces_html = '';
$vars = ['where', 'traces_html'];
extract($phpbb_dispatcher->trigger_event('wri.list_traces', compact($vars)));

$vue->traces = $traces_html;
