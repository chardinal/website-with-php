<?php
include 'db_conection.php';
// Data dinamis untuk digunakan di berbagai bagian website
$title = "DevSync";
$contact_info = [
    "name" => "DevSync",
    "address" => "Sistem Informasi, Fakultas Teknik, Universitas Negeri Surabaya.",
    "phone" => "081213141516",
    "email" => "devsync@gmail.com"
];

// Proses formulir kontak
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validasi sederhana
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Simulasi pengiriman email (dapat disesuaikan untuk menggunakan fungsi mail atau menyimpan ke database)
        echo "<script>alert('Pesan berhasil dikirim!');</script>";
    } else {
        echo "<script>alert('Mohon lengkapi semua field.');</script>";
    }  
}

$query = "SELECT * FROM captiom";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
// Query untuk mengambil data dari tabel paket_layanan
$query = "SELECT * FROM paket_layanan";
$result = $conn->query($query);

// Periksa apakah ada data yang diambil
if ($result && $result->num_rows > 0) {
    $paket_layanan = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $paket_layanan =[];
}

// Ambil nomor WhatsApp dari database
$query_whatsapp = "SELECT * FROM customer_services LIMIT 1";
$result_whatsapp = mysqli_query($conn, $query_whatsapp);
$whatsapp_row = mysqli_fetch_assoc($result_whatsapp);
$no_wa = $whatsapp_row['no_whatsapp']; 
?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1">
    <title><?php echo $title; ?></title>
      <link rel="icon" href="img/logo_baru_devsync.jpg" type="image/png">
      <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
      <link href="css/style.css" rel="stylesheet" type="text/css">
      <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
      <link href="css/animate.css" rel="stylesheet" type="text/css">
      <link href="css/whatsapp.css" rel="stylesheet" type="text/css">
</head>
<body>

 <!--Header_section-->
 <header id="header_wrapper">
    <div class="container">
      <div class="header_box">
        <div class="logo"><a href="#"><img src="img/logo+nama.png" alt="logo" width="140"></a></div>
        <nav class="navbar navbar-inverse" role="navigation">
          <div class="navbar-header">
            <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
              <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
          <div id="main-nav" class="collapse navbar-collapse navStyle">
            <ul class="nav navbar-nav" id="mainNav">
              <li class="active"><a href="#hero_section" class="scroll-link">Home</a></li>
              <li><a href="#aboutUs" class="scroll-link">About Us</a></li>
              <li><a href="#service" class="scroll-link">Services</a></li>
              <li><a href="#Portfolio" class="scroll-link">Portofolio</a></li>
              <li><a href="#clients" class="scroll-link">Packages</a></li>
              <li><a href="#team" class="scroll-link">Team</a></li>
              <li><a href="#contact" class="scroll-link">Contact</a></li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <!--Header_section-->

<!-- Icon WhatsApp -->
<a
    href="https://wa.me/<?php echo $no_wa ; ?>?text=Halo kak saya ingin melakukan konfirmasi pesanan aplikaso mobile dan melakukan pambayaran!..."
    class="whatsapp-icon"
    aria-label="Chat via WhatsApp"
