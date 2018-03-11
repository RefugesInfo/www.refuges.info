<?php
/***
 * FIXME: A refaire au format MVC, là, c'est non fonctionnel vue que j'ai sauvegardé ça de coté dans le dossier des vues
 */

//$list = fopen("mails.txt", "a");

date_default_timezone_set('Europe/Paris');

//$string = date('d\/m\/Y H:i').','.$_POST['mail'].",".$_SERVER["REMOTE_ADDR"].";\r\n";

//$fwrite = fwrite($list, $string);
//if ($fwrite == false) {
    echo "Une erreur est survenue lors de l'enregistrement";
//}

//fclose ($list);

header('Location: index.html');

?>