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
   `.htaccess` (depuis `htaccess.modele.txt`) s'ils n'existent pas ;
2. construit l'image web (PHP 8.4 + Apache + extensions pgsql/gd/mbstring/xml/intl…) ;
3. démarre PostgreSQL 15 + PostGIS 3 ;
4. charge la base de test (`ressources/sql/2026-09-21-jeu-de-donnee-test-avec-la-base-de-refuges.info.sql.gz`) si elle est vide.

Le site est ensuite disponible sur **http://localhost:8080**.

`make help` liste toutes les commandes (`down`, `logs`, `shell`, `db`,
`db-load`, `db-dump`, `seed`, `clean`…).

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

`make seed` (jeu de démo fictif) n'est plus nécessaire avec cette base.

## Régénérer le dump

Après avoir modifié la structure de la base localement :

```bash
make db-dump   # réécrit le dump de ressources/sql/, en le purgeant (ressources/sql/purge-dump.py)
```
