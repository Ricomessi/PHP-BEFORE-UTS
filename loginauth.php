<?php
session_start();
include 'koneksi.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $stmt = $koneksi->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        header("Location: main.php");

    } else {
        $errors = "Gagal, silahkan login kembali dengan username dan password yang lain";
        $_SESSION['errors'] = $errors;
        header("Location: login.php");
    }
}
