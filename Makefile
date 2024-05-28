.PHONY: build up down composer-build test phpstan, phpcs


build:
	docker compose build

up:
	docker compose up -d

down:
	docker compose down

composer-build:
	docker compose run php composer install

test:
	docker compose run php composer test

phpstan:
	docker compose run php composer phpstan

phpcs:
	docker compose run php composer phpcs
