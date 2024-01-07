<?php require_once("functions/index.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="login">
        <h1>LOGIN</h1>
        <form action="functions/index.php" method="post">
            <div class="form-item">
                <label for="email">Email</label>
                <input required type="text" name="email" id="email">
            </div>
            <div class="form-item">
                <label for="password">Kata Sandi</label>
                <input required type="password" name="password" id="password">
            </div>
            <div class="form-item tombol">
                <button name="login">Masuk</button>
            </div>
            <div class="form-item">
                <a form="register" href="regsiter.php">Belum punya akun? Silahkan Daftar</a>
            </div>
        </form>
    </div>

    <!-- notifikasi -->
    <?php if (isset($_SESSION["notif"])) : ?>
        <div class="overlay-notifikasi">
            <div class="notifikasi">
                <?php if ($_SESSION["notif"]["jenis"] == "gagal") : ?>
                    <i class="bi bi-x-circle gagal"></i>
                <?php else : ?>
                    <i class="bi bi-check-circle berhasil"></i>
                <?php endif; ?>
                <span class="pesan"><?= $_SESSION["notif"]["pesan"] ?></span>
                <button type="button">OK</button>
            </div>
        </div>
        <?php unset($_SESSION["notif"]); ?>
    <?php endif; ?>
    <!-- akhir notifikasi -->

    <script src="js/script.js"></script>
    <script src="js/login.js"></script>
</body>

</html>