<h1 class="h3 mb-4 text-gray-800">Edit Data Kategori Produk</h1>
<?php
$id_kategori_produk = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM kategori_produk WHERE id_kategori_produk = '$id_kategori_produk'");

$pecah = $ambil->fetch_assoc();

?>

<form method="post" enctype="multipart/form-data">
<div class="card shadow">
    <div class="card-body">

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama kategori Produk :</label>
        <div class="col-sm-9">
            <input type="text" name="nama_kategori_produk" class="form-control" value="<?php echo $pecah['nama_kategori_produk']; ?>">
        </div> 
        </div>

    </div>
    <div class="card-footer py-3">
        <div class="row">
            <div class="col">
                <a href="index.php?kategori_produk" class="btn btn-sm btn-danger">
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
$nama = $_POST['nama_kategori_produk'];

$koneksi->query("UPDATE kategori_produk SET nama_kategori_produk = '$nama'
WHERE id_kategori_produk = '$id_kategori_produk'");

echo"<script>alert('data kategori Produk berhasil di Update');</script>";
echo"<script>location='index.php?kategori_produk';</script>";
}
?>