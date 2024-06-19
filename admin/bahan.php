<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Bahan Baku</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="table">
            <thead class="bg-primary text-white">
              <tr>
                <th>No</th>
                <th>Nama Bahan Baku</th>
                <th>Stok</th>
                <th>Satuan</th>
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
              // Komposisi bahan baku untuk membuat 60 pcs pempek
              $komposisi_per_60_pempek = [
                'ikan tenggiri' => 2,     // 2 kg per 60 pcs
                'sagu' => 1,              // 1 kg per 60 pcs
                'bawang putih' => 3,      // 3 siung per 60 pcs
                'cabe' => 5,              // 5 kg per 60 pcs
                'garam' => 2 / 1000,      // 2 sendok teh per 60 pcs (dikonversi ke kg)
                'gula' => 1 / 1000,       // 1 sendok teh per 60 pcs (dikonversi ke kg)
                'asam jawa' => 1 / 1000,  // 1 sendok teh per 60 pcs (dikonversi ke kg)
                'gula merah' => 50 / 1000, // 50 gram per 60 pcs (dikonversi ke kg)
                'kulit ikan' => 500 / 1000, // 500 gram per 60 pcs (dikonversi ke kg)
                'telur' => 4              // 4 butir per 60 pcs
              ];
              $ambil = $koneksi->query("SELECT * FROM bahan_baku");
              $pempek = $koneksi->query("SELECT * FROM bahan_baku");

              // Array untuk menyimpan stok bahan baku
              $stok_bahan_baku = [];

              // Mengisi array $stok_bahan_baku dengan data dari database
              while ($row = $pempek->fetch_assoc()) {
                $stok_bahan_baku[$row['nama_bahan']] = $row['stok_kg'];
              }

              // Hitung jumlah pempek yang bisa dibuat berdasarkan stok bahan baku yang ada
              $jumlah_pempek = PHP_INT_MAX;

              foreach ($komposisi_per_60_pempek as $nama_bahan => $jumlah_per_60_pcs) {
                if (isset($stok_bahan_baku[$nama_bahan])) {
                  $stok = $stok_bahan_baku[$nama_bahan];
                  $pempek_dari_bahan_ini = ($stok / $jumlah_per_60_pcs) * 60;
                  $jumlah_pempek = min($jumlah_pempek, $pempek_dari_bahan_ini);
                } else {
                  $jumlah_pempek = 0;
                  break;
                }
              }
              ?>
              <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo $nomor; ?></td>
                  <td><?php echo $pecah['nama_bahan'] ?></td>
                  <td><?php echo $pecah['stok_kg'] ?></td>
                  <td><?php echo $pecah['satuan'] ?></td>
                  <?php
                  if ($_SESSION['admin']['level'] == 'Admin') {
                  ?>
                    <td>
                      <a href="index.php?halaman=ubahbahan&id=<?php echo $pecah['id_bahan']; ?>" class="btn btn-warning">Ubah</a>
                    </td>
                  <?php
                  }
                  ?>
                </tr>
                <?php $nomor++; ?>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3">Total Pempek yang bisa dibuat :</td>
                <td colspan="1"><?php echo floor($jumlah_pempek) ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>