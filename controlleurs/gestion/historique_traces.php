<?php
// /gestion/historique_traces?xxx=aaa,!bbb&yyy=ccc,zzz=123
// => SELECT * FROM trace_requettes WHERE xxx LIKE '%aaa%' AND xxx NOT LIKE '%bbb%' AND yyy LIKE '%ccc%' AND zzz = 123

// Liste les colonnes pour ne prendre que les arguments qui correspondent
$col_names = [];
$sql = 'SELECT column_name FROM information_schema.columns WHERE table_name = \'trace_requettes\'';
$result = $db->sql_query ($sql);
while ($row = $db->sql_fetchrow($result))
	$col_names[] = $row['column_name'];
$db->sql_freeresult($result);

$conditions = [];
foreach ($_GET AS $k => $v)
	if (in_array ($k, $col_names) && $v)
		foreach (explode (',', $v) AS $vv) {
			$vvs = array_reverse (explode ('!', $vv));

			if ($vvs[0] == 'null')
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
$vars = ['where', 'traces_html'];
extract($phpbb_dispatcher->trigger_event('wri.affiche_traces', compact($vars)));

$vue->where = str_replace (
	['WHERE ', 'trace_requettes.', ' AND '],
	['', '', '</p><p>AND '],
	$where
);
$vue->traces = $traces_html;
$vue->limit_traces = $_GET['limit'] ?: 250;
