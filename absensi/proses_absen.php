<?php
include 'koneksi.php';
date_default_timezone_set("Asia/Jakarta");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = mysqli_real_escape_string($conn, $_POST['nis']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $tanggal = date('Y-m-d');
    $waktu = date('H:i:s');

    // Cek apakah NIS ada di database siswa
    $result = mysqli_query($conn, "SELECT nama FROM siswa WHERE nis = '$nis'");
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        $nama = $data['nama'];

        // Cek apakah sudah absen untuk tanggal ini dan status yang sama
        $check = mysqli_query($conn, "SELECT * FROM absensi WHERE nis = '$nis' AND tanggal = '$tanggal' AND status = '$status'");
        if (mysqli_num_rows($check) > 0) {
            echo "<script>
                alert('Sudah melakukan absen $status hari ini!');
                window.location.href='index.php';
            </script>";
        } else {
            // Simpan absensi
            $insert = mysqli_query($conn, "INSERT INTO absensi (nis, nama, waktu, tanggal, status) VALUES ('$nis', '$nama', '$waktu', '$tanggal', '$status')");

            if ($insert) {
                echo "<script>
                    alert('Absen $status berhasil!');
                    window.location.href='index.php';
                </script>";
            } else {
                echo "<script>
                    alert('Gagal menyimpan data absensi!');
                    window.location.href='index.php';
                </script>";
            }
        }
    } else {
        echo "<script>
            alert('NIS tidak ditemukan!');
            window.location.href='index.php';
        </script>";
    }
} else {
    header("Location: index.php");
}
?>
