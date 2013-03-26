<?php

// --------------
// GENERE UN FLUX RSS
//
// param:
//     -"listeobjets": une liste des id_point_type a integrer dans le RSS (ex: "1,3,4,5,6')
//     -"listemassifs": une liste des id_polygone de massifs a integrer dans le RSS (ex: "1,3,4,5,6')
//
// Renvoie un XML RSS2.0
// chaque item a un title, un link, une descrition et une pubDate
// JM nov 2006

// FIXME depuis fin 2008, le rss ne marche plus très bien, on ne peut sélectionner
// les points ou les massif qui intéresse
// toutes les requêtes n'étant plus valables vue le changement profond de la base
// Mais il s'avère que les news sont très proche de ce besoin, la fusion
// devrait être faisable sans trop de douleur - sly 24/09/2009  

require_once ('../includes/config.php');
require_once ("fonctions_bdd.php");
require_once ("fonctions_nouvelles.php");


$listetypes = $_GET["listeobjets"] ;
$listetypes = str_replace( "-", ",", $listetypes ) ;

$listemass = $_GET["listemassifs"] ;
$listemass = str_replace( "-", ",", $listemass);

$nbjours = $_GET["jours"] ;

$datedeb = time() - $nbjours*24*60*60 ; // le RSS commencera il y a X jours
$pointurl = "http://".$config['nom_hote']."/point/" ; // il ne reste plus que l'ID a concatener
$longdesc = 500 ; // longueur en char du champ description. apres c'est "(...)"



//---------------------
// fonction qui prend un item en tablo et renvoie le XML
// A ADAPTER SUIVANT la version de RSS 1.0, 2.0 ou Atom
function affiche_item ($item)
{
  global $config;
  // la fonction mt_rand sert juste a avoir un GUID unique...........
  return "
  <item>
    <title>".stripslashes(htmlspecialchars($item["title"],0,"UTF-8"))."</title>
      <link>".$item["link"]."</link>
      <guid>".$item["link"]."/".mt_rand(1,1000)."</guid>
      <description>".stripslashes(htmlspecialchars($item["description"],0,"UTF-8"))."</description>
      <pubDate>".date('r',$item["pubdate"])."</pubDate>
      <category>".$item["category"]."</category>
      <!-- <enclosure url='http://".$config['nom_hote']."/images/icones/abri.png'
        length='178'
        type='image/png' /> -->
  </item> ";
}

//------------------------
// entête XML du flux, avec la description des objets et des massifs concernes
// A ADAPTER SUIVANT la version de RSS 1.0, 2.0 ou Atom
function debut_flux ($types, $massifs, $date)
{
	return
"<?xml version='1.0' encoding='UTF-8' ?>
<?xml-stylesheet type='text/xsl' href='rss.xsl' ?>
<rss version='2.0' xmlns:dc='http://purl.org/dc/elements/1.1/'>
   <channel>
	<title>Derniers messages sur refuges.info</title>
	<link>http://".$config['nom_hote']."</link> <!-- ici lien vers la conf des flux -->
	<language>fr</language>
	<description>Flux RSS du site refuges.info concernant $typesentexte dans les massifs de $massifsentexte depuis le ".date("d/m/Y", $date)."</description>
	<image>
		<title>".$config['nom_hote']."</title>
		<url>http://".$config['nom_hote']."/images/logorss.png</url>
		<link>http://".$config['nom_hote']."</link>
		<width>138</width>
		<height>69</height>
	</image>
" ;
}


 // Prepare les header (sinon il envoie du HTML! )
 header("Content-Type: text/xml; charset=UTF-8");
 $flux = debut_flux($listetypes, $listemass, $datedeb);
$news_array=affiche_news(10,"commentaires,points",TRUE);
 foreach ($news_array as $news)
{
	$item["pubdate"]=$news['date'];
	$item["title"]=$news['categorie']." : ".$news['titre'];
	$item["link"]=$news['lien'];
	$item["description"]=$news['text'];
	$item["category"]=$news['categorie'];
	
 	$flux .= affiche_item($item);
}
 $flux .= "\n  </channel>\n</rss>";
 print($flux);

?>
