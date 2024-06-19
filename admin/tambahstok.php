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
            <label>Nama Produk</label>
            <select name="idproduk" id="idproduk" class="form-control">
              <?php while ($pecah = $produk->fetch_assoc()) : ?>
                <option value="<?php echo $pecah['idproduk'] ?>"><?php echo $pecah['namaproduk'] ?></option>
              <?php endwhile ?>
            </select>
          </div>
          <div class="form-group">
            <label>Stok</label>
            <input type="text" class="form-control" name="stok">
          </div>
          <div class="form-group">
            <label>Tanggal Stok</label>
            <input type="date" class="form-control" name="tanggalstok">
          </div>
          <button class="btn btn-primary" name="tambah">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_POST['tambah'])) {
  $idproduk = $_POST["idproduk"];
  $stok = $_POST["stok"];
  $tanggalstok = $_POST["tanggalstok"];

  $koneksi->query("INSERT INTO stok(idproduk, stok, tanggalstok) VALUES ('$idproduk', '$stok', '$tanggalstok')");
  echo "<script> alert('Stok Berhasil Di Tambah');</script>";
  echo "<script> location ='index.php?halaman=stok';</script>";
}
?>