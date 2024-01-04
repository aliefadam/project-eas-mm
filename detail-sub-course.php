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
        <h1>Hypertext Markup Language</h1>
        <span>HTML</span>
    </header>
    <!-- akhir header -->

    <section class="detail">
        <div class="title">
            <span><?= getJudulMateri($_GET["materi_id"]) ?></span>
        </div>
        <div class="wrapper">
            <?php foreach (getDataDetailMateri($_GET["materi_id"]) as ["jenis_detail_materi" => $jenis, "isi" => $isi]) : ?>
                <div class="<?= $jenis ?>">
                    <?php if ($jenis == "gambar") : ?>
                        <img src="uploads/<?= $isi ?>" alt="">
                    <?php else : ?>
                        <span><?= $isi ?></span>
                    <?php endif ?>
                </div>
            <?php endforeach; ?>
            <!-- <div class="judul">
                <span>Pengertian HTML</span>
            </div>
            <div class="text">
                <span>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. A dolor qui eos et saepe debitis dolorem illum repellat distinctio voluptatem odio illo iure, quae ad! Magni beatae eveniet neque possimus? Nostrum pariatur id corrupti distinctio quasi beatae, quod, eligendi hic quisquam repudiandae cum! Possimus rerum nam recusandae quibusdam! At, eaque.
                </span>
            </div>
            <div class="gambar">
                <img src="imgs/detail-sub-course.png" alt="">
            </div> -->
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
        </div>
    </section>

    <!-- footer -->
    <?php include("components/footer.php") ?>
    <!-- akhir footer -->

    <script src="js/detail-sub-course.js"></script>
</body>

</html>