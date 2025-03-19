<?php
session_start();
include 'koneksi.php';
if (isset($_SESSION['admin-session'])) {
    echo "
    <script>
        document.location.href = 'index.php'
    </script>
    ";
}
?>
<!DOCTYPE html>
<html lang="en">
<style>
        body {
            padding-top: 50px;
            background-color: #f8f9fa;
        }
        .table img {
            max-width: 120px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .btn-submit {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        .card-laptop img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .card-ranking {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            border: 10px solid #007bff;
        }
        .card-ranking:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }
        .card-img-top {
            transition: transform 0.3s ease;
        }
        .card-ranking:hover .card-img-top {
            transform: scale(1.1);
        }
        .row {
            justify-content: center;
        }
        @media (max-width: 768px) {
            .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SPK MOORA - Hasil Akhir</title>
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
                <li><a class="nav-link scrollto" href="alternatif.php">Merek Laptop</a></li>
                <li><a class="nav-link scrollto" href="perhitungan.php">Perhitungan</a></li>
                <li><a class="nav-link scrollto" href="hasil.php">Hasil Akhir</a></li>
                <li><a class="nav-link scrollto active" href="rekomendasi.php">Rekomendasi</a></li>
                <li><a class="getstarted scrollto" href="login.php">Masuk</a></li>
            </ul>
        </nav>
    </div>
</header>

<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <h2 class="text-center">Hasil Akhir Perhitungan MOORA</h2>
            <h2 class="text-center">Pilih 5 laptop yang ingin dibandingkan</h2>
        </div>
    </section>

    <div class="container">
        <form method="POST">
            <table class="table table-hover table-bordered bg-white">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Pilih</th>
                        <th>Gambar</th>
                        <th>Nama Unit</th>
                        <th>Harga</th>
                        <th>Processor</th>
                        <th>RAM</th>
                        <th>VGA</th>
                        <th>Penyimpanan</th>
                        <th>Resolusi</th>
                        <th>Konektivitas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM alternatif");
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<tr>
                                <td class='text-center'><input type='checkbox' name='laptop[]' value='{$row['kode_alternatif']}'></td>
                                <td><img src='uploads/{$row['foto']}' alt='{$row['nama_alternatif']}'></td>
                                <td>{$row['nama_alternatif']}</td>
                                <td>{$row['harga_unit']}</td>
                                <td>{$row['processor_unit']}</td>
                                <td>{$row['ram_unit']}</td>
                                <td>{$row['vga_unit']}</td>
                                <td>{$row['penyimpanan_unit']}</td>
                                <td>{$row['resolusi_unit']}</td>
                                <td>{$row['konektifitas_unit']}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary btn-lg mb-5">Submit</button>
            </div>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['laptop'])) {
        $selectedLaptops = $_POST['laptop'];
        if (count($selectedLaptops) == 5) {
            $laptopIds = implode("','", $selectedLaptops);
            $resultQuery = mysqli_query($koneksi, "SELECT * FROM alternatif WHERE kode_alternatif IN ('$laptopIds') ORDER BY yi DESC");
            $results = [];
            while ($row = mysqli_fetch_assoc($resultQuery)) {
                $results[] = $row;
            }
            ?>
            <div class="row">
                <?php foreach (array_slice($results, 0, 5) as $index => $result): ?>
                    <div class="col-md-4">
                        <div class="card card-ranking text-center mb-4">
                            <img src="uploads/<?= htmlspecialchars($result['foto']) ?>" class="card-img-top" alt="<?= htmlspecialchars($result['nama_alternatif']) ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <strong><h5 class="card-title">Peringkat <?= $index + 1 ?></h5></strong>
                                <p class="mb-1"><strong><?= htmlspecialchars($result['nama_alternatif']) ?></strong></p>
                                <p class="text-muted">Nilai Yi: <?= round($result['yi'], 5) ?></p>
                                <p class="text-muted">Harga: <b><?= htmlspecialchars($result['harga_unit']) ?></b></p>
                                <p class="text-muted">Processor : <?= htmlspecialchars($result['processor_unit']) ?></p>
                                <p class="text-muted">RAM : <?= htmlspecialchars($result['ram_unit']) ?></p>
                                <p class="text-muted">VGA : <?= htmlspecialchars($result['vga_unit']) ?></p>
                                <p class="text-muted">Penyimpanan : <?= htmlspecialchars($result['penyimpanan_unit']) ?></p>
                                <p class="text-muted">Resolusi : <?= htmlspecialchars($result['resolusi_unit']) ?></p>
                                <p class="text-muted">Jumlah Port : <?= htmlspecialchars($result['konektifitas_unit']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        } else {
            echo "<script>alert('Pilih tepat 5 laptop!');</script>";
        }
    }
    ?>
</main>

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

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="assets/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#hasil').DataTable();
    });
</script>
</body>
</html>
