<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}
require_once "koneksi.php";
date_default_timezone_set("Asia/Jakarta"); 
// Tambah siswa
if (isset($_POST['tambah_siswa'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    mysqli_query($conn, "INSERT INTO siswa (nis, nama) VALUES ('$nis', '$nama')");
    header("Location: dashboard_admin.php");
    exit;
}

// Hapus siswa
if (isset($_GET['hapus_siswa'])) {
    $nis = $_GET['hapus_siswa'];
    mysqli_query($conn, "DELETE FROM siswa WHERE nis = '$nis'");
    header("Location: dashboard_admin.php");
    exit;
}

// Ambil data siswa dan absensi
$data_siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nis ASC");
$data_absensi = mysqli_query($conn, "SELECT * FROM absensi ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <!-- DataTables CSS -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
	<link rel="icon" type="image/png" href="1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header, footer {
            background-color: #343a40;
            color: white;
        }
        header .admin-icon {
            position: absolute;
            top: 10px;
            right: 60px;
            color: white;
            font-size: 1.5rem;
        }
        footer {
            margin-top: auto;
            padding: 10px 0;
            text-align: center;
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
    <!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function () {
    $('#tabelAbsensi').DataTable({
      "pageLength": 5,
      "lengthChange": false,
      "scrollX": true,
      "language": {
        "search": "Cari:",
        "paginate": {
          "previous": "Sebelumnya",
          "next": "Selanjutnya"
        },
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data"
      }
    });
  });
</script>

<!-- Header -->
<header class="py-3 mb-4 position-relative">
    <div class="container d-flex justify-content-center align-items-center">
        <h4 class="m-0">Dashboard Presensi</h4>
        <a href="dashboard_admin.php" class="admin-icon" title="Dashboard Admin">
            <i class="bi bi-person-circle"></i>
        </a>
        <a href="logout.php" class="btn btn-danger position-absolute end-0 me-3">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</header>

<div class="container mb-5">

    <!-- Form Tambah Siswa -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Tambah Data Siswa</div>
        <div class="card-body">
            <form method="POST">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="nis" class="form-control" placeholder="NIS" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Siswa" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="tambah_siswa" class="btn btn-success w-100">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Siswa -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">Data Siswa</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($s = mysqli_fetch_assoc($data_siswa)) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($s['nis']) ?></td>
                        <td><?= htmlspecialchars($s['nama']) ?></td>
                        <td>
                            <a href="?hapus_siswa=<?= $s['nis'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus siswa ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <!-- Laporan Absensi -->
    <div class="table-responsive">
  <table id="tabelAbsensi" class="table table-striped table-bordered text-center" style="width:100%">
    <thead class="table-dark">
      <tr>
        <a href="export_excel.php" class="btn btn-dark mb-3">
  <i class="bi bi-file-earmark-excel"></i> Download Excel
</a>
        <th>No</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>Jenis Absen</th>
        <th>NIS</th>
        <th>Nama</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM absensi ORDER BY tanggal DESC, waktu DESC");
        while ($data = mysqli_fetch_assoc($query)) {
      ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $data['tanggal'] ?></td>
          <td><?= $data['waktu'] ?></td>
          <td><?= $data['jenis_absen'] ?></td>
          <td><?= $data['nis'] ?></td>
          <td><?= $data['nama'] ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</div>

<!-- Footer -->
<footer>
    &copy; <?= date('Y') ?> <strong>zidnirifqi</strong> | Presensi Magang
</footer>

</body>
</html>
