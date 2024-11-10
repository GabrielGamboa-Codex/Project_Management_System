<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateProjectsTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('projects');
        $table->addColumn('name', 'string', ['limit' => 200])
            ->addColumn('description', 'string', ['limit' => 255])
            ->addColumn('team_id', 'integer', ['limit' => 100])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('status', 'string', ['limit' => 100])
            ->create();
    }
}
