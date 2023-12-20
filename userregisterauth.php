<?php
session_start();
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    $fullName = $_POST['registerFullName'];
    $username = $_POST['registerUsername'];
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];

    if (empty($fullName)) {
        $errors[] = "Nama tidak boleh kosong.";
    }

    if (empty($username)) {
        $errors[] = "Username tidak boleh kosong.";
    } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        $errors[] = "Username hanya boleh mengandung huruf, angka, dan underscore.";
    }

    if (empty($email)) {
        $errors[] = "Email tidak boleh kosong.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid. Mohon masukkan alamat email yang valid.";
    }

    if (empty($password)) {
        $errors[] = "Password tidak boleh kosong.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password harus memiliki setidaknya 8 karakter.";
    }

    if (empty($errors)) {

        $insertQuery = "INSERT INTO users (full_name, username, email, password) VALUES ('$fullName', '$username', '$email', '$password')";

        if ($koneksi->query($insertQuery) === TRUE) {
            $_SESSION['success'] = "Registrasi Berhasil!";
            header("Location: userver.php");
            exit;
        } else {
            echo "Error: " . $koneksi->error;
            exit;
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: userver.php");
        exit;
    }
}

$koneksi->close();
