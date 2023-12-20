<?php
session_start();
$errors = array();
$errorsu = ""; 
$success = "";

if (isset($_SESSION['errors'])) {
    $errors = ($_SESSION['errors']);
    unset($_SESSION['errors']);
} else if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
} else if (isset($_SESSION['errorsu'])) {
    $errorsu = $_SESSION['errorsu'];
    unset($_SESSION['errorsu']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Login/Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .login-register-form {
            max-width: 600px;
            margin: 100px auto;
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
                        <a class="nav-link" href="index.php">Kembali</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Pesan Kesalahan Pada Registrasi:</h4>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif (!empty($success)) : ?>
        <div class="alert alert-success" role="alert">
            <p><?php echo $success; ?></p>
        </div>
    <?php elseif (!empty($errorsu)) : ?>
        <div class="alert alert-danger" role="alert">
            <p><?php echo $errorsu; ?></p>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="login-register-form">
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                            <form id="login-form" action="userloginauth.php" method="POST">
                                <div class="form-group">
                                    <label for="loginUsername">Username</label>
                                    <input type="text" class="form-control" id="loginUsername" name="loginUsername" placeholder="Enter username" />
                                </div>
                                <div class="form-group">
                                    <label for="loginPassword">Password</label>
                                    <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Password" />
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                            <form id="register-form" action="userregisterauth.php" method="POST">
                                <div class="form-group">
                                    <label for="registerFullName">Full Name</label>
                                    <input type="text" class="form-control" id="registerFullName" name="registerFullName" placeholder="Enter your full name" />
                                </div>
                                <div class="form-group">
                                    <label for="registerUsername">Username</label>
                                    <input type="text" class="form-control" id="registerUsername" name="registerUsername" placeholder="Enter username" />
                                </div>
                                <div class="form-group">
                                    <label for="registerEmail">Email address</label>
                                    <input type="email" class="form-control" id="registerEmail" name="registerEmail" placeholder="Enter email" />
                                </div>
                                <div class="form-group">
                                    <label for="registerPassword">Password</label>
                                    <input type="password" class="form-control" id="registerPassword" name="registerPassword" placeholder="Password" />
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar fixed-bottom navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-text">
                &copy; <?php echo date("Y"); ?> Made by Rico Mesias Tamba
            </span>
        </div>
    </nav>

    <script>
        $(document).ready(function() {
            $("#myTab a").on("click", function(e) {
                e.preventDefault();
                $(this).tab("show");
            });
        });
    </script>
</body>

</html>