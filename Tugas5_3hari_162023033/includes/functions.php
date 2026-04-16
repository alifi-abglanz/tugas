<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function db(): mysqli
{
    global $connection;

    return $connection;
}

function h(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $path): never
{
    header('Location: ' . $path);
    exit;
}

function setFlash(string $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function getFlash(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}

function validateMahasiswa(array $input): array
{
    $errors = [];

    if (trim($input['nim'] ?? '') === '') {
        $errors[] = 'NIM wajib diisi.';
    }

    if (trim($input['nama'] ?? '') === '') {
        $errors[] = 'Nama wajib diisi.';
    }

    $email = trim($input['email'] ?? '');
    if ($email === '') {
        $errors[] = 'Email wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid.';
    }

    if (trim($input['jurusan'] ?? '') === '') {
        $errors[] = 'Jurusan wajib diisi.';
    }

    return $errors;
}

function getMahasiswa(?string $keyword = null): array
{
    $sql = 'SELECT id, nim, nama, email, jurusan, created_at, updated_at FROM mahasiswa';
    $types = '';
    $params = [];

    if ($keyword !== null && $keyword !== '') {
        $sql .= ' WHERE nim LIKE ? OR nama LIKE ? OR email LIKE ? OR jurusan LIKE ?';
        $search = '%' . $keyword . '%';
        $types = 'ssss';
        $params = [$search, $search, $search, $search];
    }

    $sql .= ' ORDER BY id DESC';

    $statement = mysqli_prepare(db(), $sql);
    if ($statement === false) {
        return [];
    }

    if ($types !== '') {
        mysqli_stmt_bind_param($statement, $types, ...$params);
    }

    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $rows = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
    mysqli_stmt_close($statement);

    return $rows;
}

function findMahasiswaById(int $id): ?array
{
    $statement = mysqli_prepare(
        db(),
        'SELECT id, nim, nama, email, jurusan FROM mahasiswa WHERE id = ? LIMIT 1'
    );

    if ($statement === false) {
        return null;
    }

    mysqli_stmt_bind_param($statement, 'i', $id);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $row = $result ? mysqli_fetch_assoc($result) : null;
    mysqli_stmt_close($statement);

    return $row ?: null;
}

function nimOrEmailExists(string $nim, string $email, ?int $excludeId = null): bool
{
    $sql = 'SELECT id FROM mahasiswa WHERE (nim = ? OR email = ?)';
    $types = 'ss';
    $params = [$nim, $email];

    if ($excludeId !== null) {
        $sql .= ' AND id != ?';
        $types .= 'i';
        $params[] = $excludeId;
    }

    $sql .= ' LIMIT 1';

    $statement = mysqli_prepare(db(), $sql);
    if ($statement === false) {
        return true;
    }

    mysqli_stmt_bind_param($statement, $types, ...$params);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $exists = $result && mysqli_fetch_assoc($result) !== null;
    mysqli_stmt_close($statement);

    return $exists;
}

function createMahasiswa(array $input): bool
{
    $nim = trim($input['nim']);
    $nama = trim($input['nama']);
    $email = trim($input['email']);
    $jurusan = trim($input['jurusan']);

    $statement = mysqli_prepare(
        db(),
        'INSERT INTO mahasiswa (nim, nama, email, jurusan) VALUES (?, ?, ?, ?)'
    );

    if ($statement === false) {
        return false;
    }

    mysqli_stmt_bind_param($statement, 'ssss', $nim, $nama, $email, $jurusan);
    $success = mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    return $success;
}

function updateMahasiswa(int $id, array $input): bool
{
    $nim = trim($input['nim']);
    $nama = trim($input['nama']);
    $email = trim($input['email']);
    $jurusan = trim($input['jurusan']);

    $statement = mysqli_prepare(
        db(),
        'UPDATE mahasiswa SET nim = ?, nama = ?, email = ?, jurusan = ? WHERE id = ?'
    );

    if ($statement === false) {
        return false;
    }

    mysqli_stmt_bind_param($statement, 'ssssi', $nim, $nama, $email, $jurusan, $id);
    $success = mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    return $success;
}

function deleteMahasiswa(int $id): bool
{
    $statement = mysqli_prepare(db(), 'DELETE FROM mahasiswa WHERE id = ?');

    if ($statement === false) {
        return false;
    }

    mysqli_stmt_bind_param($statement, 'i', $id);
    $success = mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    return $success;
}
