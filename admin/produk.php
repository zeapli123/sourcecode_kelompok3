<h1 class="h3 mb-4 text-gray-800">Data Produk</h1>
<?php
$produk = array();
$ambil = $koneksi->query("SELECT * FROM produk");
while ($pecah = $ambil->fetch_assoc()) {
    $produk[] = $pecah;

}
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
                    <th>Harga</th>
                    <th>Berat</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($produk as $key => $value): ?>
                <tr>
                    <td width="50"><?php echo $key+1; ?></td>
                    <td >
                        <img src="../assets/foto_produk/<?php echo $value['foto_produk']; ?>" class="img-responsive" width="150">
                    </td>
                    <td><?php echo $value['nama_produk']; ?></td>
                    <td>Rp.  <?php if(!empty($value['diskon_produk'])):?>
                            <?php echo number_format($value['harga_diskon']); ?>
                            <?php else:?>
                            <?php echo number_format($value['harga_produk']); ?>
                            <?php endif?>
                     </td>
                    <td><?php echo number_format($value['berat_produk']); ?>Gr</td>
                    <td class="text-center" width="160">
                    <a href="index.php?detail_produk&id_produk=<?php echo $value['id_produk']; ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Detail
                    </a>
                    <a href="index.php?hapus_produk&id_produk=<?php echo $value['id_produk']; ?>" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        </div>
    </div>
</div>