<?php require_once("functions/index.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/course.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- navbar -->
    <?php include("components/navbar.php") ?>
    <!-- akhir navbar -->

    <!-- header -->
    <header>
        <h1>Pelajari Bersama GeekTutors!</h1>
        <span>KURSUS</span>
    </header>
    <!-- akhir header -->

    <section class="courses">
        <?php foreach (getDataCourse() as $course) : ?>
            <div class="courses-item">
                <form action="functions/index.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id-course" id="id-course" value="<?= $course["id"] ?>">
                    <div class="atas">
                        <div class="user">
                            <div class="item">
                                <img src="uploads/<?= $course["logo"] ?>" alt="">
                                <div class="overlay">
                                    <i class="bi bi-pencil-square"></i>
                                </div>
                                <input type="file" name="logo-course" id="">
                            </div>
                            <div class="item">
                                <span><?= $course["nama_course"] ?></span>
                                <input type="text" name="nama-course" id="nama-course">
                                <span><?= $course["jenis_course"] ?></span>
                                <input type="text" name="jenis-course" id="jenis-course">
                            </div>
                        </div>
                        <?php if (isset($_SESSION["auth"]) && $_SESSION["auth"]["role"] == "admin") : ?>
                            <div class="admin">
                                <button type="button" class="btn-batal edit-course">Batal</button>
                                <button type="button" course-id="<?= $course["id"] ?>" class="btn-hapus hapus-course">Hapus</button>
                                <button name="edit-course" jenis="button" type="button" class="btn-edit edit-course">Edit</button>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="bawah">
                        <span><?= $course["deskripsi"] ?></span>
                        <input type="text" name="desk-course" id="desk-course"></input>
                    </div>
                </form>
            </div>
        <?php endforeach ?>
        <?php if (isset($_SESSION["auth"]) && $_SESSION["auth"]["role"] == "admin") : ?>
            <div class="aksi">
                <button type="button">+ Tambah Course</button>
            </div>
        <?php endif; ?>
        <div class="tambah-course">
            <h1>Tambah Course</h1>
            <form action="functions/index.php" method="post" enctype="multipart/form-data">
                <div class="form-item">
                    <label for="desk-course">Nama Course</label>
                    <input type="text" name="nama-course" id="nama-course">
                </div>
                <div class="form-item">
                    <label for="jenis-course">Jenis Course</label>
                    <input type="text" name="jenis-course" id="jenis-course">
                </div>
                <div class="form-item">
                    <label for="desk-course">Deskripsi Course</label>
                    <input type="text" name="desk-course" id="desk-course">
                </div>
                <div class="form-item">
                    <label for="logo-course">Logo Course</label>
                    <input type="file" name="logo-course" id="logo-course">
                </div>
                <div class="form-item">
                    <button name="tambah-course">Tambah</button>
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

    <script src="js/course.js"></script>
    <script src="js/nav.js"></script>

</body>

</html>