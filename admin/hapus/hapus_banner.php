<?php
$id_banner = $_GET['id_banner'];

$ambil = $koneksi->query("SELECT * FROM banner WHERE id_banner='$id_banner'");
$foto = $ambil->fetch_assoc();

$namafoto = $foto['foto_banner'];

unlink("../assets/foto_banner/".$namafoto);

$koneksi->query("DELETE FROM banner WHERE id_banner = '$id_banner'");

echo"<script>alert('data banner berhasil di hapus');</script>";
echo"<script>location='index.php?banner';</script>";
?>