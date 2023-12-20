<?php
session_start();
if (!isset($_SESSION['username2'])) {
    echo 'Attempting to redirect...';
    header('Location: userver.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Data Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .search-results {
            margin: 20px;
        }

        .search-results table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        .search-results th,
        .search-results td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        .search-results th {
            background-color: #f2f2f2;
        }

        .search-form {
            margin-top: 20px;
            margin-bottom: 20px;
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
                        <a class="nav-link btn btn-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-4">Pencarian Data Profil</h1>
        <div class="search-form">
            <form action="" method="get">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Cari Nama">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
        </div>

        <?php
        include 'koneksi.php';

        $searchResults = [];
        $searchMessage = "";

        // Periksa apakah query parameter tidak ada atau kosong
        if (!isset($_GET['query']) || empty($_GET['query'])) {
            $sql = "SELECT * FROM dataprofil"; // Tampilkan semua data jika query kosong
        } else {
            $query = $_GET['query'];
            $sql = "SELECT * FROM dataprofil WHERE nama LIKE '%$query%'";
        }

        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $searchResults[] = $row;
            }
        } else {
            $searchMessage = "Tidak ada hasil pencarian untuk '$query'.";
        }
        ?>

        <?php if (empty($searchResults)) : ?>
            <div class="search-results">
                <p>Data tidak ditemukan.</p>
            </div>
        <?php elseif (!empty($searchResults)) : ?>
            <div class="search-results">
                <h2>Hasil Pencarian:</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Sekolah Asal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($searchResults as $row) : ?>
                            <tr>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['alamat']; ?></td>
                                <td><?php echo $row['jenis_kelamin']; ?></td>
                                <td><?php echo $row['agama']; ?></td>
                                <td><?php echo $row['sekolah_asal']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>