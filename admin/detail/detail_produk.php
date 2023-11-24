<h1 class="h3 mb-4 text-gray-800">Detail Data Produk</h1>
<?php
$id_produk = $_GET["id_produk"];

// data warna produk
$data_warna = array();
$ambil = $koneksi->query("SELECT * FROM warna WHERE id_produk='$id_produk'");
while ($warna = $ambil->fetch_assoc()) {
$data_warna[] = $warna;
}

// data ukuran produk
$data_ukuran = array();
$ambil = $koneksi->query("SELECT * FROM ukuran WHERE id_produk='$id_produk'");
while ($ukuran = $ambil->fetch_assoc()) {
$data_ukuran[] = $ukuran;
}

// data foto produk
$data_foto = array();
$ambil = $koneksi->query("SELECT * FROM foto WHERE id_produk='$id_produk'");
while ($foto = $ambil->fetch_assoc()) {
$data_foto[] = $foto;
}

// data produk
$ambil = $koneksi->query("SELECT * FROM produk 
    JOIN kategori ON produk.id_kategori=kategori.id_kategori
    JOIN kategori_produk ON produk.id_kategori_produk=kategori_produk.id_kategori_produk
    WHERE id_produk='$id_produk'");

$produk = $ambil->fetch_assoc();    


// memasang id_warna produk
$ambil = $koneksi->query("SELECT * FROM warna WHERE id_produk='$id_produk'");
$warna = $ambil->fetch_assoc();

// memasang id_ukuran produk
$ambil = $koneksi->query("SELECT * FROM ukuran WHERE id_produk='$id_produk'");
$ukuran = $ambil->fetch_assoc();


// memasang id_foto produk
$ambil = $koneksi->query("SELECT * FROM foto WHERE id_produk='$id_produk'");
$foto = $ambil->fetch_assoc();

// echo"<pre>";
// print_r($produk);
// echo"</pre>";
?>
<form method="post" enctype="multipart/form-data">
<div class="card shadow">
    <div class="card-body">

    <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kategori :</label>
        <div class="col-sm-9">
           <input type="text" class="form-control" value="<?php echo $produk['nama_kategori']; ?>" readonly>
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kategori Produk :</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $produk['nama_kategori_produk']; ?>" readonly>
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Produk :</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $produk['nama_produk']; ?>" readonly>
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">harga Produk :</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $produk['harga_produk']; ?>" readonly>
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Berat Produk :</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $produk['berat_produk']; ?>" readonly>
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Deskripsi Produk :</label>
        <div class="col-sm-9">
            <textarea name="deskripsi_produk" class="form-control" readonly><?php echo $produk['deskripsi_produk']; ?></textarea >
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Stok Produk :</label>
        <div class="col-sm-9">
            <input type="number" name="stok_produk" class="form-control" value="<?php echo $produk['stok_produk']; ?>" readonly>
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Diskon Produk :</label>
        <div class="col-sm-9">
            <input type="number" name="diskon_produk" class="form-control" value="<?php echo $produk['diskon_produk']; ?>" readonly>
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Harga Diskon :</label>
        <div class="col-sm-9">
            <input type="number" name="harga_diskon" class="form-control" value="<?php echo $produk['harga_diskon']; ?>" readonly>
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Warna Produk :</label>
        <div class="col-sm-9">
            <div class="row">
            <?php foreach ($data_warna as $key => $value): ?>
                <div class="col">
                <input type="text" name="warna_produk" class="form-control" value="<?php echo $value['nama_warna']; ?>" readonly>
                </div>
                <?php endforeach ?>
            </div>
        </div> 
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Ukuran Produk :</label>
            <div class="col-sm-9">
                <div class="row">
                    <?php foreach ($data_ukuran as $key => $value): ?>
                    <div class="col">
                    <input type="text" name="ukuran_produk" class="form-control" value="<?php echo $value['nama_ukuran']; ?>" readonly>
                    </div>
                    <?php endforeach ?>

                </div>
        </div> 
        </div>

        <div class="form-group row ">
            <label class="col-sm-3 col-form-label">Foto Produk :</label>
        <div class="col-sm-9">
        <div class="row ">
                    <?php foreach ($data_foto as $key => $value): ?>
                    <div class="col">
                    <img src="../assets/foto_produk/<?php echo $value['nama_foto']; ?>" class="img-responsive mt-3" width="150" >
                    </div>
                    <?php endforeach ?>

                </div>
        </div> 
        </div>

    </div>
    <div class="card-footer py-3">
        <div class="row">
            <div class="col">
                <a href="index.php?produk" class="btn btn-sm btn-danger">
                    <i class="fas fa-chevron-left"></i> Kembali
                </a>
            </div>
            <div class="col text-right">
                <a href="index.php?edit_produk&id_produk=<?php echo $produk['id_produk']; ?>&id_warna=<?php echo $warna['id_warna']; ?>&id_ukuran=<?php echo $ukuran['id_ukuran']; ?>&id_foto=<?php echo $foto['id_foto']; ?>" class="btn btn-sm btn-primary">
                    Edit Produk <i class="fas fa-chevron-right"></i> 
                </a>
            </div>
        </div>
    </div>
</div>
</form>