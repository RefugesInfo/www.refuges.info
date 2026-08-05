# Makefile de développement local pour www.refuges.info
# Nécessite Docker + Docker Compose. Voir docker/README.md.

COMPOSE := docker compose -f docker/docker-compose.yml
DB      := $(COMPOSE) exec -T db psql -U refuges
DUMP    := docker/init/refuges-local.sql.gz

.DEFAULT_GOAL := help

.PHONY: help up down restart build logs shell db db-load db-dump seed ps clean

help: ## Affiche cette aide
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) \
	  | awk 'BEGIN{FS=":.*?## "}{printf "  \033[36m%-12s\033[0m %s\n", $$1, $$2}'
	@echo "\n  → Site : http://localhost:8080"

up: ## Construit et démarre la stack (config + base chargées si besoin)
	@[ -f config_privee.php ] || cp docker/config_privee.docker.php config_privee.php
	@[ -f .htaccess ] || cp htaccess.modele.txt .htaccess
	$(COMPOSE) up -d --build
	@printf "Attente de PostgreSQL"; \
	  until $(COMPOSE) exec -T db pg_isready -U refuges >/dev/null 2>&1; do printf "."; sleep 1; done; \
	  echo " ok"
	@if ! $(DB) -d refuges -tAc "SELECT to_regclass('public.points')" 2>/dev/null | grep -q points; then \
	  echo "Base vide → chargement du snapshot"; $(MAKE) --no-print-directory db-load; \
	else echo "Base déjà chargée."; fi
	@echo "\n✅  Site disponible sur http://localhost:8080"

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

db-load: ## (Ré)initialise la base depuis docker/init/refuges-local.sql.gz
	$(DB) -d postgres -c "SELECT pg_terminate_backend(pid) FROM pg_stat_activity WHERE datname='refuges' AND pid<>pg_backend_pid();" >/dev/null
	$(DB) -d postgres -c "DROP DATABASE IF EXISTS refuges;"
	$(DB) -d postgres -c "CREATE DATABASE refuges;"
	gzip -dc $(DUMP) | $(DB) -d refuges -v ON_ERROR_STOP=0 >/dev/null 2>&1
	@echo "Base rechargée depuis $(DUMP)."

seed: ## Injecte un jeu de données de démo (massifs, points, commentaires)
	$(DB) -d refuges -v ON_ERROR_STOP=1 < docker/init/seed-demo.sql
	@echo "Données de démo injectées."

db-dump: ## Régénère le snapshot versionné à partir de la base courante
	$(COMPOSE) exec -T db pg_dump -U refuges --no-owner --no-privileges refuges | gzip > $(DUMP)
	@echo "Snapshot écrit dans $(DUMP)."

clean: ## Arrête tout et SUPPRIME les données de la base (volume)
	$(COMPOSE) down -v
