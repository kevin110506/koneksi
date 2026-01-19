<<<<<<< HEAD
<?php
include('koneksi.php');

$id = $_GET['id'];
$hapus = mysqli_query($koneksi, "DELETE FROM prodi WHERE id=$id");

if ($hapus) {
    header("Location: index.php");
} else {
    echo "Data gagal dihapus";
=======
<?php
include('../koneksi.php');

$id = $_GET['id'];
$hapus = mysqli_query($koneksi, "DELETE FROM prodi WHERE id=$id");

if ($hapus) {
    header("Location: index.php");
} else {
    echo "Data gagal dihapus";
>>>>>>> aa7c42a201588abc3fdbace896d27c78d877051d
}