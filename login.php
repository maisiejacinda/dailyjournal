<?php
//memulai session atau melanjutkan session yang sudah ada
session_start();

//menyertakan code dari file koneksi
include "koneksi.php";

//check jika sudah ada user yang login arahkan ke halaman admin
if (isset($_SESSION['username'])) { 
	header("location:admin.php"); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['user'];
  
  //menggunakan fungsi enkripsi md5 supaya sama dengan password  yang tersimpan di database
  $password = md5($_POST['pass']);

	//prepared statement
  $stmt = $conn->prepare("SELECT username 
                          FROM user 
                          WHERE username=? AND password=?");

	//parameter binding 
  $stmt->bind_param("ss", $username, $password);//username string dan password string
  
  //database executes the statement
  $stmt->execute();
  
  //menampung hasil eksekusi
  $hasil = $stmt->get_result();
  
  //mengambil baris dari hasil sebagai array asosiatif
  $row = $hasil->fetch_array(MYSQLI_ASSOC);

  //check apakah ada baris hasil data user yang cocok
  if (!empty($row)) {
    //jika ada, simpan variable username pada session
    $_SESSION['username'] = $row['username'];

    //mengalihkan ke halaman admin
    header("location:admin.php");
  } else {
	  //jika tidak ada (gagal), alihkan kembali ke halaman login
    header("location:login.php");
  }

	//menutup koneksi database
  $stmt->close();
  $conn->close();
} else {
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
            background-color: #b3d9ff;/
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
                    Welcome to My daily Journal
                </div>
                <div class="card-body">
                    <?php
                    $username = "admin";
                    $password = "12345";
                    ?>

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

            <div class="mt-3 text-center">
                <?php
                if ($_REQUEST) {
                    if ($_POST['user'] == "admin" and $_POST['pass'] == "12345") {
                   
                        header("Location: A11202314985.html");
                        exit();
                    } else {
                        echo '<div class="alert mt-3">Username atau Password salah!</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
}
?>