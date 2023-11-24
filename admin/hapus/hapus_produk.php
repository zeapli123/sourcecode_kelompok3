<?php
$id_produk = $_GET['id_produk'];

// hapus  foto yang ada di table produk
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$pecah = $ambil->fetch_assoc();

$hapus = $pecah ['foto_produk'];

if(file_exists("../assets/foto_produk/".$hapus)){
unlink("../assets/foto_produk/".$hapus);
}

$koneksi->query("DELETE FROM produk WHERE id_produk='$id_produk'");

// hapus  foto yang ada di table foto
$datafoto = array();
$ambil = $koneksi->query("SELECT * FROM foto WHERE id_produk='$id_produk'");
while($pecah = $ambil->fetch_assoc()){

    $datafoto[] = $pecah;
}
foreach ($datafoto as $key => $value) {
    $hapusfoto = $value['nama_foto'];

    if(file_exists("../assets/foto_produk/".$hapusfoto)){
        unlink("../assets/foto_produk/".$hapusfoto);
    }

    $koneksi->query("DELETE FROM foto WHERE id_produk='$id_produk'");

    $koneksi->query("DELETE FROM ukuran WHERE id_produk='$id_produk'");

    $koneksi->query("DELETE FROM warna WHERE id_produk='$id_produk'");
}

echo"<script>alert('data produk berhasil di hapus');</script>";
echo"<script>location='index.php?produk';</script>";

?>