<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absence Interface</title>


    <style>
@import url("https://fonts.googleapis.com/css?family=Poppins:400,500,600");
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
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }

        nav {
            background: linear-gradient(95deg,#5533ff 40%,#25ddf5 100%)!important;;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        nav li {
            margin: 0 15px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 16px;}

        main {
            padding: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #394240;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #394240;
        }


        input {
            width: 30%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }




        .succes {
    background-color: #DFF0D8;
    color: #3C763D;
    padding: 15px;
    border-radius: 8px;
    margin: 20px 0; /* Adjusted margin */
    width: calc(100% - 40px); /* Adjusted width calculation */
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
      .echec {
    background: #F2DEDE;
    color: #A94442;
    padding: 15px;
    border-radius: 8px;
    margin: 20px 0;
    width: calc(100% - 40px);;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

  }

  .search-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .search-container h2 {
            color: #394240;
        }

        .search-container label {
            display: block;
            margin-bottom: 8px;
            color: #394240;
        }

        .search-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        .search-container button {
    background-color: #3ecf8e;
    color: #fff;
    padding: 12px 24px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

        .search-container button:hover {
            background-color: #1a1d1e;
        }



    </style>
</head>
<body>
<header>
      <h1>Ajout d'abscences</h1>
  </header>
  <nav>
      <ul>
      <li><a href="http://localhost/centre/ajouter.php#">Ajouter un étudiant</a></li>
          <li><a href="http://localhost/centre/search.php#">Chercher un étudiant</a></li>
          <li><a href="http://localhost/centre/addabscent.php#">Ajouter abscence</a></li>
          <li><a href="http://localhost/centre/abscent.php">Voir les abscences</a></li>
          <li><a href="http://localhost/centre/emploie.php">Voir emploies</a></li>
          <li><a href="http://localhost/centre/testdelete.php#">Voir les groupes</a></li>
          <li><a href="http://localhost/centre/voiretud.php">Voir les etudiants</a></li>
          <li><a href="http://localhost/centre/voirProfs.php">Voir les profs</a></li>
          <li><a href="http://localhost/centre/main.php">Revenir à l'acceuil</a></li>
      </ul>
  </nav>


<br><br>

<div class="search-container">
            <h2>Ajouter un absence</h2>
            <form action="insert_absence.php" method="post">
                <?php if (isset($_GET['echec'])){ ?>
                    <p id="echecMessage" class="echec"><?php echo $_GET['echec']; ?></p>
                <?php } ?>
                <?php if (isset($_GET['succes'])){ ?>
                    <p id="successMessage" class="succes"><?php echo $_GET['succes']; ?></p>
                <?php } ?>


                <label for="idetudiant">ID Étudiant:</label>
                <input type="text" id="idetudiant" name="idetudiant">

                <label for="numero_seance">Numéro de Séance :</label>
                <input type="text" id="numero_seance" name="numero_seance">

                <button type="submit">Ajouter</button>
            </form>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
        // Select the success message element
        var echecMessage = document.getElementById("echecMessage");

        // Check if the success message element exists
        if (echecMessage) {
            // Set the duration in milliseconds (e.g., 3000 milliseconds = 3 seconds)
            var duration = 4000;

            // Hide the success message after the specified duration
            setTimeout(function() {
                echecMessage.style.display = "none";
            }, duration);
        }
    });
    document.addEventListener("DOMContentLoaded", function() {
                // Select the success message element
                var successMessage = document.getElementById("successMessage");

                // Check if the success message element exists
                if (successMessage) {
                    // Set the duration in milliseconds (e.g., 3000 milliseconds = 3 seconds)
                    var duration = 4000;

                    // Hide the success message after the specified duration
                    setTimeout(function() {
                        successMessage.style.display = "none";
                    }, duration);
                }
            });
</script>

</body>
</html>
