<?php
session_start();
include 'koneksi.php';
include 'kurangstok.php';
if (!isset($_SESSION["pengguna"])) {
  echo "<script> alert('Anda belum login');</script>";
  echo "<script> location ='login.php';</script>";
  exit();
}
?>

<?php include 'header.php'; ?>
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
  <div class="container text-center pt-5 pb-3">
    <h1 class="display-4 text-white animated slideInDown mb-3">Return</h1>
    <nav aria-label="breadcrumb animated slideInDown">
      <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
        <li class="breadcrumb-item text-primary active" aria-current="page">Return</li>
      </ol>
    </nav>
  </div>
</div>
<div class="container-xxl py-6">
  <div class="container">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
      <p class="text-primary text-uppercase mb-2">Return</p>
      <h1 class="display-6 mb-4">Return</h1>
    </div>
    <div class="row g-0 justify-content-center">
      <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
        <table class="table">
          <thead class="bg-primary text-white">
            <tr class="text-center">
              <th width="10px">No</th>
              <th width="30%x">Daftar</th>
              <th>Tanggal</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php $nomor = 1;
            $id = $_GET['id'];
            $ambil = $koneksi->query("SELECT *, pemesanan.idpenjualan as idpenjualanreal FROM pemesanan left join pembayaran on pemesanan.idpenjualan = pembayaran.idpenjualan WHERE pemesanan.idpenjualan='$id'");
            while ($pecah = $ambil->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $nomor; ?></td>
                <td>
                  <ul>
                    <?php $ambilproduk = $koneksi->query("SELECT * FROM penjualan join produk on penjualan.idproduk = produk.idproduk where idpenjualan='$pecah[idpenjualanreal]'");
                    while ($produk = $ambilproduk->fetch_assoc()) { ?>
                      <li>
                        <?= $produk['namaproduk'] ?> x <?= $produk['jumlah'] ?>
                      </li>
                    <?php } ?>
                  </ul>
                </td>
                <td><?php echo tanggal($pecah['tanggalbeli']) . '<br>Jam ' . date('H:i', strtotime($pecah['waktu'])) ?></td>
                <td>Rp. <?php echo number_format($pecah["totalbeli"] + $pecah["ongkir"]); ?></td>
              </tr>
              <?php $nomor++; ?>
            <?php  } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12 wow fadeInUp" data-wow-delay="0.1s">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label class="mb-2">Status Pemesanan</label>
          <input type="text" readonly value="<?= $_GET['status'] == 'batal' ? 'Pesanan Di Batalkan' : 'Pesanan Di Kembalikan' ?>" class="form-control mb-2" name="statusbeli">
        </div>
        <div class="form-group">
          <label class="mb-2">Alasan</label>
          <input type="text" class="form-control mb-2" name="alasan">
        </div>
        <div class="form-group">
          <label class="mb-2">Bukti Foto</label>
          <input type="file" class="form-control mb-2" name="bukti_foto" accept="image/*">
        </div>
        <div class="form-group">
          <label class="mb-2">Jenis Pengembalian</label>
          <select class="form-control mb-2" name="jenis_pengembalian">
            <option value="dana">Pengembalian Dana</option>
            <option value="pesanan">Pengembalian Pesanan</option>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary" name="update">Kirim</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div style="padding-top:250px"></div>
<?php
if (isset($_POST["update"])) {
  $statusbeli = $_POST['statusbeli'];
  $alasan = $_POST['alasan'];
  $jenisPengembalian = $_POST['jenis_pengembalian'];
  $buktiFoto = $_FILES['bukti_foto'];

  // Menangani file upload
  if ($buktiFoto['error'] == 0) {
    $namaFile = $buktiFoto['name'];
    $lokasiSementara = $buktiFoto['tmp_name'];
    $direktoriTujuan = "uploads/" . $namaFile;

    // Pastikan direktori tujuan ada
    if (!file_exists('uploads')) {
      mkdir('uploads', 0777, true);
    }

    // Pindahkan file ke direktori tujuan
    if (move_uploaded_file($lokasiSementara, $direktoriTujuan)) {
      // Update database dengan path file
      $koneksi->query("UPDATE pemesanan SET statusbeli='$statusbeli', alasan='$alasan', jenis_pengembalian='$jenisPengembalian', bukti_foto='$direktoriTujuan'
                        WHERE idpenjualan='$_GET[id]'");
    } else {
      echo "<script>alert('Gagal mengunggah file ke direktori tujuan')</script>";
    }
  } else {
    // Update tanpa file upload
    $koneksi->query("UPDATE pemesanan SET statusbeli='$statusbeli', alasan='$alasan', jenis_pengembalian='$jenisPengembalian'
                      WHERE idpenjualan='$_GET[id]'");
  }

  if ($_GET['status'] == 'batal') {
    echo "<script>alert('Pesanan berhasil dibatalkan')</script>";
  } else {
    echo "<script>alert('Pesanan berhasil dikembalikan')</script>";
  }
  echo "<script>location='riwayat.php';</script>";
}
?>
<?php
include 'footer.php';
?>