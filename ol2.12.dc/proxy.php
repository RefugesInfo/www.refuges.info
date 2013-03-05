<?php //DCM++ Syntaxe proxy.php?bbox=7.18,45.57,14.13,47.83&url=serveur_kml&....
//**********************************************************************************************
//* Nom du module:         | proxy.php                                                         *
//* Date :                 | 27/10/2010                                                        *
//* Créateur :             | Dominique                                                         *
//* Rôle du module :       | Interroge un serveur distant et renvoie les données               *
//*                        | Permer d'accéder à des flux d'autres serveurs (KLM, ...)          *
//*                        | Ce proxy est rendu nécéssaire par le fait que la requette         *
//*                        | Httprequest utilisée pour rapatrier les cartes ne peut accéder    *
//*                        | pour des raisons de sécurité au serveur ayant affiché la page     *
//*                        | principale.                                                       *
//*------------------------|-------------------------------------------------------------------*
//* Modifications(date Nom)| Elements modifiés, ajoutés ou supprimés                           *
//*------------------------|-------------------------------------------------------------------*
//**********************************************************************************************

/* This is a blind proxy that we use to get around browser
restrictions that prevent the Javascript from loading pages not on the
same server as the Javascript.  This has several problems: it's less
efficient, it might break some sites, and it's a security risk because
people can use this proxy to browse the web and possibly do bad stuff
with it.  It only loads pages via http, but it can load any
content type. It supports only GET requests. */

/******************************************************************************/
// Traitement des arguments
//parse_str ($_SERVER ['QUERY_STRING'], $args); // On isole les arguments
parse_str (str_replace ('?', '&', $_SERVER ['QUERY_STRING']), $args); // On isole les arguments
$url = $args ['url']; // On analyse l'arg url
unset ($args ['url']); // On le retire de la liste des arguments
$url .= '?args';
if (count ($args))
	foreach ($args AS $k => $v)
		$url .= '&' .$k .'=' .$v; // On ajoute les arguments restants à l'ulr finale

/******************************************************************************/
// Sécurité: on autorise le rebond que vers quelques sites identifiés pour éviter à n'importe qui de faire n'importe quoi
$purl = parse_url ($url); // On analyse l'url
switch ($purl ['host']) // Liste des serveurs autorisés
{
//	case 'labs.metacarta.com':
	case 'localhost':
	case 'refuges.info':
	case 'www.refuges.info':
	case 'chemineur.fr':
	case 'wmts.geo.admin.ch':
		// C'est bon. On va chercher le contenu et on l'affiche
		
/******************************************************************************/
		// Lit le contenu d'une URL distante
		$ch = curl_init();  // Initialiser cURL.
			curl_setopt ($ch, CURLOPT_URL, $url);  // Indiquer quel URL récupérer
			curl_setopt ($ch, CURLOPT_HEADER, 0);  // Ne pas inclure l'header dans la réponse.
			ob_start ();  // Commencer à 'cache' l'output.
				curl_exec ($ch);  // Exécuter la requète.
				$cache = ob_get_contents ();  // Sauvegarder la 'cache' dans la variable $cache.
			ob_end_clean();  // Vider le buffer.
		curl_close ($ch);  // Fermer cURL.
		
/******************************************************************************/
// Trace
if(0) {
		$f = fopen ('proxy.log', 'a');
//		fwrite ($f, var_export ($_SERVER, TRUE));
		fwrite ($f, str_replace ("<", "\n<", file_get_contents("php://input"))."\n\n");
		fclose ($f);
}
/******************************************************************************/
		// Il faut forcer le charset dans le header car Openlayers ne va lire le type qu'ici et ignore les balise META
		// LE correctif qui tue proposé par SLY aprés une lute mémorable avec les charsets
		$charset = mb_detect_encoding ($cache, "UTF-8,ISO-8859-1,ISO-8859-5,ISO-8859-6,ISO-8859-7,ASCII,EUC-JP,JIS,SJIS,SHIFT_JIS,ISO-2022-JP,EUC-KR,ISO-2022-KR", true);
//		header("Content-Type:text/html; charset=$charset");
		header("Content-Type:text/html; charset=ISO-8859-1");

		// Envoie le résultat
		print ($cache);
	
/******************************************************************************/
		break;
	default:
		print ('Serveur ' .$purl ['host'] .' non autorisé');
}
?>
