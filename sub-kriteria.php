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
        
        <h2>Sub Kriteria</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-3">
            <div class="card">
              <div class="card-header">
                <div class="d-flex hstuck gap-2">
                  <h4>Harga - i1</h4>
                  <a href="tambah-harga.php" class="btn btn-primary ms-auto"><i class="bi bi-plus"></i> Tambah Harga</a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="harga" class="cell-border" width="100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Sub Kriteria</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = mysqli_query($koneksi, "SELECT * FROM harga ORDER BY bobot DESC");
                      $i = 1;
                      while ($baris = mysqli_fetch_array($query)) {
                      ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $baris['harga']; ?></td>
                        <td><?= $baris['bobot']; ?></td>
                        <td>
                          <a href="hapus-harga.php?id=<?= $baris['id_harga']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                          <a href="edit-harga.php?id=<?= $baris['id_harga']; ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
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
            </div>
          </div>
          <div class="col-lg-6 mb-3">
            <div class="card">
              <div class="card-header">
                <div class="d-flex hstuck gap-2">
                  <h4>Processor - i2</h4>
                  <a href="tambah-processor.php" class="btn btn-primary ms-auto"><i class="bi bi-plus"></i> Tambah processor</a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="processor" class="cell-border" width="100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Sub Kriteria</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = mysqli_query($koneksi, "SELECT * FROM processor ORDER BY bobot DESC");
                      $i = 1;
                      while ($baris = mysqli_fetch_array($query)) {
                      ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $baris['processor']; ?></td>
                        <td><?= $baris['bobot']; ?></td>
                        <td>
                          <a href="hapus-processor.php?id=<?= $baris['id_processor']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                          <a href="edit-processor.php?id=<?= $baris['id_processor']; ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
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
            </div>
          </div>
          <div class="col-lg-6 mb-3">
            <div class="card">
              <div class="card-header">
                <div class="d-flex hstuck gap-2">
                  <h4>RAM - i3</h4>
                  <a href="tambah-ram.php" class="btn btn-primary ms-auto"><i class="bi bi-plus"></i> Tambah RAM</a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="ram" class="cell-border" width="100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Sub Kriteria</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = mysqli_query($koneksi, "SELECT * FROM ram ORDER BY bobot DESC");
                      $i = 1;
                      while ($baris = mysqli_fetch_array($query)) {
                      ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $baris['ram']; ?></td>
                        <td><?= $baris['bobot']; ?></td>
                        <td>
                          <a href="hapus-ram.php?id=<?= $baris['id_ram']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                          <a href="edit-ram.php?id=<?= $baris['id_ram']; ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
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
            </div>
          </div>
          <div class="col-lg-6 mb-3">
            <div class="card">
              <div class="card-header">
                <div class="d-flex hstuck gap-2">
                  <h4>VGA - i4</h4>
                  <a href="tambah-vga.php" class="btn btn-primary ms-auto"><i class="bi bi-plus"></i> Tambah VGA</a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="vga" class="cell-border" width="100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Sub Kriteria</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = mysqli_query($koneksi, "SELECT * FROM vga ORDER BY bobot DESC");
                      $i = 1;
                      while ($baris = mysqli_fetch_array($query)) {
                      ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $baris['vga']; ?></td>
                        <td><?= $baris['bobot']; ?></td>
                        <td>
                          <a href="hapus-vga.php?id=<?= $baris['id_vga']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                          <a href="edit-vga.php?id=<?= $baris['id_vga']; ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
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
            </div>
          </div>
          <div class="col-lg-6 mb-3">
            <div class="card">
              <div class="card-header">
                <div class="d-flex hstuck gap-2">
                  <h4>Penyimpanan - i5</h4>
                  <a href="tambah-penyimpanan.php" class="btn btn-primary ms-auto"><i class="bi bi-plus"></i> Tambah Penyimpanan</a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="penyimpanan" class="cell-border" width="100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Sub Kriteria</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = mysqli_query($koneksi, "SELECT * FROM penyimpanan ORDER BY bobot DESC");
                      $i = 1;
                      while ($baris = mysqli_fetch_array($query)) {
                      ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $baris['penyimpanan']; ?></td>
                        <td><?= $baris['bobot']; ?></td>
                        <td>
                          <a href="hapus-penyimpanan.php?id=<?= $baris['id_penyimpanan']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                          <a href="edit-penyimpanan.php?id=<?= $baris['id_penyimpanan']; ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
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
            </div>
          </div>
          <div class="col-lg-6 mb-3">
            <div class="card">
              <div class="card-header">
                <div class="d-flex hstuck gap-2">
                  <h4>Resolusi Layar - i6</h4>
                  <a href="tambah-resolusi.php" class="btn btn-primary ms-auto"><i class="bi bi-plus"></i> Tambah Resolusi Layar</a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="resolusi" class="cell-border" width="100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Sub Kriteria</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = mysqli_query($koneksi, "SELECT * FROM resolusi ORDER BY bobot DESC");
                      $i = 1;
                      while ($baris = mysqli_fetch_array($query)) {
                      ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $baris['resolusi']; ?></td>
                        <td><?= $baris['bobot']; ?></td>
                        <td>
                          <a href="hapus-resolusi.php?id=<?= $baris['id_resolusi']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                          <a href="edit-resolusi.php?id=<?= $baris['id_resolusi']; ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
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
            </div>
          </div>
          <div class="col-lg-6 mb-3">
            <div class="card">
              <div class="card-header">
                <div class="d-flex hstuck gap-2">
                  <h4>Jumlah Konektifitas - i7</h4>
                  <a href="tambah-konektifitas.php" class="btn btn-primary ms-auto"><i class="bi bi-plus"></i> Tambah Konektifitas</a>
                </div>
              </div>
          <div class="card-body">
                <div class="table-responsive">
                  <table id="konektifitas" class="cell-border" width="100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Sub Kriteria</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = mysqli_query($koneksi, "SELECT * FROM konektifitas ORDER BY bobot DESC");
                      $i = 1;
                      while ($baris = mysqli_fetch_array($query)) {
                      ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $baris['konektifitas']; ?></td>
                        <td><?= $baris['bobot']; ?></td>
                        <td>
                          <a href="hapus-konektifitas.php?id=<?= $baris['id_konektifitas']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                          <a href="edit-konektifitas.php?id=<?= $baris['id_konektifitas']; ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
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
              </div>
              </div>

            </div>
          </div>
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
        $('#harga').DataTable();
        $('#processor').DataTable();
        $('#ram').DataTable();
        $('#vga').DataTable();
        $('#penyimpanan').DataTable();
        $('#resolusi').DataTable();
        $('#konektifitas').DataTable();
    });
  </script>

</body>

</html>