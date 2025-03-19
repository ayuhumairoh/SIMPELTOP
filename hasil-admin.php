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

    <title>SPK MOORA - Hasil Akhir</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/datatables/datatables.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <style>
        .card-ranking {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card-ranking:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }

        .table-img {
            width: 80px;
            height: auto;
            object-fit: cover;
        }
    </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto">
        <a href="index.html">SPK MOORA</a><br>
        <span class="fs-6 text-white">Pemilihan Laptop Terbaik</span>
      </h1>


      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="kriteria-admin.php">Kriteria</a></li>
          <li><a class="nav-link scrollto" href="sub-kriteria.php">Sub Kriteria</a></li>
          <li><a class="nav-link scrollto" href="alternatif-admin.php">Merek Laptop</a></li>
          <li><a class="nav-link scrollto" href="perhitungan-admin.php">Perhitungan</a></li>
          <li><a class="nav-link scrollto active" href="hasil-admin.php">Hasil Akhir</a></li>
          <li><a class="getstarted scrollto" href="logout.php">Keluar</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <h2 class="text-center">Hasil Akhir Perhitungan MOORA</h2>
        </div>
    </section>

    <div class="d-flex justify-content-center align-items-center vh-30">
  <div class="alert alert-primary alert-dismissible fade show w-190 mt-3" role="alert">
    <strong>DATA PADA SPK INI DIPEROLEH PADA AGUSTUS 2024</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
    </div>
    
    <?php
    $results = [];
    $koneksi = mysqli_connect("localhost", "root", "", "db_spklaptop");
    if (!$koneksi) die("Koneksi gagal: " . mysqli_connect_error());

    $query = mysqli_query($koneksi, "SELECT * FROM alternatif");
    $alternatif = [];
    $sumSquares = ['harga' => 0, 'processor' => 0, 'ram' => 0, 'vga' => 0, 'penyimpanan' => 0, 'resolusi' => 0, 'konektifitas' => 0];

    if ($query && mysqli_num_rows($query) > 0) {
        while ($baris = mysqli_fetch_assoc($query)) {
            foreach ($sumSquares as $key => $value) {
                $sumSquares[$key] += pow($baris[$key], 2);
            }
            $alternatif[] = $baris;
        }

        foreach ($alternatif as $baris) {
            $harga = round($baris['harga'] / sqrt($sumSquares['harga']) * 0.35, 9);
            $processor = round($baris['processor'] / sqrt($sumSquares['processor']) * 0.15, 9);
            $ram = round($baris['ram'] / sqrt($sumSquares['ram']) * 0.15, 9);
            $vga = round($baris['vga'] / sqrt($sumSquares['vga']) * 0.1, 9);
            $penyimpanan = round($baris['penyimpanan'] / sqrt($sumSquares['penyimpanan']) * 0.1, 9);
            $resolusi = round($baris['resolusi'] / sqrt($sumSquares['resolusi']) * 0.1, 9);
            $konektifitas = round($baris['konektifitas'] / sqrt($sumSquares['konektifitas']) * 0.05, 9);

            $yi = ($processor + $ram + $vga + $penyimpanan + $resolusi + $konektifitas) - $harga;

            $results[] = [
                'kode_alternatif' => $baris['kode_alternatif'],
                'nama_alternatif' => $baris['nama_alternatif'],
                'yi' => $yi,
                'foto' => $baris['foto'],
                'harga_unit' => $baris['harga_unit'],  // Menambahkan harga_unit tanpa perhitungan
                'processor_unit' => $baris['processor_unit'],
                'ram_unit' => $baris['ram_unit'],
                'vga_unit' => $baris['vga_unit'],
                'penyimpanan_unit' => $baris['penyimpanan_unit'],
                'resolusi_unit' => $baris['resolusi_unit'],
                'konektifitas_unit' => $baris['konektifitas_unit']
            ];
        }

        usort($results, function ($a, $b) {
            return $b['yi'] <=> $a['yi'];
        });
    }
    ?>

<div class="container">
        <div class="row">
            <?php foreach (array_slice($results, 0, 3) as $index => $result): ?>
                <div class="col-md-4">
                    <div class="card card-ranking text-center mb-4">
                        <img src="uploads/<?= htmlspecialchars($result['foto']) ?>" class="card-img-top" alt="<?= htmlspecialchars($result['nama_alternatif']) ?>" style="height: 210px; object-fit: cover;">
                        <div class="card-body">
                        <strong><h5 class="card-title">Peringkat <?= $index + 1 ?></h5></strong>
                            <p class="mb-1"><strong><?= htmlspecialchars($result['nama_alternatif']) ?></strong></p>
                            <p class="text-muted"><b> Dengan Nilai Yi: <?= round($result['yi'], 5) ?></b></p>
                            <p><strong><h7> Yang memiliki keunggulan </h7></strong></p>
                            <p class="text-muted">Processor : <?= htmlspecialchars($result['processor_unit']) ?></p>
                            <p class="text-muted">RAM : <?= htmlspecialchars($result['ram_unit']) ?></p>
                            <p class="text-muted">VGA : <?= htmlspecialchars($result['vga_unit']) ?></p>
                            <p class="text-muted">Penyimpanan : <?= htmlspecialchars($result['penyimpanan_unit']) ?></p>
                            <p class="text-muted">Resolusi : <?= htmlspecialchars($result['resolusi_unit']) ?></p>
                            <p class="text-muted">Jumlah Port : <?= htmlspecialchars($result['konektifitas_unit']) ?></p>
                            <h10>_________________________</h10>
                            <p class="text-muted">Harga Produk: <b><?= htmlspecialchars($result['harga_unit']) ?></b></p> <!-- Menampilkan harga unit tanpa perhitungan -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="card">
  <div class="card-body card text-white text-center bg-primary mb-3">
  <blockquote class="blockquote mb-0">
      <p><strong>Peringkat teratas diambil berdasarkan perhitungan MOORA dengan nilai Yi (Maksimum - Minimum) tertinggi</strong></p>
    </blockquote>
  </div>
</div>

        <div class="table-responsive">
            <table id="hasil" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Kode Alternatif</th>
                        <th>Nama Alternatif</th>
                        <th>Nilai Yi</th>
                        <th>Foto</th>
                        <th>Harga Unit</th> <!-- Kolom untuk harga unit -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_slice($results, 3) as $index => $result): ?>
                        <tr>
                            <td class=text-center><?= $index + 4 ?></td>
                            <td class=text-center><?= htmlspecialchars($result['kode_alternatif']) ?></td>
                            <td><?= htmlspecialchars($result['nama_alternatif']) ?></td>
                            <td><?= round($result['yi'], 5) ?></td>
                            <td>
                                <img src="uploads/<?= htmlspecialchars($result['foto']) ?>" class="table-img" alt="<?= htmlspecialchars($result['nama_alternatif']) ?>">
                            </td>
                            <td><?= htmlspecialchars($result['harga_unit']) ?></td> <!-- Menampilkan harga unit -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>


<footer id="footer">
    <div class="container text-center">
        <p>&copy; Informatika <strong>Universitas Mulawarman</strong> - Skripsi <a href="#">Ayu Humairoh</a></p>
    </div>
</footer>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/datatables/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#hasil').DataTable();
    });
</script>
</body>
</html>
