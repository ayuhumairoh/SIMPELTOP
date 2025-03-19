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

$query = mysqli_query($koneksi, "DELETE FROM harga WHERE id_harga = '$id'");
if ($query) {
  echo "
  <script>
    document.location.href = 'sub-kriteria.php';
  </script>
  ";
} else {
  echo "
  <script>
    document.location.href = 'sub-kriteria.php';
  </script>
  ";
}
?>