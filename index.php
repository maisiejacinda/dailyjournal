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
                        <a class="nav-link" href="#article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery">Gallery</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid hero-section text-sm-start">
        <div class="container">
            <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <img src="monas.jpg" alt="Monas" class="img-fluid" width="300">
                <div>
                    <h1 class="fw-bold display-4">Create Memories, Save Memories, Everyday</h1>
                    <h4 class="lead display-6">Tempat bersejarah Kemerdekaan Indonesia</h4>
                </div>
            </div>
        </div>
    </div>

    <hr align="center" color="#000000" size="3" width="100%">

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
    <div class="container" id="gallery">
        <h2 align="center">- Gallery -</h2>
        <div id="carouselGallery" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="tuguproklamasi.jpg" class="d-block w-100" alt="Gambar 1">
                </div>
                <div class="carousel-item">
                    <img src="rumahrengasdengklok.jpg" class="d-block w-100" alt="Gambar 2">
                </div>
                <div class="carousel-item">
                    <img src="hotelmajapahit.jpg" class="d-block w-100" alt="Gambar 3">
                </div>
               
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselGallery" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselGallery" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <footer class="bg-light text-center py-3">
        <div class="container">   
            <div class="d-flex justify-content-center align-items-center mb-2">
                <a href="https://www.instagram.com" class="mx-2" target="_blank">
                    <img src="https://img.icons8.com/ios-filled/50/000000/instagram-new.png" alt="Instagram" width="30"/>
                </a>
                <a href="https://twitter.com" class="mx-2" target="_blank">
                    <img src="https://img.icons8.com/ios-filled/50/000000/twitter-squared.png" alt="Twitter" width="30"/>
                </a>
                <a href="https://www.linkedin.com" class="mx-2" target="_blank">
                    <img src="https://img.icons8.com/ios-filled/50/000000/linkedin.png" alt="LinkedIn" width="30"/>
                </a>
            </div>
            <p>&copy; 2024 My Daily Journal</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
