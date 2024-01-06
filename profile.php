<?php require_once("functions/index.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <!-- navbar -->
    <?php include("components/navbar.php") ?>
    <!-- akhir navbar -->

    <div class="container">
        <div class="detail-akun">
            <div class="detail">
                <div class="kiri">
                    <img src="imgs/no_image.jpg" alt="">
                </div>
                <div class="kanan">
                    <span class="nama"><?= $_SESSION["auth"]["nama"] ?></span>
                    <span class="email"><?= $_SESSION["auth"]["email"] ?></span>
                </div>
                <div class="aksi">
                    <span><i class="bi bi-shield-lock"></i> Ganti Kata Sandi</span>
                    <span class="logout"><i class="bi bi-box-arrow-left"></i> Logout</span>
                </div>
            </div>
        </div>
        <div class="riwayat-course">
            <h2>Riwayat Course</h2>
        </div>
    </div>

    <script src="js/profile.js"></script>
</body>

</html>