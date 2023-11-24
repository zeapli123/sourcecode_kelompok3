<h1 class="h3 mb-4 text-gray-800">Data Pembelian</h1>
<?php

include '../config/koneksi.php';



// echo "<pre>";
// print_r($mengan);
// echo "</pre>";

$pembelian = array();
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
ON pembelian.id_pelanggan=pelanggan.id_pelanggan  WHERE pembelian.id_pelanggan ");
while($pecah = $ambil->fetch_assoc()){

    $pembelian[]=$pecah;
}



// echo "<pre>";
// print_r($pembelian);
// echo "</pre>";
?>
<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                   
                 
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Total Pembelian</th>
                    <th>Status</th>
                    <th>Opsi</th>
                    
                </tr>
            </thead>
            <tbody>
          
                <?php foreach ($pembelian as $key => $value):?>
                
                <tr>
                        <td>
                            <?php echo$key+1; ?>
                        </td>
                        <td>
                            <?php echo $value['nama_pelanggan']; ?>
                        </td>
                        <td>
                            <?php echo date("d F Y", strtotime($value['tanggal_pembelian'])); ?>
                        </td>
                        <td>Rp.
                            <?php echo number_format($value['total_pembelian']) ?>
                        </td>
                        <td>
                            <?php echo $value['status']; ?>
                        </td>
                           
                        <td class="text-center" width="250">
                            <a href="index.php?detail_pembayaran&id=<?php echo $value['id_pembelian']?>" class="btn btn-sm btn-info">
                            Detail</a>

                            <!-- jika status tidak pending -->
                            <?php  if($value['status']!=='pending'):?>
                            <a href="index.php?pembayaran&id=<?php echo $value['id_pembelian']?>" class="btn btn-sm btn-success">
                              Lihat Pembayaran </a>
                        <?php  endif  ?>

                        <?php if($value['status']=='pengiriman dibatalkan'):?>
                        <a href="index.php?hapus_pembayaran&id=<?php echo $value['id_pembelian'];?>" class="btn btn-sm btn-danger">  <i class="fas fa-trash"></i></a>
                        <?php  endif  ?>

                        </td>
                    </tr>
                    
                <?php endforeach?>
              
                
            </tbody>
                </table>
       
        </div>
    </div>
</div>
      

   