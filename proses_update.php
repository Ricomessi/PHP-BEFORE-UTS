<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah_asal = $_POST['sekolah_asal'];

    $errorsu = array();

    if (empty($nama)) {
        $errors[] = "Nama tidak boleh kosong";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
        $errorsu[] = "Nama hanya boleh berisi huruf dan spasi";
    }

    if (empty($alamat)) {
        $errorsu[] = "Alamat tidak boleh kosong";
    }

    if (empty($jenis_kelamin)) {
        $errorsu[] = "Pilih jenis kelamin";
    }

    if (empty($agama)) {
        $errorsu[] = "Pilih agama";
    }

    if (empty($sekolah_asal)) {
        $errorsu[] = "Sekolah asal tidak boleh kosong";
    } elseif (preg_match("/[^a-zA-Z0-9\s]/", $sekolah_asal)) {
        $errorsu[] = "Sekolah asal tidak boleh menggunakan karakter selain huruf, angka, atau spasi";
    }

    if (empty($errorsu)) {
        $sql = "UPDATE dataprofil SET nama='$nama', alamat='$alamat', jenis_kelamin='$jenis_kelamin', agama='$agama', sekolah_asal='$sekolah_asal' WHERE id=$id";

        if ($koneksi->query($sql) === TRUE) {
            header("Location: main.php");
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    } else {
        session_start();
        $_SESSION['errorsu'] = $errorsu;
        header("Location: update.php?id=" . $id);
    }
}

$koneksi->close();
