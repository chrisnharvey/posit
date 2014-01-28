<?php

namespace Posit\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AboutCommand extends \League\Shunt\Command\AboutCommand
{
    /**
     * @{inheritDoc}
     */
    protected function configure()
    {
        parent::configure();

        $this->setDescription('Short information about Posit and Shunt');
    }

    /**
     * @{inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(<<<EOT
<info>Posit</info>
<comment>Posit is an extension for Shunt that allows you to run commands in parallel on multiple AWS EC2 instances</comment>

EOT
        );

        parent::execute($input, $output);
    }
}
