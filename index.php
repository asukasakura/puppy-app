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
<div class="container-fluid">
  <div class="row mb-4">
    <div class="col text-center">
      <h1>Listado de razas de perros</h1>
    </div>
  </div>
    <div class="grid">
    <?php
        $url = 'https://dog.ceo/api/breeds/list/all';
        $response = file_get_contents($url);

        $data = json_decode($response);

        $breeds = array_keys((array)$data->message);
        sort($breeds);

        foreach ($breeds as $breed) {
      ?>

      <div class='grid__item'>
        <div class="card text-center mb-2">
            
          <?php
            $_breedUrl = "https://dog.ceo/api/breed/$breed/images/random";
            $_breedResponse = file_get_contents($_breedUrl);
            $_breedData = json_decode($_breedResponse);
            $_breedImageUrl = $_breedData->message;
            
            $subBreedsUrl = "https://dog.ceo/api/breed/$breed/list";
            $subBreedsResponse = file_get_contents($subBreedsUrl);
            $subBreedsData = json_decode($subBreedsResponse);
            if (!empty($subBreedsData->message)) {
            echo "<a href='sub-breeds.php?breed=$breed'>
                    <img src='$_breedImageUrl' alt='$breed' class='card-img-top'/>
                  </a>
                  <div class='card-body'>
                    <a href='sub-breeds.php?breed=$breed'>
                      <h5 class='card-title text-capitalize'>$breed</h5>
                    </a>
                    <a href='sub-breeds.php?breed=$breed' class='btn btn-primary'>Ver sub razas (";
                    echo count($subBreedsData->message);
            echo    ")</a>
                  </div>";
             } else {  
              echo "<img src='$_breedImageUrl' alt='$breed' class='card-img-top'/>
                    <div class='card-body'>
                      <h5 class='card-title text-capitalize'>$breed</h5>
                    </div>";
              }
          ?>

        </div>
      </div>
    <?php } ?>

    </div>
</div>
</body>
</html>
