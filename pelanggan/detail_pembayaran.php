<div class="shadow bg-white p-3 mb-3 rounded">
    <h5><strong> Detail Pembayaran</strong></h5>
</div>

<?php
include '../config/koneksi.php';
$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembayaran JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembayaran.id_pembelian='$id_pembelian'");
$pecah = $ambil->fetch_assoc();

// jika pelanggan belum melakukan pembayaran
if(empty($pecah)){
    echo"<script>alert('Belum ada data Pembayaran');</script>";
    echo"<script>location='profil.php?pesanan';</script>"; 
}

// jika data pembayaran tidak sesuai dengan yang bayr atau yang login 
if($_SESSION['pelanggan']['id_pelanggan']!==$pecah['id_pelanggan']){
    echo"<script>alert('session tidak ditemukan');</script>";
    echo"<script>location='profil.php?pesanan';</script>"; 
}
?>
<!-- <pre><?php print_r($pecah);?></pre> -->

<div class="alert alert-primary shadow text-dark">
Total tagihan anda : Rp. <?php echo number_format($pecah ['total_pembelian']);?>

</div>

<div class="shadow bg-white p-3 mb-3 rounded">
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td><?php echo $pecah['nama']?></td>
                    </tr>
                    <tr>
                        <th>Bank</th>
                        <td><?php echo $pecah['bank']?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>Rp. <?php echo number_format($pecah['total_pembelian']);?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?php echo date("d F Y", strtotime($pecah['tanggal']))?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <img src="../assets/foto_bukti/<?php echo $pecah['bukti']?>" width="250" class="img-thumbnail img-responsive">
        </div>
    </div>
</div>