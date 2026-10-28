<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PT Ken Mandiri — Sistem Informasi Bisnis</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&family=Lora:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
:root{
  --blue:#0A3D8C;--blue2:#1557C8;--blue3:#4080E8;
  --navy:#071A40;--dark:#050F22;--dark2:#080E1E;
  --silver:#E8F0FF;--silver2:#F4F7FF;--accent:#C8A010;
  --glass:rgba(232,240,255,0.08);
  --gb:rgba(10,61,140,0.35);
  --tm:rgba(232,240,255,0.55);
  --td:rgba(232,240,255,0.30);
}
html{scroll-behavior:smooth}
body{font-family:'DM Sans',sans-serif;background:var(--dark);color:var(--silver);overflow-x:hidden}
::-webkit-scrollbar{width:5px}
::-webkit-scrollbar-track{background:var(--dark2)}
::-webkit-scrollbar-thumb{background:var(--blue2);border-radius:3px}

/* ── CANVAS BG ── */
#bg{position:fixed;inset:0;z-index:0;pointer-events:none}

/* ── GLASS UTIL ── */
.g{
  background:var(--glass);
  backdrop-filter:blur(24px) saturate(1.8);
  -webkit-backdrop-filter:blur(24px) saturate(1.8);
  border:1px solid var(--gb);
  border-radius:20px;
  box-shadow:0 8px 40px rgba(0,0,0,.4),inset 0 1px 0 rgba(100,160,255,.10);
}
.gs{
  background:rgba(232,240,255,.06);
  backdrop-filter:blur(16px);
  -webkit-backdrop-filter:blur(16px);
  border:1px solid rgba(10,61,140,.22);
  border-radius:14px;
  box-shadow:0 4px 20px rgba(0,0,0,.28),inset 0 1px 0 rgba(100,160,255,.07);
}

/* ── NAV ── */
nav{
  position:fixed;top:0;left:0;right:0;z-index:999;
  height:66px;padding:0 3rem;
  display:flex;align-items:center;justify-content:space-between;
  background:rgba(5,15,34,.55);
  backdrop-filter:blur(20px) saturate(2);
  -webkit-backdrop-filter:blur(20px) saturate(2);
  border-bottom:1px solid rgba(10,61,140,.28);
  transition:all .3s;
}
nav.scrolled{background:rgba(5,15,34,.90);border-bottom-color:rgba(21,87,200,.48)}
.logo{font-family:'Playfair Display',serif;font-size:1.15rem;color:var(--blue3);line-height:1.2}
.logo small{display:block;font-family:'DM Sans',sans-serif;font-size:.6rem;color:var(--td);letter-spacing:2.5px;text-transform:uppercase;font-style:normal}
.nav-links{display:flex;gap:.2rem;list-style:none}
.nav-links a{display:block;padding:.42rem 1.1rem;color:var(--td);text-decoration:none;font-size:.82rem;letter-spacing:.6px;border-radius:50px;transition:all .22s;}
.nav-links a:hover,.nav-links a.on{color:var(--blue3);background:rgba(10,61,140,.15)}
.nav-cta{background:linear-gradient(135deg,var(--blue),var(--blue2));color:#fff!important;font-weight:500;padding:.42rem 1.4rem!important;border-radius:50px!important;}
.nav-cta:hover{transform:translateY(-1px);box-shadow:0 4px 18px rgba(21,87,200,.45)!important;background:linear-gradient(135deg,var(--blue2),var(--blue3))!important}

/* ── SECTION BASE ── */
section{position:relative;z-index:1;min-height:100vh;padding:7rem 3rem 5rem}
.stag{font-size:.68rem;letter-spacing:3.5px;text-transform:uppercase;color:var(--blue3);display:flex;align-items:center;gap:10px;margin-bottom:.8rem}
.stag::before{content:'';display:inline-block;width:26px;height:1px;background:var(--blue3);flex-shrink:0}
.stit{font-family:'Playfair Display',serif;font-size:clamp(2rem,4vw,3rem);line-height:1.15;color:var(--silver)}
.stit em{font-style:italic;color:var(--blue3)}
.gline{width:52px;height:2px;background:linear-gradient(90deg,var(--blue2),transparent);margin:1rem 0 1.8rem}

/* ── REVEAL ── */
.rv{opacity:0;transform:translateY(26px);transition:all .6s ease}
.rv.on{opacity:1;transform:translateY(0)}

/* ════════ HOME ════════ */
#home{display:grid;grid-template-columns:1fr 1fr;align-items:center;gap:3rem;padding-top:5rem}
.eyebrow{display:inline-flex;align-items:center;gap:8px;padding:.35rem 1rem;border-radius:50px;margin-bottom:1.5rem;font-size:.7rem;letter-spacing:2px;text-transform:uppercase;color:var(--blue3);font-weight:500;}
.dot{width:6px;height:6px;border-radius:50%;background:var(--blue3);animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(1.5)}}
.htit{font-family:'Playfair Display',serif;font-size:clamp(2.6rem,5vw,4.2rem);line-height:1.08;margin-bottom:.5rem}
.htit .a{color:var(--blue3);font-style:italic}
.htit .b{color:var(--td);font-size:.62em}
.hsub{font-family:'Lora',serif;font-size:.95rem;color:var(--tm);line-height:1.8;margin-bottom:2rem;max-width:400px;font-style:italic}
.btns{display:flex;gap:.9rem;flex-wrap:wrap}
.btn{padding:.8rem 1.9rem;border-radius:50px;font-family:'DM Sans',sans-serif;font-size:.83rem;font-weight:500;letter-spacing:.7px;cursor:pointer;border:none;transition:all .25s;text-decoration:none;display:inline-flex;align-items:center;gap:7px;}
.bp{background:linear-gradient(135deg,var(--blue),var(--blue2));color:#fff}
.bp:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(21,87,200,.45)}
.bo{background:transparent;color:var(--silver);border:1px solid rgba(10,61,140,.40)!important}
.bo:hover{background:rgba(10,61,140,.12);border-color:var(--blue2)!important;color:var(--blue3)}

