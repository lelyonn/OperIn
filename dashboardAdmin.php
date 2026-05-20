<?php
session_start();
require 'needAdmin.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OperIn - Platform Preloved Mahasiswa</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <!-- PRODUK -->

    <div id="produk" class="flex flex-col min-h-screen bg-amber-50">
        <!-- NAVBAR -->
        <?php include 'components/navbar.php'; ?>
            <!-- END OF NAVBAR  -->
        <main class="max-w-6xl mx-auto px-4 py-12 w-full">
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-800">Dashboard Admin OperIn</h1>
                <p class="text-gray-500 mt-2">Kelola data master dan produk yang digunakan pada database OperIn.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <a href="adminJenisProduk.php" class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-lg transition-all">
                    <p class="text-sm text-sky-600 font-semibold mb-2">Tabel 1</p>
                    <h2 class="text-2xl font-bold text-gray-800">Edit Jenis Produk</h2>
                    <p class="text-gray-500 mt-2">Tambah, lihat, ubah, dan hapus kategori produk seperti Perlengkapan Kos atau Perlengkapan Kampus.</p>
                </a>

                <a href="adminProduk.php" class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-lg transition-all">
                    <p class="text-sm text-orange-500 font-semibold mb-2">Tabel 2</p>
                    <h2 class="text-2xl font-bold text-gray-800">Edit Produk</h2>
                    <p class="text-gray-500 mt-2">Tambah, lihat, ubah, dan hapus barang preloved yang berelasi dengan jenis produk.</p>
                </a>
            </div>
        </main>
        <!-- FOOTER -->
         <?php include 'components/footer.php'; ?>
         <!-- END OF FOOTER -->
    </div>
