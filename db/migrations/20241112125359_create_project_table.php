<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateProjectTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('projects');
        $table->addColumn('name', 'string', ['limit' => 50])
            //te permite con ese comando meter un total de 4gb de espacio de datos
             ->addColumn('description', 'text')
            ->addColumn('team_id', 'integer', ['limit' => 100])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('status', 'string', ['limit' => 100])
            ->create();

    }
}
