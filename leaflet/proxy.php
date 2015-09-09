<?php // Syntaxe proxy.php?bbox=7.18,45.57,14.13,47.83&url=serveur_kml&....
/* © Dominique Cavailhez 2012
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */
 
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
//    case 'labs.metacarta.com':
    case 'localhost':
    case 'refuges.info':
    case 'www.refuges.info':
    case 'dom.refuges.info':
    case 'chemineur.fr':
    case 'v2.chemineur.fr':
    case 'v3.chemineur.fr':
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
//        fwrite ($f, var_export ($_SERVER, TRUE));
        fwrite ($f, str_replace ("<", "\n<", file_get_contents("php://input"))."\n\n");
        fclose ($f);
}
/******************************************************************************/
		$secondes_de_cache = 60;
		header("Content-disposition: filename=points.json");
		header("Content-Type: application/json; UTF-8");
		header("Content-Transfer-Encoding: binary");
		header("Pragma: cache");
		header("Expires: " . gmdate("D, d M Y H:i:s", time() + $secondes_de_cache) . " GMT");
		if($config['autoriser_CORS']===TRUE) header("Access-Control-Allow-Origin: *");
		header("Cache-Control: max-age=$secondes_de_cache");

        // Envoie le résultat
        print ($cache);

/******************************************************************************/
        break;
    default:
        print ('Serveur ' .$purl ['host'] .' non autorisé');
}
?>
