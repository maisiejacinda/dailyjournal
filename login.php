<?php
// Memulai session atau melanjutkan session yang sudah ada
session_start();

// Menyertakan code dari file koneksi
include "koneksi.php";

// Check jika sudah ada user yang login arahkan ke halaman admin
if (isset($_SESSION['username'])) { 
    header("location:admin.php"); 
    exit();
}

// Jika form dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['user']);
    $password = md5(htmlspecialchars($_POST['pass'])); // Enkripsi password dengan md5

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT username FROM user WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);

    // Menjalankan query
    $stmt->execute();

    // Menyimpan hasil eksekusi
    $hasil = $stmt->get_result();
    $row = $hasil->fetch_assoc();

    // Check apakah ada user yang cocok
    if ($row) {
        // Jika ada, simpan variable username pada session
        $_SESSION['username'] = $row['username'];
        header("location:admin.php");
    } else {
        // Jika tidak ada (login gagal), tampilkan pesan error
        $error_message = "Username atau Password salah!";
    }

    // Menutup koneksi database
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to My Daily Journal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffebf0; 
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #b3d9ff;
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #ff9ac1;
            border: none;
        }
        .btn-primary:hover {
            background-color: #ff6fa3; 
        }
        .form-control {
            border: 1px solid #ff9ac1; 
        }
        .form-control:focus {
            border-color: #b3d9ff;
            box-shadow: 0 0 5px rgba(179, 217, 255, 0.5);
        }
        .alert {
            background-color: #ffccd5;
            color: #721c24; 
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    Welcome to My Daily Journal
                </div>
                <div class="card-body">
                    <?php if (isset($error_message)) { ?>
                        <div class="alert text-center"> <?php echo $error_message; ?> </div>
                    <?php } ?>

                    <form method="post">
                        <div class="mb-3">
                            <label for="user" class="form-label">Username</label>
                            <input type="text" name="user" id="user" class="form-control" placeholder="Enter your username" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" name="pass" id="pass" class="form-control" placeholder="Enter your password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>&copy; 2024 - Your Website</small>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
