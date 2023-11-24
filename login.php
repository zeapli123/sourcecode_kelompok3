<?php
session_start();
$active = 'Home';

include 'config/koneksi.php';
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

<?php
include 'includes/header.php';

?>

        <!-- content star -->
        <div id="content">
            <div class="container">
                <div class="row">
                    <!-- breadcrumb start -->
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="index.php">Home</a></li>
                            <li>Login</li>
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
                           <h2>Membuat akun</h2>
                            <p> Jika anda tidak memiliki akun silahkan <a href="daftar.php">Daftar</a></p>
                           </center>
                           <!-- form-horizontal start -->
                           <form method="post" class="form-horizontal mt-4">
                           
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
                                <label  class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                  <button name="masuk" class="btn btn-primary">
                                    <i class="fas fa-user-md"></i> Masuk
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
    if(isset($_POST["masuk"])){
       $email =  $_POST['email'];
       $pass = sha1($_POST['password']);

        $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan= '$pass' ");
        $cek_akun = $ambil->num_rows;

        // jika email/password tidak ada di table pelanggan
        if($cek_akun==1){
            $_SESSION['pelanggan']=$ambil->fetch_assoc();
            echo"<script>alert('Login sukses');</script>";
            if(isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang'])){
                echo"<script>location='keranjang.php'</script>"; 
            }else{
                echo"<script>location='index.php'</script>"; 
            }
    } 

            // jika email/password ada di table pelanggan
        else{
            // buat session admin
          
            echo"<script>alert('Login gagal');</script>";
            echo"<script>location='login.php';</script>"; 
            
         
        }
}
    ?>
