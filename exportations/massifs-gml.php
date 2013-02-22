<?php // Génère le flux GML décrivant les massifs
//**********************************************************************************************
//* Nom du module:         | massifs-gml.php[?massif=no_massif]                                    *
//* Date :                 | 21/11/2010                                                        *
//* Créateur :             | Dominique                                                         *
//* Rôle du module :       | Génère un flot GML décrivant les massifs.                         *
//*                        | Ce fichier est dérivé de la carte des massifs /index.php          *
//*------------------------|-------------------------------------------------------------------*
//* Modifications(date Nom)| Elements modifiés, ajoutés ou supprimés                           *
//*------------------------|-------------------------------------------------------------------*
// 14/02/13 jmb : BROKEN ! ne fonctionne plus suite a mon nettoyage dans les fct polys voir GIS et geoPHP
//**********************************************************************************************

require_once ("../modeles/config.php");
require_once ("fonctions_bdd.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_polygones.php");

// Si on demande -1 (code spécial pour tous les massifs) ou rien alors on veut tous les massifs de la base dans la bbox
if (isset($_GET['massif']) and $_GET['massif']!="-1")
{
	//Evitons de récupérer une merde depuis la variable $_GET['massif'] (injections SQL par exemple)
	//On autorise soit rien, soit un id, soit une suite d'id comme ça : 12,45,78
	if (!preg_match("/[\-0-9,]*/",$_GET['massif']))
		die("Paramètres GET massif mal formé");
	$condition="id_polygone IN ({$_GET['massif']})";
}
else {
	if ($_GET['polygone_type'])
		$polygone_type = $_GET['polygone_type'];
	else
		$polygone_type = $config['id_massif'];	
	//PDO-	$condition="id_polygone_type = {$polygone_type} and id_polygone != {$config['numero_polygone_fictif']}";}
}
//PDO-  on utilise la fct prepared
//$q_select_mass= "
//	SELECT *
//	FROM polygones
//	WHERE $condition"; 

//------------
// Générateur de couleurs qui tournent autour du cercle colorimétrique
$no_coul =   0; // Le numéro de la couleur du massif va s'incrémenter
$pas     =   7; // On tourne de $pas à chaque polynome pour bien répartir les couleurs
$nb_coul =  44; // Jusqu'au massif 44
$ymin    =   0; // Luminance min
$ymax    = 200; // Luminance max
$b = ($ymin + $ymax) / 2; // Coefs du calcul
$a = 256 + $b; // +256 pour bénéficier du 0 à gauche quand on passe en hexadécimal

//------------
$xml_massifs = '';

//PDO-
//$r_select_mass= mysql_query($q_select_mass) or die("mauvaise requete dans GMcreemassifs: $q_select_mass");
//if ($_GET['massif'] != 'null')
//	while ($polygone = mysql_fetch_object($r_select_mass)) {
//PDO+

$pdo->requetes->liste_polys->bindValue('typepoly', $polygone_type , PDO::PARAM_INT );   // param_int CAPITAL pour PostGres
$pdo->requetes->liste_polys->execute() or die("mauvaise requete dans PDO liste_polys avec param=$polygone_type");
if ($_GET['massif'] != 'null')
	while ($polygone = $pdo->requetes->liste_polys->fetch() ) {
		// Couleur attribuée autour du cercle des couleurs.
		$cr = substr (dechex ($a + $b * cos (M_PI * $no_coul / $nb_coul               )), -2);
		$cv = substr (dechex ($a + $b * cos (M_PI * $no_coul / $nb_coul + 2 * M_PI / 3)), -2);
		$cb = substr (dechex ($a + $b * cos (M_PI * $no_coul / $nb_coul + 4 * M_PI / 3)), -2);
		$no_coul += $pas;

		// récupération du polygone avec la nouvelle fonction sly 01/11/2008
		$polygone_coordonnees=tableau_polygone($polygone->id_polygone);
		$xml_poly = '';
		if ($polygone_coordonnees)
			foreach ($polygone_coordonnees as $sommet_polygone)
				$xml_poly .= "\n            $sommet_polygone->x,$sommet_polygone->y" ;

		// Génération d'1 massif
		$xml_massifs .= "
	  <gml:featureMember>
		<massif>
		  <nom>{$polygone->nom_polygone}</nom>
		  <color>#$cb$cv$cr</color>
		  <url>http://".$config['nom_hote'].lien_polygone($polygone->nom_polygone,$polygone->id_polygone,'Massif') ."</url>
		  <gml:Polygon>
			<gml:LinearRing>
			  <gml:coordinates decimal=\".\" cs=\",\" ts=\" \">$xml_poly
			  </gml:coordinates>
			</gml:LinearRing>
		  </gml:Polygon>
		</massif>
	  </gml:featureMember>
	";
	}

//------------
// Génération du fichier XML
//------------
echo
"<?xml version=\"1.0\" encoding=\"".$config['encodage_exportation']."\"?>
<wfs:FeatureCollection
 xmlns:wfs=\"http://www.opengis.net/wfs\"
 xmlns:topp=\"http://www.openplans.org/topp\"
 xmlns:gml=\"http://www.opengis.net/gml\"
>
  <description>Limites de massifs montagneux provenants du site ".$config['nom_hote']."</description>
$xml_massifs
</wfs:FeatureCollection>
";

//------------
// libère la boucle des massifs
//------------
//PDO- mysql_free_result ($r_select_mass); 
// fermeture cnx mysql
//if (is_resource($mysqlink))
//    mysql_close($mysqlink);

?>
