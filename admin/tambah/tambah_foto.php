<h1 class="h3 mb-4 text-gray-800">Tambah Data Foto Produk</h1>
<?php 
$id_produk = $_GET['id_produk'] ;
?>

<form method="post" enctype="multipart/form-data">
<div class="card shadow">
    <div class="card-body">

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Foto Produk:</label>
        <div class="col-sm-9">
            <input type="file" name="foto" class="form-control">
        </div> 
        </div>

    </div>
    <div class="card-footer py-3">
        <div class="row">
            <div class="col">
                <a href="index.php?detail_produk&id_produk=<?php echo $id_produk; ?>" class="btn btn-sm btn-danger">
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
if(isset($_POST["simpan"]))
{
$namafoto = $_FILES['foto']['name'];
$lokasifoto =$_FILES['foto']['tmp_name'];

move_uploaded_file($lokasifoto, "../assets/foto_produk/". $namafoto);

$koneksi->query("INSERT INTO foto (id_produk,nama_foto) 
VALUES ('$id_produk','$namafoto')");

echo"<script>alert('data foto berhasil di tambahkan');</script>";
echo"<script>location='index.php?detail_produk&id_produk=$id_produk';</script>";
}
?>