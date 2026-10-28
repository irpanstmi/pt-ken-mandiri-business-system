<!doctype html>
<html lang="id">
<head>
  <title>Tambah Invoice - PT Ken Mandiri</title>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,700;1,9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/shared.css">
</head>
<body>
<?php
include '../koneksi.php';
if(isset($_POST['simpan'])){
  $no=mysqli_real_escape_string($conn,$_POST['no_invoice']);
  $prs=mysqli_real_escape_string($conn,$_POST['id_perusahaan']);
  $cust=mysqli_real_escape_string($conn,$_POST['id_customer']);
  $sup=mysqli_real_escape_string($conn,$_POST['id_supplier']);
  $faktur=mysqli_real_escape_string($conn,$_POST['no_faktur']);
  $po=mysqli_real_escape_string($conn,$_POST['no_praorder']);
  $tgl=mysqli_real_escape_string($conn,$_POST['tanggal']);
  $sup_val=$sup?("'$sup'"):'NULL';
  $q=mysqli_query($conn,"INSERT INTO invoice_penjualan (no_invoice,id_perusahaan,id_customer,id_supplier,no_faktur,no_praorder,tanggal) VALUES('$no','$prs','$cust',$sup_val,'$faktur','$po','$tgl')");
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
      <div style="font-size:.78rem;color:#4A6A9A;font-weight:600;"><i class="fa-solid fa-plus" style="color:#1557C8"></i> Tambah Invoice</div>
    </div>
    <div class="content-inner">
      <div class="page-tag">📄 Invoice Penjualan</div>
      <div class="page-h">Tambah Invoice Penjualan</div>
      <div class="divider-k"></div>
      <div class="header-row"><p>Buat invoice penjualan baru.</p><a href="invoice-lihat.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a></div>
      <?php if(isset($err)):?><div style="background:#fee2e2;color:#991b1b;padding:10px 14px;border-radius:8px;font-size:.82rem;margin-bottom:12px;">Error: <?=$err?></div><?php endif;?>
      <div class="form-wrap"><form method="POST">
        <div class="row-2">
          <div class="form-group"><label>No. Invoice</label><input type="text" name="no_invoice" class="form-control" placeholder="INV-2024-003" required></div>
          <div class="form-group"><label>Tanggal</label><input type="date" name="tanggal" class="form-control" value="<?=date('Y-m-d')?>" required></div>
        </div>
        <div class="row-2">
          <div class="form-group">
            <label>Perusahaan</label>
            <select name="id_perusahaan" class="form-control" required>
              <option value="">-- Pilih Perusahaan --</option>
              <?php while($p=mysqli_fetch_assoc($prs_list)):?><option value="<?=htmlspecialchars($p['id_perusahaan'])?>"><?=htmlspecialchars($p['nama_perusahaan'])?></option><?php endwhile;?>
            </select>
          </div>
          <div class="form-group">
            <label>Customer</label>
            <select name="id_customer" class="form-control" required>
              <option value="">-- Pilih Customer --</option>
              <?php while($c=mysqli_fetch_assoc($cust_list)):?><option value="<?=htmlspecialchars($c['id_customer'])?>"><?=htmlspecialchars($c['nama_customer'])?></option><?php endwhile;?>
            </select>
          </div>
        </div>
        <div class="row-2">
          <div class="form-group">
            <label>Supplier (Opsional)</label>
            <select name="id_supplier" class="form-control">
              <option value="">-- Tanpa Supplier --</option>
              <?php while($s=mysqli_fetch_assoc($sup_list)):?><option value="<?=htmlspecialchars($s['id_supplier'])?>"><?=htmlspecialchars($s['nama_supplier'])?></option><?php endwhile;?>
            </select>
          </div>
          <div class="form-group"><label>No. Faktur</label><input type="text" name="no_faktur" class="form-control" placeholder="FKT-003"></div>
        </div>
        <div class="form-group"><label>No. PraOrder / PO</label><input type="text" name="no_praorder" class="form-control" placeholder="PO-003"></div>
        <div style="display:flex;gap:10px;margin-top:8px;">
          <button type="submit" name="simpan" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Invoice</button>
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
