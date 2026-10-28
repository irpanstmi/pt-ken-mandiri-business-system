<!doctype html>
<html lang="id">
<head>
  <title>Edit Customer - PT Ken Mandiri</title>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,700;1,9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/shared.css">
</head>
<body>
<div class="wrapper">
<?php $active='customer';$depth='../';include '../shared_sidebar.php'; ?>
  <div id="content">
    <div class="top-navbar">
      <button id="sidebarCollapse" class="btn-sidebar"><i class="fa fa-bars"></i></button>
      <div class="nav-title">PT Ken <span>Mandiri</span></div>
      <div style="font-size:.78rem;color:#4A6A9A;font-weight:600;"><i class="fa-solid fa-pen" style="color:#1557C8"></i> Edit Customer</div>
    </div>
    <div class="content-inner">
      <div class="page-tag">👤 Manajemen Customer</div>
      <div class="page-h">Edit Customer</div>
      <div class="divider-k"></div>
      <?php
      include '../koneksi.php';
      $id=mysqli_real_escape_string($conn,$_GET['id']??'');
      $d=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM customer WHERE id_customer='$id'"));
      if(!$d){header("Location: customer-lihat.php");exit;}
      if(isset($_POST['simpan'])){
        $nama=mysqli_real_escape_string($conn,$_POST['nama_customer']);
        $pt=mysqli_real_escape_string($conn,$_POST['nama_pt']);
        $alamat=mysqli_real_escape_string($conn,$_POST['alamat_pt']);
        $info=mysqli_real_escape_string($conn,$_POST['informasi']);
        $q=mysqli_query($conn,"UPDATE customer SET nama_customer='$nama',nama_pt='$pt',alamat_pt='$alamat',informasi='$info' WHERE id_customer='$id'");
        if($q){header("Location: customer-lihat.php");exit;}else $err=mysqli_error($conn);
      }
      ?>
      <div class="header-row"><p>Edit data customer <strong style="color:#071A40"><?=htmlspecialchars($d['nama_customer'])?></strong></p><a href="customer-lihat.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a></div>
      <?php if(isset($err)):?><div style="background:#fee2e2;color:#991b1b;padding:10px 14px;border-radius:8px;font-size:.82rem;margin-bottom:12px;">Error: <?=$err?></div><?php endif;?>
      <div class="form-wrap"><form method="POST">
        <div class="row-2">
          <div class="form-group"><label>ID Customer</label><input type="text" class="form-control" value="<?=htmlspecialchars($d['id_customer'])?>" disabled style="opacity:.6"></div>
          <div class="form-group"><label>Nama Customer</label><input type="text" name="nama_customer" class="form-control" value="<?=htmlspecialchars($d['nama_customer'])?>" required></div>
        </div>
        <div class="form-group"><label>Nama PT</label><input type="text" name="nama_pt" class="form-control" value="<?=htmlspecialchars($d['nama_pt']??'')?>"></div>
        <div class="form-group"><label>Alamat PT</label><textarea name="alamat_pt" class="form-control"><?=htmlspecialchars($d['alamat_pt']??'')?></textarea></div>
        <div class="form-group"><label>Informasi</label><textarea name="informasi" class="form-control"><?=htmlspecialchars($d['informasi']??'')?></textarea></div>
        <div style="display:flex;gap:10px;margin-top:8px;">
          <button type="submit" name="simpan" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
          <a href="customer-lihat.php" class="btn-back"><i class="fa-solid fa-xmark"></i> Batal</a>
        </div>
      </form></div>    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>$('#sidebarCollapse').on('click',function(){$('#sidebar').toggleClass('active');});</script>
</body>
</html>