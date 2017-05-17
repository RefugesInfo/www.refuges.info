PhpBB V3.2+ & extension RefugesInfo.couplage
============================================

Adaptation de PhpBB V3.2+ à refuges.info

ARCHITECTURE DES FICHIERS
=========================
Le code est séparé en 3 parties indépendantes:
- Le code de refuges.info dans les répertoires racines.
- Le code de PhpBB V3.2+ dans le répertoire /forum
Ce code est constitué de la dernière [livraison PhpBB](http://www.phpbb-fr.com/telechargements) pack complet,
à l'exeption de config.php, install/..., docs/...
Il n'est pas permis de le modifier de sorte qu'on peut upgrader sans remord.
- Une extension /forum/ext/RefugesInfo/couplage/... suivant
[l'architecture PhpBB V3.1+/Symphony](https://area51.phpbb.com/docs/dev/31x/extensions/tutorial_basics.html)
contient tous les ajouts (hooks) à PhpBB V3.2+
- Un fichier ext/RefugesInfo/couplage/api.php servant à refuges.info d'accés en modification aux données PhpBB
- Le fichier /forum/config.php, spécifique à refuges.info, appelle ses fichiers de configuration.

EXECUTION DU CODE
=================
- L'autoload des classes PHP du modèle MVC/WRI étant incompatible avec celui de PhpBB basé sur Symphony,
un code ne peut s'exécuter que dans l'un ou l'autre des contextes.
- On s'autorise à lire les tables phpbb3_ à partir du code de refuges.info via PDO.
- Toute action modifiant le contenu de PhpBB à partir du code refuges.info
doit être effectuée en appelant (sorte de requête AJAX) l'URL /forum/ext/RefugesInfo/couplage/api.php
avec "api" et autres arguments en _POST (afin de préserver les caractères spéciaux).
Ceci permet de préserver la structure des tables de PhpBB qui est très complexe et évolutive.
Ces fonctions API ne sont exécutées que si la requette AJAX provient de la même machine (adresse IP) que celle qui l'exécute.

PARAMETRES D'INSTALLATION
=========================
* Les tables du forum sont préfixées phpbb3_

PARAMETRES DE CONFIGURATION
===========================
* GENERAL / Décocher rapport statistiques + VigLink / Envoyer
* GENERAL / Créer l’index de recherche pour « phpBB Native Fulltext » depuis la page Index de recherche.
* GÉNÉRAL / Paramètres des fichiers joints / Quota total de fichiers joints : 0
* GÉNÉRAL / Paramètres des fichiers joints / Taille maximale du fichier : 10 Mo
* GÉNÉRAL / Paramètres de la confirmation visuelle / Plugins installés : / Q&A
* GÉNÉRAL / Paramètres de la confirmation visuelle / Configurer les plugins : Configurer
* GÉNÉRAL / Paramètres de la page de contact / Activer la page de contact : Désactivé
* GÉNÉRAL / Paramètres de cookie / Nom du cookie = phpbb3_wri
* GÉNÉRAL / Paramètres de charge : NON anniversaires / liste moderateurs
* PERSONNALISER : activer Couplage "refuges.info"
* SYSTEME / Paneau de l'utilisateur / Amis et ignorés / Désactiver
