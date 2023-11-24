<h1 class="h3 mb-4 text-gray-800">Tambah Data Produk</h1>
<?php
// data kategori
$kategori  = array();

$ambil = $koneksi->query("SELECT * FROM kategori");
while ($pecah = $ambil->fetch_assoc()) {

$kategori[] = $pecah;

}

// data kategori produk
$kategori_produk  = array();

$ambil = $koneksi->query("SELECT * FROM kategori_produk");
while ($pecah = $ambil->fetch_assoc()) {

$kategori_produk[] = $pecah;

}
?>
<form method="post" enctype="multipart/form-data">
<div class="card shadow">
    <div class="card-body">

    <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kategori :</label>
        <div class="col-sm-9">
            <select name="id_kategori" class="form-control">
                <option selected disabled>Pilih Kategori</option>

                <?php foreach ($kategori as $key => $value): ?>
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
                <option selected disabled>Pilih Kategori Produk</option>
                <?php foreach ($kategori_produk  as $key => $value): ?>
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
            <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk">
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">harga Produk :</label>
        <div class="col-sm-9">
            <input type="number" name="harga_produk" class="form-control" placeholder="Harga Produk">
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Berat Produk :</label>
        <div class="col-sm-9">
            <input type="number" name="berat_produk" class="form-control" placeholder="Berat Produk">
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Warna Produk :</label>
        <div class="col-sm-9">
           <div class="input-warna">
           <input type="text" name="warna_produk[]" class="form-control" placeholder="Warna Produk">
           </div>
           <span class="btn btn-sm btn-primary mt-1 btn-warna">
            <i class="fas fa-plus"> </i> Tambah Warna
           </span>
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Ukuran Produk :</label>
        <div class="col-sm-9">
        <div class="input-ukuran">
            <input type="text" name="ukuran_produk[]" class="form-control" placeholder="Ukuran Produk">
           </div>
           <span class="btn btn-sm btn-primary mt-1 btn-ukuran">
            <i class="fas fa-plus"> </i> Tambah Ukuran
           </span>      

        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Deskripsi Produk :</label>
        <div class="col-sm-9">
            <textarea name="deskripsi_produk" class="form-control" placeholder="Deskripsi Produk"></textarea>
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Stok Produk :</label>
        <div class="col-sm-9">
            <input type="number" name="stok_produk" class="form-control" placeholder="Stok Produk">
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Foto Produk :</label>
        <div class="col-sm-9">
        <div class="input-foto">
            <input type="file" name="foto_produk[]" class="form-control">
           </div>
           <span class="btn btn-sm btn-primary mt-1 btn-foto">
            <i class="fas fa-plus"> </i> Tambah Foto
           </span>
        </div> 
        </div>
                
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Diskon Produk :</label>
        <div class="col-sm-9">
            <input type="number" name="diskon_produk" class="form-control" placeholder="Diskon Produk">
        </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Harga Diskon :</label>
        <div class="col-sm-9">
            <input type="number" name="harga_diskon" class="form-control" placeholder="Harga Diskon">
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
</form>

<?php
if(isset($_POST['simpan'])){

//   echo  "<pre>";
// print_r($_POST['warna_produk']);
// print_r($_POST['ukuran_produk']);
// print_r($_FILES['foto_produk']);
// echo"</pre>";

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

$nama_foto = $_FILES['foto_produk']['name'];
$lokasi_foto = $_FILES['foto_produk']['tmp_name'];

move_uploaded_file($lokasi_foto[0], "../assets/foto_produk/". $nama_foto[0]);

$koneksi->query("INSERT INTO produk (id_kategori,id_kategori_produk,nama_produk,
harga_produk,berat_produk,warna_produk,ukuran_produk,
deskripsi_produk,stok_produk,foto_produk,diskon_produk,harga_diskon) VALUES ('$id_kategori','$id_kategori_produk',
'$nama','$harga','$berat','$warna[0]','$ukuran[0]','$deskripsi','$stok',
'$nama_foto[0]','$diskon','$hrg_diskon')");

$id_produk_baru = $koneksi->insert_id;

 foreach ($ukuran as $key => $nama_ukuran){
    $koneksi->query("INSERT INTO ukuran (id_produk,nama_ukuran) VALUES ('$id_produk_baru','$nama_ukuran')");
 }

 foreach ($warna as $key => $nama_warna){
    $koneksi->query("INSERT INTO warna (id_produk,nama_warna) VALUES ('$id_produk_baru','$nama_warna')");
 }


 foreach ($nama_foto as $key => $namafoto){
    $lokasifoto = $lokasi_foto[$key];

    move_uploaded_file($lokasifoto, "../assets/foto_produk/".$namafoto);
     
    $koneksi->query("INSERT INTO foto (id_produk,nama_foto) VALUES ('$id_produk_baru','$namafoto')");
 }

 echo"<script>alert('data produk berhasil di tambahkan');</script>";
echo"<script>location='index.php?produk';</script>";

}
?>