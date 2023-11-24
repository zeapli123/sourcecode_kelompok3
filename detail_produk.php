<?php
session_start();
include 'config/koneksi.php';

$id_produk = $_GET['idproduk'];
$active = 'Produk';



if(isset($_POST['beli'])){
 
 // mendapatkan jumlah yang diinputkan
 $jumlah = $_POST['jumlah'];
 
 $ukuran = $_POST['ukuran'];
 $warna = $_POST['warna'];

 // update ukuran dan warna
 $koneksi->query("UPDATE produk SET ukuran_produk ='$ukuran',warna_produk = ' $warna' WHERE id_produk='$id_produk'");
 

 $_SESSION['keranjang'][$id_produk]=$jumlah;
 
 // masukan ke keranjang belanja
  echo"<script>alert('Produk masuk ke keranjang');</script>";
   echo"<script>location='keranjang.php'</script>"; 
 

    //  echo "<pre>";
    //  print_r($_SESSION['keranjang']);
    //  echo"</pre>";
 }



// data foto produk
$data_foto = array();
$ambil = $koneksi->query("SELECT * FROM foto JOIN produk ON foto.id_produk=produk.id_produk WHERE foto.id_produk='$id_produk'");
while ($pecah = $ambil->fetch_assoc()) {

$data_foto[] = $pecah;

}

// data Ukuran produk
$data_ukuran = array();
$ambil = $koneksi->query("SELECT * FROM ukuran WHERE id_produk='$id_produk'");
while ($pecah = $ambil->fetch_assoc()) {

$data_ukuran[] = $pecah;

}

// data Warna produk
$data_warna = array();
$ambil = $koneksi->query("SELECT * FROM warna  WHERE id_produk='$id_produk'");
while ($pecah = $ambil->fetch_assoc()) {

$data_warna[] = $pecah;

}

// data  produk
$data_produk = array();
$ambil = $koneksi->query("SELECT * FROM produk ");
while ($pecah = $ambil->fetch_assoc()) {

$data_produk[] = $pecah;

}

// data produk
$dataproduk = array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
while ($pecah = $ambil->fetch_assoc()){
    $dataproduk[] = $pecah;
}

// echo "<pre>";
//         print_r($_SESSION['keranjang']);
//         echo"</pre>";
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
       $produk= $ambil->fetch_assoc();
       
    //    echo "<pre>";
    //    print_r($produk);
    //    echo"</pre>";


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
     <!-- style filter css -->
    <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
</head>
<body>
      <!-- navbar start-->
      <?php include 'includes/header.php';?>
    <!-- navbar end-->
    
