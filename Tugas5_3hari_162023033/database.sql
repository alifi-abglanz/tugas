CREATE DATABASE IF NOT EXISTS crud_php_native;
USE crud_php_native;

CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    jurusan VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO mahasiswa (nim, nama, email, jurusan) VALUES
    ('2210114001', 'Alya Rahma', 'alya.rahma@example.com', 'Sistem Informasi'),
    ('2210114002', 'Bima Pratama', 'bima.pratama@example.com', 'Teknik Informatika'),
    ('2210114003', 'Citra Lestari', 'citra.lestari@example.com', 'Manajemen Informatika');
