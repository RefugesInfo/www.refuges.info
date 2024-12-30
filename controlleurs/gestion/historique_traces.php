<?php
$where_list = [
	'accepte' => ' WHERE mode <> \'Rejeté\'',
	'rejete' => ' WHERE mode = \'Rejeté\'',
];

// Hook ext/RefugesInfo/trace/listener.php liste des colonnes à afficher
$where = $where_list[$controlleur->url_decoupee[2]];
$traces_html = '';
$vars = ['where', 'traces_html'];
extract($phpbb_dispatcher->trigger_event('wri.list_traces', compact($vars)));

$vue->traces = $traces_html;
