<?php
/**********************************************************************************************
Les resultats de la recherche. Ce fichier recupere les criteres en POST de point_formulaire_recherche.php 
( une suite de fiche refuges, mais sans tous les détails )

// 15/02/13 jmb : cosmetique PHP + FIXME j'ai casse la recherche OSM !
**********************************************************************************************/

require_once("modeles/config.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_points.php");
require_once ("fonctions_polygones.php");


/************ Préparation des conditions de la recherche *******************/
// tous ceux dont le name du formulaire correspondent à la condition sur le champs en base du même nom
$conditions = new stdClass;
$conditions->binaire = new stdClass;

$conditions->avec_infos_massif=1;
$conditions->avec_liste_polygones="montagnarde";

// trie par polygones, autrement dit par massifs
// utile pour faire des listes séparées 
$conditions->ordre="liste_polygones"; 


foreach ($_POST as $champ => $valeur)
{
	if( ! empty($valeur) )
		switch ($champ) 
		{
//			case ( in_array($champ, $config['champs_binaires_simples_points'] ) ) :
//				$conditions->binaire->$champ = $valeur;   break;
	
//			case 'limite':
//				$conditions->limite=$config['points_maximum_recherche']; break ;
			
			case 'id_massif':
				$conditions->id_polygone = $valeur; break ;
			
			case ( 'lat' && !empty($_POST['lon']) && !empty($_POST['autour']) ):  // on demande un positionnement GPS. 
				// la distance n'est qu'un polygone
				
				$g = [ 'lat' => $_POST['lat'], 'lon' => $_POST['lon'] , 'rayon' => $_POST['autour'] ];
				$conditions->geometrie = cree_geometrie( $g , 'cercle' );
				$conditions->ordre = "distance";
				break;
			
			case 'id_point_type':
				$conditions->type_point = $valeur ;
				if ( $valeur == $config['id_cabane_gardee'] OR $valeur == $config['tout_type_refuge'] )
					if ( empty($conditions->places_minimum) )
						$conditions->places_minimum = 1 ;
				break;
//					$conditions->places_minimum == '' ? $conditions->places_minimum = 1 : FALSE ;
//				switch ( $valeur )  {
//					case $config['id_cabane_gardee'] : // Condition pour ne pas retourner les abris non prévus pour dormir quand on demande une cabane non gardée sans précisé le nombre de place minimum
//					case $config['tout_type_refuge'] :
//						$conditions->places_minimum == '' ? $conditions->places_minimum = 1 : FALSE ;  break;
//					case "tout-refuge" :
//						$conditions->type_point = $config['tout_type_refuge']; break; // valeur spéciale indiquant qu'on veut les abris, refuges ou gites 
//				}

			case 'champs_binaires':
				foreach ( $valeur as $c )
					$conditions->binaire->$c = true ; break;

			case 'champs_null':
				foreach ( $valeur as $c )
					$conditions->binaire->$c = NULL ; break; // TODO, ne pas restreindre aux champs binaires.
				
			default:  // tous les autres cas: nom, ouvert, places ...
				$conditions->$champ=trim($valeur); break;
		}

}
//print_r(var_dump($_POST));
//var_dump($conditions);
//	if ( !empty($valeur) )
//		$conditions->$champ=trim($valeur);

//$conditions->id_polygone=$_POST['id_massif'];
//$conditions->type_point=$_POST['id_point_type'];

// jmb tout ca dans un switch
/*switch ( $conditions->type_point ) 
{
  case $config['id_cabane_gardee'] : // Condition pour ne pas retourner les abris non prévus pour dormir quand on demande une cabane non gardée sans précisé le nombre de place minimum
  case $config['tout_type_refuge'] :
    $conditions->places_minimum == '' ? $conditions->places_minimum = 1 : FALSE ;
    break;
  case "tout-refuge" :
    $conditions->type_point=$config['tout_type_refuge']; // valeur spéciale indiquant qu'on veut les abris, refuges ou gites
    break;
}
*/
//if ($_POST['limite']==1)
//  $conditions->limite=$config['points_maximum_recherche'];

