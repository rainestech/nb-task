## Commands

start: ## Start the project containers with docker-compose
	docker-compose up -d

stop: ## Stop the project containers with docker-compose
	docker-compose down

install-dependencies: ## Install the project dependencies
	docker-compose exec users composer install --no-interaction && \
	docker-compose exec notifications composer install

run-tests: ## Run the project tests
	docker-compose exec users php bin/phpunit

run-migrations: ## Run the project migrations
	docker-compose exec users php bin/console doctrine:migrations:migrate --no-interaction && \
	docker-compose exec users php bin/console --env=test doctrine:migrations:migrate --no-interaction

consume-messages: ## Consume messages from the queue and process them
	docker-compose exec notifications php bin/console messenger:consume external -vv

install: start install-dependencies ## Install the project
