<?php

include '../config/koneksi.php';
$id_pembelian = $_GET['id'];


$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();

// mengamankan detail pembelian dari halaman pelanggan
// start
$idpembelian = $detail['id_pelanggan'];
$idpelanggan = $_SESSION['pelanggan']['id_pelanggan'];

if($idpembelian!==$idpelanggan){
    echo"<script>alert('Session Tidak ditemukan');</script>";
    echo"<script>location='profil.php?pesanan'</script>"; 

}
// end

// echo "<pre>";
// print_r($detail);
// echo "</pre>";
?>
<!-- <pre><?php print_r($detail);?></pre> -->

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
            <th>Data Pelanggan</th>
            <th>Data Pembelian</th>
            <th>Data Pengiriman</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
             
                    <P>Nama: <br><?php echo $detail['nama_pelanggan'];?> </P>
                  
                    <p>Email: <br><?php echo $detail['email_pelanggan'];?> </p>
                    <p>Telepon: <br><?php echo $detail['telepon_pelanggan'];?></p>
                </td>
                <td>
                    <P>No.Pembelian: <br><?php echo $detail['id_pembelian'];?> </P>
                    <p>Tanggal Pembelian: <br><?php echo date("d F Y", strtotime($detail['tanggal_pembelian'])); ?></p>
                    <p>Total Pembelian: <br>Rp. <?php echo number_format($detail['total_pembelian']);?></p>
                </td>
                <td>
                    <P>Alamat: <br><?php echo $detail['alamat'];?>  </P>
                    <p>Ekspedisi: <br><?php echo $detail['ekspedisi'];?> <?php echo $detail['estimasi'];?> hari</p>
                    <p>Ongkir: <br>Rp. <?php echo number_format($detail['ongkir']);?></p>
                </td>
            </tr>
        </tbody>
    </table>
    <?php 
    
   $pp = array();
   $ambil  = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$id_pembelian' ");
   while($pecah = $ambil->fetch_assoc()){
    $pp[]=$pecah;
   }
    ?>
    <!-- <pre><?php print_r($pecah);?></pre> -->
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                
                <th>Subberat</th>
                <th>SubHarga</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($pp as $key => $value): ?>
            <tr>
                 <td><?php echo $key+1;?></td>
                 <td><?php echo $value['nama'];?></td>
                 <td>Rp.
                 <?php if(!empty($value['diskon_produk'])):?>
                    <?php echo number_format($value['harga_diskon']);?>
                    <?php else:?>
                    <?php echo number_format($value['harga']);?>
                    <?php endif?>
                </td>
                 <td><?php echo number_format($value['jumlah']);?></td>
                 <td><?php echo number_format($value['subberat']);?> Gr</td>
                 <td>Rp. 
                 <?php if(!empty($value['diskon_produk'])):?>

                    <?php echo number_format($value['harga_diskon']);?>
                    <?php else:?>
                    <?php echo number_format($value['subharga']);?>
                    <?php endif?>
                </td>
             </tr>
            <?php endforeach?>
        </tbody>
    </table>
<?php 
    $produk = array();
   $ambil  = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$id_pembelian' ");
   while($hancur = $ambil->fetch_assoc()){
    $produk[]=$hancur;
   }
   ?>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                
                <th>No</th>
                <th>Warna</th>
                <th>Ukuran</th>
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($produk as $key => $value): ?>
            <tr>
                <td><?php echo $key+1;?></td> 
                <td><?php echo $value['warna_produk'];?></td>
                <td><?php echo $value['ukuran_produk'];?></td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>
