<?php
include("koneksi.php");
$hapus=mysqli_quert($koneksi,"DELETE FROM tamu WHERE id=$_GET[id]");
    if($hapus){
        header("location:index.php");
    }else{
        print "h=gagal menghapus data";
    }
?>    
    