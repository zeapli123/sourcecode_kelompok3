<h1 class="h3 mb-4 text-gray-800">Data Kategori Produk</h1>
<?php
$data_kategori_produk = array();

$ambil = $koneksi->query("SELECT * FROM kategori_produk");
while ($pecah = $ambil->fetch_assoc()) {
    $data_kategori_produk[] = $pecah;
}
?>
<div class="card shadow">
    <div class="card-header py-3">
        <a href="index.php?tambah_kategori_produk" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori Produk</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data_kategori_produk  as $key => $value): ?>
                <tr>
                    <td width="50"> <?php echo $key+1; ?></td>
                    <td >
                    <?php echo $value['nama_kategori_produk']; ?>
                    </td>
                    <td class="text-center" width="150">
                    <a href="index.php?edit_kategori_produk&id=<?php echo $value['id_kategori_produk']; ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="index.php?hapus_kategori_produk&id=<?php echo $value['id_kategori_produk']; ?>" class="btn btn-sm btn-danger">
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