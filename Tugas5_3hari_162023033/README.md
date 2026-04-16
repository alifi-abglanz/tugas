# CRUD PHP Native

Project CRUD sederhana berbasis PHP native, MySQL, HTML, CSS, dan JavaScript.

## Fitur

- Tampil data mahasiswa
- Tambah data
- Edit data
- Hapus data
- Pencarian data
- Validasi input dasar
- Query menggunakan prepared statement

## Struktur

- `index.php` halaman daftar data
- `create.php` form tambah data
- `edit.php` form edit data
- `delete.php` proses hapus data
- `includes/functions.php` helper CRUD
- `config/database.php` koneksi MySQL
- `database.sql` schema dan sample data

## Menjalankan

1. Buat database dengan isi file `database.sql`.
2. Sesuaikan kredensial pada `config/database.php` bila perlu.
3. Jalankan lewat web server PHP/Laragon/XAMPP.
