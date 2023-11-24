<?php
session_start();
$active = 'Produk';

// koneksi
include 'config/koneksi.php';




// Join data produk dengan data kategori

// jika ada id_kategori di url
if (isset($_GET['id_kategori'])) {
$id_kategori = $_GET['id_kategori'];

$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM  produk JOIN  kategori 
ON produk.id_kategori=kategori.id_kategori
WHERE produk.id_kategori='$id_kategori'");

while ($pecah = $ambil->fetch_assoc()) {
    $datakategori[] = $pecah;
}
}

// jika ada id_kategori_produk di url
elseif (isset($_GET['id_kategori_produk'])) {
    $id_kategori_produk = $_GET['id_kategori_produk'];

    $datakategoriproduk = array();
    $ambil = $koneksi->query("SELECT * FROM produk JOIN kategori_produk
    ON produk.id_kategori_produk=kategori_produk.id_kategori_produk
    WHERE produk.id_kategori_produk='$id_kategori_produk'");

    while ($pecah = $ambil->fetch_assoc()) {
        $datakategoriproduk[] = $pecah;
    }
}

// jika ada keyword di url
elseif (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    $cariproduk = array();
    $ambil = $koneksi->query("SELECT * FROM produk
    WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
    while($pecah = $ambil->fetch_assoc()){
        $cariproduk[] = $pecah;
    }

}
else{
    // data produk
$data_produk = array();
$ambil = $koneksi->query("SELECT * FROM produk");

while($pecah = $ambil->fetch_assoc()){
$data_produk [] = $pecah;
}
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

        <!-- content star -->
        <div id="content">
            <div class="container">
                <div class="row">
                    <!-- breadcrumb start -->
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="index.php">Home</a></li>
                            <li>Produk</li>
                            <?php if(isset($cariproduk)):?>
                                <li><?php echo $keyword;?></li>
                                <?php endif?>
                        </ul>
                    </div>
                    <!-- breadcrumb end -->

                    <!-- sidebar start -->
                    <div class="col-md-3">
                        <?php include 'includes/sidebar.php' ?>
                        <?php include 'includes/sidebar_filter.php' ?>
                    </div>
                    <!-- sidebar end -->

                    <!-- page-produk start -->
                    <div class="col-md-9 page-produk">
                   
                        <!-- card-box start -->
                        <div class="card-box">
                            <h1>Produk</h1>
                            <p>Produk kami dijamin barang 100% Original dan harga terjangkau. Jika and mempunyai pertanyaan silahkan  <a href="kontak.php">Hubungi Kami</a>. <strong>
                                Online Shop
                            </strong> Kami melayani Pelanggan selama 24 jam. </p>
                        </div>
                         <!-- card-box end -->
                         <div id="searchResults" class="search-results-block">
                         <!--row page-produk start -->
                         <div class="row">

                         <!-- jika ada id_kategori di url-->
                         <?php if(isset($_GET['id_kategori'])): ?>
                            
                            <?php foreach ($datakategori as $key => $value): ?>
                               <div class="col-md-4 single" >
                                   <div class="card-produk">
                                 
                               <a href="detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>">
                                   <img src="assets/foto_produk/<?php echo $value['foto_produk']; ?>" class="img-responsive">
                               </a>
                               
                               <!-- pengeditan produk start-->
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
                               
                               <!-- jika ada id_kategori_produk  -->
                               <?php elseif(isset($_GET['id_kategori_produk'])): ?>
                                
                                <?php foreach ($datakategoriproduk as $key => $value): ?>
                                   <div class="col-md-4 single" >
                                       <div class="card-produk">
                                       
                                   <a href="detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>">
                                       <img src="assets/foto_produk/<?php echo $value['foto_produk']; ?>" class="img-responsive">
                                   </a>
                                  <!-- pengeditan produk start-->
                                   <?php if(!empty($value['diskon_produk']&& empty($value['stok_produk']==0))):?>
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

                                    <!-- jika ada keyword di url -->
                                    <?php elseif(isset($_GET['keyword'])): ?>
                                <?php foreach ($cariproduk as $key => $value): ?>
                                   <div class="col-md-4 single" >
                                       <div class="card-produk">
                                       
                                   <a href="detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>">
                                       <img src="assets/foto_produk/<?php echo $value['foto_produk']; ?>" class="img-responsive">
                                   </a>

                                   <!-- pengeditan produk start-->
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

                                   <!-- jika pencarian produk tidak ditemukan  -->
                                   <?php if(empty($cariproduk)):?>
                                    <div class="col-md-12">
                                        <div class="alert alert-danger shadow">
                                        <p>Produk <strong><?php echo $keyword; ?></strong> tidak ditemukan</p>
                                        </div>
                                    </div>
                                    <?php endif?>

                            <!-- jika tidak ada id_kategori/id_kategori_produk di url -->
                            <?php else: ?>
                                <!-- jika tidak ada id_kategori/id_kategori_produk di url -->
                                <!-- maka akan tampil data produk di di bawah -->
                                
                                <?php foreach ($data_produk as $key => $value): ?>
                                   <div class="col-md-4 single" >
                                       <div class="card-produk">
                                       
                                   <a href="detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>">
                                       <img src="assets/foto_produk/<?php echo $value['foto_produk']; ?>" class="img-responsive">
                                   </a>

                                   <!-- pengeditan produk start-->
                                   <?php if(!empty($value['diskon_produk']&& empty($value['stok_produk']==0))):?>
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

                                <!-- penutup if -->
                                <?php endif ?>

                         </div>
                         </div>
                           <!-- row page-produk end -->

                                    <!-- jika ada data produk, maka pagination akan muncul -->

                                        <?php if(!empty($cariproduk) OR !empty($data_produk)): ?>

                                            <!-- pagination start -->
                                            <div class="pagination justify-content-center">
                                             <li class="page-item prev disabled">
                                                 <a href="#" class="page-link">Prev</a>
                                             </li>
                                             <li class="page-item halaman">
                                                 <a href="#" class="page-link active">1</a>
                                             </li>
                                             <li class="page-item dots">
                                                 <a href="#" class="page-link ">...</a>
                                             </li>
                                             <li class="page-item halaman">
                                                 <a href="#" class="page-link ">5</a>
                                             </li>
                                             <li class="page-item halaman">
                                                 <a href="#" class="page-link ">6</a>
                                             </li>
                                             <li class="page-item dots">
                                                 <a href="#" class="page-link ">...</a>
                                             </li>
                                             <li class="page-item halaman">
                                                 <a href="#" class="page-link ">10</a>
                                             </li>
                                             <li class="page-item next">
                                                 <a href="#" class="page-link">Next</a>
                                             </li>
                                            </div>
                                            <!-- pagination end -->
                                            
                                            <?php elseif(!empty($datakategori) OR !empty($datakategoriproduk)): ?>
                                                
                                                <!-- pagination start -->
                                                <div class="pagination justify-content-center">
                                                 <li class="page-item prev disabled">
                                                     <a href="#" class="page-link">Prev</a>
                                                 </li>
                                                 <li class="page-item halaman">
                                                     <a href="#" class="page-link active">1</a>
                                                 </li>
                                                 <li class="page-item dots">
                                                     <a href="#" class="page-link ">...</a>
                                                 </li>
                                                 <li class="page-item halaman">
                                                     <a href="#" class="page-link ">5</a>
                                                 </li>
                                                 <li class="page-item halaman">
                                                     <a href="#" class="page-link ">6</a>
                                                 </li>
                                                 <li class="page-item dots">
                                                     <a href="#" class="page-link ">...</a>
                                                 </li>
                                                 <li class="page-item halaman">
                                                     <a href="#" class="page-link ">10</a>
                                                 </li>
                                                 <li class="page-item next">
                                                     <a href="#" class="page-link">Next</a>
                                                 </li>
                                                </div>
                                                <!-- pagination end -->
                                                
                                                
                                                <!-- selain itu jika tidak ada data produk, maka pagination tidak muncul -->
                                                
                                                <?elseif(empty($cariproduk)): ?>
                                                    
                                                    
                                                    <?php endif?>
                                                    
                                                    
                                               
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

    <!--ui filter -->
    <script src="assets/js/jquery-ui.min.js"></script>

    <!-- bagian filter price -->
    <script >
    $(document).ready(function () {
    
    function filterProducts(){
        $("#searchResults").html("<p>loading...</p>");
      var min_price =$("#min_price").val();
      var max_price =$("#max_price").val();
      // alert(min_price + max_price);

      $.ajax({
          url:"filter_data.php",
          type:"POST",
          data:{min_price:min_price,max_price:max_price},
          success:function (data) {

              $("#searchResults").html(data);
          }
      });
    }
    $("#min_price, #max_price").on('keyup',function(){
        filterProducts();   
    });
      $("#slider-range").slider({
        range: true,
        orientation: "horizontal",
        min: 0,
        max: 1000000,
        values: [0, 1000000],
        step: 100,

        slide: function (event, ui) {
          if (ui.values[0] == ui.values[1]) {
              return false;
          }
          
          $("#min_price").val(ui.values[0]);
          $("#max_price").val(ui.values[1]);
            filterProducts();
        }
      });

      $("#min_price").val($("#slider-range").slider("values", 0));
      $("#max_price").val($("#slider-range").slider("values", 1));
    });

    </script>
</body>

</html>
