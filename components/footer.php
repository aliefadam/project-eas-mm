<section class="footer">
    <footer>
        <div class="item">
            <div class="sub-item">
                <span class="title">GeekTutors</span>
                <span class="sub-title">Ease of being together</span>
            </div>
            <div class="sub-item">
                <span class="title">MEDIA SOSIAL</span>
                <a href="" class="sub-title">Instagram</a>
                <a href="" class="sub-title">Twitter</a>
                <a href="" class="sub-title">Youtube</a>
            </div>
            <div class="sub-item">
                <span class="title">KURSUS</span>
                <?php foreach (getDataCourse() as $course) : ?>
                    <a href="sub-course.php?course=<?= $course["id"] ?>" class="sub-title"><?= $course["nama_course"] ?></a>
                <?php endforeach ?>
            </div>
            <div class="sub-item">
                <span class="title">TENTANG</span>
                <a href="" class="sub-title">Tentang Kita</a>
                <a href="" class="sub-title">Blog</a>
                <a href="" class="sub-title">Acara</a>
            </div>
        </div>
        <div class="item">
            <div class="sub-item">
                <img src="imgs/Vector.png" alt="">
                <img src="imgs/Vector (1).png" alt="">
                <img src="imgs/Vector (2).png" alt="">
            </div>
            <div class="sub-item">
                <a href="">Term Of Service</a>
                <a href="">Privacy</a>
                <a href="">Return and Refund</a>
            </div>
            <div class="sub-item">
                <span>Copyright &copy; 2023</span>
            </div>
        </div>
    </footer>
</section>