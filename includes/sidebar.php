<?php
// koneksi 
include 'config/koneksi.php';

// data kategori
$data_kategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($pecah = $ambil->fetch_assoc()) {

    $data_kategori[] = $pecah;
}

// data kategori produk
$data_kategori_produk = array();
$ambil = $koneksi->query("SELECT * FROM kategori_produk");
while ($pecah = $ambil->fetch_assoc()) {
    $data_kategori_produk[] = $pecah;
}
?>


<div class="card kategori">
    <div class="card-header">
        <h4>Kategori Produk</h4>
    </div>
    <nav class="nav flex-column nav-menu">

    <?php foreach ($data_kategori as $key => $value): ?>
        <a href="produk.php?id_kategori=<?php echo $value['id_kategori']; ?>" class="nav-link"><?php echo $value['nama_kategori']; ?></a>
        <?php endforeach?>
     
    </nav>
</div>


<div class="card kategori">
    <div class="card-header">
        <h4>Kategori</h4>
    </div>
    <nav class="nav flex-column nav-menu">

    <?php foreach ($data_kategori_produk as $key => $value): ?>
        <a href="produk.php?id_kategori_produk=<?php echo $value['id_kategori_produk']; ?>" class="nav-link"><?php echo $value['nama_kategori_produk']; ?></a>
        <?php endforeach?>
        
    </nav>
</div>

