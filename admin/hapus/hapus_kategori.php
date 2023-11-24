<?php
$id_kategori = $_GET['id_kategori'];
$koneksi->query("DELETE FROM kategori WHERE id_kategori = '$id_kategori'");

echo"<script>alert('data kategori berhasil di hapus');</script>";
echo"<script>location='index.php?kategori';</script>";
?>