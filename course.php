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
        <div class="courses-item">
            <form action="" method="post">
                <div class="atas">
                    <div class="user">
                        <div class="item">
                            <img src="imgs/html.png" alt="">
                        </div>
                        <div class="item">
                            <span>Basics</span>
                            <input type="text" name="type" id="type">
                            <span>Basic Of Html To Edit Website</span>
                            <input type="text" name="course_sub_name" id="course_sub_name">
                        </div>
                    </div>
                    <div class="admin">
                        <button type="button" class="btn-batal edit-course">Batal</button>
                        <button jenis="button" type="button" class="btn-edit edit-course">Edit</button>
                    </div>
                </div>
                <div class="bawah">
                    <span>Underneath, we'll delve into the fundamental elements of HTML that you need to grasp in order to edit and create content for your website. From the basic structure to essential tags, let's explore the fundamentals of HTML that will enable you to manage and modify your website's content effortlessly.</span>
                    <input type="text" name="course_desk" id="course_desk"></input>
                </div>
            </form>
        </div>
        <div class="courses-item">
            <form action="" method="post">
                <div class="atas">
                    <div class="user">
                        <div class="item">
                            <img src="imgs/css.png" alt="">
                        </div>
                        <div class="item">
                            <span>Basics</span>
                            <input type="text" name="course_name" id="course_name">
                            <span>Basic Of CSS To Edit Website</span>
                            <input type="text" name="course_sub_name" id="course_sub_name">
                        </div>
                    </div>
                    <div class="admin">
                        <button type="button" class="btn-batal edit-course">Batal</button>
                        <button jenis="button" type="button" class="btn-edit edit-course">Edit</button>
                    </div>
                </div>
                <div class="bawah">
                    <span>Underneath, we'll delve into the fundamental elements of HTML that you need to grasp in order to edit and create content for your website. From the basic structure to essential tags, let's explore the fundamentals of HTML that will enable you to manage and modify your website's content effortlessly.</span>
                    <input type="text" name="course_desk" id="course_desk"></input>
                </div>
            </form>
        </div>
        <div class="courses-item">
            <form action="" method="post">
                <div class="atas">
                    <div class="user">
                        <div class="item">
                            <img src="imgs/web.png" alt="">
                        </div>
                        <div class="item">
                            <span>Basics</span>
                            <input type="text" name="course_name" id="course_name">
                            <span>Basic Of CSS To Edit Website</span>
                            <input type="text" name="course_sub_name" id="course_sub_name">
                        </div>
                    </div>
                    <div class="admin">
                        <button type="button" class="btn-batal edit-course">Batal</button>
                        <button jenis="button" type="button" class="btn-edit edit-course">Edit</button>
                    </div>
                </div>
                <div class="bawah">
                    <span>Underneath, we'll delve into the fundamental elements of HTML that you need to grasp in order to edit and create content for your website. From the basic structure to essential tags, let's explore the fundamentals of HTML that will enable you to manage and modify your website's content effortlessly.</span>
                    <input type="text" name="course_desk" id="course_desk"></input>
                </div>
            </form>
        </div>
    </section>
    <!-- footer -->
    <?php include("components/footer.php") ?>
    <!-- akhir footer -->

    <script src="js/course.js"></script>
</body>

</html>