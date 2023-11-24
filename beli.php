<?php
session_start();
include 'config/koneksi.php';
$id_produk = $_GET['idproduk'];

$ambil = $koneksi->query("SELECT * FROM produk  WHERE produk.id_produk='$id_produk'");
$pecah = $ambil->fetch_assoc();
if(!empty($pecah['stok_produk']==0)){

   echo"<script>alert('Stok Habis Terjual');</script>";
echo"<script>location='produk.php';</script>";  

}  

elseif(isset($_SESSION['keranjang'][$id_produk]) ){
    $_SESSION['keranjang'][$id_produk]+=1;

    
}
else{
    $_SESSION['keranjang'][$id_produk]=1;
}



echo"<script>alert('Produk telah masuk ke keranjang belanja');</script>";
echo"<script>location='keranjang.php';</script>";  

// echo "<pre>";
// print_r($_SESSION['keranjang']);
// echo"</pre>";

?>
