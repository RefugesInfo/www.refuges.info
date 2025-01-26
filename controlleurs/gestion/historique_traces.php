<?php
$conditions = [];
foreach ($_GET AS $k => $v)
	foreach (explode (',', $v) AS $vv) {
		$vvs = explode ('!', $vv);
		$val = $vvs[sizeof ($vvs) - 1];
		$not = $vv[0] === '!' ? 'NOT' : '';
		$conditions[] = $val ?
			"$k $not LIKE '%$val%'" :
			"$k IS $not NULL";
	}

$numero = $controlleur->url_decoupee[3] ?: 0;
$where_list = [
	'filtre' => ' WHERE '.implode (' AND ', $conditions),
	'accepte' => ' WHERE ext_error IS NULL AND mode != \'Rejeté\'',
	'rejete' => ' WHERE ext_error IS NOT NULL OR mode = \'Rejeté\'',
	'topic' => ' WHERE topic_id = '.$numero,
	'post' => ' WHERE post_id = '.$numero,
	'point' => ' WHERE point_id = '.$numero,
	'commentaire' => ' WHERE commentaire_id = '.$numero,
	'detail' => ' WHERE trace_id = '.$numero,
];

// Hook ext/RefugesInfo/trace/listener.php liste des colonnes à afficher
$where = $where_list[$controlleur->url_decoupee[2]];
$traces_html = '';
$vars = ['where', 'traces_html'];
extract($phpbb_dispatcher->trigger_event('wri.list_traces', compact($vars)));

$vue->traces = $traces_html;
