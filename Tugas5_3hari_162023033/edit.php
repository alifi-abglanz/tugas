<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

$id = (int) ($_GET['id'] ?? 0);
$record = findMahasiswaById($id);

if ($id <= 0 || $record === null) {
    setFlash('danger', 'Data mahasiswa tidak ditemukan.');
    redirect('index.php');
}

$pageTitle = 'Edit Mahasiswa';
$data = $record;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nim' => trim($_POST['nim'] ?? ''),
        'nama' => trim($_POST['nama'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'jurusan' => trim($_POST['jurusan'] ?? ''),
    ];

    $errors = validateMahasiswa($data);

    if ($errors === [] && nimOrEmailExists($data['nim'], $data['email'], $id)) {
        $errors[] = 'NIM atau email sudah digunakan oleh data lain.';
    }

    if ($errors === [] && updateMahasiswa($id, $data)) {
        setFlash('success', 'Data mahasiswa berhasil diperbarui.');
        redirect('index.php');
    }

    if ($errors === []) {
        $errors[] = 'Gagal memperbarui data.';
    }
}

require_once __DIR__ . '/partials/header.php';
?>
<section>
    <?php require __DIR__ . '/partials/form.php'; ?>
</section>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
