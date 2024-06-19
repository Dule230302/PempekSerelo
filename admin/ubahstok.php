<?php
$produk = $koneksi->query("SELECT * FROM produk");

$ambil = $koneksi->query("SELECT * FROM stok WHERE idstok = '$_GET[id]' LIMIT 1");
$stok = $ambil->fetch_assoc();
?>

<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Stok</h6>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label>Stok</label>
            <input type="number" class="form-control" name="stok" value="<?php echo $stok['stok'] ?>">
          </div>
          <div class="form-group">
            <label>Tanggal Stok</label>
            <input type="date" class="form-control" name="tanggalstok" value="<?php echo $stok['tanggalstok'] ?>">
          </div>
          <button class="btn btn-primary" name="tambah">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_POST['tambah'])) {
  $stok = $_POST["stok"];
  $tanggalstok = $_POST["tanggalstok"];
  $id = $_GET["id"];

  // Menggunakan prepared statement untuk keamanan
  $stmt = $koneksi->prepare("UPDATE stok SET stok = ?, tanggalstok = ? WHERE idstok = ?");
  $stmt->bind_param("ssi", $stok, $tanggalstok, $id);
  $stmt->execute();
  $stmt->close();
  echo "<script> alert('Stok Berhasil Di Ubah');</script>";
  echo "<script> location ='index.php?halaman=stok';</script>";
}
?>