/* stat strip */
.srow{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-top:3rem}
.sc{padding:1.2rem 1rem;text-align:center}
.sc .n{font-family:'Playfair Display',serif;font-size:1.9rem;color:var(--blue3);font-weight:700;display:block}
.sc .l{font-size:.65rem;color:var(--td);letter-spacing:1.3px;text-transform:uppercase;margin-top:3px}

/* hero visual */
.hero-vis{position:relative;display:flex;align-items:center;justify-content:center}
.hero-card{padding:2.4rem;position:relative;overflow:hidden;border-radius:24px}
.hero-card::before{content:'';position:absolute;top:-70px;right:-70px;width:240px;height:240px;border-radius:50%;background:radial-gradient(circle,rgba(10,61,140,.20) 0%,transparent 70%);pointer-events:none;}
.hero-card::after{content:'PT KEN MANDIRI';position:absolute;bottom:1.4rem;right:1.6rem;font-family:'Playfair Display',serif;font-size:.58rem;letter-spacing:3px;color:rgba(10,61,140,.40);text-transform:uppercase;}
.hero-svg{animation:float 4s ease-in-out infinite;display:block;margin:0 auto}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
.info-pills{display:flex;flex-wrap:wrap;gap:.6rem;margin-top:1.6rem;justify-content:center}
.pill{padding:.3rem .9rem;border-radius:50px;font-size:.68rem;letter-spacing:.8px;color:var(--blue3);border:1px solid rgba(10,61,140,.28);background:rgba(10,61,140,.10);}

