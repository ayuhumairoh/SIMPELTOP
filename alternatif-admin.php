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

  <title>SIMPEL TOP</title>
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

<style>
    /* Atur lebar kolom Konektifitas agar lebih sempit */
    td.konektifitas {
        width: 100px; /* Sesuaikan dengan lebar yang diinginkan */
        text-align: center; /* Menyelaraskan teks ke tengah, jika diperlukan */
    }

    /* Atur lebar kolom Foto agar lebih lebar */
    td.foto {
        width: 200px; /* Sesuaikan dengan lebar yang diinginkan */
        text-align: center; /* Menyelaraskan gambar ke tengah */
    }

    /* Atur gambar agar tidak terlalu besar */
    td.foto img {
        width: 100%; /* Agar gambar menyesuaikan lebar kolom */
        max-width: 150px; /* Sesuaikan ukuran gambar maksimal */
        height: auto; /* Menjaga rasio aspek gambar */
    }
</style>


  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto">
        <a href="index.html">SPK MOORA</a><br>
        <span class="fs-6 text-white">Pemilihan Laptop terbaik</span>
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
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <h2>Data Laptop</h2>
      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        <div class="table-responsive">
          <a href="tambah-alternatif-admin.php" class="btn btn-primary mb-3"><i class="bi bi-plus"></i> Tambah Merek Laptop</a>
          <table id="alternatif" class="cell-border" width="100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Kode</th>
                <th>Merek laptop</th>
                <th>Harga</th>
                <th>Processor</th>
                <th>RAM</th>
                <th>VGA</th>
                <th>Penyimpanan</th>
                <th>Resolusi</th>
                <th>Kelengkapan Konektifitas</th>
                <th>Foto</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = mysqli_query($koneksi, "SELECT * FROM alternatif");
              $i = 1;
              while ($baris = mysqli_fetch_array($query)) {
                $harga = $baris['harga'];
                $processor = $baris['processor'];
                $ram = $baris['ram'];
                $vga = $baris['vga'];
                $penyimpanan = $baris['penyimpanan'];
                $resolusi = $baris['resolusi'];
                $konektifitas = $baris['konektifitas'];
                $foto = $baris['foto']; // Kolom foto
              ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $baris['kode_alternatif']; ?></td>
                <td><?= $baris['nama_alternatif']; ?></td>
                <td>
                  <?php
                  $subkriteria = mysqli_fetch_array(mysqli_query($koneksi, "SELECT harga FROM harga WHERE bobot = '$harga'"));
                  echo $subkriteria['harga'];
                  ?>
                </td>
                <td>
                  <?php
                  $subkriteria = mysqli_fetch_array(mysqli_query($koneksi, "SELECT processor FROM processor WHERE bobot = '$processor'"));
                  echo $subkriteria['processor'];
                  ?>
                </td>
                <td>
                  <?php
                  $subkriteria = mysqli_fetch_array(mysqli_query($koneksi, "SELECT ram FROM ram WHERE bobot = '$ram'"));
                  echo $subkriteria['ram'];
                  ?>
                </td>
                <td>
                  <?php
                  $subkriteria = mysqli_fetch_array(mysqli_query($koneksi, "SELECT vga FROM vga WHERE bobot = '$vga'"));
                  echo $subkriteria['vga'];
                  ?>
                </td>
                <td>
                  <?php
                  $subkriteria = mysqli_fetch_array(mysqli_query($koneksi, "SELECT penyimpanan FROM penyimpanan WHERE bobot = '$penyimpanan'"));
                  echo $subkriteria['penyimpanan'];
                  ?>
                </td>
                <td>
                  <?php
                  $subkriteria = mysqli_fetch_array(mysqli_query($koneksi, "SELECT resolusi FROM resolusi WHERE bobot = '$resolusi'"));
                  echo $subkriteria['resolusi'];
                  ?>
                </td>
                <td>
                  <?php
                  $subkriteria = mysqli_fetch_array(mysqli_query($koneksi, "SELECT konektifitas FROM konektifitas WHERE bobot = '$konektifitas'"));
                  echo $subkriteria['konektifitas'];
                  ?>
                </td>
                <td>
                  <?php if ($foto): ?>
                    <img src="uploads/<?= $foto; ?>" alt="<?= $baris['foto']; ?>" style="width: 100px; height: auto;">
                  <?php else: ?>
                    <p>Tidak ada Foto</p>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="hapus-alternatif-admin.php?id=<?= $baris['id_alternatif']; ?>" class="btn btn-danger mb-2"><i class="bi bi-trash"></i></a>
                  <a href="edit-alternatif-admin.php?id=<?= $baris['id_alternatif']; ?>" class="btn btn-primary mb-2"><i class="bi bi-pencil"></i></a>
                </td>
              </tr>
              <?php
                $i++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

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
  <script>
    $(document).ready(function () {
        $('#alternatif').DataTable();
    });
  </script>

</body>

</html>