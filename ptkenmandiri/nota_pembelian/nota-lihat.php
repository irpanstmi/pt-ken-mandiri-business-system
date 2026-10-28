<!doctype html>
<html lang="id">
<head>
  <title>Data Nota Pembelian - PT Ken Mandiri</title>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,700;1,9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/shared.css">
</head>
<body>
<div class="wrapper">
<?php $active='nota';$depth='../';include '../shared_sidebar.php'; ?>
  <div id="content">
    <div class="top-navbar">
      <button id="sidebarCollapse" class="btn-sidebar"><i class="fa fa-bars"></i></button>
      <div class="nav-title">PT Ken <span>Mandiri</span></div>
      <div style="font-size:.78rem;color:#4A6A9A;font-weight:600;"><i class="fa-solid fa-file-invoice" style="color:#1557C8"></i> Nota Pembelian</div>
    </div>
    <div class="content-inner">
      <div class="page-tag">🧾 Nota Pembelian</div>
      <div class="page-h">Data Nota Pembelian</div>
      <div class="divider-k"></div>
      <?php
      include '../koneksi.php';
      $batas=8;$halaman=isset($_GET['halaman'])?(int)$_GET['halaman']:1;$start=($halaman-1)*$batas;
      $data=mysqli_query($conn,"SELECT np.*,p.nama_perusahaan,c.nama_customer FROM nota_pembelian np LEFT JOIN perusahaan p ON np.id_perusahaan=p.id_perusahaan LEFT JOIN customer c ON np.id_customer=c.id_customer ORDER BY np.tanggal DESC LIMIT $start,$batas");
      $total_q=mysqli_query($conn,"SELECT COUNT(*) as total FROM nota_pembelian");
      $jumlah=mysqli_fetch_assoc($total_q)['total'];$pages=ceil($jumlah/$batas);$no=$start+1;
      ?>
      <div class="header-row">
        <p>Total <strong style="color:#071A40"><?=$jumlah?></strong> nota pembelian.</p>
        <a href="nota-tambah.php" class="btn-tambah"><i class="fa-solid fa-plus"></i> Tambah Nota</a>
      </div>
      <div class="table-outer">
        <div class="table-wrap"><div class="table-scroll">
          <table class="table-custom">
            <thead><tr>
              <th class="tc" style="width:45px">No</th>
              <th style="width:130px">Kode Nota</th>
              <th>Perusahaan</th>
              <th>Customer</th>
              <th class="tc" style="width:110px">Tanggal</th>
              <th>Informasi</th>
              <th class="tc" style="width:150px">Aksi</th>
            </tr></thead>
            <tbody>
              <?php if(mysqli_num_rows($data)>0):while($d=mysqli_fetch_array($data)):?>
              <tr>
                <td class="tc"><?=$no++?></td>
                <td><code style="background:rgba(142,68,173,.1);padding:2px 8px;border-radius:6px;font-size:.75rem;color:#7D3C98"><?=htmlspecialchars($d['kode_nota'])?></code></td>
                <td style="font-size:.83rem"><?=htmlspecialchars($d['nama_perusahaan']??$d['id_perusahaan'])?></td>
                <td style="font-size:.83rem"><?=htmlspecialchars($d['nama_customer']??$d['id_customer']??'-')?></td>
                <td class="tc" style="font-size:.8rem;color:#1557C8;font-weight:600"><?=date('d/m/Y',strtotime($d['tanggal']))?></td>
                <td style="font-size:.78rem;color:#4A6A9A"><?=htmlspecialchars(mb_substr($d['informasi']??'-',0,35))?></td>
                <td class="tc">
                  <a href="nota-detail.php?kode=<?=urlencode($d['kode_nota'])?>" class="btn-aksi btn-detail"><i class="fa-solid fa-eye"></i> Detail</a>
                  <a href="nota-ubah.php?kode=<?=urlencode($d['kode_nota'])?>" class="btn-aksi btn-edit"><i class="fa-solid fa-pen"></i> Edit</a>
                  <a href="nota-hapus.php?kode=<?=urlencode($d['kode_nota'])?>" class="btn-aksi btn-hapus" onclick="return confirm('Yakin hapus nota ini?')"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
              <?php endwhile;else:?>
              <tr><td colspan="7"><div class="empty-state"><i class="fa-solid fa-file-invoice"></i><p>Belum ada nota pembelian.</p></div></td></tr>
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
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>$('#sidebarCollapse').on('click',function(){$('#sidebar').toggleClass('active');});</script>
</body>
</html>
