<<<<<<< HEAD
<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_akademik";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

=======
<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_akademik";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

>>>>>>> aa7c42a201588abc3fdbace896d27c78d877051d
?>