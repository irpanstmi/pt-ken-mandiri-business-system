<?php
// shared_sidebar.php — include this at the top of every list page
// Usage: include '../shared_sidebar.php'; then pass $active and $depth
// $active = 'barang' | 'perusahaan' | 'customer' | 'supplier' | 'nota' | 'invoice'
// $depth  = '../' for subfolders, '' for root
if(!isset($active)) $active = '';
if(!isset($depth))  $depth  = '../';
?>
<nav id="sidebar">
  <div class="sb-inner">
    <div style="text-align:center;padding:18px 0 8px;">
      <div style="width:68px;height:68px;border-radius:50%;border:3px solid #1557C8;box-shadow:0 0 0 5px rgba(21,87,200,.15);background:#0A3D8C;display:flex;align-items:center;justify-content:center;font-size:1.8rem;margin:0 auto 8px;">🏢</div>
      <div style="font-family:'Fraunces',serif;font-size:.95rem;font-weight:700;font-style:italic;color:#fff;">PT Ken <span style="color:#4080E8">Mandiri</span></div>
      <small style="font-size:.52rem;font-weight:700;text-transform:uppercase;letter-spacing:.12em;color:rgba(255,255,255,.3);">Business System</small>
    </div>
    <ul class="list-unstyled components mb-0">
      <li<?=($active=='home')?' class="active"':''?>><a href="<?=$depth?>home.php"><i class="fa-solid fa-house fa-fw"></i> Beranda</a></li>
      <li<?=($active=='barang')?' class="active"':''?>><a href="<?=$depth?>barang/barang-lihat.php"><i class="fa-solid fa-box fa-fw"></i> Barang</a></li>
      <li<?=($active=='perusahaan')?' class="active"':''?>><a href="<?=$depth?>perusahaan/perusahaan-lihat.php"><i class="fa-solid fa-building fa-fw"></i> Perusahaan</a></li>
      <li<?=($active=='customer')?' class="active"':''?>><a href="<?=$depth?>customer/customer-lihat.php"><i class="fa-solid fa-users fa-fw"></i> Customer</a></li>
      <li<?=($active=='supplier')?' class="active"':''?>><a href="<?=$depth?>supplier/supplier-lihat.php"><i class="fa-solid fa-truck fa-fw"></i> Supplier</a></li>
      <li<?=($active=='nota')?' class="active"':''?>><a href="<?=$depth?>nota_pembelian/nota-lihat.php"><i class="fa-solid fa-file-invoice fa-fw"></i> Nota Pembelian</a></li>
      <li<?=($active=='invoice')?' class="active"':''?>><a href="<?=$depth?>invoice_penjualan/invoice-lihat.php"><i class="fa-solid fa-receipt fa-fw"></i> Invoice Penjualan</a></li>
      <li><a href="<?=$depth?>index.php" onclick="return confirm('Yakin keluar?')" style="margin-top:8px;border-top:1px solid rgba(255,255,255,.07);padding-top:12px!important;"><i class="fa-solid fa-right-from-bracket fa-fw"></i> Logout</a></li>
    </ul>
    <div class="sb-footer"><p>PT Ken Mandiri &copy;<script>document.write(new Date().getFullYear());</script></p></div>
  </div>
</nav>
