<?php require_once("functions/index.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <!-- navbar -->
    <?php include("components/navbar.php") ?>
    <!-- akhir navbar -->

    <!-- home -->
    <section class="home">
        <header>
            <div class="item">
                <div class="wrapper">
                    <span>Hi, Selamat Datang di GeekTutors!</span>
                    <img src="imgs/programming 1.png" alt="">
                </div>
            </div>
            <div class="item">
                <span>Tempat Di Mana Impian Belajarmu Jadi Nyata bersama GeekTutors!</span>
            </div>
            <div class="item"></div>
            <!-- <img src="imgs/home.png" alt=""> -->
        </header>
    </section>
    <!-- akhir home -->

    <!-- about -->
    <section class="about">
        <div class="item">
            <h1>Tentang GeekTutors</h1>
            <p>
                Tidak hanya bisa memulai perjalanan belajar bersama GeekTutors, tapi Anda juga dapat menyesuaikan pengalaman pendidikan Anda dengan platform kami yang ramah pengguna. Katakan selamat tinggal pada pembelajaran standar dan sambutlah konten yang dipersonalisasi dan disusun secara profesional yang akan membuat perjalanan pendidikan Anda menonjol dari yang lain.</p>
        </div>
        <div class="item">
            <img src="imgs/Rectangle 4.png" alt="">
        </div>
    </section>
    <!-- akhir about -->

    <!-- course -->
    <section class="course">
        <h1>GeekTutors Course</h1>
        <div class="wrapper">
            <div class="course-item">
                <img src="imgs/Rectangle 15.png" alt="">
                <span class="course-name">HTML</span>
                <span class="course-desk">Menjadi Ahli HTML dengan Mudah</span>
            </div>
            <div class="course-item">
                <img src="imgs/Rectangle 15 (1).png" alt="">
                <span class="course-name">CSS</span>
                <span class="course-desk">Menguasai Daya Tarik Visual dengan CSS</span>
            </div>
            <div class="course-item">
                <img src="imgs/Rectangle 15 (2).png" alt="">
                <span class="course-name">WEB</span>
                <span class="course-desk">Desain dan Implementasi: Kelas Proyek Web</span>
            </div>
        </div>
        <button class="view-more" onclick="window.location = 'course.php'">Lihat Semua Kursus</button>
    </section>
    <!-- akhir course -->

    <!-- footer -->
    <?php include("components/footer.php") ?>
    <!-- akhir footer -->

    <script src="js/nav.js"></script>
</body>

</html>