<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payment extends Migration
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
            'transaction_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'payment_date' => [
                'type' => 'DATETIME',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        // Tambahkan ini:
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('transaction_id', 'transactions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payments');
    }


    public function down()
    {
        $this->forge->dropTable('payments');
    }
}
