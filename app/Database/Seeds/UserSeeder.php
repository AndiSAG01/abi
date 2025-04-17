<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Models\UserModel;
use Faker\Factory;
use Myth\Auth\Password;


class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
        $faker = Factory::create('id_ID');

        // Cek dan buat admin jika belum ada
        $existingAdmin = $userModel->where('email', 'admin@example.com')->first();

        if (!$existingAdmin) {
            $adminData = [
                'email'         => 'admin@example.com',
                'username'      => 'admin',
                'password_hash' => Password::hash('password'), // Ganti jika perlu
                'status'        => 'Active',
                'role'          => 'admin',
                'active'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];
            $userModel->insert($adminData);
        }

        // Cek dan buat customer jika belum ada
        $existingCustomer = $userModel->where('email', 'customer@example.com')->first();

        if (!$existingCustomer) {
            $customerData = [
                'email'         => 'customer@example.com',
                'username'      => 'customer',
                'password_hash' => Password::hash('password'), // Ganti jika perlu
                'status'        => 'Active',
                'role'          => 'customer',
                'active'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];
            $userModel->insert($customerData);
        }
    }
}
