<?php


namespace App;


use Symfony\Component\Console\Application;

final class Kernel extends Application
{
    protected string $env = 'prod';
    protected bool $debug = false;

    public const DEV_ENVIRONMENT = 'dev';
    public const PROD_ENVIRONMENT = 'prod';
    public const TEST_ENVIRONMENT = 'test';

    /**
     * Constructor.
     * @param iterable $commands
     * @param string $name
     * @param string $version
     * @param string $env
     * @param bool $debug
     */
    public function __construct(
        iterable $commands = [],
        string $name = 'UNKNOWN',
        string $version = 'UNKNOWN',
        string $env = 'dev',
        bool $debug = true
    ){
        foreach ($commands as $command) {
            $this->add($command);
        }

        $this->debug = $debug;
        $this->env = $env;

        parent::__construct($name, $version);
    }

    public function getEnv(): string
    {
        return $this->env;
    }

    public function getDebug(): bool
    {
        return $this->debug;
    }
}