/* ════════ ABOUT ════════ */
#about{display:grid;grid-template-columns:1fr 1fr;gap:4.5rem;align-items:start}
.atxt{font-size:.87rem;color:rgba(232,240,255,.58);line-height:1.9;margin-bottom:1.4rem}
.flist{display:flex;flex-direction:column;gap:.85rem}
.fi{display:flex;gap:.9rem;align-items:flex-start;padding:1rem 1.2rem;transition:all .25s;}
.fi:hover{border-color:rgba(10,61,140,.48)!important;transform:translateX(5px)}
.fic{width:40px;height:40px;border-radius:10px;flex-shrink:0;background:rgba(10,61,140,.15);border:1px solid rgba(10,61,140,.28);display:flex;align-items:center;justify-content:center;font-size:17px;}
.ft h4{font-size:.84rem;color:var(--silver);margin-bottom:3px;font-weight:500}
.ft p{font-size:.74rem;color:var(--td);line-height:1.6}
.aright{display:flex;flex-direction:column;gap:1.1rem}
.ic{padding:1.6rem}
.ic h3{font-family:'Playfair Display',serif;font-size:.98rem;color:var(--blue3);margin-bottom:1rem;display:flex;align-items:center;gap:7px}
.igrid{display:grid;grid-template-columns:1fr 1fr;gap:.75rem}
.ii label{font-size:.6rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--td);display:block;margin-bottom:2px}
.ii span{font-size:.8rem;color:var(--silver)}
.rrow{display:grid;grid-template-columns:repeat(2,1fr);gap:.75rem}
.rc{padding:1.1rem;text-align:center;transition:all .25s}
.rc:hover{border-color:rgba(10,61,140,.48);transform:translateY(-3px)}
.rc .ri{font-size:22px;display:block;margin-bottom:.45rem}
.rc .rn{font-family:'Playfair Display',serif;font-size:.85rem;color:var(--blue3);display:block}
.rc .rd{font-size:.7rem;color:var(--td);margin-top:2px}

/* ════════ LOGIN SECTION ════════ */
#login-section{min-height:60vh;display:flex;align-items:center;justify-content:center;padding:5rem 3rem}
.login-wrap{max-width:420px;width:100%;padding:2.4rem;border-radius:24px}
.login-wrap h2{font-family:'Playfair Display',serif;font-size:1.6rem;color:var(--silver);text-align:center;margin-bottom:.4rem;font-style:italic}
.login-wrap p{text-align:center;font-size:.82rem;color:var(--td);margin-bottom:1.8rem}
.inp-group{margin-bottom:1.1rem;position:relative}
.inp-group label{display:block;font-size:.68rem;font-weight:500;letter-spacing:1.2px;text-transform:uppercase;color:var(--td);margin-bottom:.38rem}
.inp-group input{width:100%;padding:.72rem 1rem .72rem 2.8rem;background:rgba(232,240,255,.06);border:1px solid rgba(10,61,140,.30);border-radius:10px;color:var(--silver);font-family:'DM Sans',sans-serif;font-size:.87rem;outline:none;transition:all .25s}
.inp-group input:focus{border-color:var(--blue2);background:rgba(10,61,140,.12);box-shadow:0 0 0 3px rgba(10,61,140,.15)}
.inp-group .ic2{position:absolute;left:.9rem;top:2.35rem;color:var(--td);font-size:.85rem}
.btn-login{width:100%;padding:.82rem;background:linear-gradient(135deg,var(--blue),var(--blue2));color:#fff;border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.88rem;font-weight:600;cursor:pointer;letter-spacing:.5px;transition:all .28s;margin-top:.5rem}
.btn-login:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(21,87,200,.45);background:linear-gradient(135deg,var(--blue2),var(--blue3))}
</style>
</head>
<body>
<canvas id="bg"></canvas>

<nav id="nav">
  <div class="logo">PT Ken Mandiri<small>Business Information System</small></div>
  <ul class="nav-links">
    <li><a href="#home" class="on">Beranda</a></li>
    <li><a href="#about">Tentang</a></li>
    <li><a href="#login-section" class="nav-cta">Login</a></li>
  </ul>
</nav>

