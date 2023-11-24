<h1 class="h3 mb-4 text-gray-800">Edit Data Banner</h1>

<?php

$id_banner = $_GET['id_banner'];

$ambil = $koneksi->query("SELECT * FROM banner WHERE id_banner='$id_banner'");
$pecah = $ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
<div class="card shadow">
    <div class="card-body">

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Foto banner:</label>
        <div class="col-sm-9">
        <img src="../assets/foto_banner/<?php echo $pecah['foto_banner']; ?>" class="img-responsive mb-3" width="350">
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
if(isset($_POST['simpan'])){
  $nama_foto = $_FILES['foto']['name'];
  $lokasi_foto = $_FILES['foto']['tmp_name'];
  move_uploaded_file( $lokasi_foto,"../assets/foto_banner/". $nama_foto );

  $datafoto9= array();
    $ambil = $koneksi->query("SELECT * FROM banner WHERE id_banner='$id_banner'");
    while($pecah = $ambil->fetch_assoc()){
    
        $datafoto9[] = $pecah;
    }
    foreach ($datafoto9 as $key => $value) {
        $hapusfoto = $value['foto_banner'];
    
        if(file_exists("../assets/foto_banner/".$hapusfoto)){
            unlink("../assets/foto_banner/".$hapusfoto);
        }
    
       
        $koneksi->query("UPDATE banner SET foto_banner='$nama_foto' 
        WHERE id_banner = '$id_banner'");
    }
 

echo"<script>alert('data banner berhasil di update');</script>";
echo"<script>location='index.php?banner';</script>";
}
?>