<?php
session_start();
// $conn = mysqli_connect("localhost", "root", "", "geek_tutors");
$conn = mysqli_connect("sql108.infinityfree.com", "if0_35790994", "3yZGLPrmxx5Cw", "if0_35790994_geek_tutors");

function login($data)
{
    global $conn;
    $email = $data["email"];
    $password = $data["password"];

    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $nama, $email, $pw, $role, $foto);
    if (mysqli_stmt_fetch($stmt)) {
        $row = [
            "id" => $id,
            "nama" => $nama,
            "email" => $email,
            "password" => $pw,
            "role" => $role,
            "foto" => $foto,
        ];
        if (password_verify($password, $row["password"])) {
            $_SESSION["auth"] = [
                "id" => $id,
                "nama" => $nama,
                "email" => $email,
                "password" => $pw,
                "role" => $role,
                "foto" => $foto,
            ];
            header("Location: ../index.php");
        } else {
            $_SESSION["notif"] = [
                "jenis" => "gagal",
                "pesan" => "Kata Sandi Salah",
            ];
            header("Location: ../login.php");
        }
    } else {
        $_SESSION["notif"] = [
            "jenis" => "gagal",
            "pesan" => "Email tidak terdaftar",
        ];
        header("Location: ../login.php");
    }
}

function logout()
{
    session_destroy();
    header("Location: index.php");
}

function register($data)
{
    global $conn;
    $namaDepan = $data["nama-depan"];
    $namaBelakang = $data["nama-belakang"];
    $nama = "$namaDepan $namaBelakang";
    $email = $data["email"];
    $password = $data["password"];
    $konfirmasiPassword = $data["konfirmasi-kata-sandi"];

    if ($password != $konfirmasiPassword) {
        return false;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $role = "user";
        $foto = "no_image.jpg";
        $query = "INSERT INTO user VALUES (NULL, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $nama, $email, $password, $role, $foto);
        mysqli_stmt_execute($stmt);
        $_SESSION["notif"] = [
            "jenis" => "berhasil",
            "pesan" => "Registrasi Berhasil",
        ];
        header("Location: ../login.php");
    }
}

function tambahCourse($data, $logo)
{
    $namaCourse = $data["nama-course"];
    $jenisCourse = $data["jenis-course"];
    $deskripsi = $data["desk-course"];

    $ekstensiLogo = explode(".", $logo["name"]);
    $namaLogo = date("YmdHis") . "." . end($ekstensiLogo);

    move_uploaded_file($logo["tmp_name"], "../uploads/$namaLogo");

    global $conn;
    $query = "INSERT INTO courses VALUES(NULL, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $namaCourse, $jenisCourse, $deskripsi, $namaLogo);
    mysqli_stmt_execute($stmt);

    header("Location: ../course.php");
}

function getDataCourse()
{
    global $conn;
    $query = "SELECT * FROM courses";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function getCourseName($id)
{
    global $conn;
    $query = "SELECT * FROM courses WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row["nama_course"];
    }
}

function getCourseNameFromMateri($materiId)
{
    global $conn;

    $query = "SELECT * FROM materi INNER JOIN courses ON materi.course_id = courses.id WHERE materi.id = $materiId";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row["nama_course"];
    }
}

function updateCourse($data, $logo)
{
    $idCourse = $data["id-course"];
    $namaCourse = $data["nama-course"];
    $jenisCourse = $data["jenis-course"];
    $deskripsi = $data["desk-course"];

    global $conn;

    if ($logo["name"] == "") {
        $query = "UPDATE courses SET nama_course = ?, jenis_course = ?, deskripsi = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $namaCourse, $jenisCourse, $deskripsi, $idCourse);
        mysqli_stmt_execute($stmt);
    } else {
        $query = "SELECT * FROM courses WHERE id = $idCourse";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            $namaLogo = $row["logo"];
            unlink("../uploads/$namaLogo");
        }

        $ekstensiLogo = explode(".", $logo["name"]);
        $namaLogo = date("YmdHis") . "." . end($ekstensiLogo);
        move_uploaded_file($logo["tmp_name"], "../uploads/$namaLogo");
        $query = "UPDATE courses SET nama_course = ?, jenis_course = ?, deskripsi = ?, logo = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $namaCourse, $jenisCourse, $deskripsi, $namaLogo, $idCourse);
        mysqli_stmt_execute($stmt);
    }
    header("Location: ../course.php");
}

