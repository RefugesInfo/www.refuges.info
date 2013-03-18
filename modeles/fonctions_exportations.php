<?php
/**********************************************************************************************
ensemble de fonctions utilisables pour exporter des points de la  
base dans différents formats et rangement dans des fonctions et modularisation du tout         
tvx compatibilité feedvalidator.org, dans le but d'importer le    
format KML dans le nav sat modif fct c() et rajout de cette fct c() un peu partout           
rajout d'un ID dans Placemark passage des styles dans l'entete pour accelerer                   
entete GPX passé de ISO-8859 a utf8 re-passage en iso-8859-1 pour le kml et le gpx                    
les formats gpx sont maintenant mieux supporté un peu partout     
Ajouts pour affichage d'une couche KML sur Openlayers             
Changements dans le format KML -IconStyle- pour s'adapter à la taille des icones -gx:w- ...
Introduction du format GML
Séparation des points proches
re--re-passage en UTF-8 pour le kml et le gpx suite à la convertion de notre base à cet encodage

14/02/13 jmb-> ca fait assez peur. je m'en rendais pas compte en codant a la mano. on mets GeoPHP ?
Pas d'avis tranché -- sly
***********************************************************************************************/
require_once ("config.php");
require_once ("fonctions_bdd.php");
require_once ("fonctions_mise_en_forme_texte.php");
require_once ("fonctions_zip.php");
require_once ("fonctions_polygones.php");

/* Tableau de définition des formats et de leur caractéristiques, sur-ajoutés, à la variable $config
L'ordre d'apparition donnera l'ordre dans le menu de sélection de l'exportation
Si interne est placé à true, ce format ne sera pas proposé dans nos interfaces de sélection à l'export mais reste disponible
de façon "intere", c'est dire pour un usage javascript ou pour partenaire
sly 17/11/10
*/
//------------------------------------------
$config['formats_exportation']['kmz']=array(
"description_courte"=>"kmz (googlearth compressé)",
"extension_fichier"=>"kmz",
"content_type"=>"application/vnd.google-earth.kmz",
"interne"=>false,
"description"=>"<h4>Le format <abbr title='Keyhole Markup language Zipped'>KMZ</abbr></h4>
<p>
Le format d'export \"kmz\" est le format natif de GoogleEarth dans une version compressée avec zip
Le logiciel GoogleEarth est disponible ici gratuitement :<a href=\"http://earth.google.com/\">GoogleEarth</a>
</p>"
);

