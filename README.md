Qu'est ce que www.refuges.info ?
===============================

Le mieux, c'est d'aller voir : https://www.refuges.info/wiki/
Le code source est sous licence WTFPL voir COPYING et toute personne est bienvenue pour nous aider à améliorer le site

Comment installer une copie du code sur votre serveur ?
=======================================================

Voir le fichier INSTALL

Pour en savoir plus sur les détails techniques
==============================================
Les explications sur la structure de la base de données, la structure du code le type de fonctions (mais pas encore la liste des fonctions) vous pouvez vous reporter au fichier :
/ressources/principe_fonctionnement_refuges.info.txt


Doc dédiée aux développeurs ayant accès à la machine wri :
==========================================================

Nous disposons pour chaque développeur actuellement (2020) d'un espace de test et développement sur le même serveur que tourne www.refuges.info
Si vous voulez venir nous aider à améliorer le site, je peux vous en fournir un, venez présenter votre motivation et votre projet sur le forum https://www.refuges.info/forum

Accès aux fichiers du serveur
=============================

Avec votre espace de dév, vous avez une url ou vous pouvez tester votre code (exemple : https//sly.refuges.info)
Un code d'accès sftp et ssh pour vous y connecter et manipuler les fichiers
Là bas il y a git d'installé (voir plus bas pour les commandes communes)


Accès à la base postgresql
==========================

* https://sly.refuges.info/adminersly/adminer.php

Notez que la base de production s'appelle "refuges" et chaque instance dispose de sa propre copie.
 
Rangement actuel sur le serveur : 
=================================
 * /home/users/$login -> contient les dossiers de chaque développeur contenant chacun sa version dans :
 * /home/users/$login/$login.refuges.info -> contient la version de "développement" de chacun visible sur https://$login.refuges.info
 * /home/sites/refuges/www.refuges.info/ -> la version live contrôlable par l'utilisateur "refuges"
