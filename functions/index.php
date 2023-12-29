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

function updateCourse($data)
{
    $idCourse = $data["id-course"];
    $namaCourse = $data["nama-course"];
    $jenisCourse = $data["jenis-course"];
    $deskripsi = $data["desk-course"];

    global $conn;
    $query = "UPDATE courses SET nama_course = ?, jenis_course = ?, deskripsi = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $namaCourse, $jenisCourse, $deskripsi, $idCourse);
    mysqli_stmt_execute($stmt);
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
    updateCourse($_POST);
}

if (isset($_GET["id-hapus"])) {
    deleteCourse($_GET["id-hapus"]);
}
