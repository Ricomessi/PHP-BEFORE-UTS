<?php
session_start();
if (!isset($_SESSION['username2'])) {
    header("Location: userver.php");
    exit();
}

include "koneksi.php"; // Pastikan file koneksi.php sudah bena
if (isset($_SESSION['username2'])) {
    $username = $_SESSION['username2'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $target_directory = "uploads/"; // Direktori untuk menyimpan file yang diunggah
    $target_file = $target_directory . basename($_FILES["profile_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file gambar
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if ($check === false) {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }


    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "File tidak diunggah.";
    } else {
        // Jika semua kondisi terpenuhi, coba unggah file
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            echo "File " . htmlspecialchars(basename($_FILES["profile_image"]["name"])) . " berhasil diunggah.";

            // Simpan path file ke dalam database
            $image_path = $target_directory . basename($_FILES["profile_image"]["name"]);

            // Lakukan update ke database termasuk nama file gambar di database
            $sql = "UPDATE users SET full_name='$full_name', email='$email', password='$password', profile_image_path='$image_path' WHERE username='$username'";

            if ($koneksi->query($sql) === TRUE) {
                $success = "Update Telah Berhasil";
                $_SESSION['success'] = $success;
                header("Location: mainuser.php");
            } else {
                echo "Error: " . $sql . "<br>" . $koneksi->error;
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Profile</title>
</head>

<body>
    <h2>Update Profile</h2>
    <form action="updateuser.php" method="post" enctype="multipart/form-data">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" id="full_name" value="<?php echo $row['full_name']; ?>"><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>"><br><br>

        <label for="password">New Password:</label>
        <input type="password" name="password" id="password"><br><br>

        <label for="profile_image">Upload Profile Picture:</label>
        <input type="file" name="profile_image" id="profile_image"><br><br>

        <input type="submit" value="Update">
    </form>
</body>

</html>