<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" style="height: 800px;object-fit: cover;" src="home/img/cr1.jpg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-8">
                                <p class="text-primary text-uppercase fw-bold mb-2">Selamat Datang Di Website</p>
                                <h1 class="display-1 text-light mb-4 animated slideInDown">Pempek Serelo</h1>
                                <p class="text-light fs-5 mb-4 pb-3">Pempek enak dengan bahan ikan dan cuko asli Palembang! Cobain yuk pempek asli Palembang di Pempek Serelo.</p>
                                <a href="produk.php" class="btn btn-primary rounded-pill py-3 px-5">Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" style="height: 800px;object-fit: cover;" src="home/img/cr2.jpeg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-8">
                               <p class="text-primary text-uppercase fw-bold mb-2">Selamat Datang Di Website</p>
                                <h1 class="display-1 text-light mb-4 animated slideInDown">Pempek Serelo</h1>
                                <p class="text-light fs-5 mb-4 pb-3">Pempek enak dengan bahan ikan dan cuko asli Palembang! Cobain yuk pempek asli Palembang di Pempek Serelo.</p>
                                <a href="produk.php" class="btn btn-primary rounded-pill py-3 px-5">Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" style="height: 200px;object-fit: cover;" src="home/img/cr3.jpg" alt="">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" style="height: 200px;object-fit: cover;" src="home/img/cr4.webp" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <p class="text-primary text-uppercase mb-2">Tentang</p>
                        <h1 class="display-6 mb-4">Pempek Serelo</h1>
                        <p>Pempek Serelo adalah merek dan restoran pempek asli palembang. Kami selalu menerapkan sistem manajemen mutu (Quality System) untuk memberikan produk-produk yang terbaik, yakni makanan yang sehat, bergizi, dan layak dikonsumsi oleh masyarakat Indonesia.</p>
                        <p>Pempek merupakan salah satu kekayaan kuliner tradisional Indonesia yang saat ini sudah bisa dinikmati di seluruh pelosok negeri ini. Pempek Serelo menjual pempek kapal selam, pempek lenjer, pempek kulit dan lain-lain.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">Menu</p>
                <h1 class="display-6 mb-4">Menu</h1>
            </div>
            <div class="row g-4">
				<?php $ambil = $koneksi->query("SELECT *FROM produk LEFT JOIN kategori ON produk.idkategori=kategori.idkategori order by idproduk desc limit 3"); ?>
			<?php while ($perproduk = $ambil->fetch_assoc()) { ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="foto/<?php echo $perproduk['fotoproduk'] ?>" alt="">
                        <div class="team-text">
                            <div class="team-title">
                                <h5><?php echo $perproduk["namaproduk"] ?></h5>
                                <span>Rp <?php echo number_format($perproduk['hargaproduk']) ?></span>
                            </div>
                            <div class="team-social">
                                <a href="detail.php?id=<?php echo $perproduk['idproduk']; ?>" class="btn btn-primary rounded-pill py-3 px-5 w-100">Pesan</a>
                            </div>
                        </div>
                    </div>
                </div>
               <?php } ?> 
            </div>
        </div>
    </div>

<?php
include 'footer.php';
?>