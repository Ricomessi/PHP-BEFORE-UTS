<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo 'Attempting to redirect...';
    header('Location: login.php');
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
                        <a class="nav-link" href="main.php">Isi Formulir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cari.php">Cari Data</a>
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

        $resultsPerPage = 5; // Number of results per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $resultsPerPage;

        // Fetch data with pagination
        if (!isset($_GET['query']) || empty($_GET['query'])) {
            $sql = "SELECT * FROM dataprofil LIMIT $resultsPerPage OFFSET $offset"; // Fetch limited results if query is empty
        } else {
            $query = $_GET['query'];
            $sql = "SELECT * FROM dataprofil WHERE nama LIKE '%$query%' LIMIT $resultsPerPage OFFSET $offset"; // Fetch limited results based on query
        }

        $result = $koneksi->query($sql); // Run the SQL query

        $searchResults = [];
        $searchMessage = "";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $searchResults[] = $row;
            }
        } else {
            $searchMessage = "Tidak ada hasil pencarian untuk '$query'.";
        }

        // Fetch the total count of results
        $totalCountQuery = "SELECT COUNT(*) AS total FROM dataprofil";
        if (!empty($query)) {
            $totalCountQuery = "SELECT COUNT(*) AS total FROM dataprofil WHERE nama LIKE '%$query%'";
        }
        $totalResult = $koneksi->query($totalCountQuery);
        $total_records = $totalResult->fetch_assoc()['total'];

        $total_pages = ceil($total_records / $resultsPerPage);

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
                            <th>Update</th>
                            <th>Delete</th>
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
                                <td><a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Update</a></td>
                                <td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php if ($total_pages > 1) : ?>
                        <div class="pagination">
                            <?php if ($page > 1) : ?>
                                <a class="btn btn-secondary" href="cari.php?query=<?php echo $query; ?>&page=<?php echo $page - 1; ?>">Previous</a>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                <?php if ($i == $page) : ?>
                                    <span class="btn btn-secondary"><?php echo $i; ?></span>
                                <?php else : ?>
                                    <a class="btn btn-secondary" href="cari.php?query=<?php echo $query; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <?php if ($page < $total_pages) : ?>
                                <a class="btn btn-secondary" href="cari.php?query=<?php echo $query; ?>&page=<?php echo $page + 1; ?>">Next</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            </div>
</body>

</html>