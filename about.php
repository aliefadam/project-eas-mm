<?php require_once("functions/index.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang</title>
    <link rel="stylesheet" href="css/about.css">
    <link rel="icon" href="imgs/logo-web.svg">
</head>

<body>
    <!-- navbar -->
    <?php include("components/navbar.php") ?>
    <!-- akhir navbar -->

    <!-- header -->
    <header>
        <h1>Tentang GeekTutors</h1>

    </header>
    <!-- akhir header -->

    <section class="detail">
        <img src="imgs/Rectangle 4.png" alt="">
        <p>GeekTutors adalah platform pembelajaran daring yang menawarkan beragam kursus dalam bidang informatika dan teknologi. Kami bertujuan untuk memberikan pengalaman pembelajaran yang menarik dan terjangkau kepada semua orang, baik pemula maupun mereka yang ingin meningkatkan keterampilan teknis mereka.
        </p>
        <p>Visi Kami:
            "Menjadikan pembelajaran informatika lebih mudah diakses, menyenangkan, dan memberdayakan setiap individu untuk meraih sukses di era digital."</p>

        <div class="developer">
            <div class="row">
                <div class="profile">
                    <img src="imgs/alief.png" alt="">
                    <div class="profile-detail">
                        <span>Alief</span>
                        <span>Front End and Back End</span>
                    </div>
                </div>
                <div class="skills">
                    <div class="atas">
                        <div class="gambar">
                            <img src="imgs/js-frame.png" alt="">
                            <span>JavaScript</span>
                        </div>
                        <div class="gambar">
                            <img src="imgs/php-frame.png" alt="">
                            <span>PHP</span>
                        </div>
                        <div class="gambar">
                            <img src="imgs/html-frame.png" alt="">
                            <span>HTML</span>
                        </div>
                        <div class="gambar">
                            <img src="imgs/py-frame.png" alt="">
                            <span>Python</span>
                        </div>
                    </div>
                    <div class="bawah">
                        <span>Hal-hal yang saya kuasai</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="skills">
                    <div class="atas">
                        <div class="gambar">
                            <img src="imgs/figma-frame.png" alt="">
                            <span>JavaScript</span>
                        </div>
                        <div class="gambar">
                            <img src="imgs/html-frame.png" alt="">
                            <span>PHP</span>
                        </div>
                        <div class="gambar">
                            <img src="imgs/css-frame.png" alt="">
                            <span>HTML</span>
                        </div>
                        <div class="gambar">
                            <img src="imgs/ai-frame.png" alt="">
                            <span>Python</span>
                        </div>
                    </div>
                    <div class="bawah">
                        <span>Hal-hal yang saya kuasai</span>
                    </div>
                </div>
                <div class="profile">
                    <img src="imgs/fatih.png" alt="">
                    <div class="profile-detail">
                        <span>Fatih</span>
                        <span>UI and UX</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include("components/footer.php") ?>
    <!-- akhir footer -->
    <script src="js/nav.js"></script>

</body>

</html>