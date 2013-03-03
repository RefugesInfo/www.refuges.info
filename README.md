qu'est ce que refuges.info ?
============================

Le mieux, c'est d'aller voir : http://www.refuges.info
Le code source est sous licence WFTPL voir COPYING et toute personne est bienvenue pour nous aider à améliorer le site

installation
============

Pour installer et coder le site de www.refuges.info vous avez besoin :

* linux (pas testé sur d'autres plateformes mais sans doute possible)
* apache 2 
* php 5.3 ou supérieur (avec module gd)
* postgresql (testé avec 9.1)
* postgis (testé avec 1.5)
* git

Le code est publié sur github ici :
https://github.com/sletuffe/www.refuges.info

* Code 

Pour télécharger la dernière version de développement :
   git clone git://github.com/sletuffe/www.refuges.info.git
Le code du site se retrouve dans un dossier nommé www.refuges.info

* Postgresql

Créer un compte d'accès à une base de donnée nommée "refuges" et créer une base appelée "refuges"
Pour charger votre base de donnée (fonctions GIS incluses) le fichier de dump de la structure est dans ressources
une doc (pas totalement à jour le 03/03/2013) explique notre base dans 
/ressources/principe_fonctionnement_refuges.info.txt


* Configuration des fichiers

 * dans /modeles/
copier le fichier config_privee.php.modele vers config_privee.php et renseignez vos identifiants d'accès à la base de donnée

```
cd modeles
cp config_privee.php.modele config_privee.php
```
 * Créez et donnez tous les droits à l'utilisateur qui fait tourner apache au dossiers et fichiers contenus dans :
 
```
chmod 777 /photos_points

chmod 777 /forum/photos-points

chmod 777 /statique/mode_emploi_textes
```

Quelques commandes utiles de git adaptées à refuges.info
========================================================
(Valable sous linux, mais sans doute ailleurs aussi)

* Avoir une copie complète de la dernière version du code :

```
git clone git://github.com/sletuffe/www.refuges.info.git
```

* Placez vous ensuite dans le dossier créé :

```
cd www.refuges.info
```

* Avant de faire des ajouts, synchro avec la dernière version

```
git pull

Already up-to-date.
```


