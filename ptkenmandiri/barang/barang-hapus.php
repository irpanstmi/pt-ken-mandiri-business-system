<?php
include '../koneksi.php';
$id=mysqli_real_escape_string($conn,$_GET['id']??'');
if($id){mysqli_query($conn,"DELETE FROM barang WHERE id_barang='$id'");}
header("Location: barang-lihat.php");exit;
