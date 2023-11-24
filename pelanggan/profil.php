<?php
session_start();
include '../config/koneksi.php';
$active = 'Akun Saya';


// jika tidak ada session pelanggan(blm login) maka dilarikan ke login.php

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
$ambil =  $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");

$pecah = $ambil->fetch_assoc();
// echo"<pre>";
// print_r($pecah);
// echo"</pre>";

if(!isset($_SESSION['pelanggan'])){
echo"<script>alert('Silahkan Login');</script>";
echo"<script>location='../login.php';</script>";  
exit();
}

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

<body>
    <!-- tob-bar start -->
    <div id="top-bar">
        <div class="container">
            <div class="row">
                <!-- top left start -->
                <div class="col-md-6 top-left">
                    <a href="../index.php" class="btn btn-sm btn-primary">Welcome</a>
                    <a href="#"><?php echo $pecah['nama_pelanggan']?></a>
                </div>
                <!-- top left end -->
                <!-- top right start -->
                <div class="col-md-6 top-right">
                <ul class="top-menu">
                        <li><a href="../keranjang.php">Keranjang</a></li>
                        <!-- jika ada session pelanggan -->
                        <?php if(isset($_SESSION['pelanggan'])):?>
                            <li><a href="profil.php">Akun Saya</a></li>
                            <li><a href="../logout.php">Logout</a></li>

                        <!-- selain itu jika tidak ada session pelanggan -->
                        <?php else: ?>
                        <li><a href="../daftar.php">Daftar</a></li>
                        <li><a href="../login.php">Login</a></li>
                        <?php endif ?>
                    </ul>
                </div>
                <!-- top right end -->

            </div>
        </div>
    </div>
    <!-- navbar start-->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <!-- navbar-brand start -->
            <div class="navbar-brand">
                <a class="d-none d-lg-block" href="../index.php">Online <span>Shop</span> </a>
                <a class="d-sm-none" href="../index.php">Online <br><span>Shop</span> </a>
            </div>
            <!-- navbar-brand end -->
            <!-- btn-navbar start -->
            <div class="btn-navbar">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#search">
                    <span class="toggler"></span>
                    <i class="fas fa-search"></i>
                </button>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span class="toggler"></span>
                    <i class="fas fa-list"></i>
                </button>
            </div>
            <!-- btn-navbar end -->
            <!-- navbarNav start -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="../produk.php">Produk</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="profil.php">Akun Saya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../keranjang.php">Keranjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../kontak.php">Kontak</a>
                    </li>
                </ul>
               <!-- search start -->
               <div class="collapse clearfix" id="search">
                    <form action="../produk.php" method="get" class="navbar-form">
                        <div class="input-group">
                            <input type="search" name="keyword" class="form-control" placeholder="Search" required>
                            <span class="input-group-btn"></span>
                            <button class="btn btn-primary"  value="Search" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <!-- search end -->
                <!-- btn-search start -->
                <div class="btn-search">
                    <div class="collapse navbar-collapse">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#search">
                            <span class="toggler"></span>
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <!-- btn-search end -->
                <!-- btn-keranjang start -->
                <div class="btn-keranjang">
                <?php if(empty($_SESSION['keranjang'])):?>
                            
                            <a href="../keranjang.php" class="btn btn-primary"> <i class="fas fa-shopping-cart">(0) </i>  <span></span>  </a>
                            <?php else:?>
                                <?php
                                $items = 0;
                                foreach($_SESSION['keranjang']as $id_produk =>$jumlah){
                                    $items++;
                                }
                                    ?>
                                <a href="../keranjang.php" class="btn btn-primary"> <i class="fas fa-shopping-cart"></i>  <span>(<?php echo $items;?>) </span>  </a>
                                   
                        <?php endif;?>
                </div>
                <!-- btn-keranjang end -->
            </div>
            <!-- navbarNav end-->
        </div>
    </nav>
    <!-- navbar end-->
    <div id="content">
        <div class="container">
            <div class="row">
                <!-- breadcrumb start -->
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="../index.php">Home</a></li>
                        <li>Profil</li>
                    </ul>
                </div>
                <!-- breadcrumb end -->

                <!-- col-md-3 start -->
                <div class="col-md-3">
                    <div class="card kategori">
                        <div class="card-header text-center">
                            <img src="../assets/foto_pelanggan/<?php echo $pecah['foto_pelanggan']; ?>" class="img-responsive rounded-circle
                            rounded mx-auto d-block mb-3" width="150" >
                            <h4><?php echo $pecah['nama_pelanggan']; ?></h4>
                        </div>
                        <nav class="nav flex-column nav-menu">
                            <li class="<?php if(isset($_GET['akun'])){echo"active";}?>">
                                <a href="profil.php?akun" class="nav-link">
                                    <i class="fas fa-list"></i> Profil
                                </a>
                            </li>
                            <li class="<?php if(isset($_GET['edit_akun'])){echo"active";}?>">
                                <a href="profil.php?edit_akun" class="nav-link">
                                    <i class="fas fa-edit"></i> Edit Profil
                                    </a>
                            </li>
                            <li class="<?php if(isset($_GET['pesanan'])){echo"active";}?>">
                                <a href="profil.php?pesanan" class="nav-link">
                                    <i class="fas fa-list"></i> Pesanan
                                </a>
                            </li>
                            <li class="<?php if(isset($_GET['ubah_password'])){echo"active";}?>">
                                <a href="profil.php?ubah_password" class="nav-link">
                                    <i class="fas fa-user"></i> Ubah Password
                                    </a>
                            </li>
                            <li class="<?php if(isset($_GET['hapus_akun'])){echo"active";}?>">
                                <a href="profil.php?hapus_akun" class="nav-link">
                                    <i class="fas fa-trash"></i> Hapus Akun
                                    </a>
                            </li>
                            <li class="<?php if(isset($_GET['logout'])){echo"active";}?>">
                                <a href="../logout.php" class="nav-link">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                            </li>
                        </nav>
                    </div>

                </div>
                <!-- col-md-3 end -->

                <!-- col-md-9 start -->
                <div class="col-md-9">
                    <div class="card-box">
                        <?php

                        // halaman pesanan
                        if(isset($_GET['pesanan']))
                        {
                            include 'pesanan.php';
                        } 
                        else if(isset($_GET['detail_pesanan']))
                        {
                            include 'detail_pesanan.php';
                        }
                       
                        else if(isset($_GET['bayar']))
                        {
                            include 'bayar.php';
                        }

                         // halaman edit_akun
                        elseif(isset($_GET['edit_akun']))
                        {
                            include 'edit_akun.php';
                        }

                          // halaman ubah_password
                          elseif(isset($_GET['ubah_password']))
                          {
                              include 'ubah_password.php';
                          }

                          // halaman hapus_akun
                          elseif(isset($_GET['hapus_akun']))
                          {
                              include 'hapus_akun.php';
                          }
                          // halaman Profil
                          elseif(isset($_GET['akun']))
                          {
                              include 'akun.php';
                          }
                            // halaman detail Pembayaran
                          elseif(isset($_GET['detail_pembayaran']))
                          {
                              include 'detail_pembayaran.php';
                          }
                          else if(isset($_GET['hapus_pembayaran']))
                          {
                              include 'hapus_pembayaran.php';
                          }

                        ?>
                    </div>
                </div>
                <!-- col-md-9 end -->
            </div>
        </div>
    </div>

    <!-- footer start -->
    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Halaman</h4>
                    <ul class="menu">
                        <li><a href="../keranjang.php">Keranjang</a></li>
                        <li><a href="../kontak.php">Kontak</a></li>
                        <li><a href="../produk.php">Produk</a></li>
                        <li><a href="profil.php">Akun Saya</a></li>
                    </ul>
                    <hr>
                    <h4>Pelanggan</h4>
                    <ul>
                        <li><a href="../login.php">Produk</a></li>
                        <li><a href="../daftar.php">Daftar</a></li>

                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Kategori Produk</h4>
                    <ul>
                        <li><a href="#">Baju</a></li>
                        <li><a href="#">Jaket</a></li>
                        <li><a href="#">Celana</a></li>
                        <li><a href="#">Sweater</a></li>
                    </ul>
                    <hr>
                    <h4>Kategori</h4>
                    <ul>
                        <li><a href="#">Pria</a></li>
                        <li><a href="#">Wanita</a></li>
                        <li><a href="#">Anak</a></li>

                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Temukan Kami</h4>
                    <p>
                        <strong>Online <span>Shop</span></strong>
                        <br>Bandar Lampung
                        <br>Kecamatan Rajabasa
                        <br>Kabupaten Rajabasabr
                        <br>081234567890
                        <br>Rhamlatgebok@gmail.com
                        <strong>Bang Rhamlat</strong>
                    </p>
                    <hr>
                    <h4>Sosial Media Kami</h4>
                    <p class="sosial">
                        <a href="#" class="fab fa-facebook"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-youtube"></a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="left">&copy; Online <span>Shop</span> | 2023</p>
                </div>
                <div class="col">
                    <p class="right">&copy; Dibuat Oleh: Pejuang Mimpi.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- footer end -->

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