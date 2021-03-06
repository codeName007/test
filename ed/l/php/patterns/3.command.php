<?php
/**
 * Command
 *
 * @category Behaviour
 */

class Lamp
{
    public function turnOn()
    {
        echo "Switched ON.\n";
    }

    public function turnOff()
    {
        echo "Switched OFF.\n";
    }
}

interface CommandInterface
{
    public function execute();
}

class TurnOnCommand implements CommandInterface
{
    protected $lamp;

    public function __construct(Lamp $lamp)
    {
        $this->lamp = $lamp;
    }

    public function execute()
    {
        $this->lamp->turnOn();
    }
}

class TurnOffCommand implements CommandInterface
{
    protected $lamp;

    public function __construct(Lamp $lamp)
    {
        $this->lamp = $lamp;
    }

    public function execute()
    {
        $this->lamp->turnOff();
    }
}

class CommandRegistry
{
    private $registry = [];

    public function add(CommandInterface $command, $type)
    {
        $this->registry[$type] = $command;
    }

    public function get($type)
    {
        if (!isset($this->registry[$type])) {
            throw new RuntimeException('Cannot find command ' . $type);
        }
        return $this->registry[$type];
    }
}

$lamp = new Lamp();
$registry = new CommandRegistry();
$registry->add(new TurnOnCommand($lamp), 'ON');
$registry->add(new TurnOffCommand($lamp), 'OFF');
// $registry->add(new SosCommand($lamp), 'SOS');
// $registry->add(new TimeoutCommand($lamp, $argv[2]), 'TIMEOUT');
$registry->get($argv[1])->execute();
