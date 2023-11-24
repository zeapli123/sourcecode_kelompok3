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
        <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_pelanggan']?>" readonly>
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
        <input type="password" name="password" class="form-control" value="<?php echo $pecah['password_pelanggan']?>"readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" >Telepon :</label>
        <div class="col-sm-8">
        <input type="text" name="telepon" class="form-control" value="<?php echo $pecah['telepon_pelanggan']?>"readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" >Alamat :</label>
        <div class="col-sm-8">
        <textarea name="alamat" class="form-control" readonly><?php echo $pecah['alamat_pelanggan']?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" >Foto :</label>
        <div class="col-sm-8">
        <img src="../assets/foto_pelanggan/<?php echo $pecah['foto_pelanggan']?>" class="img-responsive mb-3"  width="150" readonly>
       
        </div>
    </div>
</form>

