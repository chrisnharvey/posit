<?php

namespace Posit\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ReflectionFunction;

class ArbitraryCommand extends \League\Shunt\Command\ArbitraryCommand
{
    /**
     * Constructor.
     *
     * @param string             $name        The name of the command
     * @param string             $description The description of the command
     * @param ReflectionFunction $callable    The callback of the command
     *
     * @throws \LogicException When the command name is empty
     *
     * @api
     */
    public function __construct($name, $description, ReflectionFunction $callable)
    {
        $this->description = $description;
        $this->callable = $callable;

        parent::__construct($name);
    }

    /**
     * @{inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName($this->getName())
            ->setDescription($this->description);
    }

    /**
     * @{inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($output->getVerbosity() > OutputInterface::VERBOSITY_NORMAL) {
            $output->writeln('Running '.$this->getName());
        }

        $this->callable->invoke($this->getApplication()->getPosit());
    }
}
