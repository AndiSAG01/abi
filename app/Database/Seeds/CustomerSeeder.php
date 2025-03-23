<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $data = ([
            'name' => 'Customers',
            'email' => 'user@gmail.com', //
            'telphone' => '12345678',
            'image' => 'C:\laragon\www\abi-Uin\public\assets\images\image_2.jpg',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->db->table('customers')->insert($data);
    }
}
