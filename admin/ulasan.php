<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Ulasan</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="table">
            <thead class="bg-primary text-white">
              <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Bintang</th>
                <th>Ulasan</th>
              </tr>
            </thead>
            <tbody>
              <?php $nomor = 1; ?>
              <?php
              $ambil = $koneksi->query("
SELECT ulasan.idulasan, ulasan.idpenjualan, ulasan.idproduk, ulasan.bintang, ulasan.ulasan, ulasan.Waktu,
       produk.namaproduk, produk.fotoproduk
FROM ulasan
JOIN produk ON ulasan.idproduk = produk.idproduk
");
              ?>
              <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo $nomor; ?></td>
                  <td><?php echo $pecah['namaproduk'] ?></td>
                  <td><?php echo $pecah['bintang'] ?></td>
                  <td><?php echo $pecah['ulasan'] ?></td>
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