Comment installer le code de www.refuges.info sur son propre hébergement ?
==========================================================================

Cette doc a été remise à jour en 2022 mais c'est pas très complet ! il est même possible que ça ait changé depuis, demandez moi conseil en ouvrant une issue.
Je ne la tiens pas trop à jour car cela me servait surtout à moi en cas de besoin de tout ré-installer. Je dirais que si votre but est d'améliorer le code de www.refuges.info il me semble plus simple que je vous ouvre une zone de développement sur notre serveur, 
ça vous évitera sans doute des complications.

Installation
============

Pour installer le code du site de www.refuges.info nous utilisons actuellement (toute autre configuration m'est inconnue si fonctionnelle)  :

* linux Debian 10
* apache 2.4
* php 7.3 avec modules :
  apt install php-common  php-mbstring  php-pgsql php7.3-cli php7.3-common php7.3-gd  php7.3-json  php7.3-mbstring  php7.3-opcache  php7.3-pgsql  php7.3-readline  php7.3-xml
* postgresql 11
* postgis 2.5
* git

Postgresql
==========

 * Créer un rôle d'accès à une base de donnée et créer une base supportant PostGIS
 * Pour charger une base de donnée avec notre structure (fonctions GIS incluses) vous pouvez trouver un dump de la structure de la base (avec ou sans les polygones de massifs, réserves et pays) dans /ressources/sql/

Code 
====

Le code est publié sur github ici :
https://github.com/RefugesInfo/www.refuges.info

Pour télécharger la dernière version de développement :

```
git clone git://github.com/RefugesInfo/www.refuges.info.git
cd www.refuges.info
```
Le code du site se retrouve dans un dossier nommé www.refuges.info (toutes les commandes d'après sont à faire depuis ce dossier)


* Configuration des fichiers

 * A la racine copier le fichier config_privee.php.modele vers config_privee.php et renseignez vos identifiants d'accès à la base de donnée et activer si besion l'affichage des erreurs de code
 * A la racine : copier le fichier htaccess.modele.txt en .htaccess (et décommenter les lignes si vous voulez que les erreurs php s'affiche à l'écran)
 * Option: si vous utilisez le mode php-fpm, copier le fichier user.modele.ini en .user.ini


Installation / upgrade phpBB
============================

 * Une fois les fichiers du GIT installés ou mis à jour, il est indispensable d'exécuter l'utilitaire /install.php
 * Cecui-ci vérifiera les principaux fichiers de configuration et vous guidera dans leur mise à niveau
 * Il vous proposera si nécéssaire la mise à jour des tables phpBB dans la base de donnée

Voir le README.md pour adapter les paramètres de config du code
