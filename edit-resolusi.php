<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['admin-session'])) {
  echo "
  <script>
    document.location.href = 'index.php'
  </script>
  ";
}

if (!isset($_GET['id'])) {
  echo "
  <script>
    document.location.href = '404.php'
  </script>
  ";
}
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SPK MOORA - Sub Kriteria</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">

  <!-- =======================================================
  * Template Name: Arsha - v4.10.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto">
        <a href="index.html">SPK MOORA</a><br>
        <span class="fs-6 text-white">Pemilihan Laptop Terbaik</span>
      </h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="kriteria-admin.php">Kriteria</a></li>
          <li><a class="nav-link scrollto active" href="sub-kriteria.php">Sub Kriteria</a></li>
          <li><a class="nav-link scrollto" href="alternatif-admin.php">Data Laptop</a></li>
          <li><a class="nav-link scrollto" href="perhitungan-admin.php">Perhitungan</a></li>
          <li><a class="nav-link scrollto" href="hasil-admin.php">Hasil Akhir</a></li>
          <li><a class="getstarted scrollto" href="logout.php">Keluar</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <h2>Edit Resolusi Layar</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Edit Resolusi Layar</h2>
          <p>Silahkan lakukan edit sub kriteria Resolusi Layar</p>
        </div>
        <div class="row">
          <div class="col-lg-3"></div>
          <div class="col-lg-6 align-items-stretch">
            <div class="card">
              <div class="card-body">
                <form method="post">
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM resolusi WHERE id_resolusi = '$id'");
                  $get = mysqli_fetch_array($query);
                  ?>
                  <div class="form-group mb-3">
                    <label for="sub">Nama Sub Kriteria</label>
                    <input type="text" name="sub" value="<?= $get['resolusi']; ?>" class="form-control" id="sub" required autocomplete="off">
                  </div>
                  <div class="form-group mb-3">
                    <label for="nilai">Nilai</label>
                    <input type="number" name="nilai" value="<?= $get['bobot']; ?>" class="form-control" id="nilai" required autocomplete="off">
                  </div>
                  <div class="text-center"><button name="tambah" class="btn btn-primary rounded-pill px-4" >Edit</button></div>
                </form>
              </div>
            </div>
            <?php
            if (isset($_POST['tambah'])) {
              $sub = htmlspecialchars($_POST['sub']);
              $nilai = htmlspecialchars($_POST['nilai']);

              $query = mysqli_query($koneksi, "UPDATE resolusi SET resolusi = '$sub', bobot = '$nilai' WHERE id_resolusi = '$id'");

              if ($query) {
                echo "
                <script>
                  document.location.href = 'alternatif.php'
                </script>
                ";
              } else {
                echo "
                <script>
                  document.location.href = 'edit-alternatif.php'
                </script>
                ";
              }
            }
            ?>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Informatika <strong><span>Universitas Mulawarman</span></strong>
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Skripsi <a href="#">Ayu Humairoh</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/jquery.dataTables.js"></script>

</body>

</html>