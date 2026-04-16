<?php

declare(strict_types=1);

$pageTitle = $pageTitle ?? 'CRUD PHP Native';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($pageTitle); ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="page-shell">
        <header class="hero">
            <div>
                <p class="eyebrow">PHP Native • HTML • CSS • JS</p>
                <h1><?= h($pageTitle); ?></h1>
                <p class="hero-copy">Project CRUD data mahasiswa dengan MySQL, validasi server-side, dan interaksi ringan di sisi client.</p>
            </div>
            <a class="button button-secondary" href="index.php">Kembali ke daftar</a>
        </header>
