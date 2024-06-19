<div class="container-fluid bg-dark text-light footer my-6 mb-0 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5 col-md-6">
                <h4 class="text-light mb-4">Kontak</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jl. Intisari Raya No.1i, RT.3/Rw9 Kalisari,ID 13790 Pasar Rebo Jakarta Timur</p>
                <p class="mb-2"><i class="fa fa-phone me-3"></i>0878 8198 2742</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>febbylailatunnuzul@gmail.com</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Tautan</h4>
                <a class="btn btn-link" href="index.php">Home</a>
                <a class="btn btn-link" href="produk.php">Produk</a>
                <a class="btn btn-link" href="daftar.php">Daftar</a>
                <a class="btn btn-link" href="login.php">Login</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Map</h4>
                <div class="row g-2">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.4772331332256!2d106.85534217499128!3d-6.332163193657452!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69edaec3dc7369%3A0xad4111bc3dfe4267!2sJl.%20Intisari%20Raya%20No.1%2C%20RW.9%2C%20Kalisari%2C%20Kec.%20Ps.%20Rebo%2C%20Kota%20Jakarta%20Timur%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2013770!5e0!3m2!1sid!2sid!4v1706686905797!5m2!1sid!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid copyright text-light py-4 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                &copy; Pempek Serelo, All Right Reserved.
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_SESSION["pengguna"])) { ?>
    <?php
    $id = $_SESSION["pengguna"]['id'];
    $ambil = $koneksi->query("SELECT *FROM pengguna WHERE id='$id'");
    $pecah = $ambil->fetch_assoc(); ?>
    <a class="whats-app" href="https://wa.me/6289675982070" target="_blank" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
        <i class="fab fa-whatsapp my-float"></i>
        <span style="display: flex; flex-direction: column; font-weight: bold; font-style: italic; align-items: center; color: #5C821A; font-size: 14px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">HUBUNGI KAMI</span>
    </a>
<?php } else { ?>
    <a class="whats-app" href="https://wa.me/6289675982070" target="_blank" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
        <i class="fab fa-whatsapp my-float"></i>
        <span style="display: flex; flex-direction: column; font-weight: bold; font-style: italic; align-items: center; color: #5C821A; font-size: 14px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">HUBUNGI KAMI</span>
    </a>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="home/lib/wow/wow.min.js"></script>
<script src="home/lib/easing/easing.min.js"></script>
<script src="home/lib/waypoints/waypoints.min.js"></script>
<script src="home/lib/counterup/counterup.min.js"></script>
<script src="home/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="home/js/main.js"></script>
<script>
    $(document).ready(function() {
        $('.scroll-button').click(function() {
            var target = $(this).data('scroll-to');
            var position = 0;

            if (target === 'middle') {
                position = $('.container').offset().top;
            } else if (target === 'bottom') {
                position = $(document).height();
            }

            $('html, body').animate({
                scrollTop: position
            }, 1000);
        });
    });
</script>
</body>

</html>