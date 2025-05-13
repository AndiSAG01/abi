<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNominalToPayments extends Migration
{
    public function up()
    {
        $fields = [
           'status' => [ // Tambahan field status
                'type' => 'ENUM',
                'constraint' => ['Lunas', 'Belum Lunas','Perlu Dicek','Dibatalkan'],
                 'default' => 'Perlu Dicek',
                'null' => false,
            ],
            'nominal' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2', // Maks 15 digit, 2 di belakang koma
                'null' => false,
            ],
        ];

        $this->forge->addColumn('payments',$fields);
    }

    public function down()
    {
        $this->forge->dropColumn('payments', ['status', 'nominal']);
    }
}
