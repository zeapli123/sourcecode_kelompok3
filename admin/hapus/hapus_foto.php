<?php
$id_produk = $_GET['id_produk'];
$id_foto = $_GET['id_foto'];

$ambil = $koneksi->query("SELECT * FROM foto WHERE id_foto='$id_foto'");
$foto = $ambil->fetch_assoc();

$namafoto = $foto['nama_foto'];

unlink("../assets/foto_produk/".$namafoto);

$koneksi->query("DELETE FROM foto WHERE id_foto = '$id_foto'");

echo"<script>alert('data Foto berhasil di hapus');</script>";
echo"<script>location='index.php?detail_produk&id_produk=$id_produk';</script>";
?>