//------------------------------------------
$config['formats_exportation']['kml']=array(
"description_courte"=>"kml (googlearth)",
"extension_fichier"=>"kml",
"content_type"=>"application/vnd.google-earth.kml",
"interne"=>false,
"description"=>"<h4>Le format <abbr title='Keyhole Markup Language'>KML</abbr></h4>
<p>
Le format d'export \"kml\" est le format natif de Google Earth
Le logiciel GoogleEarth est disponible ici gratuitement :<a href=\"http://earth.google.com/\">GoogleEarth</a>
</p>
");

//------------------------------------------
// Dominique 14/11/10
$config['formats_exportation']['gml']=array(
"description_courte"=>"gml (Geography Markup Language)",
"extension_fichier"=>"xml",
"content_type"=>"text/xml",
"interne"=>false,
"description"=>"<h4>Le format <abbr title='Geography Markup Language'>GML</abbr></h4>
<p>
Le Geography Markup Language (GML) est un langage dérivé du XML pour encoder, manipuler et échanger des données géographiques.
C'est un standard développé par l'<a href=\"http://www.opengeospatial.org/\">Open Geospatial Consortium</a>.
</p>
");

//------------------------------------------
$config['formats_exportation']['gpx']=array(
"description_courte"=>"GPS (gpx)",
"extension_fichier"=>"gpx",
"content_type"=>"application/gpx",
"interne"=>false,
"description"=>"<h4>Le format <abbr title='GPS eXchange Format'>GPX</abbr></h4>
<p>
Le format d'export \"gpx\" (GPS eXchange Format) est un format de fichier permettant l'échange de coordonnées GPS.
</p>");

//------------------------------------------
$config['formats_exportation']['gpx-garmin']=array(
"description_courte"=>"GPS (gpx simplifié)",
"extension_fichier"=>"gpx",
"content_type"=>"application/gpx",
"interne"=>false,
"description"=>"<h2>Le format <abbr title='GPs eXchange format'>GPX</abbr> ( pour Garmin )</h2>
<p>
Le format \"gpx\" est en phase de devenir un standard pour transférer des points, des routes et des traces GPS.
Il a le grand avantage d'être lu par une multitude de logiciel GPS et peut ensuite être converti pour être entré
dans un terminal GPS.
</p>
<p>
Cette version, par rapport à la version complète n'inclus que peu d'information mais permet d'être plus légère a utiliser.
</p>
<h5>Dans ce format vous trouverez les données suivantes :</h5>
<p>
latitude, longitude, altitude, nom du point
</p>");

$config['formats_exportation']['gpi']=array(
"description_courte"=>"Garmin points d'intérêts",
"extension_fichier"=>"gpi",
"content_type"=>"application/binary",
"interne"=>false,
"description"=>"<h4>Le format <abbr title='Garmin Point of Interest'>GPI</abbr> pour GPS garmin</h4>
<p>
Le format \"gpi\" est un format spécifique à la gamme de terminaux GPS garmin
</p>
<h5>Dans ce format vous trouverez les données :</h5>
<p>
latitude,longitude,nom.
</p>
<p>
Pour l'utiliser sur votre GPS garmin :<br />
# Connecter le GPS en \"mass storage mode\" ( Ça devrait être quelque chose comme Setup->Interface->USB Mass Storage )<br />
# Placer le fichier refuges.gpi dans le dossier poi dans le dossier garmin ( les créer s'ils n'existent pas )<br />
</p>");

//------------------------------------------
$config['formats_exportation']['csv']=array(
"description_courte"=>"csv (tableurs)",
"extension_fichier"=>"csv",
"content_type"=>"text/csv",
"interne"=>false,
"description"=>"<h4>Le format <abbr title='Comma Separated Values'>CSV</abbr></h4>
<p>
Le format \"csv\" est un grand classique pour partager des données, il est très simple d'utilisation et peut être lu par un tableur
ou pour un traitement informatisé. Il est moins performant que gpx mais peut s'avérer utile
</p>
<p>
Il s'agit en fait d'un fichier texte dont les champs de données sont séparés par des ;
<p>
<h5>Dans ce format vous trouverez les données suivantes dans l'ordre :</h5>
<p>
id_point;nom;type;massif;altitude;latitude;longitude;qualité GPS;nombre de place
</p>");


//**********************************************************************************************
function liste_icones_possibles()
{
	global $pdo;
	$q_select_type= "SELECT * FROM point_type";
	$res = $pdo->query($q_select_type);
	while ( $ptype = $res->fetch() )
	{
		if ($ptype->nom_icone!="")
			$icones[]=$ptype->nom_icone;
		if ($ptype->nom_icone_ferme!="")
			$icones[]=$ptype->nom_icone_ferme;
		if ($ptype->nom_icone_sommaire!="")
			$icones[]=$ptype->nom_icone_sommaire;
	}

	return $icones;
}

//**********************************************************************************************
// retourne l'entête xml pour un kml de googleearth
function entete_kml()
{
  // En-tete du fichier kml   
  global $config;

  $_xml_tete  ="<?xml version=\"1.0\" encoding=\"".$config['encodage_exportation']."\"?>
<kml xmlns=\"http://earth.google.com/kml/2.1\">
<Document>
	<name>".$config['nom_fichier_export'].".kml</name>
	<description>Points provenants du site ".$config['nom_hote']."</description>
	<open>1</open>
	<!-- Fin de l'entete KML ! -->
	<!-- Place a la liste des Styles : -->
";

  // création de liste des styles pour chaque icone possible, le nom du style est #icone_(nom de l'image)
  // sly 30/10/10
  foreach (liste_icones_possibles() as $nom_icone)
  {
    $lien_icone = "http://".$config['nom_hote'].$config['url_chemin_icones'].$nom_icone . '.png';

    $tx = $ty = 16; // La plupart des icones
	    
  $_xml_tete .= "
	<Style id='icone_$nom_icone'>
		<IconStyle>
		<hotSpot x='0.5' y='0.5' xunits='fraction' yunits='fraction' />
		<scale>1</scale>
			<Icon>
				<href>$lien_icone</href>
				<w>$tx</w>
				<h>$ty</h>
			</Icon>
   		</IconStyle>
   	</Style>";
  }
  $_xml_tete .= "
  <!-- Fin des Styles ! -->
  <!-- Place a la liste des POINTS : -->";
  
  return $_xml_tete;
}

//**********************************************************************************************
//retourne une entité xml correspondant à un point
//$point est un objet contenant toute les propriétés du point
function placemark_kml($point)
{
  global $config;
  $lien_url = lien_point_fast($point);
  
  //Creation du XML pour un point 
  $_xml ="\n  <Placemark id='$point->id_point'>\n";
  $_xml .="    <name>".c($point->nom)."</name>\n";
  $_xml .="    <description><![CDATA[
  <img src='http://".$config['nom_hote'].$config['url_chemin_icones'].$point->nom_icone.".png' />
  (<em>".c($point->nom_type)."</em>) <br />
  <center><a href='$lien_url'>".c('Détails')."</a></center>
  ]]></description>\n";
  
  //CAMERA : basique pour le moment, à améliorer
  $lon_cam = $point->longitude+0.0002;     //on se decale un peu
  $lat_cam = $point->latitude+0.0008;
  $range_cam = $point->altitude + 5500; // on se place 5500mau dessus du point
  $tilt_cam  = 40;              // on prend de l'angle autour de la verticale
  $heading_cam  = 50;           // on prend de l'angle autour de l'horizontale
  
  $_xml .= "    <LookAt>\n";
  $_xml .= "     <longitude>$lon_cam</longitude>\n";
  $_xml .= "     <latitude>$lat_cam</latitude>\n";
  $_xml .= "     <range>$range_cam</range>\n";
  $_xml .= "     <tilt>$tilt_cam</tilt>\n";
  $_xml .= "     <heading>$heading_cam</heading>\n";
  $_xml .= "    </LookAt>\n";
  
  // pointeur vers l'icone defini dans l'entete
  $_xml .= "    <styleUrl>#icone_$point->nom_icone</styleUrl>\n";
  
  $_xml .= "    <Point>\n
     <coordinates>$point->longitude,$point->latitude,0</coordinates>\n
    </Point>\n";
  
  // DOMINIQUE 10/10/10 : Ajout du paramètre lien au format utilisé par OpenLayers couche KML
  $_xml .= "
  <ExtendedData>
     <Data name=\"url\">
      <value>$lien_url</value>
     </Data>
    </ExtendedData>\n";
	
  $_xml .= "   </Placemark>\n\n";
  return $_xml;
}

//**********************************************************************************************
// retourne l'entête gml
function entete_gml($encodage="",$credit="Points provenants du site www.refuges.info")
{

  global $config;
  if ($encodage=="")
  	$encodage=$config['encodage_exportation'];
  return "<?xml version=\"1.0\" encoding=\"$encodage\"?>
<wfs:FeatureCollection
 xmlns:wfs=\"http://www.opengis.net/wfs\"
 xmlns:gml=\"http://www.opengis.net/gml\"
 xmlns:topp=\"http://www.openplans.org/topp\"
>
  <name>".$config['nom_fichier_export'].".gml</name>
  <description>$credit</description>
";
}

//**********************************************************************************************
//retourne une entité xml correspondant à un point
//$point est un objet contenant toute les propriétés du point
function feature_gml($point)
{
  return "
  <gml:featureMember>
    <point_wri>
      <nom>".c($point->nom)."</nom>
      <type>$point->nom_icone</type>
      <massif>$point->nom_polygone</massif>
      <url>" .lien_point_fast ($point) ."</url>
      <altitude>$point->altitude</altitude>
      <gml:Point>
        <gml:coordinates decimal=\".\" cs=\",\" ts=\" \">$point->longitude,$point->latitude</gml:coordinates>
      </gml:Point>
    </point_wri>
  </gml:featureMember>
";
}

//**********************************************************************************************
// retourne une ligne d'export CSV
// avec $point étant un objet disposant de toutes les caractéristiques d'un point de la base
function csv_export_line($point)
{
  $separateur=";";
  $nom=str_replace($separateur,"\\".$separateur,$point->nom);
  $nom_type=str_replace($separateur,"\\".$separateur,$point->nom_type);
  $nom_polygone=str_replace($separateur,"\\".$separateur,$point->nom_polygone);
  $nom_precision_gps=str_replace($separateur,"\\".$separateur,$point->nom_precision_gps);
/*DC 02/01/2011 Conversion des points fermés*/     
	//jmb 03/13: fonction qui renvoie la raison de la fermeture (et n'est plus dependante de la BDD)
	//if ($point->ferme!='non' and $point->ferme!='')
	//    $nom_type.=" fermé(e)";
	$nom_type.= texte_non_ouverte($point) ;

  $ligne=$point->id_point.$separateur.$nom.$separateur.$nom_type.$separateur.$nom_polygone;
  $ligne.=$separateur.$point->altitude.$separateur.$point->latitude.$separateur.$point->longitude;
  $ligne.=$separateur.$nom_precision_gps.$separateur.$point->places."\r\n";
  return $ligne;
}

//**********************************************************************************************
//retourne une ligne d'export au format csv pret pour les POI garmin ( Point Of Interest )
// le format de la ligne est :
// long,lat,nom,description
// 02.61444,45.07694,Buron de Cabrespine (Can,Acces : En flanc N de l'arete descendant de Cabres
// séparateur ",", taille du champ nom 25 caractères, taille du champ description 50 caractères
function poi_export_line($point)
{
  $separateur=",";
  $nom=str_replace($separateur,"\\".$separateur,$point->nom);
  $nom_type=str_replace($separateur,"\\".$separateur,$point->nom_type);
  
  $nom_long=substr($nom."-".$nom_type,0,30);
  $ligne=$point->longitude.$separateur.$point->latitude;
  $ligne.=$separateur.substr($nom,0,10).$separateur.$nom_long."\r\n";
  return $ligne;
}

//**********************************************************************************************
//retourne l'entête générique du gpx
function entete_gpx()
{
  global $config;
  $output='<?xml version="1.0" encoding="'.$config['encodage_exportation'].'" standalone="no"?>
<gpx xmlns="http://www.topografix.com/GPX/1/1" creator="refuges.info" version="1.1" 
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
    xsi:schemaLocation="http://www.topografix.com/GPX/1/1 http://www.topografix.com/GPX/1/1/gpx.xsd">
<metadata>
	<name>'.$config['nom_fichier_export'].'.gpx</name>
	<desc>Tout ou partie de la base de donnée de point GPS de '.$config['nom_hote'].', contenant des points d\'intérêts du massif des alpes</desc>
	<author>
		<name>Contributeurs refuges.info</name>
	</author>
	<copyright author="Contributeurs refuges.info">
		<year>2002</year>
		<license>http://creativecommons.org/licenses/by-sa/2.0/deed.fr</license>
	</copyright>
	<link href="http://'.$config['nom_hote'].'/">
		<text>http://'.$config['nom_hote'].'/</text>
		<type>text/html</type>
	</link>
</metadata>
';
return $output; 
}

/***********************************************************************************************
 retourne un waypoint au format xml gpx
 la variable niveau permet de moduler la sortie
 pour l'instant il existe "garmin", "complet" et "carte"
 "gpx" pour les synchros avec sites amis ou export
 "gpx-garmin" pour fichier très léger suffisant pour les gps
 "gpx-carte" pour la carte de refuges.info qui l'utilise, sans envoyer trop de truc inutile
 GPX documentation : http://www.topografix.com/GPX/1/1/
 
 FIXME le format gpx-carte ne servant plus il faudrait simplifier le code après :
***********************************************************************************************/
function waypoint_gpx($point,$format)
{
  // si le point GPS est mauvais on le vire
  if ($point->latitude<-90 OR $point->latitude>90 OR $point->longitude<-180 OR $point->longitude>180 )
    return "";

  if ($format=="gpx" or $format=="gpx-carte")
  {
    //FIXME : on n'utilise plus google API sly 09/11/12: Le mode carte est envoyé à l'API googlemaps du site, pour une bonne réactivité, il faut le minimum d'info nécessaire sly 12/05/2010
    $lien=lien_point_fast($point );
    $version_complete="";

    if ($format=="gpx") // tout ça est inutile et alourdi dans le mode carte googlemaps
    {
	$version_complete="
	<cmt>Acces : ".c($point->acces)."</cmt>
	<desc>".c($point->remark)."</desc>
	<src>".c($point->nom_precision_gps)."</src>
	";
	
	//Je pousse peut-être la factorisation du code un peu loin, ça perd en lisibilité, mais c'est le format mutant entre gpx pour la carte googlemaps et l'export GPX sly 12/05/2010
	$gpx_texte_lien="\t\t\t<text>".c($point->nom)." sur ".$config['nom_hote']."</text>\n";
	$gpx_massif="\t\t\t<massif>".c($point->nom_polygone)."</massif>\n";
	$gpx_id_massif="\t\t\t<id_massif>$point->id_polygone</id_massif>\n";
	$gpx_id_qualite_gpx="\t\t\t<id_qualite_gps>$point->id_type_precision_gps</id_qualite_gps>\n";
	$gpx_nombre_place="\t\t\t<nombre_place>$point->places</nombre_place>\n";
	$gpx_renseignements="\t\t\t<renseignements>".c($point->proprio)."</renseignements>\n";
	$gpx_id_point_type="\t\t\t<id_type_point>$point->id_point_type</id_type_point>\n";
    }
    elseif($format=="gpx-carte")
      // Ce tag permet de préciser dans le gpx, dans les extensions de la norme, l'icône que la carte doit afficher
      $gpx_icone="\t<icone>$point->nom_icone</icone>\n";
    
    $version_complete.="
	<link href=\"$lien\">
	$gpx_texte_lien\t\t<type>text/html</type>
	</link>
	\t<type>".c($point->nom_type)."</type>
	\t\t<extensions>
	\t\t<id_point>$point->id_point</id_point>
	\t\t$gpx_massif$gpx_id_massif$gpx_id_qualite_gpx$gpx_nombre_place$gpx_renseignements$gpx_id_point_type$gpx_icone\t\t\t</extensions>";
	
    $nom="$point->nom";

  }
  /* Ce format, destiné au terminaux garmin, utilise des champs de manière détourné car le format de 
     stockage de garmin ne permet pas de conserver l'altitude ni des champs trop longs !!
     La conversion du format gpx par gpsbabel utilise les champs name, positions et cmt, pour mapsource, je ne sais pas  17/11/10 sly 
  */
  //jmb: utilisation de la fonction qui renvoie la raison de la fermeture, ou chaine vide si ouvert
  else if($format=="gpx-garmin")
  {
	$ferme_texte = texte_non_ouverte($point) ;
    //if ( $point->ferme!='')
    //  $ferme_texte=" fermé(e)";
    //else
    //  $ferme_texte="";
    // si le champ cmt dépasse 100 le reste sera tronqué par gpsbabel, donc mettre en début de champ
    // les informations les plus importantes
    $version_complete="
    <cmt>$point->nom_type,$ferme_texte ".$point->altitude."m : ".c($point->remark)."</cmt>
    <desc>".c($point->remark)."</desc>"; // A noter que ce champs est inutile car le garmin ne dispose que de deux champs (nom et description) et seul la balise cmt est convertie par gpsbabel
    $nom="$point->nom"; // Le champ name semble limité à 30 caractères environ ce qui devrait suffire pour la plupart
  }
  
  $waypoint="
  <wpt lat=\"$point->latitude\" lon=\"$point->longitude\">
  <ele>$point->altitude</ele>
  <name>".c($nom)."</name>$version_complete
  </wpt>
  ";
  return $waypoint;
}

//**********************************************************************************************
function trackpoint_gpx($latitude,$longitude)
{
$xml="<trkpt lat=\"$latitude\" lon=\"$longitude\"></trkpt>\n";
return $xml;
}

/***********************************************************************************************
 Fonction qui permet d'exporter en provenance de la base n'importe quel polygone au format GPX
 Le dernier point aura les même coordonnées que le premier point
*/
//FIXME Attention, ca a des chance de foirer pour les POLY avec INNER RING !!
// PAUSE ! Cette fonction à toute les chances de ne plus avoir besoin d'exister vu qu'elle ne servait qu'a construire nos polygones pour les retravailler
// ailleurs, avec potGIS, on a toute les chances de ne plus en avoir besoin -- sly 16/02/13

function export_polygone_gpx($id_polygone)
{
	if (!is_numeric($id_polygone))
		return -1;
		ExteriorRing(gis);
	
	$query_liste="SELECT";
					
  $res=mysql_query($query_liste);
  $xml=entete_gpx();
  $xml.="<trk>\n";
  $xml.="<trkseg>\n";
  $premier=true;
  while ($point=mysql_fetch_object($res))
  {
    $point_text=trackpoint_gpx($point->latitude,$point->longitude);
    $xml.=$point_text;
    if ($premier)
    {
      $premier=false;
      $premier_point_xml=$point_text;
    }
  }
  $xml.="$premier_point_xml";
  $xml.="</trkseg>\n";
  $xml.="</trk>\n";
  $xml.="</gpx>\n";
  return $xml;
  
}

//**********************************************************************************************
function entete_exportation($format)
{
  if ($format=="kmz" or $format=="kml")
    $output=entete_kml();
  elseif ($format=="gml") // Dominique
    $output=entete_gml();
  elseif($format=="gpx-garmin" or $format=="gpx" or $format=="gpx-carte")
    $output=entete_gpx();
  elseif($format=="csv")
  {
    $separateur=";";
    $output="id_point".$separateur."nom".$separateur."type".$separateur."massif";
    $output.=$separateur."altitude".$separateur."latitude".$separateur."longitude";
    $output.=$separateur."qualité GPS".$separateur."nombre de place\r\n";
  }
  else
    $output="";
  return $output;
}

/***********************************************************************************************
Fonction qui retourne le fichier complet à exporter selon les paramètres de l'objet $conditions qui est un objet de 
recherche de points.
$format est le format choisi (voir tableau $config['formats_exportation'] plus haut dans ce fichier
sly 30/10/10
*/
function fichier_exportation($conditions,$format) 
{
  global $config;
  $resultat = new stdClass;
  
  // pour rationaliser, infos_points prends une geometrie plutot qu'une bbox
  if ( isset($conditions->bbox) )
		$conditions->geometrie = cree_geometrie($conditions->bbox, 'bboxOL');
  //obtenir le tableau des points, selon les conditions
  $points=infos_points($conditions);
  if ($points->erreur)
      return erreur($points->message);
  //Nombre de point récupéré(s), on va permettre de faire du cosmétique avec le bon nom de fichier si un seul
  $i=0;
  if (count($points)==1)
    $resultat->nom_fichier=replace_url($points[0]->nom);
  else
    $resultat->nom_fichier=$config['nom_fichier_export'];
  
  /** selon le type, en créer le bon entête de fichier **/
  $contenu=entete_exportation($format);
  
  // Dominique 24/11/12 Dédoublement des points proches
  //DEBUG /exportations/exportations.php?format=gml&debug=oui&bbox=5,45,5.5,45.6		
  if ($icones = $_GET ['icones']) { // Nombres d'icones qui, mises côte à côte, remplissent la largeur de la carte
    $delta_latitude  = ($conditions->nord  - $conditions->sud ) / $icones;
    $delta_longitude = ($conditions->est - $conditions->ouest) / $icones;
    if ($delta_latitude and $delta_longitude and count($points)!=0) // S'il y a un BBOX
      foreach ($points as $a => $p)
	for ($b=0; $b<$a; $b++) {// Pour toutes les paires de points $a, $b
	  $dlat = $points[$a]->latitude - $points[$b]->latitude;
	  $dlon = $points[$a]->longitude - $points[$b]->longitude;
	  if ($dlat / $delta_latitude * $dlat / $delta_latitude + $dlon / $delta_longitude * $dlon / $delta_longitude < 1) {
	    if ($dlat < 0) // $b a une plus grande latitude
	      $deplacement_latitude = $dlat + $delta_latitude;
	    else // $a a une plus grande latitude
	      $deplacement_latitude = $dlat - $delta_latitude;
	    
	    if ($dlon < 0)  // $b a une plus grande longitude
	      $deplacement_longitude = $dlon + $delta_longitude;
	    else // $a a une plus grande longitude
	      $deplacement_longitude = $dlon - $delta_longitude;
	    
	    $points[$a]->latitude  -= $deplacement_latitude  / 2;
	    $points[$b]->latitude  += $deplacement_latitude  / 2;
	    $points[$a]->longitude -= $deplacement_longitude / 3;
	    $points[$b]->longitude += $deplacement_longitude / 3;
	  }
	}
  }
  
  $kml_folder="";
  
  //------------------------------------------
  if (count($points)>0) // si nous n'avons aucun point dans la recherche, on renvoi un fichier valide, mais sans les points dedans
  {
    foreach ($points as $point)
    {
      // Petite bidouille un peu séciale, dans le mode carte, on souhaite changer les icônes de certains point dont les critères justifie une icone différente
      // sly 12/05/2010
      // FIXME : On notera un défaut lorsque l'abri est sommaire ET détruit il faudrait une 3ème combinaison d'icône
      // sly 30/10/10
      
      // S'il est sommaire ou qu'il n'a aucune place pour dormir et qu'il a l'icone pour ça
      if ( ($point->sommaire=='oui') OR ($point->places==0) AND $point->nom_icone_sommaire!='')
	$point->nom_icone=$point->nom_icone_sommaire;
      
      // Si le point est "fermé" ou "détruit" ou "ruines" et qu'il a une icone spéciale "fermée" on la choisie 
      if ( !empty($point->ferme) AND !empty($point->nom_icone_ferme) )
	$point->nom_icone=$point->nom_icone_ferme;
      
      
      switch ($format)
      {
	//------------------------------------------
	case "kmz":case "kml":
	  // Dans le cas du kml/kmz, on arrange les points par "dossier"
	  // c'est un conteneur xml qui permet une légende plus claire de GoogleEarth
	  if ($point->nom_type!=$kml_folder)
	  { // visiblement on change de dossier
	  if ($kml_folder!="") // si ce n'est pas le premier dossier, on ferme le précédent
	    $contenu.="</Folder>\r\n";
	  // on créer le nouveau dossier
	  $contenu.="<Folder><name>$point->nom_type</name>\r\n<open>0</open>";
	  // on met à jour notre variable pour pas créer un nouveau dossier à chaque fois
	  $kml_folder=$point->nom_type;
	  }
	  $contenu.=placemark_kml($point);
	  break;
	  //------------------------------------------
	case "gml":
	  
	  $contenu.=feature_gml($point,$format);
	  break;
	  //------------------------------------------
	case "gpx-garmin":case "gpx":case "gpx-carte":
	  $contenu.=waypoint_gpx($point,$format);
	  break;
	  //------------------------------------------
	case "csv":
	  $contenu.=csv_export_line($point);
	  break;
	  //------------------------------------------
      }
      $last_point=$point;
    }
  }
  //------------------------------------------
  /*** ici on s'occupe des choses à faire en fin de fichier ***/
  
  if ($format=="kmz" or $format=="kml")
  {
    $contenu.="</Folder>\r\n</Document>\r\n</kml>";
    
    // si c'est du kmz, alors on compresse la sortie
    if ($format=="kmz")
    {
      $zip = new zipfile() ; //on crée un fichier zip
      $zip->addfile($contenu, $resultat->nom_fichier.".kml") ; //on ajoute le fichier
      $contenu = $zip->file() ; //on associe l'archive
    }
  }
  
  elseif ($format=="gml")
    $contenu.="\n</wfs:FeatureCollection>";
  
  // les formats fournissant du gpx, se terminent tous par cette simple balise
  elseif ($config['formats_exportation'][$format]['extension_fichier'] =="gpx")
    $contenu.="</gpx>";
  
  $resultat->contenu=$contenu;
  return $resultat;
}

?>
