<?php
include '../koneksi.php';
$id=mysqli_real_escape_string($conn,$_GET['id']??'');
if($id){mysqli_query($conn,"DELETE FROM supplier WHERE id_supplier='$id'");}
header("Location: supplier-lihat.php");exit;
