<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        /* Custom CSS styles */
        .hero-section {
            background-image: url('img/kucing.jpeg');
            background-size: cover;
            background-position: center;
            color: #fff;
            padding: 100px 0;
            text-align: center;
        }

        .cta-button {
            background-color: #007BFF;
            color: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">PNJ Registration</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="userver.php">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4">Welcome to PNJ Registration</h1>
            <p class="lead">Discover amazing features and services.</p>
            <a href="userver.php" class="btn btn-lg cta-button">Get Started</a>
        </div>
    </section>

    <section class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="img/wisuda.jpeg" class="card-img-top" alt="Feature 1">
                    <div class="card-body">
                        <h5 class="card-title">Graduation</h5>
                        <p class="card-text">Get ready for a memorable graduation experience at PNJ. Explore our services and features to make your graduation day extraordinary.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="img/sapi.jpeg" class="card-img-top" alt="Feature 2">
                    <div class="card-body">
                        <h5 class="card-title">Rectorat</h5>
                        <p class="card-text">Discover our impressive Rektorat Building, a hub for administrative activities and events. It's where ideas turn into action.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="img/OIP.jpeg" class="card-img-top" alt="Feature 3">
                    <div class="card-body">
                        <h5 class="card-title">Library</h5>
                        <p class="card-text">Explore our state-of-the-art library, your gateway to knowledge. It's more than just books; it's an endless source of inspiration.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-dark text-light py-3 text-center">
        <div class="container">
            &copy; <?php echo date("Y"); ?> Made by Rico Mesias Tamba
        </div>
    </footer>

    <!-- Include Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-6ZjFdOed1Fm5nZLxF5LIR9Zwuvzv4C5sXH7U1uOD7z7pJ79R5DGhFbrTVvCht6o4l" crossorigin="anonymous"></script>
</body>

</html>