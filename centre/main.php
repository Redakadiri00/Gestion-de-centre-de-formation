<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>mainjdida</title>
  <link rel="shortcut icon" href="img/2.png" type="image/png">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>


@import url("https://fonts.googleapis.com/css?family=Rubik:400,400i,500");
@import url("https://fonts.googleapis.com/css?family=Poppins:400,500,600");
    /* Add this CSS for enhanced styling */
    body {
      font-family: 'Rubik', sans-serif;
      color: #333;
      background: #fff;
      margin: 0;
      padding: 0;
    }

    header {
      background: linear-gradient(95deg,#5533ff 40%,#25ddf5 100%)!important;
      color: #fff;
      padding: 350px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    .navbar-brand img {
      max-width: 150px;
    }

    .hero-area {
      text-align: center;
    }

    .section {
      padding: 80px 0;
    }

    .services-item {
      background-color: #fff;
      border: 1px solid #73D0C1;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 60px 20px;
      text-align: center;
      transition: all 0.3s ease;
    }

    .services-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .services-item .icon {
      font-size: 48px;
      margin-bottom: 20px;
      color: #ff5722;
    }

    .services-item h4 {
      font-size: 24px;
      margin-bottom: 15px;
      color: #333;
    }

    .services-item p {
      font-size: 16px;
      color: #777;
    }

    .navbar-nav .nav-item .nav-link {
      color: #fff;
    }

    .image-container {
      position: absolute;
      right: 20%;
      top: 50%;
      transform: translateY(-50%);
    }

    .image-container img {
      max-width: 400px;
      height: auto;
    }

    .text-section {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 20%;
    }

    .text-section h2 {
      font-size: 36px;
      margin-bottom: 20px;
      color: #fff;

    }

    .text-section p {
      font-size: 18px;
      margin-bottom: 20px;
      color: #fff;
      right: 0px
    }



    .top-buttons {
      position: fixed;
      top: 80px;
      right: 350px;
      z-index: 9999;
      visibility: visible; /* Initially visible */
      opacity: 1; /* Initially fully opaque */
      transition: visibility 0s, opacity 0.5s linear;
    }

    /* Hide buttons when scrolling */
    .top-buttons.hidden {
      visibility: hidden;
      opacity: 0;
    }

    /* Style for the buttons */
    .top-buttons a {
      margin-right: 10px;
      padding: 10px 15px;
      border-radius: 5px;

      color: #fff;
      text-decoration: none;
      transition: background-color 0.3s;
    }


    .logo {
  position: absolute;
  top: 83px; /* Adjust the distance from the top */
  left: 350px; /* Adjust the distance from the left */
}

.logo img {
  max-width: 160px; /* Adjust the maximum width of your logo */
}





  </style>




<script>
    window.addEventListener("scroll", function() {
      var buttonDiv = document.querySelector(".top-buttons");
      if (window.scrollY > 50) { // Adjust this value as needed
        buttonDiv.classList.add("hidden");
      } else {
        buttonDiv.classList.remove("hidden");
      }
    });
  </script>




</head>
<body>

<header id="home" class="hero-area">
  <div class="overlay">
    <span></span>
    <span></span>
  </div>
  <div class="text-section">
    <h2>Un étudiant, un enseignant <br> un livre et un stylo  <br>peuvent changer le monde</h2>
    <p>Épanouissement assuré,<br> formation exceptionnelle pour un avenir prometteur .</p>
  </div>
  <div class="image-container">
    <img src="Nerd-amico.png" alt="Your Image">
  </div>

  <div class="logo">
    <img src="https://iili.io/JujejsV.png" alt="Your Logo">
  </div>




</header>



<div class="top-buttons">
  <a href="http://localhost/centre/loginetudiant.php">Login Etudiant</a>
  <a href="http://localhost/centre/loginprof.php">Login Prof</a>
  <a href="http://localhost/centre/logindirecteur.php">Login Admin</a>

</div>









<section id="services" class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-xs-12">
        <div class="services-item ">

          <h4>Soutient</h4>
          <p>Améliorez vos notes et développez vos connaissances.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-xs-12">
        <div class="services-item text-center">

          <h4>Langue et Communication</h4>
          <p>Acquérir la capacité de communiquer dans des langues étrangères.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-xs-12">
        <div class="services-item text-center">

          <h4>Soft Skills et Informatique</h4>
          <p>Acquière des compétences précieuses afin d'optimiser ton avenir professionnel.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<footer>
  <!-- Your footer content here -->
</footer>

<a href="#" class="back-to-top" style="display: none;">
  <i class="lni-chevron-up"></i>
</a>

<div id="preloader" style="display: none;">
  <div class="loader" id="loader-1"></div>
</div>

</body>
</html>
