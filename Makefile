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
csfixer:
	vendor/bin/php-cs-fixer fix src
run:
	docker-compose run --rm php -c php script/runTask.php
set-up: build composer-install