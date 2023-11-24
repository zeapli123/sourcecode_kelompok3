<h1 class="h3 mb-4 text-gray-800">Tambah Data Kategori</h1>

<form method="post" enctype="multipart/form-data">
<div class="card shadow">
    <div class="card-body">

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama kategori :</label>
        <div class="col-sm-9">
            <input type="text" name="nama_kategori" class="form-control" placeholder="Nama kategori">
        </div> 
        </div>

    </div>
    <div class="card-footer py-3">
        <div class="row">
            <div class="col">
                <a href="index.php?kategori" class="btn btn-sm btn-danger">
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
if(isset($_POST["simpan"])){
    $nama = $_POST['nama_kategori'];

    $koneksi->query("INSERT INTO kategori (nama_kategori) VALUES ('$nama')");

 echo"<script>alert('data kategori berhasil di tambahkan');</script>";
echo"<script>location='index.php?kategori';</script>";
}
?>