<?php


namespace App;


use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class Kernel extends Application
{
    /**
     * Constructor.
     * @param iterable $commands
     * @param string $name
     * @param string $version
     */
    public function __construct(
        iterable $commands = [],
        string $name = 'UNKNOWN',
        string $version = 'UNKNOWN'
    ){
        foreach ($commands as $command) {
            $this->add($command);
        }

        parent::__construct($name, $version);
    }
}
