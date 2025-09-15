<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: login_admin.php");
    exit();
}

include 'koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM absensi ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Presensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            background-color: #ffffff;
        }
        footer {
            margin-top: 50px;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg rounded-4">
            <div class="card-body">
                <h2 class="text-center mb-4">📅 Data Presensi</h2>
                <div class="mb-3 text-center">
                    <a href="export_excel.php" class="btn btn-success">📥 Export ke Excel</a>
                    <a href="export_pdf.php" class="btn btn-danger">📄 Export ke PDF</a>
                    <a href="dashboard_admin.php" class="btn btn-secondary">🔙 Kembali</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['nis']; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['status']; ?></td>
                                    <td><?= $row['tanggal']; ?></td>
                                    <td><?= $row['waktu']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <footer class="text-center mt-4">&copy; <?php echo date('Y'); ?> @zidnirifqi</footer>
            </div>
        </div>
    </div>
</body>
</html>
