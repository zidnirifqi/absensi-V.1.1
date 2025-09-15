<?php
include 'koneksi.php';
$nis = $_GET['nis'];
$query = $conn->query("SELECT nama FROM siswa WHERE nis='$nis'");
if ($data = $query->fetch_assoc()) {
    echo $data['nama'];
} else {
    echo "";
}