function deleteCourse($id)
{
    global $conn;

    $query = "SELECT * FROM courses WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $namaLogo = $row["logo"];
        unlink("../uploads/$namaLogo");
    }
    $query = "DELETE FROM courses WHERE id = $id";
    mysqli_query($conn, $query);
    header("Location: ../course.php");
}

function tambahMateri($data)
{
    global $conn;
    $namaMateri = htmlspecialchars($data["nama_materi"]);
    $courseId = $data["course_id"];

    $query = "INSERT INTO materi VALUES(NULL, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $namaMateri, $courseId);
    mysqli_stmt_execute($stmt);

    header("Location: ../sub-course.php?course=$courseId");
}

function getDataMateri($courseId)
{
    global $conn;
    $query = "SELECT * FROM materi WHERE course_id = $courseId";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function updateMateri($data)
{
    global $conn;
    $courseId = $data["course_id"];
    $materiId = $data["materi_id"];
    $namaMateri = htmlspecialchars($data["nama_materi"]);

    $query = "UPDATE materi SET nama_materi = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $namaMateri, $materiId);
    mysqli_stmt_execute($stmt);

    header("Location: ../sub-course.php?course=$courseId");
}

function deleteMateri($materiId, $courseId)
{

    global $conn;

    $query = "DELETE FROM materi WHERE id = $materiId";
    mysqli_query($conn, $query);
    header("Location: ../sub-course.php?course=$courseId");
}

function tambahJudul($data)
{
    global $conn;
    $materiId = $data["materi_id"];
    $courseId = $data["course_id"];
    $isi = htmlspecialchars($data["isi"]);
    $jenisDetailMateri = "judul";

    $query = "INSERT INTO detail_materi VALUES(NULL, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $jenisDetailMateri, $isi, $materiId);
    mysqli_stmt_execute($stmt);

    header("Location: ../detail-sub-course.php?course_id=$courseId&materi_id=$materiId");
}

function tambahTeks($data)
{
    global $conn;
    $materiId = $data["materi_id"];
    $courseId = $data["course_id"];
    $isi = htmlspecialchars($data["isi"]);
    $jenisDetailMateri = "text";

    $query = "INSERT INTO detail_materi VALUES(NULL, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $jenisDetailMateri, $isi, $materiId);
    mysqli_stmt_execute($stmt);

    header("Location: ../detail-sub-course.php?course_id=$courseId&materi_id=$materiId");
}

function tambahGambar($data, $gambar)
{
    global $conn;
    $materiId = $data["materi_id"];
    $courseId = $data["course_id"];
    $ektensiGambar = explode(".", $gambar["name"])[1];
    $namaGambar = date("YmdHis") . ".$ektensiGambar";
    move_uploaded_file($gambar["tmp_name"], "../uploads/$namaGambar");

    $jenisDetailMateri = "gambar";

    $query = "INSERT INTO detail_materi VALUES(NULL, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $jenisDetailMateri, $namaGambar, $materiId);
    mysqli_stmt_execute($stmt);

    header("Location: ../detail-sub-course.php?course_id=$courseId&materi_id=$materiId");
}

function getJudulMateri($materi_id)
{
    global $conn;
    $query = "SELECT * FROM materi WHERE id = $materi_id";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row["nama_materi"];
    }
}

function getFirstIdMateri($courseId)
{
    global $conn;
    $query = "SELECT * FROM materi WHERE course_id = $courseId";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows[0]["id"];
}
function getLastIdMateri($courseId)
{
    global $conn;
    $query = "SELECT * FROM materi WHERE course_id = $courseId";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return end($rows)["id"];
}

