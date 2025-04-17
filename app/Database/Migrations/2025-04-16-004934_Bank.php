<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bank extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'           => ['type' => 'VARCHAR', 'constraint' => 255],
            'account_number' => ['type' => 'VARCHAR', 'constraint' => 255],
            'image'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('banks');
    }

    public function down()
    {
        $this->forge->dropTable('banks');
    }

}
