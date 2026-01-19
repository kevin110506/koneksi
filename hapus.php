<?php
include('koneksi.php');

$nim = $_GET['nim'];
$hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$nim'");

if ($hapus) {
    header("Location: list.php");
} else {
    echo "Data gagal dihapus";
}