<!-- ══════════ HOME ══════════ -->
<section id="home">
  <div>
    <div class="eyebrow g"><span class="dot"></span> Sistem Informasi Bisnis</div>
    <h1 class="htit">
      <span class="a">PT Ken</span><br>
      <span>Mandiri</span><br>
      <span class="b">Solusi Bisnis Terpadu</span>
    </h1>
    <p class="hsub">Kelola pembelian, penjualan, dan hubungan bisnis perusahaan Anda dalam satu platform yang terintegrasi dan mudah digunakan.</p>
    <div class="btns">
      <a href="#login-section" class="btn bp">🚀 Masuk Sistem</a>
      <a href="#about" class="btn bo">📋 Tentang Kami</a>
    </div>
    <div class="srow">
      <div class="sc g"><span class="n">6</span><span class="l">Modul</span></div>
      <div class="sc g"><span class="n">∞</span><span class="l">Transaksi</span></div>
      <div class="sc g"><span class="n">100%</span><span class="l">Terintegrasi</span></div>
      <div class="sc g"><span class="n">24/7</span><span class="l">Akses</span></div>
    </div>
  </div>
  <div class="hero-vis">
    <div class="hero-card g">
      <svg class="hero-svg" width="320" height="260" viewBox="0 0 320 260" xmlns="http://www.w3.org/2000/svg">
        <!-- Background rect -->
        <rect x="20" y="20" width="280" height="200" rx="16" fill="rgba(10,61,140,0.15)" stroke="rgba(21,87,200,0.3)" stroke-width="1.5"/>
        <!-- Header bar -->
        <rect x="20" y="20" width="280" height="44" rx="16" fill="rgba(10,61,140,0.3)"/>
        <rect x="20" y="48" width="280" height="16" fill="rgba(10,61,140,0.3)"/>
        <!-- Dots -->
        <circle cx="44" cy="42" r="5" fill="#ef4444"/>
        <circle cx="62" cy="42" r="5" fill="#f59e0b"/>
        <circle cx="80" cy="42" r="5" fill="#22c55e"/>
        <!-- Title text placeholder -->
        <rect x="108" y="37" width="104" height="10" rx="5" fill="rgba(64,128,232,0.4)"/>
        <!-- Table rows -->
        <rect x="36" y="78" width="248" height="8" rx="4" fill="rgba(64,128,232,0.3)"/>
        <rect x="36" y="96" width="200" height="6" rx="3" fill="rgba(232,240,255,0.12)"/>
        <rect x="36" y="110" width="220" height="6" rx="3" fill="rgba(232,240,255,0.08)"/>
        <rect x="36" y="124" width="180" height="6" rx="3" fill="rgba(232,240,255,0.12)"/>
        <rect x="36" y="138" width="240" height="6" rx="3" fill="rgba(232,240,255,0.08)"/>
        <rect x="36" y="152" width="190" height="6" rx="3" fill="rgba(232,240,255,0.12)"/>
        <!-- Button -->
        <rect x="220" y="170" width="68" height="24" rx="12" fill="rgba(21,87,200,0.6)"/>
        <rect x="36" y="174" width="80" height="6" rx="3" fill="rgba(64,128,232,0.3)"/>
        <!-- Chart bars -->
        <rect x="36" y="130" width="10" height="50" rx="3" fill="rgba(21,87,200,0.5)"/>
        <rect x="52" y="115" width="10" height="65" rx="3" fill="rgba(21,87,200,0.7)"/>
        <rect x="68" y="120" width="10" height="60" rx="3" fill="rgba(21,87,200,0.5)"/>
      </svg>
      <div class="info-pills">
        <span class="pill">📦 Barang</span>
        <span class="pill">🏢 Customer</span>
        <span class="pill">🚛 Supplier</span>
        <span class="pill">📄 Invoice</span>
        <span class="pill">🧾 Nota Pembelian</span>
      </div>
    </div>
  </div>
</section>

