<?php 
include '../config/koneksi.php';
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
$ambil =  $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$pecah=$ambil->fetch_assoc(); 

?>
<!-- <pre><?php print_r($pecah);?></pre> -->


<form method="post" enctype="multipart/form-data">
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" >Nama Lengkap :</label>
        <div class="col-sm-8">
        <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_pelanggan']?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" >Email :</label>
        <div class="col-sm-8">
        <input type="email" name="email" class="form-control" value="<?php echo $pecah['email_pelanggan']?>"readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" >Password :</label>
        <div class="col-sm-8">
        <input type="password" class="form-control" value="<?php echo $pecah['password_pelanggan']?>"readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" >Telepon :</label>
        <div class="col-sm-8">
        <input type="text" name="telepon" class="form-control" value="<?php echo $pecah['telepon_pelanggan']?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" >Alamat :</label>
        <div class="col-sm-8">
        <textarea name="alamat" class="form-control"><?php echo $pecah['alamat_pelanggan']?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" >Foto :</label>
        <div class="col-sm-8">
        <img src="../assets/foto_pelanggan/<?php echo $pecah['foto_pelanggan']?>" class="img-responsive mb-3"  width="150">
        <input type="file" name="foto" class="form-control" >
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" ></label>
        <div class="col-sm-8">
        <button name="update" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
<?php 
 if(isset($_POST["update"])){
$nama = $_POST['nama'];
$pass = sha1($_POST['password']);
$telp= $_POST['telepon'];
$alamat = $_POST['alamat'];

$nama_foto = $_FILES['foto']['name'];
$lokasi_foto = $_FILES['foto']['tmp_name'];


// jika foto pelanggan di ubah
if(!empty($lokasi_foto)){
    move_uploaded_file($lokasi_foto, "../assets/foto_pelanggan/".$nama_foto);
    $datafoto6 = array();
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
    while($pecah = $ambil->fetch_assoc()){
    
        $datafoto6[] = $pecah;
    }
    foreach ($datafoto6 as $key => $value) {
        $hapusfoto = $value['foto_pelanggan'];
    
        if(file_exists("../assets/foto_pelanggan/".$hapusfoto)){
            unlink("../assets/foto_pelanggan/".$hapusfoto);
        }
    
       
        $ambil =  $koneksi->query("UPDATE pelanggan SET nama_pelanggan = '$nama', telepon_pelanggan = '$telp', alamat_pelanggan = '$alamat',foto_pelanggan = '$nama_foto' WHERE id_pelanggan='$id_pelanggan'");
    }
// jika password pelanggan diubah
if(!empty($_POST['password'])){
   $ambil = $koneksi->query("UPDATE pelanggan SET nama_pelanggan = '$nama',password_pelanggan = '$pass',telepon_pelanggan = '$telp',alamat_pelanggan = '$alamat',foto_pelanggan = '$nama_foto' WHERE id_pelanggan='$id_pelanggan'");

}else{
    $ambil =  $koneksi->query("UPDATE pelanggan SET nama_pelanggan = '$nama', telepon_pelanggan = '$telp', alamat_pelanggan = '$alamat',foto_pelanggan = '$nama_foto' WHERE id_pelanggan='$id_pelanggan'");
 
}

}
// jika foto pelanggan tidak diubah
else{
    if(!empty($_POST['password'])){
        $ambil =  $koneksi->query("UPDATE pelanggan SET nama_pelanggan = '$nama',password_pelanggan = '$pass',telepon_pelanggan = '$telp',alamat_pelanggan = '$alamat' WHERE id_pelanggan='$id_pelanggan'");
    }else{
        $ambil =  $koneksi->query("UPDATE pelanggan SET nama_pelanggan = '$nama',telepon_pelanggan = '$telp',alamat_pelanggan = '$alamat' WHERE id_pelanggan='$id_pelanggan'");
       
    }
}
echo"<script>alert('Data Telah DiUpdate');</script>";
 echo"<script>location='profil.php?akun'</script>"; 
}

?>