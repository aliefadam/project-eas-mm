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
                    <span>Welcome to GeekTutors!</span>
                    <img src="imgs/programming 1.png" alt="">
                </div>
            </div>
            <div class="item">
                <span>Where Your Learning Dreams Come to Life with GeekTutors!</span>
            </div>
            <div class="item"></div>
            <!-- <img src="imgs/home.png" alt=""> -->
        </header>
    </section>
    <!-- akhir home -->

    <!-- about -->
    <section class="about">
        <div class="item">
            <h1>About GeekTutors</h1>
            <p>
                Not only can you embark on a journey of learning with GeekTutors, but you can also tailor your educational experience with our user-friendly platform. Say goodbye to standardized learning and hello to personalized and professionally curated content that will make your educational journey stand out from the rest.
            </p>
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
                <span class="course-desk">Become a potential and professional freelancer</span>
            </div>
            <div class="course-item">
                <img src="imgs/Rectangle 15 (1).png" alt="">
                <span class="course-name">CSS</span>
                <span class="course-desk">Become a potential and professional freelancer</span>
            </div>
            <div class="course-item">
                <img src="imgs/Rectangle 15 (2).png" alt="">
                <span class="course-name">WEB</span>
                <span class="course-desk">Become a potential and professional freelancer</span>
            </div>
        </div>
        <button class="view-more" onclick="window.location = 'course.php'">View More</button>
    </section>
    <!-- akhir course -->

    <!-- footer -->
    <?php include("components/footer.php") ?>
    <!-- akhir footer -->
</body>

</html>