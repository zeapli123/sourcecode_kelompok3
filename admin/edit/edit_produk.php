<h1 class="h3 mb-4 text-gray-800">Edit Data Produk</h1>
<?php
$id_produk = $_GET['id_produk'];
$id_ukuran = $_GET['id_ukuran'];
$id_warna = $_GET['id_warna'];
$id_foto = $_GET['id_foto'];

// data kategori
$data_kategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($pecah = $ambil->fetch_assoc()) {
    $data_kategori[] = $pecah;
}

// data kategori_produk
$data_kategori_produk = array();
$ambil = $koneksi->query("SELECT * FROM kategori_produk");
while ($pecah = $ambil->fetch_assoc()) {
    $data_kategori_produk[] = $pecah;
}

// data ukuran
$data_ukuran = array();
$ambil = $koneksi->query("SELECT * FROM ukuran WHERE id_produk='$id_produk'");
while ($pecah = $ambil->fetch_assoc()) {
    $data_ukuran[] = $pecah;
}

// data warna
$data_warna = array();
$ambil = $koneksi->query("SELECT * FROM warna WHERE id_produk='$id_produk'");
while ($pecah = $ambil->fetch_assoc()) {
    $data_warna[] = $pecah;
}


// data foto
$data_foto = array();
$ambil = $koneksi->query("SELECT * FROM foto WHERE id_produk='$id_produk'");
while ($pecah = $ambil->fetch_assoc()) {
    $data_foto[] = $pecah;
}


//data produk
$ambil = $koneksi->query("SELECT * FROM produk
JOIN kategori ON produk.id_kategori=kategori.id_kategori
JOIN kategori_produk ON produk.id_kategori_produk=kategori_produk.id_kategori_produk
WHERE id_produk='$id_produk'");
$produk = $ambil->fetch_assoc();


// echo "<pre>";
// print_r($produk);
// echo "</pre>";

?>
<form method="post" enctype="multipart/form-data">
    <div class="card shadow">
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kategori :</label>
                <div class="col-sm-9">
                    <select name="id_kategori" class="form-control">
                        <option value="<?php echo $produk['id_kategori']; ?>">
                            <?php echo $produk['nama_kategori']; ?>
                        </option>

                        <?php foreach ($data_kategori as $key => $value): ?>
                            <option value="<?php echo $value['id_kategori']; ?>">
                                <?php echo $value['nama_kategori']; ?>
                            </option>
                        <?php endforeach ?>

                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kategori Produk :</label>
                <div class="col-sm-9">
                    <select name="id_kategori_produk" class="form-control">
                        <option value="<?php echo $produk['id_kategori_produk']; ?>">
                            <?php echo $produk['nama_kategori_produk']; ?>
                        </option>

                        <?php foreach ($data_kategori_produk as $key => $value): ?>
                            <option value="<?php echo $value['id_kategori_produk']; ?>">
                                <?php echo $value['nama_kategori_produk']; ?>
                            </option>
                        <?php endforeach ?>

                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Produk :</label>
                <div class="col-sm-9">
                    <input type="text" name="nama_produk" class="form-control" value="<?php echo $produk['nama_produk']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">harga Produk :</label>
                <div class="col-sm-9">
                    <input type="number" name="harga_produk" class="form-control" value="<?php echo $produk['harga_produk']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Berat Produk :</label>
                <div class="col-sm-9">
                    <input type="number" name="berat_produk" class="form-control" value="<?php echo $produk['berat_produk']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Warna Produk :</label>
                <div class="col-sm-9">
                    <input type="text" name="warna_produk" class="form-control" value="<?php echo $produk['warna_produk']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Ukuran Produk :</label>
                <div class="col-sm-9">
                    <input type="text" name="ukuran_produk" class="form-control" value="<?php echo $produk['ukuran_produk']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Deskripsi Produk :</label>
                <div class="col-sm-9">
                    <textarea name="deskripsi_produk" class="form-control"><?php echo $produk['deskripsi_produk']; ?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Stok Produk :</label>
                <div class="col-sm-9">
                    <input type="number" name="stok_produk" class="form-control" value="<?php echo $produk['stok_produk']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Diskon Produk :</label>
                <div class="col-sm-9">
                    <input type="number" name="diskon_produk" class="form-control" value="<?php echo $produk['diskon_produk']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Harga Diskon :</label>
                <div class="col-sm-9">
                    <input type="number" name="harga_diskon" class="form-control" value="<?php echo $produk['harga_diskon']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Foto Produk :</label>
                <div class="col-sm-9">
                    <img src="../assets/foto_produk/<?php echo $produk['foto_produk']; ?>" class="img-responsive mb-3" width="150">
                    <input type="file" name="foto" class="form-control">
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
                    <button name="simpan" class="btn btn-sm btn-primary">
                        Simpan <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mt-3">
        <div class="card-header">
            <a href="index.php?tambah_ukuran&id_produk=<?php echo $produk['id_produk']; ?>" class="btn btn-sm btn-primary">
                <i class="fas-plus"></i> Tambah Ukuran
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ukuran</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data_ukuran as $key => $value): ?>
                        <tr>
                            <td width="50"><?php echo $key+1; ?></td>
                            <td><?php echo $value['nama_ukuran']; ?></td>
                            <td class="text-center" width="100">
                              <a href="index.php?hapus_ukuran&id_ukuran=<?php echo $value['id_ukuran']; ?>&id_produk=<?php echo $produk['id_produk']; ?>" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                              </a>  
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mt-3">
        <div class="card-header">
            <a href="index.php?tambah_warna&id_produk=<?php echo $produk['id_produk']; ?>" class="btn btn-sm btn-primary">
                <i class="fas-plus"></i> Tambah Warna
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Warna</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data_warna as $key => $value): ?>
                        <tr>
                            <td width="50"><?php echo $key+1; ?></td>
                            <td><?php echo $value['nama_warna']; ?></td>
                            <td class="text-center" width="100">
                              <a href="index.php?hapus_warna&id_warna=<?php echo $value['id_warna']; ?>&id_produk=<?php echo $produk['id_produk']; ?>" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                              </a>  
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mt-3">
        <div class="card-header">
            <a href="index.php?tambah_foto&id_produk=<?php echo $produk['id_produk']; ?>" class="btn btn-sm btn-primary">
                <i class="fas-plus"></i> Tambah Foto
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data_foto as $key => $value): ?>
                        <tr>
                            <td width="50"><?php echo $key+1; ?></td>
                           <td><img src="../assets/foto_produk/<?php echo $value['nama_foto']; ?>" class="img-responsive" width="150"></td>
                            <td class="text-center" width="100">
                              <a href="index.php?hapus_foto&id_foto=<?php echo $value['id_foto']; ?>&id_produk=<?php echo $produk['id_produk']; ?>" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                              </a>  
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>

