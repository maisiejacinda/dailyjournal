<?php
include "koneksi.php"; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>My Daily Journal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background-color: #f8d7da;
            padding: 50px 0;
        }
        .card-text {
            min-height: 80px;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
        .schedule-row > div {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }

        #profile {
            background-color: #f8d7da;
            padding: 50px 0;
        }
    </style>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">My Daily Journal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto text-dark">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#schedule">Schedule</a>
                    </li>
                     <li class="nav-item">
                       <li class="nav-item">
                        <a class="nav-link" href="#profile">Profile</a>
                    </li>
                        <a class="nav-link" href="#gallery">Gallery</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

   
    <div class="container-fluid hero-section text-sm-start">
        <div class="container">
            <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <img src="img/museum.jpg" alt="Monas" class="img-fluid" width="300">
                <div>
                    <h1 class="fw-bold display-4">Create Memories, Save Memories, Everyday</h1>
                    <h4 class="lead display-6">Informasi Jadwal Kuliah</h4>
                </div>
            </div>
        </div>
    </div>

    <hr>

<!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["isi"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->

<div class="container" id="schedule">
    <h2 class="text-center my-4">Jadwal Kuliah & Kegiatan Mahasiswa</h2>
    <div class="row justify-content-center">
      
        <div class="col-lg-3 col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title text-center">Senin</h5>
                    <p class="card-text">09:00 - 10:30<br>Basis Data<br>Ruang H.3.4</p>
                    <p class="card-text">13:00 - 15:00<br>Dasar Pemrograman<br>Ruang H.3.1</p>
                </div>
            </div>
        </div>
       
        <div class="col-lg-3 col-md-4 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title text-center">Selasa</h5>
                    <p class="card-text">08:00 - 09:30<br>Pemrograman Berbasis Web<br>Ruang D.2.J</p>
                    <p class="card-text">14:00 - 16:00<br>Basis Data<br>Ruang D.3.M</p>
                </div>
            </div>
        </div>
       
        <div class="col-lg-3 col-md-4 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title text-center">Rabu</h5>
                    <p class="card-text">10:00 - 12:00<br>Pemrograman Berbasis Object<br>Ruang D.2.A</p>
                    <p class="card-text">13:30 - 15:00<br>Pemrograman Sisi Server<br>Ruang D.2.A</p>
                </div>
            </div>
        </div>
       
        <div class="col-lg-3 col-md-4 mb-3">
            <div class="card text-dark bg-warning">
                <div class="card-body">
                    <h5 class="card-title text-center">Kamis</h5>
                    <p class="card-text">08:00 - 10:00<br>Pengantar Teknologi Informasi<br>Ruang D.3.N</p>
                    <p class="card-text">11:00 - 13:00<br>Rapat Koordinasi DOSCOM<br>Ruang Rapat G.1</p>
                </div>
            </div>
        </div>
     
        <div class="col-lg-3 col-md-4 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title text-center">Jumat</h5>
                    <p class="card-text">09:00 - 11:00<br>Data Mining<br>Ruang G.2.3</p>
                    <p class="card-text">13:00 - 15:00<br>Information Retrieval<br>Ruang G.2.4</p>
                </div>
            </div>
        </div>
       
        <div class="col-lg-3 col-md-4 mb-3">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h5 class="card-title text-center">Sabtu</h5>
                    <p class="card-text">08:00 - 10:00<br>Bimbingan Karier<br>Online</p>
                    <p class="card-text">10:30 - 12:00<br>Bimbingan Skripsi<br>Online</p>
                </div>
            </div>
        </div>
   
        <div class="col-lg-3 col-md-4 mb-3">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h5 class="card-title text-center">Minggu</h5>
                    <p class="card-text">Tidak Ada Jadwal</p>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="container" id="profile">
        <h2 class="text-center my-4">Profil Mahasiswa</h2>
        <div class="row align-items-center">
        
            <div class="col-md-4 text-center mb-3">
                <img src="img/museum.jpg" alt="Profile Photo" class="profile-img">
            </div>
            
        
            <div class="col-md-8">
                <h2 class="my-4">Maisie Jacinda</h2>
                <h5 class="text-muted">Mahasiswa Teknik Informatika</h5>
                <div class="row align-items-center">
                <table class="table">
                    <tr>
                        <th>NIM</th>
                        <td>A11.2023.14985</td>
                    </tr>
                    <tr>
                        <th>Program Studi</th>
                        <td>Teknik Informatika</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>111202314985@mhs.dinus.ac.id</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>+62 81227895776</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>Jl. Semarang</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

       <div class="container" id="gallery">
    <h2 align="center">- Gallery -</h2>
    <div id="carouselGallery" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            include "koneksi.php";

            $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
            $hasil = $conn->query($sql);
            $active_set = false; // Untuk menetapkan item pertama sebagai active

            while ($row = $hasil->fetch_assoc()) {
                if ($row["gambar"] != '' && file_exists('img/' . $row["gambar"])) {
                    $active_class = (!$active_set) ? ' active' : ''; // Hanya item pertama yang mendapatkan kelas active
                    $active_set = true;
                    echo '<div class="carousel-item' . $active_class . '">';
                    echo '<img src="img/' . $row["gambar"] . '" class="d-block w-100" alt="' . $row["judul"] . '">';
                    echo '</div>';
                }
            }

            // Pesan jika tidak ada gambar dalam database
            if ($hasil->num_rows == 0) {
                echo '<div class="carousel-item active">';
                echo '<p class="text-center">Tidak ada gambar yang tersedia.</p>';
                echo '</div>';
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselGallery" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselGallery" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>


    
    <footer class="bg-light text-center py-3">
        <div class="container">
            <p>&copy; 2024 My Daily Journal</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
