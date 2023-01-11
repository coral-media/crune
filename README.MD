# CRUNE
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/coral-media/crune)
![SymfonyVersion](https://img.shields.io/badge/symfony%20version-%5E5.4-green)

The **C**onsole **Run**time **E**nvironment. Built with [Symfony Components](https://symfony.com/components)

Run sample command `php bin/console app:acme`, sourcecode
available at `src/Command/AcmeCommand.php`

## How to use
Clone the repo using `git` or create your own project with `composer`:

`composer create-project coral-media/crune crune`

Any class under `./src` will be auto-wired and auto wired/configured by the container.

### Docker
In order to use the _dockerized_ distribution adjust the environment variables
in `docker.env` and modify docker files to fit your requirements as you want. The default
values/configuration also works.

`sudo docker-compose --env-file docker.env build --pull --no-cache`

Make sure the container is up and running

`sudo docker exec -it crune-php bin/console app:acme Developer`

## Included [Symfony](https://symfony.com) components
- [symfony/console](https://symfony.com/components/Console)
- [symfony/dependency-injection](https://symfony.com/components/DependencyInjection)
- [symfony/yaml](https://symfony.com/components/Yaml)
- [symfony/config](https://symfony.com/components/Config)
- [symfony/dotenv](https://symfony.com/components/Dotenv)
