<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah_asal = $_POST['sekolah_asal'];


    $errors = array();


    if (empty($nama)) {
        $errors[] = "Nama tidak boleh kosong";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
        $errors[] = "Nama hanya boleh berisi huruf dan spasi";
    }

    if (empty($alamat)) {
        $errors[] = "Alamat tidak boleh kosong";
    }

    if (empty($jenis_kelamin)) {
        $errors[] = "Pilih jenis kelamin";
    }

    if (empty($agama)) {
        $errors[] = "Pilih agama";
    }

    if (empty($sekolah_asal)) {
        $errors[] = "Sekolah asal tidak boleh kosong";
    } elseif (preg_match("/[^a-zA-Z0-9\s]/", $sekolah_asal)) {
        $errors[] = "Sekolah asal tidak boleh menggunakan karakter selain huruf, angka, atau spasi";
    }


    if (empty($errors)) {
        $sql = "INSERT INTO dataprofil (nama, alamat, jenis_kelamin, agama, sekolah_asal) VALUES ('$nama', '$alamat', '$jenis_kelamin', '$agama', '$sekolah_asal')";

        if ($koneksi->query($sql) === TRUE) {
            $success = "Data Berhasil Disimpan!!";
            $_SESSION['success'] = $success;
            header("Location: main.php");
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: main.php");
    }
}

$koneksi->close();
