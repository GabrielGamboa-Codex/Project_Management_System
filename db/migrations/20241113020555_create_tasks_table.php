<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTasksTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('tasks');
        $table->addColumn('project_id', 'integer', ['limit' => 100])
            ->addColumn('description', 'text')
            ->addColumn('due_date', 'date') 
            ->addColumn('priority', 'string', ['limit' => 100])
            ->addColumn('completed', 'boolean')
            ->addColumn('assigned_user_id', 'integer', ['limit' => 100])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('status', 'string', ['limit' => 100])
            ->create();
    }
}

