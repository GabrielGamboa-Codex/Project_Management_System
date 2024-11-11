<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string', ['limit' => 50])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('team_id', 'integer', ['limit' => 100])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('status', 'string', ['limit' => 100])
            ->addIndex(['username'], ['unique' => true, 'name' => 'idx_unique_username'])
            ->addIndex(['email'], ['unique' => true, 'name' => 'idx_unique_email']) // Añadir índice único para username ->addIndex(['email'], ['unique' => true, 'name' => 'idx_unique_email'
            ->create();



        // Inserta datos en la tabla
        $data = [
            [
                'username' => 'Master',
                'password' => password_hash('Gabo123**', PASSWORD_DEFAULT), // Hash de la contraseña
                'email' => 'foxygamboafnaf2003@gmail.com',
                'team_id' => '4',
                'created_at' => date('Y-m-d H:i:s'), // Timestamp actual
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => true,
            ],
        ];

        $table->insert($data)->save();

    }
}
