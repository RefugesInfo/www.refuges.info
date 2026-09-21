# Environnement de développement local (Docker)

Stack Docker pour faire tourner www.refuges.info en local, pilotée par le
`Makefile` à la racine du dépôt.

## Prérequis

- Docker + Docker Compose

## Démarrage

```bash
make up
```

Cette commande :

1. crée `config_privee.php` (depuis `docker/config_privee.docker.php`) et
   `.htaccess` (depuis `htaccess.modele.txt`) s'ils n'existent pas, et rend inscriptibles par le conteneur
   (`www-data`) les dossiers où le site et phpBB écrivent (cache et fichiers du forum, `photos_points/`,
   `forum/photos-points/`) ;
2. construit l'image web (PHP 8.4 + Apache + extensions pgsql/gd/mbstring/xml/intl/exif/gettext…) ;
3. démarre PostgreSQL 15 + PostGIS 3 ;
4. charge la base de test (`ressources/sql/2026-09-21-jeu-de-donnee-test-avec-la-base-de-refuges.info.sql.gz`) si elle est vide.

Le site est ensuite disponible sur **http://localhost:8080**.

`make help` liste toutes les commandes (`down`, `logs`, `shell`, `db`,
`db-load`, `db-dump`, `clean`…).

## Configuration PHP de l'image

L'image `php:8.4-apache` n'a pas de `php.ini` : le Dockerfile écrit `conf.d/wri.ini` avec les réglages utiles
(`short_open_tag`, `output_buffering`, limites d'envoi) et **`auto_globals_jit = Off`**. Ce dernier est indispensable :
avec la valeur par défaut, `$_REQUEST` arrive vide aux contrôleurs après le chargement de phpBB
(le formulaire d'ajout de point affiche « vous n'auriez pas dû arriver ici », sans aucune erreur).

Les erreurs PHP sont affichées dans la page **et** écrites dans le log d'Apache : `make logs` les montre avec les
accès (`display_errors` et `log_errors` sont activés, l'image n'ayant pas de `php.ini`).

Extensions : `exif` est requis à l'ajout d'une photo ; `gettext` et les locales `fr_FR`, `de_DE`, `en_GB`, `it_IT`,
`es_ES` sont prévus pour la traduction du site (pas encore utilisés). Ajouter une langue = l'ajouter à la liste
de la boucle `locale-gen` du Dockerfile, puis `make up` pour reconstruire l'image.

## Ce que contient la base de test

Une copie de dév du site, **purgée de toutes les données personnelles** :

- 613 points, 2 541 polygones (massifs, zones, départements…), le wiki et 821 commentaires ;
- un forum phpBB 3.3.17 fonctionnel (12 forums, environ 1 400 messages) ;
- des comptes de test, **tous avec le mot de passe `admin`** :
  - administrateurs : `sly`, `Dominique`, `Claude Mauguier`, `leosw`, `Pascal 74` ;
  - membres sans droits particuliers : `slytest`, `slytest2`, `Pascaltest`, `Plea`.

Ne sont **pas** dans le dump : messages privés, journaux, sessions, adresses IP, e-mails
(tous en `@pas.fr`), clés d'API. L'extension anti-spam Cleantalk est désactivée
(elle contacterait un service externe) et l'envoi d'e-mails du forum est coupé.
La question anti-robot de l'inscription au forum a pour réponse `sly`.

## Publier l'instance sous un autre nom (reverse proxy, HTTPS)

Par défaut le site est sur `http://localhost:8080`. Pour une instance derrière un reverse proxy
(par exemple Traefik sur un serveur), indiquez son adresse publique au chargement de la base :

```bash
make up SITE_URL=https://refugesinfo.exemple.fr
```

`make db-load` reporte alors cette adresse dans la configuration de phpBB (`make phpbb-url` la règle seule).
`docker/config_privee.docker.php` suit l'en-tête `X-Forwarded-Proto` du proxy : sans cela le bandeau du site
refuse d'afficher le formulaire de connexion (« vous devez passer en HTTPS »). Si votre `config_privee.php`
existe déjà, recopiez-y ce bloc.

## Régénérer le dump

Après avoir modifié la structure de la base localement :

```bash
make db-dump   # réécrit le dump de ressources/sql/, en le purgeant (ressources/sql/purge-dump.py)
```
