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

    <script src="js/script.js"></script>
</body>

</html>