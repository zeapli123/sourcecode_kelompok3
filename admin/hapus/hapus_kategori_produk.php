<?php
$id_kategori_produk = $_GET["id"];
$koneksi->query("DELETE FROM kategori_produk WHERE id_kategori_produk='$id_kategori_produk'");

echo"<script>alert('data Kategori Produk berhasil di Hapus');</script>";
echo"<script>location='index.php?kategori_produk';</script>";
?>