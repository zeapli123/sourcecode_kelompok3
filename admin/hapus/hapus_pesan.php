<?php
$id_pesan= $_GET['id'];
$koneksi->query("DELETE FROM pesan WHERE id_pesan='$id_pesan'");

echo"<script>alert('Pesan Berhasil Dihapus');</script>";
echo"<script>location='index.php?pesan';</script>";

// echo"<pre>";
// echo print_r($id_pesan);
// echo"</pre>";
?>