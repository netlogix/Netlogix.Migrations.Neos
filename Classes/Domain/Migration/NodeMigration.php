<?php
declare(strict_types=1);

namespace Netlogix\Migrations\Neos\Domain\Migration;

use Netlogix\Migrations\Domain\Model\Migration;

abstract class NodeMigration implements Migration
{

    /**
     * @var array
     */
    private $migrationVersions = [];

    protected function addMigrationVersion(string $migrationVersion): void
    {
        $this->migrationVersions[] = $migrationVersion;
    }

    public function down(): void
    {
        throw new \RuntimeException('No down migration available', 1590671295);
    }

    public function getMigrationVersions(): array
    {
        return $this->migrationVersions;
    }

}
