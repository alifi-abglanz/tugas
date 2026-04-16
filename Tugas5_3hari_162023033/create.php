<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Tambah Mahasiswa';
$data = [
    'nim' => '',
    'nama' => '',
    'email' => '',
    'jurusan' => '',
];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nim' => trim($_POST['nim'] ?? ''),
        'nama' => trim($_POST['nama'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'jurusan' => trim($_POST['jurusan'] ?? ''),
    ];

    $errors = validateMahasiswa($data);

    if ($errors === [] && nimOrEmailExists($data['nim'], $data['email'])) {
        $errors[] = 'NIM atau email sudah digunakan.';
    }

    if ($errors === [] && createMahasiswa($data)) {
        setFlash('success', 'Data mahasiswa berhasil ditambahkan.');
        redirect('index.php');
    }

    if ($errors === []) {
        $errors[] = 'Gagal menyimpan data ke database.';
    }
}

require_once __DIR__ . '/partials/header.php';
?>
<section>
    <?php require __DIR__ . '/partials/form.php'; ?>
</section>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
