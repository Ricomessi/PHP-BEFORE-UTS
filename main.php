<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
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
                        <a class="nav-link" href="main.php">Isi Formulir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cari.php">Lihat Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger" href="logout.php">Logout</a>
                    </li>
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
    <form action="proses.php" method="post" class="max-w-4xl mx-auto p-8 bg-gray-100 rounded-lg shadow-md">
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

    <table class="max-w-8xl mx-auto mt-8 bg-gray-100 rounded-lg shadow-md">
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Alamat</th>
            <th class="px-4 py-2">Jenis Kelamin</th>
            <th class="px-4 py-2">Agama</th>
            <th class="px-4 py-2">Sekolah Asal</th>
            <th class="px-4 py-2">Update</th>
            <th class="px-4 py-2">Delete</th>
        </tr>
        <?php
        include 'koneksi.php';

        $sql = "SELECT COUNT(*) as total_records FROM dataprofil";
        $result = $koneksi->query($sql);
        $row = $result->fetch_assoc();
        $total_records = $row['total_records'];

        // Jumlah data yang ingin ditampilkan per halaman
        $records_per_page = 5;

        // Halaman yang sedang ditampilkan, diambil dari parameter "page" dalam URL
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

        // Hitung offset (posisi awal data untuk halaman saat ini)
        $offset = ($page - 1) * $records_per_page;

        $sql = "SELECT * FROM dataprofil LIMIT $records_per_page OFFSET $offset";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='border px-4 py-2'>" . $row['nama'] . "</td>";
                echo "<td class='border px-4 py-2'>" . $row['alamat'] . "</td>";
                echo "<td class='border px-4 py-2'>" . $row['jenis_kelamin'] . "</td>";
                echo "<td class='border px-4 py-2'>" . $row['agama'] . "</td>";
                echo "<td class='border px-4 py-2'>" . $row['sekolah_asal'] . "</td>";
                echo '<td class="border px-4 py-2"><a href="update.php?id=' . $row['id'] . '" class="btn btn-primary">Update</a></td>';
                echo '<td class="border px-4 py-2"><a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td class='border px-4 py-2' colspan='7'>Tidak ada data profil.</td></tr>";
        }

        $koneksi->close();
        ?>
    </table>
    <div class="mt-4 mx-4">
        <?php
        $total_pages = ceil($total_records / $records_per_page);

        if ($total_pages > 1) {
            if ($page > 1) {
                $prev_page = $page - 1;
                echo '<a class="btn btn-secondary" href="main.php?page=' . $prev_page . '">Previous</a> ';
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    echo '<span class="btn btn-secondary">' . $i . '</span> ';
                } else {
                    echo '<a class="btn btn-secondary" href="main.php?page=' . $i . '">' . $i . '</a> ';
                }
            }

            if ($page < $total_pages) {
                $next_page = $page + 1;
                echo '<a class="btn btn-secondary" href="main.php?page=' . $next_page . '">Next</a>';
            }
        }
        ?>
    </div>
    <nav class="navbar fixed-bottom navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-text">
                &copy; <?php echo date("Y"); ?> Made by Rico Mesias Tamba
            </span>
        </div>
    </nav>
</body>

</html>