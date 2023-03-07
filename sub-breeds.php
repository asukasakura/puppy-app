<!DOCTYPE html>
<html>
<head>
    <title>Listado de razas de perros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php $breed = $_GET['breed']; ?>
  
  <div class="container">
    <div class="row mb-4">
      <div class="col text-center">
        <h1>Listado de razas de perros</h1>
        <h2 class="text-capitalize"> <?php echo $breed; ?> </h2>
      </div>
    </div>
    
    <div class="row justify-content-center">
      
      <?php

      $url = "https://dog.ceo/api/breed/" . $breed . "/images";
      $response = file_get_contents($url);
      $data = json_decode($response, true);
      $imagenes_breed = $data['message'];

      $url = "https://dog.ceo/api/breed/" . $breed . "/list";
      $response = file_get_contents($url);
      $data = json_decode($response, true);
      $subBreeds = $data['message'];

      foreach ($subBreeds as $subBreed) {
        $url = "https://dog.ceo/api/breed/" . $breed . "/" . $subBreed . "/images/random";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $imagen = $data['message']; ?>
        
        <div class='col-12 col-md-6 col-lg-4'>
          <div class="card text-center mb-2">
            <img src='<?php echo $imagen; ?>'  alt='<?php echo $subBreed; ?>' class='card-img-top'>
            <div class='card-body'>
              <h5 class='card-title text-capitalize'><?php echo $breed . ' - ' . $subBreed; ?></h5>
            </div>
          </div>
        </div>
        
        <?php } ?>
        
      </div>
      <a href="index.php"><i class="bi bi-arrow-left me-2"></i> Volver al listado</a>
    </div>
  </body>
  </html>
  