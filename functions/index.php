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




// ============================================

if (isset($_POST["login"])) {
    login($_POST);
}

if (isset($_POST["register"])) {
    register($_POST);
}
