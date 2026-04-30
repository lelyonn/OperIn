<?php
session_start();
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
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
                        <a href="#" class="hover:text-orange-400"><img src="assets/pencil.svg" alt="Edit" class="w-6 h-6"></a>
                        <a href="tambahBarang.php" class="hover:text-orange-400"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></a>
                        <a href="login.php" class="hover:text-orange-400"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></a>
                    </div>
                </div>
            </div>
    
        </nav>
        <div class="flex items-center text-black font-bold text-7xl mx-auto my-auto">Selamat datang, ADMIN</div>
    </div>