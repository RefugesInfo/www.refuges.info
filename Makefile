# Makefile de développement local pour www.refuges.info
# Nécessite Docker + Docker Compose. Voir docker/README.md.

COMPOSE := docker compose -f docker/docker-compose.yml
DB      := $(COMPOSE) exec -T db psql -U refuges
# Adresse publique de l'instance (reportée dans la config de phpBB par db-load) : make up SITE_URL=https://mon.domaine
SITE_URL ?= http://localhost:8080
DUMP    := ressources/sql/2026-09-21-jeu-de-donnee-test-avec-la-base-de-refuges.info.sql.gz

.DEFAULT_GOAL := help

.PHONY: help up down restart build logs shell db db-load phpbb-url db-dump ps clean

help: ## Affiche cette aide
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) \
	  | awk 'BEGIN{FS=":.*?## "}{printf "  \033[36m%-12s\033[0m %s\n", $$1, $$2}'
	@echo "\n  → Site : http://localhost:8080"

# config_privee.php est généré depuis config_privee.php.modele (une seule fois : prérequis "order-only").
# Les ??? sont remplacés par les valeurs du docker-compose, les clés de cartes sont laissées vides
# (les fonds sous contrat IGN, Mapbox... ne s'afficheront pas) et les options de debug sont activées.
config_privee.php: | config_privee.php.modele
	sed -E \
	  -e 's/(serveur_pgsql.\]=).*/\1"db";/' \
	  -e 's/(utilisateur_pgsql.\]=).*/\1"refuges";/' \
	  -e 's/(mot_de_passe_pgsql.\]=).*/\1"refuges";/' \
	  -e 's/(base_pgsql.\]=).*/\1"refuges";/' \
	  -e 's/(=> ).[?][?][?].,/\1"",/' \
	  -e 's#^//([$$]config_wri..debug..=true;)#\1#' \
	  -e 's#^//(ini_set..error_reporting., E_ALL . E_NOTICE)\);.*#\1 ^ E_DEPRECATED);#' \
	  -e 's#^//(ini_set..display_errors.*;)#\1#' \
	  config_privee.php.modele > $@

up: config_privee.php ## Construit et démarre la stack (config + base chargées si besoin)
	@[ -f .htaccess ] || cp htaccess.modele.txt .htaccess
	@# phpBB (cache, fichiers) et le site écrivent dans ces dossiers : le conteneur tourne en www-data, pas sous votre uid
	@chmod -R a+rwX forum/cache forum/store forum/files forum/images/avatars/upload photos_points forum/photos-points 2>/dev/null || true
	$(COMPOSE) up -d --build
	@printf "Attente de PostgreSQL"; \
	  until $(COMPOSE) exec -T db pg_isready -U refuges >/dev/null 2>&1; do printf "."; sleep 1; done; \
	  echo " ok"
	@if ! $(DB) -d refuges -tAc "SELECT to_regclass('public.points')" 2>/dev/null | grep -q points; then \
	  echo "Base vide → chargement du snapshot"; $(MAKE) --no-print-directory db-load; \
	else echo "Base déjà chargée."; fi
	@echo "\n✅  Site disponible sur http://localhost:8080 (compte administrateur : sly / admin, voir docker/README.md)"

down: ## Arrête la stack (conserve les données)
	$(COMPOSE) down

restart: ## Redémarre le conteneur web (vide les connexions PDO persistantes)
	$(COMPOSE) restart web

build: ## Reconstruit l'image web
	$(COMPOSE) build web

ps: ## État des conteneurs
	$(COMPOSE) ps

logs: ## Affiche les logs (Ctrl-C pour quitter)
	$(COMPOSE) logs -f

shell: ## Ouvre un shell bash dans le conteneur web
	$(COMPOSE) exec web bash

db: ## Ouvre un client psql sur la base refuges
	$(COMPOSE) exec db psql -U refuges -d refuges

db-load: ## (Ré)initialise la base depuis le dump de test
	$(DB) -d postgres -c "SELECT pg_terminate_backend(pid) FROM pg_stat_activity WHERE datname='refuges' AND pid<>pg_backend_pid();" >/dev/null
	$(DB) -d postgres -c "DROP DATABASE IF EXISTS refuges;"
	$(DB) -d postgres -c "CREATE DATABASE refuges;"
	gzip -dc $(DUMP) | $(DB) -d refuges -v ON_ERROR_STOP=0 >/dev/null 2>&1
	@echo "Base rechargée depuis $(DUMP)."
	@$(MAKE) --no-print-directory phpbb-url

phpbb-url: ## Règle l'adresse du forum phpBB d'après SITE_URL (défaut http://localhost:8080)
	@u='$(SITE_URL)'; proto=$${u%%://*}; rest=$${u#*://}; host=$${rest%%[:/]*}; \
	  port=$$(echo "$$rest" | sed -nE 's#^[^:/]+:([0-9]+).*#\1#p'); \
	  if [ -z "$$port" ]; then [ "$$proto" = https ] && port=443 || port=80; fi; \
	  secure=0; [ "$$proto" = https ] && secure=1; \
	  $(DB) -d refuges -q -c "UPDATE phpbb3_config SET config_value = CASE config_name WHEN 'server_name' THEN '$$host' WHEN 'server_port' THEN '$$port' WHEN 'server_protocol' THEN '$$proto://' WHEN 'cookie_secure' THEN '$$secure' END WHERE config_name IN ('server_name','server_port','server_protocol','cookie_secure')"; \
	  find forum/cache \( -name 'data_*' -o -name 'sql_*' \) -delete 2>/dev/null || true; \
	  echo "Forum phpBB réglé sur $$proto://$$host:$$port"

db-dump: ## Régénère le dump de test à partir de la base courante (purgé des données personnelles)
	$(COMPOSE) exec -T db pg_dump -U refuges --no-owner --no-privileges refuges > $(DUMP:.gz=).brut
	python3 ressources/sql/purge-dump.py $(DUMP:.gz=).brut $(DUMP:.gz=)
	gzip -9 -f $(DUMP:.gz=)
	rm -f $(DUMP:.gz=).brut
	@echo "Dump purgé écrit dans $(DUMP)."

clean: ## Arrête tout et SUPPRIME les données de la base (volume)
	$(COMPOSE) down -v