<!-- ══════════ ABOUT ══════════ -->
<section id="about">
  <div class="rv">
    <div class="stag">Tentang Sistem</div>
    <h2 class="stit">Sistem Informasi<br><em>PT Ken Mandiri</em></h2>
    <div class="gline"></div>
    <p class="atxt">PT Ken Mandiri menghadirkan sistem informasi bisnis yang komprehensif untuk memudahkan pengelolaan transaksi pembelian dan penjualan. Dengan antarmuka yang intuitif, semua data bisnis dapat diakses dan dikelola dengan efisien.</p>
    <p class="atxt">Sistem ini mencakup manajemen barang, data customer, supplier, nota pembelian, dan invoice penjualan — semua terintegrasi dalam satu platform yang andal.</p>
    <div class="flist">
      <div class="fi gs rv"><div class="fic">📦</div><div class="ft"><h4>Manajemen Barang</h4><p>Kelola katalog produk lengkap dengan harga dan keterangan.</p></div></div>
      <div class="fi gs rv" style="transition-delay:.1s"><div class="fic">🤝</div><div class="ft"><h4>Data Customer & Supplier</h4><p>Simpan dan kelola informasi mitra bisnis dengan mudah.</p></div></div>
      <div class="fi gs rv" style="transition-delay:.2s"><div class="fic">🧾</div><div class="ft"><h4>Nota Pembelian</h4><p>Catat setiap transaksi pembelian beserta detailnya secara akurat.</p></div></div>
      <div class="fi gs rv" style="transition-delay:.3s"><div class="fic">📄</div><div class="ft"><h4>Invoice Penjualan</h4><p>Buat dan kelola invoice penjualan dengan perhitungan otomatis.</p></div></div>
    </div>
  </div>
  <div class="aright">
    <div class="ic g rv">
      <h3>🏢 Informasi Perusahaan</h3>
      <div class="igrid">
        <div class="ii"><label>Nama</label><span>PT Ken Mandiri</span></div>
        <div class="ii"><label>Sistem</label><span>Business Information System</span></div>
        <div class="ii"><label>Modul</label><span>6 Modul Utama</span></div>
        <div class="ii"><label>Database</label><span>MySQL — pt_ken_mandiri</span></div>
        <div class="ii"><label>Platform</label><span>PHP & Web Based</span></div>
        <div class="ii"><label>Status</label><span>Aktif & Terintegrasi</span></div>
      </div>
    </div>
    <div class="ic g rv" style="transition-delay:.15s">
      <h3>⚙️ Fitur Utama</h3>
      <div class="rrow">
        <div class="rc gs"><span class="ri">📦</span><span class="rn">Barang</span><div class="rd">Katalog produk lengkap</div></div>
        <div class="rc gs"><span class="ri">🏢</span><span class="rn">Perusahaan</span><div class="rd">Data perusahaan & penandatangan</div></div>
        <div class="rc gs"><span class="ri">👤</span><span class="rn">Customer</span><div class="rd">Manajemen pelanggan</div></div>
        <div class="rc gs"><span class="ri">🚛</span><span class="rn">Supplier</span><div class="rd">Manajemen pemasok</div></div>
      </div>
    </div>
    <div class="ic g rv" style="transition-delay:.3s">
      <h3>📊 Modul Transaksi</h3>
      <div style="display:flex;flex-direction:column;gap:.6rem">
        <div style="display:flex;gap:.8rem;align-items:center"><span style="font-size:20px">🧾</span><div><div style="font-size:.82rem;color:var(--silver)">Nota Pembelian</div><div style="font-size:.68rem;color:var(--td)">Transaksi beli + detail pembelian</div></div></div>
        <div style="display:flex;gap:.8rem;align-items:center"><span style="font-size:20px">📄</span><div><div style="font-size:.82rem;color:var(--silver)">Invoice Penjualan</div><div style="font-size:.68rem;color:var(--td)">Faktur jual + detail invoice</div></div></div>
        <div style="display:flex;gap:.8rem;align-items:center"><span style="font-size:20px">📈</span><div><div style="font-size:.82rem;color:var(--silver)">Laporan Bisnis</div><div style="font-size:.68rem;color:var(--td)">Ringkasan transaksi & performa</div></div></div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════ LOGIN ══════════ -->
