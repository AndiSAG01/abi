<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddstatusToTours extends Migration
{
    public function up()
    {
        $fields = [
           'status' => [ // Tambahan field status
                'type' => 'ENUM',
                'constraint' => ['aktif', 'nonaktif'],
                'default' => 'aktif',
                'null' => false,
            ],
        ];

        $this->forge->addColumn('tour',$fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tour','status');
    }
}
