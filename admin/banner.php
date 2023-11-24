<h1 class="h3 mb-4 text-gray-800">Data Banner</h1>

<?php
$data_banner = array();
$ambil = $koneksi->query("SELECT * FROM banner");
while ($pecah = $ambil->fetch_assoc()) {
$data_banner[]= $pecah;
}
?>

<div class="card shadow">
    <div class="card-header py-3">
        <a href="index.php?tambah_banner" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto Banner</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data_banner as $key => $value): ?>
                <tr>
                    <td width="50"><?php echo $key+1; ?></td>
                    <td >
                        <img src="../assets/foto_banner/<?php echo $value['foto_banner']; ?>" class="img-responsive" width="250">
                    </td>
                    <td class="text-center" width="150">
                    <a href="index.php?edit_banner&id_banner=<?php echo $value['id_banner']; ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="index.php?hapus_banner&id_banner=<?php echo $value['id_banner']; ?>" class="btn btn-sm btn-danger">
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