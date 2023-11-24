<?php
$id_produk = $_GET['id_produk'];
$id_warna = $_GET['id_warna'];

$koneksi->query("DELETE FROM warna WHERE id_warna = '$id_warna'");

echo"<script>alert('data Warna berhasil di hapus');</script>";
echo"<script>location='index.php?detail_produk&id_produk=$id_produk';</script>";
?>