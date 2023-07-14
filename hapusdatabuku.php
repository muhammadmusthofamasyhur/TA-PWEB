<?php
include "koneksi.php";

$kode_buku = $_GET['kode_buku'];
$delete_data = mysqli_query($conn, "DELETE FROM db_perpustakaan WHERE `Kode Buku` = '$kode_buku'");

if ($delete_data) {
    echo "<div align='center'><h5>Data berhasil dihapus.</h5></div>";
} else {
    echo "Error: " . mysqli_error($conn);
}

echo "<meta http-equiv='refresh' content='1;url=http://localhost/perpustakaan/katalog.php'>";
?>
