<?php

declare(strict_types=1);

$data = $data ?? [
    'nim' => '',
    'nama' => '',
    'email' => '',
    'jurusan' => '',
];
$errors = $errors ?? [];
?>
<?php if ($errors !== []): ?>
    <div class="alert alert-danger">
        <strong>Periksa input:</strong>
        <ul class="error-list">
            <?php foreach ($errors as $error): ?>
                <li><?= h($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" class="card form-card" novalidate>
    <div class="form-grid">
        <label class="field">
            <span>NIM</span>
            <input type="text" name="nim" maxlength="20" value="<?= h($data['nim']); ?>" required>
        </label>

        <label class="field">
            <span>Nama</span>
            <input type="text" name="nama" maxlength="100" value="<?= h($data['nama']); ?>" required>
        </label>

        <label class="field">
            <span>Email</span>
            <input type="email" name="email" maxlength="100" value="<?= h($data['email']); ?>" required>
        </label>

        <label class="field">
            <span>Jurusan</span>
            <input type="text" name="jurusan" maxlength="100" value="<?= h($data['jurusan']); ?>" required>
        </label>
    </div>

    <div class="form-actions">
        <button type="submit" class="button">Simpan Data</button>
        <a href="index.php" class="button button-secondary">Batal</a>
    </div>
</form>
