<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BankSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'           => 'Bank Central Asia',
                'account_number' => '1234567890',
                'image'          => 'bca.png',
            ],
            [
                'name'           => 'Bank Negara Indonesia',
                'account_number' => '1122334455',
                'image'          => 'bni.png',
            ],
        ];

        // Insert multiple rows
        $this->db->table('banks')->insertBatch($data);
    }
}
