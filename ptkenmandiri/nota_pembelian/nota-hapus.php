<?php
include '../koneksi.php';
$kode=mysqli_real_escape_string($conn,$_GET['kode']??'');
if($kode){mysqli_query($conn,"DELETE FROM nota_pembelian WHERE kode_nota='$kode'");}
header("Location: nota-lihat.php");exit;
