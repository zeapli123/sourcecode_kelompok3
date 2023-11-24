<?php
include '../config/koneksi.php';
$id_pembelian = $_GET['id'];

$koneksi->query("DELETE FROM pembelian WHERE id_pembelian='$id_pembelian'");
$koneksi->query("DELETE FROM pembelian_produk WHERE id_pembelian='$id_pembelian'");
// hapus  foto yang ada di table pembayaran
$datafoto3 = array();
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
while($pecah = $ambil->fetch_assoc()){

    $datafoto3[] = $pecah;
}
foreach ($datafoto3 as $key => $value) {
    $hapusfoto = $value['bukti'];

    if(file_exists("../assets/foto_bukti/".$hapusfoto)){
        unlink("../assets/foto_bukti/".$hapusfoto);
    }

   
    $koneksi->query("DELETE FROM pembayaran WHERE id_pembelian='$id_pembelian'");
}

echo"<script>alert('daftar pembelian anda dihapus');</script>";
echo"<script>location='profil.php?pesanan'</script>"; 
exit;


?>