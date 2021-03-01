build:
	docker-compose build
composer-install:
	docker-compose run --rm php composer install
composer-update:
	docker-compose run --rm php composer update
up:
	docker-compose up
psalm:
	 docker-compose run --rm php ./vendor/bin/psalm --show-info=true