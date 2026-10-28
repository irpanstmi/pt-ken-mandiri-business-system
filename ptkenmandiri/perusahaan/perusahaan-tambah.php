<!doctype html>
<html lang="id">
<head>
  <title>Tambah Perusahaan - PT Ken Mandiri</title>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,700;1,9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/shared.css">
</head>
<body>
<div class="wrapper">
<?php $active='perusahaan';$depth='../';include '../shared_sidebar.php'; ?>
  <div id="content">
    <div class="top-navbar">
      <button id="sidebarCollapse" class="btn-sidebar"><i class="fa fa-bars"></i></button>
      <div class="nav-title">PT Ken <span>Mandiri</span></div>
      <div style="font-size:.78rem;color:#4A6A9A;font-weight:600;"><i class="fa-solid fa-plus" style="color:#1557C8"></i> Tambah Perusahaan</div>
    </div>
    <div class="content-inner">
      <div class="page-tag">🏢 Manajemen Perusahaan</div>
      <div class="page-h">Tambah Perusahaan</div>
      <div class="divider-k"></div>
      <?php
      include '../koneksi.php';
      if(isset($_POST['simpan'])){
        $id=mysqli_real_escape_string($conn,$_POST['id_perusahaan']);
        $nama=mysqli_real_escape_string($conn,$_POST['nama_perusahaan']);
        $petugas=mysqli_real_escape_string($conn,$_POST['nama_petugas']);
        $alamat=mysqli_real_escape_string($conn,$_POST['alamat_perusahaan']);
        $telp=mysqli_real_escape_string($conn,$_POST['no_telpon']);
        $fax=mysqli_real_escape_string($conn,$_POST['no_fax']);
        $email=mysqli_real_escape_string($conn,$_POST['email_perusahaan']);
        $penanda=mysqli_real_escape_string($conn,$_POST['nama_penandatangan']);
        $jabatan=mysqli_real_escape_string($conn,$_POST['jabatan']);
        $q=mysqli_query($conn,"INSERT INTO perusahaan VALUES('$id','$nama','$petugas','$alamat','$telp','$fax','$email','$penanda','$jabatan')");
        if($q){header("Location: perusahaan-lihat.php");exit;}else $err=mysqli_error($conn);
      }
      ?>
      <div class="header-row">
        <p>Isi form berikut untuk menambahkan perusahaan baru.</p>
        <a href="perusahaan-lihat.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
      </div>
      <?php if(isset($err)):?><div style="background:#fee2e2;color:#991b1b;padding:10px 14px;border-radius:8px;font-size:.82rem;margin-bottom:12px;">Error: <?=$err?></div><?php endif;?>
      <div class="form-wrap">
        <form method="POST">
          <div class="row-2">
            <div class="form-group"><label>ID Perusahaan</label><input type="text" name="id_perusahaan" class="form-control" placeholder="PRS002" required></div>
            <div class="form-group"><label>Nama Perusahaan</label><input type="text" name="nama_perusahaan" class="form-control" required></div>
          </div>
          <div class="row-2">
            <div class="form-group"><label>Nama Petugas</label><input type="text" name="nama_petugas" class="form-control"></div>
            <div class="form-group"><label>No. Telepon</label><input type="text" name="no_telpon" class="form-control"></div>
          </div>
          <div class="row-2">
            <div class="form-group"><label>No. Fax</label><input type="text" name="no_fax" class="form-control"></div>
            <div class="form-group"><label>Email Perusahaan</label><input type="email" name="email_perusahaan" class="form-control"></div>
          </div>
          <div class="row-2">
            <div class="form-group"><label>Nama Penandatangan</label><input type="text" name="nama_penandatangan" class="form-control"></div>
            <div class="form-group"><label>Jabatan</label><input type="text" name="jabatan" class="form-control"></div>
          </div>
          <div class="form-group"><label>Alamat Perusahaan</label><textarea name="alamat_perusahaan" class="form-control"></textarea></div>
          <div style="display:flex;gap:10px;margin-top:8px;">
            <button type="submit" name="simpan" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            <a href="perusahaan-lihat.php" class="btn-back"><i class="fa-solid fa-xmark"></i> Batal</a>
          </div>
        </form>
      </div>    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>$('#sidebarCollapse').on('click',function(){$('#sidebar').toggleClass('active');});</script>
</body>
</html>