>
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
</a>

  <!--Hero_Section-->
  <section id="hero_section" class="top_cont_outer">
    <div class="hero_wrapper">
      <div class="container">
        <div class="hero_section">
          <div class="row">
            <div class="col-lg-5 col-sm-7">
              <div class="top_left_cont zoomIn wow animated">
                <h2>Wujudkan Aplikasi Mobile <strong>Impian Anda</strong> dengan Fitur Unggulan</h2>
                <p>Kembangkan bisnis anda dengan aplikasi custom! Kami siap <br> membantu mewujudkan solusi digital yang
                  sesuai kebutuhan anda</p>
                <a href="#service" class="read_more2">Read more</a>
              </div>
            </div>
            <div class="col-lg-7 col-sm-5">
              <img src="img/beranda.jpeg" width="500" class="zoomIn wow animated" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Hero_Section-->

  <section id="aboutUs"><!--Aboutus-->
    <div class="inner_wrapper">
      <div class="container">
        <h2>About Us</h2>
        <div class="inner_section">
          <div class="row">
            <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right"><img src="img/about-img.jpg"
                class="img-circle delay-03s animated wow zoomIn" alt=""></div>
            <div class=" col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-left">
              <div class=" delay-01s animated fadeInDown wow animated">
                <h3>Membangun Aplikasi Mobile yang Inovatif dengan Fitur Unggulan..</h3><br />
                <p>DevSync adalah sebuah perusahaan yang bergerak pada jasa pembuatan aplikasi mobile dengan fokus pada
                  inovasi dan kualitas tinggi. Kami menawarkan desain modern dan responsif, teknologi terbaru, keamanan
                  tinggi, optimasi SEO, kolaborasi tim, pengalaman pengguna optimal, dan dukungan penuh setelah
                  peluncuran.</p><br>
                <p><?= $row['conten']?></p>
              </div>
              
              <div class="work_bottom"> <span>Ingin Tahu Lebih Banyak?</span> <a href="#contact"
                  class="contact_btn">Contact Us</a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Aboutus-->


  <!--Service-->
  <section id="service">
    <div class="container">
      <h2>Services</h2>
      <div class="service_wrapper">
        <div class="row">
          <div class="col-lg-4">
            <div class="service_block">
              <div class="service_icon delay-03s animated wow  zoomIn"> <span><i class="fa fa-android"></i></span>
              </div>
              <h3 class="animated fadeInUp wow">Android</h3>
              <p class="animated fadeInDown wow">Desain ini dapat menyesuaikan dengan berbagai macam android tanpa
                adanya gangguan.</p>
            </div>
          </div>
          <div class="col-lg-4 borderLeft">
            <div class="service_block">
              <div class="service_icon icon2  delay-03s animated wow zoomIn"> <span><i class="fa fa-apple"></i></span>
              </div>
              <h3 class="animated fadeInUp wow">Apple IOS</h3>
              <p class="animated fadeInDown wow">Desain ini dapat menyesuaikan dengan berbagai macam iphone tanpa adanya
                gangguan.</p>
            </div>
          </div>
          <div class="col-lg-4 borderLeft">
            <div class="service_block">
              <div class="service_icon icon3  delay-03s animated wow zoomIn"> <span><i class="fa fa-html5"></i></span>
              </div>
              <h3 class="animated fadeInUp wow">Design</h3>
              <p class="animated fadeInDown wow">mengutamakan desain modern dan intuitif yang tidak hanya menarik secara
                visual tetapi juga meningkatkan pengalaman pengguna..</p>
            </div>
          </div>
        </div>
        <div class="row borderTop">
          <div class="col-lg-4 mrgTop">
            <div class="service_block">
              <div class="service_icon delay-03s animated wow  zoomIn"> <span><i class="fa fa-dropbox"></i></span>
              </div>
              <h3 class="animated fadeInUp wow">Concept</h3>
              <p class="animated fadeInDown wow">Membantu klien dalam merumuskan ide-ide kreatif yang dapat memenuhi
                kebutuhan pasar dan pengguna untuk menghasilkan solusi inovatif..</p>
            </div>
          </div>
          <div class="col-lg-4 borderLeft mrgTop">
            <div class="service_block">
              <div class="service_icon icon2  delay-03s animated wow zoomIn"> <span><i class="fa fa-slack"></i></span>
              </div>
              <h3 class="animated fadeInUp wow">User Research</h3>
              <p class="animated fadeInDown wow">Dengan melakukan wawancara, survei, dan pengujian kegunaan untuk
                memahami kebutuhan, perilaku, dan harapan pengguna.</p>
            </div>
          </div>
          <div class="col-lg-4 borderLeft mrgTop">
            <div class="service_block">
              <div class="service_icon icon3  delay-03s animated wow zoomIn"> <span><i class="fa fa-users"></i></span>
              </div>
              <h3 class="animated fadeInUp wow">User Experience</h3>
              <p class="animated fadeInDown wow">Melalui analisis mendalam tentang bagaimana pengguna berinteraksi
                dengan aplikasi untuk meningkatkan kepuasan pengguna..</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Service-->

  <!-- Portfolio -->
  <section id="Portfolio" class="content">

    <!-- Container -->
    <div class="container portfolio_title">

      <!-- Title -->
      <div class="section-title">
        <h2>Portofolio</h2>
      </div>
      <!--/Title -->

    </div>
    <!-- Container -->

    <div class="portfolio-top"></div>

    <!-- Portfolio Filters -->
    <div class="portfolio">
    <div id="filters" class="sixteen columns">
        <ul class="clearfix">
            <li><a id="all" href="#" data-filter="*" class="active">
                    <h5>All</h5>
                </a></li>
            <li><a class="" href="#" data-filter=".pendidikan">
                    <h5>Pendidikan</h5>
                </a></li>
            <li><a class="" href="#" data-filter=".kesehatan">
                    <h5>Kesehatan</h5>
                </a></li>
            <li><a class="" href="#" data-filter=".travelling">
                    <h5>Travelling</h5>
                </a></li>
            <li><a class="" href="#" data-filter=".e-commerce">
                    <h5>E-Commerce</h5>
                </a></li>
            <li><a class="" href="#" data-filter=".sosial">
                    <h5>Sosial</h5>
                </a></li>
        </ul>
    </div>
    <!--/Portfolio Filters -->
    <!-- Portfolio Wrapper -->
    <div class="isotope fadeInLeft animated wow" id="portfolio_wrapper">

        <?php
        // Query untuk mendapatkan data portofolio
        $sql = "SELECT kategori, gambar FROM porto";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kategori = strtolower($row['kategori']); // Pastikan kelas sesuai format (huruf kecil)
                $gambar = $row['gambar']; // Nama file gambar dari database
                $project_name = ucwords(str_replace('_', ' ', $kategori)); // Nama project default
        ?>
                <!-- Portfolio Item -->
                <div class="portfolio-item one-four <?= $kategori ?> isotope-item">
                    <div class="portfolio_img">
                        <img src="img/<?= $gambar ?>" alt="Portfolio <?= $project_name ?>">
                    </div>
                    <div class="item_overlay">
                        <div class="item_info">
                            <h4 class="project_name"><?= $project_name ?></h4>
                        </div>
                    </div>
                </div>
                <!--/Portfolio Item -->
        <?php
            }
        } else {
            echo "<p>Tidak ada data portofolio tersedia.</p>";
        }
        $conn->close();
        ?>

    </div>
    <!--/Portfolio Wrapper -->
