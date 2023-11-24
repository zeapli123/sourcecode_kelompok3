<?php
$id_pembelian = $_GET['id'];

$koneksi->query("DELETE FROM pembelian WHERE id_pembelian='$id_pembelian'");
$koneksi->query("DELETE FROM pembelian_produk WHERE id_pembelian='$id_pembelian'");

// hapus  foto yang ada di table pembayaran
$datafoto1 = array();
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
while($pecah = $ambil->fetch_assoc()){

    $datafoto1[] = $pecah;
}
foreach ($datafoto1 as $key => $value) {
    $hapusfoto = $value['bukti'];

    if(file_exists("../assets/foto_bukti/".$hapusfoto)){
        unlink("../assets/foto_bukti/".$hapusfoto);
    }

   
    $koneksi->query("DELETE FROM pembayaran WHERE id_pembelian='$id_pembelian'");
}

echo"<script>alert('Data Pembelian Telah Dihapus');</script>";
echo"<script>location='index.php?pembelian';</script>";
exit;
?>