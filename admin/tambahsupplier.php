<?php
$produk = $koneksi->query("SELECT * FROM produk");
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
            <label>Nama Supplier</label>
            <input type="text" class="form-control" name="namasupplier">
          </div>
          <div class="form-group">
            <label>Nama Bahan</label>
            <input type="text" class="form-control" name="namabahan">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control" name="alamat">
          </div>
          <div class="form-group">
            <label>Nomor Telepon</label>
            <input type="number" class="form-control" name="telepon">
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

  $koneksi->query("INSERT INTO supplier(namasupplier, alamat, telepon, namabahan) VALUES ('$namasupplier', '$alamat', '$telepon', '$namabahan')");
  echo "<script> alert('Supplier Berhasil Di Tambah');</script>";
  echo "<script> location ='index.php?halaman=supplier';</script>";
}
?>