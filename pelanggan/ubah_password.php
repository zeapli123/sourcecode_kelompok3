<?php 
// session_start();
include '../config/koneksi.php';
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];


?>
<!-- <pre><?php print_r($pecah);?></pre> -->
<form method="post" enctype="multipart/form-data">
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" >Password Lama :</label>
        <div class="col-sm-8">
        <input type="password" name="pass_lama" class="form-control" placeholder="Password Lama" >
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" >Password Baru :</label>
        <div class="col-sm-8">
        <input type="password" name="pass_baru" class="form-control" placeholder="Password Baru">
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

    $pass_lama = sha1($_POST['pass_lama']);
    $pass_baru = sha1($_POST['pass_baru']);
    $ambil =  $koneksi->query("SELECT * FROM pelanggan WHERE password_pelanggan='$pass_lama'");

    $pass= $ambil->num_rows; 

    if($pass){
              $koneksi->query("UPDATE pelanggan SET password_pelanggan ='$pass_baru'
            WHERE id_pelanggan='$id_pelanggan'");
            echo"<script>alert('Password berhasil di Update');</script>";
            echo"<script>location='../login.php'</script>"; 
      
       
    }else{
        echo"<script>alert('Password Lama Salah');</script>";
        echo"<script>location='profil.php?ubah_password'</script>"; 
       
    }






}

?>