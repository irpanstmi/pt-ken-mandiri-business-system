<!doctype html>
<html lang="id">
<head>
  <title>Dashboard - PT Ken Mandiri</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600;1,9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{background:#F5F8FF;background-image:radial-gradient(circle at 15% 50%,rgba(10,61,140,0.05) 0%,transparent 50%),radial-gradient(circle at 85% 20%,rgba(7,26,64,0.05) 0%,transparent 50%);font-family:'Plus Jakarta Sans',sans-serif;overflow-x:hidden;height:100vh;}
    .wrapper{display:flex;width:100%;min-height:100vh;align-items:stretch;}
    #sidebar{background:#071A40;min-width:260px;max-width:260px;min-height:100vh;box-shadow:4px 0 24px rgba(0,0,0,0.2);transition:all 0.3s;position:relative;z-index:10;}
    #sidebar.active{margin-left:-260px;}
    #sidebar .logo-circle{display:block;width:90px;height:90px;margin:0 auto 12px;border-radius:50%;border:3px solid #1557C8;box-shadow:0 0 0 6px rgba(21,87,200,0.15);background:#0A3D8C;display:flex;align-items:center;justify-content:center;font-size:2rem;}
    #sidebar .brand-name{text-align:center;margin-bottom:32px;}
    #sidebar .brand-name h5{font-family:'Fraunces',serif;font-size:1.1rem;font-weight:700;font-style:italic;color:#fff;margin:0;}
    #sidebar .brand-name h5 span{color:#4080E8;}
    #sidebar .brand-name small{font-size:.62rem;color:rgba(255,255,255,.35);letter-spacing:1px;text-transform:uppercase;}
    #sidebar ul.components{padding:0 10px;list-style:none;}
    #sidebar ul li a{display:flex;align-items:center;gap:10px;padding:12px 18px;color:rgba(255,255,255,0.6);border-radius:10px;font-size:0.9rem;font-weight:500;transition:all 0.3s;margin-bottom:4px;text-decoration:none;}
    #sidebar ul li a:hover{background:rgba(21,87,200,0.18);color:#4080E8;padding-left:22px;}
    #sidebar ul li.active>a{background:#1557C8;color:#fff!important;font-weight:700;}
    #sidebar .footer{border-top:1px solid rgba(255,255,255,0.07);padding-top:16px;margin-top:16px;}
    #sidebar .footer p{color:rgba(255,255,255,0.25);font-size:0.75rem;text-align:center;}
    #content{flex:1;display:flex;flex-direction:column;overflow-y:auto;background:#F5F8FF;}
    .top-navbar{background:#fff;padding:14px 32px;display:flex;align-items:center;justify-content:space-between;border-bottom:2px solid #1557C8;box-shadow:0 2px 12px rgba(7,26,64,0.06);position:sticky;top:0;z-index:100;flex-shrink:0;}
    .top-navbar .btn-sidebar{background:#1557C8;border:none;color:#fff;width:40px;height:40px;border-radius:10px;font-size:1rem;cursor:pointer;transition:all 0.3s;}
    .top-navbar .btn-sidebar:hover{background:#0A3D8C;}
    .top-navbar .nav-title{font-family:'Fraunces',serif;font-size:1rem;font-weight:700;color:#071A40;font-style:italic;}
    .top-navbar .nav-title span{color:#1557C8;}
    .content-inner{padding:28px 32px;flex:1;overflow-y:auto;}
    .page-header{margin-bottom:28px;}
    .page-header .page-tag{font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.18em;color:#0A3D8C;margin-bottom:6px;}
    .page-header h2{font-family:'Fraunces',serif;font-size:1.8rem;font-weight:700;color:#071A40;font-style:italic;margin:0 0 6px;}
    .page-header p{color:#4A6A9A;font-size:0.9rem;}
    .divider-blue{height:3px;background:linear-gradient(90deg,#1557C8,#4080E8,transparent);border-radius:2px;margin:16px 0 24px;width:80px;}
    .welcome-banner{background:#071A40;border-radius:20px;padding:28px 32px;display:flex;align-items:center;justify-content:space-between;gap:24px;margin-bottom:32px;position:relative;overflow:hidden;}
    .welcome-banner::before{content:'';position:absolute;top:-60px;right:-60px;width:220px;height:220px;border-radius:50%;background:radial-gradient(circle,rgba(21,87,200,0.2),transparent 70%);}
    .welcome-text h3{font-family:'Fraunces',serif;font-size:1.3rem;font-weight:700;color:#fff;font-style:italic;margin-bottom:6px;}
    .welcome-text h3 span{color:#4080E8;}
    .welcome-text p{color:rgba(255,255,255,0.55);font-size:0.85rem;}
    .welcome-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(21,87,200,0.18);border:1px solid rgba(21,87,200,0.35);color:#4080E8;padding:4px 14px;border-radius:100px;font-size:0.65rem;font-weight:700;text-transform:uppercase;margin-bottom:10px;}
    .welcome-emoji{font-size:3rem;line-height:1;}
    .stat-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:24px;}
    .stat-card{background:#fff;border-radius:20px;padding:24px;box-shadow:0 6px 24px rgba(7,26,64,0.09);text-decoration:none;transition:all 0.3s ease;border-top:4px solid transparent;}
    .stat-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(7,26,64,0.15);}
    .stat-card.c1{border-top-color:#1557C8;}
    .stat-card.c2{border-top-color:#0A3D8C;}
    .stat-card.c3{border-top-color:#27AE60;}
    .stat-card.c4{border-top-color:#E67E22;}
    .stat-card.c5{border-top-color:#8E44AD;}
    .stat-card.c6{border-top-color:#E74C3C;}
    .stat-card-top{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px;}
    .stat-icon{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;}
    .c1 .stat-icon{background:rgba(21,87,200,0.1);color:#1557C8;}
    .c2 .stat-icon{background:rgba(10,61,140,0.1);color:#0A3D8C;}
    .c3 .stat-icon{background:rgba(39,174,96,0.1);color:#1A6B3C;}
    .c4 .stat-icon{background:rgba(230,126,34,0.1);color:#D35400;}
    .c5 .stat-icon{background:rgba(142,68,173,0.1);color:#7D3C98;}
    .c6 .stat-icon{background:rgba(231,76,60,0.1);color:#C0392B;}
    .stat-label{font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#4A6A9A;margin-bottom:4px;}
    .stat-num{font-family:'Fraunces',serif;font-size:2.5rem;font-weight:700;letter-spacing:-0.03em;line-height:1;}
    .c1 .stat-num{color:#1557C8;}
    .c2 .stat-num{color:#0A3D8C;}
    .c3 .stat-num{color:#1A6B3C;}
    .c4 .stat-num{color:#D35400;}
    .c5 .stat-num{color:#7D3C98;}
    .c6 .stat-num{color:#C0392B;}
    .stat-footer{display:flex;align-items:center;gap:6px;font-size:0.75rem;color:#4A6A9A;font-weight:500;padding-top:14px;border-top:1px solid rgba(21,87,200,0.10);margin-top:8px;}
    @media(max-width:992px){.stat-cards{grid-template-columns:repeat(2,1fr)}.content-inner{padding:20px}}
    @media(max-width:768px){.stat-cards{grid-template-columns:1fr}#sidebar{margin-left:-260px}#sidebar.active{margin-left:0}.welcome-banner{flex-direction:column;text-align:center}.top-navbar{padding:12px 20px}.content-inner{padding:16px}}
    ::-webkit-scrollbar{width:6px;height:6px}::-webkit-scrollbar-track{background:#f1f1f1;border-radius:10px}::-webkit-scrollbar-thumb{background:#1557C8;border-radius:10px}
  </style>
</head>
<body>
<div class="wrapper">
  <!-- SIDEBAR -->
  <nav id="sidebar">
    <div class="p-4 pt-5">
      <div class="logo-circle">🏢</div>
      <div class="brand-name">
        <h5>PT Ken <span>Mandiri</span></h5>
        <small>Business System</small>
      </div>
      <ul class="components">
        <li class="active"><a href="home.php"><i class="fa-solid fa-house"></i> Beranda</a></li>
        <li><a href="barang/barang-lihat.php"><i class="fa-solid fa-box"></i> Barang</a></li>
        <li><a href="perusahaan/perusahaan-lihat.php"><i class="fa-solid fa-building"></i> Perusahaan</a></li>
        <li><a href="customer/customer-lihat.php"><i class="fa-solid fa-users"></i> Customer</a></li>
        <li><a href="supplier/supplier-lihat.php"><i class="fa-solid fa-truck"></i> Supplier</a></li>
        <li><a href="nota_pembelian/nota-lihat.php"><i class="fa-solid fa-file-invoice"></i> Nota Pembelian</a></li>
        <li><a href="invoice_penjualan/invoice-lihat.php"><i class="fa-solid fa-receipt"></i> Invoice Penjualan</a></li>
        <li style="margin-top:12px;border-top:1px solid rgba(255,255,255,0.07);padding-top:8px;">
          <a href="index.php" onclick="return confirm('Yakin keluar?')"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </li>
      </ul>
      <div class="footer"><p>&copy; PT Ken Mandiri <script>document.write(new Date().getFullYear());</script></p></div>
    </div>
  </nav>

  <!-- KONTEN UTAMA -->
  <div id="content">
    <div class="top-navbar">
      <button type="button" id="sidebarCollapse" class="btn-sidebar"><i class="fa fa-bars"></i></button>
      <div class="nav-title">PT Ken <span>Mandiri</span></div>
      <div style="font-size:.82rem;color:#4A6A9A;font-weight:600;"><i class="fa-regular fa-clock" style="color:#1557C8"></i> <span id="timeDisplay"></span></div>
    </div>

    <div class="content-inner">
      <div class="page-header">
        <div class="page-tag">🏢 Dashboard Admin</div>
        <h2>Selamat Datang!</h2>
        <p>Sistem Informasi Bisnis PT Ken Mandiri — pantau semua data bisnis di satu tempat.</p>
        <div class="divider-blue"></div>
      </div>

      <div class="welcome-banner">
        <div class="welcome-text">
          <div class="welcome-badge"><i class="fa-solid fa-building"></i> PT Ken Mandiri</div>
          <h3>Sistem Informasi <span>Bisnis</span>,<br>Solusi Terpadu</h3>
          <p>Kelola barang, customer, supplier, dan transaksi dengan mudah dari satu dashboard.</p>
        </div>
        <div class="welcome-emoji">📊</div>
      </div>

      <?php include 'koneksi.php'; ?>

      <div class="stat-cards">
        <!-- Barang -->
        <a href="barang/barang-lihat.php" class="stat-card c1">
          <div class="stat-card-top">
            <div>
              <div class="stat-label">Jumlah Barang</div>
              <div class="stat-num"><?php $r=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS t FROM barang"));echo $r['t'];?></div>
            </div>
            <div class="stat-icon"><i class="fa-solid fa-box"></i></div>
          </div>
          <div class="stat-footer"><i class="fa-solid fa-arrow-right"></i> Lihat semua barang</div>
        </a>

        <!-- Perusahaan -->
        <a href="perusahaan/perusahaan-lihat.php" class="stat-card c2">
          <div class="stat-card-top">
            <div>
              <div class="stat-label">Perusahaan</div>
              <div class="stat-num"><?php $r=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS t FROM perusahaan"));echo $r['t'];?></div>
            </div>
            <div class="stat-icon"><i class="fa-solid fa-building"></i></div>
          </div>
          <div class="stat-footer"><i class="fa-solid fa-arrow-right"></i> Lihat perusahaan</div>
        </a>

        <!-- Customer -->
        <a href="customer/customer-lihat.php" class="stat-card c3">
          <div class="stat-card-top">
            <div>
              <div class="stat-label">Jumlah Customer</div>
              <div class="stat-num"><?php $r=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS t FROM customer"));echo $r['t'];?></div>
            </div>
            <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
          </div>
          <div class="stat-footer"><i class="fa-solid fa-arrow-right"></i> Lihat semua customer</div>
        </a>

        <!-- Supplier -->
        <a href="supplier/supplier-lihat.php" class="stat-card c4">
          <div class="stat-card-top">
            <div>
              <div class="stat-label">Jumlah Supplier</div>
              <div class="stat-num"><?php $r=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS t FROM supplier"));echo $r['t'];?></div>
            </div>
            <div class="stat-icon"><i class="fa-solid fa-truck"></i></div>
          </div>
          <div class="stat-footer"><i class="fa-solid fa-arrow-right"></i> Lihat semua supplier</div>
        </a>

        <!-- Nota Pembelian -->
        <a href="nota_pembelian/nota-lihat.php" class="stat-card c5">
          <div class="stat-card-top">
            <div>
              <div class="stat-label">Nota Pembelian</div>
              <div class="stat-num"><?php $r=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS t FROM nota_pembelian"));echo $r['t'];?></div>
            </div>
            <div class="stat-icon"><i class="fa-solid fa-file-invoice"></i></div>
          </div>
          <div class="stat-footer"><i class="fa-solid fa-arrow-right"></i> Lihat nota pembelian</div>
        </a>

        <!-- Invoice Penjualan -->
        <a href="invoice_penjualan/invoice-lihat.php" class="stat-card c6">
          <div class="stat-card-top">
            <div>
              <div class="stat-label">Invoice Penjualan</div>
              <div class="stat-num"><?php $r=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS t FROM invoice_penjualan"));echo $r['t'];?></div>
            </div>
            <div class="stat-icon"><i class="fa-solid fa-receipt"></i></div>
          </div>
          <div class="stat-footer"><i class="fa-solid fa-arrow-right"></i> Lihat invoice penjualan</div>
        </a>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function updateTime(){const now=new Date();document.getElementById('timeDisplay').textContent=now.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit',second:'2-digit'});}
  updateTime();setInterval(updateTime,1000);
  $('#sidebarCollapse').on('click',function(){$('#sidebar').toggleClass('active');});
</script>
</body>
</html>
