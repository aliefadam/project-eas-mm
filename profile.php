<?php require_once("functions/index.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- navbar -->
    <?php include("components/navbar.php") ?>
    <!-- akhir navbar -->

    <div class="container">
        <div class="detail-akun">
            <div class="detail">
                <div class="kiri">
                    <form action="functions/index.php" method="post" enctype="multipart/form-data">
                        <img class="foto" src="uploads/<?= $_SESSION["auth"]["foto"] ?>" alt="">
                        <input type="file" name="foto_baru" id="foto_baru">
                        <div class="aksi simpan-perubahan-foto" style="display: none;">
                            <button type="button">Batal</button>
                            <button type="submit" name="update-foto">Simpan</button>
                        </div>
                    </form>
                </div>
                <div class="kanan">
                    <form action="functions/index.php" method="post">
                        <div class="aksi simpan-perubahan">
                            <button type="button">Batal</button>
                            <button type="submit" name="update-nama">Simpan</button>
                        </div>
                        <span class="nama"><?= $_SESSION["auth"]["nama"] ?><i class="bi bi-pencil-square btn-edit-nama"></i></span>
                        <input type="text" name="nama_baru" id="nama_baru" class="ubah-nama">
                        <span class="email"><?= $_SESSION["auth"]["email"] ?></span>
                    </form>
                </div>
                <div class="aksi">
                    <span><i class="bi bi-shield-lock"></i> Ganti Kata Sandi</span>
                    <span class="logout"><i class="bi bi-box-arrow-left"></i> Logout</span>
                </div>
            </div>
            <div class="ubah-kata-sandi">
                <h2>Ganti Kata Sandi</h2>
                <form action="functions/index.php" method="post">
                    <div class="form-item">
                        <label for="kata-sandi-lama">Kata Sandi Lama</label>
                        <input type="password" name="kata-sandi-lama" id="kata-sandi-lama">
                    </div>
                    <div class="form-item">
                        <label for="kata-sandi-baru">Kata Sandi Baru</label>
                        <input type="password" name="kata-sandi-baru" id="kata-sandi-baru">
                    </div>
                    <div class="form-item">
                        <label for="konfirmasi-kata-sandi-baru">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="konfirmasi-kata-sandi-baru" id="konfirmasi-kata-sandi-baru">
                    </div>
                    <div class="form-item aksi">
                        <button type="button">Batal</button>
                        <button type="submit" name="ganti-kata-sandi">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <?php if ($_SESSION["auth"]["role"] == "admin") : ?>
            <div class="admin">
                <div class="item">
                    <span class="jumlah"><?= getJumlahCourse() ?></span>
                    <span class="keterangan">Jumlah Courses Saat Ini</span>
                </div>
                <div class="item">
                    <span class="jumlah"><?= getJumlahUser() ?></span>
                    <span class="keterangan">Jumlah User Terdaftar</span>
                </div>
            </div>
        <?php else : ?>
            <div class="riwayat-course">
                <h2>Riwayat Course</h2>
                <div class="scroll">
                    <?php foreach (getRiwayatCourse($_SESSION["auth"]["id"]) as $riwayat) : ?>
                        <a href="detail-sub-course.php?course_id=<?= $riwayat["course_id"] ?>&materi_id=<?= $riwayat["materi_id"] ?>" class="riwayat">
                            <span><?= $riwayat["nama_materi"] ?> - <?= $riwayat["nama_course"] ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif ?>
    </div>

    <!-- notifikasi -->
    <?php if (isset($_SESSION["notif"])) : ?>
        <div class="overlay-notifikasi">
            <div class="notifikasi">
                <?php if ($_SESSION["notif"]["jenis"] == "gagal") : ?>
                    <i class="bi bi-x-circle gagal"></i>
                <?php else : ?>
                    <i class="bi bi-check-circle berhasil"></i>
                <?php endif; ?>
                <span class="pesan"><?= $_SESSION["notif"]["pesan"] ?></span>
                <button type="button">OK</button>
            </div>
        </div>
        <?php unset($_SESSION["notif"]); ?>
    <?php endif; ?>
    <!-- akhir notifikasi -->

    <script src="js/profile.js"></script>
</body>

</html>