<!doctype html>
<html lang="id">
<head>
  <title>Edit Nota Pembelian - PT Ken Mandiri</title>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,700;1,9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/shared.css">
</head>
<body>
<?php
include '../koneksi.php';
$kode=mysqli_real_escape_string($conn,$_GET['kode']??'');
$d=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM nota_pembelian WHERE kode_nota='$kode'"));
if(!$d){header("Location: nota-lihat.php");exit;}
if(isset($_POST['simpan'])){
  $prs=mysqli_real_escape_string($conn,$_POST['id_perusahaan']);
  $cust=mysqli_real_escape_string($conn,$_POST['id_customer']);
  $tgl=mysqli_real_escape_string($conn,$_POST['tanggal']);
  $info=mysqli_real_escape_string($conn,$_POST['informasi']);
  $cust_val=$cust?("'$cust'"):'NULL';
  $q=mysqli_query($conn,"UPDATE nota_pembelian SET id_perusahaan='$prs',id_customer=$cust_val,tanggal='$tgl',informasi='$info' WHERE kode_nota='$kode'");
  if($q){header("Location: nota-lihat.php");exit;}else $err=mysqli_error($conn);
}
$perusahaan_list=mysqli_query($conn,"SELECT id_perusahaan,nama_perusahaan FROM perusahaan ORDER BY nama_perusahaan");
$customer_list=mysqli_query($conn,"SELECT id_customer,nama_customer FROM customer ORDER BY nama_customer");
?>
<div class="wrapper">
<?php $active='nota';$depth='../';include '../shared_sidebar.php'; ?>
  <div id="content">
    <div class="top-navbar">
      <button id="sidebarCollapse" class="btn-sidebar"><i class="fa fa-bars"></i></button>
      <div class="nav-title">PT Ken <span>Mandiri</span></div>
      <div style="font-size:.78rem;color:#4A6A9A;font-weight:600;"><i class="fa-solid fa-pen" style="color:#1557C8"></i> Edit Nota</div>
    </div>
    <div class="content-inner">
      <div class="page-tag">🧾 Nota Pembelian</div>
      <div class="page-h">Edit Nota Pembelian</div>
      <div class="divider-k"></div>
      <div class="header-row"><p>Edit nota <strong style="color:#071A40"><?=htmlspecialchars($d['kode_nota'])?></strong></p><a href="nota-lihat.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a></div>
      <?php if(isset($err)):?><div style="background:#fee2e2;color:#991b1b;padding:10px 14px;border-radius:8px;font-size:.82rem;margin-bottom:12px;">Error: <?=$err?></div><?php endif;?>
      <div class="form-wrap"><form method="POST">
        <div class="row-2">
          <div class="form-group"><label>Kode Nota</label><input type="text" class="form-control" value="<?=htmlspecialchars($d['kode_nota'])?>" disabled style="opacity:.6"></div>
          <div class="form-group"><label>Tanggal</label><input type="date" name="tanggal" class="form-control" value="<?=$d['tanggal']?>" required></div>
        </div>
        <div class="row-2">
          <div class="form-group">
            <label>Perusahaan</label>
            <select name="id_perusahaan" class="form-control" required>
              <?php while($p=mysqli_fetch_assoc($perusahaan_list)):?>
              <option value="<?=htmlspecialchars($p['id_perusahaan'])?>" <?=$p['id_perusahaan']==$d['id_perusahaan']?'selected':''?>><?=htmlspecialchars($p['nama_perusahaan'])?></option>
              <?php endwhile;?>
            </select>
          </div>
          <div class="form-group">
            <label>Customer</label>
            <select name="id_customer" class="form-control">
              <option value="">-- Tanpa Customer --</option>
              <?php while($c=mysqli_fetch_assoc($customer_list)):?>
              <option value="<?=htmlspecialchars($c['id_customer'])?>" <?=$c['id_customer']==$d['id_customer']?'selected':''?>><?=htmlspecialchars($c['nama_customer'])?></option>
              <?php endwhile;?>
            </select>
          </div>
        </div>
        <div class="form-group"><label>Informasi</label><textarea name="informasi" class="form-control"><?=htmlspecialchars($d['informasi']??'')?></textarea></div>
        <div style="display:flex;gap:10px;margin-top:8px;">
          <button type="submit" name="simpan" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
          <a href="nota-lihat.php" class="btn-back"><i class="fa-solid fa-xmark"></i> Batal</a>
        </div>
      </form></div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>$('#sidebarCollapse').on('click',function(){$('#sidebar').toggleClass('active');});</script>
</body>
</html>
