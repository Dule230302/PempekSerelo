<?php
$koneksi->query("DELETE FROM stok WHERE idstok='$_GET[id]'");

echo "<script>alert('Data Stok Berhasil Di Hapus');</script>";
echo "<script>location='index.php?halaman=stok';</script>";
