<?php require_once("functions/index.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/detail-sub-course.css">
</head>

<body>
    <!-- navbar -->
    <?php include("components/navbar.php") ?>
    <!-- akhir navbar -->

    <!-- header -->
    <header>
        <h1>Detail Materi</h1>
        <span><?= getCourseNameFromMateri($_GET["materi_id"]) ?></span>
    </header>
    <!-- akhir header -->



    <section class="detail">
        <div class="title">
            <span><?= getJudulMateri($_GET["materi_id"]) ?></span>
        </div>
        <div class="wrapper">
            <?php foreach (getDataDetailMateri($_GET["materi_id"]) as ["id" => $id, "jenis_detail_materi" => $jenis, "isi" => $isi, "materi_id" => $materiId]) : ?>
                <form action="functions/index.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="detail_materi_id" value="<?= $id ?>">
                    <input type="hidden" name="materi_id" value="<?= $_GET["materi_id"] ?>">
                    <input type="hidden" name="jenis" value="<?= $jenis ?>">
                    <div class="<?= $jenis ?> admin-edit">
                        <?php if ($jenis == "gambar") : ?>
                            <img src="uploads/<?= $isi ?>" alt="">
                            <input type="file" name="isi" id="isi">
                            <div jenis="gambar" class="overlay-admin">
                                <button type="button" detail-materi-id="<?= $id ?>" materi-id="<?= $materiId ?>" jenis-materi="<?= $jenis ?>">Hapus</button>
                                <button type="button" jenis="button" name="edit-detail-materi-gambar" jenis-materi="<?= $jenis ?>">Ganti Gambar</button>
                            </div>
                        <?php else : ?>
                            <span isi="<?= $isi ?>"><?= $isi ?></span>
                            <?php if ($jenis == "judul") : ?>
                                <input type="text" name="isi" id="isi" class="<?= $jenis ?>">
                            <?php else : ?>
                                <textarea type="text" name="isi" id="isi" class="<?= $jenis ?>"></textarea>
                            <?php endif; ?>
                            <div jenis="teks" class="overlay-admin">
                                <button type="button" detail-materi-id="<?= $id ?>" materi-id="<?= $materiId ?>" jenis-materi="<?= $jenis ?>">Hapus</button>
                                <button type="button" jenis="button" name="edit-detail-materi" jenis-materi="<?= $jenis ?>">Edit</button>
                            </div>
                        <?php endif ?>
                    </div>
                </form>
            <?php endforeach; ?>
            <?php if (isset($_SESSION["auth"]) && $_SESSION["auth"]["role"] == "admin") : ?>
                <div class="aksi">
                    <button type="button" class="btn-tambah-judul">+ Judul</button>
                    <div class="tambah-judul">
                        <h1>Tambah Judul</h1>
                        <form action="functions/index.php" method="post">
                            <input type="hidden" name="materi_id" value="<?= $_GET["materi_id"] ?>">
                            <div class="form-item">
                                <label for="isi">Judul</label>
                                <input type="text" name="isi" id="isi">
                            </div>
                            <div class="form-item">
                                <button name="tambah-judul">Tambah</button>
                            </div>
                        </form>
                    </div>
                    <button type="button" class="btn-tambah-teks">+ Teks</button>
                    <div class="tambah-teks">
                        <h1>Tambah Teks</h1>
                        <form action="functions/index.php" method="post">
                            <input type="hidden" name="materi_id" value="<?= $_GET["materi_id"] ?>">
                            <div class="form-item">
                                <label for="isi">Teks</label>
                                <input type="text" name="isi" id="isi">
                            </div>
                            <div class="form-item">
                                <button name="tambah-teks">Tambah</button>
                            </div>
                        </form>
                    </div>
                    <button type="button" class="btn-tambah-gambar">+ Gambar</button>
                    <form action="functions/index.php" class="tambah-gambar" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="materi_id" value="<?= $_GET["materi_id"] ?>">
                        <input type="file" name="pilih-gambar" id="pilih-gambar">
                        <button type="submit" name="tambah-gambar">Tambah</button>
                    </form>
                </div>
            <?php endif ?>
        </div>
    </section>

    <!-- overlay hapus konfirmasi hapus course -->
    <div class="overlay konfirmasi-hapus-course">
        <div class="box">
            <span>Yakin ingin menghapus detail ini?</span>
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
    <?php if (isset($_SESSION["auth"]) && $_SESSION["auth"]["role"] == "admin") : ?>
        <script src="js/detail-sub-course.js"></script>
    <?php endif ?>
</body>

</html>