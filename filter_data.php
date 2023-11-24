<?php
include 'config/koneksi.php';
if(isset($_POST['min_price'])&& isset($_POST['max_price'])){
    $min_price = $_POST['min_price'];
    $max_price = $_POST['max_price'];

  $data_produk1=array();
$ambil = $koneksi->query("SELECT * FROM  produk WHERE harga_produk AND harga_produk BETWEEN '$min_price' AND '$max_price'");
while($pecah = $ambil->fetch_assoc()){
    $data_produk1 []= $pecah;
}

if(empty($pecah['harga_produk'])&& empty($pecah['harga_diskon']) == 0){
    echo "Sorry No Data Found";
}
  
}

?>
<div class="row">
  <?php foreach ($data_produk1 as $key => $value): ?>
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
                                    <p class="harga">Rp. <?php echo number_format( $value['harga_diskon']); ?></p>
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