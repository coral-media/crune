<?php


namespace App\Command;


use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

#[AsCommand(name: 'app:acme')]
class AcmeCommand extends Command  implements ContainerAwareInterface
{

    protected ?ContainerInterface $container;

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
            $this->container->getParameter('app_name'),
            $this->container->getParameter('app_version')
        ));

        // return value is important when using CI, to fail the build when the command fails
        // in case of fail: "return self::FAILURE;"
        return self::SUCCESS;
    }

    /**
     * @required
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}