function getDataDetailMateri($materiId)
{
    global $conn;
    $query = "SELECT * FROM detail_materi WHERE materi_id = $materiId";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function updateDetailMateri($data)
{
    global $conn;
    $detailMateriId = $data["detail_materi_id"];
    $materiId = $data["materi_id"];
    $courseId = $data["course_id"];
    $jenis = $data["jenis"];
    $isi = htmlspecialchars($data["isi"]);

    // var_dump([
    //     $detailMateriId = $data["detail_materi_id"],
    //     $materiId = $data["materi_id"],
    //     $jenis = $data["jenis"],
    //     $isi = $data["isi"],
    // ]);
    // exit;
    $query = "UPDATE detail_materi SET isi = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $isi, $detailMateriId);
    mysqli_stmt_execute($stmt);

    header("Location: ../detail-sub-course.php?course_id=$courseId&materi_id=$materiId");
}

function updateDetailMateriGambar($data, $gambar)
{
    global $conn;
    $detailMateriId = $data["detail_materi_id"];
    $materiId = $data["materi_id"];
    $courseId = $data["course_id"];
    $ektensiGambar = explode(".", $gambar["name"])[1];
    $namaGambar = date("YmdHis") . ".$ektensiGambar";
    move_uploaded_file($gambar["tmp_name"], "../uploads/$namaGambar");

    $query = "SELECT * FROM detail_materi WHERE id = $detailMateriId";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $namaGambarLama = $row["isi"];
        unlink("../uploads/$namaGambarLama");
    }

    $query = "UPDATE detail_materi SET isi = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $namaGambar, $detailMateriId);
    mysqli_stmt_execute($stmt);

    header("Location: ../detail-sub-course.php?course_id=$courseId&materi_id=$materiId");
}

function deleteDetailMateri($detailMateriId, $materiId, $courseId)
{
    global $conn;
    $query = "DELETE FROM detail_materi WHERE id = $detailMateriId";
    mysqli_query($conn, $query);
    header("Location: ../detail-sub-course.php?course_id=$courseId&materi_id=$materiId");
}

function deleteDetailMateriGambar($detailMateriId, $materiId, $courseId)
{
    global $conn;
    $query = "SELECT * FROM detail_materi WHERE id = $detailMateriId";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $namaGambarLama = $row["isi"];
        unlink("../uploads/$namaGambarLama");
    }

    $query = "DELETE FROM detail_materi WHERE id = $detailMateriId";
    mysqli_query($conn, $query);
    header("Location: ../detail-sub-course.php?course_id=$courseId&materi_id=$materiId");
}

function updateNama($data)
{
    global $conn;
    $namaBaru = $data["nama_baru"];
    $id = $_SESSION["auth"]["id"];
    $query = "UPDATE user SET nama = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $namaBaru, $id);
    mysqli_stmt_execute($stmt);
    $_SESSION["auth"]["nama"] = $namaBaru;

    header("Location: ../profile.php");
}

function updateFoto($gambar)
{
    global $conn;
    $userId = $_SESSION["auth"]["id"];
    $ekstensiGambar = explode(".", $gambar["name"])[1];
    $namaGambar = date("YmdHis") . ".$ekstensiGambar";

    $namaGambarLama = $_SESSION["auth"]["foto"];
    if ($namaGambarLama != "no_image.jpg") {
        unlink("../uploads/$namaGambarLama");
    }
    $query = "UPDATE user SET foto = '$namaGambar' WHERE id = $userId";
    mysqli_query($conn, $query);
    move_uploaded_file($gambar["tmp_name"], "../uploads/$namaGambar");
    $_SESSION["auth"]["foto"] = $namaGambar;
    header("Location: ../profile.php");
}

