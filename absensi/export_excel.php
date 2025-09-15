<?php
require_once "koneksi.php";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_presensi.xls");

$data_absensi = mysqli_query($conn, "SELECT * FROM absensi ORDER BY id DESC");
?>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Jenis</th>
            <th>NIS</th>
            <th>Nama</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($data_absensi)) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['waktu'] ?></td>
            <td><?= $row['jenis_absen'] ?></td>
            <td><?= $row['nis'] ?></td>
            <td><?= $row['nama'] ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
