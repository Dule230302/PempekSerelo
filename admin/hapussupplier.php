<?php
$koneksi->query("DELETE FROM supplier WHERE idsupplier='$_GET[id]'");

echo "<script>alert('Data Supplier Berhasil Di Hapus');</script>";
echo "<script>location='index.php?halaman=supplier';</script>";
