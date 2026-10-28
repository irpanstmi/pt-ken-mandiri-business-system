<!doctype html>
<html lang="id">
<head>
  <title>Detail Invoice - PT Ken Mandiri</title>
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
$no=mysqli_real_escape_string($conn,$_GET['no']??'');
$inv=mysqli_fetch_assoc(mysqli_query($conn,"SELECT inv.*,p.nama_perusahaan,c.nama_customer,s.nama_supplier FROM invoice_penjualan inv LEFT JOIN perusahaan p ON inv.id_perusahaan=p.id_perusahaan LEFT JOIN customer c ON inv.id_customer=c.id_customer LEFT JOIN supplier s ON inv.id_supplier=s.id_supplier WHERE inv.no_invoice='$no'"));
if(!$inv){header("Location: invoice-lihat.php");exit;}

// Tambah detail
if(isset($_POST['tambah_detail'])){
  $did='DIP-'.time();
  $bid=mysqli_real_escape_string($conn,$_POST['id_barang']);
  $qty=intval($_POST['qty']);
  $up=floatval($_POST['unit_price']);
  $total=$qty*$up;
  $sub=floatval($_POST['sub_total'])?:$total;
  $desk=mysqli_real_escape_string($conn,$_POST['deskripsi']);
  mysqli_query($conn,"INSERT INTO detail_invoice_penjualan (id_detail_penjualan,no_invoice,id_barang,qty,unit_price,total_price,sub_total,deskripsi) VALUES('$did','$no','$bid',$qty,$up,$total,$sub,'$desk')");
}
// Hapus detail
if(isset($_GET['hapus_detail'])){
  $did=mysqli_real_escape_string($conn,$_GET['hapus_detail']);
  mysqli_query($conn,"DELETE FROM detail_invoice_penjualan WHERE id_detail_penjualan='$did' AND no_invoice='$no'");
  header("Location: invoice-detail.php?no=".urlencode($no));exit;
}

