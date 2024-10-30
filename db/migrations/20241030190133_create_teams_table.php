<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTeamsTable extends AbstractMigration
{
    public function change() {
        $table = $this->table('teams');
        $table->addColumn('name', 'string', ['limit' => 50])
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->create();
    }
}
