<?php

namespace Btc\CoreBundle\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use Btc\CoreBundle\DataFixtures\Loader as DataFixturesLoader;
use Doctrine\Bundle\DoctrineBundle\Command\DoctrineCommand;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use InvalidArgumentException;

class LoadFixturesCommand extends DoctrineCommand
{
    protected function configure()
    {
        $this
            ->setName('core:fixtures:load')
            ->setDescription('Load data fixtures to your database.')
            ->addOption('em', null, InputOption::VALUE_REQUIRED, 'The entity manager to use for this command.')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command loads data fixtures from your bundles:
It loads only ones which were not appended already.

<info>php %command.full_name%</info>
<info>php %command.full_name% --env=prod</info>

EOT
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var $doctrine \Doctrine\Common\Persistence\ManagerRegistry */
        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getManager($input->getOption('em'));

        $paths = array();
        foreach ($this->getApplication()->getKernel()->getBundles() as $bundle) {
            $paths[] = $bundle->getPath().'/DataFixtures/ORM';
        }

        $loader = new DataFixturesLoader($this->getContainer(), $em);
        foreach ($paths as $path) {
            if (is_dir($path)) {
                $loader->loadFromDirectory($path);
            }
        }
        $fixtures = $loader->getFixtures();
        if (!$fixtures) {
            $output->writeln('  Could not find any new <comment>fixtures</comment> to load..');
            return;
        }
        $executor = new ORMExecutor($em);
        $executor->setLogger(function($message) use ($output) {
            $output->writeln(sprintf('  <comment>></comment> <info>%s</info>', $message));
        });
        $executor->execute($fixtures, true);
        foreach ($fixtures as $fixture) {
            $em->getConnection()->insert('fixtures', ['name' => get_class($fixture)]);
        }
    }
}
