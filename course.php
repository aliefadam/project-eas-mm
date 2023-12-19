<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/course.css">
</head>

<body>
    <!-- navbar -->
    <?php include("components/navbar.php") ?>
    <!-- akhir navbar -->

    <!-- header -->
    <header>
        <h1>Course with GeekTutors!</h1>
        <span>CODE</span>
    </header>
    <!-- akhir header -->

    <section class="courses">
        <div class="courses-item" onclick="window.location = 'sub-course.php'">
            <div class="atas">
                <div class="item">
                    <img src="imgs/html.png" alt="">
                </div>
                <div class="item">
                    <span>Basics</span>
                    <span>Basic Of Html To Edit Website</span>
                </div>
            </div>
            <div class="bawah">
                <span>
                    Underneath, we'll delve into the fundamental elements of HTML that you need to grasp in order to edit and create content for your website. From the basic structure to essential tags, let's explore the fundamentals of HTML that will enable you to manage and modify your website's content effortlessly.
                </span>
            </div>
        </div>
        <div class="courses-item" onclick="window.location = 'sub-course.php'">
            <div class="atas">
                <div class="item">
                    <img src="imgs/css.png" alt="">
                </div>
                <div class="item">
                    <span>Basics</span>
                    <span>Basics Of CSS To Edit Website</span>
                </div>
            </div>
            <div class="bawah">
                <span>
                    Underneath, we'll delve into the fundamental elements of HTML that you need to grasp in order to edit and create content for your website. From the basic structure to essential tags, let's explore the fundamentals of HTML that will enable you to manage and modify your website's content effortlessly.
                </span>
            </div>
        </div>
        <div class="courses-item" onclick="window.location = 'sub-course.php'">
            <div class="atas">
                <div class="item">
                    <img src="imgs/web.png" alt="">
                </div>
                <div class="item">
                    <span>Basics</span>
                    <span>Basics Create Website</span>
                </div>
            </div>
            <div class="bawah">
                <span>
                    Underneath, we'll delve into the fundamental elements of HTML that you need to grasp in order to edit and create content for your website. From the basic structure to essential tags, let's explore the fundamentals of HTML that will enable you to manage and modify your website's content effortlessly.
                </span>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include("components/footer.php") ?>
    <!-- akhir footer -->
</body>

</html>