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
2. construit l'image web (PHP 8.2 + Apache + extensions pgsql/gd/mbstring/xml…) ;
3. démarre PostgreSQL 15 + PostGIS 3 ;
4. charge la base depuis `docker/init/refuges-local.sql.gz` si elle est vide.

Le site est ensuite disponible sur **http://localhost:8080**.

`make help` liste toutes les commandes (`down`, `logs`, `shell`, `db`,
`db-load`, `db-dump`, `clean`…).

## Ce qu'il faut savoir

**La base est quasi vide.** Le snapshot fourni ne contient que la *structure*
(les dumps publics de `ressources/sql/` ne contiennent pas les données). Le site
fonctionne mais sans contenu. Pour de vraies données, demandez une copie de la
base aux mainteneurs (voir le README principal).

**Le forum phpBB est désactivé en local** via `$config_wri['forum_desactive']`
dans `config_privee.php`. Le code est en phpBB 3.3.17 alors que les dumps SQL
publics fournissent un schéma phpBB 3.0/3.1 incompatible. Comme
`controlleurs/bandeau.php` initialise une session phpBB sur chaque page, on la
court-circuite (voir `modeles/identification.php`). `/forum/` ne fonctionnera
donc pas tant que vous ne disposez pas d'une vraie base phpBB.

## Régénérer le snapshot

Après avoir modifié la structure de la base localement :

```bash
make db-dump   # réécrit docker/init/refuges-local.sql.gz
```
