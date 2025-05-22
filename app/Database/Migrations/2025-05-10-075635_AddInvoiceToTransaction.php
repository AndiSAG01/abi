<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddInvoiceToTransaction extends Migration
{
    public function up()
    {
        // Cek apakah kolom 'invoice' sudah ada
        if (!$this->db->fieldExists('invoice', 'transactions')) {
            $fields = [
                'invoice' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'null'       => false,
                ],
            ];

            $this->forge->addColumn('transactions', $fields);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('transactions', 'invoice');
    }
}
