<?php // File to be executed if the test environment supports PHP
if (count ($_POST))
	echo"<pre style='background-color:white;color:black;font-size:14px;'>PHP save return:\n\$_POST = ".var_export($_POST,true).'</pre>';

include ('index.html');
?>
