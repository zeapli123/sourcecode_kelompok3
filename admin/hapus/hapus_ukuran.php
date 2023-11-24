<?php
$id_produk = $_GET['id_produk'];
$id_ukuran = $_GET['id_ukuran'];

$koneksi->query("DELETE FROM ukuran WHERE id_ukuran = '$id_ukuran'");

echo"<script>alert('data ukuran berhasil di hapus');</script>";
echo"<script>location='index.php?detail_produk&id_produk=$id_produk';</script>";
?>