<?php
if(isset($_POST['simpan'])){
    $id_kategori = $_POST['id_kategori'];
    $id_kategori_produk = $_POST['id_kategori_produk'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga_produk'];
    $berat = $_POST['berat_produk'];
    $warna = $_POST['warna_produk'];
    $ukuran = $_POST['ukuran_produk'];
    $deskripsi = $_POST['deskripsi_produk'];
    $stok = $_POST['stok_produk'];
    $diskon = $_POST['diskon_produk'];
    $hrg_diskon = $_POST['harga_diskon'];

    $nama_foto = $_FILES['foto']['name'];
    $lokasi_foto = $_FILES['foto']['tmp_name'];

    // jika poto di ubah
    if(!empty($lokasi_foto)){   
    move_uploaded_file($lokasi_foto, "../assets/foto_produk/".$nama_foto);
    $datafoto10= array();
    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
    while($pecah = $ambil->fetch_assoc()){
    
        $datafoto10[] = $pecah;
    }
    foreach ($datafoto10 as $key => $value) {
        $hapusfoto = $value['foto_produk'];
    
        if(file_exists("../assets/foto_produk/".$hapusfoto)){
            unlink("../assets/foto_produk/".$hapusfoto);
        }
    
       
        $koneksi->query("UPDATE produk SET id_kategori='$id_kategori',
        id_kategori_produk='$id_kategori_produk',
        nama_produk='$nama',
        harga_produk='$harga',
        berat_produk='$berat',
        ukuran_produk='$ukuran',
        warna_produk='$warna',
        deskripsi_produk='$deskripsi',
        stok_produk='$stok',
        diskon_produk='$diskon',
        harga_diskon='$hrg_diskon',
        foto_produk='$nama_foto'
        WHERE id_produk = '$id_produk'");
    }
    
}

// jika foto tidak di ubah
else{
    $koneksi->query("UPDATE produk SET id_kategori='$id_kategori',
    id_kategori_produk='$id_kategori_produk',
    nama_produk='$nama',
    harga_produk='$harga',
    berat_produk='$berat',
    ukuran_produk='$ukuran',
    warna_produk='$warna',
    deskripsi_produk='$deskripsi',
    stok_produk='$stok',
    diskon_produk='$diskon',
    harga_diskon='$hrg_diskon'
    WHERE id_produk = '$id_produk'");
}

// edit data ukuran
$ukuranproduk = $_POST['ukuran_produk'];
$koneksi->query("UPDATE ukuran SET 
id_produk='$id_produk',
nama_ukuran='$ukuranproduk'
WHERE id_ukuran='$id_ukuran'");

// edit data warna
$warnaproduk = $_POST['warna_produk'];
$koneksi->query("UPDATE warna SET 
id_produk='$id_produk',
nama_warna='$warnaproduk'
WHERE id_warna='$id_warna'");

$namafoto = $_FILES['foto']['name'];
$lokasifoto = $_FILES['foto']['tmp_name'];

// jika foto diubah
if(!empty($lokasifoto)){
    move_uploaded_file($lokasifoto, "../assets/foto_produk/". $namafoto);
   
 
    $koneksi->query("UPDATE foto SET
    id_produk='$id_produk',
    nama_foto='$namafoto'
    WHERE id_foto='$id_foto'");
}
// jika foto tidak diubah
else {
    $koneksi->query("UPDATE foto SET
    id_produk='$id_produk'
    WHERE id_foto='$id_foto'");

}
echo"<script>alert('data produk berhasil di update');</script>";
echo"<script>location='index.php?detail_produk&id_produk=$id_produk';</script>";
}
?>