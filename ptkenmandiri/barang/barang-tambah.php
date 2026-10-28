<!doctype html>
<html lang="id">
<head>
  <title>Tambah Barang - PT Ken Mandiri</title>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,700;1,9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/shared.css">
</head>
<body>
<?php
include '../koneksi.php';
if(isset($_POST['simpan'])){
  $id=mysqli_real_escape_string($conn,$_POST['id_barang']);
  $nama=mysqli_real_escape_string($conn,$_POST['nama_barang']);
  $harga=mysqli_real_escape_string($conn,$_POST['harga_barang']);
  $ket=mysqli_real_escape_string($conn,$_POST['keterangan']);
  $q=mysqli_query($conn,"INSERT INTO barang VALUES('$id','$nama','$harga','$ket')");
  if($q){header("Location: barang-lihat.php");exit;}
  else $err=mysqli_error($conn);
}
?>
<div class="wrapper">
<?php $active='barang';$depth='../';include '../shared_sidebar.php'; ?>
  <div id="content">
    <div class="top-navbar">
      <button id="sidebarCollapse" class="btn-sidebar"><i class="fa fa-bars"></i></button>
      <div class="nav-title">PT Ken <span>Mandiri</span></div>
      <div style="font-size:.78rem;color:#4A6A9A;font-weight:600;"><i class="fa-solid fa-plus" style="color:#1557C8"></i> Tambah Barang</div>
    </div>
    <div class="content-inner">
      <div class="page-tag">📦 Manajemen Barang</div>
      <div class="page-h">Tambah Barang</div>
      <div class="divider-k"></div>
      <div class="header-row">
        <p>Isi form di bawah untuk menambahkan barang baru.</p>
        <a href="barang-lihat.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
      </div>
      <?php if(isset($err)):?><div style="background:#fee2e2;color:#991b1b;padding:10px 14px;border-radius:8px;font-size:.82rem;margin-bottom:12px;border:1px solid #fca5a5;">Error: <?=$err?></div><?php endif;?>
      <div class="form-wrap">
        <form method="POST">
          <div class="row-2">
            <div class="form-group">
              <label>ID Barang</label>
              <input type="text" name="id_barang" class="form-control" placeholder="contoh: BRG004" required>
            </div>
            <div class="form-group">
              <label>Nama Barang</label>
              <input type="text" name="nama_barang" class="form-control" placeholder="Nama produk" required>
            </div>
          </div>
          <div class="form-group">
            <label>Harga Barang (Rp)</label>
            <input type="number" name="harga_barang" class="form-control" placeholder="0" min="0" step="0.01" required>
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" placeholder="Keterangan barang (opsional)"></textarea>
          </div>
          <div style="display:flex;gap:10px;margin-top:8px;">
            <button type="submit" name="simpan" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Barang</button>
            <a href="barang-lihat.php" class="btn-back"><i class="fa-solid fa-xmark"></i> Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>$('#sidebarCollapse').on('click',function(){$('#sidebar').toggleClass('active');});</script>
</body>
</html>
