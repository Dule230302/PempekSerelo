<?php
$ambil = $koneksi->query("SELECT * FROM supplier WHERE idsupplier = '$_GET[id]' LIMIT 1");
$supplier = $ambil->fetch_assoc();
?>

<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Supplier</h6>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label>Nama Supplier</label>
            <input type="text" class="form-control" name="namasupplier" value="<?php echo $supplier['namasupplier'] ?>">
          </div>
          <div class="form-group">
            <label>Nama Bahan</label>
            <input type="text" class="form-control" name="namabahan" value="<?php echo $supplier['namabahan'] ?>">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control" name="alamat" value="<?php echo $supplier['alamat'] ?>">
          </div>
          <div class="form-group">
            <label>Nomor Telepon</label>
            <input type="number" class="form-control" name="telepon" value="<?php echo $supplier['telepon'] ?>">
          </div>
          <div class="form-group"> <!-- Tambahkan input harga -->
            <label>Harga</label>
            <input type="number" class="form-control" name="harga" value="<?php echo $supplier['harga'] ?>">
          </div>
          <button class="btn btn-primary" name="tambah">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_POST['tambah'])) {
  $namasupplier = $_POST["namasupplier"];
  $alamat = $_POST["alamat"];
  $telepon = $_POST["telepon"];
  $namabahan = $_POST["namabahan"];
  $harga = $_POST["harga"]; // Tambahkan harga dari input form
  $id = $_GET["id"];

  // Menggunakan prepared statement untuk keamanan
  $stmt = $koneksi->prepare("UPDATE supplier SET namasupplier = ?, alamat = ?, telepon = ?, namabahan = ?, harga = ? WHERE idsupplier = ?");
  $stmt->bind_param("ssssii", $namasupplier, $alamat, $telepon, $namabahan, $harga, $id);
  $stmt->execute();
  $stmt->close();
  echo "<script> alert('Supplier Berhasil Di Ubah');</script>";
  echo "<script> location ='index.php?halaman=supplier';</script>";
}
?>