<<<<<<< HEAD
<?php
include('koneksi.php');

$nim = $_GET['nim'];
$hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$nim'");

if ($hapus) {
    header("Location: list.php");
} else {
    echo "Data gagal dihapus";
=======
<?php
include('../koneksi.php');

$nim = $_GET['nim'];
$hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$nim'");

if ($hapus) {
    header("Location: list.php");
} else {
    echo "Data gagal dihapus";
>>>>>>> aa7c42a201588abc3fdbace896d27c78d877051d
}