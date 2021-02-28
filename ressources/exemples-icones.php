<style>
body {
    background: linear-gradient(45deg, #fff 25%, #aaa 25%, #aaa 50%, #fff 50%, #fff 75%, #aaa 75%);
	background-size: 6px 6px;
}
</style>

<h1>Exemples d'icônes SVG et PNG générées en PHP</h1>
<?php

include_once ('../includes/config.php');

foreach (array_keys ($config_wri['definition_icones']) AS $nom) { ?>
	<p>
		<img src="../images/icones/<?=$nom?>.svg" />
		<a href="../images/icones/<?=$nom?>.svg">
			/images/icones/<?=$nom?>.svg</a>
		&nbsp; &nbsp;
		<img src="../images/icones/<?=$nom?>.png" />
		<a href="../images/icones/<?=$nom?>.png">
			/images/icones/<?=$nom?>.png</a>
	</p>
<?php } ?>
