up:
	docker compose up -d

bash:
	docker compose exec api bash

nginx:
	docker compose exec nginx sh

test:
	docker-compose exec api ./vendor/bin/phpunit --testdox --verbose

queue:
	docker compose exec queue redis-cli -a canoe

db:
	docker compose exec database mysql -u canoe -pcanoe canoe

restart:
	docker compose restart

stop:
	docker compose stop

build:
	docker compose up -d --build

down:
	docker compose down

logs:
	docker compose logs -f api

logs-nginx:
	docker compose logs -f nginx

logs-database:
	docker compose logs -f database

enable-xdebug:
	docker compose exec --user root api bash -c 'sed -i "/;zend_extension=\/usr\/local\/lib\/php\/extensions\/no-debug-non-zts-20210902\/xdebug.so/c\zend_extension=\/usr\/local\/lib\/php\/extensions\/no-debug-non-zts-20210902\/xdebug.so" /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini'
	docker compose exec --user root api bash -c 'supervisorctl restart php'

disable-xdebug:
	docker compose exec --user root api bash -c 'sed -i "/zend_extension=\/usr\/local\/lib\/php\/extensions\/no-debug-non-zts-20210902\/xdebug.so/c\;zend_extension=\/usr\/local\/lib\/php\/extensions\/no-debug-non-zts-20210902\/xdebug.so" /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini'
	docker compose exec --user root api bash -c 'supervisorctl restart php'
