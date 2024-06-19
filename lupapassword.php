<?php
session_start();
include 'koneksi.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('phpmailer/Exception.php');
include('phpmailer/PHPMailer.php');
include('phpmailer/SMTP.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pempek Serelo</title>
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/plugins/slider/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/plugins/slider/css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body class="form-login-body">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto login-desk">
                <div class="row">
                    <div class="col-md-7 detail-box">
                        <img class="logo" src="home/img/logo.png" alt="">
                        <div class="detailsh">
                            <img class="help" style="height: 300px;object-fit: cover;" src="home/img/cr3.jpg" alt="">
                            <h3>Pempek Serelo</h3>
                            <p>Pempek enak dengan bahan ikan dan cuko asli Palembang !</p>
                        </div>
                    </div>
                    <div class="col-md-5 loginform">
                        <h4>Lupa Password</h4>
                        <p>Masukkan Email Anda</p>
                        <div class="login-det">
                            <form method="post">
                                <div class="form-row">
                                    <label for="">Email</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="far fa-user text-dark"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control text-dark" name="email" aria-label="Username" aria-describedby="basic-addon1" style="color: black !important;">
                                    </div>
                                </div>
                                <p class="forget"><a href="login.php">Sudah Punya Akun? Login disini</a></p>

                                <button type="submit" class="btn btn-sm btn-danger" name="resetsandi">Reset Password</button>
                            </form>
                            <?php
                            if (isset($_POST["resetsandi"])) {
                                $email = $_POST["email"];
                                $ambil = $koneksi->query("SELECT * FROM pengguna
		WHERE email='$email'");
                                $akunyangcocok = $ambil->num_rows;
                                if ($akunyangcocok >= 1) {
                                    $akun = $ambil->fetch_assoc();
                                    // kirimemail
                                    $mail = new PHPMailer(true);
                                    $mail->SMTPDebug = 0;
                                    $mail->isSMTP();
                                    $mail->Host = 'smtp.gmail.com';
                                    $mail->SMTPAuth = true;
                                    $mail->Username = 'imartiraha03@gmail.com';
                                    $mail->Password = 'yycqdzzqesydemrt';
                                    $mail->SMTPSecure = 'ssl';
                                    $mail->Port = 465;
                                    $mail->setFrom('imartiraha03@gmail.com', 'Pempek Serelo');
                                    $mail->addAddress($email);
                                    $mail->addReplyTo('no-reply@gmail.com', 'Np-reply');
                                    $mail->isHTML(true);
                                    $mail->Subject = 'Ganti Password Akun Pempek Serelo - ' . $email;
                                    // $mail->Body    = "Silahkan ganti password anda";
                                    $mail->Body    = 'Silahkan klik link ini untuk mengganti password baru akun anda<br><br><a href="http://localhost/pempekserelo/gantipassword.php?id=' . $akun['id'] . '" target="_blank" style="background-color: #1ba4e3;
        color: white;
        padding: 14px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;">Ganti Password</a>';
                                    $mail->AltBody = '';
                                    if (!$mail->send()) {
                                        echo 'Gagal';
                                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                                    }
                                    // 
                                    echo "<script>alert('Link ganti password berhasil dikirim silahkan cek email anda untuk mengganti password');</script>";
                                    echo "<script>location='login.php';</script>";
                                } else {
                                    echo "<script>alert('Email anda tidak terdaftar dalam sistem kami');</script>";
                                    echo "<script>location='login.php';</script>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
<script src="assets/plugins/slider/js/owl.carousel.min.js"></script>
<script src="assets/js/script.js"></script>

</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pempek Serelo</title>
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/plugins/slider/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/plugins/slider/css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>



</body>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
<script src="assets/plugins/slider/js/owl.carousel.min.js"></script>
<script src="assets/js/script.js"></script>

</html>