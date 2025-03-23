<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('CustomerSeeder');
        $this->call('ItemSeeder');
        $this->call('CategorySeeder');
        $this->call('ClassificationSeeder');
    }
}
