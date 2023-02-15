DOCKER_COMPOSE=@docker-compose $(COMPOSE_FILE_PATH)
COMPOSE_FILE_PATH := -f docker-compose.yml
DOCKER_EXEC_CMD=$(DOCKER_COMPOSE) exec
DOCKER_SQL := $(DOCKER_EXEC_CMD) comments-api-mysql mysql -u root -e
DB_NAME=$(shell grep ^DB_NAME= ./comments-api/.env | cut -d '=' -f 2-)
DB_USERNAME=$(shell grep ^DB_USERNAME= ./comments-api/.env | cut -d '=' -f 2-)
DB_PASSWORD=$(shell grep ^DB_PASSWORD= ./comments-api/.env | cut -d '=' -f 2-)

install: buildImage start afterBuild

buildImage: ## Build the containers
	$(DOCKER_COMPOSE) build $(ARGUMENT)

start: ## Start the containers (only work when installed)
	$(DOCKER_COMPOSE) up -d $(ARGUMENT)

afterBuild: destroyCreateDB vendorInstall

destroyCreateDB: ## create the asked database and user
	$(DOCKER_SQL) "drop database if exists $(DB_NAME)"
	$(DOCKER_SQL) "drop user if exists $(DB_USERNAME)"
	$(DOCKER_SQL) "create database $(DB_NAME)"
	$(DOCKER_SQL) "create user '$(DB_USERNAME)'@'%' identified by '$(DB_PASSWORD)';"

vendorInstall: ## Install the vendors
	$(DOCKER_EXEC_CMD) comments-api-php composer install
	$(DOCKER_EXEC_CMD) comments-front-php composer install