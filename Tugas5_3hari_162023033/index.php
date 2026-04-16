<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Daftar Mahasiswa';
$flash = getFlash();
$keyword = trim($_GET['q'] ?? '');
$mahasiswa = getMahasiswa($keyword);

require_once __DIR__ . '/partials/header.php';
?>

<section class="toolbar card">
    <form method="get" class="search-form">
        <input
            type="search"
            name="q"
            placeholder="Cari NIM, nama, email, atau jurusan..."
            value="<?= h($keyword); ?>"
        >
        <button type="submit" class="button">Cari</button>
        <?php if ($keyword !== ''): ?>
            <a href="index.php" class="button button-secondary">Reset</a>
        <?php endif; ?>
    </form>

    <a href="create.php" class="button">+ Tambah Mahasiswa</a>
</section>

<?php if ($flash !== null): ?>
    <div class="alert alert-<?= h($flash['type']); ?>">
        <?= h($flash['message']); ?>
    </div>
<?php endif; ?>

<section class="card table-card">
    <div class="table-head">
        <h2>Data Mahasiswa</h2>
        <p><?= count($mahasiswa); ?> data ditemukan</p>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($mahasiswa === []): ?>
                    <tr>
                        <td colspan="6" class="empty-state">Belum ada data mahasiswa.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($mahasiswa as $index => $row): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= h($row['nim']); ?></td>
                            <td><?= h($row['nama']); ?></td>
                            <td><?= h($row['email']); ?></td>
                            <td><?= h($row['jurusan']); ?></td>
                            <td class="actions">
                                <a href="edit.php?id=<?= (int) $row['id']; ?>" class="button button-small button-secondary">Edit</a>
                                <a
                                    href="delete.php?id=<?= (int) $row['id']; ?>"
                                    class="button button-small button-danger js-delete"
                                    data-name="<?= h($row['nama']); ?>"
                                >
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
