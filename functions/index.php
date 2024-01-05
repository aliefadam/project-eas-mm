<?php

$conn = mysqli_connect("localhost", "root", "", "geek_tutors");

function login($data)
{
    global $conn;
    $email = $data["email"];
    $password = $data["password"];

    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $nama, $email, $pw, $role);
    if (mysqli_stmt_fetch($stmt)) {
        $row = [
            "id" => $id,
            "nama" => $nama,
            "email" => $email,
            "password" => $pw,
            "role" => $role,
        ];
        if (password_verify($password, $row["password"])) {
            header("Location: ../index.php");
        } else {
            header("Location: ../login.php");
        }
    } else {
        header("Location: ../login.php");
    }
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
        $role = "User";
        $query = "INSERT INTO user VALUES (NULL, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $nama, $email, $password, $role);
        mysqli_stmt_execute($stmt);
        header("Location: ../index.php");
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
    $isi = htmlspecialchars($data["isi"]);
    $jenisDetailMateri = "judul";

    $query = "INSERT INTO detail_materi VALUES(NULL, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $jenisDetailMateri, $isi, $materiId);
    mysqli_stmt_execute($stmt);

    header("Location: ../detail-sub-course.php?materi_id=$materiId");
}

function tambahTeks($data)
{
    global $conn;
    $materiId = $data["materi_id"];
    $isi = htmlspecialchars($data["isi"]);
    $jenisDetailMateri = "text";

    $query = "INSERT INTO detail_materi VALUES(NULL, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $jenisDetailMateri, $isi, $materiId);
    mysqli_stmt_execute($stmt);

    header("Location: ../detail-sub-course.php?materi_id=$materiId");
}

function tambahGambar($data, $gambar)
{
    global $conn;
    $materiId = $data["materi_id"];
    $ektensiGambar = explode(".", $gambar["name"])[1];
    $namaGambar = date("YmdHis") . ".$ektensiGambar";
    move_uploaded_file($gambar["tmp_name"], "../uploads/$namaGambar");

    $jenisDetailMateri = "gambar";

    $query = "INSERT INTO detail_materi VALUES(NULL, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $jenisDetailMateri, $namaGambar, $materiId);
    mysqli_stmt_execute($stmt);

    header("Location: ../detail-sub-course.php?materi_id=$materiId");
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

    header("Location: ../detail-sub-course.php?materi_id=$materiId");
}

function updateDetailMateriGambar($data, $gambar)
{
    global $conn;
    $detailMateriId = $data["detail_materi_id"];
    $materiId = $data["materi_id"];
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

    header("Location: ../detail-sub-course.php?materi_id=$materiId");
}

function deleteDetailMateri($detailMateriId, $materiId)
{
    global $conn;
    $query = "DELETE FROM detail_materi WHERE id = $detailMateriId";
    mysqli_query($conn, $query);
    header("Location: ../detail-sub-course.php?materi_id=$materiId");
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
    deleteDetailMateri($_GET["id-hapus-detail-materi"], $_GET["materi-id"]);
}