</div>

    <!--/Portfolio Filters -->
    <div class="portfolio_btm"></div>
    <div id="project_container">
      <div class="clear"></div>
      <div id="project_data"></div>
    </div>


  </section>
  <!--/Portfolio -->
  <!-- Pricing Table Section -->
  <!--page_section-->
    <h2>PILIHAN PAKET</h2>
    <section class="page_section" id="clients">
    <section class="pricing-table">
        <div class="plans">
            <?php foreach ($paket_layanan as $paket): ?>
                <div class="plan">
                <ul class="fadeInRight animated wow">
                    <h3><?= htmlspecialchars($paket['nama_paket']) ?></h3>
                    <p class="price">Rp <?= number_format($paket['harga'], 0, ',', '.') ?></p>
                    <ul>
                        <li><?= nl2br(htmlspecialchars($paket['fitur'])) ?></li>
                        <li>Durasi Pengerjaan <?= htmlspecialchars($paket['durasi_pengerjaan']) ?> Hari</li>
                        <li>Jumlah Revisi <?= htmlspecialchars($paket['jumlah_revisi']) ?> Kali</li>
                    </ul>
                    <button onclick="window.location.href='pendaftaran.php?paket=<?= urlencode($paket['id_paket']) ?>'" class="btn">Get Now</button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

  <!--client_logos-->

  <section class="page_section team" id="team"><!--main-section team-start-->
    <div class="container">
      <h2>Team DevSync</h2>

      <div class="team_section clearfix">
        <div class="team_area">
          <div class="team_box wow fadeInDown delay-03s">
            <div class="team_box_shadow"><a href="javascript:void(0)"></a></div>
            <img src="img/chardinal.png" alt="">
            <ul>
              <li><a href="javascript:void(0)" class="fa fa-linkedin-square"></a></li>
              <li><a href="javascript:void(0)" class="fa fa-envelope-o"></a></li>
              <li><a href="javascript:void(0)" class="fa fa-instagram"></a></li>
              <li><a href="javascript:void(0)" class="fa fa-github"></a></li>
            </ul>
          </div>
          <h3 class="wow fadeInDown delay-03s">Chardinal Martin Butarbutar</h3>
          <span class="wow fadeInDown delay-03s">Development</span>
          <p class="wow fadeInDown delay-03s">Mahasiswa.</p>
        </div>
        <div class="team_area">
          <div class="team_box  wow fadeInDown delay-06s">
            <div class="team_box_shadow"><a href="javascript:void(0)"></a></div>
            <img src="img/Ryan.png" alt="">
            <ul>
              <li><a href="javascript:void(0)" class="fa fa-linkedin-square"></a></li>
              <li><a href="javascript:void(0)" class="fa fa-envelope-o"></a></li>
              <li><a href="javascript:void(0)" class="fa fa-instagram"></a></li>
              <li><a href="javascript:void(0)" class="fa fa-github"></a></li>
            </ul>
          </div>
          <h3 class="wow fadeInDown delay-06s">Ryan Dwi Antoni</h3>
          <span class="wow fadeInDown delay-06s">Divisi Analisis dan Perencanaan</span>
          <p class="wow fadeInDown delay-06s">Mahasiswa.</p>
        </div>
        <div class="team_area">
          <div class="team_box wow fadeInDown delay-09s">
            <div class="team_box_shadow"><a href="javascript:void(0)"></a></div>
            <img src="img/gideon.png" alt="">
            <ul>
              <li><a href="javascript:void(0)" class="fa fa-linkedin-square"></a></li>
              <li><a href="javascript:void(0)" class="fa fa-envelope-o"></a></li>
              <li><a href="javascript:void(0)" class="fa fa-instagram"></a></li>
              <li><a href="javascript:void(0)" class="fa fa-github"></a></li>
            </ul>
          </div>
          <h3 class="wow fadeInDown delay-09s">Gideon Ary Andy</h3>
          <span class="wow fadeInDown delay-09s">UI/UX Design</span>
          <p class="wow fadeInDown delay-09s">Mahasiswa.</p>
        </div>
      </div>
    </div>
  </section>
  <!--/Team-->
  <!--Footer-->
  <footer class="footer_wrapper" id="contact">
    <div class="container">
      <section class="page_section contact" id="contact">
        <div class="contact_section">
          <h2>Contact Us</h2>
          <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 wow fadeInLeft">
            <div class="contact_info">
              <div class="detail">
                <h4>DevSync</h4>
                <p>Sistem Informasi, Fakultas Teknik, Univesitas Negeri Surabaya.</p>
              </div>
              <div class="detail">
                <h4>Call Us</h4>
                <p>+<?php echo $no_wa ; ?></p>
              </div>
              <div class="detail">
                <h4>Email Us</h4>
                <p>devsync@gmail.com</p>
              </div>
            </div>



            <ul class="social_links">
              <li class="twitter animated bounceIn wow delay-02s"><a href="javascript:void(0)"><i
                    class="fa fa-linkedin-square"></i></a></li>
              <li class="facebook animated bounceIn wow delay-03s"><a href="javascript:void(0)"><i
                    class="fa fa-facebook-square"></i></a></li>
              <li class="pinterest animated bounceIn wow delay-04s"><a href="javascript:void(0)"><i
                    class="fa fa-instagram"></i></a></li>
              <li class="gplus animated bounceIn wow delay-05s"><a href="javascript:void(0)"><i
                    class="fa fa-envelope-o"></i></a></li>
            </ul>
          </div>
          <div class="col-lg-8 wow fadeInLeft delay-06s">
            <div class="form">
              <input class="input-text" type="text" name="" value="Your Name *"
                onFocus="if(this.value==this.defaultValue)this.value='';"
                onBlur="if(this.value=='')this.value=this.defaultValue;">
              <input class="input-text" type="text" name="" value="Your E-mail *"
                onFocus="if(this.value==this.defaultValue)this.value='';"
                onBlur="if(this.value=='')this.value=this.defaultValue;">
              <textarea class="input-text text-area" cols="0" rows="0"
                onFocus="if(this.value==this.defaultValue)this.value='';"
                onBlur="if(this.value=='')this.value=this.defaultValue;">Your Message *</textarea>
              <input class="input-btn" type="submit" value="send message">
            </div>
          </div>
        </div>
      </section>
    </div>
    <div class="container">
      <div class="footer_bottom"><span>Copyright © 2045, </div>
    </div>
  </footer>

  <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery-scrolltofixed.js"></script>
  <script type="text/javascript" src="js/jquery.nav.js"></script>
  <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="js/jquery.isotope.js"></script>
  <script type="text/javascript" src="js/wow.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>

</body>

</html>