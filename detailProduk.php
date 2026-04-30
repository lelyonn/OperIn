<?php
session_start();
require 'dataProduk.php';

if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = $products;
}

$products = $_SESSION['products'];

$id = $_GET['id'];
$p = $products[$id];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $p['name'] ?> - OperIn</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-amber-50">

        <!-- NAVBAR -->
        <nav class="sticky top-0 z-50">
    
            <div class="bg-sky-600 py-4 shadow-lg">
                <div class="max-w-7xl mx-auto px-4 flex items-center justify-between gap-4">
                    <!-- LOGO -->
                    <div class="flex items-center text-white font-bold text-3xl shrink-0">
                        <a href="index.php" class="flex items-center">
                            <img src="assets/logo-operin.png" alt="Logo Operin" class="max-h-8 pr-2">
                            <span>OperIn</span>
                        </a>
                    </div>

                    <!-- SEARCH BAR  -->
                    <form class="flex flex-1 max-w-2xl">
                        <input type="text" name="search" id="search" placeholder="Cari Barang..." 
                        class="w-full pl-5 p-2 text-black font-normal text-lg bg-white border border-orange-400 focus:outline-orange-400 rounded-l-lg">
                        <button type="submit" class="px-5 bg-orange-400 text-white rounded-r-lg hover:bg-orange-500 transition-all">
                            <img src="assets/search.svg" alt="" class="max-h-6">
                        </button>
                    </form>

                    <!-- ICONS -->
                    <div class="flex gap-5 shrink-0 text-white">
                        <a href="#" class="hover:text-orange-400"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"></path></svg></a>
                        <a href="tambahBarang.php" class="hover:text-orange-400"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></a>
                        <a href="login.php" class="hover:text-orange-400"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></a>
                    </div>
                </div>
            </div>
    
        </nav>
        <!-- END OF NAVBAR -->

    <!-- KONTEN -->
    <div class="max-w-4xl mx-auto mt-10 px-6">
    
        <!-- NAVIGASI -->
        <p class="text-sm text-gray-400 mb-6">
            <a href="produk.php" class="hover:text-sky-400">Beranda</a> > <?= $p['name'] ?>
        </p>

        <!-- BACK -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 flex gap-10">
            <a href="produk.php" class="flex border bg-sky-600 border-sky-900 max-h-8 items-center pb-2 px-2 hover:bg-sky-800 rounded-lg">
                <div class="text-2xl text-white">
                    ← 
                </div>
            </a>

            <!-- GAMBAR PRODUK -->
            <div class="w-72 h-72 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100">
                <img src="<?= $p['image'] ?>" alt="<?= $p['name'] ?>"
                class="w-full h-full object-cover">
            </div>

            <!-- INFO PRODUK -->
            <div class="flex flex-col justify-between flex-1">
                <div>
                    <!-- <span class="bg-orange-50 text-orange-500 border border-orange-200 px-3 py-1 rounded-full text-xs font-medium">
                        <?= $p['kondisi'] ?>
                    </span> -->
                    <h1 class="text-2xl font-bold text-gray-800 mt-3 mb-2"><?= $p['name'] ?></h1>
                    <p class="text-3xl font-bold text-orange-500 mb-4">
                        Rp<?= number_format($p['price'], 0, ',', '.') ?>
                    </p>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <?= $p['fakultas'] ?>
                    </div>
                    <p class="text-gray-600"><?= $p['description'] ?></p>
                </div>

                <!-- TOMBOL -->
                <div class="flex gap-3 mt-8">
                    <a href="hubungiPenjual.php?id=<?= $id ?>"
                    class="px-6 py-2 bg-sky-400 text-white rounded-lg hover:bg-sky-600 transition-all font-semibold">
                        Hubungi Penjual
                    </a>
                </div>
            </div>

        </div>
    </div>

</body>
</html>