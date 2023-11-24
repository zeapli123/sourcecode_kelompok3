<?php
include '../config/koneksi.php';
$ambil =  $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
?>

<center>
    <h2>Hapus akun</h2>
    <p class="text-muted">Apakah anda yakin ingin menghapus akun?</p>
    <form method="post" class="form-horizontal">
    <div class="row">
        <div class="col">
            <button name="hapus" class="btn btn-danger">ya, saya ingin menghapus akun</button>
        </div>
        <div class="col">
            <a href="profil.php" class="btn btn-primary">tidak, saya tidak ingin menghapus akun</a>
        </div>
    </div>
    </form>
</center>
<?php

    if(isset($_SESSION['pelanggan']['id_pelanggan'] )){
        if(isset($_POST['hapus'])){
   
  
    // hapus  foto yang ada di table pembayaran
$datafoto2 = array();
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan ='$id_pelanggan'");
while($pecah = $ambil->fetch_assoc()){

    $datafoto2[] = $pecah;
}
foreach ($datafoto2 as $key => $value) {
    $hapusfoto = $value['foto_pelanggan'];

    if(file_exists("../assets/foto_pelanggan/".$hapusfoto)){
        unlink("../assets/foto_pelanggan/".$hapusfoto);
    }

   
    $koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
}

echo"<script>alert('Akun berhasil Dihapus');</script>";
echo"<script>location='../logout.php'</script>"; 


exit;
}
}

?>