<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTeamsTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('teams');
        $table->addColumn('name', 'string', ['limit' => 50])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('status', 'string', ['limit' => 100])
            ->addIndex(['name'], ['unique' => true, 'name' => 'idx_unique_name'])
            ->create();

        // Insertar datos en la tabla
        $data = [
            ['name' => 'Development', 'status' => true],
            ['name' => 'Management', 'status' => true],
            ['name' => 'Testing', 'status' => true],
            ['name' => 'Design', 'status' => true],
            ['name' => 'Code Explotation', 'status' => true],
            ['name' => 'Reviewers', 'status' => true],
        ];

        $this->table('teams')->insert($data)->save();
    }
}
