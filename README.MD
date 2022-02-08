# CRUNE
The **C**onsole **Run**time **E**nvironment. Built with [Symfony Components](https://symfony.com/components)

Run sample command `php bin/console app:acme`, sourcecode
available at `src/Command/AcmeCommand.php`

## How to use
Clone the repo using `git` or create your own project with `composer`:

`composer create-project coral-media/crune crune`

Any class under `./src` will be auto-wired and auto-configured by the container.

## Included [Symfony](https://symfony.com) components
- [symfony/console](https://symfony.com/components/Console)
- [symfony/dependency-injection](https://symfony.com/components/DependencyInjection)
- [symfony/yaml](https://symfony.com/components/Yaml)
- [symfony/config](https://symfony.com/components/Config)
- [symfony/dotenv](https://symfony.com/components/Dotenv)
