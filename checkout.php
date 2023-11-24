<?php
session_start();
include 'config/koneksi.php';
// $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

// jika tidak ada session pelanggan(blm login) maka dilarikan ke login.php

if(!isset($_SESSION['pelanggan'])){
echo"<script>alert('Silahkan Login');</script>";
echo"<script>location='login.php';</script>"; 
exit();
}

// jika keranjang kosong checkout tidak bisa
if (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) {
    echo "<script>alert('Keranjang Kosong, Silahkan Belanja');</script>";
    echo "<script>location='produk.php';</script>";
exit();
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
                        <li><a href="keranjang.php">keranjang</a></li>
                        <li>Checkout</li>
                    </ul>
                </div>
                <!-- breadcrumb end -->
                <div class="col-md-12 keranjang">

                    <!-- card-box start -->
                    <div class="card-box">
                    <h2>Checkout Belanja Anda</h2>
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
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    <?php $total = 0; ?>
                                    <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah):
                                         $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                         $pecah = $ambil->fetch_assoc();
                                         if(!empty($pecah['diskon_produk'])){
                                        
                                            $subtotal = $pecah['harga_diskon'] * $jumlah;
                                       
                                         }  else{
                                             $subtotal = $pecah['harga_produk'] * $jumlah;
                                         }
                                         $subberat= $pecah['berat_produk'] * $jumlah;
                                       
                                        //  echo "<pre>";
                                        //  print_r($pecah);
                                        //  echo"</pre>";
                                        ?>
                                       
                                        <?php
                                //       $ambil = $koneksi->query("SELECT * FROM warna WHERE id_produk='$id_produk'");
                                //   $mengan= $ambil->fetch_assoc();
                                       
                                      
                                        ?>
                                        <?php $total += $subtotal; ?>

                                        <tr>
                                            <td> <?php echo $no; ?></td>
                                            <td>
                                                <img src="assets/foto_produk/<?php echo $pecah['foto_produk']; ?>"
                                                    class="img-responsive" width="100">
                                            </td>
                                            <td>
                                                <?php echo $pecah['nama_produk']; ?>
                                            </td>
                                            <td>
                                             <?php echo $jumlah; ?>
                                                  
                                            </td>
                                            <td>Rp.
                                            <?php if(!empty($pecah['diskon_produk'])):?>
                                                    <?php echo number_format($subtotal); ?>
                                                     <?php else:?>
                                                    <?php echo number_format($subtotal); ?>
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
                                                <?php echo number_format($subtotal); ?>
                                            </td>
                                           
                                        </tr>
                                        <?php $no++; ?>
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
                    
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <input type="text" class="form-control" value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>"readonly>
                                        <br>
                                        <input type="text" class="form-control" value="<?php echo $_SESSION['pelanggan']['email_pelanggan']; ?>"readonly>
                                        <br>
                                        <input type="text" class="form-control" value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']; ?>"readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col -md-8">
                               <div class="card">
                                <div class="card-body">
                                    <form  method="post">

                                       <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Alamat :</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" name="alamat" class="form-control" placeholder="Masukan Alamat Rumah"></textarea>
                                        </div>
                                       </div>

                                       <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Provinsi :</label>
                                        <div class="col-sm-9">
                                            <select name="provinsi" class="form-control">
                                              
                                            </select>
                                        </div>
                                       </div>

                                       <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Distrik :</label>
                                        <div class="col-sm-9">
                                            <select name="distrik" class="form-control">
                                                
                                            </select>
                                        </div>
                                       </div>

                                        
                                       <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Ekspedisi :</label>
                                        <div class="col-sm-9">
                                            <select name="ekspedisi" class="form-control">
                                               
                                               
                                            </select>
                                        </div>
                                       </div>

                                        <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Paket :</label>
                                        <div class="col-sm-9">
                                            <select name="paket" class="form-control">
                                               
                                            </select>
                                        </div>
                                       </div>
                                        <input type="text" name="total_berat" class="form-control" value="<?php echo $subberat; ?>"hidden>

                                        <input type="text" name="nama_provinsi" class="form-control" hidden>
                                        <input type="text" name="nama_distrik" class="form-control" hidden>
                                        <input type="text" name="type_distrik" class="form-control" hidden>
                                        <input type="text" name="kode_pos" class="form-control" hidden>
                                        <input type="text" name="nama_ekspedisi" class="form-control" hidden>
                                        <input type="text" name="paket" class="form-control" hidden>
                                        <input type="text" name="ongkir" class="form-control" hidden>
                                        <input type="text" name="estimasi" class="form-control" hidden>

                                        <div class="text-right">
                                            <button name="checkout" class="btn btn-success"> Checkout</button>
                                        </div>
                                    </form>
                                </div>
                               </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- content end -->

<?php
if(isset($_POST['checkout']))
{
    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
    $tanggal_pembelian = date('y-m-d');
    $alamat = $_POST['alamat'];
    $berat = $_POST['total_berat'];
    $provinsi = $_POST['nama_provinsi'];
    $distrik = $_POST['nama_distrik'];
    $type = $_POST['type_distrik'];
    $pos = $_POST['kode_pos'];
    $ekspedisi = $_POST['nama_ekspedisi'];
    $paket= $_POST['paket'];
    $ongkir = $_POST['ongkir'];
    $estimasi= $_POST['estimasi'];
    $total_pembelian = $total+$ongkir;

    $koneksi->query("INSERT INTO pembelian (id_pelanggan,tanggal_pembelian,total_pembelian,alamat,total_berat,provinsi,distrik,type,kode_pos,ekspedisi,paket,ongkir,estimasi) 
    VALUES('$id_pelanggan','$tanggal_pembelian','$total_pembelian','$alamat','$berat','$provinsi','$distrik',
    '$type','$pos','$ekspedisi','$paket','$ongkir','$estimasi')");

$id_pembelian_baru = $koneksi->insert_id;

foreach ($_SESSION['keranjang'] as $id_produk => $jumlah){
    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
    $pecah = $ambil->fetch_assoc();
    $nama = $pecah['nama_produk'];
    $harga = $pecah['harga_produk'];
    $berat= $pecah['berat_produk'];
   $subberat = $pecah['berat_produk']*$jumlah;
   $subharga = $pecah['harga_produk']*$jumlah;


$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah)
VALUES('$id_pembelian_baru','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");

$koneksi->query("UPDATE produk SET stok_produk=stok_produk-$jumlah
WHERE id_produk='$id_produk'");
}
unset($_SESSION['keranjang']);
echo"<script>alert('Pembelian Sukses');</script>";
echo"<script>location='pelanggan/profil.php?pesanan';</script>";  
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