<!doctype html>
<html lang="id">
<head>
  <title>Data Supplier - PT Ken Mandiri</title>
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
      <div style="font-size:.78rem;color:#4A6A9A;font-weight:600;"><i class="fa-solid fa-truck" style="color:#1557C8"></i> Supplier</div>
    </div>
    <div class="content-inner">
      <div class="page-tag">📋 Manajemen Supplier</div>
      <div class="page-h">Data Supplier</div>
      <div class="divider-k"></div>
      <?php
      include '../koneksi.php';
      $batas=8;$halaman=isset($_GET['halaman'])?(int)$_GET['halaman']:1;$start=($halaman-1)*$batas;
      $data=mysqli_query($conn,"SELECT * FROM supplier LIMIT $start,$batas");
      $total_q=mysqli_query($conn,"SELECT COUNT(*) as total FROM supplier");
      $jumlah=mysqli_fetch_assoc($total_q)['total'];$pages=ceil($jumlah/$batas);$no=$start+1;
      ?>
      <div class="header-row">
        <p>Total <strong style="color:#071A40"><?=$jumlah?></strong> supplier terdaftar.</p>
        <a href="supplier-tambah.php" class="btn-tambah"><i class="fa-solid fa-plus"></i> Tambah Supplier</a>
      </div>
      <div class="table-outer">
        <div class="table-wrap"><div class="table-scroll">
          <table class="table-custom">
            <thead><tr><th class="tc" style="width:45px">No</th><th class="tc" style="width:100px">ID</th><th>Nama Supplier</th><th>Alamat</th><th class="tc" style="width:130px">No. Telepon</th><th class="tc" style="width:120px">Aksi</th></tr></thead>
            <tbody>
              <?php if(mysqli_num_rows($data)>0):while($d=mysqli_fetch_array($data)):?>
              <tr>
                <td class="tc"><?=$no++?></td>
                <td class="tc"><code style="background:rgba(21,87,200,.1);padding:2px 8px;border-radius:6px;font-size:.75rem;color:#0A3D8C"><?=htmlspecialchars($d['id_supplier'])?></code></td>
                <td style="font-weight:600;color:#071A40"><?=htmlspecialchars($d['nama_supplier'])?></td>
                <td style="font-size:.8rem"><?=htmlspecialchars(mb_substr($d['alamat']??'-',0,45))?></td>
                <td class="tc"><?=htmlspecialchars($d['no_telp']??'-')?></td>
                <td class="tc">
                  <a href="supplier-ubah.php?id=<?=urlencode($d['id_supplier'])?>" class="btn-aksi btn-edit"><i class="fa-solid fa-pen"></i> Edit</a>
                  <a href="supplier-hapus.php?id=<?=urlencode($d['id_supplier'])?>" class="btn-aksi btn-hapus" onclick="return confirm('Yakin hapus?')"><i class="fa-solid fa-trash"></i> Hapus</a>
                </td>
              </tr>
              <?php endwhile;else:?>
              <tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-database"></i><p>Belum ada data supplier.</p></div></td></tr>
              <?php endif;?>
            </tbody>
          </table>
        </div></div>
        <?php if($pages>1):?>
        <div class="pagi">
          <?php if($halaman>1):?><a href="?halaman=<?=$halaman-1?>"><i class="fa fa-chevron-left"></i></a><?php endif;?>
          <?php for($i=1;$i<=$pages;$i++):?><a href="?halaman=<?=$i?>" class="<?=$i==$halaman?'ap':''?>"><?=$i?></a><?php endfor;?>
          <?php if($halaman<$pages):?><a href="?halaman=<?=$halaman+1?>"><i class="fa fa-chevron-right"></i></a><?php endif;?>
        </div>
        <?php endif;?>
      </div>    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>$('#sidebarCollapse').on('click',function(){$('#sidebar').toggleClass('active');});</script>
</body>
</html>