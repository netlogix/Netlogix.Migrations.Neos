<?php
declare(strict_types=1);

namespace Netlogix\Migrations\Neos\Domain\Handler;

use Neos\ContentRepository\Migration\Command\NodeCommandController;
use Neos\ContentRepository\Migration\Domain\Model\MigrationStatus;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\ConsoleOutput;
use Netlogix\Migrations\Domain\Handler\MigrationHandler;
use Netlogix\Migrations\Domain\Model\Migration;
use Netlogix\Migrations\Neos\Domain\Migration\NodeMigration;

class NodeMigrationHandler implements MigrationHandler
{

    /**
     * @Flow\Inject
     * @var NodeCommandController
     */
    protected $nodeCommandController;

    /**
     * @var ConsoleOutput
     */
    protected $output;

    public function canExecute(Migration $migration): bool
    {
        return $migration instanceof NodeMigration;
    }

    public function up(Migration $migration): void
    {
        assert($migration instanceof NodeMigration);

        $migration->up();
        $versions = array_unique($migration->getMigrationVersions());

        foreach ($versions as $version) {
            $this->nodeCommandController->migrateCommand(
                $version,
                true,
                MigrationStatus::DIRECTION_UP
            );

            $this->outputLine('Executed Node Migration ' . $version);
        }
    }

    public function down(Migration $migration): void
    {
        throw new \InvalidArgumentException('NodeMigrationHandler does not support down migrations', 1590671429);
    }

    public function setConsoleOutput(?ConsoleOutput $consoleOutput = null): void
    {
        $this->output = $consoleOutput;
    }

    protected function outputLine(string $text, array $arguments = []): void
    {
        if (!$this->output) {
            return;
        }

        $this->output->outputLine($text, $arguments);
    }

}
