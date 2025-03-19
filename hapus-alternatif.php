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

if (!isset($_GET['id'])) {
  echo "
  <script>
    document.location.href = '404.php'
  </script>
  ";
}
$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM alternatif WHERE id_alternatif = '$id'");
if ($query) {
  echo "
  <script>
    document.location.href = 'alternatif.php';
  </script>
  ";
} else {
  echo "
  <script>
    document.location.href = 'alternatif.php';
  </script>
  ";
}
?>