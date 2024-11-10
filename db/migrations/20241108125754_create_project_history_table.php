<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateProjectHistoryTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('project_history');
        $table->addColumn('project_id', 'integer', ['limit' => 100])
            ->addColumn('action', 'string', ['limit' => 255])
            ->addColumn('user_id', 'integer', ['limit' => 100])
            ->addColumn('timestamp', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])          
            ->create();
    }
}
