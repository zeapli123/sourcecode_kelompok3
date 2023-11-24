<h1 class="h3 mb-4 text-gray-800">Data Pesan</h1>
<?php
$pesan = array();
$ambil = $koneksi->query("SELECT * FROM pesan");
while ($pecah = $ambil->fetch_assoc()) {
$pesan[] = $pecah;
}
?>
<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                   
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($pesan as $key => $value): ?>
                <tr>
                    <td width="50"> <?php echo $key+1; ?></td>
                    <td >
                    <?php echo $value['nama']; ?>
                    </td>
                    <td >
                    <?php echo $value['email']; ?>
                    </td>
                    <td >
                    <?php echo $value['telepon']; ?>
                    </td>
                    
                    
                    <td class="text-center" width="200">
                    <a href="index.php?detail_pesan&id=<?php echo $value['id_pesan']; ?>" class="btn btn-sm btn-primary">
                        Lihat Pesan
                    </a>
                    <a href="index.php?hapus_pesan&id=<?php echo $value['id_pesan']; ?>" class="btn btn-sm btn-danger">
                        </i> Hapus
                    </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
