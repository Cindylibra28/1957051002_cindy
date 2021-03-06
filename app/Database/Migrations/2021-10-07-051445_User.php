<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => TRUE,
                    'auto_increment' => TRUE
            ],
            'fullname'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100',
            ],
            'email'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'password'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
        ],
        
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('user');
    } 

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
