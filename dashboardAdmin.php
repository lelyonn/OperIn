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
        <?php include 'components/navbar.php'; ?>
            <!-- END OF NAVBAR  -->
        <div class="flex items-center text-black font-bold text-7xl mx-auto my-auto">Selamat datang, ADMIN</div>
        <!-- FOOTER -->
         <?php include 'components/footer.php'; ?>
         <!-- END OF FOOTER -->
    </div>