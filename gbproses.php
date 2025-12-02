<?php
    include("koneksi.php");
    if(isset($_POST['submit'])){
        $nama=$_POST['nama'];
        $email=$_POST['email'];
        $komentar=$_POST['komentar'];

        $sql= "INSERT INTO tamu(nama,email,komentar) VALUES ('$nama','$email','$komentar')";
        $query = $koneksi->query($sql);
        header("Location: create.php");
        exit(); 
    }
?>