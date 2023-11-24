<?php
session_start();
include '../config/koneksi.php';

// data admin
$id_admin = $_SESSION['admin']['id_admin'];
$ambil = $koneksi->query("SELECT * FROM admin WHERE id_admin='$id_admin'");
$admin = $ambil->fetch_assoc();

// data pembayaran
$data_pem=array();
$item_pem  = 0;
$ambil = $koneksi->query("SELECT * FROM pembayaran JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembayaran.id_pembelian");
while($pem = $ambil->fetch_assoc()){
$data_pem[]=$pem;
$item_pem++;
}

// data pesan
$data_pesan=array();
$item_pesan  = 0;
$ambil = $koneksi->query("SELECT * FROM pesan ");
while($pesan = $ambil->fetch_assoc()){
$data_pesan[]=$pesan;
$item_pesan++;
}

// jika tidak ada session admin, maka akan dilarikan ke halaman admin
if (!isset($_SESSION['admin'])){
    echo"<script>alert('Silahkan Login');</script>";
echo"<script>location='login.php';</script>";

exit();
// mengamankan halaman admin


}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Halaman Admin</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

     <!-- Custom styles for this page -->
     <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

     <link rel="icon" type="image/x-icon" href="../assets/img/logo_z.png">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-store-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-1">ADMINISTRATOR</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pesan -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?pesan">
                    <i class="fas fa-envelope fa-fw"></i>
                    <span>Pesan</span></a>
            </li>

            <!-- Nav Item - Banner -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?banner">
                    <i class="fas fa-image"></i>
                    <span>Banner</span></a>
            </li>

            <!-- Nav Item - Kategori -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?kategori">
                    <i class="fas fa-list"></i>
                    <span>Kategori Produk</span></a>
            </li>

             <!-- Nav Item - Kategori Produk -->
             <li class="nav-item">
                <a class="nav-link" href="index.php?kategori_produk">
                    <i class="fas fa-list"></i>
                    <span>Kategori </span></a>
            </li>

              <!-- Nav Item - Produk -->
              <li class="nav-item">
                <a class="nav-link" href="index.php?produk">
                    <i class="fas fa-cubes"></i>
                    <span>Produk</span></a>
            </li>

              <!-- Nav Item - Pembelian -->
              <li class="nav-item">
                <a class="nav-link" href="index.php?pembelian">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Pembelian</span></a>
            </li>

              <!-- Nav Item - Pelanggan -->
              <li class="nav-item">
                <a class="nav-link" href="index.php?pelanggan">
                    <i class="fas fa-users"></i>
                    <span>Pelanggan</span></a>
            </li>

              <!-- Nav Item -Laporan -->
              <li class="nav-item">
                <a class="nav-link" href="index.php?laporan_pembelian">
                    <i class="fas fa-file"></i>
                    <span>Laporan</span></a>
            </li>

             <!-- Nav Item - Logout -->
              <li class="nav-item">
                <a class="nav-link" href="index.php?logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"><?php echo $item_pem;?></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Data Pembayaran
                                </h6>
                                <?php foreach($data_pem as $key => $value):?>
                                <a class="dropdown-item d-flex align-items-center" href="index.php?pembayaran&id=<?php echo $value['id_pembelian']?>">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500"><?php echo date("d F Y", strtotime($value['tanggal']))?></div>
                                        Rp. <?php echo number_format($value['total_pembelian'])?> <br>
                                        <?php echo $value['nama']?>
                                    </div>
                                </a>
                               <?php endforeach?>
                                <a class="dropdown-item text-center small text-gray-500" href="index.php?pembelian">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter"><?php echo $item_pesan;?></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <?php foreach($data_pesan as $key => $value):?>
                                <a class="dropdown-item d-flex align-items-center" href="index.php?detail_pesan&id=<?php echo $value['id_pesan']?>">
                                    <!-- <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div> -->
                                    <div>
                                        <div class="text-truncate"><?php echo $value['nama'];?></div>
                                        <div class="small text-gray-500"><?php echo $value['email'];?></div>
                                    </div>
                                </a>
                                <?php endforeach?>
                                <a class="dropdown-item text-center small text-gray-500" href="index.php?pesan">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $admin['nama_lengkap'];?></span>
                                <img class="img-profile rounded-circle"
                                    src="../assets/foto_admin/<?php echo $admin['foto_admin'];?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="index.php?admin">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                               
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    
                    <?php
                    // halaman profile
                    if(isset($_GET["admin"]))
                    {
                        include 'admin.php';
                    }
                    // data pesan
                    else if(isset($_GET["pesan"]))
                    {
                        include 'pesan.php';
                    }
                    else if(isset($_GET["detail_pesan"]))
                    {
                        include 'detail/detail_pesan.php';
                    } 
                    else if(isset($_GET["hapus_pesan"]))
                    {
                        include 'hapus/hapus_pesan.php';
                    }

                    // data banner
                    else if(isset($_GET["banner"]))
                    {
                        include 'banner.php';
                    }
                    else if(isset($_GET["tambah_banner"]))
                    {
                        include 'tambah/tambah_banner.php';
                    }
                    else if(isset($_GET["edit_banner"]))
                    {
                        include 'edit/edit_banner.php';
                    }
                    else if(isset($_GET["hapus_banner"]))
                    {
                        include 'hapus/hapus_banner.php';
                    }

                   
                    // data kategori
                    elseif(isset($_GET["kategori"]))
                    {
                        include 'kategori.php';
                    }
                    else if(isset($_GET["tambah_kategori"]))
                    {
                        include 'tambah/tambah_kategori.php';
                    }
                    else if(isset($_GET["edit_kategori"]))
                    {
                        include 'edit/edit_kategori.php';
                    }
                    else if(isset($_GET["hapus_kategori"]))
                    {
                        include 'hapus/hapus_kategori.php';
                    }

                       // data kategori_produk
                      else if(isset($_GET["kategori_produk"]))
                       {
                           include 'kategori_produk.php';
                       }
                       else if(isset($_GET["tambah_kategori_produk"]))
                       {
                           include 'tambah/tambah_kategori_produk.php';
                       }
                       else if(isset($_GET["edit_kategori_produk"]))
                       {
                           include 'edit/edit_kategori_produk.php';
                       }
                       else if(isset($_GET["hapus_kategori_produk"]))
                       {
                           include 'hapus/hapus_kategori_produk.php';
                       }

                         // data produk
                         elseif(isset($_GET["produk"]))
                         {
                             include 'produk.php';
                         }
                         else if(isset($_GET["tambah_produk"]))
                         {
                             include 'tambah/tambah_produk.php';
                         }
                         else if(isset($_GET["edit_produk"]))
                         {
                             include 'edit/edit_produk.php';
                         }
                         else if(isset($_GET["hapus_produk"]))
                         {
                             include 'hapus/hapus_produk.php';
                         }
                         else if(isset($_GET["detail_produk"]))
                         {
                             include 'detail/detail_produk.php';
                         }

                        //  data ukuran produk
                         else if(isset($_GET["tambah_ukuran"]))
                         {
                             include 'tambah/tambah_ukuran.php';
                         }
                         //  Hapus Data ukuran produk
                         else if(isset($_GET["hapus_ukuran"]))
                         {
                             include 'hapus/hapus_ukuran.php';
                         }

                         //  data Warna produk
                         else if(isset($_GET["tambah_warna"]))
                         {
                             include 'tambah/tambah_warna.php';
                         }
                         //  Hapus Data Warna produk
                         else if(isset($_GET["hapus_warna"]))
                         {
                             include 'hapus/hapus_warna.php';
                         }


                           //  data Foto produk
                           else if(isset($_GET["tambah_foto"]))
                           {
                               include 'tambah/tambah_foto.php';
                           }
                            //  Hapus Data Foto produk
                         else if(isset($_GET["hapus_foto"]))
                         {
                             include 'hapus/hapus_foto.php';
                         }


                         // data pembelian
                         elseif(isset($_GET["pembelian"]))
                         {
                             include 'pembelian.php';
                         }

                          // data Pelanggan
                          elseif(isset($_GET["pelanggan"]))
                          {
                              include 'pelanggan.php';
                          }
                          else if(isset($_GET["hapus_pelanggan"]))
                         {
                             include 'hapus/hapus_pelanggan.php';
                         }

                        //  data Logout
                         elseif(isset($_GET["logout"]))
                         {
                             include 'logout.php';
                         }
                            // Halaman Detail pembayaran
                         else if(isset($_GET["detail_pembayaran"])){
                            include 'detail/detail_pembayaran.php';

                         }
                            // Halaman Pembayaran
                         else if(isset($_GET["pembayaran"])){
                            include 'pembayaran.php';

                         }
                            // Halaman hapus Pembayaran
                         else if(isset($_GET["hapus_pembayaran"])){
                            include 'hapus/hapus_pembayaran.php';

                         }
                            // Halaman Laporan
                         else if(isset($_GET["laporan_pembelian"])){
                            include 'laporan_pembelian.php';

                         }
                         
                    else{
                        include 'dashboard.php';
                    }
                    ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Rhamlat Gebok website</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Anda Yakin Ingin Keluar, klik <b>Logout</b> jika ingin keluar .</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="index.php?logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

     <!-- Page level plugins -->
     <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

    <!-- manambah tombol di produk -->
    <script>
        $(document).ready(function(){
            // tombol tambah Warna
           $(".btn-warna").on("click",function(){
            $(".input-warna").append("<input type='text' name='warna_produk[]' class='form-control' placeholder='Warna Produk'>");
           
        });
        // tombol tambah Ukuran
        $(".btn-ukuran").on("click",function(){
            $(".input-ukuran").append("<input type='text' name='ukuran_produk[]' class='form-control' placeholder='Ukuran Produk'>");
           
        });
        // tombol tambah Foto
        $(".btn-foto").on("click",function(){
            $(".input-foto").append("<input type='file' name='foto_produk[]' class='form-control'>");
           
        });

        });
    </script>

</body>

</html>