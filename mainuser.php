<?php
session_start();
if (!isset($_SESSION['username2'])) {
    header("Location: userver.php");
    exit();
}
$errors = array();
$success = "";
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
} else if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

include "koneksi.php";

if (isset($_SESSION['username2'])) {
    $username = $_SESSION['username2'];
    $sql = "SELECT profile_image_path FROM users WHERE username = '$username'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            padding-bottom: 70px;
        }
    </style>
</head>

<body class="bg-gray-300">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Tugas CRUD PHP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="mainuser.php">Isi Formulir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cariuser.php">Lihat Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="updateuser.php">Update User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger" href="logout.php">Logout</a>
                    </li>
                    <?php if ($row && $row['profile_image_path']) : ?>
                        <!-- Menampilkan foto profil jika ada -->
                        <img src="<?php echo $row['profile_image_path']; ?>" alt="Profile Image" class="rounded-circle mr-2" style="width: 40px; height: 40px;">
                    <?php else : ?>
                        <!-- Jika tidak ada foto profil, tampilkan teks default atau logo alternatif -->
                        <a class="navbar-brand text-white" href="#">Tugas CRUD PHP</a>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    if (!empty($errors)) {
        echo '<div class="max-w-4xl mx-auto p-4 bg-red-200 rounded-lg shadow-md mb-8">';
        echo '<h2 class="text-2xl text-red-700 mb-2">Pesan Kesalahan:</h2>';
        echo '<ul class="list-disc list-inside text-red-700">';
        foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
        echo '</div>';
    } else if (!empty($success)) {
        echo '<div class="max-w-4xl mx-auto p-4 bg-green-200 rounded-lg shadow-md mb-8">';
        echo '<ul class="list-disc list-inside text-green-700">';
        echo '<li>' . $success . '</li>';
        echo '</ul>';
        echo '</div>';
    }
    ?>

    <h1 class="text-4xl text-center my-8">Form Profil</h1>
    <form action="prosesuser.php" method="post" class="max-w-4xl mx-auto p-8 bg-gray-100 rounded-lg shadow-md">
        <div class="mb-4">
            <label for="nama" class="block text-gray-700">Nama:</label>
            <input type="text" name="nama" class="w-full form-input" rows="4">
        </div>

        <div class="mb-4">
            <label for="alamat" class="block text-gray-700">Alamat:</label>
            <textarea name="alamat" rows="4" cols="50" class="w-full form-input"></textarea>
        </div>

        <div class="mb-4">
            <label for="jenis_kelamin" class="block text-gray-700">Jenis Kelamin:</label><br>
            <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki" class="mr-2">
            <label for="laki-laki">Laki-laki</label><br>

            <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" class="mr-2">
            <label for="perempuan">Perempuan</label>
        </div>

        <div class="mb-4">
            <label for="agama" class="block text-gray-700">Agama:</label>
            <select name="agama" class="w-full form-select">
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="sekolah_asal" class="block text-gray-700">Sekolah Asal:</label>
            <input type="text" name="sekolah_asal" class="w-full form-input">
        </div>

        <div class="mb-4">
            <input type="submit" value="Simpan" class="w-full btn btn-primary">
        </div>

    </form>
    <nav class="navbar fixed-bottom navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-text">
                &copy; <?php echo date("Y"); ?> Made by Rico Mesias Tamba
            </span>
        </div>
    </nav>
</body>

</html>