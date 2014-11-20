<?php 
// Etant donné que la majorité des config apache cherche un tel fichier, je le créé juste comme un redirecteur, même si
// il serait sans doute préférable de s'en passer pour la "beauté de la cohérence"
// 27/10/2014 : sly, pourtant c'est moi qui ait écrit ça, mais je ne comprends pas pourquoi on ne pourrait pas effacer ce fichier ?
// il y a un rewrite qui fait tout pointer vers routage.php pourquoi l'index aurait il un traitement spécial ?

include("routage.php");
?>