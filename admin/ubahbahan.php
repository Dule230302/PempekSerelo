<?php
$ambil = $koneksi->query("SELECT * FROM bahan_baku WHERE id_bahan = '$_GET[id]' LIMIT 1");
$bahan = $ambil->fetch_assoc();
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
            <label>Nama Bahan</label>
            <input type="text" class="form-control" name="nama_bahan" value="<?php echo $bahan['nama_bahan'] ?>" readonly>
          </div>
          <div class="form-group">
            <label>Stok</label>
            <input type="number" class="form-control" name="stok_kg" value="<?php echo $bahan['stok_kg'] ?>">
          </div>
          <div class="form-group">
            <label>Satuan</label>
            <input type="text" class="form-control" name="satuan" value="<?php echo $bahan['satuan'] ?>">
          </div>
          <button class="btn btn-primary" name="tambah">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_POST['tambah'])) {
  $nama_bahan = $_POST["nama_bahan"];
  $stok_kg = $_POST["stok_kg"];
  $satuan = $_POST["satuan"];
  $id = $_GET["id"];

  // Menggunakan prepared statement untuk keamanan
  $stmt = $koneksi->prepare("UPDATE bahan_baku SET nama_bahan = ?, stok_kg = ?, satuan = ? WHERE id_bahan = ?");
  $stmt->bind_param("sssi", $nama_bahan, $stok_kg, $satuan, $id);
  $stmt->execute();
  $stmt->close();
  echo "<script> alert('Bahan Baku Berhasil Di Ubah');</script>";
  echo "<script> location ='index.php?halaman=bahan';</script>";
}
?>