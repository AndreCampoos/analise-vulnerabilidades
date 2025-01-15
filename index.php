<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de Vulnerabilidades - Home</title>
    <link rel="stylesheet" href="css/main.css?v=1.0"> <!-- ?v=1.0 para forçar a atualização da cache -->
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bd13738cac.js" crossorigin="anonymous"></script>
</head>
<body>
  <nav class="navbar navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="">
        <img src="img/icon.png" alt="Logotipo" class="logo">
      </a>
      <a style='color: black;' href="opinion.php">Opinion</a>
      <a href="account/login.php">
        <i class="fa-solid fa-user fa-lg"></i>
      </a>
    </div>
  </nav>
  <div class="container-fluid div-spacing">
    <div class="row">
      <div class="title col-md-6">
        <h2 class='title-h2'><b>Around The World</b></h2>
        <p class='title-p'>Discover the world like never before! Explore the beauty and diversity of fascinating countries, each with unique attractions that tell unforgettable stories, cultures and landscapes. 
          <br>From historical monuments to natural wonders, your next destination is just a click away.
        </p>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="country-image col-md-6">
            <a href="">
              <img src="img/paris.jpg" alt="">
              <p>Paris, France</p>
            </a>
          </div>
          <div class="country-image col-md-6">
            <a href="">
              <img src="img/tokyo.jpg" alt="">
              <p>Tokyo, Japan</p>
            </a>
          </div>
        </div>

        <div class="row">
          <div class="country-image col-md-6">
            <a href="">
              <img src="img/eua.jpg" alt="">
              <p>New York, EUA</p>
            </a>
          </div>
          <div class="country-image col-md-6">
            <a href="">
              <img src="img/barcelona.jpg" alt="">
              <p>Barcelona, Spain</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>