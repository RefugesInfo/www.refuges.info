<?php
/**********************************************************************************************
Fonctions de gestion des polygones de notre base.
liens vers eux, récupération, calculs de bbox, pré-calcul spatial
gestion : modification/suppression/création
06/11/10 Dominique bornes_polygone
13/03/13 jmb PDO chamboulement PDO+ pour ajout et PDO-
**********************************************************************************************/

require_once ('config.php');
require_once ("fonctions_bdd.php");
require_once ('fonctions_mise_en_forme_texte.php');

/***********************************************************************************
Cette fonction permet d'aller chercher toutes les infos d'un polygone
- Elle prend en paramêtre l'id du polygone
- Elle renvoi un objet contenant :
*nom_polygone
*l'article partitif du polygone ( "de la" chartreuse ou "des" bauges...) pour un polygone 'massif'
*etc...
******************************************************************/
function infos_polygone($id_polygone)
{
  global $pdo;
  
  $pdo->requetes->infos_poly->bindValue('idpoly', $id_polygone, PDO::PARAM_INT );
  if(!$pdo->requetes->infos_poly->execute())
    return erreur('infos_poly erreur sur le poly ',"Problème de requêtre pour trovuer le polygone n°$id_polygone");
  // detype object comme l'ancienne
  return $pdo->requetes->infos_poly->fetch();
}


/********************************************
On génére une url vers la carte d'un polygone
*********************************************/
function lien_polygone($polygone,$local=True)
{
  global $config;
  if (!isset($polygone->type_polygone))
    $polygone->type_polygone="massif";
  if ($local)
    $url_complete="";
  else
    $url_complete="http://".$config['nom_hote'];
 
return "$url_complete/nav/$polygone->id_polygone/".replace_url($polygone->type_polygone)."/".replace_url($polygone->nom_polygone)."/";
}


/**************************************************
Donne un tableau de massifs non compris dans la zone
//PDO+GIS jmb cette fonction est fait pour le GIS
// TODO: que les zones soient des polygones ...
// fonction a virer vu que c'est des ZONES qu'on veut et pas des MASSIFS (voir en dessous)
*************************************************/
function liste_autres_massifs ($zone_demandee) {
	global $config, $zones, $zone, $pdo;

	
	// Lecture de tous les massifs
	// dont les polygones n'intersectent PAS celui de la zone
	$q_select_mass= "
		SELECT *
		FROM polygones
		WHERE id_polygone_type=".$config['id_massif']."
			AND id_polygone != ".$config['numero_polygone_fictif']."
			AND Disjoint(
				gis,
				(SELECT gis FROM polygones WHERE nom_polygone =  \"" .$zone_demandee."\"  )
				)
	";

	// On envoie la requete
	$r_select_mass = $pdo->query($q_select_mass);
	// Traitement
	// Ajoute les liens vers les massifs qui ne sont pas dans une zone
	// bug en cours mais la resolution passe par des polygones, pas par du PHP.
	while ($polygone = $r_select_mass->fetch()) 
		$r[$polygone->nom_polygone] = lien_polygone ($polygone);
	
	//tableau de tous les massif n'etant pas dans la zone (polygones normalement...)
	return $r;
}
/**************************************************
Donne un tableau de ZONES hormis celle donnée en param
// TODO: que les zones soient des polygones ...
*************************************************/
function liste_autres_zones ($zone_demandee) {
	global $config, $zones, $zone, $pdo;

	//si pas de param, c'est qu'on veut les alpes de chez nous
	if ( !$zone_demandee)
		$zone_demandee = $config['zone_defaut'];
	// faut arreter, ... , les zones c'est un ID eet c'est tout
	$q_select_zone=" SELECT * FROM polygones WHERE id_polygone_type=".$config['id_zone']." AND nom_polygone !=  '$zone_demandee'" ;
	// On envoie la requete
	try {
		$r_select_zone = $pdo->query($q_select_zone);
	} catch( Exception $e ){
		echo 'Erreur de requete liste_autres_zones : ', $e->getMessage();
	}

	// Traitement
	// Ajoute les liens vers les massifs qui ne sont pas dans une zone
	// bug en cours mais la resolution passe par des polygones, pas par du PHP.
	while ($polygone = $r_select_zone->fetch()) 
		$z[$polygone->nom_polygone] = lien_polygone ($polygone->nom_polygone);

	//tableau de tous les ZONES autre que la notre
	return $z;
}

/*************************************************
Ces fonctions s'occupent de supprimer un polygone de la base
C'est à utiliser avec forte méfiance car des id de liaison
entre les points de la base et ce polygone peuvent exister, un recalcul 
des points qui appartiennent à un polygone devra être refait

*************************************************/

//suppression juste du polygone
function suppression_polygone($id_polygone)
{
	global $pdo;
	if (!is_numeric($id_polygone))
		return -1;
	$query="DELETE FROM polygones WHERE id_polygone=$id_polygone";
	$pdo->exec($query) or die('pb lors suppr polygone '.$id_polygone) ;
	return 0;
}

/*****************************************************
LISTE POLYGONES DANS POLYGONE
INPUT id_polygone du parent
INPUT type_polygone de(s) fils recherchés ( ou tous )
OUTPUT tableau de pointeurs de id_polygones, avec WKT
***  jmb    **********************************************/
//utile pour les zones qui contiennent des massifs
function liste_polys_dans_poly( $idpere, $typefils = NULL )
{
	global $pdo;
	$q = " SELECT id_polygone, id_polygone_type, article_partitif, nom_polygone, source, message_information_polygone, url_exterieure, AsWKT(gis) AS gis_wkt
			FROM polygones AS fils
			WHERE Intersects(
								(SELECT gis FROM polygones WHERE id_polygone=$idpere),
								fils.gis
							)
			";
	if (is_numeric( $typefils ) )
		$q .= "AND fils.id_polygone_type = $typefils";

	$res = $pdo->query($q) ;
	while( $fils[] = $res->fetch() ) ;

	return $fils ;
}

?>
