<?php
header("Content-disposition: filename=points-refuges-info.csv");
header("Content-Type: text/csv; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
headers_cors_par_default();

$separateur=";";

echo "#".$config_wri['copyright_API']."\r\n";
echo "id_point".$separateur."nom".$separateur."type".$separateur."altitude".$separateur."latitude".$separateur."longitude".$separateur."état".$separateur."nombre de place".$separateur."lien\r\n";

foreach ($points AS $point) {
	echo $point->id.$separateur.$point->nom.$separateur.$point->type['valeur'].$separateur.$point->coord['alt'].$separateur.$point->coord['lat'].$separateur.$point->coord['long'].$separateur.$point->etat['valeur'].$separateur.$point->places['valeur'].$separateur.$point->lien."\r\n";
}