<section class="page-produk">
          <!-- content star -->
          <div id="content">
            <div class="container">
                <div class="row">
                    <!-- breadcrumb start -->
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="produk.php">Produk</a></li>
                            <li>Detail Produk</li>
                        </ul>
                    </div>
                    <!-- breadcrumb end -->

                    <!-- sidebar start -->
                    <div class="col-md-3">
                        <?php include 'includes/sidebar.php' ?>
                    </div>
                    <!-- sidebar end -->

                    <!-- col-md-9 page-produk start -->
                    <div class="col-md-9 page-produk">

                        <!-- detail_produk start -->
                        <div id="detail-produk" class="row">
                            
                            <!-- col-md-6 start -->
                            <div class="col-md-6">
                                <div class="img-big">
                                    <div class="nav-big"></div>
                                    <div class="owl-carousel">
                                   
                                    <?php foreach ($data_foto as $key => $value): ?>
                                        <div class="item">
                                            <img src="assets/foto_produk/<?php echo $value['nama_foto']; ?>" class="img-responsive mt=3" data-hash="<?php echo $value['id_foto']; ?>">
                                        </div>
                                        <?php endforeach?>

                                    </div>
                                </div>
                               
                                <!-- img-small start -->
                               
                                <div class="img-small ">
                                <div class="owl-carousel">

                                <?php foreach ($data_foto as $key => $value): ?>
                                    <div class="item">
                                        <a href="#<?php echo $value['id_foto']; ?>">
                                            <img src="assets/foto_produk/<?php echo $value['nama_foto']; ?>" class="img-responsive " >
                                        </a>
                                    </div>
                                    <?php endforeach?>

                                </div>
                            </div>
                            
                            <!-- img-small end -->

                            </div>
                            <!-- col-md-6 end -->
                           

                            <!-- col-md-6 start -->
                            <div class="col-md-6">
                                <div class="card-box">
                                    <?php foreach ($dataproduk as $key => $value): ?>
                                    <h2><?php echo $value['nama_produk']; ?></h2>
                                    <?php endforeach?>
                                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                        
                                        <div class="form-group row" >
                                            <label class="col-sm-5 col-form-label">Jumlah Produk :</label>
                                            <div class="col-sm-7">
                                                <input type="number" name="jumlah" class="form-control" max="<?php echo $produk['stok_produk']; ?>"  min="1" value="1">
                                            </div>
                                        </div>
                                        <div class="form-group row" >
                                            <label class="col-sm-5 col-form-label">Ukuran Produk :</label>
                                            <div class="col-sm-7">
                                                <select  name="ukuran" class="form-control" required>
                                                    <option selected disabled>Pilih Ukuran</option>
                                                    <?php foreach ($data_ukuran as $key => $value): ?>
                                                    <option >
                                                    <?php echo $value['nama_ukuran']; ?>
                                                    </option>
                                                    <?php endforeach?>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" >
                                            <label class="col-sm-5 col-form-label">Warna Produk :</label>
                                            <div class="col-sm-7">
                                                <select  name="warna" class="form-control" required>
                                                    <option selected disabled>Pilih Warna</option>
                                                    <?php foreach ($data_warna as $key => $value): ?>
                                                    <option>
                                                    <?php echo $value['nama_warna']; ?>
                                                    </option>
                                                    <?php endforeach?>
                                                   
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row" >
                                            <label class="col-sm-5 col-form-label">Stok Produk :</label>
                                           
                                            <label class="col-sm-7 col-form-label">Tersisa <?php echo $produk['stok_produk']; ?> Buah :</label>
                                            
                                        </div>
                                        
                                        <div class="card-fasilitas">
                                            <?php if (!empty($produk['diskon_produk'])): ?>
                                                <?php foreach ($dataproduk as $key => $value): ?>
                                                    <p class="harga-diskon">Rp.<del>
                                                            <?php echo number_format($value['harga_produk']); ?>
                                                    </p>
                                                <?php endforeach ?>
                                            </div>
                                            <p class="harga"> Rp.<?php echo number_format($value['harga_diskon']); ?></p>
                                            
                                        <?php elseif (empty($produk['diskon_produk'])): ?>
                                            </div>
                                            <?php foreach ($dataproduk as $key => $value): ?>
                                                <p class="harga">Rp.
                                                    <?php echo number_format($value['harga_produk']); ?>
                                                </p>
                                            <?php endforeach ?>
                                        <?php endif?>      
                                           
                                        <p class="text-center">
                                            <button  class="btn btn-success" name="beli">
                                              <i class="fas fa-shopping-cart"></i>  Keranjang
                                        </button>
                                        </p>
                                    </form>
                                </div>
                            </div>
                            <!-- col-md-6 end -->
                            
                        </div>
                        <!-- detail-produk end -->

                         <!-- card-box start -->
                         <div class="card-box">
                            <h4>Detail Produk</h4>
                            <!-- input checkbox for readmore -->
                            <input type="checkbox" id="check-readmore">
                             <?php foreach ($dataproduk as $key => $value): ?>
                            <p class="description"> <?php echo $value['deskripsi_produk']; ?></p>
                              <?php endforeach?>
                                <!-- readmore button -->
                                <label for="check-readmore" class="button-readmore mb-3"></label>
                            <h4 >Ukuran Produk</h4>
                            <ul>

                            <?php foreach ($data_ukuran as $key => $value): ?>
                                <li><?php echo $value['nama_ukuran']; ?></li>
                                <?php endforeach?>
                               
                            </ul>
                            <h4>Warna Produk</h4>
                            <ul>
                            <?php foreach ($data_warna as $key => $value): ?>
                                <li><?php echo $value['nama_warna']; ?></li>
                                <?php endforeach?>
                                
                            </ul>
                        </div>
                        <!-- card-box end -->

                        <!-- produk-slide start -->
                       <div id="produk-slide">
                          <div class="card-box">
                            <h2>produk lainnya</h2>
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
                    <!-- col-md-9 page-produk end -->

                </div>
            </div>
        </div>
        <!-- content end -->
        </section>

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

        <!--ui filter -->
        <script src="assets/js/jquery-ui.min.js"></script>
</body>

</html>


  