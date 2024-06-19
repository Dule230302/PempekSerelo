<?php
session_start();
include 'koneksi.php';

// Ambil nilai keyword dari form pencarian
if (!empty($_POST['keyword'])) {
	$keyword = $_POST['keyword'];
} else {
	$keyword = "";
}

// Ambil nilai kategori dari parameter URL
$kategori = $_GET["id"];

// Ambil data produk berdasarkan kategori dan filter pencarian
$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE (namaproduk LIKE '%$keyword%' OR hargaproduk LIKE '%$keyword%') AND idkategori = $kategori");

while ($pecah = $ambil->fetch_assoc()) {
	$semuadata[] = $pecah;
}
?>
<?php
// Memasukkan header halaman
include 'header.php';

// Mengambil nama kategori
$am = $koneksi->query("SELECT * FROM kategori where idkategori='$kategori'");
$pe = $am->fetch_assoc();
?>
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
	<div class="container text-center pt-5 pb-3">
		<h1 class="display-4 text-white animated slideInDown mb-3">Kategori</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
				<li class="breadcrumb-item text-primary active" aria-current="page">Kategori</li>
			</ol>
		</nav>
	</div>
</div>
<div class="container-xxl py-6">
	<div class="container">
		<div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
			<p class="text-primary text-uppercase mb-2">Kategori : <?php echo $pe["namakategori"] ?></p>
			<h1 class="display-6 mb-4">Kategori : <?php echo $pe["namakategori"] ?></h1>
		</div>
		<div class="row mb-5">
			<div class="col-md-12">
				<form method="post">
					<div class="row">
						<div class="col-md-9  my-auto">
							<div class="form-group">
								<input type="text" name="keyword" value="<?= $keyword ?>" placeholder="Masukkan kata pencarian" class="form-control">
							</div>
						</div>
						<div class="col-md-3">
							<button type="submit" name="cari" value="cari" class="btn btn-primary w-100" style="padding:14px">Cari</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row g-4">
			<?php foreach ($semuadata as $produk) : ?>
				<?php
				// Periksa stok produk
				$idproduk = $produk['idproduk'];
				$cek_stok = $koneksi->query("SELECT stok FROM stok WHERE idproduk = '$idproduk'");
				$data_stok = $cek_stok->fetch_assoc();
				?>

				<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
					<div class="team-item text-center rounded overflow-hidden">
						<div class="position-relative">
							<?php
							// Tampilkan notifikasi jika stok habis
							if ($data_stok['stok'] <= 0) {
								echo '<div class="alert alert-danger position-absolute top-0 start-0 m-3">Stok habis!</div>';
							}
							?>
							<img class="img-fluid" style="height: 400px; object-fit: cover;" src="foto/<?php echo $produk['fotoproduk'] ?>" alt="">
						</div>
						<div class="team-text">
							<div class="team-title">
								<h5><?php echo $produk["namaproduk"] ?></h5>
								<span><?= $pe["namakategori"] ?></span>
								<span>Rp <?php echo number_format($produk['hargaproduk']) ?></span>
								<?php
								// Tampilkan rating bintang ulasan jika ada
								$ambilulasan = mysqli_query($koneksi, "SELECT sum(bintang) as totalbintang FROM ulasan where ulasan.idproduk = '$produk[idproduk]'");
								$dataulasan = $ambilulasan->fetch_assoc();
								$ambilulasan = mysqli_query($koneksi, "SELECT * FROM ulasan where ulasan.idproduk = '$produk[idproduk]'");
								$hitungulasan = $ambilulasan->num_rows;

								if ($hitungulasan == 0) {
									$jumlahulasan = 1;
								} else {
									$jumlahulasan = $hitungulasan;
								}

								$rataulasan = $dataulasan['totalbintang'] / $jumlahulasan;
								$kritik = '<div style="display: flex;">';

								for ($i = 1; $i <= 5; $i++) {
									$starClass = ($rataulasan >= $i) ? 'checked' : '';
									$kritik .= '<span class="fa fa-star ' . $starClass . '" style="color:#ffc700;font-size:15pt; margin-right: 2px;"></span>';
								}

								$kritik .= '</div>';

								if ($hitungulasan >= 1) {
									echo $kritik;
								}
								?>

							</div>
							<div class="team-social">
								<?php
								// Tampilkan tombol "Pesan" jika stok produk tersedia
								if ($data_stok['stok'] > 0) {
									echo '<a href="detail.php?id=' . $produk['idproduk'] . '" class="btn btn-primary rounded-pill py-3 px-5 w-100">Pesan</a>';
								}
								?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
<?php
// Memasukkan footer halaman
include 'footer.php';
?>