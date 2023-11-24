<?php
session_start();
include 'config/koneksi.php';
$active = 'Keranjang';


// echo "<pre>";
//         print_r($_SESSION['keranjang']);
//         echo"</pre>";

// echo "<pre>";
//         print_r($_SESSION['keranjang']);
//         echo"</pre>";
if (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) {
    echo "<script>alert('Keranjang Kosong, Silahkan Belanja');</script>";
    echo "<script>location='produk.php';</script>";
}

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
      <!-- Custom styles for this page -->
      <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- style css -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
<?php include 'includes/header.php';?>


    <!-- content start -->
    <div id="content">
        <div class="container">
            <div class="row">
                <!-- breadcrumb start -->
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li>Keranjang</li>
                    </ul>
                </div>
                <!-- breadcrumb end -->
                <div class="col-md-12 keranjang">

                    <!-- card-box start -->
                    <div class="card-box">
                        <h2>Keranjang Belanja</h2>
                        <?php if(empty($_SESSION['keranjang'])):?>
                            <p class="text-muted">anda Mempunyai (0) items di dalam keranjang </p>
                            <?php else:?>
                                <?php
                                $items = 0;
                                    foreach($_SESSION['keranjang']as $id_produk =>$jumlah){
                                        $items++;
                                    }
                                    ?>
                                    <p class="text-muted">anda Mempunyai (<?php echo $items;?>) items di dalam keranjang </p>
                        <?php endif;?>

                        
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th >No</th>
                                        <th >Foto</th>
                                        <th >produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Ukuran</th>
                                        <th>Warna</th>
                                        <th>Subtotal</th>
                                        <th>option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    <?php $total = 0; ?>
                                    <?php 
                                    foreach($_SESSION['keranjang'] as $id_produk => $jumlah):
                                        $ambil = $koneksi->query("SELECT * FROM produk  WHERE produk.id_produk='$id_produk'");
                                        $pecah = $ambil->fetch_assoc();
                                       if(!empty($pecah['diskon_produk'])){
                                        
                                           $subtotal = $pecah['harga_diskon'] * $jumlah;
                                      
                                        }  else{
                                            $subtotal = $pecah['harga_produk'] * $jumlah;
                                        }
                                        $total += $subtotal; 
                                        //    echo "<pre>";
                                        //  print_r($pecah);
                                        //  echo"</pre>";
                                        ?>
                           
                                        <tr>
                                            <td> <?php echo $no++; ?> </td>
                                                <td>
                                                    <img src="./assets/foto_produk/<?php echo $pecah['foto_produk']; ?>" class="img-responsive" width="100">
                                                </td>
                                                <td>
                                                    <?php echo $pecah['nama_produk']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $jumlah; ?>
                                        
                                                </td>
                                                <td>Rp.
                                                    <?php if(!empty($pecah['diskon_produk'])):?>
                                                    <?php echo number_format($pecah['harga_diskon']); ?>
                                                    <?php else:?>
                                                    <?php echo number_format($pecah['harga_produk']); ?>
                                                     

                                                   <?php endif?>
                                                </td>
                                                  
                                                <td>
                                        
                                                    <?php echo $pecah['ukuran_produk']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $pecah['warna_produk']; ?>
                                        
                                                </td>
                                                <td>
                                                    Rp.
                                                    <?php if(!empty($pecah['diskon_produk'])):?>
                                                    <?php echo number_format($subtotal); ?>
                                                     <?php else:?>
                                                    <?php echo number_format($subtotal); ?>
                                                          <?php endif?>
                                                </td>
                                                <td>
                                                    <a href="edit_detail_produk.php?idproduk=<?php echo $id_produk; ?>" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-redo-alt"></i>
                                                    </a>
                                                    <a href="hapus_keranjang.php?idproduk=<?php echo $id_produk; ?>" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                       
                                        
                                        <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7">Total</th>
                                        <th colspan="2">Rp.
                                            <?php echo (number_format($total)); ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- card-box end -->
                    <div class="card-footer shadow">
                        <div class="row">
                            <div class="col">
                                <a href="produk.php" class="btn btn-light">
                                    <i class="fas fa-chevron-left"></i> Lanjut Belanja
                                </a>
                            </div>
                            <div class="col text-right">
                                <a href="checkout.php" class="btn btn-primary">
                                    Checkout <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                                // data  produk
                $data_produk = array();
                $ambil = $koneksi->query("SELECT * FROM produk ");
                while ($bubar = $ambil->fetch_assoc()) {

                $data_produk[] = $bubar;

                } 
                ?>
                <div class="col-md-12 page-produk">
                   <!-- produk-slide start -->
                   <div id="produk-slide">
                         <div class="card-box mt-3">
                            <center>

                                <h2>Produk Lainnya</h2>
                            </center>
                            </div> 
                           <div class="slide">
                               <div class="nav-slide"> </div>
                                   <div class="owl-carousel">
        
                                   <?php foreach ($data_produk as $key => $value): ?>
                                       <div class="item">
                                           <a href="detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>">
                                               <img src="assets/foto_produk/<?php echo $value['foto_produk']; ?>" class="img-responsive">
                                           </a>
                                           <div class="text">
                                               <a href="detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>" >
                                               <h4><?php echo $value['nama_produk']; ?></h4>
                                               </a>
                                               <p class="harga">Rp. <?php echo number_format($value['harga_produk']); ?></p>
                                           </div>
                                       </div>
                                       <?php endforeach?>
        
                                   </div>
                              
                           </div>
                        
                         </div> 
                         <!-- produk-slide end -->
                </div>
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

      <!-- Page level plugins -->
      <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

</body>

</html>