<?php

namespace Posit\Console;

use Posit\Command;
use League\Shunt\Command as ShuntCommand;
use Posit\Posit;
use Symfony\Component\Console\Application as grandparent;

class Application extends \League\Shunt\Console\Application
{
    public function __construct($recipes = array(), $inTest = false)
    {
        if (empty($recipes)) {
            $recipes = $this->getPositRecepies();
        }
        // Run Shunt's constructor
        parent::__construct($recipes, $inTest);

        // Run Symfony console constructor with Posit name and version
        grandparent::__construct('Posit', Posit::VERSION);
    }

    public function getPosit()
    {
        return $this->posit;
    }

    protected function getDefaultCommands()
    {
        $commands = grandparent::getDefaultCommands();

        $commands[] = new Command\AboutCommand;

        // Register all collected tasks
        foreach ($this->getTasks() as $task) {
            $commands[] = new ShuntCommand\ArbitraryCommand($task['name'], $task['verbose'], $task['reflector']);
        }

        return $commands;
    }
}