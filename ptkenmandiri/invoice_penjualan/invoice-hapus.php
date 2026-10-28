<?php
include '../koneksi.php';
$no=mysqli_real_escape_string($conn,$_GET['no']??'');
if($no){mysqli_query($conn,"DELETE FROM invoice_penjualan WHERE no_invoice='$no'");}
header("Location: invoice-lihat.php");exit;
