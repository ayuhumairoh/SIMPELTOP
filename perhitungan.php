<?php
session_start();
include 'koneksi.php';
if (isset($_SESSION['admin-session'])) {
  echo "
  <script>
    document.location.href = 'kriteria.php'
  </script>
  ";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SPK MOORA - Perhitungan</title>
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
          <li><a class="nav-link scrollto" href="index.php">Beranda</a></li>
          <li><a class="nav-link scrollto" href="alternatif.php">Data Laptop</a></li>
          <li><a class="nav-link scrollto active" href="perhitungan.php">Perhitungan</a></li>
          <li><a class="nav-link scrollto" href="hasil.php">Hasil Akhir</a></li>
          <li><a class="nav-link scrollto" href="rekomendasi.php">Rekomendasi</a></li>
          <li><a class="getstarted scrollto" href="login.php">Masuk</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">
    
    <h2>Perhitungan</h2>

  </div>
</section><!-- End Breadcrumbs -->

<section class="inner-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <div class="table-responsive">
                    <table id="alternatif" class="cell-border" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Merek Laptop</th>
                                <th>Harga</th>
                                <th>Processor</th>
                                <th>RAM</th>
                                <th>VGA</th>
                                <th>Penyimpanan</th>
                                <th>Resolusi Layar</th>
                                <th>Konektifitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM alternatif");
                            $i = 1;
                            while ($baris = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $baris['kode_alternatif']; ?></td>
                                <td><?= $baris['nama_alternatif']; ?></td>
                                <td><?= $baris['harga']; ?></td>
                                <td><?= $baris['processor']; ?></td>
                                <td><?= $baris['ram']; ?></td>
                                <td><?= $baris['vga']; ?></td>
                                <td><?= $baris['penyimpanan'] ?></td>
                                <td><?= $baris['resolusi'] ?></td>
                                <td><?= $baris['konektifitas'] ?></td>
                            </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Normalisasi Matriks Keputusan -->
            <div class="col-lg-12 mb-3">
                <h2 class="my-4">Normalisasi Matriks Keputusan</h2>
                <div class="table-responsive">
                    <table id="keputusan" class="cell-border" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Merek Laptop</th>
                                <th>Harga</th>
                                <th>Processor</th>
                                <th>RAM</th>
                                <th>VGA</th>
                                <th>Penyimpanan</th>
                                <th>Resolusi Layar</th>
                                <th>Konektifitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM alternatif");
                            $sumSquares = [
                                'harga' => 0,
                                'processor' => 0,
                                'ram' => 0,
                                'vga' => 0,
                                'penyimpanan' => 0,
                                'resolusi' => 0,
                                'konektifitas' => 0
                            ];

                            // Langkah 1: Hitung total kuadrat
                            while ($baris = mysqli_fetch_array($query)) {
                                $sumSquares['harga'] += pow($baris['harga'], 2);
                                $sumSquares['processor'] += pow($baris['processor'], 2);
                                $sumSquares['ram'] += pow($baris['ram'], 2);
                                $sumSquares['vga'] += pow($baris['vga'], 2);
                                $sumSquares['penyimpanan'] += pow($baris['penyimpanan'], 2);
                                $sumSquares['resolusi'] += pow($baris['resolusi'], 2);
                                $sumSquares['konektifitas'] += pow($baris['konektifitas'], 2);
                            }

                            // Langkah 2: Normalisasi Matriks
                            $query = mysqli_query($koneksi, "SELECT * FROM alternatif");
                            $i = 1;
                            while ($baris = mysqli_fetch_array($query)) {
                                $harga = round($baris['harga'] / sqrt($sumSquares['harga']), 5);
                                $processor = round($baris['processor'] / sqrt($sumSquares['processor']), 5);
                                $ram = round($baris['ram'] / sqrt($sumSquares['ram']), 5);
                                $vga = round($baris['vga'] / sqrt($sumSquares['vga']), 5);
                                $penyimpanan = round($baris['penyimpanan'] / sqrt($sumSquares['penyimpanan']), 5);
                                $resolusi = round($baris['resolusi'] / sqrt($sumSquares['resolusi']), 5);
                                $konektifitas = round($baris['konektifitas'] / sqrt($sumSquares['konektifitas']), 5);
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $baris['kode_alternatif']; ?></td>
                                <td><?= $baris['nama_alternatif']; ?></td>
                                <td><?= $harga; ?></td>
                                <td><?= $processor; ?></td>
                                <td><?= $ram; ?></td>
                                <td><?= $vga; ?></td>
                                <td><?= $penyimpanan; ?></td>
                                <td><?= $resolusi; ?></td>
                                <td><?= $konektifitas; ?></td>
                            </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Nilai Preferensi -->
            <div class="col-lg-12 mb-3">
                <h2 class="my-4">Nilai Preferensi (Yi)</h2>
                <div class="table-responsive">
                    <table id="hasil" class="cell-border" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Merek Laptop</th>
                                <th>Nilai Yi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM alternatif");
                            $i = 1;
                            while ($baris = mysqli_fetch_array($query)) {
                                // Menghitung nilai preferensi Yi
                                $harga = round($baris['harga'] / sqrt($sumSquares['harga']) * 0.35, 9);
                                $processor = round($baris['processor'] / sqrt($sumSquares['processor']) * 0.15, 9);
                                $ram = round($baris['ram'] / sqrt($sumSquares['ram']) * 0.15, 9);
                                $vga = round($baris['vga'] / sqrt($sumSquares['vga']) * 0.1, 9);
                                $penyimpanan = round($baris['penyimpanan'] / sqrt($sumSquares['penyimpanan']) * 0.1, 9);
                                $resolusi = round($baris['resolusi'] / sqrt($sumSquares['resolusi']) * 0.1, 9);
                                $konektifitas = round($baris['konektifitas'] / sqrt($sumSquares['konektifitas']) * 0.05, 9);

                                $yi = ($processor + $ram + $vga + $penyimpanan + $resolusi + $konektifitas) - ($harga);
                                
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $baris['kode_alternatif']; ?></td>
                                <td><?= $baris['nama_alternatif']; ?></td>
                                <td><?= $yi; ?></td>
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
        $('#keputusan').DataTable();
        $('#terbobot').DataTable();
        $('#hasil').DataTable();
    });
  </script>

</body>

</html>