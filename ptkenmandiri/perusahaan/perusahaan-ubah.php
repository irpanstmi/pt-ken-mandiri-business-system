<!doctype html>
<html lang="id">
<head>
  <title>Edit Perusahaan - PT Ken Mandiri</title>
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
      <div style="font-size:.78rem;color:#4A6A9A;font-weight:600;"><i class="fa-solid fa-pen" style="color:#1557C8"></i> Edit Perusahaan</div>
    </div>
    <div class="content-inner">
      <div class="page-tag">🏢 Manajemen Perusahaan</div>
      <div class="page-h">Edit Perusahaan</div>
      <div class="divider-k"></div>
      <?php
      include '../koneksi.php';
      $id=mysqli_real_escape_string($conn,$_GET['id']??'');
      $d=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM perusahaan WHERE id_perusahaan='$id'"));
      if(!$d){header("Location: perusahaan-lihat.php");exit;}
      if(isset($_POST['simpan'])){
        $nama=mysqli_real_escape_string($conn,$_POST['nama_perusahaan']);
        $petugas=mysqli_real_escape_string($conn,$_POST['nama_petugas']);
        $alamat=mysqli_real_escape_string($conn,$_POST['alamat_perusahaan']);
        $telp=mysqli_real_escape_string($conn,$_POST['no_telpon']);
        $fax=mysqli_real_escape_string($conn,$_POST['no_fax']);
        $email=mysqli_real_escape_string($conn,$_POST['email_perusahaan']);
        $penanda=mysqli_real_escape_string($conn,$_POST['nama_penandatangan']);
        $jabatan=mysqli_real_escape_string($conn,$_POST['jabatan']);
        $q=mysqli_query($conn,"UPDATE perusahaan SET nama_perusahaan='$nama',nama_petugas='$petugas',alamat_perusahaan='$alamat',no_telpon='$telp',no_fax='$fax',email_perusahaan='$email',nama_penandatangan='$penanda',jabatan='$jabatan' WHERE id_perusahaan='$id'");
        if($q){header("Location: perusahaan-lihat.php");exit;}else $err=mysqli_error($conn);
      }
      ?>
      <div class="header-row">
        <p>Edit data perusahaan <strong style="color:#071A40"><?=htmlspecialchars($d['nama_perusahaan'])?></strong></p>
        <a href="perusahaan-lihat.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
      </div>
      <?php if(isset($err)):?><div style="background:#fee2e2;color:#991b1b;padding:10px 14px;border-radius:8px;font-size:.82rem;margin-bottom:12px;">Error: <?=$err?></div><?php endif;?>
      <div class="form-wrap">
        <form method="POST">
          <div class="row-2">
            <div class="form-group"><label>ID Perusahaan</label><input type="text" class="form-control" value="<?=htmlspecialchars($d['id_perusahaan'])?>" disabled style="opacity:.6"></div>
            <div class="form-group"><label>Nama Perusahaan</label><input type="text" name="nama_perusahaan" class="form-control" value="<?=htmlspecialchars($d['nama_perusahaan'])?>" required></div>
          </div>
          <div class="row-2">
            <div class="form-group"><label>Nama Petugas</label><input type="text" name="nama_petugas" class="form-control" value="<?=htmlspecialchars($d['nama_petugas']??'')?>"></div>
            <div class="form-group"><label>No. Telepon</label><input type="text" name="no_telpon" class="form-control" value="<?=htmlspecialchars($d['no_telpon']??'')?>"></div>
          </div>
          <div class="row-2">
            <div class="form-group"><label>No. Fax</label><input type="text" name="no_fax" class="form-control" value="<?=htmlspecialchars($d['no_fax']??'')?>"></div>
            <div class="form-group"><label>Email</label><input type="email" name="email_perusahaan" class="form-control" value="<?=htmlspecialchars($d['email_perusahaan']??'')?>"></div>
          </div>
          <div class="row-2">
            <div class="form-group"><label>Nama Penandatangan</label><input type="text" name="nama_penandatangan" class="form-control" value="<?=htmlspecialchars($d['nama_penandatangan']??'')?>"></div>
            <div class="form-group"><label>Jabatan</label><input type="text" name="jabatan" class="form-control" value="<?=htmlspecialchars($d['jabatan']??'')?>"></div>
          </div>
          <div class="form-group"><label>Alamat</label><textarea name="alamat_perusahaan" class="form-control"><?=htmlspecialchars($d['alamat_perusahaan']??'')?></textarea></div>
          <div style="display:flex;gap:10px;margin-top:8px;">
            <button type="submit" name="simpan" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
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