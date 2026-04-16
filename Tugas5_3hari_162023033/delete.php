<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

$id = (int) ($_GET['id'] ?? 0);
$record = findMahasiswaById($id);

if ($id <= 0 || $record === null) {
    setFlash('danger', 'Data yang ingin dihapus tidak ditemukan.');
    redirect('index.php');
}

if (deleteMahasiswa($id)) {
    setFlash('success', 'Data mahasiswa berhasil dihapus.');
} else {
    setFlash('danger', 'Data mahasiswa gagal dihapus.');
}

redirect('index.php');
