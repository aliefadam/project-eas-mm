<?php require_once("functions/index.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/sub-course.css">
</head>

<body>
    <!-- navbar -->
    <?php include("components/navbar.php") ?>
    <!-- akhir navbar -->

    <!-- header -->
    <header>
        <h1>Daftar Materi</h1>
        <span><?= getCourseName($_GET["course"]) ?></span>
    </header>
    <!-- akhir header -->

    <!-- gambar -->
    <section class="gambar">
        <div class="gambar-item">
            <img src="imgs/gambar-sub-course.png" alt="">
        </div>
    </section>
    <!-- akhir gambar -->

    <section class="sub-course">
        <?php $no = 1; ?>
        <?php foreach (getDataMateri($_GET["course"]) as $materi) : ?>
            <a href="detail-sub-course.php?materi_id=<?= $materi["id"] ?>" class="sub-course-item">
                <form action="functions/index.php" method="post">
                    <input type="hidden" name="materi_id" value="<?= $materi["id"] ?>">
                    <input type="hidden" name="course_id" value="<?= $_GET["course"] ?>">
                    <div class="user">
                        <div class="item">
                            <span><?= $no++ ?></span>
                        </div>
                        <div class="item">
                            <span nama-materi="<?= $materi["nama_materi"] ?>"><?= $materi["nama_materi"] ?></span>
                            <?php if (isset($_SESSION["auth"]) && $_SESSION["auth"]["role"] == "admin") : ?>
                                <input type="text" name="nama_materi">
                            <?php endif ?>
                        </div>
                    </div>
                    <?php if (isset($_SESSION["auth"]) && $_SESSION["auth"]["role"] == "admin") : ?>
                        <div class="admin">
                            <button type="button" course-id="<?= $_GET["course"] ?>" materi-id="<?= $materi["id"] ?>" class="btn-hapus">Hapus</button>
                            <button type="button" class="btn-edit">Edit</button>
                        </div>
                    <?php endif ?>
                </form>
            </a>
        <?php endforeach; ?>
        <?php if (isset($_SESSION["auth"]) && $_SESSION["auth"]["role"] == "admin") : ?>
            <div class="aksi">
                <button type="button">+ Tambah Materi</button>
            </div>
        <?php endif ?>
        <div class="tambah-course">
            <h1>Tambah Materi</h1>
            <form action="functions/index.php" method="post">
                <input type="hidden" name="course_id" value="<?= $_GET["course"] ?>">
                <div class="form-item">
                    <label for="nama_materi">Nama Materi</label>
                    <input type="text" name="nama_materi" id="nama_materi">
                </div>
                <div class="form-item">
                    <button name="tambah-materi">Tambah</button>
                </div>
            </form>
        </div>
    </section>

    <!-- overlay hapus konfirmasi hapus course -->
    <div class="overlay konfirmasi-hapus-course">
        <div class="box">
            <span>Yakin ingin menghapus course ini?</span>
            <div class="aksi">
                <button type="button">Batal</button>
                <button type="button">Yakin</button>
            </div>
        </div>
    </div>
    <!-- akhir overlay hapus konfirmasi hapus course -->

    <!-- footer -->
    <?php include("components/footer.php") ?>
    <!-- akhir footer -->

    <script src="js/sub-course.js"></script>
</body>

</html>