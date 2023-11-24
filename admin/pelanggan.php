
<h1 class="h3 mb-4 text-gray-800">Data Pelanggan</h1>
<?php

include '../config/koneksi.php';

$pelanggan = array();

$ambil = $koneksi->query("SELECT * FROM pelanggan");

while($pecah = $ambil->fetch_assoc()){

    $pelanggan[]=$pecah;
}

echo "<pre>";
print_r($pecah);
echo "</pre>";
?>
<div class="card shadow">
    <div class="card-header py-3">
        <a href="index.php?tambah_produk" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($pelanggan as $key => $value): ?>
                <tr>
                    <td width="50"><?php echo $key+1;?></td>
                    <td >
                        <img src="../assets/foto_pelanggan/<?php echo $value['foto_pelanggan'];?>" class="img-responsive" width="150">
                    </td>
                    <td> <?php echo $value['nama_pelanggan'];?></td>
                    <td><?php echo $value['email_pelanggan'];?></td>
                    <td><?php echo $value['telepon_pelanggan'];?></td>
                    <td class="text-center" width="150">
                    
                    <a href="index.php?hapus_pelanggan&id=<?php echo $value['id_pelanggan']?>" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </a>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
        </div>
    </div>
</div>