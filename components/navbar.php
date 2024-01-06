<nav>
    <div class="nav-logo">
        <a href="">GeekTutors</a>
    </div>
    <div class="nav-menu">
        <a href="index.php"><i class="bi bi-house"></i> Home</a>
        <a href="course.php"><i class="bi bi-code-slash"></i> Course</a>
        <a href="about.php"><i class="bi bi-info-circle"></i> About</a>
        <?php if (!isset($_SESSION["auth"])) : ?>
            <a href="login.php" class="login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
        <?php else : ?>
            <a href="profile.php" class="login"><i class="bi bi-person"></i> Profil</a>
        <?php endif; ?>
    </div>
</nav>