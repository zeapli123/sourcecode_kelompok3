<div class="shadow p-3 mb-3 bg-white rounded">
    <h5><b>Halaman Detail Pesan</b></h5>
</div>
<?php 

$id_pesan = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pesan WHERE id_pesan='$id_pesan'");
$pecah = $ambil->fetch_assoc();
// echo"<pre>";
// echo print_r($pecah);
// echo"</pre>";

?>
<div class="card shadow bg-white">
    <div class="card-body">

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Nama :</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?php echo $pecah['nama']?>" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Email :</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?php echo $pecah['email']?>" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Telepon :</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?php echo $pecah['telepon']?>" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Pesan :</label>
        <div class="col-sm-9">
           <textarea class="form-control" readonly><?php echo $pecah['isi_pesan']?></textarea>
        </div>
    </div>

    </div>
</div>