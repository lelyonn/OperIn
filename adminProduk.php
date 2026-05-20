<?php
session_start();
require 'needAdmin.php';
require 'config.php';

$editData = null;
$kondisiOptions = ['Baru', 'Bekas'];
$statusOptions = ['Tersedia', 'Terjual', 'Nonaktif'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProduk = (int) ($_POST['id_produk'] ?? 0);
    $idJenis = (int) ($_POST['id_jenis'] ?? 0);
    $namaProduk = trim($_POST['nama_produk'] ?? '');
    $harga = (float) ($_POST['harga'] ?? 0);
    $kondisi = $_POST['kondisi'] ?? 'Bekas';
    $fakultas = trim($_POST['fakultas'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $gambar = trim($_POST['gambar'] ?? '');
    $statusProduk = $_POST['status_produk'] ?? 'Tersedia';

    if ($idJenis > 0 && $namaProduk !== '' && $harga >= 0 && $fakultas !== '') {
        if ($idProduk > 0) {
            $stmt = mysqli_prepare(
                $koneksi,
                'UPDATE produk
                 SET id_jenis = ?, nama_produk = ?, harga = ?, kondisi = ?, fakultas = ?, deskripsi = ?, gambar = ?, status_produk = ?
                 WHERE id_produk = ?'
            );
            mysqli_stmt_bind_param($stmt, 'isdsssssi', $idJenis, $namaProduk, $harga, $kondisi, $fakultas, $deskripsi, $gambar, $statusProduk, $idProduk);
        } else {
            $stmt = mysqli_prepare(
                $koneksi,
                'INSERT INTO produk (id_jenis, nama_produk, harga, kondisi, fakultas, deskripsi, gambar, status_produk)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
            );
            mysqli_stmt_bind_param($stmt, 'isdsssss', $idJenis, $namaProduk, $harga, $kondisi, $fakultas, $deskripsi, $gambar, $statusProduk);
        }

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    redirect_to('adminProduk.php');
}

if (($_GET['action'] ?? '') === 'delete') {
    $idProduk = (int) ($_GET['id'] ?? 0);

    if ($idProduk > 0) {
        $stmt = mysqli_prepare($koneksi, 'DELETE FROM produk WHERE id_produk = ?');
        mysqli_stmt_bind_param($stmt, 'i', $idProduk);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    redirect_to('adminProduk.php');
}

if (($_GET['action'] ?? '') === 'edit') {
    $idProduk = (int) ($_GET['id'] ?? 0);
    $stmt = mysqli_prepare(
        $koneksi,
        'SELECT id_produk, id_jenis, nama_produk, harga, kondisi, fakultas, deskripsi, gambar, status_produk
         FROM produk
         WHERE id_produk = ?'
    );
    mysqli_stmt_bind_param($stmt, 'i', $idProduk);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $editData = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

$jenisProduk = mysqli_query($koneksi, 'SELECT id_jenis, nama_jenis FROM jenis_produk ORDER BY nama_jenis ASC');
$jenisOptions = [];
while ($jenis = mysqli_fetch_assoc($jenisProduk)) {
    $jenisOptions[] = $jenis;
}

$produk = mysqli_query(
    $koneksi,
    'SELECT p.id_produk, p.nama_produk, p.harga, p.kondisi, p.fakultas, p.status_produk, p.gambar, jp.nama_jenis
     FROM produk p
     INNER JOIN jenis_produk jp ON jp.id_jenis = p.id_jenis
     ORDER BY p.id_produk DESC'
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Produk - OperIn</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-amber-50">
    <?php include 'components/navbar.php'; ?>

    <main class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">CRUD Produk</h1>
                <p class="text-gray-500">Kelola barang preloved yang tampil di OperIn.</p>
            </div>
            <a href="dashboardAdmin.php" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Dashboard</a>
        </div>

        <div class="grid xl:grid-cols-[420px_1fr] gap-6">
            <section class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">
                    <?= $editData ? 'Edit Produk' : 'Tambah Produk' ?>
                </h2>

                <form method="POST" class="space-y-4">
                    <input type="hidden" name="id_produk" value="<?= e($editData['id_produk'] ?? '') ?>">

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Jenis Produk</label>
                        <select name="id_jenis" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-sky-500">
                            <option value="">Pilih jenis produk</option>
                            <?php foreach ($jenisOptions as $jenis): ?>
                                <option value="<?= e($jenis['id_jenis']) ?>"
                                    <?= (int) ($editData['id_jenis'] ?? 0) === (int) $jenis['id_jenis'] ? 'selected' : '' ?>>
                                    <?= e($jenis['nama_jenis']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Nama Produk</label>
                        <input type="text" name="nama_produk" required
                            value="<?= e($editData['nama_produk'] ?? '') ?>"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-sky-500">
                    </div>

                    <div class="grid md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Harga</label>
                            <input type="number" name="harga" min="0" step="1000" required
                                value="<?= e($editData['harga'] ?? '') ?>"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-sky-500">
                        </div>

                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Fakultas</label>
                            <input type="text" name="fakultas" required
                                value="<?= e($editData['fakultas'] ?? '') ?>"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-sky-500">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Kondisi</label>
                            <select name="kondisi" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-sky-500">
                                <?php foreach ($kondisiOptions as $option): ?>
                                    <option value="<?= e($option) ?>" <?= ($editData['kondisi'] ?? 'Bekas') === $option ? 'selected' : '' ?>>
                                        <?= e($option) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Status</label>
                            <select name="status_produk" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-sky-500">
                                <?php foreach ($statusOptions as $option): ?>
                                    <option value="<?= e($option) ?>" <?= ($editData['status_produk'] ?? 'Tersedia') === $option ? 'selected' : '' ?>>
                                        <?= e($option) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Path Gambar</label>
                        <input type="text" name="gambar" placeholder="assets/produk1.jpg"
                            value="<?= e($editData['gambar'] ?? '') ?>"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-sky-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="4"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-sky-500"><?= e($editData['deskripsi'] ?? '') ?></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 bg-sky-600 text-white py-2 rounded-lg hover:bg-sky-700 font-semibold">
                            <?= $editData ? 'Simpan Perubahan' : 'Tambah Produk' ?>
                        </button>
                        <?php if ($editData): ?>
                            <a href="adminProduk.php" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100">Batal</a>
                        <?php endif; ?>
                    </div>
                </form>
            </section>

            <section class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm overflow-x-auto">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Data Produk</h2>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-100">
                            <th class="p-3">ID</th>
                            <th class="p-3">Produk</th>
                            <th class="p-3">Jenis</th>
                            <th class="p-3">Harga</th>
                            <th class="p-3">Kondisi</th>
                            <th class="p-3">Fakultas</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($item = mysqli_fetch_assoc($produk)): ?>
                            <tr class="border-b">
                                <td class="p-3"><?= e($item['id_produk']) ?></td>
                                <td class="p-3 font-medium"><?= e($item['nama_produk']) ?></td>
                                <td class="p-3"><?= e($item['nama_jenis']) ?></td>
                                <td class="p-3">Rp<?= number_format((float) $item['harga'], 0, ',', '.') ?></td>
                                <td class="p-3"><?= e($item['kondisi']) ?></td>
                                <td class="p-3"><?= e($item['fakultas']) ?></td>
                                <td class="p-3"><?= e($item['status_produk']) ?></td>
                                <td class="p-3">
                                    <div class="flex gap-2">
                                        <a href="adminProduk.php?action=edit&id=<?= e($item['id_produk']) ?>"
                                            class="px-3 py-1 bg-orange-400 text-white rounded hover:bg-orange-500">Edit</a>
                                        <a href="adminProduk.php?action=delete&id=<?= e($item['id_produk']) ?>"
                                            onclick="return confirm('Hapus produk ini?')"
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
