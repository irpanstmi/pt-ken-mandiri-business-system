<!doctype html>
<html lang="id">
<head>
  <title>Edit Supplier - PT Ken Mandiri</title>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,700;1,9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/shared.css">
</head>
<body>
<div class="wrapper">
<?php $active='supplier';$depth='../';include '../shared_sidebar.php'; ?>
  <div id="content">
    <div class="top-navbar">
      <button id="sidebarCollapse" class="btn-sidebar"><i class="fa fa-bars"></i></button>
      <div class="nav-title">PT Ken <span>Mandiri</span></div>
      <div style="font-size:.78rem;color:#4A6A9A;font-weight:600;"><i class="fa-solid fa-pen" style="color:#1557C8"></i> Edit Supplier</div>
    </div>
    <div class="content-inner">
      <div class="page-tag">🚛 Manajemen Supplier</div>
      <div class="page-h">Edit Supplier</div>
      <div class="divider-k"></div>
      <?php
      include '../koneksi.php';
      $id=mysqli_real_escape_string($conn,$_GET['id']??'');
      $d=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM supplier WHERE id_supplier='$id'"));
      if(!$d){header("Location: supplier-lihat.php");exit;}
      if(isset($_POST['simpan'])){
        $nama=mysqli_real_escape_string($conn,$_POST['nama_supplier']);
        $alamat=mysqli_real_escape_string($conn,$_POST['alamat']);
        $telp=mysqli_real_escape_string($conn,$_POST['no_telp']);
        $q=mysqli_query($conn,"UPDATE supplier SET nama_supplier='$nama',alamat='$alamat',no_telp='$telp' WHERE id_supplier='$id'");
        if($q){header("Location: supplier-lihat.php");exit;}else $err=mysqli_error($conn);
      }
      ?>
      <div class="header-row"><p>Edit data supplier <strong style="color:#071A40"><?=htmlspecialchars($d['nama_supplier'])?></strong></p><a href="supplier-lihat.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a></div>
      <?php if(isset($err)):?><div style="background:#fee2e2;color:#991b1b;padding:10px 14px;border-radius:8px;font-size:.82rem;margin-bottom:12px;">Error: <?=$err?></div><?php endif;?>
      <div class="form-wrap"><form method="POST">
        <div class="row-2">
          <div class="form-group"><label>ID Supplier</label><input type="text" class="form-control" value="<?=htmlspecialchars($d['id_supplier'])?>" disabled style="opacity:.6"></div>
          <div class="form-group"><label>Nama Supplier</label><input type="text" name="nama_supplier" class="form-control" value="<?=htmlspecialchars($d['nama_supplier'])?>" required></div>
        </div>
        <div class="form-group"><label>No. Telepon</label><input type="text" name="no_telp" class="form-control" value="<?=htmlspecialchars($d['no_telp']??'')?>"></div>
        <div class="form-group"><label>Alamat</label><textarea name="alamat" class="form-control"><?=htmlspecialchars($d['alamat']??'')?></textarea></div>
        <div style="display:flex;gap:10px;margin-top:8px;">
          <button type="submit" name="simpan" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
          <a href="supplier-lihat.php" class="btn-back"><i class="fa-solid fa-xmark"></i> Batal</a>
        </div>
      </form></div>    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>$('#sidebarCollapse').on('click',function(){$('#sidebar').toggleClass('active');});</script>
</body>
</html>