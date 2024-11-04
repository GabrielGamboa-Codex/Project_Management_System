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
            ->addIndex(['name'], ['unique' => true, 'name' => 'idx_unique_name'])
            ->create();

        // Insertar datos en la tabla
        $data = [
            ['name' => 'Development'],
            ['name' => 'Management'],
            ['name' => 'Testing'],
            ['name' => 'Design'],
            ['name' => 'Code Explotation'],
            ['name' => 'Reviewers'],
        ];

        $this->table('teams')->insert($data)->save();
    }
}
