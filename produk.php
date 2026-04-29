<?php
session_start();
require 'dataProduk.php';


if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = $products;
}

$products = $_SESSION['products'];
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
        <div class="bg-sky-600 text-white font-semibold p-3 border-b border-white/20">
            <div class="max-w-7xl mx-auto px-4">
                Welcome To Operin: Platform Preloved Mahasiswa
            </div>
        </div>
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
         
        <!-- KATEGORI-KATEGORI -->
        <div class="flex justify-center gap-8 border-b-2 bg-amber-50 border-gray-300 shadow-lg p-4">
            <a href="" class="text-gray-600 hover:text-orange-500 transition-colors">Kategori</a>
            <a href="" class="text-gray-600 hover:text-orange-500 transition-colors">Urutkan</a>
            <a href="" class="text-gray-600 hover:text-orange-500 transition-colors">Filter</a>
            <a href="" class="text-gray-600 hover:text-orange-500 transition-colors">Promo</a>
        </div>

        <!-- HEADER SECTION PRODUK PROMOSI -->
        <div class="max-w-7xl mx-auto px-4 w-full py-5">
            <!-- PRODUK REKOMENDASI -->
            <div class="flex items-center justify-between py-2 px-5 border-b-2 bg-gray-300 border-sky-300">
                <h2 class="text-black font-semibold text-lg">Produk Rekomendasi</h2>
                <a href="" class="text-sky-500 text-sm hover:text-orange-500 transition-colors">Browse All Product →</a>
            </div>
                        
            <!-- ETALASE -->
            <div id="productGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 pt-4">
                <?php
                foreach ($products as $index => $p) : ?>
                <a href="detailProduk.php?id=<?= $index ?>" class="h-full">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-md overflow-hidden cursor-pointer hover:-translate-y-1 hover:shadow-xl transition-all h-full flex flex-col">
                        <img src="<?= $p['image'] ?>" class="w-full aspect-square object-cover bg-gray-100 shrink-0">
                        <div class="p-2.5 flex-1 flex flex-col">
                            <div class="min-h-[3rem]">
                                <p class="text-lg text-gray-700 line-clamp-2 mb-1 leading-tight"><?= $p['name'] ?></p>
                            </div>
                            <div class="mt-auto">
                                <p class="text-base font-semibold text-orange-500 mb-1">
                                    Rp<?= number_format($p['price'], 0, ',', '.') ?>
                                </p>
                                <div class="flex justify-between text-xs">
                                    <span class="text-gray-400 text-[15px]"><?= $p['fakultas'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>    
        
        <!-- HEADER SECTION PRODUK PROMOSI -->
        <div class="max-w-7xl mx-auto px-4 w-full py-10">
            <!-- PRODUK REKOMENDASI -->
            <div class="flex items-center justify-between py-2 px-5 border-b-2 bg-gray-300 border-sky-300">
                <h2 class="text-black font-semibold text-lg">Produk Rekomendasi</h2>
                <a href="" class="text-sky-500 text-sm hover:text-orange-500 transition-colors">Browse All Product →</a>
            </div>
                        
            <!-- ETALASE -->
            <div id="productGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 pt-4">
                <?php
                foreach ($products as $index => $p) : ?>
                <a href="detailProduk.php?id=<?= $index ?>" class="h-full">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-md overflow-hidden cursor-pointer hover:-translate-y-1 hover:shadow-xl transition-all h-full flex flex-col">
                        <img src="<?= $p['image'] ?>" class="w-full aspect-square object-cover bg-gray-100 shrink-0">
                        <div class="p-2.5 flex-1 flex flex-col">
                            <div class="min-h-[3rem]">
                                <p class="text-lg text-gray-700 line-clamp-2 mb-1 leading-tight"><?= $p['name'] ?></p>
                            </div>
                            <div class="mt-auto">
                                <p class="text-base font-semibold text-orange-500 mb-1">
                                    Rp<?= number_format($p['price'], 0, ',', '.') ?>
                                </p>
                                <div class="flex justify-between text-xs">
                                    <span class="text-gray-400 text-[15px]"><?= $p['fakultas'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>    
        <!-- FOOTER -->
        <footer class="bg-sky-600 text-white pt-12 pb-8 mt-auto">
            <div class="mx-30 grid grid-cols-1 md:grid-cols-4 gap-8 border-b border-sky-400 pb-8">
                <!-- Kolom 1: Brand -->
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <img src="assets/logo-operin.png" alt="Logo Operin" class="max-h-8 brightness-0 invert">
                        <span class="font-bold text-2xl">OperIn</span>
                    </div>
                    <p class="text-sky-100 text-sm leading-5">
                        Platform jual beli barang preloved khusus mahasiswa. Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse recusandae accusantium in facere
                    </p>
                </div>

                <!-- Kolom 2: Navigasi -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Layanan</h3>
                    <ul class="space-y-2 text-sm text-sky-100">
                        <li><a href="#" class="hover:text-orange-400 transition-colors">Bantuan</a></li>
                        <li><a href="#" class="hover:text-orange-400 transition-colors">Cara Jual</a></li>
                        <li><a href="#" class="hover:text-orange-400 transition-colors">Cara Beli</a></li>
                        <li><a href="#" class="hover:text-orange-400 transition-colors">Keamanan</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Tentang Kami -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Tentang OperIn</h3>
                    <ul class="space-y-2 text-sm text-sky-100">
                        <li><a href="#" class="hover:text-orange-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-orange-400 transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-orange-400 transition-colors">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: Kontak -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Ikuti Kami</h3>
                    <div class="flex gap-4 mb-4">
                        <a href="#" class="p-2 bg-sky-700 rounded-full hover:bg-orange-400 transition-all"><img src="assets/instagram.svg" class="w-5 h-5"></a>
                        <a href="#" class="p-2 bg-sky-700 rounded-full hover:bg-orange-400 transition-all"><img src="assets/github.svg" class="w-5 h-5"></a>
                        <a href="#" class="p-2 bg-sky-700 rounded-full hover:bg-orange-400 transition-all"><img src="assets/tiktok.svg" class="w-5 h-5"></a>
                    </div>
                    <p class="text-sm text-sky-100 font-medium">Email: help@operin.id</p>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center mt-8 text-sky-200 text-xs">
                <p>&copy; 2026 OperIn. All rights reserved. Platform Preloved Mahasiswa.</p>
            </div>
        </footer>
        <!-- END OF FOOTER -->
    </div>
</body>
</html>