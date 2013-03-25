ol2.12
======

Améliorations apportées à Openlayers 2.12

/*************************************************************************************************************************************/
RESTRICTIONS
IGN & SwissTopo ne fonctionnent pas sous Opera sous localhost (restriction de sécurité de Opera). Génant en debug, pas en prod

/*************************************************************************************************************************************/
Etape 1: Librairies incluses:
	OpenLayers-2.12.zip (img lib theme license.txt): http://openlayers.org/
	proj4js de proj4js-1.1.0.zip (lib)
	jsmin https://github.com/rgrove/jsmin-php pour la compression de la bibliothèque (respecte le nom des variables, ce qui n'est pas optimal mais semble nécéssaire à OL)

Etape 2: Livraison à refuges.info
	Patchs : Les patchs inclus sont documentés dans
		http://trac.osgeo.org/openlayers/ticket/2349 : Add label background color and border
		http://trac.osgeo.org/openlayers/ticket/2551 : Apply text symbolizer properties
		http://trac.osgeo.org/openlayers/ticket/2965 : Add halo's to vector labels
	Les lignes modifiées commencent par
		//DC// Lignes supprimées
		/*DC*/ Lignes supprimées
		//DC   Commentaire

	Fichiers perso:
		proxy.php // Ecrit en PHP parceque je n'ai pas de PERL sur mon PC
		refuges-info-sld.xml // ©Dominique.Cavailhez

Etape 3: Evolutions

/*************************************************************************************************************************************/
ARCHITECTURE
La totalité du code est écrit en Javascript et s'exécute dans l'explorateur (pas de PHP)
On été testés : IE6, 7, 8 & 9 (sous W7), FF, Chrome, Opera (sous XP), Safari
pas de test sous Linux & MAC

Tout le code concernant la gestion des cartes est situé dans le répertoire http://refuges.info/olX (X dépendant le l'évolution du logiciel
Il est inclu par le seul appel à <script type="text/javascript" src="http://refuges.info/olX/OpenLayers.js"></script>
	La librairie est entièrement contenue dans la classe Openlayers et ses sous classes
	Chaque classe Openlayers.xxx.yyy.zzz.js est déclarée dans le fichier lib/Openlayers/xxx/yyy/zzz.js
	
Cette bibliothèque est compressée par jsmin et GZIPpé par l'APPACHE du serveur
	Génération de la bibiothèque en 1 seul fichier ninifié
	Appeler http://refuges.info/olX/build/build.php
	Ceci crée http://refuges.info/olX/OpenLayers.js
	Et un fichier de trace de génération http://refuges.info/olX/build/build.log.html
		Ce fichier liste les modifications par rapport à la livraison OL d'origine
		
Pour debugger, il faut inclure <script type="text/javascript" src="http://refuges.info/olX/lib/OpenLayers.js"></script>
	Cette bibiothèque inclue les fichiers unitaires et non compressés de lib/... 
	Elle est beaucoup plus lente mais permet de debugger dans les fichiers d'origine plus lisibles

Les paramètres d'affichage de la carte mémorisés dans le cookie "Olparams" de syntaxe proche du permalink
	
/*************************************************************************************************************************************/
NOTES:
Safari sous XP : Windows XPS Viewer Essentials Pack
Opera sous localhost : n'envoie pas de referer

/*************************************************************************************************************************************/
TODO WRI

WRI/NAV TODO filtres types de points sur C2C / ch
IE8 : mauvais cadrage de « exporter la vue » ?? (sur PC ALU)
NAV.php faire varier les champs est ouest, ... de "exporter la vue" en fonction de la navigation dans la carte
taille police massifs sous IE

/*************************************************************************************************************************************/
TODO

NON IMPLEMENTE: http://trac.osgeo.org/openlayers/ticket/1704 : Malformed URI sequence in Firefox when using special characters in url
http://webglearth.org/ OL 3D
OpenLayers.ProxyHost = "proxy.cgi?url=";
GMLSLD Stratégy Fixed paramétrable
GMLSLD this.redraw (); // TODO : éviter de demander 2 fois les couches au serveur

 ??? clarifier defaut/params / programme dans le code
Vérifier entres cre / cookies from page
Mettre include API GG dans la classe
Emettre erreur sur SLD vide ou URL KO

Italie : remettre un bout de carte OSM pour zoom moyens /// Italie couche haute / http://www.igmi.org/ware/   view-source:http://www.igmi.org/ware/map.html   WMS->Grid   MapServer->Grid
Italie : passer en m plutôt que degrés

http://openpistemap.org/
skitour = OLcoucheWFS(map, "Skitour Refuges", "skitour_refuges", sldFile, "HebergementsJeroen", true);


BUG
Workspace gpx: ne fonctionne pas (lecture / ecriture) sous FF
Tester visu GPX avec le patch replace
Séparer les cut des delete sommet

A VOIR
http://trac.osgeo.org/openlayers/attachment/ticket/1882/DeleteFeature.js
http://trac.osgeo.org/openlayers/ticket/1249 Baselayers multiprojections
http://lists.osgeo.org/pipermail/openlayers-users/2011-July/021502.html
