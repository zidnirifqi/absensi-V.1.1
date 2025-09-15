<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}
require_once "koneksi.php";

// Ambil data absensi
$query = "SELECT * FROM absensi ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        header, footer {
            background-color: #343a40;
            color: white;
        }
        .table-container {
            background-color: #e2e3e5;
            padding: 20px;
            border-radius: 10px;
        }
        .table thead {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>

<!-- Header -->
<header class="py-3 mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <h4 class="m-0 text-center w-100">Dashboard Admin - History Presensi</h4>
        <a href="logout.php" class="btn btn-danger position-absolute end-0 me-3"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
</header>

<!-- Konten Utama -->
<div class="container mb-5">
    <div class="table-container shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Data Absensi Siswa</h5>
            <a href="export_excel.php" class="btn btn-success"><i class="bi bi-file-earmark-excel"></i> Export Excel</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Jenis Absen</th>
                        <th>NIS</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['tanggal']) ?></td>
                            <td><?= htmlspecialchars($row['waktu']) ?></td>
                            <td><?= htmlspecialchars($row['jenis_absen']) ?></td>
                            <td><?= htmlspecialchars($row['nis']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center py-3">
    &copy; <?= date('Y') ?> <strong>Zidnirifqi</strong>. All Rights Reserved.
</footer>

</body>
</html>
