<?php

declare(strict_types=1);

$dbConfig = [
    'host' => '127.0.0.1',
    'username' => 'root',
    'password' => '',
    'database' => 'crud_php_native',
    'port' => 3306,
];

$connection = mysqli_init();

if ($connection === false) {
    exit('Gagal menginisialisasi koneksi database.');
}

mysqli_real_connect(
    $connection,
    $dbConfig['host'],
    $dbConfig['username'],
    $dbConfig['password'],
    $dbConfig['database'],
    $dbConfig['port']
);

if (mysqli_connect_errno() !== 0) {
    exit('Koneksi database gagal: ' . mysqli_connect_error());
}

mysqli_set_charset($connection, 'utf8mb4');
