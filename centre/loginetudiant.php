<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Design by foolishdeveloper.com -->
  <title>Glassmorphism login Form Tutorial in html css</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <!--Stylesheet-->
  <style media="screen">
    *,
    *:before,
    *:after {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }
    @import url("https://fonts.googleapis.com/css?family=Poppins:400,500,600");    

    body {
      background-color: #fff; /* Changed background color to blue */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: 'Poppins', sans-serif;
    }

    form {
      width: 350px;
      background-color: rgba(255, 255, 255, 0.13);
      border-radius: 10px;
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
      padding: 50px 35px;
    }

    form * {
      font-family: 'Rubik', sans-serif;
      color: #000000;
      letter-spacing: 0.5px;
      outline: none;
      border: none;
    }

    form h3 {
      font-size: 32px;
      font-weight: 500;
      line-height: 42px;
      text-align: center;
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin-top: 20px;
      font-size: 16px;
      font-weight: 500;
    }

    input {
      display: block;
      height: 40px;
      width: 100%;
      background-color: rgba(36, 35, 35, 0.07);
      border-radius: 3px;
      padding: 0 10px;
      margin-top: 8px;
      font-size: 14px;
      font-weight: 300;
      background-color: rgba(36, 35, 35, 0.07);
    }

    ::placeholder {
      color: #555555;
    }

    button {
      margin-top: 30px;
      width: 100%;
      background-color: #3ecf8e;
      color: #fff;
      padding: 15px 0;
      font-size: 18px;
      font-weight: 600;
      border-radius: 5px;
      cursor: pointer;
    }
    .echec {
      background: #F2DEDE;
            color: #A94442;
            padding: 10px;
            border-radius: 5px;
            margin: 20px auto;
            width: 100%;
            text-align: center;

  }
  </style>
</head>

<body>
  <form action="testvoire.php" method="post">



    <h3>Login Here</h3>
    <?php if (isset($_GET['echec'])){ ?>
                <p id="echecMessage" class="echec"><?php echo $_GET['echec']; ?></p>
            <?php } ?>

    <label for="username">Prenom</label>
    <input type="text" placeholder="prenom" id="username" name="prenom">

    <label for="text">Prenom</label>
    <input type="text" placeholder="nom" id="text" name="nom">

    <label for="username">Email</label>
    <input type="email" placeholder="email" id="username" name="email">

    <button>Log In</button>
  </form>
</body>

</html>