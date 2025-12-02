<?php
// KONEKSI
$koneksi = mysqli_connect("localhost", "root", "", "db_bukutamu");

if (!$koneksi) {
    die("Koneksi gagal");
}

// HAPUS
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM tamu WHERE id='$id'");
    header("location: index.php");
    exit();
}

// QUERY
$sql = "SELECT * FROM tamu";
$result = mysqli_query($koneksi, $sql);
?>

<html>
<head><title>Buku Tamu</title></head>
<body>
    <h1>BUKU TAMU</h1>
    <a href="create.php">TAMBAH DATA</a>
    <hr>
    
    <?php
    // CEK APAKAH ADA DATA
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' width='100%'>";
        echo "<tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Komentar</th>
                <th>Aksi</th>
              </tr>";
        
        $no = 1;
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['komentar'] . "</td>";
            echo "<td>
                    <a href='edit.php?id=" . $row['id'] . "'>EDIT</a> | 
                    <a href='index.php?hapus=" . $row['id'] . "' onclick='return confirm(\"Hapus?\")'>HAPUS</a>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Tidak ada data. <a href='create.php'>Tambah data pertama</a></p>";
    }
    
    mysqli_close($koneksi);
    ?>
</body>
</html>