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
require_once ("fonctions_gestion_erreurs.php");


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

//FIXME à l'arrache pour réparer : à bouger proprement dans une fonction ou dans une vue ou faire autrement ! -- sly

// Ici on a demandé un nombre fini de massif solitaires
if (isset($_GET['massif']))
{
  if (!verifi_multiple_intiers($_GET['massif'])) die("Paramètres GET massif mal formé");
    $condition="id_polygone IN ({$_GET['massif']})";
    $query="select id_polygone,nom_polygone,st_asgml(geom) as poly_gml 
            from polygones
            where 
              $condition;";
}
else // ici on demande tous les massif dans le point de vue
{
  if ($_GET['polygone_type'])
          $polygone_type = $_GET['polygone_type'];
  else
          $polygone_type = $config['id_massif'];	
// FIXME FIXME FIXME FIXME FIXME FIXME FIXME FIXME FIXME FIXME FIXME FIXME FIXME FIXME !!!!!!!!
// j'ai vérifié l'ancien code : argh ! Le paramètre bbox est complètement ignoré : on récupère tous les massifs de la base (et en plus 2 fois à cause d'un bug coté OL)
// ça se corrige bien avec GIS, mais avant de changer ici, on va attendre le voir l'avenir de ce code -- sly
$query="select id_polygone,nom_polygone,st_asgml(geom) as poly_gml 
          from polygones
          where 
            id_polygone_type=".$config['id_massif'];
}
$res=$pdo->query($query);
if ($_GET['massif'] != 'null')
	while ($polygone = $res->fetch() ) 
        {
		// Couleur attribuée autour du cercle des couleurs.
		$cr = substr (dechex ($a + $b * cos (M_PI * $no_coul / $nb_coul               )), -2);
		$cv = substr (dechex ($a + $b * cos (M_PI * $no_coul / $nb_coul + 2 * M_PI / 3)), -2);
		$cb = substr (dechex ($a + $b * cos (M_PI * $no_coul / $nb_coul + 4 * M_PI / 3)), -2);
		$no_coul += $pas;
              
                // FIXME : grosse bidouille, il faudrait carrément laisser ça à postgis entièrement par la fonction st_asgml() puis rajouter nous même les infos en plus dont on a besoin
                $gml_to_xml=@simplexml_load_string($polygone->poly_gml);
                $z="gml:polygonMember";
                $x="gml:Polygon";
                $y="gml:outerBoundaryIs";
                $w="gml:LinearRing";
                $v="gml:coordinates";
		// Génération d'1 massif
		$xml_massifs .= "
	  <gml:featureMember>
		<massif>
		  <nom>{$polygone->nom_polygone}</nom>
		  <color>#$cb$cv$cr</color>
		  <url>http://".$config['nom_hote'].lien_polygone($polygone) ."</url>
		  <gml:Polygon>
			<gml:LinearRing>
			  <gml:coordinates decimal=\".\" cs=\",\" ts=\" \">".$gml_to_xml->$z->$x->$y->$w->$v."
			  </gml:coordinates>
			</gml:LinearRing>
		  </gml:Polygon>
		</massif>
	  </gml:featureMember>
	";
	}

//------------
// Génération du fichier XML
// A convertir (ou pas) au MVC
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


?>
