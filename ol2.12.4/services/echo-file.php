<?php //DCM++ © Dominique Cavailhez 2012
// Pour enregistrement local des fichiers GPX
header('Content-type: application/xml+gpx');
header('Content-Disposition: attachment; filename="'.$_GET['filename'].'"');
echo $_POST['data'];
?>