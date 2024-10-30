<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration {
    public function change() {
        $table = $this->table('users');
        $table->addColumn('username', 'string', ['limit' => 50])
              ->addColumn('password', 'string', ['limit' => 255])
              ->addColumn('email', 'string', ['limit' => 100])
              ->addColumn('team_id', 'integer', ['limit' => 100])
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->create();
    }
}

