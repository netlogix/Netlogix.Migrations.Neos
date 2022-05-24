# Netlogix.Migrations.Neos

This package provides a simple abstraction layer to execute Neos node migrations with the [Netlogix.Migrations](https://github.com/netlogix/Netlogix.Migrations) package.

## Usage

Simply create a new Migration file that extends `Netlogix\Migrations\Neos\Domain\Migration\NodeMigration`, then use `$this->addMigrationVersion('...')` to add your Node migration.

```php
<?php
declare(strict_types=1);

namespace Netlogix\Migrations\Persistence\Migrations;

use Netlogix\Migrations\Neos\Domain\Migration\NodeMigration;

class Version20200909170000 extends NodeMigration
{

    public function up(): void
    {
        $this->addMigrationVersion('20200909170000');
    }

}
```
