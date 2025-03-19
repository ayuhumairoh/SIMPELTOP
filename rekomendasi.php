<!-- Pastikan Bootstrap dan jQuery sudah di-load -->
<?php
session_start();
include 'koneksi.php';
if (isset($_SESSION['admin-session'])) {
    echo "<script>document.location.href = 'index.php'</script>";
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
        .title-blue {
        padding-top: 10px;
        color: blue; 
        color:rgb(31, 84, 141); 
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

    <title>SPK MOORA - Rekomendasi</title>
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

<div class="container mt-5">
            <h2 class="text-center fw-bold title-blue">HALAMAN REKOMENDASI</h2>
            <h3 class="text-center title-blue">Pilih minimal 3 laptop yang ingin dibandingkan</h3>
        </div>
    </section>
    <div class="container">
        <form method="POST">
            <table class="table table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Pilih</th>
                        <th>Gambar</th>
                        <th>Nama</th>
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
                                <td><img src='uploads/{$row['foto']}' style='width:100px;'></td>
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
                <button type="submit" class="btn btn-primary mb-5">Bandingkan</button>
            </div>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['laptop'])) {
        $selectedLaptops = $_POST['laptop'];
        if (count($selectedLaptops) >= 3) {
            $laptopIds = implode("','", $selectedLaptops);
            $resultQuery = mysqli_query($koneksi, "SELECT * FROM alternatif WHERE kode_alternatif IN ('$laptopIds') ORDER BY yi DESC");
            $results = [];
            while ($row = mysqli_fetch_assoc($resultQuery)) {
                $results[] = $row;
            }
            ?>
            <!-- Modal -->
            <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl"> <!-- Gunakan modal-xl untuk membuatnya lebih lebar -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title w-100 text-center fw-bold">Hasil Peringkat</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <?php foreach ($results as $index => $result): ?>
                                    <div class="col-md-4">
                                        <div class="card text-center mb-4">
                                            <img src="uploads/<?= htmlspecialchars($result['foto']) ?>" class="card-img-top" style="height: 210px; object-fit: cover;">
                                            <div class="card-body">
                                                <h5 class="card-title">Peringkat <?= $index + 1 ?></h5>
                                                <p class="mb-0"><strong><?= htmlspecialchars($result['nama_alternatif']) ?></strong></p>
                                                <p class="text-muted mt-0">Harga: <b><?= htmlspecialchars($result['harga_unit']) ?></b></p>
                                                <a href="detail.php?kode=<?= $result['kode_alternatif'] ?>" class="btn btn-info">Detail Laptop</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('#resultModal').modal('show');
                });
            </script>
            <?php
        } else {
            echo "<script>alert('Pilih Minimal 3 laptop!');</script>";
        }
    }
    ?>
</body>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="assets/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
    console.log("Dokumen siap! Mencoba menampilkan modal...");
    $('#resultModal').modal('show');
});
</script>
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
