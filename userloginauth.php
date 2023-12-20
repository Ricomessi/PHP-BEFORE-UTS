<?php
session_start();
include 'koneksi.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];


    $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username2'] = $row['username'];
        header("Location: mainuser.php");
    } else {
        $errors = "Gagal, silahkan login kembali dengan username dan password yang lain";
        $_SESSION['errorsu'] = $errors;
        header("Location: userver.php");
    }
}
