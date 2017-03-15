<?php // File to be executed if the test environment supports PHP
if (count ($_POST))
	echo"<pre style='background-color:white;color:black;font-size:14px;'>PHP save return:\n\$_POST = ".var_export($_POST,true).'</pre>';

include ('index.html');
?>

<a href="v0.7.html"
   style="position:absolute;top:150px;right:0;text-decoration:none;font-size:large"
   title="Test on Leaflet V0.7">
	&#10144;
</a>

<a href="index.html"
   style="position:absolute;top:200px;right:0;text-decoration:none;font-size:large"
   title="Test en mode html">
	&#10144;
</a>
