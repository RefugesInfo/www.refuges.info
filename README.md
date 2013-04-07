Qu'est ce que refuges.info ?
============================

Le mieux, c'est d'aller voir : http://www.refuges.info
Le code source est sous licence WTFPL voir COPYING et toute personne est bienvenue pour nous aider à améliorer le site

Installation
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

```
git clone git://github.com/sletuffe/www.refuges.info.git
cd www.refuges.info
```
Le code du site se retrouve dans un dossier nommé www.refuges.info (toutes les commandes d'après sont à faire depuis ce dossier)

* Postgresql

 * Créer un compte d'accès à une base de donnée nommée "refuges" et créer une base appelée "refuges"
 * Pour charger votre base de donnée (fonctions GIS incluses) le fichier de dump de la structure est dans ressources
une doc (pas totalement à jour le 03/03/2013) explique notre base dans /ressources/principe_fonctionnement_refuges.info.txt


* Configuration des fichiers

 * dans /includes/
copier le fichier config_privee.php.modele vers config_privee.php et renseignez vos identifiants d'accès à la base de donnée
 * A la racine : renommer le fichier htaccess.modele.txt en .htaccess (et décommenter la dernière ligne si vous voulez que les erreurs php s'affiche à l'écran)
```
cp includes/config_privee.php.modele includes/config_privee.php
vi includes/config_privee.php -> editer le fichier pour vos paramètres à vous
```
 * Créez et donnez tous les droits à l'utilisateur qui fait tourner apache au dossiers et fichiers contenus dans :
 
```
mkdir photos_points
chmod 777 photos_points

mkdir forum/photos-points
chmod 777 forum/photos-points

mkdir forum/images/avatars
chmod 777 forum/images/avatars
```

Quelques commandes utiles de git adaptées à refuges.info
========================================================
(Valable sous linux, mais sans doute ailleurs aussi)
Rappelez vous qu'avant de détruire quelque chose avec git, faut vraiment y aller avec des options toutes bizarres du style "--force" ou "--force-je-suis-sur"
les commandes de bases ne détruisent rien, jamais !
Il arrive cependant qu'on perde des fichiers, au sens propre ;-) c'est à dire qu'ils n'ont pas disparus, c'est juste qu'ils ont été déplacés
dans les méandres de git et de son dossier caché .git, mais avec la bonne commande, tout revient, donc pas de panique, tentez !
En plus, vous ne pouvez pas détruire les trucs des autres car ils sont archivés sur github et chez chaque développeur

* Avoir une copie complète de la dernière version en cours de développement du code (pas forcément stable mais la dernière version)

```
git clone https://github.com/sletuffe/www.refuges.info.git -b dev
```
(enlevez "-b dev" pour avoir la version stable)


* Avant toute modification, dites à git qui vous êtes

```
git config --global user.name "<votre login github>"

git config --global user.email <votre email sur github>

```
* Placez vous ensuite dans le dossier créé :

```
cd www.refuges.info
```

* Avant de faire des ajouts, synchro avec la dernière version (si des changements sont fait chez vous depuis, le système tente de fusionner lui même, s'il n'y arrive pas il vous l'indique)

```
git pull

Already up-to-date. -> rien a changé, vous êtes à jour
remote: Counting objects: 24, done.
remote: Compressing objects: 100% (12/12), done.
(...) -> téléchargement des éléments de la dernière version
```

* Modifier du code existant, puis, une fois satisfait, enregistrement dans votre base git de votre dossier
 * Si vous ajouter un fichier ou dossier nouveau que vous voulez rendre disponible :

```
git add <le fichier ou le dossier>
```

 * si vous en avez plein et que vous voulez tout envoyer ce qui est ajouté (ou que vous ne vous rappelez plus tellement vous en avez créé !)

```
git add . 
```

* Enregistrer localement le commit (votre éditeur de texte favoris sous linux s'ouvre pour indiquer les changements réalisés et vous demande un message de commit : sur le serveur refuges.info, par défaut c'est joe qui s'ouvre, faites ctrl+k puis x pour sauver et quitter

```
git commit -a
```

* Mettre sur github

```
git push
```
* Notez que pour éviter d'avoir à taper votre mot de passe à chaque fois (relou) vous pouvez générer une clef ssh et l'ajouter
a votre profil github 

```
ssh-keygen -t rsa 
```

ne rentrez aucun mot de passe pour protéger la clef elle même sinon il faudra taper le mot de passe pour dévérouiller la clef
qui sert à économiser le mot de passe à taper ;-)
Votre clé publique se trouve ici $HOME/.ssh/id_rsa.pub (le contenu est en texte et peut se copier coller sur votre profil github)

Ensuite (il doit y avoir une commande pour le faire mais je l'ignore) on peut éditer le fichier de config de git pour refuges.info
dans www.refuges.info/.git/config et remplacer le paramètre url pour mettre :
* url = "votre login"@github.com:sletuffe/www.refuges.info.git

FIXME: y'a encore un truc qui m'échappe avec git, chez moi c'est marqué "git@github.com:sletuffe/www.refuges.info.git" mais mon user c'est "sletuffe"
et pourtant, ça marche sans mot de passe en prenant bien ma clef... je pige pas


Doc dédiée aux développeurs ayant accès à la machine wri
========================================================

* commandes git utiles 
 * Pour passer sur la version de développement

```
git fetch origin dev --> facultatif si vous avez déjà cloner depuis dev
git checkout dev
```

 * Pour passer sur la branche stable

```
git fetch origin master
git checkout master
```

(ne faites pas de push sur la version stable, sauf résolution de bugs critiques)


* pour développer sur votre zone
 * Serveur ftp ou sftp ou ssh : www.refuges.info
 * login  / mot de passe : le votre ;-)

* accès ssh 
 * Sous Linux/OSX : ssh login@www.refuges.info
 * Sous windows, télécharger putty http://the.earth.li/~sgtatham/putty/latest/x86/putty.exe puis renseigner le serveur (et mode ssh port 22)

* Pour tous les commandes de base sous linux:

```
ls -> liste les fichiers/dossiers
ll -> liste les fichiers/dossiers en mode lisible
cd www.refuges.info -> pour rentrer dans votre zone de développement
git <options> -> pour taper des commandes git relatives à wri
cd .. -> revenir dossier d'avant
```

* Sur le serveur : 
 * /home/users/(login de l'utilisateur) -> contient les dossiers de chaque développeur contenant chacun sa version dans :
 * /home/users/(login de l'utilisateur)/www.refuges.info -> contient la version de "développement" de chacun visible sur http://<login>.refuges.info
 * /home/sites/refuges/www.refuges.info/ -> la version live contrôlable par l'utilisateur "refuges"
 * /home/sites/refuges/dev.refuges.info/ -> la version "pré-prod" contrôlable par l'utilisateur "refuges"

* pour gérer la mise en live de la dernière version sur la pré-prod
 * login ssh pour se connecter sur le site actif : refuges
 * serveur : www.refuges.info

```
cd dev.refuges.info
git pull
```

La dernière version de la branche de développement nommée "dev" doit alors être rapatriée et testée sur http://dev.refuges.info

mise en prod (après de nombreux tests validés sur la zone dev.refuges.info !):
 * login ssh pour se connecter sur le site actif : refuges
 * serveur : www.refuges.info
 
Attention : pensez bien que dev et www n'utilise pas forcément le même format de la base de donnée, bien penser à propager les
changements à ce niveau là et en discuter avec les autres avant de le faire !
 
```
cd www.refuges.info
git pull origin dev
```
(on ne touche pas aux fichiers en prod)

* accès postgresql
 * http://www.refuges.info/phppgadmin/
Notez qu'il n'y a une base de production qui s'appelle "refuges" et une, (ancienne) copie, qui s'appelle "test" accessible avec le même utilisateur et même mot de passe que l'autre.
