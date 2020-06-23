<!doctype html>
<?php

$mysqli = mysqli_connect("localhost", "rleonrlg_rleon", "chompy_5", "rleonrlg_botmysql");

if(!$mysqli){
  echo "Error: no se pudo conectar a BD." . PHP_EOL;
  die();
}


function consultarStock($variedad){
  global $mysqli;
  $resultado = $mysqli->query("SELECT $variedad FROM `stock` WHERE 1");
  $stock = mysqli_fetch_assoc($resultado);
  $cantidad = $stock[$variedad];
  return $cantidad;
}

function consultarPrecio($variedad){
  global $mysqli;
  $resultado = $mysqli->query("SELECT $variedad FROM `precios` WHERE 1");
  $precios = mysqli_fetch_assoc($resultado);
  $precio = $precios[$variedad];
  return $precio;
}

function descuentaStock($numero, $variedad){
  global $mysqli;
  $mysqli->query("UPDATE `stock` SET $variedad = $variedad - $numero");
}

function agregaStock($numero, $variedad){
  global $mysqli;
  $mysqli->query("UPDATE `stock` SET $variedad = $variedad + $numero");
}

 ?>
<html lang="en">
  <head>
    <title>botMySQL &mdash; Website Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:300,400,700,800|Open+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">

  </head>
  <body class="bg-light">

    <body data-spy="scroll" data-target="#ftco-navbar-spy" data-offset="0">

    <div class="site-wrap">

      <nav class="site-menu" id="ftco-navbar-spy">
        <div class="site-menu-inner" id="ftco-navbar">
          <ul class="list-unstyled">
            <li><a href="#section-home">Inicio</a></li>
          </ul>
        </div>
      </nav>

      <header class="site-header">
        <div class="row align-items-center">
          <div class="col-5 col-md-3">

          </div>
          <div class="col-2 col-md-6 text-center site-logo-wrap">
            <a href="index.html" class="site-logo">B</a>
          </div>
          <div class="col-5 col-md-3 text-right menu-burger-wrap">
            <a href="#" class="site-nav-toggle js-site-nav-toggle"><i></i></a>

          </div>
        </div>

      </header> <!-- site-header -->

      <div class="main-wrap " id="section-home">

        <div class="cover_1 overlay bg-light">
          <div class="img_bg" style="background-image: url(images/humintas2.jpg);" data-stellar-background-ratio="0.5">
            <div class="container">
              <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10" data-aos="fade-up">
                  <h2 class="heading mb-5">Bienvenidos a botMySQL</h2>
                  <p><a href="#section-reservation" class="smoothscroll btn btn-outline-white px-5 py-3">Prueba el bot inteligente</a></p>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- .cover_1 -->

        <div class="section"  data-aos="fade-up">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Las mejores empanadas</h2>
              </div>
            </div>
            <div class="row">

              <div class="ftco-46">
                <div class="ftco-46-row d-flex flex-column flex-lg-row">
                  <div class="ftco-46-image" style="background-image: url(images/empanada-queso.png);"></div>
                  <div class="ftco-46-text ftco-46-arrow-left">
                    <h4 class="ftco-46-subheading">Humintas</h4>
                    <h3 class="ftco-46-heading">Humintas a la olla</h3>
                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incide.</p>
                  </div>
                  <div class="ftco-46-image" style="background-image: url(images/charque.jpg);"></div>
                </div>

                <div class="ftco-46-row d-flex flex-column flex-lg-row">
                  <div class="ftco-46-text ftco-46-arrow-right">
                    <h4 class="ftco-46-subheading">empanadas de queso</h4>
                    <h3 class="ftco-46-heading">empanadas fritas rellenas de queso</h3>
                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incide.</p>
                    <p><a href="#" class="btn-link">Learn More <span class="ion-android-arrow-forward"></span></a></p>
                  </div>
                  <div class="ftco-46-image" style="background-image: url(images/humintas.jpg);"></div>
                  <div class="ftco-46-text ftco-46-arrow-up">
                    <h4 class="ftco-46-subheading">empanadas de charque</h4>
                    <h3 class="ftco-46-heading">empanadas rellenas de carne</h3>
                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incide.</p>
                    <p><a href="#" class="btn-link">Learn More <span class="ion-android-arrow-forward"></span></a></p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div> <!-- .section -->
        <div class="section bg-light" id="section-menu" data-aos="fade-up">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Menu</h2>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-8">

                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-breakfast" role="tabpanel" aria-labelledby="pills-breakfast-tab">
                    <div class="d-block d-md-flex menu-food-item">

                      <div class="text order-1 mb-3">
                        <img src="images/empanada-queso.png" alt="Image">
                        <h3><a href="#">Empanadas de queso</a></h3>
                        <p>empanadas rellenas de queso</p>
                      </div>
                      <div class="price order-2">
                        <strong>bs.8,00</strong>
                      </div>
                    </div> <!-- .menu-food-item -->

                    <div class="d-block d-md-flex menu-food-item">
                      <div class="text order-1 mb-3">
                        <img src="images/charque.jpg" alt="Image">
                        <h3><a href="#">empanadas de charque</a></h3>
                        <p>empanadas con charque de llama</p>
                      </div>
                      <div class="price order-2">
                        <strong>bs.9,00</strong>
                      </div>
                    </div> <!-- .menu-food-item -->

                    <div class="d-block d-md-flex menu-food-item">
                      <div class="text order-1 mb-3">
                        <img src="images/api.jpg" alt="Image">
                        <h3><a href="#">empanadas de api</a></h3>
                        <p>las mejores empanadas tipo api de la ciudad</p>
                      </div>
                      <div class="price order-2">
                        <strong>bs.7,00</strong>
                      </div>
                    </div> <!-- .menu-food-item -->

                    <div class="d-block d-md-flex menu-food-item">
                      <div class="text order-1 mb-3">
                        <img src="images/humintas.jpg" alt="Image">
                        <h3><a href="#">Humintas &amp; Shrimp Quesadilla</a></h3>
                        <p>Humintas a la olla</p>
                      </div>
                      <div class="price order-2">
                        <strong>$13.99</strong>
                      </div>
                    </div> <!-- .menu-food-item -->


                  </div>
                </div>
              </div>

            </div>
          </div>
        </div> <!-- .section -->
    </div>
    <div id="top">
      <iframe
      allow="microphone;"
      width="350"
      height="430"
      src="https://console.dialogflow.com/api-client/demo/embedded/74785e98-cabe-41e0-bc1f-650077aa450e">
      </iframe>
    </div>
    <style media="screen">
    #top{
      position: fixed;
      bottom: 0;
      right: 0;
    }
    </style>

    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff7a5c"/></svg></div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>

    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>

    <script src="js/jquery.easing.1.3.js"></script>

    <script src="js/aos.js"></script>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>

    <script src="js/main.js"></script>
  </body>
</html>
