<?php
session_start();
//array user sementara
$users = [
    [
        'email' => 'mahasiswa@student.uns.ac.id',
        'password' => 'password123',
        'nama' => 'Zidnii Rajwa'
    ]
];

$admins = [
    [
        'email' => 'admin@operin.id',
        'password' => 'admin123',
        'nama' => 'Admin OperIn'
    ]
];
$input_email = $_POST['email'] ?? ''; 
$input_pass  = $_POST['password'] ?? '';

$login_sukses = false;
$nama_user = "";
$redirect_url = "produk.php";
$is_admin = false;

foreach ($users as $user) {
    if ($user['email'] === $input_email && $user['password'] === $input_pass) {
        $login_sukses = true;
        $nama_user = $user['nama'];
        $redirect_url = "produk.php";
        $is_admin = false;
        break;
    }
}

foreach ($admins as $admin) {
    if ($admin['email'] === $input_email && $admin['password'] === $input_pass) {
        $login_sukses = true;
        $nama_user = $admin['nama'];
        $redirect_url = "dashboardAdmin.php";
        $is_admin = true;
        break;
    }
}

if ($login_sukses) {
    $_SESSION['user_name'] = $nama_user;
    $_SESSION['is_logged_in'] = true;
    $_SESSION['is_admin'] = $is_admin;
} else {
    header("Location: login.php?error=Gagal Login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Login...</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <meta http-equiv="refresh" content="2;url=<?= $redirect_url ?>">
</head>
<body class="bg-sky-600 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-xl text-center">
        <div class="mb-4 text-green-500">
            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">Halo, <?= htmlspecialchars($nama_user) ?>!</h1>
        <p class="text-gray-500 mt-2">Login berhasil. Mengalihkan Anda ke halaman produk...</p>
        <div class="mt-4 animate-spin inline-block w-6 h-6 border-4 border-sky-500 border-t-transparent rounded-full"></div>
    </div>
</body>
</html>
