<?php
include('../koneksi.php');

$id = $_GET['id'];
$hapus = mysqli_query($koneksi, "DELETE FROM prodi WHERE id=$id");

if ($hapus) {
    header("Location: index.php");
} else {
    echo "Data gagal dihapus";
}