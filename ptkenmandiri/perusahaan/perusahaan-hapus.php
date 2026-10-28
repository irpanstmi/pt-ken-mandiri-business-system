<?php
include '../koneksi.php';
$id=mysqli_real_escape_string($conn,$_GET['id']??'');
if($id){mysqli_query($conn,"DELETE FROM perusahaan WHERE id_perusahaan='$id'");}
header("Location: perusahaan-lihat.php");exit;
