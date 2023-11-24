<?php

$active = 'Home';

include 'includes/header.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/logo_z.png">
    <title>Toko Online</title>
    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- owl carousel -->
    <link href="assets/css/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/css/owl.theme.default.min.css" rel="stylesheet">
    <!-- style css -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
        <!-- content star -->
        <div id="content">
            <div class="container">
                <div class="row">
                    <!-- breadcrumb start -->
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="index.php">Home</a></li>
                            <li>Daftar</li>
                        </ul>
                    </div>
                    <!-- breadcrumb end -->

                    <!-- sidebar start -->
                    <div class="col-md-3">
                        <?php include 'includes/sidebar.php' ?>
                    </div>
                    <!-- sidebar end -->

                    <!-- page-produk start -->
                    <div class="col-md-9 page-produk">
                        <!-- card-box start -->
                        <div class="card-box">
                           <center>
                           <h2>Membuat akun Baru</h2>
                            <p> Jika anda sudah memiliki akun silahkan <a href="login.php">Login</a></p>
                           </center>
                           <!-- form-horizontal start -->
                           <form method="post" class="form-horizontal mt-4" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Nama Lengkap :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama" class="form-control" placeholder="Masukan nama Lengkap">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Email :</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" placeholder="Masukan Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Password :</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control" placeholder="Masukan Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Telepon :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="telepon" class="form-control" placeholder="Masukan Telepon">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Alamat :</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat" class="form-control" placeholder="Masukan alamat"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Foto :</label>
                                <div class="col-sm-9">
                                    <input type="file" name="foto" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                  <button name="daftar" class="btn btn-primary">
                                    <i class="fas fa-user-md"></i> Daftar
                                  </button>
                                </div>
                            </div>
                           </form>
                            <!-- form-horizontal end -->
                        </div>
                         <!-- card-box end -->
                          

                    </div>
                    <!-- page-produk end -->

                </div>
            </div>
        </div>
        <!-- content end -->


     <!-- footer start -->
     <?php include 'includes/footer.php'; ?>
    <!-- footer end -->

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- owl jss -->
    <script src="assets/js/owl.carousel.min.js"></script>

    <!-- main js -->
    <script src="assets/js/main.js"></script>
</body>

</html>

<?php 

// jika ada nama tombol daftar
if(isset($_POST['daftar'])){
   $nama = $_POST['nama'] ;
   $email = $_POST['email'] ;
   $password = sha1($_POST['password']) ;
   $telepon = $_POST['telepon'];
   $alamat = $_POST['alamat'];

   $nama_foto = $_FILES['foto']['name'];
   $lokasi_foto = $_FILES['foto']['tmp_name'];

move_uploaded_file($lokasi_foto, "assets/foto_pelanggan/".$nama_foto);

$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
$cek_email = $ambil->num_rows;

if($cek_email==1){
    echo"<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
    echo"<script>location='daftar.php';</script>";  
}else{
    $koneksi->query("INSERT INTO pelanggan(nama_pelanggan,email_pelanggan,
    password_pelanggan,telepon_pelanggan,alamat_pelanggan,foto_pelanggan)
    VALUES ('$nama','$email','$password', '$telepon', '$alamat','$nama_foto')");

    echo"<script>alert('pendaftaran Berhasil, Silahkan login');</script>";
    echo"<script>location='login.php';</script>";  

}

}
?>