function gantiKataSandi($data)
{
    global $conn;
    $userId = $_SESSION["auth"]["id"];
    $kataSandiLama = $_SESSION["auth"]["password"];
    $inputkataSandiLama = $data["kata-sandi-lama"];
    $kataSandiBaru = $data["kata-sandi-baru"];
    $konfirmasiKataSandiBaru = $data["konfirmasi-kata-sandi-baru"];

    if (password_verify($inputkataSandiLama, $kataSandiLama)) {
        if ($kataSandiBaru == $konfirmasiKataSandiBaru) {
            $kataSandiBaru = password_hash($kataSandiBaru, PASSWORD_DEFAULT);
            $query = "UPDATE user SET password = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "si", $kataSandiBaru, $userId);
            mysqli_stmt_execute($stmt);
            $_SESSION["auth"]["password"] = $kataSandiBaru;
            $_SESSION["notif"] = [
                "jenis" => "berhasil",
                "pesan" => "Berhasil Mengganti Kata Sandi",
            ];
            header("Location: ../profile.php");
        } else {
            $_SESSION["notif"] = [
                "jenis" => "gagal",
                "pesan" => "Konfirmasi Kata Sandi Tidak Sama",
            ];
            header("Location: ../profile.php");
        }
    } else {
        $_SESSION["notif"] = [
            "jenis" => "gagal",
            "pesan" => "Kata Sandi Lama Tidak Cocok",
        ];
        header("Location: ../profile.php");
    }
}

function catatRiwayatCourse($materiId, $courseId, $userId)
{
    global $conn;
    $query = "INSERT INTO riwayat_course_dilihat VALUES(NULL, $materiId, $courseId, $userId)";
    mysqli_query($conn, $query);
}

function getRiwayatCourse($userId)
{
    global $conn;
    $query = "SELECT * FROM riwayat_course_dilihat rcd INNER JOIN materi ON rcd.materi_id = materi.id INNER JOIN courses ON rcd.course_id = courses.id WHERE user_id = $userId ORDER BY rcd.id DESC";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function getJumlahCourse()
{
    global $conn;
    $query = "SELECT COUNT(*) as total FROM courses";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result)["total"];
}

function getJumlahUser()
{
    global $conn;
    $query = "SELECT COUNT(*) as total FROM user WHERE role != 'admin'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result)["total"];
}

// ============================================

if (isset($_POST["login"])) {
    login($_POST);
}

if (isset($_POST["register"])) {
    register($_POST);
}

if (isset($_POST["tambah-course"])) {
    tambahCourse($_POST, $_FILES["logo-course"]);
}

if (isset($_POST["edit-course"])) {
    updateCourse($_POST, $_FILES["logo-course"]);
}

if (isset($_GET["id-hapus"])) {
    deleteCourse($_GET["id-hapus"]);
}

if (isset($_POST["tambah-materi"])) {
    tambahMateri($_POST);
}

if (isset($_POST["update-materi"])) {
    updateMateri($_POST);
}

if (isset($_GET["id-hapus-materi"])) {
    deleteMateri($_GET["id-hapus-materi"], $_GET["course-id"]);
}

if (isset($_POST["tambah-judul"])) {
    tambahJudul($_POST);
}

if (isset($_POST["tambah-teks"])) {
    tambahTeks($_POST);
}

if (isset($_POST["tambah-gambar"])) {
    tambahGambar($_POST, $_FILES["pilih-gambar"]);
}

if (isset($_POST["edit-detail-materi"])) {
    updateDetailMateri($_POST);
}

if (isset($_POST["edit-detail-materi-gambar"])) {
    updateDetailMateriGambar($_POST, $_FILES["isi"]);
}

if (isset($_GET["id-hapus-detail-materi"])) {
    deleteDetailMateri($_GET["id-hapus-detail-materi"], $_GET["materi-id"], $_GET["course-id"]);
}

if (isset($_GET["id-hapus-detail-materi-gambar"])) {
    deleteDetailMateriGambar($_GET["id-hapus-detail-materi-gambar"], $_GET["materi-id"], $_GET["course-id"]);
}

if (isset($_POST["update-nama"])) {
    updateNama($_POST);
}

if (isset($_POST["update-foto"])) {
    updateFoto($_FILES["foto_baru"]);
}

if (isset($_POST["ganti-kata-sandi"])) {
    gantiKataSandi($_POST);
}
