<?php
include '../config/koneksi.php';
$id_pembelian = $_GET['id'];


$ambil = $koneksi->query("SELECT * FROM pembelian WHERE pembelian.id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();

?>
<center>
    <h2>Mohon Konfirmasi Pembayaran anda</h2>
</center>
<hr>
<div class="card-header">
    <h5>Total Pembayaran: Rp. <?php echo number_format($detail['total_pembelian'])?></h5>
</div>
<p>
    Bank BRI
    <br>No. Rekening: 123 123 1234 1234 
</p>

<hr>
<p>Petunjuk</p>
<li>Silahkan melakukan pembayaran ke virtual account di atas</li>
<li>Setelah berhasil melakukan pembayaran</li>
<li>Beritahu kami dengan dengan cara mengisi formulir dan kirimkan bukti pembayaran</li>
<hr>
<form  method="post" enctype="multipart/form-data">
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Nama lengkap :</label>
        <div class="col-sm-8">
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Transfer Bank :</label>
        <div class="col-sm-8">
           <select name="bank" class="form-control">
            <option selected disabled>Pilih Metode Pembayaran</option>
            <option value="bri">BRI</option>
            <option value="bca">BCA</option>
            <option value="btn">BTN</option>
            <option value="mandiri">Mandiri</option>
           </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Jumlah :</label>
        <div class="col-sm-8">
            <input type="text" name="jumlah" class="form-control" value="<?php echo number_format($detail['total_pembelian'])?>"readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Foto Bukti :</label>
        <div class="col-sm-8">
            <input type="file" name="bukti" class="form-control" required>
            <small class="text-danger">Foto bukti harus jpg/png max ukuran 2mb</small>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label"></label>
        <div class="col-sm-8">
          <button name="kirim" class="btn btn-primary">Kirim</button>
        </div>
    </div>
</form>
<?php
if(isset($_POST["kirim"])){
    $nama = $_POST['nama'];
    $bank = $_POST['bank'];
    $jumlah = $_POST['jumlah'];
    $tanggal = date('Y-m-d');

   $nama_bukti =  $_FILES['bukti']['name'];
    $lokasi_bukti =$_FILES['bukti']['tmp_name'];
    $tgl_bukti = date('YmdHis').$nama_bukti;


    move_uploaded_file($lokasi_bukti, "../assets/foto_bukti/".$tgl_bukti);

// menyimpan ke table pembayaran
    $koneksi->query("INSERT INTO pembayaran (id_pembelian,nama,bank,jumlah,tanggal,bukti)VALUES ('$id_pembelian','$nama','$bank','$jumlah','$tanggal','$tgl_bukti')");

    // update table pembelian
    $koneksi->query("UPDATE pembelian SET status ='sedang di proses'WHERE id_pembelian='$id_pembelian'");

    echo"<script>alert('Pembayaran Terkirim');</script>";
    echo"<script>location='profil.php?pesanan'</script>"; 

}

?>