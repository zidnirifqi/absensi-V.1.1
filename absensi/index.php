<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "db_absensi");
date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d');
$waktu = date('H:i:s');


// Notifikasi
$notif = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = $_POST['nis'];
    $jenis_absen = $_POST['jenis_absen'];
    $tanggal = date("Y-m-d");
    $waktu = date("H:i:s");

    // Cek apakah NIS valid
    $cek = $conn->query("SELECT * FROM siswa WHERE nis = '$nis'");
    if ($cek->num_rows > 0) {
        $nama = $cek->fetch_assoc()['nama'];

        // Cek apakah sudah absen jenis yang sama hari ini
        $cekAbsen = $conn->query("SELECT * FROM absensi WHERE nis = '$nis' AND tanggal = '$tanggal' AND jenis_absen = '$jenis_absen'");
        if ($cekAbsen->num_rows > 0) {
            $notif = "Anda sudah absen $jenis_absen hari ini!";
        } else {
            // Cek jika sudah lengkap absen hari ini
            $cekMasuk = $conn->query("SELECT * FROM absensi WHERE nis = '$nis' AND tanggal = '$tanggal' AND jenis_absen = 'Masuk'");
            $cekKeluar = $conn->query("SELECT * FROM absensi WHERE nis = '$nis' AND tanggal = '$tanggal' AND jenis_absen = 'Keluar'");

            $conn->query("INSERT INTO absensi (tanggal, waktu, jenis_absen, nis, nama) VALUES ('$tanggal', '$waktu', '$jenis_absen', '$nis', '$nama')");
            if ($cekMasuk->num_rows > 0 && $cekKeluar->num_rows > 0) {
                $notif = "Anda sudah absen Masuk dan Keluar hari ini!";
            } else {
                $notif = "Berhasil absen $jenis_absen!";
            }
        }
    } else {
        $notif = "NIS tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Presensi Magang</title>
  <link rel="icon" type="image/png" href="1.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      background-color: #f8f9fa;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .navbar, .footer {
      background-color: #343a40;
    }
    .navbar .navbar-brand,
    .navbar .btn,
    .footer {
      color: white;
    }
    .form-section {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .footer {
      padding: 10px 0;
      margin-top: auto;
    }
    .btn-gray {
      background-color: #343a40;
      color: white;
    }
    .btn-gray:hover {
      background-color: #495057;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">Presensi Magang</a>
    <div class="ms-auto">
      <a href="dashboard_admin.php" class="btn btn-outline-light">
        <i class="bi bi-person-circle"></i> 
      </a>
    </div>
  </div>
</nav>

<!-- Konten Tengah -->
<div class="container mb-5 d-flex justify-content-center align-items-center" style="flex:1;">
  <div class="col-md-6 form-section">
    <h4 class="text-center mb-4 fw-semibold">Form Presensi Magang</h4>

    <!-- Notifikasi -->
    <?php if ($notif): ?>
      <div class="alert alert-info alert-dismissible fade show" role="alert" id="notifAlert">
        <?= $notif ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <!-- Form -->
    <form method="POST" autocomplete="off">
      <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal & Waktu</label>
        <input type="text" class="form-control" id="tanggal" readonly>
      </div>

      <div class="mb-3">
        <label for="jenis_absen" class="form-label">Jenis Presensi</label>
        <select class="form-select" name="jenis_absen" required>
          <option value="">-- Pilih Jenis --</option>
          <option value="Masuk">Absen Masuk</option>
          <option value="Keluar">Absen Keluar</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="nis" class="form-label">NIS</label>
        <input type="text" class="form-control" name="nis" id="nis" required onkeyup="getNama()">
      </div>

      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" disabled>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-gray">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Footer -->
<footer class="footer text-center text-white">
  <div class="container">
    <small>&copy; <?= date('Y') ?> zidnirifqi | Presensi Magang </small>
  </div>
</footer>

<!-- Script Tanggal Real-time -->
<script>
  function updateTanggal() {
    const now = new Date();
    const tanggal = now.toLocaleDateString('id-ID', {
      weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });
    const waktu = now.toLocaleTimeString('id-ID');
    document.getElementById("tanggal").value = `${tanggal}, ${waktu}`;
  }
  setInterval(updateTanggal, 1000);
  updateTanggal();
</script>

<!-- Fetch Nama Otomatis -->
<script>
  function getNama() {
    const nis = document.getElementById('nis').value;
    const namaInput = document.getElementById('nama');

    if (nis.length > 0) {
      fetch(`get_nama.php?nis=${nis}`)
        .then(response => response.text())
        .then(data => {
          namaInput.value = data || '';
        });
    } else {
      namaInput.value = '';
    }
  }

  // Auto-close notifikasi setelah 3 detik
  setTimeout(() => {
    const notif = document.getElementById('notifAlert');
    if (notif) {
      notif.classList.remove('show');
    }
  }, 3000);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