$details=mysqli_query($conn,"SELECT dip.*,b.nama_barang FROM detail_invoice_penjualan dip JOIN barang b ON dip.id_barang=b.id_barang WHERE dip.no_invoice='$no'");
$barang_list=mysqli_query($conn,"SELECT id_barang,nama_barang,harga_barang FROM barang ORDER BY nama_barang");
$grand_total=0;$detail_rows=[];
while($r=mysqli_fetch_assoc($details)){$grand_total+=$r['sub_total'];$detail_rows[]=$r;}
?>
<div class="wrapper">
<?php $active='invoice';$depth='../';include '../shared_sidebar.php'; ?>
  <div id="content">
    <div class="top-navbar">
      <button id="sidebarCollapse" class="btn-sidebar"><i class="fa fa-bars"></i></button>
      <div class="nav-title">PT Ken <span>Mandiri</span></div>
      <div style="font-size:.78rem;color:#4A6A9A;font-weight:600;"><i class="fa-solid fa-eye" style="color:#1557C8"></i> Detail Invoice</div>
    </div>
    <div class="content-inner" style="overflow-y:auto;">
      <div class="page-tag">📄 Detail Invoice Penjualan</div>
      <div class="page-h"><?=htmlspecialchars($inv['no_invoice'])?></div>
      <div class="divider-k"></div>
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
        <span style="font-size:.82rem;color:#4A6A9A">Detail lengkap invoice penjualan.</span>
        <a href="invoice-lihat.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
      </div>

      <!-- Info Invoice -->
      <div class="info-card">
        <div class="section-title"><i class="fa-solid fa-circle-info" style="color:#1557C8;font-size:.9rem"></i> Informasi Invoice</div>
        <div class="info-grid">
          <div class="info-item"><label>No. Invoice</label><span><?=htmlspecialchars($inv['no_invoice'])?></span></div>
          <div class="info-item"><label>Tanggal</label><span><?=date('d F Y',strtotime($inv['tanggal']))?></span></div>
          <div class="info-item"><label>Perusahaan</label><span><?=htmlspecialchars($inv['nama_perusahaan']??$inv['id_perusahaan'])?></span></div>
          <div class="info-item"><label>Customer</label><span><?=htmlspecialchars($inv['nama_customer']??$inv['id_customer'])?></span></div>
          <div class="info-item"><label>Supplier</label><span><?=htmlspecialchars($inv['nama_supplier']??'-')?></span></div>
          <div class="info-item"><label>No. Faktur</label><span><?=htmlspecialchars($inv['no_faktur']??'-')?></span></div>
          <div class="info-item"><label>No. PO</label><span><?=htmlspecialchars($inv['no_praorder']??'-')?></span></div>
          <div class="info-item"><label>Grand Total</label><span style="color:#1557C8;font-weight:700;font-size:1rem">Rp <?=number_format($grand_total,0,',','.')?></span></div>
        </div>
      </div>

      <!-- Tambah Detail -->
      <div class="info-card">
        <div class="section-title"><i class="fa-solid fa-plus" style="color:#27AE60;font-size:.9rem"></i> Tambah Item Barang</div>
        <form method="POST">
          <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr 1fr auto;gap:10px;align-items:end;">
            <div class="form-group" style="margin:0;">
              <label>Barang</label>
              <select name="id_barang" class="form-control" id="barangSel" onchange="setHarga(this)" required>
                <option value="">-- Pilih Barang --</option>
                <?php while($b=mysqli_fetch_assoc($barang_list)):?>
                <option value="<?=htmlspecialchars($b['id_barang'])?>" data-harga="<?=$b['harga_barang']?>"><?=htmlspecialchars($b['nama_barang'])?></option>
                <?php endwhile;?>
              </select>
            </div>
            <div class="form-group" style="margin:0;"><label>Qty</label><input type="number" name="qty" id="qtyInp" class="form-control" min="1" value="1" oninput="calcTotal()" required></div>
            <div class="form-group" style="margin:0;"><label>Unit Price</label><input type="number" name="unit_price" id="upInp" class="form-control" step="0.01" oninput="calcTotal()" required></div>
            <div class="form-group" style="margin:0;"><label>Total Price</label><input type="number" name="total_price" id="tpInp" class="form-control" step="0.01" readonly style="opacity:.7"></div>
            <div class="form-group" style="margin:0;"><label>Sub Total</label><input type="number" name="sub_total" id="stInp" class="form-control" step="0.01" required></div>
            <button type="submit" name="tambah_detail" class="btn-save" style="height:38px;white-space:nowrap;"><i class="fa-solid fa-plus"></i> Tambah</button>
          </div>
          <div class="form-group" style="margin-top:10px;"><label>Deskripsi</label><input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi item (opsional)"></div>
        </form>
      </div>

      <!-- Tabel Detail -->
      <div class="table-wrap" style="flex:none;">
        <div class="table-scroll" style="max-height:260px;">
          <table class="table-custom">
            <thead><tr>
              <th class="tc" style="width:40px">No</th>
              <th>Barang</th>
              <th class="tc" style="width:60px">Qty</th>
              <th class="tc" style="width:130px">Unit Price</th>
              <th class="tc" style="width:130px">Total Price</th>
              <th class="tc" style="width:130px">Sub Total</th>
              <th>Deskripsi</th>
              <th class="tc" style="width:70px">Aksi</th>
            </tr></thead>
            <tbody>
              <?php if(count($detail_rows)>0):foreach($detail_rows as $i=>$r):?>
              <tr>
                <td class="tc"><?=$i+1?></td>
                <td style="font-weight:600;color:#071A40"><?=htmlspecialchars($r['nama_barang'])?></td>
                <td class="tc"><?=$r['qty']?></td>
                <td class="tc">Rp <?=number_format($r['unit_price'],0,',','.')?></td>
                <td class="tc">Rp <?=number_format($r['total_price'],0,',','.')?></td>
                <td class="tc" style="font-weight:700;color:#1557C8">Rp <?=number_format($r['sub_total'],0,',','.')?></td>
                <td style="font-size:.8rem"><?=htmlspecialchars($r['deskripsi']??'-')?></td>
                <td class="tc"><a href="?no=<?=urlencode($no)?>&hapus_detail=<?=urlencode($r['id_detail_penjualan'])?>" class="btn-aksi btn-hapus" onclick="return confirm('Hapus item ini?')"><i class="fa-solid fa-trash"></i></a></td>
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
  const h=sel.options[sel.selectedIndex].dataset.harga||'';
  document.getElementById('upInp').value=h;
  calcTotal();
}
function calcTotal(){
  const q=parseFloat(document.getElementById('qtyInp').value)||0;
  const u=parseFloat(document.getElementById('upInp').value)||0;
  const t=q*u;
  document.getElementById('tpInp').value=t.toFixed(2);
  document.getElementById('stInp').value=t.toFixed(2);
}
</script>
</body>
</html>
