<!doctype html>
<html lang="id">
<head>
  <title>Detail Nota Pembelian - PT Ken Mandiri</title>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,700;1,9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/shared.css">
  <style>
    .info-card{background:#fff;border-radius:14px;padding:18px 20px;box-shadow:0 4px 20px rgba(7,26,64,.08);border:1.5px solid rgba(21,87,200,.14);margin-bottom:14px;flex-shrink:0;}
    .info-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;}
    .info-item label{font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.12em;color:#4A6A9A;display:block;margin-bottom:3px;}
    .info-item span{font-size:.85rem;color:#071A40;font-weight:500;}
    .section-title{font-family:'Fraunces',serif;font-size:1rem;font-weight:700;color:#071A40;font-style:italic;margin-bottom:10px;display:flex;align-items:center;gap:8px;}
  </style>
</head>
<body>
<?php
include '../koneksi.php';
$kode=mysqli_real_escape_string($conn,$_GET['kode']??'');
$nota=mysqli_fetch_assoc(mysqli_query($conn,"SELECT np.*,p.nama_perusahaan,c.nama_customer FROM nota_pembelian np LEFT JOIN perusahaan p ON np.id_perusahaan=p.id_perusahaan LEFT JOIN customer c ON np.id_customer=c.id_customer WHERE np.kode_nota='$kode'"));
if(!$nota){header("Location: nota-lihat.php");exit;}

// Handle tambah detail
if(isset($_POST['tambah_detail'])){
  $did='DP-'.time();
  $bid=mysqli_real_escape_string($conn,$_POST['id_barang']);
  $qty=intval($_POST['qty']);
  $harga=floatval($_POST['harga_satuan']);
  $ket=mysqli_real_escape_string($conn,$_POST['keterangan']);
  mysqli_query($conn,"INSERT INTO detail_pembelian (id_detail_pembelian,kode_nota,id_barang,qty,harga_satuan,keterangan) VALUES('$did','$kode','$bid',$qty,$harga,'$ket')");
}
// Handle hapus detail
if(isset($_GET['hapus_detail'])){
  $did=mysqli_real_escape_string($conn,$_GET['hapus_detail']);
  mysqli_query($conn,"DELETE FROM detail_pembelian WHERE id_detail_pembelian='$did' AND kode_nota='$kode'");
  header("Location: nota-detail.php?kode=".urlencode($kode));exit;
}

$details=mysqli_query($conn,"SELECT dp.*,b.nama_barang FROM detail_pembelian dp JOIN barang b ON dp.id_barang=b.id_barang WHERE dp.kode_nota='$kode'");
$barang_list=mysqli_query($conn,"SELECT id_barang,nama_barang,harga_barang FROM barang ORDER BY nama_barang");
$grand_total=0;
$detail_rows=[];
while($r=mysqli_fetch_assoc($details)){$grand_total+=$r['total_harga'];$detail_rows[]=$r;}
?>
<div class="wrapper">
<?php $active='nota';$depth='../';include '../shared_sidebar.php'; ?>
  <div id="content">
    <div class="top-navbar">
      <button id="sidebarCollapse" class="btn-sidebar"><i class="fa fa-bars"></i></button>
      <div class="nav-title">PT Ken <span>Mandiri</span></div>
      <div style="font-size:.78rem;color:#4A6A9A;font-weight:600;"><i class="fa-solid fa-eye" style="color:#1557C8"></i> Detail Nota</div>
    </div>
    <div class="content-inner" style="overflow-y:auto;">
      <div class="page-tag">🧾 Detail Nota Pembelian</div>
      <div class="page-h"><?=htmlspecialchars($nota['kode_nota'])?></div>
      <div class="divider-k"></div>
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
        <span style="font-size:.82rem;color:#4A6A9A">Detail lengkap nota pembelian.</span>
        <a href="nota-lihat.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
      </div>

      <!-- Info Nota -->
      <div class="info-card">
        <div class="section-title"><i class="fa-solid fa-circle-info" style="color:#1557C8;font-size:.9rem"></i> Informasi Nota</div>
        <div class="info-grid">
          <div class="info-item"><label>Kode Nota</label><span><?=htmlspecialchars($nota['kode_nota'])?></span></div>
          <div class="info-item"><label>Tanggal</label><span><?=date('d F Y',strtotime($nota['tanggal']))?></span></div>
          <div class="info-item"><label>Perusahaan</label><span><?=htmlspecialchars($nota['nama_perusahaan']??$nota['id_perusahaan'])?></span></div>
          <div class="info-item"><label>Customer</label><span><?=htmlspecialchars($nota['nama_customer']??'-')?></span></div>
          <div class="info-item"><label>Informasi</label><span><?=htmlspecialchars($nota['informasi']??'-')?></span></div>
          <div class="info-item"><label>Grand Total</label><span style="color:#1557C8;font-weight:700;font-size:1rem">Rp <?=number_format($grand_total,0,',','.')?></span></div>
        </div>
      </div>

      <!-- Tambah Detail -->
      <div class="info-card">
        <div class="section-title"><i class="fa-solid fa-plus" style="color:#27AE60;font-size:.9rem"></i> Tambah Item Barang</div>
        <form method="POST">
          <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr auto;gap:10px;align-items:end;">
            <div class="form-group" style="margin:0;">
              <label>Barang</label>
              <select name="id_barang" class="form-control" id="barangSel" onchange="setHarga(this)" required>
                <option value="">-- Pilih Barang --</option>
                <?php while($b=mysqli_fetch_assoc($barang_list)):?>
                <option value="<?=htmlspecialchars($b['id_barang'])?>" data-harga="<?=$b['harga_barang']?>"><?=htmlspecialchars($b['nama_barang'])?></option>
                <?php endwhile;?>
              </select>
            </div>
            <div class="form-group" style="margin:0;"><label>Qty</label><input type="number" name="qty" class="form-control" min="1" value="1" required></div>
            <div class="form-group" style="margin:0;"><label>Harga Satuan</label><input type="number" name="harga_satuan" id="hargaInp" class="form-control" step="0.01" required></div>
            <div class="form-group" style="margin:0;"><label>Keterangan</label><input type="text" name="keterangan" class="form-control" placeholder="Opsional"></div>
            <button type="submit" name="tambah_detail" class="btn-save" style="height:38px;white-space:nowrap;"><i class="fa-solid fa-plus"></i> Tambah</button>
          </div>
        </form>
      </div>

      <!-- Tabel Detail -->
      <div class="table-wrap" style="flex:none;">
        <div class="table-scroll" style="max-height:280px;">
          <table class="table-custom">
            <thead><tr>
              <th class="tc" style="width:45px">No</th>
              <th class="tc" style="width:110px">ID Detail</th>
              <th>Barang</th>
              <th class="tc" style="width:80px">Qty</th>
              <th class="tc" style="width:140px">Harga Satuan</th>
              <th class="tc" style="width:140px">Total Harga</th>
              <th>Keterangan</th>
              <th class="tc" style="width:80px">Aksi</th>
            </tr></thead>
            <tbody>
              <?php if(count($detail_rows)>0):foreach($detail_rows as $i=>$r):?>
              <tr>
                <td class="tc"><?=$i+1?></td>
                <td class="tc"><code style="background:rgba(21,87,200,.1);padding:2px 6px;border-radius:5px;font-size:.72rem;color:#0A3D8C"><?=htmlspecialchars($r['id_detail_pembelian'])?></code></td>
                <td style="font-weight:600;color:#071A40"><?=htmlspecialchars($r['nama_barang'])?></td>
                <td class="tc"><?=$r['qty']?></td>
                <td class="tc">Rp <?=number_format($r['harga_satuan'],0,',','.')?></td>
                <td class="tc" style="font-weight:700;color:#1557C8">Rp <?=number_format($r['total_harga'],0,',','.')?></td>
                <td style="font-size:.8rem"><?=htmlspecialchars($r['keterangan']??'-')?></td>
                <td class="tc"><a href="?kode=<?=urlencode($kode)?>&hapus_detail=<?=urlencode($r['id_detail_pembelian'])?>" class="btn-aksi btn-hapus" onclick="return confirm('Hapus item ini?')"><i class="fa-solid fa-trash"></i></a></td>
              </tr>
              <?php endforeach;else:?>
              <tr><td colspan="8"><div class="empty-state"><i class="fa-solid fa-box-open"></i><p>Belum ada item barang.</p></div></td></tr>
              <?php endif;?>
              <?php if(count($detail_rows)>0):?>
              <tr style="background:rgba(21,87,200,.07);">
                <td colspan="5" style="text-align:right;font-weight:700;font-size:.85rem;color:#071A40;padding:10px 16px;">GRAND TOTAL</td>
                <td class="tc" style="font-weight:700;color:#1557C8;font-size:.95rem">Rp <?=number_format($grand_total,0,',','.')?></td>
                <td colspan="2"></td>
              </tr>
              <?php endif;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#sidebarCollapse').on('click',function(){$('#sidebar').toggleClass('active');});
function setHarga(sel){
  const opt=sel.options[sel.selectedIndex];
  document.getElementById('hargaInp').value=opt.dataset.harga||'';
}
</script>
</body>
</html>
