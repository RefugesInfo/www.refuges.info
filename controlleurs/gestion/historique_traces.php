<?php
// /gestion/historique_traces?xxx=aaa,!bbb&yyy=ccc,zzz=123
// => SELECT * FROM trace_requettes WHERE xxx LIKE '%aaa%' AND xxx NOT LIKE '%bbb%' AND yyy LIKE '%ccc%' AND zzz = 123

$conditions = [];
foreach ($_GET AS $k => $v)
	if ($k != 'limit')
		foreach (explode (',', $v) AS $vv) {
			$vvs = array_reverse (explode ('!', $vv));

			if (!$vvs[0])
				$conditions[] = "trace_requettes.$k IS".(isset ($vvs[1]) ? ' NOT' : '')." NULL";
			elseif (is_numeric ($vvs[0]))
				$conditions[] = "trace_requettes.$k ".(isset ($vvs[1]) ? '!' : '')."= {$vvs[0]}";
			else
				$conditions[] = "trace_requettes.$k".(isset ($vvs[1]) ? ' NOT' : '')." LIKE '%{$vvs[0]}%'";
		}

if (count ($conditions))
	$where = ' WHERE '.implode (' AND ', $conditions);

// Hook ext/RefugesInfo/trace/listener.php liste des colonnes à afficher
$traces_html = '';
$limit = $_GET['limit'] ?: 250;
$vars = ['where', 'traces_html', 'limit'];
extract($phpbb_dispatcher->trigger_event('wri.list_traces', compact($vars)));

$vue->where = str_replace (
	['WHERE ', 'trace_requettes.', ' AND '],
	['', '', '</p><p>AND '],
	$where
);
$vue->traces = $traces_html;
$vue->limit_traces = $limit;