<section id="login-section">
  <div class="login-wrap g">
    <h2>Masuk Sistem</h2>
    <p>PT Ken Mandiri — Business Information System</p>
    <div class="inp-group">
      <label>Username</label>
      <i class="ic2">👤</i>
      <input type="text" placeholder="Masukkan username">
    </div>
    <div class="inp-group">
      <label>Password</label>
      <i class="ic2">🔒</i>
      <input type="password" placeholder="Masukkan password">
    </div>
    <a href="home.php"><button class="btn-login">🚀 Masuk ke Dashboard</button></a>
    <p style="text-align:center;font-size:.7rem;color:var(--td);margin-top:1rem">Sistem Informasi Manajemen PT Ken Mandiri</p>
  </div>
</section>

<script>
/* ── BG CANVAS ── */
const cv=document.getElementById('bg'),cx=cv.getContext('2d');let W,H;
function rsz(){W=cv.width=innerWidth;H=cv.height=innerHeight;}
rsz();addEventListener('resize',rsz);
const orbs=[
  {x:.12,y:.28,r:300,c:'7,26,64',a:.22},
  {x:.85,y:.55,r:240,c:'10,61,140',a:.12},
  {x:.5,y:.88,r:200,c:'21,87,200',a:.10},
  {x:.35,y:.65,r:160,c:'7,26,64',a:.08},
];
const pts=Array.from({length:120},()=>({x:Math.random()*1920,y:Math.random()*1080,r:Math.random()*2+.4,vx:(Math.random()-.5)*.20,vy:-Math.random()*.35-.08,a:Math.random()*.28+.04,c:Math.random()>.5?'10,61,140':'21,87,200'}));
function draw(){
  cx.clearRect(0,0,W,H);cx.fillStyle='#050F22';cx.fillRect(0,0,W,H);
  orbs.forEach(o=>{const g=cx.createRadialGradient(o.x*W,o.y*H,0,o.x*W,o.y*H,o.r);g.addColorStop(0,`rgba(${o.c},${o.a})`);g.addColorStop(1,'rgba(0,0,0,0)');cx.beginPath();cx.arc(o.x*W,o.y*H,o.r,0,Math.PI*2);cx.fillStyle=g;cx.fill();});
  cx.strokeStyle='rgba(10,61,140,.03)';cx.lineWidth=.5;
  for(let x=0;x<W;x+=56){cx.beginPath();cx.moveTo(x,0);cx.lineTo(x,H);cx.stroke()}
  for(let y=0;y<H;y+=56){cx.beginPath();cx.moveTo(0,y);cx.lineTo(W,y);cx.stroke()}
  pts.forEach(p=>{p.x+=p.vx;p.y+=p.vy;p.a-=.0003;if(p.y<-8||p.a<=0){p.x=Math.random()*W;p.y=H+5;p.a=Math.random()*.28+.04;}cx.beginPath();cx.arc(p.x,p.y,p.r,0,Math.PI*2);cx.fillStyle=`rgba(${p.c},${p.a})`;cx.fill();});
  requestAnimationFrame(draw);
}draw();
/* ── NAV ── */
const nav=document.getElementById('nav');
addEventListener('scroll',()=>{nav.classList.toggle('scrolled',scrollY>40);const ids=['home','about','login-section'];let cur='';ids.forEach(id=>{const el=document.getElementById(id);if(el&&scrollY>=el.offsetTop-110)cur=id;});document.querySelectorAll('.nav-links a').forEach(a=>{a.classList.toggle('on',a.getAttribute('href')==='#'+cur);});});
document.querySelectorAll('a[href^="#"]').forEach(a=>{a.addEventListener('click',e=>{e.preventDefault();const t=document.querySelector(a.getAttribute('href'));if(t)t.scrollIntoView({behavior:'smooth'});});});
const obs=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting)e.target.classList.add('on');});},{threshold:.1});
document.querySelectorAll('.rv').forEach(el=>obs.observe(el));
</script>
</body>
</html>
