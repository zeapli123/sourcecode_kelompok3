<?php
session_start();
include 'config/koneksi.php';
$active = 'Kontak';
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
                            <li>Kontak</li>
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
                           <h2>Hubungi Kami</h2>
                            <p> Jika Anda memiliki Pertanyaan, jangan ragu untuk menghubungi kami. Layanan kami bekerja selama <strong>24 jam</strong></p>
                           </center>
                           <!-- form-horizontal start -->
                           <form method="post" class="form-horizontal mt-4" >
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Nama Lengkap :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama" class="form-control" placeholder="Masukan nama Lengkap" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Email :</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Telepon :</label>
                                <div class="col-sm-9">
                                    <input type="number" name="telepon" class="form-control" placeholder="Masukan Nomor Telepon" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Pesan :</label>
                                <div class="col-sm-9">
                                    <textarea name="pesan" class="form-control" placeholder="Masukan pesan" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                  <button name="kirim" class="btn btn-primary">
                                    <i class="fas fa-user-md"></i> Kirim
                                  </button>
                                </div>
                            </div>
                           </form>
                            <!-- form-horizontal end -->
                        </div>
                         <!-- card-box end -->
                         
                         <div class="col-md-12 kontak-map ">
                            
                         
                                  <!-- card-box start -->
                                  <div class="card-box">
                                   <center>
                                  <h2 class="judul"><span>Lokasi </span>Kami</h2>
                                  </center>
                                   
                               <center>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63454.44219761981!2d106.5465825765044!3d-6.276530441989177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fcefbec3875d%3A0x669499deb9d5368c!2sLegok%2C%20Tangerang%20Regency%2C%20Banten%2015820!5e0!3m2!1sen!2sid!4v1699380319500!5m2!1sen!2sid"  allowfullscreen=""  loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </center>
                </div>
                </div>
                <!--card-box end  --> 
                    </div>
                    <!-- page-produk end -->
                      
                    
                     
           
                </div>
            </div>
        </div>
        <!-- content end -->
    <?php
    if(isset($_POST['kirim'])){
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $telepon = $_POST['telepon'];
        $pesan = $_POST['pesan'];

        $koneksi->query("INSERT INTO pesan (nama,email,telepon,isi_pesan) VALUES('$nama','$email','$telepon','$pesan')");
        echo"<script>alert('Pesan Terkirim');</script>";
        echo"<script>location='kontak.php'</script>"; 
        
        //  echo "<pre>";
        // print_r($kirim);
        // echo"</pre>";
    
    }
    ?>

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
