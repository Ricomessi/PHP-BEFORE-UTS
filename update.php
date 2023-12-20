<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo 'Attempting to redirect...';
    header('Location: login.php');
    exit();
}

$errors = array();
if (isset($_SESSION['errorsu'])) {
    $errors = $_SESSION['errorsu'];
    unset($_SESSION['errorsu']);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Update Profil</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                        <a class="nav-link" href="main.php">Kembali</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h1 class="text-4xl text-center my-8">Update Profil</h1>
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
    }
    ?>
    <?php
    include 'koneksi.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM dataprofil WHERE id = $id";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <form action="proses_update.php" method="post" class="max-w-4xl mx-auto p-8 bg-gray-100 rounded-lg shadow-md">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700">Nama:</label>
                    <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required class="w-full form-input">
                </div>

                <div class="mb-4">
                    <label for="alamat" class="block text-gray-700">Alamat:</label>
                    <textarea name="alamat" rows="4" cols="50" class="w-full form-input"><?php echo $row['alamat']; ?></textarea>
                </div>

                <div class="mb-4">
                    <label for="jenis_kelamin" class="block text-gray-700">Jenis Kelamin:</label><br>
                    <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki" <?php if ($row['jenis_kelamin'] == 'Laki-laki') echo 'checked'; ?> class="mr-2">
                    <label for="laki-laki">Laki-laki</label><br>

                    <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" <?php if ($row['jenis_kelamin'] == 'Perempuan') echo 'checked'; ?> class="mr-2">
                    <label for="perempuan">Perempuan</label>
                </div>

                <div class="mb-4">
                    <label for="agama" class="block text-gray-700">Agama:</label>
                    <select name="agama" class="w-full form-select">
                        <option value="Islam" <?php if ($row['agama'] == 'Islam') echo 'selected'; ?>>Islam</option>
                        <option value="Kristen" <?php if ($row['agama'] == 'Kristen') echo 'selected'; ?>>Kristen</option>
                        <option value="Katolik" <?php if ($row['agama'] == 'Katolik') echo 'selected'; ?>>Katolik</option>
                        <option value="Hindu" <?php if ($row['agama'] == 'Hindu') echo 'selected'; ?>>Hindu</option>
                        <option value="Budha" <?php if ($row['agama'] == 'Budha') echo 'selected'; ?>>Budha</option>
                        <option value="Konghucu" <?php if ($row['agama'] == 'Konghucu') echo 'selected'; ?>>Konghucu</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="sekolah_asal" class="block text-gray-700">Sekolah Asal:</label>
                    <input type="text" name="sekolah_asal" value="<?php echo $row['sekolah_asal']; ?>" class="w-full form-input">
                </div>

                <div class="mb-4">
                    <input type="submit" value="Update" class="w-full btn btn-primary">
                </div>
            </form>
    <?php
        }
    }
    $koneksi->close();
    ?>
    <nav class="navbar fixed-bottom navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-text">
                &copy; <?php echo date("Y"); ?> Made by Rico Mesias Tamba
            </span>
        </div>
    </nav>
</body>

</html>