<?php


namespace App;


use Symfony\Component\Console\Application;

final class Kernel extends Application
{
    /**
     * Constructor.
     * @param iterable $commands
     * @param string $name
     * @param string $version
     * @param string $env
     */
    public function __construct(
        iterable $commands = [],
        string $name = 'UNKNOWN',
        string $version = 'UNKNOWN',
        string $env = 'dev'
    ){
        foreach ($commands as $command) {
            $this->add($command);
        }

        parent::__construct($name, $version);
    }
}
