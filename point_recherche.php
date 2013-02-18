<?php
// Les resultats de la recherche. Ce fichier recupere les criteres en POST de point_formulaire_recherche.php 
// ( une suite de fiche refuges, mais sans tous les détails )

// Contient le code PHP de la page
// Le code html est dans /vues/*.html
// Le code javascript est dans /vues/*.js
// Les variables sont passées dans l'objet $modele->...

// 30/05/12 Dominique : Retour en modeles simples
// 14/10/12 Dominique : Ajout points de la recherche sur nominatim.openstreetmap.org
// 15/02/13 jmb : cosmetique PHP + FIXME j'ai casse la recherche OSM !

require_once("modeles/config.php");
require_once ($config['chemin_modeles']."fonctions_autoconnexion.php");
require_once ($config['chemin_modeles']."fonctions_points.php");
require_once ($config['chemin_modeles']."fonctions_affichage_points.php");
require_once ($config['chemin_modeles']."fonctions_polygones.php");

/************ Préparation des conditions de la recherche *******************/
// tous ceux dont le name du formulaire correspondent à la condition sur le champs en base du même nom
foreach ($_POST as $champ => $valeur)
	$conditions->$champ=trim($valeur);

// les conditions en plus souhaitées pour cette recherche
$conditions->avec_infos_massif=1;
$conditions->id_polygone=$_POST['id_massif'];
$conditions->type_point=$_POST['id_point_type'];

// jmb tout ca dans un switch
switch ( $conditions->type_point ) {
	case $config['id_cabane_gardee'] : // Condition pour ne pas retourner les abris non prévus pour dormir quand on demande une cabane non gardée sans précisé le nombre de place minimum
	case $config['tout_type_refuge'] :
		$conditions->places_minimum == '' ? $conditions->places_minimum = 1 : FALSE ;
		break;
	case "tout-refuge" :
		$conditions->type_point=$config['tout_type_refuge']; // valeur spéciale indiquant qu'on veut les abris, refuges ou gites
		break;
}

if ($_POST['pas_limite']!=1)
	$conditions->limite=$config['points_maximum_recherche'];

//pour tous ceux là, on attend un 'oui', donc on peut gérer en tas, la recherche faisant une boucle sur $conditions->binaire
foreach ($config['champs_binaires_simples_points'] as $attribut_binaire )
	if (isset($_POST[$attribut_binaire]))
		$conditions->binaire->$attribut_binaire=$_POST[$attribut_binaire];

// par défaut, on ne veut pas les éléments fermés, sauf si on les voulait spécialement
if ($conditions->non_utilisable!='oui')
	$conditions->ouvert='oui';	

$modele = new stdClass();
$modele = liste_points ($conditions);
$modele->titre = 'Dernières nouvelles du site et informations ajoutées sur les refuges';

// Mise au pluriel s'il y a plusieurs points
if ($modele->nombre_points_sans_limite>1)
	$modele->pluriel="s";
// Message indiquant qu'on a plus de point dans le résultat que la limite autorisée
if ($conditions->limite!="" and $modele->nombre_points_sans_limite>$conditions->limite)
	$modele->trop="Votre recherche contient trop de résultats seuls $conditions->limite sont affichés";

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
