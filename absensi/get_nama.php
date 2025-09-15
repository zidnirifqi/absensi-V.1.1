<?php
require_once "koneksi.php";
if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $result = mysqli_query($conn, "SELECT nama FROM siswa WHERE nis='$nis'");
    if ($row = mysqli_fetch_assoc($result)) {
        echo $row['nama'];
    } else {
        echo "";
    }
}
