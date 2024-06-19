<?php
if ($_SESSION['admin']['level'] == 'Admin') {
?>
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="index.php?halaman=tambahstok" class="btn btn-sm btn-primary shadow-sm float-right pull-right"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Stok</a>
  </div>
<?php
}
?>
<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Stok</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="table">
            <thead class="bg-primary text-white">
              <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Tanggal</th>
                <?php
                if ($_SESSION['admin']['level'] == 'Admin') {
                ?>
                  <th>Aksi</th>
                <?php
                }
                ?>
              </tr>
            </thead>
            <tbody>
              <?php $nomor = 1; ?>
              <?php
              $ambil = $koneksi->query("
SELECT stok.idstok, produk.namaproduk, stok.stok AS stok, stok.tanggalstok
FROM stok
LEFT JOIN produk ON stok.idproduk = produk.idproduk
");
              ?>
              <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo $nomor; ?></td>
                  <td><?php echo $pecah['namaproduk'] ?></td>
                  <td><?php echo $pecah['stok'] ?></td>
                  <td><?php echo $pecah['tanggalstok'] ?></td>
                  <?php
                  if ($_SESSION['admin']['level'] == 'Admin') {
                  ?>
                    <td>
                      <a href="index.php?halaman=ubahstok&id=<?php echo $pecah['idstok']; ?>" class="btn btn-warning">Ubah</a>
                      <a href="index.php?halaman=hapusstok&id=<?php echo $pecah['idstok']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
                    </td>
                  <?php
                  }
                  ?>
                </tr>
                <?php $nomor++; ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>