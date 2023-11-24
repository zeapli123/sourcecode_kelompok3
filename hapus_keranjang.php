<?php
session_start();

$id_produk = $_GET['idproduk'];
unset($_SESSION["keranjang"][$id_produk]);
echo"<script>alert('Produk di hapus dari Keranjang');</script>";
echo"<script>location='keranjang.php';</script>";  
?>