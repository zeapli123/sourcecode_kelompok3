<?php
session_start();
include '../config/koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo_z.png">
    <title>Toko Online</title>
    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- owl carousel -->
    <link href="../assets/css/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/css/owl.theme.default.min.css" rel="stylesheet">
    <!-- style css -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body id="login">

    <div class="container">
        <div class="form-login">
            <span class="title">login</span>
            <form method="post">

            <div class="input-filed">
                <input type="text" name="username" placeholder="Masukan Usernama" required>
                <i class="fas fa-user-edit"></i>
            </div>

            <div class="input-filed">
                <input type="password" name="password" class="password" placeholder="Masukan Password" required>
                <i class="fas fa-lock lock"></i>
                <i class="fas fa-eye-slash lihat-pass"></i>
            </div>
            
            <div class="input-filed">
                <button name="masuk" class="btn btn-primary btn-user">Masuk</button>
            </div>

            </form>
        </div>
    </div>

    <?php
    if(isset($_POST["masuk"])){
       $user =  $_POST['username'];
       $pass = sha1($_POST['password']);

        $ambil = $koneksi->query("SELECT * FROM admin WHERE username = '$user' AND password= '$pass' ");
        $cek_admin = $ambil->fetch_assoc();

        // jika kosong
        if(empty($cek_admin)){
            echo"<script>alert('Login gagal');</script>";
            echo"<script>location='login.php';</script>";  

            // jika tidak kosong
        }else{
            // buat session admin
            $_SESSION ['admin'] = $cek_admin;   
            echo"<script>alert('Login sukses');</script>";
            echo"<script>location='index.php';</script>";  
    }
}
    ?>



 <!-- Bootstrap core JavaScript-->
 <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- owl jss -->
    <script src="../assets/js/owl.carousel.min.js"></script>

    <!-- main js -->
    <script src="../assets/js/main.js"></script>
</body>

</html>