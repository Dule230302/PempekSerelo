<?php
$ambil = $koneksi->query("SELECT * FROM pemesanan JOIN pengguna ON pemesanan.id = pengguna.id WHERE pemesanan.idpenjualan='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Daftar Pemesanan</h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<h3>Pemesanan</h3>
						<hr>
						<strong>NO PEMESANAN: <?php echo $detail['idpenjualan']; ?></strong><br>
						Tanggal : <?= tanggal(date('Y-m-d', strtotime($detail['tanggalbeli']))) ?><br>
						Status Barang : <?php echo $detail['statusbeli']; ?><br>
						Total Pemesanan : Rp. <?php echo number_format($detail['totalbeli']); ?><br>
						Total Bayar : Rp. <?php echo number_format($detail['ongkir'] + $detail['totalbeli']); ?><br>
						Ekspedisi : <?php echo $detail['ekspedisi']; ?><br>
						Layanan : <?php echo $detail['layanan']; ?><br>
						Ongkir : Rp. <?php echo number_format($detail['ongkir']); ?><br>
						Alasan Pengembalian : <?php echo $detail['alasan']; ?><br>
						Jenis Pengembalian : <?php echo $detail['jenis_pengembalian']; ?><br>
						Bukti Foto Pengembalian : <br>
						<?php if (!empty($detail['bukti_foto'])) : ?>
							<a href="#" data-toggle="modal" data-target="#buktiFotoModal">
								<img src="../<?php echo $detail['bukti_foto']; ?>" width="200px" alt="Bukti Foto Pengembalian">
							</a>
						<?php else : ?>
							<p>Tidak ada bukti foto pengembalian.</p>
						<?php endif; ?>
					</div>
					<div class="col-md-6">
						<h3>Pelanggan</h3>
						<hr>
						<strong>NAMA : <?php echo $detail['nama']; ?></strong><br>
						Telepon : <?php echo $detail['telepon']; ?><br>
						Email : <?php echo $detail['email']; ?><br>
						Kota : <?php echo $detail['kota']; ?><br>
						Provinsi : <?php echo $detail['provinsi']; ?><br>
						Alamat Pengiriman : <?php echo $detail['alamatpengiriman']; ?><br>
						Metode Pengiriman : <?php echo $detail['metodepengiriman']; ?><br>
					</div>
				</div>
				<br>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Produk</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Total Harga</th>
						</tr>
					</thead>
					<tbody>
						<?php $nomor = 1; ?>
						<?php $ambil_produk = $koneksi->query("SELECT * FROM penjualan WHERE idpenjualan='$_GET[id]'"); ?>
						<?php while ($pecah = $ambil_produk->fetch_assoc()) : ?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $pecah['nama']; ?></td>
								<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
								<td><?php echo $pecah['jumlah']; ?></td>
								<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
							</tr>
							<?php $nomor++; ?>
						<?php endwhile; ?>
					</tbody>
				</table>
				<?php if ($detail['metodepengiriman'] == 'Same Day' || $detail['metodepengiriman'] == "Instant") : ?>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
						Input Ongkir
					</button>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<!-- Modal untuk Tampilan Lebih Besar Bukti Foto Pengembalian -->
<div class="modal fade" id="buktiFotoModal" tabindex="-1" role="dialog" aria-labelledby="buktiFotoModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="buktiFotoModalLabel">Bukti Foto Pengembalian</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<?php if (!empty($detail['bukti_foto'])) : ?>
					<img src="../<?php echo $detail['bukti_foto']; ?>" class="img-fluid" alt="Bukti Foto Pengembalian">
				<?php else : ?>
					<p>Tidak ada bukti foto pengembalian.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php
$idpenjualan = $_GET['id'];
$ambil_pembayaran = $koneksi->query("SELECT * FROM pembayaran WHERE idpenjualan='$idpenjualan'");
$detail_pembayaran = $ambil_pembayaran->fetch_assoc();
?>

<div class="row">
	<?php if ($detail['statusbeli'] != "Selesai") : ?>
		<div class="col-md-6 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Konfirmasi</h6>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<?php if ($detail_pembayaran) : ?>
								<table class="table">
									<tr>
										<th>Nama</th>
										<td><?php echo $detail_pembayaran['nama'] ?></td>
									</tr>
									<tr>
										<th>Tanggal Transfer</th>
										<td><?= tanggal(date('Y-m-d', strtotime($detail_pembayaran['tanggaltransfer']))) ?></td>
									</tr>
									<tr>
										<th>Tanggal Upload Bukti Pembayaran</th>
										<td><?= tanggal(date('Y-m-d', strtotime($detail_pembayaran['tanggal']))) ?></td>
									</tr>
								</table>
							<?php endif; ?>
							<form method="post">
								<div class="form-group">
									<label>Masukkan No Resi Pengiriman</label>
									<input type="text" class="form-control" name="resi" value="<?php echo $detail['resipengiriman'] ?>">
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" name="statusbeli">
										<option <?php if ($detail['statusbeli'] == 'Belum di Konfirmasi') echo 'selected'; ?> value="Belum di Konfirmasi">Belum di Konfirmasi</option>
										<option <?php if ($detail['statusbeli'] == 'Belum Bayar') echo 'selected'; ?> value="Belum Bayar">Belum Bayar</option>
										<option <?php if ($detail['statusbeli'] == 'Pesanan Di Tolak') echo 'selected'; ?> value="Pesanan Di Tolak">Pesanan Di Tolak</option>
										<option <?php if ($detail['statusbeli'] == 'Barang Di Kemas') echo 'selected'; ?> value="Barang Di Kemas">Barang Di Kemas</option>
										<option <?php if ($detail['statusbeli'] == 'Barang Di Kirim') echo 'selected'; ?> value="Barang Di Kirim">Barang Di Kirim</option>
										<option <?php if ($detail['statusbeli'] == 'Barang Telah Sampai ke Pemesan') echo 'selected'; ?> value="Barang Telah Sampai ke Pemesan">Barang Telah Sampai ke Pemesan</option>
										<option <?php if ($detail['statusbeli'] == 'Pengajuan Pengembalian Pesanan Diterima') echo 'selected'; ?> value="Pengajuan Pengembalian Pesanan Diterima">Pengajuan Pengembalian Pesanan Diterima</option>
										<option <?php if ($detail['statusbeli'] == 'Pengajuan Pengembalian Pesanan Ditolak') echo 'selected'; ?> value="Pengajuan Pengembalian Pesanan Ditolak">Pengajuan Pengembalian Pesanan Ditolak</option>
									</select>
								</div>
								<button class="btn btn-primary float-right pull-right" name="proses">Simpan</button>
								<br>
								<br>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="col-md-6 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Bukti Pembayaran</h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<h4>Bukti Pembayaran</h4>
						<?php if ($detail_pembayaran) : ?>
							<img width="80%" src="../foto/<?php echo $detail_pembayaran['bukti'] ?>" alt="Bukti Pembayaran" class="img-responsive">
						<?php else : ?>
							<p>Tidak ada bukti pembayaran yang tersedia untuk ditampilkan.</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
if (isset($_POST["proses"])) {
	$resi = $_POST["resi"];
	$statusbeli = $_POST["statusbeli"];

	// Ambil status beli sebelumnya
	$statusSebelumnya = $koneksi->query("SELECT statusbeli FROM pemesanan WHERE idpenjualan='$idpenjualan'");
	$dataStatusSebelumnya = $statusSebelumnya->fetch_assoc();
	$statusSebelumnya = $dataStatusSebelumnya['statusbeli'];

	$koneksi->query("UPDATE pemesanan SET resipengiriman='$resi', statusbeli='$statusbeli'
        WHERE idpenjualan='$idpenjualan'");

	if ($statusbeli == "Pesanan Di Tolak" && $statusSebelumnya != "Pesanan Di Tolak") {
		$produk = $koneksi->query("SELECT * FROM penjualan WHERE idpenjualan='$idpenjualan'");
		while ($data = $produk->fetch_assoc()) {
			$jumlah = $data['jumlah'];
			$idproduk = $data['idproduk'];

			// Ambil stok produk saat ini
			$stokProduk = $koneksi->query("SELECT stokproduk FROM produk WHERE idproduk='$idproduk'");
			$dataStok = $stokProduk->fetch_assoc();
			$stokSaatIni = $dataStok['stokproduk'];

			$stokBaru = $stokSaatIni + $jumlah;

			// Perbarui stokproduk
			$koneksi->query("UPDATE produk SET stokproduk = '$stokBaru' WHERE idproduk='$idproduk'");
		}
	}

	echo "<script>alert('Status Transaksi Berhasil Diupdate')</script>";
	echo "<script>location='index.php?halaman=pemesanan';</script>";
}

if (isset($_POST["ubah"])) {
	$idpenjualan = $_POST["idpenjualan"];
	$ongkir = $_POST["ongkir"];
	$koneksi->query("UPDATE pemesanan SET ongkir='$ongkir' WHERE idpenjualan='$idpenjualan'");
	echo "<script>alert('Ongkir Berhasil Diupdate')</script>";
	echo "<script>location='index.php?halaman=pemesanan';</script>";
}
?>