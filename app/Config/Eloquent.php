<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// Pastikan variabel .env sudah didefinisikan, misalnya:
// database.default.hostname = localhost
// database.default.database = nama_database
// database.default.username = nama_user
// database.default.password = password_user

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => env('database.default.hostname'),
    'database'  => env('database.default.database'),
    'username'  => env('database.default.username'),
    'password'  => env('database.default.password'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();