<?php
session_start();
include 'koneksi.php';
if (isset($_SESSION['admin-session'])) { 
    echo "<script>document.location.href = 'index.php'</script>";
    exit;
}

if (!isset($_GET['kode'])) {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='rekomendasi.php';</script>";
    exit;
}

$kode = mysqli_real_escape_string($koneksi, $_GET['kode']);
$query = mysqli_query($koneksi, "SELECT * FROM alternatif WHERE kode_alternatif = '$kode'");

$laptop = mysqli_fetch_assoc($query);

if (!$laptop) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='rekomendasi.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Detail Laptop - <?= htmlspecialchars($laptop['nama_alternatif']) ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
</head>

<body>
<header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto">
            <a href="index.html">SPK MOORA</a><br>
            <span class="fs-6 text-white">Pemilihan Laptop Terbaik</span>
        </h1>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="index.php">Beranda</a></li>
                <li><a class="nav-link scrollto active" href="rekomendasi.php">Rekomendasi</a></li>
            </ul>
        </nav>
    </div>
</header>

<main id="main" class="container mt-5">
    <div class="card">
        <div class="card-body text-center mt-5">
            <img src="uploads/<?= htmlspecialchars($laptop['foto']) ?>" class="img-fluid mb-3" style="max-width: 300px;">
            <h3><?= htmlspecialchars($laptop['nama_alternatif']) ?> (<?= htmlspecialchars($laptop['kode_alternatif']) ?>)</h3>
            <p><strong>Harga:</strong> <?= htmlspecialchars($laptop['harga_unit']) ?></p>
            <p><strong>Processor:</strong> <?= htmlspecialchars($laptop['processor_unit']) ?></p>
            <p><strong>RAM:</strong> <?= htmlspecialchars($laptop['ram_unit']) ?></p>
            <p><strong>VGA:</strong> <?= htmlspecialchars($laptop['vga_unit']) ?></p>
            <p><strong>Penyimpanan:</strong> <?= htmlspecialchars($laptop['penyimpanan_unit']) ?></p>
            <p><strong>Resolusi:</strong> <?= htmlspecialchars($laptop['resolusi_unit']) ?></p>
            <p><strong>Konektivitas:</strong> <?= htmlspecialchars($laptop['konektifitas_unit']) ?></p>
            <a href="rekomendasi.php" class="btn btn-primary">Kembali ke Halaman Rekomendasi</a>
        </div>
    </div>
</main>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
<footer id="footer">
    <div class="container footer-bottom clearfix">
        <div class="copyright">
            &copy; Informatika <strong><span>Universitas Mulawarman</span></strong>
        </div>
        <div class="credits">
            Skripsi <a href="#">Ayu Humairoh</a>
        </div>
    </div>
</footer>
</html>
