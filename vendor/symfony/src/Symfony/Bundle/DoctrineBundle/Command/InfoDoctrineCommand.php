<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\DoctrineBundle\Command;

use Doctrine\ORM\Mapping\MappingException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Show information about mapped entities
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 */
class InfoDoctrineCommand extends DoctrineCommand
{
    protected function configure()
    {
        $this
            ->setName('doctrine:mapping:info')
            ->addOption('em', null, InputOption::VALUE_OPTIONAL, 'The entity manager to use for this command.')
            ->setDescription('Show basic information about all mapped entities.')
            ->setHelp(<<<EOT
The <info>doctrine:mapping:info</info> shows basic information about which
entities exist and possibly if their mapping information contains errors or not.

  <info>./app/console doctrine:mapping:info</info>

If you are using multiple entitiy managers you can pick your choice with the <info>--em</info> option:

  <info>./app/console doctrine:mapping:info --em=default</info>
EOT
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityManagerName = $input->getOption('em') ?
            $input->getOption('em') :
            $this->container->getParameter('doctrine.orm.default_entity_manager');
-
        $entityManagerService = sprintf('doctrine.orm.%s_entity_manager', $entityManagerName);

        /* @var $entityManager Doctrine\ORM\EntityManager */
        $entityManager = $this->container->get($entityManagerService);

        $entityClassNames = $entityManager->getConfiguration()
                                          ->getMetadataDriverImpl()
                                          ->getAllClassNames();

        $output->write(sprintf("Found %d entities mapped in entity manager '%s':",
            count($entityClassNames), $entityManagerName), true);

        foreach ($entityClassNames AS $entityClassName) {
            try {
                $cm = $entityManager->getClassMetadata($entityClassName);
                $output->write("<info>[OK]</info>   " . $entityClassName, true);
            } catch(MappingException $e) {
                $output->write("<error>[FAIL]</error> " . $entityClassName, true);
                $output->write("<comment>" . $e->getMessage()."</comment>", true);
                $output->write("", true);
            }
        }
    }
}