//pour tous ceux là, on attend un 'oui', donc on peut gérer en tas, la recherche faisant une boucle sur $conditions->binaire
//foreach ($config['champs_binaires_simples_points'] as $attribut_binaire )
//  if (!empty($_POST[$attribut_binaire]))
//	$conditions->binaire->$attribut_binaire=$_POST[$attribut_binaire];
  
// par défaut, on ne veut pas les éléments fermés, sauf si on les voulait spécialement
//if ($conditions->non_utilisable!='oui')
//  $conditions->ouvert='oui';	

// Recherche autour d'un couple de coordonnées gps
//if ($_POST['lat']!="" and $_POST['lon']!="" and $_POST['autour']!="")
//  $conditions->distance=$_POST['lat'].";".$_POST['lon'].";".$_POST['autour'];

$modele = new stdClass();
//======================================
// C'est LA que ca cherche
$modele->points = infos_points ($conditions);

//en PG, pas moyen de savoir si on a tapé la limite. Je dis que si on a pile poile le nombre de points, c'est qu'on la atteinte ........
 if (!empty($conditions->limite) && sizeof($modele->points) == $conditions->limite)
	$modele->limite_atteinte = $conditions->limite;

$modele->titre = 'Dernières nouvelles du site et informations ajoutées sur les refuges';
	

//$modele->limite = $conditions->limite ; // il n'y a plus moyen de savoir si on a atteind la limite avec PG. du moins pas simplement.
//var_dump($modele);
// Mise au pluriel s'il y a plusieurs points
//if ($modele->nombre_points_sans_limite>1)
//	$modele->pluriel="s";
// Message indiquant qu'on a plus de point dans le résultat que la limite autorisée
// FIXME HS en pgsql
//if ($conditions->limite!="" and $modele->nombre_points_sans_limite>=$conditions->limite)
//	$modele->trop=". Votre recherche contient trop de résultats seuls $conditions->limite sont affichés.";

//-----------------------------------------------------------------------------------------------------
// Recherche de points sur nominatim.openstreetmap.org
// FIXME ca marche plus ! 
//jmb j'ai tout casse, je laisse la fct http_build_qquery au specialiste
// en attendant, desactive.
/*$urlOL =
	'http://nominatim.openstreetmap.org/search.php?'
	.http_build_query (array (
		'email' => 'sylvain@refuges.info',
		'format' => 'xml',
		'countrycodes' => 'fr,ch,it,es',
		'accept-language' => 'fr',
		'q' => $_POST['nom'],
		'limit' => 20,
	));
// Récupération du contenu à l'aide de cURL
$ch = curl_init();  // Initialiser cURL.
	curl_setopt ($ch, CURLOPT_URL, $urlOL);
	curl_setopt ($ch, CURLOPT_HEADER, 0);  // Ne pas inclure l'header dans la réponse.
	ob_start ();  // Commencer à 'cache' l'output.
		$r = curl_exec ($ch);  // Exécuter la requète.
		$cache = ob_get_contents ();  // Sauvegarder le contenu du fichier dans la variable $cache.
	ob_end_clean();  // Vider le buffer.
curl_close ($ch);  // Fermer cURL.

// Extraction de l'arbre xml
$modele->xmlOL = simplexml_load_string ($cache);

// Décompte des points // A simplifier en PHP5.3
$modele->nbPointsOL = 0;
foreach ($modele->xmlOL as $point)
	$modele->nbPointsOL++;
*/
//-----------------------------------------------------------------------------------------------------
// On affiche le tout
$modele->type = 'point_recherche';

require_once ($config['chemin_vues']."_entete.html");
require_once ($config['chemin_vues']."$modele->type.html");
require_once ($config['chemin_vues']."_pied.html");
?> 
