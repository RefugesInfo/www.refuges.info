Qu'est ce que www.refuges.info ?
===============================

Le mieux, c'est d'aller voir : https://www.refuges.info/wiki/index
Le code source est sous licence WTFPL voir COPYING et toute personne est bienvenue pour nous aider à améliorer le site

Pour en savoir plus sur les détails techniques
==============================================
Les explications sur la structure de la base de données, la structure du code le type de fonctions (mais pas encore la liste des fonctions) vous pouvez vous reporter au fichier :
/ressources/principe_fonctionnement_refuges.info.txt

Doc dédiée aux développeurs ayant accès à la machine wri
========================================================

Nous disposons pour chaque développeur actuellement (2020) d'un espace de test et développement sur le même serveur que tourne www.refuges.info
Si vous voulez venir nous aider à améliorer le site, je peux vous en fournir un, venez présenter votre motivation et votre projet sur le forum https://www.refuges.info/forum

Accès aux fichiers du serveur
=============================

Avec votre espace de dév, vous avez une url ou vous pouvez tester votre code (exemple : https//sly.refuges.info)
Un code d'accès sftp et ssh pour vous y connecter et manipuler les fichiers
Là bas il y a git d'installé (voir plus bas pour les commandes communes)


Accès à la base postgresql
==========================

* https://www.refuges.info/phppgadmin/
ou
* https://sly.refuges.info/adminersly/adminer.php

Notez que la base de production s'appelle "refuges" et chaque instance dispose de sa propre copie.


Configurer votre instance
==========================
* Code 

Pour télécharger la dernière version de développement :

```
git clone git://github.com/RefugesInfo/www.refuges.info.git
cd www.refuges.info
```
Le code du site se retrouve dans un dossier nommé www.refuges.info (toutes les commandes d'après sont à faire depuis ce dossier)

* Configuration des fichiers

 * dans /includes/
copier le fichier config_privee.php.modele vers config_privee.php et renseignez vos identifiants d'accès à la base de donnée
 * A la racine : renommer le fichier htaccess.modele.txt en .htaccess (et décommenter la dernière ligne si vous voulez que les erreurs php s'affiche à l'écran)

 Pour que cela soit actif, j'ai sans doute besoin de faire une manip sur le serveur à ce stade, demandez à sly sur le forum.
 
RAngement actuel sur le serveur : 
=================================
 * /home/users/(login de l'utilisateur) -> contient les dossiers de chaque développeur contenant chacun sa version dans :
 * /home/users/(login de l'utilisateur)/www.refuges.info -> contient la version de "développement" de chacun visible sur https://<login>.refuges.info
 * /home/sites/refuges/www.refuges.info/ -> la version live contrôlable par l'utilisateur "refuges"

 
Quelques commandes utiles de git adaptées à refuges.info
========================================================

Nous utilisons github pour se coordonner au niveau du développement, il vous faudra donc presque certainement un compte sur github.

Rappelez vous qu'avant de détruire quelque chose avec git, faut vraiment y aller avec des options toutes bizarres du style "--force" ou "--force-je-suis-sur"
les commandes de bases ne détruisent rien, jamais !
Il arrive cependant qu'on perde des fichiers, au sens propre ;-) c'est à dire qu'ils n'ont pas disparus, c'est juste qu'ils ont été déplacés
dans les méandres de git et de son dossier caché .git, mais avec la bonne commande, tout revient, donc pas de panique, tentez !
En plus, vous ne pouvez pas détruire les trucs des autres car ils sont archivés sur github et chez chaque développeur

* Avoir une copie complète de la dernière version en cours de développement du code (pas forcément stable mais la dernière version)

```
git clone https://github.com/RefugesInfo/www.refuges.info.git
```

Cette commande téléchargera et créera un dossier nommé www.refuges.info contenant la branche "dev" (développement) la plus récente de refuges.info, mais pas forcément
celle en place sur www

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
* url = "votre login"@github.com:RefugesInfo/www.refuges.info.git

FIXME: y'a encore un truc qui m'échappe avec git, chez moi c'est marqué "git@github.com:RefugesInfo/www.refuges.info.git" mais mon user c'est "sletuffe"
et pourtant, ça marche sans mot de passe en prenant bien ma clef... je pige pas



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
 * Sous windows, télécharger putty https://the.earth.li/~sgtatham/putty/latest/x86/putty.exe puis renseigner le serveur (et mode ssh port 22)


Gestion de la mise en prod des modifications
===========================================

* pour gérer la mise en live de la dernière version
 * login ssh pour se connecter sur le site actif : refuges
 * serveur : www.refuges.info

mise en prod (après de nombreux tests validés sur sa propre zone !):
 * login ssh pour se connecter sur le site actif : refuges
 * serveur : www.refuges.info
 
Attention : pensez bien que www n'utilise pas forcément le même format de la base de donnée que votre zone de test, bien penser à propager les
changements à ce niveau là et en discuter avec les autres avant de le faire !
 
```
cd www.refuges.info
git pull origin dev
```
(on ne touche pas aux fichiers en prod)

