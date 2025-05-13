<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddInvoiceToTransaction extends Migration
{
    public function up()
    {
        $fields = [
            'invoice' => [
                'type' => 'VARCHAR',
                'constraint' => '50', // Maks 15 digit, 2 di belakang koma
                'null' => false,
            ],
        ];

        $this->forge->addColumn('transactions',$fields);
    }

    public function down()
    {
        $this->forge->dropColumn('transactions', 'invoice');
    }
}
