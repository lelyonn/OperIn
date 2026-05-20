CREATE DATABASE IF NOT EXISTS operin_db;
USE operin_db;

CREATE TABLE IF NOT EXISTS jenis_produk (
    id_jenis INT AUTO_INCREMENT PRIMARY KEY,
    nama_jenis VARCHAR(100) NOT NULL,
    deskripsi VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY,
    id_jenis INT NOT NULL,
    nama_produk VARCHAR(150) NOT NULL,
    harga DECIMAL(12, 2) NOT NULL,
    kondisi ENUM('Baru', 'Bekas') NOT NULL DEFAULT 'Bekas',
    fakultas VARCHAR(50) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255),
    status_produk ENUM('Tersedia', 'Terjual', 'Nonaktif') NOT NULL DEFAULT 'Tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_produk_jenis
        FOREIGN KEY (id_jenis)
        REFERENCES jenis_produk(id_jenis)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

INSERT INTO jenis_produk (nama_jenis, deskripsi) VALUES
('Perlengkapan Kos', 'Barang kebutuhan kos seperti setrika, rice cooker, kipas, dan alat kamar.'),
('Perlengkapan Kampus', 'Barang pendukung kuliah seperti kalkulator, buku, laptop, dan alat tulis.'),
('Fashion', 'Pakaian atau aksesoris preloved mahasiswa.'),
('Dekorasi', 'Barang dekorasi kamar atau meja belajar.');

INSERT INTO produk (id_jenis, nama_produk, harga, kondisi, fakultas, deskripsi, gambar, status_produk) VALUES
(4, 'Boneka Totoro dikasih mantan', 185000, 'Bekas', 'FEB', 'Boneka Totoro kondisi masih bagus dan cocok untuk dekorasi kamar kos.', 'assets/produk1.jpg', 'Tersedia'),
(2, 'Calculator Casio Scientific', 275000, 'Bekas', 'FMIPA', 'Sangat membantu buat matkul kalkulus. Semua tombol masih empuk dan berfungsi.', 'assets/produk2.jpg', 'Tersedia'),
(2, 'Laptop ASUS 2024', 5750000, 'Bekas', 'FT', 'Laptop baru pakai 3 bulan. Cocok untuk kuliah, coding, dan desain ringan.', 'assets/produk3.jpg', 'Tersedia'),
(1, 'Setrika Maspion', 175000, 'Bekas', 'FIB', 'Panasnya stabil, kabel masih bagus, dan aman untuk kebutuhan kos.', 'assets/produk4.jpg', 'Tersedia'),
(3, 'Kemeja Flanel H&M', 75000, 'Bekas', 'FT', 'Size L, warna tidak pudar, bahan adem buat ngampus.', 'assets/produk5.jpg', 'Tersedia');
