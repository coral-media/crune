#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

if [ "$1" = 'php-fpm' ] || [ "$1" = 'php' ] || [ "$1" = 'bin/console' ]; then
	PHP_INI_RECOMMENDED="$PHP_INI_DIR/php.ini-production"
	if [ "$APP_ENV" != 'prod' ]; then
		PHP_INI_RECOMMENDED="$PHP_INI_DIR/php.ini-development"
	fi
	ln -sf "$PHP_INI_RECOMMENDED" "$PHP_INI_DIR/php.ini"

	mkdir -p var/cache var/log

	# The first time volumes are mounted, the project needs to be recreated
	if [ ! -f composer.json ]; then
		CREATION=1
		composer create-project "$SKELETON $CRUNE_VERSION" tmp --stability="$STABILITY" \
		--prefer-dist --no-progress --no-interaction --no-install

		cd tmp
		composer require "php:>=$PHP_VERSION"
		cp -Rp . ..
		cd -

		rm -Rf tmp/
	fi

	if [ "$APP_ENV" != 'prod' ]; then
		rm -f .env.local.php
		composer install --prefer-dist --no-progress --no-interaction
	fi

	chown -R "$(whoami):www-data" var
  chmod -R ug+rwX var
  chmod -R g+s var
fi

exec docker-php-entrypoint "$@"