<?php
$id_pelanggan = $_GET["id"];
$koneksi->query("DELETE FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
echo"<script>alert('data Pelanggan berhasil di Hapus');</script>";
echo"<script>location='index.php?pelanggan';</script>";
exit;
?>