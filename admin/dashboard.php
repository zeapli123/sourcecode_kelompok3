<?php
include '../config/koneksi.php';

$ambil = $koneksi->query("SELECT * FROM pelanggan");
$pecah1 = mysqli_num_rows($ambil);

$ambil = $koneksi->query("SELECT * FROM produk");
$pecah2 = mysqli_num_rows($ambil);

$ambil = $koneksi->query("SELECT * FROM pembelian");
 $total = 0;
while($pecah3 =$ambil->fetch_assoc()){
 $subtotal = $pecah3['total_pembelian'];
 $total += $subtotal; 
}

$ambil = $koneksi->query("SELECT * FROM pembayaran");
$pecah4 = mysqli_num_rows($ambil);

?>
<div class="shadow p-3 mb-3 bg-white rounded">
    <h5>Selamat Datang <strong><?php echo $_SESSION['admin']['nama_lengkap']?></strong> Anda Login Sebagai <strong>Administrator.</strong></h5>
</div>

 <!-- Content Row -->
 <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                      Produk Terjual</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($pecah4);?> Produk</div>
                </div>
                <div class="col-auto">
                    <i class="fa fa-shopping-cart fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                       Total Pendapatan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo (number_format($total)); ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Produk
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo number_format($pecah2);?> Produk</div>
                        </div>
                        <!-- <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar"
                                    style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-cubes fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                       Pelanggan </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($pecah1);?> Pelanggan</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Content Row -->