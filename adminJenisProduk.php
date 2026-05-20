<?php
session_start();
require 'needAdmin.php';
require 'config.php';

$editData = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idJenis = (int) ($_POST['id_jenis'] ?? 0);
    $namaJenis = trim($_POST['nama_jenis'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');

    if ($namaJenis !== '') {
        if ($idJenis > 0) {
            $stmt = mysqli_prepare($koneksi, 'UPDATE jenis_produk SET nama_jenis = ?, deskripsi = ? WHERE id_jenis = ?');
            mysqli_stmt_bind_param($stmt, 'ssi', $namaJenis, $deskripsi, $idJenis);
        } else {
            $stmt = mysqli_prepare($koneksi, 'INSERT INTO jenis_produk (nama_jenis, deskripsi) VALUES (?, ?)');
            mysqli_stmt_bind_param($stmt, 'ss', $namaJenis, $deskripsi);
        }

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    redirect_to('adminJenisProduk.php');
}

if (($_GET['action'] ?? '') === 'delete') {
    $idJenis = (int) ($_GET['id'] ?? 0);

    if ($idJenis > 0) {
        $stmt = mysqli_prepare($koneksi, 'SELECT COUNT(*) AS total FROM produk WHERE id_jenis = ?');
        mysqli_stmt_bind_param($stmt, 'i', $idJenis);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if ((int) $row['total'] === 0) {
            $stmt = mysqli_prepare($koneksi, 'DELETE FROM jenis_produk WHERE id_jenis = ?');
            mysqli_stmt_bind_param($stmt, 'i', $idJenis);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    redirect_to('adminJenisProduk.php');
}

if (($_GET['action'] ?? '') === 'edit') {
    $idJenis = (int) ($_GET['id'] ?? 0);
    $stmt = mysqli_prepare($koneksi, 'SELECT id_jenis, nama_jenis, deskripsi FROM jenis_produk WHERE id_jenis = ?');
    mysqli_stmt_bind_param($stmt, 'i', $idJenis);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $editData = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

$jenisProduk = mysqli_query(
    $koneksi,
    'SELECT jp.id_jenis, jp.nama_jenis, jp.deskripsi, COUNT(p.id_produk) AS jumlah_produk
     FROM jenis_produk jp
     LEFT JOIN produk p ON p.id_jenis = jp.id_jenis
     GROUP BY jp.id_jenis, jp.nama_jenis, jp.deskripsi
     ORDER BY jp.id_jenis DESC'
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Jenis Produk - OperIn</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-amber-50">
    <?php include 'components/navbar.php'; ?>

    <main class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">CRUD Jenis Produk</h1>
                <p class="text-gray-500">Kelola master kategori untuk produk OperIn.</p>
            </div>
            <a href="dashboardAdmin.php" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Dashboard</a>
        </div>

        <div class="grid lg:grid-cols-[360px_1fr] gap-6">
            <section class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">
                    <?= $editData ? 'Edit Jenis Produk' : 'Tambah Jenis Produk' ?>
                </h2>

                <form method="POST" class="space-y-4">
                    <input type="hidden" name="id_jenis" value="<?= e($editData['id_jenis'] ?? '') ?>">

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Nama Jenis</label>
                        <input type="text" name="nama_jenis" required
                            value="<?= e($editData['nama_jenis'] ?? '') ?>"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-sky-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="4"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-sky-500"><?= e($editData['deskripsi'] ?? '') ?></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 bg-sky-600 text-white py-2 rounded-lg hover:bg-sky-700 font-semibold">
                            <?= $editData ? 'Simpan Perubahan' : 'Tambah Jenis' ?>
                        </button>
                        <?php if ($editData): ?>
                            <a href="adminJenisProduk.php" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100">Batal</a>
                        <?php endif; ?>
                    </div>
                </form>
            </section>

            <section class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm overflow-x-auto">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Data Jenis Produk</h2>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-100">
                            <th class="p-3">ID</th>
                            <th class="p-3">Nama Jenis</th>
                            <th class="p-3">Deskripsi</th>
                            <th class="p-3">Jumlah Produk</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($jenis = mysqli_fetch_assoc($jenisProduk)): ?>
                            <tr class="border-b">
                                <td class="p-3"><?= e($jenis['id_jenis']) ?></td>
                                <td class="p-3 font-medium"><?= e($jenis['nama_jenis']) ?></td>
                                <td class="p-3 text-gray-600"><?= e($jenis['deskripsi']) ?></td>
                                <td class="p-3"><?= e($jenis['jumlah_produk']) ?></td>
                                <td class="p-3">
                                    <div class="flex gap-2">
                                        <a href="adminJenisProduk.php?action=edit&id=<?= e($jenis['id_jenis']) ?>"
                                            class="px-3 py-1 bg-orange-400 text-white rounded hover:bg-orange-500">Edit</a>
                                        <a href="adminJenisProduk.php?action=delete&id=<?= e($jenis['id_jenis']) ?>"
                                            onclick="return confirm('Hapus jenis produk ini? Data yang masih dipakai produk tidak bisa dihapus.')"
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
</body>
</html>
