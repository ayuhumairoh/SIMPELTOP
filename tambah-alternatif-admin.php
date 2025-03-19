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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SPK MOORA - Merek Laptop</title>
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
          <li><a class="nav-link scrollto" href="sub-kriteria.php">Sub Kriteria</a></li>
          <li><a class="nav-link scrollto active" href="alternatif-admin.php">Data Laptop</a></li>
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
    <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
    <div class="section-title" style="padding-top:60px;">
      <h2>Tambah Data Laptop</h2>
      <p>Silahkan lakukan penambahan Data Laptop beserta subkriterianya</p>
    </div>
    <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6 align-items-stretch">
        <div class="card">
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <?php
              $query = mysqli_query($koneksi, "SELECT kode_alternatif FROM alternatif ORDER BY id_alternatif DESC LIMIT 1");
              $baris = mysqli_fetch_array($query);
              $angka = ltrim($baris['kode_alternatif'], 'A');
              $angka = $angka + 1;
              $kode = "A{$angka}";
              ?>
              <div class="form-group mb-3">
                <label for="kode">Kode Alternatif</label>
                <input type="text" name="kode" value="<?= $kode; ?>" class="form-control" id="kode" required readonly>
              </div>
              <div class="form-group mb-3">
                <label for="alternatif">Merek Laptop</label>
                <input type="text" name="alternatif" class="form-control" id="alternatif" required autocomplete="off">
              </div>
              <div class="form-group mb-3">
                <label for="foto">Foto Laptop</label>
                <input type="file" name="foto" class="form-control" id="foto" required>
              </div>

              <div class="form-group mb-3">
  <label for="harga_unit">Harga Unit</label>
  <input type="text" name="harga_unit" class="form-control" id="harga_unit" required>
</div>
              <div class="form-group mb-3">
                <label for="harga">Harga</label>
                <select name="harga" class="form-select" aria-label="Default select example" id="harga">
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM harga");
                  while ($baris = mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?= $baris['bobot']; ?>"><?= $baris['harga']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group mb-3">
                <label for="processor">Processor</label>
                <select name="processor" class="form-select" aria-label="Default select example" id="processor">
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM processor");
                  while ($baris = mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?= $baris['bobot']; ?>"><?= $baris['processor']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group mb-3">
                <label for="ram">RAM</label>
                <select name="ram" class="form-select" aria-label="Default select example" id="ram">
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM ram");
                  while ($baris = mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?= $baris['bobot']; ?>"><?= $baris['ram']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group mb-3">
                <label for="vga">VGA</label>
                <select name="vga" class="form-select" aria-label="Default select example" id="vga">
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM vga");
                  while ($baris = mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?= $baris['bobot']; ?>"><?= $baris['vga']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group mb-3">
                <label for="penyimpanan">Penyimpanan</label>
                <select name="penyimpanan" class="form-select" aria-label="Default select example" id="penyimpanan">
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM penyimpanan");
                  while ($baris = mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?= $baris['bobot']; ?>"><?= $baris['penyimpanan']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group mb-3">
                <label for="resolusi">Resolusi Layar</label>
                <select name="resolusi" class="form-select" aria-label="Default select example" id="resolusi">
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM resolusi");
                  while ($baris = mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?= $baris['bobot']; ?>"><?= $baris['resolusi']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group mb-3">
                <label for="konektifitas">Konektifitas</label>
                <select name="konektifitas" class="form-select" aria-label="Default select example" id="konektifitas">
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM konektifitas");
                  while ($baris = mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?= $baris['bobot']; ?>"><?= $baris['konektifitas']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="text-center"><button name="tambah" class="btn btn-primary rounded-pill px-4">Tambah</button></div>
            </form>
          </div>
        </div>
        <?php
        if (isset($_POST['tambah'])) {
          $kode_alternatif = htmlspecialchars($_POST['kode']);
          $alternatif = htmlspecialchars($_POST['alternatif']);
          $harga_unit = htmlspecialchars($_POST['harga_unit']); // Harga unit asli
          $harga = htmlspecialchars($_POST['harga']);
          $processor = htmlspecialchars($_POST['processor']);
          $ram = htmlspecialchars($_POST['ram']);
          $vga = htmlspecialchars($_POST['vga']);
          $penyimpanan = htmlspecialchars($_POST['penyimpanan']);
          $resolusi = htmlspecialchars($_POST['resolusi']);
          $konektifitas = htmlspecialchars($_POST['konektifitas']);
          
          $foto = $_FILES['foto']['name'];
          $tmp_foto = $_FILES['foto']['tmp_name'];
          $foto_path = "uploads/" . $foto;

          

          if (move_uploaded_file($tmp_foto, $foto_path)) {
            $query = mysqli_query($koneksi, "INSERT INTO alternatif(kode_alternatif, nama_alternatif, foto, harga_unit, harga, processor, ram, vga, penyimpanan, resolusi, konektifitas) VALUES('$kode_alternatif', '$alternatif', '$foto','$harga_unit', '$harga', '$processor', '$ram', '$vga', '$penyimpanan', '$resolusi', '$konektifitas')");

            if ($query) {
              echo "
              <script>
                document.location.href = 'alternatif-admin.php'
              </script>
              ";
            } else {
              echo "
              <script>
                alert('Gagal menambahkan data!');
                document.location.href = 'tambah-alternatif-admin.php'
              </script>
              ";
            }
          } else {
            echo "
            <script>
              alert('Gagal mengupload foto!');
              document.location.href = 'tambah-alternatif-admin.php'
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

  <script>
  window.history.scrollRestoration = 'manual';
</script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/jquery.dataTables.js"></script>
  
</body>

</html>