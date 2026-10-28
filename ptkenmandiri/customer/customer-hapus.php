<?php
include '../koneksi.php';
$id=mysqli_real_escape_string($conn,$_GET['id']??'');
if($id){mysqli_query($conn,"DELETE FROM customer WHERE id_customer='$id'");}
header("Location: customer-lihat.php");exit;
