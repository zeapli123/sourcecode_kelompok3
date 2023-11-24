<?php
 session_start();
$active = 'Home';

// koneksi
include('config/koneksi.php');

// data foto banner

$data_banner = array();
$ambil = $koneksi->query("SELECT * FROM banner");
while($pecah = $ambil->fetch_assoc()){
    $data_banner[] = $pecah;
}

// data produk
$data_produk = array();
$ambil = $koneksi->query("SELECT * FROM produk LIMIT 8");

while($pecah = $ambil->fetch_assoc()){
$data_produk [] = $pecah;
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
    <!-- style css -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- style filter css -->
    <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
</head>
<body>

<?php
include 'includes/header.php';

?>

    <!-- owl-carousel banner start -->
        <div id="banner">
            <div class="container">
                <div class="owl-nav"></div>
                    <div class="owl-carousel owl-theme">

                    <?php foreach ($data_banner as $key => $value): ?>  
                    <div class="item">
                        <img src="assets/foto_banner/<?php echo $value['foto_banner']; ?>">
                    </div>
                    <?php endforeach?>

                    </div>
            </div>
        </div>
    <!-- owl-carousel banner end -->

<!-- advantags start -->
    <div id="advantags">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card-box">
                        <div class="icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>kami mencintai pelanggan kami</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div>

                <div class="col-md-4">
                <div class="card-box">
                        <div class="icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <h3>harga Terbaik</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div>

                <div class="col-md-4">
                <div class="card-box">
                        <div class="icon">
                            <i class="fas fa-thumbs-up"></i>
                        </div>
                        <h3>100% Produk Original</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- advantags end -->

    <!-- terbaru start -->
    <div id="terbaru">
        <div class="col-md-12">
            <div class="card-box">
                <h2>Produk Terbaru</h2>
            </div>
        </div>
    </div>
    <!-- terbaru end -->

    <!-- content card-produk start -->
        <div id="content">
            <div class="container">
                <div class="row">

                <?php foreach ($data_produk as $key => $value): ?>
                    <div class="col-md-3">
                        <div class="card-produk">
                            <a href="detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>">
                                <img src="assets/foto_produk/<?php echo $value['foto_produk']; ?>" class="img-responsive">
                            </a>
                            
                            <?php if(!empty($value['diskon_produk'] && empty($value['stok_produk']==0))):?>
                            <div class="diskon">
                                <h6>Super</h6>
                            </div>
                            <div class="diskon-off">
                                <h6><font color="red"><?php echo $value['diskon_produk']; ?>%</font><br>Off</h6></h6>
                            </div>
                            <?php elseif(!empty($value['stok_produk']==0)):?>
                                <div class="diskon-off" style="background-color: #ff2424;color:#fff;">
                                <h6><font color="#fff">Sold</font><br>Out</h6></h6>
                            </div>
                             <?php else:?>
                                <div class="diskon-off" style="background-color: #3cb371;color:#fff;">
                                <h6>Sale</h6>
                            </div>
                            <?php endif?>

                            <div class="text">
                                <a href="detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>">
                                    <h3><?php echo $value['nama_produk']; ?></h3>
                                </a>
                                <?php if(!empty($value['diskon_produk'])):?>
                                    <p class="harga">Rp. <?php echo number_format($value['harga_diskon']); ?></p>
                                    <?php else:?>
                                    <p class="harga">Rp. <?php echo number_format($value['harga_produk']); ?></p>
                                    <?php endif?>
                                
                                <p class="button">
                                    <a href="detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>" class="btn btn-light">Detail Produk</a>     
                                    <a href="beli.php?idproduk=<?php echo $value['id_produk']; ?>" class="btn btn-primary">
                                        <i class="fas fa-shopping-cart"></i> Keranjang
                                    </a>     
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach?>

                </div>
            </div>
        </div>
    <!-- content card-produk  end -->

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