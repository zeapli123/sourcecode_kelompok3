<center>
    <h2>
        Pesanan Saya
    </h2>
    <p class="text-muted">Jika anda memiliki Pertanyaan, jangan ragu untuk 
    <a href="../kontak.php"> Menghubungi Kami</a>
    . Layanan untuk Pelanggan Kami bekerja sampai 24 jam.</p>
</center>
<?php

include '../config/koneksi.php';

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$pembelian = array();
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pelanggan='$id_pelanggan'");
while ($pecah = $ambil->fetch_assoc()) {   
    $pembelian[] = $pecah;
}

?>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">

    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($pembelian as $key => $value): ?>
        <tr>
            <td>
                <?php echo $key+1; ?>
            </td>
            <td>
                <?php echo date("d F Y", strtotime($value['tanggal_pembelian'])); ?>
            </td>
            <td>
            Rp. <?php echo number_format($value['total_pembelian']); ?>
            </td>
            
            <!-- mengubah warna proses pengiriman -->
            <!-- start -->
            <?php if($value['status']=='pending'):?>
                <td class="text-center text-danger">
                    <?php echo $value['status']; ?><br>
    
                    <!-- jika resi pengiriman tidak kosong -->
                    <?php if(!empty($value['resi_pengiriman'])):?>
                        <?php echo $value['resi_pengiriman']; ?>
                        <?php endif?>
                        
                </td>
                <?php elseif($value['status']=='sedang di proses'):?>
                <td class="text-center text-warning">
                    <?php echo $value['status']; ?><br>
    
                    <!-- jika resi pengiriman tidak kosong -->
                    <?php if(!empty($value['resi_pengiriman'])):?>
                        <?php echo $value['resi_pengiriman']; ?>
                        <?php endif?>
                        
                </td>
                <?php elseif($value['status']=='pengiriman dibatalkan'):?>
                <td class="text-center text-danger">
                    <?php echo $value['status']; ?><br>
                    <!-- jika resi pengiriman tidak kosong -->
                    <?php if(!empty($value['resi_pengiriman'])):?>
                        <?php echo $value['resi_pengiriman']; ?>
                        <?php endif?>  
                </td>
            <?php else:?>
                <td class="text-center text-success">
                
                <?php echo $value['status']; ?><br>

                <!-- jika resi pengiriman tidak kosong -->
                <?php if(!empty($value['resi_pengiriman'])):?>
                    <?php echo $value['resi_pengiriman']; ?>
                    <?php endif?>
              
            </td>
            <?php endif?>
                    <!-- end -->

            <td class="text-center" width="250px">
                <a href="profil.php?detail_pesanan&id=<?php echo $value['id_pembelian'];?>" class="btn btn-sm btn-info">Nota</a>
                <!--  jika statusnya pending  -->
               <?php if($value['status']=='pending'):?>

                <a href="profil.php?bayar&id=<?php echo $value['id_pembelian'];?>" class="btn btn-sm btn-primary">Input Pembayaran</a>
                
              <?php elseif($value['status']=='barang sudah sampai tujuan'):?>
                <a href="profil.php?hapus_pembayaran&id=<?php echo $value['id_pembelian'];?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
              
                <?php else: ?>
                <a href="profil.php?detail_pembayaran&id=<?php echo $value['id_pembelian'];?>" class="btn btn-sm btn-danger">Lihat Pembayaran</a>
                
               <?php endif; ?>

            </td>
        </tr>
        <?php endforeach?>
    </tbody>
    </table>
</div>