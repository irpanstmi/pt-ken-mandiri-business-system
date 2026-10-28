<!doctype html>
<html lang="id">
<head>
  <title>Edit Invoice - PT Ken Mandiri</title>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,700;1,9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/shared.css">
</head>
<body>
<?php
include '../koneksi.php';
$no=mysqli_real_escape_string($conn,$_GET['no']??'');
$d=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM invoice_penjualan WHERE no_invoice='$no'"));
if(!$d){header("Location: invoice-lihat.php");exit;}
if(isset($_POST['simpan'])){
  $prs=mysqli_real_escape_string($conn,$_POST['id_perusahaan']);
  $cust=mysqli_real_escape_string($conn,$_POST['id_customer']);
  $sup=mysqli_real_escape_string($conn,$_POST['id_supplier']);
  $faktur=mysqli_real_escape_string($conn,$_POST['no_faktur']);
  $po=mysqli_real_escape_string($conn,$_POST['no_praorder']);
  $tgl=mysqli_real_escape_string($conn,$_POST['tanggal']);
  $sup_val=$sup?("'$sup'"):'NULL';
  $q=mysqli_query($conn,"UPDATE invoice_penjualan SET id_perusahaan='$prs',id_customer='$cust',id_supplier=$sup_val,no_faktur='$faktur',no_praorder='$po',tanggal='$tgl' WHERE no_invoice='$no'");
  if($q){header("Location: invoice-lihat.php");exit;}else $err=mysqli_error($conn);
}
$prs_list=mysqli_query($conn,"SELECT id_perusahaan,nama_perusahaan FROM perusahaan");
$cust_list=mysqli_query($conn,"SELECT id_customer,nama_customer FROM customer");
$sup_list=mysqli_query($conn,"SELECT id_supplier,nama_supplier FROM supplier");
?>
<div class="wrapper">
<?php $active='invoice';$depth='../';include '../shared_sidebar.php'; ?>
  <div id="content">
    <div class="top-navbar">
      <button id="sidebarCollapse" class="btn-sidebar"><i class="fa fa-bars"></i></button>
      <div class="nav-title">PT Ken <span>Mandiri</span></div>
      <div style="font-size:.78rem;color:#4A6A9A;font-weight:600;"><i class="fa-solid fa-pen" style="color:#1557C8"></i> Edit Invoice</div>
    </div>
    <div class="content-inner">
      <div class="page-tag">📄 Invoice Penjualan</div>
      <div class="page-h">Edit Invoice Penjualan</div>
      <div class="divider-k"></div>
      <div class="header-row"><p>Edit invoice <strong style="color:#071A40"><?=htmlspecialchars($d['no_invoice'])?></strong></p><a href="invoice-lihat.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a></div>
      <?php if(isset($err)):?><div style="background:#fee2e2;color:#991b1b;padding:10px 14px;border-radius:8px;font-size:.82rem;margin-bottom:12px;">Error: <?=$err?></div><?php endif;?>
      <div class="form-wrap"><form method="POST">
        <div class="row-2">
          <div class="form-group"><label>No. Invoice</label><input type="text" class="form-control" value="<?=htmlspecialchars($d['no_invoice'])?>" disabled style="opacity:.6"></div>
          <div class="form-group"><label>Tanggal</label><input type="date" name="tanggal" class="form-control" value="<?=$d['tanggal']?>" required></div>
        </div>
        <div class="row-2">
          <div class="form-group">
            <label>Perusahaan</label>
            <select name="id_perusahaan" class="form-control" required>
              <?php while($p=mysqli_fetch_assoc($prs_list)):?><option value="<?=htmlspecialchars($p['id_perusahaan'])?>" <?=$p['id_perusahaan']==$d['id_perusahaan']?'selected':''?>><?=htmlspecialchars($p['nama_perusahaan'])?></option><?php endwhile;?>
            </select>
          </div>
          <div class="form-group">
            <label>Customer</label>
            <select name="id_customer" class="form-control" required>
              <?php while($c=mysqli_fetch_assoc($cust_list)):?><option value="<?=htmlspecialchars($c['id_customer'])?>" <?=$c['id_customer']==$d['id_customer']?'selected':''?>><?=htmlspecialchars($c['nama_customer'])?></option><?php endwhile;?>
            </select>
          </div>
        </div>
        <div class="row-2">
          <div class="form-group">
            <label>Supplier (Opsional)</label>
            <select name="id_supplier" class="form-control">
              <option value="">-- Tanpa Supplier --</option>
              <?php while($s=mysqli_fetch_assoc($sup_list)):?><option value="<?=htmlspecialchars($s['id_supplier'])?>" <?=$s['id_supplier']==$d['id_supplier']?'selected':''?>><?=htmlspecialchars($s['nama_supplier'])?></option><?php endwhile;?>
            </select>
          </div>
          <div class="form-group"><label>No. Faktur</label><input type="text" name="no_faktur" class="form-control" value="<?=htmlspecialchars($d['no_faktur']??'')?>"></div>
        </div>
        <div class="form-group"><label>No. PraOrder / PO</label><input type="text" name="no_praorder" class="form-control" value="<?=htmlspecialchars($d['no_praorder']??'')?>"></div>
        <div style="display:flex;gap:10px;margin-top:8px;">
          <button type="submit" name="simpan" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
          <a href="invoice-lihat.php" class="btn-back"><i class="fa-solid fa-xmark"></i> Batal</a>
        </div>
      </form></div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>$('#sidebarCollapse').on('click',function(){$('#sidebar').toggleClass('active');});</script>
</body>
</html>
