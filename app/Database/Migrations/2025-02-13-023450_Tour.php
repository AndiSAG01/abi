<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tour extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'classification' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'category' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'ticket' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ],
            'information' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'information_detail' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tour');
    }
    
    

    public function down()
    {
        $this->forge->dropTable('tour');
    }
}
