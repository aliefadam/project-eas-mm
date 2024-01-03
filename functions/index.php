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
        $query = "DELETE FROM courses WHERE id = $idCourse";
        mysqli_query($conn, $query);

        $ekstensiLogo = explode(".", $logo["name"]);
        $namaLogo = date("YmdHis") . "." . end($ekstensiLogo);
        move_uploaded_file($logo["tmp_name"], "../uploads/$namaLogo");
        $query = "INSERT INTO courses VALUES(NULL, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $namaCourse, $jenisCourse, $deskripsi, $namaLogo);
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
    $namaMateri = $data["nama_materi"];

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
