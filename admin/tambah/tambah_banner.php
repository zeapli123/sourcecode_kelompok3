<h1 class="h3 mb-4 text-gray-800">Tambah Data Banner</h1>

<form method="post" enctype="multipart/form-data">
<div class="card shadow">
    <div class="card-body">

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Foto banner:</label>
        <div class="col-sm-9">
            <input type="file" name="foto" class="form-control">
        </div> 
        </div>

    </div>
    <div class="card-footer py-3">
        <div class="row">
            <div class="col">
                <a href="index.php?banner" class="btn btn-sm btn-danger">
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

move_uploaded_file($lokasifoto, "../assets/foto_banner/". $namafoto);

$koneksi->query("INSERT INTO banner (foto_banner) VALUES ('$namafoto')");

echo"<script>alert('data banner berhasil di tambahkan');</script>";
echo"<script>location='index.php?banner';</script>";
}
?>