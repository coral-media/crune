<?php


namespace App\Command;


use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:acme')]
class AcmeCommand extends Command
{
    protected string $appName;
    protected string $appVersion;

    #[NoReturn]
    public function __construct(
        string $appName,
        string $appVersion,
        string $name = null
    ) {
        $this->appName = $appName;
        $this->appVersion = $appVersion;
        parent::__construct($name);
    }

    /**
     * In this method setup command, description, and its parameters
     */
    protected function configure()
    {
        $this->setDescription('The hello world command.');
        $this->addArgument('name', InputArgument::REQUIRED, 'Your name');
    }

    /**
     * Here all logic happens
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(sprintf(
            'Hello world %s from %s %s',
            $input->getArgument('name'),
            $this->appName,
            $this->appVersion
        ));

        return self::SUCCESS;
    }
}
