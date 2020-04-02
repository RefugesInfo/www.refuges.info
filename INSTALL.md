Comment installer le code de www.refuges.info sur son propre hébergement ?
==========================================================================

Cette doc date d'environ ~2013 et c'est plus super à jour, et c'est surtout pas très complet ! il est même possible que ça ait changé depuis, demandez moi conseil en ouvrant une issue.
Je ne la tiens pas trop à jour car cela me servait surtout à moi en cas de besoin de tout ré-installer. Je dirais que si votre but est d'améliorer le code de www.refuges.info il me semble plus simple que je vous ouvre une zone de développement sur notre serveur, 
ça vous évitera sans doute des complications.

Installation
============

Pour installer le code du site de www.refuges.info nous utilisons actuellement (toute autre configuration m'est inconnue si fonctionnelle)  :

* linux Debian 9
* apache 2.4
* php 7.0.1 avec modules :
  apt install php-common  php-mbstring  php-pgsql php7.0-cli php7.0-common php7.0-gd  php7.0-json  php7.0-mbstring  php7.0-opcache  php7.0-pgsql  php7.0-readline  php7.0-xml
* postgresql 9.6
* postgis 2.3
* git

Le code est publié sur github ici :
https://github.com/RefugesInfo/www.refuges.info

Code 
====

Pour télécharger la dernière version de développement :

```
git clone git://github.com/RefugesInfo/www.refuges.info.git
cd www.refuges.info
```
Le code du site se retrouve dans un dossier nommé www.refuges.info (toutes les commandes d'après sont à faire depuis ce dossier)

Postgresql
==========

 * Créer un rôle d'accès à une base de donnée et créer une base supportant PostGIS
 * Pour charger une base de donnée avec notre structure (fonctions GIS incluses) demandez nous car ça change souvent et personne ne met à jour sur github

Installation / upgrade phpBB
============================

 * Une fois les fichiers du GIT installés ou mis à jour, il est indispensable d'exécuter l'utilitaire /install.php
 * Cecui-ci vérifiera les principaux fichiers de configuration et vous guidera dans leur mise à niveau
 * Il vous proposera si nécéssaire la mise à jour des tables phpBB dans la base de donnée

Voir le README.md pour adapter les paramètres de config du code
